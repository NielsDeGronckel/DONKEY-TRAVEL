<?php
class Inkooporder {
    // Properties
    protected $levId;
    protected $artId;
    protected $inkOrdDatum;
    protected $inkOrdBestAantal;
    protected $inkOrdStatus;

    // Constructor
    public function __construct($levId = null, $artId = null, $inkOrdDatum = null, $inkOrdBestAantal = null, $inkOrdStatus = false) {
        $this->levId = $levId;
        $this->artId = $artId;
        $this->inkOrdDatum = $inkOrdDatum;
        $this->inkOrdBestAantal = $inkOrdBestAantal;
        $this->inkOrdStatus = $inkOrdStatus;
    }

    // Getters
    public function getLevId() {
        return $this->levId;
    }
    public function getArtId() {
        return $this->artId;
    }
    public function getInkOrdDatum() {
        return $this->inkOrdDatum;
    }
    public function getInkOrdBestAantal() {
        return $this->inkOrdBestAantal;
    }
    public function getInkOrdStatus() {
        return $this->inkOrdStatus;
    }

    // Setters
    public function setLevId($levId) {
        $this->levId = $levId;
    }
    public function setArtId($artId) {
        $this->artId = $artId;
    }
    public function setInkOrdDatum($inkOrdDatum) {
        $this->inkOrdDatum = $inkOrdDatum;
    }
    public function setInkOrdBestAantal($inkOrdBestAantal) {
        $this->inkOrdBestAantal = $inkOrdBestAantal;
    }
    public function setInkOrdStatus($inkOrdStatus) {
        $this->inkOrdStatus = $inkOrdStatus;
    }

    //Create inkooporders
    public function createInkooporder($levId, $artId, $inkOrdDatum, $inkOrdBestAantal, $inkOrdStatus) {
        require 'database.php';
        
        $sql = $conn->prepare('INSERT INTO inkooporders (levId, artId, inkOrdDatum, inkOrdBestAantal, inkOrdStatus) VALUES (:levId, :artId, :inkOrdDatum, :inkOrdBestAantal, :inkOrdStatus)');
        
        $sql->bindParam(':levId', $levId);
        $sql->bindParam(':artId', $artId);
        $sql->bindParam(':inkOrdDatum', $inkOrdDatum);
        $sql->bindParam(':inkOrdBestAantal', $inkOrdBestAantal);
        $sql->bindParam(':inkOrdStatus', $inkOrdStatus);
        
        $sql->execute();
        
        $_SESSION['message'] = "Inkooporder voor artikel ID " . $artId . " is toegevoegd!<br>";
        header("Location: inkoopRead.php");
    }
    
    //read inkooporder and give a update and delete button with verkooporder ID
    public function readInkooporder() {
        require 'pureConnect.php';
        $sql = $conn->prepare('SELECT * FROM inkooporders');
        $sql->execute();
        
        foreach($sql as $inkooporder) {
            echo '<br>';
            echo '<div class="readList">';
            echo '<a href="inkoopDelete.php?action=delete&inkOrdId=' . $inkooporder['inkOrdId'] . '" class="deleteButton" onclick="return confirm(\'Weet u zeker dat u deze inkooporder wilt verwijderen?\')">Delete</a> ';
            echo '<a href="inkoopUpdateForm.php?action=update&inkOrdId=' . $inkooporder['inkOrdId'] . ' "class="updateButton">Update</a> ';
            echo 'Inkoop order ID: ' . $inkooporder['inkOrdId'] . ' - ';
            echo 'Leverancier ID: ' . $inkooporder['levId'] . ' - ';
            echo 'Artikel ID: ' . $inkooporder['artId'] . ' - ';
            echo 'Inkooporder datum: ' . $inkooporder['inkOrdDatum'] . ' - ';
            echo 'Aantal: ' . $inkooporder['inkOrdBestAantal'] . ' - ';
            echo 'Status: ' . $inkooporder['inkOrdStatus'] . ' - ';
            echo '</div>';
            echo '<br>';
        }
    }
    
    //delete inkooporders using inkooporder ID
    public function deleteInkooporder($inkOrdId) {
        require 'database.php';
        $sql = $conn->prepare('DELETE FROM inkooporders WHERE inkOrdId = :inkOrdId');
        $sql->bindParam(':inkOrdId', $inkOrdId);
        $sql->execute();
        
        $_SESSION['message'] = 'Inkooporder '. $inkOrdId . ' is verwijderd. <br>';
        header("Location: inkoopRead.php");
    }
    
    //find inkooporder using inkooporder Id for the update form
    public function findInkooporder($inkOrdId) {
        require 'pureConnect.php';
        $sql = $conn->prepare('SELECT * FROM inkooporders WHERE inkOrdId = :inkOrdId');
        $sql->bindParam(':inkOrdId', $inkOrdId);
        $sql->execute();
        
        $inkOrd = $sql->fetch();
        return $inkOrd;
    }
    
    //search inkooporder using inkooporder ID
    public function searchInkooporder($inkOrdId) {
        require 'database.php';
        $sql = $conn->prepare('SELECT * FROM inkooporders WHERE inkOrdId = :inkOrdId');
        $sql->bindParam(':inkOrdId', $inkOrdId);
        $sql->execute();
        $inkOrd = $sql->fetch();
        if ($inkOrd) {
            $result = array();
            $result['levId'] = $inkOrd['levId'];
            $result['artId'] = $inkOrd['artId'];
            $result['inkOrdDatum'] = $inkOrd['inkOrdDatum'];
            $result['inkOrdBestAantal'] = $inkOrd['inkOrdBestAantal'];
            $result['inkOrdStatus'] = $inkOrd['inkOrdStatus'];
            $_SESSION['result'] = $result;
            header("Location: inkoopRead.php");
            exit;
        } else {
            header("Location: inkoopRead.php");
            $_SESSION['searchMsg'] = "No result found for this ID";
        }
    }

    //Update inkooporder using the inkooporder ID
    public function updateInkooporder($inkOrdId, $levId, $artId, $inkOrdDatum, $inkOrdBestAantal, $inkOrdStatus) {
        require 'pureConnect.php';
        $sql = $conn->prepare('UPDATE inkooporders SET artId = :artId, levId = :levId, 
        inkOrdDatum = :inkOrdDatum, inkOrdBestAantal = :inkOrdBestAantal, inkOrdStatus = :inkOrdStatus WHERE inkOrdId = :inkOrdId');
        $sql->bindParam(':inkOrdId', $inkOrdId);
        $sql->bindParam(':levId', $levId);
        $sql->bindParam(':artId', $artId);
        $sql->bindParam(':inkOrdDatum', $inkOrdDatum);
        $sql->bindParam(':inkOrdBestAantal', $inkOrdBestAantal);
        $sql->bindParam(':inkOrdStatus', $inkOrdStatus);
    
        $sql->execute();
    
        $_SESSION['message'] = 'Inkooporder ' . $inkOrdStatus . ' is bijgewerkt <br>';
        header("Location: inkoopRead.php");
    } 
      
   
}

?>