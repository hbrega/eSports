<?php

require("_header.php");

?>
		<main class="site-content account-page" id="wrapper">

			<?php
			require("_botoneraPerfil.php");
			?>

			<div class="account-content">
				<h2 class="h4">Actualizar Avatar</h2>


					<div class="row">
						<div class="col-md-4 offset-md-4">
							<label class="label" data-toggle="tooltip" title="Hace click aqui para cambiar tu avatar">
								<img class="img-fluid mx-auto" id="avatar" src="<?=$usuario->avatarURL?>" alt="avatar">
								<input type="file" class="sr-only" id="inputFile" name="image" accept="image/*">
							</label>
						</div>

						<div class="col-md-4 offset-md-4">
							<div class="progress" style="display: none">
								<div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
							</div>
						</div>
					</div>

				</div>
						
			</div>
		</main>


    	<div class="alert" role="alert"></div>
		<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="modalLabel">Recorta tu avatar</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>

					<div class="modal-body">
						<div class="img-container">
							<img id="cropImage" src="<?=$usuario->avatarURL?>" class="w-100">
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

	window.addEventListener('DOMContentLoaded', function () {
    	var avatar = document.getElementById('avatar');
      	var image = document.getElementById('cropImage');
      	var input = document.getElementById('inputFile');
      	var $progress = $('.progress');
      	var $progressBar = $('.progress-bar');
      	//var $alert = $('.alert');
      	var $modal = $('#modal');
      	var cropper;

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
          		aspectRatio: 0.75,
          		viewMode: 3,
        	});
      	}).on('hidden.bs.modal', function () {
        	cropper.destroy();
        	cropper = null;
      	});

		document.getElementById('crop').addEventListener('click', function () {
      		var initialAvatarURL;
        	var canvas;

		  	$modal.modal('hide');

        	if (cropper) {
          		canvas = cropper.getCroppedCanvas({
					width: 600,
					height: 800,
				});

				initialAvatarURL = avatar.src;
				avatar.src = canvas.toDataURL();
				$progress.show();
				//$alert.removeClass('alert-success alert-warning');

				canvas.toBlob(function (blob) {
					var formData = new FormData();

					//EN PNG Ocupa MUUUUUUUUUCHO mas!!!
					formData.append('avatar', blob, 'avatar.png');

					$.ajax('assets/php/perfilAvatar.php', {
						method: 'POST',
						data: formData,
						processData: false,
						contentType: false,

						xhr: function () {
							var xhr = new XMLHttpRequest();

							xhr.upload.onprogress = function (e) {
								var percent = '0';
								var percentage = '0%';

								if (e.lengthComputable) {
									percent = Math.round((e.loaded / e.total) * 100);
									percentage = percent + '%';
									$progressBar.width(percentage).attr('aria-valuenow', percent).text(percentage);
								}
							};

							return xhr;
						},

						success: function () {
							//$alert.show().addClass('alert-success').text('Upload success');
						},

						error: function () {
							avatar.src = initialAvatarURL;
							//$alert.show().addClass('alert-warning').text('Upload error');
						},

						complete: function () {
							$progress.hide();
							location.reload();
						},

					});
				});
			}
		});
	});
		

</script>

<?php
									 
require("_footer.php");

?>