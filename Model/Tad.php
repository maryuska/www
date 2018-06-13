<?php
session_start();


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
    //Función para conectarnos a la Base de datos
    function ConectarBD()
    {
        $this->mysqli = new mysqli("localhost", "docente", "docente", "datos_curriculares");

        if ($this->mysqli->connect_errno) {
            echo "Fallo al conectar a MySQL: (" . $this->mysqli->connect_errno . ") " . $this->mysqli->connect_error;
        }
    }


//alta de un nuevo TAD
  public function AltaTad() {
      $this->ConectarBD();
    $insertarTad  = "INSERT INTO tad (CodigoTAD,TituloTAD, AlumnoTAD, FechaLecturaTAD, LoginU)
                          VALUES ('$this->CodigoTAD', '$this->TituloTAD', '$this->AlumnoTAD', '$this->FechaLecturaTAD','$this->LoginU')";
	$resultado = $this->mysqli->query($insertarTad) or die(mysqli_error($this->mysqli));
	}

//consultar un proyecto dirigido
    public function ConsultarProyectoDirigido($CodigoP){
        $this->ConectarBD();
        $sql= $this->mysqli->query("SELECT * FROM proyectoDirigido  WHERE CodigoPD = '$CodigoP'");
        return $sql;
    }

//modificar un proyecto dirigido
    public function ModificarProyectoDirigido($CodigoPD){
        $this->ConectarBD();
        $this->mysqli->query("UPDATE proyectoDirigido SET TituloPD='$this->TituloPD',AlumnoPD='$this->AlumnoPD',FechaLecturaPD='$this->FechaLecturaPD' ,
                      CalificacionPD='$this->CalificacionPD',URLPD='$this->URLPD',CotutorPD='$this->CotutorPD',TipoPD='$this->TipoPD' where CodigoPD = '$CodigoPD'") or die (mysqli_error($this->mysqli));
    }


//lista de todos los proyectos dirigidos del usuario
    public function ListarProyectosDirigidos(){
        $this->ConectarBD();
        $sql= $this->mysqli->query("SELECT * FROM proyectoDirigido  ORDER BY FechaLecturaPD DESC");
        return $sql;

    }
//lista de todos los proyectos fin de carrera del usuario
    public function ListarProyectosDirigidosPFC(){
        $this->ConectarBD();
        $sql= $this->mysqli->query("SELECT * FROM proyectoDirigido WHERE TipoPD = 'PFC'");

        return $sql;
    }
//lista de todos los trabajos fin de grado del usuario
    public function ListarProyectosDirigidosTFG(){
        $this->ConectarBD();
        $sql= $this->mysqli->query("SELECT * FROM proyectoDirigido WHERE TipoPD = 'TFG'  ");

        return $sql;
    }
//lista de todos los trabajos fin de grado del usuario
    public function ListarProyectosDirigidosTFM(){
        $this->ConectarBD();
        $sql= $this->mysqli->query("SELECT * FROM proyectoDirigido WHERE TipoPD = 'TFM'  ");

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
