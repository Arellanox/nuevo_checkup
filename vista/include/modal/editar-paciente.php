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
            <div class="col-12 col-lg-4">
                <label for="procedencia" class="form-label">Procedencia</label>
                <input type="text" readonly name="procedencia" value="SLCHUMBERGER" class="input-form" id="procedencia">
            </div>
            <div class="col-12 col-lg-4">
              <label for="segmento" class="form-label">Segmentos</label>
              <select name="segmento" class="input-form" required id="segmentos_procedencias">
                <option value="4">WCE-GAVSA</option>
              </select>
            </div>
          </div>
          <div class="col-12 col-lg-4">
            <label for="nombre" class="form-label">Nombres</label>
            <input type="text" name="nombre" value="" class="form-control input-form" required id="editar-nombre">
          </div>
          <div class="col-6 col-lg-4">
            <label for="paterno" class="form-label">Apellido paterno</label>
            <input type="text" name="paterno" value="" class="form-control input-form" id="editar-paterno">
          </div>
          <div class="col-6 col-lg-4">
            <label for="materno" class="form-label">Apellido materno</label>
            <input type="text" name="materno" value="" class="form-control input-form" id="editar-materno">
          </div>
          <div class="col-6 col-lg-2">
            <label for="edad" class="form-label">Edad</label>
            <div class="input-group">
              <input type="number" class="form-control input-form" name="edad" placeholder="" required id="editar-edad">
              <span class="input-span">años</span>
            </div>
          </div>
          <div class="col-6 col-lg-3">
            <label for="nacimiento" class="form-label">Fecha de nacimiento</label>
            <input type="date" class="form-control input-form" name="nacimiento" placeholder="" required id="editar-nacimiento">
          </div>
          <div class="col-7 col-lg-4">
            <label for="curp" class="form-label">CURP</label>
            <input type="text" class="form-control input-form" name="curp" placeholder="" required id="editar-curp">
          </div>
          <div class="col-5 col-lg-3">
            <label for="telefono" class="form-label">Télefono</label>
            <input type="number" class="form-control input-form" name="telefono" placeholder="" id="editar-telefono">
          </div>

          <div class="col-6 col-lg-2">
            <label for="postal" class="form-label">Código postal</label>
            <input type="number" class="form-control input-form" name="postal" placeholder="" id="editar-posta">
          </div>
          <div class="col-6 col-lg-3">
            <label for="estado" class="form-label">Estado</label>
            <input type="text" class="form-control input-form" name="estado" placeholder="" id="editar-estado">
          </div>
          <div class="col-6 col-lg-3">
            <label for="municipio" class="form-label">Municipio</label>
            <input type="text" class="form-control input-form" name="municipio" placeholder="" id="editar-municipio">
          </div>
          <div class="col-6 col-lg-4">
            <label for="colonia" class="form-label">Colonia</label>
            <input type="text" class="form-control input-form" name="colonia" placeholder="" id="editar-colonia">
          </div>
          <div class="col-6 col-lg-3">
            <label for="exterior" class="form-label">No. Exterior</label>
            <div class="input-group">
            <span class="input-span">No.</span>
              <input type="text" class="form-control input-form" name="exterior" placeholder="" id="editar-exterior">
            </div>
          </div>
          <div class="col-6 col-lg-3">
            <label for="interior" class="form-label">No. Interior</label>
            <div class="input-group">
              <span class="input-span">No.</span>
              <input type="text" class="form-control input-form" name="interior" placeholder="" id="editar-interior">
            </div>
          </div>
          <div class="col-6">
            <label for="calle" class="form-label">Calle</label>
            <input type="text" class="form-control input-form" name="calle" placeholder="" id="editar-calle">
          </div>

          <div class="col-6 col-lg-4">
            <label for="nacionalidad" class="form-label">Nacionalidad</label>
            <input type="text" class="form-control input-form" name="nacionalidad" placeholder="" id="editar-nacionalidad">
          </div>
          <div class="col-6 col-lg-4">
            <label for="pasaporte" class="form-label">Pasaporte</label>
            <input type="text" class="form-control input-form" name="pasaporte" placeholder="" id="editar-pasaporte">
          </div>
          <div class="col-6 col-lg-4">
            <label for="rfc" class="form-label">RFC</label>
            <input type="text" class="form-control input-form" name="rfc" placeholder="" id="editar-rfc">
          </div>
          <div class="col-6 col-lg-3">
            <label for="vacuna" class="form-label">Vacuna</label>
            <select class="input-form" name="vacuna" id="editar-vacuna">
                <option value="1" >Ninguno...</opcion>
                <option value="PFIZER">PFIZER</opcion>
                <option value="ASTRA ZENECA" >ASTRA ZENECA</opcion>
                <option value="SPUTNIK V" >SPUTNIK V</opcion>
                <option value="SINOVAC" >SINOVAC</opcion>
                <option value="CANSINO" >CANSINO</opcion>
                <option value="MODERNA" >MODERNA</opcion>
                <option value="COVAX" >COVAX</opcion>
                <option value="JOHNSON & JOHNSON" >JOHNSON & JOHNSON</opcion>
                <option value="SINOPHARM" >SINOPHARM</opcion>
                <option value="OTRA">OTRA (ESPECIFIQUE)</opcion>
            </select>
          </div>
          <div class="col-6 col-lg-3" id="editar-extra">
            <label for="vacunaextra" class="form-label">Especifique otra vacuna</label>
            <input type="text" class="form-control input-form" id="editar-vacunaextra" placeholder="" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();">
          </div>
          <div class="col-6 col-lg-3">
            <label for="dosis" class="form-label">Dosis</label>
            <select class="input-form" name="inputTipoPDF" id="inputDosis">
                <option value="1" >Ninguno...</opcion>
                <option value="1RA" >1RA DOSIS</opcion>
                <option value="2DA">2DA DOSIS</opcion>
                <option value="3RA" >3RA DOSIS</opcion>
                <option value="REFUERZO" >REFUERZO</opcion>
            </select>
          </div>
          <div class="col-12 col-lg-6" style="margin-top: 30px;margin-bottom: 15px;">
              <div class="container">
                <div class="row"style="zoom:110%;">
                  <div class="col-md-auto">
                    <label for="" >Genero: </label>
                  </div>
                  <div class="col">
                      <input type="radio" id="mascuCues" name="genero" value="MASCULINO" required>
                      <label for="mascuCues">Masculino</label>
                  </div>
                  <div class="col">
                      <input type="radio"  id="FemeCues" name="genero" value="FEMENINO" required>
                      <label for="FemeCues" >Femenino</label>
                  </div>
                </div>
              </div>
          </div>
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
//Formulario de Preregistro
$("#formEditarPaciente").submit(function(event){
   event.preventDefault();
   /*DATOS Y VALIDACION DEL REGISTRO*/
   var form = document.getElementById("formEditarPaciente");
   var formData = new FormData(form);
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

deshabilitarVacunaExtra($("#editar-vacuna").val(), 'editar-extra');
$("#editar-vacuna").change(function(){
 //alert($(this).val());
 deshabilitarVacunaExtra($(this).val(), 'editar-extra');
});

</script>
