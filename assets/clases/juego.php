<?php


class Juego {
    
    public $id;
    
    public $nombre;
    
    public $jugadores;

    public $logo;
    public $paginaURL;
    public $red;
    

    
    function __construct($id) {
    
		$conn = _connect();

		$sql="	SELECT j.id, j.nombre,
                    j.jugadores, j.logo, j.paginaURL, j.red
                FROM juegos j
                WHERE j.id = '".$conn->real_escape_string($id)."'";

        
		$result=$conn->query($sql) or trigger_error("Failed! SQL: $sql - Error: ".mysqli_error(), E_USER_ERROR);

		if($result->num_rows==0) {
			return false;
		}
        
        

		$row=$result->fetch_assoc();
        

        
		$this->id			= $row['id'];

        $this->nombre       = $row['nombre'];

        $this->jugadores    = $row['jugadores'];

        $this->logo         = $row['logo'];
        $this->paginaURL    = $row['$paginaURL'];
        $this->red          = $row['red'];
        
    }
    
}

?>