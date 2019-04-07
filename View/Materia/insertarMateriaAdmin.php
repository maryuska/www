<?php
// Estructura general html, body
require_once 'View/Structure/Header.php';

// Menu
require_once 'View/Structure/Nav.php';

$loginU =$_SESSION["loginU"];

?>
<div class="container-fluid">
    <div class="row">

        <?php
        // Menu lateral
        require_once 'View/Structure/Sidebar.php';
        ?>

        <!-- Contenido -->
        <div class="col-md-offset-1 col-md-8 col-lg-offset-2 col-lg-6">
            <div class="cotainer">
                <?php
                // Si existe errores mostramos mensaje de error
                if(isset($errores) && !empty($errores)){
                    echo "<br>";
                    echo "<br>";
                    echo "<div class='row'>";
                    echo "  <div class='col-md-offset-4 col-md-8 col-lg-offset-3 col-lg-9'>";
                    require_once "View/errores.php";
                    echo "  </div>";
                    echo "</div>";
                }
                ?>

                <!-- Formulario -->

                <form id="formulario" class="form-horizontal" enctype="multipart/form-data" onsubmit="return comprobarMateria()"  action="index.php?controlador=Materias" method="post">

                    <!-- Materia -->

                    <h2 class="col-md-offset-4 col-lg-offset-3 text-center">Registrar Materia</h2>

                    <br>
                    <div class="form-group form-group-md">
                        <label class="col-md-4 col-lg-3 control-label" for="Login">Login usuario</label>
                        <div class="col-md-8 col-lg-9">
                            <p> <select id="Login" name="Login" type="text" placeholder="Login usuario" class="form-control <?php if(isset($errores) && in_array("Login", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["Login"])?$_POST["Login"]:''?>">
                                    <option>--</option>
                                    <?php $rows = $_SESSION["listarUsuarios"]; foreach ($rows as $row){ ?>
                                        <option value="<?php echo $row['LoginU'];?>"><?php echo $row['LoginU']." - ".$row['NombreU'];?></option>
                                    <?php } ?>
                                </select></p>
                        </div>
                    </div>

                    <div class="form-group form-group-md">
                        <label class="col-md-4 col-lg-3 control-label" for="CodigoM">Código Materia</label>
                        <div class="col-md-8 col-lg-9">
                            <input id="CodigoM" name="CodigoM" type="text" placeholder="Codigo Materia" class="form-control <?php if(isset($errores) && in_array("CodigoM", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["CodigoM"])?$_POST["CodigoM"]:''?>" >
                        </div>
                    </div>

                    <div class="form-group form-group-md">
                        <label class="col-md-4 col-lg-3 control-label" for="TipoM">Tipo Materia</label>
                        <div class="col-md-8 col-lg-9">
                            <p> <select id="TipoM" name="TipoM" type="text" placeholder="Tipo Materia" class="form-control <?php if(isset($errores) && in_array("TipoM", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["TipoM"])?$_POST["TipoM"]:''?>">
                                    <option>--</option>
                                    <option>Grado</option>
                                    <option>Tercer Ciclo</option>
                                    <option>Curso</option>
                                    <option>Master</option>
                                    <option>PostGrado</option>
                                </select></p>
                        </div>
                    </div>

                    <div class="form-group form-group-md">
                        <label class="col-md-4 col-lg-3 control-label" for="TipoParticipacionM">Tipo Participación</label>
                        <div class="col-md-8 col-lg-9">
                            <p> <select id="TipoParticipacionM" name="TipoParticipacionM" type="text" placeholder="Tipo Participacion" class="form-control <?php if(isset($errores) && in_array("TipoParticipacionM", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["TipoParticipacionM"])?$_POST["TipoParticipacionM"]:''?>">
                                    <option>--</option>
                                    <option>Docente</option>
                                    <option>Director</option>
                                </select></p>
                        </div>
                    </div>

                    <div class="form-group form-group-md">
                        <label class="col-md-4 col-lg-3 control-label" for="DenominacionM">Nombre Materia</label>
                        <div class="col-md-8 col-lg-9">
                            <input id="DenominacionM" name="DenominacionM" type="text" placeholder="Nombre Materia" class="form-control <?php if(isset($errores) && in_array("DenominacionM", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["DenominacionM"])?$_POST["DenominacionM"]:''?>" >
                        </div>
                    </div>

                    <div class="form-group form-group-md">
                        <label class="col-md-4 col-lg-3 control-label" for="TitulacionM">Titulación</label>
                        <div class="col-md-8 col-lg-9">
                            <input id="TitulacionM" name="TitulacionM" type="text" placeholder="Titulacion" class="form-control <?php if(isset($errores) && in_array("TitulacionM", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["TitulacionM"])?$_POST["TitulacionM"]:''?>" >
                        </div>
                    </div>

                    <div class="form-group form-group-md">
                        <label class="col-md-4 col-lg-3 control-label" for="AnhoAcademicoM">Año Académico</label>
                        <div class="col-md-8 col-lg-9">
                            <input id="AnhoAcademicoM" name="AnhoAcademicoM" type="date" placeholder="Año academico" class="form-control <?php if(isset($errores) && in_array("AnhoAcademicoM", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["AnhoAcademicoM"])?$_POST["AnhoAcademicoM"]:''?>" >
                        </div>
                    </div>

                    <div class="form-group form-group-md">
                        <label class="col-md-4 col-lg-3 control-label" for="CreditosM">Créditos</label>
                        <div class="col-md-8 col-lg-9">
                            <input id="CreditosM" name="CreditosM" type="text" placeholder="Creditos " class="form-control <?php if(isset($errores) && in_array("CreditosM", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["CreditosM"])?$_POST["CreditosM"]:''?>" >
                        </div>
                    </div>



                    <div class="form-group form-group-md">
                        <label class="col-md-4 col-lg-3 control-label" for="CuatrimestreM">Cuatrimestre</label>
                        <div class="col-md-8 col-lg-9">
                            <p> <select id="CuatrimestreM" name="CuatrimestreM" type="text" placeholder="Cuatrimestre" class="form-control <?php if(isset($errores) && in_array("CuatrimestreM", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["CuatrimestreM"])?$_POST["CuatrimestreM"]:''?>">
                                    <option>--</option>
                                    <option >Primero</option>
                                    <option >Segundo</option>
                                    <option>Anual</option>
                                </select></p>
                        </div>
                    </div>




                    <div class="col-md-offset-4 col-lg-offset-3 text-center">
                        <button type="submit" id="AltaMateriaAdmin" name="evento" value="altaMateriaAdmin" class="btn btn-orange">
                            Alta Materia
                        </button>
                    </div>

                    <br>
                    <br>

                </form>

            </div>
        </div>
    </div>
</div>
</div>
<?php
// Pie y cierre de html, body
require_once 'View/Structure/Footer.php';
?>






