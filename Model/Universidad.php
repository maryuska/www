<?php


require_once 'ConnectDB.php';

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
    // Crea una universidad asociada a un usuario en la bd
    // Devuelve true o false segun se cree exitosamente o no
    public function AltaUniversidad()
    {
        $insertarUniversidad = "INSERT INTO universidad(LoginU, NombreUniversidad, FechaInicio, FechaFin)
    VALUES ('$this->LoginU','$this->NombreUniversidad','$this->FechaInicio','$this->FechaFin')";

        $resultado = mysql_query($insertarUniversidad) or die(mysql_error());
    }
    //lista todos las universidades del usuario

    public function ListarUniversidades($Login)
    {
        $sql = mysql_query("SELECT * FROM universidad WHERE LoginU = '$Login'") or die(mysql_error());
        $universidades = array();
        while($row = mysql_fetch_array($sql)){array_push($universidades, $row);}
        $_SESSION["ListarUniversidades"] = $universidades;
    }


}