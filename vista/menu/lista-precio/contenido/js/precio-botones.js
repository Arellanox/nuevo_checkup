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
        let tablaPrecios = new Array();
        let url, api;
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
            const arrayFor = [tableData[i]['ID_SERVICIO'], parseFloat(arraycosto[i]), parseFloat(arraymargen[i]), total];
            tablaPrecios.push(arrayFor);
          }

          if ($('input[type=radio][name=selectChecko]').val() != 'Paq') {
            api = 1; url = 'precios_api';
          }else{

          }

          $.ajax({
            url: http + servidor + "/nuevo_checkup/api/"+url+".php",
            data: { api: api, precios: tablaPrecios },
            type: "POST",
            datatype: 'json',
            success: function (data) {

            }
          })


          // console.log()

          // console.log(tablaPrecios);
          return false;
        }, 50)
});

$('input[type=radio][name=selectChecko]').change(function() {
    if ($(this).val() != 'Paq') {
      tablaPrecio.ajax.url( '../../../api/servicios_api.php' ).load();
      data.id_area = $(this).val();
      data.cliente_id = null;
    }else{
        cargarpaquetes()
    }
    tablaPrecio.ajax.reload();
});

$('#seleccion-cliente').on('change', function(){
  cargarpaquetes()
})
