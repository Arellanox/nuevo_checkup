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
    }, 'consentimiento_api', { callbackAfter: true }, false, (data) => {
        let row = data.response.data;

        // Se recorre el array para acceder a los datos
        paciente_data = Object.keys(row).map(function (key) {
            const element = row[key];
            return {
                px: element.NOMBRE_PACIENTE,
                edad: element.EDAD,
                fecha_nacimiento: element.NACIMIENTO,
                procedencia: element.PROCEDENCIA,
                telefono: element.TELEFONO,
                correo: element.CORREO,
                consentimiento: element.CONSENTIMIENTO,
                servicio_id: element.SERVICIO_ID,
                firma: element.FIRMA
            };
        });


        // Se construye el header con la informacion del paciente
        rellenarInformacionPaciente();

        // Se construye los cuerpos de los consentimiento por cada area si es que manda mas de una
        construiBodyConsentimiento();

        // Se valida si la firma ya existe
        validar_si_existe_firma();
    })
}

// Function para rellenar la informacion del paciente en el header
function rellenarInformacionPaciente() {
    let header_div = $("#header_paciente");

    for (const key in paciente_data) {
        if (Object.hasOwnProperty.call(paciente_data, key)) {
            const element = paciente_data[key];
            let HTML = `
            <div class="col-12">
                <p class="" id="nombre-persona">${element.px} </p>
                <p class="none-p "> <strong id="edad-persona" class="none-p">${element.edad}</strong> años | <strong id="nacimiento-persona" class="none-p">${element.NACIMIENTO}</strong> </p>
            </div>

            <div class="col-12 row mt-3">
                <div class="col-12 col-md-12 col-lg-auto">
                    <p class="none-p" id="nacimiento-paciente-consulta">Procedencia:</p>
                    <p class="info-detalle-p">${element.procedencia}</p>
                </div>
                <div class="col-12 col-md-12 col-lg-auto">
                    <p class="none-p" id="genero-paciente-consulta">Teléfono:</p>
                    <p class='info-detalle-p'>
                        ${element.telefono} </p>
                </div>
                <div class="col-12 col-md-12 col-lg-auto">
                    <p class="none-p" id="correo-paciente-consulta">Correo:</p>
                    <p class='info-detalle-p'>
                        ${element.correo}</p>
                </div>
            </div>
            `;
            header_div.html(HTML);
        }
    }
}

// Function para construir el cuerpo de cada consentimiento por area, si es que existe mas de una
function construiBodyConsentimiento() {

    let div = $("#texto_consentimiento") // <-- contenedor de todo el cuerpo
    div.html("");
    for (const key in paciente_data) {
        if (Object.hasOwnProperty.call(paciente_data, key)) {
            const element = paciente_data[key];
            const CONSENTIMIENTO = element.consentimiento;

            div.append(CONSENTIMIENTO);
        }
    }

}

// Funcion para validar si la firma existe
function validar_si_existe_firma(firma = false) {
    let firma_div = $("#firma_div"); // <-- contenedor del canvas para la firma
    let aviso_div = $("#aviso_reporte"); // <-- contenedor del boton para visualizar el pdf
    let FIRMA;


    if (firma) {
        FIRMA = "1"; // <-- si la firma esta en 1 es por que si existe
    } else {
        for (const key in paciente_data) {
            if (Object.hasOwnProperty.call(paciente_data, key)) {
                const element = paciente_data[key];
                FIRMA = element.firma;
            }
        }
    }



    if (!FIRMA === "0")/* si tiene firma */ {
        // En el caso de que tenga firma se mostrara el boton para visualizar el pdf
        aviso_div.fadeIn(500);
        firma_div.fadeOut(500);
        firma_exist = true;
    } else {
        // En caso de que no tenga firma aparecera el canvas y el boton para que pueda firmar y enviar
        firma_div.fadeIn(1);
        aviso_div.fadeOut(1);
        firma_exist = false;
    }
}

// Function para construir el cuerpo del o los consentimientos
function dibujarConsentimientos() {
    let body_div = $("#");

    for (const key in paciente_data) {
        if (Object.hasOwnProperty.call(paciente_data, key)) {
            const element = paciente_data[key];

        }
    }
}

// Function para enivar la firma
function enviar_firma() {
    // Se obtiene la firma codificada en base 64
    let FIRMA = $("#firma").val();

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
        validar_si_existe_firma();
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