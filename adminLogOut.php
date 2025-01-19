<?php
 
include_once 'connection/connection.php';
session_start();
$_SESSION = [];
unset($_SESSION['admin_username']);
session_destroy();
 
echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script> 
        <script type='text/javascript'>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Log Out Successfully!',
                    text: 'You have successfully logged out. See you next time!'
                }).then((result) => {
                    if (result.isConfirmed || result.isDismissed) {
                        window.location = 'index.php';
                    }
                });
            });
        </script>"; 
 
?>