
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
                                    if( count($rows2) > 0 ){ 
                                    ?>
                                        
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Nombre</th>
                                                <th>Fecha</th>
                                                <th>Centro</th>
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
                                            </tr>
                                            <?php 
                                            }
                                            ?>
                                        </tbody>
                                    </table>

                                    <?php 
                                    } 
                                    ?>

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
                                    if( count($rows3) > 0 ){ 
                                    ?>
                                        
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Nombre</th>
                                                <th>Inicio</th>
                                                <th>Fin</th>
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
                                            </tr>
                                            <?php 
                                            }
                                            ?>
                                        </tbody>
                                    </table>

                                    <?php 
                                    } 
                                    ?>

                                </div>

                            </div>
                        </div>
                    </div>


                </div>

            </div>
        </div>

    </div>
</div>