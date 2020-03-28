
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
        <div class="col-md-offset-1 col-md-8 col-lg-offset-2 col-lg-6">
            <div class="cotainer">

                <?php
                // Artículo en session
                $rows = $_SESSION["ConsultarA"];
                
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


                foreach ($rows as $rowArticulo) {
                ?>

                <!-- Formulario -->

                <form id="formulario" class="form-horizontal" enctype="multipart/form-data" onsubmit="return comprobarArticulo()"  action="index.php?controlador=Articulos" method="post">

                    <input id="loginU" name="loginU" type="hidden" value="<?=$_SESSION["loginU"]?>">
                    <input id="CodigoA" name="CodigoA" type="hidden" placeholder="Código Artículo" class="form-control" value="<?=$rowArticulo["CodigoA"]?>" >
                    
                    <!-- Artículo -->

                    <h2 class="col-md-offset-4 col-lg-offset-3 text-center">Datos del artículo</h2>

                    <br>

                    <div class="form-group form-group-md">
                        <label class="col-md-4 col-lg-3 control-label" for="CodigoA">Código Artículo</label>
                        <div class="col-md-8 col-lg-9">
                            <input id="CodigoA2" name="CodigoA2" type="text" placeholder="Código Artículo" class="form-control" value="<?=$rowArticulo["CodigoA"]?>" disabled >
                        </div>
                    </div>

                    <div class="form-group form-group-md">
                        <label class="col-md-4 col-lg-3 control-label" for="TituloA">Título Artículo</label>
                        <div class="col-md-8 col-lg-9">
                            <input id="TituloA" name="TituloA" type="text" placeholder="Título Artículo" class="form-control  <?php if(isset($errores) && in_array("TituloA", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["TituloA"])?$_POST["TituloA"]:$rowArticulo["TituloA"]?>" >
                        </div>
                    </div>

                    <div class="form-group form-group-md">
                        <label class="col-md-4 col-lg-3 control-label" for="EstadoA">Estado Artículo</label>
                        <div class="col-md-8 col-lg-9">
                            <select id="EstadoA" name="EstadoA" class="form-control  <?php if(isset($errores) && in_array("EstadoA", $errores)){ echo " error"; } ?>">
                                <option value="0">--</option>

                                <?php
                                if(isset($errores)){
                                    // Existen errores y mostramos lo que traiga el post
                                ?>
                                
                                <option value="Enviado" <?php if(isset($_POST["EstadoA"]) && $_POST["EstadoA"] == "Enviado"){ echo "selected"; } ?>>Enviado</option>
                                <option value="Revision" <?php if(isset($_POST["EstadoA"]) && $_POST["EstadoA"] == "Revision"){ echo "selected"; } ?>>Revisión</option>
                                <option value="Publicado" <?php if(isset($_POST["EstadoA"]) && $_POST["EstadoA"] == "Publicado"){ echo "selected"; } ?>>Publicado</option>
                                
                                <?php 
                                }
                                else{ 
                                    // Es la primera vez que entramos a la página y seleccionamos lo que tenga guardado el artículo
                                ?>

                                <option value="Enviado" <?php if($rowArticulo["EstadoA"] == "Enviado"){ echo "selected"; } ?>>Enviado</option>
                                <option value="Revision" <?php if($rowArticulo["EstadoA"] == "Revision"){ echo "selected"; } ?>>Revisión</option>
                                <option value="Publicado" <?php if($rowArticulo["EstadoA"] == "Publicado"){ echo "selected"; } ?>>Publicado</option>
                                
                                <?php 
                                }
                                ?>

                            </select>
                        </div>
                    </div>

                    <!-- Autores -->

                    <h3 class="col-md-offset-4 col-lg-offset-3 text-center">
                        Autores
                        <button type="button" name="anadirAutor" class="btn btn-orange" onClick="addAutor();"> 
                            +
                        </button>
                    </h3>

                    <br>

                    <div id="cntAutores">

                        <?php

                        // Autores del artículo
                        $ConsultarAutores = $_SESSION["ConsultarAutores"];

                        // Si venimos desde los errores mostamos los autores ya introducidos
                        if(isset($errores) && in_array("autores", $errores)){
                            $autores = $_POST["ConsultarAutores"];

                            foreach($autores as $idx => $nombre){
                                ?>

                                <div class="form-group form-group-md">
                                    <label class="col-md-4 col-lg-3 control-label crudLabelAutor">Autor</label>
                                    <div class="col-xs-10 col-md-7 col-lg-8">
                                        <input name="autores[]" type="text" placeholder="Nombre del autor" class="form-control <?php if(isset($errores) && in_array("autores", $errores)){ echo " error"; } ?>" value="<?=$nombre?>" >
                                    </div>
                                    <div class="col-xs-2 col-md-1 col-lg-1">
                                        <button type="button" class="btn btn-orange" onClick="rmAutor(this);"> 
                                            Eliminar
                                        </button>
                                    </div>
                                </div>
        
                                <?php
                            }
                        }
                        elseif(count($ConsultarAutores) > 0){
                            // Si ya tenía autores metidos cargamos los que tenía
                            foreach ($ConsultarAutores as $rowAutor) {
                                ?>

                                <div class="form-group form-group-md">
                                    <label class="col-md-4 col-lg-3 control-label crudLabelAutor">Autor</label>
                                    <div class="col-xs-10 col-md-7 col-lg-8">
                                        <input name="autores[]" type="text" placeholder="Nombre del autor" class="form-control" value="<?=$rowAutor["NombreAutor"]?>" >
                                    </div>
                                    <div class="col-xs-2 col-md-1 col-lg-1">
                                        <button type="button" class="btn btn-orange" onClick="rmAutor(this);"> 
                                            Eliminar
                                        </button>
                                    </div>
                                </div>
        
                                <?php
                            }
                        }
                        else{
                            // Mostramos uno vacío para rellenar
                        ?>

                        <div class="form-group form-group-md">
                            <label class="col-md-4 col-lg-3 control-label crudLabelAutor">Autor</label>
                            <div class="col-xs-10 col-md-7 col-lg-8">
                                <input name="autores[]" type="text" placeholder="Nombre del autor" class="form-control" value="" >
                            </div>
                            <div class="col-xs-2 col-md-1 col-lg-1">
                                <button type="button" class="btn btn-orange addAutor" onClick="rmAutor(this);"> 
                                    Eliminar
                                </button>
                            </div>
                        </div>

                        <?php
                        }
                        ?>

                    </div>

                    <br>

                    <!-- Revista -->

                    <h3 class="col-md-offset-4 col-lg-offset-3 text-center">Datos de la Revista</h3>

                    <br>

                    <div class="form-group form-group-md">
                        <label class="col-md-4 col-lg-3 control-label" for="TituloR">Título Revista</label>
                        <div class="col-md-8 col-lg-9">
                            <input id="TituloR" name="TituloR" type="text" placeholder="Título Revista" class="form-control  <?php if(isset($errores) && in_array("TituloR", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["TituloR"])?$_POST["TituloR"]:$rowArticulo["TituloR"]?>" >
                        </div>
                    </div>

                    <div class="form-group form-group-md">
                        <label class="col-md-4 col-lg-3 control-label" for="ISSN">ISSN</label>
                        <div class="col-md-8 col-lg-9">
                            <input id="ISSN" name="ISSN" type="text" placeholder="ISSN" class="form-control  <?php if(isset($errores) && in_array("ISSN", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["ISSN"])?$_POST["ISSN"]:$rowArticulo["ISSN"]?>" >
                        </div>
                    </div>

                    <div class="form-group form-group-md">
                        <label class="col-md-4 col-lg-3 control-label" for="TitVolumenRuloA">Volumen</label>
                        <div class="col-md-8 col-lg-9">
                            <input id="VolumenR" name="VolumenR" type="text" placeholder="Volumen" class="form-control  <?php if(isset($errores) && in_array("VolumenR", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["VolumenR"])?$_POST["VolumenR"]:$rowArticulo["VolumenR"]?>" >
                        </div>
                    </div>

                    <div class="form-group form-group-md">
                        <label class="col-md-4 col-lg-3 control-label" for="PagIniA">Página Inicio</label>
                        <div class="col-md-8 col-lg-9">
                            <input id="PagIniA" name="PagIniA" type="text" placeholder="Página Inicio" class="form-control  <?php if(isset($errores) && in_array("PagIniA", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["PagIniA"])?$_POST["PagIniA"]:$rowArticulo["PagIniA"]?>" >
                        </div>
                    </div>

                    <div class="form-group form-group-md">
                        <label class="col-md-4 col-lg-3 control-label" for="PagFinA">Página Fin</label>
                        <div class="col-md-8 col-lg-9">
                            <input id="PagFinA" name="PagFinA" type="text" placeholder="Página Fin" class="form-control  <?php if(isset($errores) && in_array("PagFinA", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["PagFinA"])?$_POST["PagFinA"]:$rowArticulo["PagFinA"]?>" >
                        </div>
                    </div>

                    <div class="form-group form-group-md">
                        <label class="col-md-4 col-lg-3 control-label" for="FechaPublicacionR">Fecha Publicación</label>
                        <div class="col-md-8 col-lg-9">
                            <input id="FechaPublicacionR" name="FechaPublicacionR" type="date" placeholder="Fecha Publicación" class="form-control  <?php if(isset($errores) && in_array("FechaPublicacionR", $errores)){ echo " error"; } ?>" value="<?=isset($_POST["FechaPublicacionR"])?$_POST["FechaPublicacionR"]:$rowArticulo["FechaPublicacionR"]?>" >
                        </div>
                    </div>

                    <div class="col-md-offset-4 col-lg-offset-3 text-center">
                        <button type="submit" id="Registrar" name="evento" value="editarArticulo" class="btn btn-orange"> 
                            Editar artículo
                        </button>
                    </div>

                    <br>
                    <br>

                </form>

                <?php 
                }

                unset($_SESSION["ConsultarA"]);
                unset($_SESSION["ConsultarAutores"]);
                unset($_SESSION["ConsultarUsuArt"]);
                unset($_SESSION["ConsultarU"]);
                
                ?>
            </div>
        </div>

    </div>
</div>

<?php 
// Pie y cierre de html, body
require_once 'View/Structure/Footer.php';
?>
