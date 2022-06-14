window.addEventListener('load', precargar);

function precargar(){
  
  var preload = document.getElementById('wrap-preload');
  preload.classList.add('close');

}


$(document).ready(function() {
 
  // Tabla Dinamica de Soñadores
  
  var tablaSoñadora = $('#tablaSoñadores').DataTable({
    responsive: true,
    autoWidth: false,    
    "language": {
          "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json",
          "sProcessing": "Procesando...",
          "sLengthMenu": "Mostrar _MENU_ registros",
          "sZeroRecords": "No se encontraron resultados",
          "sEmptyTable": "Ningún dato disponible en esta tabla",
          "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
          "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0",
          "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
          "sInfoPostFix": "",
          "sSearch": "Buscar:",
          "sUrl": "",
          "sInfoThousands": ",",
          "sLoadingRecords": "Sin Registros",
          "oPaginate": {
              "sFirst": "Primero",
              "sLast": "Último",
              "sNext": "Siguiente",
              "sPrevious": "Anterior"
            },
            "oAria": {
              "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
              "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
          },
         "ajax" : {
          url:"ajax/tablasoñadores.ajax.php",
          type:"POST",
          "deferRender": true,
          "retrieve": true,
          "processing": true,
          }
    });

// *********************************************************

// BUSCA MUNICIPIO AL ENVIAR ID DEPARTAMENTO

    $('#departamento').change(function(){
      recargarLista();
    });

    function recargarLista(){
      $.ajax({
        type:"POST",
        url:"ajax/listadoMunicipios.ajax.php",
        data:"departamento=" + $('#departamento').val(),
        success:function(r){
          $('#listaMunicipios').html(r);
        }
      });
    }
    //*********************************************** */


// RESETEA EL MODAL DE LAS SOÑADORES
    $('#ModalCrearSoñadora').on('hidden.bs.modal', function () {
      $('#ModalCrearSoñadora form')[0].reset();
      });
// ********************************************************
    
// AGREGAR SOÑADOR
$('#ModalCrearSoñadora #agregarSoñador').submit(function(e){
  e.preventDefault();
   var addform = $(this).serialize();
   
  $.ajax({
    type: 'POST',
    url: 'ajax/soñadores.ajax.php',
    data: addform,
    success: function(respuesta){
    console.log(respuesta);
      if(respuesta == 'ok'){
        $('#ModalCrearSoñadora').modal('hide');
        Swal.fire({
          type: 'success',
          title: 'Soñador registrado exitosamente',                          
          }).then((result) => {
            window.location.reload();
          });  
      }else{
        Swal.fire({
          type: 'error',
          title: 'Soñador ya se encuentra registrado',                          
          });
      }
    }
  });
});
//************************************************************ */ 

// CAMBIAR ESTADO USUARIO Y PERSONA

$('#tablaSoñadores tbody').on("click", ".btnActivar", function() {
    var idSoñador = $(this).attr("idSoñador");
    var estadoSoñador = $(this).attr("estadoSoñador");
    var documentoSoñador = $(this).attr("documentoSoñador");
    var datos = new FormData();
    datos.append("activarId", idSoñador);
    datos.append("activarSoñador", estadoSoñador);
    datos.append("documentoSoñador", documentoSoñador);
    
    $.ajax({
      url: "ajax/soñadores.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      success: function(respuesta) {
        if(respuesta == 'ok'){
            Swal.fire({
              type: 'success',
              title: 'Estado Actualizado',                          
              }).then((result) => {
                window.location.reload();
              }); 
          }
      }
  })
}); 

// ************************************************


// VER SOÑADOR

$('#tablaSoñadores tbody').on("click", ".btnVerSoñador", function() {
var verSoñador = $(this).attr("verSoñador");
var datos = new FormData();
datos.append("verSoñador",verSoñador);
$.ajax({
  url: "ajax/soñadores.ajax.php",
  method: "POST",
  data: datos,
  cache: false,
  contentType: false,
  processData: false,
  // dataType: "json",
  success: function(respuesta) {
    var datos = JSON.parse(respuesta)
    $("#modalVerSoñador #veremail").text(datos['email']);
    $("#modalVerSoñador #vertipo").text(datos['tipo']);
    $("#modalVerSoñador #verdocumento").text(datos['documento']);
    $("#modalVerSoñador #vernombres").text(datos['nombres']);
    $("#modalVerSoñador #verapellidos").text(datos['apellidos']);
    $("#modalVerSoñador #verdireccion").text(datos['direccion']);
    $("#modalVerSoñador #vercelular").text(datos['celular']);
    $("#modalVerSoñador #verdepartamento").text(datos['departamento']);
    $("#modalVerSoñador #vermunicipio").text(datos['municipio']);
  }
  });
  
  $('#modalVerSoñador').modal('show');
});

// ************************************************

// EDITAR SOÑADOR**********************************

$('#tablaSoñadores tbody').on("click", ".btnEditarSoñador", function() {
  var idSoñador = $(this).attr("idSoñador");
  var datos = new FormData();
  datos.append("idSoñador",idSoñador);
  $.ajax({
  url: "ajax/soñadores.ajax.php",
  method: "POST",
  data: datos,
  cache: false,
  contentType: false,
  processData: false,
  success: function(respuesta) {
    var datos = JSON.parse(respuesta)
    console.log(datos);
    editarMunicipioSoñadora(datos['departamentoid']);
    $("#ModalEditarSoñador .editartipo").val(datos['tipo']);
    $("#ModalEditarSoñador .editardocumento").val(datos['documento']);
    $("#ModalEditarSoñador .editarnombres").val(datos['nombres']);
    $("#ModalEditarSoñador .editarapellidos").val(datos['apellidos']);
    $("#ModalEditarSoñador .editarf_nacimiento").val(datos['f_nacimiento']);
    $("#ModalEditarSoñador .editarsexo").val(datos['sexo']);
    $("#ModalEditarSoñador .editardireccion").val(datos['direccion']);
    $("#ModalEditarSoñador .editarcelular").val(datos['celular']);
    $("#ModalEditarSoñador .editardepartamento").val(datos['departamentoid']);
    $("#ModalEditarSoñador .editaremail").val(datos['email']);
      
     }
     });
    
     $('#ModalEditarSoñador').modal('show');
     
  });

  function editarMunicipioSoñadora(valor){
    $.ajax({
      type:"POST",
      url:"ajax/listadoMunicipios.ajax.php",
      data:"departamento=" + valor,
      success:function(r){
        $('#ModalEditarSoñador #listaMunicipios').html(r);
      }
    });
  }


  $('#ModalEditarSoñador #editarSoñador').submit(function(e){
    e.preventDefault();
    var addformedit = $(this).serialize();
    // alert(addform);
    $.ajax({
      type: 'POST',
      url: 'ajax/soñadores.ajax.php',
      data: addformedit,
      success: function(respuesta){
        if(respuesta == 'ok'){
          $('#ModalEditarSoñador').modal('hide');
          Swal.fire({
            type: 'success',
            title: 'Soñador actualizado exitosamente',                          
            });
            window.location.reload();  
        }else{
          Swal.fire({
            type: 'error',
            title: 'Problema al actualizar',                          
            });
        }
      }
    });
  });




  // TABLA PRODUCTOS************************************


  var tablaProductos = $('#tablaProductos').DataTable({
    responsive: true,
    autoWidth: false,
    "language": {
      "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json",
      "sProcessing": "Procesando...",
      "sLengthMenu": "Mostrar _MENU_ registros",
      "sZeroRecords": "No se encontraron resultados",
      "sEmptyTable": "Ningún dato disponible en esta tabla",
      "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
      "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0",
      "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
      "sInfoPostFix": "",
      "sSearch": "Buscar:",
      "sUrl": "",
      "sInfoThousands": ",",
      "sLoadingRecords": "Sin Registros",
      "oPaginate": {
          "sFirst": "Primero",
          "sLast": "Último",
          "sNext": "Siguiente",
          "sPrevious": "Anterior"
        },
        "oAria": {
          "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
          "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        }
      },
     "ajax" : {
      url:"ajax/tablaproductos.ajax.php",
      type:"POST",
      "deferRender": true,
      "retrieve": true,
      "processing": true,
      }
});

  // ***************************************************
  // RESETEA EL MODAL DE LOS PRODUCTOS
  $('#ModalCrearProducto').on('hidden.bs.modal', function () {
    $('#ModalCrearProducto form')[0].reset();
    });
// ********************************************************
  // CREAR PRODUCTO*************************************
  $('#ModalCrearProducto #agregarProducto').submit(function(e){
    e.preventDefault();
     var addform = $(this).serialize();
    $.ajax({
      type: 'POST',
      url: 'ajax/productos.ajax.php',
      data: addform,
      success: function(respuesta){
        if(respuesta == 'ok'){
          $('#ModalCrearProducto').modal('hide');
          Swal.fire({
            type: 'success',
            title: 'Producto registrado exitosamente',                          
            });
            window.location.reload(); 
        }else{
          Swal.fire({
            type: 'error',
            title: 'Producto ya se encuentra registrado con ese nombre',                          
            });
        }
      }
    });
  });

 // ***************************************************
// ESTADO PRODUCTO*************************************
$('#tablaProductos tbody').on("click", ".btnActivar", function() {
  var idProducto = $(this).attr("idProducto");
  var estadoProducto = $(this).attr("estadoProducto");
  var datos = new FormData();
  datos.append("idProducto", idProducto);
  datos.append("estadoProducto", estadoProducto);
  console.log(datos); 
    $.ajax({
      url: "ajax/productos.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      success: function(respuesta) {
        if(respuesta == 'ok'){
            Swal.fire({
              type: 'success',
              title: 'Estado Actualizado',                          
              });
              window.location.reload(); 
          }
      }
  })
}); 
// ****************************************************
// EDITAR PRODUCTO*************************************

$('#tablaProductos tbody').on("click", ".btnEditarProducto", function() {
  var idverProducto = $(this).attr("idProducto");
  var datos = new FormData();
  datos.append("idverProducto",idverProducto);
  $.ajax({
  url: "ajax/productos.ajax.php",
  method: "POST",
  data: datos,
  cache: false,
  contentType: false,
  processData: false,
  success: function(respuesta) {
    var datos = JSON.parse(respuesta)
    $("#ModalEditarProducto .editarid").val(datos['id']);
    $("#ModalEditarProducto .editarnombre").val(datos['nombre']);
    $("#ModalEditarProducto .editarvalor_unidad").val(datos['valor_unidad']);
    }
     });
    
     $('#ModalEditarProducto').modal('show');
     
  });



  $('#ModalEditarProducto #editarProducto').submit(function(e){
    e.preventDefault();
    var addform = $(this).serialize();
    $.ajax({
      type: 'POST',
      url: 'ajax/productos.ajax.php',
      data: addform,
      success: function(respuesta){
        console.log(respuesta);
        if(respuesta == 'ok'){
          $('#ModalEditarProducto').modal('hide');
          Swal.fire({
            type: 'success',
            title: 'Producto actualizado exitosamente',                          
            });
            window.location.reload(); 
        }else{
          Swal.fire({
            type: 'error',
            title: 'Problema al actualizar',                          
            });
        }
      }
    });
  });
// ****************************************************
// INGRESAR CANTIDAD AL STOCK**************************

// RESETEA EL MODAL DE LAS SOÑADORES
$('#ModalCrearStock').on('hidden.bs.modal', function () {
  $('#ModalCrearStock form')[0].reset();
  });
// ********************************************************

// AGREGAR SOÑADOR
$('#ModalCrearStock #agregarStock').submit(function(e){
e.preventDefault();
var addform = $(this).serialize();
$.ajax({
type: 'POST',
url: 'ajax/productos.ajax.php',
data: addform,
success: function(respuesta){
  // alert(respuesta);
  if(respuesta == 'ok'){
    $('#ModalCrearStock').modal('hide');
    Swal.fire({
      type: 'success',
      title: 'Cantidad agregada exitosamente',                          
      });
      window.location.reload();  
  }else{
    Swal.fire({
      type: 'error',
      title: 'Problemas al cargar la información',                          
      });
  }
}
});
});


// TABLA STOCKS****************************************

var tablaStocks = $('#tablaStocks').DataTable({
  responsive: true,
  autoWidth: false,
  "language": {
    "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json",
    "sProcessing": "Procesando...",
    "sLengthMenu": "Mostrar _MENU_ registros",
    "sZeroRecords": "No se encontraron resultados",
    "sEmptyTable": "Ningún dato disponible en esta tabla",
    "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
    "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0",
    "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
    "sInfoPostFix": "",
    "sSearch": "Buscar:",
    "sUrl": "",
    "sInfoThousands": ",",
    "sLoadingRecords": "Sin Registros",
    "oPaginate": {
        "sFirst": "Primero",
        "sLast": "Último",
        "sNext": "Siguiente",
        "sPrevious": "Anterior"
      },
      "oAria": {
        "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
      }
    },
   "ajax" : {
    url:"ajax/tablastocks.ajax.php",
    type:"POST",
    "deferRender": true,
    "retrieve": true,
    "processing": true,
    }
});

// ****************************************************
// VER DETALLE STOCKS POR PRODUCTO

$('#tablaStocks tbody').on("click", ".btnVerProductoDetalle", function(e) {
  e.preventDefault();
  var verProductoId = $(this).attr("verProductoId");
  var datos = new FormData();
  datos.append("verProductoId",verProductoId);
  $.ajax({
    url: "ajax/productos.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    // dataType: "json",
    success: function(respuesta) {
      var datos = JSON.parse(respuesta)
      var datosHtml = '';
      var total = datos.length;
      $("#tablaStockDetalle tbody").empty();
      
      for (var i = 0; i < total; i++) {
        datosHtml +="<tr><td>"+datos[i]['fecha']+"</td><td>"+datos[i]['cantidad']+" unidades</td></tr>";
      };
      $('#tablaStockDetalle tbody').append(datosHtml);
      
    }
    });
    $('#modalDetalleProducto').on('hidden.bs.modal', function () {
      $('#modalDetalleProducto form')[0].reset();
      });
    
    $('#modalDetalleProducto').modal('show');
    
    
  });



// ****************************************************
// AGREGAR PEDIDO *************************************
$('#ModalCrearPedido').on("click", ".btnAgregar", function(e) {
  e.preventDefault();
  var datoInterno = $('.datoInterno').val();
  var item = $('#producto_id').val();
  var cantidad = $('#cantidad').val();
  var datos = new FormData();
  datos.append("datoInterno",datoInterno);
  datos.append("item",item);
  datos.append("cantidad",cantidad);

  if((cantidad == 0 || cantidad == '') || item == ''){
    
    Swal.fire({
      type: 'error',
      title: 'Campos vacios en el pedido por favor revise',                          
      });

  }else{

    $.ajax({
      url: "ajax/pedidos.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      // dataType: "json",
      success: function(respuesta) {
        $('#producto_id').val('');
        $('#cantidad').val('');
        //console.log(respuesta);
        if(respuesta == 'error'){
          Swal.fire({
            type: 'error',
            title: 'El producto ya fue registrado, borrelo y vuelva a ingresarlo',                          
            });
        }
        var datos = JSON.parse(respuesta);
      
        
        var datosHtml1 = '';
        var totalPedido = 0;
        var totalP = '';
        $(".tablaIngresosProductosSoñador tbody").empty();
        var total = datos.length;
        // console.log(datos);
        for (var i = 0; i < total; i++) {
          var row = i+1;
          const numberFormat = new Intl.NumberFormat('en-US');
          var valorUnidad = numberFormat.format(datos[i]['Ped_valor_uni']);
          var valorT = datos[i]['Ped_valor_uni'] * datos[i]['Ped_cantidad'];
          var valorTotal = numberFormat.format(valorT);
          var acciones = "<div class='btn-group'><button class='btn btn-danger btn-sm btnVBorrarDetalle' verNumeroId='"+datos[i]['Ped_id']+"'>Borrar</button></div>";
          
          datosHtml1 +="<tr class='animate__animated animate__fadeIn' id='detPedido'><td>"+row+"</td><td>"+datos[i]['Ped_nombre']+"</td><td>"+datos[i]['Ped_cantidad']+"</td><td>"+valorUnidad+"</td><td>"+valorTotal+"</td><td>"+acciones+"</td></tr>";
          totalPedido += Number(valorT);
          totalP = numberFormat.format(totalPedido);
        };
          
        $(".tablaIngresosProductosSoñador tbody").append(datosHtml1);
        $(".totalPedido").text('Total: '+totalP);
        
      }
      });

      $('#ModalCrearPedido').on('hidden.bs.modal', function () {
        $('#ModalCrearPedido form')[0].reset();
        });
      
  }



});




//***************************************************** */ 
// BOTON PEDIDO CANCELAR

$('#ModalCrearPedido').on("click", ".btnCancelar", function(e) {
  e.preventDefault();
$('#producto_id').val('');
$('#cantidad').val('');
$(".tablaIngresosProductosSoñador tbody").empty();
$(".totalPedido").text('Total: ');
$("#comprobante").value = "";
var datoInternoBorrar = $('.datoInterno').val();
var datos = new FormData();
datos.append("datoInternoB",datoInternoBorrar);

$.ajax({
  url: "ajax/pedidos.ajax.php",
  method: "POST",
  data: datos,
  cache: false,
  contentType: false,
  processData: false,
  // dataType: "json",
  success: function(respuesta) {}
}); 


$('#ModalCrearPedido').on('hidden.bs.modal', function () {
  $('#ModalCrearPedido form')[0].reset();
  });
});
// *****************************************************

// BORRAR PEDIDO DETALLE ITEM
$('#ModalCrearPedido').on("click", ".btnVBorrarDetalle", function(e) {
  e.preventDefault();
  var verDetalleId = $(this).attr("verNumeroId");
  var datoInterno = $('.datoInterno').val();
  var datos = new FormData();
  datos.append("verDetalleId",verDetalleId);
  datos.append("datoInterno",datoInterno);
  console.log(datos);
  $.ajax({
    url: "ajax/pedidos.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    // dataType: "json",
    success: function(respuesta) {
      
      $('#producto_id').val('');
      $('#cantidad').val('');
      console.log(respuesta);
      var datos = JSON.parse(respuesta);
      
      var datosHtml1 = '';
      var totalPedido = 0;
      var totalP = '';
      $(".tablaIngresosProductosSoñador tbody").empty();
      var total = datos.length;
      console.log(datos);
      for (var i = 0; i < total; i++) {
        var row = i+1;
        const numberFormat = new Intl.NumberFormat('en-US');
        var valorUnidad = numberFormat.format(datos[i]['Ped_valor_uni']);
        var valorT = datos[i]['Ped_valor_uni'] * datos[i]['Ped_cantidad'];
        var valorTotal = numberFormat.format(valorT);
        var acciones = "<div class='btn-group'><button class='btn btn-danger btn-sm btnVBorrarDetalle' verNumeroId='"+datos[i]['Ped_id']+"'>Borrar</button></div>";
        
        datosHtml1 +="<tr class='animate__animated animate__fadeIn' id='detPedido'><td>"+row+"</td><td>"+datos[i]['Ped_nombre']+"</td><td>"+datos[i]['Ped_cantidad']+"</td><td>"+valorUnidad+"</td><td>"+valorTotal+"</td><td>"+acciones+"</td></tr>";
        totalPedido += Number(valorT);
        totalP = numberFormat.format(totalPedido);
      };
        
      $(".tablaIngresosProductosSoñador tbody").append(datosHtml1);
      $(".totalPedido").text('Total: '+totalP);
      $(".vrTotal").value(valorT);
      
    }
    });
});

// ******************************************************

// PROGRESS BAR CARGUE DE IMAGEN AL NAME*****************

$('#ModalCrearPedido').on("change", "#comprobante", function(e) {
   e.preventDefault();
   validarImagen(this);
});

function validarImagen(obj){
  
  var uploadFile = obj.files[0];

  if (!window.FileReader) {
      alert('El navegador no soporta la lectura de archivos');
      return;
  }

  if (!(/\.(jpeg|jpg|png)$/i).test(uploadFile.name)) {
    Swal.fire({
      type: 'error',
      title: 'Solo puede enviar imagenes',                          
      });
      document.getElementById("comprobante").value = "";
  }
}

// ******************************************************
// GUARDAR PEDIDO TABLA PRINCIPAL************************

$('#ModalCrearPedido').on("click", ".btnGuardarPedido", function(e) {
  
  e.preventDefault();
  
  if(($(".tablaIngresosProductosSoñador tbody").find("#detPedido").length == 0)){
    return Swal.fire({
      type: 'error',
      title: 'Debe agregar minimo un producto',                          
      });
      
  }
  
  var Imagen = $('#comprobante').val();
  
  if (Imagen == ''){
    return Swal.fire({
      type: 'error',
      title: 'Debe agregar comprobante de pago',                          
      });
      
  }

  var datoInterno = $('.datoInterno').val();
  var idSoñadora = $('.idS').val();
  var comprobante = $('#comprobante').prop('files')[0];
  var datos = new FormData();
  datos.append("idSoñadora",idSoñadora);
  datos.append("datoInterno",datoInterno);
  datos.append('comprobante',comprobante);

  $.ajax({
    url: "ajax/pedidos.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    // dataType: "json",
    success: function(respuesta) {
      Swal.fire({
        type: 'success',
        confirmButtonText: 'Ok',
        title: 'Pedido Creado',                          
      }).then((result) => {
        window.location.reload();
        
      });
    }
});
});

// ******************************************************
// BOTON CANCELAR CLIENTE **********************************
$('#ModalCrearCita').on("click", ".btnCancelar", function(e) {
  e.preventDefault();
  $('#ModalCrearCita').on('hidden.bs.modal', function () {
    $('#ModalCrearCita form')[0].reset();
    });
  
});



//***************************************************** */ 
// GUARDAR CLIENTE EN EL SISTEMA****************************
$('#ModalCrearCliente #crearCliente').submit(function(e){
    
  e.preventDefault();
  
  var nombres = $('#nombres').val();
  var apellidos = $('#apellidos').val();
  var celular = $('#celular').val();
  var email = $('#email').val();
  var pote = $('#pote').val();
  var soñadora = $('#soñador').val();
  var datos = new FormData();
  datos.append('nombres',nombres);
  datos.append('apellidos',apellidos);
  datos.append("celular", celular);
  datos.append("email",email);
  datos.append('pote',pote);
  datos.append('soñadora',soñadora);

  $.ajax({
    url: "ajax/pedidos.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    // dataType: "json",
    success: function(respuesta) {
      console.log(respuesta);
        Swal.fire({
          type: 'success',
          confirmButtonText: 'Ok',
          title: 'Cliente Creado',                          
        }).then((result) => {
          window.location.reload();
          
        });
      
    }
});
  
});




// ****************************************************** 
// TABLAS DE BODEGA

var tablaPedidosPendientes = $('#tablaPedidosPendientes').DataTable({
  responsive: true,
  autoWidth: false,    
  "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json",
        "sProcessing": "Procesando...",
        "sLengthMenu": "Mostrar _MENU_ registros",
        "sZeroRecords": "No se encontraron resultados",
        "sEmptyTable": "Ningún dato disponible en esta tabla",
        "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
        "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0",
        "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix": "",
        "sSearch": "Buscar:",
        "sUrl": "",
        "sInfoThousands": ",",
        "sLoadingRecords": "Sin Registros",
        "oPaginate": {
            "sFirst": "Primero",
            "sLast": "Último",
            "sNext": "Siguiente",
            "sPrevious": "Anterior"
          },
          "oAria": {
            "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
          }
        },
       "ajax" : {
        url:"ajax/tablabodega.ajax.php",
        type:"POST",
        "deferRender": true,
        "retrieve": true,
        "processing": true,
        }
  });

  // ****************************************************************************************
  // TABLA PEDIDOS ENVIADOS

  var tablaPedidosEnviados = $('#tablaPedidosEnviados').DataTable({
    responsive: true,
    autoWidth: false,    
    "language": {
          "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json",
          "sProcessing": "Procesando...",
          "sLengthMenu": "Mostrar _MENU_ registros",
          "sZeroRecords": "No se encontraron resultados",
          "sEmptyTable": "Ningún dato disponible en esta tabla",
          "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
          "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0",
          "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
          "sInfoPostFix": "",
          "sSearch": "Buscar:",
          "sUrl": "",
          "sInfoThousands": ",",
          "sLoadingRecords": "Sin Registros",
          "oPaginate": {
              "sFirst": "Primero",
              "sLast": "Último",
              "sNext": "Siguiente",
              "sPrevious": "Anterior"
            },
            "oAria": {
              "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
              "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
          },
         "ajax" : {
          url:"ajax/tablabodegaE.ajax.php",
          type:"POST",
          "deferRender": true,
          "retrieve": true,
          "processing": true,
          }
    });





  // ****************************************************************************************
  // DETALLE MODAL DEL PENDIENTE PEDIDO

  $('#tablaPedidosPendientes tbody').on("click", ".btnPendientePedido", function(e) {
    e.preventDefault();

    var idPedido = $(this).attr("idPedido");
    var datos = new FormData();
    datos.append("idPedido", idPedido);
    document.getElementById('pedido').value = idPedido;
    
    $.ajax({
      url: "ajax/pedidos.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      success: function(respuesta) {
        $("#pendientePedido").empty();
        $('#pendientePedido').append(respuesta);
        $('#modalVerPedido').modal('show');
      }
  });
});

  // ***************************************************************************
  // DETALLE MODAL ENVIADO PEDIDO
  $('#tablaPedidosEnviados tbody').on("click", ".btnEnviadoPedido", function(e) {
    e.preventDefault();

    var idPedidoF = $(this).attr("idPedidoF");
    var datos = new FormData();
    datos.append("idPedidoF", idPedidoF);
        
    $.ajax({
      url: "ajax/pedidos.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      success: function(respuesta) {
        $("#enviadoPedido").empty();
        $('#enviadoPedido').append(respuesta);
        $('#modalVerPedidoE').modal('show');
      }
  });
});
  // ***************************************************************************


    
    
  
