// const modalRegistrarPaciente = document.getElementById('ModalRegistrarPaciente')
// var edited = false;
// modalRegistrarPaciente.addEventListener('show.bs.modal', event => {
//   getProcedencias("listProcedencia");
//   var procedencia = $("#listProcedencia option:selected").val();
//   getSegmentoByProcedencia(procedencia, "segmentos_procedencias-menu");
// })
// // Lista de segmentos dinamico
// $('#listProcedencia').on('change', function() {
//   var procedencia = $("#listProcedencia option:selected").val();
//   getSegmentoByProcedencia(procedencia, "segmentos_procedencias-menu");
// });

//Formulario de Preregistro
$("#formRegistrarPaciente").submit(function (event) {
  event.preventDefault();
  /*DATOS Y VALIDACION DEL REGISTRO*/
  var form = document.getElementById("formRegistrarPaciente");
  var formData = new FormData(form);
  formData.set('api', 1);
  // console.log(formData);
  // $i=0;
  //  formData.forEach(element => {
  //   console.log($i + element);
  //   $i++;
  // });

  if (registroAgendaRecepcion == 1) {
    textSwal = '¡Asegurate de tener la procedencia correcta! : )'
  } else {
    textSwal = '¡Asegurese que todos sus datos sean correctos!'
  }

  Swal.fire({
    title: '¿Todo listo?',
    text: textSwal,
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Sí, regístrame',
    cancelButtonText: "Cancelar"
  }).then((result) => {
    if (result.isConfirmed) {
      edited = true;

      // Esto va dentro del AJAX
      $.ajax({
        data: formData,
        url: `${http}${servidor}/${appname}/api/pacientes_api.php`,
        type: "POST",
        processData: false,
        contentType: false,
        beforeSend: function () {
          $("#btn-formregistrar-informacion").prop('disabled', true);
          alertMensaje('info', '¡Se están cargando sus datos!', 'El sistema está guardando su agenda.')
        },
        dataType: 'json',
        success: function (data) {
          if (mensajeAjax(data)) {
            switch (tip) {
              case "pie":
                // id = data.response.data;
                var AgendaData = new FormData();
                // if ($('#checkCurpPasaporte').is(":checked")) {
                //   AgendaData.set('pasaporte', $('#pasaporte-registro').val())
                // } else {
                //   AgendaData.set('curp', $('#curp-registro-infor').val())
                // }

                AgendaData.set('pacienteId', data.response.data);

                AgendaData.set('cliente_id', $('#selectIngresoProcedencia').val())
                // AgendaData.set('segmento_id', null) //$('#selectSegmentos').val()
                // const tiempoTranscurrido = Date.now();
                // const hoy = new Date(tempoTranscurrido);
                // hoy.toLocaleDateString(); // "14/6/2020"
                const hoy = new Date();
                AgendaData.set('fechaAgenda', formatoFechaSQL(hoy, 'yy/mm/dd'))
                AgendaData.set('api', 1);
                // console.log(AgendaData);


                $.ajax({
                  data: AgendaData,
                  url: `${http + servidor}/${appname}/api/prerregistro_api.php`,
                  type: "POST",
                  processData: false,
                  contentType: false,
                  dataType: "json",
                  // beforeSend: function () {
                  // },
                  success: function (data) {
                    if (mensajeAjax(data)) {
                      if (data.response.code == 1) {
                        // Toast.fire({
                        //   icon: 'success',
                        //   title: 'Su información a sido registrada :)',
                        //   timer: 2000
                        // });
                        //MOSTRAR PREFOLIO EN HTML PARA RESALTARLO EN ROJOS
                        alertMensaje('success', '¡Registro completado!', 'Su registro ha sido agendado, si correo está correcto, le llegará un mensaje de confirmación con su prefolio (' + data.response.data + ')')
                        $('#log').html('<div class="alert alert-success" role="alert">Su registro ha sido agendado, si correo está correcto, le llegará un mensaje de confirmación junto a su prefolio(<strong class="bg-danger">(' + data.response.data + ')</strong>)</div>')
                        // Autocompletar el campo de prefolio y CURP en consulta de resultado
                        // document.getElementById("formAntecedentes").reset();
                        // if (session.user != null) {
                        //   $("#ModalRegistrarPrueba").modal('hide');
                        //   $("#btn-formregistrar-agenda").prop('disabled', false);
                        // }
                        tablaRecepcionPacientes.ajax.reload();
                      } else {
                        alertMensaje('error', 'Agenda no registrada', 'Hubo un error, comuniquese con el personal.');
                      }
                    }
                  },
                });
                break;

              default:
                Toast.fire({
                  icon: 'success',
                  title: 'Su información a sido registrada :)',
                  timer: 2000
                });
                break;
            }

            if (!$('#checkCurpPasaporte').is(':checked')) {
              identificador = {
                valor: $('#curp-registro-infor').val(),
                tipo: false
              }
            } else {
              identificador = {
                valor: $('#pasaporte-registro').val(),
                tipo: true
              }
            }

            document.getElementById("formRegistrarPaciente").reset();
            if (session.id != null) {
              $("#ModalRegistrarPaciente").modal('hide');
              $("#btn-formregistrar-informacion").prop('disabled', false);

              alertToast('¡Continuemos con su agenda!', 'success', 4000);

              setTimeout(() => {
                $('#ModalRegistrarPrueba').modal('show');

                $('#curp-paciente').val(identificador.valor);
                $('#checkCurpPasaporte-agenda').prop('checked', identificador.tipo);
                setTimeout(() => {
                  $('#actualizarForm').click();
                }, 500);
              }, 300);

            }
          }
        },
        error: function (jqXHR, exception) {
          $("#btn-formregistrar-informacion").prop('disabled', false);
        }
      });
    }
  })
  event.preventDefault();
});


