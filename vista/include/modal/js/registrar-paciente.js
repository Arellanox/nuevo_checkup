const modalRegistrarPaciente = document.getElementById('ModalRegistrarPaciente')
modalRegistrarPaciente.addEventListener('show.bs.modal', event => {
  getProcedencias("listProcedencia");
  var procedencia = $("#listProcedencia option:selected").val();
  getSegmentoByProcedencia(procedencia, "segmentos_procedencias-menu");
})
// Lista de segmentos dinamico
$('#listProcedencia').on('change', function() {
  var procedencia = $("#listProcedencia option:selected").val();
  getSegmentoByProcedencia(procedencia, "segmentos_procedencias-menu");
});

//Formulario de Preregistro
$("#formRegistrarPaciente").submit(function(event){
   event.preventDefault();
   /*DATOS Y VALIDACION DEL REGISTRO*/
   var form = document.getElementById("formRegistrarPaciente");
   var formData = new FormData(form);
   formData.set('api', 1);
   console.log(formData);
   $i=0;
   formData.forEach(element => {
    console.log($i + element);
    $i++;
  });
   Swal.fire({
      title: '¿Está seguro que todos sus datos estén correctos?',
      text: "¡No podrá editar o volverse a registrar!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Si, registrame',
      cancelButtonText: "Cancelar"
    }).then((result) => {
      if (result.isConfirmed) {
        $("#btn-registrarse").prop('disabled', true);

        // Esto va dentro del AJAX
        $.ajax({
          data: formData,
          url: "../../../api/pacientes_api.php",
          type: "POST",
          processData: false,
          contentType: false,
          success: function(data) {
            data = jQuery.parseJSON(data);
            if (mensajeAjax(data)) {
              Toast.fire({
                icon: 'success',
                title: 'Su información a sido registrada :)',
                timer: 2000


              });
              document.getElementById("formRegistrarPaciente").reset();
              $("#ModalRegistrarPaciente").modal('hide');
            }
          },
        });
      }
    })
   event.preventDefault();
 });

$("#vacuna").change(function(){  
  var seleccion =$("#vacuna").val(); 
  if (seleccion.toUpperCase() =='OTRA'){
    $("#vacunaExtra").prop('readonly', false);
  }else{

    $("#vacunaExtra").prop('readonly', true);
    $("#vacunaExtra").prop('value', "NA");
    } 
});
