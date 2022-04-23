<?php
require_once "../controladores/productos.controlador.php";
require_once "../modelos/producto.modelo.php";

require_once "../controladores/pedidos.controlador.php";
require_once "../modelos/pedido.modelo.php";



class TablaPedidos
{

    public function guardarDetallePedido(){

        $datos = array(
            "datoInterno"          => $this->id_interno,
            "producto_id"          => $this->producto_id,
            "cantidad"             => $this->cantidad,
            "estado"               => '1',
        );

        $respuesta = ControladorPedidos::ctrCrearPedidosDetalle($datos);

        if($respuesta == 'ok'){

            $item = 'n_interno';
            $valor = $this->id_interno;
            
            
            $mostrarPedidoDetalle = ControladorPedidos::ctrMostrarPedidoDetalle($item, $valor);
            
            echo json_encode($mostrarPedidoDetalle);
            
    }else{

        echo $respuesta;
    }
}

    public function borrarDetallePedido(){

        $item = 'id';
        $valor = $this->id;

        $respuesta = ControladorPedidos::ctrBorrarPedidoDetalle($item, $valor);
        
        
        if($respuesta == 'ok'){

            $item = 'n_interno';
            $valor = $this->id_interno;
            
            $mostrarPedidoDetalle = ControladorPedidos::ctrMostrarPedidoDetalle($item, $valor);
            
        echo json_encode($mostrarPedidoDetalle);
        }
            
    }

    public function borrarPedido(){
        
        $item = 'n_interno';
        $valor = $this->id_interno;

        $respuesta = ControladorPedidos::ctrBorrarPedidoDetalle($item, $valor);

        echo $respuesta;
    }

        public function crearPedido(){

            $datos = array(
                "idSoñadora"           => $this->idSoñadora,
                "datoInterno"          => $this->datoInterno,
                "comprobante"          => $this->comprobante,
                "fecha"                => $this->fecha,
                "estado"               => '1',
            );

                    
            $respuesta = ControladorPedidos::ctrCrearPedido($datos);

            echo json_encode($respuesta);

    }

    public function crearCita(){

        $datos = array(
            "fecha"                => $this->fecha,
            "hora"                 => $this->hora,
            "nombre"               => $this->nombres,
            "celular"              => $this->celular,
            "pote"                 => $this->pote,
            "acta"                 => $this->acta,
            "servicio"             => $this->servicio,
            "soñadora"             => $this->soñadora,
        );

                        
        $respuesta = ControladorPedidos::ctrCrearCita($datos);

        echo ($respuesta);

        
        
       


}

        
}



// EJECUTAR PROCESO
if(isset($_POST["item"])){
$mostrarPedidos = new TablaPedidos();
$mostrarPedidos->id_interno        = $_POST["datoInterno"];
$mostrarPedidos->producto_id       = $_POST["item"];
$mostrarPedidos->cantidad          = $_POST["cantidad"];
$mostrarPedidos->guardarDetallePedido();
}

if(isset($_POST["verDetalleId"])){
    $borrarItemPedidos = new TablaPedidos();
    $borrarItemPedidos->id              = $_POST["verDetalleId"];
    $borrarItemPedidos->id_interno      = $_POST["datoInterno"];
    $borrarItemPedidos->borrarDetallePedido();
    }

if(isset($_POST["datoInternoB"])){
    $borrarItemsPedidos = new TablaPedidos();
    $borrarItemsPedidos->id_interno      = $_POST["datoInternoB"];
    $borrarItemsPedidos->borrarPedido();
    }
    
if(isset($_POST["idSoñadora"])){

    $filename = $_FILES['comprobante']['name'];
    $ext = pathinfo($filename, PATHINFO_EXTENSION);
    $ubicacionTemporal =  $_FILES['comprobante']['tmp_name'];

    $ale = rand();
    $aleatorio = $ale."."; 
    $ruta = "../vistas/img/comprobantes/";
    $rutaFinal = $ruta.$aleatorio.$ext;

    copy($ubicacionTemporal , $rutaFinal);
        
    date_default_timezone_set("America/Bogota");
        
        $crearPedido = new TablaPedidos();
        $crearPedido->idSoñadora      = $_POST["idSoñadora"];
        $crearPedido->datoInterno     = $_POST["datoInterno"];
        $crearPedido->comprobante     = $rutaFinal;
        $fecha = date("d/m/Y");
        $crearPedido->fecha           = $fecha;
        $crearPedido->crearPedido();
}      

if(isset($_POST["pote"])){
    $crearCita = new TablaPedidos();
    $crearCita->fecha     = $_POST["fecha"];
    $crearCita->hora      = $_POST["hora"];
    $crearCita->nombres   = $_POST["nombres"];
    $crearCita->celular   = $_POST["celular"];
    $crearCita->pote      = $_POST["pote"];
    $crearCita->acta      = $_POST["acta"];
    $crearCita->servicio  = $_POST["servicio"];
    $crearCita->soñadora   = $_POST["soñadora"];
    $crearCita->crearCita();
    }


    
    

    
        




