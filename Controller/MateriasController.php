<?php
// Controlador de Proyectos Dirigidos

require_once '../Model/Materia.php';
$evento = $_REQUEST['evento'];

switch ($evento) {

    case 'altaMateria':

        $materia = new Materia($_POST["CodigoM"],$_POST["TipoM"],$_POST["TipoParticipacionM"],$_POST["DenominacionM"],$_POST["TitulacionM"],$_POST["AnhoAcademicoM"],$_POST["CreditosM"],$_POST["CuatrimestreM"],$_POST["LoginU"]);
        $materia->AltaMateria();
        header("location: MateriasController.php?evento=listarMaterias");

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

        header("location: MateriasController.php?evento=listarMaterias");

    break;


    case 'listarMaterias':
        $lista = new Materia("","","","","","","","","");
        //todas las materias
        $listaMaterias= $lista->ListarMaterias();
        $listaResultado = array();
        while($row = mysql_fetch_array($listaMaterias)){
            array_push($listaResultado, $row);
        }

        $_SESSION["listarMaterias"] = $listaResultado;
        header("location: ../../View/Materia/listarMaterias.php");

    break;







  default:

    echo "ACCION NO REGISTRADA";
    break;
}

?>
