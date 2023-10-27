// ----------- Formulario, Botones y PDF -----------------------------------
let paciente_data; // <-- aqui se guarda un array con toda la informacion del paciente
let url_pdf = '';

// Una vez cargue todo el contenido de la pagina se empieza a construir
$(document).ready(async function () {
    if (!turno_id) {
        $('#body-js').html('');
        alertMsj({
            title: '¡Falta definir Turno!', text: 'No se encontro ningun turno',
            icon: 'error', allowOutsideClick: false, showCancelButton: false, showConfirmButton: false
        })

        // return false;
    }


    await ContruirPagina()
});

// Escucha el boton "Enviar firma"
$(document).on("click", "#enviar_firma_btn", function () {

    // Valida el canva si esta vacio manda una alerta
    if (!validarFormulario())
        return false;

    const pdfBytes = embedSignature(url_pdf)

    // Se le manda un mensaje de alerta al usuario ya que no podra realizar esta accion una vez se envie
    alertMensajeConfirm({
        title: '¿Ha realizado su firma correctamente y aceptado los consentimientos?',
        text: 'Una vez realice este proceso no podra volver a realizarlo,',
        icon: 'warning',
        confirmButtonText: 'Si, estoy seguro',
        cancelButtonText: 'Cancelar'
    }, () => {
        // Se manda a llamar al metodo para enviar la firma
        enviar_firma(pdfBytes);
    }, 1)

})

// Escucha los cambios de todos los input de type radio
$(document).on('change', 'input[type=radio]', function () {
    // Se saca el id del input de type radio
    const id = $(this).attr('data_id');

    // Se obtiene los 2 input de aceptar o no
    const $aceptar = $(`#check_consentimiento_si_${id}`);
    const $denego = $(`#check_consentimiento_no_${id}`);

    // Contenedor de las opciones
    const $div_si = $(`#si_${id}`); // <-- Div que contiene al input y label de aceptar
    const $div_no = $(`#no_${id}`); // <-- Div que contiene al input y label de no aceptar

    // Se valida si el input de type radio esta checkeado o no 
    if ($aceptar.is(":checked")) {
        // Se pinta un background color al input de type radio cuando esta seleccionada
        $div_si.addClass('opcion')
        $div_no.removeClass('opcion')
    } else {
        $div_no.addClass('opcion')
        $div_si.removeClass('opcion')
    }

    // Se scrollea la pantalla del usuario al final de la pagina, donde esta la firma
    // window.scrollTo(0, document.body.scrollHeight)
})

/* ----------------------------------------------------------------- */

/* --------------- Funciones ------------------------------------ */

