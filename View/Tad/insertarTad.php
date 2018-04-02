<?php
require_once '../../View/Structure/Header.php';
require_once '../../View/Structure/Nav.php';
$loginU =$_SESSION["loginU"];
?>

<div class="col-md-10 izquierda">
    <h3 class="text-center">Insertar TAD</h3>
        <div class="panel panel-default">
            <div class="col-md-12">
            <form id="formulario" class="form-horizontal" enctype="multipart/form-data" action="../../Controller/TadController.php" method="post" role="form">

                <div class="form-group">
                    <label class="control-label" for="CodigoTAD">Código Tad: </label>
                    <input id="CodigoTAD" name="CodigoTAD" type="CodigoTAD" placeholder="Código TAD" class="form-control ">
                </div>

                <div class="form-group">
                    <label class="control-label" for="TituloTAD">Título Tad:</label>
                        <input id="TituloTAD" name="TituloTAD" type="TituloTAD" placeholder="Título Tad" class="form-control " >
                </div>

                <div class="form-group">
                    <label class="control-label" for="AlumnoTAD">Alumno:</label>
                    <input id="AlumnoTAD" name="AlumnoTAD" type="AlumnoTAD" placeholder="Alumno" class="form-control " >
                </div>

                <div class="form-group">
                    <label class="control-label" for="FechaLecturaTAD">Fecha lectura:</label>
                    <input id="FechaLecturaTAD" name="FechaLecturaTAD" type="date" placeholder="Fecha lectura" class="form-control " >
                </div>

                <div class="form-group">

                    <input id="LoginU" name="LoginU" type="hidden" placeholder="LoginU" value="<?php echo $loginU ?>" >
                </div>
                <br>

                <div class="col-lg-6 col-md-6 col-sm-8 col-xs-8 col-md-offset-3">
                    <label class="control-label" for="Registrar"></label>
                        <button type="submit" id="Registrar" name="evento" value="altaTad" class="btn btn-orange"> Insertar </button>
                </div>

            </form>
            </div>
        </div>

    </div>



