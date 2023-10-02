<?php
class Artikel {
    //properties
    protected $artOmschrijving;
    protected $artInkoop;
    protected $artVerkoop;
    protected $artVoorraad;
    protected $artMinVoorraad;
    protected $artMaxVoorraad;
    protected $artLocatie;
    protected $levId;

    //methoden -functies
    // constructor
    function __construct($artOmschrijving= NULL, $artInkoop= NULL, $artVerkoop= NULL, $artVoorraad= NULL, $artMinVoorraad= NULL, $artMaxVoorraad= NULL, $artLocatie= NULL, $levId= NULL) {
        $this->artOmschrijving = $artOmschrijving;
        $this->artInkoop = $artInkoop;
        $this->artVerkoop = $artVerkoop;
        $this->artVoorraad = $artVoorraad;
        $this->artMinVoorraad = $artMinVoorraad;
        $this->artMaxVoorraad = $artMaxVoorraad;
        $this->artLocatie = $artLocatie;
        $this->$levId = $levId;
    }

    // setters
    function set_artOmschrijving($artOmschrijving) {
        $this->artOmschrijving = $artOmschrijving;
    }
    function set_artInkoop($artInkoop) {
        $this->artInkoop = $artInkoop;
    }
    function set_artVerkoop($artVerkoop) {
        $this->artVerkoop = $artVerkoop;
    }
    function set_artVoorraad($artVoorraad) {
        $this->artVoorraad = $artVoorraad;
    }
    function set_artMinVoorraad($artMinVoorraad) {
        $this->artMinVoorraad = $artMinVoorraad;
    }
    function set_artMaxVoorraad($artMaxVoorraad) {
        $this->artMaxVoorraad = $artMaxVoorraad;
    }
    function set_artLocatie($artLocatie) {
        $this->artLocatie = $artLocatie;
    }
    function set_levId($levId) {
        $this->$levId = $levId;
    }
    function get_artOmschrijving() {
        return $this->artOmschrijving;
    }
    function get_artInkoop() {
        return $this->artInkoop;
    }
    function get_artVerkoop() {
        return $this->artVerkoop;
    }
    function get_artVoorraad() {
        return $this->artVoorraad;
    }
    function get_artMinVoorraad() {
        return $this->artMinVoorraad;
    }
    function get_artMaxVoorraad() {
        return $this->artMaxVoorraad;
    }
    function get_artLocatie() {
        return $this->artLocatie;
    }
    function get_levId() {
        return $this->levId;
    }

    //CRUD functies
   
    // create new artikel
    public function createArt($artOmschrijving, $artInkoop, $artVerkoop, $artVoorraad, $artMinVoorraad, $artMaxVoorraad, $artLocatie, $levId) {
        require 'database.php';
        
        $sql = $conn->prepare('INSERT INTO artikelen (artOmschrijving, artInkoop, artVerkoop, artVoorraad, artMinVoorraad, artMaxVoorraad, artLocatie, levId) VALUES (:artOmschrijving, :artInkoop, :artVerkoop, :artVoorraad, :artMinVoorraad, :artMaxVoorraad, :artLocatie, :levId)');
    
        $sql->bindParam(':artOmschrijving', $artOmschrijving);
        $sql->bindParam(':artInkoop', $artInkoop);
        $sql->bindParam(':artVerkoop', $artVerkoop);
        $sql->bindParam(':artVoorraad', $artVoorraad);
        $sql->bindParam(':artMinVoorraad', $artMinVoorraad);
        $sql->bindParam(':artMaxVoorraad', $artMaxVoorraad);
        $sql->bindParam(':artLocatie', $artLocatie);
        $sql->bindParam(':levId', $levId);
    
        $sql->execute();
    
        $_SESSION['message'] = "Artikel " . $artOmschrijving . " is toegevoegd! <br>";
        header("Location: artikelRead.php");
    }


