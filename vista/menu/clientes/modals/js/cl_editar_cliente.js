//Controlar paneles del form del modal
let countFormStep = 0;
const btnStepBack = $(".btn-form-setps-back");
const btnStepNext = $(".btn-form-setps-next");
const btnStepCancel = $(".btn-form-cancel");
const btnSubmit = $(".submit-formulario-modal");

const panel0 = $(".panel-step-0");
const panel1 = $(".panel-step-1");
const panel2 = $(".panel-step-2");
const panel3 = $(".panel-step-3");

btnStepBack.on('click', function () { actualizarPasosForm(-1); });
btnStepNext.on('click', function () { actualizarPasosForm(1); });

const ModalActualizarCliente = document.getElementById("ModalActualizarCliente");
ModalActualizarCliente.addEventListener("show.bs.modal", (event) => { cargarDatos().then(r => {}) });
ModalActualizarCliente.addEventListener("hide.bs.modal", (event) => { restablecerPasosForm(); });

const formularioActualizarCliente = document.getElementById("formActualizarCliente");
formularioActualizarCliente.addEventListener("submit", function(event) {
    if (!validarFormulario()) {
      event.preventDefault();
      return;
    }

    const form = document.getElementById("formActualizarCliente");
    const formData = new FormData(form);
    formData.set('id_cliente', array_selected['ID_CLIENTE']);
    formData.set('api', 3);

    Swal.fire({
        title: "¿Está seguro que todos los datos están correctos?",
        text: "¡Verifique los Nuevos datos antes de continuar!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Aceptar",
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                data: formData,
                url: "../../../api/clientes_api.php",
                type: "POST",
                processData: false,
                contentType: false,
                success: function (data) {
                    data = jQuery.parseJSON(data);
                    if (mensajeAjax(data)) {
                        Toast.fire({icon: "success", title: "Datos de Cliente Actualizados Correctamente!", timer: 2000});

                        //document.getElementById("formActualizarCliente").reset();
                        $('#formActualizarCliente').reset();
                        $("#ModalActualizarCliente").modal("hide");

                        tablaClientes.ajax.reload();
                    }
                }
            });
        }
    });
});

//Cargado/Rellenado de datos en los inputs del modal
async function cargarDatos() {
    await rellenarSelect('#select-cfdi-editar', 'cfdi_api', 1, 'ID_CFDI', 'CLAVE.DESCRIPCION')
    await rellenarSelect('#selectRegimenFiscal-editar', 'sat_regimen_api', 1, 'ID_REGIMEN', 'CLAVE.REGIMEN_FISCAL');
    cargarDireccionEstadosSelect('estado_fiscal');

    $("#nombre_cliente").val(array_selected["NOMBRE_COMERCIAL"]);
    $("#razon_social").val(array_selected["RAZON_SOCIAL"]);
    $("#nombre_sistema").val(array_selected["NOMBRE_SISTEMA"]);
    $("#rfc_cliente").val(array_selected["RFC"]);
    $("#curp_cliente").val(array_selected["CURP"]);
    $("#abreviatura_cliente").val(array_selected["ABREVIATURA"]);
    $("#limite_credito_cliente").val(array_selected["LIMITE_CREDITO"]);
    $("#cuenta_contable_cliente").val(array_selected["CUENTA_CONTABLE"]);
    $("#tiempo_credito_cliente").val(array_selected["TEMPORALIDAD_DE_CREDITO"]);
    $("#pagina_web").val(array_selected["PAGINA_WEB"]);
    $("#facebook").val(array_selected["FACEBOOK"]);
    $("#instagram").val(array_selected["INSTAGRAM"]);
    $("#twitter").val(array_selected["TWITTER"]);
    $("#codigo").val(array_selected["CODIGO"]);

    $('#selectRegimenFiscal-editar').val(array_selected["REGIMEN_ID"]);
    $('#select-cfdi-editar').val(array_selected["CFDI_ID"]);
    $('#selectConvenio-editar').val(array_selected["CONVENIO_ID"])
}

function validarFormulario() {
  let form = document.getElementById("formActualizarCliente");
  let camposRequeridos = form.querySelectorAll("[required]");
  let errores = [];

  camposRequeridos.forEach(campo => {
    if (!campo.value.trim()) {
      let label = document.querySelector(`label[for=${campo.id}]`);
      let nombreCampo = label ? label.innerText : campo.name;
      errores.push(nombreCampo);
    }
  });

  if (errores.length > 0) {
    Toast.fire({icon: "warning", title: "Falta completar los campos: <i>"+'\n'+errores.join("</i>, "), timer: 2000});
    return false;
  }

  return true;
}

//Controlar paneles del form del modal
function actualizarPasosForm(number){
    countFormStep += number;

    switch (countFormStep) {
        case 0:
            ocultarPanelesForm();
            btnStepBack.addClass('hidden');
            btnStepCancel.removeClass('hidden');
            panel0.removeClass('hidden');
          break;
        case 1:
            ocultarPanelesForm();
            btnStepCancel.addClass('hidden');
            btnStepBack.removeClass('hidden');
            panel1.removeClass('hidden');
          break;
        case 2:
            ocultarPanelesForm();
            btnSubmit.addClass('hidden');
            panel2.removeClass('hidden');
            btnStepNext.removeClass('hidden');
          break;
        default:
            ocultarPanelesForm();
            btnStepNext.addClass('hidden');
            btnSubmit.removeClass('hidden');
            panel3.removeClass('hidden');
          break;
    }
}

function restablecerPasosForm(){
  ocultarPanelesForm()
  countFormStep = 0;
  btnStepBack.addClass('hidden');
  btnSubmit.addClass('hidden');
  btnStepNext.removeClass('hidden');
  btnStepCancel.removeClass('hidden');
  panel0.removeClass('hidden');
}

function ocultarPanelesForm(){
    panel0.addClass('hidden');
    panel1.addClass('hidden');
    panel2.addClass('hidden');
    panel3.addClass('hidden');
}