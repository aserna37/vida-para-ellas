<div class="text-center nombreSoñadora">

<?php   
        $item = "documento";
        $valor = $_SESSION["usuario"]; 
        $persona = ControladorSoñadores::ctrMostrarSoñadores($item,$valor);
        
        foreach($persona as $key => $value){
          echo '<h6>'.ucwords($value["nombres"]).'  '. ucwords($value["apellidos"]).'</h6>';
          
        }
        ?>

</div>

<div class="nombre_menu">
  <div class="container rounded">
    <h4>Mis Pedidos</h4>
  </div>
</div>

<div class="container">
  <div class="row">
    <div class="col-md-3 col-12 mb-2 btnnuevo">
      <a class="btn btn-sm btn-block rounded float-left" href="menu" data-toggle="modal" data-target="#ModalCrearPedido" role="button">
      <lord-icon
          src="https://cdn.lordicon.com/nlzvfogq.json"
          trigger="loop"
          colors="primary:#fcee20,secondary:#fcee20"
          style="width:30px;height:30px">
      </lord-icon> 
      Nuevo pedido
      </a>
    </div>
    <div class="col-md-3 col-12 btnnuevo">
      <a class="btn btn-sm btn-block rounded float-left" href="menu" data-toggle="modal" data-target="#ModalCrearCliente" role="button">
      <lord-icon
          src="https://cdn.lordicon.com/dxjqoygy.json"
          trigger="loop"
          colors="primary:#fcee20,secondary:#fcee20"
          style="width:30px;height:30px">
      </lord-icon> 
      Registro Cliente
      </a>
    </div>
  </div>
</div>
<br>

<div class="container">
    <nav>
      <div class="nav nav-pills nav-justified" id="nav-tab" role="tablist">
        <a class="nav-link active" id="nav-pendiente-tab" data-toggle="tab" href="#nav-pendiente" role="tab" aria-controls="nav-pendiente" aria-selected="true">Pedidos Pendientes</a>
        <a class="nav-link" id="nav-enviado-tab" data-toggle="tab" href="#nav-enviado" role="tab" aria-controls="nav-enviados" aria-selected="false">Pedidos Enviados</a>
        <!-- <a class="nav-link" id="nav-cita-tab" data-toggle="tab" href="#nav-cita" role="tab" aria-controls="nav-cita" aria-selected="false">Registro de Clientes</a> -->
      </div>
    </nav>
    <div class="tab-content" id="nav-tabContent">
      <div class="tab-pane fade show active" id="nav-pendiente" role="tabpanel" aria-labelledby="nav-pendiente-tab">
      <br>
      
      <div class="card shadow-sm p-3 mb-5 bg-white rounded">
        <div class="card-body">

        <?php
        $item = 'persona_id';
        $valor = $_SESSION['id'];
        $item1 = 'estado';
        $valor1 = 1;

        $pedidoSoñador = ControladorPedidos::ctrMostrarPedidosSoñador($item, $valor, $item1, $valor1);
        
        if(empty($pedidoSoñador)){
          echo '<div class="alert alert-info" role="alert">
            Sin pedidos pendientes
            </div>';
        }else{
          $dato = "<div class='row'>";
          for ($i = 0; $i < count($pedidoSoñador); $i++){
          
            $dato.= '<div class="col-md-4 col-sm-12 shadow-sm p-3 mb-5 bg-white rounded">
                <h6>No. Pedido: <strong>P2022-'. $pedidoSoñador[$i]['id'] .'</strong></h6> 
                <h6>Fecha: <strong>'. $pedidoSoñador[$i]['fecha'] .'</strong></h6>
                <h6>Valor: <strong>$'.number_format($pedidoSoñador[$i]['total']).'</strong></h6>
                <h6>Estado: <span class="badge badge-pill badge-info">Pendiente</span></h6>
                <hr>   
                  </div>';
          }
          $dato.="</div>";
          echo $dato;
        }

          
        ?>
        
        </div>
      </div>

      </div>
      <div class="tab-pane fade" id="nav-enviado" role="tabpanel" aria-labelledby="nav-enviado-tab">
      <br>
      
      <div class="card shadow-sm p-3 mb-5 bg-white rounded">
        <div class="card-body">
        <?php
        $item = 'persona_id';
        $valor = $_SESSION['id'];
        $item1 = 'estado';
        $valor1 = 3;

        $pedidoSoñador = ControladorPedidos::ctrMostrarPedidosSoñador($item, $valor, $item1, $valor1);
        
        if(empty($pedidoSoñador)){
          echo '<div class="alert alert-info" role="alert">
            Sin pedidos enviados
            </div>';
        }else{
          $dato = "<div class='row'>";
          
          for ($i = 0; $i < count($pedidoSoñador); $i++){

            $link = '';
            
            if($pedidoSoñador[$i]['empresa'] == 'transprensa'){
                $link = "https://transprensa.com/Seguimiento/?remesa_codigo=";                
            }elseif ($pedidoSoñador[$i]['empresa'] == 'envia') {
                $link = "https://envia.co/";
            }else{
                $link = "https://www.interrapidisimo.com/sigue-tu-envio/?guia=";
            }
            
            $dato.='<div class="col-md-4 col-sm-12 shadow-sm p-3 mb-5 bg-white rounded">
                <h6>No. Pedido: <strong>P2022-'. $pedidoSoñador[$i]['id'] .'</strong></h6> 
                <h6>Fecha: <strong>'. $pedidoSoñador[$i]['fecha'] .'</strong></h6>
                <h6>Valor: <strong>$'.number_format($pedidoSoñador[$i]['total']).'</strong></h6>
                <h6>Guia: <a href="'.$link.''.$pedidoSoñador[$i]['guia'].'" target="blank"><span class="badge badge-pill badge-success">'. $pedidoSoñador[$i]['guia'] .'</span></a></h6>
                <h6>Estado: <span class="badge badge-pill badge-success">Enviado</span></h6>
                <hr>   
                  </div>';
          }
          $dato.="</div>";
          echo $dato;
        }
         
        ?>  


        </div>
      </div>

    </div>
    <!-- <div class="tab-pane fade" id="nav-cita" role="tabpanel" aria-labelledby="nav-cita-tab">
    <br>
    
    <div class="card shadow-sm p-3 mb-5 bg-white rounded">
      <div class="card-body">
      
      </div>
    </div>

    </div> -->
