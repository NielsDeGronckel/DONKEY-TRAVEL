<?php
//Lukas Sliva/Zakaria Yekhlef
//13/10/2023




class Klant
{
    // properties
    protected $username;
    protected $email;
    protected $telefoon;
    protected $password;
    protected $rights;
    protected $changed;

    // constructor
    function __construct($username = NULL, $email = NULL, $telefoon = NULL, $password = NULL, $rights = NULL, $changed = NULL)
    {
        $this->username = $username;
        $this->email = $email;
        $this->telefoon = $telefoon;
        $this->password = $password;
        $this->rights = $rights;
        $this->changed = $changed;
    }

    // other methods...

    // create new klant
    public function createKlant()
    {
        require 'database.php';
        $username = $this->get_username();
        $email = $this->get_email();
        $telefoon = $this->get_telefoon();
        $password = $this->get_password();
        $rights = $this->get_rights();
        $changed = $this->get_changed();

        // statement maken voor invoer in de tabel
        $sql = $conn->prepare('INSERT INTO klanten (username, email, telefoon, password, rights, changed) VALUES (:username, :email, :telefoon, :password, :rights, :changed)');

        // Variabelen in de statement zetten
        $sql->bindParam(':username', $username);
        $sql->bindParam(':email', $email);
        $sql->bindParam(':telefoon', $telefoon);
        $sql->bindParam(':password', $password);
        $sql->bindParam(':rights', $rights);
        $sql->bindParam(':changed', $changed);

        $sql->execute();

        // melding
        $_SESSION['message'] = "Klant " . $username . " is toegevoegd! <br>";
        header("Location: klantRead.php");
    }

    // other methods...

    // getters for new properties
    function get_username()
    {
        return $this->username;
    }

    function get_email()
    {
        return $this->email;
    }

    function get_telefoon()
    {
        return $this->telefoon;
    }

    function get_password()
    {
        return $this->password;
    }

    function get_rights()
    {
        return $this->rights;
    }

    function get_changed()
    {
        return $this->changed;
    }


    public function getKlantIdSession($qqleq) {
        // echo 'Username: ' . $qqleq . '<br>';
        // echo '<br>';
        require_once 'pureConnect.php';
        $sql = $conn->prepare('SELECT ID FROM klanten WHERE username = :username');
        $sql->bindParam(':username', $qqleq);
        // $sql->execute([":username" => $pusername]);
        $sql->execute();
        // Fetch the result of the query
        $row = $sql->fetch(PDO::FETCH_ASSOC);
        // echo "<pre> Row: " . print_r($row, true) . "</pre>";

        if ($row) {
            return $row['ID'];
        } else {
            return null; // Return null when Klant ID is not found
        }
    }

    //create new klant
//    public function createKlant() {
//        require 'database.php';
//        $username = $this->get_klantNaam();
//        $email = $this->get_klantEmail();
//        $telefoon = $this->get_telefoon();
//        $rights = $this->get_rights();
//        $changed = $this->get_changed();
//
//        //statement maken voor invoer in de tabel
//        $sql = $conn->prepare('INSERT INTO klanten (klantNaam, klantEmail, klantAdres, klantPostcode, klantWoonplaats) VALUES (:klantNaam, :klantEmail, :klantAdres, :klantPostcode, :klantWoonplaats)');
//
//        //Variabelen in de statement zetten
//        $sql->bindParam(':klantNaam', $klantNaam);
//        $sql->bindParam(':klantEmail', $klantEmail);
//        $sql->bindParam(':klantAdres', $klantAdres);
//        $sql->bindParam(':klantPostcode', $klantPostcode);
//        $sql->bindParam(':klantWoonplaats', $klantWoonplaats);
//
//        $sql->execute();
//
//        //melding
//        $_SESSION['message'] = "Klant " . $klantNaam . " is toegevoegd! <br>";
//        header("Location: klantRead.php");
//
//    }

    //read klant and give delete/update buttons with the ID
    public function readKlant() {
        require 'pureConnect.php';
        $sql = $conn->prepare('SELECT * FROM klanten');
        $sql->execute();

        foreach ($sql as $klant) {
            $klantObject = new Klant($klant['username'], $klant['email'], $klant['telefoon'], $klant['password'], $klant['rights'], $klant['changed']);
            echo '<br>';
            echo '<div class="readList">';
            echo '<a href="klantDelete.php?action=delete&klantId=' . $klant['ID'] . '" class="deleteButton" onclick="return confirm(\'Are you sure you want to delete this klant?\')">Delete</a>';
            echo '<a href="klantUpdateForm.php?action=update&klantId=' . $klant['ID'] . '" class="updateButton">Update</a>';

            // echo $klantObject->klantId . ' - ';
            echo $klantObject->username . ' - ';
            echo $klantObject->email . ' - ';
            echo $klantObject->telefoon . ' - ';
            echo $klantObject->password . ' - ';
            echo $klantObject->rights . ' - ';
            echo $klantObject->changed . ' - ';
            echo '</div>';
            echo '<br>';
        }
    }

    public function readAccount($userId) {

    }






    //delete klant using klant ID
    public function deleteKlant($klantId) {
        require 'database.php';
        $sql = $conn->prepare('DELETE FROM klanten WHERE klantId = :klantId');
        $sql->bindParam(':klantId', $klantId);
        $sql->execute();

        //melding
        $_SESSION['message'] = 'Klant ' . $username . ' is verwijderd. <br>';
        header("Location: klantRead.php");
    }

