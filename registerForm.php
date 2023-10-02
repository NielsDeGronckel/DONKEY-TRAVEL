<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <?php include("nav.php"); ?>
    <main>
        <div class="content">
            <div class="accountPage">     
                <div class="basCard">
                    <div class="accountItems">
                    <h1>Registreer medewerker:</h1>

                        <div class="accountForm">            
                            <form method="post" id="register" action="register.php">
                                <label for="username">Username:</label>
                                <input type="text" id="username" name="username" required>
                                <p id="usernameMessage"></p>
                                <br>
                                <label for="surName">Voornaam:</label>
                                <input type="text" id="surName" name="surName" required>
                                <br>
                                <label for="lastName">Achternaam:</label>
                                <input type="text" id="lastName" name="lastName" required>
                                <br>
                                <label for="email">Email:</label>
                                <input type="email" id="email" name="email" required>
                                <br>
                                <label for="password">Password:</label>
                                <input type="password" id="password" name="password" required>
                                <br>  
                                
                                
                                <!-- <div class="room">
                                    <button id="warningExplained">
                                    
                                            <i id="infoCircle" class='bx bx-info-circle' ></i>
                                            <p id="warning"><i class='bx bx-error' ></i>WARNING: Please don't fill in any sensitive information. </p>

                                            <h2 id="warningTitle"></h2>
                                            <p id="warningText"></p>
                                            <p id="warningText2"></p>
                                    </button>
                                </div>                     -->

                                <label for="confirm_password">Confirm Password:</label>
                                <input type="password" id="confirm_password" name="confirm_password" required>
                                <p id="passwordMessage"></p>

                                <br>
                                <label for="function">Functie:</label>
                                <br>
                                <select id="function" name="functie">
                                    <option value="verkoper">Verkoper</option>
                                    <option value="inkoper">Inkoper</option>
                                    <option value="bezorger">Bezorger</option>
                                    <option value="magazijnMeester">Magazijn Meester</option>
                                    <option value="magazijnMedewerker">Magazijn Medewerker</option>
                                </select>
                                
                                <div id="messagePHP"><?php

                                    if (isset($_SESSION['message'])) {
                                        echo $_SESSION['message'];
                                        unset($_SESSION['message']);
                                    }
                                    ?>
                                </div>
                                <br>

                                <input type="submit" name="register" value="Create Account">
                            </form>
                        </div>
                    </div>
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
        
        //explained
        // const warning = document.getElementById("warning");
        // const warningExplained = document.getElementById("warningExplained");
        // const warningTitle = document.getElementById("warningTitle");
        // const warningText = document.getElementById("warningText");
        // const warningText2 = document.getElementById("warningText2");
        
        const curseWords = ["fuck", "hell","crap", "damn", "ass", "hoe", "whore", "kanker", "kut", "tering" , "shite", "nigger", "nigga" ,"shit", "bitch"];

      
    //     warningExplained.addEventListener('click', () => {
    //         console.log('testing')
    //         if(isClicked) {
    //             warning.innerHTML = "WARNING: Please don't fill in any sensitive information.";
    //             warningTitle.innerHTML = '';
    //             warningText.innerHTML = '';
    //             warningText2.innerHTML = '';
    //             explained.classList.remove('opened');
    //             isClicked = false;
    //         } else {
    //             warningTitle.innerHTML = "Warning sensitive information";
    //             warningText.innerHTML = "I cannot guarantee that your password is safe. Don't use any repeated password that you might have used before on any account login.";
    //             warningText2.innerHTML = "";
    //             warning.innerHTML = "";
    //             warningExplained.classList.add('opened');
    //             isClicked = true;
    //         }
        
    // });

        // Set maximum username length
        var maxUsernameLength = 12;

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

        // function checkAgreement() {
        //     if (!document.getElementById("agreement").checked) {
        //     alert("You must agree to the warning before submitting the form.");
        //     return false;
        //     }
        //     return true;
        // }
        
//         form.addEventListener("submit", function(event) {
//     if (!warningCheckbox.checked) {
//         alert("You must agree to the warning before submitting the form.");
//         event.preventDefault();
//     }
// });
    </script>
<?php require 'footer.php'?>

</body>
</html>