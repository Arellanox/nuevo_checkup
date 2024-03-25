//Variables
var id_area, id_turno


// Tabla de pacientes subrogados
dataPacuentesSubrogados = { api: 15 }
TablaPacientesSubrogados = $('#TablaPacientesSubrogados').DataTable({
    language: {
        url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
    },
    lengthChange: false,
    info: false,
    paging: false,
    // searching: false,
    scrollY: '40vh',
    scrollCollapse: true,
    ajax: {
        dataType: 'json',
        data: function (d) {
            return $.extend(d, dataPacuentesSubrogados);
        },
        method: 'POST',
        url: '../../../api/proveedores_api.php',
        complete: function () {
            loader("Out")
            $.fn.dataTable
                .tables({
                    visible: true,
                    api: true
                })
                .columns.adjust();
        },
        dataSrc: 'response.data'
    },
    columns: [
        { data: 'COUNT' },
        { data: 'PACIENTE', },
        {
            data: 'FECHA_RECEPCION', render: function (data) {
                return formatoFecha2(data, [2, 1, 4, 1, 2, 2, 0])
            }
        },
        { data: 'PREFOLIO' },
        { data: 'PROCEDENCIA' },
        { data: 'PROVEEDOR' },

    ],
    columnDefs: [
        { target: 0, title: '#', className: 'all', with: '1px' },
        { target: 1, title: 'Nombre', className: 'all' },
        { target: 2, title: 'Fecha Recepcion', className: 'none' },
        { target: 3, title: 'Prefolio', className: 'none' },
        { target: 4, title: 'Procedencia', className: 'none' },
        { target: 5, title: 'Proveedor', className: 'none' },

    ]
})

inputBusquedaTable('TablaPacientesSubrogados', TablaPacientesSubrogados, [], [], 'col-12')

selectTable('#TablaPacientesSubrogados', TablaPacientesSubrogados, {
    unSelect: true, reload: ['col-xl-8'], movil: true, "tab-default": 'Area',
    tabs: [
        {
            title: 'Pacientes',
            element: '#tab-paciente',
            class: 'active',
        },
        {
            title: 'Area',
            element: '#tab-areas',
            class: 'disabled tab-select'
        },
        {
            title: 'Reporte',
            element: '#tab-reporte',
            class: 'disabled tab-select'
        },
    ],
}, async function (select, data, callback) {
    pacienteSub = data
    // Oculta el inputDrag
    $('#panel-reporteInput').fadeOut(100);

    if (select == 1) {

        $('#panel-areas').html('') // Limpia el panel de areas
        inputReset.resetInputDrag() // Limpia el dragAndDrop cada vez que se selecciona un nuevo paciente
        await recuperarAreas(pacienteSub) // Recupera las areas de ese paciente

        //Muestra las columnas
        callback('In')
    } else {
        // Oculta las columnas
        callback('Out')
    }
})

// Funcion que recupera las areas del paciente
function recuperarAreas(data) {
    return new Promise(function (resolve, reject) {
        ajaxAwait(
            { api: 21, turno_id: data['ID_TURNO'] }, 'proveedores_api', { callbackAfter: true }, false, function (data) {
                let dataAreas = data.response.data

                // Cilco para imprimir las areas
                dataAreas.forEach(areas => {

                    //Cambia de color si tiene reporte
                    var estadoDiv = areas.RESULTADO !== null ? 'style="background-color: #198754;"' : '';
                    var estadoP = areas.RESULTADO !== null ? 'style="color: white"' : '';

                    // Crea el html que se mostrara las areas
                    var cardAreas = `
                <div class="rounded card p-3 my-3 card-areas" ${estadoDiv} data-id-area="${areas.ID_AREA}" data-id-turno="${areas.ID_TURNO}" data-id-reporte="${areas.RESULTADO}">
                    <p ${estadoP}>${areas.AREA}</p>
                </div>
                `;

                    // Se imprimen las areas
                    $('#panel-areas').append(cardAreas)
                })

                resolve(1);
            })
    })

}

// Damos click alguna area
$('#panel-areas').on('click', '.card-areas', function (e) {
    e.preventDefault();
    e.stopPropagation();

    $('#panel-reporteInput').fadeOut(200);


    // Obtiene los valores de los atributos de datos del elemento clickeado
    let $div = $(this)
    id_area = $div.data('id-area');
    id_turno = $div.attr('data-id-turno');
    resultado = $div.attr('data-id-reporte');


    $('.card-areas').removeClass('selected');
    $div.addClass('selected');

    setTimeout(() => {
        $('#panel-reporteInput').fadeIn(200);

        // Envia a la ultima
        $('#tab-btn-Reporte').click();
    }, 200);

    // Evaluamos si el area de ese paciente tiene reporte
    if (resultado != 'null') {

        // En dado caso que tenga mostramos el boton
        $('#btn-ReporteArea').fadeIn(0)
        $('#btn-ver-resultados-areas').html(`<a type="button" target="_blank" href="${resultado}" style="margin-bottom:4px"><i class="bi bi-file-earmark-pdf"></i> Reporte</a>`);
    } else {

        // Si no, se oculta
        $('#btn-ReporteArea').fadeOut()
    }


});

    //Funcion para guarda los reportes que el usuario va a subir
let inputReset = InputDragDrop('#dropDocumentoPaciente', (inputArea, salidaInput) => {

    ajaxAwaitFormData({
        api: 20, turno_id: id_turno, area_id: id_area
    }, 'proveedores_api', 'subirDocumentoPaciente', { callbackAfter: true }, false, function (data) {

        // Una vez enviado los datos, se regresa la url para mostrar el boton con el reporte que se cargo
        let resultadoEnviado = data.response.data.url[0]['_ruta_reporte']

        alertToast('Documento guardado', 'success');

        // Mostramos el boton 
        $('#btn-ReporteArea').fadeIn(0)
        $('#btn-ver-resultados-areas').html(`<a type="button" target="_blank" href="${resultadoEnviado}" style="margin-bottom:4px"><i class="bi bi-file-earmark-pdf"></i> Reporte</a>`);

        // Borramos el contenido que tenga en el div de areas
        $('#panel-areas').html('')

        // Y recargamos la vista
        recuperarAreas(pacienteSub)


        // Siempre se ejecuta al final del proceso
        salidaInput({
            msj: { pregunta: 'Carga otro arrastrándolo' },
            dropArea_css: {
                background: 'rgb(200 254 216)', // Indicativo que hay algo cargado
            },
            strong: {
                class: 'none-p',
                borderBottom: '1px solid'
            }
        });

    })
})