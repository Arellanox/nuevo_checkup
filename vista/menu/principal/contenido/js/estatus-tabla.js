// $('#TablaEstatusTurnos tfoot th').each(function () {
//     var title = $(this).text();
//     switch (title) {
//         case '#': return;
//         case 'Recepción': return;
//     }
//     $(this).html('<input type="text" placeholder="Search ' + title + '" />');
// });;

tablaMenuPrincipal = $('#TablaEstatusTurnos').DataTable({
    language: {
        url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json",
    },
    scrollY: autoHeightDiv(0, 186),
    scrollCollapse: true,
    // paging: false,
    lengthMenu: [
        [15, 20, 25, 30, 35, 40, 45, 50, -1],
        [15, 20, 25, 30, 35, 40, 45, 50, "All"]
    ],
    ajax: {
        dataType: 'json',
        data: { api: 1 },
        method: 'POST',
        url: '../../../api/menu_principal_api.php',
        beforeSend: function () {
            loader("In", 'bottom'), array_selected = null
        },
        complete: function () {
            loader("Out", 'bottom')
        },
        dataSrc: 'response.data'
    },
    createdRow: function (row, data, dataIndex) {
        if (data.REAGENDADO == 1) {
            $(row).addClass('bg-info');
        }

        // $('td', row).addClass('bg-info');
    },
    columns: [
        { data: 'COUNT' },
        { data: 'NOMBRE_COMPLETO' },
        { data: 'PROCEDENCIA' },
        //Laboratorio
        {
            data: 'LABORATORIO_CLINICO', render: function (data) {
                html = '<i class="bi bi-droplet-fill" style="zoom:170%; color: rgb(000, 078, 089)"></i>' +
                    '<i class="bi bi-clipboard-x text-secondary" style="zoom:170%"></i>' +
                    '<i class="bi bi-send-x text-secondary" style="zoom:170%"></i>';
                return html
                // $(cell).addClass('bg-success');
                return '<i class="bi bi-droplet"></i><i class="bi bi-droplet-fill"></i>' +
                    '<i class="bi bi-clipboard-x"></i><i class="bi bi-clipboard2-check-fill">' +
                    '</i><i class="bi bi-send-x"></i><i class="bi bi-send-check-fill"></i>'
                // return drawRowTable(data, 'principal', {
                //     1: 'Terminado',
                //     2: 'En proceso'
                // });
            }
        },
        //Ultrasonido
        {
            data: 'ULTRASONIDO', render: function (data) {

                //gris, azul, 
                return '<i class="bi bi-card-image"></i><i class="bi bi-images"></i><i class="bi bi-clipboard-x"></i><i class="bi bi-clipboard-check-fill"></i><i class="bi bi-send-x"></i><i class="bi bi-send-check-fill"></i>'
                // return drawRowTable(data, 'principal', {
                //     1: 'Terminado',
                //     2: 'En proceso',
                // });
            }
        },
        //Rayos X
        {
            data: 'RAYOS_X', render: function (data) {

                return '<i class="bi bi-card-image"></i><i class="bi bi-images"></i><i class="bi bi-clipboard-x"></i><i class="bi bi-clipboard-check-fill"></i><i class="bi bi-send-x"></i><i class="bi bi-send-check-fill"></i>'

                // return drawRowTable(data, 'principal', {
                //     1: 'Terminado',
                //     2: 'En proceso',
                // });
            }
        },
        //Oftalmo
        {
            data: 'OFTALMOLOGIA', render: function (data) {
                return '<i class="bi bi-clipboard-x"></i><i class="bi bi-clipboard-check-fill"></i><i class="bi bi-send-x"></i><i class="bi bi-send-check-fill"></i>'

                // return drawRowTable(data, 'principal', {
                //     1: 'Terminado',
                //     2: 'En proceso',
                // });
            }
        },
        //HistoriaClinica
        {
            data: 'CONSULTORIO', render: function (data) {
                return '<i class="bi bi-heart-pulse"></i><i class="bi bi-heart-pulse-fill"></i><i class="bi bi-clipboard2"></i><i class="bi bi-clipboard2-pulse-fill"></i>'

                // return drawRowTable(data, 'principal', {
                //     1: 'Terminado',
                //     2: 'En proceso',
                // });
            }
        },
        //Electrocardiograma
        {
            data: 'ELECTROCARDIOGRAMA', render: function (data) {
                return '<i class="bi bi-card-image"></i><i class="bi bi-images"></i><i class="bi bi-clipboard-x"></i><i class="bi bi-clipboard-check-fill"></i><i class="bi bi-send-x"></i><i class="bi bi-send-check-fill"></i>'

                // return drawRowTable(data, 'principal', {
                //     1: 'Terminado',
                //     2: 'En proceso',
                // });
            }
        },
        //Espirometría
        {
            data: 'ESPIROMETRIA', render: function (data) {
                return '<i class="bi bi-clipboard-x"></i><i class="bi bi-clipboard-check-fill"></i><i class="bi bi-send-x"></i><i class="bi bi-send-check-fill"></i>'

                // return drawRowTable(data, 'principal', {
                //     1: 'Terminado',
                //     2: 'En proceso',
                // });
            }
        },
        //Audiometria
        {
            data: 'AUDIOMETRIA', render: function (data) {
                return '<i class="bi bi-clipboard-x"></i><i class="bi bi-clipboard-check-fill"></i><i class="bi bi-send-x"></i><i class="bi bi-send-check-fill"></i>'

                // return drawRowTable(data, 'principal', {
                //     1: 'Terminado',
                //     2: 'En proceso',
                // });
            }
        },
        //Menu
        {
            data: 'FECHA_RECEPCION',
            render: function (data) {
                return formatoFecha2(data, [0, 1, 5, 2, 0, 0, 0], null);
            }
        },
        {
            data: 'FECHA_AGENDA',
            render: function (data) {
                return formatoFecha2(data, [0, 1, 5, 2, 0, 0, 0], null);
            }
        },
        {
            data: 'FECHA_REAGENDA',
            render: function (data) {
                return formatoFecha2(data, [0, 1, 5, 2, 0, 0, 0], null);
            }
        },


        { data: 'DESCRIPCION_SEGMENTO' },
        { data: 'TURNO' },
        {
            data: 'ACTIVO',
            render: function (data) {
                return 'PENDIENTE';
            }
        },
        { data: 'PREFOLIO' },
        { data: 'GENERO' }
        // {defaultContent: 'En progreso...'}
    ],
    columnDefs: [

        { width: "180px", targets: 1 },
        { width: "5px", targets: 0 },

        { targets: [7, 9, 10], visible: false }
        // { visible: false, title: "AreaActual", targets: 20, searchable: false }

    ],

})

