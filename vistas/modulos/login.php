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
        <div class="text-center fs-6"> <a href="#">¿Olvido Contraseña?</a></div>
    
        <?php
        $login = new ControladorLogin();
        $login->ctrIngresoLogin();
        ?>

    </form>
    <div id="error"></div>
</div>