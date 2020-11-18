<?php

class Equipo {
    
    public $id;
    
    public $manager;
    public $jugadores;

    public $nombre;
    public $descripcion;
    public $logoURL;
    
    public $fechaAlta;
    public $fechaBaja;


    function __construct($id) {
    
		$conn = _connect();

		$sql="	SELECT e.id, e.idManager,
                    e.nombre, e.descripcion, e.logoURL,
                    e.fechaAlta, e.fechaBaja
                FROM equipos e
                WHERE e.id = '".$conn->real_escape_string($id)."'";

        
		$result=$conn->query($sql) or trigger_error("Failed! SQL: $sql - Error: ".mysqli_error(), E_USER_ERROR);

		if($result->num_rows==0) {
			return false;
		}
		
		$row=$result->fetch_assoc();
        
        
		$this->id			  = $row['id'];

        $this->manager        = new Manager($row['idManager']);
        $this->jugadores      = $this->ListarJugadores();

        $this->nombre         = $row['nombre'];
        $this->descripcion    = $row['descripcion'];
        $this->logoURL        = $row['logoURL'];
        
        $this->fechaAlta      = $row['fechaAlta'];
        $this->fechaBaja      = $row['fechaBaja'];
    
    }


    static function Nuevo($nombre, $manager, $descripcion) {
        
		$conn = _connect();
        
		$sql="	INSERT INTO equipos (
					idManager, nombre, descripcion
				)
				VALUES (
                    '".$conn->real_escape_string($manager->id)."',
					'".$conn->real_escape_string($nombre)."',
					'".$conn->real_escape_string($descripcion)."'
                )";

        
		if (!$conn->query($sql)) {
			echo($conn->errno." ".$conn->error);
			return false;
		}

		$idEquipo = $conn->insert_id;
		$equipo = new Equipo($idEquipo);

		return $equipo;        
    }
    
    
    public function ActualizarDatos() {
        
		$conn = _connect();

		$sql= "	UPDATE equipos
				SET 
					nombre         = '".$conn->real_escape_string($this->nombre)."',
					descripcion    = '".$conn->real_escape_string($this->descripcion)."'
				WHERE id           = ".$this->id;
				
		$result=$conn->query($sql) or trigger_error("Failed! SQL: $sql - Error: ".mysqli_error(), E_USER_ERROR);

		return true;
    }
    
    
    public function ActualizarLogo() {
        
		$conn = _connect();

		$sql= "	UPDATE equipos
				SET 
					logoURL        = '".$conn->real_escape_string($this->logoURL)."'
				WHERE id           = ".$this->id;
				
		$result=$conn->query($sql) or trigger_error("Failed! SQL: $sql - Error: ".mysqli_error(), E_USER_ERROR);

		return true;
    }
    
    
    public function AgregarJugador($jugador) {
        
		$conn = _connect();
        
        if($jugador->ListarEquipos()) {
            return false;
        }
        

        $sql="	INSERT INTO equipos_jugadores (
					idEquipo, idJugador
				)
				VALUES (
                    '".$conn->real_escape_string($this->id)."',
					'".$conn->real_escape_string($jugador->id)."'
                )";

        
		if (!$conn->query($sql)) {
			echo($conn->errno." ".$conn->error);
			return false;
		}

        return true;
    }
    
    
    public function EliminarJugador($jugador) {
        
		$conn = _connect();

        $equipoJugador = $jugador->ListarEquipos();

        if(!$equipoJugador) {
            return false;    
        } 
           
        if($equipoJugador->id != $this->id) {
            return false;    
        } 
           
        
        $sql="	UPDATE equipos_jugadores 
                SET fechaBaja       = NOW()
                WHERE idEquipo      = '".$conn->real_escape_string($this->id)."'
                    AND idJugador   = '".$conn->real_escape_string($jugador->id)."'
                    AND fechaBaja IS NULL";
        
		if (!$conn->query($sql)) {
			echo($conn->errno." ".$conn->error);
			return false;
		}

        return true;
    }
    


    public function EliminarEquipo() {
        
		$conn = _connect();

        $sql="	UPDATE equipos
                SET fechaBaja       = NOW()
                WHERE id            = '".$conn->real_escape_string($this->id)."'";

        
		if (!$conn->query($sql)) {
			echo($conn->errno." ".$conn->error);
			return false;
		}

        return true;
    }    
    
    
    
    public function ListarJugadores() {
        
		$conn = _connect();

		$sql="	SELECT idJugador
				FROM equipos_jugadores
				WHERE idEquipo = '".$conn->real_escape_string($this->id)."'
					AND fechaBaja IS NULL";
        
		$result=$conn->query($sql) or trigger_error("Failed! SQL: $sql - Error: ".mysqli_error(), E_USER_ERROR);

		if($result->num_rows==0) {
			return false;
		}

		while($row=$result->fetch_assoc()) {
			$jugadores[] = new Jugador($row['idJugador']);
		}

		return $jugadores;
    }
    
    
    
    public function ListarInvitaciones() {
        
		$conn = _connect();
        
		$sql="	SELECT id
				FROM equipos_invitaciones
				WHERE idEquipo = '".$conn->real_escape_string($this->id)."'
					AND respuesta IS NULL";
        
		$result=$conn->query($sql) or trigger_error("Failed! SQL: $sql - Error: ".mysqli_error(), E_USER_ERROR);

		if($result->num_rows==0) {
			return false;
		}

		while($row=$result->fetch_assoc()) {
			$invitaciones[] = new Invitacion($row['id']);
		}

		return $invitaciones;

    }
    
    
    public function ListarTorneos() {
        
		$conn = _connect();
        
		$sql="	SELECT id
				FROM torneos_equipos
				WHERE idEquipo = '".$conn->real_escape_string($this->id)."'
					AND fechaBaja IS NULL";
        
		$result=$conn->query($sql) or trigger_error("Failed! SQL: $sql - Error: ".mysqli_error(), E_USER_ERROR);

		if($result->num_rows==0) {
			return false;
		}

		while($row=$result->fetch_assoc()) {
			$inscripciones[] = new Inscripcion($row['id']);
		}

		return $inscripciones;
        
    }
    
    
    
}


?>