// tablaMenuPrincipal.columns().every(function () {
//     var that = this;

//     $('input', this.footer()).on('keyup change', function () {
//         if (that.search() !== this.value) {
//             that
//                 .search(this.value)
//                 .draw();
//         }
//     });
// });



//Activa o desactiva una columna
$('a.toggle-vis').on('click', function (e) {
    e.preventDefault();
    // Get the column API object
    var column = tablaMenuPrincipal.column($(this).attr('data-column'));

    // Toggle the visibility
    column.visible(!column.visible());
    tablaMenuPrincipal.ajax.reload();
    $.fn.dataTable
        .tables({
            visible: true,
            api: true
        })
        .columns.adjust();

    $(this).removeClass('span-info');
    if (column.visible())
        $(this).addClass('span-info');
});
$('a.toggle-vis').each(function () {
    var column = tablaMenuPrincipal.column($(this).attr('data-column'));
    if (column.visible())
        $(this).addClass('span-info');
})


setTimeout(() => {
    $('#TablaEstatusTurnos_filter').html(
        '<div class="text-center mt-2">' +
        '<div class="input-group flex-nowrap">' +
        '<span class="input-group-text" id="addon-wrapping" data-bs-toggle="tooltip" data-bs-placement="left"' +
        'title="Filtra la tabla con palabras u oraciones que coincidan">' +
        '<i class="bi bi-info-circle"></i>' +
        '</span>' +
        '<span class="input-group-text" id="addon-wrapping" data-bs-toggle="tooltip" data-bs-placement="left"' +
        'title="Los iconos representan el estado del paciente a las areas">' +
        '<i class="bi bi-info-circle"></i>' +
        '</span>' +
        '<input type="search" class="form-control input-color" aria-controls="TablaEstatusTurnos" style="display: unset !important; margin-left: 0px !important"' +
        'name="inputBuscarTableListaNuevos" placeholder="Filtrar coincidencias" id="BuscarTablaLista"' +
        'data-bs-toggle="tooltip" data-bs-placement="top" title="Filtra la lista por coincidencias">' +

        '</div>' +
        '</div>'
    )

    //Zoom table
    $('#TablaEstatusTurnos_wrapper').children('div [class="row"]').eq(1).css('zoom', '90%')

    //Diseño de registros
    $('#TablaEstatusTurnos_wrapper').children('div [class="row"]').eq(0).addClass('d-flex align-items-end')
}, 200);





function drawRowTable(data, tipo, msj = {}) {
    switch (data) {
        case 1: case '1':
            html = '<p class="text-success fw-bold style="letter-spacing: normal !important; text-shadow: 0 0 1px #000000;">' + msj[1] + '</p>'
            return html;
        case 0: case '0':
            html = '<p class="text-info fw-bold style="letter-spacing: normal !important; text-shadow: 0 0 1px #000000;">' + msj[2] + '</p>'
            return html
        case 'N/A':
            return '';
        default:
            return '?';
    }
}

// AUDIOMETRIA: "N/A"
// : "N/A"
// CORREO: "hola@bimo.com.mx"
// CURP: "BAMS630125MTCRLR00"
// ESPIROMETRIA: "N/A"
// ETIQUETA_TURNO: "PAR2"
// EXPEDIENTE: "000085"
// FECHA_RECEPCION: "2023-02-16 09:14:54"
// ID_TURNO: "275"
// IMG_RX: "1"
// IMG_ULTRA: "1"
// LABORATORIO_CLINICO: "0"
// MUESTRA: "1"
// NOMBRE_COMPLETO: "BARRERA MOLLINEDO SARA DEL CARMEN"
// : "N/A"
// PROCEDENCIA: "Particular"
// RAYOS_X: "N/A"
// SEGMENTO: null
// SEXO: "FEMENINO"
// SOMATOMETRIA: "N/A"
// ULTRASONIDO: "N/A"