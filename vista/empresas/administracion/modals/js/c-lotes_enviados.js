const modalListaLotesEnviados = document.getElementById("LotesEnviados"); // Declaramos una constante con el id del modal
// recarga el diseño de la tabla antes de que se llegue abirir el modal
modalListaLotesEnviados.addEventListener("show.bs.modal", (event) => {
    setTimeout(() => {
        $.fn.dataTable
            .tables({
                visible: true,
                api: true
            })
            .columns.adjust();
    }, 250);
});


// |------------------------------- Variables -------------------------------------------------------|
let dataListaLotes = { api: 5, id_cliente: session.id_cliente }; //data de lista de lotes
let dataListaPacientesLotes, selectListLote //data de lista de pacientes del lote seleccionado


// |-------------------------------- Tabla de lista de lotes -----------------------------------------|
TablaListaLotes = $('#TablaListaLotes').DataTable({
    language: {
        url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
    },
    lengthChange: false,
    info: true,
    paging: false,
    scrollY: '47vh',
    scrollCollapse: true,
    ajax: {
        dataType: 'json',
        data: function (d) {
            return $.extend(d, dataListaLotes);
        },
        method: 'POST',
        url: `${http}${servidor}/${appname}/api/maquilas_api.php`,
        complete: function () {
            // if (TablaListaLotes_inicio)
            //     $('#EnvioLotesPacientes').modal('show');
        },
        error: function (jqXHR, exception, data) {
            alertErrorAJAX(jqXHR, exception, data)
            // console.log('Error')
        },
        dataSrc: 'response.data'
    },
    columns: [
        { data: 'COUNT' },
        { data: 'FOLIO' },
        {
            data: 'ESTATUS', render: function (data, type, row) {
                switch (row.ID_ESTATUS) {
                    case "1":
                        claslistaLotes = `<span class="badge text-bg-secondary">${data}</span>`; break;
                    case "2":
                        claslistaLotes = `<span class="badge text-bg-success">${data}</span>`; break;
                    case "3":
                        claslistaLotes = `<span class="badge text-bg-warning">${data}</span>`; break;
                    case "4":
                        claslistaLotes = `<span class="badge badge-strongBlue">${data}</span>`; break; //Poner el color naranja
                    case "5":
                        claslistaLotes = `<span class="badge text-bg-danger">${data}</span>`; break;
                    case "6":
                        claslistaLotes = `<span class="badge badge-orange">${data}</span>`; break; //quizas cambiar a uno mas oscuro
                    case "7":
                        claslistaLotes = `<span class="badge text-bg-info">${data}</span>`; break;
                    default:
                        claslistaLotes = `<span class="badge text-bg-danger">Error</span>`;
                        break;
                }

                return claslistaLotes;
            }
        },
        {
            data: 'RUTA_REPORTE', render: (data) => {
                // Inicializar un arreglo vacío para contener nuestros botones
                var buttons = [];

                buttons.push(
                    '<a href="' + data + '" target="_blank" class="btn btn-borrar me-2">' +
                    '<i class="bi bi-file-earmark-pdf-fill"></i>' +
                    '</a>'
                );

                // Unir todos los botones con un espacio y devolver la cadena HTML
                return '<div class="d-flex justify-content-start align-items-center">' + buttons.join(' ') + '</div>';
            }
        },
        {
            data: 'REGISTRADO', render: function (data) {

                const formattedDate = formatoFecha2(data, [0, 1, 5, 2, 2, 2, 0], null); {

                    // Separar la fecha y la hora basado en la coma
                    const parts = formattedDate.split(', ');
                    const datePart = parts[0];
                    const timePart = parts[1];

                    // Retornar la fecha y la hora envueltas en spans con las clases correspondientes
                    return `
                            <span class="d-block">${datePart}</span>
                            <span class="d-block">${timePart}</span>`;
                }
            }
        },
        { data: 'USUARIO' },
    ],
    columnDefs: [
        { "width": "5px", "targets": [0, 3] },
    ],

})

// input que busca en la tabla de listaLotes
inputBusquedaTable('TablaListaLotes', TablaListaLotes, [{
    msj: 'Los lotes disponibles se podran vizualizar en esta lista',
    place: 'top'
}], [], 'col-12')

// Select que selecciona alguno de los lotes que hay disponibles en la lista
selectTable('#TablaListaLotes', TablaListaLotes, { unSelect: true, movil: true, reload: ['col-xl-9'] }, async function (select, data, callback) {
    selectListLote = data; //Recupera los todos los datos del lote seleecionado

    // Intentamos limpiar la tabla
    TablaDetalleLotes.clear().draw()

    //Si se selecciono alguno de los lotes enviados entonces...
    if (select == 1) {

        //Se rellena la varuable para poder abrir la tabla de TablaDetalleLotes
        dataListaPacientesLotes = { api: 7, id_lote: selectListLote.ID_LOTE }
        TablaDetalleLotes.clear().draw()
        TablaDetalleLotes.ajax.reload() // Recargamos la tabla cada vez que se seleecione un lote

        // Esperamos la carga de la tabla lo que podamos
        setTimeout(() => {
            //Muestra las columnas
            callback('In')
        }, 350);
    }
    else {
        callback('Out')
    }
})


