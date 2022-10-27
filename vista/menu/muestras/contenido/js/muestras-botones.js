






// cambiar fecha de la Lista
$('#fechaListadoLaboratorio').change(function(){
  dataListaPaciente = {api:5, fecha_busqueda: $(this).val(), area_id: 6}
  tablaMuestras.ajax.reload();
  // getPanelLab('Out', 0)
})