// rotulo de embalaje
  $('#modalVerPedido #pendientePedido').on("click", ".btnRotulo", function(e) {
    e.preventDefault();

    var idRotulo = $(this).attr("rotulo");
    var datos = new FormData();
    datos.append("idRotulo", idRotulo);
    
    $.ajax({
      url: "ajax/soñadores.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      success: function(respuesta) {
        var datos = JSON.parse(respuesta);
        // console.log(datos);
        var imgData = 'vistas/img/plantillas/logo.jpg';
        var { jsPDF } = window.jspdf;
        var doc = new jsPDF({
          format: "a5"
        });
        doc.setDrawColor(0, 75, 111);
        doc.rect(5, 5, 138, 90);
        doc.addImage(imgData, "jpg", 114, 7, 25, 25);
        doc.setFontSize(12)
        doc.text(10,30, 'Nombres:');
        doc.setFontSize(18)
        doc.text(10,37, `${datos['nombres'] + " " +datos['apellidos']}`);
        doc.setFontSize(12)
        doc.text(10,47, 'Dirección:');
        doc.setFontSize(18)
        doc.text(10,54, `${datos['direccion']}`);
        doc.setFontSize(12)
        doc.text(10,64, 'Celular:');
        doc.setFontSize(18)
        doc.text(10,71, `${datos['celular']}`);
        doc.setFontSize(12)
        doc.text(10,81, 'Ciudad - Departamento:');
        doc.setFontSize(18)
        doc.text(10,88, `${datos['municipio'] + " - " +datos['departamento']}`);
        doc.save("rotulo.pdf");
      }
  });

});


