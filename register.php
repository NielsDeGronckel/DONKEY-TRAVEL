<?php
require 'database.php';

// Check if the user is trying to register a new account
if (isset($_POST['register'])) {
    // Get the submitted form data
    $username = $_POST['username'];
    $email = $_POST['email'];
    $telefoon = $_POST['telefoon'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    //sessions for registerform repopulation
    $_SESSION['usernamePost'] = $_POST['username'];
    $_SESSION['emailPost'] = $_POST['email'];
    $_SESSION['telefoonPost'] = $_POST['telefoon'];
    $_SESSION['passwordPost'] = $_POST['password'];
    $_SESSION['confirm_passwordPost'] = $_POST['confirm_password'];


    // Check if the username is already taken
    $check_username = $conn->prepare("SELECT * FROM klanten WHERE username=:username");
    $check_username->bindParam(':username', $username);
    $check_username->execute();
    if ($check_username->rowCount() > 0) {
        $_SESSION['message'] = "<p class='messageRed'>Sorry, that username is already taken.</p>";
        header("Location: registerForm.php");
    }

    // Check if the email is already in use
    $check_email = $conn->prepare("SELECT * FROM klanten WHERE email=:email");
    $check_email->bindParam(':email', $email);
    $check_email->execute();
    if ($check_email->rowCount() > 0) {
        $_SESSION['message'] = '<p class="messageRed">Sorry, that email is already in use.';
        header("Location: registerForm.php");
    }

    // Check if the password and confirm password fields match
    if ($password != $confirm_password) {
        $_SESSION['message'] = '<p class="messageRed">Sorry, the passwords do not match</p>';
        header("Location: registerForm.php");    }

    // check if there is any inapropriate word in the username or the email
    $inapropriate_words = array("slet", "kont", "bil", "ass", "booty", "neuk", "auti", "autist", "flikker", "dildo", "kkr", "lukas", "fuck", "hell","crap", "damn", "ass", "hoe", "hoer", "whore", "kanker", "kut", "tering" , "shite", "nigger", "nigga" ,"shit", "bitch");
    foreach($inapropriate_words as $word){
        if (strpos($username, $word) !== false || strpos($email, $word) !== false) {
            $_SESSION['message'] = '<p class="messageRed">Sorry, inapropriate word found in username or email.</p>';
            header("Location: registerForm.php");
        }
    }
    //check if character contains special characters
    if (!preg_match('/^[a-zA-Z0-9]*$/', $username) || preg_match('/[!@#$%^&*()+{}\[\]:;<>,.?~\\]/', $username)) {
        $_SESSION['message'] = '<p class="messageRed">No special characters allowed.</p>';
            header("Location: registerForm.php");
        }
    // If all validation checks pass, insert the new user into the database
    if ($check_username->rowCount() == 0 && $check_email->rowCount() == 0 && $password == $confirm_password) {
        $password = password_hash($password, PASSWORD_DEFAULT);
        $query = $conn->prepare("INSERT INTO klanten (username, email, password, telefoon) VALUES (:username, :email, :password, :telefoon)");
        $query->bindParam(':username', $username);
        $query->bindParam(':email', $email);
        $query->bindParam(':telefoon', $telefoon);
        $query->bindParam(':password', $password);
        $query->execute();
        if ($query->rowCount() > 0) {
            $_SESSION['message'] = '<p class="messageGreen">Account created successfully!</p>';

            header("Location: loginForm.php");
        } else {
            $_SESSION['message'] = '<p class="messageRed">An error occurred while creating your account.</p>';

            header("Location: loginForm.php");
        }
    }
}


?>