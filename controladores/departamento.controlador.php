<?php

class ControladorDepartamentos
{

    /*=============================================
    MOSTRAR DEPARTAMENTOS
    =============================================*/

    public static function ctrMostrarDepartamentos($item, $valor)
    {

        $tabla = "departamentos";

        $respuesta = ModeloDepartamentos::mdlMostrarDepartamentos($tabla, $item, $valor);

        return $respuesta;

    }

    public static function ctrMostrarDepartamentoMunicipio($item, $valor){
        
        $tabla = "departamentos";

        $respuesta = ModeloDepartamentos::mdlMostrarDepartamentoMunicipio($tabla, $item, $valor);

        return $respuesta;
    }

}