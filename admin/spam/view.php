<?php
include('../../connectMySql.php');
include '../../loginverification.php';
if(logged_in()){

$id = $_GET['id'];
$title = "";
$category = "";
$date = "";
$description = "";
$status = "";
$user_id = "";
$suggestion = "";

$query = "SELECT a.* FROM spam a 
WHERE a.id = '".$id."'";
$result = $conn->query($query);
$incident_data = [];
while ($row = $result->fetch_assoc()) {
$incident_data = $row;
$color = "";
if($row['status']=='PENDING'){
$color = "danger";
}
else if($row['status']=='INVESTIGATING'){
$color = "warning";
}
else if($row['status']=='RESOLVED'){
$color = "success";
}
$title = $row['title'];
$category = $row['category'];
$date = $row['date'];
$description = $row['description'];
$status = $row['status'];
$user_id = $row['user_id'];
$suggestion = $row['suggestion'];
}


if (isset($_POST['btn_save'])) {
    $status = $_POST['status'];

        $sql = "UPDATE spam SET status = '$status' WHERE id = $id";
        $result = mysqli_query($conn, $sql);

        $query = "SELECT * FROM users WHERE user_id = $user_id";
        $result = $conn->query($query);
        while ($row = $result->fetch_assoc()) {
        require_once('../../PHPMailer/PHPMailerAutoload.php');
        
        // Load environment variables securely
        require_once('../../includes/env_loader.php');
        loadEnv('../../.env');
        
        $mail = new PHPMailer;
        $mail->isSMTP();
        //$mail->SMTPDebug = 2;
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587;
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'tls';
        $mail->Username = env('SMTP_USERNAME');
        $mail->Password = env('SMTP_PASSWORD');
        $mail->setFrom(env('SMTP_USERNAME'), 'iSUMBONG System');
        $mail->addReplyTo(env('SMTP_USERNAME'), 'iSUMBONG System');
        $mail->addAddress( $row['email'] , 'Receiver Name');
        $mail->isHTML(true);
        $mail->Subject = 'Update Incident Report';
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
            color: #f57c00;
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
            <h2>⚠️ Incident Report Update</h2>
            </div>
            <div class="content">
            <p><span class="label">Status:</span> '.$status.'</p>
            <p><span class="label">Title:</span> '.$title.'</p>
            <p><span class="label">Category:</span> '.$category.'</p>
            <p><span class="label">Date:</span> '.$date.'</p>
            <p><span class="label">Description:</span><br>'.$description.'</p>
            <p><span class="label">Reported By:</span> '.$_SESSION['name'].'</p>
            </div>
            <div class="footer">
            This is an automated message regarding the incident status update.
            </div>
        </div>
        </body>
        </html>';
        if (!$mail->send()) {
            echo 'Email not valid : ' . $mail->ErrorInfo;
            return;
        } else {
                echo "<script src='js/sweetalert2.all.min.js'></script>
                <body onload='success()'></body>
                <script> 
                function success(){
                Swal.fire({
                    icon: 'success',
                    title: 'Email Sent'
                })
                }</script>";
        }
        }


        echo "<script src='../../js/sweetalert2.all.min.js'></script>
        <body onload='save()'></body>
        <script> 
        function save(){
            Swal.fire(
                'Record Updated!',
                '',
                'success'
            ).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'index.php';
                }
            });
        }
        </script>";

    }


    if (isset($_POST['btn_comment'])) {
    $comment = mysqli_real_escape_string($conn, $_POST['comment']);
    $incident_id = $id; // Replace with the actual related incident ID
    $user_id = $_SESSION['name']; // Replace with the current logged-in user

    $sql = "INSERT INTO comments (incident_id, user_id, comment, date) 
            VALUES ('$incident_id', '$user_id', '$comment', NOW())";

    if (mysqli_query($conn, $sql)) {
       
    } else {
        echo "Error saving comment: " . mysqli_error($conn);
    }
}


