
<?php
require_once '../../View/Structure/Header.php';
require_once '../../View/Structure/Nav.php';
$loginU =$_SESSION["loginU"];

?>

<div class="col-md-10 izquierda">
    <h3 class="text-center">Insertar Universidad</h3>
    <div class="panel panel-default">
        <div class="col-md-12">
            <form id="formulario" class="form-horizontal" enctype="multipart/form-data" action="../../Controller/UsuariosController.php" method="post" role="form">

                <div class="form-group">
                    <label class="col-lg-3 col-md-4 col-sm-4 control-label" for="UniversidadU">Nombre</label>
                    <div class="col-lg-7 col-md-6 col-sm-6">
                        <input id="NombreUniversidad" name="NombreUniversidad" type="text" placeholder="Nombre" class="form-control input-md">

                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 col-md-4 col-sm-4 control-label" for="UniversidadU">Fecha Inicio</label>
                    <div class="col-lg-7 col-md-6 col-sm-6">
                        <input id="FechaInicio" name="FechaInicio" type="date" placeholder="Fecha Inicio" class="form-control input-md">

                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 col-md-4 col-sm-4 control-label" for="UniversidadU">Fecha Fin</label>
                    <div class="col-lg-7 col-md-6 col-sm-6">
                        <input id="FechaFin" name="FechaFin" type="date" placeholder="Fecha Fin" class="form-control input-md">

                    </div>
                </div>

                <div class="form-group">

                    <input id="LoginU" name="LoginU" type="hidden" placeholder="LoginU" value="<?php echo $loginU ?>" >
                </div>

                <div class="col-lg-6 col-md-6 col-sm-8 col-xs-8 col-md-offset-3">
                    <label class="control-label" for="Registrar"></label>
                    <button type="submit" id="Registrar" name="evento" value="altaUniversidad" class="btn btn-orange"> Insertar </button>
                </div>

            </form>
        </div>
    </div>

</div>