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
    scrollY: '40vh',
    scrollCollapse: true,
    ajax: {
        dataType: 'json',
        data: function (d) {
            return $.extend(d, dataReporteEpidemiologico);

        },
        method: 'POST',
        url: `${http}${servidor}/${appname}/api/medicos_tratantes_api.php`,
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
        // { data: 'COUNT' },
        // { data: 'PX' },
        // { data: 'NOMBRE_MEDICO' },
        // { data: 'CLIENTE' },
        // {
        //     data: 'FECHA_RECEPCION', render: function (data) {
        //         return formatoFecha2(data, [0, 1, 3, 1])
        //     }
        // },
        // {
        //     data: 'FECHA_AGENDA', render: function (data) {
        //         return formatoFecha2(data, [0, 1, 3, 1])
        //     }
        // },
        // { data: 'PREFOLIO' },
        // { data: 'ID_TURNO' },
        // {
        //     data: 'EDAD', render: function (data) {
        //         return formatoEdad(data)
        //     }
        // },
        // { data: 'GENERO' },
        // { data: null },
    ],
    columnDefs: [
        { target: 0, title: '#', className: 'all', width: '1%' },
        { target: 1, title: 'Nombre', className: 'all' },
        { target: 2, title: 'Num. Registro', className: 'all' },
        { target: 3, title: 'Fecha de recepcion', className: 'all' },
        { target: 4, title: 'Prefolio', className: 'all' },
        { target: 5, title: 'Fecha confirmado', className: 'all' },
        { target: 6, title: 'Resultado', className: 'all' },
        { target: 7, title: 'Fecha resultado', className: 'all' },
        { target: 8, title: 'Servicio', className: 'all' },
        { target: 9, title: 'Laboratorio', className: 'all' },

        { target: 10, title: 'Edad', className: 'none' },
        { target: 11, title: 'Sexo', className: 'none' },
        { target: 12, title: 'Domicilio', className: 'none' },
        { target: 13, title: 'Celular', className: 'none' },
        { target: 14, title: 'Folio', className: 'none' },
        { target: 15, title: 'Fecha de Nacimiento', className: 'none' },
        { target: 16, title: 'Municipio', className: 'none' },

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
    buttons: [
        {
            extend: 'excelHtml5',
            text: '<i class="fa fa-file-excel-o"></i> Excel',
            className: 'btn btn-success',
            titleAttr: 'Excel',
            action: function () {
                alert(1);
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