<?php
session_start();

require_once 'ConnectDB.php';

class Articulo{

    private $CodigoA;
    private $AutoresA;
    private $TituloA;
    private $TituloR;
    private $ISSN;
    private $VolumenR;
    private $PagIniA;
    private $PagFinA;
    private $FechaPublicacionR;
    private $EstadoA;

//constructor de articulo
    public function __construct($CodigoA = NULL, $AutoresA = NULL, $TituloA = NULL, $TituloR = NULL,
                                $ISSN = NULL, $VolumenR = NULL, $PagIniA = NULL, $PagFinA = NULL, $FechaPublicacionR = NULL, $EstadoA = NULL ){
        $this->CodigoA = $CodigoA;
        $this->AutoresA = $AutoresA;
        $this->TituloA = $TituloA;
        $this->TituloR = $TituloR;
        $this->ISSN = $ISSN;
        $this->VolumenR = $VolumenR;
        $this->PagIniA= $PagIniA;
        $this->PagFinA= $PagFinA;
        $this->FechaPublicacionR= $FechaPublicacionR;
        $this->EstadoA= $EstadoA;
    }

//alta de un nuevo articulo
    public function AltaArticulo() {
        $insertarArticulo  = "INSERT INTO articulo (CodigoA,AutoresA, TituloA, TituloR, ISSN,VolumenR, PagIniA,PagFinA,FechaPublicacionR,EstadoA)
                          VALUES ('$this->CodigoA', '$this->AutoresA', '$this->TituloA', '$this->TituloR','$this->ISSN','$this->VolumenR',
                           '$this->PagIniA', '$this->PagFinA','$this->FechaPublicacionR', '$this->EstadoA')";
        $resultado = mysql_query($insertarArticulo) or die(mysql_error());
    }

//consultar un articulo
    public function ConsultarArticulo($CodigoA){
        $sql= mysql_query("SELECT * FROM articulo  WHERE CodigoA = '$CodigoA'");
        return $sql;
    }

//modificar un articulo
    public function ModificarArticulo($CodigoA){
        mysql_query("UPDATE articulo SET AutoresA='$this->AutoresA',TituloA='$this->TituloA',TituloR='$this->TituloR' ,
                      ISSN='$this->ISSN',VolumenR='$this->VolumenR',PagIniA='$this->PagIniA',PagFinA='$this->PagFinA',
                      FechaPublicacionR='$this->FechaPublicacionR',EstadoA='$this->EstadoA' where CodigoA = '$CodigoA'") or die (mysql_error());
    }

//lista de todas los articulos
    public function ListarArticulos($LoginU){
        $sql= mysql_query("SELECT * FROM articulo WHERE LoginU= '$LoginU'");
        return $sql;

    }
}

?>
