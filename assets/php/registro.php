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





$conn = _connect();
$json = new stdClass();





if($_POST['action'] != "register") {
    $json->status	="error";
    $json->msg		="Acción no seteada";
}
else {
    
    if($_POST['rgtRol'] == 1) {
        $usuario = Jugador::Nuevo($_POST['rgtEmail'], $_POST['rgtPass'], $_POST['rgtFnac']);        

//        logger::Save($user, "registroJugador", "Se registro un jugador con el id: ".$usuario->id." y el siguiente email: ".$usuario->email);
    }
    else  if($_POST['rgtRol'] == 2) {
    
        $usuario = Manager::Nuevo($_POST['rgtEmail'], $_POST['rgtPass'], $_POST['rgtFnac']);        
        
        
//        logger::Save($user, "registroManager", "Se registro un manager con el id: ".$usuario->id." y el siguiente email: ".$usuario->email);
    }


    //$param = array();
    //notificator::Save($user, "bienvenida", $param);
    
    
    //$param = array();
    //notificator::Save($user, "faltaInfo", $param);
        
        
    $_SESSION['idUser']				= $usuario->id;
    $_SESSION['loginTime']			= time();

    $json->status	="ok";
}


session_commit();

echo json_encode($json);
die();

?>