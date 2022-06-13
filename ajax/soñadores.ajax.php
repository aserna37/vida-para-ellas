<?php

require_once "../controladores/soñadores.controlador.php";
require_once "../modelos/soñador.modelo.php";

require_once "../controladores/departamento.controlador.php";
require_once "../modelos/departamento.modelo.php";

require_once "../controladores/usuarios.controlador.php";
require_once "../modelos/usuario.modelo.php";

require_once "../controladores/lideres.controlador.php";
require_once "../modelos/lider.modelo.php";



use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require_once '../vistas/plugins/PHPMailer/src/Exception.php';
require_once '../vistas/plugins/PHPMailer/src/PHPMailer.php';
require_once '../vistas/plugins/PHPMailer/src/SMTP.php';



class AjaxSoñadores
{

    

    public function ajaxCrearSoñador()
        {
            $datos = array(
                "tipo"          => $this->tipo,
                "documento"     => $this->documento,
                "nombres"       => $this->nombres,
                "apellidos"     => $this->apellidos,
                "f_nacimiento"  => $this->f_nacimiento,
                "sexo"          => $this->sexo,
                "direccion"     => $this->direccion,
                "celular"       => $this->celular,
                "email"         => $this->email,
                "municipio_id"  => $this->municipio_id,
                "estado"        => $this->estado,
                "rol_id"        => $this->rol_id,
                "lider"        => $this->lider,
                "lider_documento" => $this->liderdocumento,
            );

                        
            $respuesta = ControladorSoñadores::ctrCrearSoñador($datos);

            echo $respuesta;

            if($respuesta == 'ok'){

                $encriptar = password_hash($this->documento, PASSWORD_DEFAULT, [15]);
    
                $datosusuario = array(
                    "usuario"     => $this->documento,
                    "password"      => $encriptar,
                    "foto"          => 0,
                    "rol_id"        => $this->rol_id,
                    "estado"        => $this->estado,
                );
    
                $crearLogin = ControladorUsuarios::ctrCrearUsuario($datosusuario);
    
                if($crearLogin == 'ok'){
                    $mail = new PHPMailer();
                    $mail->setLanguage('es', '../vistas/plugins/PHPMailer/language/directory/');
                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com';
                    $mail->Port = 465;
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                    $mail->SMTPAuth = true;
                    $mail->CharSet = 'UTF-8';
                    $mail->isHTML(true);  
                    $mail->Username = 'asernacalle@gmail.com';
                    $mail->Password = 'jianonoqzalgsfnc';
                    $mail->addAddress($this->email, $this->nombres.' '.$this->apellidos);
                    $mail->Subject = 'Bienvenido a Vida para Ellas';
                    $mail->msgHTML(file_get_contents('../vistas/modulos/plantilla_correo.html'), __DIR__);
                    $mail->send();
                }
                
            }else{
                echo $respuesta;
            }

            if($this->lider == '0'){

                $datoslider = array(
                    "documentoS"     => $this->documento,
                    "liderS"         => $this->liderdocumento,
                );

                    
                $relacionLider = ControladorLideres::ctrCrearLider($datoslider);
                
            }
            
        } 

// ESTADO SOÑADOR

public function ajaxEstadoSoñador()
        {
            
            $item1 = $this->activarSoñador;
            $item2 = $this->activarId;
            $item3 = $this->documentoSoñador;
            
            $respuesta = ControladorSoñadores::ctrEstadoSoñadores($item1, $item2, $item3);

            echo $respuesta;

        
        }

        // VER SOÑADOR
        
        public function ajaxVerSoñador(){

            $item = "id";
            $valor = $this->verSoñador;
            

            $respuesta = ControladorSoñadores::ctrMostrarSoñador($item, $valor);

            for ($i = 0; $i < count($respuesta); $i++) {

                $item       = "municipios.id";
                $valor      = $respuesta[$i]["municipio_id"];
            
                $mostrarMunicipios = ControladorDepartamentos::ctrMostrarDepartamentoMunicipio($item, $valor);


                $datos = [
                "email"             => $respuesta[$i]["email"],    
                "tipo"              => $respuesta[$i]["tipo"],
                "documento"         => $respuesta[$i]["documento"],
                "nombres"           => ucwords($respuesta[$i]["nombres"]),
                "f_nacimiento"      => $respuesta[$i]["f_nacimiento"],
                "sexo"              => $respuesta[$i]["sexo"],
                "apellidos"         => ucwords($respuesta[$i]["apellidos"]),
                "direccion"         => $respuesta[$i]["direccion"],
                "celular"           => $respuesta[$i]["celular"],
                "municipio"         => $mostrarMunicipios["Mun_nombre"],
                "departamento"      => $mostrarMunicipios["Dep_nombre"],
                "municipioid"         => $mostrarMunicipios["Mun_id"],
                "departamentoid"      => $mostrarMunicipios["Dep_id"],
                ];
            }
            
            echo json_encode($datos);
            


        }


