<?php
/*PHP */
include_once '../controller/navbar.php';
include_once '../connection/connection.php';

/* CSS*/
include_once '../css/table.php';
$loggedInUser = $_SESSION['admin_username'];

// Function to get admin statistics (file count, folder count, and shared folder count)
function getAdminStats($conn, $username)
{
    // Query to count files owned by admin
    $fileCountQuery = "SELECT COUNT(*) AS file_count FROM admin_file WHERE admin_file_owner_name = '$username'";
    $fileCountResult = mysqli_query($conn, $fileCountQuery);
    $fileCount = mysqli_fetch_assoc($fileCountResult)['file_count'];

    // Query to count folders owned by admin
    $folderCountQuery = "SELECT COUNT(*) AS folder_count FROM admin_folder WHERE admin_folder_owner = '$username'";
    $folderCountResult = mysqli_query($conn, $folderCountQuery);
    $folderCount = mysqli_fetch_assoc($folderCountResult)['folder_count'];

    // Query to get shared folders data
    $sharedFolderQuery = "SELECT admin_folder_shared FROM admin_folder WHERE admin_folder_shared IS NOT NULL";
    $sharedFolderResult = mysqli_query($conn, $sharedFolderQuery);

    $sharedFolderCount = 0;

    while ($sharedFolder = mysqli_fetch_assoc($sharedFolderResult)) {
        // Decode the JSON string
        $sharedFolderArray = json_decode($sharedFolder['admin_folder_shared'], true); // Use true to get an associative array
        if (is_array($sharedFolderArray)) {
            // Count the number of entries in the array
            foreach ($sharedFolderArray as $sharedUser) {
                if ($sharedUser == $username) {
                    $sharedFolderCount++;
                }
            }
        }
    }

    return [
        'file_count' => $fileCount,
        'folder_count' => $folderCount,
        'shared_folder_count' => $sharedFolderCount
    ];
}

$get = "SELECT * FROM admin_account";
$fetch = mysqli_query($conn, $get);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Accounts</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

        * {
            font-family: Poppins, 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        /* General Styles */
        body {
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: left;
            color: #333;
            margin-bottom: 50px;
            border-bottom: 1px solid gray;
            padding-bottom: 15px;
        }

        .viewButton {
            background-color: #d3d3d3;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            border-radius: 5px;
        }

        .buttonColumn {
            display: flex;
            gap: 5px;
            align-items: center;
        }

        /* Highlight logged-in user row */
        .highlight {
            background-color: #eeeeee;
        }

        .loggedInText {
            color: green;
            font-weight: bold;
            margin-left: 10px;
        }

        /* Modal Styles */
        #modalContainerForAccounts {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #fff;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.2);
            z-index: 1000;
            padding: 20px;
            border-radius: 8px;
            width: 50%;
            max-width: 500px;
        }

        #modalOverlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 999;
        }

        .closeModalButton {
            float: right;
        }

        td a {
            text-decoration: none;
            color: #333;
        }

        .profileDiv {
            display: flex;
            align-items: center;
            justify-content: center;

            a {
                display: flex;
                align-items: center;
                justify-content: center;
            }
        }

        .profileDiv>div:nth-child(1) {
            flex-basis: 200px;
            display: flex;
                align-items: center;
                justify-content: center;
        }

        .imgModal {
            width: 100px;
            height: auto;
            border-radius: 50%;
            margin: 10px 0px;
        }

        .divNgLahat {
            display: flex;
            flex-direction: column;

            .profile {
                display: flex;
                justify-content: center;
                align-items: center;
            }

        }

        .content {
            display: flex;
            border-bottom: 1px solid #d9d9d9;
            padding: 13px 0;

            label {
                flex-basis: 200px;
                color: gray;
                text-align: right;
                margin-right: 10px;
            }
        }

        .numbersDiv {
            display: flex;
            justify-content: space-evenly;
            margin-bottom: 10px;

            div {
                display: flex;
                flex-direction: column;
                padding: 10px;
                align-items: center;
            }

            span {
                font-weight: 700;
                font-size: 30px;
            }
        }

        .divNgContent {
            padding: 10px 30px 20px 30px;
        }

        h3 {
            margin: 40px 0px 20px 0px;

            text-align: center;
        }
    </style>
</head>

