<?php

require_once '../connection/connection.php';

session_start();

if (isset($_POST["admin_logIn"])) {

    $admin_username = $_POST["admin_username"];
    $admin_password = sha1($_POST["admin_password"]);

    $query = mysqli_query($conn, "SELECT * FROM admin_account WHERE admin_username = '$admin_username' OR admin_email = '$admin_username'") or die(mysqli_error($conn));
    $row = mysqli_fetch_array($query);

    if ($admin_password === $row['admin_password']) {

        $_SESSION["admin_username"] = $row['admin_username'];

        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script> 
        <script type='text/javascript'>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Log In Successfully!',
                    text: 'Welcome to FileFlex, " . htmlspecialchars($admin_username, ENT_QUOTES, 'UTF-8') . "!'
                }).then((result) => {
                    if (result.isConfirmed || result.isDismissed) {
                        window.location = '../pages/homePage.php'; // Adjust the path to your login page
                    }
                });
            });
        </script>"; 
    } else {
        echo '<script type = "text/javascript">alert("no account data in database"); window.location = "../index.php"; </script>';
    }
}

?>