$.ajax({
  url: http+servidor+"/nuevo_checkup/api/"+api+".php",
  data:{id: id,api: 3},
  // beforeSend: function() { $('#info-php').fadeOut(800) },
  complete: function(){ $('#info-php').fadeIn(800) },
  type: "POST",
  success: function(data) {
    var data = jQuery.parseJSON(data);
    data = data['response']['data'];
    $('#nombre-persona').html(data[0]['NOMBRE']+" "+data[0]['PATERNO']+" "+data[0]['MATERNO']);
    $('#nacimiento-persona').html(formatoFecha(data[0]['NACIMIENTO'])+" | <span class='span-info'>"+data[0]['EDAD']+"</span> años")
    $('#info-paci-curp').html(data[0]['CURP']);
    $('#info-paci-telefono').html(data[0]['CELULAR']);
    $('#info-paci-correo').html(data[0]['CORREO']);
    $('#info-paci-sexo').html(data[0]['GENERO']);
    if (data[0]['TURNO']) {
      $('#info-paci-turno').html(data[0]['TURNO']);
    }else{
      $('#info-paci-turno').html('Sin generar');
    }
    $('#info-paci-directorio').html(data[0]['CALLE']+", "+data[0]['COLONIA']+", "+
    data[0]['MUNICIPIO']+", "+data[0]['ESTADO']);
  }
})
