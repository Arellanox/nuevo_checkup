tablaCargosCuenta = $('#TablaListaCargos').DataTable({
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
          return $.extend(d, dataAjaxCargos);
        },
        method: 'POST',
        url: '../../../api/turnos_api.php',
        beforeSend: function() { 
            loaderDiv('In', '#TablaCargosVista', '#loader-EstadoCuenta', '#loaderDivEstadoCuenta', 0)
        },
        complete: function(){
            loaderDiv('Out', '#TablaCargosVista', '#loader-EstadoCuenta', '#loaderDivEstadoCuenta', 0)
            calcularEstudiosCargos()
        },
        dataSrc:'response.data'
    },
    createdRow: function( row, data, dataIndex ){
        if ( data.CONFIRMADO == 1 ){
          $(row).addClass('bg-success text-white');
        }else{
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
        {data: 'EDAD'},
        {data: 'EDAD'},
        {data: 'EDAD'},
        {data: 'EDAD'},
        {data: 'EDAD'},
        {data: 'EDAD'},
        {data: 'EDAD'},
        // {defaultContent: 'En progreso...'}
    ],
    columnDefs: [
    //   { "width": "10px", "targets": 0 },
    ],
    fixedColumns: true
  
  })

function calcularEstudiosCargos(){

}