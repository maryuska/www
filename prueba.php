<?php

$mysqli = new mysqli('localhost','docente','docente','datos_curriculares');

if ($mysqli->connect_errno) {
    echo("Fallo al conectar a MySQLi: (" . $mysqli->connect_errno . ")" . $mysqli->connect_error . './index.php');
}
else {
    echo("conexion ok");
}


$insertarUsuario  = "select * from usuario";
if ($resultado = $mysqli->query($insertarUsuario)){
    echo 'funciona';
    var_dump($resultado);
}
else
    echo("non conecta");


?>

