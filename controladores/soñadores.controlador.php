<?php

class ControladorSoñadores
{

    public static function ctrCrearSoñador($datos)
    {
        $datosSoñador = array(
            "tipo"          => $datos["tipo"],
            "documento"     => $datos["documento"],
            "nombres"       => $datos["nombres"],
            "apellidos"     => $datos["apellidos"],
            "f_nacimiento"  => $datos["f_nacimiento"],
            "sexo"          => $datos["sexo"],
            "direccion"     => $datos["direccion"],
            "celular"       => $datos["celular"],
            "email"         => $datos["email"],
            "municipio_id"  => $datos["municipio_id"],
            "estado"        => $datos["estado"],
            "rol_id"        => $datos["rol_id"],
        );

        $respuesta = ModeloSoñadores::mdlIngresarSoñador("personas", $datosSoñador);

        return $respuesta;
    }


    public static function ctrMostrarSoñadores($item, $valor)
    {

        $tabla = "personas";
        
        $respuesta = ModeloSoñadores::mdlMostrarSoñadores($tabla, $item, $valor);

        return $respuesta;

    }


    public static function ctrEstadoSoñadores($item1, $item2, $item3)
    {

        $tabla = "personas";
        $tabla1 = "usuarios";

        $respuesta = ModeloSoñadores::mdlEstadoSoñador($tabla, $tabla1, $item1, $item2, $item3);
        
        return $respuesta;

            
    }   
    


}

