<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


header('Content-Type: application/json');
session_start();


require("../config/config.php");
require("funciones.php");


require("../clases/persona.php");
require("../clases/manager.php");
require("../clases/equipo.php");
require("../clases/logger.php");
require("../clases/notificador.php");





$conn = _connect();
$json = new stdClass();



if($_SESSION['userLvl'] != 2) {
    $json->status	= "error";
    $json->msg		= "Nivel de usuario no valido";
}
else {
    
    if(!(isset($_SESSION['idUser']) && isset($_SESSION['userLvl']) && isset($_SESSION['loginTime']))) {
    
        $json->status	= "error";
        $json->msg		= "Sesión Expirada";
    }
    else {

        $usuario = new Manager($_SESSION['idUser']);


        if(!$equipo = Equipo::Nuevo($_POST['teamName'], $usuario, $_POST['teamAbout'])) {
            $json->status="error";
            $json->msg="No se han podido cargar los datos del equipo.";
        }
        else {

            $uploadfile = $_FILES["logo"]["tmp_name"];
            $folderPath = "uploads/logos/";
            $arch		= $usuario->id."_".microtime(true)."_".$_FILES["logo"]["name"];

            if (!is_writable("../../".$folderPath) || !is_dir("../../".$folderPath)) {
                $json->status="error";
                $json->msg="No se puede escribir en el directorio destino";
            }
            else if (move_uploaded_file($_FILES["logo"]["tmp_name"], "../../".$folderPath.$arch)) {

                $equipo->logoURL =  $folderPath.$arch;
                $equipo->ActualizarLogo();
                
                Logger::Save($usuario, "nuevoEquipo", "El usuario id: ".$usuario->id." - ".$usuario->nombre." ".$usuario->apellido." creo el equipo id: ".$equipo->id." - ".$_POST['teamName']);

            }				

        }

        $json->status="ok";

        
        
    }
}


echo json_encode($json);
die();

?>