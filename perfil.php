<?php

require("_header.php");

//CheckLogin();

?>
		<main class="site-content account-page" id="wrapper">

<?php
			require("_botoneraPerfil.php");
?>

			<div class="account-content">
				<h2 class="h4">01. Datos Personales</h2>
				<form action="#" class="form" name="pflForm" id="pflForm">
	
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<input type="text" class="form-control" name="pflName" id="pflName" placeholder="Tu Nombre" maxlength="50" value="<?=$usuario->nombre?>" required>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<input type="text" class="form-control" name="pflSurname" id="pflSurname" placeholder="Tu Apellido" maxlength="50"  value="<?=$usuario->apellido?>"required>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<input type="number" class="form-control" name="pflIdNumber" id="pflIdNumber" placeholder="Tu Numero de Documento" value="<?=$usuario->documento?>" required>
							</div>
						</div>
					
						<div class="col-md-6">
							<div class="form-group w-75">
								<input type="text" class="form-control" name="pflDOB" id="pflDOB" placeholder="Tu Fecha de Nacimiento" onfocus="(this.type='date')" onblur="(this.type='text')" value="<?=$usuario->fechaNacimiento?>" max="<?=date("Y-m-d")?>" required>
							</div>
						</div>
					</div>

						
					
					<div class="form-group d-sm-flex justify-content-sm-between align-items-sm-center">
						<input type="hidden" name="action" value="updateProfile">

						<button class="btn btn-secondary" id="pflSubmit">Actualizar Perfil</button>
					</div>

				</form>
			</div>
		</main>


<?php

require("_middle.php");
									   
?>

<script type="text/javascript">

    
    /*
    
	//actualizar perfil
	$("#pflSubmit").click(function(e) {
		
		e.preventDefault();
		var sinError=true;

		$("#pflForm").find("*").each(function() {
			$(this).removeClass("has-error");
			$(this).next("span.form-notice").remove();
		});

		$("#pflForm input[required]").each(function() {
			if($(this).val()=="") {
				$(this).addClass("has-error");
				$(this).after("<span class='form-notice'>Este campo es obligatorio</span>");
				
				sinError=false;
			}
		});
		
		
		if(sinError) {

			toggleOverlay("show");

			$.post("../../assets/php/actions.php", $("#pflForm").serialize(), function(json) {
				if(json.status=='ok') {

					window.location.reload();
				}
				else {
					UpdateNotifications();
					
//					$("#lgnEmail").addClass("has-error");
//					$("#lgnEmail").after("<span class='form-notice'>"+json.msg+"</span>");
				}

			});

			toggleOverlay("hidden");
		}
		
	});
    
    
    */


</script>


<?php

require("_footer.php");

?>