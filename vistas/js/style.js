window.addEventListener('load', precargar);

function precargar(){
  
  var preload = document.getElementById('wrap-preload');
  preload.classList.add('close');

}


$(document).ready(function() {
 
  // Tabla Dinamica de Soñadores
  
  var tablaSoñadora = $('#tablaSoñadores').DataTable({
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
$('#agregarSoñador').submit(function(e){
  e.preventDefault();
 
  var addform = $(this).serialize();
  //console.log(addform);
  
  $.ajax({
    type: 'POST',
    url: 'ajax/soñadores.ajax.php',
    data: addform,
    success: function(respuesta){
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
        alert(respuesta);
          // if(respuesta == 'ok'){
          //   Swal.fire({
          //     type: 'success',
          //     title: 'Estado Actualizado',                          
          //     });
          //     tablaSoñadora.ajax.reload();  
          // }
      }
  })
}); 





  });