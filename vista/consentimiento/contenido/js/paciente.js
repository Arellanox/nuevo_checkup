// ----------- Formulario, Botones y PDF -----------------------------------
let paciente_data; // <-- aqui se guarda un array con toda la informacion del paciente
$(document).ready(function () {
    ContruirPagina()
});

// Escucha el boton "Enviar firma"
$(document).on("click", "#enviar_firma_btn", function () {

    // Valida el canva si esta vacio manda una alerta
    if (!validarFormulario())
        return false;

    // Se le manda un mensaje de alerta al usuario ya que no podra realizar esta accion una vez se envie
    alertMensajeConfirm({
        title: '¿Ha realizado su firma correctamente?',
        text: 'Una vez envie su firma no podra volver a realizar esta acción',
        icon: 'warning',
        confirmButtonText: 'Si, estoy seguro',
        cancelButtonText: 'No'
    }, () => {
        // Se manda a llamar al metodo para enviar la firma
        enviar_firma();
    }, 1)

})

/* ----------------------------------------------------------------- */

/* --------------- Funciones ------------------------------------ */

// Function para construir todo la pagina
function ContruirPagina() {
    firma_exist = false;
    ajaxAwait({
        api: 1,
        turno_id: turno_id
    }, 'consentimiento_api', { callbackAfter: true }, false, async (data) => {
        let row = data.response.data;
        // Se recorre el array para acceder a los datos
        paciente_data = row[0];


        // Se construye el header con la informacion del paciente
        await rellenarInformacionPaciente();

        // Se construye los cuerpos de los consentimiento por cada area si es que manda mas de una
        await construiBodyConsentimiento();

        // Se valida si la firma ya existe
        validar_si_existe_firma();
    })
}

// Function para rellenar la informacion del paciente en el header
async function rellenarInformacionPaciente() {
    return new Promise(function (resolve, reject) {
        let header_div = $("#header_paciente");


        let HTML = `
            <div class="col-12">
                <p class="" id="nombre-persona">${paciente_data.NOMBRE_PACIENTE} </p>
                <p class="none-p "> <strong id="edad-persona" class="none-p">${paciente_data.EDAD}</strong> años | <strong id="nacimiento-persona" class="none-p">${paciente_data.NACIMIENTO}</strong> </p>
            </div>

            <div class="col-12 row mt-3">
                <div class="col-12 col-md-12 col-lg-auto">
                    <p class="none-p" id="nacimiento-paciente-consulta">Procedencia:</p>
                    <p class="info-detalle-p">${paciente_data.PROCEDENCIA}</p>
                </div>
                <div class="col-12 col-md-12 col-lg-auto">
                    <p class="none-p" id="genero-paciente-consulta">Teléfono:</p>
                    <p class='info-detalle-p'>
                        ${paciente_data.TELEFONO} </p>
                </div>
                <div class="col-12 col-md-12 col-lg-auto">
                    <p class="none-p" id="correo-paciente-consulta">Correo:</p>
                    <p class='info-detalle-p'>
                        ${paciente_data.CORREO}</p>
                </div>
            </div>
            `;

        header_div.html(HTML);

        resolve(1)
    })
}

// Function para construir el cuerpo de cada consentimiento por area, si es que existe mas de una
async function construiBodyConsentimiento() {
    return new Promise(function (resolve, reject) {
        let div = $("#texto_consentimiento") // <-- contenedor de todo el cuerpo
        div.html("");

        row = paciente_data.FORMATO;


        for (const key in row) {
            if (Object.hasOwnProperty.call(row, key)) {
                const element = row[key];
                const NOMBRE_SERVICIO = element.NOMBRE_SERVICIO;
                const CONSENTIMIENTO = element.CONSENTIMIENTO;
                const $id_servicio = element.SERVICIO_ID;
                const $nombre = ' ' + paciente_data.NOMBRE_PACIENTE;

                let html = `
            <div class="col-12 rounded-3 p-3 card shadow mt-3">
                <!-- Cuerpo del texto del consentimiento -->
                    <div class='row'>
                        <div class='col-12'>
                        ${CONSENTIMIENTO}
                        </div>
                    </div>
                    <hr>
                    <div class='my-3 justify-content-center checkbox_consentimiendo_div' style='display:none;'>
                    <p class=''>Marcar en las casillas si esta de acuerdo o no con el consentimiento informado</p>
                    <div class="form-check mt-3">
                        <input class="form-check-input" type="radio" name="${$id_servicio}" id="flexRadioDefault1_${$id_servicio}">
                        <label class="form-check-label fw-bold" for="flexRadioDefault1_${$id_servicio}">
                            Si estoy deacuerdo
                        </label>
                        </div>
                        <div class="form-check">
                        <input class="form-check-input" type="radio" name="${$id_servicio}" id="flexRadioDefault2_${$id_servicio}" checked>
                        <label class="form-check-label fw-bold" for="flexRadioDefault2_${$id_servicio}">
                            No estoy deacuerdo
                        </label>
                    </div>
                     
                    </div>
            </div>
            `;




                div.append(html);
                $(".nombre_paciente").html($nombre);
            }

            resolve(1)
        }
    })

}

