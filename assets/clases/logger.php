<?php


class Logger {
	
    public $id;
    public $idPersona;
    public $accion;
    public $descripcion;
    public $ip;
    public $fechaAlta;
    
    
    function __construct($id) {

		$conn = _connect();
    
		$sql="	SELECT id, idPersona, ip, accion, descripcion, fechaAlta
                FROM logs
                WHERE id = '".$conn->real_escape_string($id)."'";

        
		$result=$conn->query($sql) or trigger_error("Failed! SQL: $sql - Error: ".mysqli_error(), E_USER_ERROR);

		if($result->num_rows==0) {
			return false;
		}
		
		$row=$result->fetch_assoc();
                
        $this->id           = $row['id'];
        $this->idPersona    = $row['idPersona'];
        $this->accion       = $row['accion'];
        $this->descripcion  = $row['descripcion'];
        $this->ip           = $row['ip'];
        $this->fechaAlta    = $row['fechaAlta'];

        
    }
    
    
    public static function GetLogs($usuario) {
        
		$conn = _connect();

		$sql="	SELECT id
				FROM logs
				WHERE idPersona = '".$usuario->id."'";

		$result=$conn->query($sql) or trigger_error("Failed! SQL: $sql - Error: ".mysqli_error(), E_USER_ERROR);

		if($result->num_rows==0) {
			return false;
		}

		while($row=$result->fetch_assoc()) {
			$logs[] = new Logger($row['id']);
		}

		return $logs;        
        
    }
    
    
	public static function Save($usuario, $accion, $descripcion) {
				
		$conn = _connect();

		if($usuario == "") {
			$idPersona = "NULL";
		}
		else {
			$idPersona = $usuario->id;
		}
		

		$sql="	INSERT INTO logs (
					idPersona, accion, descripcion, ip
				)
				VALUES (
					".$idPersona.",
					'".$conn->real_escape_string($accion)."',
					'".$conn->real_escape_string($descripcion)."',
					'".$_SERVER['REMOTE_ADDR']."'
				)";

		$conn->query($sql) or trigger_error("Failed! SQL: $sql - Error: ".mysqli_error(), E_USER_ERROR);


		return true;
		
	}
    
}

?>