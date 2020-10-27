<?php

require("_header.php");

?>
		<main class="site-content login-page" id="wrapper">
			<div class="row">
				<div class="col-md-6">
					<h2 class="h4">Iniciar sesión</h2>

					<form action="#" class="form login-form" name="lgnForm" id="lgnForm">
	
						<div class="form-group">
							<input type="email" class="form-control" name="lgnEmail" id="lgnEmail" placeholder="Tu Email"  maxlength="50" required>
						</div>
				
						<div class="form-group">
							<input type="password" class="form-control" name="lgnPass" id="lgnPass" placeholder="Tu Password" maxlength="50" required>
						</div>
						
						
						<input type="hidden" name="action" value="login">

						<button class="btn btn-block login-form__button" id="lgnSubmit">Inicia sesión</button>
                    
                    </form>

                    <div class="form-group d-flex justify-content-between align-items-center mt-3">
                        <span class="password-reminder">
                            <a href="javascript: void(0)">Olvidé mi password</a>
                        </span>
                    </div>
                    
                    
                    
				</div>
				<div class="col-md-6">

					<h2 class="h4">Registrarme</h2>
					<form action="#" class="form register-form" name="rgtForm" id="rgtForm">
						
						
						<div class="form-group">
							<input type="email" class="form-control" name="rgtEmail" id="rgtEmail" placeholder="Tu Email" maxlength="50" required>
						</div>
						
						<div class="form-group">
							<input type="text" class="form-control" name="rgtFnac" id="rgtFnac" placeholder="Tu Fecha de Nacimiento" onfocus="(this.type='date')" onblur="if(this.value==''){this.type='text'}" required>
						</div>
                        
						<div class="form-group">
							<input type="password" class="form-control" name="rgtPass" id="rgtPass" placeholder="Tu Password" maxlength="50" required>
						</div>

						<div class="form-group">
							<input type="password" class="form-control" name="rgtPass2" id="rgtPass2" placeholder="Repetir Password" maxlength="50" required>
						</div>

                        <div class="form-group select-wrapper">
                            <select name="rgtRol" id="rgtRol">
                                <option value="" disabled="">Mi Rol</option>
                                <option value="1" selected>Jugador</option>
                                <option value="2">Manager</option>
                            </select>
                        </div>						

						<div class="form-group d-sm-flex align-items-sm-left">
							<label class="checkbox checkbox-inline">
								<input class="checkbox-input" type="checkbox" name="rgtCond" id="rgtCond" value="Y"> Al registrarme acepto las bases y condiciones de eSports Manager<span class="checkbox-label">&nbsp;</span>
							</label>
						</div>						

						<input type="hidden" name="action" value="register">

						
						<button class="btn btn-primary btn-block register-form__button" id="rgtSubmit">Crear mi cuenta</button>
						<div class="register-form__info">
							Recibirás un email de confirmación </br>para activar tu cuenta.
						</div>
					</form>
				</div>
			</div>
		</main>






		<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="modalLabel">Olvidé mi password</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>

					<div class="modal-body">

						<form action="#" class="form" name="recoverPass" id="recoverPass">
						
							<p>Ingrese su correo electronico para recuperar tu contraseña</p>
                            
							<div class="row">
                                <div class="col-md-12">
								    <input type="text" class="form-control" name="fgtEmail" id="fgtEmail" placeholder="Tu Email" maxlength="50" required>
								</div>
							</div>				
                            
							<input type="hidden" name="action" value="forgotPass">
						</form>
						
					</div>

					<div class="modal-footer">
						<button type="button" class="btn btn-primary" id="btnSendEmail">Enviar</button>
					</div>
				</div>
			</div>
    	</div>



<?php

require("_middle.php");

?>

