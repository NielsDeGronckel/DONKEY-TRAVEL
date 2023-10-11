<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>artikelCreateForm</title>
</head>
<body>
    <?php 
    require 'nav.php';
    require 'Leveranciers.php';
    $leverancier = new Leveranciers();
    ?>
    
    <div class="content">
        <div class="accountPage">
            <div class="basCard">
                <div class="accountItems">
                    <h1>Registreer nieuw Artikel:</h1>
                    <div class="accountForm">
                        <form method="post" id="register" action="artikelCreate.php" class="form">
                            <label for="artOmschrijving">artOmschrijving:</label>
                            <input type="text" id="artOmschrijving" name="artOmschrijving" required>
                            <br>
                            <label for="artInkoop">artInkoop:</label>
                            <input type="number" id="artInkoop" name="artInkoop" min="0" max="999.99" step="0.01" required>
                            <br>
                            <label for="artVerkoop">artVerkoop:</label>
                            <input type="number" id="artVerkoop" name="artVerkoop" min="0" max="999.99" step="0.01" required>
                            <br>
                            <label for="artVoorraad">artVoorraad:</label>
                            <input type="number" id="artVoorraad" name="artVoorraad" required>
                            <br>
                            <label for="artMinVoorraad">artMinVoorraad:</label>
                            <input type="number" id="artMinVoorraad" name="artMinVoorraad" required>
                            <br>
                            <label for="artMaxVoorraad">artMaxVoorraad:</label>
                            <input type="number" id="artMaxVoorraad" name="artMaxVoorraad" required>
                            <br>
                            <label for="artLocatie">artLocatie:</label>
                            <input type="number" id="artLocatie" name="artLocatie" required>
                            <br>
                            <label for="levId">Leverancier ID:</label>
                            <select id="levId" name="levId">
                                <?php
                                    $leverancier = $leverancier->getLeveranciers();
                                    foreach ($leverancier as $lev) {
                                        echo '<option value="' . $lev['levId'] . '">' . $lev['levId'] . ' - ' . $lev['levNaam'] . '</option>';
                                    }
                                ?>
                            </select>
                            <br>
    
                            <div class="submitButton">
                                <input type="submit" name="create" value="Create Client" class="registerClass">
                            </div>
                        </form> 
                        <div class="question">
                            <p><a href="artikelRead.php">Readartikel</a> </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <?php require 'footer.php'?>
</body>
<style>
    
    select {
        width: 100px;
        margin-left: 80px;
    }
    
input {
    margin-bottom: 5px;
    width: 200px;
    padding: 10px 15px;
    display: flex;
    justify-content: center;
    border-radius: 5px;

}

</style>


</html>