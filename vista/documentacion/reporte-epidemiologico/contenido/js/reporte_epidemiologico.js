// ==============================================================================

// ###################### Variables #############################################

// ==============================================================================

// var selectedPacientes;
// var dataJsonTablaEstudiosPaciente;

// ==============================================================================

// ###################### Tablas ################################################

// ==============================================================================

//Tbla donde se vizualiza los Médicos tratantes ya registrados en la base de datos
TablaTablaReporteEpidemiologico = $("#TablaTablaReporteEpidemiologico").DataTable({
    language: { url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json", },
    lengthChange: false,
    info: false,
    paging: true,
    scrollY: '35vh',
    scrollCollapse: true,
    ajax: {
        dataType: 'json',
        data: function (d) {
            return $.extend(d, dataReporteEpidemiologico);

        },
        method: 'POST',
        url: `${http}${servidor}/${appname}/api/calidad_api.php`,
        beforeSend: function () {
        },
        complete: function () {
            TablaTablaReporteEpidemiologico.columns.adjust().draw()
            // obtenerBTNEstudios()
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alertErrorAJAX(jqXHR, textStatus, errorThrown);
        },
        dataSrc: 'response.data'
    },
    columns: [
        { data: 'numero_de_registro' },
        { data: 'PREFOLIO' },
        {
            data: 'FOLIO', render: function (data) {
                return ifnull(data, 'N/A')
            }
        },
        {
            data: 'FECHA', render: function (data) {
                return formatoFecha2(data, [0, 1, 3, 1])
            }
        },
        { data: 'NOMBRE_COMPLETO' },

        {
            data: 'NACIMIENTO', render: function (data) {
                return formatoFecha2(data, [0, 1, 3, 1])
            }
        },
        {
            data: 'EDAD', render: function (data) {
                return `${data} años`;
            }
        },
        { data: 'GENERO' },
        { data: 'MUNICIPIO' },
        { data: 'DOMICILIO' },
        { data: 'CELULAR' },
        {
            data: 'FECHA_CONFIRMADO', render: function (data) {
                return formatoFecha2(data, [0, 1, 3, 1])
            }
        },
        { data: 'SERVICIO' },
        { data: 'RESULTADO_GLOBAL' },
        {
            data: 'PATOGENOS', render: function (data) {
                return ifnull(data, 'N/A')
            }
        },
        {
            data: 'LABORATORIO', render: function (data) {
                return ifnull(data, 'N/A')
            }
        },
        {
            data: 'FECHA_RESULTADO', render: function (data) {
                return formatoFecha2(data, [0, 1, 3, 1])
            }
        },


    ],
    columnDefs: [
        { target: 0, title: '#', className: 'all', width: '1%' },
        { target: 1, title: 'Prefolio', className: 'all' },
        { target: 2, title: 'Folio', className: 'none' },
        { target: 3, title: 'Fecha recepción', className: 'all' },
        { target: 4, title: 'Nombre', className: 'all' },
        { target: 5, title: 'Fecha de Nacimiento', className: 'none' },
        { target: 6, title: 'Edad', className: 'none' },
        { target: 7, title: 'Sexo', className: 'none' },
        { target: 8, title: 'Municipio', className: 'none' },
        { target: 9, title: 'Domicilio', className: 'none' },
        { target: 10, title: 'Celular', className: 'none' },
        { target: 11, title: 'Fecha confirmado', className: 'all' },
        { target: 12, title: 'Servicio', className: 'all' },
        { target: 13, title: 'Resultado', className: 'all' },
        { target: 14, title: 'Patogenos', className: 'all' },
        { target: 15, title: 'Laboratorio', className: 'all' },
        { target: 16, title: 'Fecha resultado', className: 'all' },

        // {
        //     targets: 10,
        //     title: '#',
        //     className: 'all actions',
        //     width: '1%',
        //     data: null,
        //     defaultContent: `
        //         <button type="button" class="btn-vizu-reporte btn btn-pantone-325" style="font-size: 20px;margin: 0px;padding: 1px 8px 1px 8px;">
        //             <i class="bi bi-clipboard2-pulse-fill btn-vizu-reporte"></i>
        //         </button>`
        // }
    ],
    dom: 'Bfrtip',
    buttons: [
        {
            extend: 'excelHtml5',
            text: '<i class="fa fa-file-excel-o"></i> Excel',
            className: 'btn btn-success',
            titleAttr: 'Excel',
            attr: {
                'data-bs-toggle': "tooltip",
                'data-bs-placement': "top",
                title: "Genere el formato por toda la tabla de pacientes o filtrado (Filtrado por: Fecha, Procedencia...)"
            },
            exportOptions: {
                // Especifica las columnas que deseas exportar
                columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16]
            }

        }
    ]
})

inputBusquedaTable('TablaTablaReporteEpidemiologico', TablaTablaReporteEpidemiologico, [], [], 'col-18')

// selectTable('#tablaPacientesTratantes', tablaPacientesTratantes,
//     {
//         // onlyData: true,
//         ClickClass: [
//             {
//                 class: 'btn-vizu-reporte',
//                 callback: function (data) {
//                     // Cargar modal de estudios del paciente
//                     configurarModal(data)
//                 },
//                 selected: false,
//             },
//         ]
//     }
// )

// ==============================================================================

// ###################### FUNCIONES #############################################

// ==============================================================================

// function para configurar el modal
// function configurarModal(data) {
//     ChangePacienteData(data)
//     const NOMBRE = selectedPacientes['PX'];
//     const TURNO_ID = selectedPacientes['ID_TURNO'];

//     $('#estudios_nombre-paciente').html(NOMBRE)

//     dataJsonTablaEstudiosPaciente = {
//         api: 6,
//         turno_id: TURNO_ID
//     }

//     TablaEstudiosCargadosPaciente.ajax.reload()

//     $("#ModalVisualizarEstudiosPaciente").modal('show');
// }

// // Funcion para setear o limpiar en una variable la informacion del paciente
// function ChangePacienteData(data = false) {

//     if (data) {
//         selectedPacientes = data;
//     } else {
//         selectedPacientes = null;
//     }
// }

// ==============================================================================

// ###################### Otras cosas ###########################################

// ==============================================================================