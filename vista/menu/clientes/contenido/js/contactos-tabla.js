tablaContacto = $("#TablaContacto").DataTable({
  language: {
    url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json",
  },
  // searching: false,
  lengthChange: false,
  info: false,
  paging: false,
  scrollY: "30vh",
  scrollCollapse: true,
  // lengthMenu: [
  //   [10, 15, 20, 25, 30, 35, 40, 45, 50, -1],
  //   [10, 15, 20, 25, 30, 35, 40, 45, 50, "All"],
  // ],
  ajax: {
    dataType: "json",
    data: function (d) {
      return $.extend(d, datacontactos);
    },
    method: "POST",
    url: "../../../api/contactos_api.php",
    beforeSend: function () {
      loaderDiv("In", "#contenido-contacto", "#loader-tabla-contacto");
    },
    complete: function () {
      loaderDiv("Out",  "#contenido-contacto", "#loader-tabla-contacto");
    },
    dataSrc: "response.data",
  },
  columns: [
    { data: "COUNT" },
    { data: "NOMBRE_COMPLETO" },
    { data: "ACTIVO" },
    // {defaultContent: 'En progreso...'}
  ],
  columnDefs: [{ width: "3px", targets: 0 }],
});

$("#BuscarTablaContactos").keyup(function () {
  tablaContacto.search($(this).val()).draw();
});

$("#TablaContacto tbody").on("click", "tr", function () {
  if ($(this).hasClass("selected")) {
    $(this).removeClass("selected");
    selectContacto = null;
  } else {
    tablaContacto.$("tr.selected").removeClass("selected");
    $(this).addClass("selected");
    selectContacto = tablaContacto.row(this).data();
  }
});

$("#TablaContacto tbody").on("dblclick", "tr", function () {
  selectContacto = tablaContacto.row(this).data();
  $(this).addClass("selected");
  if (selectContacto != null) {
    obtenerPanelInformacion(1, 0, "contacto", "#contacto-informacion");
    $("#modalInfoContacto").modal("show");
  }
});
