

obtenerContenidoLaboratorio("laboratorio.php");
function obtenerContenidoLaboratorio(tabla){
  obtenerTitulo("Laboratorio"); //Aqui mandar el nombre de la area
  $.post("contenido/"+tabla, function(html){
    var idrow;
     $("#body-js").html(html);

     var tablaUsuarios = $('#TablaLaboratorio').DataTable({
       language: {
         url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
       },
       lengthMenu: [[10, 15, 20, 25, 30, 35, 40, 45, 50, -1], [10, 15, 20, 25, 30, 35, 40, 45, 50, "All"]],
       columnDefs: [
         { "width": "5px", "targets": 0 },
       ],

     })

     $('#TablaLaboratorio tbody').on('click', 'tr', function () {
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

    $("#btn-perfil").click(function(){
      alert()
    })


  });
}
