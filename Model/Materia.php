<?php
session_start();

require_once 'ConnectDB.php';

class Materia{

  private $CodigoM;
  private $TipoM;
  private $TipoParticipacionM;
  private $DenominacionM;
  private $TitulacionM;
  private $AnhoAcademicoM;
  private $CreditosM;
  private $CuatrimestreM;
  private $LoginU;

//constructor de proyectos dirigidos
  public function __construct($CodigoM = NULL, $TipoM = NULL, $TipoParticipacionM = NULL, $DenominacionM = NULL, $TitulacionM = NULL,
                              $AnhoAcademicoM = NULL, $CreditosM = NULL, $CuatrimestreM = NULL , $LoginU = NULL ){
    $this->CodigoM = $CodigoM;
    $this->TipoM = $TipoM;
    $this->TipoParticipacionM = $TipoParticipacionM;
    $this->DenominacionM = $DenominacionM;
    $this->TitulacionM = $TitulacionM;
    $this->AnhoAcademicoM = $AnhoAcademicoM;
    $this->CreditosM= $CreditosM;
    $this->CuatrimestreM= $CuatrimestreM;
    $this->LoginU= $LoginU;
  }

//alta de una nueva materia
  public function AltaMateria() {
    $insertarMateria  = "INSERT INTO materia(CodigoM,TipoM, TipoParticipacionM, DenominacionM, TitulacionM,AnhoAcademicoM, CreditosM,CuatrimestreM,LoginU)
                          VALUES ('$this->CodigoM', '$this->TipoM', '$this->TipoParticipacionM', '$this->DenominacionM','$this->TitulacionM',
                          '$this->AnhoAcademicoM', '$this->CreditosM', '$this->CuatrimestreM', '$this->LoginU')";
	$resultado = mysql_query($insertarMateria) or die(mysql_error());
	}

//consultar una materia
    public function ConsultarMateria($CodigoM){
        $sql= mysql_query("SELECT * FROM materia  WHERE CodigoM = '$CodigoM'");
        return $sql;
    }

//modificar una materia
    public function ModificarMateria($CodigoM){

    }


//lista de todas las materias del usuario
    public function ListarMaterias(){
        $sql= mysql_query("SELECT * FROM materia  ");
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
