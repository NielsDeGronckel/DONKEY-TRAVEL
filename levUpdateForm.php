<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>update leverancier</title>
</head>
<body>
<?php
require 'nav.php';
?>
<div class="content">
    <div class="accountPage">
        <div class="basCard">
            <div class="accountItems">
                <h1>Update leverancier:</h1>
                <div class="accountForm">
                    <?php
                    require 'leveranciers.php';
                    $levId = $_GET['levId'];
                    $lev1 = new Leveranciers();
                    $lev = $lev1->findLeverancier($levId);
                    // var_dump($levId);
                    ?>
                    <form   form method="POST" action="levUpdate.php">
                        <input type="hidden" name="levId" value="<?php echo $lev['levId']; ?>">
                        <label>Naam:</label>
                        <input type="text" name="levNaam" value="<?php echo $lev['levNaam']; ?>"><br>
                        <label>Contact Naam:</label>
                        <input type="text" name="levContact" value="<?php echo $lev['levContact']; ?>">
                        <label>Email:</label>
                        <input type="email" name="levEmail" value="<?php echo $lev['levEmail']; ?>"><br>
                        <label>Adres:</label>
                        <input type="text" name="levAdres" value="<?php echo $lev['levAdres']; ?>"><br>
                        <label>Postcode:</label>
                        <input type="text" name="levPostcode" pattern="[0-9]{4}[A-Z]{2}" title="Five digit zip code" value="<?php echo $lev['levPostcode']; ?>"><br>
                        <label>Woonplaats:</label>
                        <input type="text" name="levWoonplaats" value="<?php echo $lev['levWoonplaats']; ?>"><br>
                        <input type="submit" value="Submit">
                    </form>
                    <div class="question">
                        <p>Alle leveranciers: <a href="levRead.php">Leveranciers Read</a> </p>
                        <p>Maak nieuwe leveranciers: <a href="levCreateForm.php">Leverancier Create</a> </p>

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
</style>
</html>