/* Modal confirmación borrar perfil */

function abrirConfirmBorrarPerfil(idFormulario, nombre){

    event.preventDefault(); // Evitamos que se envíe el formulario
    $("#confirmBorrarPerfil .nombre").eq(0).html(nombre);   // Añadimos el nombre al modal de confirmación
    // Abrimos el modal y cuando pulsen el botón de elminar enviamos el formulario
    $('#confirmBorrarPerfil').modal({
        backdrop: 'static',
        keyboard: false
    })
    .on('click', '#borrar', function(e) {
        $("#" + idFormulario).submit();    // Obtiene el primer formulario que hay por encima del botón
    });

}

/* Modal confirmación borrar tesis */

function abrirConfirmBorrarTesis(idFormulario, nombre){

    event.preventDefault(); // Evitamos que se envíe el formulario
    $("#confirmBorrarTesis .nombre").eq(0).html(nombre);   // Añadimos el nombre al modal de confirmación
    // Abrimos el modal y cuando pulsen el botón de elminar enviamos el formulario
    $('#confirmBorrarTesis').modal({
        backdrop: 'static',
        keyboard: false
    })
        .on('click', '#borrar', function(e) {
            $("#" + idFormulario).submit();    // Obtiene el primer formulario que hay por encima del botón
        });

}
/* Modal confirmación borrar materia */

function abrirConfirmBorrarMateria(idFormulario, nombre){

    event.preventDefault(); // Evitamos que se envíe el formulario
    $("#confirmBorrarMateria .nombre").eq(0).html(nombre);   // Añadimos el nombre al modal de confirmación
    // Abrimos el modal y cuando pulsen el botón de elminar enviamos el formulario
    $('#confirmBorrarMateria').modal({
        backdrop: 'static',
        keyboard: false
    })
        .on('click', '#borrar', function(e) {
            $("#" + idFormulario).submit();    // Obtiene el primer formulario que hay por encima del botón
        });

}
/* Modal confirmación borrar estancia */

function abrirConfirmBorrarEstancia(idFormulario, nombre){

    event.preventDefault(); // Evitamos que se envíe el formulario
    $("#confirmBorrarEstancia .nombre").eq(0).html(nombre);   // Añadimos el nombre al modal de confirmación
    // Abrimos el modal y cuando pulsen el botón de elminar enviamos el formulario
    $('#confirmBorrarEstancia').modal({
        backdrop: 'static',
        keyboard: false
    })
        .on('click', '#borrar', function(e) {
            $("#" + idFormulario).submit();    // Obtiene el primer formulario que hay por encima del botón
        });

}
/* Modal confirmación borrar proyecto dirigido */

function abrirConfirmPD(idFormulario, nombre){

    event.preventDefault(); // Evitamos que se envíe el formulario
    $("#confirmBorrarPD .nombre").eq(0).html(nombre);   // Añadimos el nombre al modal de confirmación
    // Abrimos el modal y cuando pulsen el botón de elminar enviamos el formulario
    $('#confirmBorrarPD').modal({
        backdrop: 'static',
        keyboard: false
    })
        .on('click', '#borrar', function(e) {
            $("#" + idFormulario).submit();    // Obtiene el primer formulario que hay por encima del botón
        });

}

/* Modal confirmación borrar TAD */

function abrirConfirmBorrarTad(idFormulario, nombre){

    event.preventDefault(); // Evitamos que se envíe el formulario
    $("#confirmBorrarTad .nombre").eq(0).html(nombre);   // Añadimos el nombre al modal de confirmación
    // Abrimos el modal y cuando pulsen el botón de elminar enviamos el formulario
    $('#confirmBorrarTad').modal({
        backdrop: 'static',
        keyboard: false
    })
        .on('click', '#borrar', function(e) {
            $("#" + idFormulario).submit();    // Obtiene el primer formulario que hay por encima del botón
        });


}

/* Modal confirmación borrar articulo usuario */

