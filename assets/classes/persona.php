<?php

abstract class Persona {
    
    public  $id;
    
    public  $nombre;
    public  $apellido;
    
    public  $email;
    public  $clave;
    
    public  $documento;
    public  $fechaNacimiento;
    
    public  $fechaAlta;
    
    
    
    abstract static function Login($email, $pass);
    abstract static function Nuevo($email, $pass, $fechaNacimiento);
    abstract static function BuscarPorEmail($email);
    abstract function ActualizarDatos();
    abstract function ListarEquipos();

    
    public function ActualizarDatosComunes() {
        
		$conn = _connect();

		$sql= "	UPDATE personas
				SET 
					nombre          = '".$conn->real_escape_string($this->nombre)."',
					apellido		= '".$conn->real_escape_string($this->apellido)."',
					documento		= '".$conn->real_escape_string($this->documento)."',
					fechaNacimiento	= '".$conn->real_escape_string($this->fechaNacimiento)."'
				WHERE id=".$this->id;
				
		$result=$conn->query($sql) or trigger_error("Failed! SQL: $sql - Error: ".mysqli_error(), E_USER_ERROR);

		return true;
    }

    
    public function calcularEdad() {
        
        $dob = date("Y-m-d",strtotime($this->fechaNacimiento));

		$dobObject = new DateTime($dob);
		$nowObject = new DateTime();

		$diff = $dobObject->diff($nowObject);

		return $diff->y;		
    }
    
    
    static function buscarEmail($email) {
        //esta busca independientemente de la persona! CAMBIAME!!! ES HORRIBLE!
        
		if($email=="") {
			return false;
		}
		
		$conn = _connect();

		$sql="	SELECT id
				FROM personas
				WHERE email=''".$conn->real_escape_string($email)."'";

		$result=$conn->query($sql) or trigger_error("Failed! SQL: $sql - Error: ".mysqli_error(), E_USER_ERROR);
		
		if($result->num_rows==0) {
			return false;
		}
		
		return true;
    }
    
    
    
    
}


?>