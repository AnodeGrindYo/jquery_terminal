<?php
// Afficher les erreurs à l'écran
ini_set('display_errors', 1);
// Afficher les erreurs et les avertissements
//error_reporting(e_all);

//var_dump($_POST);
//include("autoload.php");
//require_once("autoload.php");
require_once("../modules/module_help/src/help.php");
require_once("../modules/module_whoami/src/whoami.php");
require_once("../modules/module_nasa/nasa.php");
//require_once("../modules/module_iss_location/src/iss_location.php"); // ces deux modules sont désactivés car les api sont en http, et moi en https
/*require_once("../modules/module_people_in_space/src/people_in_space.php");*/



if(isset($_POST) && isset($_POST["input"]))
{
    /*echo $_POST["input"];*/
    $input = $_POST["input"];
    switch($input)
    {
        case "help_generic": show_help();
        break;
        case "iss_live": iss_live();
        break;
        case "whoami": whoami();
        break;
        case "apod": apod();
        break;
        case "where_is_iss": where_is_iss();
        break;
        /*case "people_in_space": people_in_space();
        break;
        case "iss_location": iss_location();
        break;*/
        /*case "showcv": showcv(); // déplacé en front
        break;*/
    }
}