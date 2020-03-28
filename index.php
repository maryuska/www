<?php

// Recogemos los parámetros para importar la vista o controlador necesario

/*$controlador = $_GET["controlador"] ?? "";



 La linea anterior sería el equivalente en PHP7 a*/
 
 $controlador = "";
 if(isset($_GET["controlador"])){
    $controlador = $_GET["controlador"];
 }

if( empty($controlador) ){  // Si el controlador está vacio incluimos a la vista de login

    require_once "View/login.php";

}
elseif(file_exists("Controller/" . $controlador . "Controller.php")){      // Comprobamos si existe el archivo del controlador y en tal caso lo requerimos

    require_once "Controller/" . $controlador . "Controller.php";

}
else{                       // Sino se cumple ninguna de las anteriores estaría dandose un error, matamos la web y mostramos error

    die("ERROR!");

}

?>