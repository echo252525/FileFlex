
<?php
// Include the database connection
include_once '../connection/connection.php';
session_start();

if (isset($_POST['editAcccountName'])) {
    $old_admin_name = $_POST['oldName'];
    $new_admin_name = $_POST['admin_name'];

    // Prepare the SQL statement to update the name
    $stmt = $conn->prepare("UPDATE admin_account SET admin_name = ? WHERE admin_name = ?");
    $stmt->bind_param("ss", $new_admin_name, $old_admin_name); // "ss" means both parameters are strings

    // Execute the query
    if ($stmt->execute()) {
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script> 
            <script type='text/javascript'>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'success',
                        title: 'Name updated successfully!',
                        text: 'You have successfully updated your name.'
                    }).then((result) => {
                        if (result.isConfirmed || result.isDismissed) {
                            window.location = '../pages/accountSettings.php';
                        }
                    });
                });
            </script>";
    } else {
        // In case of an error
        echo "Error updating name: " . $stmt->error;
    }

    $stmt->close();
}




if (isset($_POST['editAcccountUsername'])) {
    $old_admin_username = $_POST['oldUsername'];
    $new_admin_username = $_POST['admin_username'];

    // Prepare the SQL statement to update the username in admin_account table
    $stmt = $conn->prepare("UPDATE admin_account SET admin_username = ? WHERE admin_username = ?");
    $stmt->bind_param("ss", $new_admin_username, $old_admin_username);

    // Execute the query for admin_account
    if ($stmt->execute()) {
        // Update the session variable to reflect the new username
        $_SESSION['admin_username'] = $new_admin_username;

        // Update the admin_file table
        $stmt2 = $conn->prepare("UPDATE admin_file SET admin_file_owner_name = ? WHERE admin_file_owner_name = ?");
        $stmt2->bind_param("ss", $new_admin_username, $old_admin_username);

        if ($stmt2->execute()) {
            // Update the admin_folder table owner column
            $stmt3 = $conn->prepare("UPDATE admin_folder SET admin_folder_owner = ? WHERE admin_folder_owner = ?");
            $stmt3->bind_param("ss", $new_admin_username, $old_admin_username);

            if ($stmt3->execute()) {
                // Fetch and update admin_folder_shared column
                $query = "SELECT folder_id, admin_folder_shared FROM admin_folder";
                $result = $conn->query($query);

                while ($row = $result->fetch_assoc()) {
                    $id = $row['folder_id'];
                    $sharedUsers = json_decode($row['admin_folder_shared'], true);

                    // Check if the old username exists in the shared users array
                    if (is_array($sharedUsers) && in_array($old_admin_username, $sharedUsers)) {
                        // Replace the old username with the new username
                        $sharedUsers = array_map(function ($username) use ($old_admin_username, $new_admin_username) {
                            return $username === $old_admin_username ? $new_admin_username : $username;
                        }, $sharedUsers);

                        // Encode the updated array back to JSON
                        $updatedSharedUsers = json_encode($sharedUsers);

                        // Update the admin_folder_shared column
                        $updateSharedStmt = $conn->prepare("UPDATE admin_folder SET admin_folder_shared = ? WHERE folder_id = ?");
                        $updateSharedStmt->bind_param("si", $updatedSharedUsers, $id);
                        $updateSharedStmt->execute();
                        $updateSharedStmt->close();
                    }
                }

                echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script> 
                    <script type='text/javascript'>
                        document.addEventListener('DOMContentLoaded', function() {
                            Swal.fire({
                                icon: 'success',
                                title: 'Username updated successfully!',
                                text: 'You have successfully updated your username.'
                            }).then((result) => {
                                if (result.isConfirmed || result.isDismissed) {
                                    window.location = '../pages/accountSettings.php';
                                }
                            });
                        });
                    </script>";
            } else {
                echo "Error updating admin_folder owner: " . $stmt3->error;
            }

            $stmt3->close();
        } else {
            echo "Error updating admin_file owner name: " . $stmt2->error;
        }

        $stmt2->close();
    } else {
        echo "Error updating username: " . $stmt->error;
    }

    $stmt->close();
}




