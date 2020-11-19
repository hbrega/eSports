<?php


class Torneo {
    
    public $id;
    
    public $nombre;
    
    public $idJuego;
    public $juego;

    public $cupoEquipos;
    public $edadMinima;
    public $descripcion;
    
    public $fechaAlta;
    public $fechaBaja;

    


    function __construct($id) {
    
		$conn = _connect();

		$sql="	SELECT t.id, t.nombre, 
                    t.idJuego, t.cupoEquipos, t.edadMinima,
                    t.mCierreInscripcion, t.descripcion,
                    t.fechaAlta, t.fechaBaja
                FROM torneos t
                WHERE t.id = '".$conn->real_escape_string($id)."'";

        
		$result=$conn->query($sql) or trigger_error("Failed! SQL: $sql - Error: ".mysqli_error(), E_USER_ERROR);

		if($result->num_rows==0) {
			return false;
		}
		
		$row=$result->fetch_assoc();
        
        
		$this->id			  = $row['id'];

        $this->nombre	      = $row['nombre'];

        $this->idJuego        = $row['idJuego'];
        $this->juego          = new Juego($row['idJuego']);

        $this->cupoEquipos    = $row['cupoEquipos'];
        $this->edadMinima     = $row['edadMinima'];
        $this->descripcion    = $row['descripcion'];
        
        $this->fechaAlta      = $row['fechaAlta'];
        $this->fechaBaja      = $row['fechaBaja'];
    
    }
    
    
    
    function AbandonarTorneo($equipo) {
        
		$conn = _connect();
        
		$sql= "	UPDATE torneos_equipos
				SET 
					fechaBaja      = NOW()
				WHERE idTorneo     = ".$this->id."
                    AND idEquipo   = ".$equipo->id."
                    AND fechaBaja  IS NULL";

		$result=$conn->query($sql) or trigger_error("Failed! SQL: $sql - Error: ".mysqli_error(), E_USER_ERROR);
        
        
		$sql= "	UPDATE torneos_equipos_jugadores
				SET 
					fechaBaja      = NOW()
				WHERE idTorneo     = ".$this->id."
                    AND idEquipo   = ".$equipo->id."
                    AND fechaBaja  IS NULL";

		$result=$conn->query($sql) or trigger_error("Failed! SQL: $sql - Error: ".mysqli_error(), E_USER_ERROR);

        
        return true;
    }
    
    
    
    function ListarJugadores($equipo) {
        
		$conn = _connect();
        
		$sql="	SELECT idJugador
				FROM torneos_equipos_jugadores
				WHERE idTorneo = '".$conn->real_escape_string($this->id)."'
                    AND idEquipo  = '".$conn->real_escape_string($equipo->id)."'
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
    
    
    
    function CheckEquipo($equipo) {
        
		$conn = _connect();
        
		$sql="	SELECT id
				FROM torneos_equipos
				WHERE idTorneo = '".$conn->real_escape_string($this->id)."'
                    AND idEquipo  = '".$conn->real_escape_string($equipo->id)."'
					AND fechaBaja IS NULL";
        
		$result=$conn->query($sql) or trigger_error("Failed! SQL: $sql - Error: ".mysqli_error(), E_USER_ERROR);

		if($result->num_rows==0) {
			return true;
		}
        
        return false;
        
    }

    
    function CheckJugador($jugador) {
        
		$conn = _connect();

		$sql="	SELECT id
				FROM torneos_equipos_jugadores
				WHERE idTorneo = '".$conn->real_escape_string($this->id)."'
                    AND idJugador  = '".$conn->real_escape_string($jugador->id)."'
					AND fechaBaja IS NULL";
        
		$result=$conn->query($sql) or trigger_error("Failed! SQL: $sql - Error: ".mysqli_error(), E_USER_ERROR);

		if($result->num_rows==0) {
			return true;
		}
        
        return false;        
        
    }
    

    
    
    
}


?>