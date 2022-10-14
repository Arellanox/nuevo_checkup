

$('input[type=radio][name=selectChecko]').change(function() {


  rellenarSelect("#seleccion-estudio", "servicios_api", 2, 0, 'ABREVIATURA.DESCRIPCION', {'id_area' : this.value});

});



$('input[type="radio"][name="selectPaquete"]').change(function(){

  switch ($(this).val()) {
    case 1:

    break;
    case 2:

    break;
    default:

  }
})

select2('#seleccion-paquete', 'form-select-paquetes')
select2('#seleccion-estudio','form-select-paquetes')
