
$(tablePaquetesHTML).on('dblclick', 'tr', function (){
    if (!$("input[name='cantidad-paquete']").is(":focus")) {
      tablaContenidoPaquete.row( $(this)).remove().draw();
      if (tablaContenidoPaquete.data().count()) {
        calcularFilasTR()
      }
    }
});
