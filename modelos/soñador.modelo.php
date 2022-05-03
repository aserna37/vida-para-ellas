<?php

require_once "conexion.php";

class ModeloSoñadores
{
// Mostrar Soñador
    
public static function mdlMostrarSoñadores($tabla, $item, $valor)
    {

        if($valor == '1') {

            $valor = '4';

            if ($item != null) {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item <> :$item");

            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

            $stmt->execute();

            return $stmt->fetchAll();

        } else {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY id DESC");

            $stmt->execute();

            return $stmt->fetchAll();

        }
    } else {
        
        if ($item != null) {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

            $stmt->execute();

            return $stmt->fetchAll();

        } else {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY id DESC");

            $stmt->execute();

            return $stmt->fetchAll();

        }
    }

        $stmt->close();

        $stmt = null;

    }







// Crear Soñador

public static function mdlIngresarSoñador($tabla, $datos)
    
    {
        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(tipo, documento, nombres, apellidos, f_nacimiento, sexo, direccion, celular, email, municipio_id, estado, rol_id) VALUES 
        (:tipo, :documento, :nombres, :apellidos, :f_nacimiento, :sexo, :direccion, :celular, :email, :municipio_id, :estado, :rol_id)");

        $stmt->bindParam(":tipo", $datos["tipo"], PDO::PARAM_STR);
        $stmt->bindParam(":documento", $datos["documento"], PDO::PARAM_STR);
        $stmt->bindParam(":nombres", $datos["nombres"], PDO::PARAM_STR);
        $stmt->bindParam(":apellidos", $datos["apellidos"], PDO::PARAM_STR);
        $stmt->bindParam(":f_nacimiento", $datos["f_nacimiento"], PDO::PARAM_STR);
        $stmt->bindParam(":sexo", $datos["sexo"], PDO::PARAM_STR);
        $stmt->bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);
        $stmt->bindParam(":celular", $datos["celular"], PDO::PARAM_STR);
        $stmt->bindParam(":email", $datos["email"], PDO::PARAM_STR);
        $stmt->bindParam(":municipio_id", $datos["municipio_id"], PDO::PARAM_STR);
        $stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_STR);
        $stmt->bindParam(":rol_id", $datos["rol_id"], PDO::PARAM_STR);

        if ($stmt->execute()) {

            return "ok";

        } else {

            return "error";

        }

        $stmt->close();
        $stmt = null;

    }


//**************** */ 

public static function mdlEstadoSoñador($tabla, $tabla1, $item1, $item2, $item3)
    
    {
        
        
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla INNER JOIN $tabla1
                                               ON ($tabla.documento = $tabla1.usuario)
                                               SET $tabla.estado = :item1, $tabla1.estado = :item1
                                               WHERE $tabla.documento = :item3");
        
        $stmt->bindValue(":item1", $item1, PDO::PARAM_INT);
        $stmt->bindValue(":item2", $item2, PDO::PARAM_INT);
        $stmt->bindValue(":item3", $item3, PDO::PARAM_INT);

        if ($stmt->execute()) {

            return "ok";

        } else {

            return "error";

        }

        $stmt->close();
        $stmt = null;

    }


    // Editar Soñador

public static function mdlEditarSoñador($tabla, $datos)
    
{
    $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET documento=:documento, nombres=:nombres, apellidos=:apellidos, f_nacimiento=:f_nacimiento, sexo = :sexo, direccion=:direccion, celular=:celular, email=:email, municipio_id=:municipio_id, fecha_modificacion=:fecha_modificacion WHERE documento = :documento");

    $stmt->bindParam(":documento", $datos["documento"], PDO::PARAM_STR);
    $stmt->bindParam(":nombres", $datos["nombres"], PDO::PARAM_STR);
    $stmt->bindParam(":apellidos", $datos["apellidos"], PDO::PARAM_STR);
    $stmt->bindParam(":f_nacimiento", $datos["f_nacimiento"], PDO::PARAM_STR);
    $stmt->bindParam(":sexo", $datos["sexo"], PDO::PARAM_STR);
    $stmt->bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);
    $stmt->bindParam(":celular", $datos["celular"], PDO::PARAM_STR);
    $stmt->bindParam(":email", $datos["email"], PDO::PARAM_STR);
    $stmt->bindParam(":municipio_id", $datos["municipio_id"], PDO::PARAM_STR);
    $stmt->bindParam(":fecha_modificacion", $datos["fecha_modificacion"], PDO::PARAM_STR);

    if ($stmt->execute()) {

        return "ok";

    } else {

        return "error";

    }

    $stmt->close();
    $stmt = null;

}


//**************** */ 



    }
