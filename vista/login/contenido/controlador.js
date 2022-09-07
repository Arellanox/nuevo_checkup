// obtenerContenido o cambiar
obtenerContenido("login.php");
function obtenerContenido(tabla){
  $.post("contenido/"+tabla, function(html){
     $("#body-js").html(html);


     $("#formIniciarSesion").submit(function(){
        event.preventDefault();
        /*DATOS Y VALIDACION DEL REGISTRO*/
        var form = document.getElementById("formIniciarSesion");
        var formData = new FormData(form);
        formData.set('api', 6);
        $.ajax({
          data: formData,
          url: "../../api/usuarios_api.php",
          type: "POST",
          processData: false,
          contentType: false,
          success: function(data) {
            data = jQuery.parseJSON(data);
            console.log(data);
            if (mensajeAjax(data)) {
              window.location.href = '../menu/recepcion/index.php';
            }
          },
        });
     })
  });
}
