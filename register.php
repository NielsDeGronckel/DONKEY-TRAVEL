<?php
require 'database/database.php';
require 'Classes/Klant.php';
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

    
    $klant1 = new Klant();
    $klant1->createKlant($username, $email, $telefoon, $password, $confirm_password);


   
}


?>