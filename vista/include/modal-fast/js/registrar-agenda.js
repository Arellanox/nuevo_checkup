//Formulario de registro de pruebas
// $('#formDIV *').prop('disabled',true);
$("#formDIV").fadeOut(400);
$('.btn-formregistrar-agenda').prop('disabled', true);
$('#eliminarForm').prop('disabled', true);
$('#curp-paciente').prop('readonly', false);

clienteRegistro = 19;

setTimeout(() => {
  if (nombreCliente != null) {
    $("#procedencia-registro").html(nombreCliente)
    if (clienteRegistro != 17) {
      rellenarSelect('#selectSegmentos', 'segmentos_api', 2, 0, 'DESCRIPCION', {
        cliente_id: clienteRegistro
      });
    } else {
      $('#selectSegmentos').find('option').remove().end()
    }
  }
}, 1000);


$(document).on('click', '#btn-seguir-agenda', function (event) {
  event.preventDefault();
  $('#ModalRegistrarPrueba').modal('hide');
  setTimeout(() => {
    // alertToast('Continúa completando el cuestionario y déjanos cuidar de ti.', 'success', 4000)
    $('#ModalCuestionarioRiesgo').modal('show');
  }, 300);

})

$(document).on('input change', '.required', function () {
  var allFieldsFilled = true;
  $('.required').each(function () {
    if ($(this).val() === '') {
      allFieldsFilled = false;
      return false; // Salir del bucle each si se encuentra un campo vacío
    }
  });

  if (allFieldsFilled) {
    $('.btn-formregistrar-agenda').prop('disabled', false);
  } else {
    $('.btn-formregistrar-agenda').prop('disabled', true);
  }
});


// Registrar agenda del paciente
$("#formCuestionarioRiesgo").submit(async function (event) {
  event.preventDefault();

  // alert("form formAntecedentes-paciente")
  /*DATOS Y VALIDACION DEL REGISTRO*/
  // var form = document.getElementById("formRegistrarAgenda");


  // alert('si')
  // return false;
  //proceso anterior
  var formData = new FormData();
  if (ant) {
    var formAntPersonalPato = jQuery(document.forms['formAntPersonalPato']).serializeArray();
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

    var formAntGinecologicos = jQuery(document.forms['formAntGinecologicos']).serializeArray();

    

    if (evaluarAntecedentes(formAntPersonalPato, formAntNoPatologicos, formAntHeredofamiliares, formAntPsicologico, formAntNutricionales, formMedioLaboral, formAntGinecologicos)) {
      return false;
    }


    // var formAntPersonalPato = document.getElementById('formAntPersonalPato');

    // var formData = new FormData(formAntPersonalPato);

    for (var i = 0; i < formAntPersonalPato.length; i++)
      formData.append(formAntPersonalPato[i].name, formAntPersonalPato[i].value)

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

    for(var i = 0; i < formAntGinecologicos.length; i++)
      formData.append(formAntGinecologicos[i].name, formAntGinecologicos[i].value);
    // alert('form');
  }
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

  switch (registroAgendaRecepcion) {
    case 1:
      formData.set('cliente_id', $('#selectProcedencia').val())
      formData.set('pacienteId', $('#curp-paciente').val())
      break;

    default:
      formData.set('cliente_id', clienteRegistro)
      if ($('#checkCurpPasaporte-agenda').is(":checked")) {
        formData.set('pasaporte', $('#curp-paciente').val())
      } else {
        formData.set('curp', $('#curp-paciente').val())
      }
      break;
  }



  if ($('#selectSegmentos').val() != null) {
    formData.set('segmento_id', $('#selectSegmentos').val()) //
  }
  formData.set('fechaAgenda', '2023-10-25')
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
  }).then(async (result) => {
    if (result.isConfirmed) {


      $(".btn-formregistrar-agenda").prop('disabled', true);

      //Obtiene la ID del paciente
      let idPaciente = await ajaxAwaitFormData({
        api: 1,
      }, 'pacientes_api', 'formRegistrarAgenda', { WithoutResponseData: true });
      formData.set('pacienteId', idPaciente)

      $('#formRegistrarAgenda').trigger('reset');

      $.ajax({
        data: formData,
        url: `${http}${servidor}/${appname}/api/prerregistro_api.php`,
        type: "POST",
        processData: false,
        contentType: false,
        dataType: "json",
        beforeSend: function () {
          alertMensaje('info', '¡Se están cargando sus datos!', 'El sistema está guardando su agenda. Se enviará un correo de confirmación con su prefolio.')
        },
        success: function (data) {
          if (mensajeAjax(data)) {
            if (data.response.code == 1) {

              let responseAgenda = data.response.data;

              //Checkup Fast
              const formDataArray = [];

              $('#formCuestionarioRiesgo input[name^="quest-riesgo"]:checked').each(function () {
                const name = $(this).attr('name');
                const valor = $(this).val();
                const index = name.match(/\[(\d+)\]/)[1];
                const attributeValue = $(this).attr('data-value'); // Reemplaza 'data-attribute' por el nombre del atributo que deseas obtener

                formDataArray[index] = { valor, ponderacion: attributeValue };
              });

              let totalPonderacion = 0;


              for (let key in formDataArray) {
                if (formDataArray.hasOwnProperty(key)) {
                  const ponderacion = parseInt(formDataArray[key].ponderacion);
                  if (!isNaN(ponderacion)) {
                    totalPonderacion += ponderacion;
                  }
                }
              }


              console.log(totalPonderacion);
              console.log(formDataArray);

              ajaxAwait({
                api: 1,
                prefolio: data.response.data,
                ponderacion: totalPonderacion,
                'quest-riesgo': formDataArray
              }, 'fast_checkup_api', { callbackAfter: true }, false, (data) => {

                $('#formCuestionarioRiesgo').trigger('reset')
                $('#ModalCuestionarioRiesgo').modal('hide');

                //MOSTRAR PREFOLIO EN HTML PARA RESALTARLO EN ROJOS
                // alertMensaje('success', '¡Registro completado!', 'Su registro ha sido agendado, llegará un correo de confirmación con su prefolio (' + data.response.data + ')')
                alertMensaje('success', '¡Registro completado!', 'Su registro ha sido agendado, identifique con el siguiente prefolio(' + responseAgenda + ')')
                // $('#log').html('<div class="alert alert-success" role="alert">Su registro ha sido agendado, llegará un correo de confirmación junto a su prefolio(<strong class="bg-danger">(' + responseAgenda + ')</strong>)</div>')
                $('#log').html('<div class="alert alert-success" role="alert">Su registro ha sido agendado, identifiquese con el siguiente prefolio(<strong class="bg-danger">(' + responseAgenda + ') en bimo</strong>)</div>')



                // document.getElementById("formAntecedentes").reset();
                $("#ModalRegistrarPrueba").modal('hide');
                if (session.user != null) {
                  $(".btn-formregistrar-agenda").prop('disabled', false);
                }

                //Recargar la vista
                try {
                  tablaRecepcionPacientes.ajax.reload();
                } catch (error) {
                  console.log(error);
                }
                //Recargar la vista de aceptados
                try {
                  tablaRecepcionPacientesIngrersados.ajax.reload();
                } catch (error) {
                  console.log(error);
                }
              })

            } else {
              alertMensaje('error', 'Agenda no registrada', 'Hubo un error, comuniquese con el personal.');
            }
          }
        },
      });
    }
  })
  //

  //Callback de checkup-fast
  // })
  //
})

