<?php

// Controlador
require_once 'View/Structure/lib/html2pdf/html2pdf.class.php';
require_once 'Controller/ControllerController.php';
require_once 'Model/Pdf.php';

$evento = $_REQUEST['evento'];

switch ($evento) {

    case "crearPdf":
        require_once "View/Pdf/opcionesPdf.php";
    break;

    case "generar":

        // Si es menor que 3, solo vendrían controlador, evento y loginU.
        if(count($_POST) < 3){ 

            $msgError   = "Debe seleccionar al menos un check para generar el PDF.";
            $errores    = array();
            require_once "View/Pdf/opcionesPdf.php";

        }
        else{

            $html    = "";   // Aquí vamos a ir almacenando el html donde pintaremos en el pdf.

            $objetoPDF  = new Pdf();

            // Obtener estilo
            $html       .= $objetoPDF->getStyle();
            $html       .= "<page>";

            // Obtenemos la información personal del pdf
            $html       .= $objetoPDF->informacionPersonal($_POST["loginU"]);

            // Si se ha seleccionado formacionAcademica la concatenamos al html
            if( isset($_POST["formacionAcademica"]) && $_POST["formacionAcademica"] == 1)
                $html    .= $objetoPDF->formacionAcademica($_POST["loginU"]);

            // Si se ha seleccionado Proyectos dirigidos la concatenamos al html
            if( isset($_POST["proyectosDirigidos"]) && $_POST["proyectosDirigidos"] == 1)
                $html    .= $objetoPDF->proyectosDirigidos($_POST["loginU"]);

            // Si se ha seleccionado materias la concatenamos al html
            if( isset($_POST["materias"]) && $_POST["materias"] == 1)
                $html    .= $objetoPDF->materias($_POST["loginU"]);

            // Si se ha seleccionado congresos la concatenamos al html
            if( isset($_POST["congresos"]) && $_POST["congresos"] == 1)
                $html    .= $objetoPDF->congresos($_POST["loginU"]);

            // Si se ha seleccionado proyectos la concatenamos al html
            if( isset($_POST["proyectos"]) && $_POST["proyectos"] == 1)
                $html    .= $objetoPDF->proyectos($_POST["loginU"]);

            // Si se ha seleccionado tad la concatenamos al html
            if( isset($_POST["tad"]) && $_POST["tad"] == 1)
                $html    .= $objetoPDF->tad($_POST["loginU"]);

            // Si se ha seleccionado tesis la concatenamos al html
            if( isset($_POST["tesis"]) && $_POST["tesis"] == 1)
                $html    .= $objetoPDF->tesis($_POST["loginU"]);

            // Cerramos la pagina del pdf
            $html       .= "</page>";

            $html2pdf = new Html2Pdf('P','A4','es','true','UTF-8');
            $html2pdf->writeHTML($html);
            $html2pdf->output("View/Pdf/pdfGenerado.pdf", "F");

            require_once "View/Pdf/vistaPdf.php";
        }

    break;

}

?>