    //read artikel and give delete/update buttons with the ID    
    public function readArt() {
        require 'pureConnect.php';
        $sql = $conn->prepare('SELECT * FROM artikelen');
        $sql->execute();
    
        foreach($sql as $artikel) {
            $artikelObject = new Artikel($artikel['artOmschrijving'], $artikel['artInkoop'], $artikel['artVerkoop'], $artikel['artVoorraad'], $artikel['artMinVoorraad'], $artikel['artMaxVoorraad'], $artikel['artLocatie'], $artikel['levId']);
    
            echo '<br>';
            echo '<div class="readList">';

            echo '<a href="artikelDelete.php?action=delete&artId=' . $artikel['artId'] . '" class="deleteButton" onclick="return confirm(\'Are you sure you want to delete this artikel?\')">Delete</a>';
            echo '<a href="artikelUpdateForm.php?action=update&artId=' . $artikel['artId'] . '"class="updateButton">Update</a>';
            echo $artikelObject->artOmschrijving . ' - ';
            echo $artikelObject->artInkoop . ' - ';
            echo $artikelObject->artVerkoop . ' - ';
            echo $artikelObject->artVodforraad . ' - ';
            echo $artikelObject->artMinVoorraad . ' - ';
            echo $artikelObject->artMaxVoorraad . ' - ';
            echo $artikelObject->artLocatie . ' - ';
            echo $artikelObject->levId . ' - ';
            echo '</div>';
            echo '<br>';
        }
    
    }
   
    //delete artikel using artikel ID
    public function deleteArt($artId) {
    require 'database.php';
    $sql = $conn->prepare('DELETE FROM artikelen WHERE artId = :artId');
    $sql->bindParam(':artId', $artId);
    $sql->execute();

    //melding
    $_SESSION['message'] = 'Artikel ' . $artId . ' is verwijderd. <br>';
    header("Location: artikelRead.php");
    }

    //find artikel using artikel Id for the update form
    public function findArt($artId) {
        require 'pureConnect.php';
        $sql = $conn->prepare('SELECT * FROM artikelen WHERE artId = :artId');
        $sql->bindParam(':artId', $artId);
        $sql->execute();

        $artikel = $sql->fetch();
        return $artikel;
    }

    //get the artikel omschrijving and ID for the option values in inkoop and verkoop order create/update
    public function getArtikelen() {
        require 'pureConnect.php';
        $sql = $conn->prepare('SELECT artId, artOmschrijving FROM artikelen');
        $sql->execute();

        $artikelen = array();
        while ($row = $sql->fetch()) {
            $artikelen[] = $row;
        }
        return $artikelen;
    }

    //search artikel using artikel omschrijving
    public function searchArtOms($artOmschrijving) {
        require 'database.php';
        $sql = $conn->prepare('SELECT * FROM artikelen WHERE artOmschrijving = :artOmschrijving');
        $sql->bindParam(':artOmschrijving', $artOmschrijving);
        $sql->execute();

        $artikel = $sql->fetch();
        if ($artikel) {
            $result = array();
            $result['artOmschrijving'] = $artikel['artOmschrijving'];
            $result['artInkoop'] = $artikel['artInkoop'];
            $result['artVerkoop'] = $artikel['artVerkoop'];
            $result['artVoorraad'] = $artikel['artVoorraad'];
            $result['artMinVoorraad'] = $artikel['artMinVoorraad'];
            $result['artMaxVoorraad'] = $artikel['artMaxVoorraad'];
            $result['artLocatie'] = $artikel['artLocatie'];
            $result['levId'] = $artikel['levId'];
            $_SESSION['result'] = $result;
            header("Location: artikelRead.php");
            exit;

        } else {
            header("Location: artikelRead.php");
            $_SESSION['searchMsg'] = "No result found for this Artikel.";

        }

    }

    //search artikel using artikel ID
    public function searchArt($artId) {
        require 'database.php';
        $sql = $conn->prepare('SELECT * FROM artikelen WHERE artId = :artId');
        $sql->bindParam(':artId', $artId);
        $sql->execute();

        $artikel = $sql->fetch();
        if ($artikel) {
            $result = array();
            $result['artOmschrijving'] = $artikel['artOmschrijving'];
            $result['artInkoop'] = $artikel['artInkoop'];
            $result['artVerkoop'] = $artikel['artVerkoop'];
            $result['artVoorraad'] = $artikel['artVoorraad'];
            $result['artMinVoorraad'] = $artikel['artMinVoorraad'];
            $result['artMaxVoorraad'] = $artikel['artMaxVoorraad'];
            $result['artLocatie'] = $artikel['artLocatie'];
            $result['levId'] = $artikel['levId'];
            $_SESSION['result'] = $result;
            header("Location: artikelRead.php");
            exit;

        } else {
            header("Location: artikelRead.php");
            $_SESSION['searchMsg'] = "No result found for this Artikel ID.";

        }

    }

