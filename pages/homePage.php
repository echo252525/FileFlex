<?php
/*PHP */
include_once '../controller/navbar.php';
include_once '../connection/connection.php';

/* CSS */
include_once '../css/table.php';
include_once '../css/contextMenu.php';

$loggedInUser = $_SESSION['admin_username'];

// Check if a search query is provided
$searchQuery = isset($_POST['search']) ? mysqli_real_escape_string($conn, $_POST['search']) : '';

// Query to fetch the recent files (limit to 6 for display)
$getRecentFiles = "SELECT * FROM admin_file WHERE admin_file_owner_name = '$loggedInUser' AND admin_file_name LIKE '%$searchQuery%' ORDER BY admin_file_date_uploaded DESC LIMIT 6";
$recentFilesResult = mysqli_query($conn, $getRecentFiles);

// Query to count the total number of files
$getTotalFiles = "SELECT COUNT(*) as total FROM admin_file WHERE admin_file_owner_name = '$loggedInUser' AND admin_file_name LIKE '%$searchQuery%'";
$totalFilesResult = mysqli_query($conn, $getTotalFiles);
$totalFilesRow = mysqli_fetch_assoc($totalFilesResult);
$totalFilesCount = $totalFilesRow['total'];

date_default_timezone_set('Asia/Manila');

$ownedFoldersQuery = "SELECT * FROM admin_folder WHERE admin_folder_owner = '$loggedInUser'";
$ownedFoldersResult = mysqli_query($conn, $ownedFoldersQuery);

// Fetch all folders to check shared folders
$allFoldersQuery = "SELECT * FROM admin_folder";
$allFoldersResult = mysqli_query($conn, $allFoldersQuery);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

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
        margin-bottom: 20px;
        border-bottom: 1px solid gray;
        padding-bottom: 15px;
        padding-left: 10px;
    }

    .welcomeText {
        text-align: center;
    }

    .empty-message {
        text-align: center;
        color: #333;
        font-size: 18px;
        padding: 20px;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .empty-message svg {
        width: 30vh;
        height: auto;
        margin-top: 10px;
        margin-bottom: 50px;
        fill: #A9A9A9;
    }

    .search-bar {
        text-align: center;
        margin-bottom: 20px;
    }

    .search-bar input[type="text"] {
        padding: 10px 10px 10px 20px;
        width: 50%;
        font-size: 16px;
        margin-right: 10px;
        border-radius: 20px;
        border: 1px solid lightgray;
    }

    .search-bar input[type="submit"],
    .search-bar button {
        padding: 12px 15px;
        background-color: #128f8b;
        color: white;
        border-radius: 20px;
        cursor: pointer;
        border: none;
    }

    .search-bar input[type="submit"]:hover,
    .search-bar button:hover {
        background-color: #5F9EA0;
        transform: translateY(-1px);
    }

    .view-more {
        display: flex;
        justify-content: center;
        margin-top: 20px;
    }

    .view-more a {
        padding: 10px 20px;
        background-color: #4CAF50;
        color: white;
        text-decoration: none;
        border-radius: 5px;
    }

    .view-more a:hover {
        background-color: #45a049;
    }

    .tooltip {
        display: none;
        position: absolute;
        background: rgba(0, 0, 0, 0.7);
        color: #fff;
        padding: 5px 10px;
        border-radius: 5px;
        font-size: 14px;
        z-index: 1000;
        pointer-events: none;
    }

    .file-name-input {
        width: 100%;
        padding: 5px;
        font-size: 14px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    #storage-usage {
        text-align: center;
        margin: 20px 0;
    }

    #storageChart {
        width: 100%;
        /* Adjust the width as per the container */
        max-width: 600px;
        /* Maximum width of the chart */
        height: 300px;
        /* Set a fixed height */
        margin: 0 auto;
    }
</style>
<?php
// Get total file size
$totalSize = 0;
$filesQuery = "SELECT * FROM admin_file WHERE admin_file_owner_name = '$loggedInUser'";
$filesResult = mysqli_query($conn, $filesQuery);

while ($file = mysqli_fetch_assoc($filesResult)) {
    $filePath = '../uploads/adminFile/' . $file['admin_file_name'];
    if (file_exists($filePath)) {
        $totalSize += filesize($filePath);
    }
}

// Set total storage limit (e.g., 10GB for demonstration)
$totalStorage = 10 * 1024 * 1024 * 1024; // 10GB in bytes

// Calculate usage percentage
$usagePercentage = ($totalSize / $totalStorage) * 100;

