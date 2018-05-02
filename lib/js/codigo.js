$(document).ready(function() {
    $('#btnDel').attr('disabled','disabled');
    $('#btnAdd').click(function() {
        var num = $('.clonedInput').length; // cuantos campos de entrada "duplicables" tenemos actualmente
        var newNum = new Number(num + 1); // la ID numérica del nuevo campo de entrada que se agrega

        // crea el nuevo elemento a través de clone () y manipula su ID usando el valor newNum
        var newElem = $('#input' + num).clone().attr('id', 'Add' + newNum);

        // manipular los valores de nombre / identificación de la entrada dentro del nuevo elemento
        newElem.children(':last').attr('id', 'name' + newNum).attr('name', 'name' + newNum);

        // inserta el nuevo elemento después del último campo de entrada "duplicable"
        $('#input' + num).after(newElem);

        // habilitar el botón "eliminar"
        $('#btnDel').attr('disabled',false);

    });

    $('#btnDel').click(function() {
        var num = $('.clonedInput').length; // cuantos campos de entrada "duplicables" tenemos actualmente
        $('#input' + num).remove(); // eliminar el último elemento

        // habilitar el botón "agregar"
        $('#btnAdd').attr('disabled',false);

    });

});
