$(document).on('click', '#omitir-paciente', function (e) {

    reiniciarVista();
    $('#contenedor-vista-query').fadeIn(1);


})


function reiniciarVista() {
    $('.contenedorMaster').fadeOut(1);
}