// |-------------------------------- Tabla de lista de lotes -----------------------------------------|
TablaDetalleLotes = $('#TablaDetalleLotes').DataTable({
    language: {
        url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
    },
    lengthChange: false,
    info: true,
    paging: false,
    scrollY: '47vh',
    scrollCollapse: true,
    ajax: {
        dataType: 'json',
        data: function (d) {
            return $.extend(d, dataListaPacientesLotes);
        },

        method: 'POST',
        url: `${http}${servidor}/${appname}/api/maquilas_api.php`,
        complete: function () {
            // if (TablaListaLotes_inicio)
            //     $('#EnvioLotesPacientes').modal('show');
        },
        error: function (jqXHR, exception, data) {
            alertErrorAJAX(jqXHR, exception, data)
            // console.log('Error')
        },
        dataSrc: 'response.data'
    },

    createdRow: function (row, data, dataIndex) {
        switch (row.TIPO_SOLICITUD) {
            case "1":
                // Ordinario
                // $(row).addClass('bg-info');
                break;
            case "2":
                // Urgente

                $(row).addClass('bg-warning');
            default:
                return ''; break;
        }

    },

    columns: [
        { data: 'COUNT' },
        { data: 'PACIENTE' },
        {
            data: 'DESCRIPCION_SOLICITUD', render: function (data, type, row, meta) {
                switch (row.TIPO_SOLICITUD) {
                    case "1":
                        // Ordinario
                        return `<span class="badge text-bg-info">${data}</span>`; break;
                    case "2":
                        // Urgente
                        return `<span class="badge text-bg-warning">${data}</span>`; break;

                    default:
                        return ''; break;
                }
            }
        },
        { data: 'FOLIO' },
        { data: 'SIHO_CUENTA' },
        { data: 'AREA_SE_ENCUENTRA' },
        {
            data: 'FECHA_REGISTRO', render: function (data) {

                const formattedDate = formatoFecha2(data, [0, 1, 5, 2, 2, 2, 0], null); {

                    // Separar la fecha y la hora basado en la coma
                    const parts = formattedDate.split(', ');
                    const datePart = parts[0];
                    const timePart = parts[1];

                    // Retornar la fecha y la hora envueltas en spans con las clases correspondientes
                    return `
                        <span class="d-block">${datePart}</span>
                        <span class="d-block">${timePart}</span>`;
                }
            }
        },
        {
            data: 'REPORTES', render: function (data) {
                // Inicializar un arreglo vacío para contener nuestros botones
                var buttons = [];

                // Asegurarse de que 'data' es un array antes de intentar usar 'length'
                if (data) {
                    // Recorrer cada reporte en los datos
                    for (const key in data) {
                        if (Object.hasOwnProperty.call(data, key)) {
                            const element = data[key];
                            buttons.push(
                                '<a href="' + element + '" target="_blank" class="btn btn-borrar me-2">' +
                                '<i class="bi bi-file-earmark-pdf-fill"></i>' +
                                '</a>'
                            );
                        }
                    }
                } else {
                    buttons.push(`<div class="badge text-bg-warning px-3 rounded-pill font-weight-normal 
                            text-dark">Pendiente</div>`)
                    // Manejar el caso en el que 'data' no es un array (por ejemplo, mostrar un mensaje de error o un valor por defecto)
                    // console.error('Data is not an array:', data);
                }

                // Unir todos los botones con un espacio y devolver la cadena HTML
                return '<div class="d-flex justify-content-start align-items-center">' + buttons.join(' ') + '</div>';
            }
        },
        { data: 'REGISTRADO_POR' },
        { data: 'PREFOLIO' },
    ],
    columnDefs: [
        { "width": "10px", "targets": 0 },
    ],

})

// input que busca en la tabla de TablaDetalleLotes
inputBusquedaTable('TablaDetalleLotes', TablaDetalleLotes, [{
    msj: 'Los pacientes que esten dentro del lote seleccionado se podran vizualizar en esta tabla',
    place: 'top'
}], [], 'col-12')


// Funcio para que cada vez que selecciones un reporte se abra
function vistapreviaPacienteLote() {

    var reportePaciente = $(this).data("id");


    area_nombre = 'envio_muestras'
    api = encodeURIComponent(window.btoa(area_nombre));
    // turno = encodeURIComponent(window.btoa(pacienteActivo.array['ID_TURNO']));
    area = encodeURIComponent(window.btoa(-5));

    //lo muestra
    btn.show()
    btn.attr('target', '_blank')
    btn.attr('href', `${http}${servidor}/${appname}/visualizar_reporte/?api=${api}&turno=${turno}&area=${area}`)

}