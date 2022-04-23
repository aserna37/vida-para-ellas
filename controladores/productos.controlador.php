<?php

class ControladorProductos
{

    public static function ctrMostrarProductos($item, $valor)
    {

        $tabla = "productos";
        
        $respuesta = ModeloProductos::mdlMostrarProductos($tabla, $item, $valor);

        return $respuesta;

    }


    public static function ctrCrearProducto($datos)
    {
        $datosProducto = array(
            "nombre"            => $datos["nombre"],
            "valor_unidad"      => $datos["valor_unidad"],
            "estado"            => $datos["estado"],
        );

        $respuesta = ModeloProductos::mdlIngresarProducto("productos", $datosProducto);

        return $respuesta;
    }

    public static function ctrEstadoProducto($item1, $item2)
    {

        $tabla = "productos";
        
        $respuesta = ModeloProductos::mdlEstadoProducto($tabla, $item1, $item2);
        
        return $respuesta;

            
    }
    
    public static function ctrMostrarProducto($item, $valor)
    {

        $tabla = "productos";
        
        $respuesta = ModeloProductos::mdlMostrarProductos($tabla, $item, $valor);

        return $respuesta;

    }

    public static function ctrEditarProducto($datos)
    {
        $datosProducto = array(
            "id"                 => $datos["id"],
            "nombre"             => $datos["nombre"],
            "valor_unidad"       => $datos["valor_unidad"],
            "fecha_modificacion" => $datos["fecha_modificacion"],
        );

        $respuesta = ModeloProductos::mdlEditarProducto("productos", $datosProducto);

        return $respuesta;
    }

    public static function ctrGuardarProductoDetalle($datos)
    {

        $cantidadProducto = array(
            "producto_id"        => $datos["producto_id"],
            "cantidad"           => $datos["cantidad"],
            "fecha"              => $datos["fecha"],
            
        );

        $tabla ='productos_cantidad_detallado';
        $tabla1 = 'productos_cantidad_total';

        $respuesta = ModeloProductos::mdlGuardarProductoDetalle($tabla, $tabla1, $cantidadProducto);

        return $respuesta;
    }

    
    public static function ctrMostrarStocks()
    {
                
        $respuesta = ModeloProductos::mdlMostrarStocks();

        return $respuesta;

    }

    public static function ctrMostrarStockDetalle($item, $valor)
    {
        $tabla = 'productos_cantidad_detallado';        

        $respuesta = ModeloProductos::mdlMostrarStockDetalle($tabla,$item,$valor);

        return $respuesta;

    }



    



}