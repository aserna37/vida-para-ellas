<div class="nombre_menu">
  <div class="container rounded">
    <h4>Embalaje</h4>
  </div>
</div>

<div class="container">
<div class="table-responsive-sm">
            <table class="table table-striped" style="width:100%" id="tablaEmbalaje">
        <thead>
            <tr>
            <th scope="col">Pedido</th>
            <th scope="col">Fecha</th>
            <th scope="col">Soñador</th>
            <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            
        </tbody>
        </table>
    </div>
</div>



<div class="modal fade" id="modalMostrarPedido" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Información del Pedido</h5>
        <input type="text" id="pedidoE" hidden>
      </div>
      <div class="modal-body">

      <table class="table table-striped">
  <thead>
    <tr class="text-center">
      <th scope="col">Embalado</th>
      <th scope="col">Producto</th>
      <th scope="col">Cantidad</th>
    </tr>
  </thead>
  <tbody id="pendienteEmbalaje">
    
  </tbody>
</table>
          <div class="form-group">
              <h5><span class="badge badge-success">Foto Pedido Embalado</span></h5>
            <input type="file" class="form-control-file" id="fotoPedido" name="fotoPedido" accept="image/jpeg, image/png, image/jpg">
            <br>
          </div>
       

      </div>
      <div class="modal-footer">
          <button type="submit" id="btnEmbalaje" class="btn btnGuardarEmbalaje">Pedido Embalado</button>
        <button type="button" class="btn btnCancelar" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
    </div>
  </div>
</div>