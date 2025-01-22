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
    <title>Shared Folders</title>
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
        /* Folder grid container */
        .folder-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-top: 30px;
            align-items: flex-start;
        }

        /* Folder box styling */
        .folder-box {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            cursor: pointer;
            transition: transform 0.2s ease-in-out;
            padding: 10px 15px;
        }

        /* Hover effect for folder */
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

        /* Empty message styling */
        .empty-message {
            text-align: center;
            color: #333;
            font-size: 18px;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        /* SVG icon styling for empty state */
        .empty-message svg {
            width: 46vh;
            height: auto;
            margin-top: 10px;
            margin-bottom: 50px;
            fill: #A9A9A9;
        }

        /* Tooltip Styling */
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
    </style>
</head>

<body>
    <?php
    $loggedInUser = $_SESSION['admin_username'];

    // Query to get all rows
    $get = "SELECT * FROM admin_folder";
    $fetch = mysqli_query($conn, $get);

    // Initialize an array to store folders shared with the logged-in user
    $sharedFolders = [];
    $profilePictures = [];

    // Fetch the profile picture paths
    $profileQuery = "SELECT admin_username, admin_profile FROM admin_account";  // Adjust your query as needed
    $profileResult = mysqli_query($conn, $profileQuery);
    while ($profileRow = mysqli_fetch_assoc($profileResult)) {
        $profilePictures[$profileRow['admin_username']] = "../uploads/adminProfile/" . $profileRow['admin_profile'];
    }

    while ($row = mysqli_fetch_assoc($fetch)) {
        // Decode the JSON string into a PHP array
        $sharedUsers = json_decode($row['admin_folder_shared'], true);

        // Check if the logged-in user exists in the shared users list
        if (is_array($sharedUsers) && in_array($loggedInUser, $sharedUsers)) {
            $sharedFolders[] = $row;
        }
    }
    ?>

    <main>
    

        <div class="container">
        <h1>Shared with me</h1>
            <?php if (!empty($sharedFolders)): ?>
                <div class="folder-grid">
                    <?php foreach ($sharedFolders as $folder): ?>
                        <a href="mySharedFolderFilesTable.php?admin_folder_name=<?php echo htmlspecialchars($folder['admin_folder_name']); ?>" class="folder-box folder-row"
                            data-folder-id="<?php echo $folder['folder_id']; ?>"
                            data-folder-name="<?php echo htmlspecialchars($folder['admin_folder_name']); ?>"
                            data-folder-owner="<?php echo $folder['admin_folder_owner']; ?>"
                            data-folder-shared="<?php echo htmlspecialchars($folder['admin_folder_shared']); ?>">

                            <!-- SVG Folder Icon -->
                            <svg class="folder-icon" height="100px" width="100px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
                                    viewBox="0 0 501.379 501.379" xml:space="preserve">
                                <path style="fill:#EF9F2C;" d="M406.423,93.889H205.889c-17.067,0-30.933-13.867-30.933-30.933s-13.867-30.933-30.933-30.933H30.956
                                    c-17.067,0-30.933,13.867-30.933,30.933v375.467c0,17.067,13.867,30.933,30.933,30.933h375.467
                                    c17.067,0,30.933-13.867,30.933-30.933v-313.6C436.289,107.756,422.423,93.889,406.423,93.889z"/>
                                <path style="fill:#FEC656;" d="M470.423,157.889H97.089c-13.867,0-26.667,9.6-29.867,22.4l-66.133,249.6
                                    c-5.333,19.2,9.6,38.4,29.867,38.4h373.333c13.867,0,26.667-9.6,29.867-22.4l66.133-248.533
                                    C505.623,177.089,490.689,157.889,470.423,157.889z"/>
                            </svg>

                            <!-- Folder Name -->
                            <div class="folder-name">
                                <?php echo htmlspecialchars($folder['admin_folder_name']); ?>
                            </div>
                        </a>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="empty-message">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed">
                        <path d="M440-280h320v-22q0-45-44-71.5T600-400q-72 0-116 26.5T440-302v22Zm160-160q33 0 56.5-23.5T680-520q0-33-23.5-56.5T600-600q-33 0-56.5 23.5T520-520q0 33 23.5 56.5T600-440ZM160-160q-33 0-56.5-23.5T80-240v-480q0-33 23.5-56.5T160-800h240l80 80h320q33 0 56.5 23.5T880-640v400q0 33-23.5 56.5T800-160H160Zm0-80h640v-400H447l-80-80H160v480Zm0 0v-480 480Z" />
                    </svg>
                    No folders are shared with you.
                </div>
            <?php endif; ?>
        </div>
    </main>

    <!-- Context Menu -->
    <div class="context-menu" id="contextMenu">
    
    </div>

    <script>
        // Pass the PHP profilePictures array to JavaScript
        const profilePictures = <?php echo json_encode($profilePictures); ?>;

        document.addEventListener('DOMContentLoaded', () => {
            const rows = document.querySelectorAll('.folder-row');
            const tooltip = document.createElement('div');
            tooltip.className = 'tooltip';
            document.body.appendChild(tooltip);

            rows.forEach(row => {
                row.addEventListener('mouseenter', (event) => {
                    const name = row.getAttribute('data-folder-name');
                    const owner = row.getAttribute('data-folder-owner');
                    const sharedWith = JSON.parse(row.getAttribute('data-folder-shared'));

                    // Construct tooltip content
                    let tooltipContent = `<strong>${name}</strong><br>Owner: ${owner}`;
                    if (sharedWith.length > 0) {
                        tooltipContent += `<br>Shared With:<br><div style="display: flex; flex-wrap: wrap; gap: 10px;">`;
                        sharedWith.forEach(username => {
                            const profileImagePath = profilePictures[username];
                            tooltipContent += `
                                <div style="text-align: center; width: 50px;">
                                    <img src="${profileImagePath}" alt="${username}" style="width: 40px; height: 40px; border-radius: 50%;"/>
                                    <div style="font-size: 12px; color: #fff; margin-top: 5px;">${username}</div>
                                </div>
                            `;
                        });
                        tooltipContent += `</div>`;
                    }

                    tooltip.innerHTML = tooltipContent;
                    tooltip.style.display = 'block';
                });

                row.addEventListener('mousemove', (event) => {
                    tooltip.style.left = event.pageX + 10 + 'px';
                    tooltip.style.top = event.pageY + 10 + 'px';
                });

                row.addEventListener('mouseleave', () => {
                    tooltip.style.display = 'none';
                });
            });
        });

        document.addEventListener('DOMContentLoaded', applySidebarState);

    </script>
</body>

</html>