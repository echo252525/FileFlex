<?php
include_once '../connection/connection.php';
session_start();

if (isset($_POST['createFile'])) {
    date_default_timezone_set('Asia/Manila');

    if (isset($_FILES['admin_file_name'])) {
        // Check for upload errors
        if ($_FILES['admin_file_name']['error'] == 0) {
            // Form data
            if (!isset($_SESSION['admin_username'])) {
                echo "Session expired or not logged in.";
                exit(); // Stop further processing if session is not valid
            }

            // Fetch the admin_email and admin_contact from the admin_account table
            $admin_username = $_SESSION['admin_username'];
            $query = mysqli_query($conn, "SELECT admin_email, admin_contact FROM admin_account WHERE admin_username = '$admin_username'") or die(mysqli_error($conn));
            $admin_data = mysqli_fetch_assoc($query);

            if ($admin_data) {
                $admin_file_folder = $_POST['admin_file_folder'];
                $admin_file_description = $_POST['admin_file_description'];
                $admin_file_owner_name = $admin_username;  // Ensure this is set
                $admin_file_date_uploaded = date("Y-m-d H:i:s");
                $admin_file_owner_email = $admin_data['admin_email'];  // Retrieved email from the database
                $admin_file_owner_contact = $admin_data['admin_contact'];  // Retrieved contact from the database

                // File handling
                $target_dir = "../uploads/adminFile/";
                $original_file_name = basename($_FILES["admin_file_name"]["name"]);
                $fileType = strtolower(pathinfo($original_file_name, PATHINFO_EXTENSION));

                // Check file size (limit to 10MB or adjust as necessary)
                if ($_FILES["admin_file_name"]["size"] > 100000000000) {
                    die("Sorry, your file is too large.");
                }

                // Check if a file with the same admin_file_name already exists
                $checkSql = "SELECT COUNT(*) as count FROM admin_file WHERE admin_file_name = '$original_file_name'";
                $checkResult = mysqli_query($conn, $checkSql);
                $row = mysqli_fetch_assoc($checkResult);
                $fileCount = $row['count'];

                // If file name already exists, append a number to the admin_file_name
                if ($fileCount > 0) {
                    $i = 1;
                    do {
                        $newFileName = pathinfo($original_file_name, PATHINFO_FILENAME) . " ($i)." . $fileType;
                        $checkSql = "SELECT COUNT(*) as count FROM admin_file WHERE admin_file_name = '$newFileName'";
                        $checkResult = mysqli_query($conn, $checkSql);
                        $row = mysqli_fetch_assoc($checkResult);
                        $fileCount = $row['count'];
                        $i++;
                    } while ($fileCount > 0);

                    $admin_file_name = $newFileName;  // Set the new admin_file_name
                } else {
                    // If file doesn't exist, use the original file name
                    $admin_file_name = $original_file_name;
                }

                // Create the full path for the file
                $target_file = $target_dir . $admin_file_name;

                // Try to upload the file
                if (!move_uploaded_file($_FILES["admin_file_name"]["tmp_name"], $target_file)) {
                    die("Sorry, there was an error uploading your file.");
                }

                // Insert data into the database (only insert the file details, including the new admin_file_name)
                $sql = "INSERT INTO admin_file (admin_file_name, admin_file_folder, admin_file_description, admin_file_owner_name, admin_file_date_uploaded, admin_file_owner_email, admin_file_owner_contact)
                        VALUES ('$admin_file_name', '$admin_file_folder', '$admin_file_description', '$admin_file_owner_name', '$admin_file_date_uploaded', '$admin_file_owner_email', '$admin_file_owner_contact')";

                if (mysqli_query($conn, $sql)) {
                    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script> 
                        <script type='text/javascript'>
                            document.addEventListener('DOMContentLoaded', function() {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'New File added successfully!',
                                    text: 'You have successfully added a new file.'
                                }).then((result) => {
                                    if (result.isConfirmed || result.isDismissed) {
                                        window.location = '../pages/myFilesTable.php';
                                    }
                                });
                            });
                        </script>";
                } else {
                    echo "<script type='text/javascript'>
                            alert('Error: " . mysqli_error($conn) . "');
                            window.location = '../pages/homePage.php';
                          </script>";
                }
            } else {
                echo "Error: No data found for this admin.";
            }
        } else {
            echo "File upload error: " . $_FILES['admin_file_name']['error'];
        }
    } else {
        echo "No file uploaded.";
    }
}
?>