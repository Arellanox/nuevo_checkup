var tablaClientes = $("#TablaClientes").DataTable({
  processing: true,
  language: {
    url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json",
    loadingRecords: '&nbsp;',
    processing: '<div class="spinner"></div>'
  },
  scrollY: "60vh",
  scrollCollapse: true,
  lengthMenu: [
    [10, 15, 20, 25, 30, 35, 40, 45, 50, -1],
    [10, 15, 20, 25, 30, 35, 40, 45, 50, "All"],
  ],
  ajax: {
    dataType: "json",
    data: { api: 2 },
    method: "POST",
    url: "../../../api/clientes_api.php",
    // beforeSend: function () {
    //   loader("In");
    // },
    // complete: function () {
    //   loader("Out");
    // },
    dataSrc: "response.data",
  },
  columns: [
    { data: 'COUNT' },
    { data: 'NOMBRE_COMERCIAL' },
    { data: 'RAZON_SOCIAL' },
    { data: 'ABREVIATURA'},

    // {defaultContent: 'En progreso...'}
  ],
  columnDefs: [{ width: "3px", targets: 0 }],
});
// setTimeout(function(){loader("In")}, 500);
// selectDatatable("TablaClientes", tablaClientes);

$('#TablaClientes tbody').on('click', 'tr', function () {
   if ($(this).hasClass('selected')) {
       $(this).removeClass('selected');
       array_selected = null;
       // datacontactos.api = 2;
       datacontactos.id_cliente = 0;
       tablaContacto.ajax.reload();
           dataSegmento.cliente_id = 0;
    tablaSegmentos.ajax.reload();
   } else {
       tablaClientes.$('tr.selected').removeClass('selected');
       $(this).addClass('selected');
       array_selected = tablaClientes.row( this ).data();
       // datacontactos.api = 2;
          dataSegmento.cliente_id = array_selected["ID_CLIENTE"];
          datacontactos.id_cliente = array_selected['ID_CLIENTE'];
          tablaSegmentos.ajax.reload();
       tablaContacto.ajax.reload();

   }
});

$('#TablaClientes tbody').on('dblclick', 'tr', function () {
    array_selected = tablaClientes.row( this ).data();
    $(this).addClass('selected');
    if (array_selected != null) {
      obtenerPanelInformacion(1, 0, 'cliente')
      $("#modalInfoCliente").modal("show");
    }
});
