<?php

require_once'Structure/Header.php';
require_once'Structure/Nav.php';


?>
<div class="centrado boxlogin">
    <form class="form-group " action="../../Controller/UsuariosController.php" method="post">
        <label class=" control-label"> Login Usuario </label>
        <div >
            <input id="LoginU" name="LoginU" type="text" placeholder="Login Usuario" class="form-control" required>
        </div>
        <label class=" control-label"> Password </label>
        <div >
            <input id="PasswordU" name="PasswordU" type="text" placeholder="Password" class="form-control" required>
        </div>

        <p align="center"><input  type="submit" name="evento" value="Login" class="btn btn-orange "></p>
    </form>


</div>