    //Update artikel using the artikel ID
    public function updateArt($artId, $artOmschrijving, $artInkoop, $artVerkoop, $artVoorraad, $artMinVoorraad, $artMaxVoorraad, $artLocatie, $levId) {
        require 'database.php';
        $sql = $conn->prepare('UPDATE artikelen SET artOmschrijving = :artOmschrijving, artInkoop = :artInkoop, artVerkoop = :artVerkoop, artVoorraad = :artVoorraad, artMinVoorraad = :artMinVoorraad, artMaxVoorraad = :artMaxVoorraad, artLocatie = :artLocatie, levId = :levId WHERE artId = :artId');
        $sql->bindParam(':artId', $artId);
        $sql->bindParam(':artOmschrijving', $artOmschrijving);
        $sql->bindParam(':artInkoop', $artInkoop);
        $sql->bindParam(':artVerkoop', $artVerkoop);
        $sql->bindParam(':artVoorraad', $artVoorraad);
        $sql->bindParam(':artMinVoorraad', $artMinVoorraad);
        $sql->bindParam(':artMaxVoorraad', $artMaxVoorraad);
        $sql->bindParam(':artLocatie', $artLocatie);
        $sql->bindParam(':levId', $levId);


        $sql->execute();
    
        $_SESSION['message'] = 'Artikel ' . $artOmschrijving . ' is bijgewerkt <br>';
        header("Location: artikelRead.php");
    }

    //artikel voorraad display
    // public function artikelVoorraad() {
    //     require 'pureConnect.php';
    //     $sql = "SELECT * FROM artikelen WHERE artVoorraad < artMaxVoorraad";
    //     $result = $conn->query($sql);

    //     // if ($result->num_rows > 0) {
    //     //     while($row = $result->fetch_assoc()) {
    //     //         // Calculate the bestelhoeveelheid
    //     //         $bestelling = $this->maxVoorraad - $this->minVoorraad;

    //     //         // Update the artVoorraad in the database
    //     //         $sql = "UPDATE artikelen SET artVoorraad = artVoorraad + $bestelling WHERE id = " . $row["id"];
    //     //         $conn->query($sql);

    //     //         echo "Bestelling geplaatst voor " . $row["artNaam"] . ": $bestelling\n";
    //     //     }
    //     // } else {
    //     //     echo "Alle artikelen zijn op voorraad.\n";
    //     // }
    // }
    public function searchArtVoorraad() {
        // require 'database.php';
        // $sql = $conn->prepare('SELECT * FROM artikelen WHERE artVoorraad < artMaxVoorraad');
        // $sql->execute();

        // $artikel = $sql->fetch();
        // if ($artikel) {
        //     $result = array();
        //     $result['artOmschrijving'] = $artikel['artOmschrijving'];
        //     $result['artInkoop'] = $artikel['artInkoop'];
        //     $result['artVerkoop'] = $artikel['artVerkoop'];
        //     $result['artVoorraad'] = $artikel['artVoorraad'];
        //     $result['artMinVoorraad'] = $artikel['artMinVoorraad'];
        //     $result['artMaxVoorraad'] = $artikel['artMaxVoorraad'];
        //     $result['artLocatie'] = $artikel['artLocatie'];
        //     $result['levId'] = $artikel['levId'];
        //     $_SESSION['result'] = $result;
        //     header("Location: artVoorraad.php");
        //     exit;

        // } else {
        //     header("Location: artVoorraad.php");
        //     $_SESSION['searchMsg'] = "Alle artikelen zijn op voorraad.";

        // }
        require 'pureConnect.php';
        $sql = $conn->prepare('SELECT * FROM artikelen WHERE artVoorraad < artMaxVoorraad');
        $sql->execute();
    
        foreach($sql as $artikel) {
            $artikelObject = new Artikel($artikel['artOmschrijving'], $artikel['artInkoop'], $artikel['artVerkoop'], $artikel['artVoorraad'], $artikel['artMinVoorraad'], $artikel['artMaxVoorraad'], $artikel['artLocatie'], $artikel['levId']);
    
            echo '<br>';
            echo '<div class="readList">';

            echo '<a href="artikelDelete.php?action=delete&artId=' . $artikel['artId'] . '" class="deleteButton" onclick="return confirm(\'Are you sure you want to delete this artikel?\')">Delete</a>';
            echo '<a href="artikelUpdateForm.php?action=update&artId=' . $artikel['artId'] . '"class="updateButton">Update</a>';
            
            echo $artikelObject->artOmschrijving . ' - ';
            echo $artikelObject->artInkoop . ' - ';
            echo $artikelObject->artVerkoop . ' - ';
            echo $artikelObject->artVoorraad . ' - ';
            echo $artikelObject->artMinVoorraad . ' - ';
            echo $artikelObject->artMaxVoorraad . ' - ';
            echo $artikelObject->artLocatie . ' - ';
            echo $artikelObject->levId . ' - ';
            echo '</div>';
            echo '<br>';
        }

    }
}

?>