$('#modalVerPedido .modal-footer').on("click", "#btnBodega", function(e) {
  e.preventDefault();
  var guia = document.getElementById('guia').value;
  if(guia == ''){
    return Swal.fire({
      type: 'error',
      title: 'Debe Agregar la Guia',                          
      });
  }
  var empresa = document.getElementById('empresa').value;
  var datoPedido = document.getElementById('pedido').value;
  var datos = new FormData();
  datos.append("datoPedido", datoPedido);
  datos.append("guia", guia);
  datos.append("empresa", empresa);

  $.ajax({
    url: "ajax/pedidos.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    success: function(respuesta) {
      console.log(respuesta);
      if(respuesta =='ok'){
      return Swal.fire({
        type: 'success',
        confirmButtonText: 'Ok',
        title: 'Pedido Aprobado',                          
      }).then((result) => {
        window.location.reload();
      });

    } 
  }
  
});
});

// ******************************************************

// VALIDAR IMAGEN DE EMBALAJE
$('#modalMostrarPedido').on("change", "#fotoPedido", function(e) {
  e.preventDefault();
  validarImagen(this);
});

// ******************************************************



// ******************************************************

// TABLA USUARIOS

var tablaSoñadora = $('#tablaUsuarios').DataTable({
  responsive: true,
  autoWidth: false,    
  "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json",
        "sProcessing": "Procesando...",
        "sLengthMenu": "Mostrar _MENU_ registros",
        "sZeroRecords": "No se encontraron resultados",
        "sEmptyTable": "Ningún dato disponible en esta tabla",
        "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
        "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0",
        "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix": "",
        "sSearch": "Buscar:",
        "sUrl": "",
        "sInfoThousands": ",",
        "sLoadingRecords": "Sin Registros",
        "oPaginate": {
            "sFirst": "Primero",
            "sLast": "Último",
            "sNext": "Siguiente",
            "sPrevious": "Anterior"
          },
          "oAria": {
            "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
          }
        },
       "ajax" : {
        url:"ajax/tablausuarios.ajax.php",
        type:"POST",
        "deferRender": true,
        "retrieve": true,
        "processing": true,
        }
  });



  //************************************************************ */ 

