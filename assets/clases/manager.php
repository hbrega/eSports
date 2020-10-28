<?php

class Manager extends Persona {
    
    public $linkedinID; 
    
    
    
    
    function __construct($id) {
        
		$conn = _connect();

		$sql="	SELECT p.id, p.tipoPersona,
                    p.nombre, p.apellido,
                    p.email, p.clave,
                    p.documento, p.fechaNacimiento,
                    m.linkedinID, p.fechaAlta
                FROM personas p
                JOIN managers m ON p.id = m.idPersona
                WHERE p.id = '".$conn->real_escape_string($id)."'";
        
		$result=$conn->query($sql) or trigger_error("Failed! SQL: $sql - Error: ".mysqli_error(), E_USER_ERROR);

        if($result->num_rows==0) {
			return false;
		}
		
		$row=$result->fetch_assoc();
        
        
		$this->id				= $row['id'];

        $this->nombre           = $row['nombre'];
        $this->apellido         = $row['apellido'];

        $this->tipoPersona      = $row['tipoPersona'];
        
		$this->email			= $row['email'];
        $this->clave            = $row['clave'];
    
        $this->documento        = $row['documento'];
        $this->fechaNacimiento  = $row['fechaNacimiento'];

        $this->linkedinID       = $row['linkedinID'];
        $this->fechaAlta        = $row['fechaAlta'];

    }

    
    static function Login($email, $pass) {
        
		$conn = _connect();
		
		$sql="	SELECT id
				FROM personas
				WHERE email = '".$conn->real_escape_string($email)."'
				    AND clave = md5('".$conn->real_escape_string($pass)."')
                    AND tipoPersona = 2 ";

		$result=$conn->query($sql) or trigger_error("Failed! SQL: $sql - Error: ".mysqli_error(), E_USER_ERROR);
		
		if($result->num_rows==0) {
			return false;
		}

		$row=$result->fetch_assoc();
		
		$manager = new Manager($row['id']);

		return $manager;
    }


    static function Nuevo($email, $pass, $fechaNacimiento) {
        
		$conn = _connect();
        
		$sql="	INSERT INTO personas (
					tipoPersona, email, clave, fechaNacimiento
				)
				VALUES (
                    2,
					'".$conn->real_escape_string($email)."',
					md5('".$conn->real_escape_string($pass)."'),
					'".$conn->real_escape_string($fechaNacimiento)."'
				)";
		
		
		if (!$conn->query($sql)) {
			echo($conn->errno." ".$conn->error);
			return false;
		}

		$idManager = $conn->insert_id;


        $sql="	INSERT INTO managers (
					idPersona
				)
				VALUES (
                    ".$idManager."
				)";
        
        
		$conn->query($sql);
        
		$manager = new Manager($idManager);

        
		return $manager;        
    }

    
    static function BuscarPorEmail($email) {
        
		$conn = _connect();
		
		$sql="	SELECT id
				FROM personas
				WHERE email = '".$conn->real_escape_string($email)."'
                    AND tipoPersona = 2 ";

		$result=$conn->query($sql) or trigger_error("Failed! SQL: $sql - Error: ".mysqli_error(), E_USER_ERROR);
		
		if($result->num_rows==0) {
			return false;
		}

		$row=$result->fetch_assoc();
		
		$manager = new Manager($row['id']);

		return $manager;
    }
    
    
    public function ActualizarDatos() {

		$conn = _connect();

		$sql= "	UPDATE managers
				SET 
					linkedinID     = '".$conn->real_escape_string($this->linkedinID)."'
				WHERE idPersona    = ".$this->id;
				
		$result=$conn->query($sql) or trigger_error("Failed! SQL: $sql - Error: ".mysqli_error(), E_USER_ERROR);

		return true;
    } 


    public function ListarEquipos() {
        
		$conn = _connect();

		$sql="	SELECT id
				FROM equipos
				WHERE idManager = '".$this->id."'
					AND fechaBaja IS NULL";

		$result=$conn->query($sql) or trigger_error("Failed! SQL: $sql - Error: ".mysqli_error(), E_USER_ERROR);

		if($result->num_rows==0) {
			return false;
		}

		while($row=$result->fetch_assoc()) {
			$equipo[] = new Equipo($row['id']);
		}

		return $equipo;
    }


    public function Notificar($tipoNotif, $arrDatos) {
        
        
        return false;
    }
    
    
    
}

?>