// Function para construir todo la pagina
async function ContruirPagina() {
    return new Promise(async function (resolve, reject) {
        // Se inicializa la firma en false, por que no existe
        firma_exist = false;
        await ajaxAwait({
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

            url_pdf = paciente_data.FORMATO[0].PDF_BLANCO

            resolve(1);
        })
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


        // Se inicializa una variable para contar cuantas veces esta haciendo el for
        let i = 0;
        for (const key in row) {
            if (Object.hasOwnProperty.call(row, key)) {
                const element = row[key];
                const CONSENTIMIENTO = element.CONSENTIMIENTO;
                const $id_servicio = element.SERVICIO_ID;
                const $nombre = ' ' + paciente_data.NOMBRE_PACIENTE;

                let $btn_paginacion = $('.botones_paginacion_body') // <-- Boton de paginacion de los consentimientos

                const $ACEPTADO_CONSENTIMIENTO = element.ACEPTADO;
                let $badge = "";

                if ($ACEPTADO_CONSENTIMIENTO === 1) {
                    $badge = `<h5 class="text-success fw-bold">
                    <i class="bi bi-check-circle-fill"></i> Aceptado
                    </h5>`;
                } else {
                    $badge = `<h5 class="text-danger fw-bold">
                    <i class="bi bi-x-circle-fill"></i> No aceptado
                    </h5>`;
                }

                // Se setea la variable de la clase del carousel para que funcione
                var $class = "carousel-item";

                // Se evalue si el, elemento que esta pasando es el primero
                if (i === 0) {
                    // Si es el primero se le pone la clase de active
                    $class = "carousel-item active"
                    $btn_paginacion.fadeOut(100); //<-- El boton de paginacion desaparece por que solo hay 1 coonsentimiento
                } else {
                    // Si no es el primero se le pone la clase por defecto
                    $class = $class
                    $btn_paginacion.fadeIn(100); //<-- El boton de paginacion desaparece por que hay mas de 1 consentimiento
                }

                let html = `
                <div class="col-12 ${$class}">
                    <!-- Cuerpo del texto del consentimiento -->
                        <div class='row'>
                            <div class='col-12'>
                            ${CONSENTIMIENTO}
                            </div>
                        </div>
                        <hr>
                        <!-- Aviso del consentimiento en caso de que haya aceptado o no -->
                        <div class='aceptado_aviso' style='display:none;'>
                            <div class='d-flex justify-content-center'>
                                ${$badge}
                            </div>
                        </div>
                        <!-- Checkbox para aceptar los consentimientoss -->
                        <div class='my-3 justify-content-center checkbox_consentimiendo_div' style='display:none;'>
                            <p class='text-center d-flex justify-content-center fw-bold'>Marcar en las casillas si esta de acuerdo o no con el consentimiento informado.</p>
                            <div class='row mt-3'>
                                <div class='col-6 d-flex justify-content-center'>
                                    <div class="" id="si_${$id_servicio}" style='padding:10px;'>
                                        <input class="form-check-input" value='1' type="radio" name="${$id_servicio}" data_id="${$id_servicio}" id="check_consentimiento_si_${$id_servicio}" >
                                            <label style='font-size:1.20rem;' class="form-check-label fw-bold" for="check_consentimiento_si_${$id_servicio}">
                                                Si estoy deacuerdo
                                            </label>
                                    </div>
                                </div>
                                <div class='col-6 d-flex justify-content-center'>
                                    <div class=""  id="no_${$id_servicio}" style='padding:10px;'>
                                        <input class="form-check-input" value='0' type="radio" name="${$id_servicio}" data_id="${$id_servicio}" id="check_consentimiento_no_${$id_servicio}">
                                            <label style='font-size:1.20rem;' class="form-check-label fw-bold" for="check_consentimiento_no_${$id_servicio}">
                                                No estoy deacuerdo
                                            </label>
                                    </div>
                                </div>
                            </div>
                        
                        </div>
                </div >
                `;

                div.append(html);
                $(".nombre_paciente").html($nombre);
                // Incrementamos la variable
                i++;
            }

            resolve(1)
        }
    })

}

// Funcion para validar si la firma existe
function validar_si_existe_firma() {

    let firma = paciente_data.FIRMA;

    if (firma === "0") /* no tiene firma */ {
        firma_exist = false;
    } else {
        firma_exist = true;
    }

    fadeConsentimiento(firma_exist)
}

