<?php

if(!isset($_SESSION))
    session_start();

require_once 'Validacion.php';

class Articulo{

    private $CodigoA;
    private $TituloA;
    private $TituloR;
    private $ISSN;
    private $VolumenR;
    private $PagIniA;
    private $PagFinA;
    private $FechaPublicacionR;
    private $EstadoA;

//constructor de articulo
    public function __construct($CodigoA = NULL,  $TituloA = NULL, $TituloR = NULL,
                                $ISSN = NULL, $VolumenR = NULL, $PagIniA = NULL, $PagFinA = NULL, $FechaPublicacionR = NULL, $EstadoA = NULL ){
        $this->CodigoA = $CodigoA;
        $this->TituloA = $TituloA;
        $this->TituloR = $TituloR;
        $this->ISSN = $ISSN;
        $this->VolumenR = $VolumenR;
        $this->PagIniA= $PagIniA;
        $this->PagFinA= $PagFinA;
        $this->FechaPublicacionR= $FechaPublicacionR;
        $this->EstadoA= $EstadoA;
    }
//Función para conectarnos a la Base de datos
    function ConectarBD()
    {
        $this->mysqli = new mysqli("localhost", "docente", "docente", "datos_curriculares");

        if ($this->mysqli->connect_errno) {
            echo "Fallo al conectar a MySQL: (" . $this->mysqli->connect_errno . ") " . $this->mysqli->connect_error;
        }
    }

//alta de un nuevo articulo
    public function AltaArticulo() {
        $this->ConectarBD();
        $insertarArticulo  = "INSERT INTO articulo (CodigoA, TituloA, TituloR, ISSN,VolumenR, PagIniA,PagFinA,FechaPublicacionR,EstadoA)
                          VALUES ('$this->CodigoA',  '$this->TituloA', '$this->TituloR','$this->ISSN','$this->VolumenR',
                           '$this->PagIniA', '$this->PagFinA','$this->FechaPublicacionR', '$this->EstadoA')";
        $resultado = $this->mysqli->query($insertarArticulo) or die(mysqli_error($this->mysqli));
    }

    public function UpdateAutorArticulo($codigoA, $autores){

        $this->ConectarBD();

        // Almacenamos los códigos de autor para luego borrar del artículo los que no tengan relación
        $codigosAutores = array();

        // Recorremos el array de autores
        foreach($autores as $idx => $autor){

            $CodigoAutor = '';
            $loginU = '';

            // Buscamos si existe, si es así cogemos el código
            $consulta = $this->mysqli->query("SELECT * FROM autor  WHERE NombreAutor = '$autor'");
            if( $consulta->num_rows > 0 &&  $row = mysqli_fetch_array($consulta)){
                $CodigoAutor = $row["CodigoAutor"];
                $codigosAutores[] = $CodigoAutor;
            }
    
            // Sino existe, buscamos si hay un usuario con ese nombre para obtener su loginU -> despues llamaríamos a AltaUsuarioArticulo para ese par
            if(empty($loginU)){
                $consulta = $this->mysqli->query("SELECT LoginU FROM usuario WHERE CONCAT(NombreU, ' ', ApellidosU) = '$autor'");
                if( $consulta->num_rows > 0 &&  $row = mysqli_fetch_array($consulta))
                    $loginU = $row["LoginU"];
            }

            $bExisteRelacion = false;

            // Sino existe un autor insertamos en la tabla del autor
            if(empty($CodigoAutor)){
                $resultado = $this->mysqli->query("INSERT INTO autor (NombreAutor, LoginU) VALUES ('$autor', '$loginU')") or die(mysqli_error($this->mysqli));
                $CodigoAutor = $this->mysqli->insert_id;
                $codigosAutores[] = $CodigoAutor;
            }
  
            // Buscamos si existe la relación autor-articulo en ese caso no la insertamos
            $consulta = $this->mysqli->query("SELECT COUNT(*) total FROM autor_articulo WHERE CodigoA = '$codigoA' AND  CodigoAutor = '$CodigoAutor'");
            if( $consulta->num_rows > 0 &&  $row = mysqli_fetch_array($consulta)){
                if($row["total"] > 0)
                    $bExisteRelacion = true;
            }

            // Sino existe la relación la creamos
            if($bExisteRelacion == false)
                $resultado = $this->mysqli->query("INSERT INTO autor_articulo (CodigoA, CodigoAutor) VALUES ('$codigoA', '$CodigoAutor')") or die(mysqli_error($this->mysqli));
            
            // Si el $loginU no está vacio es porque hay un usuario con ese login y le asignamos al artículo también a ese usuario
            if(!empty($loginU))
                $this->UpdateUsuarioArticulo($codigoA, $loginU);
        }

        // Eliminamos el resto de relaciones que no estén en el artículo
        $this->mysqli->query("DELETE FROM autor_articulo WHERE CodigoA = '$codigoA' AND CodigoAutor NOT IN(" . implode(',', $codigosAutores) . ")") or die(mysqli_error($this->mysqli));

    }

