tablaRecepcionPacientes = $('#TablaRecepcionPacientes').DataTable({
  language: { url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json", },
  scrollY: autoHeightDiv(0, 374),
  scrollCollapse: true,
  lengthMenu: [
    [10, 15, 20, 25, 30, 35, 40, 45, 50, -1],
    [10, 15, 20, 25, 30, 35, 40, 45, 50, "All"]
  ],
  ajax: {
    dataType: 'json',
    data: function (d) {
      return $.extend(d, dataRecepcion);
    },
    method: 'POST',
    url: '../../../api/recepcion_api.php',
    beforeSend: function () {
      loader("In"), array_selected = null
    },
    complete: function () {
      loader("Out")
    },
    dataSrc: 'response.data'
  },
  columns: [
    { data: 'COUNT' },
    { data: 'NOMBRE_COMPLETO' },
    { data: 'PREFOLIO' },
    { data: 'NOMBRE_COMERCIAL' },
    { data: 'DESCRIPCION_SEGMENTO' },
    {
      data: 'FECHA_AGENDA',
      render: function (data) {
        return formatoFecha2(data, [0, 1, 5, 2, 0, 0, 0], null);
      }
    },
    { data: 'GENERO' }
    // {defaultContent: 'En progreso...'}
  ],
  columnDefs: [
    { width: "5px", targets: 0 },

  ],

})

inputBusquedaTable('TablaRecepcionPacientes', tablaRecepcionPacientes, [
  {
    msj: 'Filtra la tabla con palabras u oraciones que coincidan en el campo de busqueda',
    place: 'left'
  },
])


selectDatatable("TablaRecepcionPacientes", tablaRecepcionPacientes, 1, "pacientes_api", 'paciente', { 0: null }, function () {
  console.log(array_selected);

  if (array_selected['CLIENTE_ID'] == 18) {
    $('#buttonBeneficiario').html(`<button type="button" class="btn btn-hover me-2" style="margin-bottom:4px" data-bs-toggle="modal"
            data-bs-target="#ModalBeneficiario">
            <i class="bi bi-save"></i> Beneficiario
          </button>`)
  } else {
    $('#buttonBeneficiario').html('');
  }


})