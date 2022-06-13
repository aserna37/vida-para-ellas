<?php

require_once "../controladores/productos.controlador.php";
require_once "../modelos/producto.modelo.php";

class AjaxProductos
{

   public function ajaxCrearProducto()
        {
            $datos = array(
                "nombre"          => $this->nombre,
                "valor_unidad"    => $this->valor_unidad,
                "estado"          => $this->estado,
            );

            $respuesta = ControladorProductos::ctrCrearProducto($datos);

            echo $respuesta;
            
        } 


    public function ajaxEstadoProducto()
        {
            $item1 = $this->activarProducto;
            $item2 = $this->activarId;
                        
            $respuesta = ControladorProductos::ctrEstadoProducto($item1, $item2);

            echo $respuesta;


        }

    public function ajaxVerProducto()
        {
            $item = "id";
            $valor = $this->verProducto;
            

            $respuesta = ControladorProductos::ctrMostrarProducto($item, $valor);

            for ($i = 0; $i < count($respuesta); $i++) {

                $datos = [
                "id"                   => $respuesta[$i]["id"], 
                "nombre"               => $respuesta[$i]["nombre"],    
                "valor_unidad"         => $respuesta[$i]["valor_unidad"],
                ];
            }
            
            echo json_encode($datos);


        }

    public function ajaxEditarProducto()
        {
            $datos = array(
                "id"                       => $this->id,
                "nombre"                   => $this->nombre,
                "valor_unidad"             => $this->valor_unidad,
                "fecha_modificacion"       => $this->fecha_modificacion,
            );

            $respuesta = ControladorProductos::ctrEditarProducto($datos);

            echo $respuesta;

        }

    public function ajaxCantidadProductoDetalle()
        {
            $datos = array(
                "producto_id"       => $this->producto_id,
                "cantidad"          => $this->cantidad,
                "fecha"             => $this->fecha,
            );

            $respuesta = ControladorProductos::ctrGuardarProductoDetalle($datos);

            echo $respuesta;

            
        }
        
        public function ajaxStockProductoDetalle()
        { 
            $item = "producto_id";
            $valor = $this->verProductoId;
            

            $respuesta = ControladorProductos::ctrMostrarStockDetalle($item, $valor);

            echo json_encode($respuesta);

        }

    }


// CREAR PRODUCTOS*************************************************

if (isset($_POST["opcion"])) {

    if($_POST["opcion"]=='1'){

            date_default_timezone_set("America/Bogota");

            $producto                 = new AjaxProductos();
            $producto->nombre          = strtolower($_POST["nombre"]);
            $producto->valor_unidad    = $_POST["valor_unidad"];
            $producto->estado          = $_POST["estado"];
            $producto->ajaxCrearProducto();
    }


    
    
}

if (isset($_POST["estadoProducto"])) {

    if($_POST["estadoProducto"]=='1'){

        $activarProducto                    = new AjaxProductos();
        $activarProducto->activarProducto   = 0;
        $activarProducto->activarId         = $_POST["idProducto"];
        $activarProducto->ajaxEstadoProducto();
    }else{
        $activarProducto                    = new AjaxProductos();
        $activarProducto->activarProducto   = 1;
        $activarProducto->activarId         = $_POST["idProducto"];
        $activarProducto->ajaxEstadoProducto();
    }

}

if (isset($_POST["idverProducto"])) {

    $verProducto                 = new AjaxProductos();
    $verProducto->verProducto    = $_POST["idverProducto"];
    $verProducto->ajaxVerProducto();

}

if (isset($_POST["eopcion"])) {
            
                       
    if($_POST["eopcion"]=='2'){

        date_default_timezone_set("America/Bogota");
        
        $producto                   = new AjaxProductos();
        $producto->id               = $_POST["eid"];
        $producto->nombre           = strtolower($_POST["enombre"]);
        $producto->valor_unidad     = $_POST["evalor_unidad"];
        $fecha = date("d/m/Y H:i:s");
        $producto->fecha_modificacion = $fecha;
        
        $producto->ajaxEditarProducto();
    }
    
}
    //***********INGRESAR AL STOCKS***************************** */
    
    if (isset($_POST["producto_id"])) {
            
                       
         date_default_timezone_set("America/Bogota");
            
            $productoDetalle                   = new AjaxProductos();
            $productoDetalle->producto_id      = $_POST["producto_id"];
            $productoDetalle->cantidad         = $_POST["cantidad"];
            $fecha = date("d/m/Y");
            $productoDetalle->fecha            = $fecha;
            
            $productoDetalle->ajaxCantidadProductoDetalle();
        }
    
    // ************************************************************

    // DETALLE STOCKS

    if (isset($_POST["verProductoId"])) {
            
           $productoDetallePro                   = new AjaxProductos();
           $productoDetallePro->verProductoId      = $_POST["verProductoId"];
           
           
           $productoDetallePro->ajaxStockProductoDetalle();
       }


    // ************************************************************

    




?>