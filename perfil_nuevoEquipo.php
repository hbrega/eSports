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

<script type="text/javascript">

    var cropper;
    var canvas;

	
	window.addEventListener('DOMContentLoaded', function () {
    	var avatar = document.getElementById('avatar');
      	var image = document.getElementById('cropImage');
      	var input = document.getElementById('inputFile');
      	var $progress = $('.progress');
      	var $progressBar = $('.progress-bar');
      	//var $alert = $('.alert');
      	var $modal = $('#modal');

      	$('[data-toggle="tooltip"]').tooltip();

		input.addEventListener('change', function (e) {
        	var files = e.target.files;
        	var done = function (url) {
          		input.value = '';
          		image.src = url;
          		//$alert.hide();
          		$modal.modal('show');
        	};

			var reader;
        	var file;
        	var url;

        	if (files && files.length > 0) {
          		file = files[0];

          		if (URL) {
            		done(URL.createObjectURL(file));
          		}
				else if (FileReader) {
            		reader = new FileReader();
            		reader.onload = function (e) {
              			done(reader.result);
            		};
            		reader.readAsDataURL(file);
          		}
        	}
			
			
		});

      	$modal.on('shown.bs.modal', function () {
        	cropper = new Cropper(image, {
          		aspectRatio: 1,
          		viewMode: 3,
        	});
      	}).on('hidden.bs.modal', function () {
        	cropper.destroy();
        	cropper = null;
      	});

		document.getElementById('crop').addEventListener('click', function () {
      		var initialAvatarURL;

		  	$modal.modal('hide');

        	if (cropper) {
          		canvas = cropper.getCroppedCanvas({
					width: 600,
					height: 600,
				});

				initialAvatarURL = avatar.src;
				avatar.src = canvas.toDataURL();
			}
		});
	});

	
	

	//crear equipo
	$("#teamSubmit").click(function(e) {
		
		e.preventDefault();
		var sinError=true;

		$("#teamForm").find("*").each(function() {
			$(this).removeClass("has-error");
			$(this).next("span.form-notice").remove();
		});

		$("#teamForm input[required]").each(function() {
			if($(this).val()=="") {
				$(this).addClass("has-error");
				$(this).after("<span class='form-notice'>Este campo es obligatorio</span>");
				
				sinError=false;
			}
		});
		
		if(canvas==undefined) {
			$("#inputFile").after("<span class='form-notice'>Es obligatorio subir un logo</span>");

			sinError=false;
		}
		
		if(sinError) {
			
			toggleOverlay("show");

			canvas.toBlob(function (blob) {
			
				var formData = new FormData();

				formData.append('logo', blob, 'logo.png');
				formData.append('teamName', $('#teamName').val());
				formData.append('teamAbout', $('#teamAbout').val());
				formData.append('action', 'newTeam');


				$.ajax('assets/php/perfil_nuevoEquipo.php', {
					method: 'POST',
					data: formData,
					processData: false,
					contentType: false,

					error: function () {
						alert("Ha ocurrido un error, en unos minutos intentelo nuevamente");
						//$alert.show().addClass('alert-warning').text('Upload error');
						toggleOverlay("hidden");
					},

					success: function () {
						window.location='perfil_listarEquipos.php';
						toggleOverlay("hidden");
					},

					complete: function () {
//						location.reload();
					},
				});


			});
			
		}
		
	});
	
	
	
	
</script>


<?php

require("_footer.php");

?>