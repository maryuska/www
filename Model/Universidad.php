<?php



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
    //lista todos las universidades del usuario

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



}