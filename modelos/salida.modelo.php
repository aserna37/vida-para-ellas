<?php

require_once "conexion.php";

class ModeloSalidas
{
    
    public static function mdlMostrarSalidas()
    {
        $stmt = Conexion::conectar()->prepare("SELECT productos.nombre as Pro_nombre,
                                                      salida_manual.id as Sal_id,
                                                      salida_manual.fecha as Sal_fecha,
                                                      salida_manual.cantidad as Sal_cantidad
                                                  FROM productos 
                                                  INNER JOIN salida_manual ON productos.id = salida_manual.producto_id");
        
        
    $stmt->execute();

    return $stmt->fetchAll();
    
                
    $stmt->close();
    
    $stmt = null;
            
    
            
    }

    public static function mdlAgregarSalidas($tabla, $datos)
    {
        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(producto_id, fecha, cantidad, observaciones) VALUES 
        (:producto_id, :fecha, :cantidad, :observaciones)");

        $stmt->bindParam(":producto_id", $datos["producto_id"], PDO::PARAM_STR);
        $stmt->bindParam(":fecha", $datos["fecha"], PDO::PARAM_STR);
        $stmt->bindParam(":cantidad", $datos["cantidad"], PDO::PARAM_STR);
        $stmt->bindParam(":observaciones", $datos["observaciones"], PDO::PARAM_STR);
    
        if ($stmt->execute()) {

            return "ok";

        } else {

            return "error";

        }

        $stmt->close();
        $stmt = null;

    }

    public static function mdlMostrarSalida($tabla, $item, $valor)
    {
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item=:item");

        $stmt->bindParam(":item", $valor, PDO::PARAM_STR);
        
    
        $stmt->execute();

        return $stmt->fetchAll();
    
                
    $stmt->close();
    
    $stmt = null;

    }
    
    



    



}