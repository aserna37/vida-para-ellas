
<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Vida para Ellas - Login</title>

    <!-- <link rel="apple-touch-icon" href="vistas/img/plantilla/icono.png">
    <link rel="shortcut icon" href="vistas/img/plantilla/icono.png"> -->
    <?php
    if (isset($_SESSION["validarSesionBackend"]) && $_SESSION["validarSesionBackend"] === "ok"){
        echo '<link rel="stylesheet" href="vistas/css/style.css">';
        echo '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">';
        echo '<link rel="stylesheet" href="vistas/css/imagehover.min.css">';
        echo '<link rel="stylesheet" href="vistas/css/animate.min.css">';
        echo '<link rel="stylesheet" href="vistas/plugins/sweet_alert2/sweetalert2.min.css">';
        echo '<link rel="stylesheet" href="//cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">';
    }else{
        echo '<link rel="stylesheet" href="vistas/css/login.css">';
        echo '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">';
        echo '<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">';
    }
    ?>
    
    
    
    
    
</head>
<body>
<?php

if (isset($_SESSION["validarSesionBackend"]) && $_SESSION["validarSesionBackend"] === "ok") {
    include "modulos/cabezote.php";

    if($_SESSION["rol"] == 1){
        
        if (isset($_GET["ruta"])) {
    
            if ($_GET["ruta"] == "menu" ||
                $_GET["ruta"] == "perfil" ||
                $_GET["ruta"] == "salir" ||
                $_GET["ruta"] == "productos" ||
                $_GET["ruta"] == "soñadores" ||
                $_GET["ruta"] == "reportes") {
                include "modulos/" . $_GET["ruta"] . ".php";
    
            }
    
        }
    } if($_SESSION["rol"] == 2){
        
        if (isset($_GET["ruta"])) {
    
            if ($_GET["ruta"] == "embalaje" ||
                $_GET["ruta"] == "perfil" ||
                $_GET["ruta"] == "salir") {
                include "modulos/" . $_GET["ruta"] . ".php";
    
            }
    
        }
    } if($_SESSION["rol"] == 3){
        
        if (isset($_GET["ruta"])) {
    
            if ($_GET["ruta"] == "bodega" ||
                $_GET["ruta"] == "perfil" ||
                $_GET["ruta"] == "salir") {
                include "modulos/" . $_GET["ruta"] . ".php";
    
            }
    
        }
    }else{
        
        if (isset($_GET["ruta"])) {
    
            if ($_GET["ruta"] == "soñador" ||
                $_GET["ruta"] == "perfil" ||
                $_GET["ruta"] == "salir") {
                include "modulos/" . $_GET["ruta"] . ".php";
    
            }
    
        }
    }
    

    include "modulos/footer.php";

    

} else {

    include "modulos/login.php";

}

?>

<script src="vistas/plugins/datatable/jquery-3.5.1.js"></script>
<script src="vistas/js/style.js"></script>
<script src="vistas/plugins/datatable/dataTables.min.js"></script>
<script src="https://cdn.lordicon.com/lusqsztk.js"></script>
<script src="vistas/plugins/sweet_alert2/sweetalert2.all.min.js" ></script>

<?php
    if (isset($_SESSION["validarSesionBackend"]) && $_SESSION["validarSesionBackend"] === "ok"){
        echo '<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>';
        echo '<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>';
        
    }else{
        
        echo '<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>';
    }
    ?>
</body>
</html>
