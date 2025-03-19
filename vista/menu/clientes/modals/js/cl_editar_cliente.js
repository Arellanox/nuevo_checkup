let countFormStep = 0;

const btnStepBack = $(".btn-form-setps-back");
const btnStepNext = $(".btn-form-setps-next");
const btnStepCancel = $(".btn-form-cancel");
const btnSubmit = $(".submit-formulario-modal");

// Agrupar los paneles en un array para manejarlos mejor
const panels = [$(".panel-step-0"), $(".panel-step-1"), $(".panel-step-2"), $(".panel-step-3")];

// Eventos para los botones de navegación
btnStepBack.on('click', function () { actualizarPasosForm(-1); });
btnStepNext.on('click', function () { actualizarPasosForm(1); });

// Al abrir el modal, carga los datos
const ModalActualizarCliente = document.getElementById("ModalActualizarCliente");
ModalActualizarCliente.addEventListener("show.bs.modal", async () => { await cargarDatos(); });
ModalActualizarCliente.addEventListener("hide.bs.modal", () => { restablecerPasosForm(); });

// Formulario
const formularioActualizarCliente = document.getElementById("formActualizarCliente");

formularioActualizarCliente.addEventListener("submit", function(event) {
    event.preventDefault();

    if (!validarFormulario()) {
        return;
    }

    const formData = new FormData(formularioActualizarCliente);
    formData.set('id_cliente', array_selected['ID_CLIENTE']);
    formData.set('api', 3);

    Swal.fire({
        title: "¿Está seguro que todos los datos están correctos?",
        text: "¡Verifique los nuevos datos antes de continuar!",
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

                        formularioActualizarCliente.reset();
                        $("#ModalActualizarCliente").modal("hide");

                        tablaClientes.ajax.reload();
                    }
                }
            });
        }
    });
});

// Carga de datos en los inputs del modal
async function cargarDatos() {
    await rellenarSelect('#select-cfdi-editar', 'cfdi_api', 1, 'ID_CFDI', 'CLAVE.DESCRIPCION');
    await rellenarSelect('#selectRegimenFiscal-editar', 'sat_regimen_api', 1, 'ID_REGIMEN', 'CLAVE.REGIMEN_FISCAL');
    cargarDireccionEstadosSelect('estado_fiscal');

    const campos = {
        "#nombre_cliente": "NOMBRE_COMERCIAL",
        "#razon_social": "RAZON_SOCIAL",
        "#nombre_sistema": "NOMBRE_SISTEMA",
        "#rfc_cliente": "RFC",
        "#curp_cliente": "CURP",
        "#abreviatura_cliente": "ABREVIATURA",
        "#limite_credito_cliente": "LIMITE_CREDITO",
        "#cuenta_contable_cliente": "CUENTA_CONTABLE",
        "#tiempo_credito_cliente": "TEMPORALIDAD_DE_CREDITO",
        "#pagina_web": "PAGINA_WEB",
        "#facebook": "FACEBOOK",
        "#instagram": "INSTAGRAM",
        "#twitter": "TWITTER",
        "#codigo": "CODIGO",
        "#tipo_contribuyente": "TIPO_CONTRIBUYENTE",
        "#calle_fiscal": "CALLE",
        "#numero_exterior": "NUMERO_EXTERIOR",
        "#numero_interior": "NUMERO_INTERIOR",
        "#codigo_postal": "CODIGO_POSTAL",
        "#colonia_fiscal": "COLONIA",
        "#estado_fiscal": "ESTADO",
        "#municipio_fiscal": "MUNICIPIO",
        "#referencia_direccion": "REFERENCIAS",
        "#correo_fiscal": "CORREO_ELECTRONICO",
        "#lada_numero_fiscal": "TELEFONO_LADA",
        "#numero_fiscal": "TELEFONO",
        "#comentarios_cliente": "COMENTARIOS",
    };

    console.log('hola')
    Object.entries(campos).forEach(([id, key]) => {
        $(id).val(array_selected[key] || "");
    });

    $('#selectRegimenFiscal-editar').val(array_selected["REGIMEN_ID"]).trigger('change');
    $('#select-cfdi-editar').val(array_selected["CFDI_ID"]);
    $('#selectConvenio-editar').val(array_selected["CONVENIO_ID"]);

    mostrarPDF("#visualizar_pdf_situacion_fiscal", array_selected["PDF_CIF"]);
    mostrarPDF("#visualizar_pdf_convenios", array_selected["PDF_CONVENIO"]);
    mostrarPDF("#visualizar_pdf_lista_precios", array_selected["PDF_LISTA_PRECIOS"]);

}

function mostrarPDF(selector, url) {
    if (url) {
        $(selector).removeClass('hidden').attr("href", current_url + url);
    }else{
        $(selector).addClass('hidden').attr("href", current_url + url);
    }
}

// Validación de formulario
function validarFormulario(formId = "formActualizarCliente") {
    let form = document.getElementById(formId);
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
        Toast.fire({icon: "warning", title: "Falta completar los campos: <i>" + errores.join("</i>, "), timer: 2000});
        return false;
    }

    return true;
}

// Control de pasos en el modal
function actualizarPasosForm(stepChange) {
    countFormStep += stepChange;

    if (countFormStep < 0) countFormStep = 0;
    if (countFormStep >= panels.length) countFormStep = panels.length - 1;

    // Ocultar todos los paneles y mostrar solo el actual
    panels.forEach(panel => panel.addClass('hidden'));
    panels[countFormStep].removeClass('hidden').fadeIn(200);

    // Mostrar u ocultar botones según el paso
    btnStepBack.toggleClass('hidden', countFormStep === 0);
    btnStepCancel.toggleClass('hidden', countFormStep !== 0);
    btnStepNext.toggleClass('hidden', countFormStep === panels.length - 1);
    btnSubmit.toggleClass('hidden', countFormStep !== panels.length - 1);
}

// Restablecer los pasos cuando se cierra el modal
function restablecerPasosForm() {
    countFormStep = 0;
    actualizarPasosForm(0);
}