        // EDITAR SOÑADOR

        public function ajaxEditarSoñador(){

            $datos = array(
                "documento"                 => $this->documento,
                "nombres"                   => $this->nombres,
                "apellidos"                 => $this->apellidos,
                "f_nacimiento"              => $this->f_nacimiento,
                "sexo"                      => $this->sexo,
                "direccion"                 => $this->direccion,
                "celular"                   => $this->celular,
                "email"                     => $this->email,
                "municipio_id"              => $this->municipio_id,
                "fecha_modificacion"        => $this->fecha_modificacion,
            );

            $respuesta = ControladorSoñadores::ctrEditarSoñador($datos);

            echo $respuesta;



        }

}

// CREAR PERSONAS*************************************************

if (isset($_POST["opcion"])) {

    if($_POST["opcion"]=='1'){

            date_default_timezone_set("America/Bogota");

            $soñador                = new AjaxSoñadores();
            $soñador->tipo          = $_POST["tipo"];
            $soñador->documento     = $_POST["documento"];
            $soñador->nombres       = strtolower($_POST["nombres"]);
            $soñador->apellidos     = strtolower($_POST["apellidos"]);
            $soñador->f_nacimiento  = $_POST["f_nacimiento"];
            $soñador->sexo          = $_POST["sexo"];
            $soñador->direccion     = strtolower($_POST["direccion"]);
            $soñador->celular       = $_POST["celular"];
            $soñador->email         = strtolower($_POST["email"]);
            $soñador->municipio_id  = $_POST["municipio_id"];
            $soñador->estado        = $_POST["estado"];
            $soñador->rol_id        = $_POST["rol_id"];
            $soñador->lider         = $_POST["checkLider"];
            $soñador->liderdocumento = $_POST["liderdocumento"];

            $soñador->ajaxCrearSoñador();
    }
    
}

// ACTIVAR ESTADO DE LAS PERSONAS *************************************

if (isset($_POST["activarSoñador"])) {

    if($_POST["activarSoñador"]=='1'){

        $activarSoñador                     = new AjaxSoñadores();
        $activarSoñador->activarSoñador     = 0;
        $activarSoñador->activarId          = $_POST["activarId"];
        $activarSoñador->documentoSoñador   = $_POST["documentoSoñador"];
        $activarSoñador->ajaxEstadoSoñador();
    }else{
        $activarSoñador                     = new AjaxSoñadores();
        $activarSoñador->activarSoñador     = 1;
        $activarSoñador->activarId          = $_POST["activarId"];
        $activarSoñador->documentoSoñador   = $_POST["documentoSoñador"];
        $activarSoñador->ajaxEstadoSoñador();
    }


}


// VER SOÑADOR **************************************
if (isset($_POST["verSoñador"])) {

        $verSoñador                 = new AjaxSoñadores();
        $verSoñador->verSoñador     = $_POST["verSoñador"];
        $verSoñador->ajaxVerSoñador();

}

// EDITAR - VER SOÑADOR
if (isset($_POST["idSoñador"])) {

    $verSoñador                 = new AjaxSoñadores();
    $verSoñador->verSoñador     = $_POST["idSoñador"];
    $verSoñador->ajaxVerSoñador();

}

if (isset($_POST["opcion"])) {
            
                       
        if($_POST["opcion"]=='2'){

            date_default_timezone_set("America/Bogota");
            
            $soñador                = new AjaxSoñadores();
            $soñador->documento     = $_POST["edocumento"];
            $soñador->nombres       = strtolower($_POST["enombres"]);
            $soñador->apellidos     = strtolower($_POST["eapellidos"]);
            $soñador->f_nacimiento  = $_POST["ef_nacimiento"];
            $soñador->sexo          = $_POST["esexo"];
            $soñador->direccion     = strtolower($_POST["edireccion"]);
            $soñador->celular       = $_POST["ecelular"];
            $soñador->email         = strtolower($_POST["eemail"]);
            $soñador->municipio_id  = $_POST["municipio_id"];
            $fecha = date("d/m/Y H:i:s");
            $soñador->fecha_modificacion = $fecha;
            
            $soñador->ajaxEditarSoñador();
        }
    
}

// BUSCAR PARA ROTULO

if(isset($_POST["idRotulo"])){
    $buscarRotulo = new AjaxSoñadores();
    $buscarRotulo->verSoñador     = $_POST["idRotulo"];
    $buscarRotulo->ajaxVerSoñador();
    } 

?>