<?php
session_start();

require_once 'ConnectDB.php';

class Libro{

    private $CodigoL;
    private $AutoresL;
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
    public function __construct($CodigoL = NULL, $AutoresL = NULL, $TituloL = NULL, $ISBN = NULL, $PagIniL = NULL,
                                $PagFinL = NULL, $VolumenL = NULL, $EditorialL = NULL, $FechaPublicacionL = NULL, $EditorL = NULL, $PaisEdicionL = NULL ){
        $this->CodigoL = $CodigoL;
        $this->AutoresL = $AutoresL;
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

//alta de un nuevo Libro
    public function AltaLibro() {
        $insertarLibro  = "INSERT INTO libro(CodigoL,AutoresL, TituloL, ISBN, PagIniL,PagFinL, VolumenL,EditorialL,FechaPublicacionL, EditorL,PaisEdicionL)
                          VALUES ('$this->CodigoL', '$this->AutoresL', '$this->TituloL', '$this->ISBN','$this->PagIniL','$this->PagFinL',
                           '$this->VolumenL', '$this->EditorialL','$this->FechaPublicacionL', '$this->EditorL','$this->PaisEdicionL')";
        $resultado = mysql_query($insertarLibro) or die(mysql_error());
    }

//consultar un Libro
    public function ConsultarLibro($CodigoE){
        $sql= mysql_query("SELECT * FROM libro  WHERE CodigoE = '$CodigoE'");
        return $sql;
    }

//modificar un Libro
    public function ModificarLibro($CodigoE){
        mysql_query("UPDATE libro SET AutoresL='$this->AutoresL',TituloL='$this->TituloL',ISBN='$this->ISBN' ,
                      PagIniL='$this->PagIniL',PagFinL='$this->PagFinL',VolumenL='$this->VolumenL',
                        EditorialL='$this->EditorialL',FechaPublicacionL='$this->FechaPublicacionL',EditorL='$this->EditorL',PaisEdicionL='$this->PaisEdicionL' where CodigoE = '$CodigoE'") or die (mysql_error());
    }

//lista de todos los Libro de un usuario
    public function ListarLibro($LoginU){
        $sql= mysql_query("SELECT * FROM libro WHERE LoginU= '$LoginU' ORDER BY FechaPublicacionL DESC");
        return $sql;

    }

}

?>
