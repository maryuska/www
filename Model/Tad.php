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
  private $AdjuntoTAD;

//Constructor de TAD
  public function __construct($CodigoTAD = NULL, $TituloTAD = NULL, $AlumnoTAD = NULL, $FechaLecturaTAD = NULL, $LoginU = NULL, $AdjuntoTAD = NULL ){
    $this->CodigoTAD = $CodigoTAD;
    $this->TituloTAD = $TituloTAD;
    $this->AlumnoTAD = $AlumnoTAD;
    $this->FechaLecturaTAD = $FechaLecturaTAD;
    $this->LoginU= $LoginU;
    $this->AdjuntoTAD= $AdjuntoTAD;
  }
  
//Función para conectarnos a la Base de datos
    function ConectarBD()
    {
        $this->mysqli = new mysqli("localhost", "docente", "docente", "datos_curriculares");

        if ($this->mysqli->connect_errno) {
            echo "Fallo al conectar a MySQL: (" . $this->mysqli->connect_errno . ") " . $this->mysqli->connect_error;
        }
    }

// Set adjunto
    public function setAdjunto($AdjuntoTAD){
        $this->AdjuntoTAD = $AdjuntoTAD;
    }
//Alta de un nuevo TAD
  public function AltaTad() {
    $this->ConectarBD();
    $insertarTad  = "INSERT INTO tad (CodigoTAD,TituloTAD, AlumnoTAD, FechaLecturaTAD, LoginU, AdjuntoTAD)
                          VALUES ('$this->CodigoTAD', '$this->TituloTAD', '$this->AlumnoTAD', '$this->FechaLecturaTAD','$this->LoginU','$this->AdjuntoTAD')";
	$resultado = $this->mysqli->query($insertarTad) or die(mysqli_error($this->mysqli));
	}

//Consultar una tad
    public function ConsultarTad($CodigoTAD){
        $this->ConectarBD();
        $sql= $this->mysqli->query("SELECT * FROM tad  WHERE CodigoTAD = '$CodigoTAD'");
        return $sql;
    }

//modificar una tad
    public function ModificarTad($CodigoTAD){
        $this->ConectarBD();
        $this->mysqli->query("UPDATE tad SET  TituloTAD='$this->TituloTAD',
                                                  AlumnoTAD='$this->AlumnoTAD',
                                                  FechaLecturaTAD='$this->FechaLecturaTAD',
                                                  AdjuntoTAD='$this->AdjuntoTAD'
                              where CodigoTAD = '$CodigoTAD'") or die (mysqli_error($this->mysqli));
    }

//Listar tad
    public function ListarTad($LoginU){
        $this->ConectarBD();
        $sql= $this->mysqli->query("SELECT * FROM tad WHERE LoginU= '$LoginU' ORDER BY FechaLecturaTAD DESC");
        return $sql;
    }
	
//Listar tad como admin
    public function ListarTadAdmin(){
        $this->ConectarBD();
        $sql= $this->mysqli->query("SELECT * FROM tad ORDER BY FechaLecturaTAD DESC");
        return $sql;
    }

//Eliminar tad
    public function BorrarTad($CodigoTAD){
        $this->ConectarBD();
        // Eliminamos el fichero que tuvier adjunto
        $sql = $this->mysqli->query("SELECT AdjuntoTAD FROM tad WHERE CodigoPD = '$CodigoTAD'");
        if( $sql->num_rows > 0 ){
            $res = mysqli_fetch_array($sql);
            if(!empty($res["AdjuntoTAD"]))
                @unlink('Archivos/tads/' . $res["AdjuntoTAD"]);
        }
        // Eliminamos el registro de BD
        $this->mysqli->query("DELETE FROM tad WHERE CodigoTAD= '$CodigoTAD'")or die(mysqli_error($this->mysqli));
    }

//Buscar tad
    public function BuscarTad($buscar){
        $this->ConectarBD();
        $sql = $this->mysqli->query("SELECT * FROM tad WHERE CodigoTAD LIKE '%$buscar' || CodigoTAD LIKE '%$buscar%' || CodigoTAD LIKE '$buscar%' ||
                                                            TituloTAD LIKE '%$buscar'|| TituloTAD LIKE '%$buscar%' || TituloTAD LIKE '$buscar%' ||
                                                            AlumnoTAD LIKE '%$buscar'|| AlumnoTAD LIKE '%$buscar%' || AlumnoTAD LIKE '$buscar%' ||
                                                            FechaLecturaTAD LIKE '%$buscar'|| FechaLecturaTAD LIKE '%$buscar%' || FechaLecturaTAD LIKE '$buscar%'
                                                            ") or die(mysqli_error($this->mysqli));
        return $sql;
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

   

}

?>
