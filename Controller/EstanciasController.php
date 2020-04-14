<?php
// Controlador de Proyectos Dirigidos
require_once 'Controller/ControllerController.php';
require_once 'Model/Usuarios.php';
require_once 'Model/Estancias.php';
$evento = $_REQUEST['evento'];

switch ($evento) {


// Página insertar estancia
    case "paginaInsertarEstancia":
        require_once "View/Estancia/insertarEstancia.php";
        break;

// Página insertar estancia admin
    case "paginaInsertarEstanciaAdmin":

        $Usuario = new Usuarios("","","","","","","","","");
        $consultarUsuarios = $Usuario->ListarUsuarios();

        $consulta = array();
        while($row = mysqli_fetch_array($consultarUsuarios)){
            array_push($consulta, $row);
        }
        $_SESSION["listarUsuarios"] = $consulta;
        require_once "View/Estancia/insertarEstanciaAdmin.php";
        break;


//Dar alta una estancia
    case 'altaEstancia':

        // Subimos el fichero si viene alguno
        $AdjuntoE = '';
        if(isset($_FILES['AdjuntoE']) && $_FILES['AdjuntoE']['error'] == 0){
            $dir_subida = 'Archivos/estancias/';
            $fichero_subido = $dir_subida . basename($_FILES['AdjuntoE']['name']);
            if (move_uploaded_file($_FILES['AdjuntoE']['tmp_name'], $fichero_subido))
                $AdjuntoE = basename($_FILES['AdjuntoE']['name']);
        }

        //recoge los datos de la estancia
        $loginU=$_POST["LoginU"];
        $estancia = new Estancias($_POST["CodigoE"],$_POST["CentroE"],$_POST["UniversidadE"],$_POST["PaisE"],$_POST["FechaInicioE"],$_POST["FechaFinE"],$_POST["TipoE"],$_POST["LoginU"],$AdjuntoE);
        $CodigoE = $_REQUEST['CodigoE'];

        $errores = $estancia->validarEstancia($_POST);

            if(!empty($errores)){
                $msgError = "Los campos con el borde rojo son obligatorios.";
                require_once "View/Estancia/insertarEstancia.php";
            }
            else {

                $consultaE = $estancia->ConsultarEstancia($CodigoE);

                if ($consultaE->num_rows > 0) {    // Existe estancia
                    $errores = array("CodigoE", "CentroE", "UniversidadE", "PaisE", "FechaInicioE", "FechaFinE", "TipoE", "LoginU");
                    $msgError = "La estancia: " . $_POST["CodigoE"] . " ya existe, no puede insertar la misma.";
                    require_once "View/Estancia/insertarEstancia.php";
                } else {
                    // Si no ha habido errores subimos el fichero
                    if($_FILES['AdjuntoE']['error'] == 0){
                        $dir_subida = 'Archivos/estancias/';
                        $fichero_subido = $dir_subida . basename($_FILES['AdjuntoE']['name']);
                        if (move_uploaded_file($_FILES['AdjuntoE']['tmp_name'], $fichero_subido))
                            $AdjuntoE = basename($_FILES['AdjuntoE']['name']);
                    }
                    $estancia->setAdjunto($AdjuntoE);

                    $estancia->AltaEstancia();
                    $login = $_REQUEST["LoginU"];
                    header("Location: index.php?controlador=Estancias&evento=listarEstancias&LoginU=" . $login);
                }
            }
		
    break;

//Dar alta una estancia como Admin
    case 'altaEstanciaAdmin':
        // Subimos el fichero si viene alguno
        $AdjuntoE = '';
        if(isset($_FILES['AdjuntoE']) && $_FILES['AdjuntoE']['error'] == 0){
            $dir_subida = 'Archivos/estancias/';
            $fichero_subido = $dir_subida . basename($_FILES['AdjuntoE']['name']);
            if (move_uploaded_file($_FILES['AdjuntoE']['tmp_name'], $fichero_subido))
                $AdjuntoE = basename($_FILES['AdjuntoE']['name']);
        }

        //recoge los datos de la estancia
       $estancia = new Estancias($_POST["CodigoE"],$_POST["CentroE"],$_POST["UniversidadE"],$_POST["PaisE"],$_POST["FechaInicioE"],$_POST["FechaFinE"],$_POST["TipoE"],$_POST["Login"],$AdjuntoE);
        $CodigoE = $_REQUEST['CodigoE'];

        $Usuario = new Usuarios("","","","","","","","","");
        $consultarUsuarios = $Usuario->ListarUsuarios();
        $consulta = array();
        while($row = mysqli_fetch_array($consultarUsuarios)){
            array_push($consulta, $row);
        }
        $_SESSION["listarUsuarios"] = $consulta;

        $errores = $estancia->validarEstancia($_POST);

        if(!empty($errores)){
            $msgError = "Los campos con el borde rojo son obligatorios.";
            require_once "View/Estancia/insertarEstanciaAdmin.php";
        }
        else {

            $consultaE = $estancia->ConsultarEstancia($CodigoE);

            if ($consultaE->num_rows > 0) {    // Existe estancia
                $errores = array("CodigoE", "CentroE", "UniversidadE", "PaisE", "FechaInicioE", "FechaFinE", "TipoE", "LoginU");
                $msgError = "La estancia: " . $_POST["CodigoE"] . " ya existe, no puede insertar la misma.";
                require_once "View/Estancia/insertarEstanciaAdmin.php";
            } else {
                // Si no ha habido errores subimos el fichero
                if($_FILES['AdjuntoE']['error'] == 0){
                    $dir_subida = 'Archivos/estancias/';
                    $fichero_subido = $dir_subida . basename($_FILES['AdjuntoE']['name']);
                    if (move_uploaded_file($_FILES['AdjuntoE']['tmp_name'], $fichero_subido))
                        $AdjuntoE = basename($_FILES['AdjuntoE']['name']);
                }
                $estancia->setAdjunto($AdjuntoE);
                $estancia->AltaEstancia();
                header("Location: index.php?controlador=Estancias&evento=listarEstanciasAdmin");
            }
        }
        break;		

//Consultar una estancia para modificar
    case 'consultarEstancia':

        $estancia = new Estancias("","","","","","","","","");
        $CodigoE = $_REQUEST['CodigoE'];
        $consultaE = $estancia->ConsultarEstancia($CodigoE);
        $consulta = array();
        while($row1 = mysqli_fetch_array($consultaE)){
            array_push($consulta, $row1);
        }
        $_SESSION["consultarEstancia"] = $consulta;

        require_once "View/Estancia/modificarEstancia.php";

        break;

//Consultar una estancia para modificar como admin
    case 'consultarEstanciaAdmin':

        $Usuario = new Usuarios("","","","","","","","","");
        $consultarUsuarios = $Usuario->ListarUsuarios();

        $consulta = array();
        while($row = mysqli_fetch_array($consultarUsuarios)){
            array_push($consulta, $row);
        }
        $_SESSION["listarUsuarios"] = $consulta;

        $estancia = new Estancias("","","","","","","","","");
        $CodigoE = $_REQUEST['CodigoE'];
        $consultaE = $estancia->ConsultarEstancia($CodigoE);
        $consulta = array();
        while($row1 = mysqli_fetch_array($consultaE)){
            array_push($consulta, $row1);
        }
        $_SESSION["consultarEstancia"] = $consulta;

        require_once "View/Estancia/modificarEstanciaAdmin.php";

        break;

//Modificar una estancia
    case 'modificarEstancia':
        // Subimos el fichero si viene alguno
        $AdjuntoE = '';
        if(isset($_FILES['AdjuntoE']) && $_FILES['AdjuntoE']['error'] == 0){
            $dir_subida = 'Archivos/estancias/';
            $fichero_subido = $dir_subida . basename($_FILES['AdjuntoE']['name']);
            if (move_uploaded_file($_FILES['AdjuntoE']['tmp_name'], $fichero_subido))
                $AdjuntoE = basename($_FILES['AdjuntoE']['name']);
        }
        $tipou=$_SESSION["TipoUsuario"];
        $Usuario = new Usuarios("","","","","","","","","");
        $consultarUsuarios = $Usuario->ListarUsuarios();
        $consulta = array();
        while($row = mysqli_fetch_array($consultarUsuarios)){
            array_push($consulta, $row);
        }
        $_SESSION["listarUsuarios"] = $consulta;

        $CodigoE = $_POST['CodigoE'];
        $CentroE = $_POST['CentroE'];
        $UniversidadE = $_POST['UniversidadE'];
        $PaisE = $_POST['PaisE'];
        $FechaInicioE= $_POST['FechaInicioE'];
        $FechaFinE = $_POST['FechaFinE'];
        $TipoE = $_POST['TipoE'];
        $LoginU = $_POST['LoginU'];

        $estancia = new Estancias($CodigoE, $CentroE, $UniversidadE, $PaisE, $FechaInicioE, $FechaFinE, $TipoE, $LoginU ,$AdjuntoE);
        $errores    = $estancia->validarEstancia($_POST);

        if(!empty($errores)){
            $msgError = "Los campos con el borde rojo son obligatorios.";
            $consultaE = $estancia->ConsultarEstancia($CodigoE);
            $consulta = array();
            while($row1 = mysqli_fetch_array($consultaE)){
                array_push($consulta, $row1);
            }
            $_SESSION["consultarEstancia"] = $consulta;

            if($tipou == 'U') {
                require_once "View/Estancia/modificarEstancia.php";
            }else{
                require_once "View/Estancia/modificarEstanciaAdmin.php";
            }
        }
        else{
            // Si tiene marcado el check de eliminar lo eliminamos
            if( isset($_POST["AdjuntoE_delete"]) && $_POST["AdjuntoE_delete"] == '1' )
                @unlink('Archivos/estancias/' . $_POST["AdjuntoE_old"]);

            // Subimos el fichero si viene alguno
            if(isset($_FILES['AdjuntoE']) && $_FILES['AdjuntoE']['error'] == 0){
                $dir_subida = 'Archivos/estancias/';
                $fichero_subido = $dir_subida . basename($_FILES['AdjuntoE']['name']);
                if (move_uploaded_file($_FILES['AdjuntoE']['tmp_name'], $fichero_subido)){
                    $AdjuntoE = basename($_FILES['AdjuntoE']['name']);

                    // Si teniamos un archivo anterior lo eliminamos
                    if( $_POST["AdjuntoE_old"] )
                        @unlink('Archivos/estancias/' . $_POST["AdjuntoE_old"]);

                }

            }

            $estancia->setAdjunto($AdjuntoE);

            $estancia->ModificarEstancia($CodigoE);
            $loginU = $_POST['LoginU'];
            if($tipou == 'U'){
                header("Location: index.php?controlador=Estancias&evento=listarEstancias&LoginU=$loginU");
            }else{
                header("Location: index.php?controlador=Estancias&evento=listarEstanciasAdmin");
            }
        }

    break;

//Listar estancias de usuario
    case 'listarEstancias':
        $LoginU = $_REQUEST['LoginU'];
        $lista = new Estancias("","","","","","","","","");
        //todas las estancias
        $listaEstancias = $lista->ListarEstancias($LoginU);
        $listaResultado = array();
        while($row = mysqli_fetch_array($listaEstancias)){
            array_push($listaResultado, $row);
        }
        //estancias de investigacion
        $listaEstanciasInves = $lista->ListarEstanciasInvertigacion($LoginU);
        $listaResultadoEInves = array();
        while($row1 = mysqli_fetch_array($listaEstanciasInves)){
            array_push($listaResultadoEInves, $row1);
        }
        //estancias de doctorado
        $listaEstanciasD = $lista->ListarEstanciasDoctorado($LoginU);
        $listaResultadoED = array();
        while($row2 = mysqli_fetch_array($listaEstanciasD)){
            array_push($listaResultadoED, $row2);
        }
        //estancias de invitado
        $listaEstanciasInvi = $lista->ListarEstanciasInvitado($LoginU);
        $listaResultadoEInvi = array();
        while($row3 = mysqli_fetch_array($listaEstanciasInvi)){
            array_push($listaResultadoEInvi, $row3);
        }

        $_SESSION["listarEstancias"] = $listaResultado;
        $_SESSION["listarEstanciasInvestigacion"] = $listaResultadoEInves;
        $_SESSION["listarEstanciasDoctorado"] = $listaResultadoED;
        $_SESSION["listarEstanciasInvitado"] = $listaResultadoEInvi;
        require_once("View/Estancia/listarEstancias.php");

    break;

//Listar todas las estancias como admin
    case 'listarEstanciasAdmin':

        $lista = new Estancias("","","","","","","","","");

        //todas las estancias
        $listaEstancias = $lista->ListarEstanciasAdmin();
        $listaResultado = array();
        while($row = mysqli_fetch_array($listaEstancias)){
            array_push($listaResultado, $row);
        }
        //estancias de investigacion
        $listaEstanciasInves = $lista->ListarEstanciasInvertigacionAdmin();
        $listaResultadoEInves = array();
        while($row1 = mysqli_fetch_array($listaEstanciasInves)){
            array_push($listaResultadoEInves, $row1);
        }
        //estancias de doctorado
        $listaEstanciasD = $lista->ListarEstanciasDoctoradoAdmin();
        $listaResultadoED = array();
        while($row2 = mysqli_fetch_array($listaEstanciasD)){
            array_push($listaResultadoED, $row2);
        }
        //estancias de invitado
        $listaEstanciasInvi = $lista->ListarEstanciasInvitadoAdmin();
        $listaResultadoEInvi = array();
        while($row3 = mysqli_fetch_array($listaEstanciasInvi)){
            array_push($listaResultadoEInvi, $row3);
        }

        $_SESSION["listarEstanciasAdmin"] = $listaResultado;
        $_SESSION["listarEstanciasInvestigacionAdmin"] = $listaResultadoEInves;
        $_SESSION["listarEstanciasDoctoradoAdmin"] = $listaResultadoED;
        $_SESSION["listarEstanciasInvitadoAdmin"] = $listaResultadoEInvi;

        require_once("View/Estancia/listarEstanciasAdmin.php");

        break;

//Borrar estancia
    case 'borrarEstancia':
        $CodigoE=$_REQUEST["CodigoE"];
        $Estancia = new Estancias("","","","","","","","","");

        $Estancia->BorrarEstancia($CodigoE);

        $tipou=$_SESSION["TipoUsuario"];

        if($tipou == 'U'){
            header("Location: index.php?controlador=Estancias&evento=listarEstancias&LoginU=$loginU");
        }else{
            header("Location: index.php?controlador=Estancias&evento=listarEstanciasAdmin");
        }
        break;

//Buscar estancia
    case 'buscarEstancia':
        $buscar= $_POST['textoBusqueda'];

        $Estancia = new Estancias("","","","","","","","","");
        $consultarEstancia = $Estancia->BuscarEstancia($buscar);

        if(!empty($consultarEstancia)){
            $listaResultado = array();
            while($row = mysqli_fetch_array($consultarEstancia)){
                array_push($listaResultado, $row);
            }
            $_SESSION["listarBusqueda"] = $listaResultado;

            $tipou=$_SESSION["TipoUsuario"];
            if($tipou == 'U'){
                require_once "View/Estancia/buscarEstancias.php";
            }else{
                require_once "View/Estancia/buscarEstanciasAdmin.php";
            }
        }else{
            echo 'ERROR: no se encontro ningun resultado';
        }
        break;

    default:

    echo "ACCION NO REGISTRADA";
    break;
}

?>
