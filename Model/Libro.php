<?php
session_start();


class Libro{

    private $CodigoL;
    private $TituloL;
    private $ISBN;
    private $PagIniL;
    private $PagFinL;
    private $VolumenL;
    private $EditorialL;
    private $FechaPublicacionL;
    private $EditorL;
    private $PaisEdicionL;

//constructor de libro
    public function __construct($CodigoL = NULL, $TituloL = NULL, $ISBN = NULL, $PagIniL = NULL,
                                $PagFinL = NULL, $VolumenL = NULL, $EditorialL = NULL, $FechaPublicacionL = NULL, $EditorL = NULL, $PaisEdicionL = NULL ){
        $this->CodigoL = $CodigoL;
        $this->TituloL = $TituloL;
        $this->ISBN = $ISBN;
        $this->PagIniL = $PagIniL;
        $this->PagFinL = $PagFinL;
        $this->VolumenL= $VolumenL;
        $this->EditorialL= $EditorialL;
        $this->FechaPublicacionL = $FechaPublicacionL;
        $this->EditorL= $EditorL;
        $this->PaisEdicionL= $PaisEdicionL;
    }
//Función para conectarnos a la Base de datos
    function ConectarBD()
    {
        $this->mysqli = new mysqli("localhost", "docente", "docente", "datos_curriculares");

        if ($this->mysqli->connect_errno) {
            echo "Fallo al conectar a MySQL: (" . $this->mysqli->connect_errno . ") " . $this->mysqli->connect_error;
        }
    }

//alta de un nuevo Libro
    public function AltaLibro() {
        $this->ConectarBD();
        $insertarLibro  = "INSERT INTO libro(CodigoL, TituloL, ISBN, PagIniL,PagFinL, VolumenL,EditorialL,FechaPublicacionL, EditorL,PaisEdicionL)
                          VALUES ('$this->CodigoL', '$this->TituloL', '$this->ISBN','$this->PagIniL','$this->PagFinL',
                           '$this->VolumenL', '$this->EditorialL','$this->FechaPublicacionL', '$this->EditorL','$this->PaisEdicionL')";
        $resultado = $this->mysqli->query($insertarLibro) or die(mysqli_error( $this->mysqli));
    }

//consultar un Libro
    public function ConsultarLibro($CodigoE){
        $this->ConectarBD();
        $sql= $this->mysqli->query("SELECT * FROM libro  WHERE CodigoE = '$CodigoE'");
        return $sql;
    }

//modificar un Libro
    public function ModificarLibro($CodigoE){
        $this->ConectarBD();
        $this->mysqli->query("UPDATE libro SET TituloL='$this->TituloL',ISBN='$this->ISBN' ,
                      PagIniL='$this->PagIniL',PagFinL='$this->PagFinL',VolumenL='$this->VolumenL',
                        EditorialL='$this->EditorialL',FechaPublicacionL='$this->FechaPublicacionL',EditorL='$this->EditorL',PaisEdicionL='$this->PaisEdicionL' where CodigoE = '$CodigoE'") or die (mysqli_error( $this->mysqli));
    }

//lista de todos los Libro de un usuario
    public function ListarLibro($LoginU){
        $this->ConectarBD();
        $sql= $this->mysqli->query("SELECT * FROM libro WHERE LoginU= '$LoginU' ORDER BY FechaPublicacionL DESC");
        return $sql;

    }

}

?>
