//Variables
var id_area, id_turno


// Tabla de pacientes
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

        $('#panel-areas').html('')
        await recuperarAreas(pacienteSub)

        //Muestra las columnas
        callback('In')
    } else {

        callback('Out')
    }
})


function recuperarAreas(data) {
    return new Promise(function (resolve, reject) {
        ajaxAwait(
            { api: 21, turno_id: data['ID_TURNO'] }, 'proveedores_api', { callbackAfter: true }, false, function (data) {
                let dataAreas = data.response.data

                dataAreas.forEach(areas => {
                    var cardAreas = `
                <div class="rounded card p-3 my-3 card-areas " data-id-area="${areas.ID_AREA}" data-id-turno="${areas.ID_TURNO}">
                    <p>${areas.AREA}</p>
                </div>
                `;

                    $('#panel-areas').append(cardAreas)
                })

                resolve(1);
            })
    })

}

$('#panel-areas').on('click', '.card-areas', function (e) {
    e.preventDefault();
    e.stopPropagation();

    $('#panel-reporteInput').fadeOut(200);


    // Obtiene los valores de los atributos de datos del elemento clickeado
    let $div = $(this)
    id_area = $div.data('id-area');
    id_turno = $div.attr('data-id-turno');

    $('.card-areas').removeClass('selected');
    $div.addClass('selected');

    setTimeout(() => {
        $('#panel-reporteInput').fadeIn(200);

        // Envia a la ultima
        $('#tab-btn-Reporte').click();
    }, 200);

});


InputDragDrop('#dropDocumentoPaciente', (inputArea, salidaInput) => {

    ajaxAwaitFormData({
        api: 20, turno_id: id_turno, area_id: id_area
    }, 'proveedores_api', 'subirDocumentoPaciente', { callbackAfter: true }, false, function () {

        alertToast('Documento guardado', 'success');

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