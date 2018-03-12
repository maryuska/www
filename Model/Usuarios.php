<?php
session_start();

require_once 'ConnectDB.php';

class Usuarios{

  private $LoginU;
  private $PasswordU;
  private $NombreU;
  private $ApellidosU;
    private $TipoContrato;
    private $Centro;
    private $Departamento;


  public function __construct($LoginU = NULL, $PasswordU = NULL, $NombreU = NULL, $ApellidosU = NULL, $TipoContrato = NULL, $Centro = NULL, $Departamento = NULL ){
    $this->LoginU = $LoginU;
    $this->PasswordU = $PasswordU;
    $this->NombreU = $NombreU;
    $this->ApellidosU = $ApellidosU;
      $this->TipoContrato = $TipoContrato;
      $this->Centro = $Centro;
      $this->Departamento= $Departamento;
  }

  public function altaUsuario() {
    $insertarUsuario  = "INSERT INTO usuario(LoginU,PasswordU, NombreU, ApellidosU, TipoContrato,Centro, Departamento)
                          VALUES ('$this->LoginU', '$this->PasswordU', '$this->NombreU', '$this->ApellidosU','$this->TipoContrato', '$this->Centro', '$this->Departamento')";
		$resultado = mysql_query($insertarUsuario) or die(mysql_error());
  }




  public function login(){
    $loginUsuario = "SELECT * FROM usuario WHERE LoginU = '$this->LoginU' AND PasswordU = '$this->PasswordU'";
    $loginUsuario = mysql_query($loginUsuario) or die(mysql_error());
    if (isset($loginUsuario)){
      $row=mysql_fetch_assoc ($loginUsuario);

        $_SESSION["loginU"] = $row['LoginU'] ;
        $_SESSION["Usuario"] = $row['NombreU'] ;

    }
  }

public function consultarUsuario($Login){
        $sql = mysql_query("SELECT * FROM usuario WHERE LoginU = '$Login'") or die(mysql_error());
        return $sql;
    }

    public function ConsultarUniversidades($Login){
        $sql = mysql_query("SELECT uni.NombreUniversidad, uni.FechaInicio, uni.FechaFin FROM usuario u, universidad uni WHERE u.LoginU = '$Login' AND uni.LoginU= u.LoginU") or die(mysql_error());
        return $sql;
    }

    public function ConsultarTitulos($Login){
        $sql = mysql_query("SELECT t.NombreTitulo, t.FechaTitulo, t.CentroTitulo FROM usuario u, titulo_academico t WHERE u.LoginU = '$Login' AND t.LoginU= u.LoginU") or die(mysql_error());
        return $sql;
    }























  // sin modificar
//Consulta los datos de un usuario
// Devuelve los datos de un usuario


  public function modificarUsuario(){
    $_SESSION["loginU"]=$this->LoginU;
    $sql= mysql_query("UPDATE usuario SET PasswordU='$this->PasswordU',NombreU='$this->NombreU' ,ApellidosU='$this->ApellidosU',UniversidadU='$this->UniversidadU', WHERE LoginU='$this->LoginU'") or die (mysql_error());


  }

  public function listarDocente(){
    $sql= mysql_query("SELECT * FROM usuario WHERE TipoU='$this->TipoU'");

    $sql2 = array();
    while($row = mysql_fetch_array($sql)){array_push($sql2, $row);}
    $_SESSION["listarDocente"] = $sql2;

  }


}

?>
