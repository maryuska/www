<?php
require_once 'View/Structure/Header.php';
require_once 'View/Structure/Nav.php';
?>

    <div class="centrado">
        <div class="boxlogin">

            <form action="index.php?controlador=Usuarios" method="post">

                <div class="form-group">
                    <label class="control-label" for="LoginU">Login Usuario</label>
                    <input id="LoginU" name="LoginU" type="text" placeholder="Login Usuario" class="form-control" required>
                </div>

                <div class="form-group">
                    <label class="control-label" for="PasswordU">Password</label>
                    <input id="PasswordU" name="PasswordU" type="text" placeholder="Password" class="form-control" required>
                </div>

                <div class="text-center">
                    <button type="submit" name="evento" value="Login" class="btn btn-orange">Login</button>
                </div>
                
            </form>

        </div>
    </div>

<?php 
require_once 'View/Structure/Footer.php';
?>