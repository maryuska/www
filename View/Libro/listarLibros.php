
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
                <p class="lead separator separator-title">Lista de Estancias</p>


                <!-- Botón buscar -->
                <br>
                <br>
                <div class="row">
                    <form class="form-horizontal" action="index.php?controlador=Estancias" method="POST" role="search">
                        <div class="col-lg-3 col-md-6 col-xs-10">
                            <input name="textoBusqueda" type="text" class="form-control" placeholder="buscar">
                        </div>
                        <div class="col-lg-3 col-md-3 col-xs-2">
                            <button type="submit" name="evento" value="buscarEstancia" class="btn btn-orange">
                                Buscar
                            </button>
                        </div>
                        <div class="col-lg-6 col-md-3 col-xs-2 text-right">
                            <a class="btn btn-orange " href="index.php?controlador=Estancias&evento=paginaInsertarEstancia">
                                Insertar estancia
                            </a>
                        </div>
                    </form>
                </div>

                <br>
                <br>



                <div class="tab-content">
                    <!--listado de libros ordenados mas recientes  -->
                    <div class="tab-pane fade in active" id="tab1">
                        <?php
                        $lista = $_SESSION["listarLibros"];
                        $contador   = 1;
                        if (isset($lista)) {
                            foreach ($lista as $row){ ?>

                                <div class="form-group col-lg-6">
                                    <div class="panel panel-default">
                                        <!-- Codigo libro -->
                                        <div class="tdTitulo">
                                            <td type="submit"   name = "CodigoL" ><?php echo $row['CodigoL']; ?></td>
                                        </div>
                                        <!-- datos estancia-->
                                        <div class="panel-body">
                                            <tr>
                                                <td valign="top" width="50%">
                                                    <b name = "AutoresL" >Autores:</b>
                                                    <?php echo $row['AutoresL']; ?>
                                                    <br>
                                                    <b name = "TituloL">Título: </b>
                                                    <?php echo $row['TituloL']; ?>
                                                    <br>
                                                    <b  name = "ISBN" >ISBN: </b>
                                                    <?php echo $row['ISBN']; ?>
                                                    <br>
                                                    <b name = "PagIniL">Página inicio: </b>
                                                    <?php echo $row['PagIniL']; ?>
                                                    <br>
                                                    <b name = "PagFinL">Página fin: </b>
                                                    <?php echo $row['PagFinL']; ?>
                                                    <br>
                                                    <b name = "VolumenL">Volumen: </b>
                                                    <?php echo $row['VolumenL']; ?>
                                                    <br>
                                                    <b name = "EditorialL">Editorial: </b>
                                                    <?php echo $row['EditorialL']; ?>
                                                    <br>
                                                    <b name = "FechaPublicacionL">Fecha publicación: </b>
                                                    <?php echo $row['FechaPublicacionL']; ?>
                                                    <br>
                                                    <b name = "EditorL">Editor: </b>
                                                    <?php echo $row['EditorL']; ?>
                                                    <br>
                                                    <b name = "PaisEdicionL">Pais Edición: </b>
                                                    <?php echo $row['PaisEdicionL']; ?>
                                                    <br>

                                                </td>

                                            </tr>
                                            <div class="margin-bottom5 text-center">
                                                <form name="formBorrarLibro<?php echo $contador; ?>" id="formBorrarLibro<?php echo $contador; ?>" class="text-center" action="index.php" method="get">
                                                    <input type="hidden" name="controlador" value="Libros">
                                                    <input type="hidden" name="evento" value="borrarLibro">
                                                    <input type="hidden" name="CodigoE" value="<?php echo $row['CodigoL']; ?>">
                                                    <input type="hidden" name="LoginU" value="<?php echo $row['LoginU'] ?>">
                                                    <button type="button" class="btn btn-transparent btn-orange" onClick="window.location.href='index.php?controlador=Libros&evento=consultarLibro&CodigoL=<?php echo $row['CodigoL']; ?>'">
                                                        Modificar
                                                    </button>
                                                    <button type="button" class="btn btn-transparent btn-orange" onClick="abrirConfirmBorrarLibro('formBorrarLibro<?php echo $contador; ?>', '<?php echo $row['CodigoL']." ".$row['TituloL']; ?>');">
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


</div>
<!-- Confirmar borrar libro -->
<div id="confirmBorrarEstancia" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger text-danger">
                <h4 class="modal-title">Atención</h4>
            </div>
            <div class="modal-body text-center">
                <h5>¿Desea eliminar la estancia de <strong class="Titulo"></strong>?</h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-modal btn-primary" id="borrar">Eliminar</button>
                <button type="button" class="btn btn-modal btn-danger" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>
<!-- FIN: Confirmar borrar libro -->
<?php
// Pie y cierre de html, body
require_once 'View/Structure/Footer.php';
?>
