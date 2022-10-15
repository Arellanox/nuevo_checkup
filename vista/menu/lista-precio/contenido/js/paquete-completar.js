
  function mantenimientoPaquete(){
    rellenarSelect('#seleccion-paquete','paquetes_api', 2,0,'DESCRIPCION');
  }

    function contenidoPaquete(){
    rellenarSelect('#seleccion-paquete','paquetes_api', 5,0,'DESCRIPCION');
  }


$('input[type="radio"][name="selectPaquete"]').change(function() {
console.log(this.value);
switch ($(this).val()) {
 case '1':
   contenidoPaquete();
break;
case '2':
  mantenimientoPaquete();
break;

}
});




$('input[type=radio][name=selectChecko]').change(function() {
  rellenarSelect("#seleccion-estudio", "servicios_api", 8, 0, 'ABREVIATURA.DESCRIPCION', {'id_area' : this.value});

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
