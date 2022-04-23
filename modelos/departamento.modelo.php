<?php

require_once "conexion.php";

class ModeloDepartamentos
{

    /*=============================================
    MOSTRAR DEPARTAMENTOS
    =============================================*/

    public static function mdlMostrarDepartamentos($tabla, $item, $valor)
    {

        if ($item != null) {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

            $stmt->execute();

            return $stmt->fetch();

        } else {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY id ASC");

            $stmt->execute();

            return $stmt->fetchAll();

        }

        $stmt->close();

        $stmt = null;

    }

    public static function mdlMostrarDepartamentoMunicipio($tabla, $item, $valor)
    {

        if ($item != null) {

            $stmt = Conexion::conectar()->prepare("SELECT municipios.nombre as Mun_nombre,
                                                          departamentos.nombre as Dep_nombre,
                                                          municipios.id as Mun_id,
                                                          departamentos.id as Dep_id 
                                                   FROM $tabla INNER JOIN municipios ON
                                                   departamentos.id = municipios.departamento_id 
                                                   WHERE $item = $valor");
            
            // $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);
            
            $stmt->execute();

            return $stmt->fetch();

        } else {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY id ASC");

            $stmt->execute();

            return $stmt->fetchAll();

        }

        $stmt->close();

        $stmt = null;

    }
}
