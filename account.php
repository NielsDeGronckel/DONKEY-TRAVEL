<?php
require 'database.php';

require 'function.php';
switch($rights) {
    case "afdelingsHoofd":
        header("location: menuAfdelingsHoofd.php");
        break;
    case "magazijnMedewerker":
        header("location: menuMagazijnMedewerker.php");

        break;
    case "magazijnMeester":
        header("location: menuMagazijnMeester.php");
        break;
    case "bezorger":
        header("location: menuBezorger.php");

        break;
    case "verkoper":
        header("location: menuVerkoper.php");

        break;
    case "inkoper":
        header("location: menuInkoper.php");

        break;
    case NULL:
            header("location: menuKlant.php");
    
            break;
    default:
        break;

}

?>