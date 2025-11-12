// |------------------------------- Variables -------------------------------------------------------|
let dataListaLotes = { api: 5, id_cliente: session.id_cliente }; //data de lista de lotes
let dataListaPacientesLotes, dataPacientesLotes = { api: 7 };


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
        dataSrc: 'response.data'
    },
    columns: [
        { data: 'COUNT' },
        { data: 'PROCEDENCIA' },
        { data: 'FOLIO' },
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
        {
            data: 'ESTATUS', render: function (data, type, row) {

                switch (row.ID_ESTATUS) {
                    case "2":
                        clas_listoLotes = `<span class="badge text-bg-success">${data}</span>`; break;
                    case "3":
                        clas_listoLotes = `<span class="badge text-bg-warning">${data}</span>`; break;
                    case "4":
                        clas_listoLotes = `<span class="badge badge-strongBlue">${data}</span>`; break; //Poner el color naranja
                    case "5":
                        clas_listoLotes = `<span class="badge text-bg-danger">${data}</span>`; break;
                    case "6":
                        clas_listoLotes = `<span class="badge badge-orange">${data}</span>`; break; //quizas cambiar a uno mas oscuro
                    case "7":
                        clas_listoLotes = `<span class="badge text-bg-info">${data}</span>`; break;
                    default:
                        clas_listoLotes = `<span class="badge text-bg-danger">Error</span>`;
                        break;
                }

                return clas_listoLotes;

            }
        },
        { data: 'USUARIO' },

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
        }
    ],
    columnDefs: [
        { "width": "10px", "targets": [0, 3] },
    ],

})

inputBusquedaTable('TablaListaLotes', TablaListaLotes, [{
    msj: 'Los lotes disponisbles se vizualizaran en esta lista ',
    place: 'top'
}], [], 'col-12')


selectTable('#TablaListaLotes', TablaListaLotes, { unSelect: true, movil: true, reload: ['col-xl-9'] }, async function (select, data, callback) {

    if (select == 1) {

        dataPacientesLotes = { api: 7, id_lote: data.ID_LOTE }
        TablaPacientesLotes.clear().draw()
        TablaPacientesLotes.ajax.reload() // Recargamos la tabla cada vez que se seleecione un lote

        //Muestra las columnas
        callback('In')
    } else {

        callback('Out')
        // selectListaMuestras = null;
    }
})



// |---------------------------- Tabla de lista de pacientes de los lotes-----------------------------|
TablaPacientesLotes = $('#TablaPacientesLotes').DataTable({
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
            return $.extend(d, dataPacientesLotes);
        },
        method: 'POST',
        url: `${http}${servidor}/${appname}/api/maquilas_api.php`,
        complete: function () {
            // if (TablaListaLotes_inicio)
            //     $('#EnvioLotesPacientes').modal('show');
        },
        dataSrc: 'response.data'
    },
    columns: [

        { data: 'COUNT' },
        { data: 'PACIENTE' },
        {
            data: 'FECHA_TOMA_MUESTRA', render: function (data) {
                return formatoFecha2(data, [0, 1, 5, 1])
            }
        },
        { data: 'SEXO' },
        {
            data: 'FECHA_REGISTRO', render: function (data) {
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
        { data: 'REGISTRADO_POR' },
        { data: 'EDAD' },
        {
            data: 'ESTATUS', render: function (data, type, row) {

                switch (row.ID_ESTATUS) {
                    case "1":
                        clas_pacientesLotes = `<span class="badge text-bg-secondary">${data}</span>`; break;
                    case "2":
                        clas_pacientesLotes = `<span class="badge text-bg-success">${data}</span>`; break;
                    case "3":
                        clas_pacientesLotes = `<span class="badge text-bg-warning">${data}</span>`; break;
                    case "4":
                        clas_pacientesLotes = `<span class="badge badge-strongBlue">${data}</span>`; break; //Poner el color naranja
                    case "5":
                        clas_pacientesLotes = `<span class="badge text-bg-danger">${data}</span>`; break;
                    case "6":
                        clas_pacientesLotes = `<span class="badge badge-orange">${data}</span>`; break; //quizas cambiar a uno mas oscuro
                    case "7":
                        clas_pacientesLotes = `<span class="badge text-bg-info">${data}</span>`; break;
                    default:
                        clas_pacientesLotes = `<span class="badge text-bg-danger">Error</span>`;
                        break;
                }

                return clas_pacientesLotes;
            }
        },

        {
            data: 'REPORTES', render: function (data, type, row) {
                console.log(data, type, row)
                var buttons = [];

                // Verificar si 'data' no es null o undefined y no termina en 'null'
                if (data && data.split('/').pop() !== 'null') {
                    buttons.push(
                        '<a href="' + data + '" target="_blank" class="btn btn-borrar me-2">' +
                        '<i class="bi bi-file-earmark-pdf-fill"></i>' +
                        '</a>'
                    );
                } else {
                    // En dado caso que no tenga nada se mostrara este boton
                    buttons.push(
                        '<span class="badge text-bg-warning">En proceso</span>'

                    );
                }

                return '<div class="d-flex justify-content-start align-items-center">' + buttons.join(' ') + '</div>';
            }
        },
        {
            data: null, render: function (data) {

                let html = `
                    <button type="button" class="btn btn-info btn_tomar_muestras">
                        <i class="bi bi-droplet-half btn_tomar_muestras"></i>
                    </button>
                `;

                return html;
            }
        }


    ],
    columnDefs: [
        { "width": "10px", "targets": [0, 3, 7, 8, 9] },
    ],

})


selectTable('#TablaPacientesLotes', TablaPacientesLotes, {
    OnlyData: true,
    ClickClass: [
        {
            class: 'btn_tomar_muestras',
            callback: function (data) {
                // Data siendo los datos del row
                console.log(data);
                // Carga nuevos datos
                dataJsonMuestras['id_turno'] = data.ID_TURNO;

                // Carga información del paciente

                // recarga y recupera nuevos datos
                pacienteEstudios.clear().draw();
                pacienteEstudios.ajax.reload();

                alertToast('Cargando estudios del paciente', 'info', 4000)

                // Abrir modal una vez cargado los datos (o llamado)
                $('#modalRecepcionMuestras').modal('show')

            },
            selected: true
        },
    ]
})


inputBusquedaTable('TablaPacientesLotes', TablaPacientesLotes, [{
    msj: 'Filtra los pacientes con información clave.',
    place: 'top'
}], [], 'col-12')



// Ingresa información del paciente
function infoPacienteModal(data) {
    $('#nombre-paciente').html(ifnull(data, '', ['1']));
    $('#fecha_de_nacimiento-paciente').html(ifnull(data, '', ['1']));
    $('#edad-paciente').html(ifnull(data, '', ['1']));
    $('#curp-paciente').html(ifnull(data, '', ['1']));
    $('#numero_cuenta-paciente').html(ifnull(data, '', ['1']));




}