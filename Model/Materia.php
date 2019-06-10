<?php
if(!isset($_SESSION))
    session_start();

require_once 'Validacion.php';


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

//Constructor de materias
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
  
//Función para conectarnos a la Base de datos
    function ConectarBD()
    {
        $this->mysqli = new mysqli("localhost", "docente", "docente", "datos_curriculares");

        if ($this->mysqli->connect_errno) {
            echo "Fallo al conectar a MySQL: (" . $this->mysqli->connect_errno . ") " . $this->mysqli->connect_error;
        }
    }
	
//Alta de una nueva materia
  public function AltaMateria() {
      $this->ConectarBD();
    $insertarMateria  = "INSERT INTO materia(CodigoM,TipoM, TipoParticipacionM, DenominacionM, TitulacionM,AnhoAcademicoM, CreditosM,CuatrimestreM,LoginU)
                          VALUES ('$this->CodigoM', '$this->TipoM', '$this->TipoParticipacionM', '$this->DenominacionM','$this->TitulacionM',
                          '$this->AnhoAcademicoM', '$this->CreditosM', '$this->CuatrimestreM', '$this->LoginU')";
	$resultado = $this->mysqli->query($insertarMateria) or die(mysqli_error($this->mysqli));
	}

//Consultar una materia
    public function ConsultarMateria($CodigoM){
        $this->ConectarBD();
        $sql= $this->mysqli->query("SELECT * FROM materia  WHERE CodigoM = '$CodigoM'");
        return $sql;
    }

