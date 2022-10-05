obtenerContenidoPrecios("listaprecios.php");
function obtenerContenidoPrecios(tabla) {
  obtenerTitulo("ListaPrecios"); //Aqui mandar el nombre de la area
  $.post("contenido/" + tabla, function (html) {
    var idrow;
    $("#body-js").html(html);

    var tablaPrecio = $("#TablaListaPrecios").DataTable({
      language: {
        url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json",
      },
      lengthMenu: [
        [10, 15, 20, 25, 30, 35, 40, 45, 50, -1],
        [10, 15, 20, 25, 30, 35, 40, 45, 50, "All"],
      ],
      columnDefs: [
        { width: "4%", targets: 0 },
        { width: "24%", targets: 1 },
        { width: "24%", targets: 2 },
        { width: "24%", targets: 3 },
        { width: "24%", targets: 4 },
      ],
    });

    $("#btn-perfil").click(function () {
      alert();
    });

    $("#seleccion-cliente").select2({
      tags: false,
      width: "15%",
      placeholder: "Selecciona un registro",
    });
    rellenarSelect("#seleccion-cliente", "clientes_api", 2, 0, 1);
  });
}
