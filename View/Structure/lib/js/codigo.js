
function buscarUsuario(){
    window.open('View/Usuario/BuscarUsuario.php','buscar','width=300, height=400');
}

// Función que monta las fechas From To
function getRangoFechas(capaFrom, capaTo){

    $( function() {
        var dateFormat = "dd/mm/yy",
        from = $( capaFrom )
            .datepicker({
            defaultDate: "+1w",
            changeMonth: true,
            numberOfMonths: 2
            })
            .on( "change", function() {
            to.datepicker( "option", "minDate", getDate( this, dateFormat ) );
            }),
        to = $( capaTo ).datepicker({
            defaultDate: "+1w",
            changeMonth: true,
            numberOfMonths: 2
        })
        .on( "change", function() {
            from.datepicker( "option", "maxDate", getDate( this, dateFormat ) );
        });

    } );
}



function getDate( element, dateFormat ) {
    var date;
    try {
      date = $.datepicker.parseDate( dateFormat, element.value );
    } catch( error ) {
      date = null;
    }
    return date;
}