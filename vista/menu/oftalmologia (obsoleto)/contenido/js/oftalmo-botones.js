

$("#btn-analisis-pdf").click(function () {
  if (array_selected != null) {
    $("#ModalSubirInterpretacion").modal("show");
  } else {
    alertSelectTable();
  }
});

$('#fechaListadoAreaMaster').change(function(){
  dataListaPaciente = {api:5, fecha_busqueda: $(this).val(), area_id: 3}
  tablaContenido.ajax.reload();
  // getPanel('.informacion-labo', '#loader-Lab', '#loaderDivLab',selectListaLab, 'Out')
})
