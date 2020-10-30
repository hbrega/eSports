<?php


class Logger {
	
	public static function Save($usuario, $action, $description) {
				
		$conn = _connect();

        
        /*
        
		if(usuario == "") {
			$idUser = "NULL";
		}
		else {
			$idUser = usuario->id;
		}
		

		$sql="	INSERT INTO logs (
					idUser, action, description, ip
				)
				VALUES (
					".$idUser.",
					'".$conn->real_escape_string($action)."',
					'".$conn->real_escape_string($description)."',
					'".$_SERVER['REMOTE_ADDR']."'
				)";

		$conn->query($sql) or trigger_error("Failed! SQL: $sql - Error: ".mysqli_error(), E_USER_ERROR);


        */
		return true;
		
	}

}



?>