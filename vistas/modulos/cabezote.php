<div id="wrap-preload">
    <img width="150px" src="vistas/img/plantillas/ripple.gif" alt="gif" class="gif">
</div>

<nav class="navbar navbar-expand-sm shadow p-3 mb-5 navbar-light bg-white rounded">
<?php 
if($_SESSION["rol"] == 1){
  ?><a class="navbar-brand" href="menu">
    <img src="vistas/img/plantillas/logo.png" width="50" height="50" alt="logo">
  </a><?php
}elseif($_SESSION["rol"] == 2){
  ?><a class="navbar-brand" href="embalaje">
    <img src="vistas/img/plantillas/logo.png" width="50" height="50" alt="logo">
  </a><?php
}elseif($_SESSION["rol"] == 3){
  ?><a class="navbar-brand" href="bodega">
    <img src="vistas/img/plantillas/logo.png" width="50" height="50" alt="logo">
  </a><?php
}elseif($_SESSION["rol"] == 4){
  ?><a class="navbar-brand" href="soñador">
    <img src="vistas/img/plantillas/logo.png" width="50" height="50" alt="logo">
  </a><?php
}
?>  
  <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <!-- <span class="navbar-toggler-icon"></span> -->
    <div class="dropdown dropleft">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuMobile" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <?php if($_SESSION['foto'] == 0){
            
            ?><img src="vistas/img/perfiles/anonymous.png" width="30" height="30" class="rounded-circle">
        
          <?php }else{
            
            ?><img src="vistas/img/perfiles/<?php echo $_SESSION['foto'] ?>" width="30" height="30" class="rounded-circle">
        
          <?php } ?>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuMobile">
          <a class="dropdown-item" href="perfil">Perfil</a>
          <a class="dropdown-item" href="salir">Salir</a>
        </div>
  </div>  
  </button>
  
  <div class="collapse navbar-collapse" id="navbar-list-4">
    <ul class="navbar-nav ml-auto">
      <?php   
        $item = "documento";
        $valor = $_SESSION["usuario"]; 
        $persona = ControladorSoñadores::ctrMostrarSoñadores($item,$valor);
        
        foreach($persona as $key => $value){
          echo '<li class="nav item pt-3 mr-3">'.ucwords($value["nombres"]).'  '. ucwords($value["apellidos"]).'</li>';
        }
        ?>
        <li class="nav-item dropdown dropleft">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenu" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <?php if($_SESSION['foto'] == 0){
            
            ?><img src="vistas/img/perfiles/anonymous.png" width="40" height="40" class="rounded-circle">
        
          <?php }else{
            
            ?><img src="vistas/img/perfiles/<?php echo $_SESSION['foto'] ?>" width="40" height="40" class="rounded-circle">
        
          <?php } ?>  
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenu">
          <a class="dropdown-item" href="perfil">Perfil</a>
          <a class="dropdown-item" href="salir">Salir</a>
        </div>
      </li>   
    </ul>
    </div>
</nav>

