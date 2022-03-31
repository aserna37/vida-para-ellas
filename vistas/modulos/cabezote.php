<div id="wrap-preload">
    <img width="150px" src="vistas/img/plantillas/ripple.gif" alt="gif" class="gif">
</div>

<nav class="navbar navbar-expand-sm shadow p-3 mb-5 navbar-light bg-white rounded">
  <a class="navbar-brand" href="#">
    <img src="vistas/img/plantillas/logo.png" width="60" height="60" alt="logo">
    
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-list-4" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbar-list-4">
    <ul class="navbar-nav ml-auto">
      <?php   
        $item = "documento";
        $valor = $_SESSION["usuario"]; 
        $persona = ControladorSoñadores::ctrMostrarSoñadores($item,$valor);
        
        foreach($persona as $key => $value){
          echo '<li class="nav item pt-3 mr-3">'.$value["nombres"].'  '. $value["apellidos"].'</li>';
        }
        ?>
        <li class="nav-item dropdown dropleft">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <img src="vistas/img/perfiles/anonymous.png" width="40" height="40" class="rounded-circle">
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="perfil">Perfil</a>
          <a class="dropdown-item" href="salir">Salir</a>
        </div>
      </li>   
    </ul>
    </div>
</nav>