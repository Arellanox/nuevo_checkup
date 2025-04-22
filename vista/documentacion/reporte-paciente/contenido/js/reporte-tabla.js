tablaPrincipal = $('#tablaPrincipal').DataTable({
  language: {
    url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json",
    emptyTable: "No se ha elegido fecha y procedencia a mostrar.",
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
    url: `${http}${servidor}/${appname}/api/cargos_turnos_api.php`,
    beforeSend: function () { loader("In") },
    complete: function () {
      loader("Out", 'bottom')
    },
    dataSrc: 'response.data'
  },
  columns: [
    { data: 'NUM_SISTEMA' },
    { data: 'NUM_PROVEEDOR' },
    { data: 'FACTURA' },
    { data: 'CLAVE_BENEFICIARIO' },
    { data: 'PACIENTE' },
    { data: 'AREA' },
    { data: 'PARENTESCO' },
    { data: 'NUM_PASE' },
    { data: 'SERVICIOS' },
    {
      data: 'COSTO_BASE', render: function (data) {
        return `$${parseDataTable(data)}`;
      }
    },
    { data: 'PREFOLIO' },
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
    { data: 'VENDEDOR' },
    { data: 'EQUIPO' },
    { data: 'TRABAJADOR' },
    { data: 'VERIFICACION' },
    { data: 'CATEGORIA' },
    { data: 'URES' },
    { data: 'DIAGNOSTICO' },
    { data: 'SERVICIOS_ABREVIATURA' },
    { data: 'FORMA_PAGO' },
    { data: 'METODO_DE_PAGO' },
    { data: 'FACTURA' },
    { data: 'SE_MAQUILA' },
    { data: 'LABORATORIO_MAQUILA' },
    { data: 'NUM_TRABAJADOR' },
    { data: 'TIENE_FACTURA' },
    { data: 'TIPO_CLIENTE' },
    { data: 'US_INTERPRETADO_POR' }
  ],
  columnDefs: [
    { target: 0, className: 'all', title: 'No. Sistema', width: '7%', visible: false },
    { target: 1, className: 'none beneficiario', title: 'No. Proovedor', visible: false },
    { target: 2, className: 'none beneficiario', title: 'No. Factura', visible: false },
    { target: 3, className: 'none beneficiario', title: 'Clave Beneficiario', width: '10%', visible: false },
    { target: 4, className: 'all', title: 'Paciente' },
    { target: 5, className: 'none', title: 'Area' },
    { target: 6, className: 'none beneficiario', title: 'Parentesco', visible: false },
    { target: 7, className: 'none beneficiario', title: 'No. Pase', width: '7%', visible: false },
    { target: 8, className: 'all', title: 'Servicios' },
    { target: 9, className: 'all', title: 'Costo' },
    { target: 10, className: 'all', title: 'Prefolio' },
    { target: 11, className: 'none', title: 'Cantidad' },
    { target: 12, className: 'all', title: 'Unitario', width: '7%' },
    { target: 13, className: 'all', title: 'Subtotal', width: '7%' },
    { target: 14, className: 'all', title: 'IVA', width: '7%' },
    { target: 15, className: 'all', title: 'Total', width: '7%' },
    { target: 16, className: 'all', title: 'Fecha Recepción', width: '12%' },
    { target: 17, className: 'all', title: 'Procedencia' },
    { target: 18, className: 'none', title: 'Vendedor' },
    { target: 19, className: 'all', title: 'Equipo' },
    { target: 20, className: 'none beneficiario', title: 'Trabajador', visible: false },
    { target: 21, className: 'none beneficiario', title: 'Verificacion (url)', visible: false },
    { target: 22, className: 'none beneficiario', title: 'Categoria', visible: false },
    { target: 23, className: 'none beneficiario', title: 'Ures', visible: false },
    { target: 24, className: 'none', title: 'Diagnostico' },
    { target: 25, className: 'none', title: 'abreviatura', visible: false, searchable: true },
    { target: 26, className: 'none', title: 'Forma de Pago' },
    { target: 27, className: 'none', title: 'Método de Pago' },
    { target: 28, className: 'none', title: 'No. Factura' },
    { target: 29, className: 'none', title: 'Maquilado' },
    { target: 30, className: 'none', title: 'Subrogado' },
    { target: 31, className: 'none', title: 'Num. Trabajador' },
    { target: 32, className: 'none', title: 'Factura' },
    { target: 33, className: 'none', title: 'Tipo Cliente' },
    { target: 34, className: 'none', title: 'US Interpretado por' },
  ],
  rowGroup: {
    dataSrc: 'PREFOLIO', // Columna utilizada para la agrupación
    startRender: function (rows, group) {
      // Renderización personalizada del grupo
      var paciente = rows.data()[0].PACIENTE;
      var costo_servicio = rows.data().pluck('TCOSTO_SERVICIOOTAL').reduce(function (a, b) {
        return a + parseFloat(parseDataTable(b));
      }, 0);
      var sumUnitario = rows.data().pluck('PRECIO_UNITARIO').reduce(function (a, b) {
        return a + parseFloat(parseDataTable(b));
      }, 0);
      var sumSubtotal = rows.data().pluck('SUBTOTAL').reduce(function (a, b) {
        return a + parseFloat(parseDataTable(b));
      }, 0);
      var sumIVA = rows.data().pluck('IVA').reduce(function (a, b) {
        return a + parseFloat(parseDataTable(b));
      }, 0);
      var sumTotal = rows.data().pluck('TOTAL').reduce(function (a, b) {
        return a + parseFloat(parseDataTable(b));
      }, 0);
      var fechaRecepcion = rows.data()[0].FECHA_RECEPCION;
      var procedencia = rows.data()[0].PROCEDENCIA;
      var equipo_serv = rows.data()[0].EQUIPO;
      var diagnostico = rows.data()[0].DIAGNOSTICO;

      let tr = $('<tr/>')

      tr.addClass('background-group');

      return tr
        .append('<td>' + paciente + '</td>')
        .append(`<td>${rows.count()} servicios</td>`)
        .append(`<td>$${costo_servicio.toFixed(2)}</tr>`)
        .append(`<td>${group}</td>`)
        .append(`<td>\$${sumUnitario.toFixed(2)}</td>`)
        .append(`<td>\$${sumSubtotal.toFixed(2)}</td>`)
        .append(`<td>\$${sumIVA.toFixed(2)}</td>`)
        .append(`<td>\$${sumTotal.toFixed(2)}</td>`)
        .append(`<td>${formatoFecha2(fechaRecepcion, [0, 1, 5, 2, 1, 1, 1])}</td>`)
        .append(`<td>${procedencia}</td>`)
        .append(`<td></td>`);
      // .append('<td>' + diagnostico + '</td>');
    }
  },
  dom: 'Bfrtip',
  buttons: [

    {
        text: '<i class="fa fa-file-excel-o"></i> Excel',
        className: 'btn btn-success',
        titleAttr: 'Descargar Excel',
        action: function () {
          dataList['api'] = 6;

          ajaxAwait(dataList, 'cargos_turnos_api', { callbackAfter: true }, false, function (data) {
              console.warn(data.response.data[0]);
              window.location.href = data.response.data[0]
              dataList['api'] = 3;
          })
        }
    },
    {
      text: '<i class="fa fa-file-pdf-o"></i> PDF',
      className: 'btn btn-danger',
      titleAttr: 'Descargar PDF',
      action: function () {
        const customDataList = dataList;
        customDataList.api = "estados_cuentas";

        const params = new URLSearchParams(customDataList).toString();
        const link = document.createElement('a');
        link.href = current_url+'/visualizar_reporte/index-pruebas.php?' + params;
        link.target = '_blank';

        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
      }
    },
    {
      text: '<i class="bi bi-box-arrow-in-down"></i> Incluir Campos Beneficiarios',
      className: 'btn btn-turquesa',
      id: 'btn-ocultar-campos-beneficiarios',
      extend: '',
      action: function () {
        var columnasOcultas = ['beneficiario']; // Clases CSS de las columnas que quieres ocultar
        columnasOcultas.forEach(function (clase) {
          var columnas = tablaPrincipal.columns('.' + clase);
          var estadoActual = columnas.visible()[0];
          columnas.visible(!estadoActual);
        });

        tablaPrincipal.buttons().container().removeClass('show-columns');
        tablaPrincipal.buttons().container().addClass('hide-columns');

        setTimeout(() => {
          tablaPrincipal.columns.adjust().draw(false); // Ajustar columnas y redibujar completamente la tabla
        }, 130);

      }
    },
    {
      text: '<i class="bi bi-list"></i> Detallado',
      className: 'btn btn-outline-turquesa',
      attr:{
        id: 'btn-reporte-detallado',
      },
      extend: '',
      action: function () {
        if(dataList['detallado'] == 1){
          dataList['detallado'] = 0;
          $('#btn-reporte-detallado').removeClass('btn-turquesa').addClass('btn-outline-turquesa');
          tablaPrincipal.ajax.reload();
        } else {
          dataList['detallado'] = 1;
          $('#btn-reporte-detallado').removeClass('btn-outline-turquesa').addClass('btn-turquesa');
          tablaPrincipal.ajax.reload();
        }
       
      }
    },
    {
      text: '<i class="bi bi-eye-slash"></i> Ocultar',
      className: 'btn btn-secondary',
      action: function () {
        tablaPrincipal.rows().nodes().to$().addClass('d-none');

      }
    },
    {
      text: '<i class="bi bi-eye"></i> Mostrar',
      className: 'btn btn-secondary',
      action: function () {
        tablaPrincipal.rows().nodes().to$().removeClass('d-none');

      }
    }
  ],


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