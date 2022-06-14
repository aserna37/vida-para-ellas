<?php
require_once "../controladores/salidas.controlador.php";
require_once "../modelos/salida.modelo.php";

class TablaSalidas
{

    public function mostrarSalidas(){

        $salidas = ControladorSalidas::ctrMostrarSalidas();

        $number_filter_row = count($salidas);
        $data = array();

        for ($i = 0; $i < count($salidas); $i++){

            
                $acciones = "<div class='btn-group'><button class='btn btn-info btn-sm btnVerObservaciones' idSalida='" . $salidas[$i]["Sal_id"] . "'>Ver</button></div>";


                $sub_array = array();
                $sub_array[] = ucfirst($salidas[$i]["Pro_nombre"]);
                $sub_array[] = $salidas[$i]["Sal_fecha"];
                $sub_array[] = $salidas[$i]["Sal_cantidad"];
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

$mostrarSalidas = new TablaSalidas();
$mostrarSalidas->mostrarSalidas();
    

    
        




