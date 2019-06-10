<?php
if(!isset($_SESSION))
    session_start();
require_once 'Validacion.php';

class Estancias{

  private $CodigoE;
  private $CentroE;
  private $UniversidadE;
  private $PaisE;
  private $FechaInicioE;
  private $FechaFinE;
  private $TipoE;
  private $LoginU;

//Constructor de estancia
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

//Función para conectarnos a la Base de datos
    function ConectarBD()
    {
        $this->mysqli = new mysqli("localhost", "docente", "docente", "datos_curriculares");

        if ($this->mysqli->connect_errno) {
            echo "Fallo al conectar a MySQL: (" . $this->mysqli->connect_errno . ") " . $this->mysqli->connect_error;
        }
    }

//Alta de una nueva estancia
  public function AltaEstancia() {
      $this->ConectarBD();
    $insertarEstancia  = "INSERT INTO estancia(CodigoE,CentroE, UniversidadE, PaisE, FechaInicioE,FechaFinE, TipoE,LoginU)
                          VALUES ('$this->CodigoE', '$this->CentroE', '$this->UniversidadE', '$this->PaisE','$this->FechaInicioE','$this->FechaFinE',
                           '$this->TipoE', '$this->LoginU')";
	$resultado = $this->mysqli->query($insertarEstancia) or die(mysqli_error($this->mysqli));
	}

//Consultar una estancia
    public function ConsultarEstancia($CodigoE){
        $this->ConectarBD();
        $sql= $this->mysqli->query("SELECT * FROM estancia  WHERE CodigoE = '$CodigoE'");
        return $sql;
    }

//Modificar una estancia
    public function ModificarEstancia($CodigoE){
        $this->ConectarBD();
        $this->mysqli->query("UPDATE estancia SET   CentroE='$this->CentroE',
                                                    UniversidadE='$this->UniversidadE',
                                                    PaisE='$this->PaisE' ,
                                                    FechaInicioE='$this->FechaInicioE',
                                                    FechaFinE='$this->FechaFinE',
                                                    TipoE='$this->TipoE'
                                                    where CodigoE = '$CodigoE'") or die (mysqli_error($this->mysqli));
    }


//Listar estancias de usuario
//Lista de todas las estancias de un usuario
    public function ListarEstancias($LoginU){
        $this->ConectarBD();
        $sql= $this->mysqli->query("SELECT * FROM estancia WHERE LoginU= '$LoginU' ORDER BY FechaFinE DESC");
        return $sql;

    }

//Lista de todas las estancias de invertigacion
    public function ListarEstanciasInvertigacion($LoginU){
        $this->ConectarBD();
        $sql= $this->mysqli->query("SELECT * FROM estancia WHERE LoginU= '$LoginU' AND TipoE = 'Investigacion'");
        return $sql;
    }

//Lista de todas las estancias de doctorado
    public function ListarEstanciasDoctorado($LoginU){
        $this->ConectarBD();
        $sql= $this->mysqli->query("SELECT * FROM estancia WHERE LoginU= '$LoginU' AND TipoE = 'Doctorado'");
        return $sql;
    }

//Lista de todas las estancias de invitado
    public function ListarEstanciasInvitado($LoginU){
        $this->ConectarBD();
        $sql= $this->mysqli->query("SELECT * FROM estancia WHERE LoginU= '$LoginU' AND TipoE = 'Invitado'");
        return $sql;
    }

//listar estancias como admin
//Lista de todas las estancias
    public function ListarEstanciasAdmin(){
        $this->ConectarBD();
        $sql= $this->mysqli->query("SELECT * FROM estancia ORDER BY FechaFinE DESC");
        return $sql;

    }

//Lista de todas las estancias de invertigacion como admin
    public function ListarEstanciasInvertigacionAdmin(){
        $this->ConectarBD();
        $sql= $this->mysqli->query("SELECT * FROM estancia WHERE TipoE = 'Investigacion'");
        return $sql;
    }

//Lista de todas las estancias de doctorado como admin
    public function ListarEstanciasDoctoradoAdmin(){
        $this->ConectarBD();
        $sql= $this->mysqli->query("SELECT * FROM estancia WHERE TipoE = 'Doctorado'");
        return $sql;
    }

//Lista de todas las estancias de invitado como admin
    public function ListarEstanciasInvitadoAdmin(){
        $this->ConectarBD();
        $sql= $this->mysqli->query("SELECT * FROM estancia WHERE TipoE = 'Invitado'");
        return $sql;
    }

//Buscar estancia
    public function BuscarEstancia($buscar){
        $this->ConectarBD();
        $sql = $this->mysqli->query("SELECT * FROM estancia WHERE CodigoE LIKE '%$buscar' || CodigoE LIKE '%$buscar%' || CodigoE LIKE '$buscar%' ||
                                                            CentroE LIKE '%$buscar'|| CentroE LIKE '%$buscar%' || CentroE LIKE '$buscar%' ||
                                                            UniversidadE LIKE '%$buscar'|| UniversidadE LIKE '%$buscar%' || UniversidadE LIKE '$buscar%' ||
                                                            PaisE LIKE '%$buscar'|| PaisE LIKE '%$buscar%' || PaisE LIKE '$buscar%' ||
                                                            FechaInicioE LIKE '%$buscar'|| FechaInicioE LIKE '%$buscar%' || FechaInicioE LIKE '$buscar%' ||
                                                            FechaFinE LIKE '%$buscar'|| FechaFinE LIKE '%$buscar%' || FechaFinE LIKE '$buscar%' ||
                                                            TipoE LIKE '%$buscar'|| TipoE LIKE '%$buscar%' || TipoE LIKE '$buscar%' ||
                                                            LoginU LIKE '%$buscar'|| LoginU LIKE '%$buscar%' || LoginU LIKE '$buscar%' 
                                                            ") or die(mysqli_error($this->mysqli));
        return $sql;
    }

//Eliminar estancia
    public function BorrarEstancia($CodigoE){
        $this->ConectarBD();
        $this->mysqli->query("DELETE FROM estancia WHERE CodigoE= '$CodigoE'")or die(mysqli_error($this->mysqli));
    }

    /**
     * Valida si los campos del formulario de una materia son correctos
     *
     * @param array $campos del formulario
     * @return array $errores, contiene los campos fallidos $errores[] = nombre del campo
     */
    public function validarEstancia($campos){

        $errores    = array();
        $validar    = new Validacion();

        // Codigo estancia
        if(isset($campos["CodigoE"]) && !$validar->validarSoloNumeros($campos["CodigoE"]))
            $errores[]  = "CodigoE";

        // Centro estancia
        if(isset($campos["CentroE"]) && !$validar->validarSoloLetras($campos["CentroE"]))
            $errores[]  = "CentroE";

        // Universidad estancia
        if(isset($campos["UniversidadE"]) && !$validar->validarLetrasYNumeros($campos["UniversidadE"]))
            $errores[]  = "UniversidadE";

        // Pais estancia
        if(isset($campos["PaisE"]) && !$validar->validarSoloLetras($campos["PaisE"]))
            $errores[]  = "PaisE";

        // Fecha inicio estancia
        if(isset($campos["FechaInicioE"]) && !$validar->validarFecha($campos["FechaInicioE"])|| (date("Y-m-d", strtotime($campos["FechaInicioE"])) >= date("Y-m-d")))
            $errores[]  = "FechaInicioE";

        // Fecha fin estancia
        if(isset($campos["FechaFinE"]) && !$validar->validarFecha($campos["FechaFinE"])|| (date("Y-m-d", strtotime($campos["FechaFinE"])) >= date("Y-m-d")))
            $errores[]  = "FechaFinE";

        // Tipo estancia
        if(isset($campos["TipoE"]) && !$validar->validarSoloLetras($campos["TipoE"]))
            $errores[]  = "TipoE";


        return $errores;
    }

}

?>
