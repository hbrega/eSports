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





if($_POST['action'] != "updateProfile") {
    $json->status	= "error";
    $json->msg		= "Acción no seteada";
}
else {
    
    if(!(isset($_SESSION['idUser']) && isset($_SESSION['userLvl']) && isset($_SESSION['loginTime']))) {
    
        $json->status	= "error";
        $json->msg		= "Sesión Expirada";
    }
    else {
        
        switch($_SESSION['userLvl']) {
            case 1:
                $usuario = new Jugador($_SESSION['idUser']);
                break;

            case 2:
                $usuario = new Manager($_SESSION['idUser']);
                break;
        }

    
        $usuario->nombre           = $_POST['pflName'];
        $usuario->apellido         = $_POST['pflSurname'];
        $usuario->documento        = $_POST['pflIdNumber'];
        $usuario->fechaNacimiento  = $_POST['pflDOB'];

        
        $usuario->ActualizarDatosComunes(); //en tabla personas

        
        Logger::Save($usuario, "actualizoDatos", "El usuario: ".$usuario->id." modifico sus datos personales. Nombre: ".$usuario->nombre."  Apellido: ".$usuario->apellido."  Documento: ".$usuario->documento." Fecha de Nacimiento: ".$usuario->fechaNacimiento.");

        $json->status="ok";
        
    }
}


    
echo json_encode($json);
die();

?>