
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
            <div class="row">

                <div class="col-lg-6 margin-botom20">
                    <!-- Datos personales -->
                    <div class="panel panel-default">

                        <div class="tdTitulo">
                            Datos personales
                        </div>

                        <?php 
                        $rows = $_SESSION["ConsultarU"];
                        foreach ($rows as $row) { 
                        ?>

                        <div class="panel-body">
                                
                            <div class="form-group">
                                <label class="control-label" for="LoginU">Login</label>
                                <input id="LoginU" name="LoginU" type="text" class="form-control" value="<?php echo $row['LoginU']; ?>" disabled>
                            </div>

                            <div class="form-group">
                                <label class="control-label" for="NombreU">Nombre</label>
                                <input id="NombreU" name="NombreU" type="text" class="form-control" value="<?php echo $row['NombreU']; ?>" disabled>
                            </div>

                            <div class="form-group">
                                <label class="control-label" for="ApellidosU">Apellidos</label>
                                <input id="ApellidosU" name="ApellidosU" type="text" class="form-control" value="<?php echo $row['ApellidosU']; ?>" disabled>
                            </div>

                            <div class="form-group">
                                <label class="control-label" for="Telefono">Telefono</label>
                                <input id="Telefono" name="Telefono" type="tel" class="form-control" value="<?php echo $row['Telefono']; ?>" disabled>
                            </div>

                            <div class="form-group">
                                <label class="control-label" for="Mail">Mail</label>
                                <input id="Mail" name="Mail" type="email" class="form-control" value="<?php echo $row['Mail']; ?>" disabled>
                            </div>

                            <div class="form-group">
                                <label class="control-label" for="DNI">DNI</label>
                                <input id="DNI" name="DNI" type="text" class="form-control" value="<?php echo $row['DNI']; ?>" disabled>
                            </div>

                            <div class="form-group">
                                <label class="control-label" for="FechaNacimiento">Fecha Nacimiento</label>
                                <input id="FechaNacimiento" name="FechaNacimiento" type="date" class="form-control" value="<?php echo $row['FechaNacimiento']; ?>" disabled>
                            </div>

                            <div class="form-group">
                                <label class="control-label" for="TipoContratoU">Tipo Contrato</label>
                                <input id="TipoContratoU" name="TipoContratoU" type="text" class="form-control" value="<?php echo $row['TipoContrato']; ?>" disabled>
                            </div>

                            <div class="form-group">
                                <label class="control-label" for="CentroU">Centro</label>
                                <input id="CentroU" name="CentroU" type="text" class="form-control" value="<?php echo $row['Centro']; ?>" disabled>
                            </div>

                            <div class="form-group">
                                <label class="control-label" for="DepartamentoU">Departamento</label>
                                <input id="DepartamentoU" name="DepartamentoU" type="text" class="form-control" value="<?php echo $row['Departamento']; ?>" disabled>
                            </div>

                            

                        </div>

                        <?php
                        }
                        ?>
                    </div>

                    <div class="text-center">
                        <form name="formBorrarPerfil" id="formBorrarPerfil" action="index.php" method="get">
                            <input type="hidden" name="controlador" value="Usuarios">
                            <input type="hidden" name="evento" value="borrarPerfil">
                            <input type="hidden" name="LoginU" value="<?php echo $row['LoginU']; ?>">
                            <button type="button" class="btn btn-orange" onClick="abrirConfirmBorrarPerfil('formBorrarPerfil', '<?php echo $row['NombreU']." ".$row['ApellidosU']; ?>');">
                                Borrar Perfil
                            </button>
                        </form>
                    </div>

                </div>
                <div class="col-lg-6">

                    <!-- Datos académicos -->
                    <div class="row margin-botom20">
                        <div class="col-xs-12">
                            <div class="panel panel-default">

                                <div class="tdTitulo">
                                    Títulos Académicos
                                </div>

                                <div class="panel-body">
                                    <?php  
                                    $rows2 = $_SESSION["ConsultaUT"];

                                    if(count($rows2) > 0){
                                    ?>
                                        
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Nombre</th>
                                                <th>Fecha</th>
                                                <th>Centro</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ($rows2 as $row2) { 
                                            ?>
                                            <tr>
                                                <td>
                                                    <?php echo $row2['NombreTitulo']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row2['FechaTitulo']; ?> 
                                                </td>
                                                <td>
                                                    <?php echo $row2['CentroTitulo']; ?>
                                                </td>
                                                <td class="text-right" width="80px">
                                                    <a href="index.php?controlador=Usuarios&evento=consultarTituloAcademico&LoginU=<?php echo $row['LoginU']; ?>&NombreTitulo=<?php echo $row2['NombreTitulo']; ?>">
                                                        Modificar
                                                    </a>
                                                </td>
                                            </tr>
                                            <?php 
                                            }
                                            ?>
                                        </tbody>
                                    </table>

                                    <?php 
                                    } 
                                    ?>

                                    <div class="text-center">
                                        <a class="btn btn-orange" href="index.php?controlador=Usuarios&evento=insertarTituloAcademico">
                                            Insertar
                                        </a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <!-- Universidades -->
                    <div class="row margin-botom20">
                        <div class="col-xs-12">
                            <div class="panel panel-default">

                                <div class="tdTitulo">
                                    Universidades
                                </div>

                                <div class="panel-body">
                                    <?php  
                                    $rows3 = $_SESSION["ConsultaUA"];
                                    if(count($rows3) > 0){
                                    ?>
                                        
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Nombre</th>
                                                <th>Inicio</th>
                                                <th>Fin</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ($rows3 as $row3) { 
                                            ?>
                                            <tr>
                                                <td>
                                                    <?php echo $row3['NombreUniversidad']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row3['FechaInicio']; ?> 
                                                </td>
                                                <td>
                                                    <?php echo $row3['FechaFin']; ?>
                                                </td>
                                                <td class="text-right" width="80px">
                                                    <a href="index.php?controlador=Usuarios&evento=consultarUniversidad&LoginU=<?php echo $row['LoginU']; ?>&NombreTitulo=<?php echo $row2['NombreTitulo']; ?>">
                                                        Modificar
                                                    </a>
                                                </td>
                                            </tr>
                                            <?php 
                                            }
                                            ?>
                                        </tbody>
                                    </table>

                                    <?php 
                                    } 
                                    ?>

                                    <div class="text-center">
                                        <a class="btn btn-orange" href="index.php?controlador=Usuarios&evento=insertarUniversidad">
                                            Insertar
                                        </a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>


                </div>

            </div>
        </div>

    </div>
</div>

<!-- Confirmar borrar perfil -->
<div id="confirmBorrarPerfil" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger text-danger">
                <h4 class="modal-title">Atención</h4>
            </div>
            <div class="modal-body text-center">
                <h5>¿Desea eliminar el perfil de <strong class="nombre"></strong>?</h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-modal btn-primary" id="borrar">Eliminar</button>
                <button type="button" class="btn btn-modal btn-danger" data-dismiss="modal">Cancelar</button>
            </div>                    
        </div>
    </div>
</div>
<!-- FIN: Confirmar borrar perfil -->

<?php 
// Pie y cierre de html, body
require_once 'View/Structure/Footer.php';
?>