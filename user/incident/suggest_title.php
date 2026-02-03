<?php
/**
 * Auto-Suggest Incident Title based on Description
 * Uses OpenAI API to analyze the description and suggest the most appropriate incident title
 */

header('Content-Type: application/json');

include('../../connectMySql.php');
include '../../loginverification.php';

// Load environment variables
require_once('../../includes/env_loader.php');
loadEnv('../../.env');

// Check if user is logged in
if (!logged_in()) {
    echo json_encode(['success' => false, 'error' => 'Unauthorized access']);
    exit;
}

// Get the JSON input
$input = json_decode(file_get_contents('php://input'), true);

if (!isset($input['description']) || empty(trim($input['description']))) {
    echo json_encode(['success' => false, 'error' => 'Description is required']);
    exit;
}

$description = trim($input['description']);

// Get API key from environment variables
$apiKey = env('OPENAI_API_KEY');
if (!$apiKey) {
    echo json_encode(['success' => false, 'error' => 'API configuration error']);
    exit;
}

// Define the available incident titles
$availableTitles = [
    // Phishing
    "Nag-click ako ng suspicious link",
    "Binigay ko ang OTP sa scammer",
    "Na-scam ako sa pekeng website/email",
    // Identity Theft
    "May gumamit ng ID ko para mag-loan",
    "May fake account na gumagamit ng pangalan/photos ko",
    "Ginamit ang personal info ko nang walang pahintulot",
    // Online Fraud
    "Na-scam ako sa online shopping",
    "Na-scam ako sa investment/crypto scheme",
    "Nawala ang pera ko sa GCash/Maya scam",
    // Hacking / Unauthorized Access
    "Na-hack ang social media account ko",
    "May nag-access sa account ko nang walang pahintulot",
    "May virus/malware ang device ko",
    // Cyberbullying
    "Inaapi/minamaliit ako online",
    "May nagbabanta o nang-haharass sa akin online",
    "Pinapahiya ako o kinakalat ang photos/videos ko"
];

$titlesJson = json_encode($availableTitles, JSON_UNESCAPED_UNICODE);

$prompt = "
Analyze the following incident description and determine which incident title is the BEST match.

Description:
\"$description\"

Available Incident Titles (choose EXACTLY one from this list):
$titlesJson

RULES:
1. You MUST select one title from the list above. Do not create new titles.
2. Analyze the description carefully to understand the type of cybercrime or incident.
3. Match keywords and context to the most appropriate title.

MATCHING GUIDE:
- Phishing: suspicious links, fake emails/websites, OTP scams, scam messages
- Identity Theft: someone using your ID, fake accounts using your name/photos, personal info misuse
- Online Fraud: shopping scams, investment/crypto scams, GCash/Maya scams, money loss
- Hacking: hacked accounts, unauthorized access, viruses, malware
- Cyberbullying: harassment, threats, bullying, embarrassment, spreading photos/videos

Return your answer in this exact JSON format only:
{
    \"suggested_title\": \"<exact title from the list>\",
    \"confidence\": \"high|medium|low\",
    \"category\": \"Phishing|Identity Theft|Online Fraud|Hacking|Cyberbullying\"
}
";

$url = "https://api.openai.com/v1/chat/completions";

$payload = [
    "model" => "gpt-4o-mini",
    "messages" => [
        [
            "role" => "system",
            "content" => "You are an expert at classifying cybercrime incidents. Always respond with valid JSON only."
        ],
        [
            "role" => "user",
            "content" => $prompt
        ]
    ],
    "max_tokens" => 200,
    "temperature" => 0.3
];

$ch = curl_init($url);
curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_HTTPHEADER => [
        "Content-Type: application/json",
        "Authorization: Bearer $apiKey"
    ],
    CURLOPT_POSTFIELDS => json_encode($payload)
]);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

if (!$response) {
    echo json_encode(['success' => false, 'error' => 'Failed to connect to AI service']);
    exit;
}

$result = json_decode($response, true);

if (isset($result['error'])) {
    echo json_encode(['success' => false, 'error' => 'AI service error: ' . $result['error']['message']]);
    exit;
}

if (isset($result['choices'][0]['message']['content'])) {
    $content = trim($result['choices'][0]['message']['content']);
    
    // Clean up the response (remove markdown code blocks if present)
    $content = preg_replace('/```(json)?/i', '', $content);
    $content = trim($content);
    
    $jsonData = json_decode($content, true);
    
    if ($jsonData && isset($jsonData['suggested_title'])) {
        $suggestedTitle = $jsonData['suggested_title'];
        
        // Verify the suggested title is in our list
        if (in_array($suggestedTitle, $availableTitles)) {
            echo json_encode([
                'success' => true,
                'suggested_title' => $suggestedTitle,
                'confidence' => $jsonData['confidence'] ?? 'medium',
                'category' => $jsonData['category'] ?? 'Unknown'
            ]);
        } else {
            // Try to find a partial match
            $bestMatch = null;
            $bestScore = 0;
            
            foreach ($availableTitles as $title) {
                similar_text(strtolower($suggestedTitle), strtolower($title), $score);
                if ($score > $bestScore) {
                    $bestScore = $score;
                    $bestMatch = $title;
                }
            }
            
            if ($bestMatch && $bestScore > 50) {
                echo json_encode([
                    'success' => true,
                    'suggested_title' => $bestMatch,
                    'confidence' => 'medium',
                    'category' => $jsonData['category'] ?? 'Unknown'
                ]);
            } else {
                echo json_encode(['success' => false, 'error' => 'Could not determine appropriate title']);
            }
        }
    } else {
        echo json_encode(['success' => false, 'error' => 'Invalid response from AI service']);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'No response from AI service']);
}
?>
