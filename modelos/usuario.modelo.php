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

    

    // public static function mdlEstadoUsuario($tabla, $item1, $item2, $item3)
    
    // {
    //     $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET estado = :item1 WHERE usuario = :item2");

    //     $stmt->bindValue(":item1", $item1, PDO::PARAM_INT);
    //     $stmt->bindValue(":item2", $item2, PDO::PARAM_INT);
    //     $stmt->bindValue(":item3", $item3, PDO::PARAM_INT);

    //     if ($stmt->execute()) {

    //         return "ok";

    //     } else {

    //         return "error";

    //     }

    //     $stmt->close();
    //     $stmt = null;

    // }


}