// CAMBIAR ESTADO USUARIO Y PERSONA

$('#tablaUsuarios tbody').on("click", ".btnActivar", function() {
  var idSoñador = $(this).attr("idSoñador");
  var estadoSoñador = $(this).attr("estadoSoñador");
  var documentoSoñador = $(this).attr("documentoSoñador");
  var datos = new FormData();
  datos.append("activarId", idSoñador);
  datos.append("activarSoñador", estadoSoñador);
  datos.append("documentoSoñador", documentoSoñador);
  
  $.ajax({
    url: "ajax/soñadores.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    success: function(respuesta) {
      if(respuesta == 'ok'){
          Swal.fire({
            type: 'success',
            title: 'Estado Actualizado',                          
            }).then((result) => {
              window.location.reload();
            });
          }
        }
      });
      
}); 

// ************************************************

// AGREGAR Usuario
$('#ModalCrearUsuario #agregarUsuario').submit(function(e){
  e.preventDefault();
   var addform = $(this).serialize();
  $.ajax({
    type: 'POST',
    url: 'ajax/soñadores.ajax.php',
    data: addform,
    success: function(respuesta){
    // alert(respuesta);
      if(respuesta == 'ok'){
        $('#ModalCrearUsuario').modal('hide');
        Swal.fire({
          type: 'success',
          title: 'Usuario registrado exitosamente',                          
          });
          window.location.reload();
      }else{
        Swal.fire({
          type: 'error',
          title: 'Usuario ya se encuentra registrado',                          
          });
      }
    }
  });
});
//************************************************************ */ 
// VER USUARIO
$('#tablaUsuarios tbody').on("click", ".btnVerSoñador", function() {
  var verSoñador = $(this).attr("verSoñador");
  var datos = new FormData();
  datos.append("verSoñador",verSoñador);
  $.ajax({
    url: "ajax/soñadores.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    // dataType: "json",
    success: function(respuesta) {
      var datos = JSON.parse(respuesta);
      console.log(datos);
      $("#modalVerUsuario #veremail").text(datos['email']);
      $("#modalVerUsuario #vertipo").text(datos['tipo']);
      $("#modalVerUsuario #verdocumento").text(datos['documento']);
      $("#modalVerUsuario #vernombres").text(datos['nombres']);
      $("#modalVerUsuario #verapellidos").text(datos['apellidos']);
      $("#modalVerUsuario #verdireccion").text(datos['direccion']);
      $("#modalVerUsuario #vercelular").text(datos['celular']);
      $("#modalVerUsuario #verdepartamento").text(datos['departamento']);
      $("#modalVerUsuario #vermunicipio").text(datos['municipio']);
    }
    });
    
    $('#modalVerUsuario').modal('show');
  });
  
  // ************************************************

  // ****************************************************** 


  // TABLAS DE EMBALAJE

