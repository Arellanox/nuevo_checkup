var archivosNoSoportados = []; // Lista para guardar los nombres de archivos no soportados
let  input_facturas = InputDragDrop('#dropFacturas', (inputArea, salidaInput) => {

    // Suponiendo que inputArea es un input de tipo file con el atributo "multiple" habilitado
    var files = inputArea.get(0).files;

    // Obten el nombre
    var nombreArchivo = inputArea.val().split('\\').pop();

    $('#image-preview').hide();
    $('#image-preview').html('');
    $('#pdf-canvas').hide();
    // Itera sobre todos los archivos seleccionados
    for (var i = 0; i < files.length; i++) {
        procesarArchivo(files[i]);
    }

    // Al finalizar, verifica si hay archivos no soportados para informar al usuario
    if (archivosNoSoportados.length > 0) {
        var listaArchivosNoSoportados = "Archivos no soportados:\n" + archivosNoSoportados.join('\n');
        alert(listaArchivosNoSoportados);
    }




    // Vista previa final
    // $('.nombre_orden-paciente').html(nombreArchivo);


    // Siempre se ejecuta al final del proceso
    salidaInput({
        msj: { pregunta: 'Carga otro arrastrándolo' },
        dropArea_css: {
            background: 'rgb(200 254 216)', // Indicativo que hay algo cargado
        },
        strong: {
            class: 'none-p',
            borderBottom: '1px solid'
        }
    });

    // Configuraciones
}, { multiple: true })


// Función para procesar cada archivo
var procesarArchivo = function (file) {
    var nombreArchivo = file.name;

    // Verifica si el archivo es un PDF
    if (file.type === 'application/pdf') {
        var fileReader = new FileReader();
        fileReader.onload = function () {
            $('#pdf-canvas').show();

            var typedarray = new Uint8Array(this.result);
            pdfjsLib.getDocument(typedarray).promise.then(function (pdf) {

                mostrarPDF(typedarray)
            });
        };
        fileReader.readAsArrayBuffer(file);
    } else if (file.type.match('image.*')) {
        // Procesamiento para imágenes
        var reader = new FileReader();
        reader.onload = function (e) {
            // Cambia aquí para añadir cada imagen al contenedor 'image-preview'
            var imgContainer = document.getElementById('image-preview');
            imgContainer.style.display = 'block'; // Asegura que el contenedor sea visible

            var img = document.createElement('img');
            img.className = 'img-thumbnail';
            img.style.width = '100%';
            img.style.height = 'auto';
            img.src = e.target.result;

            imgContainer.appendChild(img); // Agrega la imagen al contenedor
        };
        reader.readAsDataURL(file);
        // $('#image-preview').show();
    } else {
        // Archivos no soportados
        archivosNoSoportados.push(nombreArchivo);
    }
};

// Función para mostrar PDFs
var mostrarPDF = function (typedarray) {
    pdfjsLib.getDocument(typedarray).promise.then(function (pdf) {
        // Asegura que el contenedor esté vacío y muestra el contenedor
        var pdfContainer = document.getElementById('pdf-canvas');
        pdfContainer.innerHTML = ''; // Limpia el contenedor para nuevos archivos PDF
        pdfContainer.style.display = 'block';

        // Itera sobre cada página del PDF
        for (let pageNum = 1; pageNum <= pdf.numPages; pageNum++) {
            pdf.getPage(pageNum).then(function (page) {
                var canvas = document.createElement('canvas');
                var ctx = canvas.getContext('2d');

                // Asegúrate de escalar el viewport a tu necesidad
                var viewport = page.getViewport({ scale: 1.5 });
                canvas.height = viewport.height;
                canvas.width = viewport.width;

                canvas.style.maxWidth = "100%"

                var renderContext = {
                    canvasContext: ctx,
                    viewport: viewport
                };

                // Renderiza la página
                page.render(renderContext).promise.then(function () {
                    // Agrega el canvas al contenedor
                    pdfContainer.appendChild(canvas);
                });
            });
        }
    });
};



const resetInputDrag = function resetInputDrag() {

    // Resetear los estilos al estado inicial
    dropArea.removeClass('hover_dropDrag').css({
      'border-color': 'rgb(0 79 90 / 17%)',
      'background-color': 'transparent', // Suponiendo que el fondo inicial es transparente
      'color': 'black', // Si el texto inicial es negro
      // Restablecer cualquier otro estilo que sea necesario
    });

    // También debes asegurarte de que el contenido de la zona de arrastre se restablezca
    const labelArea = dropArea.find('label');
    labelArea.text('Sube tu archivo arrastrándolo aquí'); // O el texto inicial que desees
  }


  $('#formArchivoFacturas').submit(function (event) {
    event.preventDefault();

    // Input del dragAndDrop
    let inputFileFacturas = $("input[name='facturas[]']").val()  

    if(inputFileFacturas != "" ){
        alertMensajeConfirm({
            title: '¿Esta seguro de guardar la factura?',
            text: 'Guardará/Actualizará la factura de este paciente',
            icon: 'info'
        }, () => {
            ajaxAwaitFormData({
                api: 8,
                id_grupo: subirFactura,
                // factura: inputFileFacturas
            }, 'admon_grupos_api', 'formArchivoFacturas', { callbackAfter: true, resetForm: true }, false, (data) => {
                // $('#modalFacturarCuenta').modal('hide');
                // tablaContados.ajax.reload()
                alertToast('Paciente facturado', 'success', 4000)
            })
        }, 1)
    }else{
        alertToast('Debe agregar una factura antes de guardar', 'warning', 4000)
    }


})

