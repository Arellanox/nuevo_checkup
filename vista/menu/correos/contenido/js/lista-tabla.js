tablaListaPaciente = $('#TablaLaboratorio').DataTable({
    language: {
        url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
    },
    lengthChange: false,
    info: false,
    paging: false,
    scrollY: autoHeightDiv(0, 244),
    scrollCollapse: true,
    ajax: {
        dataType: 'json',
        data: function (d) {
            return $.extend(d, dataListaPaciente);
        },
        method: 'POST',
        url: '../../../api/turnos_api.php',
        beforeSend: function () {
            loader("In")
        },
        complete: function () {
            loader("Out", 'bottom')
            //Para ocultar segunda columna
            reloadSelectTable()

             // invalidar reporte
            if(session.permisos['invalidarRep'] == 1){
                $("#btn-rechazar-resultado").css("display","");
            }

            // validar reporte
            if (session.permisos['validarRep'] == 1){
                $("#btn-confirmarenviar-resultado").css("display","");
            }

            // Reemplazar pdf del reporte
            if(session.permisos['ReemplazarRep'] == 1){
                $("#file-upload-rep-lab").css("display", "");
            }
        },
        dataSrc: 'response.data'
    },
    createdRow: function (row, data, dataIndex) {
        if (data.DOBLE_CHECK == 1) {
            $(row).addClass('bg-success text-white');
        } else {
            $(row).addClass('bg-warning');
        }
    },
    columns: [
        { data: 'COUNT' },
        { data: 'NOMBRE_COMPLETO' },
        { data: 'PREFOLIO' },
        { data: 'CLIENTE' },
        { data: 'SEGMENTO' },
        { data: 'turno' },
        { data: 'GENERO' },
        { data: 'EXPEDIENTE' },
        // {defaultContent: 'En progreso...'}
    ],
    columnDefs: [
        { "width": "10px", "targets": 0 },
    ],

})
loaderDiv("Out", null, "#loader-Lab", '#loaderDivLab');


// let adobeDCView = new AdobeDC.View({


// });



// Función que se ejecuta cuando se realiza una acción para obtener un nuevo PDF
function getNewView(url, filename) {
    // Destruir la instancia existente de AdobeDC.View
    // Crear una instancia inicial de AdobeDC.View
    let adobeDCView = new AdobeDC.View({ clientId: "cd0a5ec82af74d85b589bbb7f1175ce3", divId: "adobe-dc-view" });

    var nuevaURL = url;

    // Agregar un parámetro único a la URL para evitar la caché del navegador
    nuevaURL += "?timestamp=" + Date.now();

    // Cargar y mostrar el nuevo PDF en el visor
    adobeDCView.previewFile({
        content: { location: { url: nuevaURL } },
        metaData: { fileName: filename }
    });
}




selectTable('#TablaLaboratorio', tablaListaPaciente, {
    unSelect: true, movil: true, reload: ['col-xl-9'], tabs: [
        {
            title: 'Pacientes',
            element: '#tab-paciente',
            class: 'active',
        },
        {
            title: 'Reporte',
            element: '#tab-reporte',
            class: 'disabled tab-select'
        },
    ],
}, async function (selectTR, array, callback) {
    // selectDatatable('TablaLaboratorio', tablaListaPaciente, 0, 0, 0, 0, function (selectTR = null, array = null) {
    datalist = array;
    dataSelect = new GuardarArreglo({
        select: true,
        nombre_paciente: datalist['NOMBRE_COMPLETO'],
        turno: datalist['ID_TURNO'],
        ruta: null
    })
    // console.log(dataSelect)
    if (selectTR == 1) {
        estadoBotones(0) //Habilitar botones
        $('#height-card-pdf').css('height', autoHeightDiv(0, 100))
        try {


            ajaxAwait({ id_turno: datalist['ID_TURNO'], api: 14, area_id: areaActiva }, 'turnos_api', {
                callbackAfter: true, response: false
            }, false, (data) => {
                if (data.response.code != 1) {
                    alertMensaje('error', 'Error en recuperar registro', 'Hubo un problema en recuperar este resultado del paciente', 'Intente de nuevo o reporte el problema al soporte de TI')
                } else {
                    selectEstudio = new GuardarArreglo(data.response.data);
                    let row = [data.response.data];

                    if (row['DOBLE_CHECK'])
                        selectEstudio.setguardado(1)



                    // if (datalist.DOBLE_CHECK == 1 || selectEstudio.getguardado() == 1)
                    //     estadoBotones(1) //Desactivar si ya fue enviado

                    getNewView(selectEstudio.array.RUTA, selectEstudio.array.NOMBRE_ARCHIVO);
                }

            })

            // document.addEventListener("adobe_dc_view_sdk.ready", function () {

            //     
            // });


            // adobeDCView.loadFile({
            //     content: {
            //         location: {
            //             url: selectEstudio.array.RUTA
            //         }
            //     },
            //     metaData: {
            //         fileName: selectEstudio.array.NOMBRE_ARCHIVO
            //     }
            // });


            // try {
            //     // vistaPDF('#pdfviewer', selectEstudio.array.RUTA, selectEstudio.array.NOMBRE_ARCHIVO)
            // } catch (error) {

            // }

        } catch (error) {
            console.log(error)
        }

        callback('In')
    } else {
        callback('Out')

    }
})


$("#BuscarTablaListaLaboratorio").keyup(function () {
    tablaListaPaciente.search($(this).val()).draw();
});


// function getResultadoPaciente(turno) {
//     return new Promise(resolve => {
//         $.ajax({
//             url: `${http}${servidor}/${appname}/api/turnos_api.php`,
//             dataType: 'json',
//             data: { id_turno: turno, api: 14, area_id: areaActiva },
//             method: "POST",
//             success: function (data) {
//                 selectEstudio = new GuardarArreglo(data.response.data);
//                 // console.log(selectEstudio)
//                 let row = [data.response.data];

//                 if (row['DOBLE_CHECK'])
//                     selectEstudio.setguardado(1)
//             },
//             complete: function () {
//                 resolve(1);
//             }
//         })
//     });
// }

function estadoBotones(estado) {
    switch (estado) {
        case 1:
            // $('#btn-rechazar-resultado').prop('disabled', true);
            // $('#btn-confirmarenviar-resultado').prop('disabled', true);
            break;
        case 0:
            $('#btn-rechazar-resultado').prop('disabled', false);
            $('#btn-confirmarenviar-resultado').prop('disabled', false);
        default:
            break;
    }
}