<?php

class Jugador extends Persona {
    
    public $avatarURL;
    public $nickname;

    public $steamID;
    public $psnID;
    public $xboxID;
    public $discordID; 

    public $facebookURL;
    public $instagramURL;
    public $twitterURL;

    public $sobreMi;
     
     
    
    
    function __construct($id) {
        
		$conn = _connect();

		$sql="	SELECT p.id, p.tipoPersona,
                    p.nombre, p.apellido,
                    p.email, p.clave,
                    p.documento, p.fechaNacimiento,
                    j.avatarURL, j.nickname,
                    j.steamID, j.psnID, j.xboxID, j.discordID,
                    j.facebookURL, j.instagramURL, j.twitterURL,
                    j.sobreMi, p.fechaAlta
                FROM personas p
                JOIN jugadores j ON p.id = j.idPersona
                WHERE p.id = '".$conn->real_escape_string($id)."'";

        
		$result=$conn->query($sql) or trigger_error("Failed! SQL: $sql - Error: ".mysqli_error(), E_USER_ERROR);

		if($result->num_rows==0) {
			return false;
		}
		
		$row=$result->fetch_assoc();
        
        
		$this->id				= $row['id'];

        $this->nombre           = $row['nombre'];
        $this->apellido         = $row['apellido'];
        
		$this->email			= $row['email'];
        $this->clave            = $row['clave'];
    
        $this->documento        = $row['documento'];
        $this->fechaNacimiento  = $row['fechaNacimiento'];

        $this->avatarURL        = $row['avatarURL'];
        $this->nickname         = $row['nickname'];

        $this->steamID          = $row['steamID'];
        $this->psnID            = $row['psnID'];
        $this->xboxID           = $row['xboxID'];
        $this->discordID        = $row['discordID'];

        $this->facebookURL      = $row['facebookURL'];
        $this->instagramURL     = $row['instagramURL'];
        $this->twitterURL       = $row['twitterURL'];

        $this->sobreMi          = $row['sobreMi'];
        $this->fechaAlta        = $row['fechaAlta'];

    }
    
    
    static function Login($email, $pass) {
        
		$conn = _connect();
		
		$sql="	SELECT id
				FROM personas
				WHERE email = '".$conn->real_escape_string($email)."'
				    AND clave = md5('".$conn->real_escape_string($pass)."')
                    AND tipoPersona = 1 ";

		$result=$conn->query($sql) or trigger_error("Failed! SQL: $sql - Error: ".mysqli_error(), E_USER_ERROR);
		
		if($result->num_rows==0) {
			return false;
		}

		$row=$result->fetch_assoc();
		
		$jugador = new Jugador($row['id']);

		return $jugador;
    }
     
    
    static function Nuevo($email, $pass, $fechaNacimiento) {
        
		$conn = _connect();
        
		$sql="	INSERT INTO personas (
					tipoPersona, email, clave, fechaNacimiento
				)
				VALUES (
                    1,
					'".$conn->real_escape_string($email)."',
					md5('".$conn->real_escape_string($pass)."'),
					'".$conn->real_escape_string($fechaNacimiento)."'
				)";
		
		
		if (!$conn->query($sql)) {
			echo($conn->errno." ".$conn->error);
			return false;
		}

		$idJugador = $conn->insert_id;


        $sql="	INSERT INTO jugadores (
					idPersona
				)
				VALUES (
                    ".$idJugador."
				)";
        
        
		$conn->query($sql);
        
		$jugador = new Jugador($idJugador);

        
		return $jugador;        
    }
    
    
    static function BuscarPorEmail($email) {
        
		$conn = _connect();
		
		$sql="	SELECT id
				FROM personas
				WHERE email = '".$conn->real_escape_string($email)."'
                    AND tipoPersona = 1 ";

		$result=$conn->query($sql) or trigger_error("Failed! SQL: $sql - Error: ".mysqli_error(), E_USER_ERROR);
		
		if($result->num_rows==0) {
			return false;
		}

		$row=$result->fetch_assoc();
		
		$jugador = new Jugador($row['id']);

		return $jugador;
    }


    public function ActualizarDatos() {
        
		$conn = _connect();

		$sql= "	UPDATE jugadores
				SET 
					nickname       = '".$conn->real_escape_string($this->nickname)."',
					steamID        = '".$conn->real_escape_string($this->steamID)."',
					psnID		   = '".$conn->real_escape_string($this->psnID)."',
					xboxID		   = '".$conn->real_escape_string($this->xboxID)."',
					discordID	   = '".$conn->real_escape_string($this->discordID)."',
					facebookURL	   = '".$conn->real_escape_string($this->facebookURL)."',
					instagramURL   = '".$conn->real_escape_string($this->instagramURL)."',
					twitterURL	   = '".$conn->real_escape_string($this->twitterURL)."',
					sobreMi		   = '".$conn->real_escape_string($this->sobreMi)."'
				WHERE idPersona    = ".$this->id;
				
		$result=$conn->query($sql) or trigger_error("Failed! SQL: $sql - Error: ".mysqli_error(), E_USER_ERROR);

		return true;
    } 
     
    
    public function ActualizarAvatar() {
        
		$conn = _connect();

		$sql= "	UPDATE jugadores
				SET 
					avatarURL      = '".$conn->real_escape_string($this->avatarURL)."'
				WHERE idPersona    = ".$this->id;
				
		$result=$conn->query($sql) or trigger_error("Failed! SQL: $sql - Error: ".mysqli_error(), E_USER_ERROR);

		return true;
    }

    
    public function ListarInvitaciones() {
        
		$conn = _connect();

		$sql="	SELECT id
				FROM equipos_invitaciones
				WHERE idJugador = '".$conn->real_escape_string($this->id)."'
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


    
    public function ListarEquipos() {
        
		$conn = _connect();

		$sql="	SELECT idEquipo
				FROM equipos_jugadores
				WHERE idJugador = '".$this->id."'
					AND fechaBaja IS NULL
                LIMIT 1";

		$result=$conn->query($sql) or trigger_error("Failed! SQL: $sql - Error: ".mysqli_error(), E_USER_ERROR);

		if($result->num_rows==0) {
			return false;
		}

		$row=$result->fetch_assoc();
		$equipo = new Equipo($row['idEquipo']);
        
		return $equipo;		
    }
    
    
    public function ListarTorneos() {
        
        return false;
    }
    
    
    
}

?>