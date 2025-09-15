let pacienteMedios = [];
let ModalEditarPaciente = $('#ModalEditarPaciente');

/*ModalEditarPaciente.addEventListener('shown.bs.modal', async event => {
  console.log('Modal Abierto 1')
  $('#editar-nombre').val(array_selected['NOMBRE']);
  $('#editar-paterno').val(array_selected['PATERNO']);
  $('#editar-materno').val(array_selected['MATERNO']);
  $('#editar-nacimiento').val(array_selected['NACIMIENTO']);


  // Calcular edad
  $(`#editar-edad`).val(calcularEdad2(array_selected['NACIMIENTO'])['numero'])
  $(`#span_formEdad_edit`).html(calcularEdad2(array_selected['NACIMIENTO'])['tipo'])

  $('#editar-curp').val(array_selected['CURP']);
  $('#editar-telefono').val(array_selected['CELULAR']);
  $('#editar-postal').val(array_selected['POSTAL']);
  $('#editar-correo').val(array_selected['CORREO']);
  $('#editar-correo_2').val(array_selected['CORREO_2']);
  $('#editar-estado').val(array_selected['ESTADO']);
  $('#editar-municipio').val(array_selected['MUNICIPIO']);
  $('#editar-colonia').val(array_selected['COLONIA']);
  $('#editar-exterior').val(array_selected['EXTERIOR']);
  $('#editar-interior').val(array_selected['INTERIOR']);
  $('#editar-calle').val(array_selected['CALLE']);
  $('#editar-nacionalidad').val(array_selected['NACIONALIDAD']);
  $('#editar-pasaporte').val(array_selected['PASAPORTE']);
  $('#editar-rfc').val(array_selected['RFC']);
  $('#editar-vacuna').val(array_selected['VACUNA']);
  $('#editar-vacunaExtra').val(array_selected['OTRAVACUNA']);
  $('#editar-inputDosis').val(array_selected['DOSIS']);

  let genero = array_selected['GENERO'];
  genero = genero.toUpperCase();

  if (genero.toUpperCase() === 'MASCULINO') $('#edit-mascuCues').attr('checked', true);
  else $('#edit-femenCues').attr('checked', true);

  if(array_selected['MEDIOS_ENTREGA']) {
    const medios = array_selected['MEDIOS_ENTREGA'];
    const mediosArray = medios.split(',').map(m => m.trim());

    if (mediosArray.length > 0) {
      mediosArray.forEach((item) => {
        if (item === "CORREO") $('#correo').prop('checked', true);
        else if (item === "WHATSAPP") $('#whatsapp').prop('checked', true);
        else if (item === "IMPRESO") $('#impreso').prop('checked', true);
      });
    }
    console.log(medios)
  }
});*/

$('#ModalEditarPaciente').on('shown.bs.modal', function () {

    $('#editar-nombre').val(array_selected['NOMBRE']);
    $('#editar-paterno').val(array_selected['PATERNO']);
    $('#editar-materno').val(array_selected['MATERNO']);
    $('#editar-nacimiento').val(array_selected['NACIMIENTO']);

    // Calcular edad
    $(`#editar-edad`).val(calcularEdad2(array_selected['NACIMIENTO'])['numero'])
    $(`#span_formEdad_edit`).html(calcularEdad2(array_selected['NACIMIENTO'])['tipo'])

    $('#editar-curp').val(array_selected['CURP']);
    $('#editar-telefono').val(array_selected['CELULAR']);
    $('#editar-telefono-2').val(array_selected['CELULAR_2']);
    $('#editar-postal').val(array_selected['POSTAL']);
    $('#editar-correo').val(array_selected['CORREO']);
    $('#editar-correo_2').val(array_selected['CORREO_2']);
    $('#editar-estado').val(array_selected['ESTADO']);
    $('#editar-municipio').val(array_selected['MUNICIPIO']);
    $('#editar-colonia').val(array_selected['COLONIA']);
    $('#editar-exterior').val(array_selected['EXTERIOR']);
    $('#editar-interior').val(array_selected['INTERIOR']);
    $('#editar-calle').val(array_selected['CALLE']);
    $('#editar-nacionalidad').val(array_selected['NACIONALIDAD']);
    $('#editar-pasaporte').val(array_selected['PASAPORTE']);
    $('#editar-rfc').val(array_selected['RFC']);
    $('#editar-vacuna').val(array_selected['VACUNA']);
    $('#editar-vacunaExtra').val(array_selected['OTRAVACUNA']);
    $('#editar-inputDosis').val(array_selected['DOSIS']);

    $('.input-edit-correo-check').prop('checked', false);
    $('.input-edit-whatsapp-check').prop('checked', false);
    $('.input-edit-impreso-check').prop('checked', false);

    let genero = array_selected['GENERO'];
    genero = genero.toUpperCase();

    if (genero.toUpperCase() === 'MASCULINO') $('#edit-mascuCues').attr('checked', true);
    else $('#edit-femenCues').attr('checked', true);

    if(array_selected['MEDIOS_ENTREGA']) {
        const medios = array_selected['MEDIOS_ENTREGA'];
        const mediosArray = medios.split(',').map(m => m.trim());
        const evaluted = []; // Pérmite saber si un medio ya fue evaluado o no

        if (mediosArray.length > 0) {
            mediosArray.forEach((item) => {
                if (item === "CORREO") {
                    $('.input-edit-correo-check').prop('checked', true);
                    evaluted.push("CORREO");
                } else {
                    if (!evaluted.includes("CORREO")) $('.input-edit-correo-check').prop('checked', false);
                }

                if (item === "WHATSAPP") {
                  $('.input-edit-whatsapp-check').prop('checked', true);
                    evaluted.push("WHATSAPP");
                } else {
                    if (!evaluted.includes("WHATSAPP")) $('.input-edit-whatsapp-check').prop('checked', false);
                }

                if (item === "IMPRESO") {
                    $('.input-edit-impreso-check').prop('checked', true);
                    evaluted.push("IMPRESO");
                }  else {
                    if (!evaluted.includes("IMPRESO")) $('.input-edit-impreso-check').prop('checked', false);
                }
            });
        }
    }

/*
    console.log(array_selected)
*/
});

