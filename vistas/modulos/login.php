<div id="wrap-preload">
    <img width="150px" src="vistas/img/plantillas/ripple.gif" alt="gif" class="gif">
</div>

<div class="wrapper">
    <div class="logo"> <img src="vistas/img/plantillas/login.png" alt=""> </div>
    <div class="text-center mt-4 name"> Bienvenido </div>
    <form method="post" class="p-3 mt-3" id="formLogin">
        <div class="form-field d-flex align-items-center"> <span class="far fa-user"></span> <input type="text" name="usuario" id="usuario" placeholder="Usuario"> </div>
        <div class="form-field d-flex align-items-center"> <span class="fas fa-key"></span> <input type="password" name="password" id="password" placeholder="Contraseña"> </div> 
        <button type="submit" class="btn mt-3">Ingresar</button>
        <div class="text-center fs-6"> <a type="button" data-bs-toggle="modal" data-bs-target="#ModalNuevaContraseña" >¿Olvido Contraseña?</a></div>
    
        <?php
        $login = new ControladorLogin();
        $login->ctrIngresoLogin();
        ?>

    </form>
    <div id="error"></div>
</div>


<div class="modal fade" id="ModalNuevaContraseña" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Restablecer contraseña</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="buscarUsuario">
      <div class="modal-body">
          <p class="text-center">Coloca aquí tu número de documento de identidad para buscar tu usuario y enviarte un correo de recuperación de contraseña:</p>
        <small for="informacion" class="form-label">Documento de identidad</small>
        <input type="text" class="form-control" id="usudocumento" name="usudocumento" placeholder="Documento de identidad">
        </div>
      <div class="modal-footer">
        <button type="submit" class="btn btnGuardar">Enviar</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
      </div>
      </form>
    </div>
  </div>
</div>