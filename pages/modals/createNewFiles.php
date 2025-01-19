<?php
include_once '../../connection/connection.php';
include_once '../../css/modals.php';
session_start();
$loggedInUser = $_SESSION['admin_username'];

// Fetch folders owned by the logged-in user
$ownedFoldersQuery = "SELECT * FROM admin_folder WHERE admin_folder_owner = '$loggedInUser'";
$ownedFoldersResult = mysqli_query($conn, $ownedFoldersQuery);

// Fetch all folders to check shared folders
$allFoldersQuery = "SELECT * FROM admin_folder";
$allFoldersResult = mysqli_query($conn, $allFoldersQuery);
?>

<div id="newFileModalForFiles" class="modal">
    <div class="modal-content">
        <span class="close-btn" onclick="closeModalForFiles()">
            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#5f6368">
                <path d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z" />
            </svg>
        </span>

        <h2>Create New File</h2>

        <form action="../remote/newFile.php" method="POST" enctype="multipart/form-data">
            <div class="divs">
                <label for="admin_file_name">Upload the file here:</label>
                <div class="file-upload-container" onclick="triggerFileInput()">
                    <!-- Hidden file input -->
                    <input type="file" id="admin_file_name" name="admin_file_name" style="display: none;" required />
                    <!-- SVG icon -->
                    <div class="upload-icon">
                        
                        <p>Click to Upload</p>
                    </div>
                </div>
            </div>
            <div class="divs">
                <label for="admin_file_folder">Add to Folder:</label>
                <select name="admin_file_folder">
                    <option value="">None</option>

                    <!-- Display owned folders -->
                    <?php while ($aline = mysqli_fetch_array($ownedFoldersResult)) { ?>
                        <option value="<?php echo ($aline["admin_folder_name"]); ?>"><?php echo ($aline["admin_folder_name"]); ?></option>
                    <?php } ?>

                    <!-- Display shared folders -->
                    <?php while ($folder = mysqli_fetch_array($allFoldersResult)) {
                        $sharedList = json_decode($folder["admin_folder_shared"], true);
                        if (is_array($sharedList) && in_array($loggedInUser, $sharedList)) { ?>
                            <option value="<?php echo ($folder["admin_folder_name"]); ?>"><?php echo ($folder["admin_folder_name"]); ?> (Shared)</option>
                    <?php }
                    } ?>
                </select>
            </div>
            <div class="divs">
                <label for="admin_file_description">Description:</label>
                <textarea value="This is my File" id="admin_file_description" name="admin_file_description" rows="3" placeholder="Short description of your file" required></textarea>
            </div>
            <div class="createFileDiv">
                <input type="submit" value="Create File" name="createFile" />
            </div>
        </form>
    </div>
</div>


    