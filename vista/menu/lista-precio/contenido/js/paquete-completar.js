

$('input[type=radio][name=selectChecko]').change(function() {


  rellenarSelect("#seleccion-estudio", "servicios_api", 2, 0, 'ABREVIATURA.DESCRIPCION', {'ID_SERVICIO' : this.value});

});


rellenarSelect("#seleccion-paquete", "paquetes_api", 2, 0, 'COUNT.DESCRIPCION', {'ID_SERVICIO' : '1'});




select2("#seleccion-paquete", "paq")
select2("#seleccion-estudio", "paq")
