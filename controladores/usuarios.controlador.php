<?php

class ControladorUsuarios
{

    public static function ctrCrearUsuario($datos)
    {
        $datosUsuario = array(
            "usuario"   => $datos["usuario"],
            "password"  => $datos["password"],
            "foto"      => $datos["foto"],
            "rol_id"    => $datos["rol_id"],
            "estado"    => $datos["estado"],
        );

        $respuesta = ModeloUsuario::mdlIngresarUsuario("usuarios", $datosUsuario);

        return $respuesta;
    }

    


}