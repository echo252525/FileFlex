<?php
// downloadFile.php

// Ensure the 'admin_file_name' parameter is provided
if (isset($_GET['admin_file_name'])) {
    $fileName = basename($_GET['admin_file_name']); // Sanitize the file name
    $filePath = '../uploads/adminFile/' . $fileName;
    
    // Check if the file exists
    if (file_exists($filePath)) {
        // Set headers to initiate the file download
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . $fileName . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filePath));

        // Clear output buffering
        ob_clean();
        flush();

        // Read the file and send it to the output buffer
        readfile($filePath);
         
        exit;
    } else {
        // File not found
        echo 'The requested file does not exist.';
    }
    
} else {
    // Invalid request
    echo 'No file specified.';
}
?>