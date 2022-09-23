let id_paciente_edit=null;
const ModalEditarPaciente = document.getElementById('ModalEditarPaciente')
ModalEditarPaciente.addEventListener('show.bs.modal', event => {
  // Colocar ajax

   id_paciente_edit=array_selected['ID_PACIENTE'];

   const cargarDatos = async () => {
     await getProcedencias("listProcedencia-editar");
     var procedencia = $("#listProcedencia-edit option:selected").val();
     await getSegmentoByProcedencia(procedencia, "segmentos_procedencias-edit");

     $.ajax({
       url: "../../../api/pacientes_api.php",
       type: "POST",
       data:{id:id_paciente_edit,api:2},
       success: function(data) {
         var arrayPaciente = JSON.parse(data);
         paciente=arrayPaciente[0];
         $('#listProcedencia-edit').val(paciente['PROCEDENCIA']);
         $('#segmentos_procedencias-edit').val(paciente['SEGMENTO']);
         $('#editar-nombre').val(paciente['NOMBRE']);
         $('#editar-paterno').val(paciente['PATERNO']);
         $('#editar-materno').val(paciente['MATERNO']);
         $('#editar-edad').val(paciente['EDAD']);
         $('#editar-nacimiento').val(paciente['NACIMIENTO']);
         $('#editar-curp').val(paciente['CURP']);
         $('#editar-telefono').val(paciente['CELULAR']);
         $('#editar-postal').val(paciente['POSTAL']);
         $('#editar-correo').val(paciente['CORREO']);
         $('#editar-estado').val(paciente['ESTADO']);
         $('#editar-municipio').val(paciente['MUNICIPIO']);
         $('#editar-colonia').val(paciente['COLONIA']);
         $('#editar-exterior').val(paciente['EXTERIOR']);
         $('#editar-interior').val(paciente['INTERIOR']);
         $('#editar-calle').val(paciente['CALLE']);
         $('#editar-nacionalidad').val(paciente['NACIONALIDAD']);
         $('#editar-pasaporte').val(paciente['PASAPORTE']);
         $('#editar-rfc').val(paciente['RFC']);
         $('#editar-vacuna').val(paciente['VACUNA']);
         $('#editar-vacunaExtra').val(paciente['OTRAVACUNA']);
         $('#editar-inputDosis').val(paciente['DOSIS']);
         var genero=paciente['GENERO'];
         genero=genero.toUpperCase();
         if(genero.toUpperCase() =='MASCULINO'){
           $('#edit-mascuCues').attr('checked', true);
         }  else{
           $('#edit-femenCues').attr('checked', true);
         }
       }
     })
   }


  // If necessary, you could initiate an AJAX request here







});
// Lista de segmentos dinamico
$('#listProcedencia-edit').on('change', function() {
  var procedencia = $("#listProcedencia-edit option:selected").val();
  getSegmentoByProcedencia(procedencia, "segmentos_procedencias-edit");
});




//Formulario de Preregistro
$("#formEditarPaciente").submit(function(event){
 event.preventDefault();
 /*DATOS Y VALIDACION DEL REGISTRO*/
 var form = document.getElementById("formEditarPaciente");
 var formData = new FormData(form);
 formData.set('id', id_paciente_edit);
 formData.set('api', 4);
 $i=0;
 formData.forEach(element => {
  console.log($i+' ' + element);
  $i++;
});
 Swal.fire({
    title: '¿Está seguro que todos sus datos estén correctos?',
    text: "¡No podrá revertir los cambios!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Confirmar',
    cancelButtonText: "Cancelar"
  }).then((result) => {
    if (result.isConfirmed) {
      $("#btn-actualizar").prop('disabled', true);

      // Esto va dentro del AJAX
      $.ajax({
        data:formData,
        url: "../../../api/pacientes_api.php",
        type: "POST",
        processData: false,
        contentType: false,
        success: function(data) {
          data = jQuery.parseJSON(data);
          console.log(data['response']['code']);
          switch (data['response']['code']) {
            case 1:
              Toast.fire({
                icon: 'success',
                title: 'Información actualizada :)',
                timer: 2000
              });
              document.getElementById("formEditarPaciente").reset();
              $("#ModalEditarPaciente").modal('hide');
            break;
            case "repetido":
              Swal.fire({
                 icon: 'error',
                 title: 'Oops...',
                 text: '¡CURP duplicada!',
                 footer: 'Está CURP ya existe'
              })
            break;
            default:
              Swal.fire({
                 icon: 'error',
                 title: 'Oops...',
                 text: 'Hubo un problema!',
                 footer: 'Reporte este error con el personal :)'
              })
          }
        },
      });
    }
  })
 event.preventDefault();
});


$("#editar-vacuna").change(function(){
var seleccion =$("#editar-vacuna").val();
if (seleccion.toUpperCase() =='OTRA'){
  $("#editar-vacunaExtra").prop('readonly', false);
}else{

  $("#editar-vacunaExtra").prop('readonly', true);
  $("#editar-vacunaExtra").prop('value', "NA");
  }
});
