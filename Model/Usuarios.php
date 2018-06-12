<?php
session_start();
require_once 'ConnectDB.php';

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
//regustrar un usuario
  public function altaUsuario() {


    $insertarUsuario  = "INSERT INTO usuario(LoginU,PasswordU, NombreU, ApellidosU, Telefono, Mail, DNI, FechaNacimiento, TipoContrato,Centro, Departamento, TipoUsuario)
                          VALUES ('$this->LoginU', '$this->PasswordU', '$this->NombreU', '$this->ApellidosU',  '$this->Telefono', '$this->Mail', '$this->DNI', '$this->FechaNacimiento','$this->TipoContrato', '$this->Centro', '$this->Departamento','$this->TipoUsuario')";
		$resultado = mysql_query( $insertarUsuario) or die(mysql_error());
  }

//loguear un usuario

   public function login(){


       $loginUsuario = "SELECT * FROM usuario WHERE LoginU = '$this->LoginU' AND PasswordU = '$this->PasswordU'";
       $loginUsuario = mysql_query($loginUsuario) or die(mysql_error());
       if (isset($loginUsuario)){
           $row=mysql_fetch_assoc ($loginUsuario);
           $_SESSION["loginU"] = $row['LoginU'] ;
           $_SESSION["Usuario"] = $row['NombreU'] ;
           $_SESSION["TipoUsuario"] = $row['TipoUsuario'] ;
        }
    }
//consultar un usuario
    public function consultarUsuario($Login){
        $sql = mysql_query("SELECT * FROM usuario WHERE LoginU = '$Login'") or die(mysql_error());
        return $sql;
    }
//consultar las universidades en las que trabajo un usuario
    public function ConsultarUniversidades($Login){
        $sql = mysql_query("SELECT * FROM usuario u, universidad uni WHERE u.LoginU = '$Login' AND uni.LoginU= u.LoginU") or die(mysql_error());
        return $sql;
    }
//consultar los titulos de un usuario
    public function ConsultarTitulos($Login){
        $sql = mysql_query("SELECT t.NombreTitulo, t.FechaTitulo, t.CentroTitulo FROM usuario u, titulo_academico t WHERE u.LoginU = '$Login' AND t.LoginU= u.LoginU") or die(mysql_error());
        return $sql;
    }

//modificar el perfil de un usuario
    public function ModificarUsuario($LoginU){
        mysql_query("UPDATE usuario SET   LoginU='$this->LoginU', ApellidosU='$this->ApellidosU',Telefono='$this->Telefono',Mail='$this->Mail' ,
                      DNI='$this->DNI',FechaNacimiento='$this->FechaNacimiento',TipoContrato='$this->TipoContrato', Centro='$this->Centro', Departamento='$this->Departamento'  where LoginU = '$LoginU'") or die (mysql_error());
    }

 //listar usuarios
    public function ListarUsuarios(){
      $sql = mysql_query("SELECT * FROM usuario WHERE TipoUsuario='U'") or die (msql_error());
      return $sql;
    }




//eliminis usuario
public function BorrarUsuario($Login){
      mysql_query("DELETE FROM usuario WHERE LoginU= '$Login'")or die(mysql_error());
}















  // sin modificar
//Consulta los datos de un usuario
// Devuelve los datos de un usuario



  public function listarDocente(){
    $sql= mysqli_query("SELECT * FROM usuario WHERE TipoU='$this->TipoU'");

    $sql2 = array();
    while($row = mysqli_fetch_array($sql)){array_push($sql2, $row);}
    $_SESSION["listarDocente"] = $sql2;

  }


}

?>
