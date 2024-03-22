let id_documentos

// Formulario para agregar direccion
$(document).on('click', '#btn-subir-documentos', function (e) {
    id_documentos = $('#btn-subir-documentos').attr('data-bs-id')
    console.log(id_documentos)
    if (id_documentos == '0' || typeof id_documentos == 'undefined') {
        alertToast('Selecciona un proveedor', 'info');
        return false;
    }

    //Limpia la vista cada vez que se entra al modal
    $('#image-preview').hide();
    $('#image-preview').html('');
    $('#pdf-canvas').hide();

    inputDropDocumentos.resetInputDrag();

    // Reinicia y abre nuevo modalw
    // document.getElementById('form-proveedores').reset();
    dataDocumentosProveedor['id_proveedores'] = id_documentos
    TableDocumentosProveedor.ajax.reload()

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
let inputDropDocumentos = InputDragDrop('#dropProveedoresDocumentacion', (inputArea, salidaInput) => {



    // Suponiendo que inputArea es un input de tipo file con el atributo "multiple" habilitado
    var files = inputArea.get(0).files;

    // Obten el nombre
    // var nombreArchivo = inputArea.val().split('\\').pop();

    $('#image-preview').hide();
    $('#image-preview').html('');
    $('#pdf-canvas').hide();

    $('#pdfviewer').html('')

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

            $('#image-preview').hide();
            $('#image-preview').html('');
            $('#pdf-canvas').hide();

            alertToast('Documento(s) guardado', 'success');

            TableDocumentosProveedor.ajax.reload()
        })
    }, 1)
})


// Tabla de areas
dataDocumentosProveedor = { api: 16, id_proveedores: id_documentos }
TableDocumentosProveedor = $('#TableDocumentosProveedor').DataTable({
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
        data: function (d) {
            return $.extend(d, dataDocumentosProveedor);
        },
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
        { data: 'COUNT' },
        { data: 'TIPO_ARCHIVO', },
        {
            data: 'PROVEEDOR_ID', render: function (data, row) {
                return `<i class="bi bi-trash eliminar-documento" data-id = "${row}" style = "cursor: pointer"></i>`;
            }
        }
    ],
    columnDefs: [
        { target: 0, title: '#', className: 'all', with: '1px' },
        { target: 1, title: 'Tipo de archivo', className: 'all' },
        { target: 2, title: '<i class="bi bi-trash"></i>', className: 'all' },
    ]

})


inputBusquedaTable('TableDocumentosProveedor', TableDocumentosProveedor, [], [], 'col-12')

// Función que se ejecuta cuando se realiza una acción para obtener un nuevo PDF
function getNewView(url, filename) {
    // Destruir la instancia existente de AdobeDC.View
    // Crear una instancia inicial de AdobeDC.View
    let adobeDCView = new AdobeDC.View({ clientId: "cd0a5ec82af74d85b589bbb7f1175ce3", divId: "adobe-dc-view" });

    var nuevaURL = url;

    // Agregar un parámetro único a la URL para evitar la caché del navegador
    nuevaURL += "?timestamp=" + Date.now();

    // Cargar y mostrar el nuevo PDF en el visor
    adobeDCView.previewFile({
        content: { location: { url: nuevaURL } },
        metaData: { fileName: filename }
    });
}


selectTable('#TableDocumentosProveedor', TableDocumentosProveedor, {
    multipleSelect: false, noColumns: false, unSelect: true,
    ClickClass: [
        {
            class: 'eliminar-documento',
            callback: (data) => {
                desactivarDocumentoProveedor(data)
            },
            selected: true
        }
    ]
}, function (select, data, callback) {

    console.log(data);
    if (select) {
        getNewView(data.URL, data.NOMBRE);

    }
})

function desactivarDocumentoProveedor(data) {
    var id_proveedorDocumento = data
    console.log(id_proveedorDocumento)

    alertMensajeConfirm({
        title: '¿Está seguro que desea desactivar este documento?',
        text: 'No podrá modificarlo despues',
        icon: 'warning',
    }, function () {

        ajaxAwait({
            api: 18,
            id_proveedores: id_proveedorDocumento['PROVEEDOR_ID'],
            id_tipo_archivo: id_proveedorDocumento['ID_TIPO_ARCHIVO'],
            posicion_archivo: id_proveedorDocumento['POSICION']
        },
            'proveedores_api', { callbackAfter: true }, false, function (data) {
                alertToast('Documento eliminado!', 'success', 4000)

                $('.adobe-dc-view').html('')

                TableDocumentosProveedor.ajax.reload();
            })
    }, 1)
}
