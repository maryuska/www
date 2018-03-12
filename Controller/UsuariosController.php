<?php
// Controlador de Usuarios

require_once '../Model/Usuarios.php';
require_once '../Model/Universidad.php';
require_once '../Model/TituloAcademico.php';
$evento = $_REQUEST['evento'];

switch ($evento) {
/*
  case 'registrarUsuario':
      if ($_POST["PasswordU"]!==$_POST["PasswordU2"]) {
      header("location: ../../View/errores.php?PassErr");
    }


       $usuario = new Usuarios ($_POST["Login"], $_POST["PasswordU"], $_POST["NombreU"],$_POST["ApellidosU"],$_POST["UniversidadU"],$_POST["Login"],$_POST["Titulo"], $_POST["TipoContrato"],$_POST["Centro"],$_POST["Departamento"]);
       $usuario->altaUsuario();

      header("location: ../../View/home.php");
    break;
*/
    case 'registrarUsuario':

        if ($_POST["PasswordU"]!==$_POST["PasswordU2"]) {
            header("location: ../../View/errores.php?PassErr");
        }
        $usuario = new Usuarios ($_POST["Login"], $_POST["PasswordU"], $_POST["NombreU"],$_POST["ApellidosU"], $_POST["TipoContrato"],$_POST["Centro"],$_POST["Departamento"]);

        //registra el usuario en la bd

        //recoge los datos universitarios  y de titulodel formulario
        $universidad= new Universidad($_POST["Login"],$_POST["NombreUniversidad"],$_POST["FechaInicio"],$_POST["FechaFin"]);
        $tituloAcademico= new TituloAcademico($_POST["Login"],$_POST["Titulo"],$_POST["FechaTitulo"],$_POST["CentroTitulo"]);

        //añade datos universitarios y titulo al usuario
        $universidad->AltaUniversidad();
        $tituloAcademico->AltaTituloAcademico();
        $usuario->altaUsuario();

      header("location: ../../View/home.php");
    break;

    case 'logOut':

          session_unset();
          session_destroy();

          header("location:../../View/home.php");
      break;

  case 'Login':
     $LoginU= $_POST["LoginU"];
     $PasswordU= $_POST["PasswordU"];
    $usuario = new Usuarios( $LoginU,$PasswordU,"","","","","","","");
     $usuario->login();

    if (isset( $_SESSION["Usuario"])) {


        header("location: ../../Controller/UsuariosController.php?evento=ConsultarUsuario&LoginU=$LoginU");
    } else {

        header("location: ../../View/home.php");
    }


      break;


    case 'ConsultarUsuario':

        //conuslta datos del usuario
        $Login=$_REQUEST["LoginU"];
        $Usuario = new Usuarios("","","","","","","","","");
        $consultarUsuario = $Usuario->consultarUsuario($Login);

        $consulta = array();
        while($row = mysql_fetch_array($consultarUsuario)){
            array_push($consulta, $row);
        }

        //lista datos universidades del usuario

        $consultarUniversidad = $Usuario->ConsultarUniversidades($Login);

        $consultaUA = array();
        while($row2 = mysql_fetch_array($consultarUsuarioUniversidad)){
            array_push($consultaUA, $row2);
        }


		//lista datos de titulos del usuario
        $consultarTitulo = $Usuario->ConsultarTitulos($Login);

        $consultaUT = array();
        while($row3 = mysql_fetch_array($consultarTitulo)){
            array_push($consultaUT, $row3);
        }

        $_SESSION["ConsultarU"] = $consulta;
		$_SESSION["ConsultaUA"] = $consultaUA;
        $_SESSION["ConsultaUT"] = $consultaUT;


		header("location: ../../View/Usuario/consultarUsuario.php");
    break;



    case 'ListarUsuarios':

        $lista = new Usuarios("","","","","","","","","");
        $lista->ListarUsuarios();
        header("location: ../../View/Usuario/listarUsuario.php");
        break;


    case 'ModificarUsuario':

        $CodigoPro = $_POST['CodigoPro'];
        $NombrePro = $_POST['NombrePro'];
        $DireccionPro = $_POST['DireccionPro'];
        $AlmacenServicio = $_POST['AlmacenServicio'];
        $FamiliaPro = $_POST['FamiliaPro'];
        $TelefonoDelegacion = $_POST['TelefonoDelegacion'];


        $proveedor = new Proveedor($CodigoPro, $NombrePro, $DireccionPro, $AlmacenServicio, $FamiliaPro, $TelefonoDelegacion);
        $proveedor->modificarProveedor($CodigoPro);

        header("location: ProveedorController.php?evento=ListarProveedores");

        break;


    //sin verificar
    //

/*
  case 'modificarDocente':
      $Login=$_SESSION["loginU"];
      $Usuario = new Usuarios($Login,$_POST["PasswordU"],$_POST["NombreU"],$_POST["ApellidosU"],$_POST["UniversidadU"],"Docente");
      $Titulo=$_POST["Titulo"];
      $TipoContrato=$_POST["TipoContrato"];
      $Centro=$_POST["Centro"];
      $Departamento=$_POST["Departamento"];

      $Usuario->ModificarDocente();


      header("location: DocenteController.php?evento=modificarDocente&Login=$Login&Titulo=$Titulo&TipoContrato=$TipoContrato&Centro=$Centro&Departamento=$Departamento");

    break;

  case 'listarDocente':
      $Usuario = new Usuarios($_SESSION["loginU"],"","","","","Docente");
      $Usuario->listarDocente();

      header("location: DocenteController.php?evento=listarDocente");
      break;

*/



  default:
    # code...
    echo "ACCION NO REGISTRADA";
    break;
}

?>
