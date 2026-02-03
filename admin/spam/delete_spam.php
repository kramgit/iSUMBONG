<?php
include('../../connectMySql.php');
include '../../loginverification.php';

if(logged_in() && isset($_POST['spam_id'])){
    $spam_id = mysqli_real_escape_string($conn, $_POST['spam_id']);
    
    // Delete attachments from database and file system
    $attach_query = "SELECT * FROM attachment WHERE incident_id = '$spam_id'";
    $attach_result = mysqli_query($conn, $attach_query);
    
    while($attach = mysqli_fetch_assoc($attach_result)){
        // Delete physical file
        if(file_exists($attach['attachment'])){
            unlink($attach['attachment']);
        }
    }
    
    // Delete attachments from database
    $delete_attach = "DELETE FROM attachment WHERE incident_id = '$spam_id'";
    mysqli_query($conn, $delete_attach);
    
    // Delete comments
    $delete_comments = "DELETE FROM comments WHERE incident_id = '$spam_id'";
    mysqli_query($conn, $delete_comments);
    
    // Delete spam report
    $delete_spam = "DELETE FROM spam WHERE id = '$spam_id'";
    
    if(mysqli_query($conn, $delete_spam)){
        echo "<script src='../../js/sweetalert2.all.min.js'></script>
        <body onload='success()'></body>
        <script> 
        function success(){
            Swal.fire({
                icon: 'success',
                title: 'Deleted',
                text: 'Spam report has been permanently deleted'
            }).then((result) => {
                window.location.href = 'index.php';
            });
        }
        </script>";
    } else {
        echo "<script src='../../js/sweetalert2.all.min.js'></script>
        <body onload='error()'></body>
        <script> 
        function error(){
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Failed to delete report'
            }).then((result) => {
                window.location.href = 'view.php?id=$spam_id';
            });
        }
        </script>";
    }
} else {
    header('location: index.php');
}
?>