    public function UpdateUsuarioArticulo($codigoA, $loginU){

        $this->ConectarBD();

        // Si el loginU es un array, vendremos desde el administrador pq puede elegir varios usuario
        if(is_array($loginU)){
            // Como todas las relaciones de los artículos con el usuario las manejaría el administrador, en el caso de que
            // el administrador no seleccione un usuario, se desvincularía el artículo de ese usuario, de tal forma
            // que podemos borrar todas las referencias e insertar solo las que venga en la tabla.
            $this->mysqli->query("DELETE FROM usuario_articulo WHERE CodigoA = '$codigoA'") or die(mysqli_error($this->mysqli));
            // Insertamos las relaciones
            foreach($loginU as $idx => $valor){
                $insertarRelacion  = "INSERT INTO usuario_articulo (CodigoA, LoginU) VALUES ('$codigoA',  '$valor')";
                $resultado = $this->mysqli->query($insertarRelacion) or die(mysqli_error($this->mysqli));
            }
        }
        else{
            // Si el loginU NO es un array, vendremos desde la insercción de un usuario, por lo que buscaremos si existe esta relación
            // en caso de no existir la agregamos de otra forma no realizaríamos nada.
            $consulta = $this->mysqli->query("SELECT COUNT(*) AS total FROM usuario_articulo  WHERE CodigoA = '$codigoA' AND LoginU = '$loginU'");
            if($row = mysqli_fetch_array($consulta)){
                if($row["total"] == 0){
                    $insertarRelacion  = "INSERT INTO usuario_articulo (CodigoA, LoginU) VALUES ('$codigoA',  '$loginU')";
                    $resultado = $this->mysqli->query($insertarRelacion) or die(mysqli_error($this->mysqli));
                }
            }
        }

        return $resultado;
    }

    //consultar un articulo
    public function ConsultarArticulo($CodigoA){
        $this->ConectarBD();
        $sql= $this->mysqli->query("SELECT * FROM articulo  WHERE CodigoA = '$CodigoA'");
        return $sql;
    }

    //consultar autores
    public function ConsultarAutores($CodigoA){
        $this->ConectarBD();
        $sql= $this->mysqli->query("SELECT au.* FROM autor_articulo AS aa INNER JOIN autor AS au ON aa.CodigoAutor = au.CodigoAutor WHERE aa.CodigoA = '$CodigoA'") or die (mysqli_error($this->mysqli));
        return $sql;
    }

    //consultar usuarios
    public function ConsultarUsuarios($CodigoA){
        $this->ConectarBD();
        $sql= $this->mysqli->query("SELECT ua.*, u.NombreU, u.ApellidosU FROM usuario_articulo AS ua INNER JOIN usuario AS u ON ua.LoginU = u.LoginU WHERE ua.CodigoA= '$CodigoA'") or die (mysqli_error($this->mysqli));
        return $sql;
    }

