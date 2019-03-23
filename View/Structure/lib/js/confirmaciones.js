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