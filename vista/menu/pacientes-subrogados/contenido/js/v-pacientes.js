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
    multipleSelect: false, noColumns: false, unSelect: true, reload: ['col-xl-9']
    // ClickClass: [
    //     {
    //         class: 'eliminar-documento',
    //         callback: (data) => {
    //             desactivarDocumentoProveedor(data)
    //         },
    //         selected: true
    //     }
    // ]
}, function (select, data, callback) {
    pacienteSub = data

    if (select == 1) {
        //Muestra las columnas
        callback('In')

        $('#panel-areas').html('')

        recuperarAreas(pacienteSub)
    } else {

        callback('Out')
    }
})


function recuperarAreas(data) {
    ajaxAwait(
        { api: 21, turno_id: data['ID_TURNO'] }, 'proveedores_api', { callbackAfter: true }, false, function (data) {
            let dataAreas = data.response.data

            dataAreas.forEach(areas => {
                var cardAreas = `
                <div class="rounded card p-3 my-3" data-id-area="${areas.ID_AREA}" data-id-turno="${areas.ID_TURNO}">
                    <p>${areas.AREA}</p>
                </div>
                `;

                $('#panel-areas').append(cardAreas)
            })
        })
}

$(document).ready(function () {
    $('#panel-areas').on('click', '.card', function () {
        // Obtiene los valores de los atributos de datos del elemento clickeado
        id_area = $(this).data('id-area');
        id_turno = $(this).attr('data-id-turno');



    });
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