</div>


<!-- INGRESO PEDIDO -->

<div class="modal fade" id="ModalCrearPedido" data-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header fondoarriba">
        <h5 class="text-white ml-2">Nuevo Pedido</h5>
      </div>
      <form id="agregarPedido">
      <div class="modal-body">
        <img class="img-fluid ml-2 mb-2" width="80px" src="vistas/img/plantillas/login.png" alt="">
        
        <div class="row">
          <div class="class-md-8 ml-3">
            <div class="card shadow p-3 mb-5 bg-white rounded">
              <div class="card-body">
                <?php   
            $item = "documento";
            $valor = $_SESSION["usuario"]; 
            $municipio = '';
            $persona = ControladorSoñadores::ctrMostrarSoñadores($item,$valor);
            
            foreach($persona as $key => $value){
              
              echo '<h4>'.ucwords($value["nombres"]).'  '. ucwords($value["apellidos"]).'</h4>';
              echo '<h6>'.ucwords($value["direccion"]).'</h6>';
              echo '<h6>'.ucwords($value["celular"]).'</h6>';
              
              $municipio = $value['municipio_id'];
            }
            
            $item1       = "municipios.id";
            $valor1      = $municipio;
            
            $mostrarMunicipio = ControladorDepartamentos::ctrMostrarDepartamentoMunicipio($item1, $valor1);
            
            $Ciudad = $mostrarMunicipio["Mun_nombre"];
            $Departamento = $mostrarMunicipio["Dep_nombre"];
            echo '<h6>'.ucwords($Ciudad).' - '.ucwords($Departamento).'</h6>';
            ?>
          </div>
        </div>
      </div>
      <div class="col-md-4" hidden>
        <?php $valorInterno = rand();
            echo '<input type="text" name="datoInterno" class="datoInterno" value = '. $valorInterno.'>'; 
            echo '<input type="text" name="idSoñadora" class="idSoñadora" value= '. $_SESSION['usuario'].'>';
            echo '<input type="text" name="idS" class="idS" value= '. $_SESSION['id'].'>';
            ?>
                        
          </div>
        </div>
        
        <div class="row shadow p-3 mb-5 bg-white rounded">
          <div class="col-md-9 col-sm-8">
            <label for="producto" class="col-form-label col-form-label-sm">Producto</label>
            <select class="form-control form-control-sm rounded" name="producto_id" id="producto_id">
              <option selected value="">Seleccione...</option>
              <?php
                            $item = "estado";
                            $valor = "1";
                            
                            $productos = ControladorProductos::ctrMostrarProductos($item,$valor);
                            
                            foreach($productos as $key => $value){
                              echo '<option value="' . $value["id"] . '">' . $value["nombre"] . '</option>';
                            }
                            ?>
                    </select>
                  </div>
          <div class="col-md-3 col-sm-4">
          <label for="cantidad" class="col-form-label col-form-label-sm">Cantidad</label>
          <input type="number" class="form-control form-control-sm"
          name="cantidad"
          id="cantidad"
          min="1"
          >
        </div>
          <div class="col-md-12 col-sm-12">
            <button type="button" class="btn btn-sm btn-block btnAgregar">Agregar al Pedido</button>
          </div>
        </div>
      </div>

      <div class="container">
        <div class="table-responsive">
        <table class="table tablaIngresosProductosSoñador">
          <br>
          <caption>
          <div class="row">  
            <div class="col-md-7 col-sm-12">
            <div class="form-group">
              <h5><span class="badge badge-success">Comprobante de Pago</span></h5>
            <input type="file" class="form-control-file" id="comprobante" name="comprobante" accept="image/jpeg, image/png, image/jpg">
            <br>
            </div>
            </div>
            <div class="col-md-5 col-sm-12">
              <h4 ><span class="badge badge-pill badge-success totalPedido">Total:</span></h4>   
            </div>
          
          </div>
          </caption>
  <thead>
    <tr>
      <th scope="col">item</th>
      <th scope="col">Producto</th>
      <th scope="col">Cantidad</th>
      <th scope="col">Precio</th>
      <th scope="col">Total</th>
      <th scope="col">Acción</th>
    </tr>
  </thead>
  <tbody>
    
  </tbody>
