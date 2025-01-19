<?php include_once '../controller/navbar.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Full Name</title>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
  <style>
    input[type="number"]::-webkit-outer-spin-button,
    input[type="number"]::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    #sidebar ul li #accountSettings {
        color: var(--accent-clr);

        svg {
            fill: var(--accent-clr);
        }
    }
    h1 {
        text-align: left;
        color: #333;
        border-bottom: 1px solid gray;
        padding-bottom: 15px;
        padding-left: 10px;
    }
    #admin_name {
        padding: 10px;
        border-radius: 3px;
        border: 1px solid gray;
    }
    .button {
        background-color: #128f8b;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 20px;
        cursor: pointer;
    }
    .div {
        border: 1px solid lightgray;
        border-radius: 10px;
        padding: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 30px;
    }
    .details {
        input {
            padding: 10px 20px;
            width: 500px;
            border-radius: 3px;
            border: 1px solid gray;
        }
        .show_password {
            position: absolute;
            top: 36%;
            left: 55%;
        }
        .show_confirmPassword {
            position: absolute;
            top: 36%;
            left: 92%;
        }
    }
    p {
        font-size: 15px;
        color: lightgray;
    }

    .title > div:first-child {
        margin-bottom: 20px;
    }
    [name="deleteAccount"] {
        background-color: #f05c6c;
        
    }
  </style>
  <main>
    <div class="container">

      <form action="../remote/editAccountDetails.php" method="POST" id="editForm">

        <!-- EDIT NAME -->
        <?php if (isset($_GET['admin_name'])) {
            $admin_name = mysqli_real_escape_string($conn, $_GET['admin_name']); ?>
            <div class="title">
                <div>
                <a href="accountSettings.php">
                        <svg xmlns="http://www.w3.org/2000/svg" 
                        height="20px" 
                        viewBox="0 -960 960 960" 
                        width="20px" 
                        fill="#128f8b">
                        <path d="m313-440 224 224-57 56-320-320 320-320 57 56-224 224h487v80H313Z"/></svg>
                    </a>
                </div>
                <div>
                    <h1>Edit full name</h1>
                </div>
            </div>
            <p>Changes to your full name will be reflected across your FileFlex acocunt.</p><br>
            <div class="div">
                <div class="details">
                    <label for="adminOldName">Current full name</label>
                    <input type="text" id="oldName" name="oldName" value="<?php echo $admin_name ?>" required /><br>
                </div>
                <div class="details">
                    <label for="adminNewName">New full name</label>
                    <input type="text" id="admin_name" name="admin_name" placeholder="Enter your new full name" required />
                </div>
            </div>
            <br><button class="button" type="submit" id="submitNameButton" name="editAcccountName">Save Changes</button>
        <?php } ?>

        <!-- EDIT USERNAME -->
        <?php if (isset($_GET['admin_username']) && !isset($_GET['id'])) {
            $admin_username = mysqli_real_escape_string($conn, $_GET['admin_username']); ?>
            <div class="title">
                <div>
                    <a href="accountSettings.php">
                        <svg xmlns="http://www.w3.org/2000/svg" 
                        height="20px" 
                        viewBox="0 -960 960 960" 
                        width="20px" 
                        fill="#128f8b">
                        <path d="m313-440 224 224-57 56-320-320 320-320 57 56-224 224h487v80H313Z"/></svg>
                    </a>    
                </div>
                <div>
                    <h1>Edit Username</h1>
                </div>
            </div>
            <p>Changes to your username will be reflected across your FileFlex acocunt.</p><br>
            <div class="div">
                <div class="details">
                    <label for="admiOldUsername">Old Username:</label>
                    <input type="text" id="oldUsername" name="oldUsername" value="<?php echo $admin_username ?>" required />
                </div>
                <div class="details">
                    <label for="adminNewUserame">New Username:</label>
                    <input type="text" id="admin_username" name="admin_username" placeholder="Enter your new Username" required />
                </div>
            </div>
            <br><button class="button" type="submit" id="submitUsername" name="editAcccountUsername">Save Changes</button>
        <?php } ?>

        <!-- EDIT EMAIL -->
        <?php if (isset($_GET['admin_email'])) {
            $admin_email = mysqli_real_escape_string($conn, $_GET['admin_email']); ?>
            <div class="title">
                <div>
                    <a href="accountSettings.php">
                        <svg xmlns="http://www.w3.org/2000/svg" 
                        height="20px" 
                        viewBox="0 -960 960 960" 
                        width="20px" 
                        fill="#128f8b">
                        <path d="m313-440 224 224-57 56-320-320 320-320 57 56-224 224h487v80H313Z"/></svg>
                    </a>    
                </div>
                <div>
                    <h1>Edit Email Adress</h1>
                </div>
            </div>
            <p>Changes to your email address will be reflected across your FileFlex acocunt.</p><br>
            <div class="div">
                <div class="details">
                    <label for="adminOldEmail">Old Email Address:</label>
                    <input type="text" id="oldEmail" name="oldEmail" value="<?php echo $admin_email ?>" required />
                </div>
                <div class="details">
                    <label for="adminNewEmail">New Email Address:</label>
                    <input type="email" id="admin_email" name="admin_email" placeholder="Enter your new Email Adress" required />
                </div>
            </div>
            <br><button class="button" type="submit" id="submitEmail" name="editAcccountEmail">Save Changes</button>
        <?php } ?>

        <!-- EDIT CONTACT -->
        <?php if (isset($_GET['admin_contact'])) {
            $admin_contact = mysqli_real_escape_string($conn, $_GET['admin_contact']); ?>
            <div class="title">
                <div>
                    <a href="accountSettings.php">
                        <svg xmlns="http://www.w3.org/2000/svg" 
                        height="20px" 
                        viewBox="0 -960 960 960" 
                        width="20px" 
                        fill="#128f8b">
                        <path d="m313-440 224 224-57 56-320-320 320-320 57 56-224 224h487v80H313Z"/></svg>
                    </a>    
                </div>
                <div>
                    <h1>Edit Contact Number</h1>
                </div>
            </div>
            <p>Changes to your contact number will be reflected across your FileFlex acocunt.</p><br>
            <div class="div">
                <div class="details">
                    <label for="adminOldContact">Old Contact Number:</label>
                    <input type="text" id="oldContact" name="oldContact" value="<?php echo $admin_contact ?>" required />
                </div>
                <div class="details">
                    <label for="adminNewContact">New Contact Number:</label>
                    <input type="number" id="admin_contact" name="admin_contact" placeholder="Enter your new Contact Number" required />
                </div>
            </div>
            <br><button class="button" type="submit" id="submitContact" name="editAcccountContact">Save Changes</button>
        <?php } ?>


        <!-- CHANGE PASSWORD -->
        <?php if (isset($_POST['sendCodes'])) {
             $old_admin_password = $_POST['admin_password'];
        ?>

            <div class="title">
                <div>
                    <a href="accountSettings.php">
                        <svg xmlns="http://www.w3.org/2000/svg" 
                        height="20px" 
                        viewBox="0 -960 960 960" 
                        width="20px" 
                        fill="#128f8b">
                        <path d="m313-440 224 224-57 56-320-320 320-320 57 56-224 224h487v80H313Z"/></svg>
                    </a>    
                </div>
                <div>
                    <h1>New password</h1> <br>
                </div>
            </div>
            
            <input type="hidden" id="old_admin_password" name="old_admin_password" value="<?php echo $old_admin_password ?>" required />
            
            <div class="div">
                <div class="details">
                    <label for="newPass">Type new password:</label>
                    <input type="password" id="new_admin_password" name="new_admin_password" placeholder="Enter at least 8 characters" required />
                    <a class="show_password" onclick="togglePassword()" alt="Show password"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#5f6368">
                        <path d="m644-428-58-58q9-47-27-88t-93-32l-58-58q17-8 34.5-12t37.5-4q75 0 127.5 52.5T660-500q0 20-4 37.5T644-428Zm128 126-58-56q38-29 67.5-63.5T832-500q-50-101-143.5-160.5T480-720q-29 0-57 4t-55 12l-62-62q41-17 84-25.5t90-8.5q151 0 269 83.5T920-500q-23 59-60.5 109.5T772-302Zm20 246L624-222q-35 11-70.5 16.5T480-200q-151 0-269-83.5T40-500q21-53 53-98.5t73-81.5L56-792l56-56 736 736-56 56ZM222-624q-29 26-53 57t-41 67q50 101 143.5 160.5T480-280q20 0 39-2.5t39-5.5l-36-38q-11 3-21 4.5t-21 1.5q-75 0-127.5-52.5T300-500q0-11 1.5-21t4.5-21l-84-82Zm319 93Zm-151 75Z" />
                        </svg>
                    </a>    
                </div>
                <div class="details">
                    <label for="confirmNewPass">Confirm new password:</label>
                    <input type="password" id="new_admin_confirmPassword" name="new_admin_confirmPassword" placeholder="Confirm your new password" required />
                    <a class="show_confirmPassword" onclick="toggleConfirmPassword()" alt="Show Confirm password"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#5f6368">
                        <path d="m644-428-58-58q9-47-27-88t-93-32l-58-58q17-8 34.5-12t37.5-4q75 0 127.5 52.5T660-500q0 20-4 37.5T644-428Zm128 126-58-56q38-29 67.5-63.5T832-500q-50-101-143.5-160.5T480-720q-29 0-57 4t-55 12l-62-62q41-17 84-25.5t90-8.5q151 0 269 83.5T920-500q-23 59-60.5 109.5T772-302Zm20 246L624-222q-35 11-70.5 16.5T480-200q-151 0-269-83.5T40-500q21-53 53-98.5t73-81.5L56-792l56-56 736 736-56 56ZM222-624q-29 26-53 57t-41 67q50 101 143.5 160.5T480-280q20 0 39-2.5t39-5.5l-36-38q-11 3-21 4.5t-21 1.5q-75 0-127.5-52.5T300-500q0-11 1.5-21t4.5-21l-84-82Zm319 93Zm-151 75Z" />
                        </svg>
                    </a>
                </div>
            </div>
            <br><button class="button" type="submit" id="submitPassword" name="editPassword">Save Changes</button>
        <?php } ?>


        <!-- DELETE ACCOUNT -->
        <?php if (isset($_GET['id']) && isset($_GET['admin_username'])) {
            $admin_username = mysqli_real_escape_string($conn, $_GET['admin_username']);
            $id = mysqli_real_escape_string($conn, $_GET['id']); ?>
            <div class="title">
                <div>
                <a href="accountSettings.php">
                        <svg xmlns="http://www.w3.org/2000/svg" 
                        height="20px" 
                        viewBox="0 -960 960 960" 
                        width="20px" 
                        fill="#128f8b">
                        <path d="m313-440 224 224-57 56-320-320 320-320 57 56-224 224h487v80H313Z"/></svg>
                    </a>
                </div>
                <div>
                    <h1>Delete Account</h1> <br>
                </div>
            </div>
            
            <p>
                Are you sure you want to delete your account? This action is permanent and cannot be undone. 
                All your data, preferences, and settings will be permanently erased.
            </p>
            
            <input type="hidden" id="id" name="id" value="<?php echo $id ?>" required />
            <input type="hidden" id="admin_username" name="admin_username" value="<?php echo $admin_username ?>" required />

            <label for="agreement">
                <input type="checkbox" id="agreement" name="agreement" required>
                I agree to the <a href="termsAndConditions.php" target="_blank">Terms and Conditions</a> and <a href="privacyPolicy.php" target="_blank">Privacy Policy.</a> <br>
            </label>
            <br><button class="button" type="submit" id="submitAccount" name="deleteAccount">Delete Account</button>
            
        <?php } ?>
      </form>
    </div>
  </main>
