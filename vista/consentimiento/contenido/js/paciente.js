// ----------- Formulario, Botones y PDF -----------------------------------
let paciente_data; // <-- aqui se guarda un array con toda la informacion del paciente
let url_pdf = '';
let pdf_consentimiento;

// Una vez cargue todo el contenido de la pagina se empieza a construir
$(document).ready(async function() {
    if (!turno_id) {
        CerrarPagina();
        return false;
    }


    await ContruirPagina()
});

// Escucha el boton "Enviar firma"
$(document).on("click", "#enviar_firma_btn", function() {

    // Valida el canva si esta vacio manda una alerta
    if (!validarFormulario())
        return false;


    if (!validarConsentimientos()) {
        return false;
    }

    // const pdfBytes = embedSignature(url_pdf)

    // Se le manda un mensaje de alerta al usuario ya que no podra realizar esta accion una vez se envie
    alertMensajeConfirm({
        title: '¿Ha realizado su firma correctamente y aceptado los consentimientos?',
        text: 'Una vez realice este proceso no podra volver a realizarlo,',
        icon: 'warning',
        confirmButtonText: 'Si, estoy seguro',
        cancelButtonText: 'Cancelar'
    }, () => {
        // Se manda a llamar al metodo para enviar la firma
        enviar_firma();
    }, 1)

})

