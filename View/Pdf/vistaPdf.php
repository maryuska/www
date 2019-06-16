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
        <div class="col-md-offset-1 col-md-8">
            <div class="cotainer">

                <iframe width="100%" height="700" src="./View/Pdf/pdfGenerado.pdf"></iframe>

            </div>
        </div>

    </div>
</div>

<?php 
// Pie y cierre de html, body
require_once 'View/Structure/Footer.php';
?>
