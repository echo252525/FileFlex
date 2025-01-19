    <?php
    /*PHP */
    include_once '../controller/navbar.php';
    include_once '../connection/connection.php';

    /* CSS*/
    include_once '../css/table.php';
    include_once '../css/contextMenu.php';

    if (isset($_GET['admin_folder_name'])) {
        $admin_folder_name = mysqli_real_escape_string($conn, $_GET['admin_folder_name']);
        $loggedInUser = $_SESSION['admin_username'];

        // Fetch the admin_folder_shared field from the admin_folder table
        $folderQuery = "SELECT admin_folder_shared FROM admin_folder WHERE admin_folder_name = '$admin_folder_name'";
        $folderResult = mysqli_query($conn, $folderQuery);

        if ($folderResult && mysqli_num_rows($folderResult) > 0) {

            $folderRow = mysqli_fetch_assoc($folderResult);

            // Decode the JSON-encoded shared list
            $sharedList = json_decode($folderRow['admin_folder_shared'], true);

            if (json_last_error() === JSON_ERROR_NONE || (is_array($sharedList) && in_array($loggedInUser, $sharedList))) {

                $get = "SELECT * FROM admin_file WHERE admin_file_folder = '$admin_folder_name'";
                $fetch = mysqli_query($conn, $get);
            } else {
                // User is not authorized
                $fetch = false;
            }
        } else {
            // Folder not found
            $fetch = false;
        }
    }


    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo $admin_folder_name ?> Folders</title>
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
            margin-bottom: 50px;
            border-bottom: 1px solid gray;
            padding-bottom: 15px;
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
            width: 46vh;
            /* Set the size of the SVG */
            height: auto;
            margin-top: 10px;
            margin-bottom: 50px;
            fill: #A9A9A9;
            /* Change the color to match the delete button color */
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
    </style>

    <body>
        <main>

            <div class="container">
                <h1>
                    <?php $previousPage = $_SERVER['HTTP_REFERER'] ?? 'No referrer available';
                   
                    if ($previousPage === 'http://localhost/fileFlex/pages/myFoldersTable.php') {?>
                    <a class="navLink" href="myFoldersTable.php"> 
                        <?php echo $loggedInUser . "'s Folders"; ?>
                    </a> 
                    <?php echo " > " . $admin_folder_name;
                    } else if ($previousPage === 'http://localhost/fileFlex/pages/homePage.php') {?>
                    
                    <a class="navLink" href="homePage.php">
                        Recent Files
                    </a> 
                    <?php echo " > " . $admin_folder_name;
                    } else if ($previousPage === 'http://localhost/fileFlex/pages/myFilesTable.php') {?>
                    <a class="navLink" href="myFilesTable.php">
                        <?php echo $loggedInUser . "'s Files"; ?>
                    </a> 
                    <?php echo " > " . $admin_folder_name; }
                    else {  echo $admin_folder_name; }?>
                </h1>
                <?php if ($fetch && mysqli_num_rows($fetch) > 0): ?>
                    <table>
                        <thead>
                            <th>File</th>
                            <th>Folder</th>
                            <th>File Size</th>
                            <th>Owner</th>
                            <th>Date Uploaded</th>
                        </thead>
                        <tbody>
                            <?php while ($aline = mysqli_fetch_array($fetch)) { ?>
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
                                        $maxLength = 30; // Set the maximum number of characters to display
                                        if (strlen($fileName) > $maxLength) {
                                            echo substr($fileName, 0, $maxLength) . '...'; // Display truncated file name with "..."
                                        } else {
                                            echo $fileName; // Display the full file name if it's within the limit
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <div class="folderDiv">

                                            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#5f6368">
                                                <path d="M160-160q-33 0-56.5-23.5T80-240v-480q0-33 23.5-56.5T160-800h240l80 80h320q33 0 56.5 23.5T880-640v400q0 33-23.5 56.5T800-160H160Z" />
                                            </svg>
                                            <?php echo ($aline["admin_file_folder"]); ?>

                                        </div>
                                    </td>
                                    <td>
                                        <?php
                                        // Get the path of the file
                                        $filePath = '../uploads/adminFile/' . $aline["admin_file_name"];

                                        // Check if the file exists before getting its size
                                        if (file_exists($filePath)) {
                                            // Get the file size
                                            $fileSize = filesize($filePath);
                                            // Convert the file size to a human-readable format
                                            echo formatFileSize($fileSize);
                                        } else {
                                            echo 'File not found';
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        if ($loggedInUser === $aline["admin_file_owner_name"]) {
                                            echo 'me';
                                        } else {
                                            echo $aline["admin_file_owner_name"];
                                        }
                                        ?>
                                    </td>
                                    <td><?php echo date("F j, Y", strtotime($aline["admin_file_date_uploaded"])); ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <div class="empty-message">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed">
                            <path d="m840-234-80-80v-326H560v-200H320v86l-80-80v-6q0-33 23.5-56.5T320-920h280l240 240v446Zm-520-46h248L320-528v248ZM820-28 648-200H320q-33 0-56.5-23.5T240-280v-328L28-820l56-56L876-84l-56 56ZM540-577Zm-96 173ZM160-40q-33 0-56.5-23.5T80-120v-520h80v520h480v80H160Z" />
                        </svg>
                        No files available in this folder.
                    </div>
                <?php endif; ?>
            </div>
        </main>

        <!-- Context Menu -->
        <div class="context-menu" id="contextMenu">
            <button id="renameBtn">Rename</button> <!-- Add Rename Button -->
            <form action="../remote/deleteFile.php" method="POST">
                <input type="hidden" name="fileId" id="fileIdInputForDelete">
                <input type="hidden" name="folderNameInputForDelete" id="folderNameInputForDelete">
                <input type="submit" value="Delete" name="delete2">
            </form>

        </div>

        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const rows = document.querySelectorAll('.file-row');
                const contextMenu = document.getElementById('contextMenu');
                const renameBtn = document.getElementById('renameBtn');
                contextMenu.style.display = 'none';
                const fileIdInputForDelete = document.getElementById('fileIdInputForDelete');
                const folderActive = document.getElementById('FolderActive');
                folderActive.classList.toggle('active');

                // Show context menu on right-click
                rows.forEach(row => {
                    row.addEventListener('contextmenu', (event) => {
                        event.preventDefault();

                        const fileId = row.getAttribute('data-file-id');
                        const folder = row.getAttribute('data-file-folder');
                        const fileName = row.getAttribute('data-file-name');
                        fileIdInputForDelete.value = fileId;
                        folderNameInputForDelete.value = folder;

                        renameBtn.setAttribute('data-file-id', fileId); // Store the fileId for renaming
                        renameBtn.setAttribute('data-file-name', fileName);
                        contextMenu.style.display = 'block';
                        contextMenu.style.left = `${event.pageX}px`;
                        contextMenu.style.top = `${event.pageY}px`;
                    });
                });


                renameBtn.addEventListener('click', () => {
                    const fileId = renameBtn.getAttribute('data-file-id');
                    const fileRow = document.querySelector(`tr[data-file-id="${fileId}"]`);
                    const fileNameCell = fileRow.querySelector('td:nth-child(1)'); // Get the file name cell

                    // Create an input field with the current file name as its value
                    const oldFileName = renameBtn.getAttribute('data-file-name');
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
                    }
                });

                // Prevent context menu from closing when interacting with it
                contextMenu.addEventListener('click', (event) => {
                    event.stopPropagation();
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
                                const file = row.getAttribute('data-file');
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
            
            document.addEventListener('DOMContentLoaded', applySidebarState);

        </script>
    </body>

    </html>