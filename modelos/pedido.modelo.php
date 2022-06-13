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
                                                  productos.valor_unidad as Ped_valor_uni,
                                                  (productos_cantidad_total.total - salida_cantidad_total.total) as Diferencia
                                                   FROM productos 
                                                   INNER JOIN pedidos_detalle ON productos.id = pedidos_detalle.producto_id
                                                   INNER JOIN productos_cantidad_total ON productos.id = productos_cantidad_total.producto_id
                                                   INNER JOIN salida_cantidad_total ON productos.id = salida_cantidad_total.producto_id
                                                   WHERE $item = $valor");
        
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

    public static function mdlCrearCliente($tabla, $datos)
    
    { $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombres, apellidos, celular, email, pote, personaId) VALUES 
        (:nombres, :apellidos, :celular, :email, :pote, :personaId)");

        $stmt->bindParam(":nombres", $datos["nombres"], PDO::PARAM_STR);
        $stmt->bindParam(":apellidos", $datos["apellidos"], PDO::PARAM_STR);
        $stmt->bindParam(":celular", $datos["celular"], PDO::PARAM_STR);
        $stmt->bindParam(":email", $datos["email"], PDO::PARAM_STR);
        $stmt->bindParam(":pote", $datos["pote"], PDO::PARAM_STR);
        $stmt->bindParam(":personaId", $datos["soñadora_id"], PDO::PARAM_STR);
    
        if ($stmt->execute()) {

            return "ok";

        } else {

            return "error";

        }
        
        $stmt->close();
        $stmt = null;

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
                                                      pedidos.guia as guia,
                                                      pedidos.empresa as empresa,
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


    public static function mdlactualizarEnvioPedido($tabla, $guia, $empresa, $item, $valor)
    
    {

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET 
                                                guia = :guia, empresa = :empresa
                                                WHERE $item = :item");

        $stmt->bindValue(":guia", $guia, PDO::PARAM_STR);
        $stmt->bindValue(":empresa", $empresa, PDO::PARAM_STR);
        $stmt->bindValue(":item", $valor, PDO::PARAM_STR);
                
        
        if ($stmt->execute()) {

            return "ok"; 
            
            } else{
            
                return 'error';
            }

        $stmt->close();
        $stmt = null;
        
        
    }

    public static function mdlactualizarFotoPedido($tabla, $foto, $item, $valor){

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET 
                                                fotop = :foto
                                                WHERE $item = :item");

        $stmt->bindValue(":foto", $foto, PDO::PARAM_STR);
        $stmt->bindValue(":item", $valor, PDO::PARAM_STR);
                
        
        if ($stmt->execute()) {

            return "ok"; 
            
            } else{
            
                return 'error';
            }

        $stmt->close();
        $stmt = null;

    }

    public static function mdlbuscarPedidoDetalle($tabla, $item, $valor)
    
    {

        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = $valor");

        // $stmt->bindValue(":item", $valor, PDO::PARAM_STR);
                
        
        $stmt->execute();

        return $stmt->fetchAll();
        
        
    }

    public static function mdlmostrarPedidos()
    
    {

        
        $stmt = Conexion::conectar()->prepare("SELECT pedidos.id as Ped_id,
                                                  pedidos.fecha as Ped_fecha,
                                                  personas.nombres as Ped_nombres,
                                                  personas.apellidos as Ped_apellidos,
                                                  pedidos.total as Ped_valor,
                                                  pedidos.estado as Ped_estado
                                                  FROM personas 
                                                  INNER JOIN pedidos ON personas.id = pedidos.persona_id");
        

        $stmt->execute();

        return $stmt->fetchAll();
           
    }







}