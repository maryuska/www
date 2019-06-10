<?php
if(!isset($_SESSION))
    session_start();

require_once 'Validacion.php';

class Congreso{

    private $CodigoC;
    private $NombreC;
    private $AcronimoC;
    private $AnhoC;
    private $LugarC;

//Constructor de congreso
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

//Alta de un nuevo congreso
    public function AltaCongreso() {
        $this->ConectarBD();
        $insertarCongreso  = "INSERT INTO congreso(CodigoC,NombreC, AcronimoC, AnhoC, LugarC)
                          VALUES ('$this->CodigoC', '$this->NombreC', '$this->AcronimoC', '$this->AnhoC','$this->LugarC')";
        $resultado = $this->mysqli->query($insertarCongreso) or die(mysqli_error($this->mysqli));
    }

//Alta de un usuario congreso
    public function Participa($Login,$CodigoC,$TipoParticipacionC){
        $this->ConectarBD();
        $participar = "INSERT INTO docente_congreso (CodigoC,LoginU,TipoParticipacionC)
			VALUES ('$CodigoC','$Login','$TipoParticipacionC')";
        $resultado = $this->mysqli->query($participar) or die(mysqli_error($this->mysqli));
    }

//Consultar un congreso
    public function ConsultarCongreso($CodigoC){
        $this->ConectarBD();
        $sql= $this->mysqli->query("SELECT * FROM congreso c, docente_congreso dc WHERE c.CodigoC=dc.CodigoC AND c.CodigoC = '$CodigoC'");
        return $sql;
    }

//Modificar un congreso
    public function ModificarCongreso($CodigoC,$TipoParticipacionC){
        $this->ConectarBD();
        $this->mysqli->query("UPDATE congreso c, docente_congreso dc SET c.nombreC='$this->NombreC',
                                                  c.AcronimoC='$this->AcronimoC',
                                                  c.AnhoC='$this->AnhoC' ,
                                                  c.LugarC='$this->LugarC',     
                                                  dc.TipoParticipacionC='$TipoParticipacionC'                                     
                      where c.CodigoC = '$CodigoC' AND c.CodigoC=dc.CodigoC") or die (mysqli_error($this->mysqli));
    }

//Lista de todos los congresos del usuario
    public function ListarCongresos($Login){
        $this->ConectarBD();
        $sql= $this->mysqli->query("SELECT * FROM congreso c, docente_congreso dc WHERE c.CodigoC = dc.CodigoC  AND dc.LoginU = '$Login'  ORDER BY AnhoC DESC");
        return $sql;

    }
	
//Lista de todos los congresos MCO
    public function ListarCongresosMCO($Login){
        $this->ConectarBD();
        $sql= $this->mysqli->query("SELECT * FROM congreso c, docente_congreso dc WHERE c.CodigoC = dc.CodigoC  AND dc.LoginU = '$Login' AND dc.TipoParticipacionC = 'MCO'ORDER BY AnhoC DESC");

        return $sql;
    }
	
//Lista de todos los congresos MCC
    public function ListarCongresosMCC($Login){
        $this->ConectarBD();
        $sql= $this->mysqli->query("SELECT * FROM congreso c, docente_congreso dc WHERE c.CodigoC = dc.CodigoC  AND dc.LoginU = '$Login' AND dc.TipoParticipacionC = 'MCC'ORDER BY AnhoC DESC");

        return $sql;
    }

//Lista de todos los congresos R
    public function ListarCongresosR($Login){
        $this->ConectarBD();
        $sql= $this->mysqli->query("SELECT * FROM congreso c, docente_congreso dc WHERE c.CodigoC = dc.CodigoC  AND dc.LoginU = '$Login' AND dc.TipoParticipacionC = 'R'ORDER BY AnhoC DESC");

        return $sql;
    }

//Lista de todos los congresos c
    public function ListarCongresosC($Login){
        $this->ConectarBD();
        $sql= $this->mysqli->query("SELECT * FROM congreso c, docente_congreso dc WHERE c.CodigoC = dc.CodigoC  AND dc.LoginU = '$Login' AND dc.TipoParticipacionC = 'C'ORDER BY AnhoC DESC");

        return $sql;
    }


//Lista de todos los congresos PCC
    public function ListarCongresosPCC($Login){
        $this->ConectarBD();
        $sql= $this->mysqli->query("SELECT * FROM congreso c, docente_congreso dc WHERE c.CodigoC = dc.CodigoC  AND dc.LoginU = '$Login' AND dc.TipoParticipacionC = 'PCC'ORDER BY AnhoC DESC");

        return $sql;
    }

//Lista de todos los congresos PCO
    public function ListarCongresosPCO($Login){
        $this->ConectarBD();
        $sql= $this->mysqli->query("SELECT * FROM congreso c, docente_congreso dc WHERE c.CodigoC = dc.CodigoC  AND dc.LoginU = '$Login' AND dc.TipoParticipacionC = 'PCO'ORDER BY AnhoC DESC");

        return $sql;
    }

//Listas de congresos con admin
//Lista de todos los congresos
    public function ListarCongresosAdmin(){
        $this->ConectarBD();
        $sql= $this->mysqli->query("SELECT * FROM congreso c, docente_congreso dc WHERE c.CodigoC = dc.CodigoC   ORDER BY AnhoC DESC");
        return $sql;

    }
//Lista de todos los congresos MCO
    public function ListarCongresosMCOAdmin(){
        $this->ConectarBD();
        $sql= $this->mysqli->query("SELECT * FROM congreso c, docente_congreso dc WHERE c.CodigoC = dc.CodigoC  AND dc.TipoParticipacionC = 'MCO'ORDER BY AnhoC DESC");

        return $sql;
    }

//Lista de todos los congresos MCO
    public function ListarCongresosMCCAdmin(){
        $this->ConectarBD();
        $sql= $this->mysqli->query("SELECT * FROM congreso c, docente_congreso dc WHERE c.CodigoC = dc.CodigoC  AND dc.TipoParticipacionC = 'MCC'ORDER BY AnhoC DESC");

        return $sql;
    }
//Lista de todos los congresos c
    public function ListarCongresosCAdmin(){
        $this->ConectarBD();
        $sql= $this->mysqli->query("SELECT * FROM congreso c, docente_congreso dc WHERE c.CodigoC = dc.CodigoC  AND dc.TipoParticipacionC = 'C'ORDER BY AnhoC DESC");

        return $sql;
    }


//Lista de todos los congresos R
    public function ListarCongresosRAdmin(){
        $this->ConectarBD();
        $sql= $this->mysqli->query("SELECT * FROM congreso c, docente_congreso dc WHERE c.CodigoC = dc.CodigoC  AND dc.TipoParticipacionC = 'R'ORDER BY AnhoC DESC");

        return $sql;
    }

//Lista de todos los congresos PCO
    public function ListarCongresosPCOAdmin(){
        $this->ConectarBD();
        $sql= $this->mysqli->query("SELECT * FROM congreso c, docente_congreso dc WHERE c.CodigoC = dc.CodigoC  AND dc.TipoParticipacionC = 'PCO'ORDER BY AnhoC DESC");

        return $sql;
    }

//Lista de todos los congresos PCC
    public function ListarCongresosPCCAdmin(){
        $this->ConectarBD();
        $sql= $this->mysqli->query("SELECT * FROM congreso c, docente_congreso dc WHERE c.CodigoC = dc.CodigoC  AND dc.TipoParticipacionC = 'PCC'ORDER BY AnhoC DESC");

        return $sql;
    }


//Eliminar un congreso
    public function BorrarCongreso($CodigoC){
        $this->ConectarBD();
        $this->mysqli->query("DELETE FROM congreso WHERE CodigoC = '$CodigoC'")or die(mysqli_error($this->mysqli));
    }

//Eliminar`participar en un congreso
    public function BorrarParticipa($LoginU,$CodigoC){
        $this->ConectarBD();
        $this->mysqli->query("DELETE FROM docente_congreso WHERE CodigoC = '$CodigoC' AND LoginU='$LoginU'")or die(mysqli_error($this->mysqli));
    }

//Buscar usuario
    public function BuscarCongreso($buscar){
        $this->ConectarBD();
        $sql = $this->mysqli->query("SELECT *
                                                            FROM congreso c
                                                            WHERE
                                                            c.CodigoC LIKE '%$buscar' || c.CodigoC LIKE '%$buscar%' || c.CodigoC LIKE '$buscar%' ||
                                                            c.NombreC LIKE '%$buscar'|| c.NombreC LIKE '%$buscar%' || c.NombreC LIKE '$buscar%' ||
                                                            c.AcronimoC LIKE '%$buscar'|| c.AcronimoC LIKE '%$buscar%' || c.AcronimoC LIKE '$buscar%' ||
                                                            c.AnhoC LIKE '%$buscar'|| c.AnhoC LIKE '%$buscar%' || c.AnhoC LIKE '$buscar%' ||
                                                            c.LugarC LIKE '%$buscar'|| c.LugarC LIKE '%$buscar%' || c.LugarC LIKE '$buscar%'  
                                                                                                       
                                                            ") or die(mysqli_error($this->mysqli));
        return $sql;
    }

    /**
     * Valida si los campos del formulario de una materia son correctos
     *
     * @param array $campos del formulario
     * @return array $errores, contiene los campos fallidos $errores[] = nombre del campo
     */
    public function validarCongreso($campos){

        $errores    = array();
        $validar    = new Validacion();

        // Login
        if(empty($campos["LoginU"]))
            $errores[]  = "LoginU";

        // Codigo congreso
        if(isset($campos["CodigoC"]) && !$validar->validarSoloNumeros($campos["CodigoC"]))
            $errores[]  = "CodigoC";

        // nombre congreso
        if(isset($campos["NombreC"]) && !$validar->validarSoloLetras($campos["NombreC"]))
            $errores[]  = "NombreC";

        // Tipo de participación
        if(empty($campos["TipoParticipacionC"]))
            $errores[]  = "TipoParticipacionC";

        return $errores;
    }


}

?>
