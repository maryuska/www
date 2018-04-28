<?php
session_start();

require_once 'ConnectDB.php';

class Technicalreport{

    private $CodigoTR;
    private $TituloTR;
    private $DepartamentoTR;
    private $UniversidadTR;
    private $FechaTR;

//constructor de Technicalreport
    public function __construct($CodigoTR = NULL,  $TituloTR = NULL, $DepartamentoTR = NULL, $UniversidadTR = NULL, $FechaTR = NULL ){
        $this->CodigoTR = $CodigoTR;
        $this->TituloTR = $TituloTR;
        $this->DepartamentoTR = $DepartamentoTR;
        $this->UniversidadTR = $UniversidadTR;
        $this->FechaTR = $FechaTR;
    }

//alta de una nueva Technicalreport
    public function AltaTechnicalreport() {
        $insertarTechnicalreport  = "INSERT INTO technicalreport(CodigoTR, TituloTR, DepartamentoTR, UniversidadTR,FechaTR)
                          VALUES ('$this->CodigoTR', '$this->AutoresTR', '$this->TituloTR', '$this->DepartamentoTR','$this->UniversidadTR','$this->FechaTR')";
        $resultado = mysql_query($insertarTechnicalreport) or die(mysql_error());
    }

//consultar una Technicalreport
    public function ConsultarTechnicalreport($CodigoTR){
        $sql= mysql_query("SELECT * FROM technicalreport  WHERE CodigoE = '$CodigoTR'");
        return $sql;
    }

//modificar una Technicalreport
    public function ModificarTechnicalreport($CodigoTR){
        mysql_query("UPDATE technicalreport SET TituloTR='$this->TituloTR',DepartamentoTR='$this->DepartamentoTR' ,
                      UniversidadTR='$this->UniversidadTR',FechaTR='$this->FechaTR' where CodigoE = '$CodigoTR'") or die (mysql_error());
    }

//lista de todas las Technicalreport de un usuario
    public function ListarTechnicalreport($LoginU){
        $sql= mysql_query("SELECT * FROM technicalreport WHERE LoginU= '$LoginU' ORDER BY FechaTR DESC");
        return $sql;

    }

}

?>
