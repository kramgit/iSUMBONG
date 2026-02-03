<?php
include('../../connectMySql.php');
include '../../loginverification.php';

// Load environment variables
require_once('../../includes/env_loader.php');
loadEnv('../../.env');

if (logged_in()) {
    if (isset($_POST['btn_save'])) {
        $title = isset($_POST['title']) && !empty($_POST['title']) ? $_POST['title'] : '';
        $category = "";
        $date = $_POST['date']; // Date reported by user
        $description = $_POST['description'] . "\n\nLocation: " . ($_POST['location'] ?? '') . "\nReporter Address: " . ($_POST['address'] ?? ''); // Include both location and address in description
        $location = $_POST['location'] ?? ''; // Store location for database
        $address = $_POST['address'] ?? ''; // Store address with fallback
        $severity_level = "";
        $full_name = $_POST['full_name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'] ?? '';
        $notified = ''; // Set default value for notified field
        $evidence_logs = isset($_POST['evidence_logs']) ? 1 : 0;
        $evidence_screenshots = isset($_POST['evidence_screenshots']) ? 1 : 0;
        $evidence_email = isset($_POST['evidence_email']) ? 1 : 0;
        $evidence_other = isset($_POST['evidence_other']) ? 1 : 0;
        $additional_info = $_POST['additional_info'];
        $user_id = $_SESSION['user_id'];
        $suggestion = "";
        $table = "incident";

        // Get API key from environment variables
        $apiKey = env('OPENAI_API_KEY');
        if (!$apiKey) {
            echo "❌ OpenAI API key not found in environment variables.";
            exit;
        }
        
        $url = "https://api.openai.com/v1/chat/completions";
        if (!isset($_FILES['attachment']) || !isset($_POST['description'])) {
            echo "❌ Please upload an image and enter a description.";
            exit;
        }
        $description = $_POST['description'];
        $imageTmpName = $_FILES['attachment']['tmp_name'][0] ?? null;
        $imageType = $_FILES['attachment']['type'][0] ?? '';
        if (!$imageTmpName || !file_exists($imageTmpName)) {
            echo "❌ Please upload at least one valid image file.";
            exit;
        }
        $imageData = base64_encode(file_get_contents($imageTmpName));
        $payload = [
            "model" => "gpt-4o-mini",
            "messages" => [[
                "role" => "user",
                "content" => [
                    [
                        "type" => "text",
                        "text" => "Suriin mo kung tugma ang larawan sa description na ito: '$description'. Sagutin lang ng 'Tugma' o 'Hindi tugma'."
                    ],
                    [
                        "type" => "image_url",
                        "image_url" => [
                            "url" => "data:$imageType;base64,$imageData"
                        ]
                    ]
                ]
            ]],
            "max_tokens" => 50
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
        curl_close($ch);

        if (!$response) {
            echo "❌ No response from API.";
            exit;
        }

        $result = json_decode($response, true);
        if (isset($result['choices'][0]['message']['content'])) {
            if($result['choices'][0]['message']['content'] != 'Tugma'){
                $table = "spam";
            }
        } 

        // Skip categorization if it's spam
        if ($table == "spam") {
            // Set default values for spam - no AI categorization needed
            $category = "Spam";
            $severity_level = "N/A";
            $suggestion = "This report has been marked as spam and will be reviewed by administrators.";
            // Set a default title for spam if not provided
            if (empty($title)) {
                $title = "Spam Report";
            }
        } else {
            // Only do AI categorization for non-spam incidents
        $apiKey = env('OPENAI_API_KEY');
        if (!$apiKey) {
            echo "❌ OpenAI API key not found in environment variables.";
            exit;
        }

        // Available titles for auto-detection
        $availableTitles = [
            // Phishing - by severity
            "May nag-send ng chat na may link",
            "Nakatanggap ng suspicious na email o text",
            "Nag-click ako ng suspicious link",
            "Binigay ko ang OTP sa scammer",
            "Na-scam ako sa pekeng website/email",
            // Identity Theft - by severity
            "May humihinging ng personal info ko online",
            "May gumamit ng ID ko para mag-loan",
            "May fake account na gumagamit ng pangalan/photos ko",
            "Ginamit ang personal info ko nang walang pahintulot",
            // Online Fraud - by severity
            "May nag-aalok ng too good to be true deals",
            "Na-scam ako sa online shopping",
            "Na-scam ako sa investment/crypto scheme",
            "Nawala ang pera ko sa GCash/Maya scam",
            // Hacking - by severity
            "May kakaibang login attempts sa account ko",
            "Na-hack ang social media account ko",
            "May nag-access sa account ko nang walang pahintulot",
            "May virus/malware ang device ko",
            // Cyberbullying - by severity
            "Inaapi/minamaliit ako online",
            "May nagbabanta o nang-haharass sa akin online",
            "Pinapahiya ako o kinakalat ang photos/videos ko"
        ];
        $titlesJson = json_encode($availableTitles, JSON_UNESCAPED_UNICODE);

        $prompt = "
        Base sa description, classify mo ito at piliin ang PINAKA-ANGKOP na title:

        Description: $description

        Ibigay ang sagot sa JSON format lang na ganito. 
        Plain text lang, walang HTML tags tulad ng <br>. 
        Gamitin ang newline (\\n) para sa spacing. 

        RULE: Alamin muna ang pangunahing language ng Title at Description.
        - Kung mas marami ang English words, gamitin ang English sa suggestion.
        - Kung mas marami ang Filipino words, gamitin ang Filipino sa suggestion.
        - Isang language lang dapat, huwag halo-halo.

        SEVERITY LEVEL CRITERIA - Gamitin ang tamang criteria base sa category:

        **Phishing:**
        - Low: Suspicious message received, but no interaction
        - High: User clicked the link or replied, but no data was stolen
        - Critical: Credentials or sensitive data were stolen

        **Identity Theft:**
        - Low: Attempted use of personal information
        - High: Partial misuse of identity
        - Critical: Full identity misuse causing financial or legal damage

        **Online Fraud:**
        - Low: Scam attempt reported with no loss
        - High: Financial loss with limited impact
        - Critical: Large financial loss or repeated fraudulent transactions

        **Unauthorized Access:**
        - Low: Failed login attempts detected
        - High: Account accessed, but no data loss
        - Critical: Account fully compromised and data modified or stolen

        **Cyberbullying:**
        - Low: Verbal harassment without threats
        - High: Repeated harassment causing emotional distress
        - Critical: Threats, blackmail, or content causing serious harm

        AVAILABLE TITLES (piliin ang ISANG title na PINAKA-ANGKOP sa description):
        $titlesJson

        TITLE SELECTION GUIDE:
        - Phishing Low: 'May nag-send ng chat na may link', 'Nakatanggap ng suspicious na email o text'
        - Phishing High: 'Nag-click ako ng suspicious link'
        - Phishing Critical: 'Binigay ko ang OTP sa scammer', 'Na-scam ako sa pekeng website/email'
        - Identity Theft Low: 'May humihinging ng personal info ko online'
        - Identity Theft High: 'May gumamit ng ID ko para mag-loan', 'May fake account na gumagamit ng pangalan/photos ko'
        - Identity Theft Critical: 'Ginamit ang personal info ko nang walang pahintulot'
        - Online Fraud Low: 'May nag-aalok ng too good to be true deals'
        - Online Fraud High: 'Na-scam ako sa online shopping'
        - Online Fraud Critical: 'Na-scam ako sa investment/crypto scheme', 'Nawala ang pera ko sa GCash/Maya scam'
        - Unauthorized Access Low: 'May kakaibang login attempts sa account ko'
        - Unauthorized Access High: 'Na-hack ang social media account ko'
        - Unauthorized Access Critical: 'May nag-access sa account ko nang walang pahintulot', 'May virus/malware ang device ko'
        - Cyberbullying Low: 'Inaapi/minamaliit ako online'
        - Cyberbullying High: 'May nagbabanta o nang-haharass sa akin online'
        - Cyberbullying Critical: 'Pinapahiya ako o kinakalat ang photos/videos ko'

        {
        \"title\": \"Piliin ang ISANG title mula sa listahan na PINAKA-ANGKOP sa description. EXACT title lang.\",
        \"category\": \"Choose from these 5 categories ONLY: Phishing, Identity Theft, Online Fraud, Unauthorized Access, or Cyberbullying\",
        \"severity_level\": \"Low | High | Critical (Based on the criteria above, analyze the description carefully and assign the appropriate level)\",
        \"suggestion\": \"Preventive measures (paano maiwasan / how to avoid), bullet points na may paliwanag bawat isa.\\n\\n If it happens / If it happens, ilagay ang dapat gawin step-by-step, gamit ang parehong language na ginamit sa Description.\"
        }
        ";

        $ch = curl_init("https://api.openai.com/v1/chat/completions");

        $data = [
            "model" => "gpt-4o-mini",
            "messages" => [
                ["role" => "user", "content" => $prompt]
            ],
        ];

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Content-Type: application/json",
            "Authorization: " . "Bearer " . $apiKey,
        ]);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            echo "cURL Error: " . curl_error($ch);
        } else {
            $result = json_decode($response, true);

            if (isset($result['error'])) {
                echo "API Error: " . $result['error']['message'];
            } elseif (isset($result['choices'][0]['message']['content'])) {
                $content = trim($result['choices'][0]['message']['content']);

                $jsonData = json_decode($content, true);

                if (!$jsonData) {
                    $clean = preg_replace('/```(json)?/i', '', $content);
                    $clean = trim($clean);
                    $jsonData = json_decode($clean, true);
                }

                if ($jsonData && isset($jsonData['category'], $jsonData['severity_level'], $jsonData['suggestion'])) {
                    // Auto-detect title if not provided by user
                    if (empty($title) && isset($jsonData['title'])) {
                        $suggestedTitle = trim($jsonData['title']);
                        // Verify it's in our list
                        if (in_array($suggestedTitle, $availableTitles)) {
                            $title = $suggestedTitle;
                        } else {
                            // Try to find closest match
                            $bestMatch = null;
                            $bestScore = 0;
                            foreach ($availableTitles as $t) {
                                similar_text(strtolower($suggestedTitle), strtolower($t), $score);
                                if ($score > $bestScore) {
                                    $bestScore = $score;
                                    $bestMatch = $t;
                                }
                            }
                            $title = ($bestMatch && $bestScore > 50) ? $bestMatch : "Na-scam ako sa pekeng website/email";
                        }
                    }
                    
                    $category = $jsonData['category'];
                    $severity_level = $jsonData['severity_level'];
                    $suggestion = $jsonData['suggestion'];

                    if (is_array($suggestion)) {
                        $suggestion = implode("\n", $suggestion);
                    }

                    $suggestion = str_replace(
                        ["<br>", "<br/>", "<br />"], 
                        "\n", 
                        $suggestion
                    );

                    // Remove the htmlspecialchars that was causing HTML encoding issues
                    // $suggestion = htmlspecialchars($suggestion, ENT_QUOTES, 'UTF-8');
                } else {
                    // If JSON parsing fails, set default values instead of showing error
                    $category = "General Security";
                    $severity_level = "Medium";
                    $suggestion = "Please review this incident and take appropriate security measures.";
                    
                    // Optionally log the parsing issue for debugging (comment out in production)
                    // echo "JSON parsing failed. Using default values.<br>";
                    // echo "<pre>" . htmlspecialchars($content) . "</pre>";
                }
            } else {
                // If no content in API response, use default values
                $category = "General Security";
                $severity_level = "Medium";
                $suggestion = "Please review this incident and take appropriate security measures.";
                
                // Optionally log the API issue for debugging (comment out in production)
                // echo "No content in API response. Using default values.<br>";
                // echo "<pre>" . print_r($result, true) . "</pre>";
            }
        }

        curl_close($ch);
        
        } // End of if ($table != "spam")


        // Use prepared statement to prevent SQL injection
        $sql = "INSERT INTO $table (
            title, category, date, description, location, severity_level,
            full_name, address, email, phone, notified,
            evidence_logs, evidence_screenshots, evidence_email, evidence_other,
            additional_info, user_id, suggestion
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssssssssiiiisss", 
            $title, $category, $date, $description, $location, $severity_level,
            $full_name, $address, $email, $phone, $notified,
            $evidence_logs, $evidence_screenshots, $evidence_email, $evidence_other,
            $additional_info, $user_id, $suggestion
        );
        
        $result = $stmt->execute();

        if ($result) {
            $incident_id = $stmt->insert_id;

            // Debug: Log the incident ID
            error_log("New incident created with ID: " . $incident_id);

            if (!empty($_FILES['attachment']['name'][0])) {
                $upload_dir = "../../uploads/";
                
                // Create upload directory if it doesn't exist
                if (!is_dir($upload_dir)) {
                    mkdir($upload_dir, 0777, true);
                }

                $uploaded_files = [];
                foreach ($_FILES['attachment']['name'] as $key => $name) {
                    // Skip empty file names or invalid uploads
                    if (empty($name) || !isset($_FILES['attachment']['tmp_name'][$key])) {
                        continue;
                    }
                    
                    $tmp_name = $_FILES['attachment']['tmp_name'][$key];
                    $file_name = basename($name);
                    
                    // Create unique filename to prevent conflicts
                    $unique_name = uniqid() . "_" . time() . "_" . $file_name;
                    $file_path = $upload_dir . $unique_name;

                    // Validate file upload
                    if (is_uploaded_file($tmp_name) && move_uploaded_file($tmp_name, $file_path)) {
                        // Use prepared statement for security
                        $attachment_sql = "INSERT INTO attachment (incident_id, attachment, filename) VALUES (?, ?, ?)";
                        $attachment_stmt = $conn->prepare($attachment_sql);
                        $attachment_stmt->bind_param("iss", $incident_id, $file_path, $file_name);
                        $attachment_stmt->execute();
                        $attachment_stmt->close();
                        
                        $uploaded_files[] = $file_name;
                        error_log("Uploaded file: " . $file_name . " for incident ID: " . $incident_id);
                    }
                }
                
                error_log("Total files uploaded: " . count($uploaded_files) . " - Files: " . implode(", ", $uploaded_files));
            }

            $query = "SELECT * FROM admin limit 1";
            $result = $conn->query($query);
            while ($row = $result->fetch_assoc()) {
                require_once('../../PHPMailer/PHPMailerAutoload.php');
                require_once('../../gmail_config.php'); // Load email configuration
                
                $mail = new PHPMailer;
                $mail->isSMTP();
                $mail->Host = SMTP_HOST;
                $mail->Port = SMTP_PORT;
                $mail->SMTPAuth = true;
                $mail->Username = SMTP_USERNAME;
                $mail->Password = SMTP_PASSWORD;
                $mail->SMTPSecure = SMTP_ENCRYPTION;
                $mail->setFrom(FROM_EMAIL, FROM_NAME);
                $mail->addReplyTo(REPLY_TO_EMAIL, FROM_NAME);
                $mail->addAddress($row['email'], 'Receiver Name');
                $mail->Subject = 'New Incident Report';
                $mail->isHTML(true);

                $mail->Body = '
                <!DOCTYPE html>
                <html>
                <head>
                <style>
                    body {
                    font-family: Arial, sans-serif;
                    background-color: #f4f6f8;
                    margin: 0;
                    padding: 0;
                    }
                    .container {
                    background-color: #ffffff;
                    max-width: 600px;
                    margin: 30px auto;
                    padding: 20px 30px;
                    border-radius: 8px;
                    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
                    color: #333;
                    }
                    .header {
                    text-align: center;
                    padding-bottom: 20px;
                    }
                    .header h2 {
                    margin: 0;
                    color: #1a73e8;
                    }
                    .content p {
                    margin: 12px 0;
                    font-size: 15px;
                    }
                    .label {
                    font-weight: bold;
                    color: #555;
                    }
                    .footer {
                    margin-top: 30px;
                    font-size: 13px;
                    text-align: center;
                    color: #888;
                    }
                </style>
                </head>
                <body>
                <div class="container">
                    <div class="header">
                    <h2>🚨 New Incident Report</h2>
                    </div>
                    <div class="content">
                    <p><span class="label">Title:</span> '.$title.'</p>
                    <p><span class="label">Category:</span> '.$category.'</p>
                    <p><span class="label">Date:</span> '.$date.'</p>
                    <p><span class="label">Description:</span><br>'.$description.'</p>
                    <p><span class="label">Reported By:</span> '.$_SESSION['name'].'</p>
                    </div>
                    <div class="footer">
                    This is an automated message. Please do not reply.
                    </div>
                </div>
                </body>
                </html>';

                if (!$mail->send()) {
                    echo 'Email not sent: ' . $mail->ErrorInfo;
                } else {
                    echo "<script src='../../js/sweetalert2.all.min.js'></script>
                    <body onload='success()'></body>
                    <script> 
                    function success(){
                    Swal.fire({
                        icon: 'success',
                        title: 'Report Sent'
                    })
                    }</script>";
                }
            }

            echo "<script src='../../js/sweetalert2.all.min.js'></script>
            <body onload='save()'></body>
            <script> 
            function save(){
                Swal.fire({
                    title: 'Incident Reported Successfully!',
                    text: 'Your incident has been reported.',
                    icon: 'success',
                    confirmButtonText: 'View Reports'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'index.php';
                    }
                });
            }
            </script>";
        } else 
        {
            echo "Error saving incident: " . $stmt->error;
        }
        
        $stmt->close();
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>iSumbong</title>

    <!-- Custom fonts for this template-->
    <link href="../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../../css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

       <?php include'../sidebar.php';?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

               <?php include'../nav.php';?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                         <div class="container">

                            <div class="card o-hidden border-0 shadow-lg my-5">
                                <div class="card-body ">
                                    <!-- Nested Row within Card Body -->
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="">
                                                <a href="index.php" class="text-primary d-flex align-items-center mb-3" style="text-decoration: none;">
                                                    <i class="fas fa-arrow-left me-2"></i> Back to Manage Incidents
                                                </a>
                                                <div class="text-center">
                                                    <h1 class="h4 text-gray-900 mb-4">Report Incident</h1>
                                                </div>
                                                <form method="post" enctype="multipart/form-data" style="background: #fff; padding: 2rem; border-radius: 10px;  margin: auto;">
                                                    <div class="row">
                                                
                                                    <div class="form-group mb-3 col-lg-6 col-12">
                                                        <label for="title">Incident Title <span class="text-muted">(Optional - Auto-detected)</span></label>
                                                        <select class="form-control" id="title" name="title">
                                                            <option value="" selected>-- System will auto-detect / Awtomatikong pipiliin ng sistema --</option>
                                                            <optgroup label="🟢 Phishing - Low (Nakatanggap lang)">
                                                                <option value="May nag-send ng chat na may link">May nag-send ng chat na may link</option>
                                                                <option value="Nakatanggap ng suspicious na email o text">Nakatanggap ng suspicious na email o text</option>
                                                            </optgroup>
                                                            <optgroup label="🟡 Phishing - High (Na-click ang link)">
                                                                <option value="Nag-click ako ng suspicious link">Nag-click ako ng suspicious link</option>
                                                            </optgroup>
                                                            <optgroup label="🔴 Phishing - Critical (Naibigay ang info)">
                                                                <option value="Binigay ko ang OTP sa scammer">Binigay ko ang OTP sa scammer</option>
                                                                <option value="Na-scam ako sa pekeng website/email">Na-scam ako sa pekeng website/email</option>
                                                            </optgroup>
                                                            <optgroup label="🟢 Identity Theft - Low">
                                                                <option value="May humihinging ng personal info ko online">May humihinging ng personal info ko online</option>
                                                            </optgroup>
                                                            <optgroup label="🟡 Identity Theft - High">
                                                                <option value="May gumamit ng ID ko para mag-loan">May gumamit ng ID ko para mag-loan</option>
                                                                <option value="May fake account na gumagamit ng pangalan/photos ko">May fake account na gumagamit ng pangalan/photos ko</option>
                                                            </optgroup>
                                                            <optgroup label="🔴 Identity Theft - Critical">
                                                                <option value="Ginamit ang personal info ko nang walang pahintulot">Ginamit ang personal info ko nang walang pahintulot</option>
                                                            </optgroup>
                                                            <optgroup label="🟢 Online Fraud - Low">
                                                                <option value="May nag-aalok ng too good to be true deals">May nag-aalok ng too good to be true deals</option>
                                                            </optgroup>
                                                            <optgroup label="🟡 Online Fraud - High">
                                                                <option value="Na-scam ako sa online shopping">Na-scam ako sa online shopping</option>
                                                            </optgroup>
                                                            <optgroup label="🔴 Online Fraud - Critical">
                                                                <option value="Na-scam ako sa investment/crypto scheme">Na-scam ako sa investment/crypto scheme</option>
                                                                <option value="Nawala ang pera ko sa GCash/Maya scam">Nawala ang pera ko sa GCash/Maya scam</option>
                                                            </optgroup>
                                                            <optgroup label="🟢 Hacking - Low">
                                                                <option value="May kakaibang login attempts sa account ko">May kakaibang login attempts sa account ko</option>
                                                            </optgroup>
                                                            <optgroup label="🟡 Hacking - High">
                                                                <option value="Na-hack ang social media account ko">Na-hack ang social media account ko</option>
                                                            </optgroup>
                                                            <optgroup label="🔴 Hacking - Critical">
                                                                <option value="May nag-access sa account ko nang walang pahintulot">May nag-access sa account ko nang walang pahintulot</option>
                                                                <option value="May virus/malware ang device ko">May virus/malware ang device ko</option>
                                                            </optgroup>
                                                            <optgroup label="🟢 Cyberbullying - Low">
                                                                <option value="Inaapi/minamaliit ako online">Inaapi/minamaliit ako online</option>
                                                            </optgroup>
                                                            <optgroup label="🟡 Cyberbullying - High">
                                                                <option value="May nagbabanta o nang-haharass sa akin online">May nagbabanta o nang-haharass sa akin online</option>
                                                            </optgroup>
                                                            <optgroup label="🔴 Cyberbullying - Critical">
                                                                <option value="Pinapahiya ako o kinakalat ang photos/videos ko">Pinapahiya ako o kinakalat ang photos/videos ko</option>
                                                            </optgroup>
                                                        </select>
                                                        <small class="form-text text-muted"><i class="fas fa-info-circle"></i> Leave blank to let the system automatically choose based on your description.</small>
                                                    </div>

                                                    <!-- Date of Incident -->
                                                    <div class="form-group mb-3  col-lg-6 col-12">
                                                        <label for="incident_date">Date Reported / Petsa ng Insidente<span class="text-danger">*</span></label>
                                                        <input type="datetime-local" class="form-control" id="date" name="date" required>
                                                        <small class="form-text text-muted">Kailan nangyari ang insidente?</small>
                                                    </div>

                                                    <!-- Description -->
                                                    <div class="form-group mb-3  col-lg-12 col-12">
                                                        <label for="description">Description<span class="text-danger">*</span></label>
                                                        <textarea class="form-control" id="description" name="description" rows="6" placeholder="Please provide detailed information about the incident... / Magbigay ng detalyadong impormasyon tungkol sa insidente..." required></textarea>
                                                        <small class="form-text text-muted">
                                                            <strong>Include the following details / Isama ang sumusunod na detalye:</strong>
                                                            <ul class="mb-0 mt-1" style="font-size: 0.875rem;">
                                                                <li><strong>Ano ang nangyari (What happened):</strong> Ilarawan nang detalyado ang insidente</li>
                                                                <li><strong>Kailan (When):</strong> Petsa at oras ng insidente</li>
                                                                <li><strong>Saan (Where):</strong> Tukoy na lokasyon o lugar kung saan ito nangyari</li>
                                                                <li><strong>Sino (Who):</strong> Mga taong sangkot (kung mayroon)</li>
                                                                <li><strong>Paano (How):</strong> Paano nangyari o naganap ang insidente</li>
                                                                <li><strong>Epekto (Impact):</strong> Mga resulta o epekto ng insidente</li>
                                                            </ul>
                                                        </small>
                                                    </div>


                                                    <!-- Category -->
                                                    <!--<div class="form-group mb-3  col-lg-6 col-12">
                                                        <label for="category">Category</label>
                                                        <select class="form-control" id="category" name="category" required>
                                                            <option value="" disabled selected>Select a category</option>
                                                            <?php
                                                            // Check if incident_type table exists first
                                                            /*$table_check = $conn->query("SHOW TABLES LIKE 'incident_type'");
                                                            if ($table_check && $table_check->num_rows > 0) {
                                                                $query = "SELECT * FROM incident_type ";
                                                                $result = $conn->query($query);
                                                                if ($result && $result->num_rows > 0) {
                                                                    while ($row = $result->fetch_assoc()) {
                                                                        echo '<option value="'.$row['name'].'">'.$row['name'].'</option>';
                                                                    }
                                                                } else {
                                                                    echo '<option value="" disabled>No categories found</option>';
                                                                }
                                                            } else {
                                                                // Default categories if table doesn't exist
                                                                echo '<option value="Security Incident">Security Incident</option>';
                                                                echo '<option value="Network Issue">Network Issue</option>';
                                                                echo '<option value="System Malfunction">System Malfunction</option>';
                                                                echo '<option value="Data Breach">Data Breach</option>';
                                                                echo '<option value="Unauthorized Access">Unauthorized Access</option>';
                                                                echo '<option value="Other">Other</option>';
                                                            }*/
                                                            ?>
                                                        </select>
                                                    </div>-->

                                                    
                                                    <!--<div class="form-group mb-3 col-lg-6 col-12">
                                                        <label for="title">Severity Level</label>
                                                        <select class="form-control" id="severity_level" name="severity_level" required>
                                                            <option value="" disabled selected>Select severity level</option>
                                                            <option value="low">Low</option>
                                                            <option value="medium">Medium</option>
                                                            <option value="high">High</option>
                                                            <option value="critical">Critical</option>
                                                        </select>
                                                    </div>-->

                                                    <!-- Reporter Information -->
                                                    <div class="mb-4 col-lg-12">
                                                        <h6 class="fw-bold text-dark mb-3">
                                                            <i class="fas fa-user text-danger me-2"></i>Reporter Information
                                                        </h6>
                                                        <div class="row mb-3">
                                                            <div class="col-12 col-lg-6">
                                                                <label for="fullName" class="form-label">Full Name <span class="text-danger">*</span></label>
                                                                <input type="text" class="form-control" id="fullName" name="full_name" value="<?php echo htmlspecialchars($_SESSION['name'] ?? ''); ?>" placeholder="Enter full name" required readonly style="background-color: #e9ecef;">
                                                            </div>
                                                            <div class="col-12 col-lg-6">
                                                                <label for="address" class="form-label">Address</label>
                                                                <input type="text" class="form-control" id="address" name="address" placeholder="Enter your address">
                                                            </div>
                                                        </div>

                                                        <div class="row mb-3">
                                                            <div class="col-12 col-lg-6">
                                                                <label for="email" class="form-label">Contact Email <span class="text-danger">*</span></label>
                                                                <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($_SESSION['email'] ?? ''); ?>" placeholder="Enter email" required readonly style="background-color: #e9ecef;">
                                                            </div>
                                                            <div class="col-12 col-lg-6">
                                                                <label for="phone" class="form-label">Contact Phone</label>
                                                                <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter contact number">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Actions Taken -->
                                                    <div class="mb-4 col-lg-12">
                                                        <div class="col-12 col-lg-12">
                                                            <h6 class="fw-bold text-dark mb-3">
                                                                <i class="fas fa-clipboard-check text-danger me-2"></i>Actions Taken
                                                            </h6>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <div class="col-12">
                                                                <label for="actions_taken" class="form-label">What actions have been taken so far?</label>
                                                                <textarea class="form-control" id="actions_taken" name="actions_taken" rows="3" placeholder="Describe any immediate actions taken to address this incident (e.g., isolated affected systems, changed passwords, contacted IT support, etc.)"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Attachments -->
                                                    <div class="mb-4 col-lg-12">
                                                        <div class="form-group mb-4">
                                                            <label style="width: 100%;">Attachments</label>
                                                            <p class="text-muted mb-3" style="font-size: 14px;">
                                                                Mag-upload ng mga ebidensya na may kinalaman sa iyong ulat. Maaaring kasama dito ang mga screenshot ng kahina-hinalang mensahe, email, resibo ng transaksyon, error logs, o anumang dokumentong makakatulong sa pag-verify at pagsisiyasat ng insidente.
                                                            </p>

                                                            <!-- Upload Area Outside the Label -->
                                                            <div id="upload-area" style="border: 2px dashed #ccc; padding: 2rem; text-align: center; border-radius: 10px; cursor: pointer;">
                                                                <i class="fas fa-cloud" style="font-size: 30px; margin-bottom: 10px;"></i>
                                                                <p style="margin: 0;">Click to upload or drag and drop</p>
                                                                <small>Screenshots, logs, or other evidence (Max 10MB)</small>
                                                                <div id="file-preview" style="margin-top: 1rem; text-align: left;"></div>
                                                            </div>

                                                            <!-- Real Hidden File Input -->
                                                            <input type="file" name="attachment[]" id="file-upload" accept=".png,.jpg,.jpeg,.pdf,.log,.txt" style="display: none;" multiple>
                                                        </div>
                                                    </div>

                                                    <!-- Additional Information -->
                                                    <div class="mb-4 col-lg-12">
                                                        <div class="col-12 col-lg-12">
                                                            <h6 class="fw-bold text-dark mb-3">
                                                                <i class="fas fa-info-circle text-danger me-2"></i>Additional Information
                                                            </h6>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <div class="col-12">
                                                                <textarea class="form-control" id="additional_info" name="additional_info" rows="3" placeholder="Any additional details that might be relevant to this incident"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Submit Button -->
                                                    <div class="form-group d-flex justify-content-center">
                                                        <button type="submit" name="btn_save" class="btn btn-primary" style="background-color: #2563EB; border: none; padding: 12px 40px;">Submit Incident</button>
                                                    </div>
                                                </form>

                                                <hr>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

            </div>
        </div>
            
            <!-- End of Main Content -->

            <?php include'../footer.php';?>

        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="../../logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="../../vendor/jquery/jquery.min.js"></script>
    <script src="../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../../js/sb-admin-2.min.js"></script>

    
    <!-- Page level plugins -->
    <script src="../../vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../../vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../../js/demo/datatables-demo.js"></script>
    <script>
      $(function () {
        $("#dataTable").DataTable({
          "responsive": true,
          "autoWidth": false,
          "bDestroy": true,
        });
      });
    </script>
    
    <script>
        const fileInput = document.getElementById('file-upload');
        const previewContainer = document.getElementById('file-preview');
        const uploadArea = document.getElementById('upload-area');

        uploadArea.addEventListener('click', () => {
            // Open file picker manually when user clicks the upload area
            fileInput.click();
        });

        fileInput.addEventListener('change', () => {
            previewContainer.innerHTML = ''; // Clear existing preview
            Array.from(fileInput.files).forEach(file => {
                const fileElement = document.createElement('div');
                fileElement.style.marginBottom = '5px';
                fileElement.style.fontSize = '14px';
                fileElement.innerHTML = `<i class="fas fa-paperclip"></i> ${file.name}`;
                previewContainer.appendChild(fileElement);
            });
        });
    </script>
</body>

</html>
<?php
}
else
{
    header('location:../../index.php');
}?>
