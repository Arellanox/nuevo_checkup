<div class="modal fade" id="ModalRegistrarPaciente" tabindex="-1" aria-labelledby="filtrador" aria-hidden="true" data-bs-backdrop="static">
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
                <select class="input-form" name="procedencia" id="listPorcedencia" >
                </select>
            </div>
            <div class="col-12 col-lg-4">
              <label for="segmento" class="form-label">Segmentos</label>
              <select name="segmento" id="segmentos_procedencias" class="input-form" required >
                <option value="4">WCE-GAVSA</option>
              </select>
            </div>
          </div>
          <div class="col-12 col-lg-4">
            <label for="nombre" class="form-label">Nombres</label>
            <input type="text" name="nombre" value="" class="form-control input-form" required>
          </div>
          <div class="col-6 col-lg-4">
            <label for="paterno" class="form-label">Apellido paterno</label>
            <input type="text" name="paterno" value="" class="form-control input-form">
          </div>
          <div class="col-6 col-lg-4">
            <label for="materno" class="form-label">Apellido materno</label>
            <input type="text" name="materno" value="" class="form-control input-form">
          </div>
          <div class="col-6 col-lg-2">
            <label for="edad" class="form-label">Edad</label>
            <div class="input-group">
              <input type="number" class="form-control input-form" name="edad" placeholder="" required>
              <span class="input-span">años</span>
            </div>
          </div>
          <div class="col-6 col-lg-3">
            <label for="nacimiento" class="form-label">Fecha de nacimiento</label>
            <input type="date" class="form-control input-form" name="nacimiento" placeholder="" required>
          </div>
          <div class="col-7 col-lg-4">
            <label for="curp" class="form-label">CURP</label>
            <input type="text" class="form-control input-form" name="curp" placeholder="" required>
          </div>
          <div class="col-5 col-lg-3">
            <label for="telefono" class="form-label">Télefono</label>
            <input type="number" class="form-control input-form" name="telefono" placeholder="" >
          </div>

          <div class="col-6 col-lg-2">
            <label for="postal" class="form-label">Código postal</label>
            <input type="number" class="form-control input-form" name="postal" placeholder="" >
          </div>
          <div class="col-6 col-lg-3">
            <label for="estado" class="form-label">Estado</label>
            <input type="text" class="form-control input-form" name="estado" placeholder="" >
          </div>
          <div class="col-6 col-lg-3">
            <label for="municipio" class="form-label">Municipio</label>
            <input type="text" class="form-control input-form" name="municipio" placeholder="" >
          </div>
          <div class="col-6 col-lg-4">
            <label for="colonia" class="form-label">Colonia</label>
            <input type="text" class="form-control input-form" name="colonia" placeholder="" >
          </div>
          <div class="col-6 col-lg-3">
            <label for="exterior" class="form-label">No. Exterior</label>
            <div class="input-group">
            <span class="input-span">No.</span>
              <input type="text" class="form-control input-form" name="exterior" placeholder="" >
            </div>
          </div>
          <div class="col-6 col-lg-3">
            <label for="interior" class="form-label">No. Interior</label>
            <div class="input-group">
              <span class="input-span">No.</span>
              <input type="text" class="form-control input-form" name="interior" placeholder="" >
            </div>
          </div>
          <div class="col-6">
            <label for="calle" class="form-label">Calle</label>
            <input type="text" class="form-control input-form" name="calle" placeholder="" >
          </div>

          <div class="col-6 col-lg-4">
            <label for="nacionalidad" class="form-label">Nacionalidad</label>
            <input type="text" class="form-control input-form" name="nacionalidad" placeholder="" >
          </div>
          <div class="col-6 col-lg-4">
            <label for="pasaporte" class="form-label">PASAPORTE</label>
            <input type="text" class="form-control input-form" name="pasaporte" placeholder="" >
          </div>
          <div class="col-6 col-lg-4">
            <label for="rfc" class="form-label">RFC</label>
            <input type="text" class="form-control input-form" name="rfc" placeholder="" >
          </div>
          <div class="col-6 col-lg-3">
            <label for="vacuna" class="form-label">Vacuna</label>
            <select class="input-form" name="vacuna" id="inputVacuna">
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
          <div class="col-6 col-lg-3" id="vacunaExtra">
            <label for="vacunaextra" class="form-label">Especifique otra vacuna</label>
            <input type="text" class="form-control input-form" id="vacunaextra" placeholder="" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();">
          </div>
          <div class="col-6 col-lg-3">
            <label for="dosis" class="form-label">Dosis</label>
            <select class="input-form" name="inputTipoPDF" id="inputDosis" >
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
  var select = document.getElementById("listPorcedencia"),
      length = select.options.length;
  while(length--){
    select.remove(length);
  }
  // If necessary, you could initiate an AJAX request here
  $.ajax({
    url: "https://bimo-lab.com/includeHTML/formularios/php/consulta-paciente-ingreso.php",
    type: "POST",
    success: function(data) {
      var data = jQuery.parseJSON(data);
      //Equipo Utilizado
      // console.log(data);
      var select = document.getElementById("listPorcedencia");
      for (var i = 0; i < data.length; i++) {
        var content = data[i]['procedencia'];
        var value = data[i]['id'];
        var el = document.createElement("option");
        el.textContent = content;
        el.value = value;
        select.appendChild(el);
      }
    },
    fail: function(){
      Toast.fire({
        icon: 'error',
        title: 'Ha ocurrido un problema con las procedencias...',
        timer: 2000
      });
    }
  })
})
// Lista de segmentos dinamico
$('#listPorcedencia').on('change', function() {
  var procedencia = $("#listPorcedencia option:selected").val();
  $.ajax({
    url: "??",
      type: "POST",
      data:{
        procedencia:procedencia
      },
    success: function(data) {
      var selectsegmentos = document.getElementById("segmentos_procedencias");
      for (var i = 0; i < data.length; i++) {
        var content = data[i]['procedencia'];
        var value = data[i]['id'];
        var el = document.createElement("option");
        el.textContent = content;
        el.value = value;
        selectsegmentos.appendChild(el);
      }
      // $("#segmentos_procedencias").html(data);
    },
    fail: function(){
      Toast.fire({
        icon: 'error',
        title: 'Ha ocurrido un problema con los segmentos...',
        timer: 2000
      });
    }
    // data: { municipios : estado }
  });
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
