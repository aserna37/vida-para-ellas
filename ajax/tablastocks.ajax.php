<?php
require_once "../controladores/productos.controlador.php";
require_once "../modelos/producto.modelo.php";

class TablaStocks
{

    public function mostrarTablaStocks(){

        
        $stocks = ControladorProductos::ctrMostrarStocks();

        $number_filter_row = count($stocks);
        $data = array();

        for ($i = 0; $i < count($stocks); $i++){

            $acciones = "<div class='btn-group'><button class='btn btn-warning btn-sm btnVerProductoDetalle' verProductoId='" . $stocks[$i]["Pro_id"] . "'>Ver Detalle</button></div>";

                $Pro_total = "" . $stocks[$i]["Pro_total"] . " unidades";
                

                $sub_array = array();
                $sub_array[] = $stocks[$i]["Pro_nombre"];
                $sub_array[] = $Pro_total;
                $sub_array[] = 0;
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

$mostrarProductos = new TablaStocks();
$mostrarProductos->mostrarTablaStocks();
    

    
        




