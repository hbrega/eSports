<?php

require("_header.php");

?>

		<main class="site-content contact-us-page" id="wrapper">
			<div class="site-content__inner">
				<div class="site-content__holder">
					<h1 class="page-title h3">Contactanos</h1>
					<div class="page-content">
						<h4 class="text-sm">Información de contacto</h4>
						<p>
							Si tenés alguna duda, envianos un email y no te olvides de seguirnos en nuestras redes para mantenerte informado.
						</p>
						<div class="info-box">
							<div class="info-box__label">Consultas generales</div>
							<div class="info-box__content"><a href="mailto:organizacion@esportsmanager.com">organizacion<span class="color-success">@</span>esportsmanager.com</a></div>
						</div>
						<ul class="social-menu social-menu--links">
							<li><a href="https://www.facebook.com/esports/"></a></li>
							<li><a href="https://twitter.com/esports"></a></li>
							<li><a href="https://www.twitch.com/esports"></a></li>
							<li><a href="https://discord.gg/esports"></a></li>
						</ul>

						<h4>Envíanos un mensaje</h4>
						<form action="#" class="form" name="contactForm" id="contactForm">

							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<input type="text" class="form-control" name="cntName" id="cntName" placeholder="Tu nombre" value="<?=(isset($user)?$user->name." ".$user->surname:"")?>" required>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<input type="text" class="form-control" name="cntEmail" id="cntEmail" placeholder="Tu Email" value="<?=(isset($user)?$user->email:"")?>" required>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<textarea name="cntMessage" id="cntMessage" cols="30" rows="5" class="form-control" placeholder="Tu mensaje"></textarea>
									</div>
								</div>
							</div>
							
							<input type="hidden" name="cntIdUser" value="<?=(isset($user)?$user->id:"")?>" >
							<input type="hidden" name="action" value="message" >
							
							<button class="btn btn-secondary" id="cntSubmit">Enviar</button>
						</form>
					</div>

				</div>
			</div>
		</main>
		


<?php

require("_middle.php");
											   
?>

<script type="text/javascript">

	//registro de nuevo usuario
	$("#cntSubmit").click(function(e) {
		
		e.preventDefault();
		var sinError=true;

		$("#contactForm").find("*").each(function() {
			$(this).removeClass("has-error");
			$(this).next("span.form-notice").remove();
		});


		$("#contactForm input[required]").each(function() {
			if($(this).val()=="") {
				$(this).addClass("has-error");
			}
		});

		
		if($("#cntMessage").val()=="") {
			$("#cntMessage").after("<span class='form-notice'>Este campo es obligatorio</span>");
				
			sinError=false;
		}
		
		
		//formato de mail
		var regularExp = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
		if($("#cntEmail").val()!="") {
			if(!regularExp.test( $("#cntEmail").val() )) {

				$("#cntEmail").addClass("has-error");
				$("#cntEmail").after("<span class='form-notice'>El valor ingresado no es un email valido</span>");

				sinError=false;
			}
		}
		
		
		if(sinError) {
			toggleOverlay("show");

			$.post("../../assets/php/actions.php", $("#contactForm").serialize(), function(json) {
				if(json.status=='ok') {
					window.location="index.php";
				}
				else {
					alert(json.status);
				}

				toggleOverlay("hide");

			});

			return false;
		}
	});

</script>

<?php
require("_footer.php");

?>