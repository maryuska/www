<?php
if(!isset($_SESSION))
    session_start();

require_once 'Validacion.php';


class Proyecto{

    private $CodigoProy;
    private $TituloProy;
    private $EntidadFinanciadora;
    private $AcronimoProy;
    private $AnhoInicioProy;
    private $AnhoFinProy;
    private $Importe;
    private $AdjuntoProy;

//constructor de proyecto
    public function __construct($CodigoProy = NULL, $TituloProy = NULL, $EntidadFinanciadora = NULL, $AcronimoProy = NULL, $AnhoInicioProy = NULL, $AnhoFinProy = NULL, $Importe = NULL ,$AdjuntoProy = NULL){
        $this->CodigoProy = $CodigoProy;
        $this->TituloProy = $TituloProy;
        $this->EntidadFinanciadora = $EntidadFinanciadora;
        $this->AcronimoProy = $AcronimoProy;
        $this->AnhoInicioProy = $AnhoInicioProy;
        $this->AnhoFinProy = $AnhoFinProy;
        $this->Importe= $Importe;
        $this->AdjuntoProy= $AdjuntoProy;
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
    public function setAdjunto($AdjuntoProy){
        $this->AdjuntoProy = $AdjuntoProy;
    }

//Alta de un nuevo proyecto
    public function AltaProyecto() {
        $this->ConectarBD();
        $insertarProyecto  = "INSERT INTO proyecto(CodigoProy,TituloProy, EntidadFinanciadora, AcronimoProy, AnhoInicioProy,AnhoFinProy,Importe, AdjuntoProy)
                          VALUES ('$this->CodigoProy', '$this->TituloProy', '$this->EntidadFinanciadora', '$this->AcronimoProy','$this->AnhoInicioProy','$this->AnhoFinProy','$this->Importe', '$this->AdjuntoProy')";
        $resultado = $this->mysqli->query($insertarProyecto) or die(mysqli_error($this->mysqli));
    }
//Alta de un usuario proyecto
    public function Participa($CodigoProy,$Login,$TipoParticipacionProy){
        $this->ConectarBD();
        $participar = "INSERT INTO docente_proyecto (CodigoProy,LoginU,TipoParticipacionProy)
			VALUES ('$CodigoProy','$Login','$TipoParticipacionProy')";
        $resultado = $this->mysqli->query($participar) or die(mysqli_error($this->mysqli));
    }

//Consultar un proyecto
    public function ConsultarProyecto($CodigoProy){
        $this->ConectarBD();
        $sql= $this->mysqli->query("SELECT * FROM Proyecto p, docente_proyecto dp WHERE p.CodigoProy=dp.CodigoProy AND p.CodigoProy = '$CodigoProy'");
        return $sql;
    }

//Modificar un Proyecto
    public function ModificarProyecto($CodigoProy){
        $this->ConectarBD();
        $this->mysqli->query("UPDATE proyecto p
                                              SET p.TituloProy='$this->TituloProy',
                                                  p.EntidadFinanciadora='$this->EntidadFinanciadora',
                                                  p.AcronimoProy='$this->AcronimoProy' ,
                                                  p.AnhoInicioProy='$this->AnhoInicioProy',
                                                  p.AnhoFinProy='$this->AnhoFinProy',
                                                  p.Importe='$this->Importe',                                
                                                  p.AdjuntoProy='$this->AdjuntoProy'                                     
                                 where p.CodigoProy = '$CodigoProy' ") or die (mysqli_error($this->mysqli));

    }

//Lista de todos los proyecto del usuario
    public function ListarProyectos($Login){
        $this->ConectarBD();
        $sql= $this->mysqli->query("SELECT * FROM proyecto p, docente_proyecto dp WHERE p.CodigoProy = dp.CodigoProy  AND dp.LoginU = '$Login'  ORDER BY p.AnhoInicioProy DESC");
        return $sql;

    }
	
//Lista de todos los proyectos como investigador
    public function ListarProyectosInvestigador($Login){
        $this->ConectarBD();
        $sql= $this->mysqli->query("SELECT * FROM proyecto p, docente_proyecto dp WHERE p.CodigoProy = dp.CodigoProy  AND dp.LoginU = '$Login' AND dp.TipoParticipacionProy = 'Investigador'ORDER BY p.AnhoInicioProy DESC");

        return $sql;
    }
//Lista de todos los proyectos como investigador principal
    public function ListarProyectosInvestigadorPrincipal($Login){
        $this->ConectarBD();
        $sql= $this->mysqli->query("SELECT * FROM proyecto p, docente_proyecto dp WHERE p.CodigoProy = dp.CodigoProy  AND dp.LoginU = '$Login' AND dp.TipoParticipacionProy = 'Investigador Principal'ORDER BY p.AnhoInicioProy DESC");

        return $sql;
    }

//Listas de proyecto con admin
//Lista de todos los proyecto admin
    public function ListarProyectosAdmin(){
        $this->ConectarBD();
        $sql= $this->mysqli->query("SELECT * FROM proyecto p, docente_proyecto dp WHERE p.CodigoProy = dp.CodigoProy    ORDER BY p.AnhoInicioProy DESC");
        return $sql;

    }
	
//Lista de todos los proyectos como investigador como admin
    public function ListarProyectosInvestigadorAdmin(){
        $this->ConectarBD();
        $sql= $this->mysqli->query("SELECT * FROM proyecto p, docente_proyecto dp WHERE p.CodigoProy = dp.CodigoProy   AND dp.TipoParticipacionProy = 'Investigador'ORDER BY p.AnhoInicioProy DESC");

        return $sql;
    }
	
//Lista de todos los proyectos como investigador principal como admin
    public function ListarProyectosInvestigadorPrincipalAdmin(){
        $this->ConectarBD();
        $sql= $this->mysqli->query("SELECT * FROM proyecto p, docente_proyecto dp WHERE p.CodigoProy = dp.CodigoProy  AND dp.TipoParticipacionProy = 'Investigador Principal'ORDER BY p.AnhoInicioProy DESC");

        return $sql;
    }

//Eliminar un proyecto
    public function BorrarProyecto($CodigoProy){
        $this->ConectarBD();

        // Eliminamos el fichero que tuvier adjunto
        $sql = $this->mysqli->query("SELECT AdjuntoProy FROM proyecto WHERE CodigoProy = '$CodigoProy'");
        if( $sql->num_rows > 0 ){
            $res = mysqli_fetch_array($sql);
            if(!empty($res["AdjuntoProy"]))
                @unlink('Archivos/proyectos/' . $res["AdjuntoProy"]);
        }

        // Eliminamos el registro de BD
        $this->mysqli->query("DELETE FROM proyecto WHERE CodigoProy = '$CodigoProy'")or die(mysqli_error($this->mysqli));
    }

//Eliminar
    public function BorrarParticipa($LoginU,$CodigoProy){
        $this->ConectarBD();
        $this->mysqli->query("DELETE FROM docente_proyecto WHERE CodigoProy = '$CodigoProy' AND LoginU='$LoginU'")or die(mysqli_error($this->mysqli));
    }

//Buscar usuario
    public function BuscarProyecto($buscar){
        $this->ConectarBD();
        $sql = $this->mysqli->query("SELECT *
                                                            FROM Proyecto c
                                                            WHERE
                                                            c.CodigoProy LIKE '%$buscar' || c.CodigoProy LIKE '%$buscar%' || c.CodigoProy LIKE '$buscar%' ||
                                                            c.TituloProy LIKE '%$buscar'|| c.TituloProy LIKE '%$buscar%' || c.TituloProy LIKE '$buscar%' ||
                                                            c.EntidadFinanciadora LIKE '%$buscar'|| c.EntidadFinanciadora LIKE '%$buscar%' || c.EntidadFinanciadora LIKE '$buscar%' ||
                                                            c.AcronimoProy LIKE '%$buscar'|| c.AcronimoProy LIKE '%$buscar%' || c.AcronimoProy LIKE '$buscar%' ||
                                                            c.AnhoInicioProy LIKE '%$buscar'|| c.AnhoInicioProy LIKE '%$buscar%' || c.AnhoInicioProy LIKE '$buscar%' ||
                                                            c.AnhoFinProy LIKE '%$buscar'|| c.AnhoFinProy LIKE '%$buscar%' || c.AnhoFinProy LIKE '$buscar%' ||
                                                            c.Importe LIKE '%$buscar'|| c.Importe LIKE '%$buscar%' || c.Importe LIKE '$buscar%'  ||
                                                            c.AdjuntoProy LIKE '%$buscar'|| c.AdjuntoProy LIKE '%$buscar%' || c.AdjuntoProy LIKE '$buscar%' 
                                                                
                                                            ") or die(mysqli_error($this->mysqli));
        return $sql;
    }

    /**
     * Valida si los campos del formulario de una materia son correctos
     *
     * @param array $campos del formulario
     * @return array $errores, contiene los campos fallidos $errores[] = nombre del campo
     */
    public function validarProyecto($campos){

        $errores    = array();
        $validar    = new Validacion();

        // Codigo Proyecto
        if(isset($campos["CodigoProy"]) && !$validar->validarLetrasYNumeros($campos["CodigoProy"]))
            $errores[]  = "CodigoProy";

        // titulo Proyecto
        if(isset($campos["TituloProy"]) && !$validar->validarLetrasYNumeros($campos["TituloProy"]))
            $errores[]  = "TituloProy";

        //
        if(isset($campos["EntidadFinanciadora"]) && !$validar->validarLetrasYNumeros($campos["EntidadFinanciadora"]))
            $errores[]  = "EntidadFinanciadora";

        //
        if(isset($campos["AcronimoProy"]) &&  !$validar->validarLetrasYNumeros($campos["AcronimoProy"]))
                $errores[]  = "AcronimoProy";

        //
        if(isset($campos["AnhoInicioProy"]) && ( !$validar->validarLetrasYNumeros($campos["AnhoInicioProy"])))
            $errores[]  = "AnhoInicioProy";

        //
        if(isset($campos["AnhoFinProy"]) && ( !$validar->validarLetrasYNumeros($campos["AnhoFinProy"])))
            $errores[]  = "AnhoFinProy";

        //
        if(isset($campos["Importe"]) && !$validar->validarSoloNumeros($campos["Importe"]))
            $errores[]  = "Importe";


        return $errores;
    }


}

?>
