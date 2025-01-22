<?php
/* PHP */
include_once '../controller/navbar.php';
include_once '../connection/connection.php';

/* CSS */
include_once '../css/table.php';
include_once '../css/contextMenu.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Folders</title>
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
            font-family: Arial, sans-serif;
        }

        h1 {
            text-align: left;
            color: #333;
            margin-bottom: 50px;
            border-bottom: 1px solid gray;
            padding-bottom: 15px;
            padding-left: 10px;
        }

        .folder-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-top: 30px;
            align-items: flex-start;
        }

        .folder-box {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            cursor: pointer;
            transition: transform 0.2s ease-in-out;
            padding: 10px 15px;
        }

        .folder-icon {
            filter: drop-shadow(1.95px 1.95px 2.6px rgba(0, 0, 0, 0.15));
        }

        .folder-box:hover {
            transform: translateY(-2px);
        }

        .folder-name {
            font-size: 14px;
            color: #333;
            text-align: center;
            font-weight: 500;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 60%;
            text-decoration: none;
        }

        .tooltip {
            display: none;
            position: absolute;
            background: rgba(0, 0, 0, 0.7);
            color: #fff;
            padding: 10px;
            border-radius: 5px;
            font-size: 14px;
            z-index: 1000;
            pointer-events: none;
        }

        .tooltip img {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            margin-right: 5px;
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
    </style>
</head>

<body>
    <?php
    $loggedInUser = $_SESSION['admin_username'];
    $getFolders = "SELECT * FROM admin_folder WHERE admin_folder_owner = '$loggedInUser'";
    $folders = mysqli_query($conn, $getFolders);

    $folderData = [];
    while ($folder = mysqli_fetch_assoc($folders)) {
        $sharedWith = json_decode($folder['admin_folder_shared'], true);

        // Fetch profile pictures for shared users
        $profilePictures = [];
        if (!empty($sharedWith)) {
            $sharedWithPlaceholders = "'" . implode("','", $sharedWith) . "'";
            $getProfiles = "SELECT admin_username, admin_profile FROM admin_account WHERE admin_username IN ($sharedWithPlaceholders)";
            $result = mysqli_query($conn, $getProfiles);

            while ($row = mysqli_fetch_assoc($result)) {
                // Construct the full path for the profile image
                $profilePictures[] = [
                    'username' => $row['admin_username'],
                    'profile' => "../uploads/adminProfile/" . $row['admin_profile'], // Adjust the path based on your folder structure
                ];
            }
        }

        // Add data for each folder
        $folderData[] = [
            'id' => $folder['folder_id'],
            'name' => $folder['admin_folder_name'],
            'owner' => $folder['admin_folder_owner'],
            'sharedWithProfiles' => $profilePictures,
        ];
    }
    ?>

    <main>


        <div class="container">
            <h1><?php echo $loggedInUser ?>'s Folders</h1>
            <?php if (!empty($folderData)): ?>
                <div class="folder-grid">
                    <?php foreach ($folderData as $folder): ?>
                        <a href="myFolderFilesTable.php?admin_folder_name=<?php echo $folder['name']; ?>" class="design">
                            <div class="folder-box folder-row"
                                data-folder-id="<?php echo $folder['id']; ?>"
                                data-folder-name="<?php echo $folder['name']; ?>"
                                data-folder-owner="<?php echo $folder['owner']; ?>"
                                data-folder-shared="<?php echo htmlspecialchars(json_encode($folder['sharedWithProfiles']), ENT_QUOTES, 'UTF-8'); ?>">

                                <!-- SVG Folder Icon -->
                                <svg class="folder-icon" height="100px" width="100px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                    viewBox="0 0 501.379 501.379" xml:space="preserve">
                                    <path style="fill:#EF9F2C;" d="M406.423,93.889H205.889c-17.067,0-30.933-13.867-30.933-30.933s-13.867-30.933-30.933-30.933H30.956
                                    c-17.067,0-30.933,13.867-30.933,30.933v375.467c0,17.067,13.867,30.933,30.933,30.933h375.467
                                    c17.067,0,30.933-13.867,30.933-30.933v-313.6C436.289,107.756,422.423,93.889,406.423,93.889z" />
                                    <path style="fill:#FEC656;" d="M470.423,157.889H97.089c-13.867,0-26.667,9.6-29.867,22.4l-66.133,249.6
                                    c-5.333,19.2,9.6,38.4,29.867,38.4h373.333c13.867,0,26.667-9.6,29.867-22.4l66.133-248.533
                                    C505.623,177.089,490.689,157.889,470.423,157.889z" />
                                </svg>

                                <!-- Folder Name -->
                                <div class="folder-name" data-folder-id="<?php echo $folder['id']; ?>"
                                    data-folder-name="<?php echo $folder['name']; ?>">
                                    <?php echo $folder["name"]; ?>
                                </div>
                            </div>
                        </a>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="empty-message">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed">
                        <path d="m871-202-71-71v-367H434l-80-80-80-80h114l80 80h332q33 0 56.5 23.5T880-640v400q0 11-2 20.5t-7 17.5ZM819-28 687-160H160q-33 0-56.5-23.5T80-240v-480q0-33 23.5-56.5T160-800l80 80h-80v480h447L28-820l56-56L876-84l-57 56ZM368-480Zm209-17Z" />
                    </svg>
                    No folders available in your account.
                </div>
            <?php endif; ?>
        </div>
    </main>

    <!-- Context Menu -->
    <div class="context-menu" id="contextMenu">
        <button id="renameBtn">Rename</button>
        <form action="../remote/deleteFolder.php" method="POST">
            <input type="hidden" name="folderId" id="folderIdInputForDelete">
            <input type="hidden" name="folderNameInputForDelete" id="folderNameInputForDelete">
            <input type="submit" value="Delete" name="delete">
        </form>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const contextMenu = document.getElementById('contextMenu');
            contextMenu.style.display = 'none';
            const renameBtn = document.getElementById('renameBtn');
            const rows = document.querySelectorAll('.folder-row');
            const tooltip = document.createElement('div');
            tooltip.className = 'tooltip';
            document.body.appendChild(tooltip);
            let tooltipTimeout;


            const folderIdInputForDelete = document.getElementById('folderIdInputForDelete');
            const folderNameInputForDelete = document.getElementById('folderNameInputForDelete');

            rows.forEach(row => {
                row.addEventListener('contextmenu', (event) => {
                    event.preventDefault();

                    const folderId = row.getAttribute('data-folder-id');
                    const folderName = row.getAttribute('data-folder-name');
                    folderIdInputForDelete.value = folderId;
                    folderNameInputForDelete.value = folderName;

                    renameBtn.setAttribute('data-folder-id', folderId); // Store the fileId for renaming
                    renameBtn.setAttribute('data-folder-name', folderName);
                    contextMenu.style.display = 'block';
                    contextMenu.style.left = `${event.pageX}px`;
                    contextMenu.style.top = `${event.pageY}px`;
                });
            });


            renameBtn.addEventListener('click', () => {
                const folderId = renameBtn.getAttribute('data-folder-id'); // Get the folder ID
                const folderRow = document.querySelector(`div[data-folder-id="${folderId}"]`);
                const folderNameCell = folderRow.querySelector('.folder-name'); // Get the folder name cell

                // Create a form element
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = '../remote/renameFolder.php'; // The URL to the backend script

                // Create an input field with the current folder name as its value
                const oldFolderName = folderNameCell.textContent.trim();
                const inputField = document.createElement('input');
                inputField.type = 'text';
                inputField.name = 'newFolderName'; // The name attribute that will be sent to the backend
                inputField.value = oldFolderName;
                inputField.classList.add('folder-name-input'); // Add class for styling

                // Add a hidden input field for folderId to send with the form
                const folderIdInput = document.createElement('input');
                folderIdInput.type = 'hidden';
                folderIdInput.name = 'folder_Id'; // The name attribute to pass the folder ID
                folderIdInput.value = folderId;

                // Append the input fields to the form
                form.appendChild(inputField);
                form.appendChild(folderIdInput);

                // Replace the folder name with the form and input field
                folderNameCell.innerHTML = ''; // Clear the cell
                folderNameCell.appendChild(form);

                // Focus on the input field for user editing
                inputField.focus();

                // Add event listener to submit the form when the user presses Enter or leaves the field
                form.addEventListener('submit', (event) => {
                    event.preventDefault(); // Prevent the default form submission

                    const newFolderName = inputField.value.trim();
                    if (newFolderName && newFolderName !== oldFolderName) {
                        // Submit the form directly to the backend
                        form.submit(); // Submit the form (normal form submission)
                    } else {
                        folderNameCell.textContent = oldFolderName; // Revert to old name if no change
                    }
                });

                // Handle blur (when the user clicks outside the input)
                inputField.addEventListener('blur', () => {
                    const newFolderName = inputField.value.trim();
                    if (newFolderName && newFolderName !== oldFolderName) {
                        form.submit(); // Submit the form if the folder name is updated
                    } else {
                        folderNameCell.textContent = oldFolderName; // Revert to old folder name
                    }
                });

                // Handle Enter key press to submit the form
                inputField.addEventListener('keydown', (event) => {
                    if (event.key === 'Enter') {
                        const newFolderName = inputField.value.trim();
                        if (newFolderName && newFolderName !== oldFolderName) {
                            form.submit(); // Submit the form if the folder name is updated
                        } else {
                            folderNameCell.textContent = oldFolderName; // Revert to old name
                        }
                    }
                });

                // Close the context menu (optional)
                contextMenu.style.display = 'none';
            });

            function updateFolderName(folderId, newFolderName) {
                const xhr = new XMLHttpRequest();
                xhr.open('POST', '../remote/renameFolder.php', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onreadystatechange = function() {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        // On success, folder name is updated in the database
                        console.log('Folder name updated successfully!');
                    }
                };
                xhr.send(`folderId=${folderId}&newFolderName=${newFolderName}`);
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

            rows.forEach(row => {
                row.addEventListener('mouseenter', (event) => {
                    if (contextMenu.style.display === 'none') {
                        tooltipTimeout = setTimeout(() => {
                            const name = row.getAttribute('data-folder-name');
                            const owner = row.getAttribute('data-folder-owner');
                            const sharedWith = JSON.parse(row.getAttribute('data-folder-shared'));

                            // Construct tooltip content
                            let tooltipContent = `<strong>${name}</strong><br>Owner: ${owner}`;
                            if (sharedWith.length > 0) {
                                tooltipContent += `<br>Shared With:<br><div style="display: flex; flex-wrap: wrap; gap: 10px;">`;
                                sharedWith.forEach(profile => {
                                    tooltipContent += `
                                    <div style="text-align: center; width: 50px;">
                                        <img src="${profile.profile}" alt="${profile.username}" title="${profile.username}" style="width: 40px; height: 40px; border-radius: 50%;">
                                        <div style="font-size: 12px; color: #fff; margin-top: 5px; word-wrap: break-word;">${profile.username}</div>
                                    </div>
                                `;
                                });
                                tooltipContent += `</div>`;
                            }

                            tooltip.innerHTML = tooltipContent;
                            tooltip.style.display = 'block';
                            tooltip.style.left = `${event.pageX + 10}px`;
                            tooltip.style.top = `${event.pageY + 10}px`;
                        }, 200);
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