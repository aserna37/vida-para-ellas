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
    <h4>Stocks</h4>
  </div>
</div>

<div class="btnnuevo container">
        <a id="" class="btn btn-sm rounded float-left" href="menu" data-toggle="modal" data-target="#ModalCrearStock" role="button">
        <lord-icon
            src="https://cdn.lordicon.com/tvyxmjyo.json"
            trigger="loop"
            colors="primary:#fcee20,secondary:#fcee20"
            style="width:30px;height:30px">
        </lord-icon> 
        Ingreso a Inventario
        </a>
</div>
<br>
<br>

<div class="card container shadow p-3 mb-5 bg-white rounded animate__animated animate__fadeInUp">
  <div class="card-body">
    <div class="table-responsive-sm">
            <table class="table table-striped text-center" style="width:100%" id="tablaStocks">
        <thead>
            <tr>
            <th scope="col">Producto</th>
            <th scope="col">Cantidades Total</th>
            <th scope="col">Ventas o Salidas</th>
            <th scope="col">Cantidad Disponible</th>
            <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            
        </tbody>
        </table>
    </div>
  </div>
</div>


<!-- INGRESAR AL STOCKS -->

<div class="modal fade" id="ModalCrearStock" data-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ingreso Cantidad Producto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="agregarStock">
      <div class="modal-body">
        
        <div class="form-group row">
        
        <div class="form-group col-sm-12">
                        <label for="producto" class="col-form-label col-form-label-sm">Producto</label>
                        <select class="form-control form-control-sm rounded" name="producto_id" id="producto_id" required>
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

          <div class="form-group col-sm-12">
              <label for="cantidad" class="col-form-label col-form-label-sm">Cantidad en Unidades</label>
              <input type="text" class="form-control form-control-sm"
              name="cantidad"
              onkeypress="return event.charCode >= 48 && event.charCode <= 57" 
              id="cantidad"
              required>
          </div> 

          
        </div>
     
      </div>
      <div class="modal-footer">
      <button type="submit" class="btn btnGuardar">Guardar</button>
                <button type="button" class="btn btnCancelar" data-dismiss="modal">Cancelar</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- *********************************************** -->

<!-- VER DETALLE INGRESO A STOCKS -->

<div class="modal fade" id="modalDetalleProducto" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ingreso detallado por Producto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          
      <div class="table-responsive-sm" id="tablaDetalleStock">
            <table class="table table-striped" style="width:100%" id="tablaStockDetalle">
        <thead>
            <tr>
            <th scope="col">Fecha</th>
            <th scope="col">Cantidad</th>
            </tr>
        </thead>
        <tbody>
            
        </tbody>
        </table>
    </div>
        
        
                             
      </div>
      </div>
  </div>
</div>