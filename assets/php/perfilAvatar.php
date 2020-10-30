<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


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



	$uploadfile = $_FILES["avatar"]["tmp_name"];
	$folderPath = "uploads/avatars/";
	$arch		= $usuario->id."_".microtime(true)."_".$_FILES["avatar"]["name"];
	
	
	if (!is_writable("../../".$folderPath) || !is_dir("../../".$folderPath)) {
//		$json->status="error";
//		$json->msg="No se puede escribir en el directorio destino";
	}
	else if (move_uploaded_file($_FILES["avatar"]["tmp_name"], "../../".$folderPath.$arch)) {

        $usuario->avatarURL     = $folderPath.$arch;
		$usuario->ActualizarAvatar();

	}
	
	Logger::Save($usuario, "usuarioAvatar", "El usuario ".$usuario->id." cambio su avatar al siguiente: ".substr($folderPath.$arch, 6));

}
    
die();

?>