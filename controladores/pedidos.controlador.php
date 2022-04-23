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

    public static function ctrCrearCita($datos){

        $datosCita = array(
            "fecha"            => $datos["fecha"],
            "hora"             => $datos["hora"],
            "nombres"          => $datos["nombre"],
            "celular"          => $datos["celular"],
            "pote"             => $datos["pote"],
            "acta"             => $datos["acta"],
            "servicio"         => $datos["servicio"],
            "soñadora_id"      => $datos["soñadora"],
       );


        $tabla = 'citas';

        $respuesta = ModeloPedidos::mdlCrearCita($tabla, $datosCita);

        return $respuesta;


    }

    public static function ctrMostrarCitasSoñador($item, $valor){

        $tabla = 'citas';

        $respuesta = ModeloPedidos::mdlMostrarCitasSoñador($tabla, $item, $valor);

        return $respuesta;


    }







}