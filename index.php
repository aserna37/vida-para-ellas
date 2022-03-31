<?php

require_once "controladores/plantilla.controlador.php";
require_once "controladores/login.controlador.php";
// require_once "controladores/productos.controlador.php";
require_once "controladores/departamento.controlador.php";
require_once "controladores/soñadores.controlador.php";

require_once "modelos/usuario.modelo.php";
// require_once "modelos/productos.modelo.php";
require_once "modelos/departamento.modelo.php";
require_once "modelos/soñador.modelo.php";
// require_once "modelos/rutas.php";

$plantilla = new ControladorPlantilla();
$plantilla->ctrPlantilla();



?>