<?php

class ControladorRoles
{

    /*=============================================
    MOSTRAR ROLES
    =============================================*/

    public static function ctrMostrarRoles($item, $valor)
    {

        $tabla = "roles";

        $respuesta = ModeloRol::mdlMostrarRol($tabla, $item, $valor);

        return $respuesta;

    }

    

}