<?php
if(isset($_SESSION['username'])) {

    // Retrieve user's 'functie' from the database
    $username = $_SESSION['username'];
    $query = "SELECT functie FROM medewerkers WHERE username = :username";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $functie = $row['functie'];
}
?>