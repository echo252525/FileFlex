<?php
include_once '../connection/connection.php';

if (isset($_POST['delete'])) {
    $folderId = $_POST['folderId'];
    $folderNameInputForDelete = $_POST['folderNameInputForDelete'];

    // Query to fetch all file paths associated with the specified folder
    $getFilePathsQuery = "SELECT file_id, admin_file_name FROM admin_file WHERE admin_file_folder = '$folderNameInputForDelete'";
    $result = mysqli_query($conn, $getFilePathsQuery);

    $deleteFolderQuery = "DELETE FROM admin_folder WHERE folder_id = '$folderId'";
    $result1 = mysqli_query($conn, $deleteFolderQuery);

    if (mysqli_num_rows($result) > 0) {
        // Loop through each file in the folder
        while ($fileData = mysqli_fetch_assoc($result)) {
            $fileId = $fileData['file_id'];
            $filePath = '../uploads/adminFile/' . $fileData['admin_file_name'];

            // Delete the file record from the database
            $deleteQuery = "DELETE FROM admin_file WHERE file_id = '$fileId' AND admin_file_folder = '$folderNameInputForDelete'";
            if (mysqli_query($conn, $deleteQuery)) {
                // If the file exists on the server, delete it
                if (file_exists($filePath)) {
                    unlink($filePath); // Delete the file from the server
                }
            } else {
                // Error deleting file from the database
                echo "<script>alert('Error deleting file from the database: " . mysqli_error($conn) . "');</script>";
                exit; // Stop further processing if an error occurs
            }
        }

        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script> 
        <script type='text/javascript'>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Folder Deleted Successfully!',
                    text: 'The folder and " . mysqli_num_rows($result) . " files have been successfully deleted.'
                }).then((result) => {
                    if (result.isConfirmed || result.isDismissed) {
                        window.location = '../pages/myFoldersTable.php';
                    }
                });
            });
        </script>"; 
        exit;
    } else {
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script> 
        <script type='text/javascript'>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Folder Deleted Successfully!',
                    text: 'The folder was empty and has been successfully deleted.'
                }).then((result) => {
                    if (result.isConfirmed || result.isDismissed) {
                        window.location = '../pages/myFoldersTable.php';
                    }
                });
            });
        </script>"; 
        exit;
    }
}
?>
