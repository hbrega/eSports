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



    

$jugadores = $equipo->ListarJugadores();
$jugTaj="";

if($jugadores) {
    foreach($jugadores as $jugador) {

        $jugTaj.="	
            <div class='col-sm-6 col-lg-4'>
                <div class='team-item team-item--v4 team-3'>
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
                    <div class='h4 btnExpulsar' style='font-size: 2em; padding: 6px; background-color: #F00; color: #fff;' data-jugador='".$jugador->id."'>EXPULSAR</div>
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


					<p class="mt-4 mb-4">
						<?=str_replace(PHP_EOL,"<br>",$equipo->descripcion)?>
					</p>

					
					
					<div class="row mt-sm-auto mb-sm-auto">

						<?=$jugTaj?>

						<div class="col-sm-6 col-lg-3">
							<div class="team-item team-item--v4 team-3" id="invitarJugador">
								<a href="javascript: void(0)" class="team-item__thumbnail" >
									<div class="team-item__bg-holder">
										<div class="team-item__bg" style="background-image: url(assets/img/selection_bg.jpg);"></div>
									</div>
									<div style="background-image: url(assets/img/invite.png);" class="team-item__img-primary"></div>
								</a>
								<span class="team-item__subtitle h6" style='font-size: 1.5em;'>Invitar Jugador</span>
							</div>
						</div>
						
					</div>

                    
                    <?=$invTabla?>

                    
					<div class="text-right">
						<button class="btn btn-danger" id="borrarEquipo">ELiminar Equipo</button>
						<a href="perfil_listarEquipos.php"><button class="btn btn-warning" id="volver">Volver</button></a>
					</div>
					
				</div>
            </div>





			<div class="modal fade" id="modalInvite" role="dialog" aria-labelledby="modalLabelInvite" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="modalLabelInvite">Invita Jugadores</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>

						<div class="modal-body">
							
							<form action="#" class="form" name="ivtForm" id="ivtForm">

								<p>Ingrese el Correo Electronico de la persona a invitar</p>
                                
								<div class="form-group">
									<select name="ivtPlayer" id="ivtPlayer" class="form-control" style="width: 100%">
										<option value=""></option>
									</select>
								</div>
                                
								<input type="hidden" name="idEquipo" value="<?=$_GET['idEquipo']?>">
								<input type="hidden" name="action" value="invitarJugador">
							</form>							
						</div>

						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
							<button type="button" class="btn btn-primary" id="enviarInvitacion">Invitar</button>
						</div>
					</div>
				</div>
			</div>


        </main>



<?php

require("_middle.php");
									   
?>

<script type="text/javascript">


    $("#invitarJugador").click(function() {
		$("#modalInvite").modal('show');
	});


    $("#ivtPlayer").select2({
		language: "es",
		minimumInputLength: 3,
		ajax: {
			url: 'assets/php/checkInvite.php',
			dataType: 'json',
            data: function (params) {
                return {
                    q: params.term,
                    page: params.page,
                    equipo: '<?=$_GET['idEquipo']?>'
                };
            },
            delay: 250, 
			cache: true,
			placeholder: '',
			dropdownParent: $("#modalInvite"),
			tags: true,
			language: 'es',

			processResults: function (data) {
				return {
					results: data
				};
			}
		}
	});

    
    
    
    
	$("#enviarInvitacion").click(function(e) {
		
		e.preventDefault();
		var sinError=true;

		
		$("#ivtForm").find("*").each(function() {
			$(this).removeClass("has-error");
			$(this).next("span.form-notice").remove();
		});


        if( $("#ivtPlayer").val() == "" ) {
            $("#ivtPlayer").addClass("has-error");
            $("#ivtPlayer").after("<span class='form-notice'>Este campo es obligatorio</span>");

            sinError=false;
		}

        
		if(sinError) {
			
			toggleOverlay("show");

			$.post("assets/php/invitar.php", $("#ivtForm").serialize(), function(json) {
				$("#ivtPlayer").val(null).trigger('change');
				$("#ivtMail").val("");
				
				if(json.status=='ok') {
                    location.reload();
                    
					//$("#modalInvite").modal('hide');
					//toggleOverlay("hide");
					//UpdateNotifications(true);
				
				}
				else {
					alert(json.msg);
					toggleOverlay("hide");
				}


			});

		}
	});
    
    
    
   
    //expulsar jugador
    $(".btnExpulsar").click(function(e) {
    
		if(prompt("Seguro que desea eliminar expulsar al jugador? escriba CONFIRMAR para proceder") == "CONFIRMAR") {
			
			toggleOverlay("show");
            var jugadorID = $(this).data("jugador");
//            alert(playerID);

			$.post("assets/php/expulsarJugador.php", {action: 'expulsarJugador', jugador: jugadorID, equipo: '<?=$_GET['idEquipo']?>'}, function(json) {

				if(json.status=='ok') {
					location.reload();
					toggleOverlay("hide");
				}
				else {
					alert(json.msg);
					toggleOverlay("hide");
				}
			});
		}
    });
    
    
    
    
	//eliminar Equipo
	$("#borrarEquipo").click(function(e) {

		if(prompt("Seguro que desea eliminar el equipo? escriba CONFIRMAR para proceder") == "CONFIRMAR") {
			
			toggleOverlay("show");

			$.post("assets/php/eliminarEquipo.php", {action: 'borrarEquipo', equipo: '<?=$_GET['idEquipo']?>'}, function(json) {

				if(json.status=='ok') {
					window.location = 'perfil_listarEquipos.php';
					toggleOverlay("hide");
				}
				else {
					alert(json.msg);
					toggleOverlay("hide");
				}
			});
		}
	});
	    
    
    
    
</script>    
    
    
<?php

require("_footer.php");

?>