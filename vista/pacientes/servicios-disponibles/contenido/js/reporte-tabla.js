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

  ],
  columnDefs: [
    // { target: 0, className: 'all', title: '#', width: '2%' },
    { target: 0, className: 'all', title: 'Servicio', width: '33.3%' },
    { target: 1, className: 'all', title: 'Precio Venta', width: '33.3%' },
    { target: 2, className: 'min-tablet', title: 'Area', width: '33.3%' },

  ],


  rowGroup: {
    dataSrc: 'AREA',
    startRender: function (rows, group) {
      var areasMostrar = areasString;

      // Verificar si el área está en las áreas que deseas mostrar y mostrar el grupo
      if (areasMostrar.includes(group)) {
        // Crear un objeto jQuery para el elemento de fila
        var row = $('<tr/>')
          .addClass('background-group')
          .append('<td colspan="22">' + group + '</td>');

        // Devolver el elemento de fila
        return row;
      }

      return null; // Si el área no está en las áreas que deseas mostrar, no mostrar el grupo
    },
    emptyDataGroup: null
  },

  rowCallback: function (row, data) {
    var area = data.AREA; // Obtener el valor del campo 'AREA' para la fila actual
    var areasMostrar = areasString;

    // Verificar si el área está en las áreas que deseas mostrar y mostrar la fila
    if (areasMostrar.includes(area)) {
      $(row).show();
    } else {
      $(row).hide();
    }
  },




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