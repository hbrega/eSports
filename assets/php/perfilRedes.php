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





if($_POST['action'] != "updateNetworks") {
    $json->status	= "error";
    $json->msg		= "Acción no seteada";
}
else if($_SESSION['userLvl'] != 1) {
    $json->status	= "error";
    $json->msg		= "Nivel de usuario no valido";
}
else {
    
    if(!(isset($_SESSION['idUser']) && isset($_SESSION['userLvl']) && isset($_SESSION['loginTime']))) {
    
        $json->status	= "error";
        $json->msg		= "Sesión Expirada";
    }
    else {

        $usuario = new Jugador($_SESSION['idUser']);

        $usuario->nickname 		= $_POST['nwtNickname'];

        $usuario->steamID		= $_POST['nwtSteam'];
        $usuario->discordID		= $_POST['nwtDiscord'];
        $usuario->psnID	        = $_POST['nwtPSN'];
        $usuario->xboxID		= $_POST['nwtXBOX'];

        $usuario->facebookURL   = $_POST['nwtFacebook'];
        $usuario->instagramURL	= $_POST['nwtInstagram'];
        $usuario->twitterURL    = $_POST['nwtTwitter'];

        $usuario->sobreMi       = $_POST['nwtSobreMi'];

			
        $usuario->ActualizarDatos();

        
        
        Logger::Save($usuario, "actualizoRedes", "El usuario: ".$usuario->id." modifico sus redes. Nickname: ".$usuario->nickname."  steamID: ".$usuario->steamID."  discordID: ".$usuario->discordID."  psnID: ".$usuario->psnID."  xboxID: ".$usuario->xboxID."  facebookURL: ".$usuario->facebookURL." instagramURL: ".$usuario->instagramURL." twitterURL: ".$usuario->twitterURL." Acerca de Mi: ".$usuario->sobreMi);

			
        $json->status="ok";
 
    }
}


echo json_encode($json);
die();

?>