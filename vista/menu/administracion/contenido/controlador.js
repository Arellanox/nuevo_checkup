
//Menu predeterminado
hasLocation();
$(window).on("hashchange", function (e) {
  hasLocation();
});




selectFormUsuario = 0;
// ObtenerTabla o cambiar
function obtenerContenidoUsuarios() {
  obtenerTitulo("Usuarios"); //Aqui mandar el nombre de la area
  $.post("contenido/usuarios.php", function (html) {
    var idrow;
    $("#body-js").html(html);
    // Datatable
    $.getScript("contenido/js/usuario-tabla.js");
    // Botones
    $.getScript("contenido/js/usuario-botones.js");
  });
}

var TablaVistaMedicosTratantes, dataMedicosTratantes = { api: 2 }
detectCoincidence('#nombre-medicoTrarante')
async function ObtenerContenidoMedicosTratantes() {
  await obtenerTitulo("Médicos Tratantes");
  $.post("contenido/medicos/medicos_tratantes.php", function (html) {
    $("#body-js").html(html);
  }).done(function () {

    select2('#select-usuarios-medicos-tratantes', null, 'Selecciona un médico tratante');
    rellenarSelect('#select-usuarios-medicos-tratantes', 'usuarios_api', 2, 'ID_USUARIO', 'nombrecompleto')

    $.getScript("contenido/medicos/js/btn-medicos-tratantes.js");
    $.getScript("contenido/medicos/js/tabla-medicos-tratantes.js");

  })

}



let tablaVistaVendedores, dataVistaVendedores = { api: 2 }
async function obtenerContenidoVendedores() {
  await obtenerTitulo("Vendedores");
  $.post("contenido/vendedores/vendedores_medicos.html", function (html) {
    $("#body-js").html(html);
  }).done(function () {

    $.getScript("contenido/vendedores/js/vendedores_medicos.js");

  })

}
// function obtenerContenidoServicios(tabla, titulo){
//   obtenerTitulo(titulo); //Aqui mandar el nombre de la area
//   $.post("contenido/servicios.php", function (html) {
//     var idrow;
//     $("#body-js").html(html);
//     // Datatable
//     $.getScript("contenido/js/servicios-tabla.js");
//     $.getScript("contenido/js/precios-tabla.js");
//     // Botones
//     $.getScript("contenido/js/servicios-botones.js");
//   });
// }

// function obtenerContenidoSegmentos(titulo) {
//   obtenerTitulo(titulo); //Aqui mandar el nombre de la area
//   $.post("contenido/segmentos.php", function (html) {
//     var idrow;
//     $("#body-js").html(html);
//     // Datatable
//     $.getScript("contenido/js/segmentos-tabla.js");
//     // Botones
//     $.getScript("contenido/js/botones-segmento.js");
//   });
// }



//-------------------------------------------//
//--------------- Proveedores ---------------//
//-------------------------------------------//
setFormProveedores = 0;
async function obtenerContenidoVendedores() {
  await obtenerTitulo("Proveedores bimo");
  $.post("contenido/proveedores/lista_proveedores.html", function (html) {
    $("#body-js").html(html);
  }).done(function () {

    // Botones
    $.getScript("contenido/proveedores/js/btn.js");

    // Datatable
    $.getScript("contenido/proveedores/js/tabla.js");

  })

}

function hasLocation() {
  $('.usuarios_menu').fadeOut(0);
  $('.medicos_vendedores_menu').fadeOut(0);
  // if (validarVista('ADMINISTRACIÓN')) {
  var hash = window.location.hash.substring(1);
  $("a").removeClass("navlinkactive");
  $("nav li a[href='#" + hash + "']").addClass("navlinkactive");
  switch (hash) {
    case "USUARIOS":
      $('.usuarios_menu').fadeIn(0);
      if (validarVista('ADMINISTRACIÓN'))
        obtenerContenidoUsuarios("usuario.php", "Usuarios");
      break;
    case "MEDICOS":
      $('.medicos_vendedores_menu').fadeIn(0);
      if (validarVista('MEDICOS_TRATANTES'))
        ObtenerContenidoMedicosTratantes();
      break;

    case "VENDEDORES":
      $('.medicos_vendedores_menu').fadeIn(0);
      if (validarVista('VENDEDORES_COMISIONADOS'))//PERMISO PARA ENTRAR
        obtenerContenidoVendedores();
      break;


    case "PROVEEDORES":
      // $('.proveeedores_man').fadeIn(0);
      // if (validarVista('VENDEDORES_COMISIONADOS'))//PERMISO PARA ENTRAR
      obtenerContenidoVendedores();
      break;

    case 'CONTACTOS_PROVEEDORES':


      break;

    // case "Servicios":
    //   obtenerContenidoServicios("servicios.php", "Servicios");
    //   break;
    // case "Segmentos":
    //   obtenerContenidoSegmentos("Segmentos");
    //   break;
    default: avisoArea(); break;
  }
  // }
}
