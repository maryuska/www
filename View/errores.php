<?php

require_once 'View/Structure/Header.php';
require_once 'View/Structure/Nav.php';

?>

<div class="alert alert-danger" role="alert">
    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
    <span>
        <strong>Error:</strong> 
        <?php
        if(isset($msgError))
            echo $msgError;
        else
            echo "Algo ha fallado.";
        ?>
    </span>
</div>