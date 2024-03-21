// Formulario para nuevos contactos
$(document).on('click', '#btn-documentosProveedores', function (e) {
    e.preventDefault();
    e.stopPropagation();

    tablaVistaPacientes.ajax.reload();

    alertToast('Cargando pacientes', 'info');

    setTimeout(() => {
        $('#modalVistaPacientes').modal('show');
        $.fn.dataTable
            .tables({
                visible: true,
                api: true
            })
            .columns.adjust();
    }, 300);
})



// Tabla de contactos por proveedor
dataVistaPacientes = { api: 15, }
// proveedor_id: proveedor_id
tablaVistaPacientes = $('#tablaVistaPacientes').DataTable({
    language: {
        url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
    },
    lengthChange: false,
    info: false,
    paging: false,
    scrollY: '50vh',
    scrollCollapse: true,
    ajax: {
        dataType: 'json',
        data: function (d) {
            return $.extend(d, dataVistaPacientes);
        },
        method: 'POST',
        url: '../../../api/proveedores_api.php',
        dataSrc: 'response.data'
    },
    columns: [
        { data: 'COUNT', },
        { data: 'PACIENTE', },
        { data: 'PROCEDENCIA', },
        { data: 'PREFOLIO', },
        {
            data: 'FECHA_RECEPCION',
            render: function (data) {

                if (!data)
                    return '';

                const formattedDate = formatoFecha2(data, [0, 1, 5, 2, 2, 2, 0], null);

                // Separar la fecha y la hora basado en la coma
                const parts = formattedDate.split(', ');
                const datePart = parts[0];
                const timePart = parts[1];

                // Retornar la fecha y la hora envueltas en spans con las clases correspondientes
                return `
                    <span class="d-block">${datePart}</span>
                    <span class="d-block">${timePart}</span>
                `;
            }
        },
    ],
    columnDefs: [
        { target: 0, title: '#', className: 'all', width: '5px' },
        { target: 1, title: 'Paciente', className: 'all' },
        { target: 2, title: 'Procedencia', className: 'min-tablet' },
        { target: 3, title: 'Prefolio', className: 'min-tablet' },
        { target: 4, title: 'Recepción', className: 'min-tablet' },

    ],
    dom: 'Bfrtip',
    buttons: [
        {
            extend: 'excelHtml5',
            text: '<i class="fa fa-file-excel-o"></i> Excel',
            className: 'btn btn-success',
            titleAttr: 'Excel',
        }
    ]


})

inputBusquedaTable('tablaVistaPacientes', tablaVistaPacientes, [
    {
        msj: 'Visualiza todo los contactos disponibles del proveedor',
        place: 'top'
    },
    {
        msj: '',
        place: 'top'
    }
], [], 'col-12')