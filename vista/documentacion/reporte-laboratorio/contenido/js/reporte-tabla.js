tablaPrincipal = $('#tablaPrincipal').DataTable({
  language: {
    url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json",
    emptyTable: "La selección actual no arroja datos para mostrar.",
  },
  lengthChange: false,
  info: true,
  paging: true,
  lengthMenu: [
    [20, 35, 50, 100, -1],
    [20, 35, 50, 100, "All"]
  ],
  scrollY: '61vh',
  scrollCollapse: true,
  ajax: {
    dataType: 'json',
    data: function (d) {
      return $.extend(d, dataList);
    },

    method: 'POST',
    url: `${http}${servidor}/${appname}/api/reportes_api.php`,
    beforeSend: function () { loader("In") },
    complete: function () {
      loader("Out", 'bottom')
    },
    dataSrc: 'response.data'
  },
  columns: [
    { data: 'PREFOLIO' },
    { data: 'PROCEDENCIA' },
    { data: 'PX' },
    { data: 'FECHA_RECEPCION' },
    { data: 'ANIO' },
    { data: 'MES' },
    { data: 'DIA' },
    { data: 'SERVICIO' },
    { data: 'AREA' },
  ],
  columnDefs: [
    { target: 0, className: '', title: "Prefolio" },
    { target: 1, className: '', title: "Procedencia" },
    { target: 2, className: '', title: "Paciente" },
    { target: 3, className: '', title: "Fecha Recepción" },
    { target: 4, className: '', title: "Año" },
    { target: 5, className: '', title: "Mes" },
    { target: 6, className: '', title: "Día" },
    { target: 7, className: '', title: "Servicio" },
    { target: 8, className: '', title: "Área" },
  ],
  dom: 'Bfrtip',
  buttons: [
    {
      extend: 'excelHtml5',
      text: '<i class="bi bi-download"></i> Excel',
      className: 'btn btn-success',
      titleAttr: 'Excel',
      customizeData: function (data) {
        // Eliminar encabezados de columnas ocultas
        for (var i = data.header.length - 1; i >= 0; i--) {
          if (!$('#tablaPrincipal').DataTable().column(i).visible()) {
            data.header.splice(i, 1);
            for (var j = 0; j < data.body.length; j++) {
              data.body[j].splice(i, 1);
            }
          }
        }
      }
    },
  ]
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
    msj: 'Puedes organizar el contenido con los encabezados de la tabla.',
    place: 'top'
  },
  {
    msj: 'El campo de busqueda filtra sus coincidencias.',
    place: 'top'
  },
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