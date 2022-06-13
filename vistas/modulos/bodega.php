<div class="nombre_menu">
  <div class="container rounded">
    <h4>Pedidos</h4>
  </div>
</div>

<div class="container">
<ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
  <li class="nav-item" role="presentation">
    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Pendientes</a>
  </li>
  <li class="nav-item" role="presentation">
    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Enviados</a>
  </li>
</ul>

<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
  <div class="card container shadow p-3 mb-5 bg-white rounded animate__animated animate__fadeInUp">
  <div class="card-body">
    <div class="table-responsive-sm">
            <table class="table table-striped" style="width:100%" id="tablaPedidosPendientes">
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
</div>
  </div>
  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
  <div class="card container shadow p-3 mb-5 bg-white rounded animate__animated animate__fadeInUp">
  <div class="card-body">
    <div class="table-responsive-sm">
            <table class="table table-striped" style="width:100%" id="tablaPedidosEnviados">
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
</div>
  </div>
</div>
</div>


<!-- modal de datos pendiente -->
<div class="modal fade" id="modalVerPedido" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Información del Pedido</h5>
        <input type="text" id="pedido" hidden>
      </div>
      <div class="modal-body" id="pendientePedido">
        
       

      </div>
      <div class="modal-footer">
          <button type="submit" id="btnBodega" class="btn btnGuardarPedido">Para embalar</button>
        <button type="button" class="btn btnCancelar" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
    </div>
  </div>
</div>


<!-- modal de datos enviado -->
<div class="modal fade" id="modalVerPedidoE" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Información del Pedido</h5>
      </div>
      <div class="modal-body" id="enviadoPedido">
        
       

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btnCancelar" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
    </div>
  </div>
</div>