var tablaEmbalaje = $('#tablaEmbalaje').DataTable({
  responsive: true,
  autoWidth: false,    
  "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json",
        "sProcessing": "Procesando...",
        "sLengthMenu": "Mostrar _MENU_ registros",
        "sZeroRecords": "No se encontraron resultados",
        "sEmptyTable": "Ningún dato disponible en esta tabla",
        "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
        "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0",
        "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix": "",
        "sSearch": "Buscar:",
        "sUrl": "",
        "sInfoThousands": ",",
        "sLoadingRecords": "Sin Registros",
        "oPaginate": {
            "sFirst": "Primero",
            "sLast": "Último",
            "sNext": "Siguiente",
            "sPrevious": "Anterior"
          },
          "oAria": {
            "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
          }
        },
       "ajax" : {
        url:"ajax/tablaembalaje.ajax.php",
        type:"POST",
        "deferRender": true,
        "retrieve": true,
        "processing": true,
        }
  });
// **************************************************

// MOSTRAR PEDIDO EMBALAJE
// DETALLE MODAL DEL PENDIENTE

$('#tablaEmbalaje tbody').on("click", ".btnMostrarPedido", function(e) {
  e.preventDefault();
  var idPedidoE = $(this).attr("idPedidoE");
  var datos = new FormData();
  datos.append("idPedidoE", idPedidoE);
  document.getElementById('pedidoE').value = idPedidoE;
  
  $.ajax({
    url: "ajax/pedidos.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    success: function(respuesta) {
      $("#pendienteEmbalaje").empty();
      $('#pendienteEmbalaje').append(respuesta);
      $('#modalMostrarPedido').modal('show');
      
    }
})

  
  
});
// *************************************************
// TOGGLE IMAGEN EMBALAJE
$('#modalMostrarPedido tbody').on("click", ".imgE", function(e) {
  $(this).attr("src", 'vistas/img/plantillas/good.png');
});

