<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Artikel Voorraad</title>
</head>
<body>
<?php require 'nav.php'?>
<?php
    require_once 'Artikel.php';
    $artikelen = new Artikel();
?>
<div class="content">
    <div class="accountPage">
        <div class="basCard">
            <div class="accountItems">
                <h1>Artikel Voorraad</h1>
                <div class="accountForm">
                    <p>De volgende artikelen moeten bijbesteld worden: </p>
                    <?php
                        $artikelen = $artikelen->searchArtVoorraad();
                    ?>
                    <div class="question">
                        <p><a href="artikelRead.php">Artikel Read</a> </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php require 'footer.php'?>
</body>
<style>

input {
    margin-bottom: 5px;
    width: 200px;
    padding: 10px 15px;
    display: flex;
    justify-content: center;
    border-radius: 5px;

}

#messagePHP {
    color: white;
}

a {
    margin: 5px;
    padding: 5px;
    border-radius: 5px;
}
a:hover {
    background-color: white;
    color: black;
}
.CardContent {
    padding: 10px;
    margin: 10px;

}

</style>
</html>