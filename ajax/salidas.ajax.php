<?php

require_once "../controladores/salidas.controlador.php";
require_once "../modelos/salida.modelo.php";

require_once "../controladores/productos.controlador.php";
require_once "../modelos/producto.modelo.php";

class AjaxSalidas
{

   public function ajaxCrearSalida()
        {
            $datos = array(
                "producto_id"     => $this->producto_id,
                "fecha"           => $this->fecha,
                "cantidad"        => $this->cantidad,
                "observaciones"   => $this->observaciones,
            );

            $respuesta = ControladorSalidas::ctrAgregarSalidas($datos);

            if($respuesta == 'ok'){

                $item = 'producto_id';
                $valor = $this->producto_id;
                
                $cantidadProducto = $this->cantidad;

                $buscarSalida = ControladorProductos::ctrbuscarProductoSalida($item, $valor);

                $item = $buscarSalida[0]['producto_id'];
                        $valor = intval($buscarSalida[0]['total']) + intval($cantidadProducto);
                        
                        $actualizarSalida = ControladorProductos::ctrActualizarProductoSalida($item, $valor);
            
                        echo 'ok';

                    }

           
        } 

        public function ajaxMostrarSalida()
        {
            $item = 'id';
            $valor = $this->id;

            $respuesta = ControladorSalidas::ctrMostrarSalida($item, $valor);

            $dato = $respuesta[0]['observaciones'];

            echo "<p class='text-center'>$dato</p>";
            
        } 


    
    }


// CREAR SALIDA*************************************************


if (isset($_POST["producto_id"])) {

    $nuevaSalida                 = new AjaxSalidas();
    $nuevaSalida->producto_id    = $_POST["producto_id"];
    $fecha = date("d/m/Y");
    $nuevaSalida->fecha          = $fecha;
    $nuevaSalida->cantidad       = $_POST["cantidad"];
    $nuevaSalida->observaciones  = $_POST["observaciones"];
    $nuevaSalida->ajaxCrearSalida();

}

if (isset($_POST["idSalida"])) {

    $verSalida                 = new AjaxSalidas();
    $verSalida->id             = $_POST["idSalida"];
    $verSalida->ajaxMostrarSalida();

}


?>