tablaPaquete = $("#TablaListaPaquetes").DataTable({
  lengthChange: false,
  info: false,
  paging: false,
  scrollY: "63vh",
  scrollCollapse: true,
  columnDefs: [
    { width: "213.266px", targets: 0},
    { width: "80.75px", targets: 1},
    { width: "90.516px", targets: 2 },
    { width: "80.8438px", targets: 3 },
    { width: "102.484px", targets: 4 },
    { width: "99.344px", targets: 5 },
    { width: "64.75px", targets: 6 },
    { visible: false, targets: 7, searchable: false, },
  ],
  language: {
    url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json",
  },
});

$('#TablaListaPaquetes tbody').on('dblclick', 'tr', function (){
    if (!$("input[name='cantidad-paquete']").is(":focus")) {

      // let datadbl = tablaPaquete.row( this ).data();
      //
      // // console.log(datadbl)
      // if (dataSet.indexOf(datadbl['LIST'])) {
      //   console.log(datadbl);
      //   dataSet = dataSet.filter(item => item.LIST != datadbl['LIST'])
      //   cargarTabla(dataSet);
      //   // alert('Eliminado '+datadbl['DESCRIPCION'])
      // }
      tablaPaquete.row( $(this)).remove().draw();
      calcularFilasTR()
    }
});
