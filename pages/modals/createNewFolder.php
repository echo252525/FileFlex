<?php
include_once '../../connection/connection.php';
include_once '../../css/modals.php';
session_start();
$loggedInUser = $_SESSION['admin_username'];
$get = "SELECT * FROM admin_account WHERE admin_username != '$loggedInUser'";
$fetch = mysqli_query($conn, $get);
?>

<div id="newFileModalForFolders" class="modal">
    <div class="modal-content">
        <span class="close-btn" onclick="closeModalForFolders()"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#5f6368"><path d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z"/></svg></span>
        <h2>Create New Folder</h2>
        <form action="../remote/newFolder.php" method="POST" enctype="multipart/form-data">
            <div class="divs">
                <label for="admin_folder_name">Folder Name:</label>
                <input type="text" id="admin_folder_name" name="admin_folder_name" placeholder="Enter here the folder name" required>   
            </div>
            
            <div class="divs">
                <label for="admin_folder_shared">Share Folder:</label>
                <select name="admin_folder_shared[]" id="admin_folder_shared" multiple="multiple">
                    <?php while ($aline = mysqli_fetch_array($fetch)) { ?>
                        <option value="<?php echo $aline["admin_username"]; ?>"><?php echo $aline["admin_username"]; ?></option>
                    <?php } ?>
                </select>   
            </div>

            <div class="createFileDiv">
                <input type="submit" value="Create Folder" name="createFolder">
            </div>
        </form>
    </div>
</div>