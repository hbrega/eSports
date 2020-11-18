<?php


class Inscripcion {
    
    public $id;
    
    public $idTorneo;
    public $torneo;
    
    public $idEquipo;
    public $equipo;

    public $jugadores;

    public $idManager;
    public $manager;
    
    public $nombre;
    public $descripcion;
    public $logoURL;
    
    public $fechaAlta;
    public $fechaBaja;

    


    function __construct($id) {
    
		$conn = _connect();

		$sql="	SELECT t.id, t.idTorneo, t.idEquipo, 
                    t.idManager, t.nombre, t.descripcion, t.logoURL, 
                    t.fechaAlta, t.fechaBaja
                FROM torneos_equipos t
                WHERE t.id = '".$conn->real_escape_string($id)."'";

        
		$result=$conn->query($sql) or trigger_error("Failed! SQL: $sql - Error: ".mysqli_error(), E_USER_ERROR);

		if($result->num_rows==0) {
			return false;
		}
		
		$row=$result->fetch_assoc();
        
        
		$this->id			  = $row['id'];

        $this->nombre	      = $row['nombre'];
        $this->descripcion	  = $row['descripcion'];
        $this->logoURL	      = $row['logoURL'];

        $this->idTorneo       = $row['idTorneo'];
        $this->torneo         = new Torneo($row['idTorneo']);

        $this->idEquipo       = $row['idEquipo'];
        $this->equipo         = new Equipo($row['idEquipo']);
        
        $this->fechaAlta      = $row['fechaAlta'];
        $this->fechaBaja      = $row['fechaBaja'];
        
        
        
		$sql="	SELECT t.idJugador
                FROM torneos_equipos_jugadores t
                WHERE t.idInscripcion = '".$this->id."'";

		$result=$conn->query($sql) or trigger_error("Failed! SQL: $sql - Error: ".mysqli_error(), E_USER_ERROR);

		if($result->num_rows==0) {
			return false;
		}
		
		while($row=$result->fetch_assoc()) {
            $this->jugadores[]  = new Jugador($row['idJugador']);
        }
        
    }

    

    
    
    
}


?>