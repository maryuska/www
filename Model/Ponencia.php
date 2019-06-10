<?php
session_start();


class Ponencia{

    private $CodigoP;
    private $TituloP;
    private $CongresoP;
    private $FechaIniCP;
    private $FechaFinCP;
    private $LugarCP;
    private $PaisCP;

//Constructor de ponencia
    public function __construct($CodigoP = NULL, $TituloP = NULL, $CongresoP = NULL, $FechaIniCP = NULL, $FechaFinCP = NULL, $LugarCP = NULL, $PaisCP = NULL ){
        $this->CodigoP = $CodigoP;
        $this->TituloP = $TituloP;
        $this->CongresoP = $CongresoP;
        $this->FechaIniCP = $FechaIniCP;
        $this->FechaFinCP = $FechaFinCP;
        $this->LugarCP= $LugarCP;
        $this->PaisCP= $PaisCP;
    }
	
//Función para conectarnos a la Base de datos
    function ConectarBD()
    {
        $this->mysqli = new mysqli("localhost", "docente", "docente", "datos_curriculares");

        if ($this->mysqli->connect_errno) {
            echo "Fallo al conectar a MySQL: (" . $this->mysqli->connect_errno . ") " . $this->mysqli->connect_error;
        }
    }
	
//Alta de una nueva ponencia
    public function AltaPonencia() {
        $this->ConectarBD();
        $insertarPonencia  = "INSERT INTO ponencia(CodigoP, TituloP, CongresoP, FechaIniCP,FechaFinCP, TipoE,LoginU)
                          VALUES ('$this->CodigoP', '$this->TituloP', '$this->CongresoP','$this->FechaIniCP','$this->FechaFinCP',
                           '$this->LugarCP', '$this->PaisCP')";
        $resultado =  $this->mysqli->query($insertarPonencia) or die(mysqli_error($this->mysqli));
    }

//Consultar una ponencia
    public function ConsultarPonencia($CodigoP){
        $this->ConectarBD();
        $sql=  $this->mysqli->query("SELECT * FROM ponencia  WHERE CodigoP = '$CodigoP'");
        return $sql;
    }

//Modificar una ponencia
    public function ModificarPonencia($CodigoP){
        $this->ConectarBD();
        $this->mysqli->query("UPDATE ponencia SET TituloP='$this->TituloP',CongresoP='$this->CongresoP' ,
                      FechaIniCP='$this->FechaIniCP',FechaFinCP='$this->FechaFinCP',LugarCP='$this->LugarCP',PaisCP='$this->PaisCP' where CodigoP = '$CodigoP'") or die (mysqli_error($this->mysqli));
    }

//Lista de todas las ponencias de un usuario
    public function ListarPonencias($LoginU){
        $this->ConectarBD();
        $sql=  $this->mysqli->query("SELECT * FROM ponencia WHERE LoginU= '$LoginU' ORDER BY FechaFinCP DESC");
        return $sql;

    }

}

?>
