<?php
if(!isset($_SESSION))
    session_start();

require_once 'Validacion.php';

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




//consultar una materia
    public function ConsultarTad($CodigoTAD){
        $this->ConectarBD();
        $sql= $this->mysqli->query("SELECT * FROM tad  WHERE CodigoTAD = '$CodigoTAD'");
        return $sql;
    }

//modificar una materia
    public function ModificarTad($CodigoTAD){
        $this->ConectarBD();
        $this->mysqli->query("UPDATE tad SET  TituloTAD='$this->TituloTAD',
                                                  AlumnoTAD='$this->AlumnoTAD',
                                                  FechaLecturaTAD='$this->FechaLecturaTAD'
                              where CodigoTAD = '$CodigoTAD'") or die (mysqli_error($this->mysqli));
    }


    //lista tad
    public function ListarTad($LoginU){
        $this->ConectarBD();
        $sql= $this->mysqli->query("SELECT * FROM tad WHERE LoginU= '$LoginU'");
        return $sql;
    }
    //lista tad admin
    public function ListarTadAdmin(){
        $this->ConectarBD();
        $sql= $this->mysqli->query("SELECT * FROM tad");
        return $sql;
    }




//eliminar tad
    public function BorrarTad($CodigoTAD){
        $this->ConectarBD();
        $this->mysqli->query("DELETE FROM materia WHERE CodigoM= '$CodigoTAD'")or die(mysqli_error($this->mysqli));
    }

    /**
     * Valida si los campos del formulario de una materia son correctos
     *
     * @param array $campos del formulario
     * @return array $errores, contiene los campos fallidos $errores[] = nombre del campo
     */
    public function validarTad($campos){

        $errores    = array();
        $validar    = new Validacion();

        if(isset($campos["CodigoTAD"]) && !$validar->validarLetrasYNumeros($campos["CodigoTAD"]))
            $errores[]  = "CodigoTAD";

        if(isset($campos["TituloTAD"]) && !$validar->validarLetrasYNumeros($campos["TituloTAD"]))
            $errores[]  = "TituloTAD";

        if(isset($campos["AlumnoTAD"]) && !$validar->validarSoloLetras($campos["AlumnoTAD"]))
            $errores[]  = "AlumnoTAD";

        if(isset($campos["FechaLecturaTAD"]) && ( !$validar->validarFecha($campos["FechaLecturaTAD"]) || (date("Y-m-d", strtotime($campos["FechaLecturaTAD"])) >= date("Y-m-d")) ) )
            $errores[]  = "FechaLecturaTAD";

        return $errores;
    }

    //buscar materia
    public function BuscarTad($buscar){
        $this->ConectarBD();
        $sql = $this->mysqli->query("SELECT * FROM tad WHERE CodigoTAD LIKE '%$buscar' || CodigoTAD LIKE '%$buscar%' || CodigoTAD LIKE '$buscar%' ||
                                                            TituloTAD LIKE '%$buscar'|| TituloTAD LIKE '%$buscar%' || TituloTAD LIKE '$buscar%' ||
                                                            AlumnoTAD LIKE '%$buscar'|| AlumnoTAD LIKE '%$buscar%' || AlumnoTAD LIKE '$buscar%' ||
                                                            FechaLecturaTAD LIKE '%$buscar'|| FechaLecturaTAD LIKE '%$buscar%' || FechaLecturaTAD LIKE '$buscar%'
                                                            ") or die(mysqli_error($this->mysqli));
        return $sql;
    }























}

?>
