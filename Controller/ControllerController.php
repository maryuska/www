<?php


function anadirMensaje($mensaje, $alerta){
    ////session_start();();
    if(!isset($_SESSION['notificaciones']))
    {
        $_SESSION['notificaciones']=array();
        array_push($_SESSION['notificaciones'],array('alerta' => $alerta, 'mensaje' => $mensaje));
    }else{
        array_push($_SESSION['notificaciones'],array('alerta' => $alerta, 'mensaje' => $mensaje));
    }
}
?>