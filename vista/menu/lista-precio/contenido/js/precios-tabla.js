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

$('#TablaListaPrecios tbody').on('click', 'tr', function () {
   if ($(this).hasClass('selected')) {
       $(this).removeClass('selected');
       array_selected = null;
   } else {
       tablaPrecio.$('tr.selected').removeClass('selected');
       $(this).addClass('selected');
       array_selected = tablaPrecio.row( this ).data();
       console.log(array_selected);
   }
});


$('#TablaListaPrecios tbody').on('click', 'tr', function () {
  costo = $(this+':input[name=costo]').value;
  console.log(costo);
});
