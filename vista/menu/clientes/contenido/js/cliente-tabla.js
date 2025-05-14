var bimoClientes;
var franquiciasClientes;
let filtroTipo3Activo = false;
var tablaClientes = $("#TablaClientes").DataTable({
  language: {
    url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json",
  },
  scrollY: "60vh",
  scrollCollapse: true,
  lengthMenu: [
    [10, 15, 20, 25, 30, 35, 40, 45, 50, -1],
    [10, 15, 20, 25, 30, 35, 40, 45, 50, "All"],
  ],
  ajax: {
    dataType: "json",
    data: {api: 2},
    method: "POST",
    url: "../../../api/clientes_api.php",
    beforeSend: function () {
      loader("In");
    },
    complete: function () {
      loader("Out");
    },
    dataSrc: "response.data",
  },
  columns: [
    {data: 'COUNT'},
    {data: 'NOMBRE_COMERCIAL'},
    {data: 'RAZON_SOCIAL'},
    {data: 'ABREVIATURA'},

    // {defaultContent: 'En progreso...'}
  ],
  columnDefs: [{width: "3px", targets: 0}],
});

$.fn.dataTable.ext.search.push(function (settings, data, dataIndex, rowData) {
  // Solo aplica al DataTable de clientes
  if (settings.nTable.id !== "TablaClientes") return true;

  // Si el filtro está activo, solo mostramos los USUARIO_TIPO_ID = 3
  if (filtroTipo3Activo) {
    // `rowData` estará disponible solo si `rowCallback` o `ajax.dataSrc` devuelve objetos.
    const usuarioTipo = rowData?.USUARIO_TIPO_ID || 0;
    return parseInt(usuarioTipo) === 3;
  }

  // Si el filtro no está activo, mostramos todo
  return true;
});


selectTable("#TablaClientes", tablaClientes,
  { dblClick: true },
  // One Click
  (select, data, callback) => {
    if (select) {
      dataDescuentoTable.id_cliente = data['ID_CLIENTE'];
      TablaDescuentoCliente.ajax.reload();

      dataSegmento.cliente_id = data["ID_CLIENTE"];
      tablaSegmentos.ajax.reload();


      datacontactos.id_cliente = data['ID_CLIENTE'];
      tablaContacto.ajax.reload();
    } else {
      dataDescuentoTable = false
      tablaContacto.clear().draw();
      // dataSegmento.cliente_id = 0;
      tablaSegmentos.clear().draw();


      TablaDescuentoCliente.clear().draw();
    }
  },
  // Doble Click
  (select, data) => {
    if (select) {
      obtenerPanelInformacion(1, 0, 'cliente')
      $("#modalInfoCliente").modal("show");
    }
  }
)

