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
    scrollY: '37vh',
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
                return formatoFecha(data)
                // return formatoFecha2(data, [0, 1, 3, 1])
            }
        },
        { data: 'CLAVE' },
        { data: 'NOMBRE' },
        { data: 'PATERNO' },
        { data: 'MATERNO' },
        { data: 'PROCEDENCIA'},

        {
            data: 'NACIMIENTO', render: function (data) {
                return formatoFecha(data)
                // return formatoFecha2(data, [0, 1, 3, 1])
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
                return formatoFechaSinHora(data)
            }
        },
        { data: 'SERVICIO' },
        { data: 'RESULTADO_GLOBAL' },
        {
            data: 'PATOGENOS', render: function (data) {
                return ifnull(formatearArreglo(data),'N/A')
            }
        },
        {
            data: 'LABORATORIO', render: function (data) {
                return ifnull(data, 'N/A')
            }
        },
        {
            data: 'FECHA_RESULTADO', render: function (data) {
                return formatoFechaSinHora(data)
                // return formatoFecha2(data, [0, 1, 3, 1])
            }
        },


    ],
    columnDefs: [
        { target: 0, title: '#', className: 'all', width: '1%' },
        { target: 1, title: 'Prefolio', className: 'all' },
        { target: 2, title: 'Folio', className: 'none' },
        { target: 3, title: 'Fecha recepción', className: 'all' },
        { target: 4, title: 'clave', className: 'none' },
        { target: 5, title: 'Nombre', className: 'all' },
        { target: 6, title: 'Apdo. Paterno', className: 'all' },
        { target: 7, title: 'Apdo. Materno', className: 'all' },
        { target: 8, title: 'Procedencia', className: 'all' },
        { target: 9, title: 'Fecha de Nacimiento', className: 'none' },
        { target: 10, title: 'Edad', className: 'none' },
        { target: 11, title: 'Sexo', className: 'none' },
        { target: 12, title: 'Municipio', className: 'none' },
        { target: 13, title: 'Domicilio', className: 'none' },
        { target: 14, title: 'Celular', className: 'none' },
        { target: 15, title: 'Fecha confirmado', className: 'all' },
        { target: 16, title: 'Servicio', className: 'all' },
        { target: 17, title: 'Resultado', className: 'all' },
        { target: 18, title: 'Patogenos', className: 'all' },
        { target: 19, title: 'Laboratorio', className: 'all' },
        { target: 20, title: 'Fecha resultado', className: 'all' },
        
        
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
                columns: [0 ,8, 3, 2, 4, 6, 7, 5, 9, 10, 11, 12, 13, 14, 18, 1, 15, 16, 17, 19, 20]
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
//Formatea el arreglo a una forma mas legible ejemplo: ["Influenza A (IAV):POSITIVO","Influenza A H1N1:POSITIVO"]
function formatearArreglo(texto) {
    if (texto) {
        const arrayResultados = JSON.parse(texto.replace(/'/g, '"'));
        const resultadosLegibles = arrayResultados.map(item => {
            const [nombre, resultado] = item.split(':');
            return `${nombre}: ${resultado}`;
        });
        return resultadosLegibles.join(', ');
    }

    return '';
}

//Quita la hora de la fecha que trae de la base de datos
function formatoFechaSinHora(texto) {
    if (texto) {
        const partes = texto.split(' ');
        const fechaSinHora = partes[0]; // Obtener solo la parte de la fecha
        const [anio, mes, dia] = fechaSinHora.split('-');
        return `${dia}/${mes}/${anio}`;
    }

    return '';
}

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