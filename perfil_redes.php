<?php

require("_header.php");

?>
		<main class="site-content account-page" id="wrapper">

<?php
			require("_botoneraPerfil.php");
?>

			<div class="account-content">
				<h2 class="h4">Mis Juegos y Redes</h2>


				<form action="#" class="form" name="ntwForm" id="ntwForm">

					<h6 class="h6">NICKNAME</h6>

					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<input type="text" class="form-control" name="nwtNickname" id="nwtNickname" placeholder="Tu Nickname" maxlength="50" value="<?=$usuario->nickname?>">
							</div>
						</div>
					</div>
                    
                    
                    
					<h6 class="h6">Mis Usuarios</h6>

					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<input type="text" class="form-control" name="nwtSteam" id="nwtSteam" placeholder="Tu STEAM ID" maxlength="50" value="<?=$usuario->steamID?>">
							</div>
						</div>

                        <div class="col-md-6">
							<div class="form-group">
								<input type="text" class="form-control" name="nwtDiscord" id="nwtDiscord" placeholder="Tu Discord ID" maxlength="50" value="<?=$usuario->discordID?>">
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<input type="text" class="form-control" name="nwtPSN" id="nwtPSN" placeholder="Tu PSN ID" maxlength="50" value="<?=$usuario->psnID?>">
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<input type="text" class="form-control" name="nwtXBOX" id="nwtXBOX" placeholder="Tu XBOX ID" maxlength="50"  value="<?=$usuario->xboxID?>">
							</div>
						</div>
					</div>


                    
					<h6 class="h6">Mis Redes Sociales</h6>
					<p class="">INGRESA SÓLO TU USUARIO. EJEMPLO: SI TU PERFIL DE FACEBOOK ES FACEBOOK.COM/EJEMPLO, TIPEA SOLO "EJEMPLO" SIN LAS COMILLAS.</p>

					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<input type="text" class="form-control" name="nwtFacebook" id="nwtFacebook" placeholder="Tu Perfil de Facebook" maxlength="50" value="<?=$usuario->facebookURL?>">
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<input type="text" class="form-control" name="nwtInstagram" id="nwtInstagram" placeholder="Tu Perfil de Instagram" maxlength="50"  value="<?=$usuario->instagramURL?>">
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<input type="text" class="form-control" name="nwtTwitter" id="nwtTwitter" placeholder="Tu Perfil de Twitter" maxlength="50" value="<?=$usuario->twitterURL?>">
							</div>
						</div>
					</div>

                    
					<h6 class="h6 mt-4">Sobre Mi</h6>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<textarea name="nwtSobreMi" id="nwtSobreMi" rows="3" class="form-control" placeholder="Escribe algo sobre ti" maxlength="1000"><?=$usuario->sobreMi?></textarea>
							</div>
						</div>					
					</div>
                    
                    
					<div class="form-group d-sm-flex justify-content-sm-between align-items-sm-center">
						<input type="hidden" name="action" value="updateNetworks">

						<button class="btn btn-secondary" id="ntwSubmit">Actualizar</button>
					</div>

                </form>				
			</div>
		</main>
		
<?php

require("_middle.php");
									   
?>

<script type="text/javascript">

	//actualizar redes
	$("#ntwSubmit").click(function(e) {
		
		e.preventDefault();
		var sinError=true;

		$("#ntwForm").find("*").each(function() {
			$(this).removeClass("has-error");
			$(this).next("span.form-notice").remove();
		});

		
		if(sinError) {

			toggleOverlay("show");

			$.post("assets/php/perfilRedes.php", $("#ntwForm").serialize(), function(json) {
				if(json.status=='ok') {
					window.location.reload();
				}
				else {
				    alert(json.msg);
				}

			});

			toggleOverlay("hidden");
		}
		
	});
	
</script>

<?php

require("_footer.php");

?>