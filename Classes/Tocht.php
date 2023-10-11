<?php


// namespace database;


// tochten
// ID INT
// Omschrijving VARCHAR(40)
// Route VARCHAR(50)
// AantalDagen INT
class Tocht {
    private $id;
    private $omschrijving;
    private $route;
    private $aantaldagen;

    public function __construct($id=NULL, $omschrijving=NULL, $route=NULL, $aantaldagen=NULL) {
        $this->id = $id;
        $this->omschrijving = $omschrijving;
        $this->route = $route;
        $this->aantaldagen = $aantaldagen;
    }

    public function getID() {
        return $this->id;
    }

    public function getOmschrijving() {
        return $this->omschrijving;
    }

    public function getRoute() {
        return $this->route;
    }

    public function getAantaldagen() {
        return $this->aantaldagen;
    }

    public function setID($id) {
        $this->id = $id;
    }

    public function setOmschrijving($omschrijving) {
        $this->omschrijving = $omschrijving;
    }

    public function setRoute($route) {
        $this->route = $route;
    }

    public function setAantaldagen($aantaldagen) {
        $this->aantaldagen = $aantaldagen;
    }

    //get the tochten ID, omschrijving and dagen for the option values in boeking create/update
    public function getTochten() {
        require 'pureConnect.php';
    
        $sql = $conn->prepare("SELECT ID, Omschrijving, AantalDagen FROM tochten");
        $sql->execute();
        $tochten = array();
        while ($row = $sql->fetch()) {
            $tochten[] = $row;
        }
        return $tochten;    
    }

    public function getTochtWithId($id) {
        require 'pureConnect.php';
    
        $sql = $conn->prepare("SELECT Omschrijving, Aantaldagen FROM tochten WHERE ID = :id");
        $sql->bindParam(':id', $id);
        $sql->execute();
        
        // Fetch a single row
        $tocht = $sql->fetch(PDO::FETCH_ASSOC);
        // var_dump($tocht);
        return $tocht;
    }
    


}