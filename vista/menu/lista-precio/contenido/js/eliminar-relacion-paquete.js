// eliminar un cliente del paquete
$('.listaClientesPaquetes').on('click', function(){
    
    ajaxAwait({
        id_paquete: $('#seleccion-paquete').val(),
        cliente_id: $(this).data('bs-id'),
        api: 13
    }, 'paquetes_api', { callbackAfter: true, WithoutResponseData: true }, false, function(data){
        alertToast('¡Eliminado!', 'success', 4000)
        ajaxAwait({
            api: 12,
            id_paquete: $('#seleccion-paquete').val()
          }, "paquetes_api", { callbackAfter: true, WithoutResponseData: true }, false, function(d){
          
            $('#listaAsignada').html(mostrarClientesAsignados(d));
            $.getScript('contenido/js/eliminar-relacion-paquete.js')
      
          });
    });
})

$('#filtroClientes').on('input', function() {
    var filtro = $(this).val().toLowerCase(); // Obtener el texto del filtro en minúsculas
    
    // Iterar sobre los elementos con clase 'cliente'
    $('#listaAsignada .cliente').each(function() {
      var nombreCliente = $(this).find('label').text().toLowerCase(); // Obtener el texto del cliente
      
      // Comprobar si el nombre del cliente contiene el texto del filtro
      if (nombreCliente.includes(filtro)) {
        $(this).removeClass('hidden'); // Mostrar si coincide
      } else {
        $(this).addClass('hidden'); // Ocultar si no coincide
      }
    });
});