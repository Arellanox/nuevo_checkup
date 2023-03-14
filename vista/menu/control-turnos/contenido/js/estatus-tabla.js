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
    scrollY: autoHeightDiv(0, 263),
    scrollCollapse: true,
    // paging: false,
    lengthMenu: [
        [15, 20, 25, 30, 35, 40, 45, 50, -1],
        [15, 20, 25, 30, 35, 40, 45, 50, "All"]
    ],
    ajax: {
        dataType: 'json',
        data: { api: 5 },
        method: 'POST',
        url: '../../../api/turnero_api.php',
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


        // {defaultContent: 'En progreso...'}
    ],
    columnDefs: [
        { width: "5px", targets: 1 },
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

function drawStatusMenuTable(data, iconObject = { 0: 'muestra', 1: 'reporte', 2: 'correo', 3: 'captura' }) {
    //Icons
    html = '';
    // console.log(data)

    if (data) {
        // console.log(data);
        for (const key in iconObject) {
            if (iconObject.hasOwnProperty.call(iconObject, key)) {
                const val = iconObject[key];
                // if (data[val])
                html += analizarIconStatus(data[val], val);
            }
        }
    }
    return html;

};

function analizarIconStatus(data, tipo) {
    icons = {
        muestra: {
            0: 'muestra_sin_tomar',
            1: 'muestra_tomada',
            'N/A': '',
        },
        reporte: {
            0: 'reporte_sin',
            1: 'reportado',
            'N/A': '',
        },
        correo: {
            0: 'correo_sin',
            1: 'correo_enviado',
            'N/A': '',
        },
        capturas: {
            0: 'captura_sin_tomar',
            1: 'captura_tomada',
            'N/A': '',
        }
    }
    return elegirIconStatus(icons[tipo], data)
}

function elegirIconStatus(tipo, key) {
    if (tipo) {
        // console.log(key, tipo[key])
        switch (tipo[key]) {
            case 'muestra_sin_tomar': return '<i class="bi bi-droplet text-secondary" style="zoom:170%;"></i>';
            case 'muestra_tomada': return '<i class="bi bi-droplet-fill" style="zoom:170%; color: rgb(162 0 0)"></i>'; // zoom: 170%; color: rgb(255 255 255); border - radius: 50 %; padding: 0px 2px 0px 2px; background - color: rgb(162, 0, 0); background: linear-gradient(to bottom right, rgb(161 0 0), rgb(162 0 0));
            case 'captura_sin_tomar': return '<i class="bi bi-card-image text-secondary" style="zoom:170%;"></i>';
            case 'captura_tomada': return '<i class="bi bi-image-fill" style="zoom:170%; color: rgb(162 0 0)"></i>';
            case 'reporte_sin': return '<i class="bi bi-clipboard-x text-secondary" style="zoom:170%;"></i>';
            case 'reportado': return '<i class="bi bi-clipboard2-check-fill" style="zoom:170%; color: rgb(247, 190, 0)"></i>';
            case 'correo_sin': return '<i class="bi bi-send-x text-secondary" style="zoom:170%;"></i>';
            case 'correo_enviado': return '<i class="bi bi-send-check-fill" style="zoom:170%; color: rgb(000, 175, 170)"></i>';
            case 'N/A': return '';
        }
        // console.log('vacio')
        return '';
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