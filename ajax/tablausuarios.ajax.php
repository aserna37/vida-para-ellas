<?php
require_once "../controladores/soñadores.controlador.php";
require_once "../modelos/soñador.modelo.php";

require_once "../controladores/roles.controlador.php";
require_once "../modelos/rol.modelo.php";


class TablaUsuarios
{

    public function mostrarTablaUsuarios(){

        $item  = "rol_id";
        $valor = '1';

        $usuarios = ControladorSoñadores::ctrMostrarSoñadores($item, $valor);

        $number_filter_row = count($usuarios);
        $data = array();

        for ($i = 0; $i < count($usuarios); $i++){

            $item       = "id";
            $valor      = $usuarios[$i]["rol_id"];
            
            $mostrarRol = ControladorRoles::ctrMostrarRoles($item, $valor);
            
            /*=============================================
                AGREGAR ETIQUETAS DE ESTADO
                =============================================*/
                if ($usuarios[$i]["estado"] == 0) {
                    $colorEstado    = "btn-danger";
                    $textoEstado    = "Desactivado";
                    $estadoSoñador = 0;
                } else {
                    $colorEstado    = "btn-success";
                    $textoEstado    = "Activado";
                    $estadoSoñador = 1;
                }
                
                $estado = "<button class='btn btn-sm btnActivar " . $colorEstado . "' idSoñador='" . $usuarios[$i]["id"] . "' estadoSoñador='" . $estadoSoñador . "' documentoSoñador='" . $usuarios[$i]["documento"] . "'>" . $textoEstado . "</button>";
                $acciones = "<div class='btn-group'><button class='btn btn-info btn-sm btnEditarSoñador' idSoñador='" . $usuarios[$i]["id"] . "' data-toggle='modal' data-target='#modalEditarSoñador'>Editar</button><button class='btn btn-warning btn-sm btnVerSoñador' verSoñador='" . $usuarios[$i]["id"] . "'>Ver</button></div>";

                $sub_array = array();
                $sub_array[] = $usuarios[$i]["documento"];
                $sub_array[] = $usuarios[$i]["nombres"];
                $sub_array[] = $usuarios[$i]["apellidos"];
                $sub_array[] = $mostrarRol["nombre"];
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

$mostrarUsuarios = new TablaUsuarios();
$mostrarUsuarios->mostrarTablaUsuarios();
    

    
        




