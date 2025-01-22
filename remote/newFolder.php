<?php
include_once '../connection/connection.php';
session_start();

if (isset($_POST['createFolder'])) {
    $admin_folder_name = mysqli_real_escape_string($conn, $_POST['admin_folder_name']);
    $admin_folder_owner = $_SESSION['admin_username'];

    // If no shared users are selected, default to an empty array
    $admin_folder_shared = isset($_POST['admin_folder_shared']) ? $_POST['admin_folder_shared'] : [];

    // Convert the array to a JSON string
    $admin_folder_shared_json = json_encode($admin_folder_shared);

    // Check if the folder already exists
    $checkSql = "SELECT COUNT(*) as count FROM admin_folder WHERE admin_folder_name = '$admin_folder_name' AND admin_folder_owner = '$admin_folder_owner'";
    $checkResult = mysqli_query($conn, $checkSql);
    $row = mysqli_fetch_assoc($checkResult);
    $folderCount = $row['count'];

    // If a folder with the same name exists, append a number to the folder name
    if ($folderCount > 0) {
        $i = 1;
        // Loop until we find a unique folder name
        do {
            $newFolderName = $admin_folder_name . " ($i)";
            $checkSql = "SELECT COUNT(*) as count FROM admin_folder WHERE admin_folder_name = '$newFolderName' AND admin_folder_owner = '$admin_folder_owner'";
            $checkResult = mysqli_query($conn, $checkSql);
            $row = mysqli_fetch_assoc($checkResult);
            $folderCount = $row['count'];
            $i++;
        } while ($folderCount > 0);

        // Set the new folder name
        $admin_folder_name = $newFolderName;
    }

    // Insert the folder into the database
    $sql = "INSERT INTO admin_folder (admin_folder_name, admin_folder_owner, admin_folder_shared) 
        VALUES ('$admin_folder_name', '$admin_folder_owner', '$admin_folder_shared_json')";

    // Execute the query and handle success/failure
    if (mysqli_query($conn, $sql)) {
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script> 
                <script type='text/javascript'>
                    document.addEventListener('DOMContentLoaded', function() {
                        Swal.fire({
                            icon: 'success',
                            title: 'New Folder created successfully!',
                            text: 'You have successfully created a new folder.'
                        }).then((result) => {
                            if (result.isConfirmed || result.isDismissed) {
                                window.location = '../pages/myFoldersTable.php';
                            }
                        });
                    });
                </script>";
    } else {
        echo "<script type='text/javascript'>
            alert('Error creating folder: " . mysqli_error($conn) . "');
            window.location = '../pages/homePage.php';
        </script>";
    }
} else {
    echo "<script type='text/javascript'>
        alert('Invalid request.');
        window.location = '../pages/homePage.php';
    </script>";
}
?>