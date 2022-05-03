<?php

require_once "conexion.php";

class ModeloPedidos
{

    public static function mdlIngresarPedidoDetalle($tabla, $datos)
    
    {
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla 
                                               WHERE n_interno = :n_interno
                                               AND producto_id = :producto_id");

        $stmt->bindParam(":n_interno", $datos["datoInterno"], PDO::PARAM_STR);
        $stmt->bindParam(":producto_id", $datos["producto_id"], PDO::PARAM_STR);

        $stmt->execute();
        
        $resultado = $stmt->fetchAll();

        $contarItem = count($resultado);

        if($contarItem == 0){

            $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(n_interno, producto_id, cantidad) VALUES 
            (:n_interno, :producto_id, :cantidad)");
    
            $stmt->bindParam(":n_interno", $datos["datoInterno"], PDO::PARAM_STR);
            $stmt->bindParam(":producto_id", $datos["producto_id"], PDO::PARAM_STR);
            $stmt->bindParam(":cantidad", $datos["cantidad"], PDO::PARAM_STR);
        
            if ($stmt->execute()) {
    
                return "ok";
    
            } else {
    
                return "error";
    
            }

        }else{

            return "error";            
            
        }
        
        $stmt->close();
        $stmt = null;

    }


    public static function mdlMostrarPedidoDetalle($tabla, $item, $valor)
    {
           
    $stmt = Conexion::conectar()->prepare("SELECT productos.nombre as Ped_nombre,
                                                  pedidos_detalle.id as Ped_id, 
                                                  pedidos_detalle.cantidad as Ped_cantidad,
                                                  productos.valor_unidad as Ped_valor_uni
                                                   FROM productos INNER JOIN pedidos_detalle ON
                                                   productos.id = pedidos_detalle.producto_id
                                                   WHERE pedidos_detalle.n_interno = $valor");
        
        // $stmt->bindValue(":item", $item, PDO::PARAM_INT);
        
        $stmt->execute();

        return $stmt->fetchAll();
               
            $stmt->close();
    
            $stmt = null;

    }

    public static function mdlBorrarPedidoDetalle($tabla, $item, $valor)
    
    {
        $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE $item = :$item");

        $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);
            
        if ($stmt->execute()) {

            return "ok";

        } else {

            return "error";

        }

        $stmt->close();
        $stmt = null;

    }

    public static function mdlCrearPedido($tabla, $datos)
    
    {

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(pro_det_n_interno, fecha, persona_id, comprobante, total, estado) VALUES 
        (:pro_det_n_interno, :fecha, :persona_id, :comprobante, :total, :estado)");

        $stmt->bindParam(":pro_det_n_interno", $datos["datoInterno"], PDO::PARAM_STR);
        $stmt->bindParam(":fecha", $datos["fecha"], PDO::PARAM_STR);
        $stmt->bindParam(":persona_id", $datos["idSoñadora"], PDO::PARAM_STR);
        $stmt->bindParam(":comprobante", $datos["comprobante"], PDO::PARAM_STR);
        $stmt->bindParam(":total", $datos["total"], PDO::PARAM_STR);
        $stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_STR);
    
        $stmt->execute();

        $stmt1 = Conexion::conectar()->prepare("SELECT * FROM pedidos WHERE pro_det_n_interno=:datoInterno");
        
        $stmt1->bindParam(":datoInterno", $datos["datoInterno"], PDO::PARAM_STR);
        
        $stmt1->execute();

        $respuesta = $stmt1->fetch(PDO::FETCH_ASSOC);

        $idPedido = $respuesta['id'];

        

        $tabla2 = 'pedidos_detalle';

        $stmt2 = Conexion::conectar()->prepare("UPDATE $tabla2 SET 
                                                $tabla2.pedido_id = $idPedido
                                                WHERE $tabla2.n_interno = :item2");

        $stmt2->bindValue(":item2", $datos["datoInterno"], PDO::PARAM_STR);

        if ($stmt2->execute()) {

            return "ok";

        } else {

            return "error";

        }



        
        $stmt->close();
        $stmt = null;
        $stmt1->close();
        $stmt1 = null;
        $stmt2->close();
        $stmt2 = null;


    }

