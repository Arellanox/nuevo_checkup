$("#btn-perfil").click(function () {
  alert();
});

$("#seleccion-cliente").select2({
  tags: false,
  width: "50%",
  placeholder: "Selecciona un cliente",
});
rellenarSelect("#seleccion-cliente", "clientes_api", 2, 0, 1);


$('#btn-precios-guardar').click(function () {
  $('#btn-precios-guardar').prop('disabled', true)
  let tablaPrecios = new Array();
  let url, api, id;
  tablaPrecio.search('').draw();
  setTimeout(function(){
    // var form_data  = tablaPrecio.rows().data();
    var costo = tablaPrecio.$("input[name='costo']").serialize();
    var margen = tablaPrecio.$("input[name='margen']").serialize();

    costo2 = costo.slice(6);
    // console.log(costo2);

    let arraycosto = costo2.split('&costo=');

    margen2 = margen.slice(7);
    // console.log(margen2);

    let arraymargen = margen2.split('&margen=');

    // console.log(arraymargen);
    var tableData = tablaPrecio.rows().data().toArray();
    // console.log(tableData);
    for (var i = 0; i < tableData.length; i++) {
      total = parseFloat(arraycosto[i]) + (parseFloat(arraycosto[i])*parseFloat(arraymargen[i])/100);
      if ($('input[type=radio][name=selectChecko]:last').is(':checked')) {
        id = tableData[i]['ID_PAQUETE']
      }else{
        id = tableData[i]['ID_SERVICIO']
      }
      const arrayFor = [id, parseFloat(arraycosto[i]), parseFloat(arraymargen[i]), total];
      tablaPrecios.push(arrayFor);
    }
    if (tablaPrecios.length > 0) {
      if ($('input[type=radio][name=selectChecko]:last').is(':checked')) {
        api = 7; url = 'paquetes_api';
        // alert('Paquete')
        aviso = "Estudios actualizados"
      }else{
        api = 1; url = 'precios_api';
        aviso = "Paquetes actualizados";
        // alert('Estudios')
        // console.log($('#check-paquetes'))
        // console.log($('input[type=radio][name=selectChecko]'))
      }

      // console.log(tablaPrecios)
      //
      $.ajax({
        url: http + servidor + "/nuevo_checkup/api/"+url+".php",
        data: { api: api, contenedorListaPrecios: tablaPrecios },
        type: "POST",
        datatype: 'json',
        beforeSend: function(){
           alertMensaje('info', 'Espere un momento', 'El sistema esta guardando los datos...')
        },
        success: function (data) {
          data = jQuery.parseJSON(data);
          if (mensajeAjax(data)) {
            alertSelectTable(aviso, icon = 'success', timer = 2000)
          }
          $('#btn-precios-guardar').prop('disabled', false)
        },
        complete: function(){
          $('#btn-precios-guardar').prop('disabled', false)
        }
      })

      // console.log()

      // console.log(tablaPrecios);
    }else{
      alertSelectTable('No hay información en la tabla', 'error')
      $('#btn-precios-guardar').prop('disabled', false)
    }

    return false;
  }, 50)
});

$('input[type=radio][name=selectChecko]').change(function() {
    if ($(this).val() != 'Paq') {
      if ($(this).val() != 0) {
        tablaPrecio.ajax.url( '../../../api/servicios_api.php' ).load();
        data = {api:8, id_area: $(this).val()};
      }else{
        tablaPrecio.ajax.url( '../../../api/servicios_api.php' ).load();
        data = {api:8, otros_servicios: 1};
      }

    }else{
        cargarpaquetes()
    }
    tablaPrecio.ajax.reload();
});

$('#seleccion-cliente').on('change', function(){
  cargarpaquetes()
})
