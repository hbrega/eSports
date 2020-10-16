<?php

class Invitacion {
    
    public $id;
    
    public $jugador;
    public $equipo;
    
    public $respuesta;
    
    public $fechaEnvio;
    public $fechaRespuesta;
    

    function __construct($id) {
        
		$conn = _connect();

		$sql="	SELECT id, idEquipo, idJugador,
                    respuesta, fechaEnvio, fechaRespuesta
                FROM equipos_invitaciones 
                WHERE id = '".$conn->real_escape_string($id)."'";

        
		$result=$conn->query($sql) or trigger_error("Failed! SQL: $sql - Error: ".mysqli_error(), E_USER_ERROR);

		if($result->num_rows==0) {
			return false;
		}
		
		$row=$result->fetch_assoc();
        
        
        $this->id               = $row['id'];

        $this->jugador          = new Jugador($row['idJugador']);
        $this->equipo           = new Equipo($row['idEquipo']);
        
		$this->respuesta		= $row['respuesta'];
    
        $this->fechaEnvio       = $row['fechaEnvio'];
        $this->fechaRespuesta   = $row['fechaRespuesta'];

    }
    
    
    static function Invitar($jugador, $equipo) {
        
		$conn = _connect();

		$sql="	INSERT INTO equipos_invitaciones (
					idEquipo, idJugador
				)
				VALUES (
					'".$conn->real_escape_string($equipo->id)."',
					'".$conn->real_escape_string($jugador->id)."'
				)";

        
		if (!$conn->query($sql)) {
			echo($conn->errno." ".$conn->error);
			return false;
		}

		if (!$conn->query($sql)) {
			echo($conn->errno." ".$conn->error);
			return false;
		}

		$idInvitacion = $conn->insert_id;
		$invitacion = new Invitacion($idInvitacion);

		return $invitacion; 
    }
    

    public function AceptarInvitacion() {
        
		$conn = _connect();

        if(!$this->equipo->AgregarJugador($this->jugador)) {
            return false;
        }
        
		$sql="	UPDATE equipos_invitaciones
                SET respuesta       = 'S',
                    fechaRespuesta  = NOW()
                WHERE id            = '".$conn->real_escape_string($this->id)."'";
                    
		if (!$conn->query($sql)) {
			echo($conn->errno." ".$conn->error);
			return false;
		}

        //rechazar el resto de las invitaciones:
        $invitaciones = $this->jugador->ListarInvitaciones();
        foreach($invitaciones as $invitacion) {
            $invitacion->RechazarInvitacion();    
        }
        
        
		return true;        
    }
    
    
    public function RechazarInvitacion() {
        
		$conn = _connect();

		$sql="	UPDATE equipos_invitaciones
                SET respuesta       = 'N',
                    fechaRespuesta  = NOW()
                WHERE id            = '".$conn->real_escape_string($this->id)."'";
                    
		if (!$conn->query($sql)) {
			echo($conn->errno." ".$conn->error);
			return false;
		}

		return true;        
    }
        
    
    
    
    
    
}

?>