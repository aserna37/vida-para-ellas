<?php

require_once "../controladores/soñadores.controlador.php";
require_once "../modelos/soñador.modelo.php";

require_once "../controladores/usuarios.controlador.php";
require_once "../modelos/usuario.modelo.php";

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
                
            );

            $respuesta = ControladorSoñadores::ctrCrearSoñador($datos);

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
    
                echo $crearLogin;
         
            }else{
                echo $respuesta;
            }
            


        } 

// ESTADO SOÑADOR

public function ajaxEstadoSoñador()
        {
            
            $item1 = $this->activarSoñador;
            $item2 = $this->activarId;
            $item3 = $this->documentoSoñador;
            
            $respuesta = ControladorSoñadores::ctrEstadoSoñadores($item1, $item2, $item3);

            // var_dump ($datos);

            echo $respuesta;

        
        }

        
        



    
}

// CREAR PERSONAS*************************************************

if (isset($_POST["tipo"])) {

            $soñador                = new AjaxSoñadores();
            $soñador->tipo          = $_POST["tipo"];
            $soñador->documento     = $_POST["documento"];
            $soñador->nombres       = $_POST["nombres"];
            $soñador->apellidos     = $_POST["apellidos"];
            $soñador->f_nacimiento  = $_POST["f_nacimiento"];
            $soñador->sexo          = $_POST["sexo"];
            $soñador->direccion     = $_POST["direccion"];
            $soñador->celular       = $_POST["celular"];
            $soñador->email         = $_POST["email"];
            $soñador->municipio_id  = $_POST["municipio_id"];
            $soñador->estado        = $_POST["estado"];
            $soñador->rol_id        = $_POST["rol_id"];

            $soñador->ajaxCrearSoñador();


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

?>