<?php
session_start();

require_once 'ConnectDB.php';

class Congreso{

    private $CodigoC;
    private $NombreC;
    private $AcronimoC;
    private $AnhoC;
    private $LugarC;

//constructor de congreso
    public function __construct($CodigoC = NULL, $NombreC = NULL, $AcronimoC = NULL, $AnhoC = NULL, $LugarC = NULL){
        $this->CodigoC = $CodigoC;
        $this->NombreC = $NombreC;
        $this->AcronimoC = $AcronimoC;
        $this->AnhoC = $AnhoC;
        $this->LugarC = $LugarC;
    }

//alta de un nuevo congreso
    public function AltaCongreso() {
        $insertarCongreso  = "INSERT INTO congreso(CodigoC,NombreC, AcronimoC, AnhoC, LugarC)
                          VALUES ('$this->CodigoC', '$this->NombreC', '$this->AcronimoC', '$this->AnhoC','$this->LugarC')";
        $resultado = mysql_query($insertarCongreso) or die(mysql_error());
    }

//consultar un congreso
    public function ConsultarEstancia($CodigoC){
        $sql= mysql_query("SELECT * FROM congreso  WHERE CodigoC = '$CodigoC'");
        return $sql;
    }

//modificar un congreso
    public function ModificarCongreso($CodigoC){
        mysql_query("UPDATE congreso SET NombreC='$this->NombreC',AcronimoC='$this->AcronimoC',AnhoC='$this->AnhoC' ,
                      LugarC='$this->LugarC' where CodigoC = '$CodigoC'") or die (mysql_error());
    }

//lista de todos los congresos de un usuario
    public function ListarCongresos($LoginU){
        $sql= mysql_query("SELECT * FROM congreso WHERE LoginU= '$LoginU' ORDER BY AnhoC DESC");
        return $sql;

    }

}

?>
