<?php



class Status {
  
    public function __construct() {
    }


// Get the statussen ID and Status for the option values in boeking create/update
public function getStatussen() {
    require 'database/pureConnect.php';
    
    $sql = $conn->prepare("SELECT ID, Status FROM statussen");
    $sql->execute();
    $statussen = array();
    while ($row = $sql->fetch()) {
        $statussen[] = $row;
    }
    return $statussen;    
}

// Get status details using status ID for the boeking read
public function getStatusWithId($id) {
    require 'database/pureConnect.php';
    
    $sql = $conn->prepare("SELECT Status FROM statussen WHERE ID = :id");
    $sql->bindParam(':id', $id);
    $sql->execute();
    
    // Fetch a single row
    $status = $sql->fetch(PDO::FETCH_ASSOC);
    return $status;
}

    


}