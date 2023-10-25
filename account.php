<?php
require 'database/database.php';

require 'function.php';
switch($rights) {
    case "admin":
        header("location: menuAdmin.php");
        break;
    case "management":
        header("location: menuManagement.php");
        break;
    case NULL || 'NULL':
        header("location: menuKlant.php");
        break;
    default:
        break;

}

?>