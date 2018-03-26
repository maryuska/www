<?php
require_once '../../View/Structure/Header.php';
require_once '../../View/Structure/Nav.php';
$loginU =$_SESSION["loginU"];

?>

<div class="col-md-10 izquierda">
    <h3 class="text-center">Insertar Materia</h3>
        <div class="panel panel-default">
            <div class="col-md-12">
            <form id="formulario" class="form-horizontal" enctype="multipart/form-data" action="../../Controller/MateriasController.php" method="post" role="form">

                <div class="form-group">
                    <label class="control-label" for="CodigoM">Código Materia: </label>
                    <input id="CodigoM" name="CodigoM" type="CodigoM" placeholder="Código Materia" class="form-control ">
                </div>

                <div class="form-group">
                    <label class="control-label" for="TipoM">Tipo Materia:</label>
                    <p> <select type="TipoM"  class="form-control"  id="TipoM" name="TipoM">
                            <option>--</option>
                            <option>Grado</option>
                            <option>Tercer Ciclo</option>
                            <option>Curso</option>
                            <option>Master</option>
                            <option>Post Grado</option>
                        </select></p>
                </div>

                <div class="form-group">
                    <label class="control-label" for="TipoParticipacionM">Tipo de participación:</label>
                    <p> <select type="TipoParticipacionM"  class="form-control"  id="TipoParticipacionM" name="TipoParticipacionM">
                            <option>--</option>
                            <option>Docente</option>
                            <option>Director</option>
                        </select></p>
                </div>

                <div class="form-group">
                    <label class="control-label" for="DenominacionM">Denominación:</label>
                        <input id="DenominacionM" name="DenominacionM" type="DenominacionM" placeholder="Denominación" class="form-control " >
                </div>

                <div class="form-group">
                    <label class="control-label" for="TitulacionM">Titulación:</label>
                    <input id="TitulacionM" name="TitulacionM" type="TitulacionM" placeholder="Titulación" class="form-control " >
                </div>

                <div class="form-group">
                    <label class="control-label" for="AnhoAcademicoM">Año académico:</label>
                    <input id="AnhoAcademicoM" name="AnhoAcademicoM" type="AnhoAcademicoM" placeholder="Año académico" class="form-control " >
                </div>

                <div class="form-group">
                    <label class="control-label" for="CreditosM">Créditos:</label>
                    <input id="CreditosM" name="CreditosM" type="CreditosM" placeholder="Créditos" class="form-control " >
                </div>

                <div class="form-group">
                    <label class="control-label" for="TipoPD">Cuatrimestre:</label>
                    <p> <select type="CuatrimestreM"  class="form-control"  id="CuatrimestreM" name="CuatrimestreM">
                            <option>--</option>
                            <option >Primero</option>
                            <option >Segundo</option>
                            <option>Anual</option>
                        </select></p>
                </div>
                <br>

                <div class="form-group">

                    <input id="LoginU" name="LoginU" type="hidden" placeholder="LoginU" value="<?php echo $loginU ?>" >
                </div>

                <div class="col-lg-6 col-md-6 col-sm-8 col-xs-8 col-md-offset-3">
                    <label class="control-label" for="Registrar"></label>
                        <button type="submit" id="Registrar" name="evento" value="altaMateria" class="btn btn-orange"> Insertar </button>
                </div>

            </form>
            </div>
        </div>

    </div>