// Escucha los cambios de todos los input de type radio
$(document).on('change', 'input[type=radio]', function() {
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
    return new Promise(async function(resolve, reject) {
        // Se inicializa la firma en false, por que no existe
        firma_exist = false;
        await ajaxAwait({
            api: 1,
            turno_id: turno_id
        }, 'consentimiento_api', { callbackAfter: true }, false, async (data) => {
            let row = data.response.data;
            // Se recorre el array para acceder a los datos
            paciente_data = row[0];

            if (paciente_data === undefined) {
                await CerrarPagina();
                return false;
            }

            // Se construye el header con la informacion del paciente
            await rellenarInformacionPaciente();
                
            // Se construye los cuerpos de los consentimiento por cadas area si es que manda mas de una
            await construiBodyConsentimiento();

            // Se valida si la firma ya existe
            validar_si_existe_firma();

            // url_pdf = paciente_data.FORMATO[0].PDF_BLANCO

            resolve(1);
        })
    })
}

// Function para rellenar la informacion del paciente en el header
async function rellenarInformacionPaciente() {
    return new Promise(function(resolve, reject) {
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
    return new Promise(function(resolve, reject) {
        let div = $("#texto_consentimiento") // <-- contenedor de todo el cuerpo
        div.html(""); // <-- se borra todo el contenido existente para remplazarlo con el nuevo

        row = paciente_data.FORMATO;


        // Se inicializa una variable para contar cuantas veces esta haciendo el for
        let i = 0;
        for (const key in row) {
            if (Object.hasOwnProperty.call(row, key)) {
                const element = row[key];
                const CONSENTIMIENTO = element.CONSENTIMIENTO; // <-- Cuerpo del consentimiento
                const $id_servicio = element.SERVICIO_ID; // <-- ID del servicio
                const $nombre = ' ' + paciente_data.NOMBRE_PACIENTE; // <-- Nombre del paciente

                const $quimico = element.QUIMICO; // <-- Nombre del quimico

                let $btn_paginacion = $('.botones_paginacion_body') // <-- Boton de paginacion de los consentimientos

                const $ACEPTADO_CONSENTIMIENTO = element.ACEPTADO; // <-- INT para saber si el consentimiento fue aceptado o no

                let $badge = "";

                // Se evalua si el consentimiento es aceptado
                if ($ACEPTADO_CONSENTIMIENTO === 1) /* El consentimiento esta aceptado */ {
                    $badge = `<h5 class="text-success fw-bold">
                    <i class="bi bi-check-circle-fill"></i> Aceptado
                    </h5>`;
                } else /* El consentimiento no fue aceptado */ {
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

                // Ponemos todos los consentimientos creados dentro de su contenedor
                div.append(html);

                // Pintamos la informacion para el cuerpo del consentimiento
                $(".nombre_paciente").html($nombre); // <<-- Nombre del paciente
                $('.quimico').html($quimico); // <<-- Quimico


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

// Function para enivar la firma y recuperar los pdf para acomodar la firma
let prueba_paciente_arreglo;
function enviar_firma() {
    // se manda una alerta al usuario para que sepa que se esta haciendo el proceso para guardar el consentimiento
    alertMsj({
        title: 'Por favor espere un momento',
        text: 'Se esta guardando su consentimiento.',
        icon: 'info',
        allowOutsideClick: false,
        showCancelButton: false,
        showConfirmButton: false,
        footer: 'Gracias por esperar'
    })

    // Enviar pdf
    // const pdfBlob = pdf
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
            if ($(`#check_consentimiento_si_${ID}`).is(":checked")) {
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

    // Se hace la peticion para guardar los consentimientos del paciente y recuperar todos los PDF para poder acomodar la firma
    ajaxAwait(data_json, 'consentimiento_api', { callbackAfter: true }, false, (data) => {

        // Si la peticion se realiza correctamente entonces ya se guardaron los consentimientos en la base de datos
        // despues que se guarden los consentimientos tenemos que recuperar los pdf ya rellenados con la informacion del paciente
        // y con todas las firmas que se les requiera poner al pdf, para que con la funcion que hizo juan, se pongan la firma y se arme
        // un arreglo con los pdf ya modificados con sus firmas

        // Se hace la peticion ajax para recuperar el arreglo con los pdf rellenados y las firmas
        ajaxAwait({
            api: 3,
            turno_id: turno_id // <-- turno del paciente
        }, 'consentimiento_api', { callbackAfter: true }, false, async (data) => {
            let row = data.response.data;
            let arreglo_paciente = row.JSON_UNIDO; // arreglo con los pdf modificados y las firmas

            const arreglo_pdf = await configurar_pdf_firma(arreglo_paciente); // <-- se manda a llamar a la funcion para configurar todos los pdf
            prueba_paciente_arreglo = arreglo_pdf;
            console.log(arreglo_pdf);

            ajaxAwait({
                api: 7,
                turno_id: turno_id, // <-- turno del paciente
                url_final: arreglo_pdf // <-- arreglo de los pdf ya modificados
            }, 'consentimiento_api', { callbackAfter: true }, false, async (data) => {
                swal.close(); // <-- se cierra la alerta anterior
                alertMsj({
                    title: '¡Su firma y consentimiento se han guardado!',
                    text: 'ya puede visualizar su reporte',
                    icon: 'success',
                    allowOutsideClick: false,
                    showCancelButton: false,    
                    showConfirmButton: true
                })
                limpiarFirma(); // <-- se limpia el canva de la firma
                ContruirPagina(); // <-- se vuelve a construir toda la pagina con los cambios del paciente realizados
                // validar_si_existe_firma();
            })

        })


        // Se tienen que recuperar todos los PDF de los consentimiento con la informacion del paciente ya relllenada
        // Para poder posicionar la firma en los consentimientos y luego enviarlos

        // configurar_pdf_firma(pdf_consentimiento); // se manda a llamar el metodo para modificar los pdf con las firmas


        // alertMsj({
        //     title: '¡Su firma y consentimiento se han guardado!',
        //     text: 'ya puede visualizar su reporte',
        //     icon: 'success',
        //     allowOutsideClick: false,
        //     showCancelButton: false,
        //     showConfirmButton: true
        // })
        // limpiarFirma();
        // ContruirPagina();
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

// Function para cerrar la pagina en caso de que algo falle 
function CerrarPagina() {
    return new Promise(function(resolve, reject) {
        $('#body-js').html('');
        alertMsj({
            title: '¡Falta definir Turno!',
            text: 'No se encontro ningun turno o el turno al que intenta entrar no existe',
            icon: 'error',
            allowOutsideClick: false,
            showCancelButton: false,
            showConfirmButton: false
        })

        resolve(1)
    })
}


// Function para validar los consentimientos
function validarConsentimientos() {
    // En los casos de que se le olvide firmar al paciente o que no haya seleccionado alguna de las acciones para los consentimientos
    // Es decir si no acepto o no algun consentimiento, no se pueden dejar blanco hay que validar eso

    // Se saca todos los consentimiento que tenga el paciente
    let row = paciente_data.FORMATO

    // Se recorren todos los consentimientos
    for (const key in row) {
        if (Object.hasOwnProperty.call(row, key)) {
            const element = row[key];
            const ID = element.SERVICIO_ID; // <-- ID del servicio
            const $NOMBRE = element.NOMBRE_CONSENTIMIENTO // <<-- Nombre del consentimiento

            // Se evalua cual check esta seleccionando y se le asigna un valor 0 es que acepto  1 es que no acepto
            if ($(`#check_consentimiento_si_${ID}`).is(":checked") ||
                $(`#check_consentimiento_no_${ID}`).is(":checked")
            ) {
                continue;
            } else {
                alertToast(`No se marcaron todos los consentimiento.`, 'info', 3000);
                return false;
            }
        }
    }


    // Si todos los checkboxes están marcados, retorna true para permitir que el formulario se envíe
    return true
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


/* ==================== Funciones para poner la firma en el PDF de prueba =========================================== */

// Estas 2 funciones fueron hechas para poder posicionar la firma, no son las originales solo son de prueba
async function embedSignature(url_pdf, firmaDataURL, CONFIG) {


    // 1. Carga el PDF original
    const pdfBytes = await fetch(url_pdf).then(res => res.arrayBuffer());

    // Se manda a llamar al metodo para agregar las firmas al PDF
    const pdfFirmadoBytes = await agregarFirmaAlPDF(
        pdfBytes, // <-- PDF original
        firmaDataURL, // <-- Firma codificada en base64
        CONFIG
    );

    // return pdfFirmadoBytes
    // Convierte los bytes del PDF firmado a un Blob y descárgalo
    const blob = new Blob([pdfFirmadoBytes], { type: 'application/pdf' });
    const link = document.createElement('a');
    link.href = URL.createObjectURL(blob);
    link.download = 'PDF_firmado.pdf';
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);

}

async function agregarFirmaAlPDF(pdfBytes, firmaDataURL, CONFIG) {

    // Carga el PDF existente
    const pdfDoc = await PDFLib.PDFDocument.load(pdfBytes);

    // Decodifica la imagen de la firma desde el DataURL
    const firmaBytes = Uint8Array.from(atob(firmaDataURL.split(',')[1]), c => c.charCodeAt(0));

    // Agrega la imagen de la firma al PDF
    const firmaImage = await pdfDoc.embedPng(firmaBytes);

    // Obtiene la primera página del PDF
    const pagina = pdfDoc.getPages()[CONFIG.hoja];

    // Define las dimensiones y posición de la firma en la página
    const { width, height } = firmaImage.scale(0.5);
    // console.log(width, height);
    // console.log(pagina.getWidth() / 2 - width / 2);
    pagina.drawImage(firmaImage, CONFIG);

    // Serializa el PDF a bytes
    const pdfBytesActualizado = await pdfDoc.save();

    return pdfBytesActualizado;
}


// Inicializar SignaturePad en el canvas
// var canvas = document.getElementById('firmaCanvas');
// var signaturePad = new SignaturePad(canvas);
/* ==================== Fin =========================================== */


/* ==================== Funciones para poner la firma en el PDF =========================================== */
let array_prueba;

function prueba_firma() {
    ajaxAwait({
        api: 3,
        turno_id: 621
    }, 'consentimiento_api', { callbackAfter: true }, false, async (data) => {
        let row = data.response.data;
        // Se recorre el array para acceder a los datos
        array_prueba = row;
    })
}

//prueba_firma();
let arreglo_final;
// function para configurar el pdf y ordenar todos los datos para ponerlo dentro del PDF
async function configurar_pdf_firma(row) {
    arreglo_pdf = []; // <-- aqui ira los PDF ya modificados 

    // Se recorre todo el arreglo para acceder a su data
    for (const key in row) {
        if (Object.hasOwnProperty.call(row, key)) {
            const element = row[key];
            // variables por cada PDF que nos serviran mas tarde
            const $URL_PDF = element.URL_PDF // Ruta del PDF original sin las firmas
            const $ID = element.SERVICIO_ID // ID del consentimiento
            const $FIRMAS = element.FIRMAS // Array que contiene todas las firmas que se pondran en el PDF
            try {
                // Se debe de obtener el PDF ya que solo me llega la ruta, entonces tengo que sacar el archivo como tal
                let pdfBytes = await fetch($URL_PDF).then(res => res.arrayBuffer());

                // Despues tengo que ejecutar la función para poner las N firmas en el PDF
                let $pdf_firmado = await draw_firmas(pdfBytes, $FIRMAS, $ID);

                // Convierte el PDF a formato Base64
                const pdfBase64 = arrayBufferToBase64($pdf_firmado);

                // // Se convierte el PDF a tipo Blob para que pueda ser guardado
                // let blob = new Blob([$pdf_firmado], {
                //     type: 'application/pdf'
                // });

                // const link = document.createElement('a');
                // link.href = URL.createObjectURL(blob);
                // link.download = 'PDF_firmado.pdf';
                // document.body.appendChild(link);
                // link.click();
                // document.body.removeChild(link);

                //La funcion me retorna el PDF ya con las firmas hechas entonces ya se mete en el arreglo para enviarlo a back
                arreglo_pdf[key] = {
                    id_consentimiento: $ID,
                    pdf: pdfBase64
                }
            } catch (error) {   
                // se manejan los errores por si llega a suceder algo imprevisto
                console.error(`Error en la posicion de: ${key}: ${error.message}`);
            }
        }
    }

    arreglo_final = arreglo_pdf;

    return arreglo_pdf; //<-- retornamos el arreglo de los PDF's ya rellenados con su firma y todo
}

// function para poner todas las firmas que se manden en el arreglo, al PDF especificado
async function draw_firmas(
    $pdf, // <-- PDF del consentimiento
    $firmas, // <-- Array que contiene todas las firmas que se pondran en el PDF
    $id = null, // <-- ID del consentimiento
) {
    // Se carga el PDF existente para poder editarlo, y se por cada PDF que se le mande, es decir las veces que se ejecute la     función
    let pdfDoc = await PDFLib.PDFDocument.load($pdf);

    // Se recorre el arreglo de firmas para poder acceder a todas las firmas que se pondran en el PDF
    for (const key in $firmas) {
        if (Object.hasOwnProperty.call($firmas, key)) {
            const element = $firmas[key];
            const $firma = element.FIRMA; // <-- Firmas en base64

            // const $acepto = element.CONSENTIMIENTO; // <-- BIT para saber si acepto el consentimiento o no #ya no se usara o eso creo
            // const $tipo = element.TIPO; // <-- Tipo de usuario que es la firma es decir paciente o medico # esto tampoco se si se usa

            // Variables para la configuracion de la firma
            const $config = element.CONFIG; // <-- Configuración de las firmas como la posicion en la que debe estar
            let $pagina = $config.hoja; // <-- Numero de hoja en la cual se va a poner la firma

            // Decodifica la imagen de la firma desde el DataURL
            const firmaBytes = Uint8Array.from(atob($firma.split(',')[1]), c => c.charCodeAt(0));

            // Agrega la imagen de la firma al PDF
            const firmaImage = await pdfDoc.embedPng(firmaBytes);

            // Obtiene la primera página del PDF
            const pagina = pdfDoc.getPages()[$pagina];

            // Define las dimensiones y posición de la firma en la página
            const {
                width,
                height
            } = firmaImage.scale(0.5);

            // Se pone la firma en el PDF con las configuraciones establecidas
            pagina.drawImage(firmaImage, $config);
        }
    }
    // Serializa el PDF a bytes
    const pdfBytesActualizado = await pdfDoc.save();

    // Se regresa el PDF serealizado ya editado con todas las firmas
    return pdfBytesActualizado;
}


// Función para convertir un ArrayBuffer a una cadena Base64
function arrayBufferToBase64(buffer) {
    let binary = ''
    const bytes = new Uint8Array(buffer)
    const len = bytes.byteLength
    for (let i = 0; i < len; i++) {
        binary += String.fromCharCode(bytes[i])
    }
    return btoa(binary)
}