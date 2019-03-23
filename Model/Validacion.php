<?php

/**
 * Clase que se encarga de las validaciones genéricas que se podrán realizar
 */
class Validacion
{

    /**
     * Constructor
     */
    public function __construct(){}

    /**
     * Valida si un texto contiene solo numeros
     * 
     * @param string $texto
     * @param bool  - true, si es correcto
     *              - false, si no es correcto
     */
    public function validarSoloNumeros($texto){
        $patron   = "/[0-9]+/";
        return preg_match_all($patron, $texto);
    }

    /**
     * Valida si un texto contiene solo letras con espacios
     * 
     * @param string $texto
     * @param bool  - true, si es correcto
     *              - false, si no es correcto
     */
    public function validarSoloLetras($texto){
        if(empty($texto))
            return false;
            
        $patron     = "/[a-zA-ZáéíóúÁÉÍÓÚñÑ]+\s*/";
        $resultado  = preg_match_all($patron, $texto);
        return ( count($resultado) > 0);
    }

    /**
     * Valida si un texto contiene letras, números o espacios
     * 
     * @param string $texto
     * @param bool  - true, si es correcto
     *              - false, si no es correcto
     */
    public function validarLetrasYNumeros($texto)
    {
        if(empty($texto))
            return false;

        $patron     = "/[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9]+\s*/";
        $resultado  = preg_match_all($patron, $texto);
        return ( count($resultado) > 0);
    }

    /**
     * Valida un telefono con el formato XXXXXXXXX
     * 
     * @param string $texto
     * @param bool  - true, si es correcto
     *              - false, si no es correcto
     */
    public function validarTelefono($texto){
        $patron   = "/[0-9]{9}/";
        return preg_match_all($patron, $texto);
    }

    /**
     * Valida un email con el formato xxxx@xxx.xx
     * 
     * @param string $texto
     * @param bool  - true, si es correcto
     *              - false, si no es correcto
     */
    public function validarEmail($texto){
        $patron   = "/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/";
        return preg_match_all($patron,$texto);
    }

    /**
     * Valida un dni calculando su letra correcta, el formato debe ser XXXXXXXX-Y
     * ( ocho números, un guión y la letra correcta )
     * 
     * @param string $texto
     * @param bool  - true, si es correcto
     *              - false, si no es correcto
     */
    public function validarDni($texto){
        $partes     = explode('-', $texto);
        
        if(count($partes) != 2)
            return false;

        $numeros    = $partes[0];
        $letra      = strtoupper($partes[1]);

        if(strlen($numeros) != 8)
            return false;
        else
            return (substr("TRWAGMYFPDXBNJZSQVHLCKE",$numeros%23,1) == $letra);

    }

    /**
     * Valida que una fecha exista en el calendario y tenga el formato dd/mm/yyyy
     * 
     * @param string $texto
     * @param bool  - true, si es correcto
     *              - false, si no es correcto
     */
    public function validarFecha($texto){
        $valores    = explode('-', $texto);
        if(count($valores) == 3 && checkdate($valores[1], $valores[2], $valores[0])){
            return true;
        }
        return false;
    }

}

?>