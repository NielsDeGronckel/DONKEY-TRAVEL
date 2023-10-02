<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>update artikel</title>
</head>
<body>
    <?php 
    require 'nav.php';
    ?>

    <div class="content">
        <div class="accountPage">
            <div class="basCard">
                <div class="accountItems">
                    <h1>Update artikelen:</h1>
                    <div class="accountForm">
                        <?php
                            require 'Artikel.php';
                            $artId = $_GET['artId'];
                            $artikel1 = new Artikel();
                            $artikel = $artikel1->findArt($artId);
                            // var_dump($artId);
                        ?>
                       <form method="POST" action="artikelUpdate.php">
                            <input type="hidden" name="artId" value="<?php echo $artikel['artId']; ?>">
                            <label>artOmschrijving :</label>
                            <input type="text" name="artOmschrijving" value="<?php echo $artikel['artOmschrijving']; ?>"><br>
                            <label>artInkoop:</label>
                            <input type="text" name="artInkoop" value="<?php echo $artikel['artInkoop']; ?>"><br>
                            <label>artVerkoop:</label>
                            <input type="text" name="artVerkoop" value="<?php echo $artikel['artVerkoop']; ?>"><br>
                            <label>artVoorraad:</label>
                            <input type="text" name="artVoorraad" value="<?php echo $artikel['artVoorraad']; ?>"><br>
                            <label>artMinVoorraad :</label>
                            <input type="text" name="artMinVoorraad" value="<?php echo $artikel['artMinVoorraad']; ?>"><br>
                            <label>artMaxVoorraad:</label>
                            <input type="text" name="artMaxVoorraad" value="<?php echo $artikel['artMaxVoorraad']; ?>">
                            <label>artLocatie:</label>
                            <input type="text" name="artLocatie" value="<?php echo $artikel['artLocatie']; ?>"><br>
                            <label>levId :</label>
                            <input type="text" name="levId" value="<?php echo $artikel['levId']; ?>"><br>
                            <div class="formEnd">
                                <input type="submit" value="Submit">
                                <p><a id="cancel" href="klantRead.php">Cancel</a></p>
                            </div>
                        </form>

                        <div class="question">
                            <p>Alle artikelen: <a href="artikelRead.php">artikel Read</a> </p>
                            <p>Maak nieuwe artikel: <a href="artikelCreateForm.php">artikel Create</a> </p>

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