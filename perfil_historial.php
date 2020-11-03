<?php

require("_header.php");


//invitaciones
$invitaTable = "";
if($usuario->tipoPersona == 1) {
    if($invitaciones = $usuario->ListarInvitaciones()) {

        $invitaTable="
                    <h4 class='h5'>Solicitudes</h2>

                    <table class='table invitacionTable'>
                        <thead>
                            <tr>
                                <th>Fecha</th>
                                <th>Notificacion</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
        ";

        foreach($invitaciones as $invitacion) {
            $invitaTable.="
                            <tr>
                                <td class='align-middle'>".$invitacion->fechaEnvio."</td>
                                <td class='align-middle'>".$invitacion->equipo->manager->nombre." ".$invitacion->equipo->manager->apellido." (".$invitacion->equipo->manager->email.") te invito a unirte al equipo ".$invitacion->equipo->nombre."</td>
                                <td class='align-middle text-right'>
                                    <button type='button' class='btn btn-primary' data-invitacion='".$invitacion->id."'>Aceptar</button>
                                    <button type='button' class='btn btn-danger' data-invitacion='".$invitacion->id."'>Rechazar</button>
                                </td>
                            </tr>
            ";
        }

        $invitaTable.="
                        </tbody>
                    </table>
        ";

    }
}




//log
$logsTable = "";
if($logs = Logger::GetLogs($usuario)) {
	
	$logsTable="
				<h4 class='h5'>Logs</h2>

                <table class='table logsTable'>
					<thead>
						<tr>
							<th>Fecha</th>
							<th>Descripcion</th>
						</tr>
					</thead>
					<tbody>
	";
	
	foreach($logs as $log) {
		$logsTable.="
						<tr>
							<td class='align-middle'>".$log->fechaAlta."</td>
							<td class='align-middle'>".$log->descripcion."</td>
						</tr>
		";
	}
	
	$logsTable.="
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
				<h2 class="h4">Solicitudes &amp; Logs</h2>


                <?=$invitaTable?>
				

                <?=$logsTable?>
                
			</div>

        </main>

<?php

require("_middle.php");
									   
?>

<script type="text/javascript">
    
	$(".invitacionTable button.btn-primary").click(function(e) {
		$.post("assets/php/aceptarInvitacion.php", {invitacion: $(this).data("invitacion"), action: 'aceptarInvitacion'}, function(json) {
			if(json.status=='ok') {
				window.location = "perfil_miEquipo.php"
				toggleOverlay("hide");
			}
			else {
				alert(json.msg);
				toggleOverlay("hide");
			}
		});
	});

	$(".invitacionTable button.btn-danger").click(function(e) {
		$.post("assets/php/rechazarInvitacion.php", {invitacion: $(this).data("invitacion"), action: 'rechazarInvitacion'}, function(json) {
			if(json.status=='ok') {
				location.reload();
				toggleOverlay("hide");
			}
			else {
				alert(json.msg);
				toggleOverlay("hide");
			}
		});
	});

</script>

<?php

require("_footer.php");

?>