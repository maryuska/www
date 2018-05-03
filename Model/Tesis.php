<?php
session_start();

require_once 'ConnectDB.php';

class Tesis{

    private $CodigoTesis;
    private $AutorTesis;
    private $TutorTesis;
    private $FechaInscripcion;
    private $FechaLectura;
    private $URLTesis;
    private $LoginU;

//constructor de tesis
    public function __construct($CodigoTesis = NULL, $AutorTesis = NULL, $TutorTesis = NULL, $FechaInscripcion = NULL, $FechaLectura = NULL, $URLTesis = NULL, $LoginU = NULL ){
        $this->CodigoTesis = $CodigoTesis;
        $this->AutorTesis = $AutorTesis;
        $this->TutorTesis = $TutorTesis;
        $this->FechaInscripcion = $FechaInscripcion;
        $this->FechaLectura = $FechaLectura;
        $this->URLTesis = $URLTesis;
        $this->LoginU= $LoginU;
    }

//alta de una nueva tesis
    public function AltaTesis() {
        $insertarTesis  = "INSERT INTO tesis(CodigoTesis,AutorTesis, TutorTesis, FechaInscripcion, FechaLectura,URLTesis, LoginU)
                          VALUES ('$this->CodigoTesis', '$this->AutorTesis', '$this->TutorTesis', '$this->FechaInscripcion','$this->FechaLectura'
                          ,'$this->URLTesis', '$this->LoginU')";
        $resultado = mysqli_query($insertarTesis) or die(mysqli_error());
    }

//consultar una tesis
    public function ConsultarTesis($CodigoTesis){
        $sql= mysqli_query("SELECT * FROM tesis  WHERE CodigoE = '$CodigoTesis'");
        return $sql;
    }

//modificar una tesis
    public function ModificarTesis($CodigoTesis){
        mysqli_query("UPDATE tesis SET AutorTesis='$this->AutorTesis',TutorTesis='$this->TutorTesis',FechaInscripcion='$this->FechaInscripcion' ,
                      FechaLectura='$this->FechaLectura',URLTesis='$this->URLTesis' where CodigoTesis = '$CodigoTesis'") or die (mysqli_error());
    }

//lista de todas las tesis de un usuario
    public function ListarTesis($LoginU){
        $sql= mysqli_query("SELECT * FROM tesis WHERE LoginU= '$LoginU' ORDER BY FechaInscripcion DESC");
        return $sql;

    }

}

?>