$('#checkCurpPasaporte').change(function () {
  if ($(this).is(":checked")) {
    $('#curp-registro-infor').removeAttr('required');
    $('#curp-registro-infor').prop('disabled', true);
    $('#pasaporte-registro').prop('required', true);
    $("#pasaporte-registro").focus();
    alertSelectTable('Use su pasaporte como identificación', 'info', 3000)
  } else {
    $('#pasaporte-registro').removeAttr('required');
    $('#curp-registro-infor').prop('disabled', false);
    $('#curp-registro-infor').prop('required', true);
    $("#curp-registro-infor").focus();
    alertSelectTable('Use su CURP como identificación', 'info', 3000)
  }
  // $('#checkCurpPasaporte').val($(this).is(':checked'));
});

//Campos mayus
$('#formRegistrarPaciente input[type=text]').css('text-transform', 'uppercase')
$('#formRegistrarPaciente input[type=text]').on('change keyup', function () {
  $(this).css('text-transform', 'uppercase')
  $(this).val(function () {
    return this.value.toUpperCase();
  })
})


if (registroAgendaRecepcion == 1) {
  $('#contenido-procedencia').html(`<label for="selectIngresoProcedencia" class="form-label">Selecciona procedencia</label>
  <select class="form-control input-form dataIdProcedencias" id="selectIngresoProcedencia">
  </select>`)

  select2('#selectIngresoProcedencia', "ModalRegistrarPaciente", 'Cargando...')
  rellenarSelect('#selectIngresoProcedencia', 'clientes_api', 2, 'ID_CLIENTE', 'NOMBRE_COMERCIAL')

}


//  this.value=this.value.toUpperCase();



//  const ModalRegistrarPaciente = document.getElementById('ModalRegistrarPaciente');
//
//  ModalRegistrarPaciente.addEventListener('hide.bs.modal', event => {
//   if (edited){
//     edited=false;
//     actualizarTablaPacientesRecepcion();
//   }
//  });
//
//
// $("#vacuna").change(function(){
//   var seleccion =$("#vacuna").val();
//   if (seleccion.toUpperCase() =='OTRA'){
//     $("#vacunaExtra").prop('readonly', false);
//   }else{
//
//     $("#vacunaExtra").prop('readonly', true);
//     $("#vacunaExtra").prop('value', "NA");
//     }
// });



const ModalRegistrarPaciente = document.getElementById('ModalRegistrarPaciente')
ModalRegistrarPaciente.addEventListener('show.bs.modal', event => {
  if (registroAgendaRecepcion == 1)
    rellenarSelect('#selectIngresoProcedencia', 'clientes_api', 2, 'ID_CLIENTE', 'NOMBRE_COMERCIAL')

});
