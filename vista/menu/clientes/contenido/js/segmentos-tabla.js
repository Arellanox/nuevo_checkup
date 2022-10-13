var tablaSegmentos = $("#TablaSegmentosAdmin").DataTable({
  language: {
    url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json",
  },
  lengthChange: false,
  info: false,
  paging: false,
  scrollY: "55vh",
  scrollCollapse: true,
  ajax: {
    dataType: "json",
    data: { api: 2 },
    method: "POST",
    url: "../../../api/segmentos_api.php",
    beforeSend: function () {
      loader("In");
    },
    complete: function () {
      loader("Out");
    },
    dataSrc: "",
  },
  columns: [
    { data: "count" },
    { data: "DESCRIPCION" },
    { data: "ACTIVO" },

    // {defaultContent: 'En progreso...'}
  ],
  columnDefs: [{ width: "3px", targets: 0 }],
});
// setTimeout(function(){loader("In")}, 500);

$("#TablaSegmentosAdmin tbody").on("click", "tr", function () {
  if ($(this).hasClass("selected")) {
    $(this).removeClass("selected");
    array_selected = null;

    dataSegmento.id_cliente = 1;
    tablaSegmentos.ajax.reload();
  } else {
    tablaSegmentos.$("tr.selected").removeClass("selected");
    $(this).addClass("selected");
    array_selected = tablaSegmentos.row(this).data();

    dataSegmento.id_cliente = array_selected["ID_CLIENTE"];
    tablaSegmentos.ajax.reload();
  }
});
