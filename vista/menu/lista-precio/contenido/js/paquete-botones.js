$('#agregar-estudio-paquete').click(function() {
  $.ajax({
    url: http + servidor + "/nuevo_checkup/api/servicios_api.php",
    type: "POST",
      dataType: 'json',
      data: { id: $('#seleccion-estudio').val(),api: 3 },
      success: function (data) {
            data = data.response.data[0];
            meterDato(data.DESCRIPCION, data.ABREVIATURA, data.COSTO, data.PRECIO_VENTA, data.ID_SERVICIO, data.ABREVIATURA, tablaPaquete);
        }
      }
    );
})

$('input[type="radio"][name="selectPaquete"]').change(function() {
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
  if ($(this).val() != 0) {
    rellenarSelect("#seleccion-estudio", "servicios_api", 8, 0, 'ABREVIATURA.DESCRIPCION', {'id_area' : this.value});
  }else{
    rellenarSelect("#seleccion-estudio", "servicios_api", 8, 0, 'ABREVIATURA.DESCRIPCION', {'otros_servicios' : 1});
  }
});

$('#guardar-contenido-paquete').on('click', function(){
  
})