if (isset($_POST['editAcccountEmail'])) {
    $old_admin_email = $_POST['oldEmail'];
    $new_admin_email = $_POST['admin_email'];

    // Prepare the SQL statement to update the email in admin_account table
    $stmt = $conn->prepare("UPDATE admin_account SET admin_email = ? WHERE admin_email = ?");
    $stmt->bind_param("ss", $new_admin_email, $old_admin_email); // "ss" means both parameters are strings

    // Execute the query for admin_account
    if ($stmt->execute()) {
        // Now, update the admin_file table where admin_file_email matches the old email
        $stmt2 = $conn->prepare("UPDATE admin_file SET admin_file_owner_email = ? WHERE admin_file_owner_email = ?");
        $stmt2->bind_param("ss", $new_admin_email, $old_admin_email); // "ss" means both parameters are strings

        if ($stmt2->execute()) {
            // Success message
            echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script> 
                <script type='text/javascript'>
                    document.addEventListener('DOMContentLoaded', function() {
                        Swal.fire({
                            icon: 'success',
                            title: 'Email updated successfully!',
                            text: 'You have successfully updated your email.'
                        }).then((result) => {
                            if (result.isConfirmed || result.isDismissed) {
                                window.location = '../pages/accountSettings.php';
                            }
                        });
                    });
                </script>";
        } else {
            // In case of an error with admin_file table
            echo "Error updating admin_file email: " . $stmt2->error;
        }

        $stmt2->close();  // Close the second prepared statement

    } else {
        // In case of an error with admin_account table
        echo "Error updating email: " . $stmt->error;
    }

    $stmt->close();  // Close the first prepared statement
}


if (isset($_POST['editAcccountContact'])) {
    $old_admin_contact = $_POST['oldContact'];
    $new_admin_contact = $_POST['admin_contact'];

    // Prepare the SQL statement to update the email in admin_account table
    $stmt = $conn->prepare("UPDATE admin_account SET admin_contact = ? WHERE admin_contact = ?");
    $stmt->bind_param("ss", $new_admin_contact, $old_admin_contact); // "ss" means both parameters are strings

    // Execute the query for admin_account
    if ($stmt->execute()) {
        // Now, update the admin_file table where admin_file_email matches the old email
        $stmt2 = $conn->prepare("UPDATE admin_file SET admin_file_owner_contact = ? WHERE admin_file_owner_contact = ?");
        $stmt2->bind_param("ss", $new_admin_contact, $old_admin_contact); // "ss" means both parameters are strings

        if ($stmt2->execute()) {
            // Success message
            echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script> 
                <script type='text/javascript'>
                    document.addEventListener('DOMContentLoaded', function() {
                        Swal.fire({
                            icon: 'success',
                            title: 'Contact Number updated successfully!',
                            text: 'You have successfully updated your Contact Number.'
                        }).then((result) => {
                            if (result.isConfirmed || result.isDismissed) {
                                window.location = '../pages/accountSettings.php';
                            }
                        });
                    });
                </script>";
        } else {
            // In case of an error with admin_file table
            echo "Error updating admin_file contact: " . $stmt2->error;
        }

        $stmt2->close();  // Close the second prepared statement

    } else {
        // In case of an error with admin_account table
        echo "Error updating contact: " . $stmt->error;
    }

    $stmt->close();  // Close the first prepared statement
}


if (isset($_POST['editPassword'])) {
    $old_admin_password = $_POST['old_admin_password']; // Old password hashed
    $new_admin_password = $_POST['new_admin_password']; // New password entered by the user
    $confirm_new_admin_password = $_POST['new_admin_confirmPassword']; // Confirmation of the new password

    // Fetch the current password from the database
    $stmt = $conn->prepare("SELECT id FROM admin_account WHERE admin_password = ?");
    $stmt->bind_param("s", $old_admin_password);
    $stmt->execute();
    $stmt->bind_result($id);
    $stmt->fetch();
    $stmt->close();

    // Check if the new password matches the confirmation password
    if ($new_admin_password !== $confirm_new_admin_password) {
        // Success message
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script> 
        <script type='text/javascript'>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Passwords do not match!',
                    text: 'New password and confirmation password do not match.'
                }).then((result) => {
                    if (result.isConfirmed || result.isDismissed) {
                        window.history.back();
                    }
                });
            });
        </script>";
        exit;
    }

    // Hash the new password
    $new_hashed_password = SHA1($new_admin_password);

    // Update the password in the database
    $stmt = $conn->prepare("UPDATE admin_account SET admin_password = ? WHERE id = ?");
    $stmt->bind_param("si", $new_hashed_password, $id);

    if ($stmt->execute()) {
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script> 
                <script type='text/javascript'>
                    document.addEventListener('DOMContentLoaded', function() {
                        Swal.fire({
                            icon: 'success',
                            title: 'Password updated successfully!',
                            text: 'You have successfully updated your password.'
                        }).then((result) => {
                            if (result.isConfirmed || result.isDismissed) {
                                window.location = '../pages/accountSettings.php';
                            }
                        });
                    });
                </script>";
    } else {
        echo "<script type='text/javascript'>
                alert('Error updating password: " . $stmt->error . "');
                window.history.back();
              </script>";
    }

    $stmt->close();
}



