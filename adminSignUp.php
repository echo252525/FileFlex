<!DOCTYPE html>
<!-- Created By CodingNepal -->
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>Admin Sign Up</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="icon" href="img/favicon.png" type="image/png">
</head>

<body>
    <img src="img/ppt.png" id="ppt">
    <img src="img/folder.png" id="folder">
    <img src="img/doc.png" id="doc">
    <img src="img/pdf.png" id="pdf">

    <div class="container">
        <div class="div1">
            <div>
                <img src="img/logo.png" id="logo">
            </div>
            <div>
                <a href="parallax.php"><svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 -960 960 960" width="20px" fill="#128f8b">
                        <path d="m313-440 224 224-57 56-320-320 320-320 57 56-224 224h487v80H313Z" />
                    </svg></a>
            </div>
        </div>
        <header>Admin Sign Up </header>
        <div class="progress-bar">
            <div class="step">
                <p>Name</p>
                <div class="bullet"> <span>1</span> </div>
                <div class="check fas fa-check"></div>
            </div>
            <div class="step">
                <p>Contact</p>
                <div class="bullet"><span>2</span></div>
                <div class="check fas fa-check"></div>
            </div>
            <div class="step">
                <p>Password</p>
                <div class="bullet"><span>3</span></div>
                <div class="check fas fa-check"></div>
            </div>
            <div class="step">
                <p>Profile</p>
                <div class="bullet"><span>4</span></div>
                <div class="check fas fa-check"></div>
            </div>
        </div>

        <div class="form-outer">
            <form id="myForm" action="remote/adminSignUp.php" method="POST" enctype="multipart/form-data">
                <div class="page slide-page">
                    <div class="title">
                        Basic Information
                    </div>
                    <div class="field">
                        <div class="label">
                            Full name:
                        </div>
                        <input type="text" id="admin_name" name="admin_name" placeholder="Firstname M.I. Lastname" required />
                    </div>
                    <div class="field">
                        <div class="label">
                            Username:
                        </div>
                        <input type="text" id="admin_username" name="admin_username" placeholder="Enter your username" required />
                    </div>
                    <div class="field">
                        <button id="nextBtn" class="firstNext next">Next</button>
                    </div>
                </div>
                <div class="page">
                    <div class="title">
                        Contact Infomation
                    </div>
                    <div class="field">
                        <div class="label">
                            Email Address:
                        </div>
                        <input type="email" id="admin_email" name="admin_email" placeholder="example@gmail.com" required />
                    </div>
                    <div class="field">
                        <div class="label">
                            Mobile Number:
                        </div>
                        <input type="number" id="admin_contact" name="admin_contact" maxlength="11" placeholder="0999 999 9999" required />
                    </div>
                    <div class="field btns">
                        <button class="prev-1 prev">Previous</button>
                        <button id="nextBtn2" class="next-1 next">Next</button>
                    </div>
                </div>

                <div class="page">
                    <div class="title">
                        Password
                    </div>
                    <div class="field">
                        <div class="label">
                            Create Password:
                        </div>
                        <input type="password" id="admin_password" name="admin_password" placeholder="Enter at least 8 characters" required />
                        <a class="show_password" onclick="togglePassword()" alt="Show password"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#5f6368">
                                <path d="m644-428-58-58q9-47-27-88t-93-32l-58-58q17-8 34.5-12t37.5-4q75 0 127.5 52.5T660-500q0 20-4 37.5T644-428Zm128 126-58-56q38-29 67.5-63.5T832-500q-50-101-143.5-160.5T480-720q-29 0-57 4t-55 12l-62-62q41-17 84-25.5t90-8.5q151 0 269 83.5T920-500q-23 59-60.5 109.5T772-302Zm20 246L624-222q-35 11-70.5 16.5T480-200q-151 0-269-83.5T40-500q21-53 53-98.5t73-81.5L56-792l56-56 736 736-56 56ZM222-624q-29 26-53 57t-41 67q50 101 143.5 160.5T480-280q20 0 39-2.5t39-5.5l-36-38q-11 3-21 4.5t-21 1.5q-75 0-127.5-52.5T300-500q0-11 1.5-21t4.5-21l-84-82Zm319 93Zm-151 75Z" />
                            </svg></a>
                    </div>
                    <div class="field">
                        <div class="label">
                            Confirm Password:
                        </div>
                        <input type="password" id="admin_confirmPassword" name="admin_confirmPassword" placeholder="Confirm your password" required />
                        <a class="show_confirmPassword" onclick="toggleConfirmPassword()" alt="Show Confirm password"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#5f6368">
                                <path d="m644-428-58-58q9-47-27-88t-93-32l-58-58q17-8 34.5-12t37.5-4q75 0 127.5 52.5T660-500q0 20-4 37.5T644-428Zm128 126-58-56q38-29 67.5-63.5T832-500q-50-101-143.5-160.5T480-720q-29 0-57 4t-55 12l-62-62q41-17 84-25.5t90-8.5q151 0 269 83.5T920-500q-23 59-60.5 109.5T772-302Zm20 246L624-222q-35 11-70.5 16.5T480-200q-151 0-269-83.5T40-500q21-53 53-98.5t73-81.5L56-792l56-56 736 736-56 56ZM222-624q-29 26-53 57t-41 67q50 101 143.5 160.5T480-280q20 0 39-2.5t39-5.5l-36-38q-11 3-21 4.5t-21 1.5q-75 0-127.5-52.5T300-500q0-11 1.5-21t4.5-21l-84-82Zm319 93Zm-151 75Z" />
                            </svg></a>
                    </div>
                    <div class="field btns">
                        <button class="prev-2 prev">Previous</button>
                        <button id="nextBtn3" class="next-2 next">Next</button>
                    </div>
                </div>
                <div class="page">


                    <div class="card">
                        <img src="img/icon1.png" id="profile_pic">
                        <label for="admin_profile">Upload Profile Picture</label>
                        <input type="file" id="admin_profile" name="admin_profile" accept="image/*" required />
                    </div>

                    <div class="field btns">
                        <button class="prev-3 prev">Previous</button>
                        <input id="nextBtn4" class="button" type="submit" value="Sign Up" name="admin_signUp"></input>
                    </div>

                </div>

        </div>
        </form>
        <div class="signUpLink">
            <a href="index.php">Already have an account? Sign in</a>
        </div>
    </div>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

        * {
            margin: 0;
            padding: 0;
            outline: none;
            font-family: Poppins, 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333
        }

        body {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            overflow: hidden;
            background: #f9f9f9;
        }

        .div1 {
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid #d9d9d9;
            padding-bottom: 10px;
            margin-bottom: 20px;

            img {
                width: 70px;
            }
        }

        ::selection {
            color: #fff;
            background: #128f8b;
        }

        .container {
            width: 30%;
            background: #fff;
            border-radius: 20px;
            box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;
            padding: 30px;
        }

        .container header {
            font-size: 25px;
            font-weight: 600;

        }

        .container .form-outer {
            width: 100%;
            overflow: hidden;
        }

        .container .form-outer form {
            display: flex;
            width: 400%;
        }

        .form-outer form .page {
            width: 25%;
            transition: margin-left 0.3s ease-in-out;
        }

        .form-outer form .page .title {
            text-align: center;
            font-size: 25px;
            font-weight: 500;

        }

        .form-outer form .page .field {
            width: 100%;
            height: 45px;
            margin: 45px 0px 0px 0px;
            display: flex;
            position: relative;
        }

        form .page .field .label {
            position: absolute;
            top: -22px;
        }

        form .page .field input.button {
            width: 100%;
            height: calc(100% + 5px);
            border: none;
            background: #128f8b;
            margin-top: -20px;
            border-radius: 20px;
            color: #fff;
            cursor: pointer;
            font-size: 15px;
            letter-spacing: 1px;
            text-transform: uppercase;
            transition: 0.5s ease;
        }

        form .page .field input {
            height: 100%;
            width: 100%;
            border: 1px solid #ccc;
            border-radius: 20px;
            padding-left: 15px;
        }

        #nextBtn4 {
            padding-left: 0px;
        }

        form .page .field select {
            width: 100%;
            padding-left: 10px;
            font-size: 17px;
            font-weight: 500;
        }

        form .page .field button {
            width: 100%;
            height: calc(100% + 5px);
            border: none;
            background: #128f8b;
            margin-top: -20px;
            border-radius: 20px;
            color: #fff;
            cursor: pointer;
            font-size: 15px;

            letter-spacing: 1px;
            text-transform: uppercase;
            transition: 0.5s ease;
        }



        form .page .field button:hover {
            background-color: #5F9EA0;
            transform: translateY(-1px);
        }

        form .page .btns button {
            margin-top: -20px !important;
        }

        form .page .btns button.prev {
            margin-right: 3px;
            font-size: 15px;
        }

        form .page .btns button.next {
            margin-left: 3px;
        }

        .container .progress-bar {
            display: flex;
            margin: 25px 0;
            user-select: none;
        }

        .container .progress-bar .step {
            text-align: center;
            width: 100%;
            position: relative;
        }

        .container .progress-bar .step p {
            font-size: 15px;
            color: #000;
            margin-bottom: 8px;
        }

        .progress-bar .step .bullet {
            height: 25px;
            width: 25px;
            border: 1px solid #000;
            display: inline-block;
            border-radius: 50%;
            position: relative;
            transition: 0.2s;
            font-weight: 500;
            font-size: 17px;
            line-height: 25px;
        }

        .progress-bar .step .bullet.active {
            border-color: #128f8b;
            background: #128f8b;
        }

        .progress-bar .step .bullet span {
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
        }

        .progress-bar .step .bullet.active span {
            display: none;
        }

        .progress-bar .step .bullet:before,
        .progress-bar .step .bullet:after {
            position: absolute;
            content: '';
            bottom: 12px;
            right: -81px;
            height: 1px;
            width: 74px;
            background: #262626;
        }

        .progress-bar .step .bullet.active:after {
            background: #128f8b;
            transform: scaleX(0);
            transform-origin: left;
            animation: animate 0.3s linear forwards;
        }

        @keyframes animate {
            100% {
                transform: scaleX(1);
            }
        }

        .progress-bar .step:last-child .bullet:before,
        .progress-bar .step:last-child .bullet:after {
            display: none;
        }

        .progress-bar .step p.active {
            color: #128f8b;
            transition: 0.2s linear;
        }

        .progress-bar .step .check {
            position: absolute;
            left: 50%;
            top: 70%;
            font-size: 15px;
            transform: translate(-50%, -50%);
            display: none;
        }

        .progress-bar .step .check.active {
            display: block;
            color: #fff;
        }

        #doc,
        #pdf,
        #ppt,
        #folder {
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

        .password-container,
        .confirm-password-container {
            position: relative;
        }

        .show_password,
        .show_confirmPassword {
            position: absolute;
            right: 12px;
            top: 54%;
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

        .card {
            display: grid;
            place-items: center;

            img {
                width: 130px;
                height: 130px;
                border-radius: 50%;
            }

            label {
                background-color: white;
                border: 1px solid #128f8b;
                display: block;
                color: #128f8b;
                padding: 6px 20px;
                font-size: 13px;
                border-radius: 20px;
                transition: background-color 0.3s, transform 0.3s;
                cursor: pointer;
                margin: 25px 0px 30px 0px;
                text-align: center;
            }

            input {
                display: none;
            }
        }

        .signUpLink {
            text-align: center;
            width: 100%;
            color: #d54050;

            a {
                text-decoration: none;
                color: #d54050;
                font-size: 14px;
            }
        }

        input[type="number"]::-webkit-outer-spin-button,
        input[type="number"]::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
    </style>
    <script>
        const slidePage = document.querySelector(".slide-page");
        const nextBtnFirst = document.querySelector(".firstNext");
        const prevBtnSec = document.querySelector(".prev-1");
        const nextBtnSec = document.querySelector(".next-1");
        const prevBtnThird = document.querySelector(".prev-2");
        const nextBtnThird = document.querySelector(".next-2");
        const prevBtnFourth = document.querySelector(".prev-3");
        const submitBtn = document.querySelector(".submit");
        const progressText = document.querySelectorAll(".step p");
        const progressCheck = document.querySelectorAll(".step .check");
        const bullet = document.querySelectorAll(".step .bullet");
        let current = 1;



        nextBtnFirst.addEventListener("click", function(event) {
            const admin_name = document.getElementById('admin_name');
            const admin_username = document.getElementById('admin_username');
            const usernamePattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*()_+=[\]{}|;:'",.<>?/\\-]).{3,20}$/;



            if (!admin_name.value.trim() || !admin_name.value.trim()) {
                nextBtnFirst.setAttribute("onclick", "check()");
                event.preventDefault();
            } else if (!admin_username.value.trim() || !(usernamePattern.test(admin_username.value.trim()))) {
                nextBtnFirst.setAttribute("onclick", "userNameCheck()");
                event.preventDefault();
            } else {
                nextBtnFirst.setAttribute("onclick", "");
                event.preventDefault();
                slidePage.style.marginLeft = "-25%";
                bullet[current - 1].classList.add("active");
                progressCheck[current - 1].classList.add("active");
                progressText[current - 1].classList.add("active");
                current += 1;
            }
        });
        nextBtnSec.addEventListener("click", function(event) {
            const admin_email = document.getElementById('admin_email');
            const admin_contact = document.getElementById('admin_contact');
            const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
            const contactPattern = /^(\d{11})$/;

            if (!admin_email.value.trim() || !admin_contact.value.trim()) {
                nextBtnSec.setAttribute("onclick", "check()");
                event.preventDefault();
            } else if (!admin_email.value.trim() || !emailPattern.test(admin_email.value.trim())) {
                nextBtnSec.setAttribute("onclick", "emailCheck()");
                event.preventDefault();
            } else if (!admin_contact.value.trim() || !contactPattern.test(admin_contact.value.trim())) {
                nextBtnSec.setAttribute("onclick", "contactCheck()");
                event.preventDefault();
            } else {
                nextBtnSec.setAttribute("onclick", "");
                event.preventDefault();
                slidePage.style.marginLeft = "-50%";
                bullet[current - 1].classList.add("active");
                progressCheck[current - 1].classList.add("active");
                progressText[current - 1].classList.add("active");
                current += 1;
            }
        });

        nextBtnThird.addEventListener("click", function(event) {
            const admin_password = document.getElementById('admin_password');
            const admin_confirmPassword = document.getElementById('admin_confirmPassword');
            const passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*()_+=[\]{}|;:'",.<>?/\\-]).{3,20}$/;
            if (!admin_password.value.trim() || !admin_confirmPassword.value.trim()) {
                nextBtnThird.setAttribute("onclick", "check()");
                event.preventDefault();
            } else if (!admin_password.value.trim() || !admin_confirmPassword.value.trim() || (admin_password.value.trim() !== admin_confirmPassword.value.trim())) {
                nextBtnThird.setAttribute("onclick", "isPassMatch()");
                event.preventDefault();
            } else if (!passwordPattern.test(admin_password.value.trim()) || !passwordPattern.test(admin_confirmPassword.value.trim())) {
                nextBtnThird.setAttribute("onclick", "invalidPass()");
                event.preventDefault();
            } else {
                nextBtnThird.setAttribute("onclick", "");
                event.preventDefault();
                slidePage.style.marginLeft = "-75%";
                bullet[current - 1].classList.add("active");
                progressCheck[current - 1].classList.add("active");
                progressText[current - 1].classList.add("active");
                current += 1;
            }
        });

        prevBtnSec.addEventListener("click", function(event) {
            event.preventDefault();
            slidePage.style.marginLeft = "0%";
            bullet[current - 2].classList.remove("active");
            progressCheck[current - 2].classList.remove("active");
            progressText[current - 2].classList.remove("active");
            current -= 1;
        });
        prevBtnThird.addEventListener("click", function(event) {
            event.preventDefault();
            slidePage.style.marginLeft = "-25%";
            bullet[current - 2].classList.remove("active");
            progressCheck[current - 2].classList.remove("active");
            progressText[current - 2].classList.remove("active");
            current -= 1;
        });
        prevBtnFourth.addEventListener("click", function(event) {
            event.preventDefault();
            slidePage.style.marginLeft = "-50%";
            bullet[current - 2].classList.remove("active");
            progressCheck[current - 2].classList.remove("active");
            progressText[current - 2].classList.remove("active");
            current -= 1;
        });

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

        function toggleConfirmPassword() {
            const ConfirmPasswordInput = document.getElementById("admin_confirmPassword");
            const icon2 = document.querySelector(".show_confirmPassword");

            if (ConfirmPasswordInput.type === "password") {
                ConfirmPasswordInput.type = "text";
                icon2.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed"><path d="M480-320q75 0 127.5-52.5T660-500q0-75-52.5-127.5T480-680q-75 0-127.5 52.5T300-500q0 75 52.5 127.5T480-320Zm0-72q-45 0-76.5-31.5T372-500q0-45 31.5-76.5T480-608q45 0 76.5 31.5T588-500q0 45-31.5 76.5T480-392Zm0 192q-146 0-266-81.5T40-500q54-137 174-218.5T480-800q146 0 266 81.5T920-500q-54 137-174 218.5T480-200Zm0-300Zm0 220q113 0 207.5-59.5T832-500q-50-101-144.5-160.5T480-720q-113 0-207.5 59.5T128-500q50 101 144.5 160.5T480-280Z"/></svg>';
            } else {
                ConfirmPasswordInput.type = "password";
                icon2.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#5f6368"><path d="m644-428-58-58q9-47-27-88t-93-32l-58-58q17-8 34.5-12t37.5-4q75 0 127.5 52.5T660-500q0 20-4 37.5T644-428Zm128 126-58-56q38-29 67.5-63.5T832-500q-50-101-143.5-160.5T480-720q-29 0-57 4t-55 12l-62-62q41-17 84-25.5t90-8.5q151 0 269 83.5T920-500q-23 59-60.5 109.5T772-302Zm20 246L624-222q-35 11-70.5 16.5T480-200q-151 0-269-83.5T40-500q21-53 53-98.5t73-81.5L56-792l56-56 736 736-56 56ZM222-624q-29 26-53 57t-41 67q50 101 143.5 160.5T480-280q20 0 39-2.5t39-5.5l-36-38q-11 3-21 4.5t-21 1.5q-75 0-127.5-52.5T300-500q0-11 1.5-21t4.5-21l-84-82Zm319 93Zm-151 75Z"/></svg>';
            }
        }

        let profilePic = document.getElementById('profile_pic');
        let inputFile = document.getElementById('admin_profile');

        inputFile.onchange = function() {
            profilePic.src = URL.createObjectURL(inputFile.files[0]);
        }


        // Listen for changes in the input field to dynamically enable/disable the button


        function isPassMatch() {
            Swal.fire({
                icon: 'info',
                title: 'password does not match!',
                text: 'Please ensure that Confirm Password is matched with Password.'
            });
        }

        function invalidPass() {
            Swal.fire({
                icon: 'info',
                title: 'Weak Password!',
                text: 'Password must contain at least one uppercase letter, one lowercase letter, and one special character.'
            });
        }

        function emailCheck() {
            Swal.fire({
                icon: 'info',
                title: 'Invalid Email Adress!',
                text: 'Please ensure that Email Adress is Valid.'
            });
        }

        function contactCheck() {
            Swal.fire({
                icon: 'info',
                title: 'Invalid Contact Number!',
                text: 'Please ensure that Contact Number is Valid. ex. 0999 999 9999.'
            });
        }


        function userNameCheck() {
            Swal.fire({
                icon: 'info',
                title: 'Invalid Username!',
                text: 'Username must contain at least one uppercase letter, one lowercase letter, and one special character.'
            });
        }

        function check() {
            Swal.fire({
                icon: 'info',
                title: 'All Fields Required!',
                text: 'Please fill All Fields.'
            });
        }
    </script>
</body>

</html>