<?php
// Controlador de Materias

require_once '../Model/Materia.php';
$evento = $_REQUEST['evento'];

switch ($evento) {

    case 'altaMateria':
        $loginU=$_POST["LoginU"];
        $materia = new Materia($_POST["CodigoM"],$_POST["TipoM"],$_POST["TipoParticipacionM"],$_POST["DenominacionM"],$_POST["TitulacionM"],$_POST["AnhoAcademicoM"],$_POST["CreditosM"],$_POST["CuatrimestreM"],$_POST["LoginU"]);
        $materia->AltaMateria();
        header("location: MateriasController.php?evento=listarMaterias&LoginU=$loginU");

    break;


    case 'consultarMateria':

        $materia = new Materia("","","","","","","","","");
        $CodigoM = $_REQUEST['CodigoM'];
        $consultaM = $materia->ConsultarMateria($CodigoM);
        $consulta = array();
        while($row1 = mysql_fetch_array($consultaM)){
            array_push($consulta, $row1);
        }
        $_SESSION["consultarMateria"] = $consulta;

        header("location: ../../View/Materia/modificarMateria.php");

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
        $materia->ModificarMateria($CodigoM);

        header("location: MateriasController.php?evento=listarMaterias&LoginU=$loginU");

    break;


    case 'listarMaterias':

        $LoginU = $_REQUEST['LoginU'];
        $lista = new Materia("","","","","","","","","");

        //todas las materias
        $listaMaterias= $lista->ListarMaterias($LoginU);
        $listaResultado = array();
        while($row = mysql_fetch_array($listaMaterias)){
            array_push($listaResultado, $row);
        }
        //materias grado
        $listaMateriasGrado = $lista->ListarMateriasGrado($LoginU);
        $listaResultadoMG = array();
        while($row1 = mysql_fetch_array($listaMateriasGrado)){
            array_push($listaResultadoMG, $row1);
        }
        //materias tercer ciclo
        $listaMateriasTCiclo = $lista->ListarMateriasTCiclo($LoginU);
        $listaResultadoMTC = array();
        while($row2 = mysql_fetch_array($listaMateriasTCiclo)){
            array_push($listaResultadoMTC, $row2);
        }
        //materias master
        $listaMateriasMaster = $lista->ListarMateriasMaster($LoginU);
        $listaResultadoMM = array();
        while($row3 = mysql_fetch_array($listaMateriasMaster)){
            array_push($listaResultadoMM, $row3);
        }
        //materias post grado
        $listaMateriasPostG = $lista->ListarMateriasPost($LoginU);
        $listaResultadoMPG = array();
        while($row4 = mysql_fetch_array($listaMateriasPostG)){
            array_push($listaResultadoMPG, $row4);
        }
        //materias cursos
        $listaMateriasCursos = $lista->ListarMateriasCursos($LoginU);
        $listaResultadoMC = array();
        while($row5 = mysql_fetch_array($listaMateriasCursos)){
            array_push($listaResultadoMC, $row5);
        }
        $_SESSION["listarMaterias"] = $listaResultado;
        $_SESSION["listarMateriasGrado"] = $listaResultadoMG;
        $_SESSION["listarMateriasTCiclo"] = $listaResultadoMTC;
        $_SESSION["listarMateriasMaster"] = $listaResultadoMM;
        $_SESSION["listarMateriasPost"] = $listaResultadoMPG;
        $_SESSION["listarMateriasCursos"] = $listaResultadoMC;

        header("location: ../../View/Materia/listarMaterias.php");

    break;







  default:

    echo "ACCION NO REGISTRADA";
    break;
}

?>
