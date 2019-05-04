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

/* Modal confirmación borrar proyecto dirigido */

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