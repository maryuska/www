
<?php
// Estructura general html, body
require_once 'View/Structure/Header.php';

// Menu
require_once 'View/Structure/Nav.php';

?>

<div class="container-fluid">
    <div class="row">

        <?php
        // Menu lateral
        require_once 'View/Structure/Sidebar.php';
        ?>

        <!-- Contenido -->
        <div class="col-md-10">
            <div class="cotainer">
                <!--Titulo de lo que se esta haciendo -->
                <p class="lead separator separator-title">Lista de TAD</p>
                <!-- Botón buscar -->
                <br>
                <br>
                <div class="row">
                    <form class="form-horizontal" action="index.php?controlador=Ponencia" method="POST" role="search">
                        <div class="col-lg-3 col-md-6 col-xs-10">
                            <input name="textoBusqueda" type="text" class="form-control" placeholder="buscar">
                        </div>
                        <div class="col-lg-3 col-md-3 col-xs-2">
                            <button type="submit" name="evento" value="buscarPonencia" class="btn btn-orange">
                                Buscar
                            </button>
                        </div>
                        <div class="col-lg-6 col-md-3 col-xs-2 text-right">
                            <a class="btn btn-orange " href="index.php?controlador=Ponencia&evento=paginaInsertarPonenciaAdmin">
                                Insertar Ponencia
                            </a>
                        </div>
                    </form>
                </div>

                <br>
                <br>



                <div class="tab-content">


                    <?php
                    $lista = $_SESSION["listarPonenciaAdmin"];
                    $contador   = 1;
                    if (isset($lista)) {
                        foreach ($lista as $row){ ?>

                            <div class="form-group col-lg-6">
                                <div class="panel panel-default">
                                    <!-- Nombre ponencia -->
                                    <div class="tdTitulo">
                                        <td type="submit"   name = "TituloP" ><?php echo $row['TituloP']; ?></td>
                                    </div>
                                    <!-- datos proyecto-->
                                    <div class="panel-body">
                                        <tr>
                                            <td valign="top" width="50%">
                                                <b name = "CodigoP" >Código Ponencia:</b>
                                                <?php echo $row['CodigoP']; ?>
                                                <br>
                                                <b name = "CongresoP">Congreso: </b>
                                        	<?php echo $row['CongresoP']; ?>
                                        	<br>
                                        	<b  name = "FechaIniCP" >Fecha Inicio: </b>
                                        	<?php echo $row['FechaIniCP']; ?>
                                        	<br>
                                        	<b  name = "FechaFinCP" >Fecha Fin: </b>
                                        	<?php echo $row['FechaFinCP']; ?>
                                        	<br>
                                        	<b name = "LugarCP">Lugar: </b>  
						<?php echo $row['LugarCP']; ?>                                    
                                        	<br>
						<b name = "PaisCP">País: </b>  
						<?php echo $row['PaisCP']; ?>                                    
                                        	<br>
                                            </td>

                                        </tr>
                                        <div class="margin-bottom5 text-center">
                                            <form name="formBorrarTad<?php echo $contador; ?>" id="formBorrarPonencia<?php echo $contador; ?>" class="text-center" action="index.php" method="get">
                                                <input type="hidden" name="controlador" value="Tad">
                                                <input type="hidden" name="evento" value="borrarTad">
                                                <input type="hidden" name="CodigoTAD" value="<?php echo $row['CodigoTAD']; ?>">
                                                <input type="hidden" name="LoginU" value="<?php echo $row['LoginU']; ?>">
                                                <button type="button" class="btn btn-transparent btn-orange" onClick="window.location.href='index.php?controlador=Ponencia&evento=consultarPonenciaAdmin&CodigoPonencia=<?php echo $row['CodigoP']; ?>'">
                                                    Modificar
                                                </button>
                                                <button type="button" class="btn btn-transparent btn-orange" onClick="abrirConfirmBorrarPonencia('formBorrarPonencia<?php echo $contador; ?>', '<?php echo $row['CodigoP']." ".$row['TituloP']; ?>');">
                                                    Borrar
                                                </button>
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <?php
                            $contador++;
                        }
                    }
                    ?>


                </div>
            </div>

        </div>
    </div>


</div>




<!-- Confirmar borrar ponencia-->
<div id="confirmBorrarPonencia" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger text-danger">
                <h4 class="modal-title">Atención</h4>
            </div>
            <div class="modal-body text-center">
                <h5>¿Desea eliminar la Ponencia <strong class="nombre"></strong>?</h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-modal btn-primary" id="borrar">Eliminar</button>
                <button type="button" class="btn btn-modal btn-danger" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>
<!-- FIN: Confirmar borrar ponencia-->
<?php
// Pie y cierre de html, body
require_once 'View/Structure/Footer.php';
?>
