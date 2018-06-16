<?php
session_start();
//require_once 'ConnectDB.php';

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
                          VALUES ('$this->LoginU', '$this->PasswordU', '$this->NombreU', '$this->ApellidosU',  '$this->Telefono', '$this->Mail', '$this->DNI', '$this->FechaNacimiento','$this->TipoContrato', '$this->Centro', '$this->Departamento','$this->TipoUsuario')";
		$resultado = $this->mysqli->query($insertarUsuario) or die(mysqli_error($this->mysqli));

  }

//loguear un usuario

   public function login(){

       $this->ConectarBD();
       $loginUsuario = "SELECT * FROM usuario WHERE LoginU = '$this->LoginU' AND PasswordU = '$this->PasswordU'";
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












}

?>
