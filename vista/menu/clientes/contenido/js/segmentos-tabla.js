
tablaSegmentos = $("#TablaSegmentosAdmin").DataTable({
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
      data: function (s) {
      return $.extend(s, dataSegmento);
    },
    method: "POST",
    url: "../../../api/segmentos_api.php",
    beforeSend: function () {
      loaderDiv("In", "#contenido-segmento", "#loader-tabla-segmento");
    },
    complete: function () {
      loaderDiv("Out",  "#contenido-segmento", "#loader-tabla-segmento");
    },
    dataSrc: "response.data",
  },
  columns: [
    { data: "COUNT" },
    { data: "DESCRIPCION" },
    { data: "DESCRIPCION_PADRE" },

    // {defaultContent: 'En progreso...'}
  ],
  columnDefs: [{ width: "3px", targets: 0 }],
});
// setTimeout(function(){loader("In")}, 500);

$("#TablaSegmentosAdmin tbody").on("click", "tr", function () {
  if ($(this).hasClass("selected")) {
    $(this).removeClass("selected");
    selectSegmento = null;
  } else {
    tablaSegmentos.$("tr.selected").removeClass("selected");
    $(this).addClass("selected");
    selectSegmento = tablaSegmentos.row(this).data();
  }
});
