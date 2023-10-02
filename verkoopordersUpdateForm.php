<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>update verkooporder</title>
</head>
<body>
    <?php 
    require 'nav.php';
    ?>


    <div class="content">
        <div class="accountPage">
            <div class="basCard">
                <div class="accountItems">
                    <h1>Update verkooporder:</h1>
                    <div class="accountForm">
                        <?php
                        require 'Verkooporders.php';
                        require 'Artikel.php';

                        require 'Klant.php';
                        
                        $verkOrdId = $_GET['verkOrdId'];
                        $verkOrd1 = new Verkooporders();
                        $verkOrd = $verkOrd1->findVerkooporder($verkOrdId);
                        
                        $klanten = new Klant();
                        $klantenList = $klanten->getKlanten();
                        $artikelen = new Artikel();
                        $artikelList = $artikelen->getArtikelen();
                            
                        ?>
                        <form method="POST" action="verkoopordersUpdate.php">
                            <input type="hidden" name="verkOrdId" value="<?php echo $verkOrd['verkOrdId']; ?>">
                            <!-- <label>Klant ID:</label>
                            <input type="number" name="klantId" value="<?php echo $verkOrd['klantId']; ?>"><br> -->
                            <label>Klant ID:</label>
                            <select name="klantId">
                                <?php foreach ($klantenList as $klant) { ?>
                                    <option value="<?php echo $klant['klantId']; ?>" <?php if ($verkOrd['klantId'] == $klant['klantId']) { echo 'selected'; } ?>>
                                        <?php echo $klant['klantId'] . ' - ' . $klant['klantNaam']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                            <br>
                            <label>Artikel ID:</label>
                            <select name="artId">
                                <?php foreach ($artikelList as $Artikel) { ?>
                                    <option value="<?php echo $Artikel['artId']; ?>" <?php if ($verkOrd['artId'] == $Artikel['artId']) { echo 'selected'; } ?>>
                                        <?php echo $Artikel['artId'] . ' - ' . $Artikel['artOmschrijving']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                            <br>
                            <!-- <label>Artikel ID:</label>
                            <input type="number" name="artId" value="<?php echo $verkOrd['artId']; ?>"><br> -->
                            <label>Besteldatum:</label>
                            <input type="date" name="verkOrdDatum" value="<?php echo $verkOrd['verkOrdDatum']; ?>"><br>
                            <label>Aantal:</label>
                            <input type="number" name="verkOrdBestAantal" value="<?php echo $verkOrd['verkOrdBestAantal']; ?>"><br>
                            <label>Status:</label>
                            <input type="text" name="verkOrdStatus" value="<?php echo $verkOrd['verkOrdStatus']; ?>"><br>
                            <div class="formEnd">
                                <input type="submit" value="Submit">                            
                                <p><a id="cancel" href="verkooporderRead.php">Cancel</a></p>
                            </div>
                        </form>

                        <!-- <form method="POST" action="inkoopUpdate.php">
                            <input type="hidden" name="inkOrdId" value="<?php echo $inkOrd['inkOrdId']; ?>">
                            <label>Leverancier ID:</label>
                            <input type="number" name="levId" value="<?php echo $inkOrd['levId']; ?>"><br>
                            <label>Artikel ID:</label>
                            <input type="number" name="artId" value="<?php echo $inkOrd['artId']; ?>"><br>
                            <label>Besteldatum:</label>
                            <input type="date" name="inkOrdDatum" value="<?php echo $inkOrd['inkOrdDatum']; ?>"><br>
                            <label>Aantal:</label>
                            <input type="number" name="inkOrdBestAantal" value="<?php echo $inkOrd['inkOrdBestAantal']; ?>"><br>
                            <label>Status:</label>
                            <input type="text" name="inkOrdStatus" value="<?php echo $inkOrd['inkOrdStatus']; ?>"><br>
                            <div class="formEnd">
                                <input type="submit" value="Submit">                            
                                <p><a id="cancel" href="verkooporderRead.php">Cancel</a></p>
                            </div>

                        </form> -->

                        <div class="question">
                            <p><a href="verkooporderCreateForm.php">Create verkooporder</a> </p>

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