<script type="text/javascript">

	//login
    
    /*
	$("#lgnSubmit").click(function(e) {

		e.preventDefault();
		var sinError=true;

		$("#lgnForm").find("*").each(function() {
			$(this).removeClass("has-error");
			$(this).next("span.form-notice").remove();
		});

		$("#lgnForm input[required]").each(function() {
			if($(this).val()=="") {
				$(this).addClass("has-error");
				$(this).after("<span class='form-notice'>Este campo es obligatorio</span>");
				
				sinError=false;
			}
		});
		
		//formato de mail
		var regularExp = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
		if($("#lgnEmail").val()!="") {
			if(!regularExp.test( $("#lgnEmail").val() )) {

				$("#lgnEmail").addClass("has-error");
				$("#lgnEmail").after("<span class='form-notice'>El valor ingresado no es un email valido</span>");

				sinError=false;
			}
		}
		
		if(sinError) {

			toggleOverlay("show");

			$.post("../../assets/php/actions.php", $("#lgnForm").serialize(), function(json) {
				if(json.status=='ok') {

					window.location="index.php";
				}
				else {
					UpdateNotifications();
					
					$("#lgnEmail").addClass("has-error");
					$("#lgnEmail").after("<span class='form-notice'>"+json.msg+"</span>");
				}
				
				toggleOverlay("hidden");

			});

			return false;
		}
	});
    */
	
	
    
    
    
	
	//registro de nuevo usuario
	$("#rgtSubmit").click(function(e) {
		
		e.preventDefault();
		var sinError=true;

		$("#rgtForm").find("*").each(function() {
			$(this).removeClass("has-error");
			$(this).next("span.form-notice").remove();
		});

		$("#rgtForm input[required]").each(function() {
			if($(this).val()=="") {
				$(this).addClass("has-error");
				$(this).after("<span class='form-notice'>Este campo es obligatorio</span>");
				
				sinError=false;
			}
		});
		
		//formato de mail
		var regularExp = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
		if($("#rgtEmail").val()!="") {
			if(!regularExp.test( $("#rgtEmail").val() )) {

				$("#rgtEmail").addClass("has-error");
				$("#rgtEmail").after("<span class='form-notice'>El valor ingresado no es un email valido</span>");

				sinError=false;
			}
		}
		
		if( $("#rgtPass").val() != $("#rgtPass2").val() ) {
			$("#rgtPass2").addClass("has-error");
			$("#rgtPass2").after("<span class='form-notice'>Las contraseñas no coinciden</span>");

			sinError=false;
		}

        
        
        
        
        
        
		if(!$("#rgtCond").is(':checked')) {  
			$("#rgtCond").addClass("has-error");
			$("#rgtCond").after("<span class='form-notice'>Debe aceptar las bases y condiciones</span>");

			sinError=false;
		}
		
		
		if(sinError) {
			
			toggleOverlay("show");

			$.post("assets/php/existeEmail.php", {email: $("#rgtEmail").val()}, function(json) {
				if(json.status=='ok') {
					$("#rgtEmail").addClass("has-error");
					$("#rgtEmail").after("<span class='form-notice'>El email ingresado ya esta en uso</span>");

					toggleOverlay("hide");
					return false;
				}
				else {
					
					$.post("assets/php/registro.php", $("#rgtForm").serialize(), function(json) {
						if(json.status=='ok') {
							window.location="index.php";
						}
						else {
							alert(json.msg);
						}

						toggleOverlay("hide");
					
					});
					
					return false;
				}
			});
		}
	});

    
    
    
    
    /*
    $(".password-reminder").click(function() {
        
        $("#modal").modal('show');
        
    });
        
    
    $("#btnSendEmail").click(function(e) {
    
		e.preventDefault();
		var sinError=true;

		$("#recoverPass").find("*").each(function() {
			$(this).removeClass("has-error");
		});

		$("#recoverPass input[required]").each(function() {
			if($(this).val()=="") {
				$(this).addClass("has-error");
				
				sinError=false;
			}
		});

        if(sinError) {

            toggleOverlay("show");

            $.post("../../assets/php/actions.php", $("#recoverPass").serialize(), function(json) {
                if(json.status=='ok') {

                    
                    
    //                window.location="copamobilecr.php";

                }
                else {
                    alert(json.msg);
                }

                toggleOverlay("hide");
            });
        }
    });
    */


</script>

<?php

require("_footer.php");

?>