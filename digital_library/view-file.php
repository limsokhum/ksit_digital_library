<?php
include('../config/conn_db.php');
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // fetch file to view from database
    $sql = "SELECT * FROM digitalbook_tb WHERE id=$id";
    $result = mysqli_query($conn, $sql);
    
    $file = mysqli_fetch_assoc($result);
    $filepath = '../admin_dashboard_library/uploads/' . $file['name'];
    
    if (file_exists($filepath)) {
    header('Content-Type: application/pdf');

    readfile('../admin_dashboard_library/uploads/' . $file['name']);
    
    // Now update downloads count
    $viewCount = $file['view'] + 1;
    $viewQuery = "UPDATE digitalbook_tb SET view=$viewCount WHERE id=$id";
    mysqli_query($conn, $viewQuery);
    exit;
    
    
    }
    
    }
?>