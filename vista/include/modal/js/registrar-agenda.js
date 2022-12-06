//Formulario de registro de pruebas
// $('#formDIV *').prop('disabled',true);
$("#formDIV").fadeOut(400);
$('#btn-formregistrar-agenda').prop('disabled', true);
$('#eliminarForm').prop('disabled', true);
$('#curp-paciente').prop('readonly', false);



// Registrar agenda del paciente
$("#formRegistrarAgenda").submit(function (event) {
  event.preventDefault();
  alert("form formAntecedentes-paciente")
  /*DATOS Y VALIDACION DEL REGISTRO*/
  // var form = document.getElementById("formRegistrarAgenda");

  var formAntPersonalPato = jQuery(document.forms['formAntNoPatologicos']).serializeArray();
  // var formAntNoPatologicos = document.getElementById('formAntNoPatologicos');
  var formAntNoPatologicos = jQuery(document.forms['formAntNoPatologicos']).serializeArray();
  // var formAntHeredofamiliares = document.getElementById('formAntHeredofamiliares');
  var formAntHeredofamiliares = jQuery(document.forms['formAntHeredofamiliares']).serializeArray();
  // var formAntPsicologico = document.getElementById('formAntPsicologico');
  var formAntPsicologico = jQuery(document.forms['formAntPsicologico']).serializeArray();
  // var formAntNutricionales = document.getElementById('formAntNutricionales');
  var formAntNutricionales = jQuery(document.forms['formAntNutricionales']).serializeArray();
  // var formMedioLaboral = document.getElementById('formMedioLaboral');
  var formMedioLaboral = jQuery(document.forms['formMedioLaboral']).serializeArray();

  if (evaluarAntecedentes(formAntPersonalPato, formAntNoPatologicos, formAntHeredofamiliares, formAntPsicologico, formAntNutricionales, formMedioLaboral)) {
    alertMensaje('info', 'Antecedentes incompletos', 'Necesita llenar todo el formulario de antecedentes')
    return false;
  }


  var formAntPersonalPato = document.getElementById('formAntPersonalPato');

  var formData = new FormData(formAntPersonalPato);

  for (var i = 0; i < formAntNoPatologicos.length; i++)
    formData.append(formAntNoPatologicos[i].name, formAntNoPatologicos[i].value)

  for (var i = 0; i < formAntHeredofamiliares.length; i++)
    formData.append(formAntHeredofamiliares[i].name, formAntHeredofamiliares[i].value);

  for (var i = 0; i < formAntPsicologico.length; i++)
    formData.append(formAntPsicologico[i].name, formAntPsicologico[i].value);

  for (var i = 0; i < formAntNutricionales.length; i++)
    formData.append(formAntNutricionales[i].name, formAntNutricionales[i].value);

  for (var i = 0; i < formMedioLaboral.length; i++)
    formData.append(formMedioLaboral[i].name, formMedioLaboral[i].value);

  // var formData = new FormData(document.forms['form-ship']); // with the file input
  // var poData = jQuery(document.forms['po-form']).serializeArray();
  // for (var i=0; i<poData.length; i++)
  //     formData.append(poData[i].name, poData[i].value);


  // console.log(formData.get('estudiosLab[]'))
  // if (formData.get('estudiosLab[]') == null) {
  //   Swal.fire({
  //      icon: 'error',
  //      title: 'Oops...',
  //      text: 'No ha seleccionado ninguna prueba!',
  //   })
  //   return
  // }
  // formData.set('antecedentes', json);
  if ($('#checkCurpPasaporte-agenda').is(":checked")) {
    formData.set('pasaporte', $('#curp-paciente').val())
  } else {
    formData.set('curp', $('#curp-paciente').val())
  }

  formData.set('cliente_id', clienteRegistro)
  // formData.set('segmento_id', null) //$('#selectSegmentos').val()
  formData.set('fechaAgenda', $('#fecha-agenda').val())
  formData.set('api', 1);
  // console.log(formData);
  Swal.fire({
    title: '¿Está seguro que todos sus datos son correctos?',
    text: "¡No podrá volver a registrarse hasta terminar la solicitud de registro anterior!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Sí, regístrame',
    cancelButtonText: "Cancelar"
  }).then((result) => {
    if (result.isConfirmed) {
      $("#btn-formregistrar-agenda").prop('disabled', true);

      $.ajax({
        data: formData,
        url: http + servidor + "/nuevo_checkup/api/prerregistro_api.php",
        type: "POST",
        processData: false,
        contentType: false,
        beforeSend: function () {
          alertMensaje('info', '¡Se están cargando sus datos!', 'El sistema está guardando su agenda. Se enviará un correo de confirmación con su prefolio.')
        },
        success: function (data) {
          data = jQuery.parseJSON(data);
          if (mensajeAjax(data)) {
            if (data.response.code == 1) {
              // Toast.fire({
              //   icon: 'success',
              //   title: 'Su información a sido registrada :)',
              //   timer: 2000
              // });
              //MOSTRAR PREFOLIO EN HTML PARA RESALTARLO EN ROJOS
              alertMensaje('success', '¡Registro completado!', 'Su registro ha sido agendado, llegará un correo de confirmación con su prefolio <strong class="bg-danger">(' + data.response.data + ')</strong>')
              // Autocompletar el campo de prefolio y CURP en consulta de resultado

              document.getElementById("formAntecedentes").reset();
              if (session.user != null) {
                $("#ModalRegistrarPrueba").modal('hide');
                $("#btn-formregistrar-agenda").prop('disabled', false);
              }
            } else {
              alertMensaje('error', 'Agenda no registrada', 'Hubo un error, comuniquese con el personal.');
            }
          }
        },
      });
    }
  })
})

