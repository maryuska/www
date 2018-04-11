<?php
session_start();

require_once 'ConnectDB.php';

class Proyecto{

    private $CodigoProy;
    private $TituloProy;
    private $EntidadFinanciadora;
    private $AcronimoProy;
    private $AnhoInicioProy;
    private $AnhoFinProy;
    private $Importe;

//constructor de proyecto
    public function __construct($CodigoProy = NULL, $TituloProy = NULL, $EntidadFinanciadora = NULL, $AcronimoProy = NULL, $AnhoInicioProy = NULL, $AnhoFinProy = NULL, $Importe = NULL ){
        $this->CodigoE = $CodigoProy;
        $this->TituloProy = $TituloProy;
        $this->EntidadFinanciadora = $EntidadFinanciadora;
        $this->AcronimoProy = $AcronimoProy;
        $this->AnhoInicioProy = $AnhoInicioProy;
        $this->AnhoFinProy = $AnhoFinProy;
        $this->Importe= $Importe;
    }

//alta de un nuevo proyecto
    public function AltaProyecto() {
        $insertarProyecto  = "INSERT INTO proyecto(CodigoProy,TituloProy, EntidadFinanciadora, AcronimoProy, AnhoInicioProy,AnhoFinProy, TipoE)
                          VALUES ('$this->CodigoProy', '$this->TituloProy', '$this->EntidadFinanciadora', '$this->AcronimoProy','$this->AnhoInicioProy','$this->AnhoFinProy',
                           '$this->Importe'')";
        $resultado = mysql_query($insertarProyecto) or die(mysql_error());
    }

//consultar un proyecto
    public function ConsultarProyecto($CodigoProy){
        $sql= mysql_query("SELECT * FROM proyecto  WHERE CodigoE = '$CodigoProy'");
        return $sql;
    }

//modificar un proyecto
    public function ModificarProyecto($CodigoProy){
        mysql_query("UPDATE proyecto SET TituloProy='$this->TituloProy',EntidadFinanciadora='$this->EntidadFinanciadora',AcronimoProy='$this->AcronimoProy' ,
                      AnhoInicioProy='$this->AnhoInicioProy',AnhoFinProy='$this->AnhoFinProy',Importe='$this->Importe' where CodigoProy = '$CodigoProy'") or die (mysql_error());
    }

//lista de todos los proyectos de un usuario
    public function ListarProyectos($LoginU){
        $sql= mysql_query("SELECT * FROM estancia WHERE LoginU= '$LoginU' ORDER BY AnhoInicioProy DESC");
        return $sql;
    }

}

?>
