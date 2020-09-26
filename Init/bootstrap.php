<?php
session_start();
spl_autoload_register("auto_load");

function auto_load($class)
{
    // DEBUG
    // var_dump($_SERVER['REQUEST_URI']);
    // echo "Nombre d'éléments dans l'url : " . count(explode("/", $_SERVER['REQUEST_URI']));

    if ($class == "article" or $class == "comment" or $class == "contact") {
        if (count(explode("/", $_SERVER['REQUEST_URI'])) >= 4) {
            require "../Classe/WB_data_" . $class . ".php";
        } else {
            require "Classe/WB_data_" . $class . ".php";
        }
    } elseif ($class == "formManager" or $class == "configManager" or $class == "userManager" or $class == "dataManager" or $class == "data" or $class == "toolbox" or $class == "dataManager" or $class == "DB") {

        if (count(explode("/", $_SERVER['REQUEST_URI'])) >= 4) {
            require "../Classe/WB_" . $class . ".php";
        } else {
            require "Classe/WB_" . $class . ".php";
        }
    } elseif ($class == "user") {
        if (count(explode("/", $_SERVER['REQUEST_URI'])) >= 4) {
            require "../Classe/WB_" . $class . ".php";
        } else {
            require "Classe/WB_" . $class . ".php";
        }
    } elseif ($class == "about") {

        if (count(explode("/", $_SERVER['REQUEST_URI'])) >= 4) {
            require "../Info/WB_" . $class . ".php";
        } else {

            require "Info/WB_" . $class . ".php";
        }
    } elseif ($class == "info") {
        if (count(explode("/", $_SERVER['REQUEST_URI'])) >= 4) {
            require "../Info/WB_" . $class . ".php";
        } else {

            require "Info/WB_" . $class . ".php";
        }
    }
}
