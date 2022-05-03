<?php
require_once "./controladores/soñadores.controlador.php";
require_once "./modelos/soñador.modelo.php";

require_once "./controladores/departamento.controlador.php";
require_once "./modelos/departamento.modelo.php";


ob_start();

$link =  $_SERVER['REQUEST_URI'];
$idPersona = explode("=",$link);

$item = "id";
$valor = $idPersona[1];

$nombreImagen = "/vistas/img/plantillas/logo.png";
$imagenBase64 = "data:image/png;base64," . base64_encode(file_get_contents($nombreImagen));


$respuesta = ControladorSoñadores::ctrMostrarSoñador($item, $valor);

for ($i = 0; $i < count($respuesta); $i++) {

    $item       = "municipios.id";
    $valor      = $respuesta[$i]["municipio_id"];

    $mostrarMunicipios = ControladorDepartamentos::ctrMostrarDepartamentoMunicipio($item, $valor);


?>

<div class="container p-3 contenedor_rotulo">
    <div class="row">
        <div class="col-5 ml-2">
            <h4>Soñador: </h4><h2 ><?php echo ucwords($respuesta[$i]["nombres"]).' '.ucwords($respuesta[$i]["apellidos"]); ?></h2>
            <h4>Dirección: </h4><h2><?php echo $respuesta[$i]["direccion"]; ?></h2>
            <h4>Celular: </h4><h2><?php echo $respuesta[$i]["celular"]; ?></h2>
            <h4>Municipio: </h4><h2><?php echo $mostrarMunicipios["Mun_nombre"]; ?></h2>
            <h4>Departamento: </h4><h2><?php echo $mostrarMunicipios["Dep_nombre"]; ?></h2>
        </div>
        <div class="col-5 text-center">
            <br>
            <img src="<?php echo $imagenBase64 ?>" width="380px" alt="">
        </div>

    </div>

</div>

<?php
}

$html = ob_get_clean();

require 'vendor/autoload.php';



use Dompdf\Dompdf;
use Dompdf\Option;
use Dompdf\Exception as DomException;
use Dompdf\Options;

$dompdf = new Dompdf(array('enable_remote' => true));

$options = $dompdf->getOptions();
$dompdf->setOptions($options);
$dompdf->loadHtml($html);
$dompdf->setPaper('A5', 'landscape');
$dompdf->render();
header("Content-type: application/pdf");
header("Content-Disposition: inline; filename=documento.pdf");
echo $dompdf->output();
// $contenido = $dompdf->output();
// $nombreDelDocumento = "1.pdf";
// $dompdf->stream('render.pdf', ['attachment' => true]);
// $bytes = file_put_contents($nombreDelDocumento, $contenido);








?>