    //modificar un articulo
    public function ModificarArticulo($CodigoA){
        $this->ConectarBD();
        $this->mysqli->query("UPDATE articulo SET TituloA='$this->TituloA',TituloR='$this->TituloR' ,
                      ISSN='$this->ISSN',VolumenR='$this->VolumenR',PagIniA='$this->PagIniA',PagFinA='$this->PagFinA',
                      FechaPublicacionR='$this->FechaPublicacionR',EstadoA='$this->EstadoA' where CodigoA = '$CodigoA'") or die (mysqli_error($this->mysqli));
    }

    // Elimina un artículo
    public function EliminarArticuloUsuario($CodigoA, $LoginU){
        $this->ConectarBD();
        // Comprueba si el artículo lo tiene asignado más usuario, de ser así borra solo la asociación del artículo a su usuario
        // sino borraría el artículo completo
        $consulta = $this->mysqli->query("SELECT COUNT(*) AS total FROM usuario_articulo  WHERE CodigoA = '$CodigoA'");
        if($row = mysqli_fetch_array($consulta)){
            if($row["total"] > 1){
                return $this->mysqli->query("DELETE FROM usuario_articulo WHERE CodigoA = '$CodigoA' AND LoginU = '$LoginU'") or die(mysqli_error($this->mysqli));
            }
            else{
                return $this->EliminarArticuloAdministrador($CodigoA);
            }
        }
    }

    // Eliminar articulo administrador
    public function EliminarArticuloAdministrador($CodigoA){
        $this->ConectarBD();
        // Eliminamos todas las relaciones con los usuarios
        $this->mysqli->query("DELETE FROM usuario_articulo WHERE CodigoA = '$CodigoA'") or die(mysqli_error($this->mysqli));
        // Eliminamos todas las relaciones con los autores
        $this->mysqli->query("DELETE FROM autor_articulo WHERE CodigoA = '$CodigoA'") or die(mysqli_error($this->mysqli));
        // Eliminamos el artículo
        return $this->mysqli->query("DELETE FROM articulo WHERE CodigoA = '$CodigoA'") or die(mysqli_error($this->mysqli));
    }

    //lista de todas los articulos
    public function ListarArticulos($LoginU, $TituloA){
        $this->ConectarBD();
        $sql = "SELECT DISTINCT a.* FROM articulo AS a INNER JOIN usuario_articulo AS ua ON a.CodigoA = ua.CodigoA ";
        if(!empty($LoginU) && !empty($TituloA))
            $sql .= " WHERE ua.LoginU = '$LoginU' AND a.tituloA LIKE '%$TituloA%'";
        elseif(!empty($LoginU))
            $sql .= " WHERE ua.LoginU = '$LoginU'";
        elseif(!empty($TituloA))
            $sql .= " WHERE a.tituloA LIKE '%$TituloA%'";
            
        $consulta = $this->mysqli->query($sql) or die (mysqli_error($this->mysqli));
        return $consulta;
    }

    // Comprobamos si existe el artículo
    public function existeArticulo($CodigoA){
        $this->ConectarBD();
        $consulta = $this->mysqli->query("SELECT COUNT(*) total FROM articulo WHERE CodigoA = '$CodigoA'");
        if( $consulta->num_rows > 0 &&  $row = mysqli_fetch_array($consulta))
            if($row["total"] > 0)
                return true;
        return false;
    }

    /**
     * Valida si los campos del formulario del perfil son correctos
     * 
     * @param array $campos del formulario
     * @return array $errores, contiene los campos fallidos $errores[] = nombre del campo
     */
    public function validarArticulo($campos){

        $errores    = array();
        $validar    = new Validacion();

        // Validamos que tenga algún loginU
        if(empty($campos["loginU"]) && !$validar->validarLetrasYNumeros($campos["loginU"]))
            $errores[]  = "loginU";

        // Código del artículo
        if(empty($campos["CodigoA"]) || !$validar->validarSoloLetras($campos["CodigoA"]))
            $errores[]  = "CodigoA";

        // Título del artículo
        if(empty($campos["TituloA"]) || !$validar->validarSoloLetras($campos["TituloA"]))
            $errores[]  = "TituloA";

        // Título de la revista
        if(empty($campos["TituloR"]) || !$validar->validarSoloLetras($campos["TituloR"]))
            $errores[]  = "TituloR";

        // ISSN
        if(empty($campos["ISSN"]) || !$validar->validarSoloLetras($campos["ISSN"]))
            $errores[]  = "ISSN";

        // Validamos que tenga algún autor
        if(isset($campos["autores"])){ 
            if(is_array($campos["autores"])){
                foreach($campos["autores"] as $idx => $valor)
                    if(!$validar->validarLetrasYNumeros($valor))
                        $errores[]  = "autores";
            }
            elseif(!$validar->validarLetrasYNumeros($campos["autores"])){
                $errores[]  = "autores";
            }
        }
        else{ 
            $errores[]  = "autores";
        }

        return $errores;
    }

    /**
     * Valida si los campos del formulario del perfil son correctos
     * 
     * @param array $campos del formulario
     * @return array $errores, contiene los campos fallidos $errores[] = nombre del campo
     */
    public function validarArticuloAdmin($campos){

        $errores    = array();
        $validar    = new Validacion();

        // Validamos que tenga algún loginU
        if(isset($campos["loginU"])){ 
            if(is_array($campos["loginU"])){
                foreach($campos["loginU"] as $idx => $valor)
                    if(!$validar->validarLetrasYNumeros($valor))
                        $errores[]  = "loginU";
            }
            else{
                $errores[]  = "loginU";
            }
        }
        else{ 
            $errores[]  = "loginU";
        }

        // Código del artículo
        if(empty($campos["CodigoA"]) || !$validar->validarSoloLetras($campos["CodigoA"]))
            $errores[]  = "CodigoA";

        // Título del artículo
        if(empty($campos["TituloA"]) || !$validar->validarSoloLetras($campos["TituloA"]))
            $errores[]  = "TituloA";

        // Título de la revista
        if(empty($campos["TituloR"]) || !$validar->validarSoloLetras($campos["TituloR"]))
            $errores[]  = "TituloR";

        // ISSN
        if(empty($campos["ISSN"]) || !$validar->validarSoloLetras($campos["ISSN"]))
            $errores[]  = "ISSN";

        // Validamos que tenga algún autor
        if(isset($campos["autores"])){ 
            if(is_array($campos["autores"])){
                foreach($campos["autores"] as $idx => $valor)
                    if(!$validar->validarLetrasYNumeros($valor))
                        $errores[]  = "autores";
            }
            elseif(!$validar->validarLetrasYNumeros($campos["autores"])){
                $errores[]  = "autores";
            }
        }
        else{ 
            $errores[]  = "autores";
        }

        return $errores;
    }


}

?>
