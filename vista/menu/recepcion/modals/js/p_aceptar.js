// Obtener datos del paciente seleccionado
var url_paciente = null;
const modalPacienteAceptar = document.getElementById('modalPacienteAceptar')
modalPacienteAceptar.addEventListener('show.bs.modal', event => {
  document.getElementById("title-paciente_aceptar").innerHTML = array_selected[1];
  document.getElementById("btn-confirmar-paciente").disabled = true;

  rellenarSelect('#select-paquetes','paquetes_api', 2,0,'DESCRIPCION')
})

$("#btn-obtenerID").click(function(){
  var folder = "identificacion/";
  $.ajax({
    url : "../../../api/archivos/imagen_paciente.php",
    type: "POST",
    data:{api:1},
    success: function (data) {
      data = jQuery.parseJSON(data);
      img = "identificacion/"+data[2];
      $("#image-perfil").attr("src",img);
      url_paciente = "https:bimo-lab.com/nuevo_checkup/vista/menu/recepcion/identificacion/"+data[2];
      document.getElementById("btn-confirmar-paciente").disabled = false;
    }
  });
})

$("#btn-confirmar-paciente").click(function(){
document.getElementById("btn-confirmar-paciente").disabled = true;
  $.ajax({
    url: "??",
    type: "POST",
    data:{
      id: array_selected['id_paciente'],
      url: url_paciente
    },
    success: function(data) {
      if (true) {
        Swal.fire({
          position: 'center',
          icon: 'success',
          title: 'Turno: @Turno',
          text: 'Generando credencial...',
          showCloseButton: false,
        })

      }
    },
  });
})
select2("#select-paquetes", "modalPacienteAceptar", 'Seleccione un paquete');
select2("#select-lab", "modalPacienteAceptar", 'Seleccione un estudio');
select2("#select-rx", "modalPacienteAceptar", 'Seleccione un estudio');
select2("#select-us", "modalPacienteAceptar", 'Seleccione un estudio');
select2("#select-otros", "modalPacienteAceptar", 'Seleccione un estudio');
