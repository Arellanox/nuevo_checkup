$("#Buscarmetodo").click(function(){
  idMetodo = $('#select_metodos').val();
  text = $( "#select_metodos option:selected" ).text();
  // alert(text);
  if (idMetodo != "") {
    TablaMetodos.$('tr.selected').removeClass('selected');
    document.getElementById("edit-metodo-descripcion").value = text;

    filter = text.toUpperCase();
    tablesearch = document.getElementById("TablaMetodos");
    tr = tablesearch.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++) {
      td = tr[i].getElementsByTagName("td")[1];
      if (td) {
        txtValue = td.textContent || td.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
          tr[i].classList.add("selected");
        }
      }
    }


    cambiarFormMetodo(1);
  }else{
    cambiarFormMetodo(0);
  }
})

$("#Limpiarmetodo").click(function(){
  TablaMetodos.$('tr.selected').removeClass('selected');
  cambiarFormMetodo(0)
})
