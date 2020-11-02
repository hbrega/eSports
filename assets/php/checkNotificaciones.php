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

$unread=0;

if(!isset($_SESSION['idUser'])) {
	
	$json->qty		= 0;
	$json->unread	= 0;
	
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

	$notif = Notificador::Cargar($usuario, 10);
	
	$json->qty	= $notif['qty'];

	for($x=0; $x < $notif['qty']; $x++) {
		
		$json->rows[$x]['id']=$notif[$x]['id'];
		$json->rows[$x]['cell']=array($notif[$x]['titulo'], $notif[$x]['contenido'], $notif[$x]['link'], $notif[$x]['fechaLectura']);

		if($notif[$x]['fechaLectura']=="")
			$unread++;

	}
	$json->unread	= $unread;
    
}
	

echo json_encode($json);
die();
?>