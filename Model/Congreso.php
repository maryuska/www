<?php
session_start();



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
//Función para conectarnos a la Base de datos
    function ConectarBD()
    {
        $this->mysqli = new mysqli("localhost", "docente", "docente", "datos_curriculares");

        if ($this->mysqli->connect_errno) {
            echo "Fallo al conectar a MySQL: (" . $this->mysqli->connect_errno . ") " . $this->mysqli->connect_error;
        }
    }

//alta de un nuevo congreso
    public function AltaCongreso() {
        $this->ConectarBD();
        $insertarCongreso  = "INSERT INTO congreso(CodigoC,NombreC, AcronimoC, AnhoC, LugarC)
                          VALUES ('$this->CodigoC', '$this->NombreC', '$this->AcronimoC', '$this->AnhoC','$this->LugarC')";
        $resultado = $this->mysqli->query($insertarCongreso) or die(mysqli_error($this->mysqli));
    }

//consultar un congreso
    public function ConsultarEstancia($CodigoC){
        $this->ConectarBD();
        $sql= $this->mysqli->query("SELECT * FROM congreso  WHERE CodigoC = '$CodigoC'");
        return $sql;
    }

//modificar un congreso
    public function ModificarCongreso($CodigoC){
        $this->ConectarBD();
        $this->mysqli->query("UPDATE congreso SET NombreC='$this->NombreC',AcronimoC='$this->AcronimoC',AnhoC='$this->AnhoC' ,
                      LugarC='$this->LugarC' where CodigoC = '$CodigoC'") or die (mysqli_error($this->mysqli));
    }

//lista de todos los congresos de un usuario
    public function ListarCongresos($LoginU){
        $this->ConectarBD();
        $sql= $this->mysqli->query("SELECT * FROM congreso WHERE LoginU= '$LoginU' ORDER BY AnhoC DESC");
        return $sql;

    }

}

?>
