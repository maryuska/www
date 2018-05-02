/*usuario/registrarse*/
function comprobarUsuario() {
    var Login = document.getElementById("Login").value;
    var PasswordU = document.getElementById("PasswordU").value;
   /*var PasswordU2 = document.getElementById("PasswordU2").value;
    var NombreU = document.getElementById("NombreU").value;
    var ApellidosU = document.getElementById("ApellidosU").value;
    var Telefono = document.getElementById("Telefono").value;
    var Mail = document.getElementById("Mail").value;
    var DNI = document.getElementById("DNI").value;
    var FechaNacimiento = document.getElementById("FechaNacimiento").value;
    var TipoContrato = document.getElementById("TipoContrato").value;
    var Centro = document.getElementById("Centro").value;
    var Departamento = document.getElementById("Departamento").value;
    var NombreUniversidad = document.getElementById("NombreUniversidad").value;
    var FechaInicio = document.getElementById("FechaInicio").value;
    var FechaFin  = document.getElementById("FechaFin").value;
    var Titulo = document.getElementById("Titulo").value;
    var FechaTitulo  = document.getElementById("FechaTitulo").value;
    var CentroTitulo = document.getElementById("CentroTitulo").value;

    var dayI,dayF,monthI,monthF,yearI,yearF;
*/
    if( Login == null /*|| Login.length == 0 || /^\s+$/.test(Login) || Login.match(/[A-Za-z0-9]/) == null*/) {
        alert("Error: Error de registro del Login");
        return false;

    }else if(PasswordU != PasswordU2 || PasswordU2 == null || PasswordU == null){
        alert("Error: Las passwords no coinciden ");
        return false;

    }else  if( NombreU == null || NombreU.length == 0 || /^\s+$/.test(NombreU) || NombreU.match(/[A-Za-z0-9]/)==null ) {
        alert("Error: Nombre de Usuario no valido");
        return false;

    } else  if( ApellidosU == null || ApellidosU.length == 0 || /^\s+$/.test(ApellidosU) || ApellidosU.match(/[A-Za-z0-9]/)==null ) {
        alert("Error: Apellidos de Usuario no validos");
        return false;
    }

    else  if( Telefono == null || Telefono.length == 0 || /^\s+$/.test(Telefono) || Telefono.match(/^[9|6|7]{1}([\d]{2}[-]*){3}[\d]{2}$/)==null ) {
        alert("Error: Numero de telefono no valido");
        return false;
    }
    else  if( Mail == null || Mail.length == 0 || /^\s+$/.test(Mail) || Mail.match(/[\w-\.]{3,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/)==null) {
        alert("Error: Introduzca una direccion de correo valida");
        return false;

    }else if( DNI == null || DNI.length == 0 || /^\s+$/.test(DNI) || DNI.match(/^\d{8}[a-zA-Z]$/)!=null) {
        alert("Error: Error de registro de nif , debe ser 8 digitos y una letra ");
        return false;

    }else if (FechaNacimiento.length == 0 || FechaNacimiento.match(/\d{1,2}\/\d{1,2}\/\d{2,4}$/) == null) {
            alert("Error: Fallo en la fecha de nacimiento");
            return false;

    } else  if( TipoContrato == null || TipoContrato.length == 0 || /^\s+$/.test(TipoContrato) || TipoContrato.match(/[A-Za-z0-9]/)==null ) {
            alert("Error: Tipo Contrato no valido");
            return false;

    } else  if( Centro == null || Centro.length == 0 || /^\s+$/.test(Centro) || Centro.match(/[A-Za-z0-9]/)==null ) {
        alert("Error: Centro no valido");
        return false;

    } else  if( Departamento == null || Departamento.length == 0 || /^\s+$/.test(Departamento) || Departamento.match(/[A-Za-z0-9]/)==null ) {
        alert("Error: Departamento no valido");
        return false;

    } else  if( NombreUniversidad == null || NombreUniversidad.length == 0 || /^\s+$/.test(NombreUniversidad) || NombreUniversidad.match(/[A-Za-z0-9]/)==null ) {
        alert("Error: Universidad no valida");
        return false;

    } else  if( Titulo == null || Titulo.length == 0 || /^\s+$/.test(Titulo) || Titulo.match(/[A-Za-z0-9]/)==null ) {
        alert("Error: Titulo no valido");
        return false;

    } else  if( CentroTitulo == null || CentroTitulo.length == 0 || /^\s+$/.test(CentroTitulo) || CentroTitulo.match(/[A-Za-z0-9]/)==null ) {
        alert("Error: Centro Título no valido");
        return false;

    }else if (FechaTitulo == null || FechaTitulo.length == 0 || FechaTitulo.match(/\d{1,2}\/\d{1,2}\/\d{2,4}$/) == null) {
        alert("Error: Fecha título no valida");
        return false;

    }else  if(FechaInicio == null || FechaInicio.length==0 || FechaInicio.match(/\d{1,2}\/\d{1,2}\/\d{2,4}$/) == null) {
        alert("Es obligatorio introducir una fecha de inicio");
        return false;
    }else  if( FechaFin.length==0 || FechaFin.match(/\d{1,2}\/\d{1,2}\/\d{2,4}$/) == null) {
        alert("Error: Fecha fin no valida");
        return false;
    }else {
            return true;
        }
}
function comprobarUniversidad() {
    var NombreUniversidad = document.getElementById("NombreUniversidad").value;
    var FechaInicio = document.getElementById("FechaInicio").value;
    var FechaFin  = document.getElementById("FechaFin").value;


    if( NombreUniversidad == null || NombreUniversidad.length == 0 || /^\s+$/.test(NombreUniversidad) || NombreUniversidad.match(/[A-Za-z0-9]/)==null ) {
        alert("Error: Universidad no valida");
        return false;

    }else  if(!isNaN(FechaInicio)) {
        alert("Error: Debe elegir una fecha de inicio");
        return false;

    }else  if( !isNaN(FechaFin)) {
        alert("Error: Debe elegir una fecha de fin");
        return false;
    }else {
        return true;
    }

}
function comprobarTituloAcademico() {
    var Titulo = document.getElementById("Titulo").value;
    var FechaTitulo = document.getElementById("FechaTitulo").value;
    var CentroTitulo  = document.getElementById("CentroTitulo").value;


    if( Titulo == null || Titulo.length == 0 || /^\s+$/.test(Titulo) || Titulo.match(/[A-Za-z0-9]/)==null ) {
        alert("Error: Titulo no valido");
        return false;

    } else  if( CentroTitulo == null || CentroTitulo.length == 0 || /^\s+$/.test(CentroTitulo) || CentroTitulo.match(/[A-Za-z0-9]/)==null ) {
        alert("Error: Centro Título no valido");
        return false;

    }else if ( !isNaN(FechaTitulo)) {
        alert("Error: Fecha título no valida");
        return false;
    }else {
        return true;
    }

}