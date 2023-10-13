<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Boeking aanvragen</title>
</head>
<body>
    <?php 
    require 'nav.php';
    require 'Classes/Tocht.php';
    $tochten = new Tocht();
    ?>
    
    <div class="content">
        <div class="accountPage">
            <div class="basCard">
                <div class="accountItems">
                    <h1>Nieuwe boeking:</h1>
                    <?php 
                    $klantId = $_SESSION['klantId'];
    
                    ?>
                    <div class="accountForm">
                        <form method="post" id="register" action="boekingCreate.php" class="form">
                        <input type="hidden" name="klantId" value="<?php echo $klantId; ?>">

                        <label for="datepicker">Start Datum:</label>
                        <input type="date" id="datepicker" name="datepicker" required min="<?php echo date('Y-m-d', strtotime('+1 week')); ?>">
                            <label for="tochtId">Tocht:</label>
                            <select id="tochtId" name="tochtId" required>
                            <option value="" disabled selected>Selecteer een tocht:</option>
                                <?php
                                    $tochten = $tochten->getTochten();
                                    // var_dump($tochten);
                                    foreach ($tochten as $tocht) {
                                        echo '<option value="' . $tocht['ID'] . '">' . $tocht['Omschrijving'] . ' (' . $tocht['Aantaldagen'] . ' dagen)</option>';
                                    }
                                ?>
                            </select>
                            <br>
    
                            <div class="submitButton">
                                <input type="submit" name="create" value="Create Boeking" class="registerClass">
                            </div>
                        </form> 
                        <div class="redirect">
                            <p><a href="boekingRead.php"><i class='bx bx-message-alt-detail'></i> Boekingen inzien</a> </p>
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
        width: 250px;
        margin-left: 50px;
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