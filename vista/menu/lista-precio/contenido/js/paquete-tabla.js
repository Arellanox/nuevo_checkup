// // var data = 12;
// var data ={api:2};
// var apiurl = '../../../api/servicios_api.php';

let dataSet = [{
    'COUNT':  0,
    'DESCRIPCION': 0,
    'CVE':0,
    'CANTIDAD':1,
    'COSTO_TOTAL': 0,
    'PRECIO_VENTA':0,
    'SUBTOTAL': 0,
  }];

var tablaPaquete = $("#TablaListaPaquetes").DataTable({
  processing: true,
  data : dataSet,
  columns:[
    {data: 'COUNT'},
    {data: 'DESCRIPCION'},
    {data: 'CVE'},
    {data: 'CANTIDAD'},
    {data: 'COSTO_TOTAL'},
    {data: 'PRECIO_VENTA'},
    {data: 'SUBTOTAL'}
  ],
  language: {
    url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json",
    loadingRecords: '&nbsp;',
    processing: '<div class="spinner"></div>'
  },
  lengthMenu: [
    [10, 15, 20, 25, 30, 35, 40, 45, 50, -1],
    [10, 15, 20, 25, 30, 35, 40, 45, 50, "All"],
  // ],

  ]
});



$('#TablaListaPaquetes tbody').on('dblclick', 'tr', function () {
    datadbl = tablaClientes.row( this ).data();
    datadbl['COUNT']
});

function meterDato (DESCRIPCION,CVE,COSTO_TOTAL,PRECIO_VENTA){
let longitud = dataSet.length+1;
  dataSet.push({
    'COUNT':  longitud,
    'DESCRIPCION': DESCRIPCION,
    'CVE':CVE,
    'CANTIDAD':1,
    'COSTO_TOTAL': COSTO_TOTAL,
    'PRECIO_VENTA':PRECIO_VENTA,
    'SUBTOTAL': 0,
  })

    tablaPaquete.clear();
    tablaPaquete.rows.add(dataSet);
    tablaPaquete.draw();

}


$('#submit-completarPaquete').click(function() {


  $.ajax({
    url: http + servidor + "/nuevo_checkup/api/servicios_api.php",
    type: "POST",
      dataType: 'json',
      data: { id: $('#seleccion-estudio').val(),api: 3 },
      success: function (data) {
            console.log(data);
            data = data.response.data[0];
            meterDato(data.DESCRIPCION, data.ABREVIATURA, data.COSTO, data.PRECIO_VENTA);
        }
      }
    );
})