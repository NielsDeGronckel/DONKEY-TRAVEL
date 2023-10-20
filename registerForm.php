<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="assets/style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-4773475340562413"
     crossorigin="anonymous"></script>
</head>
<body>
    <?php include("nav.php"); ?>
    <main>
        <div class="content">
            <div class="registerView"> 
            <h2>Register</h2>  
    
               
                <div class="registerForm">            
                    <form method="post" id="register" action="register.php">
                    <div class="labelInput">
                        <label class="iconField" for="username"><i class='bx bxs-user'></i></label>
                        <input type="text" id="username" name="username" placeholder="Username" value="<?php echo isset($_SESSION['usernamePost']) ? $_SESSION['usernamePost'] : ''; ?>" required>
                        </div>
                        <span id="usernameMessage"></span>
                        <div class="labelInput">
                        <label class="iconField" for="email"><i class='bx bxs-envelope' ></i></label>
                        <input type="text" id="email" name="email" placeholder="email" value="<?php echo isset($_SESSION['emailPost']) ? $_SESSION['emailPost'] : ''; ?>" required>
                        </div>    
                        <div class="labelInput">
                        <label class="iconField" for="telefoon"><i class='bx bxs-phone'></i></label>
                        <input type="tel" id="telefoon" name="telefoon" pattern="[0-9]{10}" max="99999999999" placeholder="1234567890" value="<?php echo isset($_SESSION['telefoonPost']) ? $_SESSION['telefoonPost'] : ''; ?>" required>
                        </div>    
                        <div class="labelInput">
                        <label class="iconField" for="password"><i class='bx bxs-lock-open-alt'></i></label>
                        <input type="password" id="password" name="password" placeholder="Password" value="<?php echo isset($_SESSION['passwordPost']) ? $_SESSION['passwordPost'] : ''; ?>" required>
                        </div>
                        <div class="labelInput">
                        <label class="iconField" for="confirm_password"><i class='bx bxs-lock-alt' ></i></label>
                        <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm Password" value="<?php echo isset($_SESSION['confirm_passwordPost']) ? $_SESSION['confirm_passwordPost'] : ''; ?>" required>
                        </div>
                        <span id="passwordMessage"></span>
                        <span id="checkboxMessage"></span>

                        <div id="messagePHP"><?php

                        if (isset($_SESSION['message'])) {
                            echo $_SESSION['message'];
                            unset($_SESSION['message']);
                        }
                        ?></div>
                        <input type="submit" name="register" value="Create Account" class="submitButton">
                        <p class="redirect">Already have an account? <a href="loginForm.php">Login here<i class='bx bxs-right-arrow-alt'></i></a></p>

                    </form>
                </div>
            </div>
        </div>
    </main>
    <style>
        .registerForm {
            padding: 10px;
            margin: 10px;
        }
        

        input {
             width: 200px;
            padding: 10px 15px;
            margin: 5px 0;
            box-sizing: border-box;
            /* background-image: url('img/gif.gif'); */
        }

        #agreement {
            width: 30px;
        }

      
        select, input {
        width: 200px;
        padding: 10px 15px;
        margin: 5px 0;
        box-sizing: border-box;
        /* background-image: url('img/gif.gif'); */
        background-color: #ffffff7d ;

        border-radius: 10px;
    }
    #update:hover {
        /* input[type="submit"] { */
        background-color: #f23f5f;
    }
    select option {
        /* background-color: #ffc0cb; */
    }
    ::placeholder {
            color: black; /* Text color for the placeholder */
        }

    /* #usernameMessage { */
        span {
        margin: 0;
        padding: 0;
        height: 0;
    }

    </style>
    <script>
                // Get the form element
        var form = document.getElementById("register");
        const checkboxMessage = document.getElementById("checkboxMessage");
        const passwordMessage = document.getElementById("passwordMessage");
        const usernameMessage = document.getElementById("usernameMessage");
        const warningCheckbox = document.getElementById("agreement");
        const password = document.getElementById("password");
        const confirmPassword = document.getElementById("confirm_password");
        
        const usernameInput = document.getElementById("username");
        const emailInput = document.getElementById("email");

        // var usernameCharCount = document.getElementById("username-char-count");
        // var emailCharCount = document.getElementById("email-char-count");

        usernameInput.addEventListener("input", handleInput(usernameInput, 22));
        emailInput.addEventListener("input", handleInput(emailInput, 32));

        //explained
        const warning = document.getElementById("warning");
        const warningExplained = document.getElementById("warningExplained");
        const warningTitle = document.getElementById("warningTitle");
        const warningText = document.getElementById("warningText");
        const warningText2 = document.getElementById("warningText2");
        
        const curseWords = ["slet", "kont", "bil", "ass", "booty", "neuk", "auti", "autist", "flikker", "dildo", "kkr", "lukas", "fuck", "hell","crap", "damn", "ass", "hoe", "hoer", "whore", "kanker", "kut", "tering" , "shite", "nigger", "nigga" ,"shit", "bitch"];

        // Set maximum username length
        var maxUsernameLength = 22;
        
        function handleInput(inputField, maxCharacterLimit) {
            return function() {
                var currentLength = inputField.value.length;

                if (currentLength > maxCharacterLimit) {
                inputField.style.color = "red";
                inputField.value = inputField.value.substring(0, maxCharacterLimit);
                } else {
                inputField.style.color = "black";
                }
            };
        }

        var telefoonInput = document.getElementById("telefoon");

        telefoonInput.addEventListener("input", function() {
        // Remove non-numeric characters
        telefoonInput.value = telefoonInput.value.replace(/\D/g, "");

        // Limit the input to 11 characters
        if (telefoonInput.value.length > 11) {
            telefoonInput.value = telefoonInput.value.slice(0, 11);
        }
        });


        // Add event listener for form submit
        form.addEventListener("submit", function(event) {
            // Get the current username
            var username = usernameInput.value;

            // Check if the username is too long
            if (username.length > maxUsernameLength) {
                // Prevent form from being submitted
                event.preventDefault();
                // Show error message
                usernameMessage.innerHTML = 'The username cannot be longer than ' + maxUsernameLength + ' characters';
                // alert("Sorry, the username cannot be longer than " + maxUsernameLength + " characters.");
            } else if (!warningCheckbox.checked) {
                checkboxMessage.innerHTML = "You must agree to the warning before submitting the form.";
                event.preventDefault();
            } else if (password.value !== confirmPassword.value) {
                passwordMessage.innerHTML = "Passwords do not match. Please try again.";
                event.preventDefault();
            } else {
                    for (var i = 0; i < curseWords.length; i++) {
                        // Check if the input value contains the curse word
                        if (username.indexOf(curseWords[i]) !== -1) {
                            event.preventDefault();

                            // Alert the user that the input contains a curse word
                            usernameMessage.innerHTML ="The username contains a curse word, please enter a different username.";

                            // Clear the input field
                            username.value = "";
                            break;
                        }
                    }
            }
        });


    </script>
<script src="assets/main.js"></script>
</body>
</html>