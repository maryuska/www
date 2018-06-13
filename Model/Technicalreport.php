<?php
session_start();


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
    function ConectarBD()
    {
        $this->mysqli = new mysqli("localhost", "docente", "docente", "datos_curriculares");

        if ($this->mysqli->connect_errno) {
            echo "Fallo al conectar a MySQL: (" . $this->mysqli->connect_errno . ") " . $this->mysqli->connect_error;
        }
    }
//alta de una nueva Technicalreport
    public function AltaTechnicalreport() {
        $this->ConectarBD();
        $insertarTechnicalreport  = "INSERT INTO technicalreport(CodigoTR, TituloTR, DepartamentoTR, UniversidadTR,FechaTR)
                          VALUES ('$this->CodigoTR', '$this->AutoresTR', '$this->TituloTR', '$this->DepartamentoTR','$this->UniversidadTR','$this->FechaTR')";
        $resultado = $this->mysqli->query($insertarTechnicalreport) or die(mysqli_error($this->mysqli));
    }

//consultar una Technicalreport
    public function ConsultarTechnicalreport($CodigoTR){
        $this->ConectarBD();
        $sql= $this->mysqli->query("SELECT * FROM technicalreport  WHERE CodigoE = '$CodigoTR'");
        return $sql;
    }

//modificar una Technicalreport
    public function ModificarTechnicalreport($CodigoTR){
        $this->ConectarBD();
        $this->mysqli->query("UPDATE technicalreport SET TituloTR='$this->TituloTR',DepartamentoTR='$this->DepartamentoTR' ,
                      UniversidadTR='$this->UniversidadTR',FechaTR='$this->FechaTR' where CodigoE = '$CodigoTR'") or die (mysqli_error($this->mysqli));
    }

//lista de todas las Technicalreport de un usuario
    public function ListarTechnicalreport($LoginU){
        $this->ConectarBD();
        $sql= $this->mysqli->query("SELECT * FROM technicalreport WHERE LoginU= '$LoginU' ORDER BY FechaTR DESC");
        return $sql;

    }

}

?>
