<?php

require_once 'Validacion.php';

class TituloAcademico
{

    private $LoginU;
    private $NombreTitulo;
    private $FechaTitulo;
    private $CentroTitulo;


    function __construct($LoginU = NULL, $NombreTitulo = NULL, $FechaTitulo = NULL, $CentroTitulo = NULL)
    {
        $this->LoginU = $LoginU;
        $this->NombreTitulo = $NombreTitulo;
        $this->FechaTitulo = $FechaTitulo;
        $this->CentroTitulo = $CentroTitulo;
    }
    // Crea un titulo asociado a un usuario en la bd
    // Devuelve true o false segun se cree exitosamente o no
    //Función para conectarnos a la Base de datos
    function ConectarBD()
    {
        $this->mysqli = new mysqli("localhost", "docente", "docente", "datos_curriculares");

        if ($this->mysqli->connect_errno) {
            echo "Fallo al conectar a MySQL: (" . $this->mysqli->connect_errno . ") " . $this->mysqli->connect_error;
        }
    }
    public function AltaTituloAcademico()
    {
        $this->ConectarBD();
        $insertarTituloAcademico = "INSERT INTO titulo_academico (LoginU, NombreTitulo, FechaTitulo, CentroTitulo)
    VALUES ('$this->LoginU','$this->NombreTitulo','$this->FechaTitulo','$this->CentroTitulo')";

        $resultado = $this->mysqli->query($insertarTituloAcademico) or die(mysqli_error($this->mysqli));
    }
    //lista todos las titulosAcademicos del usuario

    public function ListarTitulosAcademicos($LoginU)
    {
        $this->ConectarBD();
        $sql = $this->mysqli->query("SELECT * FROM titulo_academico WHERE LoginU = '$LoginU' ORDER BY FechaTitulo DESC ") or die(mysqli_error($this->mysqli));
        return $sql;
    }


    public function ModificarTituloAcademico($LoginU, $NombreTitulo){
        $sql = $this->mysqli->query("UPDATE titulo_academico SET NombreTitulo='$this->NombreTitulo',FechaTitulo='$this->FechaTitulo',CentroTitulo='$this->CentroTitulo'
				WHERE LoginU = '$LoginU' AND NombreTitulo = '$NombreTitulo'")
        or die(mysqli_error($this->mysqli));

    }
    //borrar titulos academicos de un usuario
    public function BorrarTitulosUsuario($Login){
        $this->ConectarBD();
        $this->mysqli->query("DELETE FROM titulo_academico WHERE LoginU= '$Login'")or die(mysqli_error($this->mysqli));
    }

    /**
     * Valida si los campos del formulario del titulo academico son correctos
     * 
     * @param array $campos del formulario
     * @return array $errores, contiene los campos fallidos $errores[] = nombre del campo
     */
    public function validarTituloAcademico($campos){

        $errores    = array();
        $validar    = new Validacion();

        // Titulo
        if(isset($campos["Titulo"]) && !$validar->validarLetrasYNumeros($campos["Titulo"]))
            $errores[]  = "Titulo";

        // Fecha titulo
        if(isset($campos["FechaTitulo"]) && !$validar->validarFecha($campos["FechaTitulo"]))
            $errores[]  = "FechaTitulo";

        // Centro titulo
        if(isset($campos["CentroTitulo"]) && !$validar->validarLetrasYNumeros($campos["CentroTitulo"]))
            $errores[]  = "CentroTitulo";

        return $errores;
    }

}