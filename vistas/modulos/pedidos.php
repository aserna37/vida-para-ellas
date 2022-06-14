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
    <h4>Pedidos</h4>
  </div>
</div>

<div class="card container shadow p-3 mb-5 bg-white rounded animate__animated animate__fadeInUp">
  <div class="card-body">
    <div class="table-responsive-sm">
            <table class="table table-striped text-center" style="width:100%" id="tablaPedidosTotal">
        <thead>
            <tr>
            <th scope="col">No. Pedido</th>
            <th scope="col">Fecha</th>
            <th scope="col">Soñador</th>
            <th scope="col">Valor</th>
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



<!-- MOSTRAR OBSERVACIONES -->
<div class="modal fade" id="ModalVerDetallePedido" data-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Información del pedido</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="DetallePedido">
        
        
     
      </div>
      <div class="modal-footer">
         <button type="button" class="btn btnCancelar" data-dismiss="modal">Cerrar</button>
      </div>
      </div>
  </div>
</div>