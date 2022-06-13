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
                $Sal_total = "" . $stocks[$i]["Sal_total"] . " unidades";
                $disponible = intval($stocks[$i]["Pro_total"]) - intval($stocks[$i]["Sal_total"]);

                if($disponible < 20){
                    $verCantidad = "<h5><span class='badge rounded-pill bg-danger text-white'>".$disponible." Unidades</span></h5>";
                }else{
                    $verCantidad = "<h5><span class='badge rounded-pill bg-success text-white'>".$disponible." Unidades</span></h5>";
                }

                $sub_array = array();
                $sub_array[] = ucfirst($stocks[$i]["Pro_nombre"]);
                $sub_array[] = $Pro_total;
                $sub_array[] = $Sal_total;
                $sub_array[] = $verCantidad;
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
    

    
        