// PEDIDO YA EMBALADO Y PARA ENVIAR

$('#modalMostrarPedido .modal-footer').on("click", "#btnEmbalaje", function(e) {
  e.preventDefault();
  
  var Imagen = $('#fotoPedido').val();
  
  if (Imagen == ''){
    return Swal.fire({
      type: 'error',
      title: 'Debe agregar foto del pedido embalado',                          
      });
      
  }
  
  var datoPedidoE = document.getElementById('pedidoE').value;
  var fotoPedidoE = $('#fotoPedido').prop('files')[0];
  var datos = new FormData();
  datos.append("datoPedidoE", datoPedidoE);
  datos.append("fotoPedidoE", fotoPedidoE);
  console.log(datos);
  $.ajax({
    url: "ajax/pedidos.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    success: function(respuesta) {
      if(respuesta =='ok'){
      return Swal.fire({
        type: 'success',
        confirmButtonText: 'Ok',
        title: 'Pedido Embalado',                          
      }).then((result) => {
        window.location.reload();
      });

    } 
  }
  
});
});


// RESETEA EL MODAL DE OLVIDA CONTRASEÑA
$('#ModalNuevaContraseña').on('hidden.bs.modal', function () {
  $('#ModalNuevaContraseña form')[0].reset();
  });
//

