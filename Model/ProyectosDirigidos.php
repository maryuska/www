<?php
session_start();

require_once 'ConnectDB.php';

class ProyectosDirigidos{

  private $CodigoPD;
  private $TituloPD;
  private $AlumnoPD;
  private $FechaLecturaPD;
  private $CalificacionPD;
  private $URLPD;
  private $CotutorPD;
  private $TipoPD;

//constructor de proyectos dirigidos
  public function __construct($CodigoPD = NULL, $TituloPD = NULL, $AlumnoPD = NULL, $FechaLecturaPD = NULL, $CalificacionPD = NULL, $URLPD = NULL, $CotutorPD = NULL, $TipoPD = NULL ){
    $this->CodigoPD = $CodigoPD;
    $this->TituloPD = $TituloPD;
    $this->AlumnoPD = $AlumnoPD;
    $this->FechaLecturaPD = $FechaLecturaPD;
    $this->CalificacionPD = $CalificacionPD;
    $this->URLPD = $URLPD;
    $this->CotutorPD= $CotutorPD;
    $this->TipoPD= $TipoPD;
  }

//alta de un nuevo proyecto dirigido
  public function AltaProyectoDirigido() {
    $insertarProyectoDirigido  = "INSERT INTO usuario(CodigoPD,TituloPD, AlumnoPD, FechaLecturaPD, CalificacionPD,URLPD, CotutorPD,TipoPD)
                          VALUES ('$this->CodigoPD', '$this->TituloPD', '$this->AlumnoPD', '$this->FechaLecturaPD','$this->CalificacionPD','$this->URLPD', '$this->CotutorPD', '$this->TipoPD')";
	$resultado = mysql_query($insertarProyectoDirigido) or die(mysql_error());
  }


//modificar un proyecto dirigido
    public function ModificarProyectosDirigidos(){

    }


//lista de todos los proyectos dirigidos del usuario
    public function ListarProyectosDirigidos(){
        $sql= mysql_query("SELECT * FROM proyectoDirigido ");
        return $sql;

    }
//lista de todos los proyectos fin de carrera del usuario
    public function ListarProyectosDirigidosPFC(){
        $sql= mysql_query("SELECT * FROM proyectoDirigido WHERE TipoPD = 'PFC'");

        return $sql;
    }
//lista de todos los trabajos fin de grado del usuario
    public function ListarProyectosDirigidosTFG(){
        $sql= mysql_query("SELECT * FROM proyectoDirigido WHERE TipoPD = 'TFG'  ");

        return $sql;
    }
//lista de todos los trabajos fin de grado del usuario
    public function ListarProyectosDirigidosTFM(){
        $sql= mysql_query("SELECT * FROM proyectoDirigido WHERE TipoPD = 'TFM'  ");

        return $sql;
    }


























  // sin modificar
//Consulta los datos de un usuario
// Devuelve los datos de un usuario


  public function modificarUsuario(){
    $_SESSION["loginU"]=$this->LoginU;
    $sql= mysql_query("UPDATE usuario SET PasswordU='$this->PasswordU',NombreU='$this->NombreU' ,ApellidosU='$this->ApellidosU',UniversidadU='$this->UniversidadU', WHERE LoginU='$this->LoginU'") or die (mysql_error());


  }

  public function listarDocente(){
    $sql= mysql_query("SELECT * FROM usuario WHERE TipoU='$this->TipoU'");

    $sql2 = array();
    while($row = mysql_fetch_array($sql)){array_push($sql2, $row);}
    $_SESSION["listarDocente"] = $sql2;

  }


}

?>
