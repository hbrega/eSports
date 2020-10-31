<?php

require("_header.php");


$inviteTable = "";
/*
if($invites = $user->GetInvites()) {

	inviteTable="
				<h4 class='h5'>Solicitudes</h2>
    
				<table class='table logsTable'>
					<thead>
						<tr>
							<th>Fecha</th>
							<th>Notificacion</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
	";
    
	foreach($invites as $invite) {
		
		inviteTable.="
						<tr>
							<td class='align-middle'>18 Marzo 2020</td>
							<td class='align-middle'>".$invite->sender->name." ".$invite->sender->surname." - ".$invite->sender->email." te invito a unirte al equipo ".$invite->team->name."</td>
							<td class='align-middle text-right'>
								<button type='button' class='btn btn-primary' data-invitation='".$invite->id."'>Aceptar</button>							
								<button type='button' class='btn btn-danger' data-invitation='".$invite->id."'>Rechazar</button>							
							</td>
						</tr>
		";
	}
	
	inviteTable.="
					</tbody>
				</table>
	";
	
}
*/




$logsTable = "";
if($logs = Logger::GetLogs($usuario)) {
	
	$logsTable="
				<h4 class='h5'>Logs</h2>

                <table class='table inviteTable'>
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


                <?=$inviteTable?>
				

                <?=$logsTable?>
                
			</div>

        </main>

<?php

require("_middle.php");
									   
?>


<?php

require("_footer.php");

?>