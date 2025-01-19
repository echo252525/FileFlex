<?php
include_once '../connection/connection.php';
session_start();

if (!isset($_SESSION['admin_username'])) {
    header("Location: ../index.php");
    exit();
}

function formatFileSize($bytes)
{
    if ($bytes >= 1073741824) {
        $bytes = number_format($bytes / 1073741824, 2) . ' GB';
    } elseif ($bytes >= 1048576) {
        $bytes = number_format($bytes / 1048576, 2) . ' MB';
    } elseif ($bytes >= 1024) {
        $bytes = number_format($bytes / 1024, 2) . ' KB';
    } else {
        $bytes = $bytes . ' bytes';
    }
    return $bytes;
}
$loggedInUser = $_SESSION['admin_username'];
$get = "SELECT * FROM admin_account WHERE admin_username = '$loggedInUser'";
$fetch = mysqli_query($conn, $get);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

        :root {
            --base-clr: #f1f1f1;
            --text-clr: #000000;
            --secondary-text-clr: #343434;
            --line-clr: #dfdfdf;
            --hover-clr: #dedede;
            --accent-clr: #128f8b;
        }

        * {
            margin: 0;
            padding: 0;
            font-family: Poppins, 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f9f9f9;
        }

        main {
            padding: min(30px, 7%);
        }

        main p {
            color: var(--secondary-text-clr);
            margin-top: 5px;
            margin-bottom: 15px;
        }

        .container {
            background-color: white;
            border: 1px solid var(--line-clr);
            border-radius: 1em;
            margin-bottom: 20px;
            padding: min(3em, 15%);

            box-shadow: rgba(0, 0, 0, 0.15) 1.95px 1.95px 2.6px;
        }

        html {
            font-family: Poppins, 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.5rem;
        }

        body {
            min-height: 100vh;
            min-height: 100vdh;
            background-color: var(--base-clr);
            color: var(--text-clr);
            display: grid;
            grid-template-columns: auto 1fr;
        }

        #sidebar {
            box-sizing: border-box;
            height: 100vh;
            width: 250px;

            padding: 5px 1em;
            background-color: var(--base-clr);
            border-right: 1px solid var(--line-clr);

            box-shadow: rgba(0, 0, 0, 0.15) 1.95px 1.95px 2.6px;

            position: sticky;
            top: 0;
            align-self: start;

            transition: 300ms ease-in-out;
            overflow: hidden;
            text-wrap: nowrap;
        }

        #sidebar.close {
            padding: 5px;
            width: 60px;
        }

        #sidebar ul {
            list-style: none;
        }

        #sidebar>ul>li:first-child {
            display: flex;
            justify-self: flex-end;
            margin-bottom: 16px;

            .logo img {
                width: 70px;
            }
        }

        #sidebar ul li ul.sub-menu a.active {
            color: #3bb5b1;

        }

        #sidebar ul li ul.sub-menu a.active::before {
            content: url('data:image/svg+xml,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20height%3D%2224px%22%20viewBox%3D%220%20-960%20960%20960%22%20width%3D%2224px%22%20fill%3D%22%233bb5b1%22%3E%3Cpath%20d%3D%22M504-480%20320-664l56-56%20240%20240-240%20240-56-56%20184-184-184Z%22%2F%3E%3C%2Fsvg%3E');
            display: inline-block;
            width: 24px;
            height: 24px;
        }

        #sidebar ul li a.active {
            color: var(--accent-clr);

            svg {
                fill: var(--accent-clr);
            }
        }



        #sidebar ul li span.active {
            color: var(--accent-clr);
        }

        #sidebar ul li svg.active {
            fill: var(--accent-clr);

        }

        #sidebar ul li div.profile-container a.profile-link {
            border-radius: 50%;
            padding: 0;
            /* Overrides padding */
            text-decoration: none;
            color: none;
            /* Keep this as you desire */
            display: flex;
            gap: 1em;
            margin-top: 7px;
            margin-right: 20px;
        }

        /* The second selector */
        #sidebar a,
        #sidebar .dropdown-btn,
        #sidebar .logo {
            border-radius: .5em;
            padding: .85em;
            /* This will be overridden by the first selector */
            text-decoration: none;
            color: var(--text-clr);
            /* This will be overridden by the first selector */
            display: flex;
            align-items: center;
            gap: 1em;
        }


        .dropdown-btn {
            width: 100%;
            text-align: left;
            background: none;
            border: none;
            font: inherit;
            cursor: pointer;
        }

        #sidebar svg {
            flex-shrink: 0;
            fill: var(--text-clr);
        }

        #sidebar a span,
        #sidebar .dropdown-btn span {
            flex-grow: 1;
        }

        #sidebar a:hover,
        #sidebar .dropdown-btn:hover {
            background-color: var(--hover-clr);
        }

        #sidebar .sub-menu {
            display: grid;
            grid-template-rows: 0fr;
            transition: 300ms ease-in-out;

            >div {
                overflow: hidden;
            }
        }

        #sidebar .sub-menu.show {
            grid-template-rows: 1fr;
        }

        .dropdown-btn svg {
            transition: 200ms ease;
        }

        .rotate svg:last-child {
            rotate: 180deg;
        }

        #sidebar .sub-menu a {
            padding-left: 2em;
        }

        #toggle-btn {
            margin-left: auto;
            padding: 1em;
            border: none;
            border-radius: .5em;
            background: none;
            cursor: pointer;

            svg {
                transition: rotate 150ms ease;
            }
        }

        #toggle-btn:hover {
            background-color: var(--hover-clr);
        }

        .circular-profile {
            width: 40px;
            height: 40px;
            border-radius: 50%;

            /* Makes it circular */
            object-fit: cover;
            /* Prevents distortion */
            border: 2px solid #ddd;
            /* Optional: Adds a border */
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            /* Optional: Adds a subtle shadow */
        }

        .profile-container {
            position: relative;
            display: inline-block;
        }

        .profile-img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            cursor: pointer;
        }

        .profile-hover {
            display: none;
            /* Hide by default */
            position: absolute;
            top: 200%;
            /* Place directly below the image */
            left: 0%;
            transform: translate(10px, -50%);
            /* Add spacing to the right and center vertically */
            background-color: rgba(0, 0, 0, 0.8);
            color: white;
            text-align: left;
            padding: 10px;
            border-radius: 8px;
            z-index: 1000;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            width: max-content;
            /* Ensure content fits dynamically */
            white-space: nowrap;
            /* Prevent line breaks */
        }

        .profile-container:hover .profile-hover {
            display: block;
            /* Show on hover */
        }

    </style>
