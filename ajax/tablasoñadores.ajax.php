<?php
require_once "../controladores/soñadores.controlador.php";
require_once "../modelos/soñador.modelo.php";

require_once "../controladores/departamento.controlador.php";
require_once "../modelos/departamento.modelo.php";

class TablaSoñadores
{

    public function mostrarTablaSoñadores(){

        $item  = "rol_id";
        $valor = "4";

        $soñadores = ControladorSoñadores::ctrMostrarSoñadores($item, $valor);

        $number_filter_row = count($soñadores);
        $data = array();

        for ($i = 0; $i < count($soñadores); $i++){

            $item       = "municipios.id";
            $valor      = $soñadores[$i]["municipio_id"];
            
            $mostrarMunicipios = ControladorDepartamentos::ctrMostrarDepartamentoMunicipio($item, $valor);
            
            /*=============================================
                AGREGAR ETIQUETAS DE ESTADO
                =============================================*/
                if ($soñadores[$i]["estado"] == 0) {
                    $colorEstado    = "btn-danger";
                    $textoEstado    = "Desactivado";
                    $estadoSoñador = 0;
                } else {
                    $colorEstado    = "btn-success";
                    $textoEstado    = "Activado";
                    $estadoSoñador = 1;
                }
                
                $estado = "<button class='btn btn-sm btnActivar " . $colorEstado . "' idSoñador='" . $soñadores[$i]["id"] . "' estadoSoñador='" . $estadoSoñador . "' documentoSoñador='" . $soñadores[$i]["documento"] . "'>" . $textoEstado . "</button>";
                $acciones = "<div class='btn-group'><button class='btn btn-info btn-sm btnEditarSoñador' idSoñador='" . $soñadores[$i]["id"] . "' data-toggle='modal' data-target='#modalEditarSoñador'>Editar</button><button class='btn btn-warning btn-sm btnVerSoñador' verSoñador='" . $soñadores[$i]["id"] . "'>Ver</button></div>";

                $sub_array = array();
                $sub_array[] = $soñadores[$i]["documento"];
                $sub_array[] = ucwords($soñadores[$i]["nombres"]);
                $sub_array[] = ucwords($soñadores[$i]["apellidos"]);
                $sub_array[] = $mostrarMunicipios["Mun_nombre"];
                $sub_array[] = $mostrarMunicipios["Dep_nombre"];
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

$mostrarSoñadoras = new TablaSoñadores();
$mostrarSoñadoras->mostrarTablaSoñadores();
    

    
        




