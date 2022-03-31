<?php

require_once "../modelos/conexion.php";

    $tabla = 'municipios';
    $item = 'departamento_id';
    $valor = $_POST['departamento'];

    $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item order by nombre ASC");

    $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

    $stmt->execute();
        

        $cadena="<label for='documento' class='col-form-label col-form-label-sm'>Municipio</label> 
        <select class='form-control form-control-sm rounded' name='municipio_id' id='municipio_id' required>
        <option selected value=''>Seleccione...</option>";

        while($value = $stmt->fetch(PDO::FETCH_ASSOC)){
            $cadena=$cadena.'<option value="' . $value["id"] . '">' . $value["nombre"] . '</option>';
        }

        echo  $cadena."</select>";
    












?>
                        