<?php
//Lukas Sliva

class Klant {
    //properties
    protected $klantNaam;
    protected $klantEmail;
    protected $klantAdres;
    protected $klantPostcode;
    protected $klantWoonplaats;

    //methoden -functies
    // constructor
    function __construct($klantNaam=NULL, $klantEmail=NULL, $klantAdres=NULL, $klantPostcode=NULL, $klantWoonplaats=NULL) {
        $this->klantNaam = $klantNaam;
        $this->klantEmail = $klantEmail;
        $this->klantAdres = $klantAdres;
        $this->klantPostcode = $klantPostcode;
        $this->klantWoonplaats = $klantWoonplaats;
    }

    // setters
    function set_klantNaam($klantNaam) {
        $this->klantNaam = $klantNaam;
    }
    function set_klantEmail($klantEmail) {
        $this->klantEmail = $klantEmail;
    }
    function set_klantAdres($klantAdres) {
        $this->klantAdres = $klantAdres;
    }
    function set_klantPostcode($klantPostcode) {
        $this->klantPostcode = $klantPostcode;
    }
    function set_klantWoonplaats($klantWoonplaats) {
        $this->klantWoonplaats = $klantWoonplaats;
    }
    // getter
    function get_klantNaam() {
        return $this->klantNaam;
    }
    function get_klantEmail() {
        return $this->klantEmail;
    }
    function get_klantAdres() {
        return $this->klantAdres;
    }
    function get_klantPostcode() {
        return $this->klantPostcode;
    }
    function get_klantWoonplaats() {
        return $this->klantWoonplaats;
    }
    
    //CRUD functies
    // Retrieves the userId from the database based on the provided email and stores it in a session variable
    public function getKlantIdSession($qqleq) {
        // echo 'Username: ' . $qqleq . '<br>';
        // echo '<br>';
        require_once 'database/pureConnect.php';
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
    public function createKlant() {
        require 'database/pureConnect.php';
        $klantNaam = $this->get_klantNaam();
        $klantEmail = $this->get_klantEmail();
        $klantAdres = $this->get_klantAdres();
        $klantPostcode = $this->get_klantPostcode();
        $klantWoonplaats = $this->get_klantWoonplaats();
    
        //statement maken voor invoer in de tabel
        $sql = $conn->prepare('INSERT INTO klanten (klantNaam, klantEmail, klantAdres, klantPostcode, klantWoonplaats) VALUES (:klantNaam, :klantEmail, :klantAdres, :klantPostcode, :klantWoonplaats)');
    
        //Variabelen in de statement zetten
        $sql->bindParam(':klantNaam', $klantNaam);
        $sql->bindParam(':klantEmail', $klantEmail);
        $sql->bindParam(':klantAdres', $klantAdres);
        $sql->bindParam(':klantPostcode', $klantPostcode);
        $sql->bindParam(':klantWoonplaats', $klantWoonplaats);
    
        $sql->execute();
    
        //melding
        $_SESSION['message'] = "Klant " . $klantNaam . " is toegevoegd! <br>";
        header("Location: klantRead.php");
        
    }

    //read klant and give delete/update buttons with the ID    
    public function readKlant() {
        require 'database/pureConnect.php';
        $sql = $conn->prepare('SELECT * FROM klanten');
        $sql->execute();
    
        foreach($sql as $klant) {
            $klantObject = new Klant($klant['klantNaam'], $klant['klantEmail'], $klant['klantAdres'], $klant['klantPostcode'], $klant['klantWoonplaats']);
            echo '<br>';
            echo '<div class="readList">';
            echo '<a href="klantDelete.php?action=delete&klantId=' . $klant['klantId'] . '" class="deleteButton" onclick="return confirm(\'Are you sure you want to delete this klant?\')">Delete</a>';            
            echo '<a href="klantUpdateForm.php?action=update&klantId=' . $klant['klantId'] . '"class="updateButton">Update</a>';
            
            // echo $klantObject->klantId . ' - ';
            echo $klantObject->klantNaam . ' - ';
            echo $klantObject->klantEmail . ' - ';
            echo $klantObject->klantAdres . ' - ';
            echo $klantObject->klantPostcode . ' - ';
            echo $klantObject->klantWoonplaats . ' - ';
            echo '</div>';
            echo '<br>';
        }
  
    }

    //delete klant using klant ID
    public function deleteKlant($klantId) {
        require 'database/pureConnect.php';
        $sql = $conn->prepare('DELETE FROM klanten WHERE klantId = :klantId');
        $sql->bindParam(':klantId', $klantId);
        $sql->execute();
    
        //melding
        $_SESSION['message'] = 'Klant ' . $klantNaam . ' is verwijderd. <br>';
        header("Location: klantRead.php");
    }

    //find klant using klant Id for the update form
    public function findKlant($klantId) {
        require 'database/pureConnect.php';
        $sql = $conn->prepare('SELECT * FROM klanten WHERE klantId = :klantId');
        $sql->bindParam(':klantId', $klantId);
        $sql->execute();
    
        $klant = $sql->fetch();
        return $klant;
    }

    //get the klant naam and ID for the option values for the verkoop order create/update
    // public function getKlanten() {
    //     require 'database/pureConnect.php';
    //     $sql = $conn->prepare('SELECT klantId, klantNaam FROM klanten');
    //     $sql->execute();

    //     $klanten = array();
    //     while ($row = $sql->fetch()) {
    //         $klanten[] = $row;
    //     }
    //     return $klanten;
    // }

    
     //get tocht omschrijving, aantal dagen using tochtId for the boeking read
     public function getKlantenWithId($id) {
        require 'database/pureConnect.php';
    
        $sql = $conn->prepare("SELECT username, email, telefoon FROM klanten WHERE ID = :id");
        $sql->bindParam(':id', $id);
        $sql->execute();
        
        // Fetch a single row
        $klant = $sql->fetch(PDO::FETCH_ASSOC);
        // var_dump($tocht);
        return $klant;
    }
    // Get the klanten ID, username, email, and telefoon for the option values in boeking create/update
    public function getKlanten() {
        require 'database/pureConnect.php';
        
        $sql = $conn->prepare("SELECT ID, username, email, telefoon FROM klanten");
        $sql->execute();
        $klanten = array();
        while ($row = $sql->fetch()) {
            $klanten[] = $row;
        }
        return $klanten;    
    }

    // Get klant details using klant ID for the boeking read
    public function getKlantWithId($id) {
        require 'database/pureConnect.php';
        
        $sql = $conn->prepare("SELECT username, email, telefoon FROM klanten WHERE ID = :id");
        $sql->bindParam(':id', $id);
        $sql->execute();
        
        // Fetch a single row
        $klant = $sql->fetch(PDO::FETCH_ASSOC);
        return $klant;
    }


    //search klant using klant ID
    public function searchBezorger($klantId) {
        require 'database/pureConnect.php';
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
        require 'database/pureConnect.php';
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
        require 'database/pureConnect.php';
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
        require 'database/pureConnect.php';
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