<?php

require("_header.php");

if(!$equipos = $usuario->ListarEquipos()) {
	echo("<script>window.location='perfil_nuevoEquipo.php'</script>");
	die();
}


$eqTarj="";
foreach($equipos as $equipo) {
    
	
	$eqTarj.=" <div class='col-sm-6 col-lg-4' style='margin-bottom: 50px;'>
					<div class='team-item team-item--v4 team-3'>
						<a href='perfil_admEquipo.php?idEquipo=".$equipo->id."' class='team-item__thumbnail'>
							<div class='team-item__bg-holder'>
								<div class='team-item__bg' style='background-image: url(assets/img/selection_bg.jpg);'></div>
							</div>
							<div style='background-image: url(".$equipo->logoURL.");' class='team-item__img-primary'></div>
						</a>
						<span class='team-item__subtitle h6'>".$equipo->nombre."</span>
					</div>
				</div>";
    }




?>
		<main class="site-content account-page" id="wrapper">

<?php
			require("_botoneraPerfil.php");
?>

			<div class="account-content">
				<h2 class="h4">Mis Equipos</h2>

            
				<div class="col-lg-12">
					<div class="row mt-sm-auto mb-sm-auto">

						<?=$eqTarj?>

						<div class="col-sm-6 col-lg-4">
							<div class="team-item team-item--v4 team-3" id="nuevoEquipo">
								<a href="perfil_nuevoEquipo.php" class="team-item__thumbnail" >
									<div class="team-item__bg-holder">
										<div class="team-item__bg" style="background-image: url(assets/img/selection_bg.jpg);"></div>
									</div>
									<div style="background-image: url(assets/img/invite.png);" class="team-item__img-primary"></div>
								</a>
								<span class="team-item__subtitle h6">Nuevo Equipo</span>
							</div>
						</div>

                        
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