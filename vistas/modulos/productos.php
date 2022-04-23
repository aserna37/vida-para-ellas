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
    <h4>Productos</h4>
  </div>
</div>

<div class="btnnuevo container">
        <a id="" class="btn btn-sm rounded float-left" href="menu" data-toggle="modal" data-target="#ModalCrearProducto" role="button">
        <lord-icon
            src="https://cdn.lordicon.com/jvucoldz.json"
            trigger="loop"
            colors="primary:#fcee20,secondary:#fcee20"
            style="width:30px;height:30px">
        </lord-icon> 
        Nuevo producto
        </a>
</div>
<br>
<br>

<div class="card container shadow p-3 mb-5 bg-white rounded animate__animated animate__fadeInUp">
  <div class="card-body">
    <div class="table-responsive-sm">
            <table class="table table-striped" style="width:100%" id="tablaProductos">
        <thead>
            <tr>
            <th scope="col">Nombre</th>
            <th scope="col">Precio x unidad</th>
            <th scope="col">Estado</th>
            <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            
        </tbody>
        </table>
    </div>
  </div>
</div>


<!-- NUEVO PRODUCTO -->

<div class="modal fade" id="ModalCrearProducto" data-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Nuevo Producto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="agregarProducto">
      <div class="modal-body">
        
        <div class="form-group row">
        
          <div class="form-group col-sm-12">
              <label for="nombre" class="col-form-label col-form-label-sm">Nombre Producto</label>
              <input type="text" class="form-control form-control-sm"
              name="nombre"
              id="nombre"
              minlength="5" required>
          </div> 

          <div class="form-group col-sm-12">
              <label for="valor_unidad" class="col-form-label col-form-label-sm">Valor por Unidad</label>
              <input type="number" class="form-control form-control-sm"
              name="valor_unidad"
              id="valor_unidad"
              required>
          </div> 

          <input type="text" name="estado" value="1" hidden>
          <input type="text" name="opcion" value="1" hidden>


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


<!-- ******************************************* -->
<!-- EDITAR PRODUCTO**************************** -->

<div class="modal fade" id="ModalEditarProducto" data-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar Producto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="editarProducto">
      <div class="modal-body">
        
        <div class="form-group row">

        <div class="form-group col-sm-12" hidden>
              <label for="nombre" class="col-form-label col-form-label-sm">Id Producto</label>
              <input type="text" class="form-control form-control-sm editarid"
              name="eid"
              id="id"
              minlength="5" required>
          </div> 
        
          <div class="form-group col-sm-12">
              <label for="nombre" class="col-form-label col-form-label-sm">Nombre Producto</label>
              <input type="text" class="form-control form-control-sm editarnombre"
              name="enombre"
              id="nombre"
              minlength="5" required>
          </div> 

          <div class="form-group col-sm-12">
              <label for="valor_unidad" class="col-form-label col-form-label-sm">Valor por Unidad</label>
              <input type="number" class="form-control form-control-sm editarvalor_unidad"
              name="evalor_unidad"
              id="valor_unidad"
              required>
          </div> 

          <input type="text" name="eopcion" value="2" hidden>


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




<!-- ******************************************* -->