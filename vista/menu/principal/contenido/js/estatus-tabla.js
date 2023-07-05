// $('#TablaEstatusTurnos tfoot th').each(function () {
//     var title = $(this).text();
//     switch (title) {
//         case '#': return;
//         case 'Recepción': return;
//     }
//     $(this).html('<input type="text" placeholder="Search ' + title + '" />');
// });;






function drawRowTable(data, tipo, msj = { 0: '', 1: '', 2: '' }) {
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

const columnas = [
    { data: 'COUNT' },
    { data: 'NOMBRE_COMPLETO' },
    { data: 'PROCEDENCIA' },
    { data: 'PREFOLIO' },
    // Laboratorio
    {
        data: 'LABORATORIO_CLINICO',
        area: 6,
        iconObject: { 0: 'muestra', 1: 'reporte', 2: 'correo' }
    },
    // Biomolecular
    {
        data: 'BIOMOLECULAR',
        area: 12,
        iconObject: { 0: 'muestra', 1: 'reporte', 2: 'correo' }
    },
    // Ultrasonido
    {
        data: 'ULTRASONIDO',
        area: 11,
        iconObject: { 0: 'capturas', 1: 'reporte', 2: 'correo' }
    },
    // Rayos X
    {
        data: 'RAYOS_X',
        area: 8,
        iconObject: { 0: 'capturas', 1: 'reporte', 2: 'correo' }
    },
    // Oftalmo
    {
        data: 'OFTALMOLOGIA',
        area: 3,
        iconObject: { 0: 'reporte', 2: 'correo' }
    },
    // Historia Clínica
    {
        data: 'CONSULTORIO',
        area: 1,
        iconObject: { 0: 'reporte', 2: 'correo' }
    },
    // Electrocardiograma
    {
        data: 'ELECTROCARDIOGRAMA',
        area: 10,
        iconObject: { 0: 'capturas', 1: 'reporte', 2: 'correo' }
    },
    // Nutricion InBody
    {
        data: 'INBODY',
        area: 14,
        iconObject: { 0: 'capturas', 1: 'correo' }
    },
    // Espirometría
    {
        data: 'ESPIROMETRIA',
        area: 5,
        iconObject: { 0: 'capturas', 1: 'reporte', 2: 'correo' }
    },
    // Audiometria
    {
        data: 'AUDIOMETRIA',
        area: 4,
        iconObject: { 0: 'capturas', 1: 'reporte', 2: 'correo' }
    },
    // Menu
    {
        data: 'FECHA_RECEPCION',
        render: function (data) {
            return formatoFecha2(data, [0, 1, 5, 2, 0, 0, 0], null);
        }
    },
    { data: 'TURNO' },
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
    {
        data: 'ACTIVO',
        render: function (data) {
            return 'PENDIENTE';
        }
    },
    { data: 'GENERO' }
];

function drawStatusMenuTable(data, iconObject) {
    let html = '';
    if (iconObject.hasOwnProperty(data)) {
        const icon = iconObject[data];
        html = `
      <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          ${icon}
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
          <a class="dropdown-item" href="#">muestra</a>
          <a class="dropdown-item" href="#">reporte</a>
          <a class="dropdown-item" href="#">correo</a>
        </div>
      </div>
    `;
    }
    return html;
}

function analizarIconStatus(data, row, type, column) {
    if (type === 'display' && column.hasOwnProperty('area')) {
        const area = column.area;
        const iconObject = column.iconObject;
        return drawStatusMenuTable(data, iconObject);
    }
    return data;
}

// Dentro del código principal donde configuras DataTables, puedes utilizar la función analizarIconStatus:

const tabla = $('#miTabla').DataTable({

});


tablaMenuPrincipal = $('#TablaEstatusTurnos').DataTable({
    language: {
        url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json",
    },
    scrollY: function () {
        return autoHeightDiv(0, 263)
        $(window).resize(function () {
            return autoHeightDiv(0, 263)
        })
    },
    scrollCollapse: true,
    // paging: false,
    deferRender: true,
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
    columnDefs: [
        { width: "1%", targets: "col-number" },
        { width: "20%", targets: "col-20%" },
        { width: "5%", targets: "col-5%" },
        { width: "7%", targets: "col-icons" },
        { targets: "col-invisble-first", visible: false },
        {
            targets: [4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14],
            render: analizarIconStatus
        }
        // { visible: false, title: "AreaActual", targets: 20, searchable: false }
    ],
    columns: columnas,


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

// $.fn.dataTable.tables({ visible: true, api: true }).columns.adjust();


//Activa o desactiva una columna
$('a.toggle-vis').on('click', function (e) {
    e.preventDefault();
    // Get the column API object
    var column = tablaMenuPrincipal.column($(this).attr('data-column'));

    // Toggle the visibility
    column.visible(!column.visible());
    // tablaMenuPrincipal.ajax.reload();
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

selectDatatabledblclick(async function (select, data) {
    let dataInfo = data;
    if (select) {
        await obtenerPanelInformacion(1, 'toma_de_muestra_api', 'estudios_muestras', '#panel-muestras-estudios')
        var myOffcanvas = document.getElementById('offcanvasInfoPrincipal')
        var bsOffcanvas = new bootstrap.Offcanvas(myOffcanvas)
        bsOffcanvas.show()

    }
}, '#TablaEstatusTurnos', tablaMenuPrincipal)





setTimeout(() => {
    $('#TablaEstatusTurnos_filter').html(
        '<div class="text-center mt-2" style="padding-right: 5%">' +
        '<div class="input-group flex-nowrap">' +
        '<span class="input-span" id="addon-wrapping" data-bs-toggle="tooltip" data-bs-placement="left"' +
        'title="Filtra la tabla con palabras u oraciones que coincidan" style="margin-bottom: 0px !important">' +
        '<i class="bi bi-info-circle"></i>' +
        '</span>' +
        '<span class="input-span" id="addon-wrapping" data-bs-toggle="tooltip" data-bs-placement="left"' +
        'title="Los iconos representan el estado del paciente a las areas" style="margin-bottom: 0px !important">' +
        '<i class="bi bi-info-circle"></i>' +
        '</span>' +
        '<input type="search" class="input-form form-control" aria-controls="TablaEstatusTurnos" style="display: unset !important; margin-left: 0px !important; margin-bottom: 0px !important"' +
        'name="inputBuscarTableListaNuevos" placeholder="Filtrar coincidencias" id="BuscarTablaListaTurnos"' +
        'data-bs-toggle="tooltip" data-bs-placement="top" title="Filtra la lista por coincidencias">' +

        '</div>' +
        '</div>'
    )

    //Zoom table
    $('#TablaEstatusTurnos_wrapper').children('div [class="row"]').eq(1).css('zoom', '90%')

    //Diseño de registros
    $('#TablaEstatusTurnos_wrapper').children('div [class="row"]').eq(0).addClass('d-flex align-items-end')


    $("#BuscarTablaListaTurnos").keyup(function () {
        tablaMenuPrincipal.search($(this).val()).draw();
    });

}, 200);

inputBusquedaTable('TablaEstatusTurnos', tablaMenuPrincipal, [
    {
        msj: 'Filtra la tabla con palabras u oraciones que coincidan',
        place: 'left'
    },
    {
        msj: 'Los iconos representan el estado del paciente a las areas',
        place: 'left'
    },
])



