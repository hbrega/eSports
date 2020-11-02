<?php

class notificator {
	
	public $id;
//	public $user;

	public $tipo;
	public $titulo;
	public $contenido;
	
	public $fechaAlta;
	public $fechaLectura;
	

	function __construct($id) {
		
		$conn = _connect();
		
		
	}
	

	public static function MarcarLeido($id, $usuario) {
		
		$conn = _connect();
		
		$sql = "	UPDATE notificaciones
					SET fechaLectura = NOW()
					WHERE id =  '".$id."' 
						AND	idUsuario = '".$usuario->id."'";

		$result = $conn->query($sql) or trigger_error("Failed! SQL: $sql - Error: ".mysqli_error(), E_USER_ERROR);
		
		return true;
	}
	

	public static function Cargar($usuario, $limite) {
		
		$conn = _connect();
        
		$sql = "	SELECT id, idUsuario, tipo, titulo, contenido, link, fechaAlta, fechaLectura
					FROM notificaciones
					WHERE idUsuario ='".$usuario->id."'
						AND borrado IS NULL
					ORDER BY id DESC, fechaLectura ASC 
					LIMIT ".$conn->real_escape_string($$limite);
		$result = $conn->query($sql) or trigger_error("Failed! SQL: $sql - Error: ".mysqli_error(), E_USER_ERROR);

		$i=0;
		while($row=$result->fetch_assoc()) {
				
			$arr[$i]['id'] 			  = $row['id'];
			$arr[$i]['titulo'] 		  = $row['titulo'];
			$arr[$i]['contenido'] 	  = $row['contenido'];
			$arr[$i]['link'] 		  = $row['link'];
			$arr[$i]['fechaLectura']  = $row['fechaLectura'];
			
			$i++;
		}

		
		$arr['qty']=$i;
		

		return $arr;
		
	}

	
	public static function Save($usuario, $tipo, $arrParam) {
		
		$conn = _connect();

        
        /*
		switch($tipo) {
			case "register":	
				
				$titulo="Registro en Goals Play";
				$contenido="Se ha enviado un mail a ".$usuario->email."<br>En el mismo encontrara un link para confirmar su registro.<br>En caso de no recibirlo por favor revise su carpeta de correo no deseado";

				$link="javascript: void(0)";
				$repeat=false;
				break;

				
			case "activation":	
				
				$titulo="Activacion en Goals Play";
				$contenido="Su usuario ha sido activado<br>Ya puede ingresar al sitio haciendo click en INICIAR SESION";

				$link="login.php";
				$repeat=false;
				break;

				
			case "already_activated":	
				
				$titulo="Activacion en Goals Play";
				$contenido="Su usuario fue activado con anterioridad<br>Puede ingresar al sitio haciendo click en INICIAR SESION";

				$link="login.php";
				$repeat=false;
				break;
				

			case "missing_data":	
				
				$titulo="Complete su informacion de perfil";
				$contenido="No olvide completar sus datos personales para poder participar en los torneos";

				$link="perfil.php";
				$repeat=false;
				break;
				
				
			case "too_young":	
				
				$titulo="Menor de Edad";
				$contenido="Aun no tienes 13 años, no podras participar de ningun torneo en la plataforma";

				$link="javascript: void(0)";
				$repeat=false;
				break;
				

			case "need_authorization":	
				
				$titulo="Necesitas autorizacion de tus padres o tutores";
				$contenido="Al ser menor de 16 años, tus padres/tutores/encargados deberán rellenar un formulario que deberás enviarnos.";
				
				$link="javascript: void(0)";
				$repeat=false;
				break;
				
				
			case "invitacion_sent":	
				
				$titulo="Invitacion Enviada";
				$contenido="Tu invitacion al usuario: ".$arrParam[0]." para unirse al equipo: '".$arrParam[1]."' ha sido enviada satisfactoriamente.";
				
				$link="javascript: void(0)";
				$repeat=true;
				break;
				

			case "invitacion_received":	
				
				$titulo="Invitacion Recibida";
				$contenido="Has sido invitado por: ".$arrParam[0]." para unirte al equipo: '".$arrParam[1]."', para responder a la misma, hace click AQUI";
				
				$link="perfil_historial.php";
				$repeat=true;
				break;
				
				
			case "invitation_accepted":	
				$titulo="Han aceptado tu invitacion";
				$contenido=$arrParam[0]." ha aceptado tu invitacion y se ha unido tu equipo: ".$arrParam[1];
				
				$link="javascript: void(0)";
				$repeat=true;
				break;
			
			
			case "invitation_rejected":	
				$titulo="Han rechazado tu invitacion";
				$contenido=$arrParam[0]." ha rechazado tu invitacion para unirse a tu equipo: ".$arrParam[1];
				
				$link="javascript: void(0)";
				$repeat=true;
				break;

				
			case "joined_team":	
				
				$titulo="Te uniste a un equipo";
				$contenido="Te has unido al equipo: ".$arrParam[0].", para ver el perfil del mismo, hace click AQUI";
				
				$link="perfil_equipo2.php";
				$repeat=true;
				break;
				
				
			case "delete_team":	
				
				$titulo="El equipo fue eliminado";
				$contenido="El administrador ".$arrParam[0]." ha eliminado el equipo: ".$arrParam[1];
				
				$link="javascript: void(0)";
				$repeat=true;
				break;

			
			case "message_sent":	
				
				$titulo="Tu mensaje ha sido enviado";
				$contenido="Tu mensaje ha sido enviado con exito, te responderemos a la brevedad.";
				
				$link="javascript: void(0)";
				$repeat=false;
				break;

				
			case "join_tournament_invalid":
				
				$titulo="Ya estas participando del torneo";
				$contenido="No puedes volver a inscribirte al torneo: ".$arrParam[0]." porque ya estas participando del mismo.";
				
				$link="javascript: void(0)";
				$repeat=false;
				break;
				
				
			case "join_tournament_wrong_age":
				
				$titulo="No puedes inscribirte al torneo";
				$contenido="No puedes inscribirte al torneo: ".$arrParam[0]." porque no cumples los requisitos de edad.";
				
				$link="javascript: void(0)";
				$repeat=false;
				break;
				
				
			case "join_tournament_need_auth":
				
				$titulo="Te anotaste al torneo";
				$contenido="Te inscribiste al torneo: ".$arrParam[0].", necesitaras autorizacion de tus padres para confirmar tu participacion en el mismo.";
				
				$link="javascript: void(0)";
				$repeat=false;
				break;

				
			case "join_tournament":
				
				$titulo="Te anotaste al torneo";
				$contenido="Te inscribiste al torneo: ".$arrParam[0].".";
				
				$link="javascript: void(0)";
				$repeat=false;
				break;
				
				
			case "leave_tournament":
				
				$titulo="Abandonaste el torneo";
				$contenido="Abandonaste el torneo: ".$arrParam[0].".";
				
				$link="javascript: void(0)";
				$repeat=false;
				break;
                
					
			case "kicked_player":
				
				$titulo="Expulsaste a un jugador";
				$contenido="Expulsaste al jugador: ".$arrParam[0]." de tu equipo: ".$arrParam[1].".";
				
				$link="javascript: void(0)";
				$repeat=true;
				break;				
			
                
			case "kicked":
				
				$titulo="Te expulsaron de un equipo";
				$contenido="Has sido expulsado del equipo: ".$arrParam[0].".";
				
				$link="javascript: void(0)";
				$repeat=true;
				break;				
                
                
                
			default:
				return false;
				break;
				
		}
		*/
		
		
		if(!$repeat) {
		$sql = "	UPDATE notificaciones
					SET fechaLectura = NOW(),
						borrado = 'S'
					WHERE tipo =  '".$tipo."' 
						AND	idUsuario = '".$usuario->id."'";

			$conn->query($sql) or trigger_error("Failed! SQL: $sql - Error: ".mysqli_error(), E_USER_ERROR);
		}


		$sql="	INSERT INTO notificaciones (
					idUsuario, tipo, titulo, link, contenido
				)
				VALUES (
					'".$usuario->id."',
					'".$conn->real_escape_string($tipo)."',
					'".$conn->real_escape_string($titulo)."',
					'".$conn->real_escape_string($link)."',
					'".$conn->real_escape_string($contenico)."'
				)";

		$conn->query($sql) or trigger_error("Failed! SQL: $sql - Error: ".mysqli_error(), E_USER_ERROR);

		
		return true;
	}

}

?>