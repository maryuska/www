<?php
session_start();

class Articulo{

    private $CodigoA;
    private $TituloA;
    private $TituloR;
    private $ISSN;
    private $VolumenR;
    private $PagIniA;
    private $PagFinA;
    private $FechaPublicacionR;
    private $EstadoA;

//constructor de articulo
    public function __construct($CodigoA = NULL,  $TituloA = NULL, $TituloR = NULL,
                                $ISSN = NULL, $VolumenR = NULL, $PagIniA = NULL, $PagFinA = NULL, $FechaPublicacionR = NULL, $EstadoA = NULL ){
        $this->CodigoA = $CodigoA;
        $this->TituloA = $TituloA;
        $this->TituloR = $TituloR;
        $this->ISSN = $ISSN;
        $this->VolumenR = $VolumenR;
        $this->PagIniA= $PagIniA;
        $this->PagFinA= $PagFinA;
        $this->FechaPublicacionR= $FechaPublicacionR;
        $this->EstadoA= $EstadoA;
    }
//Función para conectarnos a la Base de datos
    function ConectarBD()
    {
        $this->mysqli = new mysqli("localhost", "docente", "docente", "datos_curriculares");

        if ($this->mysqli->connect_errno) {
            echo "Fallo al conectar a MySQL: (" . $this->mysqli->connect_errno . ") " . $this->mysqli->connect_error;
        }
    }

//alta de un nuevo articulo
    public function AltaArticulo() {
        $this->ConectarBD();
        $insertarArticulo  = "INSERT INTO articulo (CodigoA, TituloA, TituloR, ISSN,VolumenR, PagIniA,PagFinA,FechaPublicacionR,EstadoA)
                          VALUES ('$this->CodigoA',  '$this->TituloA', '$this->TituloR','$this->ISSN','$this->VolumenR',
                           '$this->PagIniA', '$this->PagFinA','$this->FechaPublicacionR', '$this->EstadoA')";
        $resultado = $this->mysqli->query($insertarArticulo) or die(mysqli_error($this->mysqli));
    }

//consultar un articulo
    public function ConsultarArticulo($CodigoA){
        $this->ConectarBD();
        $sql= $this->mysqli->query("SELECT * FROM articulo  WHERE CodigoA = '$CodigoA'");
        return $sql;
    }

//modificar un articulo
    public function ModificarArticulo($CodigoA){
        $this->ConectarBD();
        $this->mysqli->query("UPDATE articulo SET TituloA='$this->TituloA',TituloR='$this->TituloR' ,
                      ISSN='$this->ISSN',VolumenR='$this->VolumenR',PagIniA='$this->PagIniA',PagFinA='$this->PagFinA',
                      FechaPublicacionR='$this->FechaPublicacionR',EstadoA='$this->EstadoA' where CodigoA = '$CodigoA'") or die (mysqli_error($this->mysqli));
    }

//lista de todas los articulos
    public function ListarArticulos($LoginU){
        $this->ConectarBD();
        $sql= $this->mysqli->query("SELECT * FROM articulo WHERE LoginU= '$LoginU'");
        return $sql;

    }
}

?>
