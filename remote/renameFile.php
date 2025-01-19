<?php
// renameFile.php
include_once '../connection/connection.php';

if (isset($_POST['fileId']) && isset($_POST['newFileName'])) {
    $fileId = $_POST['fileId'];
    $newFileName = mysqli_real_escape_string($conn, $_POST['newFileName']);

    // Query to get the old admin_file_name
    $getFileQuery = "SELECT admin_file_name FROM admin_file WHERE file_id = '$fileId'";
    $result = mysqli_query($conn, $getFileQuery);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $oldFileName = $row['admin_file_name'];

        $uploadDir = '../uploads/adminFile/'; // Path to the folder containing the files
        $oldFilePath = $uploadDir . $oldFileName;
        $newFilePath = $uploadDir . $newFileName;

        // Check if the old file exists
        if (file_exists($oldFilePath)) {
            // Attempt to rename the file
            if (rename($oldFilePath, $newFilePath)) {
                // Update the database only if the file rename is successful
                $updateQuery = "UPDATE admin_file SET admin_file_name = '$newFileName' WHERE file_id = '$fileId'";
                if (mysqli_query($conn, $updateQuery)) {
                    echo "File name updated successfully in the database and on the server.";
                } else {
                    // Rollback the file rename if the database update fails
                    rename($newFilePath, $oldFilePath);
                    echo "Error updating the database. Changes reverted.";
                }
            } else {
                echo "Error renaming the file on the server.";
            }
        } else {
            echo "Original file not found on the server.";
        }
    } else {
        echo "File not found in the database.";
    }
} else {
    echo "Invalid request.";
}
?>
