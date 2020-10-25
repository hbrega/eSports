<?php

require("_header.php");

    

//para testear altas de jugadores
//$jugador = Jugador::Nuevo("test02@test.com", "1234", "1982-05-15");
    

$jugador = new Jugador(1);

/*
$jugador->nombre           = "Hernan";
$jugador->apellido         = "Brega";

$jugador->documento        = "29501053";

$jugador->nickname         = "snowburn";

$jugador->steamID          = "https://steamcommunity.com/id/snowburn";
$jugador->psnID            = "https://psn.com/profile/ph_snowburn";
$jugador->xboxID           = "https://xbox.live/snowburn";
$jugador->discordID        = "snowburn#6346";

$jugador->facebookURL      = "https://facebook.com/hernanbrega";
$jugador->instagramURL     = "https://instagram.com/hernanbrega";
$jugador->twitterURL       = "https://twitter.com/hbrega";

$jugador->sobreMi          = "Admin y Jugador del sitio";

$jugador->ActualizarDatosComunes(); //en tabla personas
$jugador->ActualizarDatos(); //en tabla jugadores
*/



//$manager = Manager::Nuevo("manager01@test.com", "1234", "1980-01-01");
$manager = new Manager(3);

//echo($manager->calcularEdad());
/*
$manager->nombre        = "Juan";
$manager->apellido      = "Lopez";
$manager->documento     = "32632531";
$manager->linkedinID    = "https://ar.linkedin.com/in/juanlopez";

$manager->ActualizarDatosComunes(); //en tabla personas
$manager->ActualizarDatos(); //en tabla managers
*/

//login OK
//$jugador = Jugador::Login("test02@test.com", "1234");


//login FAIL

//if(!$jugador = Jugador::Login("mailfalso@test.com", "1234")) {
//    echo("Login Incorrecto");
//}




//$equipo = Equipo::Nuevo("Equipo Prueba 001", $manager, "Este es un equipo de prueba!!");


$equipo = new Equipo(1);

//$equipo->AgregarJugador(new Jugador(1));
//$equipo->AgregarJugador(new Jugador(2));
//$equipo->EliminarJugador(new Jugador(2));
//$equipo = new Equipo(1); //NO OLVIDAR ACTUALIZAR!!!!
    



//$invitacion = Invitacion::Invitar(new Jugador(2), $equipo);


//$jugador2 = new Jugador(2);
//$invitaciones = $jugador2->ListarInvitaciones();



//$invitacion3 = new Invitacion(3);
//$invitacion3->RechazarInvitacion();

//$invitacion3 = new Invitacion(5);
//$invitacion3->AceptarInvitacion();

?>

<pre>
<?php print_r($jugador)?>
<?php print_r($manager)?>
<?php print_r($equipo)?>
<?php //print_r($invitacion)?>
<?php //print_r($invitaciones)?>
</pre>


<?php

require("_footer.php")

?>