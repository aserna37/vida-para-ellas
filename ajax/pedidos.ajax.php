<?php

use Twilio\Rest\Client;

require_once '../vistas/plugins/twilio/src/Twilio/autoload.php';

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

            $item = 'pedidos_detalle.n_interno';
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

            $item = 'pedidos_detalle.n_interno';
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

    public function crearCliente(){

        $datos = array(
            "nombres"              => $this->nombres,
            "apellidos"            => $this->apellidos,
            "celular"              => $this->celular,
            "email"                => $this->email,
            "pote"                 => $this->pote,
            "soñadora"             => $this->soñadora,
        );

                        
        $respuesta = ControladorPedidos::ctrCrearCliente($datos);

        echo ($respuesta);

        $sid = 'ACcc04f68dc761d4dfd5d627f80eeb724a';
        $token = 'f73e9ebadc61a94ee911e164919e17c0';
        $client = new Client($sid, $token);

        $client->messages->create(
            // the number you'd like to send the message to
            '+57'.$this->celular.'',
            [
                // A Twilio phone number you purchased at twilio.com/console
                'from' => '+12074079698',
                // the body of the text message you'd like to send
                'body' => ''.ucwords($this->nombres).' '.ucwords($this->apellidos).'. Gracias por preferirnos!'
            ]
        );

}

    public function buscarPedido(){


        $item = 'id';
        $valor = $this->idPedido;

        $respuesta = ControladorPedidos::ctrbuscarPedido($item, $valor);

        for ($i = 0; $i < count($respuesta); $i++){

            $pedido = 'P2022-'.$respuesta[$i]["pedido"];
            $nombres = ucwords($respuesta[$i]['nombres'])." ".ucwords($respuesta[$i]['apellidos']);
            $total = '$'.number_format($respuesta[$i]['total']);
            $comprobante = $respuesta[$i]['comprobante'];
            $fecha = $respuesta[$i]['fecha'];
            $persona = $respuesta[$i]['persona'];

            $item = 'pedidos_detalle.pedido_id';
            $valor = $this->idPedido;
                  
            $respuestaDetalle = ControladorPedidos::ctrMostrarPedidoDetalle($item, $valor);

            $tablaDetalle='';
            for ($i = 0; $i < count($respuestaDetalle); $i++){

                $producto = ucwords($respuestaDetalle[$i]['Ped_nombre']);
                $cantidad = $respuestaDetalle[$i]['Ped_cantidad'];
                $disponible = $respuestaDetalle[$i]['Diferencia'];
                
                $tablaDetalle.="<tr><td>$producto</td><td>$cantidad Unidades</td><td><h5><span class='badge badge-pill badge-secondary'>$disponible Unidades</span></h5></td></tr>";
            }

            echo '<div class="row">
            <div class="col-3">
            <h4>Pedido:</h4>
            <h4>Soñador:</h4>
            <h4>Fecha:</h4>
            <h4>Valor:</h4>

            </div>
            <div class="col-9">
            <h4><span class="badge badge-pill badge-light">'.$pedido.'</span></h4>
            <h4><span class="badge badge-pill badge-light">'.$nombres.'</span></h4>
            <h4><span class="badge badge-pill badge-light">'.$fecha.'</span></h4>
            <h4><span class="badge badge-pill badge-success">'.$total.'</span></h4>

            </div>

          </div>

        <div class="row bg-light my-auto rounded">
                <div class="col-6">
                    <a class="btn btn-block btn-outline-secondary" href="vistas/img/comprobantes/'.$comprobante.'" target="_blank">Ver Comprobante</a>
                </div>
                <div class="col-6 ">
                    <button class="btn btn-block btn-outline-secondary btnRotulo" rotulo="'.$persona.'">Generar Rotulo de envio</button>
                </div>
                <div class="col-6">
                <label for="guia" class="col-form-label col-form-label-sm">No. Guia</label>
                <input type="text" class="form-control form-control-sm" id="guia" name="guia" placeholder="Guia" required>
                </div>
                <div class="col-6">
                <label class="col-form-label col-form-label-sm" for="empresa">Empresa de envio</label>
                <select class="form-control form-control-sm" id="empresa" name="empresa">
                  <option selected value="transprensa">TransPrensa</option>
                  <option value="envia">Envia</option>
                  <option value="interrapidisimo">Interrapidisimo</option>
        
                </select>
                </div>
        </div>
        <br>
        <div class="row bg-light my-auto rounded">
                <div class="col-12 text-center">
                        <h5>Detalle Pedido</h5>
                        <table class="table table-sm table-bordered">
                    <thead>
                    <tr>
                    <th scope="col">Producto</th>
                    <th scope="col">Cantidad</th>
                    <th scope="col">Disponible</th>
                    </tr>
                    </thead>
                    <tbody>
                    '.$tablaDetalle.'                
                    </tbody>
                    </table>
                
                </div>
                
        </div>        ';
        }
        
        

    }  
    
    public function actualizarEstadoPedido(){

        $estado = $this->estado; 
        $item = 'id';
        $item1 = 'pedido_id';
        $valor = $this->idPedido;
        
        

        if($estado == '2'){
            
            $guia = $this->guia;
            $empresa = $this->empresa;
            $envio = ControladorPedidos::ctractualizarEnvioPedido($guia,$empresa,$item,$valor);

            if ($envio == 'ok'){
             
                $respuesta = ControladorPedidos::ctractualizarEstadoPedido($estado, $item, $item1, $valor);
                
                echo $respuesta;
            }else{
                
                echo $envio;
            }

        }elseif($estado == '3'){
            
            $foto = $this->fotoPedido;
            $fotoR = ControladorPedidos::ctractualizarFotoPedido($foto,$item,$valor);

            if ($fotoR == 'ok'){
             
                $respuesta = ControladorPedidos::ctractualizarEstadoPedido($estado, $item, $item1, $valor);
                
                echo $respuesta;
                
                $salida = ControladorPedidos::ctrbuscarPedidoDetalle($item1,$valor);

                for ($i = 0; $i < count($salida); $i++){
                    
                    $item = 'producto_id';
                    $valor = $salida[$i]['producto_id'];
                    $cantidadProducto = $salida[$i]['cantidad'];

                    $buscarSalida = ControladorProductos::ctrbuscarProductoSalida($item, $valor);
                    
                    if(empty($buscarSalida)){
                                                
                        $ingresarSalida = ControladorProductos::ctrCrearProductoSalida($item, $valor, $cantidadProducto);
                        
                    }else{
                        
                        $item = $buscarSalida[0]['producto_id'];
                        $valor = intval($buscarSalida[0]['total']) + intval($cantidadProducto);
                        
                        $actualizarSalida = ControladorProductos::ctrActualizarProductoSalida($item, $valor);
                        
                        
                    
                    }
                }

            }else{
                
                echo $fotoR;
            }
        
        }



        
        
        



    }

    public function buscarPedidoE(){


        $item = 'pedidos_detalle.pedido_id';
        $valor = $this->idPedidoE;
                  
        $respuesta = ControladorPedidos::ctrMostrarPedidoDetalle($item, $valor);

        $img = '<img class="imgE" src="vistas/img/plantillas/wrong.png" width="40" height="40" class="rounded-circle">';
        
        for ($i = 0; $i < count($respuesta); $i++){

           echo '<tr class="text-center">
           <td>'.$img.'</td>
           <td>'.ucwords($respuesta[$i]['Ped_nombre']).'</td>
           <td>'.$respuesta[$i]['Ped_cantidad'].'</td>
         </tr>';

            
        }
        
        

    }  


    public function buscarPedidoF(){


        $item = 'id';
        $valor = $this->idPedido;

        $respuesta = ControladorPedidos::ctrbuscarPedido($item, $valor);

        for ($i = 0; $i < count($respuesta); $i++){

            $pedido = 'P2022-'.$respuesta[$i]["pedido"];
            $nombres = ucwords($respuesta[$i]['nombres'])." ".ucwords($respuesta[$i]['apellidos']);
            $fecha = $respuesta[$i]['fecha'];
            $total = '$'.number_format($respuesta[$i]['total']);
            $comprobante = $respuesta[$i]['comprobante'];
            $guia = $respuesta[$i]['guia'];
            $empresa = ucwords($respuesta[$i]['empresa']);
            $link = '';
            
            if($empresa == 'transprensa'){
                $link = "https://transprensa.com/Seguimiento/?remesa_codigo=";                
            }elseif ($empresa == 'envia') {
                $link = "https://envia.co/";
            }else{
                $link = "https://www.interrapidisimo.com/sigue-tu-envio/?guia=";
            }

            $item = 'pedidos_detalle.pedido_id';
            $valor = $this->idPedido;
                  
            $respuestaDetalle = ControladorPedidos::ctrMostrarPedidoDetalle($item, $valor);

            $tablaDetalle='';
            for ($i = 0; $i < count($respuestaDetalle); $i++){

                $producto = ucwords($respuestaDetalle[$i]['Ped_nombre']);
                $cantidad = $respuestaDetalle[$i]['Ped_cantidad'];
                
                $tablaDetalle.="<tr><td>$producto</td><td>$cantidad</td></tr>";
            }
            



            echo '<div class="row">
            <div class="col-3">
            <h4>Pedido:</h4>
            <h4>Soñador:</h4>
            <h4>Fecha:</h4>
            <h4>Valor:</h4>
            <h4>Guia:</h4>
            <h4>Empresa:</h4>

            </div>
            <div class="col-9">
            <h4><span class="badge badge-pill badge-light">'.$pedido.'</span></h4>
            <h4><span class="badge badge-pill badge-light">'.$nombres.'</span></h4>
            <h4><span class="badge badge-pill badge-light">'.$fecha.'</span></h4>
            <h4><span class="badge badge-pill badge-light">'.$total.'</span></h4>
            <a href="'.$link.''.$guia.'" target="blank"><h4><span class="badge badge-pill badge-success">'.$guia.'</span></h4></a>
            <h4><span class="badge badge-pill badge-success">'.$empresa.'</span></h4>

            </div>

          </div>

        <div class="row bg-light my-auto rounded">
                <div class="col-12 text-center">
                        <h5>Detalle Pedido</h5>
                        <table class="table table-sm table-bordered">
                    <thead>
                    <tr>
                    <th scope="col">Producto</th>
                    <th scope="col">Cantidad</th>
                    </tr>
                    </thead>
                    <tbody>
                    '.$tablaDetalle.'
                    
                    </tbody>
                    </table>
                
                </div>
                
        </div>        ';
        }
        
        

    }
    
    
    public function buscarPedidoDetalle(){


        $item = 'id';
        $valor = $this->idPedido;

        $respuesta = ControladorPedidos::ctrbuscarPedido($item, $valor);

        for ($i = 0; $i < count($respuesta); $i++){

            $pedido = 'P2022-'.$respuesta[$i]["pedido"];
            $nombres = ucwords($respuesta[$i]['nombres'])." ".ucwords($respuesta[$i]['apellidos']);
            $fecha = $respuesta[$i]['fecha'];
            $total = '$'.number_format($respuesta[$i]['total']);
            $comprobante = $respuesta[$i]['comprobante'];
            $guia = $respuesta[$i]['guia'];
            $empresa = ucwords($respuesta[$i]['empresa']);
            $link = '';
            
            if($empresa == 'transprensa'){
                $link = "https://transprensa.com/Seguimiento/?remesa_codigo=";                
            }elseif ($empresa == 'envia') {
                $link = "https://envia.co/";
            }else{
                $link = "https://www.interrapidisimo.com/sigue-tu-envio/?guia=";
            }

            $item = 'pedidos_detalle.pedido_id';
            $valor = $this->idPedido;
                  
            $respuestaDetalle = ControladorPedidos::ctrMostrarPedidoDetalle($item, $valor);

            $tablaDetalle='';
            for ($i = 0; $i < count($respuestaDetalle); $i++){

                $producto = ucwords($respuestaDetalle[$i]['Ped_nombre']);
                $cantidad = $respuestaDetalle[$i]['Ped_cantidad'];
                
                $tablaDetalle.="<tr><td>$producto</td><td>$cantidad</td></tr>";
            }
            



            echo '<div class="row">
            <div class="col-5">
            <h4>Pedido:</h4>
            <h4>Soñador:</h4>
            <h4>Fecha:</h4>
            <h4>Valor:</h4>
            <h4>Comprobante:</h4>
            <h4>Guia:</h4>
            <h4>Empresa:</h4>

            </div>
            <div class="col-7">
            <h4><span class="badge badge-pill badge-light">'.$pedido.'</span></h4>
            <h4><span class="badge badge-pill badge-light">'.$nombres.'</span></h4>
            <h4><span class="badge badge-pill badge-light">'.$fecha.'</span></h4>
            <h4><span class="badge badge-pill badge-light">'.$total.'</span></h4>
            <a class="btn btn-block btn-sm btn-outline-secondary" href="vistas/img/comprobantes/'.$comprobante.'" target="_blank">Ver Comprobante</a>
            <a href="'.$link.''.$guia.'" target="blank"><h4><span class="badge badge-pill badge-success">'.$guia.'</span></h4></a>
            <h4><span class="badge badge-pill badge-success">'.$empresa.'</span></h4>

            </div>

          </div>

        <div class="row bg-light my-auto rounded">
                <div class="col-12 text-center">
                        <h5>Detalle Pedido</h5>
                        <table class="table table-sm table-bordered">
                    <thead>
                    <tr>
                    <th scope="col">Producto</th>
                    <th scope="col">Cantidad</th>
                    </tr>
                    </thead>
                    <tbody>
                    '.$tablaDetalle.'
                    
                    </tbody>
                    </table>
                
                </div>
                
        </div>        ';
        }
        
        

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
    $rutaFinal  = $ruta.$aleatorio.$ext;
    $rutaGrabar = $aleatorio.$ext;

    copy($ubicacionTemporal , $rutaFinal);
        
    date_default_timezone_set("America/Bogota");
        
        $crearPedido = new TablaPedidos();
        $crearPedido->idSoñadora      = $_POST["idSoñadora"];
        $crearPedido->datoInterno     = $_POST["datoInterno"];
        $crearPedido->comprobante     = $rutaGrabar;
        $fecha = date("d/m/Y");
        $crearPedido->fecha           = $fecha;
        $crearPedido->crearPedido();
}      

