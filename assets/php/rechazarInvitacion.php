<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


header('Content-Type: application/json');
session_start();


require("../config/config.php");
require("funciones.php");


require("../clases/persona.php");
require("../clases/jugador.php");
require("../clases/manager.php");
require("../clases/equipo.php");
require("../clases/invitacion.php");
require("../clases/logger.php");
require("../clases/notificador.php");



$conn = _connect();
$json = new stdClass();



switch($_SESSION['userLvl']) {
    case 1:
        $usuario = new Jugador($_SESSION['idUser']);
        break;

    case 2:
        $json->status	= "error";
        $json->msg		= "Sesion Invalida";
        echo json_encode($json);
        die();
}

if($_POST['action'] != "rechazarInvitacion") {
    $json->status	= "error";
    $json->msg		= "Acción no seteada";
}
else {
    
    
    $invitacion = new Invitacion($_POST['invitacion']);
    
    $invitacion->RechazarInvitacion();
    
    
    Notificador::Save($invitacion->equipo->manager, "invitacionRechazada", array($invitacion->jugador->nombre." ".$invitacion->jugador->apellido, $invitacion->equipo->nombre) );

    Logger::Save($invitacion->jugador, "invitacionRechazada", "El usuario id: ".$invitacion->jugador->id." - ".$invitacion->jugador->nombre." ".$invitacion->jugador->apellido." rechazo la invitacion a unirse al equipo id: ".$invitacion->equipo->id." - ".$invitacion->equipo->nombre);

    $json->status="ok";
}


echo json_encode($json);
die();

?>