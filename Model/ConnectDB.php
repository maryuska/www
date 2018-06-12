
<?php
@mysql_connect("localhost","docente","docente");
mysql_select_db("datos_curriculares");

?>

<!-- Variables de conexion a la base de datos
/*
class ConnectDB
{
    public static function conexion()
    {


// Conexion a la base de datos
        $mysqli=new mysqli("localhost", "docente", "docente", "datos_curriculares");


        if ($mysqli->connect_errno) {
            echo("Fallo al conectar a MySQLi: (" . $mysqli->connect_errno . ")" . $mysqli->connect_error . './index.php');

        } else {
            echo("conexion ok");
        }
        return $mysqli;
    }
}

*/

/*class Conectar extends mysqli{

public function __construct(){

/parent::__construct('localhost','docente','docente','datos_curriculares');
$server   = "localhost";
$username = "docente";
$password = "docente";
$database = "datos_curriculares";

// Conexion a la base de datos
$mysqli = @mysqli_connect($server, $username, $password, $database);

return $mysqli;

}
}*/
-->
