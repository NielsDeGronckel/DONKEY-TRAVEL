<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Klant Create</title>
</head>
<body>
    <?php require 'nav.php'?>
    <div class="content">
        <div class="accountPage">
            <div class="basCard">
                <div class="accountItems">
                    <h1>Registreer nieuwe klant:</h1>
                    <div class="accountForm">
                        <form method="post" id="register" action="klantCreate.php" class="form">
                            <label for="klantNaam">Name:</label>
                            <input type="text" id="name" name="klantNaam" required>
                            <p id="nameMessage"></p>

                            <label for="klantEmail">Email:</label>
                            <input type="email" id="email" name="klantEmail" required>
                            <br>
                            <label for="klantAdres">Adres:</label>
                            <input type="text" id="adress" name="klantAdres" required>
                            <br>
                            <label for="klantPostcode">Postcode:</label>
                            <input type="text" pattern="[0-9]{4}[A-Z]{2}" title="Five digit zip code" id="postcode" name="klantPostcode" required>
                            <br>
                            <label for="klantWoonplaats">Woonplaats:</label>
                            <input type="text" id="woonplaats" name="klantWoonplaats" required>
                            <br>
                            <!-- <label for="password">Password:</label>
                            <input type="password" id="password" name="password" required>
                            <br>    
                            <label for="confirm_password">Confirm Password:</label>
                            <input type="password" id="confirm_password" name="confirm_password" required>
                            <p id="passwordMessage"></p> -->

                            <div class="submitButton">
                                <input type="submit" name="register" value="Create Client" class="registerClass">
                            </div>
                        </form> 
                        <div class="question">
                            <p><a href="klantRead.php">Klant Read</a> </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <?php require 'footer.php'?>
</body>
<style>
    
input {
    margin-bottom: 5px;
    width: 200px;
    padding: 10px 15px;
    display: flex;
    justify-content: center;
    border-radius: 5px;

}

</style>

<script>
    var form = document.getElementById("register");
    const checkboxMessage = document.getElementById("checkboxMessage");
    const passwordMessage = document.getElementById("passwordMessage");
    const usernameMessage = document.getElementById("usernameMessage");
    const warningCheckbox = document.getElementById("agreement");
    const password = document.getElementById("password");
    const confirmPassword = document.getElementById("confirm_password");
    const usernameInput = document.getElementById("username");
    // Set maximum username length
    var maxUsernameLength = 12;
    // set cursewords
    const curseWords = ["fuck", "hell","crap", "damn", "ass", "hoe", "whore", "kanker", "kut", "tering" , "shite", "nigger", "nigga" ,"shit", "bitch"];


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
</html>