</head>

<body>
    <nav id="sidebar" class="close">
        <ul>
            <li>
                <?php
                $aline = mysqli_fetch_array($fetch);
                ?>
                <div class="profile-container">
                    <a href="../pages/accountSettings.php" class="profile-link">
                        <img src="../uploads/adminProfile/<?php echo htmlspecialchars($aline['admin_profile']); ?>" alt="Profile Picture" class="circular-profile">
                    </a>
                    <div class="profile-hover">
                        <p>FileFlex Account</p>
                        <p class="admin-name"><?php echo htmlspecialchars($aline['admin_name']); ?></p>
                        <p class="admin-email"><?php echo htmlspecialchars($aline['admin_email']); ?></p>
                    </div>
                </div>

                <span class="logo"><img src="../img/logo.png"></span>
                <button onclick="toggleSidebar()" id="toggle-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed">
                        <path d="m242-200 200-280-200-280h98l200 280-200 280h-98Zm238 0 200-280-200-280h98l200 280-200 280h-98Z" />
                    </svg>
                </button>
            </li>
            <li>
                <a href="../pages/homePage.php" class="nav <?php echo (basename($_SERVER['PHP_SELF']) == 'homePage.php') ? 'active' : ''; ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed">
                        <path d="M240-200h120v-240h240v240h120v-360L480-740 240-560v360Zm-80 80v-480l320-240 320 240v480H520v-240h-80v240H160Zm320-350Z" />
                    </svg>
                    <span>Home</span>
                </a>

            </li>

            <li>
                <button onclick="toggleSubMenu(this)" class="dropdown-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed">
                        <path d="M440-280h80v-160h160v-80H520v-160h-80v160H280v80h160v160ZM200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h560q33 0 56.5 23.5T840-760v560q0 33-23.5 56.5T760-120H200Zm0-80h560v-560H200v560Zm0-560v560-560Z" />
                    </svg>
                    <span>Create</span>
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed">
                        <path d="M480-344 240-584l56-56 184 184 184-184 56 56-240 240Z" />
                    </svg>
                </button>
                <ul class="sub-menu">
                    <div>
                        <li>
                            <a onclick="openModalForFiles()">New File</a>
                            <div id="modalContainerForFiles"></div>
                        </li>
                        <li>
                            <a onclick="openModalForFolders()">New Folder</a>
                            <div id="modalContainerForFolders"></div>
                        </li>
                    </div>
                </ul>
            </li>

            <li>
                <button onclick="toggleSubMenu(this)" class="dropdown-btn" id="dropdown">
                    <svg class="nav <?php echo (basename($_SERVER['PHP_SELF']) == 'myFilesTable.php' || basename($_SERVER['PHP_SELF']) == 'myFoldersTable.php' || basename($_SERVER['PHP_SELF']) == 'myFolderFilesTable.php' || basename($_SERVER['PHP_SELF']) == 'mySharedFolderFilesTable.php' || basename($_SERVER['PHP_SELF']) == 'mySharedFolderTable.php') ? 'active' : ''; ?>" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed">
                        <path d="M480-320q75 0 127.5-52.5T660-500q0-75-52.5-127.5T480-680q-75 0-127.5 52.5T300-500q0 75 52.5 127.5T480-320Zm0-72q-45 0-76.5-31.5T372-500q0-45 31.5-76.5T480-608q45 0 76.5 31.5T588-500q0 45-31.5 76.5T480-392Zm0 192q-146 0-266-81.5T40-500q54-137 174-218.5T480-800q146 0 266 81.5T920-500q-54 137-174 218.5T480-200Zm0-300Zm0 220q113 0 207.5-59.5T832-500q-50-101-144.5-160.5T480-720q-113 0-207.5 59.5T128-500q50 101 144.5 160.5T480-280Z" />
                    </svg>
                    <span class="nav <?php echo (basename($_SERVER['PHP_SELF']) == 'myFilesTable.php' || basename($_SERVER['PHP_SELF']) == 'myFoldersTable.php' || basename($_SERVER['PHP_SELF']) == 'myFolderFilesTable.php' || basename($_SERVER['PHP_SELF']) == 'mySharedFolderFilesTable.php' || basename($_SERVER['PHP_SELF']) == 'mySharedFolderTable.php') ? 'active' : ''; ?>">View</span>
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed">
                        <path d="M480-344 240-584l56-56 184 184 184-184 56 56-240 240Z" />
                    </svg>
                </button>
                <ul class="sub-menu" id="sub-menu">
                    <div>
                        <li>
                            <a id="views" href="../pages/myFilesTable.php" class="nav <?php echo (basename($_SERVER['PHP_SELF']) == 'myFilesTable.php') ? 'active' : ''; ?>">My Files</a>
                        </li>
                        <li>
                            <a id="FolderActive" href="../pages/myFoldersTable.php" class="nav <?php echo (basename($_SERVER['PHP_SELF']) == 'myFoldersTable.php') ? 'active' : ''; ?>">My Folders</a>
                        </li>
                        <li>
                            <a id="sharedFolderActive" href="../pages/mySharedFolderTable.php" class="nav <?php echo (basename($_SERVER['PHP_SELF']) == 'mySharedFolderTable.php') ? 'active' : ''; ?>">Shared Folder</a>
                        </li>
                    </div>
                </ul>
            </li>

            <li>
                <a href="../pages/adminAccounts.php" class="nav <?php echo (basename($_SERVER['PHP_SELF']) == 'adminAccounts.php') ? 'active' : ''; ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed">
                        <path d="m370-80-16-128q-13-5-24.5-12T307-235l-119 50L78-375l103-78q-1-7-1-13.5v-27q0-6.5 1-13.5L78-585l110-190 119 50q11-8 23-15t24-12l16-128h220l16 128q13 5 24.5 12t22.5 15l119-50 110 190-103 78q1 7 1 13.5v27q0 6.5-2 13.5l103 78-110 190-118-50q-11 8-23 15t-24 12L590-80H370Zm70-80h79l14-106q31-8 57.5-23.5T639-327l99 41 39-68-86-65q5-14 7-29.5t2-31.5q0-16-2-31.5t-7-29.5l86-65-39-68-99 42q-22-23-48.5-38.5T533-694l-13-106h-79l-14 106q-31 8-57.5 23.5T321-633l-99-41-39 68 86 64q-5 15-7 30t-2 32q0 16 2 31t7 30l-86 65 39 68 99-42q22 23 48.5 38.5T427-266l13 106Zm42-180q58 0 99-41t41-99q0-58-41-99t-99-41q-59 0-99.5 41T342-480q0 58 40.5 99t99.5 41Zm-2-140Z" />
                    </svg>
                    <span>Admin Accounts</span>
                </a>

            </li>

            <li>
                <a href="../pages/accountSettings.php" class="nav <?php echo (basename($_SERVER['PHP_SELF']) == 'accountSettings.php') ? 'active' : ''; ?>" id="accountSettings">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed">
                        <path d="M480-480q-66 0-113-47t-47-113q0-66 47-113t113-47q66 0 113 47t47 113q0 66-47 113t-113 47ZM160-160v-112q0-34 17.5-62.5T224-378q62-31 126-46.5T480-440q66 0 130 15.5T736-378q29 15 46.5 43.5T800-272v112H160Zm80-80h480v-32q0-11-5.5-20T700-306q-54-27-109-40.5T480-360q-56 0-111 13.5T260-306q-9 5-14.5 14t-5.5 20v32Zm240-320q33 0 56.5-23.5T560-640q0-33-23.5-56.5T480-720q-33 0-56.5 23.5T400-640q0 33 23.5 56.5T480-560Zm0-80Zm0 400Z" />
                    </svg>
                    <span>Account Settings</span>
                </a>

            </li>
            <li>
                <a href="../adminLogOut.php">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed">
                        <path d="M200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h280v80H200v560h280v80H200Zm440-160-55-58 102-102H360v-80h327L585-622l55-58 200 200-200 200Z" />
                    </svg>
                    <span>Log Out</span>
                </a>

            </li>
        </ul>
    </nav>

    <script>
        const toggleButton = document.getElementById('toggle-btn');
        const sidebar = document.getElementById('sidebar');
        const dropdownBtn = document.getElementById('sub-menu');
        const dropdown = document.getElementById('dropdown');

        function toggleSidebar() {
            sidebar.style.transition = '300ms ease-in-out';
            
            sidebar.classList.toggle('close');
            toggleButton.classList.toggle('rotate');
            closeAllSubMenus()
            const isClosed = sidebar.classList.contains('close');
            localStorage.setItem('sidebarState', isClosed ? 'close' : ''); 
        }

        function applySidebarState() {
            const savedState = localStorage.getItem('sidebarState');
            let savedStateDrp = localStorage.getItem('savedStateDrp');
            // Apply the saved state or default to open

            
            if (savedState === 'close') {
                sidebar.style.transition = '300ms ease-in-out';
                sidebar.classList.add('close');
                toggleButton.classList.toggle('rotate');
                dropdownBtn.style.transition = '300ms ease-in-out';
                

            } else {
                sidebar.style.transition = 'none';
                sidebar.classList.remove('close');
                toggleButton.classList.toggle('rotate');

            }

            if (savedStateDrp === 'show' && !sidebar.classList.contains('close')) {
                dropdownBtn.style.transition = 'none';
                dropdownBtn.classList.add('show');
                dropdown.classList.add('rotate');
                
            } else {
                dropdownBtn.style.transition = '300ms ease-in-out';
                dropdownBtn.classList.remove('show');
                dropdown.classList.remove('rotate');
            }

        }

        function toggleSubMenu(button) {

            if (!button.nextElementSibling.classList.contains('show')) {
                closeAllSubMenus();
            }
            button.nextElementSibling.classList.toggle('show');
            button.classList.toggle('rotate');

            const isClosedDrp = dropdownBtn.classList.contains('show');
            localStorage.setItem('savedStateDrp', isClosedDrp ? 'show' : '');

            if (sidebar.classList.contains('close')) {
                sidebar.classList.toggle('close');
                toggleButton.classList.toggle('rotate');
                const isClosed = sidebar.classList.contains('close');
                localStorage.setItem('sidebarState', isClosed ? 'close' : '');
            }


        }

        function closeAllSubMenus() {
            Array.from(sidebar.getElementsByClassName('show')).forEach(ul => {
                ul.classList.remove('show');
                ul.previousElementSibling.classList.remove('rotate');
            })
            const isClosedDrp = dropdownBtn.classList.contains('show');
            localStorage.setItem('savedStateDrp', isClosedDrp ? 'show' : '');
            dropdownBtn.style.transition = '300ms ease-in-out';
        }

        function openModalForFiles() {
            document.getElementById("newFileModalForFiles").style.display = "block";
        }

        function openModalForFolders() {
            document.getElementById("newFileModalForFolders").style.display = "block";
        }

        function loadModalForFiles() {
            fetch('../pages/modals/createNewFiles.php')
                .then(response => response.text())
                .then(html => {
                    document.getElementById('modalContainerForFiles').innerHTML = html;
                })
                .catch(error => {
                    console.warn('Error loading modal:', error);
                });
        }

        function loadModalForFolders() {
            fetch('../pages/modals/createNewFolder.php')
                .then(response => response.text())
                .then(html => {
                    document.getElementById('modalContainerForFolders').innerHTML = html;
                })
                .catch(error => {
                    console.warn('Error loading modal:', error);
                });
        }


        // Trigger modal loading on page load
        loadModalForFiles();
        loadModalForFolders();

        function closeModalForFiles() {
            document.getElementById("newFileModalForFiles").style.display = "none";
        }

        function closeModalForFolders() {
            document.getElementById("newFileModalForFolders").style.display = "none";
        }

        function triggerFileInput() {
            document.getElementById('admin_file_name').click();
        }

    </script>
</body>

</html>