if(isset($_POST["pote"])){
    $crearCita = new TablaPedidos();
    $crearCita->nombres     = strtolower($_POST["nombres"]);
    $crearCita->apellidos   = strtolower($_POST["apellidos"]);
    $crearCita->celular     = $_POST["celular"];
    $crearCita->email       = strtolower($_POST["email"]);
    $crearCita->pote        = $_POST["pote"];
    $crearCita->soñadora    = $_POST["soñadora"];
    $crearCita->crearCliente();
    }


    if(isset($_POST["idPedido"])){
        $buscarPedido = new TablaPedidos();
        $buscarPedido->idPedido     = $_POST["idPedido"];
        $buscarPedido->buscarPedido();
        }

    if(isset($_POST["idPedidoD"])){
        $buscarPedido = new TablaPedidos();
        $buscarPedido->idPedido     = $_POST["idPedidoD"];
        $buscarPedido->buscarPedidoDetalle();
        }    

    if(isset($_POST["idPedidoF"])){
        $buscarPedido = new TablaPedidos();
        $buscarPedido->idPedido     = $_POST["idPedidoF"];
        $buscarPedido->buscarPedidoF();
        }    

    
    if(isset($_POST["datoPedido"])){
        $actualizarPedido = new TablaPedidos();
        $actualizarPedido->idPedido         = $_POST["datoPedido"];
        $actualizarPedido->guia = $_POST['guia'];
        $actualizarPedido->empresa = $_POST['empresa'];
        $actualizarPedido->estado = 2;
        $actualizarPedido->actualizarEstadoPedido();
        }
        
    if(isset($_POST["idPedidoE"])){
        $buscarPedidoE = new TablaPedidos();
        $buscarPedidoE->idPedidoE     = $_POST["idPedidoE"];
        $buscarPedidoE->buscarPedidoE();
        } 
        
    if(isset($_POST["datoPedidoE"])){

        $filename = $_FILES['fotoPedidoE']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $ubicacionTemporal =  $_FILES['fotoPedidoE']['tmp_name'];

        $ale = rand();
        $aleatorio = $ale."."; 
        $ruta = "../vistas/img/pedidos/";
        $rutaFinal  = $ruta.$aleatorio.$ext;
        $rutaGrabar = $aleatorio.$ext;

        copy($ubicacionTemporal , $rutaFinal);

        $actualizarPedido = new TablaPedidos();
        $actualizarPedido->idPedido         = $_POST["datoPedidoE"];
        $actualizarPedido->fotoPedido       = $rutaGrabar;
        $actualizarPedido->estado = 3;
        $actualizarPedido->actualizarEstadoPedido();
        }    



            


    
    

    
        




