// ----------- Formulario, Botones y PDF -----------------------------------
$(document).on("click", "#enviar_firma_btn", function () {
    validarFormulario()
})









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