// Function para enivar la firma
function enviar_firma(pdf) {

    // Enviar pdf
    const pdfBlob = pdf
    // Se obtiene la firma codificada en base 64
    let FIRMA = $("#firma").val();
    // Se saca todos los consentimiento que tenga el paciente
    let row = paciente_data.FORMATO
    // Se crea y prepara el array que se le va a enviar a la api
    let data_json = {
        api: 2, //<-- API a la que va dirigido
        turno_id: turno_id, // <-- Turno del cliente
        firma: FIRMA, // <-- Firma del cliente
        consentimiento: [] // <-- ID y Checkbox de los consentimiento
    }

    // Se recorren todos los consentimientos
    for (const key in row) {
        if (Object.hasOwnProperty.call(row, key)) {
            const element = row[key];
            const ID = element.SERVICIO_ID; // <-- ID del servicio

            // Se evalua cual check esta seleccionando y se le asigna un valor 0 es que acepto  1 es que no acepto
            if ($(`#check_consentimiento_si_${ID} `).is(":checked")) {
                valor = 1 //<-- Acepto el consentimiento
            } else {
                valor = 0 // <-- No acepto el consentimiento
            }

            // Se inserta en el json los valores de los consentimientos
            data_json.consentimiento[key] = {
                ID_SERVICIO: ID,
                CONSENTIMIENTO: valor
            };
        }
    }

    // Se hace la peticion y se manda un alerta si se hizo la captura correctamente
    ajaxAwait(data_json, 'consentimiento_api', { callbackAfter: true }, false, () => {
        alertMsj({
            title: '¡Su firma y consentimiento se han guardado!',
            text: 'ya puede visualizar su reporte',
            icon: 'success',
            allowOutsideClick: false,
            showCancelButton: false,
            showConfirmButton: true
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

function fadeConsentimiento(firma) {
    let firma_div = $("#firma_div"); // <-- contenedor del canvas para la firma
    let aviso_div = $("#aviso_reporte"); // <-- contenedor del boton para visualizar el pdf
    let $consentimiento_checkbox_div = $(".checkbox_consentimiendo_div");
    let $aceptado_aviso = $('.aceptado_aviso');

    if (firma) {
        // En el caso de que tenga firma se mostrara el boton para visualizar el pdf
        aviso_div.fadeIn(500);
        $aceptado_aviso.fadeIn(500);
        firma_div.fadeOut(500);
        $consentimiento_checkbox_div.fadeOut(500);
    } else {
        // En caso de que no tenga firma aparecera el canvas y el boton para que pueda firmar y enviar
        firma_div.fadeIn(1);
        aviso_div.fadeOut(1);
        $aceptado_aviso.fadeOut(1);
        $consentimiento_checkbox_div.fadeIn(1);
    }
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

// Modificacion al pdf
async function embedSignature(url_pdf) {
    // 1. Carga el PDF original
    const pdfBytes = await fetch(url_pdf).then(res => res.arrayBuffer());
    const firmaDataURL = document.getElementById('firmaCanvas').toDataURL();

    const pdfFirmadoBytes = await agregarFirmaAlPDF(pdfBytes, firmaDataURL);

    return pdfFirmadoBytes
    // // Convierte los bytes del PDF firmado a un Blob y descárgalo
    // const blob = new Blob([pdfFirmadoBytes], { type: 'application/pdf' });
    // const link = document.createElement('a');
    // link.href = URL.createObjectURL(blob);
    // link.download = 'PDF_firmado.pdf';
    // document.body.appendChild(link);
    // link.click();
    // document.body.removeChild(link);

}

async function agregarFirmaAlPDF(pdfBytes, firmaDataURL) {
    // Carga el PDF existente
    const pdfDoc = await PDFLib.PDFDocument.load(pdfBytes);

    // Decodifica la imagen de la firma desde el DataURL
    const firmaBytes = Uint8Array.from(atob(firmaDataURL.split(',')[1]), c => c.charCodeAt(0));

    // Agrega la imagen de la firma al PDF
    const firmaImage = await pdfDoc.embedPng(firmaBytes);

    // Obtiene la primera página del PDF
    const pagina = pdfDoc.getPages()[1];

    // Define las dimensiones y posición de la firma en la página
    const { width, height } = firmaImage.scale(0.5);
    console.log(width, height);
    console.log(pagina.getWidth() / 2 - width / 2);
    pagina.drawImage(firmaImage, {
        x: 400,
        y: 580,
        width: 100,
        height: 70,
    });

    // Serializa el PDF a bytes
    const pdfBytesActualizado = await pdfDoc.save();

    return pdfBytesActualizado;
}


// Inicializar SignaturePad en el canvas
// var canvas = document.getElementById('firmaCanvas');
// var signaturePad = new SignaturePad(canvas);


/* -------------------------- funciones para el modal -------------------------------- */