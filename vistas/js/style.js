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
    // alert(respuesta);
      if(respuesta == 'ok'){
        $('#ModalCrearSoñadora').modal('hide');
        Swal.fire({
          type: 'success',
          title: 'Soñador registrado exitosamente',                          
          });
          tablaSoñadora.ajax.reload();  
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
              });
              tablaSoñadora.ajax.reload();  
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
  //   // dataType: "json",
    
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
            tablaSoñadora.ajax.reload();  
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
            tablaProductos.ajax.reload();  
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
              tablaProductos.ajax.reload();  
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
            tablaProductos.ajax.reload();  
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
      tablaStocks.ajax.reload();  
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
// BOTON CANCELAR CITA **********************************
$('#ModalCrearCita').on("click", ".btnCancelar", function(e) {
  e.preventDefault();
  $('#ModalCrearCita').on('hidden.bs.modal', function () {
    $('#ModalCrearCita form')[0].reset();
    });
  
});



//***************************************************** */ 
// GUARDAR CITA EN EL SISTEMA****************************
$('#ModalCrearCita #crearCita').submit(function(e){
    
  e.preventDefault();
  var fecha = $('#fecha').val();
  var hora = $('#hora').val();
  var nombres = $('#nombres').val();
  var celular = $('#celular').val();
  var pote = $('#pote').val();
  var acta = $('#acta').val();
  var servicio = $('#servicio').val();
  var soñadora = $('#soñador').val();
  var datos = new FormData();
  datos.append("fecha",fecha);
  datos.append("hora",hora);
  datos.append('nombres',nombres);
  datos.append("celular", celular);
  datos.append("pote",pote);
  datos.append('acta',acta);
  datos.append('servicio',servicio);
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
        Swal.fire({
          type: 'success',
          confirmButtonText: 'Ok',
          title: 'Cita Creada',                          
        }).then((result) => {
          window.location.reload();
          
        });
      
    }
});
  
});




// ******************************************************




  });