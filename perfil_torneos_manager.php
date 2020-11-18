<?php

require("_header.php");

if($_SESSION['userLvl'] != 2) {
	echo("<script>window.location='perfil_nuevoEquipo.php'</script>");
	die();
}


if(!$equipos = $usuario->ListarEquipos()) {
	echo("<script>window.location='perfil_nuevoEquipo.php'</script>");
	die();
}



$inscripcionesTable = "";
foreach($equipos as $equipo) {

    $inscripciones = $equipo->ListarTorneos();

    $inscripcionesTable.="
        <h4 class='h5'>".$equipo->nombre."</h2>

        <table class='table torneosTable mb-4'>
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Torneo</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
        ";
    
    
    if($inscripciones) {
        foreach($inscripciones as $inscripcion) {
            $inscripcionesTable.="
                <tr>
                    <td class='align-middle'>".$inscripcion->fechaAlta."</td>
                    <td class='align-middle'>".$inscripcion->torneo->nombre."</td>
                    <td class='align-middle text-right'>
                        <button type='button' class='btn btn-primary'>Ver Jugadores</button>
                        <button type='button' class='btn btn-danger'>Abandonar</button>
                    </td>
                </tr>
            ";
        }

    }
    else {
        $inscripcionesTable.="
                <tr>
                    <td colspan='3' class='align-middle'>EL EQUIPO AÚN NO SE INSCRIBIÓ A NINGÚN TORNEO</td>
                </tr>
        ";
    }


    $inscripcionesTable.="
            </tbody>
        </table>
    ";
    
}




?>
		<main class="site-content account-page" id="wrapper">

<?php
			require("_botoneraPerfil.php");
?>

			<div class="account-content">
				<h2 class="h4">Mis Torneos</h2>

                <?=$inscripcionesTable?>
            </div>
		</main>


<?php

require("_middle.php");
									   
?>



<?php

require("_footer.php");

?>