// loader("Out")
resolucion = screen.height-450;
var tablaUsuarios = $('#TablaUsuariosAdmin').DataTable({
  language: {
    url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
  },
  scrollY: "60vh",
  scrollCollapse: true,
  lengthMenu: [[10, 15, 20, 25, 30, 35, 40, 45, 50, -1], [10, 15, 20, 25, 30, 35, 40, 45, 50, "All"]],
  columnDefs: [
    { "width": "3px", "targets": 0 },
  ],

})
// setTimeout(function(){loader("In")}, 500);

$('#TablaUsuariosAdmin tbody').on('click', 'tr', function () {
   // alert( 'Clicked row id '+idrow );
   if ($(this).hasClass('selected')) {
       $(this).removeClass('selected');
       array_paciente = null;
   } else {
       tablaUsuarios.$('tr.selected').removeClass('selected');
       $(this).addClass('selected');
       array_paciente = tablaUsuarios.row( this ).data();
   }
});
