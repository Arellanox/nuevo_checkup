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
    error: function (jqXHR, textStatus, errorThrown) {
      alertErrorAJAX(jqXHR, textStatus, errorThrown);
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
    {
      data: 'COUNT', render: function () {
        let html = `
          <div class="row">
            <div class="col-6" style="max-width: max-content; padding: 0px; padding-left: 3px; padding-right: 3px;">
              <i class="bi bi-person-bounding-box" style="cursor: pointer; font-size:18px;" id="btn-perfil-paciente"></i>
            </div>
            <div class="col-6" style="max-width: max-content; padding: 0px; padding-left: 3px; padding-right: 3px;">
              <i class="bi bi-card-heading" style="cursor: pointer; font-size:18px;"></i>
            </div>            
          </div>
        `;
        html = '';
        return html
      }
    },
    { data: 'GENERO' }
    // {defaultContent: 'En progreso...'}
  ],
  columnDefs: [
    { width: "5px", targets: 0 },
    { width: "30px", targets: 6 }

  ],

})


inputBusquedaTable('TablaRecepcionPacientes', tablaRecepcionPacientes, [
  {
    msj: 'Filtra la tabla con palabras u oraciones que coincidan en el campo de busqueda',
    place: 'left'
  },
])


selectDatatable("TablaRecepcionPacientes", tablaRecepcionPacientes, 1, "pacientes_api", 'paciente', { 0: "#panel-informacion" }, function () {
  if (array_selected['CLIENTE_ID'] == 18) {
    $('#buttonBeneficiario').fadeIn(200)
  } else {
    $('#buttonBeneficiario').fadeOut(200);
  }


})