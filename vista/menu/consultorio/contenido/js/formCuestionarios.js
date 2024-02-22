async function metodoConsultaRapida(data) {
    await obtenerInformacionPaciente(data)
    await obtenerPanelInformacion(data['ID_TURNO'], "signos-vitales_api", 'signos-vitales', '#signos-vitales');
    // await obtenerContenidoConsultaRapida(data)

    loader("Out", 'bottom')
}


//Obtiene la informacion basica del paciente
function obtenerInformacionPaciente(data) {
    return new Promise(resolve => {
        $('#nombre-paciente-consulta').html(data.NOMBRE_COMPLETO);
        $('#nacimiento-paciente-consulta').html(formatoFecha2(data.NACIMIENTO, [3, 1, 2, 2, 0, 0, 0]))
        $("#edad-paciente-consulta").html(formatoEdad(data.EDAD)  + ' años')
        $('#genero-paciente-consulta').html(data.GENERO)
        $('#correo-paciente-consulta').html(data.CORREO)
        $('#curp-paciente-consulta').html(data.CURP)
        resolve(1)
    });
}

$('#btn-formCuestionarioDepresion').on('click',function(e){
    e.preventDefault();

    ajaxAwaitFormData(jsonData, url_api, '#formCuestionarioDepresion', { callbackAfter: true, callbackBefore: true},
    () => {
        $(`#${formulario}:submit`).prop('disabled', true)
        alertMensaje('info', 'Cargando datos de interpretación', 'Espere un momento mientras el sistema registra todos los datos');
    },
    (data) => {
        alertMensaje('success', '¡Interpretación guardada!', 'Consulte o confirme el reporte despues de guardar');
        estadoFormulario(2)
        obtenerServicios(areaActiva, dataSelect.array['turno'])


        switch (areaActiva) {
            case 4:
                SubirCapturasAudiometria();
                break;

            default:
                break;
        }



        $("#formSubirInterpretacion:submit").prop('disabled', false)
    }
)

})




// $(`#${formulario}`).submit(function (event) {
//     event.preventDefault();
//     /*DATOS Y VALIDACION DEL REGISTRO*/

//     if (confirmado != 1 || session.permisos['ActuaReportIm'] == 1) {

//         let jsonData = {}
//         jsonData['id_turno'] = dataSelect.array['turno'];
//         jsonData['id_area'] = areaActiva;
//         jsonData['api'] = api_interpretacion;

//         switch (areaActiva) {
//             case 5:
//                 if (validarCuestionarioEspiro()) {
//                     return false
//                 }
//                 break;

//             case 4:
//                 // Busca y obtiene todas las capturas de la tabla
//                 let capturesArray = []
//                 let audiometria_tablas = "#captures img";
//                 $(audiometria_tablas).each(function () {
//                     capturesArray.push($(this).attr('src'));
//                 });

//                 // Convertir el arreglo a una cadena JSON 
//                 jsonData['tabla_reporte'] = JSON.stringify(capturesArray);


//                 // Agregar mas campos
//                 jsonData['otoscopia'] = $('#textArea-otoscopia').val();
//                 jsonData['audiometria_oido_derecho'] = $('#audiometria_oido_derecho').val();
//                 jsonData['audiometria_oido_izquierdo'] = $('#audiometria_oido_izquierdo').val();

//                 break;
//         }

//         alertMensajeConfirm({
//             title: "¿Está seguro de subir la interpretación?",
//             text: "Podrá visualizarlo una vez guardado...",
//             icon: "warning",
//         }, function () {



            // ajaxAwaitFormData(jsonData, url_api, formulario, { callbackAfter: true, callbackBefore: true, formulariosExtras: ['formSubirInterpretacionAudio-2'] },
            //     () => {
            //         $(`#${formulario}:submit`).prop('disabled', true)
            //         alertMensaje('info', 'Cargando datos de interpretación', 'Espere un momento mientras el sistema registra todos los datos');
            //     },
            //     (data) => {
            //         alertMensaje('success', '¡Interpretación guardada!', 'Consulte o confirme el reporte despues de guardar');
            //         estadoFormulario(2)
            //         obtenerServicios(areaActiva, dataSelect.array['turno'])


            //         switch (areaActiva) {
            //             case 4:
            //                 SubirCapturasAudiometria();
            //                 break;

            //             default:
            //                 break;
            //         }



            //         $("#formSubirInterpretacion:submit").prop('disabled', false)
            //     }
            // )

//         }, 1);

//     } else {
//         alertMensaje('info', 'EL resultado ya ha sido guardado', 'No puede cargar mas resultados a este paciente');
//     }
//     event.preventDefault();
// });