// ENVIO USUARIO PARA RESTABLECER CONTRASEÑA
$('#ModalNuevaContraseña #buscarUsuario').submit(function(e){
  e.preventDefault();
  var addform = $(this).serialize();
  $.ajax({
    type: 'POST',
    url: 'ajax/usuarios.ajax.php',
    data: addform,
    success: function(respuesta){
    console.log(respuesta);
      if(respuesta == 'ok'){
        $('#ModalNuevaContraseña').modal('hide');
        Swal.fire({
          type: 'success',
          title: 'Verifique su correo electronico',                          
          });
          //window.location.reload();  
      }else{
        Swal.fire({
          type: 'error',
          title: 'Documento de identidad no encontrado',                          
          });
      }
    }
  });
});
// ********************************************************
// ACTUALIZAR FOTO

$('#Actualizar_foto').submit(function(e){
  e.preventDefault();
  if($('#foto_perfil').val()){
    var documentoF = $('#documento').val();
    var foto = $('#foto_perfil').prop('files')[0];
    var datos = new FormData();
    datos.append("documentoF",documentoF);
    datos.append('foto',foto);
        
    $.ajax({
      url: "ajax/usuarios.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      success: function(respuesta) {
        console.log(respuesta);
        Swal.fire({
          type: 'success',
          confirmButtonText: 'Ok',
          title: 'Foto actualizada',                          
        }).then((result) => {
          window.location.reload();
        });
      }
  });
  }else{
    return Swal.fire({
      type: 'error',
      title: 'No ha agregado la imagen',                          
      });
  }

});


