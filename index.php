<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Log In</title>
</head>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
    * {
        font-family: Poppins, 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        color: #333
    }
    body {
        height: 100vh;
        width: 100vw;
        display: flex;
        justify-content: center;
        align-items: center;
        overflow-x: hidden;
        background: #f9f9f9;
    }
    .mainDiv {
        display: flex;
        justify-content: space-between;
        flex-wrap: wrap; /* Allow wrapping to the next line */
        background: white;
        padding: 30px;
        border-radius: 20px;
        box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;
        width: 40%;
    }
    .div1 {
        flex-basis: 100%;
        display: flex;
        align-items: center;
        justify-content: space-between;
        border-bottom: 1px solid #d9d9d9;
        padding-bottom: 10px;
        margin-bottom: 30px;
        img{
            width: 70px;
        }
    }
    .div2 {
        margin-right: 10px;
        p {
            font-size: 30px;
            font-weight: 600;
        }
    }
    input[type="text"], 
    input[type="password"] {
        padding: 10px 10px 12px 15px;
        border: 1px solid #ccc;
        border-radius: 20px;
        transition: border-color 0.3s, box-shadow 0.3s;
        width: 95%;
        margin-bottom: 15px;
        
    }
    .password-container {
        position: relative;
    }
    .show_password {
        position: absolute;
        right: 25px;
        top: 55%;
        transform: translateY(-50%);
        cursor: pointer;
        display: flex;
        align-items: center;
        svg {
            width: 18px;
            height: 18px;
            fill: #5f6368;
        }
    }
    .signUpLink {
        text-align: center;
        a {
            text-decoration: none;
            color: #d54050;
            display: block;
            margin-top: 10px;
            font-size: 14px;
        }

    }
    .button {
        background-color: #128f8b;
        color: white;
        border: none;
        padding: 10px 20px;
        font-size: 15px;
        border-radius: 20px;
        transition: background-color 0.3s, transform 0.3s;
        cursor: pointer;
        
        width: 95%;
        margin-top: 10px;
    }
    .button:hover {
		background-color: #5F9EA0;
		transform: translateY(-1px);
	}
    .button:active {
        background-color: #097969;
		transform: translateY(1px);
    }
    .iconsDiv {
        position: relative;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        img {
            position: absolute;
            top: 0;
            left: 0;
            pointer-events: none;
            -webkit-filter: drop-shadow(1px 1px 5px #000000);
            filter: drop-shadow(5px 5px 5px #0000002f);
        }
    }
    #doc, #pdf, #ppt, #folder {
        position: absolute;
    }
    #doc {
        width: 300px;
        top: 10%;
        left: 85%;
    }
    #pdf {
        width: 220px;
        top: 60%;
        left: 87%;
    }
    #ppt {
        width: 280px;
        top: 10%;
        left: -3.5%;
    }
    #folder {
        width: 220px;
        top: 55%;
        left: -1%;
    }
</style>
<body>
    <img src="img/ppt.png" id="ppt">
    <img src="img/folder.png" id="folder">
    <img src="img/doc.png" id="doc">
    <img src="img/pdf.png" id="pdf">

    <div class="mainDiv">
        <div class="div1">
            <div>
                <img src="img/logo.png" id="logo">
            </div>
            <div>
                <a href="parallax.php"><svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 -960 960 960" width="20px" fill="#128f8b"><path d="m313-440 224 224-57 56-320-320 320-320 57 56-224 224h487v80H313Z"/></svg></a>    
            </div>
        </div>

        <div class="div2">
            <p>Admin Sign in</p>
        </div>

        <div class="div3">
            <form action="remote/adminLogIn.php" method="POST">

                <label for="adminName" >Username:</label>
                <input type="text" id="admin_username" name="admin_username" placeholder="Enter your username" required />

                <div class="password-container">
                    <label for="password">Password:</label>
                    <input type="password" id="admin_password" name="admin_password" placeholder="Enter at least 8 characters" required />
                    <a class="show_password" onclick="togglePassword()">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#5f6368">
                            <path d="m644-428-58-58q9-47-27-88t-93-32l-58-58q17-8 34.5-12t37.5-4q75 0 127.5 52.5T660-500q0 20-4 37.5T644-428Zm128 126-58-56q38-29 67.5-63.5T832-500q-50-101-143.5-160.5T480-720q-29 0-57 4t-55 12l-62-62q41-17 84-25.5t90-8.5q151 0 269 83.5T920-500q-23 59-60.5 109.5T772-302Zm20 246L624-222q-35 11-70.5 16.5T480-200q-151 0-269-83.5T40-500q21-53 53-98.5t73-81.5L56-792l56-56 736 736-56 56ZM222-624q-29 26-53 57t-41 67q50 101 143.5 160.5T480-280q20 0 39-2.5t39-5.5l-36-38q-11 3-21 4.5t-21 1.5q-75 0-127.5-52.5T300-500q0-11 1.5-21t4.5-21l-84-82Zm319 93Zm-151 75Z"/>
                        </svg>
                    </a>
                </div>

                <input class="button" type="submit" value="Sign in" name="admin_logIn"></input>

                <div class="signUpLink">
                    <a href="adminSignUp.php">Don't have an account? Sign up</a>
                </div>

                
            </form>
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById("admin_password");
            const icon = document.querySelector(".show_password");

            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                icon.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed"><path d="M480-320q75 0 127.5-52.5T660-500q0-75-52.5-127.5T480-680q-75 0-127.5 52.5T300-500q0 75 52.5 127.5T480-320Zm0-72q-45 0-76.5-31.5T372-500q0-45 31.5-76.5T480-608q45 0 76.5 31.5T588-500q0 45-31.5 76.5T480-392Zm0 192q-146 0-266-81.5T40-500q54-137 174-218.5T480-800q146 0 266 81.5T920-500q-54 137-174 218.5T480-200Zm0-300Zm0 220q113 0 207.5-59.5T832-500q-50-101-144.5-160.5T480-720q-113 0-207.5 59.5T128-500q50 101 144.5 160.5T480-280Z"/></svg>';
            } else {
                passwordInput.type = "password";
                icon.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#5f6368"><path d="m644-428-58-58q9-47-27-88t-93-32l-58-58q17-8 34.5-12t37.5-4q75 0 127.5 52.5T660-500q0 20-4 37.5T644-428Zm128 126-58-56q38-29 67.5-63.5T832-500q-50-101-143.5-160.5T480-720q-29 0-57 4t-55 12l-62-62q41-17 84-25.5t90-8.5q151 0 269 83.5T920-500q-23 59-60.5 109.5T772-302Zm20 246L624-222q-35 11-70.5 16.5T480-200q-151 0-269-83.5T40-500q21-53 53-98.5t73-81.5L56-792l56-56 736 736-56 56ZM222-624q-29 26-53 57t-41 67q50 101 143.5 160.5T480-280q20 0 39-2.5t39-5.5l-36-38q-11 3-21 4.5t-21 1.5q-75 0-127.5-52.5T300-500q0-11 1.5-21t4.5-21l-84-82Zm319 93Zm-151 75Z"/></svg>';
            }
        }
    </script>
</body>

</html>
