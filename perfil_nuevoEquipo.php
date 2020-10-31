<?php

require("_header.php");

?>
		<main class="site-content account-page" id="wrapper">

<?php
			require("_botoneraPerfil.php");
?>

			<div class="account-content">
				<h2 class="h4">Nuevo Equipo</h2>

				<form action="#" class="form" name="teamForm" id="teamForm" enctype="multipart/form-data">
					
					
					<h6 class="h6">Datos Básicos</h6>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<input type="text" class="form-control" name="teamName" id="teamName" placeholder="El Nombre de tu Equipo" maxlength="100" value="" required>
							</div>
						</div>
					</div>
				
					
					<h6 class="h6">El Logo de mi Equipo</h6>
					<div class="row">
						<div class="col-md-4">
							<label class="label" data-toggle="tooltip" title="Hace click aqui para cambiar el logo de tu equipo">
								<img class="img-fluid mx-auto" id="avatar" src="assets/img/team_placeholder.png" alt="avatar">
								<input type="file" class="sr-only" id="inputFile" name="image" accept="image/*">
							</label>
						</div>
						
					</div>
					

					<h6 class="h6 mt-4">Descripcion del Equipo</h6>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<textarea name="teamAbout" id="teamAbout" rows="3" class="form-control" placeholder="Descripcion del Equipo..."  maxlength="1000"></textarea>
							</div>
						</div>					
					</div>

					
					<div class="form-group">
						<input type="hidden" name="action" value="newTeam">

						<button class="btn btn-secondary" id="teamSubmit">Crear Equipo</button>
					</div>

				</form>				
			
			</div>
		</main>
		

		<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="modalLabel">Recorta el logo de equipo</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>

					<div class="modal-body">
						<div class="img-container">
							<img id="cropImage" src="assets/img/team_placeholder.png" class="w-100">
						</div>
					</div>

					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
						<button type="button" class="btn btn-primary" id="crop">Recortar</button>
					</div>
				</div>
			</div>
    	</div>


<?php

require("_middle.php");
									   
?>



<?php

require("_footer.php");

?>