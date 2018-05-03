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

//constructor de materias
  public function __construct($CodigoM = NULL, $TipoM = NULL, $TipoParticipacionM = NULL, $DenominacionM = NULL, $TitulacionM = NULL, $AnhoAcademicoM = NULL, $CreditosM = NULL, $CuatrimestreM = NULL , $LoginU = NULL ){

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
	$resultado = mysqli_query($insertarMateria) or die(mysqli_error());
	}

//consultar una materia
    public function ConsultarMateria($CodigoM){
        $sql= mysqli_query("SELECT * FROM materia  WHERE CodigoM = '$CodigoM'");
        return $sql;
    }

//modificar una materia
    public function ModificarMateria($CodigoM){
        mysqli_query("UPDATE materia SET TipoM='$this->TipoM',TipoParticipacionM='$this->TipoParticipacionM',DenominacionM='$this->DenominacionM',
                      TitulacionM='$this->TitulacionM',TitulacionM='$this->TitulacionM',AnhoAcademicoM='$this->AnhoAcademicoM',CreditosM='$this->CreditosM',CuatrimestreM='$this->CuatrimestreM' 
                      where CodigoM = '$CodigoM'") or die (mysqli_error());
    }


//lista de todas las materias del usuario
    public function ListarMaterias($LoginU){
        $sql= mysqli_query("SELECT * FROM materia WHERE LoginU= '$LoginU' ORDER BY AnhoAcademicoM DESC");
        return $sql;
    }

//lista de todas las materias de grado
    public function ListarMateriasGrado($LoginU){
        $sql= mysqli_query("SELECT * FROM materia WHERE LoginU= '$LoginU' AND TipoM = 'Grado'");
        return $sql;
    }
//lista de todas las materias detercer ciclo
    public function ListarMateriasTCiclo($LoginU){
        $sql= mysqli_query("SELECT * FROM materia WHERE LoginU= '$LoginU' AND TipoM = 'Tercer ciclo'  ");
        return $sql;
    }
//lista de todas las materias de master
    public function ListarMateriasMaster($LoginU){
        $sql= mysqli_query("SELECT * FROM materia WHERE LoginU= '$LoginU' AND TipoM = 'Master'  ");
        return $sql;
    }
//lista de todas las materias de post grado
    public function ListarMateriasPost($LoginU){
        $sql= mysqli_query("SELECT * FROM materia WHERE LoginU= '$LoginU' AND TipoM = 'Post Grado'  ");
        return $sql;
    }
//lista de todas las materias de cursos
    public function ListarMateriasCursos($LoginU){
        $sql= mysqli_query("SELECT * FROM materia WHERE LoginU= '$LoginU' AND TipoM = 'Curso'  ");
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