if (isset($_POST['editProfile'])) {
    $admin_username = $_POST['admin_username']; // Assuming you pass this from the form

    // Fetch the current profile picture
    $stmt = $conn->prepare("SELECT admin_profile FROM admin_account WHERE admin_username = ?");
    $stmt->bind_param("s", $admin_username);
    $stmt->execute();
    $stmt->bind_result($currentProfile);
    $stmt->fetch();
    $stmt->close();

    // File upload directory
    $uploadDir = "../uploads/adminProfile/";

    // Process the uploaded file
    $originalFileName = basename($_FILES["admin_profile"]["name"]);
    $imageFileType = strtolower(pathinfo($originalFileName, PATHINFO_EXTENSION));

    // Validate image file
    $check = getimagesize($_FILES["admin_profile"]["tmp_name"]);
    if ($check === false) {
        echo "<script type='text/javascript'>
                alert('File is not a valid image.');
                window.location = '../pages/accountSettings.php';
              </script>";
        exit();
    }

    // Validate file size (limit to 2MB)
    if ($_FILES["admin_profile"]["size"] > 2000000) {
        echo "<script type='text/javascript'>
                alert('File is too large. Max size is 2MB.');
                window.location = '../pages/accountSettings.php';
              </script>";
        exit();
    }

    // Validate allowed file formats
    if (!in_array($imageFileType, ["jpg", "jpeg", "png"])) {
        echo "<script type='text/javascript'>
                alert('Only JPG, JPEG, and PNG files are allowed.');
                window.location = '../pages/accountSettings.php';
              </script>";
        exit();
    }

    // Create a unique file name
    $newFileName = pathinfo($originalFileName, PATHINFO_FILENAME) . '_' . uniqid() . '.' . $imageFileType;
    $targetFile = $uploadDir . $newFileName;

    // Attempt to move the uploaded file
    if (move_uploaded_file($_FILES["admin_profile"]["tmp_name"], $targetFile)) {
        // Delete the old profile picture if it exists
        if (!empty($currentProfile) && file_exists($uploadDir . $currentProfile)) {
            unlink($uploadDir . $currentProfile);
        }

        // Update the database with the new profile picture
        $stmt = $conn->prepare("UPDATE admin_account SET admin_profile = ? WHERE admin_username = ?");
        $stmt->bind_param("ss", $newFileName, $admin_username);

        if ($stmt->execute()) {
            echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script> 
                <script type='text/javascript'>
                    document.addEventListener('DOMContentLoaded', function() {
                        Swal.fire({
                            icon: 'success',
                            title: 'Profile Picture updated successfully!',
                            text: 'You have successfully updated your profile picture.'
                        }).then((result) => {
                            if (result.isConfirmed || result.isDismissed) {
                                window.location = '../pages/accountSettings.php';
                            }
                        });
                    });
                </script>";
        } else {
            echo "<script type='text/javascript'>
                    alert('Error updating profile: " . $stmt->error . "');
                    window.location = '../pages/accountSettings.php';
                  </script>";
        }

        $stmt->close();
    } else {
        echo "<script type='text/javascript'>
                alert('Error uploading file.');
                window.location = '../pages/accountSettings.php';
              </script>";
    }
}


