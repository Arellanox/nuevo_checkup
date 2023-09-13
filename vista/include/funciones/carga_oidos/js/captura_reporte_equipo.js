// let jsonData = {}
// jsonData['id_turno'] = dataSelect.array['turno'];
// jsonData['id_area'] = areaActiva;
// jsonData['api'] = api_interpretacion;

// // Busca y obtiene todas las capturas de la tabla
// let capturesArray = []
// let audiometria_tablas = "#captures img";
// $(audiometria_tablas).each(function () {
//     capturesArray.push($(this).attr('src'));
// });

// // Convertir el arreglo a una cadena JSON
// jsonData['tabla_reporte'] = JSON.stringify(capturesArray);

//       case "ULTRASONIDO":
// control_turnos = 8;
// formulario = "formSubirInterpretacion";
// api_capturas = 2;
// api_interpretacion = 1;
// url_api = 'ultrasonido_api';
// obtenerContenidoVistaMaster(11, 'Resultados de Ultrasonido', 'contenido_modal.php');
// break;

api_capturaEquipos = 7

const getFormCapturaEquipos = (paciente) => {
    // console.log(paciente)

    let jsonData = {} // <- Json vacio
    jsonData['id_turno'] = paciente.ID_TURNO // <- se llama el turno (revisar si asi se llama)
    jsonData['id_area'] = areaActiva // <- revisar de donde viene
    jsonData['api'] = api_capturaEquipos

    let capturasArraya = []
    let audiometria_tablas = '#reporte_equipo'
    $(audiometria_tablas).each(function () {
        capturasArraya.push($(this).attr('src'))
    })
    jsonData['tabla_reporte'] = JSON.stringify(capturasArraya)

    $('#btn-subir-reporte-equipo').submit(function (e) {
        e.preventDefault()
        alertMensajeConfirm({
            title: '¿Está seguro de subir la interpretación?',
            text: "Podrá visualizarlo una vez guardado...",
            icon: 'warning',
            showCancelButton: true,
        }, function () {
            // ajaxAwaitFormData(
            //     {
            //         id_area: areaActiva,
            //         api: api_interpretacion,
            //         id_turno: dataSelect.array['turno'],
            //         confirmado: 1
            //     }, url_api, formulario, { callbackAfter: true, callbackBefore: true },
            //     () => {
            //         $(`#${formulario}:submit`).prop('disabled', true)
            //         alertMensaje('info', 'Confirmando reporte', 'Espere un momento, estamos generando el reporte...');
            //     }

            ajaxAwaitFormData(jsonData, url_api, '#formCapturaResultados', { callbackAfter: true, callbackBefore: true },
                () => {

                })
        }, 1)

    })
}
