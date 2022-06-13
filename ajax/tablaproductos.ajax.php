<?php
require_once "../controladores/productos.controlador.php";
require_once "../modelos/producto.modelo.php";

class TablaProductos
{

    public function mostrarTablaProductos(){

        $item  = null;
        $valor = null;

        $productos = ControladorProductos::ctrMostrarProductos($item, $valor);

        $number_filter_row = count($productos);
        $data = array();

        for ($i = 0; $i < count($productos); $i++){

            
            
            /*=============================================
                AGREGAR ETIQUETAS DE ESTADO
                =============================================*/
                if ($productos[$i]["estado"] == 0) {
                    $colorEstado    = "btn-danger";
                    $textoEstado    = "Inactivo";
                    $estadoProducto = 0;
                } else {
                    $colorEstado    = "btn-success";
                    $textoEstado    = "Activo";
                    $estadoProducto = 1;
                }
                
                $estado = "<button class='btn btn-sm btnActivar " . $colorEstado . "' idProducto='" . $productos[$i]["id"] . "' estadoProducto='" . $estadoProducto . "'>" . $textoEstado . "</button>";
                $acciones = "<div class='btn-group'><button class='btn btn-info btn-sm btnEditarProducto' idProducto='" . $productos[$i]["id"] . "' data-toggle='modal' data-target='#modalEditarProducto'>Editar</button></div>";


                $sub_array = array();
                $sub_array[] = ucfirst($productos[$i]["nombre"]);
                $sub_array[] = number_format($productos[$i]["valor_unidad"]);
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


// EJECUTAR PROCESO

$mostrarProductos = new TablaProductos();
$mostrarProductos->mostrarTablaProductos();
    

    
        