// Convert total size and storage limit to GB
$totalSizeGB = $totalSize / (1024 * 1024 * 1024); // Convert to GB
$totalStorageGB = $totalStorage / (1024 * 1024 * 1024); // Convert to GB
?>

<body>
    <main>
        <div class="container">
            <h1 class="welcomeText">Welcome, <?php echo $loggedInUser ?>!</h1>


            <!-- Storage Usage Chart -->
            <div id="progress-bar-container" style="text-align: center; margin: 20px 0;"> <br>
                <h3>Storage Usage: <?php echo round($totalSizeGB, 2) . 'GB / ' . round($totalStorageGB, 2) . 'GB used'; ?></h3>
                <div id="progress-bar" style="width: 100%; background-color: #f3f3f3; border-radius: 5px; height: 20px;">
                    <div id="progress" style="height: 100%; width: <?php echo $usagePercentage; ?>%; background-color: #4CAF50; border-radius: 5px;"></div>
                </div>
            </div>
        </div>
        <div class="container">
            <h1>Recent Files</h1>
            <!-- Search bar form -->
            <div class="search-bar">
                <form method="POST">
                    <input type="text" name="search" placeholder="Search all files..." value="<?php echo htmlspecialchars($searchQuery); ?>">

                    <input type="submit" value="Search">
                    <!-- Remove button -->
                    <button type="button" onclick="clearSearch()">Clear</button>
                </form>
            </div>

            <?php if (mysqli_num_rows($recentFilesResult) > 0): ?>
                <!-- Display table with files -->
                <table>
                    <thead>
                        <th>File</th>
                        <th>Folder</th>
                        <th>File Size</th>
                        <th>Date Uploaded</th>
                        <th>Time Uploaded</th>
                    </thead>

                    <tbody>
                        <?php while ($aline = mysqli_fetch_array($recentFilesResult)) { ?>
                            <tr class="file-row"
                                data-file-id="<?php echo $aline['file_id']; ?>"
                                data-file-folder="<?php echo $aline['admin_file_folder']; ?>"
                                data-file-name="<?php echo $aline['admin_file_name']; ?>"
                                data-file-description="<?php echo htmlspecialchars($aline['admin_file_description']); ?>"
                                data-file-owner="<?php echo ($aline['admin_file_owner_name']); ?>"
                                data-file-email="<?php echo ($aline['admin_file_owner_email']); ?>"
                                data-file-contact="<?php echo ($aline['admin_file_owner_contact']); ?>"
                                onclick="openInNewTab('../uploads/adminFile/<?php echo $aline['admin_file_name']; ?>')">
                                <td>
                                    <?php
                                    $fileName = $aline["admin_file_name"];
                                    $maxLength = 40;
                                    echo strlen($fileName) > $maxLength ? substr($fileName, 0, $maxLength) . '...' : $fileName;
                                    ?>
                                </td>

                                <td>
                                    <?php if (!empty($aline['admin_file_folder'])): ?>
                                        <div class="folderDiv">
                                            <a href="myFolderFilesTable.php?admin_folder_name=<?php echo $aline['admin_file_folder']; ?>" class="design" onclick="event.stopPropagation();">
                                                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#5f6368">
                                                    <path d="M160-160q-33 0-56.5-23.5T80-240v-480q0-33 23.5-56.5T160-800h240l80 80h320q33 0 56.5 23.5T880-640v400q0 33-23.5 56.5T800-160H160Z" />
                                                </svg>
                                                <?php echo ($aline["admin_file_folder"]); ?>
                                            </a>
                                        </div>
                                    <?php else: ?>
                                        <div class="folderDiv">—</div>
                                    <?php endif; ?>
                                </td>


                                <td>
                                    <?php
                                    $filePath = '../uploads/adminFile/' . $aline["admin_file_name"];
                                    echo file_exists($filePath) ? formatFileSize(filesize($filePath)) : 'File not found';
                                    ?>
                                </td>
                                <td><?php echo date("F j, Y", strtotime($aline["admin_file_date_uploaded"])); ?></td>
                                <td><?php echo date("g:i A", strtotime($aline["admin_file_date_uploaded"])); ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <!-- Display "View More" link if total files exceed 6 -->
                <?php if ($totalFilesCount > 6): ?>
                    <div class="view-more">
                        <a href="myFilesTable.php">View All Files</a>
                    </div>
                <?php endif; ?>
            <?php else: ?>
                <!-- No files or search results -->
                <div class="empty-message">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed">
                        <path d="m840-234-80-80v-326H560v-200H320v86l-80-80v-6q0-33 23.5-56.5T320-920h280l240 240v446Zm-520-46h248L320-528v248ZM820-28 648-200H320q-33 0-56.5-23.5T240-280v-328L28-820l56-56L876-84l-56 56ZM540-577Zm-96 173ZM160-40q-33 0-56.5-23.5T80-120v-520h80v520h480v80H160Z" />
                    </svg>
                    No files available.
                </div>
            <?php endif; ?>

        </div>
    </main>

    <div class="context-menu" id="contextMenu">
        <button id="addToFolderBtn"></button>
        <button id="renameBtn">Rename</button>
        <form action="../remote/deleteFile.php" method="POST">
            <input type="hidden" name="fileId" id="fileIdInputForDelete">
            <input type="submit" value="Delete" name="delete1">
        </form>

        <!-- Add to Folder Form -->
        <div class="add-folder-form" id="addFolderForm">
            <form action="../remote/updateFolder.php" method="POST">
                <p>Choose a Folder:</p>
                <input type="hidden" name="fileId" id="fileIdInputForAddFolder">

                <select name="update_folder" id="folderSelect">
                    <!-- Display owned folders -->
                    <?php while ($aline = mysqli_fetch_array($ownedFoldersResult)) { ?>
                        <option value="<?php echo ($aline["admin_folder_name"]); ?>"><?php echo ($aline["admin_folder_name"]); ?></option>
                    <?php } ?>

                    <!-- Display shared folders -->
                    <?php while ($folder = mysqli_fetch_array($allFoldersResult)) {
                        // Decode the shared folders list
                        $sharedList = json_decode($folder["admin_folder_shared"], true);

                        // Check if the logged-in user is in the shared list
                        if (is_array($sharedList) && in_array($loggedInUser, $sharedList)) { ?>
                            <option value="<?php echo ($folder["admin_folder_name"]); ?>"><?php echo ($folder["admin_folder_name"]); ?> (Shared)</option>
                    <?php }
                    } ?>

                </select>
                <input type="submit" value="Add to Folder" name="updateFolder">
            </form>
        </div>
    </div>

    <script>
        function clearSearch() {
            document.querySelector('input[name="search"]').value = '';
            window.location.href = window.location.href.split('?')[0];
        }

        window.onload = function() {
            if (window.history.replaceState) {
                window.history.replaceState(null, null, window.location.href);
            }
        };

        document.addEventListener('DOMContentLoaded', () => {
            const rows = document.querySelectorAll('.file-row');
            const contextMenu = document.getElementById('contextMenu');
            contextMenu.style.display = 'none';

            const renameBtn = document.getElementById('renameBtn');
            const fileIdInputForAddFolder = document.getElementById('fileIdInputForAddFolder');
            const fileIdInputForDelete = document.getElementById('fileIdInputForDelete');
            const folderSelect = document.getElementById('folderSelect');

            const addToFolderBtn = document.getElementById('addToFolderBtn');
            const addFolderForm = document.getElementById('addFolderForm');
            let selectedFileId;

            // Show context menu on right-click
            rows.forEach(row => {
                row.addEventListener('contextmenu', (event) => {
                    event.preventDefault();
                    selectedFileId = row.getAttribute('data-file-id');
                    const fileId = row.getAttribute('data-file-id');
                    const folder = row.getAttribute('data-file-folder');
                    const fileName = row.getAttribute('data-file-name');
                    fileIdInputForAddFolder.value = fileId;
                    fileIdInputForDelete.value = fileId;
                    renameBtn.setAttribute('data-file-name', fileName);
                    // Exclude the current folder from the select options
                    const options = folderSelect.querySelectorAll('option');
                    options.forEach(option => {
                        if (option.value === folder) {
                            option.style.display = 'none'; // Hide the current folder in the select options
                        } else {
                            option.style.display = 'block'; // Show all other folders
                        }
                    });

                    if (folder === '' || folder === null) {
                        // If no folder, display 'Add to Folder'
                        addToFolderBtn.textContent = 'Add to Folder ↓';
                    } else {
                        // If file is already in a folder, display 'Change Folder'
                        addToFolderBtn.textContent = 'Change Folder ↓';
                    }

                    contextMenu.style.display = 'block';
                    contextMenu.style.left = `${event.pageX}px`;
                    contextMenu.style.top = `${event.pageY}px`;
                });
            });


            renameBtn.addEventListener('click', () => {
                const fileId = selectedFileId;
                const fileRow = document.querySelector(`tr[data-file-id="${fileId}"]`);
                const fileNameCell = fileRow.querySelector('td:nth-child(1)'); // Get the file name cell

                // Create an input field with the current file name as its value
                const oldFileName = renameBtn.getAttribute('data-file-name');;
                const inputField = document.createElement('input');
                inputField.type = 'text';
                inputField.value = oldFileName;
                inputField.classList.add('file-name-input'); // Add class for styling

                // Replace the file name with the input field
                fileNameCell.innerHTML = ''; // Clear the cell
                fileNameCell.appendChild(inputField);

                // Focus on the input field for user editing
                inputField.focus();

                // Add an event listener to save the new file name when the user presses Enter
                inputField.addEventListener('blur', () => {
                    const newFileName = inputField.value.trim();
                    if (newFileName && newFileName !== oldFileName) {
                        updateFileName(fileId, newFileName);
                        location.reload();

                    } else {
                        // Revert to the old file name if no change or cancel
                        fileNameCell.textContent = oldFileName;
                    }
                });

                inputField.addEventListener('keydown', (event) => {
                    if (event.key === 'Enter') {
                        const newFileName = inputField.value.trim();
                        if (newFileName && newFileName !== oldFileName) {
                            updateFileName(fileId, newFileName);
                        } else {
                            fileNameCell.textContent = oldFileName;
                        }
                    }
                });

                // Close the context menu
                contextMenu.style.display = 'none';
            });

            function updateFileName(fileId, newFileName) {
                const xhr = new XMLHttpRequest();
                xhr.open('POST', '../remote/renameFile.php', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onreadystatechange = function() {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        // On success, update the file name in the table
                        const fileRow = document.querySelector(`tr[data-file-id="${fileId}"]`);
                        if (fileRow) {
                            const fileNameCell = fileRow.querySelector('td:nth-child(1)');
                            fileNameCell.textContent = newFileName; // Update the file name in the table
                        }
                    }
                };
                xhr.send(`fileId=${fileId}&newFileName=${newFileName}`);
            }

            // Hide context menu on outside click
            document.addEventListener('click', (event) => {
                if (!contextMenu.contains(event.target)) {
                    contextMenu.style.display = 'none';
                    addFolderForm.style.display = 'none';
                }
            });

            // Prevent context menu from closing when interacting with it
            contextMenu.addEventListener('click', (event) => {
                event.stopPropagation();
            });

            // Show Add to Folder form
            addToFolderBtn.addEventListener('click', () => {
                addFolderForm.style.display = 'block';
            });

            const tooltip = document.createElement('div');
            tooltip.className = 'tooltip';
            document.body.appendChild(tooltip);

            let tooltipTimeout;

            rows.forEach(row => {
                row.addEventListener('mouseenter', (event) => {
                    // Check if the context menu is visible
                    if (contextMenu.style.display === 'none') {
                        tooltipTimeout = setTimeout(() => {
                            const name = row.getAttribute('data-file-name');
                            const description = row.getAttribute('data-file-description');
                            const owner = row.getAttribute('data-file-owner');
                            const email = row.getAttribute('data-file-email');
                            const contact = row.getAttribute('data-file-contact');
                            tooltip.innerHTML = name + "<br>" + "Description: " + description + "<br>" + "Owner: " + owner + "<br>" + "Email: " + email + "<br>" + "Contact: " + contact;
                            tooltip.style.display = 'block';
                        }, 15); // Delay for tooltip
                    }
                });

                row.addEventListener('mousemove', (event) => {
                    // Check if the context menu is visible
                    if (contextMenu.style.display === 'none') {
                        tooltip.style.left = `${event.pageX + 10}px`;
                        tooltip.style.top = `${event.pageY + 10}px`;
                    }
                });

                row.addEventListener('mouseleave', () => {
                    clearTimeout(tooltipTimeout); // Clear tooltip timeout if mouse leaves row
                    tooltip.style.display = 'none';
                });
            });
        });

        window.onload = function() {
            // Update the storage chart
            const progress = document.getElementById('progress');
            const progressText = document.getElementById('progress-text');

            // Update the progress bar width and text
            progress.style.width = `${<?php echo $usagePercentage; ?>}%`;
            progressText.textContent = `Storage Usage: <?php echo round($usagePercentage, 2); ?>%`;

            // Keep the rest of your existing code below...
        };

        document.addEventListener('DOMContentLoaded', applySidebarState);
    </script>
</body>

</html>