function evaluarAntecedentes(div1, div2, div3, div4, div5, div6) {
  if (div1.length != 20) {
    return true;
  }
  if (div2.length != 20) {
    return true;
  }
  if (div3.length != 20) {
    return true;
  }
  if (div4.length != 15) {
    return true;
  }
  if (div5.length != 26) {
    return true;
  }
  if (div6.length != 45) {
    return true;
  }
  return false;
}

var tipoPaciente = "0"; //Particular por defecto
$('#actualizarForm').click(function () {

  //Solicitar si la curp existe
  // window.location.hash = "formDIV";

  // document.getElementById("mensaje").innerHTML='<div class="alert alert-success" role="alert">'+
  //    'CURP aceptada, concluya su registro seleccionando el estudio a realizar.'+
  // '</div>';
  // $('#formDIV *').prop('disabled',false);

  // $('#btn-formregistrar-agenda').prop('disabled',false);
  curp = $('#curp-paciente').val();
  if (curp.length > 0) {
    $.ajax({
      data: getDataAjax(curp),
      url: http + servidor + "/nuevo_checkup/api/pacientes_api.php",
      type: "POST",
      beforeSend: function () {
        $('#actualizarForm').prop('disabled', true);
        $('#checkCurpPasaporte-agenda').prop('disabled', true);
      },
      success: async function (data) {
        data = jQuery.parseJSON(data);
        if (mensajeAjax(data)) {
          if (data['response']['data'].length > 0) {
            Toast.fire({
              icon: 'success',
              title: 'CURP valida...',
              timer: 2000
            });
            $("#formDIV").fadeIn(400);
            $('#curp-paciente').prop('readonly', true);
            $('#eliminarForm').prop('disabled', false);
            document.getElementById("mensaje").innerHTML = '<div class="alert alert-success" role="alert">' +
              'CURP aceptada, concluya su registro seleccionando el estudio a realizar.' +
              '</div>';
            $('#paciente-registro').html(data.response.data[0].NOMBRE_COMPLETO);
            if (data.response.data[0].CURP == null) {
              $('#curp-registro').html(data.response.data[0].PASAPORTE);
            } else {
              $('#curp-registro').html(data.response.data[0].CURP);
            }
            $('#curp-registro').html(data.response.data[0].CURP);
            $('#sexo-registro').html(data.response.data[0].GENERO);
            // $('#procedencia-registro').html(data.response.data[0].PROCEDENCIA);
            // $('#formDIV *').prop('disabled',false);
            $('#btn-formregistrar-agenda').prop('disabled', false);
            await obtenerVistaAntecenetesPaciente('#antecedentes-registro', $('#procedencia-registro').text(), 0)

          } else {
            $('#actualizarForm').prop('disabled', false);
            $('#checkCurpPasaporte-agenda').prop('disabled', false);
            alertMensaje('error', 'Identificador invalido', 'Asegurese que que este usando correctamente su CURP o pasaporte');
          }
        }
      },
      error: function () {
        $('#actualizarForm').prop('disabled', false);
        $('#checkCurpPasaporte-agenda').prop('disabled', false);
      }
    });
  } else {
    alertMensaje('error', 'Identificador invalido', 'Asegurese que que este usando correctamente su CURP o pasaporte');
  }

  // obtenerSignosVitales('#antecedentes-registro')
})