//Revisa y alerta si falta algun campo
function evaluarAntecedentes(div1, div2, div3, div4, div5, div6, div7) {
  // console.log(div1.length)
  if (div1.length != 51) {
    alertMensaje('info', 'Antecedentes personales patológicos', 'Formulario incompleto, favor de rellenar todos')
    mostrarAntecedente('collapse-Patologicos-Target', 'formAntPersonalPato')
    return true;
  }
  if (div2.length != 20) {
    alertMensaje('info', 'Antecedentes no patológicos', 'Formulario incompleto, favor de rellenar todos')
    mostrarAntecedente('collapse-nopatologicos-Target', 'formAntNoPatologicos')
    return true;
  }
  if (div3.length != 20) {
    alertMensaje('info', 'Antecedentes heredofamiliares', 'Formulario incompleto, favor de rellenar todos')
    mostrarAntecedente('collapse-anteHeredo-Target', 'formAntHeredofamiliares')
    mostrarAntecedente('collapse-anteHeredo-Target', 'historiaFamiliarForm')
    return true;
  }
  if (div4.length != 15) {
    alertMensaje('info', 'Antecedentes psicológicos/psiquiátricos', 'Formulario incompleto, favor de rellenar todos')
    mostrarAntecedente('collapse-antPsico-Target', 'formAntPsicologico')
    return true;
  }
  if (div5.length != 26) {
    alertMensaje('info', 'Antecedentes nutricionales', 'Formulario incompleto, favor de rellenar todos')
    mostrarAntecedente('collapse-antNutri-Target', 'formAntNutricionales')
    return true;
  }
  if (div6.length != 45) {
    alertMensaje('info', 'Antecedentes medio laboral', 'Formulario incompleto, favor de rellenar todos')
    mostrarAntecedente('collapse-MedLabo-Target', 'formMedioLaboral')
    return true;
  }
  return false;
}

//Muestra al paciente el formulario a ver
function mostrarAntecedente(btn, form) {
  location.hash = '';
  // $('#' + btn).click();
  $("#" + btn).collapse("show");
  setTimeout(() => {
    location.hash = form;
  }, 300);
}

