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

    public static function ctrBuscarUsuario($item, $valor)
    {
        $tabla = "usuarios";

        $respuesta = ModeloUsuario::mdlMostrarUsuario($tabla, $item, $valor);

        return $respuesta;
    }

    public static function ctrActualizarContraseña($item, $valor)
    {
        $tabla = "usuarios";
        
        $respuesta = ModeloUsuario:: mdlActualizarContraseña($tabla,$item,$valor);
        
        return $respuesta;
    }

    public static function ctrActualizarFoto($item, $valor)
    {
        $tabla = "usuarios";
        
        $respuesta = ModeloUsuario:: mdlActualizarFoto($tabla,$item,$valor);
        
        return $respuesta;
    }

    


}