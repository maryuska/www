<?php
// Controlador de Materias

require_once 'Controller/ControllerController.php';
require_once 'Model/Materia.php';
$evento = $_REQUEST['evento'];

switch ($evento) {
    // Página insertar materia
    case "paginaInsertarMateria":
        require_once "View/Materia/insertarMateria.php";
        break;
    // Página insertar materia admin
    case "paginaInsertarMateriaAdmin":
        require_once "View/Materia/insertarMateriaAdmin.php";
        break;

    case 'altaMateria':
    $loginU=$_POST["LoginU"];
    $materia = new Materia($_POST["CodigoM"],$_POST["TipoM"],$_POST["TipoParticipacionM"],$_POST["DenominacionM"],$_POST["TitulacionM"],$_POST["AnhoAcademicoM"],$_POST["CreditosM"],$_POST["CuatrimestreM"],$_POST["LoginU"]);
    $materia->AltaMateria();

        header("Location: index.php?controlador=Materias&evento=listarMaterias&LoginU=$loginU");

    break;

    case 'altaMateriaAdmin':

        $materia = new Materia($_POST["CodigoM"],$_POST["TipoM"],$_POST["TipoParticipacionM"],$_POST["DenominacionM"],$_POST["TitulacionM"],$_POST["AnhoAcademicoM"],$_POST["CreditosM"],$_POST["CuatrimestreM"],$_POST["Login"]);
        $materia->AltaMateria();

            header("Location: index.php?controlador=Materias&evento=listarMateriasAdmin");

        break;

    case 'consultarMateria':

        $materia = new Materia("","","","","","","","","");
        $CodigoM = $_REQUEST['CodigoM'];
        $consultaM = $materia->ConsultarMateria($CodigoM);
        $consulta = array();
        while($row1 = mysqli_fetch_array($consultaM)){
            array_push($consulta, $row1);
        }
        $_SESSION["consultarMateria"] = $consulta;

        require_once "View/Materia/modificarMateria.php";

        break;

    case 'modificarMateria':

        $CodigoM = $_POST['CodigoM'];
        $TipoM = $_POST['TipoM'];
        $TipoParticipacionM = $_POST['TipoParticipacionM'];
        $DenominacionM = $_POST['DenominacionM'];
        $TitulacionM = $_POST['TitulacionM'];
        $AnhoAcademicoM = $_POST['AnhoAcademicoM'];
        $CreditosM = $_POST['CreditosM'];
        $CuatrimestreM = $_POST['CuatrimestreM'];
        $LoginU = $_POST['LoginU'];


        $materia = new Materia( $CodigoM,$TipoM, $TipoParticipacionM ,$DenominacionM ,$TitulacionM ,$AnhoAcademicoM ,$CreditosM,$CuatrimestreM, $LoginU  );
        $errores    = $materia->validarMateria($_POST);
        if(!empty($errores)){
            // Tiene errores de validación volvemos a la página anterior
            require_once "View/Materia/modificarMateria.php";
        }
        else{

            $materia->ModificarMateria($CodigoM);
            $tipou=$_SESSION["TipoUsuario"];
            if($tipou == 'U'){
                header("Location: index.php?controlador=Materias&evento=listarMaterias&LoginU=$loginU");
            }else{
                header("Location: index.php?controlador=Materias&evento=listarMateriasAdmin");
            }
        }


    break;

//listar materias por usuario
    case 'listarMaterias':

        $LoginU = $_REQUEST['LoginU'];
        $lista = new Materia("","","","","","","","","");

        //todas las materias
        $listaMaterias= $lista->ListarMaterias($LoginU);
        $listaResultado = array();
        while($row = mysqli_fetch_array($listaMaterias)){
            array_push($listaResultado, $row);
        }
        //materias grado
        $listaMateriasGrado = $lista->ListarMateriasGrado($LoginU);
        $listaResultadoMG = array();
        while($row1 = mysqli_fetch_array($listaMateriasGrado)){
            array_push($listaResultadoMG, $row1);
        }
        //materias tercer ciclo
        $listaMateriasTCiclo = $lista->ListarMateriasTCiclo($LoginU);
        $listaResultadoMTC = array();
        while($row2 = mysqli_fetch_array($listaMateriasTCiclo)){
            array_push($listaResultadoMTC, $row2);
        }
        //materias master
        $listaMateriasMaster = $lista->ListarMateriasMaster($LoginU);
        $listaResultadoMM = array();
        while($row3 = mysqli_fetch_array($listaMateriasMaster)){
            array_push($listaResultadoMM, $row3);
        }
        //materias post grado
        $listaMateriasPostG = $lista->ListarMateriasPost($LoginU);
        $listaResultadoMPG = array();
        while($row4 = mysqli_fetch_array($listaMateriasPostG)){
            array_push($listaResultadoMPG, $row4);
        }
        //materias cursos
        $listaMateriasCursos = $lista->ListarMateriasCursos($LoginU);
        $listaResultadoMC = array();
        while($row5 = mysqli_fetch_array($listaMateriasCursos)){
            array_push($listaResultadoMC, $row5);
        }
        $_SESSION["listarMaterias"] = $listaResultado;
        $_SESSION["listarMateriasGrado"] = $listaResultadoMG;
        $_SESSION["listarMateriasTCiclo"] = $listaResultadoMTC;
        $_SESSION["listarMateriasMaster"] = $listaResultadoMM;
        $_SESSION["listarMateriasPost"] = $listaResultadoMPG;
        $_SESSION["listarMateriasCursos"] = $listaResultadoMC;

        require_once("View/Materia/listarMaterias.php");

    break;

//listar todas las materias admin
    case 'listarMateriasAdmin':

        $lista = new Materia("","","","","","","","","");

        //todas las materias
        $listaMaterias= $lista->ListarMateriasAdmin();
        $listaResultado = array();
        while($row = mysqli_fetch_array($listaMaterias)){
            array_push($listaResultado, $row);
        }
        //materias grado
        $listaMateriasGrado = $lista->ListarMateriasGradoAdmin();
        $listaResultadoMG = array();
        while($row1 = mysqli_fetch_array($listaMateriasGrado)){
            array_push($listaResultadoMG, $row1);
        }
        //materias tercer ciclo
        $listaMateriasTCiclo = $lista->ListarMateriasTCicloAdmin();
        $listaResultadoMTC = array();
        while($row2 = mysqli_fetch_array($listaMateriasTCiclo)){
            array_push($listaResultadoMTC, $row2);
        }
        //materias master
        $listaMateriasMaster = $lista->ListarMateriasMasterAdmin();
        $listaResultadoMM = array();
        while($row3 = mysqli_fetch_array($listaMateriasMaster)){
            array_push($listaResultadoMM, $row3);
        }
        //materias post grado
        $listaMateriasPostG = $lista->ListarMateriasPostAdmin();
        $listaResultadoMPG = array();
        while($row4 = mysqli_fetch_array($listaMateriasPostG)){
            array_push($listaResultadoMPG, $row4);
        }
        //materias cursos
        $listaMateriasCursos = $lista->ListarMateriasCursosAdmin();
        $listaResultadoMC = array();
        while($row5 = mysqli_fetch_array($listaMateriasCursos)){
            array_push($listaResultadoMC, $row5);
        }
        $_SESSION["listarMaterias"] = $listaResultado;
        $_SESSION["listarMateriasGrado"] = $listaResultadoMG;
        $_SESSION["listarMateriasTCiclo"] = $listaResultadoMTC;
        $_SESSION["listarMateriasMaster"] = $listaResultadoMM;
        $_SESSION["listarMateriasPost"] = $listaResultadoMPG;
        $_SESSION["listarMateriasCursos"] = $listaResultadoMC;

        require_once("View/Materia/listarMateriasAdmin.php");

        break;

//buscar materia
    case 'buscarMateria':
        $buscar= $_POST['textoBusqueda'];

        $Materia = new Materia("","","","","","","","","");
        $consultarMateria = $Materia->BuscarMateria($buscar);

        if(!empty($consultarMateria)){
            $listaResultado = array();
            while($row = mysqli_fetch_array($consultarMateria)){
                array_push($listaResultado, $row);
            }
            $_SESSION["listarBusqueda"] = $listaResultado;

            $tipou=$_SESSION["TipoUsuario"];
            if($tipou == 'U'){
                require_once "View/Materia/buscarMateria.php";
            }else{
                require_once "View/Materia/BuscarMateriaAdmin.php";
            }

        }else{
            echo 'ERROR: no se encontro ningun resultado';
        }
        break;

//borrar materia
    case 'borrarMateria':
        $CodigoM=$_REQUEST["CodigoM"];
        $Materia = new Materia("","","","","","","","","");
        $Materia->BorrarMateria($CodigoM);
        $tipou=$_SESSION["TipoUsuario"];

        if($tipou == 'U'){
            header("Location: index.php?controlador=Materias&evento=listarMaterias&LoginU=$loginU");
        }else{
            header("Location: index.php?controlador=Materias&evento=listarMateriasAdmin");
        }
        break;


  default:

    echo "ACCION NO REGISTRADA";
    break;
}

?>
