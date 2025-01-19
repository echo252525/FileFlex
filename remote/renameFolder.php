<?php
// renameFolder.php
include_once '../connection/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $folderId = $_POST['folder_Id'];
    $newFolderName = $_POST['newFolderName'];

    if (!empty($folderId) && !empty($newFolderName)) {
        // Step 1: Update the admin_file_folder in the admin_file table
        $updateFileQuery = "UPDATE admin_file SET admin_file_folder = ? WHERE admin_file_folder = (SELECT admin_folder_name FROM admin_folder WHERE folder_id = ?)";
        $stmt = mysqli_prepare($conn, $updateFileQuery);
        mysqli_stmt_bind_param($stmt, 'si', $newFolderName, $folderId);

        if (mysqli_stmt_execute($stmt)) {
            // Step 2: Update the folder name in the admin_folder table
            $updateFolderQuery = "UPDATE admin_folder SET admin_folder_name = ? WHERE folder_id = ?";
            $stmt = mysqli_prepare($conn, $updateFolderQuery);
            mysqli_stmt_bind_param($stmt, 'si', $newFolderName, $folderId);

            if (mysqli_stmt_execute($stmt)) {
                // Redirect to myFoldersTable.php after successful update
                echo "<script>window.location.href = '../pages/myFoldersTable.php';</script>";
            } else {
                echo "Error updating folder name in admin_folder: " . mysqli_error($conn);
            }
        } else {
            echo "Error updating admin_file_folder: " . mysqli_error($conn);
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        echo "Error: folder_Id or newFolderName is missing or empty.";
    }
}
?>
