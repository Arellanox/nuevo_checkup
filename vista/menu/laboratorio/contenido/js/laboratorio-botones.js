



// cambiar fecha de la Lista
$('#fechaListadoLaboratorio').change(function(){
  
  dataListaPaciente.fecha = $(this).val();
  tablaListaPaciente.ajax.reload();
})
