<?php


require_once "../controladores/usuarios.controlador.php";
require_once "../controladores/soñadores.controlador.php";

require_once "../modelos/usuario.modelo.php";
require_once "../modelos/soñador.modelo.php";


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require_once '../vistas/plugins/PHPMailer/src/Exception.php';
require_once '../vistas/plugins/PHPMailer/src/PHPMailer.php';
require_once '../vistas/plugins/PHPMailer/src/SMTP.php';

class AjaxUsuarios
{
    public function ajaxBuscarUsuario()
    {
        $item = "usuario";
        $valor = $this->documento;

        $respuesta = ControladorUsuarios::ctrBuscarUsuario($item, $valor);

        if(empty($respuesta)){
            echo 'error';
        }else{
            echo 'ok';
            
            $item = "documento";
            $soñador = ControladorSoñadores::ctrMostrarSoñador($item, $valor);
            $uniqidStr = uniqid();
            $encriptar = password_hash($uniqidStr, PASSWORD_DEFAULT, [15]);
            
            $item = $this->documento;
            $valor = $encriptar;
            
            $nuevaContraseña = ControladorUsuarios::ctrActualizarContraseña($item, $valor);
            
            for ($i = 0; $i < count($soñador); $i++) {


                $mail = new PHPMailer();
                $mail->setLanguage('es', '../vistas/plugins/PHPMailer/language/directory/');
                $mail->isSMTP();
                // $mail->SMTPDebug = SMTP::DEBUG_SERVER;
                $mail->Host = 'smtp.gmail.com';
                $mail->Port = 465;
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                $mail->SMTPAuth = true;
                $mail->Username = 'asernacalle@gmail.com';
                $mail->Password = 'jianonoqzalgsfnc';
                $mail->isHTML(true);    
                $mail->addAddress($soñador[$i]['email'], $soñador[$i]['nombres'].' '.$soñador[$i]['apellidos']);
                $mail->CharSet = 'UTF-8';
                $titulo = "Restablecimiento de contraseña";
                $mail->Subject = $titulo;
                $mail->Body    = "<div style='text-align:center'>
                                  <h1 style='color:#7552ff'>Restablecer Contraseña</h1>
                                  <hr>
                                  <p style='color:gray'>Usted ha solicitado el restablecimiento de su contraseña. Se ha generado
                                  credenciales con la siguiente informacion:</p><br>
                                  <p><small style='color:gray'>Usuario: </small><b>".$soñador[$i]['documento']."</b></p>
                                  <p><small style='color:gray'>Contraseña: </small><b>".$uniqidStr."</b></p>
                                  <p style='color:#7552ff'><i><b>NOTA: NO OLVIDE CAMBIAR SU CONTRASEÑA AL ENTRAR A LA PLATAFORMA</b></i></p>
                                  </div>";
                $mail->send();
            }
        }
    }

    public function ajaxActualizarFotoUsuario()
    {
    
        $item = $this->documento;
        $valor = $this->foto;

            
        $nuevaFoto = ControladorUsuarios::ctrActualizarFoto($item, $valor);

        echo $nuevaFoto;
    }

    public function ajaxActualizarContraseñaUsuario()
    {
        
        $item = $this->documento;
        $encriptar = password_hash($this->contraseña, PASSWORD_DEFAULT, [15]);
        $valor = $encriptar;

        $nuevaContraseña = ControladorUsuarios::ctrActualizarContraseña($item, $valor);
       
        echo $nuevaContraseña;

    }



}

if (isset($_POST["usudocumento"])) {
    
    $usuario                = new AjaxUsuarios();
    $usuario->documento     = $_POST["usudocumento"];
    $usuario->ajaxBuscarUsuario();
}

if(isset($_POST["documentoF"])){
    
        $filename = $_FILES['foto']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $ubicacionTemporal =  $_FILES['foto']['tmp_name'];

        $ale = rand();
        $aleatorio = $ale."."; 
        $ruta = "../vistas/img/perfiles/";
        $rutaFinal  = $ruta.$aleatorio.$ext;
        $rutaGrabar = $aleatorio.$ext;

        copy($ubicacionTemporal , $rutaFinal);
        
        $usuario                = new AjaxUsuarios();
        $usuario->documento     = $_POST['documentoF'];
        $usuario->foto          = $rutaGrabar;
        $usuario->ajaxActualizarFotoUsuario();
}

if(isset($_POST["documentoC"])){
    
        $usuario                = new AjaxUsuarios();
        
        $usuario->documento     = $_POST['documentoC'];
        $usuario->contraseña    = $_POST['contraseña'];
        $usuario->ajaxActualizarContraseñaUsuario();
    }

    
    
    
