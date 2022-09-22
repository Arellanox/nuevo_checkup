$("#Buscarmetodo").click(function(){
  idMetodo = $('#select_metodos').val();
  text = $( "#select_metodos option:selected" ).text();
  if (idMetodo != "") {
    TablaMetodos.$('tr.selected').removeClass('selected');
    document.getElementById("edit-metodo-descripcion").value = text;
    var tr = selectedTrTable(text, 1, 'TablaMetodos')
    array_metodo = TablaMetodos.row( tr ).data();
    cambiarFormMetodo(1);
  }else{
    array_metodo = null;
    cambiarFormMetodo(0);
  }
})

$("#Limpiarmetodo").click(function(){
  TablaMetodos.$('tr.selected').removeClass('selected');
  array_metodo = null;
  cambiarFormMetodo(0)
})
