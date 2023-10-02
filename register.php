<?php
require 'database.php';
// Check if the user is trying to register a new account
if (isset($_POST['register'])) {

    // Get the submitted form data
    $surName = $_POST['surName'];
    $lastName = $_POST['lastName'];
    $functie = $_POST['functie'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Check if the username is already taken
    $check_username = $conn->prepare("SELECT * FROM medewerkers WHERE username=:username");
    $check_username->bindParam(':username', $username);
    $check_username->execute();
    if ($check_username->rowCount() > 0) {
        $_SESSION['message'] = "Sorry, that username is already taken.";
        header("Location: registerForm.php");
    }

    // Check if the email is already in use
    $check_email = $conn->prepare("SELECT * FROM medewerkers WHERE email=:email");
    $check_email->bindParam(':email', $email);
    $check_email->execute();
    if ($check_email->rowCount() > 0) {
        $_SESSION['message'] = 'Sorry, that email is already in use.';
        header("Location: registerForm.php");
    }

    // Check if the password and confirm password fields match
    if ($password != $confirm_password) {
        $_SESSION['message'] = "Sorry, the passwords do not match.";
        header("Location: registerForm.php");
    }

    // check if there is any inapropriate word in the username or the email
    $inapropriate_words = array("fuck", "hell","crap", "damn", "ass", "hoe", "whore", "kanker", "kut", "tering" , "shite", "nigger", "nigga" ,"shit", "bitch");
    foreach($inapropriate_words as $word){
        if (strpos($username, $word) !== false || strpos($email, $word) !== false) {
            echo "Sorry, inapropriate word found.";
            
        }
    }

    // If all validation checks pass, insert the new user into the database
    if ($check_username->rowCount() == 0 && $check_email->rowCount() == 0 && $password == $confirm_password) {
        $password = password_hash($password, PASSWORD_DEFAULT);
        $query = $conn->prepare("INSERT INTO medewerkers (surName, lastName, functie, username, email, password) VALUES (:surName, :lastName, :functie, :username, :email, :password)");
        $query->bindParam(':surName', $surName);
        $query->bindParam(':lastName', $lastName);
        $query->bindParam(':functie', $functie);
        $query->bindParam(':username', $username);
        $query->bindParam(':email', $email);
        $query->bindParam(':password', $password);
        $query->execute();
        if ($query->rowCount() > 0) {
            $_SESSION['message'] = 'Account created successfully!';

            header("Location: loginForm.php");
        } else {
            $_SESSION['message'] = 'An error occurred while creating your account.';

            header("Location: loginForm.php");
        }
    }
}


?>
