loader("In")
var tablaPrincipal = $('#TablaEjemplo').DataTable({
  language: {
    url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
  },
  scrollY: "60vh",
  scrollCollapse: true,
  lengthMenu: [[10, 15, 20, 25, 30, 35, 40, 45, 50, -1], [10, 15, 20, 25, 30, 35, 40, 45, 50, "All"]],
  columnDefs: [
    { "width": "5px", "targets": 0 },
  ],

})
setTimeout(function(){loader("Out")}, 500);
$('#TablaEjemplo tbody').on('click', 'tr', function () {
   // alert( 'Clicked row id '+idrow );
   if ($(this).hasClass('selected')) {
       $(this).removeClass('selected');
       array_paciente = null;
   } else {
       tablaPrincipal.$('tr.selected').removeClass('selected');
       $(this).addClass('selected');
       array_paciente = tablaPrincipal.row( this ).data();
   }
});
