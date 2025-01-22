<?php include_once '../controller/navbar.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send Code</title>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/@emailjs/browser@4/dist/email.min.js"></script>
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    <script type="text/javascript">
        (function() {
            emailjs.init({
                publicKey: "YapnH3TLMZpc_7AHM",
            });
        })();

        document.addEventListener('DOMContentLoaded', applySidebarState);
    </script>

    <style>
        #sidebar ul li #accountSettings {
            color: var(--accent-clr);

            svg {
                fill: var(--accent-clr);
            }
        }

        .title>div:first-child {
            margin-bottom: 40px;
        }

        #verificationCode {
            padding: 10px;
            border-radius: 3px;
            border: 1px solid gray;
        }

        .button,
        #resendButton {
            background-color: #128f8b;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 20px;
            cursor: pointer;
        }

        #resendButton {
            background-color: gray;
        }
    </style>
</head>

<body>
    <main>
        <div class="container">
            <form action="editAccount.php" method="POST" id="editForm">
                <?php
                // Check if the admin password and email are set in the URL
                if (isset($_GET['admin_password']) && isset($_GET['admin_email'])) {
                    $admin_password = mysqli_real_escape_string($conn, $_GET['admin_password']);
                    $admin_email = mysqli_real_escape_string($conn, $_GET['admin_email']);

                    // Generate a random 6-digit code
                    $verification_code = rand(100000, 999999);

                    // Store the verification code in the session (if needed for PHP verification)
                    $_SESSION['verification_code'] = $verification_code;
                ?>

                    <div class="title">
                        <div>
                            <a href="accountSettings.php">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    height="20px"
                                    viewBox="0 -960 960 960"
                                    width="20px"
                                    fill="#128f8b">
                                    <path d="m313-440 224 224-57 56-320-320 320-320 57 56-224 224h487v80H313Z" />
                                </svg>
                            </a>
                        </div>
                        <div>
                            <h1>We've sent a 6-digit code to your email</h1> <br>
                        </div>
                    </div>

                    <input type="hidden" id="admin_password" name="admin_password" value="<?php echo $admin_password ?>" required />
                    <input type="hidden" id="admin_email" name="admin_email" value="<?php echo $admin_email ?>" required />

                    <label for="verificationCode">Enter 6-digit code:</label>
                    <input type="text" id="verificationCode" name="verificationCode" placeholder="6-digit code" maxlength="6" pattern="^\d{6}$" required />

                    <button class="button" type="submit" id="submitContact" name="sendCodes">
                        Submit
                    </button>

                    <button type="button" id="resendButton" onclick="sendVerificationCode()" disabled>Resend Code</button>
                    <p id="timerText" style="display:none;">Please wait <span id="timer"></span> before resending.</p>

                    <script type="text/javascript">
                        // Send the verification code to the admin's email using EmailJS
                        function sendVerificationCode() {
                            emailjs.send("service_o10ztq4", "template_hzmrerc", {
                                to_email: '<?php echo $admin_email; ?>',
                                verification_code: '<?php echo $verification_code; ?>'
                            }).then(function(response) {
                                console.log('SUCCESS!', response);
                                Swal.fire({
                                    icon: 'success',
                                    title: '6-digit code sent!',
                                    text: 'A 6-digit code has been sent to your email.'
                                }).then((result) => {
                                    if (result.isConfirmed || result.isDismissed) {
                                        startTimer();
                                    }
                                });
                            }).catch(function(error) {
                                console.log('FAILED...', error);
                                alert('Failed to send email: ' + error.text);
                            });
                        }

                        // JavaScript function to compare the entered code with the sent code
                        document.getElementById("editForm").addEventListener("submit", function(event) {
                            var enteredCode = document.getElementById("verificationCode").value;
                            var storedCode = '<?php echo $_SESSION['verification_code']; ?>'; // Fetch the stored code from PHP

                            // Compare the entered code with the stored code
                            if (enteredCode !== storedCode) {
                                event.preventDefault(); // Prevent form submission
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Incorrect Code!',
                                    text: 'The 6-digit verification code is incorrect.'
                                });
                            }
                        });

                        // Start the countdown timer (5 minutes = 300 seconds)
                        var countdown;

                        function startTimer() {
                            var countdownValue = 30; // Set to 300 seconds for 5 minutes
                            document.getElementById("resendButton").disabled = true; // Disable resend button
                            document.getElementById("timerText").style.display = "block"; // Show the timer message

                            countdown = setInterval(function() {
                                var minutes = Math.floor(countdownValue / 60);
                                var seconds = countdownValue % 60;

                                // Format time as minutes and seconds
                                var timeDisplay = minutes + " minute" + (minutes !== 1 ? "s" : "") + " " + seconds + " second" + (seconds !== 1 ? "s" : "");
                                document.getElementById("timer").textContent = timeDisplay;

                                countdownValue--;

                                if (countdownValue < 0) {
                                    clearInterval(countdown); // Stop the timer
                                    document.getElementById("resendButton").disabled = false; // Enable resend button
                                    document.getElementById("timerText").style.display = "none"; // Hide the timer message
                                }
                            }, 1000); // Update the timer every second
                        }

                        // Trigger the initial email send when the page loads
                        sendVerificationCode();
                    </script>

                <?php } ?>
            </form>
        </div>
    </main>

</body>

</html>