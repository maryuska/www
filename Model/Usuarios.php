<?php
if(!isset($_SESSION))
    session_start();

require_once 'Validacion.php';
require_once 'Universidad.php';
require_once 'TituloAcademico.php';

class Usuarios{
  private $LoginU;
  private $PasswordU;
  private $NombreU;
  private $ApellidosU;
    private $Telefono;
    private $Mail;
    private $DNI;
    private $FechaNacimiento;
    private $TipoContrato;
    private $Centro;
    private $Departamento;
    private $TipoUsuario;

//constructor de usuario
  public function __construct($LoginU = NULL, $PasswordU = NULL, $NombreU = NULL, $ApellidosU = NULL, $Telefono = NULL, $Mail = NULL, $DNI = NULL, $FechaNacimiento = NULL, $TipoContrato = NULL, $Centro = NULL, $Departamento = NULL ,$TipoUsuario = NULL){
    $this->LoginU = $LoginU;
    $this->PasswordU = $PasswordU;
    $this->NombreU = $NombreU;
    $this->ApellidosU = $ApellidosU;
    $this->Telefono = $Telefono;
    $this->Mail = $Mail;
    $this->DNI = $DNI;
    $this->FechaNacimiento = $FechaNacimiento;
    $this->TipoContrato = $TipoContrato;
    $this->Centro = $Centro;
    $this->Departamento= $Departamento;
    $this->TipoUsuario= $TipoUsuario;
  }

//Función para conectarnos a la Base de datos
    function ConectarBD()
    {
        $this->mysqli = new mysqli("localhost", "docente", "docente", "datos_curriculares");

        if ($this->mysqli->connect_errno) {
            echo "Fallo al conectar a MySQL: (" . $this->mysqli->connect_errno . ") " . $this->mysqli->connect_error;
        }
    }

//registrar un usuario
  public function altaUsuario() {
//objetual mysqli
      $this->ConectarBD();
       $insertarUsuario  = "INSERT INTO usuario(LoginU,PasswordU, NombreU, ApellidosU, Telefono, Mail, DNI, FechaNacimiento, TipoContrato,Centro, Departamento, TipoUsuario)
                          VALUES ('$this->LoginU', MD5('$this->PasswordU'), '$this->NombreU', '$this->ApellidosU',  '$this->Telefono', '$this->Mail', '$this->DNI', '$this->FechaNacimiento','$this->TipoContrato', '$this->Centro', '$this->Departamento','$this->TipoUsuario')";
		$resultado = $this->mysqli->query($insertarUsuario) or die(mysqli_error($this->mysqli));

  }

//loguear un usuario

