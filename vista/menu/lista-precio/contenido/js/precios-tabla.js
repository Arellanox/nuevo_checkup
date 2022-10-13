// var data = 12;
var data ={api:2};
var apiurl = '../../../api/servicios_api.php';
var tablaPrecio = $("#TablaListaPrecios").DataTable({
  processing: true,
  language: {
    url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json",
    loadingRecords: '&nbsp;',
    processing: '<div class="spinner"></div>'
  },
  lengthMenu: [
    [10, 15, 20, 25, 30, 35, 40, 45, 50, -1],
    [10, 15, 20, 25, 30, 35, 40, 45, 50, "All"],
  ],
  columnDefs: [
    { width: "4%", targets: 0 },
    { width: "24%", targets: 1 },
    { width: "24%", targets: 2 },
    { width: "24%", targets: 3 },
    { width: "24%", targets: 4 },
  ],
  ajax: {
      dataType: 'json',
      data: function ( d ) {
         return  $.extend(d, data);
      },
      method: 'POST',
      url: apiurl,
      beforeSend: function() { loader("In") },
      complete: function(){ loader("Out"), tablaPrecio.processing( false ); },
      dataSrc:''
  },
  columns:[
      {data: 'COUNT'},
      {data: 'DESCRIPCION'},
      {
        data: 'COSTO', render: function (data, type, full, meta) {
            if (data == null || data == 0) {
              value = 0;
            }else{
              value = data;
            }
            rturn = '<div class="input-group"><span class="input-span">$</span><input type="number" class="form-control input-form costo" name="costo" placeholder="" value="'+value+'"></div>';

            return rturn;
          },
      },
      {
        data: 'UTILIDAD', render: function (data, type, full, meta) {
            if (data == null || data == 0) {
              value = 0;
            }else{
              value = data;
            }
            rturn = '<div class="input-group"><input type="number" class="form-control input-form margen" name="margen" placeholder="" value="'+value+'"><span class="input-span">%</span></div>';

            return rturn;
          },
      },
      {data: 'PRECIO_VENTA', render: function (data, type, full, meta) {
          if (data == null || data == 0) {
            value = 0;
          }else{
            value = data;
          }
          rturn = '<div class="total">$'+value+'</div>';

          return rturn;
        },},
      // {defaultContent: 'En progreso...'}
  ],
});


jQuery(document).on("change ,  keyup" , "input[name='costo'] , input[name='margen']" ,function(){
     var parent_element = jQuery(this).closest("tr");
     var costo = parseFloat(jQuery(parent_element).find("input[name='costo']").val());
     var margen = parseFloat(jQuery(parent_element).find("input[name='margen']").val());
     if( costo > 0 && margen > 0)
      {
        total = costo + (costo*margen/100);
        jQuery(parent_element).find(".total").html('<div class="total">$'+ total.toFixed(2) +'</div>');
      }
      else
      {
        jQuery(parent_element).find(".total").html('<div class="total">$0</div>');
      }
});

let tablaPrecios = new Array();

$('#btn-precios-guardar').click(function () {
        // var form_data  = tablaPrecio.rows().data();
        var costo = tablaPrecio.$("input[name='costo']").serialize();
        var margen = tablaPrecio.$("input[name='margen']").serialize();

        costo2 = costo.slice(6);
        console.log(costo2);

        let arraycosto = costo2.split('&costo=');

        margen2 = margen.slice(7);
        console.log(margen2);

        let arraymargen = margen2.split('&margen=');

        console.log(arraymargen);
        var tableData = tablaPrecio.rows().data().toArray();
        console.log(tableData);
        for (var i = 0; i < tableData.length; i++) {
          total = parseFloat(arraycosto[i]) + (parseFloat(arraycosto[i])*parseFloat(arraymargen[i])/100);
          const arrayFor = [tableData[i][0], parseFloat(arraycosto[i]), parseFloat(arraymargen[i]), total];
          tablaPrecios.push(arrayFor);
        }

        console.log(tablaPrecios);
        return false;
});

$('input[type=radio][name=selectChecko]').change(function() {
    if (this.value != 'Paq') {
      tablaPrecio.ajax.url( '../../../api/servicios_api.php' ).load();
      data.id_area = 12;
    }else{
      tablaPrecio.ajax.url( '../../../api/paquetes_api.php' ).load();
      data.api = 2;
      data.cliente_id = $('#seleccion-cliente').val();
    }
    tablaPrecio.ajax.reload();
});

$('#seleccion-cliente').on('change', function(){
  // tablaPrecio.ajax.url( '../../../api/paquetes_api.php' ).load();
  // data.api = 2;
  data.cliente_id = $(this).val();
  tablaPrecio.ajax.reload();
})
