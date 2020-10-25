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
//require("classes/domicilio.php");
//require("classes/telefono.php");



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
<body class="site-layout--horizontal preloader-is--active">

    
	<div class="site-wrapper">

		<header id="header" class="site-header site-header--bottom">
		
			<div class="header-logo header-logo--img">
				<a href="index.php"><img src="assets/img/logo.png" srcset="assets/img/logo@2x.png 2x" alt="Inicio"></a>
			</div>
		

            
			<nav class="main-nav">
				<ul class="main-nav__list">
					<li class=""><a href="home.html">Home</a></li>
					<li class="">
						<a href="#">Teams</a>
						<ul class="main-nav__sub">
							<li class="">
								<a href="#">Team Selections</a>
								<ul class="main-nav__sub main-nav__sub--dropup">
									<li class=""><a href="team-selection-1.html">Team Selection v1</a></li>
									<li class=""><a href="team-selection-2.html">Team Selection v2</a></li>
									<li class=""><a href="team-selection-3.html">Team Selection v3</a></li>
									<li class=""><a href="team-selection-4.html">Team Selection v4</a></li>
								</ul>
							</li>
							<li class="">
								<a href="team-overview.html">Team Overview</a>
								<ul class="main-nav__sub">
									<li class=""><a href="team-overview.html">Team Overview v1</a></li>
									<li class=""><a href="team-overview-2.html">Team Overview v2</a></li>
								</ul>
							</li>
							<li class=""><a href="team-player-1.html">Player Page</a></li>
						</ul>
					</li>
					<li class=""><a href="#">Matches</a>
						<ul class="main-nav__sub">
							<li class=""><a href="matches-scores.html">Match Scores</a></li>
							<li class=""><a href="matches-upcoming.html">Upcoming Matches</a></li>
							<li class=""><a href="matches-standings.html">Standings</a></li>
							<li class=""><a href="#">Match Stats</a>
								<ul class="main-nav__sub">
									<li class=""><a href="matches-stats-1.html">Match Stats v1</a></li>
									<li class=""><a href="matches-stats-2.html">Match Stats v2</a></li>
									<li class=""><a href="matches-stats-3.html">Match Stats v3</a></li>
								</ul>
							</li>
							<li class="">
								<a href="#">Match Lineups</a>
								<ul class="main-nav__sub">
									<li class=""><a href="matches-lineups-1.html">Match Lineups v1</a></li>
									<li class=""><a href="matches-lineups-2.html">Match Lineups v2</a></li>
									<li class=""><a href="matches-lineups-3.html">Match Lineups v3</a></li>
								</ul>
							</li>
							<li class=""><a href="#">Match Overviews</a>
								<ul class="main-nav__sub">
									<li class=""><a href="matches-overview-1.html">Match Overview v1</a></li>
									<li class=""><a href="matches-overview-2.html">Match Overview v2</a></li>
								</ul>
							</li>
							<li class=""><a href="matches-replay.html">Match Replay</a></li>
						</ul>
					</li>
					<li class="active"><a href="#">News</a>
						<ul class="main-nav__sub">
							<li class=""><a href="blog-1.html">News v1</a></li>
							<li class=""><a href="blog-2.html">News v2</a></li>
							<li class=""><a href="blog-3.html">News v3</a></li>
							<li class="active"><a href="blog-4.html">News v4</a></li>
							<li class=""><a href="blog-classic.html">News Classic <span class="badge badge-danger">New</span></a></li>
							<li class=""><a href="blog-post.html">Post Page</a></li>
						</ul>
					</li>
					<li><a href="#">Features</a>
						<div class="main-nav__megamenu">
							<div class="row">
								<div class="col-md-4">
									<h6 class="main-nav__title">Main Pages</h6>
									<div class="row">
										<ul class="col-md-4">
											<li class=""><a href="index.html">Landing Image</a></li>
											<li class=""><a href="index-2.html">Landing Video</a></li>
											<li class=""><a href="blog-1.html">News v1</a></li>
											<li class=""><a href="blog-2.html">News v2</a></li>
											<li class=""><a href="blog-3.html">News v3</a></li>
											<li class="active"><a href="blog-4.html">News v4</a></li>
											<li class=""><a href="blog-classic.html">News Classic <span class="badge badge-danger">New</span></a></li>
										</ul>
										<ul class="col-md-4">
											<li class=""><a href="shop-account-settings.html">Account Settings</a></li>
											<li class=""><a href="shop-account-orders.html">Account Orders</a></li>
											<li class=""><a href="login-register.html">Login & Register</a></li>
											<li class=""><a href="features-about-us.html">About Us</a></li>
											<li class=""><a href="features-contact-us.html">Contact Us</a></li>
											<li class=""><a href="features-faqs.html">FAQs</a></li>
										</ul>
										<ul class="col-md-4">
											<li class=""><a href="management-and-staff.html">MGMT & Staff</a></li>
											<li class=""><a href="streams-archive.html">Streams Page</a></li>
											<li class=""><a href="partners.html">Our Partners</a></li>
											<li class=""><a href="features-shortcodes.html">Shortcodes</a></li>
											<li class=""><a href="features-typography.html">Typography</a></li>
											<li class=""><a href="features-icons.html">Icons <span class="badge badge-danger">New</span></a></li>
											<li class=""><a href="features-bg-1.html">Backgrounds</a></li>
										</ul>
									</div>
								</div>
								<div class="col-md-4">
									<div class="row">
										<h6 class="col-md-8 main-nav__title">Team Pages</h6>
										<h6 class="col-md-4 main-nav__title">Player Pages</h6>
									</div>
									<div class="row">
										<ul class="col-md-4">
											<li class=""><a href="team-selection-1.html">Team Selection v1</a></li>
											<li class=""><a href="team-selection-2.html">Team Selection v2</a></li>
											<li class=""><a href="team-selection-3.html">Team Selection v3</a></li>
											<li class=""><a href="team-selection-4.html">Team Selection v4</a></li>
											<li class=""><a href="team-overview.html">Team Overview v1</a></li>
											<li class=""><a href="team-overview-2.html">Team Overview v2</a></li>
										</ul>
										<ul class="col-md-4">
											<li><a href="team-overview.html?slide=1">Team Statistics</a></li>
											<li><a href="team-overview.html?slide=2">Team Achv</a></li>
											<li><a href="team-overview.html?slide=3">Team Matches</a></li>
										</ul>
										<ul class="col-md-4">
											<li><a href="team-player-1.html">Player Overview</a></li>
											<li><a href="team-player-1.html?slide=1">Player Statistics</a></li>
											<li><a href="team-player-1.html?slide=2">Player Achv</a></li>
											<li><a href="team-player-1.html?slide=3">Player Hardware</a></li>
											<li><a href="team-player-1.html?slide=4">Player Stream</a></li>
										</ul>
									</div>
								</div>
								<div class="col-md-4">
									<div class="row">
										<h6 class="col-md-8 main-nav__title">Match Pages</h6>
										<h6 class="col-md-4 main-nav__title">Shop Pages</h6>
									</div>
									<div class="row">
										<ul class="col-md-4">
											<li class=""><a href="matches-scores.html">Match Scores</a></li>
											<li class=""><a href="matches-upcoming.html">Upcoming Matches</a></li>
											<li class=""><a href="matches-standings.html">Standings</a></li>
											<li class=""><a href="matches-overview-1.html">Overview v1</a></li>
											<li class=""><a href="matches-overview-2.html">Overview v2</a></li>
											<li class=""><a href="matches-stats-1.html">Match Stats v1</a></li>
										</ul>
										<ul class="col-md-4">
											<li class=""><a href="matches-stats-2.html">Match Stats v2</a></li>
											<li class=""><a href="matches-stats-3.html">Match Stats v3</a></li>
											<li class=""><a href="matches-lineups-1.html">Match Lineups v1</a></li>
											<li class=""><a href="matches-lineups-2.html">Match Lineups v2</a></li>
											<li class=""><a href="matches-lineups-3.html">Match Lineups v3</a></li>
											<li class=""><a href="matches-replay.html">Match Replay</a></li>
										</ul>
										<ul class="col-md-4">
											<li class=""><a href="shop.html">Shop Page v1</a></li>
											<li class=""><a href="shop-2.html">Shop Page v2</a></li>
											<li class=""><a href="shop-product.html">Product Page</a></li>
											<li class=""><a href="shop-checkout.html">Checkout Page</a></li>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</li>
					<li class="">
						<a href="#">Shop</a>
						<ul class="main-nav__sub">
							<li class=""><a href="shop.html">Shop Page v1</a></li>
							<li class=""><a href="shop-2.html">Shop Page v2</a></li>
							<li class=""><a href="shop-product.html">Product Page</a></li>
							<li class=""><a href="shop-checkout.html">Checkout Page</a></li>
						</ul>
					</li>
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
						<li><a href="https://discord.gg/xxxx"><span class="link-subtitle">Discord</span>Necrochat</a></li>
						<li><a href="https://twitch.com"><span class="link-subtitle">Twitch</span>Necroplay</a></li>
						<li><a href="https://twitter.com/danfisher_dev"><span class="link-subtitle">Twitter</span>Necrotwt</a></li>
						<li><a href="https://www.facebook.com/danfisher.dev/"><span class="link-subtitle">Facebook</span>Necrogame</a></li>
					</ul>
				</div>

                <div class="header-cart-toggle">
					<svg role="img" class="df-icon df-icon--bag">
						<use xlink:href="assets/img/necromancers.svg#bag"/>
					</svg>
					<svg role="img" class="df-icon df-icon--close">
						<use xlink:href="assets/img/necromancers.svg#close"/>
					</svg>
					<span class="header-cart-toggle__items-count">0</span>
				</div>

                <div class="header-account hide">
					<div class="header-account__avatar">
						<img src="assets/img/samples/account-user-avatar.jpg" srcset="assets/img/samples/account-user-avatar@2x.jpg 2x" alt="">
					</div>
					<div class="header-account__body">
						Hello!
						<div class="header-account__name">James Spiegel</div>
					</div>
					<div class="header-account__icon">
						<a href="shop-account-settings.html">
							<svg role="img" class="df-icon df-icon--account">
								<use xlink:href="assets/img/necromancers.svg#account"/>
							</svg>
						</a>
						<a href="login-register.html">
							<svg role="img" class="df-icon df-icon--logout">
								<use xlink:href="assets/img/necromancers.svg#logout"/>
							</svg>
						</a>
					</div>
				</div>

                <div class="header-menu-toggle">
					<div class="header-menu-toggle__inner">
						<span>&nbsp;</span>
						<span>&nbsp;</span>
						<span>&nbsp;</span>
					</div>
				</div>
			</div>
		</header>