if (isset($_POST['deleteAccount'])) {
    // Get and sanitize input
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $admin_username = mysqli_real_escape_string($conn, $_POST['admin_username']);

    // Start database transaction
    $conn->begin_transaction();

    try {
        // Step 1: Delete associated files from the filesystem and admin_file table
        $query = "SELECT admin_file_name FROM admin_file WHERE admin_file_owner_name = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $admin_username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            while ($fileData = $result->fetch_assoc()) {
                $filePath = '../uploads/adminFile/' . $fileData['admin_file_name'];

                // Delete the file from the filesystem
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }
        }
        $stmt->close();

        // Delete file records from admin_file table
        $stmt1 = $conn->prepare("DELETE FROM admin_file WHERE admin_file_owner_name = ?");
        $stmt1->bind_param("s", $admin_username);
        $stmt1->execute();
        $stmt1->close();

        // Step 2: Update admin_folder_shared to remove the username
        $query2 = "SELECT folder_id, admin_folder_shared FROM admin_folder WHERE admin_folder_shared IS NOT NULL AND admin_folder_shared != ''";
        $stmt2 = $conn->prepare($query2);
        $stmt2->execute();
        $result2 = $stmt2->get_result();

        while ($folderData = $result2->fetch_assoc()) {
            $sharedArray = json_decode($folderData['admin_folder_shared'], true);

            // Check if admin_username exists in the array
            if (($key = array_search($admin_username, $sharedArray)) !== false) {
                unset($sharedArray[$key]); // Remove the username
                $sharedArray = array_values($sharedArray); // Re-index the array

                // Update the database with the modified array
                $updatedShared = json_encode($sharedArray);
                $updateStmt = $conn->prepare("UPDATE admin_folder SET admin_folder_shared = ? WHERE folder_id = ?");
                $updateStmt->bind_param("si", $updatedShared, $folderData['folder_id']);
                $updateStmt->execute();
                $updateStmt->close();
            }
        }
        $stmt2->close();

        // Step 3: Delete files from admin_file table where admin_file_folder matches folders being deleted
        $query3 = "SELECT folder_id, admin_folder_name FROM admin_folder WHERE admin_folder_owner = ?";
        $stmt3 = $conn->prepare($query3);
        $stmt3->bind_param("s", $admin_username);
        $stmt3->execute();
        $result3 = $stmt3->get_result();

        $folderNames = [];
        while ($folderData = $result3->fetch_assoc()) {
            $folderNames[] = $folderData['admin_folder_name']; // Collect folder names
        }
        $stmt3->close();

        // Step 3.2: Select and delete files associated with these folder names
        if (!empty($folderNames)) {
            $inClause = implode(',', array_fill(0, count($folderNames), '?'));
            $query4 = "SELECT admin_file_name, admin_file_folder FROM admin_file WHERE admin_file_folder IN ($inClause)";
            $stmt4 = $conn->prepare($query4);

            // Bind folder names to the query
            $stmt4->bind_param(str_repeat('s', count($folderNames)), ...$folderNames);
            $stmt4->execute();
            $result4 = $stmt4->get_result();

            while ($fileData = $result4->fetch_assoc()) {
                $filePath = '../uploads/adminFile/' . $fileData['admin_file_name'];

                if (file_exists($filePath)) {
                    unlink($filePath); // Remove the file from the filesystem
                }
            }
            $stmt4->close();

            // Delete the file records from admin_file table
            $deleteQuery = "DELETE FROM admin_file WHERE admin_file_folder IN ($inClause)";
            $deleteStmt = $conn->prepare($deleteQuery);
            $deleteStmt->bind_param(str_repeat('s', count($folderNames)), ...$folderNames);
            $deleteStmt->execute();
            $deleteStmt->close();
        }

        // Step 3.3: Finally, delete the folders from admin_folder table
        $query5 = "DELETE FROM admin_folder WHERE admin_folder_owner = ?";
        $stmt5 = $conn->prepare($query5);
        $stmt5->bind_param("s", $admin_username);
        $stmt5->execute();
        $stmt5->close();

        // Step 5: Delete from admin_account table
        $stmt6 = $conn->prepare("DELETE FROM admin_account WHERE id = ? AND admin_username = ?");
        $stmt6->bind_param("is", $id, $admin_username);
        $stmt6->execute();
        $stmt6->close();

        // Commit the transaction
        $conn->commit();

        // Destroy the session
        session_destroy();

        // Redirect to a success page or login page
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script> 
            <script type='text/javascript'>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'success',
                        title: 'Account Deleted!',
                        text: 'You have successfully deleted your FileFlex account.'
                    }).then((result) => {
                        if (result.isConfirmed || result.isDismissed) {
                            window.location = '../index.php'; // Adjust the path to your login page
                        }
                    });
                });
            </script>";
    } catch (Exception $e) {
        // Rollback the transaction in case of an error
        $conn->rollback();

        echo "<script type='text/javascript'>
        alert('Error deleting account: " . addslashes($e->getMessage()) . "');
        window.history.back();
      </script>";
    }
}
