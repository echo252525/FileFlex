<?php
include_once '../connection/connection.php';

if (isset($_POST['updateFolder'])) {
    $fileId = $_POST['fileId'];
    $folderName = $_POST['update_folder'];

    $updateQuery = "UPDATE admin_file SET admin_file_folder = '$folderName' WHERE file_id = '$fileId'";
    if (mysqli_query($conn, $updateQuery)) {
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script> 
                <script type='text/javascript'>
                    document.addEventListener('DOMContentLoaded', function() {
                        Swal.fire({
                            icon: 'success',
                            title: 'File moved successfully!',
                            text: 'You have successfully moved a file into the folder " . $folderName . "'
                        }).then((result) => {
                            if (result.isConfirmed || result.isDismissed) {
                                window.location = '../pages/myFolderFilesTable.php?admin_folder_name=$folderName';
                            }
                        });
                    });
                </script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
