<?php

class ControladorPedidos
{

   public static function ctrCrearPedidosDetalle($datos)
    {
        $datosPedidoDetalle = array(
            "datoInterno"      => $datos["datoInterno"],
            "producto_id"      => $datos["producto_id"],
            "cantidad"         => $datos["cantidad"],
        );

        
        $respuesta = ModeloPedidos::mdlIngresarPedidoDetalle("pedidos_detalle", $datosPedidoDetalle);

        return $respuesta;
    }


    public static function ctrMostrarPedidoDetalle($item, $valor)
    {

        $tabla = "pedidos_detalle";
        
        $respuesta = ModeloPedidos::mdlMostrarPedidoDetalle($tabla, $item, $valor);

        return $respuesta;

    }

    public static function ctrBorrarPedidoDetalle($item, $valor)
    {

        $tabla = "pedidos_detalle";
        
        $respuesta = ModeloPedidos::mdlBorrarPedidoDetalle($tabla, $item, $valor);

        return $respuesta;

    }

    public static function ctrCrearPedido($datos)
    {

        $tabla = "pedidos_detalle";
        $item  = 'n_interno';
        $valor = $datos['datoInterno'];
        
        $total = ModeloPedidos::mdlMostrarPedidoDetalle($tabla, $item, $valor);

        $valorT = 0;
        $valorTotal =0;

        for ($i = 0; $i < count($total); $i++){
            
            $valorT = intval($total[$i]['Ped_valor_uni']) * intval($total[$i]['Ped_cantidad']);
            $valorTotal += $valorT;

        }
            

        $datosPedido = array(
            "idSoñadora"       => $datos["idSoñadora"],
            "datoInterno"      => $datos["datoInterno"],
            "comprobante"      => $datos["comprobante"],
            "fecha"            => $datos["fecha"],
            "estado"           => $datos["estado"],
            "total"            => $valorTotal,
        );

        $respuesta = ModeloPedidos::mdlCrearPedido('pedidos', $datosPedido);

        return $respuesta;
    }

    public static function ctrMostrarPedidosSoñador($item, $valor, $item1,$valor1){

        $tabla = 'pedidos';

        $respuesta = ModeloPedidos::mdlMostrarPedidosSoñador($tabla, $item, $valor, $item1, $valor1);

        return $respuesta;


    }

    public static function ctrCrearCliente($datos){

        $datosCliente = array(
            
            "nombres"          => $datos["nombres"],
            "apellidos"        => $datos["apellidos"],
            "celular"          => $datos["celular"],
            "email"            => $datos["email"],
            "pote"             => $datos["pote"],
            "soñadora_id"      => $datos["soñadora"],
       );


        $tabla = 'clientes';

        $respuesta = ModeloPedidos::mdlCrearCliente($tabla, $datosCliente);

        return $respuesta;


    }

    public static function ctrMostrarPedidosPendientes($item, $valor){

        $tabla = 'pedidos';

        $respuesta = ModeloPedidos::mdlMostrarPedidosPendientes($tabla, $item, $valor);

        return $respuesta;


    }

    public static function ctrbuscarPedido($item, $valor){

        $tabla = 'pedidos';

        $respuesta = ModeloPedidos::mdlbuscarPedido($tabla, $item, $valor);

        return $respuesta;


    }

    public static function ctractualizarEstadoPedido($estado, $item, $item1, $valor){

        $tabla = 'pedidos';
        $tabla1 = 'pedidos_detalle';

        $respuesta = ModeloPedidos::mdlactualizarEstadoPedido($tabla, $tabla1, $estado, $item, $item1, $valor);

        return $respuesta;


    }


    public static function ctractualizarEnvioPedido($guia,$empresa,$item,$valor){
        
        $tabla = 'pedidos';
        
        $respuesta = ModeloPedidos::mdlactualizarEnvioPedido($tabla, $guia, $empresa, $item, $valor);

        return $respuesta;
    }


    public static function ctractualizarFotoPedido($foto,$item,$valor){
        
        $tabla = 'pedidos';

        $respuesta = ModeloPedidos::mdlactualizarFotoPedido($tabla, $foto, $item, $valor);

        return $respuesta;
    }

    public static function ctrbuscarPedidoDetalle($item, $valor){

        $tabla = 'pedidos_detalle';

        $respuesta = ModeloPedidos::mdlbuscarPedidoDetalle($tabla, $item, $valor);

        return $respuesta;


    }


    public static function ctrMostrarPedidos(){

        $respuesta = ModeloPedidos::mdlmostrarPedidos();

        return $respuesta;

    }









}