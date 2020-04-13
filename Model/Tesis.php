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
    private $AdjuntoT;

//Constructor de tesis
    public function __construct($CodigoTesis = NULL, $AutorTesis = NULL, $FechaInscripcion = NULL, $FechaLectura = NULL, $CalificacionTesis= NULL, $URLTesis = NULL, $LoginU = NULL, $AdjuntoT = NULL ){
        $this->CodigoTesis = $CodigoTesis;
        $this->AutorTesis = $AutorTesis;
        $this->FechaInscripcion = $FechaInscripcion;
        $this->FechaLectura = $FechaLectura;
        $this->CalificacionTesis = $CalificacionTesis;
        $this->URLTesis = $URLTesis;
        $this->LoginU= $LoginU;
        $this->AdjuntoT= $AdjuntoT;
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
    public function setAdjunto($AdjuntoT){
        $this->AdjuntoT = $AdjuntoT;
    }

//Alta de una nueva tesis
    public function AltaTesis() {
        $this->ConectarBD();
        $insertarTesis  = "INSERT INTO tesis(CodigoTesis,AutorTesis, FechaInscripcion, FechaLectura,CalificacionTesis ,URLTesis, LoginU,AdjuntoT)
                          VALUES ('$this->CodigoTesis',
                                   '$this->AutorTesis', 
                                   '$this->FechaInscripcion',
                                   '$this->FechaLectura',
                                  '$this->CalificacionTesis',
                                  '$this->URLTesis',
                                   '$this->LoginU',
                                   '$this->AdjuntoT')";
        $resultado =  $this->mysqli->query($insertarTesis) or die(mysqli_error($this->mysqli));
    }

//Consultar una tesis
    public function ConsultarTesis($CodigoTesis){
        $this->ConectarBD();
        $sql=  $this->mysqli->query("SELECT * FROM tesis  WHERE CodigoTesis = '$CodigoTesis'");
        return $sql;
    }

//Modificar una tesis
    public function ModificarTesis($CodigoTesis){
        $this->ConectarBD();
        $this->mysqli->query("UPDATE tesis SET AutorTesis='$this->AutorTesis',
                                              FechaInscripcion='$this->FechaInscripcion' ,
                                              FechaLectura='$this->FechaLectura',
                                              URLTesis='$this->URLTesis',
                                              AdjuntoT='$this->AdjuntoT'
                                               where CodigoTesis = '$CodigoTesis'") or die (mysqli_error($this->mysqli));
    }

//Lista de todas las tesis de un usuario
    public function ListarTesis($LoginU){
        $this->ConectarBD();
        $sql=  $this->mysqli->query("SELECT * FROM tesis WHERE LoginU= '$LoginU' ORDER BY FechaInscripcion DESC");
        return $sql;

    }

//Lista tesis admin
    public function ListarTesisAdmin(){
        $this->ConectarBD();
        $sql= $this->mysqli->query("SELECT * FROM tesis ");
        return $sql;
    }

//Eliminar tesis
    public function BorrarTesis($CodigoTesis){
        $this->ConectarBD();
        // Eliminamos el fichero que tuvier adjunto
        $sql = $this->mysqli->query("SELECT AdjuntoT FROM tesis WHERE CodigoTesis = '$CodigoTesis'");
        if( $sql->num_rows > 0 ){
            $res = mysqli_fetch_array($sql);
            if(!empty($res["AdjuntoT"]))
                @unlink('Archivos/tesis/' . $res["AdjuntoT"]);
        }

        // Eliminamos el registro de BD
        $this->mysqli->query("DELETE FROM tesis WHERE CodigoTesis= '$CodigoTesis'")or die(mysqli_error($this->mysqli));
    }
	
//Buscar materia
    public function BuscarTesis($buscar){
        $this->ConectarBD();
        $sql = $this->mysqli->query("SELECT * FROM tesis WHERE CodigoTesis LIKE '%$buscar' || CodigoTesis LIKE '%$buscar%' || CodigoTesis LIKE '$buscar%' ||
                                                            AutorTesis LIKE '%$buscar'|| AutorTesis LIKE '%$buscar%' || AutorTesis LIKE '$buscar%' ||
                                                            FechaInscripcion LIKE '%$buscar'|| FechaInscripcion LIKE '%$buscar%' || FechaInscripcion LIKE '$buscar%' ||
                                                            FechaLectura LIKE '%$buscar'|| FechaLectura LIKE '%$buscar%' || FechaLectura LIKE '$buscar%' ||
                                                            CalificacionTesis LIKE '%$buscar'|| CalificacionTesis LIKE '%$buscar%' || CalificacionTesis LIKE '$buscar%' ||
                                                            URLTesis LIKE '%$buscar'|| URLTesis LIKE '%$buscar%' || URLTesis LIKE '$buscar%'||
                                                            AdjuntoT LIKE '%$buscar'|| AdjuntoT LIKE '%$buscar%' || AdjuntoT LIKE '$buscar%'
                                                            ") or die(mysqli_error($this->mysqli));
        return $sql;
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

}

?>
