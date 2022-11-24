// Metodos para rellenar el DOM
function obtenerAntecedentes(div){ //Sin usar
  return new Promise(resolve => {
    $.post(http + servidor + "/nuevo_checkup/vista/include/acordion/antecedentes-paciente.php", function (html) {
      $(div).html(html);
    }).done(function(){
      // alert("Done post")
      resolve(1);
    });

  });
}

function obtenerNotasHistorial(id){
  return new Promise(resolve => {
    $.ajax({
      url: http + servidor + "/nuevo_checkup/api/notas_historia_api.php",
      type: "POST",
      dataType: "json",
      data: { id_paciente: id, api: 2 },
      success: function (data) {
        console.log(data);
        var event = new Date();
        var options = { hours: 'numeric', minutes: 'numeric', weekday: 'long', year: 'numeric', month: 'short', day: 'numeric'};
        // ACTIVO: "1"
        // ID_NOTA: "2"
        // NOTAS: "nota historial Luisa"
        // TURNO_ID: "59"
        let row = data.response.data;
        for (let i = 0; i < row.length; i++) {
          agregarNotaConsulta('@Usuario actual', event.toLocaleDateString('es-ES', options), row[i]['NOTAS'], '#notas-historial', row[i]['ID_NOTA'])
        }
      },
      complete:function(){
        resolve(1);
      }
    });
  });

}

function consultarConsulta(id){ return new Promise(resolve => {
    $.ajax({
      url: http + servidor + "/nuevo_checkup/api/consulta_api.php",
      type: "POST",
      data: { turno_id: id, api: 2 },
      dataType: "json",
      success: function (data) {
        let row = data.response.data
        for (let i = 0; i < row.length; i++) {
          if (row[i]['COMPLETADO'] == null) {
            $('#btn-ir-consulta').html('<button type="button" onclick="obtenerContenidoConsulta(pacienteActivo.array, '+row[i]['ID_CONSULTA']+')" class="btn btn-hover me-2" style="margin: 15px 60px 10px 60px !important;font-size: 21px;"> <i class="bi bi-clipboard-heart"></i> Continuar consulta </button>')
          }
        }
      },
      complete:function(){
        resolve(1);
      }
    });
  })
}

function obtenerHistorialConsultas(id){
  return new Promise(resolve => {
    $.ajax({
      url: http + servidor + "/nuevo_checkup/api/turnos_api.php",
      type: "POST",
      dataType: "json",
      data: { id: id, api: 7 },
      success: function (data) {
        $('#historial-consultas-paciente').html('')
        let fecha = '01 Sep 2022';
        let nombre = 'Nombre medico';
        let motivo = 'motivo consulta';


        for (var i = 0; i < 5; i++) {
          $('#historial-consultas-paciente').append('<div class="row line-top" style="margin:0px">'+
                                                    '<div class="col-3 line-right">'+ fecha +'</div>'+
                                                    '<div class="col-9"><p>'+ nombre +'</p> <p>'+ motivo +'</p>'+
                                                    '</div> </div>')
        }



      },
      complete:function(){
        resolve(1);
      }
    });
  });
}