$query = "SELECT a.* FROM spam a 
WHERE a.id = '".$id."'";
$result = $conn->query($query);
$incident_data = [];
while ($row = $result->fetch_assoc()) {
$incident_data = $row;
$color = "";
if($row['status']=='PENDING'){
$color = "danger";
}
else if($row['status']=='INVESTIGATING'){
$color = "warning";
}
else if($row['status']=='RESOLVED'){
$color = "success";
}
$title = $row['title'];
$category = $row['category'];
$date = $row['date'];
$description = $row['description'];
$status = $row['status'];
$user_id = $row['user_id'];
$suggestion = $row['suggestion'];
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

    <title>iReport</title>

    <!-- Custom fonts for this template-->
    <link href="../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../../css/sb-admin-2.min.css" rel="stylesheet">
    <link href="../../js/sweetalert2.min.css" rel="stylesheet">
    <script src="../../js/sweetalert2.min.js"></script>
    
    <!-- Gmail-style view -->
    <style>
        body {
            font-family: 'Roboto', 'Segoe UI', Arial, sans-serif;
            background-color: #f5f5f5;
        }
        
        /* Gmail Toolbar */
        .gmail-toolbar {
            background: white;
            padding: 12px 16px;
            border-bottom: 1px solid #e0e0e0;
            display: flex;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
        }
        
        .toolbar-btn {
            background: white;
            border: none;
            padding: 8px 16px;
            border-radius: 4px;
            color: #5f6368;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
            transition: all 0.2s;
        }
        
        .toolbar-btn:hover {
            background: #f8f9fa;
        }
        
        .toolbar-btn i {
            font-size: 16px;
        }
        
        .toolbar-divider {
            width: 1px;
            height: 24px;
            background: #e0e0e0;
            margin: 0 4px;
        }
        
        /* Gmail Message Container */
        .gmail-message {
            background: white;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.12);
            margin: 16px auto;
            max-width: 1200px;
        }
        
        /* Message Header */
        .message-header {
            padding: 20px 24px;
            border-bottom: 1px solid #e0e0e0;
        }
        
        .message-subject {
            font-size: 22px;
            font-weight: 400;
            color: #202124;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        
        .spam-label {
            background: #fef7e0;
            color: #f9ab00;
            border: 1px solid #fdd663;
            padding: 4px 12px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 500;
            text-transform: uppercase;
        }
        
        .status-badge-gmail {
            padding: 4px 12px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: 500;
            text-transform: uppercase;
        }
        
        .status-pending { background: #fef7e0; color: #f9ab00; }
        .status-investigating { background: #e8f0fe; color: #1967d2; }
        .status-resolved { background: #e6f4ea; color: #137333; }
        
        .sender-info {
            display: flex;
            align-items: flex-start;
            gap: 16px;
        }
        
        .sender-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #1a73e8;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            font-weight: 500;
            flex-shrink: 0;
        }
        
        .sender-details {
            flex: 1;
        }
        
        .sender-name {
            font-size: 14px;
            color: #202124;
            font-weight: 500;
            margin-bottom: 4px;
        }
        
        .sender-email {
            font-size: 12px;
            color: #5f6368;
        }
        
        .message-date {
            font-size: 12px;
            color: #5f6368;
            white-space: nowrap;
        }
        
        .message-actions {
            margin-top: 12px;
            display: flex;
            gap: 8px;
        }
        
        .action-icon {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #5f6368;
            cursor: pointer;
            transition: all 0.2s;
        }
        
        .action-icon:hover {
            background: #f1f3f4;
        }
        
        /* Message Body */
        .message-body {
            padding: 24px;
            font-size: 14px;
            line-height: 1.6;
            color: #202124;
        }
        
        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 16px;
            margin: 20px 0;
        }
        
        .info-item {
            font-size: 13px;
            background: white;
            padding: 16px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            border-left: 4px solid #1a73e8;
        }
        
        .info-item:hover {
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.12);
            transform: translateY(-2px);
        }
        
        .info-item:nth-child(1) { border-left-color: #667eea; }
        .info-item:nth-child(2) { border-left-color: #f5576c; }
        .info-item:nth-child(3) { border-left-color: #f9ab00; }
        .info-item:nth-child(4) { border-left-color: #4facfe; }
        .info-item:nth-child(5) { border-left-color: #43e97b; }
        .info-item:nth-child(6) { border-left-color: #fa709a; }
        
        .info-label {
            color: #5f6368;
            font-weight: 500;
            margin-bottom: 4px;
        }
        
        .info-value {
            color: #202124;
        }
        
        .description-section {
            margin: 20px 0;
            padding: 16px;
            background: #f8f9fa;
            border-radius: 8px;
            border-left: 4px solid #1a73e8;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
        }
        
        .description-section:hover {
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.12);
        }
        
        .section-title {
            font-weight: 500;
            color: #202124;
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        /* Attachments */
        .attachments-section {
            margin: 20px 0;
        }
        
        .attachment-card {
            display: flex;
            align-items: center;
            padding: 12px;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            margin-bottom: 8px;
            transition: all 0.2s;
            cursor: pointer;
        }
        
        .attachment-card:hover {
            border-color: #1a73e8;
            background: #f8f9fa;
        }
        
        .attachment-icon {
            width: 40px;
            height: 40px;
            background: #e8f0fe;
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #1a73e8;
            margin-right: 12px;
        }
        
        .attachment-info {
            flex: 1;
        }
        
        .attachment-name {
            font-size: 14px;
            color: #202124;
            font-weight: 500;
        }
        
        .attachment-size {
            font-size: 12px;
            color: #5f6368;
        }
        
        .attachment-actions {
            display: flex;
            gap: 8px;
        }
        
        .attachment-btn {
            padding: 6px 16px;
            border: 1px solid #dadce0;
            border-radius: 4px;
            background: white;
            color: #1a73e8;
            font-size: 13px;
            cursor: pointer;
            transition: all 0.2s;
        }
        
        .attachment-btn:hover {
            background: #f8f9fa;
            border-color: #1a73e8;
        }
        
        /* Comments Section */
        .comments-section {
            background: white;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.12);
            margin: 16px auto;
            max-width: 1200px;
            padding: 24px;
        }
        
        .comment-item {
            padding: 16px;
            background: #f8f9fa;
            border-radius: 8px;
            margin-bottom: 12px;
        }
        
        .comment-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 8px;
        }
        
        .comment-author {
            font-weight: 500;
            color: #202124;
            font-size: 14px;
        }
        
        .comment-date {
            font-size: 12px;
            color: #5f6368;
        }
        
        .comment-text {
            font-size: 14px;
            color: #5f6368;
            line-height: 1.5;
        }
        
        .reply-box {
            display: flex;
            gap: 12px;
            margin-top: 20px;
        }
        
        .reply-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: #1a73e8;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            flex-shrink: 0;
        }
        
        .reply-input-group {
            flex: 1;
        }
        
        .reply-input {
            width: 100%;
            padding: 12px;
            border: 1px solid #dadce0;
            border-radius: 8px;
            font-size: 14px;
            font-family: inherit;
            resize: vertical;
            min-height: 80px;
        }
        
        .reply-input:focus {
            outline: none;
            border-color: #1a73e8;
            box-shadow: 0 1px 6px rgba(26, 115, 232, 0.3);
        }
        
        .reply-actions {
            margin-top: 12px;
            display: flex;
            gap: 8px;
        }
        
        .btn-gmail {
            padding: 8px 24px;
            border-radius: 4px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
            border: none;
        }
        
        .btn-gmail-primary {
            background: #1a73e8;
            color: white;
        }
        
        .btn-gmail-primary:hover {
            background: #1557b0;
            box-shadow: 0 1px 3px rgba(0,0,0,0.2);
        }
        
        .btn-gmail-secondary {
            background: white;
            color: #5f6368;
            border: 1px solid #dadce0;
        }
        
        .btn-gmail-secondary:hover {
            background: #f8f9fa;
        }
        
        /* Status Update Section */
        .status-update-section {
            background: white;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.12);
            margin: 16px auto;
            max-width: 1200px;
            padding: 24px;
        }
        
        .status-select {
            padding: 10px 16px;
            border: 1px solid #dadce0;
            border-radius: 4px;
            font-size: 14px;
            color: #202124;
            background: white;
            cursor: pointer;
        }
        
        .status-select:focus {
            outline: none;
            border-color: #1a73e8;
            box-shadow: 0 1px 6px rgba(26, 115, 232, 0.3);
        }
        
        @media print {
            .no-print { display: none !important; }
            .gmail-message { box-shadow: none; }
        }
        
        @media (max-width: 768px) {
            .gmail-toolbar {
                padding: 8px 12px;
            }
            
            .toolbar-btn {
                padding: 6px 12px;
                font-size: 13px;
            }
            
            .message-subject {
                font-size: 18px;
            }
            
            .info-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
    
    <style>
        /* Document-style report styling */
        @media print {
            .no-print { display: none !important; }
            .card { border: 1px solid #dee2e6 !important; box-shadow: none !important; }
            .container-fluid { padding: 0 !important; }
            .card-body { padding: 15px !important; }
            body { font-size: 12pt; }
            .document-container { max-width: none !important; }
        }
        
        .document-container {
            background: white;
            font-family: 'Times New Roman', serif;
            line-height: 1.6;
            color: #333;
            max-width: 900px;
            margin: 0 auto;
            padding: 30px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }
        
        .document-header {
            text-align: center;
            border-bottom: 3px double #000;
            padding-bottom: 25px;
            margin-bottom: 35px;
        }
        
        .document-title {
            font-family: 'Times New Roman', serif;
            font-size: 2.5rem;
            font-weight: bold;
            letter-spacing: 3px;
            margin-bottom: 10px;
            color: #000;
        }
        
        .document-subtitle {
            font-size: 1.1rem;
            color: #666;
            margin-bottom: 15px;
        }
        
        .report-meta {
            font-size: 0.95rem;
            color: #777;
            margin-top: 15px;
        }
        
        .section-header {
            font-size: 1.3rem;
            font-weight: bold;
            color: #000;
            border-bottom: 2px solid #007bff;
            padding-bottom: 8px;
            margin-top: 30px;
            margin-bottom: 20px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .field-row {
            display: flex;
            margin-bottom: 12px;
            border-bottom: 1px dotted #ddd;
            padding-bottom: 8px;
        }
        
        .field-label {
            font-weight: bold;
            min-width: 180px;
            color: #000;
            font-size: 0.95rem;
        }
        
        .field-value {
            flex: 1;
            padding-left: 15px;
            color: #333;
            font-size: 0.95rem;
        }
        
        .description-box {
            background-color: #f8f9fa;
            border: 1px solid #ddd;
            padding: 15px;
            margin: 15px 0;
            border-radius: 5px;
            font-size: 0.95rem;
            line-height: 1.7;
        }
        
        .status-badge {
            display: inline-block;
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: bold;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .status-pending { background-color: #dc3545; color: white; }
        .status-investigating { background-color: #ffc107; color: #000; }
        .status-resolved { background-color: #28a745; color: white; }
        
        .evidence-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin: 20px 0;
        }
        
        .evidence-item {
            text-align: center;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        
        .evidence-item i {
            font-size: 2rem;
            margin-bottom: 10px;
        }
        
        .evidence-yes { color: #28a745; }
        .evidence-no { color: #6c757d; }
        
        .attachment-list {
            list-style: none;
            padding: 0;
        }
        
        .attachment-item {
            background-color: white;
            border: 1px solid #e0e0e0;
            padding: 10px 15px;
            margin-bottom: 10px;
            border-radius: 8px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: all 0.3s ease;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        }
        
        .attachment-item:hover {
            background-color: #f8f9fa;
            border-color: #007bff;
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(0, 123, 255, 0.2);
        }
        
        .attachment-item .file-info {
            display: flex;
            align-items: center;
            flex: 1;
        }
        
        .attachment-item .file-info i {
            color: #007bff;
            margin-right: 8px;
        }
        
        .attachment-item .file-actions {
            display: flex;
            gap: 8px;
        }
        
        .page-break {
            page-break-before: always;
        }
        
        /* Fixed sidebar styles */
        #wrapper {
            overflow-x: hidden;
        }
        
        #wrapper #content-wrapper {
            background-color: #f8f9fa;
            width: 100%;
            overflow-x: hidden;
        }
        
        #wrapper.toggled #accordionSidebar {
            margin-left: -224px;
        }
        
        #accordionSidebar {
            min-height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            width: 224px;
            z-index: 100;
        }
        
        #content-wrapper {
            margin-left: 224px;
            min-height: 100vh;
        }

        /* Clean up form styling for document view */
        .no-print {
            background-color: #f8f9fa;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 20px;
            margin-top: 30px;
        }
        
        .control-buttons {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1000;
            display: flex;
            gap: 10px;
        }
        
        @media (max-width: 768px) {
            .document-container {
                padding: 15px;
                margin: 10px;
            }
            
            .field-row {
                flex-direction: column;
            }
            
            .field-label {
                min-width: auto;
                margin-bottom: 5px;
            }
            
            .field-value {
                padding-left: 0;
            }
            
            .control-buttons {
                position: relative;
                top: auto;
                right: auto;
                justify-content: center;
                margin-bottom: 20px;
            }
            
            /* Fixed sidebar responsive styles */
            #accordionSidebar {
                margin-left: -224px;
            }
            
            #wrapper.toggled #accordionSidebar {
                margin-left: 0;
            }
            
            #content-wrapper {
                margin-left: 0;
            }
        }
        
        @media (max-width: 576px) {
            .file-actions {
                flex-direction: column;
                gap: 5px;
            }
            
            .file-actions .btn {
                font-size: 0.75rem;
                padding: 0.25rem 0.5rem;
            }
        }
    </style>

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
                <div class="container-fluid" style="background: #f5f5f5; padding: 0;">
                    
                    <!-- Gmail Toolbar -->
                    <div class="gmail-toolbar no-print">
                        <button class="toolbar-btn" onclick="window.location.href='index.php'">
                            <i class="fas fa-arrow-left"></i>
                            <span>Back</span>
                        </button>
                        
                        <div class="toolbar-divider"></div>
                        
                        <button class="toolbar-btn" onclick="markNotSpam()">
                            <i class="fas fa-inbox"></i>
                            <span>Not spam</span>
                        </button>
                        
                        <button class="toolbar-btn" onclick="deleteForever()">
                            <i class="fas fa-trash"></i>
                            <span>Delete</span>
                        </button>
                        
                        <div class="toolbar-divider"></div>
                        
                        <button class="toolbar-btn" onclick="window.print()">
                            <i class="fas fa-print"></i>
                            <span>Print</span>
                        </button>
                        
                        <button class="toolbar-btn" onclick="refreshPage()">
                            <i class="fas fa-sync-alt"></i>
                        </button>
                    </div>

                    <!-- Gmail Message -->
                    <div class="gmail-message">
                        <!-- Message Header -->
                        <div class="message-header">
                            <div class="message-subject">
                                <span class="spam-label"><i class="fas fa-exclamation-triangle"></i> SPAM</span>
                                <?= htmlspecialchars($incident_data['title'] ?? 'No Subject') ?>
                                <span class="status-badge-gmail status-<?= strtolower($status) ?>"><?= $status ?></span>
                            </div>
                            
                            <div class="sender-info">
                                <div class="sender-avatar">
                                    <?= strtoupper(substr($incident_data['full_name'] ?? 'U', 0, 1)) ?>
                                </div>
                                
                                <div class="sender-details" style="flex: 1;">
                                    <div style="display: flex; justify-content: space-between; align-items: start;">
                                        <div>
                                            <div class="sender-name"><?= htmlspecialchars($incident_data['full_name'] ?? 'Unknown') ?></div>
                                            <div class="sender-email">
                                                &lt;<?= htmlspecialchars($incident_data['email'] ?? 'no-email@example.com') ?>&gt;
                                            </div>
                                        </div>
                                        <div class="message-date">
                                            <?= date('M j, Y, g:i A', strtotime($incident_data['date'])) ?>
                                        </div>
                                    </div>
                                    
                                    <div class="message-actions">
                                        <div class="action-icon" title="Reply" onclick="focusReply()">
                                            <i class="fas fa-reply"></i>
                                        </div>
                                        <div class="action-icon" title="Star">
                                            <i class="far fa-star"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Message Body -->
                        <div class="message-body">
                            <!-- Report Information Grid -->
                            <div class="info-grid">
                                <div class="info-item">
                                    <div class="info-label">Report ID</div>
                                    <div class="info-value">#<?= str_pad($id, 6, '0', STR_PAD_LEFT) ?></div>
                                </div>
                                <div class="info-item">
                                    <div class="info-label">Category</div>
                                    <div class="info-value"><?= htmlspecialchars($incident_data['category'] ?? 'N/A') ?></div>
                                </div>
                                <div class="info-item">
                                    <div class="info-label">Severity Level</div>
                                    <div class="info-value"><?= htmlspecialchars($incident_data['severity_level'] ?? 'N/A') ?></div>
                                </div>
                                <div class="info-item">
                                    <div class="info-label">Date Created</div>
                                    <div class="info-value"><?= date('M j, Y, g:i A', strtotime($incident_data['created_at'])) ?></div>
                                </div>
                                <?php if (!empty($incident_data['location'])): ?>
                                <div class="info-item">
                                    <div class="info-label">Location</div>
                                    <div class="info-value"><?= htmlspecialchars($incident_data['location']) ?></div>
                                </div>
                                <?php endif; ?>
                                <?php if (!empty($incident_data['phone'])): ?>
                                <div class="info-item">
                                    <div class="info-label">Phone</div>
                                    <div class="info-value"><?= htmlspecialchars($incident_data['phone']) ?></div>
                                </div>
                                <?php endif; ?>
                            </div>
                            
                            <!-- Description -->
                            <div class="description-section">
                                <div class="section-title">
                                    <i class="fas fa-align-left"></i>
                                    Incident Description
                                </div>
                                <div><?= nl2br(htmlspecialchars($incident_data['description'] ?? '')) ?></div>
                            </div>
                            
                            <?php if (!empty($incident_data['additional_info'])): ?>
                            <div class="description-section">
                                <div class="section-title">
                                    <i class="fas fa-info-circle"></i>
                                    Additional Information
                                </div>
                                <div><?= nl2br(htmlspecialchars($incident_data['additional_info'])) ?></div>
                            </div>
                            <?php endif; ?>
                            
                            <!-- Attachments -->
                            <!-- File Attachments -->
                        <?php
                        $query = "SELECT * FROM attachment WHERE incident_id = '".$id."'";
                        $result = $conn->query($query);
                        if ($result->num_rows > 0):
                        ?>
                        <div class="section-header">
                            <i class="fas fa-paperclip me-2"></i>Attached Files
                        </div>
                        <ul class="attachment-list">
                            <?php
                            while ($row = $result->fetch_assoc()) {
                                $file_extension = pathinfo($row['filename'], PATHINFO_EXTENSION);
                                $is_image = in_array(strtolower($file_extension), ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp']);
                                
                                echo '<li class="attachment-item">
                                        <div class="attachment-info">
                                            <i class="fas fa-file me-2"></i>
                                            <span class="attachment-name">'.htmlspecialchars($row['filename']).'</span>
                                        </div>
                                        <div class="attachment-actions no-print">
                                            <button class="btn btn-sm btn-outline-primary me-2" onclick="viewAttachment(\''.htmlspecialchars($row['attachment']).'\', \''.htmlspecialchars($row['filename']).'\', '.($is_image ? 'true' : 'false').')">
                                                <i class="fas fa-eye"></i> View
                                            </button>
                                            <a href="'.htmlspecialchars($row['attachment']).'" download="'.htmlspecialchars($row['filename']).'" class="btn btn-sm btn-outline-success">
                                                <i class="fas fa-download"></i> Download
                                            </a>
                                        </div>
                                    </li>';
                            }
                            ?>
                        </ul>
                        <?php endif; ?>
                        </div>
                    </div>

                </div>
                <!-- End Page Content -->
            
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

    <!-- Evidence Modal -->
    <div class="modal fade" id="evidenceModal" tabindex="-1" role="dialog" aria-labelledby="evidenceModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="evidenceModalLabel">Evidence Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="evidenceModalBody">
                    <!-- Evidence content will be loaded here -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Attachment Modal -->
    <div class="modal fade" id="attachmentModal" tabindex="-1" role="dialog" aria-labelledby="attachmentModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="attachmentModalLabel">File Viewer</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="attachmentModalBody">
                    <!-- Attachment content will be loaded here -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <a id="downloadLink" href="#" class="btn btn-primary" download>
                        <i class="fas fa-download"></i> Download
                    </a>
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

    <script>
    // Gmail-style functions
    function focusReply() {
        document.getElementById('commentInput').focus();
        document.getElementById('commentInput').scrollIntoView({ behavior: 'smooth', block: 'center' });
    }
    
    function refreshPage() {
        location.reload();
    }
    
    function markNotSpam() {
        Swal.fire({
            title: 'Mark as Not Spam?',
            text: 'This will move the report back to Incidents.',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#1a73e8',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Yes, not spam',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                // Create form and submit
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = 'move_to_incidents.php';
                
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'spam_id';
                input.value = '<?= $id ?>';
                
                form.appendChild(input);
                document.body.appendChild(form);
                form.submit();
            }
        });
    }
    
    function deleteForever() {
        Swal.fire({
            title: 'Delete Forever?',
            text: 'This spam report will be permanently deleted. This cannot be undone.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Yes, delete forever',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                // Create form and submit
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = 'delete_spam.php';
                
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'spam_id';
                input.value = '<?= $id ?>';
                
                form.appendChild(input);
                document.body.appendChild(form);
                form.submit();
            }
        });
    }
    
    function viewEvidenceDetails(type) {
        let content = '';
        let title = '';
        
        <?php
        // Pass PHP data to JavaScript
        echo "let evidenceLogs = " . json_encode($incident_data['evidence_logs_details'] ?? '') . ";\n";
        echo "let evidenceScreenshots = " . json_encode($incident_data['evidence_screenshots_details'] ?? '') . ";\n";
        echo "let evidenceEmail = " . json_encode($incident_data['evidence_email_details'] ?? '') . ";\n";
        echo "let evidenceOther = " . json_encode($incident_data['evidence_other_details'] ?? '') . ";\n";
        ?>
        
        switch(type) {
            case 'logs':
                content = evidenceLogs;
                title = 'System Logs Evidence';
                break;
            case 'screenshots':
                content = evidenceScreenshots;
                title = 'Screenshots Evidence';
                break;
            case 'email':
                content = evidenceEmail;
                title = 'Email Evidence';
                break;
            case 'other':
                content = evidenceOther;
                title = 'Other Evidence';
                break;
        }
        
        document.getElementById('evidenceModalLabel').innerText = title;
        
        let modalBody = document.getElementById('evidenceModalBody');
        
        if (content && content.trim() !== '') {
            if (type === 'logs') {
                modalBody.innerHTML = '<pre style="white-space: pre-wrap; word-wrap: break-word; max-height: 400px; overflow-y: auto; background-color: #f8f9fa; padding: 15px; border-radius: 5px;">' + content + '</pre>';
            } else {
                modalBody.innerHTML = '<div style="max-height: 400px; overflow-y: auto; padding: 15px;">' + content.replace(/\n/g, '<br>') + '</div>';
            }
        } else {
            modalBody.innerHTML = '<div class="text-center text-muted"><i class="fas fa-info-circle"></i> No ' + type + ' evidence details available for this report.</div>';
        }
        
        $('#evidenceModal').modal('show');
    }

    function viewAttachment(filePath, fileName, isImage) {
        document.getElementById('attachmentModalLabel').innerText = 'File: ' + fileName;
        
        let modalBody = document.getElementById('attachmentModalBody');
        let downloadLink = document.getElementById('downloadLink');
        
        // Set download link
        downloadLink.href = filePath;
        downloadLink.download = fileName;
        
        if (isImage) {
            // Display image
            modalBody.innerHTML = '<div class="text-center"><img src="' + filePath + '" class="img-fluid" alt="' + fileName + '" style="max-height: 70vh;"></div>';
        } else {
            // Show file info for non-image files
            modalBody.innerHTML = '<div class="text-center"><div class="mb-3"><i class="fas fa-file fa-4x text-muted"></i></div><h5>' + fileName + '</h5><p class="text-muted">This file type cannot be previewed in the browser. Click the download button below to download and view the file.</p></div>';
        }
        
        $('#attachmentModal').modal('show');
    }
    </script>
    
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
</body>

</html>
<?php
}
else
{
    header('location:../../index.php');
}