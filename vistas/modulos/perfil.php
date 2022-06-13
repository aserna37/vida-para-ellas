<div class="retorno">
        <a class="btn btn-sm rounded float-right" href="menu" role="button">
        Regresar al menu
        <lord-icon
            src="https://cdn.lordicon.com/gwlkhzue.json"
            trigger="loop"
            colors="primary:#ffffff"
            style="width:20px;height:20px">
        </lord-icon> 
        </a>
</div>

<br>

<div class="nombre_menu">
  <div class="container rounded">
    <h4>Mi Perfil</h4>
  </div>
</div>

<div class="container shadow p-3 mb-5 bg-body rounded">
<input type="text" name="documento" id="documento" value="<?php echo $_SESSION["usuario"] ?>" hidden>
<div class="row align-items-center">
<div class="col-md-6 col-sm-12">
  <h4>Actualizar foto perfil</h4>
  <hr>
  <form id="Actualizar_foto">
  <label for="formFile" class="form-label">Seleccione su foto de perfil</label>
  <input class="form-control" type="file" id="foto_perfil" name="foto_perfil" accept="image/jpeg, image/png, image/jpg">
  <br>
  <button type="submit" class="btn btn-block btn-secondary">Actualizar foto</button>
  </form>
</div>
<div class="col-md-6 col-sm-12">
  <h4>Actualizar contraseña</h4>
  <small class="text-danger">Minimo 5 caracteres en tu contraseña</small>
  <hr>
  <form id="Actualizar_contraseña">
  <label for="contraseña" class="form-label">Contraseña</label>
  <input type="password" class="form-control" name="contraseña" id="contraseña" required minlength="5">
  <br>
  <label for="re-contraseña" class="form-label">Repetir Contraseña</label>
  <input type="password" class="form-control" name="re_contraseña" id="re_contraseña" required minlength="5">
  <br>
  <button type="submit" class="btn btn-block btn-secondary">Actualizar contraseña</button>
</form>
</div>

</div>
</div>

