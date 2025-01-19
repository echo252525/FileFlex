<?php
include_once '../connection/connection.php';

// Check if the 'removeFile' button is clicked and 'fileId' is passed via POST
if (isset($_POST['delete1'])) {
    // Get the file ID from the form submission
    $fileId = $_POST['fileId'];

    // Sanitize the fileId to prevent SQL injection (although this is numeric, good practice)
    $fileId = mysqli_real_escape_string($conn, $fileId);

    // Query to fetch the file information based on the provided file ID
    $getFilePathQuery = "SELECT admin_file_name FROM admin_file WHERE file_id = '$fileId'";
    $result = mysqli_query($conn, $getFilePathQuery);

    if (mysqli_num_rows($result) > 0) {
        // Fetch the file data
        $fileData = mysqli_fetch_assoc($result);
        $filePath = '../uploads/adminFile/' . $fileData['admin_file_name'];

        // Proceed with deleting the file from the database
        $deleteQuery = "DELETE FROM admin_file WHERE file_id = '$fileId'";

        if (mysqli_query($conn, $deleteQuery)) {
            // If the file exists on the server, delete it
            if (file_exists($filePath)) {
                unlink($filePath);  // Delete the file from the server
            }
            echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script> 
        <script type='text/javascript'>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'File Deleted Successfully!',
                    text: 'File have been successfully deleted.'
                }).then((result) => {
                    if (result.isConfirmed || result.isDismissed) {
                        window.location = '../pages/myFilesTable.php';
                    }
                });
            });
        </script>";
        } else {
            // Error deleting file from the database
            echo "Error deleting file from the database: " . mysqli_error($conn);
        }
    } else {
        // File not found in the database
        echo "File not found.";
    }
}

if (isset($_POST['delete2'])) {
    // Get the file ID from the form submission
    $fileId = $_POST['fileId'];
    $folderNameInputForDelete = $_POST['folderNameInputForDelete'];
    // Sanitize the fileId to prevent SQL injection (although this is numeric, good practice)
    $fileId = mysqli_real_escape_string($conn, $fileId);

    // Query to fetch the file information based on the provided file ID
    $getFilePathQuery = "SELECT admin_file_name FROM admin_file WHERE file_id = '$fileId'";
    $result = mysqli_query($conn, $getFilePathQuery);

    if (mysqli_num_rows($result) > 0) {
        // Fetch the file data
        $fileData = mysqli_fetch_assoc($result);
        $filePath = '../uploads/adminFile/' . $fileData['admin_file_name'];

        // Proceed with deleting the file from the database
        $deleteQuery = "DELETE FROM admin_file WHERE file_id = '$fileId'";

        if (mysqli_query($conn, $deleteQuery)) {
            // If the file exists on the server, delete it
            if (file_exists($filePath)) {
                unlink($filePath);  // Delete the file from the server
            }
            echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script> 
        <script type='text/javascript'>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'File Deleted Successfully!',
                    text: 'File have been successfully deleted.'
                }).then((result) => {
                    if (result.isConfirmed || result.isDismissed) {
                        window.location = '../pages/myFolderFilesTable.php?admin_folder_name=$folderNameInputForDelete';
                    }
                });
            });
        </script>";
        } else {
            // Error deleting file from the database
            echo "Error deleting file from the database: " . mysqli_error($conn);
        }
    } else {
        // File not found in the database
        echo "File not found.";
    }
}

if (isset($_POST['delete3'])) {
    // Get the file ID from the form submission
    $fileId = $_POST['fileId'];
    $folderNameInputForDelete = $_POST['folderNameInputForDelete'];
    // Sanitize the fileId to prevent SQL injection (although this is numeric, good practice)
    $fileId = mysqli_real_escape_string($conn, $fileId);

    // Query to fetch the file information based on the provided file ID
    $getFilePathQuery = "SELECT admin_file_name FROM admin_file WHERE file_id = '$fileId'";
    $result = mysqli_query($conn, $getFilePathQuery);

    if (mysqli_num_rows($result) > 0) {
        // Fetch the file data
        $fileData = mysqli_fetch_assoc($result);
        $filePath = '../uploads/adminFile/' . $fileData['admin_file_name'];

        // Proceed with deleting the file from the database
        $deleteQuery = "DELETE FROM admin_file WHERE file_id = '$fileId'";

        if (mysqli_query($conn, $deleteQuery)) {
            // If the file exists on the server, delete it
            if (file_exists($filePath)) {
                unlink($filePath);  // Delete the file from the server
            }
            echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script> 
        <script type='text/javascript'>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'File Deleted Successfully!',
                    text: 'File have been successfully deleted.'
                }).then((result) => {
                    if (result.isConfirmed || result.isDismissed) {
                        window.location = '../pages/mySharedFolderFilesTable.php?admin_folder_name=$folderNameInputForDelete';
                    }
                });
            });
        </script>";
        } else {
            // Error deleting file from the database
            echo "Error deleting file from the database: " . mysqli_error($conn);
        }
    } else {
        // File not found in the database
        echo "File not found.";
    }
}
?>