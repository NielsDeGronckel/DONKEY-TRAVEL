<?php
// require 'database.php';
require 'Klant.php';

if (isset($_POST['register'])) {

    // Get the submitted form data
    $klantNaam = $_POST['klantNaam'];
    $klantEmail = $_POST['klantEmail'];
    $klantAdres = $_POST['klantAdres'];
    $klantPostcode = $_POST['klantPostcode'];
    $klantWoonplaats = $_POST['klantWoonplaats'];

    // check if there is any inapropriate word in the username or the email
    $inapropriate_words = array("fuck", "hell","crap", "damn", "ass", "hoe", "whore", "kanker", "kut", "tering" , "shite", "nigger", "nigga" ,"shit", "bitch");
    foreach($inapropriate_words as $word){
        if (strpos($klantNaam, $word) !== false || strpos($klantEmail, $word) !== false) {
            echo "Sorry, inapropriate word found.";
            
        }
    }

    // If all validation checks pass, insert the new user into the database
    $klant1 = new Klant($klantNaam, $klantEmail, $klantAdres, $klantPostcode, $klantWoonplaats);
    $klant1->createKlant();
    
    // var_dump($student1);
    $klant1->afdrukken();
}
?>