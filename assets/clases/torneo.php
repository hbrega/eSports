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
    
    
}


?>