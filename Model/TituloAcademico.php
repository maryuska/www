<?php

require_once 'ConnectDB.php';

class TituloAcademico
{

    private $LoginU;
    private $NombreTitulo;
    private $FechaTitulo;
    private $CentroTitulo;


    function __construct($LoginU = NULL, $NombreTitulo = NULL, $FechaTitulo = NULL, $CentroTitulo = NULL)
    {
        $this->LoginU = $LoginU;
        $this->NombreTitulo = $NombreTitulo;
        $this->FechaTitulo = $FechaTitulo;
        $this->CentroTitulo = $CentroTitulo;
    }
    // Crea un titulo asociado a un usuario en la bd
    // Devuelve true o false segun se cree exitosamente o no
    public function AltaTituloAcademico()
    {
        $insertarTituloAcademico = "INSERT INTO titulo_academico (LoginU, NombreTitulo, FechaTitulo, CentroTitulo)
    VALUES ('$this->LoginU','$this->NombreTitulo','$this->FechaTitulo','$this->CentroTitulo')";

        $resultado = mysql_query($insertarTituloAcademico) or die(mysql_error());
    }
    //lista todos las titulosAcademicos del usuario

    public function ListarTitulosAcademicos($LoginU)
    {
        $sql = mysql_query("SELECT * FROM titulo_academico WHERE LoginU = '$LoginU' ORDER BY FechaTitulo DESC ") or die(mysql_error());
        return $sql;
    }
    public function ConsultaTituloAcademico($LoginU,$NombreTitulo)
    {
        $sql = mysql_query("SELECT * FROM titulo_academico WHERE LoginU = '$LoginU' AND NombreTitulo=  '$NombreTitulo'") or die(mysql_error());
        return $sql;
    }

    public function ModificarTituloAcademico($LoginU, $NombreTitulo){
        $sql = mysql_query("UPDATE titulo_academico SET NombreTitulo='$this->NombreTitulo',FechaTitulo='$this->FechaTitulo',CentroTitulo='$this->CentroTitulo'
				WHERE LoginU = '$LoginU' AND NombreTitulo = '$NombreTitulo'")
        or die(mysql_error());

    }
    //borrar titulos academicos de un usuario
    public function BorrarTitulosUsuario($Login){
        mysql_query("DELETE FROM titulo_academico WHERE LoginU= '$Login'")or die(mysql_error());
    }

}