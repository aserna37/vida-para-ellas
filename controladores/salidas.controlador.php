<?php

class ControladorSalidas
{

    public static function ctrMostrarSalidas()
    {

        $respuesta = ModeloSalidas::mdlMostrarSalidas();

        return $respuesta;

    }

    public static function ctrAgregarSalidas($datos)
    {
        $tabla="salida_manual";

        $nuevaSalida = array(
            "producto_id"        => $datos["producto_id"], 
            "fecha"              => $datos["fecha"],
            "cantidad"           => $datos["cantidad"],
            "observaciones"      => $datos["observaciones"],
         
        );

        $respuesta = ModeloSalidas::mdlAgregarSalidas($tabla,$nuevaSalida);

        return $respuesta;

    }

    public static function ctrMostrarSalida($item,$valor)
    {
        $tabla="salida_manual";

        $respuesta = ModeloSalidas::mdlMostrarSalida($tabla,$item,$valor);

        return $respuesta;

    }

    
}