</body>

<script>
  const form = document.getElementById('editForm');
  const submitNameButton = document.getElementById('submitName');
  const submitUsernameButton = document.getElementById('submitUsername');
  const submitEmailButton = document.getElementById('submitEmail');
  const submitContactButton = document.getElementById('submitContact');
  const submitPasswordButton = document.getElementById('submitPassword');
  const submitAccountButton = document.getElementById('submitAccount');

  // NAME
  if (submitNameButton) {
    submitNameButton.addEventListener('click', function(event) {
      let valid = true;
      const adminNameInput = document.getElementById('admin_name');
      const newName = adminNameInput.value.trim();
      const oldName = document.getElementById('oldName') ? document.getElementById('oldName').value : '';
      const fullNamePattern = /^[a-zA-Z]+(\s[a-zA-Z]+)?(\s[a-zA-Z]+)?(\s[a-zA-Z]+)$/;
      if (newName === oldName) {
        Swal.fire({
          icon: 'warning',
          title: 'No Changes Made!',
          text: 'The new full name is the same as the old one. Please enter a different name.'
        });
        valid = false;
      } else if (adminNameInput && !fullNamePattern.test(adminNameInput.value)) {

        Swal.fire({
          icon: 'info',
          title: 'Invalid Fullname!',
          text: 'Please ensure that Name follows the name format (Firstname M.I. Lastname) .'
        });

        valid = false;
      }
      if (!valid) {
        event.preventDefault();
      }
    });
  }

  // USERNAME
  if (submitUsernameButton) {
    submitUsernameButton.addEventListener('click', function(event) {
      let valid = true;
      const adminUsernameInput = document.getElementById('admin_username');
      const newUsername = adminUsernameInput.value.trim();
      const oldUsername = document.getElementById('oldUsername') ? document.getElementById('oldUsername').value : '';
      const usernamePattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*()_+=[\]{}|;:'",.<>?/\\-]).{3,20}$/;

      if (newUsername === oldUsername) {
        Swal.fire({
          icon: 'warning',
          title: 'No Changes Made!',
          text: 'The new username is the same as the old one. Please enter a different username.'
        });
        valid = false;
      } else if (adminUsernameInput && !usernamePattern.test(adminUsernameInput.value)) {
        Swal.fire({
          icon: 'info',
          title: 'Invalid Username!',
          text: 'Username must contain at least one uppercase letter, one lowercase letter, and one special character.'
        });
        valid = false;
      }
      if (!valid) {
        event.preventDefault();
      }
    });
  }

  // EMAIL
  if (submitEmailButton) {
    submitEmailButton.addEventListener('click', function(event) {
      let valid = true;
      const adminEmailInput = document.getElementById('admin_email');
      const newEmail = adminEmailInput.value.trim();
      const oldEmail = document.getElementById('oldEmail') ? document.getElementById('oldEmail').value : '';
      const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;


      if (newEmail === oldEmail) {
        Swal.fire({
          icon: 'warning',
          title: 'No Changes Made!',
          text: 'The new Email Adress is the same as the old one. Please enter a different Email Adress.'
        });
        valid = false;
      } else if (adminEmailInput && !emailPattern.test(adminEmailInput.value)) {
        Swal.fire({
          icon: 'info',
          title: 'Invalid Email Adress!',
          text: 'Please ensure that Email Adress is Valid.'
        });
        valid = false;
      }
      if (!valid) {
        event.preventDefault();
      }
    });
  }

  //CONTACT
  if (submitContactButton) {
    submitContactButton.addEventListener('click', function(event) {
      let valid = true;
      const adminContactInput = document.getElementById('admin_contact');
      const newContact = adminContactInput.value.trim();
      const oldContact = document.getElementById('oldContact') ? document.getElementById('oldContact').value : '';
      const contactPattern = /^(\d{11})$/;


      if (newContact === oldContact) {
        Swal.fire({
          icon: 'warning',
          title: 'No Changes Made!',
          text: 'The new Contact Number is the same as the old one. Please enter a different Contact Number.'
        });
        valid = false;
      } else if (adminContactInput && !contactPattern.test(adminContactInput.value)) {
        Swal.fire({
          icon: 'info',
          title: 'Invalid Contact Number!',
          text: 'Please ensure that Contact Number is Valid. ex. 0999 999 9999.'
        });
        valid = false;
      }
      if (!valid) {
        event.preventDefault();
      }
    });
  }

  //PASSWORD
  if (submitPasswordButton) {
    submitPasswordButton.addEventListener('click', function(event) {
      let valid = true;
      const adminNewPasswordInput = document.getElementById('new_admin_password');
      const adminNewConfirmPasswordInput = document.getElementById('new_admin_confirmPassword');
      let newPassword;
      let newConfirmPassword;

      function sha1(message) {
        const encoder = new TextEncoder();
        const data = encoder.encode(message);

        return crypto.subtle.digest('SHA-1', data).then(hashBuffer => {
          const hashArray = Array.from(new Uint8Array(hashBuffer));
          return hashArray.map(byte => byte.toString(16).padStart(2, '0')).join('');
        });
      }

      sha1(adminNewPasswordInput.value.trim()).then(hash => {
        newPassword = hash;
      });

      sha1(adminNewConfirmPasswordInput.value.trim()).then(hash => {
        newConfirmPassword = hash;
      });

      const oldPassword = document.getElementById('old_admin_password') ? document.getElementById('old_admin_password').value : '';

      console.log(newPassword);
      console.log(newConfirmPassword);
      const passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*()_+=[\]{}|;:'",.<>?/\\-]).{3,20}$/;

      if (adminNewPasswordInput.value !== adminNewConfirmPasswordInput.value) {
        Swal.fire({
          icon: 'warning',
          title: 'Passwords do not Match!',
          text: 'Make sure that the password is same as confirm password.'
        });
        valid = false;

      } else if (adminNewPasswordInput && !passwordPattern.test(adminNewPasswordInput.value)) {
        Swal.fire({
          icon: 'info',
          title: 'weak Password!',
          text: 'Please ensure that Password is strong.'
        });
        valid = false;
      }
      if (!valid) {
        event.preventDefault();
      }
    });
  }

  //DELETE ACCOUNT
  if (submitAccountButton) {
    submitAccountButton.addEventListener('click', function(event) {
      let valid = true;
      const agreementInput = document.getElementById('agreement');

      if (!agreementInput.checked) {
        Swal.fire({
          icon: 'warning',
          title: 'agreement!',
          text: 'Please Check the agreement.'
        });
        valid = false;
      }
      if (!valid) {
        event.preventDefault();
      }
    });
  }













  function togglePassword() {
    const passwordInput = document.getElementById("new_admin_password");
    const icon = document.querySelector(".show_password");

    if (passwordInput.type === "password") {
      passwordInput.type = "text";
      icon.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed"><path d="M480-320q75 0 127.5-52.5T660-500q0-75-52.5-127.5T480-680q-75 0-127.5 52.5T300-500q0 75 52.5 127.5T480-320Zm0-72q-45 0-76.5-31.5T372-500q0-45 31.5-76.5T480-608q45 0 76.5 31.5T588-500q0 45-31.5 76.5T480-392Zm0 192q-146 0-266-81.5T40-500q54-137 174-218.5T480-800q146 0 266 81.5T920-500q-54 137-174 218.5T480-200Zm0-300Zm0 220q113 0 207.5-59.5T832-500q-50-101-144.5-160.5T480-720q-113 0-207.5 59.5T128-500q50 101 144.5 160.5T480-280Z"/></svg>';
    } else {
      passwordInput.type = "password";
      icon.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#5f6368"><path d="m644-428-58-58q9-47-27-88t-93-32l-58-58q17-8 34.5-12t37.5-4q75 0 127.5 52.5T660-500q0 20-4 37.5T644-428Zm128 126-58-56q38-29 67.5-63.5T832-500q-50-101-143.5-160.5T480-720q-29 0-57 4t-55 12l-62-62q41-17 84-25.5t90-8.5q151 0 269 83.5T920-500q-23 59-60.5 109.5T772-302Zm20 246L624-222q-35 11-70.5 16.5T480-200q-151 0-269-83.5T40-500q21-53 53-98.5t73-81.5L56-792l56-56 736 736-56 56ZM222-624q-29 26-53 57t-41 67q50 101 143.5 160.5T480-280q20 0 39-2.5t39-5.5l-36-38q-11 3-21 4.5t-21 1.5q-75 0-127.5-52.5T300-500q0-11 1.5-21t4.5-21l-84-82Zm319 93Zm-151 75Z"/></svg>';
    }
  }

  function toggleConfirmPassword() {
    const ConfirmPasswordInput = document.getElementById("new_admin_confirmPassword");
    const icon2 = document.querySelector(".show_confirmPassword");

    if (ConfirmPasswordInput.type === "password") {
      ConfirmPasswordInput.type = "text";
      icon2.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed"><path d="M480-320q75 0 127.5-52.5T660-500q0-75-52.5-127.5T480-680q-75 0-127.5 52.5T300-500q0 75 52.5 127.5T480-320Zm0-72q-45 0-76.5-31.5T372-500q0-45 31.5-76.5T480-608q45 0 76.5 31.5T588-500q0 45-31.5 76.5T480-392Zm0 192q-146 0-266-81.5T40-500q54-137 174-218.5T480-800q146 0 266 81.5T920-500q-54 137-174 218.5T480-200Zm0-300Zm0 220q113 0 207.5-59.5T832-500q-50-101-144.5-160.5T480-720q-113 0-207.5 59.5T128-500q50 101 144.5 160.5T480-280Z"/></svg>';
    } else {
      ConfirmPasswordInput.type = "password";
      icon2.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#5f6368"><path d="m644-428-58-58q9-47-27-88t-93-32l-58-58q17-8 34.5-12t37.5-4q75 0 127.5 52.5T660-500q0 20-4 37.5T644-428Zm128 126-58-56q38-29 67.5-63.5T832-500q-50-101-143.5-160.5T480-720q-29 0-57 4t-55 12l-62-62q41-17 84-25.5t90-8.5q151 0 269 83.5T920-500q-23 59-60.5 109.5T772-302Zm20 246L624-222q-35 11-70.5 16.5T480-200q-151 0-269-83.5T40-500q21-53 53-98.5t73-81.5L56-792l56-56 736 736-56 56ZM222-624q-29 26-53 57t-41 67q50 101 143.5 160.5T480-280q20 0 39-2.5t39-5.5l-36-38q-11 3-21 4.5t-21 1.5q-75 0-127.5-52.5T300-500q0-11 1.5-21t4.5-21l-84-82Zm319 93Zm-151 75Z"/></svg>';
    }
  }

  document.addEventListener('DOMContentLoaded', applySidebarState);

</script>

</html>