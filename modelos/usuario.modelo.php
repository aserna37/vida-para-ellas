<?php

require_once "conexion.php";

class ModeloUsuario
{

    /*=============================================
    MOSTRAR USUARIOS
    =============================================*/

    public static function mdlMostrarUsuario($tabla, $item, $valor)
    {
        if ($item != null) {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY id DESC");

            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch();

        } else {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY id DESC");
            $stmt->execute();
            return $stmt->fetchAll();

        }

    }


    /*=============================================
    REGISTRO DE USUARIO
    =============================================*/

    public static function mdlIngresarUsuario($tabla, $datos)
    {

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(usuario, password, foto, rol_id, estado) VALUES (:usuario, :password, :foto, :rol_id, :estado)");

        $stmt->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);
        $stmt->bindParam(":password", $datos["password"], PDO::PARAM_STR);
        $stmt->bindParam(":foto", $datos["foto"], PDO::PARAM_STR);
        $stmt->bindParam(":rol_id", $datos["rol_id"], PDO::PARAM_STR);
        $stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_STR);
        
        if ($stmt->execute()) {

            return "ok";

        } else {

            return "error";

        }

        $stmt->close();

        $stmt = null;

    }

    public static function mdlActualizarContraseña($tabla,$item,$valor)
    {
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET password =:password WHERE usuario =:item");
        $stmt->bindParam(":password", $valor, PDO::PARAM_STR);
        $stmt->bindParam(":item", $item, PDO::PARAM_STR);

        if($stmt->execute()) {

            return "ok";

        } else {

            return "error";

        }

        $stmt->close();

        $stmt = null;

    }

    public static function mdlActualizarFoto($tabla,$item,$valor)
    {
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET foto =:foto WHERE usuario =:item");
        $stmt->bindParam(":foto", $valor, PDO::PARAM_STR);
        $stmt->bindParam(":item", $item, PDO::PARAM_STR);

        if($stmt->execute()) {

            return "ok";

        } else {

            return "error";

        }

        $stmt->close();

        $stmt = null;

    }



}
