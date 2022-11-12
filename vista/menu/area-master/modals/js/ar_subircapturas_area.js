
const ModalSubirCapturas = document.getElementById('ModalSubirCapturas')
ModalSubirCapturas.addEventListener('show.bs.modal', event => {
  // console.log(selectListaLab)
  $('#Area-estudio').html(hash)
  document.getElementById("formSubirCapturas").reset();
  // alert(selectEstudio.selectID)
  $('#nombre-paciente-capturas').val(selectPacienteArea['NOMBRE_COMPLETO'])
})

$('#inputFilesCapturasArea').on('change', function(){
  var fileList = $(this)[0].files || [] //registra todos los archivos
  let aviso = 0;
  for (file of fileList){ //una iteración de toda la vida
    ext=file.name.split('.').pop()
    console.log('>ARCHIVO: ', file.name)
    switch (ext) {
      case 'png': case 'jpg': case 'jpeg': case 'pdf':
        console.log('>>TIPO DE ARCHIVO CORRECTO: ')
        break;
      default:
        aviso = 1;
        console.log('>>TIPO DE ARCHIVO INCORRECTO', ext)
        break;
    }
  }
  if (aviso == 1) {
    $(this).val('')
    alertMensaje('error', 'Archivo incorrecto', 'Algunos archivos no son correctos')
  }
});

//Formulario Para Subir Interpretacion
$("#formSubirCapturas").submit(function (event) {
  event.preventDefault();
  /*DATOS Y VALIDACION DEL REGISTRO*/
  var form = document.getElementById("formSubirCapturas");
  var formData = new FormData(form);
  formData.set('id_turno',selectPacienteArea['ID_TURNO'])
  formData.set('id_servicio', selectEstudio.selectID)
  formData.set('id_area', areaActiva)
  formData.set('api', 10);
  Swal.fire({
    title: "¿Está seguro de subir la interpretación?",
    text: "¡No podrá cambiar el resultado!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Aceptar",
  }).then((result) => {
    if (result.isConfirmed) {
      // $('#submit-registrarEstudio').prop('disabled', true);
      // Esto va dentro del AJAX

      $.ajax({
        data: formData,
        url: '??',
        url: "../../../api/servicios_api.php",
        type: "POST",
        processData: false,
        contentType: false,
        success: function (data) {
          data = jQuery.parseJSON(data);
          if (mensajeAjax(data)) {
            Toast.fire({
              icon: "success",
              title: "¡Capturas guardadas!",
              timer: 2000,
            });
            document.getElementById("formSubirCapturas").reset();
            $("#ModalSubirCapturas").modal("hide");
            // tablaContacto.ajax.reload();
          }
        },
      });
    }
  });
  event.preventDefault();
});
