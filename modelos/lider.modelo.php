<?php

require_once "conexion.php";

class ModeloLider
{

    public static function mdlIngresarLider($tabla, $datos)
    {

        $documento_lider = $datos['documento_lider'];
        $documento_soñadora = $datos['documento_soñadora'];
        
        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(documento_lider, documento_soñadora) VALUES ($documento_lider, $documento_soñadora)");

        if ($stmt->execute()) {

            return "ok";

        } else {

            return "error";

        }

        $stmt->close();

        $stmt = null;

    }

    


}