$('#eliminarForm').click(function () {
  $('#curp-paciente').prop('readonly', false);
  $('#eliminarForm').prop('disabled', true);
  $('#actualizarForm').prop('disabled', false);
  $('#checkCurpPasaporte-agenda').prop('disabled', false);
  // $('#formDIV *').prop('disabled',true);
  $("#formDIV").fadeOut(400);
  $('#btn-formregistrar-agenda').prop('disabled', true);
  // window.location.hash = "curp-paciente";
  // $('##antecedentes-registro').html('')
})



// $('#btn-formregistrar-agenda').on('click', function(){
//   if ($('input[type="radio"]:not(:checked)').length != 126 ) {
//     alert($('input[type="radio"]:not(:checked)').length)
//     console.log($('input[type="radio"]:not(:checked)'))
//     $('input[type="radio"]').prop("checked", true);
//   }else{
//     var form = document.getElementById("formAntecedentes-paciente");
//     var formData = new FormData(form);
//     formData.set('curp', $('#curp-paciente').val())
//     formData.set('procedencia', tipoPaciente)
//     console.log(formData.getAll);
//   }
// })

$('#checkCurpPasaporte-agenda').change(function () {
  if ($(this).is(":checked")) {
    $('#label-identificacion').html('Pasaporte')
  } else {
    $('#label-identificacion').html('CURP')
  }

  $("#curp-paciente").focus();
});

function getDataAjax(text) {
  if ($('#checkCurpPasaporte-agenda').is(":checked")) {
    return dataAjax = {
      pasaporte: text,
      api: 2
    };
  } else {
    return dataAjax = {
      curp: text,
      api: 2
    };
  }
}



$(document).on("change ,  keyup", "input[type='radio']", function () {
  var parent_element = $(this).closest("div[class='row']");
  if (this.value == true) {
    var collapID = $(parent_element).children("div[class='collapse']").attr("id");
    $('#' + collapID).collapse("show")
    // $('#'+collapID).find(':input').prop('required', true);
  } else {
    var collapID = $(parent_element).children("div[class='collapse show']").attr("id");
    $('#' + collapID).collapse("hide")
    $('#' + collapID).find(':input').val('')
    // $('#'+collapID).find(':input').prop('required', false);
  }
});

if (registroAgendaProcedencia == 1) {
  $('#procedencia-agenda').html('<select class="form-control input-form" id="selectProcedencia"></select>')
}
// else{
//   $('#procedencia-agenda').html('<p id="procedencia-registro">PARTICULAR</p>')
// }


//Mayus
$('#curp-paciente').css('text-transform', 'uppercase')
$('#curp-paciente').val(function () {
  return this.value.toUpperCase();
})

// $("#formDIV").addClass("disable-div");