$('#Actualizar_contraseña').submit(function(e){
    e.preventDefault();
    if($('#contraseña').val() === $('#re_contraseña').val()){
      var documentoC = $('#documento').val();
      var contraseña = $('#contraseña').val();
      var datos = new FormData();
      datos.append("documentoC",documentoC);
      datos.append("contraseña",contraseña);

      $.ajax({
        url: "ajax/usuarios.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        success: function(respuesta) {
          
          Swal.fire({
            type: 'success',
            confirmButtonText: 'Ok',
            title: 'Contraseña actualizada',                          
          }).then((result) => {
            window.location.reload();
          });
        }
    });
    }else{
      return Swal.fire({
        type: 'error',
        title: 'Contraseñas no coinciden',                          
        });
    }
  });

  $("#foto_perfil").change(function(e) {
    e.preventDefault();
      validarImagen(this);
  }); 
// ********************************************************
// Validar is es Lider
$('input[type=radio][name=checkLider]').on('change', function() {
  switch ($(this).val()) {
    case '1':
      $('#esLider').css('display','none');
      break;
    case '0':
      $('#esLider').css('display','block');
      break;
  }

});



// ********************************************************
// TABLA PEDIDOS ADMINISTRADOR
var tablaPedidosTotal = $('#tablaPedidosTotal').DataTable({
  responsive: true,
  autoWidth: false,    
  "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json",
        "sProcessing": "Procesando...",
        "sLengthMenu": "Mostrar _MENU_ registros",
        "sZeroRecords": "No se encontraron resultados",
        "sEmptyTable": "Ningún dato disponible en esta tabla",
        "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
        "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0",
        "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix": "",
        "sSearch": "Buscar:",
        "sUrl": "",
        "sInfoThousands": ",",
        "sLoadingRecords": "Sin Registros",
        "oPaginate": {
            "sFirst": "Primero",
            "sLast": "Último",
            "sNext": "Siguiente",
            "sPrevious": "Anterior"
          },
          "oAria": {
            "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
          }
        },
       "ajax" : {
        url:"ajax/tablapedidos.ajax.php",
        type:"POST",
        "deferRender": true,
        "retrieve": true,
        "processing": true,
        }
        
  });
// ********************************************************

// RESETEA EL MODAL SALIDA MANUAL
$('#ModalNuevaSalida').on('hidden.bs.modal', function () {
  $('#ModalNuevaSalida form')[0].reset();
  });
//

// TABLA SALIDAS MANUALES
var tablaSalidas = $('#tablaSalidas').DataTable({
  responsive: true,
  autoWidth: false,    
  "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json",
        "sProcessing": "Procesando...",
        "sLengthMenu": "Mostrar _MENU_ registros",
        "sZeroRecords": "No se encontraron resultados",
        "sEmptyTable": "Ningún dato disponible en esta tabla",
        "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
        "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0",
        "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix": "",
        "sSearch": "Buscar:",
        "sUrl": "",
        "sInfoThousands": ",",
        "sLoadingRecords": "Sin Registros",
        "oPaginate": {
            "sFirst": "Primero",
            "sLast": "Último",
            "sNext": "Siguiente",
            "sPrevious": "Anterior"
          },
          "oAria": {
            "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
          }
        },
       "ajax" : {
        url:"ajax/tablasalidas.ajax.php",
        type:"POST",
        "deferRender": true,
        "retrieve": true,
        "processing": true,
        }
        
  });

  // AGREGAR SALIDA MANUAL

  $('#ModalNuevaSalida #agregarSalida').submit(function(e){
    e.preventDefault();
     var addform = $(this).serialize();
    $.ajax({
      type: 'POST',
      url: 'ajax/salidas.ajax.php',
      data: addform,
      success: function(respuesta){
        console.log(respuesta);
        if(respuesta == 'ok'){
          $('#ModalNuevaSalida').modal('hide');
          Swal.fire({
            type: 'success',
            title: 'Salida manual realizada',                          
            });
            return window.location.reload();
        }
      }
    });
  });

// ********************************************************
// MODAL VER OBSERVACIONES

$('#tablaSalidas tbody').on("click", ".btnVerObservaciones", function() {
  var idSalida = $(this).attr("idSalida");
  var datos = new FormData();
  datos.append("idSalida",idSalida);
  $.ajax({
    url: "ajax/salidas.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    // dataType: "json",
    success: function(respuesta) {
      $("#Observaciones").empty();
      $('#Observaciones').append(respuesta);
    }
    });
    $('#ModalVerObservaciones').modal('show');
  });

// ********************************************************

// ********************************************************
// MODAL VER DETALLE PEDIDO TABLA PEDIDOS

$('#tablaPedidosTotal tbody').on("click", ".btnPedidoDetalle", function() {
  var idPedidoD = $(this).attr("idPedido");
  var datos = new FormData();
  datos.append("idPedidoD",idPedidoD);
  $.ajax({
    url: "ajax/pedidos.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    // dataType: "json",
    success: function(respuesta) {
      $("#DetallePedido").empty();
      $('#DetallePedido').append(respuesta);
    }
    });
    $('#ModalVerDetallePedido').modal('show');
  });

// ********************************************************

});
  