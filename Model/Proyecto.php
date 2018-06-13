<?php
session_start();


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
//Función para conectarnos a la Base de datos
    function ConectarBD()
    {
        $this->mysqli = new mysqli("localhost", "docente", "docente", "datos_curriculares");

        if ($this->mysqli->connect_errno) {
            echo "Fallo al conectar a MySQL: (" . $this->mysqli->connect_errno . ") " . $this->mysqli->connect_error;
        }
    }

//alta de un nuevo proyecto
    public function AltaProyecto() {
        $this->ConectarBD();
        $insertarProyecto  = "INSERT INTO proyecto(CodigoProy,TituloProy, EntidadFinanciadora, AcronimoProy, AnhoInicioProy,AnhoFinProy, TipoE)
                          VALUES ('$this->CodigoProy', '$this->TituloProy', '$this->EntidadFinanciadora', '$this->AcronimoProy','$this->AnhoInicioProy','$this->AnhoFinProy',
                           '$this->Importe'')";
        $resultado = $this->mysqli->query($insertarProyecto) or die(mysqli_error( $this->mysqli));
    }

//consultar un proyecto
    public function ConsultarProyecto($CodigoProy){
        $this->ConectarBD();
        $sql= $this->mysqli->query("SELECT * FROM proyecto  WHERE CodigoE = '$CodigoProy'");
        return $sql;
    }

//modificar un proyecto
    public function ModificarProyecto($CodigoProy){
        $this->ConectarBD();
        $this->mysqli->query("UPDATE proyecto SET TituloProy='$this->TituloProy',EntidadFinanciadora='$this->EntidadFinanciadora',AcronimoProy='$this->AcronimoProy' ,
                      AnhoInicioProy='$this->AnhoInicioProy',AnhoFinProy='$this->AnhoFinProy',Importe='$this->Importe' where CodigoProy = '$CodigoProy'") or die (mysqli_error( $this->mysqli));
    }

//lista de todos los proyectos de un usuario
    public function ListarProyectos($LoginU){
        $this->ConectarBD();
        $sql= $this->mysqli->query("SELECT * FROM estancia WHERE LoginU= '$LoginU' ORDER BY AnhoInicioProy DESC");
        return $sql;
    }

}

?>
