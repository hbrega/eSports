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

				<ul class="account-navigation__menu">
					<li>
						<a class="<?=(basename($_SERVER["PHP_SELF"])=="perfil.php"?"active":"")?>" href="perfil.php">Datos Personales</a>
					</li>

					<li>
						<a class="<?=(basename($_SERVER["PHP_SELF"])=="perfil_redes.php"?"active":"")?>" href="perfil_redes.php">Mis Juegos y Redes</a>
					</li>


                
                
                
                </ul>
			</div>
