<?php
session_start();

require_once 'ConnectDB.php';

class Ponencia{

    private $CodigoP;
    private $AutoresP;
    private $TituloP;
    private $CongresoP;
    private $FechaIniCP;
    private $FechaFinCP;
    private $LugarCP;
    private $PaisCP;

//constructor de ponencia
    public function __construct($CodigoP = NULL, $AutoresP = NULL, $TituloP = NULL, $CongresoP = NULL, $FechaIniCP = NULL, $FechaFinCP = NULL, $LugarCP = NULL, $PaisCP = NULL ){
        $this->CodigoP = $CodigoP;
        $this->AutoresP = $AutoresP;
        $this->TituloP = $TituloP;
        $this->CongresoP = $CongresoP;
        $this->FechaIniCP = $FechaIniCP;
        $this->FechaFinCP = $FechaFinCP;
        $this->LugarCP= $LugarCP;
        $this->PaisCP= $PaisCP;
    }

//alta de una nueva ponencia
    public function AltaPonencia() {
        $insertarPonencia  = "INSERT INTO ponencia(CodigoP,AutoresP, TituloP, CongresoP, FechaIniCP,FechaFinCP, TipoE,LoginU)
                          VALUES ('$this->CodigoP', '$this->AutoresP', '$this->TituloP', '$this->CongresoP','$this->FechaIniCP','$this->FechaFinCP',
                           '$this->LugarCP', '$this->PaisCP')";
        $resultado = mysql_query($insertarPonencia) or die(mysql_error());
    }

//consultar una ponencia
    public function ConsultarPonencia($CodigoP){
        $sql= mysql_query("SELECT * FROM ponencia  WHERE CodigoP = '$CodigoP'");
        return $sql;
    }

//modificar una ponencia
    public function ModificarPonencia($CodigoP){
        mysql_query("UPDATE ponencia SET AutoresP='$this->AutoresP',TituloP='$this->TituloP',CongresoP='$this->CongresoP' ,
                      FechaIniCP='$this->FechaIniCP',FechaFinCP='$this->FechaFinCP',LugarCP='$this->LugarCP',PaisCP='$this->PaisCP' where CodigoP = '$CodigoP'") or die (mysql_error());
    }


//lista de todas las ponencias de un usuario
    public function ListarPonencias($LoginU){
        $sql= mysql_query("SELECT * FROM ponencia WHERE LoginU= '$LoginU' ORDER BY FechaFinCP DESC");
        return $sql;

    }

}

?>
