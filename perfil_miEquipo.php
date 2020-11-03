<?php

require("_header.php");

if($_SESSION['userLvl'] != 1) {
	echo("<script>window.location='perfil.php'</script>");
	die();
}


if(!$equipo = $usuario->ListarEquipos()) {
	echo("<script>window.location='perfil.php'</script>");
	die();
}



//manager
$manTaj="	
    <div class='col-sm-6 col-lg-3'>
        <div class='team-item team-item--v4 team-3' style='transform: scale(0.5, 0.5);'>
            <a href='manager.php?id=".$equipo->manager->id."' class='team-item__thumbnail'>
                <div class='team-item__bg-holder'>
                    <div class='team-item__bg' style='background-image: url(assets/img/samples/team-selection-character-01-bg.jpg);'></div>
                </div>
                <div style='background-image: url(".$equipo->manager->avatarURL.");' class='team-item__img-primary'></div>
            </a>
            <p class='team-item__subtitle h6' style='font-size: 2em;'>
                <a href='manager.php?id=".$equipo->manager->id."'>
                    ".($equipo->manager->nombre==""?"$equipo->manager->email":$equipo->manager->nombre.' '.$equipo->manager->apellido)."
                </a>	
            </p>
        </div>
    </div>
    ";




$jugadores = $equipo->ListarJugadores();
$jugTaj="";

if($jugadores) {
    foreach($jugadores as $jugador) {

        $jugTaj.="	
            <div class='col-sm-6 col-lg-3'>
                <div class='team-item team-item--v4 team-3' style='transform: scale(0.5, 0.5);'>
                    <a href='jugador.php?id=".$jugador->id."' class='team-item__thumbnail'>
                        <div class='team-item__bg-holder'>
                            <div class='team-item__bg' style='background-image: url(assets/img/samples/team-selection-character-01-bg.jpg);'></div>
                        </div>
                        <div style='background-image: url(".$jugador->avatarURL.");' class='team-item__img-primary'></div>
                    </a>
                    <p class='team-item__subtitle h6' style='font-size: 2em;'>
                        <a href='jugador.php?id=".$jugador->id."'>
                            ".($jugador->nombre==""?"$jugador->email":$jugador->nombre.' '.$jugador->apellido)."
                        </a>	
                    </p>
                    <p class='team-item__subtitle h6' style='font-size: 1.5em;'>
                        <a href='jugador.php?id=".$jugador->id."'>
                            ".$jugador->nickname."
                        </a>
                    </p>
                </div>
            </div>
        ";
    }
}


    
    

//invitaciones
$invTabla = "";
if($invitaciones = $equipo->ListarInvitaciones()) {
	
	$invTabla="
				<h4 class='h5 mt-4 mb-3'>Invitaciones Pendientes</h2>

                <table class='table'>
					<thead>
						<tr>
							<th>Fecha</th>
							<th>Jugador</th>
						</tr>
					</thead>
					<tbody>
	";
	
	foreach($invitaciones as $invitacion) {
		$invTabla.="
						<tr>
							<td class='align-middle'>".$invitacion->fechaEnvio."</td>
							<td class='align-middle'>".$invitacion->jugador->nombre." ".$invitacion->jugador->apellido." (".$invitacion->jugador->email.")</td>
						</tr>
		";
	}
	
	$invTabla.="
					</tbody>
				</table>
	";
}




?>
		<main class="site-content account-page" id="wrapper">

<?php
			require("_botoneraPerfil.php");
?>

			<div class="account-content">
				<h2 class="h4">Mi equipo</h2>

            
				<div class="col-lg-12">

					<div class="row align-items-center">
						<div class="col-4 col-md-4 col-xl-3">
							
							<img class="w-100" src="<?=$equipo->logoURL?>" alt="">

						</div>
						<div class="col-8 col-md-8 col-xl-9">
							<h2 class="player-info-title h1 text-uppercase d-flex my-auto" style="color: #000"><?=$equipo->nombre?></h2>
						</div>
					</div>


					<p class="mt-4 mb-4">
						<?=str_replace(PHP_EOL,"<br>",$equipo->descripcion)?>
					</p>

					
					
                    
                    <p class="h5">Manager</p>
					<div class="row mt-sm-auto mb-sm-auto">

                        <?=$manTaj?>

					</div>
                    
                    
                    <h2 class="h5">Jugadores</h2>
					<div class="row mt-sm-auto mb-sm-auto">

						<?=$jugTaj?>

					</div>


                    
                    

                    
					<div class="text-right">
						<button class="btn btn-danger" id="abandonarEquipo">Abandonar Equipo</button>
					</div>
					
				</div>
            </div>




        </main>



<?php

require("_middle.php");
									   
?>

<script type="text/javascript">



    
    
    
    
    
</script>    
    
    
<?php

require("_footer.php");

?>