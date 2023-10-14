<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>update boeking</title>
</head>
<body>
    <?php 
    require 'nav.php';
    require 'Classes/Boeking.php';
    require 'Classes/Tocht.php';
    ?>

    <div class="content">
        <div class="accountPage">
            <div class="basCard">
                <div class="accountItems">
                    <h1>Update boeking:</h1>
                    <div class="accountForm">
                        <?php
                            $klantId = $_SESSION['klantId'];
                            $ID = $_GET['ID'];
                            $boekingUpdate = new Boeking();
                            $Boeking = $boekingUpdate->findBoeking($ID) ;
                            $tochten = new Tocht();
                            // var_dump($ID);
                        ?>

                    <div class="accountForm">
                        <form method="post" id="register" action="boekingUpdate.php" class="form">
                        <input type="hidden" name="ID" value="<?php echo $ID; ?>">

                        <label for="datepicker">Start Datum:</label>
                        <input type="date" id="datepicker" name="StartDatum" required min="<?php echo date('Y-m-d', strtotime('+1 week')); ?>" value="<?php echo $Boeking['StartDatum'];?>">
                            <label for="tochtId">Tocht:</label>
                            <select id="tochtId" name="FKtochtenID" required>
                                <?php
                                $tochtenArray = $tochten->getTochten();
                                $tochtIdArray = $tochten->getTochtWithId($Boeking['FKtochtenID']);
                                // $tochtOmschrijving = $tochtIdArray['Omschrijving'];
                                 ?>
                            <option value="<?php echo $Boeking['FKtochtenID'];?>"><?php echo $tochtIdArray['Omschrijving'] . ' (' . $tochtIdArray['Aantaldagen'] . ' dagen)'?></option>
                                <?php
                                    // var_dump($tochten);
                                    foreach ($tochtenArray as $tocht) {
                                        if ($tocht['ID'] !== $tochtIdArray['ID']) {
                                            echo '<option value="' . $tocht['ID'] . '">' . $tocht['Omschrijving'] . ' (' . $tocht['Aantaldagen'] . ' dagen)</option>';
                                        }
                                    }
                                ?>
                            </select>
                            <br>
    
                            <div class="formEnd">
                                <input type="submit" value="Submit">                            
                                <p><a id="cancel" href="boekingRead.php">Cancel</a></p>
                            </div>
                        </form> 

                        <!-- <div class="question">
                            <p>Alle Boekingen: <a href="artikelRead.php">artikel Read</a> </p>
                            <p>Maak nieuwe artikel: <a href="artikelCreateForm.php">artikel Create</a> </p>

                        </div> -->
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
    width: 110px;
    padding: 10px 15px;
    display: flex;
    justify-content: center;
    border-radius: 5px;
    cursor: pointer;
    margin: 0;
}

label {
    margin: 0;
}

select {
    width: 60%;
}
</style>
</html>