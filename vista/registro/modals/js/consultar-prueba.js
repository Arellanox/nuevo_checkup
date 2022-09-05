
// Consulta de resultado
$("#formObtenerResultado").submit(function(event){
   event.preventDefault();
   /*DATOS Y VALIDACION DEL REGISTRO*/
   var form = document.getElementById("formObtenerResultado");
   var formData = new FormData(form);
   formData.set('api', 3);
   console.log(formData);

   $.ajax({
     data: formData,
     url: "??",
     type: "POST",
     processData: false,
     contentType: false,
     success: function(data) {
       data = jQuery.parseJSON(data);
       switch (data['codigo'] == 1) {
         case 1:
            // if(array['Resultado'] == "Negativo"){ resultado= "Negative"}else{resultado = "Positive"};
            if(array['Sexo'] == "MASCULINO" || array['Sexo'] == "Masculino"){ sexo= "Male"}else{sexo = "Female"};
            Swal.fire({
             html:
             '<div class="row">'+
               '<div class="col-12 d-flex justify-content-center">'+
                 '<img src="http://bimo-lab.com/archivos/sistema/bimo.png"  id="logo_empresa" style="width=100%"><img src="http://bimo-lab.com/archivos/sistema/hnsg.jpg"  id="logo_empresa" style="width=100%">'+
               '</div>'+
               '<div class="col-12  d-flex justify-content-center" style="margin-top: 10px">'+
                 '<img src="http://bimo-lab.com/archivos/sistema/check.png" alt="" width="15%">'+
               '</div>'+

               '<div class="col-12">'+
                 '<div class="row">'+
                   '<div class="col-12 d-flex justify-content-center">'+
                     '<strong>¡El resultado de su prueba está listo!</strong>'+
                   '</div>'+
                   '<div class="col-12 d-flex justify-content-center">'+
                     'Test result'+
                   '</div>'+
                 '</div>'+
               '</div>'+

               '<div class="col-12" style="margin-top: 5px">'+
                 '<div class="row">'+
                   '<div class="col-12 d-flex justify-content-center">'+
                     '<strong>Nombre/ </strong>Name:'+
                   '</div>'+
                   '<div class="col-12 d-flex justify-content-center">'+
                     array['Nombre']+
                   '</div>'+
                 '</div>'+
               '</div>'+

               '<div class="col-12" style="margin-top: 5px">'+
                 '<div class="row">'+
                   '<div class="col-12 d-flex justify-content-center">'+
                     '<strong>Fecha de nacimiento/ </strong>Birth date:'+
                   '</div>'+
                   '<div class="col-12 d-flex justify-content-center">'+
                     array['Nacimiento']+
                   '</div>'+
                 '</div>'+
               '</div>'+

               '<div class="col-12" style="margin-top: 5px">'+
                 '<div class="row">'+
                   '<div class="col-6 ">'+
                     '<div class="row">'+
                       '<div class="col-12 d-flex justify-content-center">'+
                         '<strong>Edad/</strong>Age'+
                       '</div>'+
                       '<div class="col-12 d-flex justify-content-center">'+
                         array['Edad']+' años/ age'+
                       '</div>'+
                     '</div>'+
                   '</div>'+
                   '<div class="col-6 ">'+
                     '<div class="row ">'+
                       '<div class="col-12 d-flex justify-content-center">'+
                         '<strong>Sexo/ </strong>Gender:'+
                       '</div>'+
                       '<div class="col-12 d-flex justify-content-center">'+
                         array['Sexo']+'/ '+sexo+
                       '</div>'+
                     '</div>'+
                   '</div>'+
                 '</div>'+
               '</div>'+

               '<div class="col-12" style="margin-top: 5px">'+
                 '<div class="row">'+
                   '<div class="col-12 d-flex justify-content-center">'+
                     '<strong>Estudio realizado/ </strong>Test:'+
                   '</div>'+
                   '<div class="col-12 d-flex justify-content-center">'+
                     array['Estudio']+
                   '</div>'+
                 '</div>'+
               '</div>'+

               '<div class="col-12" style="margin-top: 5px">'+
                 '<div class="row" style="background-color: #B9B9B9;">'+
                   '<div class="col-12 d-flex justify-content-center">'+
                     '<strong>Resultado/ </strong>Result:'+
                   '</div>'+
                   '<div class="col-12 d-flex justify-content-center">'+
                     '<strong>'+array['Resultado']+'/ </strong>' + resultado+
                   '</div>'+
                 '</div>'+
               '</div>'+

               '<div class="col-12" style="margin-top: 15px">'+
                 '<div class="row">'+
                   '<div class="col-12 d-flex justify-content-center">'+
                     '<strong>Fecha de toma de muestra/ </strong>Collected:'+
                   '</div>'+
                   '<div class="col-12 d-flex justify-content-center">'+
                     array['Tomado']+
                   '</div>'+
                 '</div>'+
               '</div>'+

               '<div class="col-12" style="margin-top: 15px">'+
                 '<div class="row">'+
                   '<div class="col-12 d-flex justify-content-center">'+
                     '<strong>Fecha de resultado/ </strong>Reported:'+
                   '</div>'+
                   '<div class="col-12 d-flex justify-content-center">'+
                     array['FResultado']+
                   '</div>'+
                 '</div>'+
               '</div>'+

               '<div class="col-12" style="margin-top: 20px;margin-bottom: 20px">'+
                   '<div class="d-grid gap-2 col-6 mx-auto">'+
                     array['PDF']+
                   '</div>'+
               '</div>'+
             '</div>',
             showCloseButton: true,
           });
         break;
         default:
           Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: 'Hubo un problema!',
              footer: 'Reporte este error con el personal :)'
           })
       }
     },
   });
   event.preventDefault();
 });
