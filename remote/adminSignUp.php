<?php
include_once '../connection/connection.php';

if (isset($_POST['admin_signUp'])) {
    $admin_name = $_POST['admin_name'];
    $admin_username = $_POST['admin_username'];
    $admin_email = $_POST['admin_email'];
    $admin_contact = $_POST['admin_contact'];
    $admin_password = $_POST['admin_password'];
    $admin_confirmPassword = $_POST['admin_confirmPassword'];
    $admin_created_date = date("Y-m-d");

    $inserted_password = sha1($_POST['admin_password']);

    $target_dir = "../uploads/adminProfile/";
    $original_file_name = basename($_FILES["admin_profile"]["name"]);
    $imageFileType = strtolower(pathinfo($original_file_name, PATHINFO_EXTENSION));

    // Check if image file is a valid image
    $check = getimagesize($_FILES["admin_profile"]["tmp_name"]);
    if ($check === false) {
        die("File is not an image.");
    }

    // Check file size (limit to 2MB)
    if ($_FILES["admin_profile"]["size"] > 2000000) {
        die("Sorry, your file is too large.");
    }

    // Allow certain file formats
    if (!in_array($imageFileType, ["jpg", "jpeg", "png"])) {
        die("Sorry, only JPG, JPEG, & PNG files are allowed.");
    }

    // Create a unique file name
    $new_filename = pathinfo($original_file_name, PATHINFO_FILENAME) . '_' . uniqid() . '.' . $imageFileType;
    $target_file = $target_dir . $new_filename;
    // Try to upload file
    if (!move_uploaded_file($_FILES["admin_profile"]["tmp_name"], $target_file)) {
        die("Sorry, there was an error uploading your file.");
    }

    if ($admin_password === $admin_confirmPassword) {
        $sql = "INSERT INTO admin_account (admin_name, admin_username, admin_email, admin_contact, admin_password, admin_profile, admin_created_date) 
                VALUES ('$admin_name', '$admin_username', '$admin_email', '$admin_contact', '$inserted_password', '$new_filename', '$admin_created_date')";

        if (mysqli_query($conn, $sql)) {
            echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script> 
        <script type='text/javascript'>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Account created successfully!',
                    text: 'Your account has been created. Please log in to continue.'
                }).then((result) => {
                    if (result.isConfirmed || result.isDismissed) {
                        window.location = '../index.php'; // Adjust the path to your login page
                    }
                });
            });
        </script>";
        } else {
            echo "<script type='text/javascript'>
                    alert('Error: " . mysqli_error($conn) . "');
                    window.location = '../index.php';
                  </script>";
        }
    } else {
        echo "<script type='text/javascript'>
                alert('Passwords do not match.');
                window.location = '../index.php';
              </script>";
    }
}
?>