function obtenerMediosEntrega () {
    var medios = []
    if ($('.input-edit-impreso-check').is(':checked')) medios.push('3')
    if ($('.input-edit-whatsapp-check').is(':checked')) medios.push('2')
    if ($('.input-edit-correo-check').is(':checked')) medios.push('1')

    if (medios.length <= 0) {
        medios = pacienteMedios;
    }

    return medios
}

$('#ModalEditarPaciente').on('hidden.bs.modal', function () {
    $('.input-correo-check').prop('checked', false);
    $('.input-whatsapp-check').prop('checked', false);
    $('.input-impreso-check').prop('checked', false);

    $('.input-edit-impreso-check').prop('checked', false);
    $('.input-edit-whatsapp-check').prop('checked', false);
    $('.input-edit-correo-check').prop('checked', false);
})

//Formulario de Preregistro
$("#formEditarPaciente").submit(function (event) {
    event.preventDefault();

    /*selectedMedia = '';

    let checkedCount = $('#communicationOptions input[type="checkbox"]:checked').length;

    if (checkedCount === 0) {
        alertToast('Por favor, seleccione al menos un medio de comunicación', 'info');
        return false
    } else {
        // Recoge los valores de los checkboxes seleccionados y los une con comas
        let selectedMedia = $('#communicationOptions input[type="checkbox"]:checked').map(function () {
          return this.value;
        }).get().join(', ');
    }*/

    /*DATOS Y VALIDACION DEL REGISTRO*/
    let form = document.getElementById("formEditarPaciente");
    let formData = new FormData(form);

    formData.set('id', array_selected['ID_PACIENTE']);
    formData.set('medios_entrega', obtenerMediosEntrega());
    formData.set('api', 3);

    console.log(obtenerMediosEntrega())

    $i = 0;
    formData.forEach(element => {$i++;});

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
                url: "../../../api/pacientes_api.php",
                type: "POST",
                processData: false,
                contentType: false,
                success: function (data) {
                    $("#btn-actualizar").prop('disabled', false);
                    data = jQuery.parseJSON(data);

                    switch (data['response']['code']) {
                        case 1:
                            Toast.fire({
                                icon: 'success',
                                title: 'Información actualizada :)',
                                timer: 2000
                            });

                            document.getElementById("formEditarPaciente").reset();
                            $("#ModalEditarPaciente").modal('hide');

                            try {
                                tablaRecepcionPacientesIngrersados.ajax.reload()
                            } catch (e) {
                                console.warn(e)
                            }

                            try {
                                tablaRecepcionPacientes.ajax.reload()
                            } catch (e) {
                                console.warn(e)
                            }
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

$("#editar-vacuna").change(function () {
    var seleccion = $("#editar-vacuna").val();
    if (seleccion.toUpperCase() == 'OTRA') {
        $("#editar-vacunaExtra").prop('readonly', false);
    } else {

        $("#editar-vacunaExtra").prop('readonly', true);
        $("#editar-vacunaExtra").prop('value', "NA");
    }
});

$('.input-edit-impreso-check').change(function (){
    if (pacienteMedios.includes("3")) {
        pacienteMedios = pacienteMedios.filter(item => item !== "3");
    } else { pacienteMedios.push("3"); }
});
$('.input-edit-whatsapp-check').change(function (){
    if (pacienteMedios.includes("2")) {
        pacienteMedios = pacienteMedios.filter(item => item !== "2");
    } else { pacienteMedios.push("2"); }
});
$('.input-edit-correo-check').change(function (){
    if (pacienteMedios.includes("1")) {
        pacienteMedios = pacienteMedios.filter(item => item !== "1");
    } else { pacienteMedios.push("1"); }
});