</table>
        <p class="text-center bg-danger text-white rounded">Nota: despues de confirmar su pedido este pasa a revisión de existencias y verificación de ingreso de pago.</p>
        </div>
        </div>
           <div class="modal-footer">
            <button type="button" class="btn btnGuardarPedido">Enviar Pedido</button>
            <button type="button" class="btn btnCancelar" data-dismiss="modal">Cancelar</button>
          </div>
        </div>
      </form>
      </div>
    </div>
  </div>
</div>



<!-- ********************************************************* -->
<!-- MODAL CREAR CLIENTE **************************************** -->

<div class="modal fade" id="ModalCrearCliente" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Registro de Clientes</h5>
      </div>
      <form id="crearCliente">
      <div class="modal-body">
        
      <div class="form-group row">
          
          <div class="form-group col-sm-12">
              <label for="nombres" class="col-form-label col-form-label-sm">Nombre del Cliente</label>
              <input type="text" class="form-control form-control-sm"
              name="nombres"
              onkeypress="return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32) || (event.charCode == 209) || (event.charCode == 241))"
              id="nombres"
              minlength="3" required>
          </div>

          <div class="form-group col-sm-12">
              <label for="apellidos" class="col-form-label col-form-label-sm">Apellidos del Cliente</label>
              <input type="text" class="form-control form-control-sm"
              name="apellidos"
              onkeypress="return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32) || (event.charCode == 209) || (event.charCode == 241))"
              id="apellidos"
              minlength="3" required>
          </div>
          
          <div class="form-group col-sm-6">
                <label for="celular" class="col-form-label col-form-label-sm">Celular</label>
                <input type="text" class="form-control form-control-sm" 
                onkeypress="return event.charCode >= 48 && event.charCode <= 57" 
                name="celular" 
                maxlength="10" 
                id="celular" required>
          </div>

          <div class="form-group col-sm-6">
                <label for="email" class="col-form-label col-form-label-sm">Email</label>
                <input type="email" class="form-control form-control-sm" 
                name="email" 
                id="email">
          </div>
          
          <div class="form-group col-sm-6">
                <label for="pote" class="col-form-label col-form-label-sm">No. Pote</label>
                <input type="text" class="form-control form-control-sm" 
                onkeypress="return event.charCode >= 48 && event.charCode <= 57" 
                name="pote" 
                maxlength="10" 
                id="pote" required>
          </div>

          
          
          
                <input type="text" class="form-control form-control-sm" 
                name="soñador" 
                value = "<?php echo $_SESSION['id']; ?>" 
                id="soñador" hidden>
          


        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btnGuardarCliente">Registrar Cliente</button>
          <button type="button" class="btn btnCancelar" data-dismiss="modal">Cancelar</button>
        </div>
      </div>
    </form>
  </div>
</div>




<!-- ********************************************************* -->