<body>
    <main>
        <div class="container">
            <h1>Admin Accounts</h1>
            <table>
                <thead>
                    <th>Profile</th>
                    <th>Username</th>
                    <th>Email</th>
                </thead>
                <tbody>
                    <?php while ($aline = mysqli_fetch_array($fetch)) {
                        $highlightClass = ($aline['admin_username'] === $loggedInUser) ? 'highlight' : '';
                        $loggedInText = ($aline['admin_username'] === $loggedInUser) ? '<span class="loggedInText"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#6ec531"><path d="m424-296 282-282-56-56-226 226-114-114-56 56 170 170Zm56 216q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Z"/></svg></span>' : '';

                        // Get admin statistics (files, folders, shared folders)
                        $stats = getAdminStats($conn, $aline['admin_username']);
                    ?>


                        <tr class="<?php echo $highlightClass; ?>" onclick="openModalForAccounts('<?php echo $aline['admin_name']; ?>', '<?php echo $aline['admin_profile']; ?>', '<?php echo $aline['admin_username']; ?>', '<?php echo $aline['admin_email']; ?>', '<?php echo $aline['admin_contact']; ?>', '<?php echo $aline['admin_created_date']; ?>', '<?php echo $stats['file_count']; ?>', '<?php echo $stats['folder_count']; ?>', '<?php echo $stats['shared_folder_count']; ?>')">

                            <td>
                                <div class="profileDiv">
                                    <div>
                                         <?php
                                        $file_name = $aline['admin_profile'];
                                        $file_path = "../uploads/adminProfile/" . $file_name;
                                        echo "<img src='$file_path' alt='Profile Picture' style='width: 40px; height: auto; object-fit: cover; border-radius: 50%;'>";
                                        ?>
                                        <?php echo ($aline["admin_name"]); ?>
                                    </div>
                                    <div>
                                        <?php echo $loggedInText; ?>
                                    </div>
                                </div>
                            </td>
                            <td><?php echo ($aline["admin_username"]); ?></td>
                            <td><?php echo ($aline["admin_email"]); ?></td>

                        </tr>

                    <?php } ?>
                </tbody>
            </table>
        </div>
    </main>

    <!-- Modal and Overlay -->
    <div id="modalOverlay"></div>
    <div id="modalContainerForAccounts">
        <span class="closeModalButton" onclick="closeModalForAccounts()"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#5f6368">
                <path d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z" />
            </svg></span>
        <div id="modalContent"></div>
    </div>

    <script>
        function openModalForAccounts(name, profilePath, username, email, contact, createdDate, fileCount, folderCount, sharedFolderCount) {
            const modal = document.getElementById("modalContainerForAccounts");
            const overlay = document.getElementById("modalOverlay");
            const modalContent = document.getElementById("modalContent");

            modalContent.innerHTML = `
                <h3>Your profile</h3>
                <div class="divNgLahat">
                    <div class="profile">
                        <img src="../uploads/adminProfile/${profilePath}" alt="Profile Picture" class="imgModal">
                    </div>
                    <div class="divNgContent">
                        <div class="content">
                            <label>Name:</label>
                            <span>${name}</span>
                        </div>
                        <div class="content">
                            <label>Username:</label>
                            <span>${username}</span>
                        </div>
                        <div class="content">
                            <label>Email:</label>
                            <span>${email}</span>
                        </div>
                        <div class="content">
                            <label>Contact:</label>
                            <span>${contact}</span>
                        </div>
                        <div class="content">
                            <label>Date created:</label>
                            <span>${createdDate}</span>
                        </div>
                    </div>
                    
                    <div class="numbersDiv">
                        <div>
                            <span>${fileCount}</span>
                            <label>Files</label>
                        </div>
                        <div>
                            <span>${sharedFolderCount}</span>
                            <label>Shared with me</label>
                        </div>
                        <div>
                            <span>${folderCount}</span>
                            <label>Folders</label>
                        </div>
                    </div>
                </div>
                
                
            `;
            modal.style.display = "block";
            overlay.style.display = "block";
        }

        function closeModalForAccounts() {
            document.getElementById("modalContainerForAccounts").style.display = "none";
            document.getElementById("modalOverlay").style.display = "none";
        }

        document.addEventListener('DOMContentLoaded', applySidebarState);
    </script>
</body>

</html>