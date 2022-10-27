tablaMuestras = $('#TablaMuestras').DataTable({
  language: {
    url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
  },
  lengthChange: false,
  info: false,
  paging: false,
  scrollY: "55vh",
  scrollCollapse: true,
  ajax: {
      dataType: 'json',
      data: function (d) {
        return $.extend(d, dataListaPaciente);
      },
      method: 'POST',
      url: '../../../api/turnos_api.php',
      beforeSend: function() { loader("In") },
      complete: function(){
        loader("Out")
        loaderDiv("Out", null, "#loader-muestras", '#loaderDivmuestras', 0);
        $('.informacion-muestras').fadeOut()
      },
      dataSrc:'response.data'
  },
  createdRow: function( row, data, dataIndex ){
      if ( data.EDAD == 31 )
      {
          $(row).addClass('bg-warning');
      }
  },
  columns:[
      {
        data: 'ID_PACIENTE', render: function(data){
          return '';
        }
      },
      {data: 'NOMBRE_COMPLETO'},
      {data: 'PREFOLIO', render: function (data, type, full, meta) {
          return "20221014JMC412";
        },
      },
      {data: 'EDAD'},
      {data: 'EDAD'},
      // {defaultContent: 'En progreso...'}
  ],
  columnDefs: [
    { "width": "10px", "targets": 0 },
  ],

})

loaderDiv("Out", null, "#loader-muestras", '#loaderDivmuestras');
selectDatatable('TablaMuestras', tablaMuestras, 0, 0, 0, 0, function(selectTR = null, array = null){
  selectListaMuestras = array;
  if (selectTR == 1) {
    getPanel('.informacion-muestras', '#loader-muestras', '#loaderDivmuestras', selectListaMuestras, 'In', async function(divClass){
        await obtenerPanelInformacion(selectListaMuestras['ID_PACIENTE'], 'pacientes_api', 'paciente_lab')
        await obtenerListaEstudiosContenedores(selectListaMuestras['ID_PACIENTE'])
        console.log(divClass)
        $(divClass).fadeIn(100);
      });
  }else{
      getPanel('.informacion-muestras', '#loader-muestras', '#loaderDivmuestras',selectListaMuestras, 'Out')
  }
})

$("#BuscarTablaListaMuestras").keyup(function () {
  tablaMuestras.search($(this).val()).draw();
});

function obtenerListaEstudiosContenedores(idturno = null){return new Promise(resolve => {
    loaderDiv("Out", null, "#loader-muestras", '#loaderDivmuestras');
    resolve(1);
  });
}
