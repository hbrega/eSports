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
require("../clases/logger.php");
require("../clases/notificador.php");





$conn = _connect();
$json = new stdClass();





if($_POST['action'] != "register") {
    $json->status	= "error";
    $json->msg		= "Acción no seteada";
}
else {
    
    if($_POST['rgtRol'] == 1) {
        $usuario = Jugador::Nuevo($_POST['rgtEmail'], $_POST['rgtPass'], $_POST['rgtFnac']);        

        Logger::Save($usuario, "registroJugador", "Se registro un jugador con el id: ".$usuario->id." y el siguiente email: ".$usuario->email);
    }
    else  if($_POST['rgtRol'] == 2) {
    
        $usuario = Manager::Nuevo($_POST['rgtEmail'], $_POST['rgtPass'], $_POST['rgtFnac']);        
        
        
        Logger::Save($usuario, "registroManager", "Se registro un manager con el id: ".$usuario->id." y el siguiente email: ".$usuario->email);
    }


    $param = array();
    Notificador::Save($usuario, "registro", $param);
    
    
    $param = array();
    Notificador::Save($usuario, "faltaInfo", $param);
        
        
    $_SESSION['idUser']				= $usuario->id;
    $_SESSION['userLvl']			= $usuario->tipoPersona;
    $_SESSION['loginTime']			= time();
    $_SESSION['ShowNotifications']	= true;

    
    $json->status	= "ok";
}


session_commit();

echo json_encode($json);
die();

?>