<?php 

if(!isset($_SESSION))
    session_start();

require_once 'Model/Usuarios.php';
require_once 'Model/ProyectosDirigidos.php';
require_once 'Model/Materia.php';
require_once 'Model/Congreso.php';
require_once 'Model/Estancias.php';
require_once 'Model/Proyecto.php';
require_once 'Model/Tad.php';
require_once 'Model/Tesis.php';

class Pdf{


    public function __construct(){

    }

    //Función para conectarnos a la Base de datos
    function ConectarBD()
    {
        $this->mysqli = new mysqli("localhost", "docente", "docente", "datos_curriculares");

        if ($this->mysqli->connect_errno) {
            echo "Fallo al conectar a MySQL: (" . $this->mysqli->connect_errno . ") " . $this->mysqli->connect_error;
        }
    }

    public function getStyle(){
        return "
            <style type='text/css'>
                .tabla{ 
                    width: 600px;
                    border-collapse:collapse; 
                }
                .tabla th{
                    background: black;
                    color: white;
                    padding: 5px;
                }
                .tabla td{
                    border: 1px solid black;
                    padding: 5px;
                }
                .negrita{
                    font-weight: bold;
                }
                .marginTop{
                    margin: 10px 0 0 0;
                }
                .reset{
                    margin: 0;
                    padding: 0;
                }
                .naranja{
                    color: #FF7514;
                }
            </style>
        ";
    }

    public function informacionPersonal($loginU){

        // Consultamos los datos del usuario
        $usuario    = new Usuarios();
        $conUsuario = $usuario->consultarUsuario($loginU);
        $rowUsuario = mysqli_fetch_array($conUsuario);

        $nombre             = $rowUsuario["NombreU"];
        $apellidos          = $rowUsuario["ApellidosU"];
        $fechaNamcimiento   = $rowUsuario["FechaNacimiento"];
        if($fechaNamcimiento != null && $fechaNamcimiento != '0000-00-00')
            $fechaNamcimiento = date("d-m-Y", strtotime($fechaNamcimiento));
        $movil              = $rowUsuario["Telefono"];
        $email              = $rowUsuario["Mail"];

        $html = "<h2 class='negrita marginTop'>";
        $html.= "   INFORMACIÓN PERSONAL";
        $html.= "</h2>";
        $html.= "<hr class='naranja'>";
        $html.= "<div class='reset'>";
        $html.= "   <p class='reset'><strong>Nombre:</strong> " . $nombre . "</p>";
        $html.= "   <p class='reset'><strong>Apellidos:</strong> " . $apellidos . "</p>";
        $html.= "   <p class='reset'><strong>Fecha nacimiento:</strong> " . $fechaNamcimiento . "</p>";
        $html.= "   <p class='reset'><strong>Móvil:</strong> " . $movil . "</p>";
        $html.= "   <p class='reset'><strong>Mail:</strong> " . $email . "</p>";
        $html.= "</div>";
        $html.= "<br><br>";

        return $html;
    }

    public function formacionAcademica($loginU){

        $tituloAcademico    = new TituloAcademico();
        $conTitulos         = $tituloAcademico->ListarTitulosAcademicos($loginU);

        $html = "<h2 class='negrita marginTop'>";
        $html.= "   FORMACIÓN ACADÉMICA";
        $html.= "</h2>";
        $html.= "<hr class='naranja'>";
        $html.= "<div class='reset'>";

        if($conTitulos->num_rows > 0){

            $html.= "   <table class='tabla'>";
            $html.= "       <thead>";
            $html.= "           <tr>";
            $html.= "               <th>Centro</th>";
            $html.= "               <th>Titulo</th>";
            $html.= "               <th>Fecha</th>";
            $html.= "           </tr>";
            $html.= "       </thead>";
            $html.= "       <tbody>";

            while($row = mysqli_fetch_array($conTitulos)){

                $nombre     = $row["NombreTitulo"];
                $centro     = $row["CentroTitulo"];
                $fecha      = $row["FechaTitulo"];
                if($fecha != null && $fecha != '0000-00-00')
                    $fecha = date("d-m-Y", strtotime($fecha));


                $html.= "           <tr>";
                $html.= "               <td>" . $centro . "</td>";
                $html.= "               <td>" . $nombre . "</td>";
                $html.= "               <td>" . $fecha . "</td>";
                $html.= "           </tr>";

            }

            $html.= "       </tbody>";
            $html.= "   </table>";

        }
        else{
            $html.= "<p class='reset'>No tiene títulos académicos disponibles.</p>";
        }


        $html.= "</div>";
        $html.= "<br><br>";
        return $html;
    }

