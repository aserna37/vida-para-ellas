<?php
require_once "../controladores/pedidos.controlador.php";
require_once "../modelos/pedido.modelo.php";

class TablaPedidosTotales
{
    public function mostrarTablaPedidos(){
        
        $pedidos = ControladorPedidos::ctrMostrarPedidos();

        $number_filter_row = count($pedidos);
        $data = array();

        

        for ($i = 0; $i < count($pedidos); $i++){

            $valorEstado = $pedidos[$i]['Ped_estado']; 

            if( $valorEstado== '1'){
                $estado = '<h5><span class="badge bg-warning text-white">Pendiente</span></h5>';
            }elseif($valorEstado== '2'){
                $estado = '<h5><span class="badge bg-secondary text-white">Aprobado</span></h5>';
            }else{
                $estado = '<h5><span class="badge bg-success text-white">Enviado</span></h5>';
            }

            $acciones ="<button class='btn btn-dark text-white btn-sm btnPedidoDetalle' idPedido='" . $pedidos[$i]["Ped_id"] . "'>Detalles</button>";

                $sub_array = array();
                $sub_array[] = 'P'.''.date('Y').'-'.$pedidos[$i]['Ped_id'];
                $sub_array[] = $pedidos[$i]['Ped_fecha'];
                $sub_array[] = ucwords($pedidos[$i]['Ped_nombres']).' '.ucwords($pedidos[$i]['Ped_apellidos']);
                $sub_array[] = number_format($pedidos[$i]['Ped_valor']);
                $sub_array[] = $estado;
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



$mostrarPedidos = new TablaPedidosTotales();
$mostrarPedidos->mostrarTablaPedidos();












?>