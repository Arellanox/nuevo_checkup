<div class="modal fade" id="ModalConsultarResultado" tabindex="-1" aria-labelledby="filtrador" aria-hidden="true" data-bs-backdrop="static">
  <div class="modal-dialog modal-md modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header header-modal">
        <h5 class="modal-title">Crear registro de laboratorio</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p class="text-center" >Utilice su <strong>PREFOLIO</strong>, <strong>CURP</strong> y seleccione la prueba a consultar.</p>
        <form id="formObtenerResultado">
            <div class="row">
                <div class="col-12">
                    <label for="procedencia" class="form-label">PREFOLIO</label>
                    <input type="text" name="prefolio" value="" class="form-control input-form" id="prefolio-consulta" required>
                </div>
                <div class="col-12">
                    <label for="procedencia" class="form-label">CURP</label>
                    <input type="text" name="curp" value="" class="form-control input-form" id="curp-consulta" required>
                </div>
                <div class="col-12">
                  <label for="segmento" class="form-label">Estudio</label>
                  <select name="segmento" id="estudio-consulta" class="input-form" required>
                    <option>Seleccione...</option>
                    <option value="">PSA</option>
                  </select>
                </div>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-cancelar" data-bs-dismiss="modal"><i class="bi bi-arrow-left-short"></i> Cancelar</button>
        <button type="submit" form="formObtenerResultado" class="btn btn-confirmar">
          <i class="bi bi-binoculars"></i> Consultar
        </button>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
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
</script>
