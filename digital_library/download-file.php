<?php
include('../config/conn_db.php');
// Donwload files
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM digitalbook_tb WHERE id=$id";
    $result = mysqli_query($conn, $sql);

    $file = mysqli_fetch_assoc($result);
    $filepath = '../admin_dashboard_library/uploads/' . $file['name'];

    if (file_exists($filepath)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($filepath));
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize('../admin_dashboard_library/uploads/' . $file['name']));
        readfile('../admin_dashboard_library/uploads/' . $file['name']);

        // Now update downloads count
        $newCount = $file['downloads'] + 1;
        $updateQuery = "UPDATE digitalbook_tb SET downloads=$newCount WHERE id=$id";
        mysqli_query($conn, $updateQuery);
        exit;

      
    }

}
?>