    public function proyectosDirigidos($loginU, $tipoPD, $fechaDesdePD, $fechaHastaPD){

        $proyectos      = new ProyectosDirigidos();
        $conProyectos   = $proyectos->ListarProyectosDirigidos($loginU);


        $html = "<h2 class='negrita marginTop'>";
        $html.= "   PROYECTOS DIRIGIDOS";
        $html.= "</h2>";
        $html.= "<hr class='naranja'>";

        $html.= "<div class='reset'>";

        if($conProyectos->num_rows > 0){
            while($row = mysqli_fetch_array($conProyectos)){
                if($row["TipoPD"]==$tipoPD || $tipoPD==Null){

                    $codigo         = $row["CodigoPD"];
                    $titulo         = $row["TituloPD"];
                    $alumno         = $row["AlumnoPD"];
                    $calificacion   = $row["CalificacionPD"];

                    $html.= "   <p class='reset'><strong>Código:</strong> " . $codigo . "</p>";
                    $html.= "   <p class='reset'><strong>Título:</strong> " . $titulo . "</p>";
                    $html.= "   <p class='reset'><strong>Alumno:</strong> " . $alumno . "</p>";
                    $html.= "   <p class='reset'><strong>Calificación:</strong> " . $calificacion . "</p>";
                    $html.= "   <hr>";
                }
            }

        }
        else{
            $html.= "<p class='reset'>No tiene proyectos dirigidos disponibles.</p>";
        }

        $html.= "</div>";

        return $html;
    }

    public function materias($loginU){

        $materias      = new Materia();
        $conMaterias   = $materias->ListarMaterias($loginU);

        $html = "<h2 class='negrita marginTop'>";
        $html.= "   MATERIAS";
        $html.= "</h2>";
        $html.= "<hr class='naranja'>";

        $html.= "<div class='reset'>";

        if($conMaterias->num_rows > 0){


            while($row = mysqli_fetch_array($conMaterias)){

                $codigo         = $row["CodigoM"];
                $nombre         = $row["DenominacionM"];
                $participacion  = $row["TipoParticipacionM"];
                $titulacion     = $row["TitulacionM"];
                $fecha      = $row["AnhoAcademicoM"];
                if($fecha != null && $fecha != '0000-00-00')
                    $fecha = date("Y", strtotime($fecha));

                $html.= "   <p class='reset'><strong>Código:</strong> " . $codigo . "</p>";
                $html.= "   <p class='reset'><strong>Nombre:</strong> " . $nombre . "</p>";
                $html.= "   <p class='reset'><strong>Participación:</strong> " . $participacion . "</p>";
                $html.= "   <p class='reset'><strong>Titulación:</strong> " . $titulacion . "</p>";
                $html.= "   <p class='reset'><strong>Año académico:</strong> " . $fecha . "</p>";
                $html.= "   <hr>";

            }

        }
        else{
            $html.= "<p class='reset'>No tiene Materias disponibles.</p>";
        }

        $html.= "</div>";

        return $html;
    }

    public function congresos($loginU){

        $congresos      = new Congreso();
        $conCongresos   = $congresos->ListarCongresos($loginU);

        $html = "<h2 class='negrita marginTop'>";
        $html.= "   CONGRESOS";
        $html.= "</h2>";
        $html.= "<hr class='naranja'>";

        $html.= "<div class='reset'>";

        if($conCongresos->num_rows > 0){


            while($row = mysqli_fetch_array($conCongresos)){

                $Nombre         = $row["NombreC"];
                $Acronimo         = $row["AcronimoC"];
                $Año         = $row["AnhoC"];
                if($Año != null && $Año != '0000-00-00')
                    $Año = date("Y", strtotime($Año));
                $Ciudad   = $row["LugarC"];

                $html.= "   <p class='reset'><strong>Nombre:</strong> " . $Nombre . "</p>";
                $html.= "   <p class='reset'><strong>Acrónimo:</strong> " . $Acronimo . "</p>";
                $html.= "   <p class='reset'><strong>Año:</strong> " . $Año . "</p>";
                $html.= "   <p class='reset'><strong>Ciudad:</strong> " . $Ciudad . "</p>";
                $html.= "   <hr>";

            }

        }
        else{
            $html.= "<p class='reset'>No tiene congresos disponibles.</p>";
        }

        $html.= "</div>";

        return $html;
    }

