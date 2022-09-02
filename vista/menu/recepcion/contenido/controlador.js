
// Variables globales
var array_paciente;

// ObtenerTabla o cambiar
obtenerContenidoRecepcion("recepcion.php");
function obtenerContenidoRecepcion(tabla){
  obtenerTitulo('Recepción'); //Aqui mandar el nombre de la area
  $.post("contenido/"+tabla, function(html){
    var idrow;
     $("#body-js").html(html);
     // Datatable
     var tablaPrincipal = $('#TablaEjemplo').DataTable({
       language: {
         url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
       },
       lengthMenu: [[10, 15, 20, 25, 30, 35, 40, 45, 50, -1], [10, 15, 20, 25, 30, 35, 40, 45, 50, "All"]],
       columnDefs: [
         { "width": "5px", "targets": 0 },
       ],

     })

     $('#TablaEjemplo tbody').on('click', 'tr', function () {
        // alert( 'Clicked row id '+idrow );
        if ($(this).hasClass('selected')) {
            $(this).removeClass('selected');
            array_paciente = null;
        } else {
            tablaPrincipal.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
            array_paciente = tablaPrincipal.row( this ).data();
        }
    });


    $("#btn-aceptar").click(function(){
      if (array_paciente !=null) {
        $("#modalPacienteAceptar").modal('show');
      }else{
        alertRecepcion();
      }
    })

    $("#btn-rechazar").click(function(){
      if (array_paciente !=null) {
        $("#modalPacienteRechazar").modal('show');
      }else{
        alertRecepcion();
      }
    })

    $("#btn-editar").click(function(){
      if (array_paciente !=null) {
        $("#ModalEditarPaciente").modal('show');
      }else{
        alertRecepcion();
      }
    })

    $("#btn-perfil").click(function(){
      if (array_paciente !=null) {
        $("#modalPacientePerfil").modal('show');
      }else{
        alertRecepcion();
      }
    })
  });
}

function recepciónPaciente(estatus, id){
  Swal.fire({
    title: '¿Estás seguro de '+estatus+' este paciente?',
    text: "",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Aceptar',
    cancelButtonText: 'Cancelar'
  }).then((result) => {
    if (result.isConfirmed) {
      switch (estatus) {
        case 'aceptar':
          Swal.fire({
             icon: 'success',
             title: 'Aceptado!',
             text: 'El pase del paciente se está generando...'
          })
          // Ajax para generar TURNO y generar pase
        break;
        case 'rechazar':
          Swal.fire(
            'Rechazado!',
            'El paciente a sido rechazado.',
            'error'
          )
          // Ajax para cancelar registro del paciente
          break;
        default:

      }
    }
  })
}

function alertRecepcion(){
    Toast.fire({
      icon: 'error',
      title: 'No ha seleccionado ningún paciente',
      timer: 4000
    });
}
