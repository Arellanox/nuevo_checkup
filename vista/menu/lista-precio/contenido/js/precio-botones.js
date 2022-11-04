
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


$('input[type=radio][name=selectChecko]').change(function(){
  obtenertablaListaPrecios(columnsDefinidas, columnasData, apiurl, {api:2, id_area: $(this).val()})
})


$('input[type=radio][name=selectTipLista]').change(function(){
  switch ($(this).val()) {
    case '1':
        $('.vista_estudios-precios').fadeIn(100)
        $('#divSeleccionCliente').fadeOut(100)
      break;
    case '2':
        $('.vista_estudios-precios').fadeIn(100)
        $('#divSeleccionCliente').fadeIn(100)
      break;
    case '3':
        $('.vista_estudios-precios').fadeOut(100)
        $('#divSeleccionCliente').fadeIn(100)
      break;
    default:

  }
  switch ($(this).val()) {
    case "1":
      columnsDefinidas = [
        { width: "5%", title: "#", targets: 0 },
        { width: "8%", title: "AB", targets: 1 },
        { width: "42%", title: "Nombre", targets: 2 },
        { width: "20%", title: "Costo", targets: 3 },
      ]
      columnasData = [
          {data: 'COUNT'},
          {data: 'ABREVIATURA'},
          {data: 'DESCRIPCION'},
          {
            data: 'COSTO',
            render: function (data, type, full, meta) {
                if (data == null || data == 0) {
                  value = 0;
                }else{
                  value = data;
                }
                rturn = '<div class="input-group"><span class="input-span">$</span><input type="number" class="form-control input-form costo" name="costo" placeholder="" value="'+value+'"></div>';

                return rturn;
            },
          },
      ]
    break;
    case "2":
      columnsDefinidas = [
        { width: "5%", title: "#", targets: 0 },
        { width: "8%", title: "AB", targets: 1 },
        { width: "38%", title: "Nombre", targets: 2 },
        { title: "Costo", targets: 3 },
        { width: "20%",title: "Utilidad", targets: 4 },
        { width: "20%",title: "Total", targets: 5 }
      ]
      columnasData = [
        {data: 'COUNT'},
        {data: 'ABREVIATURA'},
        {data: 'DESCRIPCION'},
        {
          data: 'COSTO',
          render: function (data, type, full, meta) {
              if (data == null || data == 0) {
                value = 0;
              }else{
                value = data;
              }
              rturn = '<div class="costo-paquete text-center">$'+value+'</div>';

              return rturn;
            },
        },
        {
          data: 'UTILIDAD',
          render: function (data, type, full, meta) {
              if (data == null || data == 0) {
                value = 0;
              }else{
                value = data;
              }
              rturn = '<div class="input-group"><input type="number" class="form-control input-form margen" name="margen" placeholder="" value="'+value+'"><span class="input-span">%</span></div>';

              return rturn;
            },
        },
        {
          data: 'PRECIO_VENTA',
          render: function (data, type, full, meta) {
            if (data == null || data == 0) {
              value = 0;
            }else{
              value = data;
            }
            rturn = '<div class="input-group"><span class="input-span">$</span><input type="number" class="form-control input-form total" name="margen" placeholder="" value="'+value+'"></div>';

            return rturn;
          },
        },
    ]
    break;
    case "3":
      columnsDefinidas = [
        { width: "5%", title: "#", targets: 0 },
        { title: "Paquete", targets: 1 },
        { width: "10%",title: "Costo", targets: 2 },
        { width: "18%",title: "Utilidad", targets: 3 },
        { width: "18%",title: "Total", targets: 4 }
      ]
      columnasData = [
        {data: 'COUNT'},
        {data: 'DESCRIPCION'},
        {
          data: 'COSTO',
          render: function (data, type, full, meta) {
              if (data == null || data == 0) {
                value = 0;
              }else{
                value = data;
              }
              rturn = '<div class="costo-paquete text-center">$'+value+'</div>';

              return rturn;
            },
        },
        {
          data: 'UTILIDAD',
          render: function (data, type, full, meta) {
              if (data == null || data == 0) {
                value = 0;
              }else{
                value = data;
              }
              rturn = '<div class="input-group"><input type="number" class="form-control input-form margen" name="margen" placeholder="" value="'+value+'"><span class="input-span">%</span></div>';

              return rturn;
            },
        },
        {
          data: 'PRECIO_VENTA',
          render: function (data, type, full, meta) {
            if (data == null || data == 0) {
              value = 0;
            }else{
              value = data;
            }
            rturn = '<div class="input-group"><span class="input-span">$</span><input type="number" class="form-control input-form total" name="margen" placeholder="" value="'+value+'"></div>';

            return rturn;
          },
        }
    ]
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
    columnDefs:columnsDefinidas,
  });
  $('input[type=radio][name=selectChecko]:checked').prop('checked', false);
  // obtenertablaListaPrecios(columnsDefinidas, columnasData, apiurl)
})
