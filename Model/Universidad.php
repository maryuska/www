<?php

require_once 'Validacion.php';

class Universidad
{

    private $LoginU;
    private $NombreUniversidad;
    private $FechaInicio;
    private $FechaFin;


    function __construct($LoginU = NULL, $NombreUniversidad = NULL, $FechaInicio = NULL, $FechaFin = NULL)
    {
        $this->LoginU = $LoginU;
        $this->NombreUniversidad = $NombreUniversidad;
        $this->FechaInicio = $FechaInicio;
        $this->FechaFin = $FechaFin;
    }
//Función para conectarnos a la Base de datos
    function ConectarBD()
    {
        $this->mysqli = new mysqli("localhost", "docente", "docente", "datos_curriculares");

        if ($this->mysqli->connect_errno) {
            echo "Fallo al conectar a MySQL: (" . $this->mysqli->connect_errno . ") " . $this->mysqli->connect_error;
        }
    }
	
// Crea una universidad asociada a un usuario en la bd
// Devuelve true o false segun se cree exitosamente o no
    public function AltaUniversidad()
    {
        $this->ConectarBD();
        $insertarUniversidad = "INSERT INTO universidad(LoginU, NombreUniversidad, FechaInicio, FechaFin)
    VALUES ('$this->LoginU','$this->NombreUniversidad','$this->FechaInicio','$this->FechaFin')";

        $resultado = $this->mysqli->query($insertarUniversidad) or die(mysqli_error( $this->mysqli));
    }
	
//Lista todos las universidades del usuario
    public function ListarUniversidades($Login)
    {
        $this->ConectarBD();
        $sql = $this->mysqli->query("SELECT * FROM universidad WHERE LoginU = '$Login' ORDER BY FechaFin DESC ") or die(mysqli_error( $this->mysqli));
        $universidades = array();
        while($row = mysqli_fetch_array($sql)){array_push($universidades, $row);}
        $_SESSION["ListarUniversidades"] = $universidades;
    }

//borrar universidades de un usuario
    public function BorrarUniversidadesUsuario($Login)
    {
        $this->ConectarBD();
        $this->mysqli->query("DELETE FROM universidad WHERE LoginU= '$Login'")or die(mysqli_error( $this->mysqli));
    }

    /**
     * Valida si los campos del formulario de la universidad son correctos
     * 
     * @param array $campos del formulario
     * @return array $errores, contiene los campos fallidos $errores[] = nombre del campo
     */
    public function validarUniversidad($campos){

        $errores    = array();
        $validar    = new Validacion();

        // Nombre universidad
        if(isset($campos["NombreUniversidad"]) && !$validar->validarLetrasYNumeros($campos["NombreUniversidad"]))
            $errores[]  = "NombreUniversidad";

        // Fecha inicio
        if(isset($campos["FechaInicio"]) && !$validar->validarFecha($campos["FechaInicio"]))
            $errores[]  = "FechaInicio";

        // Fecha fin
        if(isset($campos["FechaFin"]) && !$validar->validarFecha($campos["FechaFin"]))
            $errores[]  = "FechaFin";
        if( isset($campos["FechaInicio"]) && $validar->validarFecha($campos["FechaInicio"]) && date("Y-m-d", strtotime($campos["FechaFin"])) < date("Y-m-d", strtotime($campos["FechaInicio"])) )
            $errores[]  = "FechaFin";

        return $errores;
    }

}