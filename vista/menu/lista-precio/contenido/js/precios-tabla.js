tablaPrecio = $("#TablaListaPrecios").DataTable({
  // processing: true,
  language: {
    url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json",
    // loadingRecords: '&nbsp;&nbsp;&nbsp;',
    // processing: '<div class="spinner"></div>'
  },
  lengthChange: false,
  info: false,
  paging: false,
  scrollY: "63vh",
  scrollCollapse: true,
  columnDefs: [
    { width: "5%", targets: 0 },
    { width: "5%", targets: 1 },
    { width: "50%", targets: 1 },
    { width: "30%", targets: 2 },
    // { width: "24%", targets: 3 },
    // { width: "24%", targets: 4 },
  ],
  ajax: {
      dataType: 'json',
      data: function ( d ) {
         return  $.extend(d, data);
      },
      method: 'POST',
      url: apiurl,
      beforeSend: function () {
        loaderDiv("In", "#contenido-lista-precios", "#loader-tabla-precios");
      },
      complete: function () {
        loaderDiv("Out",  "#contenido-lista-precios", "#loader-tabla-precios");
      },
      dataSrc:'response.data'
  },
  columns:[
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
      // {
      //   data: 'UTILIDAD',
      //   render: function (data, type, full, meta) {
      //       if (data == null || data == 0) {
      //         value = 0;
      //       }else{
      //         value = data;
      //       }
      //       rturn = '<div class="input-group"><input type="number" class="form-control input-form margen" name="margen" placeholder="" value="'+value+'"><span class="input-span">%</span></div>';
      //
      //       return rturn;
      //     },
      // },
      // {
      //   data: 'PRECIO_VENTA',
      //   render: function (data, type, full, meta) {
      //     if (data == null || data == 0) {
      //       value = 0;
      //     }else{
      //       value = data;
      //     }
      //     rturn = '<div class="total">$'+value+'</div>';
      //
      //     return rturn;
      //   },
      // },
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
