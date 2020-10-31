			<div class="account-navigation">
				<div class="account-navigation__header">
					<a class="account-navigation__logout" href="logout.php">
						Cerrar Sesión
					</a>
					<a class="account-navigation__avatar" href="perfil_avatar.php">
						<img src="<?=$usuario->avatarURL?>" alt="">
						<span class="account-navigation__browse-icon">&nbsp;</span>
					</a>
					<div class="account-navigation__subtitle">Bienvenido</div>
					<div class="account-navigation__name h5"><?=($usuario->nombre==""?"$usuario->email":$usuario->nombre.' '.$usuario->apellido)?></div>
				</div>

<?php                
            
    if(get_class($usuario) == "Jugador") { 
    
?>
                
				<ul class="account-navigation__menu">
					<li>
						<a class="<?=(basename($_SERVER["PHP_SELF"])=="perfil.php"?"active":"")?>" href="perfil.php">Datos Personales</a>
					</li>

					<li>
						<a class="<?=(basename($_SERVER["PHP_SELF"])=="perfil_redes.php"?"active":"")?>" href="perfil_redes.php">Mis Juegos y Redes</a>
					</li>

					<li>
						<a class="<?=((basename($_SERVER["PHP_SELF"])=="perfil_miEquipo.php")?"active":"")?>" href="perfil_miEquipo.php"?>Mi Equipo</a>
					</li>
					
					<li>
						<a class="<?=(basename($_SERVER["PHP_SELF"])=="perfil_torneos.php"?"active":"")?>" href="perfil_torneos.php">Mis Torneos</a>
					</li>

                    <li>
						<a class="<?=(basename($_SERVER["PHP_SELF"])=="perfil_historial.php"?"active":"")?>" href="perfil_historial.php">Solicitudes &amp; Logs</a>
					</li>
                </ul>
                
<?php                
                
    }
    else if(get_class($usuario) == "Manager") { 
     
?>

                <ul class="account-navigation__menu">
					<li>
						<a class="<?=(basename($_SERVER["PHP_SELF"])=="perfil.php"?"active":"")?>" href="perfil.php">Datos Personales</a>
					</li>

					<li>
						<a class="<?=((basename($_SERVER["PHP_SELF"])=="perfil_nuevoEquipo.php") || (basename($_SERVER["PHP_SELF"])=="perfil_listarEquipos.php")|| (basename($_SERVER["PHP_SELF"])=="perfil_admEquipo.php")?"active":"")?>" href="<?=($usuario->ListarEquipos()?"perfil_listarEquipos.php":"perfil_nuevoEquipo.php")?>">Mis Equipos</a>
					</li>
					
					<li>
						<a class="<?=(basename($_SERVER["PHP_SELF"])=="perfil_torneos.php"?"active":"")?>" href="perfil_torneos.php">Mis Torneos</a>
					</li>

                    <li>
						<a class="<?=(basename($_SERVER["PHP_SELF"])=="perfil_historial.php"?"active":"")?>" href="perfil_historial.php">Solicitudes &amp; Logs</a>
					</li>
                </ul>
                    
<?php                
                
    }
    
?>
                
			</div>