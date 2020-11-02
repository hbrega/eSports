<?php
header('Content-Type: application/json');

//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);

session_start();

require("../config/config.php");
require("funciones.php");

require("../clases/persona.php");
require("../clases/jugador.php");
require("../clases/manager.php");
require("../clases/notificador.php");


$json = new stdClass();

if(!isset($_POST['id'])) {
    die();
}


switch($_SESSION['userLvl']) {
    case 1:
        $usuario = new Jugador($_SESSION['idUser']);
        break;

    case 2:
        $usuario = new Manager($_SESSION['idUser']);
        break;
}

Notificador::MarcarLeido($_POST['id'], $usuario);

die();
?>