<?php
session_start();

require_once 'ConnectDB.php';

class Ponencia{

    private $CodigoP;
    private $TituloP;
    private $CongresoP;
    private $FechaIniCP;
    private $FechaFinCP;
    private $LugarCP;
    private $PaisCP;

//constructor de ponencia
    public function __construct($CodigoP = NULL, $TituloP = NULL, $CongresoP = NULL, $FechaIniCP = NULL, $FechaFinCP = NULL, $LugarCP = NULL, $PaisCP = NULL ){
        $this->CodigoP = $CodigoP;
        $this->TituloP = $TituloP;
        $this->CongresoP = $CongresoP;
        $this->FechaIniCP = $FechaIniCP;
        $this->FechaFinCP = $FechaFinCP;
        $this->LugarCP= $LugarCP;
        $this->PaisCP= $PaisCP;
    }

//alta de una nueva ponencia
    public function AltaPonencia() {
        $insertarPonencia  = "INSERT INTO ponencia(CodigoP, TituloP, CongresoP, FechaIniCP,FechaFinCP, TipoE,LoginU)
                          VALUES ('$this->CodigoP', '$this->TituloP', '$this->CongresoP','$this->FechaIniCP','$this->FechaFinCP',
                           '$this->LugarCP', '$this->PaisCP')";
        $resultado = mysqli_query($insertarPonencia) or die(mysqli_error());
    }

//consultar una ponencia
    public function ConsultarPonencia($CodigoP){
        $sql= mysqli_query("SELECT * FROM ponencia  WHERE CodigoP = '$CodigoP'");
        return $sql;
    }

//modificar una ponencia
    public function ModificarPonencia($CodigoP){
        mysqli_query("UPDATE ponencia SET TituloP='$this->TituloP',CongresoP='$this->CongresoP' ,
                      FechaIniCP='$this->FechaIniCP',FechaFinCP='$this->FechaFinCP',LugarCP='$this->LugarCP',PaisCP='$this->PaisCP' where CodigoP = '$CodigoP'") or die (mysqli_error());
    }


//lista de todas las ponencias de un usuario
    public function ListarPonencias($LoginU){
        $sql= mysqli_query("SELECT * FROM ponencia WHERE LoginU= '$LoginU' ORDER BY FechaFinCP DESC");
        return $sql;

    }

}

?>
