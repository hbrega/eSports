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



$conn = _connect();
$json = new stdClass();


if(!isset($_SESSION['idUser'])) {
	echo("[]");
	die();
}


if(!$_GET['q']) {
	$_GET['q']="";
}


if(strlen($_GET['q'])<3) {
	echo("[]");
	die();
}

//$user = new user($_SESSION['idUser']);

switch($_SESSION['userLvl']) {
    case 1:
	echo("[]");
	die();

    case 2:
        $usuario = new Manager($_SESSION['idUser']);
        break;
}



$sql="	SELECT u.id, CONCAT(u.nombre, ' ', u.apellido, ' (', u.email,')') as fullname, SUBSTRING_INDEX(u.email, '@', 1) userMail
		FROM jugadores j
        LEFT JOIN personas u ON j.idPersona = u.id
		LEFT JOIN equipos_jugadores tu ON u.id=tu.idJugador
			AND ".$_GET['equipo']."=tu.idEquipo
			AND tu.fechaBaja IS NULL
		LEFT JOIN equipos_invitaciones ti ON ti.idJugador=u.id
			AND ".$_GET['equipo']."=ti.idEquipo
			AND ti.fechaRespuesta IS NULL
		WHERE u.id <> ".$_SESSION['idUser']." 
			AND tu.idJugador IS NULL
			AND ti.id IS NULL
			AND u.nombre IS NOT NULL
		HAVING userMail LIKE '%".$_GET['q']."%'";


$result=$conn->query($sql) or trigger_error("Failed! SQL: $sql - Error: ".mysqli_error(), E_USER_ERROR);

$json = [];
while($row=$result->fetch_array()){
	$json[] = [
		'id'=>$row[0], 
		'text'=>$row[1]
	];
}


echo(json_encode($json));
die();

?>