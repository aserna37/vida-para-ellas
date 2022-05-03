<?php
require_once "../controladores/pedidos.controlador.php";
require_once "../modelos/pedido.modelo.php";

class TablaPedidos
{

    public function mostrarTablaPedidosPendientes(){

        $item  = "estado";
        $valor = "1";

        $pedidos = ControladorPedidos::ctrMostrarPedidosPendientes($item, $valor);

        $number_filter_row = count($pedidos);
        $data = array();

        for ($i = 0; $i < count($pedidos); $i++){

                  
            /*=============================================
                AGREGAR ETIQUETAS DE ESTADO
                =============================================*/
                $acciones = "<button class='btn btn-success btn-sm btnPendientePedido' idPedido='" . $pedidos[$i]["pedido"] . "'>Información pedido</button>";
                $pedido = 'P2022-'.$pedidos[$i]["pedido"];
                $nombres = ucwords($pedidos[$i]['nombres'])." ".ucwords($pedidos[$i]['apellidos']); 
                $sub_array = array();
                $sub_array[] = $pedido;
                $sub_array[] = $pedidos[$i]["fecha"];
                $sub_array[] = $nombres;
                $sub_array[] = $acciones;
                $data[] = $sub_array;

            }

            $output = array(
                'recordsTotal'  =>  $number_filter_row,
                'data'          =>  $data
            );

            echo json_encode($output);

    }
}


// EJECUTAR PROCESO

$mostrarPedidos = new TablaPedidos();
$mostrarPedidos->mostrarTablaPedidosPendientes();
    

    
        




