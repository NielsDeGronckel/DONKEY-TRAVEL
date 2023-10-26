<?php
require 'Classes/Klant.php';

// Check if the form has been submitted via the POST method
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve the values from the form data
    $klantId = $_POST['klantId'];
    $usernameKlant = $_POST['usernameKlant'];
    $email = $_POST['email'];
    $telefoon = $_POST['telefoon'];
    $password = $_POST['password'];
     if (!empty($password)) {
        $password = trim($password);
     }
    // $password = password_hash($password, PASSWORD_DEFAULT);

    //create new instance for the class
    $klant = new Klant();
    
    // Call the updateLeverancier method on the $lev object, passing in the form data as arguments
    // $klant->updateKlant($klantId, $usernameKlant, $email, $telefoon, (!empty($password) ? $password : ));
    $klant->updateKlant($klantId, $usernameKlant, $email, $telefoon, $password);

}
?>