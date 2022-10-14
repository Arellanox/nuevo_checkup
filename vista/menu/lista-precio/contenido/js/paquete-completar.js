

$('input[type=radio][name=selectChecko]').change(function() {


  rellenarSelect("#seleccion-estudio", "servicios_api", 2, 0, 'ABREVIATURA.DESCRIPCION', {'id_area' : this.value});

});


$('#form-select-paquetes').addClass("disable-div");

$('input[type="radio"][name="selectPaquete"]').change(function(){

  $('#form-select-paquetes').removeClass("disable-div");
  switch ($(this).val()) {
    case 1:

    break;
    case 2:

    break;
    default:

  }
})