    public function proyectos($loginU){

        $proyectos      = new Proyecto();
        $conProyectos   = $proyectos->ListarProyectos($loginU);

        $html = "<h2 class='negrita marginTop'>";
        $html.= "   PROYECTOS";
        $html.= "</h2>";
        $html.= "<hr class='naranja'>";

        $html.= "<div class='reset'>";

        if($conProyectos->num_rows > 0){


            while($row = mysqli_fetch_array($conProyectos)){

                $Titulo         = $row["TituloProy"];
                $EntidadFinanciadora         = $row["EntidadFinanciadora"];
                $Acronimo   = $row["AcronimoProy"];
                $AnhoInicio   = $row["AnhoInicioProy"];
                if($AnhoInicio != null && $AnhoInicio != '0000-00-00')
                    $AnhoInicio = date("Y", strtotime($AnhoInicio));
                $AnhoFin         = $row["AnhoFinProy"];
                if($AnhoFin != null && $AnhoFin != '0000-00-00')
                    $AnhoFin = date("Y", strtotime($AnhoFin));
                $Importe   = $row["Importe"];

                $html.= "   <p class='reset'><strong>Título:</strong> " . $Titulo . "</p>";
                $html.= "   <p class='reset'><strong>Acrónimo:</strong> " . $Acronimo . "</p>";
                $html.= "   <p class='reset'><strong>Año inicio:</strong> " . $AnhoInicio . "</p>";
                $html.= "   <p class='reset'><strong>Año fin:</strong> " . $AnhoFin . "</p>";
                $html.= "   <p class='reset'><strong>Año:</strong> " . $EntidadFinanciadora . "</p>";
                $html.= "   <p class='reset'><strong>Ciudad:</strong> " . $Importe . "</p>";
                $html.= "   <hr>";

            }

        }
        else{
            $html.= "<p class='reset'>No tiene proyectos disponibles.</p>";
        }

        $html.= "</div>";

        return $html;
    }

    public function tad($loginU){

    $tad     = new Tad();
    $conTad   = $tad->ListarTad($loginU);

    $html = "<h2 class='negrita marginTop'>";
    $html.= "   TAD";
    $html.= "</h2>";
    $html.= "<hr class='naranja'>";

    $html.= "<div class='reset'>";

    if($conTad->num_rows > 0){


        while($row = mysqli_fetch_array($conTad)){

            $Codigo         = $row["CodigoTAD"];
            $Titulo         = $row["TituloTAD"];
            $Alumno   = $row["AlumnoTAD"];
            $Fecha        = $row["FechaLecturaTAD"];
            if($Fecha != null && $Fecha != '0000-00-00')
                $Fecha = date("d-m-Y", strtotime($Fecha));


            $html.= "   <p class='reset'><strong>Código:</strong> " . $Codigo . "</p>";
            $html.= "   <p class='reset'><strong>Título:</strong> " . $Titulo . "</p>";
            $html.= "   <p class='reset'><strong>Alumno:</strong> " . $Alumno . "</p>";
            $html.= "   <p class='reset'><strong>Fecha lectura:</strong> " . $Fecha . "</p>";
            $html.= "   <hr>";

        }

    }
    else{
        $html.= "<p class='reset'>No tiene tads disponibles.</p>";
    }

    $html.= "</div>";

    return $html;
}

    public function tesis($loginU){

        $tesis     = new Tesis();
        $conTesis   = $tesis->ListarTesis($loginU);

        $html = "<h2 class='negrita marginTop'>";
        $html.= "   TESIS";
        $html.= "</h2>";
        $html.= "<hr class='naranja'>";

        $html.= "<div class='reset'>";

        if($conTesis->num_rows > 0){


            while($row = mysqli_fetch_array($conTesis)){

                $Codigo         = $row["CodigoTesis"];
                $Autor         = $row["AutorTesis"];
                $Tutor   = $row["TutorTesis"];
                $Fecha        = $row["FechaLectura"];
                if($Fecha != null && $Fecha != '0000-00-00')
                    $Fecha = date("d-m-Y", strtotime($Fecha));
                $Calificacion   = $row["CalificacionTesis"];


                $html.= "   <p class='reset'><strong>Código:</strong> " . $Codigo . "</p>";
                $html.= "   <p class='reset'><strong>Autor:</strong> " . $Autor . "</p>";
                $html.= "   <p class='reset'><strong>Tutor:</strong> " . $Tutor . "</p>";
                $html.= "   <p class='reset'><strong>Fecha lectura:</strong> " . $Fecha . "</p>";
                $html.= "   <p class='reset'><strong>Calificación:</strong> " . $Calificacion . "</p>";
                $html.= "   <hr>";

            }

        }
        else{
            $html.= "<p class='reset'>No tiene tesis disponibles.</p>";
        }

        $html.= "</div>";

        return $html;
    }
}

?>