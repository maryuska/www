<?php

require_once'Structure/Header.php';
require_once'Structure/Nav.php';


if(isset($_GET["PassErr"]) ){
?>
<center>
  <div class="alert alert-danger" role="alert">
    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
    <span class="sr-only">Error:</span>
    Las contraseñas no coinciden.
  </div>
</center>
<?php } ?>

<center>
<button type="button" name="button" class="btn-success" onclick="location: location.href='home.php'"> Ir a la pagina principal </button>
</center>

<?php
require_once'Structure/Footer.php';
?>
