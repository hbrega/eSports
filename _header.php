<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


session_start();


require("assets/config/config.php");
require("assets/php/funciones.php");




require("assets/classes/persona.php");
require("assets/classes/jugador.php");
require("assets/classes/manager.php");
require("assets/classes/equipo.php");
require("assets/classes/invitacion.php");
require("assets/classes/pagina.php");
require("assets/classes/menu.php");




$pagina = new pagina(basename($_SERVER["PHP_SELF"]));
$menu = new menu();



if($pagina->reqLogin=="S") {
//	if(!isset($_SESSION['idUser']) || !isset($_SESSION['loginTime'])) {
//		header("location: index.php");
//		die();
//	}
}

/*
if(isset($_SESSION['idUser']) && isset($_SESSION['loginTime'])) {
	$user = new user($_SESSION['idUser']);
}
*/



$conn = _connect();


?>
<!doctype html>
<html lang="es">    
<head>

    <title>eSports Manager</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="keywords" content="">

	<link rel="shortcut icon" href="assets/img/favicons/favicon.ico">
	<link rel="apple-touch-icon" sizes="120x120" href="assets/img/favicons/favicon-120.png">
	<link rel="apple-touch-icon" sizes="152x152" href="assets/img/favicons/favicon-152.png">

	<meta name="viewport" content="width=device-width,initial-scale=1.0">

    <link href="https://fonts.googleapis.com/css?family=Rajdhani:300,400,500,600,700" rel="stylesheet">
	<link href="assets/vendor/magnific-popup/css/magnific-popup.css" rel="stylesheet">
	<link href="assets/vendor/slick/css/slick.css" rel="stylesheet">
	<link href="assets/vendor/nanoscroller/css/nanoscroller.css" rel="stylesheet">
	<link href="assets/vendor/fontawesome/css/brands.css" rel="stylesheet">
	<link href="assets/vendor/cropper/cropper.min.css" rel="stylesheet">
	<link href="assets/vendor/select2/css/select2.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
	<link href="assets/css/custom.css" rel="stylesheet">

</head>
<body class="<?=$pagina->claseBody?>">

	<div class="<?=$pagina->claseWrapper?>">

        
		<header id="header" class="site-header site-header--bottom">
		
			<div class="header-logo header-logo--img">
				<a href="index.php"><img src="assets/img/logo.png" srcset="assets/img/logo@2x.png 2x" alt="Inicio"></a>
			</div>
		

            
			<nav class="main-nav">
				<ul class="main-nav__list">
					<?=$menu->ShowMenu("header")?>
				</ul>
			</nav>
		

            
            
			<div class="header-actions">
				<div class="header-top-bar-toggle d-md-none hide">
					<svg role="img" class="df-icon df-icon--joystick">
						<use xlink:href="assets/img/necromancers.svg#joystick"/>
					</svg>
					<svg role="img" class="df-icon df-icon--close">
						<use xlink:href="assets/img/necromancers.svg#close"/>
					</svg>
				</div>

                <div class="header-social-toggle d-none d-md-block">
					<svg role="img" class="df-icon df-icon--thumb-up">
						<use xlink:href="assets/img/necromancers.svg#thumb-up"/>
					</svg>
					<span class="header-social-toggle__plus">&nbsp;</span>
					<ul class="social-menu social-menu--header">
						<li><a href="https://discord.gg/esports"><span class="link-subtitle">Discord</span>eSports</a></li>
						<li><a href="https://twitch.com/esports"><span class="link-subtitle">Twitch</span>eSports</a></li>
						<li><a href="https://twitter.com/esports"><span class="link-subtitle">Twitter</span>@eSports</a></li>
						<li><a href="https://www.facebook.com/esports/"><span class="link-subtitle">Facebook</span>@eSports</a></li>
					</ul>
				</div>

                
                
                <!-- En estado normal --->
                <div class="header-cart-toggle">
					<svg role="img" class="df-icon df-icon--bag">
						<use xlink:href="assets/img/necromancers.svg#bag"/>
					</svg>
					<svg role="img" class="df-icon df-icon--close">
						<use xlink:href="assets/img/necromancers.svg#close"/>
					</svg>
					<span class="header-cart-toggle__items-count">0</span>
				</div>


                
                <!-- con el menu abierto --->
				<?php
					if(isset($_SESSION['idUser']) && isset($_SESSION['loginTime'])) {
				?>
				<div class="header-account hide">
					<div class="header-account__avatar">
						<a href="perfil.php">
							<img src="" srcset="" alt="">
						</a>
					</div>
					<div class="header-account__body">
						Hola!
						<div class="header-account__name">
							<a href="perfil.php">
								
							</a>
						</div>
					</div>

					<div class="header-account__icon">
						<a href="logout.php">
							<svg role="img" class="df-icon df-icon--logout">
								<use xlink:href="assets/img/necromancers.svg#logout"/>
							</svg>
						</a>
					</div>
				</div>				
				<?php
					}
				?>

                
                
                <div class="header-menu-toggle">
					<div class="header-menu-toggle__inner">
						<span>&nbsp;</span>
						<span>&nbsp;</span>
						<span>&nbsp;</span>
					</div>
				</div>
			</div>
		</header>