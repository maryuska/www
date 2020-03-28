<?php
if(!isset($_SESSION))
    session_start();

require_once 'Validacion.php';


class ProyectosDirigidos{

  private $CodigoPD;
  private $TituloPD;
  private $AlumnoPD;
  private $FechaLecturaPD;
  private $CalificacionPD;
  private $URLPD;
  private $CotutorPD;
  private $TipoPD;
  private $AdjuntoPD;

//constructor de proyectos dirigidos
  public function __construct($CodigoPD = NULL, $TituloPD = NULL, $AlumnoPD = NULL, $FechaLecturaPD = NULL, $CalificacionPD = NULL, $URLPD = NULL, $CotutorPD = NULL, $TipoPD = NULL, $AdjuntoPD = NULL ){
    $this->CodigoPD = $CodigoPD;
    $this->TituloPD = $TituloPD;
    $this->AlumnoPD = $AlumnoPD;
    $this->FechaLecturaPD = $FechaLecturaPD;
    $this->CalificacionPD = $CalificacionPD;
    $this->URLPD = $URLPD;
    $this->CotutorPD = $CotutorPD;
    $this->TipoPD = $TipoPD;
    $this->AdjuntoPD = $AdjuntoPD;
  }

//Función para conectarnos a la Base de datos
    function ConectarBD()
    {
        $this->mysqli = new mysqli("localhost", "docente", "docente", "datos_curriculares");

        if ($this->mysqli->connect_errno) {
            echo "Fallo al conectar a MySQL: (" . $this->mysqli->connect_errno . ") " . $this->mysqli->connect_error;
        }
    }

// Set adjunto
    public function setAdjunto($AdjuntoPD){
        $this->AdjuntoPD = $AdjuntoPD;
    }

//Alta de un nuevo proyecto dirigido
  public function AltaProyectoDirigido() {
      $this->ConectarBD();
    $insertarProyectoDirigido  = "INSERT INTO proyectoDirigido(CodigoPD,TituloPD, AlumnoPD, FechaLecturaPD, CalificacionPD,URLPD, CotutorPD, TipoPD, AdjuntoPD)
                          VALUES ('$this->CodigoPD', '$this->TituloPD', '$this->AlumnoPD', '$this->FechaLecturaPD','$this->CalificacionPD','$this->URLPD', '$this->CotutorPD', '$this->TipoPD', '$this->AdjuntoPD')";
	$resultado = $this->mysqli->query($insertarProyectoDirigido) or die(mysqli_error($this->mysqli));
	}

//Alta de un usuario dirige un proyecto dirigido
  public function Dirige($CodigoPD,$Login){
      $this->ConectarBD();
        $dirigir = "INSERT INTO docente_proyectodirigido (CodigoPD, LoginU)
			VALUES ('$CodigoPD','$Login')";
        $resultado = $this->mysqli->query($dirigir) or die(mysqli_error($this->mysqli));
    }

//Consultar un proyecto dirigido
    public function ConsultarProyectoDirigido($CodigoP){
        $this->ConectarBD();
        $sql= $this->mysqli->query("SELECT * FROM proyectoDirigido p, docente_proyectodirigido dp WHERE p.CodigoPD=dp.CodigoPD AND p.CodigoPD = '$CodigoP'");
        return $sql;
    }
	
//Consultar quien dirige un proyecto
public function ConsultarDirige($CodigoPD){
      $this->ConectarBD();
      $sql=$this->mysqli->query("SELECT * FROM docente_proyectoDirigido WHERE CodigoPD= '$CodigoPD'");
      return $sql;
}

//Modificar un proyecto dirigido
    public function ModificarProyectoDirigido($CodigoPD){
        $this->ConectarBD();
        $this->mysqli->query("UPDATE proyectoDirigido SET   TituloPD='$this->TituloPD',
                                                            AlumnoPD='$this->AlumnoPD',
                                                            FechaLecturaPD='$this->FechaLecturaPD' ,
                                                            CalificacionPD='$this->CalificacionPD',
                                                            URLPD='$this->URLPD',
                                                            CotutorPD='$this->CotutorPD',
                                                            TipoPD='$this->TipoPD',
                                                            AdjuntoPD='$this->AdjuntoPD'
                                                            where CodigoPD = '$CodigoPD'") or die (mysqli_error($this->mysqli));
    }

//Lista de todos los proyectos dirigidos del usuario
    public function ListarProyectosDirigidos($Login){
        $this->ConectarBD();
        $sql= $this->mysqli->query("SELECT * FROM proyectoDirigido p, docente_proyectoDirigido dp WHERE p.CodigoPD = dp.CodigoPD  AND dp.LoginU = '$Login'  ORDER BY FechaLecturaPD DESC");
        return $sql;

    }
    
//Lista de todos los proyectos dirigidos del usuario usado para crear el pdf
    public function ListarProyectosDirigidosPDF($loginU, $tipoPD, $fechaDesdePD, $fechaHastaPD){
        $this->ConectarBD();

        $where = "";
        if(!empty($tipoPD)){
            $where .= " AND p.TipoPD = '$tipoPD' ";
        }

        if(!empty($fechaDesdePD) && !empty($fechaHastaPD)){
            $fechaDesdePD = date("Y-m-d", strtotime($fechaDesdePD));
            $fechaHastaPD = date("Y-m-d", strtotime($fechaHastaPD));
            $where .= " AND p.FechaLecturaPD BETWEEN '$fechaDesdePD' AND '$fechaHastaPD'";
        }
        elseif(!empty($fechaDesdePD)){
            $fechaDesdePD = date("Y-m-d", strtotime($fechaDesdePD));
            $where .= " AND p.FechaLecturaPD > '$fechaDesdePD'";
        }
        elseif(!empty($fechaHastaPD)){
            $fechaHastaPD = date("Y-m-d", strtotime($fechaHastaPD));
            $where .= " AND p.FechaLecturaPD < '$fechaHastaPD'";
        }

        $sql= $this->mysqli->query("SELECT * FROM proyectoDirigido p, docente_proyectoDirigido dp WHERE p.CodigoPD = dp.CodigoPD  AND dp.LoginU = '$loginU' " . $where . "  ORDER BY FechaLecturaPD DESC");
        return $sql;
    }

//Lista de todos los proyectos fin de carrera del usuario
    public function ListarProyectosDirigidosPFC($Login){
        $this->ConectarBD();
        $sql= $this->mysqli->query("SELECT * FROM proyectoDirigido p, docente_proyectoDirigido dp WHERE p.CodigoPD = dp.CodigoPD  AND dp.LoginU = '$Login' AND p.TipoPD = 'PFC'ORDER BY FechaLecturaPD DESC");

        return $sql;
    }

//Lista de todos los trabajos fin de grado del usuario
    public function ListarProyectosDirigidosTFG($Login){
        $this->ConectarBD();
        $sql= $this->mysqli->query("SELECT * FROM proyectoDirigido p, docente_proyectoDirigido dp WHERE p.CodigoPD = dp.CodigoPD  AND dp.LoginU = '$Login' AND p.TipoPD = 'TFG' ORDER BY FechaLecturaPD DESC ");

        return $sql;
    }

//Lista de todos los trabajos fin de master del usuario
    public function ListarProyectosDirigidosTFM($Login){
        $this->ConectarBD();
        $sql= $this->mysqli->query("SELECT * FROM proyectoDirigido p, docente_proyectoDirigido dp WHERE p.CodigoPD = dp.CodigoPD  AND dp.LoginU = '$Login'  AND p.TipoPD = 'TFM' ORDER BY FechaLecturaPD DESC ");

        return $sql;
    }

//Lista de todos los proyectos dirigidos como Admin
    public function ListarProyectosDirigidosAdmin(){
        $this->ConectarBD();
        $sql= $this->mysqli->query("SELECT * FROM proyectoDirigido p, docente_proyectoDirigido dp WHERE p.CodigoPd=dp.CodigoPD ORDER BY FechaLecturaPD DESC");
        return $sql;

    }

//Lista de todos los proyectos fin de carrera como Admin
    public function ListarProyectosDirigidosPFCAdmin(){
        $this->ConectarBD();
        $sql= $this->mysqli->query("SELECT * FROM proyectoDirigido p, docente_proyectoDirigido dp WHERE p.CodigoPd=dp.CodigoPD AND TipoPD = 'PFC' ORDER BY FechaLecturaPD DESC");

        return $sql;
    }

//Lista de todos los trabajos fin de grado como Admin
    public function ListarProyectosDirigidosTFGAdmin(){
        $this->ConectarBD();
        $sql= $this->mysqli->query("SELECT * FROM proyectoDirigido p, docente_proyectoDirigido dp WHERE p.CodigoPd=dp.CodigoPD AND TipoPD = 'TFG'ORDER BY FechaLecturaPD DESC  ");
        return $sql;
    }

//Lista de todos los trabajos fin de master como Admin
    public function ListarProyectosDirigidosTFMAdmin(){
        $this->ConectarBD();
        $sql= $this->mysqli->query("SELECT * FROM proyectoDirigido p, docente_proyectoDirigido dp WHERE p.CodigoPd=dp.CodigoPD AND TipoPD = 'TFM' ORDER BY FechaLecturaPD DESC ");
        return $sql;
    }

//Eliminar un proyecto dirigido
    public function BorrarProyectoDirigido($CodigoPD){
        $this->ConectarBD();

        // Eliminamos el fichero que tuvier adjunto
        $sql = $this->mysqli->query("SELECT AdjuntoPD FROM proyectoDirigido WHERE CodigoPD = '$CodigoPD'");
        if( $sql->num_rows > 0 ){
            $res = mysqli_fetch_array($sql);
            if(!empty($res["AdjuntoPD"]))
                @unlink('Archivos/proyectos_dirigidos/' . $res["AdjuntoPD"]);
        }

        // Eliminamos el registro de BD
        $this->mysqli->query("DELETE FROM proyectoDirigido WHERE CodigoPD = '$CodigoPD'")or die(mysqli_error($this->mysqli));
    }

//Eliminar
    public function BorrarDirige($CodigoPD,$LoginU){
        $this->ConectarBD();
        $this->mysqli->query("DELETE FROM docente_proyectodirigido WHERE CodigoPD = '$CodigoPD' AND LoginU='$LoginU'")or die(mysqli_error($this->mysqli));
    }

//Buscar proyectoDirigido
    public function BuscarProyectoDirigido($buscar){
        $this->ConectarBD();
        $sql = $this->mysqli->query("SELECT * FROM proyectoDirigido WHERE CodigoPD LIKE '%$buscar' || CodigoPD LIKE '%$buscar%' || CodigoPD LIKE '$buscar%' ||
                                                            TituloPD LIKE '%$buscar'|| TituloPD LIKE '%$buscar%' || TituloPD LIKE '$buscar%' ||
                                                            AlumnoPD LIKE '%$buscar'|| AlumnoPD LIKE '%$buscar%' || AlumnoPD LIKE '$buscar%' ||
                                                            FechaLecturaPD LIKE '%$buscar'|| FechaLecturaPD LIKE '%$buscar%' || FechaLecturaPD LIKE '$buscar%' ||
                                                            CalificacionPD LIKE '%$buscar'|| CalificacionPD LIKE '%$buscar%' || CalificacionPD LIKE '$buscar%' ||
                                                            URLPD LIKE '%$buscar'|| URLPD LIKE '%$buscar%' || URLPD LIKE '$buscar%' ||
                                                            CotutorPD LIKE '%$buscar'|| CotutorPD LIKE '%$buscar%' || CotutorPD LIKE '$buscar%' ||
                                                            TipoPD LIKE '%$buscar'|| TipoPD LIKE '%$buscar%' || TipoPD LIKE '$buscar%' 
                                                            ") or die(mysqli_error($this->mysqli));
        return $sql;
    }

    /**
     * Valida si los campos del formulario de una materia son correctos
     *
     * @param array $campos del formulario
     * @return array $errores, contiene los campos fallidos $errores[] = nombre del campo
     */
    public function validarProyectoDirigido($campos){

        $errores    = array();
        $validar    = new Validacion();

        // Login
        if(empty($campos["LoginU"]))
            $errores[]  = "LoginU";
        
        // Codigo Proyecto dirigido
        if(isset($campos["CodigoPD"]) && !$validar->validarLetrasYNumeros($campos["CodigoPD"]))
            $errores[]  = "CodigoPD";

        // titulo Proyecto dirigido
        if(isset($campos["TituloPD"]) && !$validar->validarLetrasYNumeros($campos["TituloPD"]))
            $errores[]  = "TituloPD";

        // alumno proyecto dirigido
        if(isset($campos["AlumnoPD"]) && !$validar->validarSoloLetras($campos["AlumnoPD"]))
            $errores[]  = "AlumnoPD";

        // Fecha lectura
        if(isset($campos["FechaLecturaPD"]) && ( !$validar->validarFecha($campos["FechaLecturaPD"]) || (date("Y-m-d", strtotime($campos["FechaLecturaPD"])) >= date("Y-m-d")) ) )
            $errores[]  = "FechaLecturaPD";

        // url
        if(isset($campos["URLPD"]) && !$validar->validarLetrasYNumeros($campos["URLPD"]))
            $errores[]  = "URLPD";

        //cotutor
        if(isset($campos["CotutorPD"]) && !$validar->validarSoloLetras($campos["CotutorPD"]))
            $errores[]  = "CotutorPD";

        //Tipo proyecto
        if(isset($campos["TipoPD"]) && !$validar->validarSoloLetras($campos["TipoPD"]))
            $errores[]  = "TipoPD";

        return $errores;
    }

}

?>
