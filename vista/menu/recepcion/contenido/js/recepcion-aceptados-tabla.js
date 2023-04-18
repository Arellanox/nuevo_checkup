tablaRecepcionPacientesIngrersados = $('#TablaRecepcionPacientes-Ingresados').DataTable({
  language: {
    url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json",
  },
  scrollY: autoHeightDiv(0, 332), //347px
  scrollCollapse: true,
  lengthMenu: [
    [20, 25, 30, 35, 40, 45, 50, -1],
    [20, 25, 30, 35, 40, 45, 50, "All"]
  ],
  ajax: {
    dataType: 'json',
    data: function (d) {
      return $.extend(d, dataRecepcion);
    },
    method: 'POST',
    url: '../../../api/recepcion_api.php',
    beforeSend: function () {
      loader("In", 'bottom'), array_selected = null
    },
    complete: function () {
      loader("Out", 'bottom')
      $.fn.dataTable
        .tables({
          visible: true,
          api: true
        })
        .columns.adjust();
    },
    error: function (jqXHR, textStatus, errorThrown) {
      alertErrorAJAX(jqXHR, textStatus, errorThrown);
    },
    dataSrc: 'response.data'
  },
  createdRow: function (row, data, dataIndex) {
    if (data.REAGENDADO == 1) {
      $(row).addClass('bg-info');
    }
  },
  columns: [
    { data: 'COUNT' },
    { data: 'NOMBRE_COMPLETO' },
    { data: 'PREFOLIO', },
    {
      data: 'NOMBRE_COMERCIAL',
      render: function (data) {
        switch (data) {
          case 'Particular': case 'PARTICULAR':
            return `<p class="fw-bold" style="letter-spacing: normal !important;">${data}</p>`;
          default:
            return data;
        }
      }
    },
    { data: 'DESCRIPCION_SEGMENTO' },
    { data: 'TURNO' },
    {
      data: 'ID_PACIENTE',
      render: function (data) {
        return 'PENDIENTE';
      }
    },
    // {
    //   data: 'ESTADO_ANALISIS',
    //   render: function (data) {
    //     switch (data) {
    //       case 'Terminado':
    //         return '<p class="text-primary fw-bold" style="letter-spacing: normal !important;">' + data + '</p>';
    //       case 'En proceso':
    //         return '<p class="text-warning fw-bold" style="letter-spacing: normal !important;">' + data + '</p>';
    //       default:
    //         return '';
    //     }
    //   }
    // },
    // {
    //   data: 'ESTADO_MUESTRA',
    //   render: function (data) {
    //     switch (data) {
    //       case 'Tomada':
    //         return '<p class="text-success fw-bold" style="letter-spacing: normal !important;">' + data + '</p>';
    //       case 'Sin tomar':
    //         return '<p class="text-warning fw-bold" style="letter-spacing: normal !important;">' + data + '</p>';
    //       default:
    //         return '';
    //     }
    //   }
    // },
    {
      data: 'FECHA_RECEPCION',
      render: function (data) {
        return formatoFecha2(data, [0, 1, 5, 2, 0, 0, 0], null);
      }
    },
    {
      data: 'FECHA_AGENDA',
      render: function (data) {
        return formatoFecha2(data, [0, 1, 5, 2, 0, 0, 0], null);
      }
    },
    {
      data: 'FECHA_REAGENDA',
      render: function (data) {
        return '<p class="text-primary fw-bold" style="letter-spacing: normal !important;">' + formatoFecha2(data, [0, 1, 5, 2, 0, 0, 0], null) + '</p>';

      }
    },
    { data: 'GENERO' },
    {
      data: 'COUNT', render: function () {
        let html = `
          <div class="row">
            <div class="col-6" style="max-width: max-content; padding: 0px; padding-left: 3px; padding-right: 3px;">
              <i class="bi bi-pencil-square btn-editar" style="cursor: pointer; font-size:18px;"></i>
            </div>
            <div class="col-6" style="max-width: max-content; padding: 0px; padding-left: 3px; padding-right: 3px;">
              <i class="bi bi-card-heading" style="cursor: pointer; font-size:18px;" id="btn-cargar-documentos"></i>
            </div>            
          </div>
        `;
        html = '';
        return html
      }
    },
    // {defaultContent: 'En progreso...'}
  ],
  columnDefs: [
    { width: "5px", targets: 0 },
    { visible: false, title: "AreaActual", targets: 6, searchable: false },
    { target: 11, width: "30px" }

  ],

})

inputBusquedaTable('TablaRecepcionPacientes-Ingresados', tablaRecepcionPacientesIngrersados, [
  {
    msj: 'Filtra la tabla con palabras u oraciones que coincidan en el campo de busqueda',
    place: 'left'
  },
])

selectDatatable("TablaRecepcionPacientes-Ingresados", tablaRecepcionPacientesIngrersados, 1, {
  0: "pacientes_api",
  1: "documentos_api",
  3: "toma_de_muestra_api"
}, {
  0: "paciente",
  1: "documentos-paciente",
  2: "estudios_muestras"
}, {
  0: "#panel-informacion",
  1: "#panel-documentos-paciente",
  2: "#panel-muestras-estudios"
}, function () {


  if (array_selected['CLIENTE_ID'] == 18) {
    $('#buttonBeneficiario').fadeIn(200)
  } else {
    $('#buttonBeneficiario').fadeOut(200);
  }


})


$('')

autoHeightDiv('#panel-informacion-pacientesTurnos', 188)