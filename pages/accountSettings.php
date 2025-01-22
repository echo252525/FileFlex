<?php include_once '../controller/navbar.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Settings</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<style>
    body {
        background-color: #f9f9f9;
    }

    a {
        text-decoration: none;
        /* Remove underline */
        color: inherit;
        /* Inherit color from the parent or specified color */
    }

    /* Optionally, if you want specific control over label styles */
    a label {
        color: #333;
        /* Set your desired color */
        font-weight: normal;
        /* Adjust weight if needed */
        text-decoration: none;
        /* Ensure no underline is applied */
    }

    .basicInfo,
    .contactInfo,
    .securityInfo {
        border: 1px solid darkgray;
        border-radius: 20px;
        margin-bottom: 20px;
        padding: 20px;
        background-color: white;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);

        h2 {
            margin-bottom: 20px;
            font-weight: none;
        }

        .one,
        .two {
            border-bottom: 1px solid darkgray;
            padding: 20px 20px 20px 5px;
        }
    }

    .basicInfo {
        img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            margin-bottom: 10px;
        }
    }

    .one {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;

        .dateCreated {
            color: gray;
        }
    }

    .two {
        display: flex;

        label {
            flex-basis: 200px;
        }

        span {
            flex-basis: 900px;
        }
    }

    .card {
        display: grid;
        place-items: center;

        img {
            width: 180px;
            height: 180px;
            border-radius: 50%;
        }

        input[type="file"] {
            display: none;
        }

        input[type="submit"] {
            display: none;
        }

        svg {
            border-radius: 50%;
            border: 1px solid black;
            padding: 5px;
            margin-right: 10px;
        }
    }

    h1 {
        text-align: left;
        color: #333;
        margin-bottom: 20px;
        border-bottom: 1px solid gray;
        padding-bottom: 15px;
        padding-left: 10px;
    }

    h2 {
        color: #333;
    }

    
    .border {
        display: flex;
        justify-content: center;
        align-items: center;
    }
</style>

<body>
    <main>
        <div class="container">
            <div class="text">
                <h1>Account Settings</h1>
            </div>

            <div class="basicInfo">
                <h2>Basic Info</h2>

                <div class="one">
                    <div class="profileDiv">
                        <div class="card">
                            <img src="../uploads/adminProfile/<?php echo htmlspecialchars($aline['admin_profile']); ?>" alt="Profile Picture" id="profile_pic">

                            <label for="admin_profile">
                                <div class="border">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="15px" viewBox="0 -960 960 960" width="15px" fill="#000000">
                                        <path d="M200-200h57l391-391-57-57-391 391v57Zm-80 80v-170l528-527q12-11 26.5-17t30.5-6q16 0 31 6t26 18l55 56q12 11 17.5 26t5.5 30q0 16-5.5 30.5T817-647L290-120H120Zm640-584-56-56 56 56Zm-141 85-28-29 57 57-29-28Z" />
                                    </svg>
                                    <label>Profile Picture</label> <br>
                                </div>
                            </label>
                            <form action="../remote/editAccountDetails.php" method="POST" id="editForm" enctype="multipart/form-data">
                                <input type="hidden" id="admin_username" name="admin_username" value="<?php echo htmlspecialchars($aline['admin_username']); ?>" />
                                <input type="file" id="admin_profile" name="admin_profile" accept="image/*" />
                                <input type="submit" id="submitProfile" name="editProfile"></input>
                            </form>
                        </div>
                    </div>
                    
                    
                    <label class="dateCreated">Date Created: <?php echo date("F j, Y", strtotime($aline["admin_created_date"])); ?></label>


                </div>

                <a href="editAccount.php?admin_name=<?php echo htmlspecialchars($aline['admin_name']); ?>">
                    <div class="two">
                        <label>Name</label>
                        <span><?php echo htmlspecialchars($aline['admin_name']); ?></span>
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="black">
                            <path d="M504-480 320-664l56-56 240 240-240 240-56-56 184-184Z" />
                        </svg>
                    </div>
                </a>

                <a href="editAccount.php?admin_username=<?php echo htmlspecialchars($aline['admin_username']); ?>" class="design">
                    <div class="two">
                        <label>Username</label>
                        <span><?php echo htmlspecialchars($aline['admin_username']); ?></span>
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="black">
                            <path d="M504-480 320-664l56-56 240 240-240 240-56-56 184-184Z" />
                        </svg>
                    </div>
                </a>

            </div>


            <div class="contactInfo">
                <h2>Contact</h2>

                <a href="editAccount.php?admin_email=<?php echo htmlspecialchars($aline['admin_email']); ?>" class="design">
                    <div class="two">
                        <label>Email Address</label>
                        <span><?php echo htmlspecialchars($aline['admin_email']); ?></span>
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="black">
                            <path d="M504-480 320-664l56-56 240 240-240 240-56-56 184-184Z" />
                        </svg>
                    </div>
                </a>

                <a href="editAccount.php?admin_contact=<?php echo htmlspecialchars($aline['admin_contact']); ?>" class="design">
                    <div class="two">
                        <label>Contact Number</label>
                        <span><?php echo htmlspecialchars($aline['admin_contact']); ?></span>
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="black">
                            <path d="M504-480 320-664l56-56 240 240-240 240-56-56 184-184Z" />
                        </svg>
                    </div>
                </a>

            </div>


            <div class="securityInfo">
                <h2>Security</h2>

                <a href="sendCodes.php?admin_password=<?php echo urlencode($aline['admin_password']); ?>&admin_email=<?php echo urlencode($aline['admin_email']); ?>" class="design">
                    <div class="two">
                        <label>Change Password</label>
                        <span></span>
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="black">
                            <path d="M504-480 320-664l56-56 240 240-240 240-56-56 184-184Z" />
                        </svg>
                    </div>
                </a>


                <a href="editAccount.php?id=<?php echo urlencode($aline['id']); ?>&admin_username=<?php echo urlencode($aline['admin_username']); ?>" class="design">
                    <div class="two">
                        <label>Delete Account</label>
                        <span></span>
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="black">
                            <path d="M504-480 320-664l56-56 240 240-240 240-56-56 184-184Z" />
                        </svg>
                    </div>
                </a>

            </div>
        </div>
    </main>
    <script>
        // Get the file input and profile image elements
        let profilePic = document.getElementById('profile_pic');
        let inputFile = document.getElementById('admin_profile');
        let submitProfile = document.getElementById('submitProfile'); // Assuming the submit button has the id 'submit_button'

        inputFile.onchange = function() {
            // Display SweetAlert2 dialog
            Swal.fire({
                title: 'Confirm Profile Update',
                text: 'Do you want to update your profile picture?',
                imageUrl: URL.createObjectURL(inputFile.files[0]), // Preview the uploaded image
                imageAlt: 'Profile Picture Preview',
                showCancelButton: true,
                confirmButtonText: 'Yes, update it!',
                cancelButtonText: 'Cancel',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    // Automatically click the submit button if user confirms
                    submitProfile.click();
                } else {
                    // Reset the file input if the user cancels
                    inputFile.value = '';
                }
            });
        };

        document.addEventListener('DOMContentLoaded', applySidebarState);
    </script>
</body>



</html>