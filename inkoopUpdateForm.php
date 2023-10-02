<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>update inkooporder</title>
</head>
<body>
    <?php 
    require 'nav.php';
    ?>

    <div class="content">
        <div class="accountPage">
            <div class="basCard">
                <div class="accountItems">
                    <h1>Update inkooporder:</h1>
                    <div class="accountForm">
                    <?php
                        require 'Artikel.php';

                        require 'Leveranciers.php';
                        
                        require 'Inkooporders.php';
                        $inkOrdId = $_GET['inkOrdId'];
                        $inkOrd1 = new Inkooporder();
                        $inkOrd = $inkOrd1->findInkooporder($inkOrdId);
                        
                        $leverancier = new Leveranciers();
                        $levList = $leverancier->getLeveranciers();
                        $artikelen = new Artikel();
                        $artikelList = $artikelen->getArtikelen();
                            
                        ?>
                        <form method="POST" action="inkoopUpdate.php">
                            <input type="hidden" name="inkOrdId" value="<?php echo $inkOrd['inkOrdId']; ?>">
                            <label>Leverancier ID:</label>
                            <select name="levId">
                                <?php foreach ($levList as $leverancier) { ?>
                                    <option value="<?php echo $leverancier['levId']; ?>" <?php if ($inkOrd['levId'] == $leverancier['levId']) { echo 'selected'; } ?>>
                                        <?php echo $leverancier['levId'] . ' - ' . $leverancier['levNaam']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                            <br>
                            <label>Artikel ID:</label>
                            <select name="artId">
                                <?php foreach ($artikelList as $Artikel) { ?>
                                    <option value="<?php echo $Artikel['artId']; ?>" <?php if ($inkOrd['artId'] == $Artikel['artId']) { echo 'selected'; } ?>>
                                        <?php echo $Artikel['artId'] . ' - ' . $Artikel['artOmschrijving']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                            
                            <br>
                            
                            <!-- <label>Leverancier ID:</label>
                            <input type="number" name="levId" value="<?php echo $inkOrd['levId']; ?>"><br>
                            <label>Artikel ID:</label>
                            <input type="number" name="artId" value="<?php echo $inkOrd['artId']; ?>"><br> -->
                            <label>Besteldatum:</label>
                            <input type="date" name="inkOrdDatum" value="<?php echo $inkOrd['inkOrdDatum']; ?>"><br>
                            <label>Aantal:</label>
                            <input type="number" name="inkOrdBestAantal" value="<?php echo $inkOrd['inkOrdBestAantal']; ?>"><br>
                            <label>Status:</label>
                            <input type="text" name="inkOrdStatus" value="<?php echo $inkOrd['inkOrdStatus']; ?>"><br>
                            <div class="formEnd">
                                <input type="submit" value="Submit">                            
                                <p><a id="cancel" href="inkoopRead.php">Cancel</a></p>
                            </div>

                        </form>

                        <div class="question">
                            <p><a href="inkoopCreateForm.php">Create inkooporder</a> </p>

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