//Modificar una materia
    public function ModificarMateria($CodigoM){
        $this->ConectarBD();
        $this->mysqli->query("UPDATE materia SET  TipoM='$this->TipoM',
                                                  TipoParticipacionM='$this->TipoParticipacionM',
                                                  DenominacionM='$this->DenominacionM',
                                                  TitulacionM='$this->TitulacionM',
                                                  TitulacionM='$this->TitulacionM',
                                                  AnhoAcademicoM='$this->AnhoAcademicoM',
                                                  CreditosM='$this->CreditosM',
                                                  CuatrimestreM='$this->CuatrimestreM' 
                              where CodigoM = '$CodigoM'") or die (mysqli_error($this->mysqli));
    }

//Listar materias de un usuario determinado
        //lista de todas las materias del usuario
            public function ListarMaterias($LoginU){
                $this->ConectarBD();
                $sql= $this->mysqli->query("SELECT * FROM materia WHERE LoginU= '$LoginU' ORDER BY AnhoAcademicoM DESC");
                return $sql;
            }

        //lista de todas las materias de grado
            public function ListarMateriasGrado($LoginU){
                $this->ConectarBD();
                $sql= $this->mysqli->query("SELECT * FROM materia WHERE LoginU= '$LoginU' AND TipoM = 'Grado'");
                return $sql;
            }

        //lista de todas las materias detercer ciclo
            public function ListarMateriasTCiclo($LoginU){
                $this->ConectarBD();
                $sql= $this->mysqli->query("SELECT * FROM materia WHERE LoginU= '$LoginU' AND TipoM = 'Tercer ciclo'  ");
                return $sql;
            }

        //lista de todas las materias de master
            public function ListarMateriasMaster($LoginU){
                $this->ConectarBD();
                $sql= $this->mysqli->query("SELECT * FROM materia WHERE LoginU= '$LoginU' AND TipoM = 'Master'  ");
                return $sql;
            }

        //lista de todas las materias de post grado
            public function ListarMateriasPost($LoginU){
                $this->ConectarBD();
                $sql= $this->mysqli->query("SELECT * FROM materia WHERE LoginU= '$LoginU' AND TipoM = 'Post Grado'  ");
                return $sql;
            }

        //lista de todas las materias de cursos
            public function ListarMateriasCursos($LoginU){
                $this->ConectarBD();
                $sql= $this->mysqli->query("SELECT * FROM materia WHERE LoginU= '$LoginU' AND TipoM = 'Curso'  ");
                return $sql;
            }

//Listar materias como administrador
        //lista de todas las materias del usuario
            public function ListarMateriasAdmin(){
                $this->ConectarBD();
                $sql= $this->mysqli->query("SELECT * FROM materia ORDER BY AnhoAcademicoM DESC");
                return $sql;
            }

        //lista de todas las materias de grado
            public function ListarMateriasGradoAdmin(){
                $this->ConectarBD();
                $sql= $this->mysqli->query("SELECT * FROM materia WHERE TipoM = 'Grado'");
                return $sql;
            }

        //lista de todas las materias detercer ciclo
            public function ListarMateriasTCicloAdmin(){
                $this->ConectarBD();
                $sql= $this->mysqli->query("SELECT * FROM materia WHERE TipoM = 'Tercer ciclo'  ");
                return $sql;
            }

        //lista de todas las materias de master
            public function ListarMateriasMasterAdmin(){
                $this->ConectarBD();
                $sql= $this->mysqli->query("SELECT * FROM materia WHERE TipoM = 'Master'  ");
                return $sql;
            }

        //lista de todas las materias de post grado
            public function ListarMateriasPostAdmin(){
                $this->ConectarBD();
                $sql= $this->mysqli->query("SELECT * FROM materia  WHERE TipoM = 'Post Grado'  ");
                return $sql;
            }

        //lista de todas las materias de cursos
            public function ListarMateriasCursosAdmin(){
                $this->ConectarBD();
                $sql= $this->mysqli->query("SELECT * FROM materia  WHERE TipoM = 'Curso'  ");
                return $sql;
            }

//Eliminar materia
    public function BorrarMateria($CodigoM){
        $this->ConectarBD();
        $this->mysqli->query("DELETE FROM materia WHERE CodigoM= '$CodigoM'")or die(mysqli_error($this->mysqli));
    }

    /**
     * Valida si los campos del formulario de una materia son correctos
     *
     * @param array $campos del formulario
     * @return array $errores, contiene los campos fallidos $errores[] = nombre del campo
     */
    public function validarMateria($campos){

        $errores    = array();
        $validar    = new Validacion();

        // Codigo Materia
        if(isset($campos["CodigoM"]) && !$validar->validarLetrasYNumeros($campos["CodigoM"]))
            $errores[]  = "CodigoM";

        // Tipo Materia
        if(isset($campos["TipoM"]) && !$validar->validarSoloLetras($campos["TipoM"]))
            $errores[]  = "TipoM";

        // Tipo de participacion en la materia
        if(isset($campos["TipoParticipacionM"]) && !$validar->validarSoloLetras($campos["TipoParticipacionM"]))
            $errores[]  = "TipoParticipacionM";

        // Nombre de la materia
        if(isset($campos["DenominacionM"]) && !$validar->validarSoloLetras($campos["DenominacionM"]))
            $errores[]  = "DenominacionM";

        // En que titulacion se imparte la materia
        if(isset($campos["TitulacionM"]) && !$validar->validarSoloLetras($campos["TitulacionM"]))
            $errores[]  = "TitulacionM";

        // Fecha en la que se imparte la materia
        if(isset($campos["AnhoAcademicoM"]) && ( !$validar->validarFecha($campos["AnhoAcademicoM"]) || (date("Y-m-d", strtotime($campos["AnhoAcademicoM"])) >= date("Y-m-d")) ) )
            $errores[]  = "AnhoAcademicoM";

        // Creditos de la materia
        if(isset($campos["CreditosM"]) && !$validar->validarLetrasYNumeros($campos["CreditosM"]))
            $errores[]  = "CreditosM";

        // Cuatrimestre en el que se imparte la materia
        if(isset($campos["CuatrimestreM"]) && !$validar->validarLetrasYNumeros($campos["CuatrimestreM"]))
            $errores[]  = "CuatrimestreM";

        return $errores;
    }

//Buscar materia
    public function BuscarMateria($buscar){
        $this->ConectarBD();
        $sql = $this->mysqli->query("SELECT * FROM materia WHERE CodigoM LIKE '%$buscar' || CodigoM LIKE '%$buscar%' || CodigoM LIKE '$buscar%' ||
                                                            TipoM LIKE '%$buscar'|| TipoM LIKE '%$buscar%' || TipoM LIKE '$buscar%' ||
                                                            TipoParticipacionM LIKE '%$buscar'|| TipoParticipacionM LIKE '%$buscar%' || TipoParticipacionM LIKE '$buscar%' ||
                                                            DenominacionM LIKE '%$buscar'|| DenominacionM LIKE '%$buscar%' || DenominacionM LIKE '$buscar%' ||
                                                            TitulacionM LIKE '%$buscar'|| TitulacionM LIKE '%$buscar%' || TitulacionM LIKE '$buscar%' ||
                                                            AnhoAcademicoM LIKE '%$buscar'|| AnhoAcademicoM LIKE '%$buscar%' || AnhoAcademicoM LIKE '$buscar%' ||
                                                            CreditosM LIKE '%$buscar'|| CreditosM LIKE '%$buscar%' || CreditosM LIKE '$buscar%' ||
                                                            CuatrimestreM LIKE '%$buscar'|| CuatrimestreM LIKE '%$buscar%' || CuatrimestreM LIKE '$buscar%' 
                                                            ") or die(mysqli_error($this->mysqli));
        return $sql;
    }


}

?>
