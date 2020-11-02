<?php
header('Content-Type: application/json');

//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);

require("../config/config.php");
require("funciones.php");

require("../clases/persona.php");
require("../clases/notificador.php");


$json = new stdClass();

$unread=0;

if(!isset($_SESSION['idUser'])) {
	
	$json->qty		= 0;
	$json->unread	= 0;
	
}
else {

	$json->qty		= 0;
	$json->unread	= 0;
    
    /*    
	$user = new user($_SESSION['idUser']);
	
	$notif = notificator::Get($user, 10);
	
	$json->qty	= $notif['qty'];

	for($x=0; $x < $notif['qty']; $x++) {
		
		$json->rows[$x]['id']=$notif[$x]['id'];
		$json->rows[$x]['cell']=array($notif[$x]['title'], $notif[$x]['content'], $notif[$x]['link'], $notif[$x]['readDate']);

		if($notif[$x]['readDate']=="")
			$unread++;

	}
	$json->unread	= $unread;
    */
	
}
	

echo json_encode($json);
die();
?>