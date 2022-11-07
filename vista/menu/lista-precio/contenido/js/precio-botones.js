select2('#seleccionar-cliente', 'divSeleccionCliente', 'Cargando lista de clientes...')
rellenarSelect('#seleccionar-cliente','clientes_api', 2,0,'NOMBRE_SISTEMA.NOMBRE_COMERCIAL');

$('#seleccionar-cliente').change(function(){
  obtenertablaListaPrecios(columnsDefinidas, columnasData, '../../../api/paquetes_api.php', {api:2, cliente_id: $(this).val()}, 'response.data')
})

select2('#seleccion-paquete', 'vista_paquetes-precios', 'Cargando lista de paquetes...')
rellenarSelect('#seleccion-paquete','paquetes_api', 2,0,'DESCRIPCION', {cliente_id: 1});



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


$('#btn-guardar-lista').click(function(){
  switch ($('input[type=radio][name=selectTipLista]:checked').val()) {
    case '1':
        console.log(getListaConcepto());
      break;
    case '2':
        console.log(getListaPrecios('ID_SERVICIO'))
      break;
    case '3':
        console.log(getListaPrecios('ID_PAQUETE'))
      break;
    default:
      alert('No a seleccionado ninguna opcion')

  }
})


$('input[type=radio][name=selectChecko]').change(function(){
  if ($(this).val() != 1) {
      obtenertablaListaPrecios(columnsDefinidas, columnasData, apiurl, {api:2, id_area: $(this).val()})
  }else{
      obtenertablaListaPrecios(columnsDefinidas, columnasData, apiurl, {api:2, otros_servicios: 1})
  }
})


$('input[type=radio][name=selectTipLista]').change(function(){
  switch ($(this).val()) {
    case '1':
        columnsDefinidas = obtenerColumnasTabla('1.1')
        columnasData = obtenerColumnasTabla('1.2')
        $('.vista_estudios-precios').fadeIn(100)
        $('#divSeleccionCliente').fadeOut(100)
      break;
    case '2':
        columnsDefinidas = obtenerColumnasTabla('2.1')
        columnasData = obtenerColumnasTabla('2.2')
        $('.vista_estudios-precios').fadeIn(100)
        $('#divSeleccionCliente').fadeIn(100)
      break;
    case '3':
        columnsDefinidas = obtenerColumnasTabla('3.1')
        columnasData = obtenerColumnasTabla('3.2')
        $('.vista_estudios-precios').fadeOut(100)
        $('#divSeleccionCliente').fadeIn(100)
        obtenertablaListaPrecios(columnsDefinidas, columnasData, '../../../api/paquetes_api.php', {api:2, cliente_id: 1}, 'response.data')
        return 1;
      break;
    default:
      confirm('Esta opcion no deberia verser, recargue la pagina y eliga una opción')
  }
  tablaPrecio.destroy();
  $('#TablaListaPrecios').empty();
  tablaPrecio = $("#TablaListaPrecios").DataTable({
    language: {
      url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json",
    },
    lengthChange: false,
    info: false,
    paging: false,
    columnDefs: columnsDefinidas
  });
  $('input[type=radio][name=selectChecko]:checked').prop('checked', false);
  // obtenertablaListaPrecios(columnsDefinidas, columnasData, apiurl)
})
