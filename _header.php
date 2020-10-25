<?php

//En el diagrama de clases todos los cargar se tienen que llamar LISTAR!!!

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require("assets/config/config.php");
require("assets/php/funciones.php");




require("assets/classes/persona.php");
require("assets/classes/jugador.php");
require("assets/classes/manager.php");
require("assets/classes/equipo.php");
require("assets/classes/invitacion.php");
//require("classes/domicilio.php");
//require("classes/telefono.php");


session_start();

//$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
$conn = _connect();

?>
<!doctype html>
<html lang="es">    
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">    
    <title>eSports Manager</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.css" integrity="sha512-Velp0ebMKjcd9RiCoaHhLXkR1sFoCCWXNp6w4zj1hfMifYB5441C+sKeBl/T/Ka6NjBiRfBBQRaQq65ekYz3UQ==" crossorigin="anonymous" />
    
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    
    <link rel="stylesheet" href="css/design.css">

    
    
</head>
<body>


    <div class="w-100">
    </div>


    <div class="container">
        <section class="mt-3 mb-3">
            <div class="row">

                
                
                
            </div>
        </section>