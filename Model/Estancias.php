<?php
session_start();

require_once 'ConnectDB.php';

class Estancias{

  private $CodigoE;
  private $CentroE;
  private $UniversidadE;
  private $PaisE;
  private $FechaInicioE;
  private $FechaFinE;
  private $TipoE;
  private $LoginU;

//constructor de estancia
  public function __construct($CodigoE = NULL, $CentroE = NULL, $UniversidadE = NULL, $PaisE = NULL, $FechaInicioE = NULL, $FechaFinE = NULL, $TipoE = NULL, $LoginU = NULL ){
    $this->CodigoE = $CodigoE;
    $this->CentroE = $CentroE;
    $this->UniversidadE = $UniversidadE;
    $this->PaisE = $PaisE;
    $this->FechaInicioE = $FechaInicioE;
    $this->FechaFinE = $FechaFinE;
    $this->TipoE= $TipoE;
    $this->LoginU= $LoginU;
  }

//alta de una nueva estancia
  public function AltaEstancia() {
    $insertarEstancia  = "INSERT INTO estancia(CodigoE,CentroE, UniversidadE, PaisE, FechaInicioE,FechaFinE, TipoE,LoginU)
                          VALUES ('$this->CodigoE', '$this->CentroE', '$this->UniversidadE', '$this->PaisE','$this->FechaInicioE','$this->FechaFinE',
                           '$this->TipoE', '$this->LoginU')";
	$resultado = mysqli_query($insertarEstancia) or die(mysqli_error());
	}

//consultar una estancia
    public function ConsultarEstancia($CodigoE){
        $sql= mysqli_query("SELECT * FROM estancia  WHERE CodigoE = '$CodigoE'");
        return $sql;
    }

//modificar una estancia
    public function ModificarEstancia($CodigoE){
        mysqli_query("UPDATE estancia SET CentroE='$this->CentroE',UniversidadE='$this->UniversidadE',PaisE='$this->PaisE' ,
                      FechaInicioE='$this->FechaInicioE',FechaFinE='$this->FechaFinE',TipoE='$this->TipoE' where CodigoE = '$CodigoE'") or die (mysqli_error());
    }

//lista de todas las estancias de un usuario
    public function ListarEstancias($LoginU){
        $sql= mysqli_query("SELECT * FROM estancia WHERE LoginU= '$LoginU' ORDER BY FechaFinE DESC");
        return $sql;

    }
//lista de todas las estancias de invertigacion
    public function ListarEstanciasInvertigacion($LoginU){
        $sql= mysqli_query("SELECT * FROM estancia WHERE LoginU= '$LoginU' AND TipoE = 'Investigacion'");
        return $sql;
    }
//lista de todas las estancias de doctorado
    public function ListarEstanciasDoctorado($LoginU){
        $sql= mysqli_query("SELECT * FROM estancia WHERE LoginU= '$LoginU' AND TipoE = 'Doctorado'");
        return $sql;
    }
//lista de todas las estancias de invitado
    public function ListarEstanciasInvitado($LoginU){
        $sql= mysqli_query("SELECT * FROM estancia WHERE LoginU= '$LoginU' AND TipoE = 'Invitado'");
        return $sql;
    }

}

?>
