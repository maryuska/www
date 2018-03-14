<?php
require_once '../../View/Structure/Header.php';
require_once '../../View/Structure/NavSimple.php';

?>

<div class=".col-md-6">



    <div class="tab-content">

             <form id="formulario" class="form-horizontal" enctype="multipart/form-data" action="../../Controller/UsuariosController.php" method="post" role="form">

             <!-- Form Name -->
            <h2>Registrar Docente</h2>

            <div class="form-group">
                <label class="panel-body col-lg-3 col-md-4 col-sm-4 control-label" for="Login">Login Usuario</label>
                <div class="col-lg-7 col-md-6 col-sm-6">
                    <input id="Login" name="Login" type="text" placeholder="Login Usuario" class="form-control ">

                </div>
            </div>

            <div class="form-group">
              <label class="col-lg-3 col-md-4 col-sm-4 control-label" for="PasswordU">Password</label>
              <div class="col-lg-7 col-md-6 col-sm-6">
                <input id="PasswordU" name="PasswordU" type="password" placeholder="Password" class="form-control input-md" >

              </div>
            </div>

            <div class="form-group">
              <label class="col-lg-3 col-md-4 col-sm-4 control-label" for="PasswordU2">Repetir Password</label>
              <div class="col-lg-7 col-md-6 col-sm-6">
                <input id="PasswordU2" name="PasswordU2" type="password" placeholder="Repetir Password" class="form-control input-md" >

              </div>
            </div>

            <div class="form-group">
                <label class="col-lg-3 col-md-4 col-sm-4 control-label" for="NombreU">Nombre Usuario</label>
                <div class="col-lg-7 col-md-6 col-sm-6">
                    <input id="NombreU" name="NombreU" type="text" placeholder="Nombre Usuario" class="form-control input-md">

                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-3 col-md-4 col-sm-4 control-label" for="ApellidosU">Apellidos </label>
                <div class="col-lg-7 col-md-6 col-sm-6">
                    <input id="ApellidosU" name="ApellidosU" type="text" placeholder="Apellidos" class="form-control input-md">

                </div>
            </div>

                 <div class="form-group">
                     <label class="col-lg-3 col-md-4 col-sm-4 control-label" for="TipoContrato">Tipo Contrato</label>
                     <div class="col-lg-7 col-md-6 col-sm-6">
                         <input id="TipoContrato" name="TipoContrato" type="text" placeholder="Tipo Contrato" class="form-control input-md">

                     </div>
                 </div>

                 <div class="form-group">
                     <label class="col-lg-3 col-md-4 col-sm-4 control-label" for="Centro">Centro de trabajo</label>
                     <div class="col-lg-7 col-md-6 col-sm-6">
                         <input id="Centro" name="Centro" type="text" placeholder="Centro de trabajo" class="form-control input-md">

                     </div>
                 </div>

                 <div class="form-group">
                     <label class="col-lg-3 col-md-4 col-sm-4 control-label" for="Departamento">Departamento</label>
                     <div class="col-lg-7 col-md-6 col-sm-6">
                         <input id="Departamento" name="Departamento" type="text" placeholder="Departamento" class="form-control input-md">

                     </div>
                 </div>


                 <h3> Datos de la Universidad</h3>

                 <div class="form-group">
                     <label class="col-lg-3 col-md-4 col-sm-4 control-label" for="UniversidadU">Nombre</label>
                     <div class="col-lg-7 col-md-6 col-sm-6">
                         <input id="NombreUniversidad" name="NombreUniversidad" type="text" placeholder="Nombre" class="form-control input-md">

                     </div>
                 </div>
                 <div class="form-group">
                     <label class="col-lg-3 col-md-4 col-sm-4 control-label" for="UniversidadU">Fecha Inicio</label>
                     <div class="col-lg-7 col-md-6 col-sm-6">
                         <input id="FechaInicio" name="FechaInicio" type="text" placeholder="Fecha Inicio" class="form-control input-md">

                     </div>
                 </div>
                 <div class="form-group">
                     <label class="col-lg-3 col-md-4 col-sm-4 control-label" for="UniversidadU">Fecha Fin</label>
                     <div class="col-lg-7 col-md-6 col-sm-6">
                         <input id="FechaFin" name="FechaFin" type="text" placeholder="Fecha Fin" class="form-control input-md">

                     </div>
                 </div>

                 <h3> Datos del Titulo</h3>
            <div class="form-group">

                     <label class="col-lg-3 col-md-4 col-sm-4 control-label" for="Titulo">Nombre Titulo</label>
                     <div class="col-lg-7 col-md-6 col-sm-6">
                         <input id="Titulo" name="Titulo" type="text" placeholder="Nombre Titulo" class="form-control input-md">

                     </div>
                 </div>
            <div class="form-group">
                <label class="col-lg-3 col-md-4 col-sm-4 control-label" for="Titulo">Fecha Titulo</label>
                     <div class="col-lg-7 col-md-6 col-sm-6">
                         <input id="FechaTitulo" name="FechaTitulo" type="text" placeholder="Fecha" class="form-control input-md">

                     </div>
             </div>
                 <div class="form-group">
                     <label class="col-lg-3 col-md-4 col-sm-4 control-label" for="Titulo">Centro Titulo</label>
                     <div class="col-lg-7 col-md-6 col-sm-6">
                         <input id="CentroTitulo" name="CentroTitulo" type="text" placeholder="Centro Titulo" class="form-control input-md">

                     </div>
                 </div>


                 <div class="form-group">
                     <label class="col-lg-3 col-md-4 col-sm-4 control-label" for="Registrar"></label>
                     <div class="col-lg-3 col-md-4 col-sm-4">
                         <button type="submit" id="Registrar" name="evento" value="registrarUsuario" class="btn btn-orange"> Registrarse </button>
                     </div>
                 </div>

            </form>
    </div>

    </div>



</div>

