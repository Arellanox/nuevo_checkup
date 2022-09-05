<div class="modal fade" id="ModalRegistrarPaciente" tabindex="-1" aria-labelledby="filtrador" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header header-modal">
        <h5 class="modal-title">Nuevo registro de paciente</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p class="text-center" >Asegurese que toda su información este correcta. <br /> Utilice su <strong>CURP</strong> para crear su registro de laboratorio</p>
        <form class="row" id="formRegistrarPaciente">
          <div class="row">
            <div class="col-12 col-lg-5">
                <label for="procedencia" class="form-label">Procedencia</label>
                <select class="input-form" name="procedencia" id="listProcedencia" >
                </select>
            </div>
            <div class="col-12 col-lg-4">
              <label for="segmento" class="form-label">Segmentos</label>
              <select name="segmento" id="segmentos_procedencias" class="input-form" required >
                <option value="4">WCE-GAVSA</option>
              </select>
            </div>
          </div>
          <?php include "formRegistroPaciente.php"; ?>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-cancelar" data-bs-dismiss="modal"><i class="bi bi-arrow-left-short"></i> Cancelar</button>
        <button type="submit" form="formRegistrarPaciente" class="btn btn-confirmar" id="btn-registrarse">
          <i class="bi bi-send-plus"></i> Registrar
        </button>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
const modalRegistrarPaciente = document.getElementById('ModalRegistrarPaciente')
modalRegistrarPaciente.addEventListener('show.bs.modal', event => {
  // Colocar ajax
  var select = document.getElementById("listProcedencia"),
      length = select.options.length;
  while(length--){
    select.remove(length);
  }

  // If necessary, you could initiate an AJAX request here
  getProcedencias("listProcedencia");
  getSegmentoByProcedencia(procedencia, "segmentos_procedencias");
})
// Lista de segmentos dinamico
$('#listProcedencia').on('change', function() {
  var procedencia = $("#listProcedencia option:selected").val();
  getSegmentoByProcedencia(procedencia, "segmentos_procedencias");
});

//Formulario de Preregistro
$("#formRegistrarPaciente").submit(function(event){
   event.preventDefault();
   /*DATOS Y VALIDACION DEL REGISTRO*/
   var form = document.getElementById("formRegistrarPaciente");
   var formData = new FormData(form);
   formData.set('api', 3);
   console.log(formData);

   Swal.fire({
      title: '¿Está seguro que todos sus datos estén correctos?',
      text: "¡No podrá editar o volverse a registrar!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Si, registrame',
      cancelButtonText: "Cancelar"
    }).then((result) => {
      if (result.isConfirmed) {
        $("#btn-registrarse").prop('disabled', true);

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
                  title: 'Su información a sido registrada :)',
                  timer: 2000
                });
                document.getElementById("formRegistrarPaciente").reset();
                $("#ModalRegistrarPaciente").modal('hide');
              break;
              case "repetido":
                Swal.fire({
                   icon: 'error',
                   title: 'Oops...',
                   text: '¡Usted ya está registrado!',
                   footer: 'Utilice su CURP para registrarse en una nueva prueba'
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

deshabilitarVacunaExtra($("#inputVacuna").val(), 'vacunaExtra');
$("#inputVacuna").change(function(){
 //alert($(this).val());
 deshabilitarVacunaExtra($(this).val(), 'vacunaExtra');
});


</script>
