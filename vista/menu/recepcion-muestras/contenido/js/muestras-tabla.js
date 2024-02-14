// |------------------------------- Variables -------------------------------------------------------|
let dataListaLotes = { api: 5, id_cliente: session.id_cliente }; //data de lista de lotes
let dataListaPacientesLotes


// tablaMuestras = $('#TablaMuestras').DataTable({
//   language: {
//     url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
//   },
//   lengthChange: false,
//   info: true,
//   paging: false,
//   scrollY: autoHeightDiv(0, 384),
//   scrollCollapse: true,
//   ajax: {
//     dataType: 'json',
//     data: function (d) {
//       return $.extend(d, dataListaPaciente);
//     },
//     method: 'POST',
//     url: '../../../api/toma_de_muestra_api.php',
//     beforeSend: function () { loader("In") },
//     complete: function () {
//       loader("Out", 'bottom')

//       //Para ocultar segunda columna
//       reloadSelectTable()
//     },
//     dataSrc: 'response.data'
//   },
//   createdRow: function (row, data, dataIndex) {
//     if (data.MUESTRA_TOMADA == 1) {
//       $(row).addClass('bg-success text-white');
//     }
//   },
//   columns: [
//     {
//       data: 'ID_PACIENTE', render: function (data) {
//         return '';
//       }
//     },
//     { data: 'NOMBRE_COMPLETO' },
//     { data: 'PREFOLIO' },
//     { data: 'EDAD' },
//     { data: 'EDAD' },
//     // {defaultContent: 'En progreso...'}
//   ],
//   columnDefs: [
//     { "width": "10px", "targets": 0 },
//   ],

// })

// loaderDiv("Out", null, "#loader-muestras", '#loaderDivmuestras');
// // selectDatatable('TablaMuestras', tablaMuestras, 0, 0, 0, 0, function (selectTR = null, array = null) {

// // })


// //new selectDatatable:
// selectTable('#TablaMuestras', tablaMuestras, { unSelect: true, movil: true, reload: ['col-xl-9'] }, async function (select, data, callback) {
//   selectListaMuestras = data;

//   if (select == 1) {

//     //Activa o desactiva el boton
//     if (selectListaMuestras.MUESTRA_TOMADA == 1) {
//       $('#muestra-tomado').prop('disabled', true)
//     } else {
//       $('#muestra-tomado').prop('disabled', false)
//     }

//     //Procesos
//     await obtenerPanelInformacion(selectListaMuestras['ID_TURNO'], 'pacientes_api', 'paciente', '#panel-informacion', '_lab')
//     await obtenerListaEstudiosContenedores(selectListaMuestras['ID_TURNO'])

//     //Muestra las columnas
//     callback('In')
//   } else {

//     callback('Out')
//     selectListaMuestras = null;
//   }
// })



// inputBusquedaTable('TablaMuestras', tablaMuestras, [{
//   msj: 'Los pacientes con muestras tomadas se visualizarán confirmados de color verde',
//   place: 'top'
// }], [], 'col-12')


// function obtenerListaEstudiosContenedores(idturno = null) {
//   return new Promise(resolve => {

//     ajaxAwait({ api: 2, id_turno: idturno }, 'toma_de_muestra_api', { callbackAfter: true, WithoutResponseData: true }, false, (row) => {
//       let html = '';
//       for (var i = 0; i < row.length; i++) {
//         // console.log(row[i]);
//         html += '<li class="list-group-item">';
//         html += row[i]['GRUPO'];
//         html += '<i class="bi bi-arrow-right-short"></i><strong>' + row[i]['MUESTRA'] + '</strong> - <strong>' + row[i]['CONTENEDOR'] + '</strong></li>';

//       }
//       $('#lista-estudios-paciente').html(html);

//       //Complete
//       loaderDiv("Out", null, "#loader-muestras", '#loaderDivmuestras');
//       resolve(1);
//     });


//   });
// }


// //Panel turnos, mandar id fisica al  principio
// obtenerPanelInformacion(7, null, "turnos_panel", '#turnos_panel')







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
                        clas = `<span class="badge text-bg-success">${data}</span>`; break;
                    case "3":
                        clas = `<span class="badge text-bg-warning">${data}</span>`; break;
                    case "4":
                    clas = `<span class="badge badge-strongBlue">${data}</span>`; break; //Poner el color naranja
                    case "5":
                        clas = `<span class="badge text-bg-danger">${data}</span>`; break;
                    case "6":
                        clas = `<span class="badge badge-orange">${data}</span>`; break; //quizas cambiar a uno mas oscuro
                    case "7":
                        clas = `<span class="badge text-bg-info">${data}</span>`; break;
                    default:
                        clas = `<span class="badge text-bg-danger">Error</span>`;
                         break;
                }

                 return clas;

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
      {data: 'PACIENTE'},
      { data: 'FOLIO' },
      {data: 'ESTATUS'},
      {data: 'REPORTES'}, //RESULTADO
      { data: 'FECHA_TOMA_MUESTRA'}, //FECHA_RESULTADO
      { data: 'FECHA_REGISTRO'},
      { data: 'REGISTRADO'},
      { data: 'EDAD'},
      { data: 'SEXO'},


    //   {
    //       data: 'ESTATUS', render: function (data) {
    //           return ifnull(data, 'N/A', true)
    //       }
    //   },
    //   {
    //       data: 'RUTA_REPORTE', render: (data) => {
    //           // Inicializar un arreglo vacío para contener nuestros botones
    //           var buttons = [];

    //           buttons.push(
    //               '<a href="' + data + '" target="_blank" class="btn btn-borrar me-2">' +
    //               '<i class="bi bi-file-earmark-pdf-fill"></i>' +
    //               '</a>'
    //           );

    //           // Unir todos los botones con un espacio y devolver la cadena HTML
    //           return '<div class="d-flex justify-content-start align-items-center">' + buttons.join(' ') + '</div>';
    //       }
    //   },
    //   {
    //       data: 'REGISTRADO', render: function (data) {

    //           const formattedDate = formatoFecha2(data, [0, 1, 5, 2, 2, 2, 0], null); {

    //               // Separar la fecha y la hora basado en la coma
    //               const parts = formattedDate.split(', ');
    //               const datePart = parts[0];
    //               const timePart = parts[1];

    //               // Retornar la fecha y la hora envueltas en spans con las clases correspondientes
    //               return `
    //                       <span class="d-block">${datePart}</span>
    //                       <span class="d-block">${timePart}</span>`;
    //           }
    //       }
    //   },
    //   { data: 'USUARIO' },
  ],
  columnDefs: [
      { "width": "10px", "targets": [0, 3] },
  ],

})
