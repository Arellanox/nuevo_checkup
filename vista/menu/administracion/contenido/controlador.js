//Menu predeterminado
window.location.hash = 'Usuarios';

// ObtenerTabla o cambiar
obtenerContenidoUsuarios("administracion.php", "Administración | Usuarios");
function obtenerContenidoUsuarios(tabla, titulo){
  obtenerTitulo(titulo); //Aqui mandar el nombre de la area

  $.post("contenido/"+tabla, function(html){
    var idrow;
     $("#body-js").html(html);
     loader("Out")
     var tablaUsuarios = $('#TablaUsuariosAdmin').DataTable({
       language: {
         url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
       },
       lengthMenu: [[10, 15, 20, 25, 30, 35, 40, 45, 50, -1], [10, 15, 20, 25, 30, 35, 40, 45, 50, "All"]],
       columnDefs: [
         { "width": "5px", "targets": 0 },
       ],

     })

     setTimeout(function(){loader("In")}, 500);

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
  });
}

function obtenerContenidoClientes(tabla, titulo){
  obtenerTitulo(titulo); //Aqui mandar el nombre de la area
  $.post("contenido/"+tabla, function(html){
    var idrow;
     $("#body-js").html(html);
     loader("Out")
  });
}

function obtenerContenidoServicios(tabla, titulo){
  obtenerTitulo(titulo); //Aqui mandar el nombre de la area
  $.post("contenido/"+tabla, function(html){
    var idrow;
     $("#body-js").html(html);
     loader("Out")
  });
}

function loader(fade){
  if (fade == 'Out') {
    $("#ContenidoHTML").fadeToggle(1);
    $("#loader").removeClass("noloader");
    $("#loader").addClass("loader");
    $("#preloader").removeClass("preloader");
    $("#preloader").addClass("preloader");
  }else if (fade == 'In') {
    $("#loader").removeClass("loader");
    $("#loader").addClass("noloader");
    $("#preloader").addClass("preloader");
    $("#preloader").removeClass("preloader");
    $("#ContenidoHTML").fadeToggle(100);
  }
}