function abrirConfirmBorrarArticulo(idFormulario, nombre){

    event.preventDefault(); // Evitamos que se envíe el formulario
    $("#confirmBorrarArticulo .nombre").eq(0).html(nombre);   // Añadimos el nombre al modal de confirmación
    // Abrimos el modal y cuando pulsen el botón de elminar enviamos el formulario
    $('#confirmBorrarArticulo').modal({
        backdrop: 'static',
        keyboard: false
    })
    .on('click', '#borrar', function(e) {
        $("#" + idFormulario).submit();    // Obtiene el primer formulario que hay por encima del botón
    });

}
/* Modal confirmación borrar proyecto  */

function abrirConfirmBorrarP(idFormulario, nombre){

    event.preventDefault(); // Evitamos que se envíe el formulario
    $("#confirmBorrarP .nombre").eq(0).html(nombre);   // Añadimos el nombre al modal de confirmación
    // Abrimos el modal y cuando pulsen el botón de elminar enviamos el formulario
    $('#confirmBorrarP').modal({
        backdrop: 'static',
        keyboard: false
    })
        .on('click', '#borrar', function(e) {
            $("#" + idFormulario).submit();    // Obtiene el primer formulario que hay por encima del botón
        });

}

/* Modal confirmación borrar congreso */

function abrirConfirmBorrarCongreso(idFormulario, nombre){
    event.preventDefault(); // Evitamos que se envíe el formulario
    $("#confirmBorrarCongreso .nombre").eq(0).html(nombre);   // Añadimos el nombre al modal de confirmación
    // Abrimos el modal y cuando pulsen el botón de elminar enviamos el formulario
    $('#confirmBorrarCongreso').modal({
        backdrop: 'static',
        keyboard: false
    })
    .on('click', '#borrar', function(e) {
        $("#" + idFormulario).submit();    // Obtiene el primer formulario que hay por encima del botón
    });

}



/*confirmaciones de modificacion*/


/* Modal modificar congreso */

function abrirConfirmModificarCongreso(){
    $('#confirmModificarCongreso').modal({
        backdrop: 'static',
        keyboard: false
    })
        .on('click', '#modificar', function(e) {
            $("#formularioModificarCongreso").submit();
        });
}


/* Modal modificar proyecto dirigido */

function abrirConfirmModificarProyectoDirigido(){
    $('#confirmModificarProyectoDirigido').modal({
        backdrop: 'static',
        keyboard: false
    })
    .on('click', '#modificar', function(e) {
        $("#formularioModificarProyectoDirigido").submit();
    });
}

/* Modal modificar estancia */

function abrirConfirmModificarEstancia(){
    $('#confirmModificarEstancia').modal({
        backdrop: 'static',
        keyboard: false
    })
        .on('click', '#modificar', function(e) {
            $("#formularioModificarEstancia").submit();
        });
}

/* Modal modificar materia */

function abrirConfirmModificarMateria(){
    $('#confirmModificarMateria').modal({
        backdrop: 'static',
        keyboard: false
    })
        .on('click', '#modificar', function(e) {
            $("#formularioModificarMateria").submit();
        });
}

/* Modal modificar proyecto */

function abrirConfirmModificarProyecto(){
    $('#confirmModificarProyecto').modal({
        backdrop: 'static',
        keyboard: false
    })
        .on('click', '#modificar', function(e) {
            $("#formularioModificarProyecto").submit();
        });
}

/* Modal modificar TAD */

function abrirConfirmModificarTAD(){
    $('#confirmModificarTAD').modal({
        backdrop: 'static',
        keyboard: false
    })
        .on('click', '#modificar', function(e) {
            $("#formularioModificarTAD").submit();
        });
}

/* Modal modificar tesis */

function abrirConfirmModificarTesis(){
    $('#confirmModificarTesis').modal({
        backdrop: 'static',
        keyboard: false
    })
        .on('click', '#modificar', function(e) {
            $("#formularioModificarTesis").submit();
        });
}


/* Modal modificar usuario */

function abrirConfirmModificarPerfil(){
    $('#confirmModificarUsuario').modal({
        backdrop: 'static',
        keyboard: false
    })
        .on('click', '#modificar', function(e) {
            $("#formularioModificarUsuario").submit();
        });
}