var tablaSegmentos = $("#TablaSegmentosAdmin").DataTable({
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
    { data: "4.0.DESCRIPCION" },
    { data: "5.0.NOMBRE_COMERCIAL"},

    // {defaultContent: 'En progreso...'}
  ],
  columnDefs: [{ width: "3px", targets: 0 }],
});
// setTimeout(function(){loader("In")}, 500);
selectDatatable("TablaSegmentosAdmin", tablaSegmentos);