   public function login(){

       $this->ConectarBD();
       $loginUsuario = "SELECT * FROM usuario WHERE LoginU = '$this->LoginU' AND PasswordU = MD5('$this->PasswordU')";
       $loginUsuario = $this->mysqli->query($loginUsuario) or die(mysqli_error($this->mysqli));
       if (isset($loginUsuario)){
           $row=mysqli_fetch_assoc ($loginUsuario);
           $_SESSION["loginU"] = $row['LoginU'] ;
           $_SESSION["Usuario"] = $row['NombreU'] ;
           $_SESSION["TipoUsuario"] = $row['TipoUsuario'] ;
        }
    }
//consultar un usuario
    public function consultarUsuario($Login){
        $this->ConectarBD();
        $sql = $this->mysqli->query("SELECT * FROM usuario WHERE LoginU = '$Login'") or die( mysqli_error($this->mysqli));
        return $sql;
    }
//consultar las universidades en las que trabajo un usuario
    public function ConsultarUniversidades($Login){
        $this->ConectarBD();
        $sql = $this->mysqli->query("SELECT * FROM usuario u, universidad uni WHERE u.LoginU = '$Login' AND uni.LoginU= u.LoginU") or die(mysqli_error($this->mysqli));
        return $sql;
    }
//consultar los titulos de un usuario
    public function ConsultarTitulos($Login){
        $this->ConectarBD();
        $sql = $this->mysqli->query("SELECT t.NombreTitulo, t.FechaTitulo, t.CentroTitulo FROM usuario u, titulo_academico t WHERE u.LoginU = '$Login' AND t.LoginU= u.LoginU") or die(mysqli_error($this->mysqli));
        return $sql;
    }

//modificar el perfil de un usuario
    public function ModificarUsuario($LoginU){
        $this->ConectarBD();
        $this->mysqli->query("UPDATE usuario SET   NombreU='$this->NombreU', 
                                                   ApellidosU='$this->ApellidosU',
                                                   Telefono='$this->Telefono',
                                                   Mail='$this->Mail' ,
                                                   DNI='$this->DNI',
                                                   FechaNacimiento='$this->FechaNacimiento',
                                                   TipoContrato='$this->TipoContrato', 
                                                   Centro='$this->Centro',
                                                   Departamento='$this->Departamento' 
                            where LoginU = '$LoginU'") or die (mysqli_error($this->mysqli));
    }

 //listar usuarios
    public function ListarUsuarios(){
        $this->ConectarBD();
      $sql = $this->mysqli->query("SELECT * FROM usuario WHERE TipoUsuario='U'") or die (mysqli_error($this->mysqli));
      return $sql;
    }




//eliminis usuario
public function BorrarUsuario($Login){
    $this->ConectarBD();
    $this->mysqli->query("DELETE FROM usuario WHERE LoginU= '$Login'")or die(mysqli_error($this->mysqli));
}



//buscar usuario
public function BuscarUsuario($buscar){
    $this->ConectarBD();
    $sql = $this->mysqli->query("SELECT * FROM usuario WHERE LoginU LIKE '%$buscar' || LoginU LIKE '%$buscar%' || LoginU LIKE '$buscar%' ||
                                                            NombreU LIKE '%$buscar'|| NombreU LIKE '%$buscar%' || NombreU LIKE '$buscar%' ||
                                                            ApellidosU LIKE '%$buscar'|| ApellidosU LIKE '%$buscar%' || ApellidosU LIKE '$buscar%' ||
                                                            Telefono LIKE '%$buscar'|| Telefono LIKE '%$buscar%' || Telefono LIKE '$buscar%' ||
                                                            Mail LIKE '%$buscar'|| Mail LIKE '%$buscar%' || Mail LIKE '$buscar%' ||
                                                            DNI LIKE '%$buscar'|| DNI LIKE '%$buscar%' || DNI LIKE '$buscar%' ||
                                                            TipoContrato LIKE '%$buscar'|| TipoContrato LIKE '%$buscar%' || TipoContrato LIKE '$buscar%' ||
                                                            Centro LIKE '%$buscar'|| Centro LIKE '%$buscar%' || Centro LIKE '$buscar%' ||
                                                            Departamento LIKE '%$buscar'|| Departamento LIKE '%$buscar%' || Departamento LIKE '$buscar%' 
                                                            ") or die(mysqli_error($this->mysqli));
    return $sql;
}


    /**
     * Valida si los campos del formulario del perfil son correctos
     * 
     * @param array $campos del formulario
     * @return array $errores, contiene los campos fallidos $errores[] = nombre del campo
     */
    public function validarPerfil($campos){

        $errores    = array();
        $validar    = new Validacion();

        // Nombre
        if(isset($campos["NombreU"]) && !$validar->validarSoloLetras($campos["NombreU"]))
            $errores[]  = "NombreU";

        // Apellidos
        if(isset($campos["ApellidosU"]) && !$validar->validarSoloLetras($campos["ApellidosU"]))
            $errores[]  = "ApellidosU";

        // Telefono
        if(isset($campos["Telefono"]) && !$validar->validarTelefono($campos["Telefono"]))
            $errores[]  = "Telefono";

        // Email
        if(isset($campos["Mail"]) && !$validar->validarEmail($campos["Mail"]))
            $errores[]  = "Mail";

        // Dni
        if(isset($campos["DNI"]) && !$validar->validarDni($campos["DNI"]))
            $errores[]  = "DNI";

        // Fecha Nacimiento
        if(isset($campos["FechaNacimiento"]) && ( !$validar->validarFecha($campos["FechaNacimiento"]) || (date("Y-m-d", strtotime($campos["FechaNacimiento"])) >= date("Y-m-d")) ) )
            $errores[]  = "FechaNacimiento";       

        // Tipo de contrato
        if(isset($campos["TipoContrato"]) && !$validar->validarLetrasYNumeros($campos["TipoContrato"]))
            $errores[]  = "TipoContrato";

        // Centro
        if(isset($campos["Centro"]) && !$validar->validarLetrasYNumeros($campos["Centro"]))
            $errores[]  = "Centro";

        // Departamento
        if(isset($campos["Departamento"]) && !$validar->validarLetrasYNumeros($campos["Departamento"]))
            $errores[]  = "Departamento";

        return $errores;
    }

    /**
     * Valida si los campos del formulario registrar usuario son correctos
     * 
     * @param array $campos del formulario
     * @return array $errores, contiene los campos fallidos $errores[] = nombre del campo
     */
    public function validarRegistrarUsuario($campos){

        $errores    = array();
        $validar    = new Validacion();

        // Login obligatorio
        if(!isset($campos["Login"]) || !$validar->validarLetrasYNumeros($campos["Login"]))
            $errores[]      = "Login";

        // Password obligatorio
        if(!isset($campos["PasswordU"]) || !$validar->validarLetrasYNumeros($campos["PasswordU"])){
            $errores[]      = "PasswordU";
            $errores[]      = "PasswordU2";
        }
        elseif(!isset($campos["PasswordU2"]) || $campos["PasswordU"] != $campos["PasswordU2"])
            $errores[]      = "PasswordU2";

        // Datos referentes al perfil, combina el array procedente de la función con el actual de errores
        $errores            = array_merge($errores, $this->validarPerfil($campos));

        // Datos referentes a la universidad, combina el array procedente de la función con el actual de errores
        $universidad        = new Universidad();
        $errores            = array_merge($errores, $universidad->validarUniversidad($campos));

        // Datos referentes al titulo académico, combina el array procedente de la función con el actual de errores
        $tituloAcademico    = new TituloAcademico();
        $errores            = array_merge($errores, $tituloAcademico->validarTituloAcademico($campos));

        return $errores;

    }
    
}

?>