var tipoPaciente = "0"; //Particular por defecto
$('#actualizarForm').click(async function () {
  curp = $('#curp-paciente').val();
  if (ant) {
    await obtenerVistaAntecenetesPaciente('#antecedentes-registro', $('#procedencia-registro').text(), 0, pacienteActivo.array.GENERO)
    await obtenerAntecedentesPaciente(null, curp);
  } else {
    $('#cuestionadioRegistro').fadeOut(100);
    // $('input[type="radio"]').prop("checked", true)
  }

  //Solicitar si la curp existe
  // window.location.hash = "formDIV";

  // document.getElementById("mensaje").innerHTML='<div class="alert alert-success" role="alert">'+
  //    'CURP aceptada, concluya su registro seleccionando el estudio a realizar.'+
  // '</div>';
  // $('#formDIV *').prop('disabled',false);

  // $('.btn-formregistrar-agenda').prop('disabled',false);

  if (curp.length > 0) {
    $.ajax({
      data: getDataAjax(curp),
      url: `${http}${servidor}/${appname}/api/pacientes_api.php`,
      type: "POST",
      beforeSend: function () {
        $('#actualizarForm').prop('disabled', true);
        $('#checkCurpPasaporte-agenda').prop('disabled', true);
      },
      success: async function (data) {
        data = jQuery.parseJSON(data);
        if (mensajeAjax(data)) {
          if (data['response']['data'].length > 0) {
            // Toast.fire({
            //   icon: 'success',
            //   title: 'CURP valida...',
            //   timer: 2000
            // });
            $("#formDIV").fadeIn(400);
            $('#curp-paciente').prop('readonly', true);
            $('#eliminarForm').prop('disabled', false);
            document.getElementById("mensaje").innerHTML = `<div class="alert alert-success" role="alert"> 
              Identificador aceptado, verifique los siguientes datos para continuar.
            </div>`;


            $('#paciente-registro').html(data.response.data[0].NOMBRE_COMPLETO);
            if (data.response.data[0].CURP == null) {
              $('#curp-registro').html(data.response.data[0].PASAPORTE);
            }
            $('#curp-registro').html(data.response.data[0].CURP);
            $('#sexo-registro').html(data.response.data[0].GENERO);
            // $('#procedencia-registro').html(data.response.data[0].PROCEDENCIA);
            // $('#formDIV *').prop('disabled',false);
            $('.btn-formregistrar-agenda').prop('disabled', false);


          } else {
            $('#actualizarForm').prop('disabled', false);
            $('#checkCurpPasaporte-agenda').prop('disabled', false);

            alertMensajeConfirm({
              title: 'Identificación incorrecta',
              text: 'Si es su primera vez necesitamos su información personal antes de continuar',
              icon: 'info',
              confirmButtonText: 'Quiero registrame',
              cancelButtonText: 'Corregir dato',
            }, function () {
              $('#ModalRegistrarPrueba').modal('hide');
              setTimeout(() => {
                alertToast('¡Genial!, registre su información para continuar', 'info', 4000)
                $('#ModalRegistrarPaciente').modal('show');
                setTimeout(() => {
                  $('#formRegistrarPaciente input:first').focus()
                }, 800);
              }, 300);
            }, 1)
            // alertMensaje('error', 'Identificador invalido', 'Asegurese que que este usando correctamente su CURP o pasaporte');
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
  $('.btn-formregistrar-agenda').prop('disabled', true);
  // window.location.hash = "curp-paciente";
  // $('##antecedentes-registro').html('')
})



// $('.btn-formregistrar-agenda').on('click', function(){
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
  if (registroAgendaRecepcion == 1)
    return dataAjax = {
      id: text,
      api: 2
    };

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



if (registroAgendaRecepcion == 1) {
  $('#procedencia-agenda').html('<select class="form-control input-form" id="selectProcedencia"></select>')
  $('#Label-BuscarPaciente').html('<label for="curp" class="form-label" id="label-identificacion">Pacientes existentes</label>' +
    '<select class="form-control input-form" id="curp-paciente"></select>' +
    '<div class="form-check">' +
    '<input class="form-check-input" type="checkbox" value="" id="checkCurpPasaporte-agenda">' +
    '<label class="form-check-label" for="checkCurpPasaporte-agenda"> Soy extranjero </label></div>')
  select2('#curp-paciente', "ModalRegistrarPrueba", 'Cargando...')
  rellenarSelect('#curp-paciente', 'pacientes_api', 2, 'ID_PACIENTE', 'CURP.PASAPORTE.NOMBRE_COMPLETO.NACIMIENTO.EXPEDIENTE')
  $('#checkCurpPasaporte-agenda').prop('disabled', true)
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