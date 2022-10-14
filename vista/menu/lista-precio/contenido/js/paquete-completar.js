

$('input[type=radio][name=selectChecko]').change(function() {


  rellenarSelect("#seleccion-estudio", "servicios_api", 2, 0, 'ABREVIATURA.DESCRIPCION', {'ID_SERVICIO' : this.value});

});


rellenarSelect("#seleccion-paquete", "paquetes_api", 2, 0, 'COUNT.DESCRIPCION', {'VACIOS' : '1'});




select2("#seleccion-paquete", "paq")
select2("#seleccion-estudio", "paq")


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
