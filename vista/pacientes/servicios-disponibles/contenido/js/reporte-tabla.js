tablaPrincipal = $('#tablaPrincipal').DataTable({
  language: {
    url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json",
    emptyTable: "No se ha elegido fecha y procedencia a mostrar.",
  },
  lengthChange: false,
  info: false,
  paging: false,
  scrollY: '68vh',
  scrollCollapse: true,
  ordering: false,
  ajax: {
    dataType: 'json',
    data: { api: 1 },
    method: 'POST',
    url: `${http}${servidor}/${appname}/api/precio_particulares_api.php`,
    beforeSend: function () { loader("In") },
    complete: function () {
      loader("Out", 'bottom')
    },
    dataSrc: 'response.data'
  },
  columns: [
    // { data: null, },
    { data: 'SERVICIO' },
    {
      data: 'PRECIO_VENTA', render: function (data) {
        return `$${data}`;
      }
    },
    { data: 'AREA' },
    // { data: 'PACIENTE' },
    // { data: 'PARENTESCO' },
    // { data: 'NUM_PASE' },
    // { data: 'SERVICIOS' },
    // { data: 'PREFOLIO' },
    // { data: 'CANTIDAD' },
    // {
    //   data: 'PRECIO_UNITARIO', render: function (data) {
    //     return `$${parseDataTable(data)}`;
    //   }
    // },
    // {
    //   data: 'SUBTOTAL', render: function (data) {
    //     return `$${parseDataTable(data)}`;
    //   }
    // },
    // {
    //   data: 'IVA', render: function (data) {
    //     return `$${parseDataTable(data)}`;
    //   }
    // },
    // {
    //   data: 'TOTAL', render: function (data) {
    //     return `$${parseDataTable(data)}`;
    //   }
    // },
    // {
    //   data: 'FECHA_RECEPCION', render: function (data) {
    //     return formatoFecha2(data, [0, 1, 5, 2, 1, 1, 1]);
    //   }
    // },
    // { data: 'PROCEDENCIA' },
    // { data: 'TRABAJADOR' },
    // { data: 'VERIFICACION' },
    // { data: 'CATEGORIA' },
    // { data: 'URES' },
    // { data: 'DIAGNOSTICO' },
    // { data: 'SERVICIOS_ABREVIATURA' }
  ],
  columnDefs: [
    // { target: 0, className: 'all', title: '#', width: '2%' },
    { target: 0, className: 'all', title: 'Servicio', width: '33.3%' },
    { target: 1, className: 'all', title: 'Precio Venta', width: '33.3%' },
    { target: 2, className: 'min-tablet', title: 'Area', width: '33.3%' },

    // { target: 0, className: 'all', title: 'No. Sistema', width: '7%', visible: false },
    // { target: 1, className: 'none beneficiario', title: 'No. Proovedor', visible: false },
    // { target: 2, className: 'none beneficiario', title: 'No. Factura', visible: false },
    // { target: 3, className: 'none beneficiario', title: 'Clave Beneficiario', width: '10%', visible: false },
    // { target: 4, className: 'all', title: 'Paciente' },
    // { target: 5, className: 'none beneficiario', title: 'Parentesco', visible: false },
    // { target: 6, className: 'none beneficiario', title: 'No. Pase', width: '7%', visible: false },
    // { target: 7, className: 'all', title: 'Servicios' },
    // { target: 8, className: 'all', title: 'Prefolio' },
    // { target: 9, className: 'none', title: 'Cantidad' },
    // { target: 10, className: 'all', title: 'Unitario', width: '7%' },
    // { target: 11, className: 'all', title: 'Subtotal', width: '7%' },
    // { target: 12, className: 'all', title: 'IVA', width: '7%' },
    // { target: 13, className: 'all', title: 'Total', width: '7%' },
    // { target: 14, className: 'all', title: 'Fecha Recepción', width: '12%' },
    // { target: 15, className: 'all', title: 'Procedencia' },
    // { target: 16, className: 'none beneficiario', title: 'Trabajador', visible: false },
    // { target: 17, className: 'none beneficiario', title: 'Verificacion (url)', visible: false },
    // { target: 18, className: 'none beneficiario', title: 'Categoria', visible: false },
    // { target: 19, className: 'none beneficiario', title: 'Ures', visible: false },
    // { target: 20, className: 'all', title: 'Diagnostico' },
    // { target: 21, className: 'none', title: 'abreviatura', visible: false, searchable: true },
  ],


  // rowGroup: {

  //   dataSrc: 'PREFOLIO', // Columna utilizada para la agrupación
  //   // startRender: function (rows, group) {
  //   //   // Renderización personalizada del grupo
  //   //   var paciente = rows.data()[0].PACIENTE;

  //   //   let tr = $('<tr/>')

  //   //   tr.addClass('background-group');

  //   //   return tr
  //   //     .append(`<div class="d-flex align-center">${paciente}</div>`)

  //   // }
  // },

  rowGroup: {
    dataSrc: 'AREA',
    startRender: function (rows, group) {

      // Crear un objeto jQuery para el elemento de fila
      var row = $('<tr/>')
        .addClass('background-group')
        .append('<td colspan="22">' + group + '</td>');

      // Devolver el elemento de fila
      return row;
    }
  }



  // dom: 'Bfrtip',
  // buttons: [
  //   // {
  //   //   extend: 'copyHtml5',
  //   //   text: '<i class="fa fa-files-o"></i>',
  //   //   titleAttr: 'Copy'
  //   // },
  //   {
  //     extend: 'excelHtml5',
  //     text: '<i class="fa fa-file-excel-o"></i> Excel',
  //     className: 'btn btn-success',
  //     titleAttr: 'Excel',
  //     customizeData: function (data) {
  //       // Eliminar encabezados de columnas ocultas
  //       for (var i = data.header.length - 1; i >= 0; i--) {
  //         if (!$('#tablaPrincipal').DataTable().column(i).visible()) {
  //           data.header.splice(i, 1);
  //           for (var j = 0; j < data.body.length; j++) {
  //             data.body[j].splice(i, 1);
  //           }
  //         }
  //       }
  //     }
  //   },
  //   {
  //     text: '<i class="bi bi-box-arrow-in-down"></i> Incluir Campos Beneficiarios',
  //     className: 'btn btn-turquesa',
  //     id: 'btn-ocultar-campos-beneficiarios',
  //     extend: '',
  //     action: function () {
  //       var columnasOcultas = ['beneficiario']; // Clases CSS de las columnas que quieres ocultar
  //       columnasOcultas.forEach(function (clase) {
  //         var columnas = tablaPrincipal.columns('.' + clase);
  //         var estadoActual = columnas.visible()[0];
  //         columnas.visible(!estadoActual);
  //       });

  //       tablaPrincipal.buttons().container().removeClass('show-columns');
  //       tablaPrincipal.buttons().container().addClass('hide-columns');

  //       setTimeout(() => {
  //         tablaPrincipal.columns.adjust().draw(false); // Ajustar columnas y redibujar completamente la tabla
  //       }, 130);

  //     }
  //   },
  //   {
  //     text: '<i class="bi bi-eye-slash"></i> Ocultar',
  //     className: 'btn btn-secondary',
  //     action: function () {
  //       tablaPrincipal.rows().nodes().to$().addClass('d-none');

  //     }
  //   },
  //   {
  //     text: '<i class="bi bi-eye"></i> Mostrar',
  //     className: 'btn btn-secondary',
  //     action: function () {
  //       tablaPrincipal.rows().nodes().to$().removeClass('d-none');

  //     }
  //   },
  // ],


})

function parseDataTable(data) {
  let parsedData;

  if (!isNaN(parseFloat(data))) {
    // Si el dato puede ser convertido a número
    parsedData = parseFloat(data).toFixed(2); // Convertir a número y limitar a dos decimales
  } else {
    // Si el dato es texto
    parsedData = 0;
  }

  return parsedData
}

inputBusquedaTable('tablaPrincipal', tablaPrincipal, [
  {
    msj: 'Puedes ocultar los servicios de cada area al darle click en ella.',
    place: 'top'
  },
  // {
  //   msj: 'El campo de busqueda filtra sus coincidencias.',
  //   place: 'top'
  // },
], {}, 'col-12')



// Agregar un evento clic a las filas de grupo
$('#tablaPrincipal tbody').on('click', '.background-group', function () {
  // $(this).toggleClass('group-hidden');
  var rows = tablaPrincipal.rows($(this).nextUntil('.background-group'));
  if (rows.nodes().to$().hasClass('d-none')) {
    rows.nodes().to$().removeClass('d-none');
  } else {
    rows.nodes().to$().addClass('d-none');
  }

});