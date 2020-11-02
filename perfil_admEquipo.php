<?php

require("_header.php");

if($_SESSION['userLvl'] != 2) {
	echo("<script>window.location='perfil_nuevoEquipo.php'</script>");
	die();
}


if(!$usuario->ListarEquipos()) {
	echo("<script>window.location='perfil_nuevoEquipo.php'</script>");
	die();
}


$equipo = new Equipo($_GET['idEquipo']);

if($equipo->manager->id != $usuario->id) {
	echo("<script>window.location='index.php'</script>");
	die();
}





?>
		<main class="site-content account-page" id="wrapper">

<?php
			require("_botoneraPerfil.php");
?>

			<div class="account-content">
				<h2 class="h4">Administrar equipo</h2>

            
				<div class="col-lg-12">

					<div class="row align-items-center">
						<div class="col-4 col-md-4 col-xl-3">
							
							<img class="w-100" src="<?=$equipo->logoURL?>" alt="">

						</div>
						<div class="col-8 col-md-8 col-xl-9">
							<h2 class="player-info-title h1 text-uppercase d-flex my-auto" style="color: #000"><?=$equipo->nombre?></h2>
						</div>
					</div>


					<p>
						<?=str_replace(PHP_EOL,"<br>",$equipo->descripcion)?>
					</p>

					
					
					<div class="row mt-sm-auto mb-sm-auto">

						<?=$teammatesCards?>

						
						<div class="col-sm-6 col-lg-3">
							<div class="team-item team-item--v4 team-3" style="transform: scale(0.5, 0.5);" id="invitePlayer">
								<a href="javascript: void(0)" class="team-item__thumbnail" >
									<div class="team-item__bg-holder">
										<div class="team-item__bg" style="background-image: url(assets/img/samples/team-selection-character-01-bg.jpg);"></div>
									</div>
									<div style="background-image: url(assets/img/invite.png);" class="team-item__img-primary"></div>
								</a>
								<span class="team-item__subtitle h6" style="font-size: 2em;">Invitar Jugador</span>
							</div>
						</div>
						
					</div>

					<div class="text-right">
						<button class="btn btn-danger" id="deleteTeam">ELiminar Equipo</button>
					</div>
					
				</div>
                
            </div>
		</main>


<?php

require("_middle.php");
									   
?>



<?php

require("_footer.php");

?>