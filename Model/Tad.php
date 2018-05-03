<?php
session_start();

require_once 'ConnectDB.php';

class Tad{

  private $CodigoTAD;
  private $TituloTAD;
  private $AlumnoTAD;
  private $FechaLecturaTAD;
  private $LoginU;

//constructor de TAD
  public function __construct($CodigoTAD = NULL, $TituloTAD = NULL, $AlumnoTAD = NULL, $FechaLecturaTAD = NULL, $LoginU = NULL ){
    $this->CodigoTAD = $CodigoTAD;
    $this->TituloTAD = $TituloTAD;
    $this->AlumnoTAD = $AlumnoTAD;
    $this->FechaLecturaTAD = $FechaLecturaTAD;
    $this->LoginU= $LoginU;
  }

//alta de un nuevo TAD
  public function AltaTad() {
    $insertarTad  = "INSERT INTO tad (CodigoTAD,TituloTAD, AlumnoTAD, FechaLecturaTAD, LoginU)
                          VALUES ('$this->CodigoTAD', '$this->TituloTAD', '$this->AlumnoTAD', '$this->FechaLecturaTAD','$this->LoginU')";
	$resultado = mysqli_query($insertarTad) or die(mysqli_error());
	}

//consultar un proyecto dirigido
    public function ConsultarProyectoDirigido($CodigoP){
        $sql= mysqli_query("SELECT * FROM proyectoDirigido  WHERE CodigoPD = '$CodigoP'");
        return $sql;
    }

//modificar un proyecto dirigido
    public function ModificarProyectoDirigido($CodigoPD){
        mysqli_query("UPDATE proyectoDirigido SET TituloPD='$this->TituloPD',AlumnoPD='$this->AlumnoPD',FechaLecturaPD='$this->FechaLecturaPD' ,
                      CalificacionPD='$this->CalificacionPD',URLPD='$this->URLPD',CotutorPD='$this->CotutorPD',TipoPD='$this->TipoPD' where CodigoPD = '$CodigoPD'") or die (mysqli_error());
    }


//lista de todos los proyectos dirigidos del usuario
    public function ListarProyectosDirigidos(){
        $sql= mysqli_query("SELECT * FROM proyectoDirigido  ORDER BY FechaLecturaPD DESC");
        return $sql;

    }
//lista de todos los proyectos fin de carrera del usuario
    public function ListarProyectosDirigidosPFC(){
        $sql= mysqli_query("SELECT * FROM proyectoDirigido WHERE TipoPD = 'PFC'");

        return $sql;
    }
//lista de todos los trabajos fin de grado del usuario
    public function ListarProyectosDirigidosTFG(){
        $sql= mysqli_query("SELECT * FROM proyectoDirigido WHERE TipoPD = 'TFG'  ");

        return $sql;
    }
//lista de todos los trabajos fin de grado del usuario
    public function ListarProyectosDirigidosTFM(){
        $sql= mysqli_query("SELECT * FROM proyectoDirigido WHERE TipoPD = 'TFM'  ");

        return $sql;
    }


























  // sin modificar
//Consulta los datos de un usuario
// Devuelve los datos de un usuario


  public function modificarUsuario(){
    $_SESSION["loginU"]=$this->LoginU;
    $sql= mysqli_query("UPDATE usuario SET PasswordU='$this->PasswordU',NombreU='$this->NombreU' ,ApellidosU='$this->ApellidosU',UniversidadU='$this->UniversidadU', WHERE LoginU='$this->LoginU'") or die (mysqli_error());


  }

  public function listarDocente(){
    $sql= mysqli_query("SELECT * FROM usuario WHERE TipoU='$this->TipoU'");

    $sql2 = array();
    while($row = mysqli_fetch_array($sql)){array_push($sql2, $row);}
    $_SESSION["listarDocente"] = $sql2;

  }


}

?>
