<?php

require("_header.php");

if($_SESSION['userLvl'] != 2) {
	echo("<script>window.location='perfil_nuevoEquipo.php'</script>");
	die();
}

$equipo = new Equipo($_GET['idEquipo']);





/*
if(!$equipos = $usuario->ListarEquipos()) {
	echo("<script>window.location='perfil_nuevoEquipo.php'</script>");
	die();
}
*/



?>
		<main class="site-content account-page" id="wrapper">

<?php
			require("_botoneraPerfil.php");
?>

			<div class="account-content">
				<h2 class="h4">Administrar equipo</h2>

            
                

                
                
                
                
            
            </div>
		</main>


<?php

require("_middle.php");
									   
?>



<?php

require("_footer.php");

?>