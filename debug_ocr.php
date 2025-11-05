<?php
// Debug OCR issues for ID verification

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $uploadDir = "uploads/";
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $fileName = basename($_FILES["id_image"]["name"]);
    $targetFile = $uploadDir . $fileName;

    if (move_uploaded_file($_FILES["id_image"]["tmp_name"], $targetFile)) {
        $outputFile = $uploadDir . "debug_output_" . uniqid();
        
        // Try different Tesseract paths
        $possiblePaths = [
            "C:\\Program Files\\Tesseract-OCR\\tesseract.exe",
            "C:\\Users\\User\\AppData\\Local\\Programs\\Tesseract-OCR\\tesseract.exe",
            "C:\\Program Files (x86)\\Tesseract-OCR\\tesseract.exe",
            "tesseract"
        ];
        
        $tesseractPath = null;
        foreach ($possiblePaths as $path) {
            if ($path === "tesseract" || file_exists($path)) {
                $tesseractPath = ($path === "tesseract") ? $path : "\"$path\"";
                break;
            }
        }
        
        if ($tesseractPath) {
            $cmd = $tesseractPath . " " . escapeshellarg($targetFile) . " " . escapeshellarg($outputFile) . " -l eng";
            exec($cmd . " 2>&1", $output, $return_var);

            if ($return_var === 0 && file_exists($outputFile . ".txt")) {
                $extractedText = file_get_contents($outputFile . ".txt");
                $cleanText = preg_replace('/\s+/', ' ', $extractedText);
                $cleanTextLower = strtolower(trim($cleanText));
                
                // Check for variations
                $hasSiniloan = (stripos($cleanTextLower, "siniloan") !== false || 
                               stripos($cleanTextLower, "sin1loan") !== false ||
                               stripos($cleanTextLower, "sinilaon") !== false ||
                               stripos($cleanTextLower, "siniioan") !== false ||
                               stripos($cleanTextLower, "similoan") !== false);
                               
                $hasLaguna = (stripos($cleanTextLower, "laguna") !== false ||
                             stripos($cleanTextLower, "1aguna") !== false ||
                             stripos($cleanTextLower, "iaguna") !== false);

                // Check for valid barangays
                $validBarangays = ['acevida', 'bagong pag-asa', 'bagumbarangay', 'buhay', 'gen. luna', 
                                  'halayhayin', 'mendiola', 'kapatalan', 'laguio', 'liyang', 'magsaysay', 
                                  'p. burgos', 'g. redor', 'salubungan', 'wawa', 'j. rizal', 'mayatba', 
                                  'llvac', 'pandenio', 'macatad'];
                
                $foundBarangays = [];
                foreach ($validBarangays as $barangay) {
                    if (stripos($cleanTextLower, $barangay) !== false) {
                        $foundBarangays[] = $barangay;
                    }
                }

                $hasValidBarangay = !empty($foundBarangays);
                $isValidID = ($hasSiniloan && $hasLaguna) || ($hasValidBarangay && $hasLaguna && stripos($cleanTextLower, "siniloan") !== false);

                echo "<h3>OCR Debug Results:</h3>";
                echo "<p><strong>Raw OCR Text:</strong></p>";
                echo "<pre style='background: #f5f5f5; padding: 10px; border: 1px solid #ddd;'>" . htmlspecialchars($extractedText) . "</pre>";
                
                echo "<p><strong>Cleaned Text:</strong></p>";
                echo "<pre style='background: #f5f5f5; padding: 10px; border: 1px solid #ddd;'>" . htmlspecialchars($cleanText) . "</pre>";
                
                echo "<p><strong>Lowercase Text:</strong></p>";
                echo "<pre style='background: #f5f5f5; padding: 10px; border: 1px solid #ddd;'>" . htmlspecialchars($cleanTextLower) . "</pre>";
                
                echo "<p><strong>Detection Results:</strong></p>";
                echo "<ul>";
                echo "<li>Has Siniloan: " . ($hasSiniloan ? "✅ YES" : "❌ NO") . "</li>";
                echo "<li>Has Laguna: " . ($hasLaguna ? "✅ YES" : "❌ NO") . "</li>";
                echo "<li>Valid Barangays Found: " . ($hasValidBarangay ? "✅ " . implode(', ', $foundBarangays) : "❌ NONE") . "</li>";
                echo "<li>Overall Result: " . ($isValidID ? "✅ VALID" : "❌ INVALID") . "</li>";
                echo "</ul>";
                
                // Check individual word matches
                echo "<p><strong>Word Analysis:</strong></p>";
                $words = explode(' ', $cleanTextLower);
                foreach ($words as $word) {
                    $isImportant = (stripos($word, 'siniloan') !== false || 
                                   stripos($word, 'laguna') !== false || 
                                   in_array(trim($word), $validBarangays));
                    if ($isImportant) {
                        echo "<span style='background: yellow; padding: 2px; margin: 1px; display: inline-block;'>" . htmlspecialchars($word) . "</span> ";
                    } else {
                        echo htmlspecialchars($word) . " ";
                    }
                }
                
            } else {
                echo "<p style='color: red;'>OCR failed. Return code: $return_var</p>";
                echo "<p>Command output:</p>";
                echo "<pre>" . implode("\n", $output) . "</pre>";
            }
        } else {
            echo "<p style='color: red;'>Tesseract not found in any of the expected locations.</p>";
        }
    } else {
        echo "<p style='color: red;'>File upload failed.</p>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>OCR Debug Tool</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .upload-form { background: #f9f9f9; padding: 20px; border-radius: 5px; margin-bottom: 20px; }
        .result { margin-top: 20px; }
    </style>
</head>
<body>
    <h1>🔍 OCR Debug Tool for ID Verification</h1>
    
    <div class="upload-form">
        <form method="post" enctype="multipart/form-data">
            <label for="id_image">Upload ID Image:</label><br>
            <input type="file" name="id_image" id="id_image" accept="image/*" required><br><br>
            <button type="submit">Debug OCR</button>
        </form>
    </div>
    
    <p><strong>Instructions:</strong></p>
    <ul>
        <li>Upload an ID image to see exactly what text OCR extracts</li>
        <li>Check if "Siniloan" and "Laguna" are properly detected</li>
        <li>Use this to troubleshoot why valid IDs are being rejected</li>
    </ul>
</body>
</html>