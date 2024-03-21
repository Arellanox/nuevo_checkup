let id_documentos

// Formulario para agregar direccion
$(document).on('click', '.btn-subir-documentos', function (e) {
    id_documentos = $(this).attr('data-bs-id')

    // Reinicia y abre nuevo modalw
    // document.getElementById('form-proveedores').reset();

    // Formulario y vista de contactos
    $('#modalVistaDocumentos').modal('show');
    
    setTimeout(() => {
        $.fn.dataTable
        .tables({
            visible: true,
            api: true
        })
        .columns.adjust();
    }, 300);

})

var archivosNoSoportados = []; // Lista para guardar los nombres de archivos no soportados
InputDragDrop('#dropProveedoresDocumentacion', (inputArea, salidaInput) => {



    // Suponiendo que inputArea es un input de tipo file con el atributo "multiple" habilitado
    var files = inputArea.get(0).files;

    // Obten el nombre
    // var nombreArchivo = inputArea.val().split('\\').pop();

    $('#image-preview').hide();
    $('#image-preview').html('');
    $('#pdf-canvas').hide();

    // console.log(files);
    // Itera sobre todos los archivos seleccionados
    for (var i = 0; i < files.length; i++) {
        console.log(files)
        procesarArchivo_input(files[i]);
    }

    // Al finalizar, verifica si hay archivos no soportados para informar al usuario
    if (archivosNoSoportados.length > 0) {
        var listaArchivosNoSoportados = "Archivos no soportados:\n" + archivosNoSoportados.join('\n');
        alert(listaArchivosNoSoportados);
    }


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
var procesarArchivo_input = function (file) {
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

$(document).on('submit', '#form-proveedores_documentos', function (e) {
    e.preventDefault();
    e.stopPropagation();

    // Preguntar si esta todo bien
    alertMensajeConfirm({
        icon: 'info',
        title: '¿Deseas guardar una nuevo documento?',
        text: 'No podra actualizarlo'
    }, () => {

        // Mandar los datos
        ajaxAwaitFormData({
            api: 10,
            id_proveedores: id_documentos,
        }, 'proveedores_api', 'form-proveedores_documentos', { formJquery: $('#subirDocumentoProveedor'), callbackAfter: true, resetForm: true }, false, (data) => {

            alertToast('Documento(s) guardado', 'success');

            TableDocumentosProveedor.ajax.reload()
        })
    }, 1)
})


// Tabla de areas
let TableDocumentosProveedor = $('#TableDocumentosProveedor').DataTable({
    language: {
        url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
    },
    lengthChange: false,
    info: false,
    paging: false,
    // searching: false,
    scrollY: '40vh',
    scrollCollapse: true,
    ajax: {
        dataType: 'json',
        data: {api: 11,  id_proveedores: id_documentos},
        method: 'POST',
        url: '../../../api/proveedores_api.php',
        complete: function () {
            $.fn.dataTable
                .tables({
                    visible: true,
                    api: true
                })
                .columns.adjust();
        },
        dataSrc: 'response.data'
    },
    columns: [
        { data: 'count' },
        { data: 'TIPO_ARCHIVO', },
    ],
    columnDefs: [
        { target: 0, title: '#', className: 'all', with: '1px' },
        { target: 1, title: 'Tipo de archivo', className: 'all' },
    ]

})


inputBusquedaTable('TableDocumentosProveedor', TableDocumentosProveedor, [], [], 'col-12')




// let areas_seleccionadas = [];
// selectTable('#TableDocumentosProveedor', TableAreasSelect, {
//     multipleSelect: true, noColumns: false, unSelect: true,
// }, async function (select, data, callback) {
//     console.log(data);
//     if (select) {
//         areas_seleccionadas.push(data.ID_AREA);
//     } else {
//         areas_seleccionadas.splice(data.ID_AREA, 1)
//     }
// })