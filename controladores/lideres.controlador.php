<?php

class ControladorLideres
{

    public static function ctrCrearLider($datos)
    {
        $datosLider = array(
            "documento_soñadora"   => $datos["documentoS"],
            "documento_lider"      => $datos["liderS"],
        );

        $respuesta = ModeloLider::mdlIngresarLider("lider_soñadora", $datosLider);

        return $respuesta;
    }

}