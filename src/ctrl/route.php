<?php
//include("../modules/autoload.php");
require_once("autoload.php");

if(isset($_POST) && isset($_POST["input"]))
{
    $input = $_POST["input"];
    switch($input)
    {
        case "help_generic": show_help();
        break;
        case "whoami": whoami();
        break;
        case "people_in_space": people_in_space();
        break;
        case "iss_location": iss_location();
        break;
        /*case "showcv": showcv(); // déplacé en front
        break;*/
    }
}