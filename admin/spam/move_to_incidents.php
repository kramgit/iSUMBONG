<?php
include('../../connectMySql.php');
include '../../loginverification.php';

if(logged_in() && isset($_POST['spam_id'])){
    $spam_id = mysqli_real_escape_string($conn, $_POST['spam_id']);
    
    // Move from spam to incident table - explicitly map matching columns only
    $move_query = "INSERT INTO incident (
        title, category, date, description, location, severity_level,
        full_name, address, email, phone, notified,
        evidence_logs, evidence_screenshots, evidence_email, evidence_other,
        additional_info, created_at, status, user_id, suggestion,
        user_deleted, deleted_by_admin
    ) SELECT 
        title, category, date, description, location, severity_level,
        full_name, address, email, phone, notified,
        evidence_logs, evidence_screenshots, evidence_email, evidence_other,
        additional_info, created_at, status, user_id, suggestion,
        0 as user_deleted, 0 as deleted_by_admin
    FROM spam WHERE id = '$spam_id'";
    
    if(mysqli_query($conn, $move_query)){
        // Get the new incident ID
        $new_incident_id = mysqli_insert_id($conn);
        
        // Delete from spam table
        $delete_query = "DELETE FROM spam WHERE id = '$spam_id'";
        mysqli_query($conn, $delete_query);
        
        echo "<script src='../../js/sweetalert2.all.min.js'></script>
        <body onload='success()'></body>
        <script> 
        function success(){
            Swal.fire({
                icon: 'success',
                title: 'Not Spam',
                text: 'Report has been moved back to Incidents',
                timer: 2000,
                showConfirmButton: false
            }).then((result) => {
                window.location.href = '../incident/view.php?id=$new_incident_id';
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
                text: 'Failed to move report'
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
