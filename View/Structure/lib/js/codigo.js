
function buscarUsuario(){
    window.open('View/Usuario/BuscarUsuario.php','buscar','width=300, height=400');
}

// Añadir una caja para agregar un autor más en la insercción o modificación
function addAutor(){

    // Contenido
    var texto = '';
    texto += '<div class="form-group form-group-md">';
    texto += '  <label class="col-md-4 col-lg-3 control-label crudLabelAutor">Autor</label>';
    texto += '  <div class="col-xs-10 col-md-7 col-lg-8">';
    texto += '      <input name="autores[]" type="text" placeholder="Nombre del autor" class="form-control" value="">';
    texto += '  </div>';
    texto += '  <div class="col-xs-2 col-md-1 col-lg-1">';
    texto += '      <button type="button" class="btn btn-orange addAutor" onClick="rmAutor(this);">';
    texto += '          Eliminar';
    texto += '      </button>';
    texto += '  </div>';
    texto += '</div>';
    
    // Agregamos el contenido
    $("#cntAutores").append(texto);

}

// Eliminar una caja de autor en la insercción o modificación
function rmAutor(boton){

    // Si solo tiene uno no dejamos que lo elimine lo ponemos en blanco
    if( $("#cntAutores > div").length == 1 ){   // Cuenta cuantos "div" hay dentro de #cntAutores
        $("#cntAutores input").val(''); // Pone a vacio todos los input que haya dentro de #cntAutores
    }
    else{
        // En caso contrario lo eliminamos
        $(boton).parent().parent().remove();
    }
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