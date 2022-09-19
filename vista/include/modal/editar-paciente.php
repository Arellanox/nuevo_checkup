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
                <select class="input-form"  id="listProcedencia-edit" >
                </select>
            </div>
            <div class="col-12 col-lg-4">
              <label for="segmento" class="form-label">Segmentos</label>
              <select name="segmento" id="segmentos_procedencias-edit" class="input-form" required >
                 <!-- <option value="4">WCE-GAVSA</option> -->
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
              <input type="number" class="form-control input-form" name="edad" placeholder="" min="0" max="150" required id="editar-edad">
              <span class="input-span">años</span>
            </div>
          </div>
          <div class="col-6 col-lg-3">
            <label for="nacimiento" class="form-label">Fecha de nacimiento</label>
            <input type="date" class="form-control input-form" name="nacimiento" placeholder="" required id="editar-nacimiento">
          </div>
          <div class="col-7 col-lg-4">
            <label for="curp" class="form-label">CURP</label>
            <input type="text" class="form-control input-form" name="curp" pattern="[A-Za-z]{4}[0-9]{6}[HMhm]{1}[A-Za-z]{5}[0-9]{2}" placeholder="" required id="editar-curp">
          </div>
          <div class="col-5 col-lg-3">
            <label for="telefono" class="form-label">Télefono</label>
            <input type="number" class="form-control input-form" name="telefono" pattern="[0-9]{10}" placeholder="" id="editar-telefono">
          </div>
          <div class="col-6 col-lg-4">
            <label for="correo" class="form-label">Correo</label>
            <input type="email" class="form-control input-form" name="correo" id="editar-correo" placeholder="" >
          </div>
          <div class="col-6 col-lg-2">
            <label for="postal" class="form-label">Código postal</label>
            <input type="number" class="form-control input-form" name="postal" id="editar-postal" pattern="[0-9]{5}" placeholder="" id="editar-posta">
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
          <div class="col-6 col-lg-4">
            <label for="exterior" class="form-label">No. Exterior</label>
            <div class="input-group">
            <span class="input-span">No.</span>
              <input type="text" class="form-control input-form" name="exterior" placeholder="" id="editar-exterior">
            </div>
          </div>
          <div class="col-6 col-lg-4">
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

          <div class="col-6 col-lg-3">
            <label for="nacionalidad" class="form-label">Nacionalidad</label>
            <input type="text" class="form-control input-form" name="nacionalidad" placeholder="" id="editar-nacionalidad">
          </div>
          <div class="col-6 col-lg-3">
            <label for="pasaporte" class="form-label">Pasaporte</label>
            <input type="text" class="form-control input-form" name="pasaporte" placeholder="" id="editar-pasaporte">
          </div>
          <div class="col-6 col-lg-3">
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
            <input type="text" class="form-control input-form" name="vacunaExtra" id="editar-vacunaExtra" placeholder="" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"  readonly> 
          </div>


          <div class="col-6 col-lg-3">
            <label for="inputDosis" class="form-label">Dosis</label>
            <select class="input-form" name="inputDosis" id="editar-inputDosis">
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
                      <input type="radio" id="edit-mascuCues" name="genero" value="MASCULINO" required>
                      <label for="edit-mascuCues">Masculino</label>
                  </div>
                  <div class="col">
                      <input type="radio"  id="edit-femenCues" name="genero" value="FEMENINO" required>
                      <label for="edit-emeCues" >Femenino</label>
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
  let id_paciente_edit=null;
  const ModalEditarPaciente = document.getElementById('ModalEditarPaciente')
  ModalEditarPaciente.addEventListener('show.bs.modal', event => {
    // Colocar ajax

     id_paciente_edit=array_selected['ID_PACIENTE'];

    var select = document.getElementById("listProcedencia-edit"),
        length = select.options.length;
    while(length--){
      select.remove(length);
    }

    // If necessary, you could initiate an AJAX request here
    getProcedencias("listProcedencia-edit");
    var procedencia = $("#listProcedencia-edit option:selected").val();
    getSegmentoByProcedencia(procedencia, "segmentos_procedencias-edit");

    //  console.log(array_selected['ID_PACIENTE']);
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
</script>
