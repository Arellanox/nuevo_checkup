<div class="modal fade" id="ModalEditarPaciente" tabindex="-1" aria-labelledby="filtrador" aria-hidden="true" data-bs-backdrop="static">
  <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header header-modal">
        <h5 class="modal-title">Editar información del paciente</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p class="text-center" >Actualice la información requerida, no podrá regresar estos cambios</p>
        <form class="row" id="formEditarPaciente">
          <div class="row">
            <div class="col-12 col-lg-5">
                <label for="procedencia" class="form-label">Procedencia</label>
                <select class="input-form" name="procedencia" id="listProcedencia-edit" >
                </select>
            </div>
            <div class="col-12 col-lg-4">
              <label for="segmento" class="form-label">Segmentos</label>
              <select name="segmento" id="segmentos_procedencias-edit" class="input-form" required >
                <option value="4">WCE-GAVSA</option>
              </select>
            </div>
          </div>
          <?php include "formRegistroPaciente.php"; ?>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-cancelar" data-bs-dismiss="modal"><i class="bi bi-arrow-left-short"></i> Cancelar</button>
        <button type="submit" form="formEditarPaciente" class="btn btn-confirmar" id="btn-actualizar">
          <i class="bi bi-send-plus"></i> Actualizar
        </button>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
const ModalEditarPaciente = document.getElementById('ModalEditarPaciente')
ModalEditarPaciente.addEventListener('show.bs.modal', event => {
  // Colocar ajax
  var select = document.getElementById("listProcedencia-edit"),
      length = select.options.length;
  while(length--){
    select.remove(length);
  }
  // If necessary, you could initiate an AJAX request here
  getProcedencias("listProcedencia-edit");
  getSegmentoByProcedencia(procedencia, "segmentos_procedencias-edit");
  $.ajax({
    url: "??",
    type: "POST",
    data:{id:array_paciente['DT_RowId']},
    success: function(data) {
      $('#listProcedencia-edit').val("data")
      $('#segmentos_procedencias-edit').val("data")
      $('#editar-nombre').val("data")
      $('#editar-paterno').val("data")
      $('#editar-materno').val("data")
      $('#editar-edad').val("data")
      $('#editar-nacimiento').val("data")
      $('#editar-curp').val("data")
      $('#editar-telefono').val("data")
      $('#editar-postal').val("data")
      $('#editar-estado').val("data")
      $('#editar-municipio').val("data")
      $('#editar-colonia').val("data")
      $('#editar-exterior').val("data")
      $('#editar-interior').val("data")
      $('#editar-calle').val("data")
      $('#editar-nacionalidad').val("data")
      $('#editar-pasaporte').val("data")
      $('#editar-rfc').val("data")
      $('#editar-vacuna').val("data")
      $('#editar-vacunaextra').val("data")
      $('#editar-inputDosis').val("data")


    }
  })
})
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
   formData.set('id', array_paciente['DT_RowId']);
   formData.set('api', 3);
   console.log(formData);

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
          data: formData,
          url: "??",
          type: "POST",
          processData: false,
          contentType: false,
          success: function(data) {
            data = jQuery.parseJSON(data);
            switch (data['codigo'] == 1) {
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

deshabilitarVacunaExtra($("#editar-vacuna").val(), "editar-extra");
$("#editar-vacuna").change(function(){
 //alert($(this).val());
 deshabilitarVacunaExtra($(this).val(), "editar-extra");
});

</script>