    public static function mdlMostrarPedidosSoñador($tabla, $item, $valor, $item1, $valor1)
    
    {

        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item=:item AND $item1=:item1");

        $stmt->bindValue(":item", $valor, PDO::PARAM_STR);
        $stmt->bindValue(":item1", $valor1, PDO::PARAM_STR);
        
        
        $stmt->execute();

        return $stmt->fetchAll();
        
        
    }

    public static function mdlCrearCita($tabla, $datos)
    
    { $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(fecha, hora, nombres, celular, pote, acta, servicio, persona_id) VALUES 
        (:fecha, :hora, :nombres, :celular, :pote, :acta, :servicio, :persona_id)");

        $stmt->bindParam(":fecha", $datos["fecha"], PDO::PARAM_STR);
        $stmt->bindParam(":hora", $datos["hora"], PDO::PARAM_STR);
        $stmt->bindParam(":nombres", $datos["nombres"], PDO::PARAM_STR);
        $stmt->bindParam(":celular", $datos["celular"], PDO::PARAM_STR);
        $stmt->bindParam(":pote", $datos["pote"], PDO::PARAM_STR);
        $stmt->bindParam(":acta", $datos["acta"], PDO::PARAM_STR);
        $stmt->bindParam(":servicio", $datos["servicio"], PDO::PARAM_STR);
        $stmt->bindParam(":persona_id", $datos["soñadora_id"], PDO::PARAM_STR);
    
        if ($stmt->execute()) {

            return "ok";

        } else {

            return "error";

        }
        
        $stmt->close();
        $stmt = null;

    }

    public static function mdlMostrarCitasSoñador($tabla, $item, $valor)
    
    {

        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item=:item");

        $stmt->bindValue(":item", $valor, PDO::PARAM_STR);
                
        
        $stmt->execute();

        return $stmt->fetchAll();
        
        
    }

    public static function mdlMostrarPedidosPendientes($tabla, $item, $valor)
    
    {

        $stmt = Conexion::conectar()->prepare("SELECT pedidos.id as pedido,
                                                      pedidos.fecha as fecha,
                                                      personas.nombres as nombres,
                                                      personas.apellidos as apellidos
                                                      FROM personas INNER JOIN pedidos ON
                                                      personas.id = pedidos.persona_id 
                                                      WHERE pedidos.estado = $valor");


        // $stmt->bindValue(":item", $valor, PDO::PARAM_STR);
                
        
        $stmt->execute();

        return $stmt->fetchAll();
        
        
    }


    public static function mdlbuscarPedido($tabla, $item, $valor)
    
    {

        $stmt = Conexion::conectar()->prepare("SELECT pedidos.id as pedido,
                                                      pedidos.fecha as fecha,
                                                      pedidos.comprobante as comprobante,
                                                      pedidos.total as total,
                                                      pedidos.persona_id as persona,
                                                      personas.nombres as nombres,
                                                      personas.apellidos as apellidos
                                                      FROM personas INNER JOIN pedidos ON
                                                      personas.id = pedidos.persona_id 
                                                      WHERE pedidos.id = $valor");


        // $stmt->bindValue(":item", $valor, PDO::PARAM_STR);
                
        
        $stmt->execute();

        return $stmt->fetchAll();
        
        
    }

    public static function mdlactualizarEstadoPedido($tabla, $tabla1, $estado, $item, $item1, $valor)
    
    {

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET 
                                                estado = $estado
                                                WHERE $item = :item");

        $stmt->bindValue(":item", $valor, PDO::PARAM_STR);
                
        
        if ($stmt->execute()) {

            $stmt = Conexion::conectar()->prepare("UPDATE $tabla1 SET 
                                                estado = $estado
                                                WHERE $item1 = :item");

            $stmt->bindValue(":item", $valor, PDO::PARAM_STR);
            
            if($stmt->execute()){
            
                return "ok"; 
            
            } else{
            
                return 'error';
            }

        } else {

            return "error";

        }
        
        $stmt->close();
        $stmt = null;
        
        
    }






}