// Funcion para validar si la firma existe
function validar_si_existe_firma() {
    let firma_div = $("#firma_div"); // <-- contenedor del canvas para la firma
    let aviso_div = $("#aviso_reporte"); // <-- contenedor del boton para visualizar el pdf
    let $consentimiento_checkbox_div = $(".checkbox_consentimiendo_div");

    let firma = paciente_data.FIRMA;

    if (firma === "0")/* no tiene firma */ {
        // En caso de que no tenga firma aparecera el canvas y el boton para que pueda firmar y enviar
        firma_div.fadeIn(1);
        aviso_div.fadeOut(1);
        $consentimiento_checkbox_div.fadeIn(1);
        firma_exist = false;
    } else {
        // En el caso de que tenga firma se mostrara el boton para visualizar el pdf
        aviso_div.fadeIn(500);
        firma_div.fadeOut(500);
        $consentimiento_checkbox_div.fadeOut(500);
        firma_exist = true;
    }
}

// Function para enivar la firma
function enviar_firma() {
    // Se obtiene la firma codificada en base 64
    let FIRMA = $("#firma").val();



    return false;
    ajaxAwait({
        api: 2,
        turno_id: turno_id,
        firma: FIRMA
    }, 'consentimiento_api', { callbackAfter: true }, false, () => {
        alertMsj({
            title: '¡Su firma se ha guardado!', text: 'ya puede visualizar su reporte',
            icon: 'success', allowOutsideClick: false, showCancelButton: false, showConfirmButton: true
        })

        limpiarFirma();
        ContruirPagina();
        // validar_si_existe_firma();
    })
}

// Function para limpiar la firma en caso de que se haya enviado con exito
function limpiarFirma() {
    resetFirma();
    $("#firma").val("");
}

// ------------------------------------------------------------------------

// ------------ Script para la firma --------------------------------------
// Obtén una referencia al elemento canvas y al contexto de dibujo
var canvas = document.getElementById('firmaCanvas');
var ctx = canvas.getContext('2d');
// Variables para almacenar la posición anterior del puntero/touch y un indicador de si se está dibujando actualmente
var drawing = false;
var lastX = 0;
var lastY = 0;

// Agrega eventos para registrar los movimientos del puntero/touch
canvas.addEventListener('mousedown', startDrawing);
canvas.addEventListener('mousemove', draw);
canvas.addEventListener('mouseup', stopDrawing);
canvas.addEventListener('mouseout', stopDrawing);

canvas.addEventListener('touchstart', startDrawing);
canvas.addEventListener('touchmove', draw);
canvas.addEventListener('touchend', stopDrawing);
canvas.addEventListener('touchcancel', stopDrawing);

// Función para comenzar el dibujo
function startDrawing(e) {
    drawing = true;
    var pos = getMousePos(canvas, e);
    [lastX, lastY] = [pos.x, pos.y];
    e.preventDefault();
}

// Función para dibujar en el lienzo
function draw(e) {
    if (!drawing) return; // Si no se está dibujando, no hacer nada

    var pos = getMousePos(canvas, e);
    var currentX = pos.x;
    var currentY = pos.y;

    // Dibujar una línea suave desde la posición anterior a la posición actual
    ctx.lineWidth = 3;
    ctx.lineJoin = 'round';
    ctx.lineCap = 'round';
    ctx.strokeStyle = 'blue';
    ctx.beginPath();
    ctx.moveTo(lastX, lastY);
    ctx.lineTo(currentX, currentY);
    ctx.stroke();

    [lastX, lastY] = [currentX, currentY];
    e.preventDefault();
}

// Función para detener el dibujo
function stopDrawing() {
    drawing = false;
}

// Función auxiliar para obtener las coordenadas del puntero/touch en relación con el canvas
function getMousePos(canvas, evt) {
    var rect = canvas.getBoundingClientRect();
    var clientX, clientY;

    if (evt.touches && evt.touches.length > 0) {
        clientX = evt.touches[0].clientX;
        clientY = evt.touches[0].clientY;
    } else {
        clientX = evt.clientX;
        clientY = evt.clientY;
    }

    return {
        x: clientX - rect.left,
        y: clientY - rect.top
    };
}

// Función para reiniciar el campo de la firma
function resetFirma() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);
}

// ...

// Referencia al campo oculto
var firmaInput = document.getElementById('firma');

function validarFormulario() {
    var canvas = document.getElementById('firmaCanvas');
    var firmaInput = document.getElementById('firma');

    // Obtener el contexto del canvas
    var ctx = canvas.getContext('2d');

    // Verificar si se ha dibujado algo en el canvas
    var canvasData = ctx.getImageData(0, 0, canvas.width, canvas.height).data;
    var isFirmaVacia = Array.from(canvasData).every((pixel) => pixel === 0);

    if (isFirmaVacia) {
        alertToast('Por favor, ingrese su firma antes de enviar el formulario.', 'info', 3000);
        return false;
    }

    // Si se ha dibujado algo en el canvas, guardar la imagen en el campo de firma
    var imageDataUrl = canvas.toDataURL();
    firmaInput.value = imageDataUrl;

    return true;
}

// Inicializar SignaturePad en el canvas
// var canvas = document.getElementById('firmaCanvas');
// var signaturePad = new SignaturePad(canvas);


/* -------------------------- funciones para el modal -------------------------------- */