    //find klant using klant Id for the update form
    public function findKlant($klantId) {
        require 'pureConnect.php';
        $sql = $conn->prepare('SELECT * FROM klanten WHERE klantId = :klantId');
        $sql->bindParam(':klantId', $klantId);
        $sql->execute();

        $klant = $sql->fetch();
        return $klant;
    }

    //get the klant naam and ID for the option values for the verkoop order create/update
    public function getKlanten() {
        require 'pureConnect.php';
        $sql = $conn->prepare('SELECT klantId, klantNaam FROM klanten');
        $sql->execute();

        $klanten = array();
        while ($row = $sql->fetch()) {
            $klanten[] = $row;
        }
        return $klanten;
    }

    //search klant using klant ID
    public function searchBezorger($klantId) {
        require 'database.php';
        $sql = $conn->prepare('SELECT klanten.klantId, klantNaam, klantEmail, klantAdres, klantPostcode, klantWoonplaats, verkOrdId, verkOrdStatus, verkOrdDatum, artId
        FROM klanten
        JOIN verkooporders ON klanten.klantId = verkooporders.klantId
        WHERE klanten.klantId = :klantId');
        $sql->bindParam(':klantId', $klantId);
        $sql->execute();

        $klant = $sql->fetch();
        if ($klant) {
            $result = array();
            $result['klantId'] = $klant['klantId'];
            $result['klantNaam'] = $klant['klantNaam'];
            $result['klantEmail'] = $klant['klantEmail'];
            $result['klantAdres'] = $klant['klantAdres'];
            $result['klantPostcode'] = $klant['klantPostcode'];
            $result['klantWoonplaats'] = $klant['klantWoonplaats'];
            $result['verkOrdId'] = $klant['verkOrdId'];
            $result['verkOrdStatus'] = ($klant['verkOrdStatus'] == 1) ? 'true' : 'false';
            $result['verkOrdDatum'] = $klant['verkOrdDatum'];
            $result['artId'] = $klant['artId'];

            //redirect to the menu and pass the result array
            header("Location: menuBezorger.php");
            $_SESSION['result'] = $result;
            exit;
        } else {
            //redirect to the menu and give the error message
            header("Location: menuBezorger.php");
            $_SESSION['searchMsg'] = "No result found for this Klant.";

        }

    }

    //search klant using klant postcode
    public function searchKlant($klantPostcode) {
        require 'database.php';
        $sql = $conn->prepare('SELECT * FROM klanten WHERE klantPostcode = :klantPostcode');
        $sql->bindParam(':klantPostcode', $klantPostcode);
        $sql->execute();

        $klant = $sql->fetch();
        if ($klant) {
            $result = array();
            $result['klantNaam'] = $klant['klantNaam'];
            $result['klantEmail'] = $klant['klantEmail'];
            $result['klantAdres'] = $klant['klantAdres'];
            $result['klantPostcode'] = $klant['klantPostcode'];
            $result['klantWoonplaats'] = $klant['klantWoonplaats'];
            $_SESSION['result'] = $result;
            header("Location: klantRead.php");
            exit;

        } else {
            header("Location: klantRead.php");
            $_SESSION['searchMsg'] = "No result found for this Postcode.";

        }

    }

    //search klant using klant ID

    public function searchKlantId($klantId) {
        require 'database.php';
        $sql = $conn->prepare('SELECT * FROM klanten WHERE klantId = :klantId');
        $sql->bindParam(':klantId', $klantId);
        $sql->execute();

        $klant = $sql->fetch();
        if ($klant) {
            $result = array();
            $result['klantNaam'] = $klant['klantNaam'];
            $result['klantEmail'] = $klant['klantEmail'];
            $result['klantAdres'] = $klant['klantAdres'];
            $result['klantPostcode'] = $klant['klantPostcode'];
            $result['klantWoonplaats'] = $klant['klantWoonplaats'];
            $_SESSION['result'] = $result;
            header("Location: klantRead.php");
            exit;

        } else {
            header("Location: klantRead.php");
            $_SESSION['searchMsg'] = "No result found for this klantId.";

        }

    }

    //Update klant using the klant ID
    public function updateKlant($klantId, $klantNaam, $klantEmail, $klantAdres, $klantPostcode, $klantWoonplaats) {
        require 'database.php';
        $sql = $conn->prepare('UPDATE klanten SET klantNaam = :klantNaam, klantEmail = :klantEmail, klantAdres = :klantAdres, klantPostcode = :klantPostcode, klantWoonplaats = :klantWoonplaats WHERE klantId = :klantId');
        $sql->bindParam(':klantId', $klantId);
        $sql->bindParam(':klantNaam', $klantNaam);
        $sql->bindParam(':klantEmail', $klantEmail);
        $sql->bindParam(':klantAdres', $klantAdres);
        $sql->bindParam(':klantPostcode', $klantPostcode);
        $sql->bindParam(':klantWoonplaats', $klantWoonplaats);

        $sql->execute();

        $_SESSION['message'] = 'Klant ' . $klantNaam . ' is bijgewerkt <br>';
        header("Location: klantRead.php");
    }
}

?>
}


?>