<?php

class pagina {
	
	public $id;
	public $nombre;
	
	public $claseBody;
	public $claseWrapper;

	public $reqLogin;
	
	
	function __construct($nombre) {
		
		$conn = _connect();
		
		$sql = "	SELECT id, nombre, claseBody, claseWrapper, reqLogin
                    FROM paginas
					WHERE nombre ='".$conn->real_escape_string($nombre)."'";

		$result = $conn->query($sql) or trigger_error("Failed! SQL: $sql - Error: ".mysqli_error(), E_USER_ERROR);

        
        
		if($result->num_rows==0) {
			$this->id				= NULL;
			$this->nombre			= $nombre;

			$this->claseBody		= "site-layout--horizontal preloader-is--active";
			$this->claseWrapper		= "site-wrapper";

			$this->reqLogin			= "N";

		}
		else {
			
			$row=$result->fetch_assoc();
			
			$this->id				= $row['id'];
			$this->nombre			= $row['nombre'];

			$this->claseBody		= $row['claseBody'];
			$this->claseWrapper		= $row['claseWrapper'];

			$this->reqLogin			= $row['reqLogin'];
			
		}
		
	}

	
}

?>