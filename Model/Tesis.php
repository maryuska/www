<?php
if(!isset($_SESSION))
    session_start();

require_once 'Validacion.php';
class Tesis{

    private $CodigoTesis;
    private $AutorTesis;
    private $FechaInscripcion;
    private $FechaLectura;
    private $CalificacionTesis;
    private $URLTesis;
    private $LoginU;

//constructor de tesis
    public function __construct($CodigoTesis = NULL, $AutorTesis = NULL, $FechaInscripcion = NULL, $FechaLectura = NULL, $CalificacionTesis= NULL, $URLTesis = NULL, $LoginU = NULL ){
        $this->CodigoTesis = $CodigoTesis;
        $this->AutorTesis = $AutorTesis;
        $this->FechaInscripcion = $FechaInscripcion;
        $this->FechaLectura = $FechaLectura;
        $this->CalificacionTesis = $CalificacionTesis;
        $this->URLTesis = $URLTesis;
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

//alta de una nueva tesis
    public function AltaTesis() {
        $this->ConectarBD();
        $insertarTesis  = "INSERT INTO tesis(CodigoTesis,AutorTesis, FechaInscripcion, FechaLectura,CalificacionTesis ,URLTesis, LoginU)
                          VALUES ('$this->CodigoTesis',
                                   '$this->AutorTesis', 
                                   '$this->FechaInscripcion',
                                   '$this->FechaLectura',
                                  '$this->CalificacionTesis',
                                  '$this->URLTesis',
                                   '$this->LoginU')";
        $resultado =  $this->mysqli->query($insertarTesis) or die(mysqli_error($this->mysqli));
    }

//consultar una tesis
    public function ConsultarTesis($CodigoTesis){
        $this->ConectarBD();
        $sql=  $this->mysqli->query("SELECT * FROM tesis  WHERE CodigoTesis = '$CodigoTesis'");
        return $sql;
    }

//modificar una tesis
    public function ModificarTesis($CodigoTesis){
        $this->ConectarBD();
        $this->mysqli->query("UPDATE tesis SET AutorTesis='$this->AutorTesis',
                                              FechaInscripcion='$this->FechaInscripcion' ,
                                              FechaLectura='$this->FechaLectura',
                                              URLTesis='$this->URLTesis'
                                               where CodigoTesis = '$CodigoTesis'") or die (mysqli_error($this->mysqli));
    }

//lista de todas las tesis de un usuario
    public function ListarTesis($LoginU){
        $this->ConectarBD();
        $sql=  $this->mysqli->query("SELECT * FROM tesis WHERE LoginU= '$LoginU' ORDER BY FechaInscripcion DESC");
        return $sql;

    }

    //lista tesis admin
    public function ListarTesisAdmin(){
        $this->ConectarBD();
        $sql= $this->mysqli->query("SELECT * FROM tesis ");
        return $sql;
    }




//eliminar tesis
    public function BorrarTesis($CodigoTesis){
        $this->ConectarBD();
        $this->mysqli->query("DELETE FROM tesis WHERE CodigoTesis= '$CodigoTesis'")or die(mysqli_error($this->mysqli));
    }

    /**
     * Valida si los campos del formulario de una materia son correctos
     *
     * @param array $campos del formulario
     * @return array $errores, contiene los campos fallidos $errores[] = nombre del campo
     */
    public function validarTesis($campos){

        $errores    = array();
        $validar    = new Validacion();

        if(isset($campos["CodigoTesis"]) && !$validar->validarLetrasYNumeros($campos["CodigoTesis"]))
            $errores[]  = "CodigoTesis";

        if(isset($campos["AutorTesis"]) && !$validar->validarSoloLetras($campos["AutorTesis"]))
            $errores[]  = "AutorTesis";

        if(isset($campos["FechaInscripcion"]) && ( !$validar->validarFecha($campos["FechaInscripcion"]) || (date("Y-m-d", strtotime($campos["FechaInscripcion"])) >= date("Y-m-d")) ) )
            $errores[]  = "FechaInscripcion";

        if(isset($campos["FechaLectura"]) && ( !$validar->validarFecha($campos["FechaLectura"]) || (date("Y-m-d", strtotime($campos["FechaLectura"])) >= date("Y-m-d")) ) )
            $errores[]  = "FechaLectura";

        if(isset($campos["CalificacionTesis"]) && !$validar->validarSoloLetras($campos["CalificacionTesis"]))
            $errores[]  = "CalificacionTesis";

        if(isset($campos["URLTesis"]) && !$validar->validarLetrasYNumeros($campos["URLTesis"]))
            $errores[]  = "URLTesis";


        return $errores;
    }

    //buscar materia
    public function BuscarTesis($buscar){
        $this->ConectarBD();
        $sql = $this->mysqli->query("SELECT * FROM tesis WHERE CodigoTesis LIKE '%$buscar' || CodigoTesis LIKE '%$buscar%' || CodigoTesis LIKE '$buscar%' ||
                                                            AutorTesis LIKE '%$buscar'|| AutorTesis LIKE '%$buscar%' || AutorTesis LIKE '$buscar%' ||
                                                            FechaInscripcion LIKE '%$buscar'|| FechaInscripcion LIKE '%$buscar%' || FechaInscripcion LIKE '$buscar%' ||
                                                            FechaLectura LIKE '%$buscar'|| FechaLectura LIKE '%$buscar%' || FechaLectura LIKE '$buscar%' ||
                                                            CalificacionTesis LIKE '%$buscar'|| CalificacionTesis LIKE '%$buscar%' || CalificacionTesis LIKE '$buscar%' ||
                                                            URLTesis LIKE '%$buscar'|| URLTesis LIKE '%$buscar%' || URLTesis LIKE '$buscar%'
                                                            ") or die(mysqli_error($this->mysqli));
        return $sql;
    }



}

?>
