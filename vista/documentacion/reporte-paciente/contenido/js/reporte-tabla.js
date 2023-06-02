tablaPrincipal = $('#tablaPrincipal').DataTable({
  language: {
    url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
  },
  // lengthChange: false,
  // info: false,
  // paging: false,
  // scrollY: autoHeightDiv(0, 284),
  // scrollCollapse: true,
  ajax: {
    dataType: 'json',
    data: function (d) {
      return $.extend(d, dataList);
    },

    method: 'POST',
    url: `${http}${servidor}/${appname}/api/cargos_turnos_api.php`,
    beforeSend: function () { loader("In") },
    complete: function () {
      loader("Out")
    },
    dataSrc: 'response.data'
  },
  columns: [
    { data: 'NUM_SISTEMA' },
    { data: 'NUM_PROVEEDOR' },
    { data: 'FACTURA' },
    { data: 'CLAVE_BENEFICIARIO' },
    { data: 'PACIENTE' },
    { data: 'PARENTESCO' },
    { data: 'NUM_PASE' },
    { data: 'SERVICIOS' },
    { data: 'CANTIDAD' },
    {
      data: 'PRECIO_UNITARIO', render: function (data) {
        return `$${parseDataTable(data)}`;
      }
    },
    {
      data: 'SUBTOTAL', render: function (data) {
        return `$${parseDataTable(data)}`;
      }
    },
    {
      data: 'IVA', render: function (data) {
        return `$${parseDataTable(data)}`;
      }
    },
    {
      data: 'TOTAL', render: function (data) {
        return `$${parseDataTable(data)}`;
      }
    },
    {
      data: 'FECHA_RECEPCION', render: function (data) {
        return formatoFecha2(data, [0, 1, 5, 2, 1, 1, 1]);
      }
    },
    { data: 'PROCEDENCIA' },
    { data: 'TRABAJADOR' },
    { data: 'VERIFICACION' },
    { data: 'CATEGORIA' },
    { data: 'URES' },
    { data: 'DIAGNOSTICO' },
  ],
  columnDefs: [
    { target: 0, className: 'all', title: 'No. Sistema', width: '7%' },
    { target: 1, className: 'none', title: 'No. Proovedor' },
    { target: 2, className: 'none', title: 'No. Factura' },
    { target: 3, className: 'all', title: 'Clave Beneficiario', width: '10%' },
    { target: 4, className: 'all', title: 'Paciente' },
    { target: 5, className: 'none', title: 'Parentesco' },
    { target: 6, className: 'all', title: 'No. Pase', width: '7%' },
    { target: 7, className: 'all', title: 'Servicios' },
    { target: 8, className: 'none', title: 'Cantidad' },
    { target: 9, className: 'all', title: 'Unitario', width: '7%' },
    { target: 10, className: 'all', title: 'Subtotal', width: '7%' },
    { target: 11, className: 'all', title: 'IVA', width: '7%' },
    { target: 12, className: 'all', title: 'Total', width: '7%' },
    { target: 13, className: 'all', title: 'Fecha Recepción', width: '12%' },
    { target: 14, className: 'none', title: 'Procedencia' },
    { target: 15, className: 'none', title: 'Trabajador' },
    { target: 16, className: 'none', title: 'Verificacion (url)' },
    { target: 17, className: 'none', title: 'Categoria' },
    { target: 18, className: 'none', title: 'Ures' },
    { target: 19, className: 'all', title: 'Diagnostico' },
  ],



  dom: 'Bfrtip',
  buttons: [
    // {
    //   extend: 'copyHtml5',
    //   text: '<i class="fa fa-files-o"></i>',
    //   titleAttr: 'Copy'
    // },
    {
      extend: 'excelHtml5',
      text: '<i class="fa fa-file-excel-o"></i> Excel',
      className: 'btn btn-option',
      titleAttr: 'Excel'
    },
    // {
    //   extend: 'csvHtml5',
    //   text: '<i class="fa fa-file-text-o"></i>',
    //   titleAttr: 'CSV'
    // },
    // {
    //   extend: 'pdfHtml5',
    //   text: '<i class="fa fa-file-pdf-o"></i>',
    //   titleAttr: 'PDF'
    // }
  ],

  // UNA IDEA de funcion
  initComplete: function () {
    var api = this.api();

    // For each column
    api
      .columns()
      .eq(0)
      .each(function (colIdx) {
        // Set the header cell to contain the input element
        var cell = $('.filters th').eq(
          $(api.column(colIdx).header()).index()
        );
        var title = $(cell).text();
        console.log(cell)
        // var title = 'si';
        $(cell).html('<input type="text" style="width: 100%" placeholder="' + title + '" />');

        // On every keypress in this input
        $(
          'input',
          $('.filters th').eq($(api.column(colIdx).header()).index())
        )
          .off('keyup change')
          .on('change', function (e) {
            // Get the search value
            $(this).attr('title', $(this).val());
            var regexr = '({search})'; //$(this).parents('th').find('select').val();

            var cursorPosition = this.selectionStart;
            // Search the column for that value
            api
              .column(colIdx)
              .search(
                this.value != ''
                  ? regexr.replace('{search}', '(((' + this.value + ')))')
                  : '',
                this.value != '',
                this.value == ''
              )
              .draw();
          })
          .on('keyup', function (e) {
            e.stopPropagation();

            $(this).trigger('change');
            $(this)
              .focus()[0]
              .setSelectionRange(cursorPosition, cursorPosition);
          });
      });
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