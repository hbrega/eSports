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





if($_POST['action'] != "login") {
    $json->status	= "error";
    $json->msg		= "Acción no seteada";
}
else {
    
    
    if(!Persona::buscarEmail($_POST['lgnEmail'])) {    

        Logger::Save("", "falloLoginUsuarioDesconocido", "Intento fallido de login, usuario desconocido, email: ".$_POST['lgnEmail']);

        $json->status	="error";
        $json->msg		="Usuario o Clave incorrecto";        
        
    }
    else {
        
        $tipoUsuario = Persona::buscarTipoPersona($_POST['lgnEmail']);
        
        
        switch($tipoUsuario) {
                
            case 1:

                if($usuario = Jugador::Login($_POST['lgnEmail'], $_POST['lgnPass'])) {                    
                    

					Logger::Save($usuario, "loginJugador", "Login correcto, usuario id: ".$usuario->id." - ".$usuario->nombre." ".$usuario->apellido." - ".$_POST['lgnEmail']);


                    
                    if($usuario->nombre == "" || $usuario->apellido == "" || $usuario->documento == "") {
						$param = array();
						//Notificador::Save($user, "faltaInfo", $param);
					}
					

                    
					$_SESSION['idUser']				= $usuario->id;
					$_SESSION['userLvl']			= $usuario->tipoPersona;
					$_SESSION['loginTime']			= time();
					$_SESSION['ShowNotifications']	= true;
					
					$json->status	= "ok";
                }
                else {

                    Logger::Save($usuario, "falloLogin", "Intento fallido de login, email: ".$_POST['lgnEmail']);

				    $json->status	="error";
				    $json->msg		="Usuario o Clave incorrecto";
                    
                }                    
                break;
                
            case 2:
                
                if($usuario = Manager::Login($_POST['lgnEmail'], $_POST['lgnPass'])) {                    
                    

					Logger::Save($usuario, "loginManager", "Login correcto, manager id: ".$usuario->id." - ".$usuario->nombre." ".$usuario->apellido." - ".$_POST['lgnEmail']);


                    
                    if($usuario->nombre == "" || $usuario->apellido == "" || $usuario->documento == "") {
						$param = array();
						//Notificador::Save($user, "faltaInfo", $param);
					}
					

					$_SESSION['idUser']				= $usuario->id;
					$_SESSION['userLvl']			= $usuario->tipoPersona;
					$_SESSION['loginTime']			= time();
					$_SESSION['ShowNotifications']	= true;
					
					$json->status	= "ok";
                }
                else {

                    logger::Save($usuario, "falloLogin", "Intento fallido de login, email: ".$_POST['lgnEmail']);

				    $json->status	="error";
				    $json->msg		="Usuario o Clave incorrecto";
                    
                }                    
                break;
        }
    }
    
    
}
    
session_commit();

echo json_encode($json);
die();

?>