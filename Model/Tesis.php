<?php
session_start();


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
        $insertarTesis  = "INSERT INTO tesis(CodigoTesis,AutorTesis, TutorTesis, FechaInscripcion, FechaLectura,URLTesis, LoginU)
                          VALUES ('$this->CodigoTesis', '$this->AutorTesis', '$this->TutorTesis', '$this->FechaInscripcion','$this->FechaLectura'
                          ,'$this->URLTesis', '$this->LoginU')";
        $resultado =  $this->mysqli->query($insertarTesis) or die(mysqli_error($this->mysqli));
    }

//consultar una tesis
    public function ConsultarTesis($CodigoTesis){
        $this->ConectarBD();
        $sql=  $this->mysqli->query("SELECT * FROM tesis  WHERE CodigoE = '$CodigoTesis'");
        return $sql;
    }

//modificar una tesis
    public function ModificarTesis($CodigoTesis){
        $this->ConectarBD();
        $this->mysqli->query("UPDATE tesis SET AutorTesis='$this->AutorTesis',TutorTesis='$this->TutorTesis',FechaInscripcion='$this->FechaInscripcion' ,
                      FechaLectura='$this->FechaLectura',URLTesis='$this->URLTesis' where CodigoTesis = '$CodigoTesis'") or die (mysqli_error($this->mysqli));
    }

//lista de todas las tesis de un usuario
    public function ListarTesis($LoginU){
        $this->ConectarBD();
        $sql=  $this->mysqli->query("SELECT * FROM tesis WHERE LoginU= '$LoginU' ORDER BY FechaInscripcion DESC");
        return $sql;

    }

}

?>
