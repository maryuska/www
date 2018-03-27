<?php
require_once '../../View/Structure/Header.php';
require_once '../../View/Structure/Nav.php';
$loginU =$_SESSION["loginU"];

?>

<div class="col-md-10 izquierda">
    <h3 class="text-center">Insertar Estancia</h3>
    <div class="panel panel-default">
        <div class="col-md-12">
            <form id="formulario" class="form-horizontal" enctype="multipart/form-data" action="../../Controller/EstanciasController.php" method="post" role="form">

                <div class="form-group">
                    <label class="control-label" for="CodigoE">Código Estancia: </label>
                    <input id="CodigoE" name="CodigoE" type="CodigoE" placeholder="Código Estancia" class="form-control ">
                </div>

                <div class="form-group">
                    <label class="control-label" for="CentroE">Centro:</label>
                    <input id="CentroE" name="CentroE" type="CentroE" placeholder="Centro" class="form-control " >
                </div>

                <div class="form-group">
                    <label class="control-label" for="UniversidadE">Universidad:</label>
                    <input id="UniversidadE" name="UniversidadE" type="UniversidadE" placeholder="Universidad" class="form-control " >
                </div>

                <div class="form-group">
                    <label class="control-label" for="PaisE">País:</label>
                    <input id="PaisE" name="PaisE" type="PaisE" placeholder="País" class="form-control " >
                </div>

                <div class="form-group">
                    <label class="control-label" for="FechaInicioE">Fecha inicio:</label>
                    <input id="FechaInicioE" name="FechaInicioE" type="date" placeholder="Fecha inicio" class="form-control " >
                </div>

                <div class="form-group">
                    <label class="control-label" for="FechaInicioF">Fecha Fin:</label>
                    <input id="FechaInicioF" name="FechaInicioF" type="date" placeholder="Fecha fin" class="form-control " >
                </div>

                <div class="form-group">
                    <label class="control-label" for="TipoE">Tipo de estancia:</label>
                    <p> <select type="TipoE"  class="form-control"  id="TipoE" name="TipoE">
                            <option>--</option>
                            <option >Investigacion</option>
                            <option >Doctorado</option>
                            <option>Invitado</option>
                        </select></p>
                </div>
                <br>

                <div class="form-group">

                    <input id="LoginU" name="LoginU" type="hidden" placeholder="LoginU" value="<?php echo $loginU ?>" >
                </div>

                <div class="col-lg-6 col-md-6 col-sm-8 col-xs-8 col-md-offset-3">
                    <label class="control-label" for="Registrar"></label>
                    <button type="submit" id="Registrar" name="evento" value="altaEstancia" class="btn btn-orange"> Insertar </button>
                </div>

            </form>
        </div>
    </div>

</div>



