

$('input[type=radio][name=selectChecko]').change(function() {
    if (this.value == 4) {
      tablaPrecio.ajax.url( '../../../api/paquetes_api.php' ).load();
      data.api = 2;
      data.id_cliente = 1;
    }else{
      tablaPrecio.ajax.url( '../../../api/servicios_api.php' ).load();
      data.id_area = 12;
    }
    tablaPrecio.processing( true );
    tablaPrecio.ajax.reload();
    console.log(this.value);


});



rellenarSelect("#seleccion-paquete", "paquetes_api", 2, 0, 'DESCRIPCION');



select2("#seleccion-paquete", "paq")
select2("#seleccion-estudio", "paq")
