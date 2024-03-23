let proveedor_id_credito = 0;
// Formulario para nuevos contactos
$(document).on('click', '.btn-cargar-documentos', function (e) {
    e.preventDefault();
    e.stopPropagation();

    const btn = $(this)
    // Obtenemos la id de proveedor
    proveedor_id_credito = btn.attr('data-bs-id');

    // Vaciamos areas seleccionadas
    areas_seleccionadas = []

    // Reinicia y abre nuevo modalw
    document.getElementById('form-info_credito').reset();
    resetInputLabel()
    // Formulario y vista de contactos
    bsCollapse.hide();

    // Recupera informaación  
    alertToast('Cargando datos previos...', 'info');
    getInfoCredito();
    getArchivosInformacionCredito();

    // Abre el modal de información de credito
    $('#modalVistaInfoCredito').modal('show');


})

$('.collapse').on('shown.bs.collapse', function () {
    $.fn.dataTable
        .tables({
            visible: true,
            api: true
        })
        .columns.adjust();
});



// Formulario
$(document).on('submit', '#form-info_credito', function (e) {
    e.preventDefault();

    // Preguntar si esta todo bien
    alertMensajeConfirm({
        icon: 'info',
        title: '¿Deseas guardar correctamente la información?',
        text: 'No podrá modificarlo más tarde'
    }, () => {
        let servicios = TableAreasSelect.rows('.selected').data();
        let ids = [];

        for (let i = 0; i < servicios.length; i++) {
            // Asumiendo que cada objeto de datos de la fila tiene una propiedad 'ID'
            ids.push(servicios[i].ID_AREA);
        }

        let idText = ids.join(', ');

        // Mandar los datos
        ajaxAwaitFormData({
            api: 12, proveedor_id: proveedor_id_credito, tipo_servicio_prestar: idText
        }, 'proveedores_api', 'form-info_credito', { callbackAfter: true, resetForm: true }, false, (data) => {

            alertToast('Información guardada', 'success');

            // Reseteamos el formulario
            document.getElementById('form-info_credito').reset();

            // getArchivosInformacionCredito();
            getInfoCredito();

            // $('#modalVistaProveedores').modal('hide');

            // Recargar tabla de contactos

        })
    }, 1)
})



// Tabla de areas
let TableAreasSelect = $('#servicio_table_select').DataTable({
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
        data: { api: 2 },
        method: 'POST',
        url: '../../../api/areas_api.php',
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
        {
            data: null, render: function () {
                return '';
            }
        },
        { data: 'DESCRIPCION', },
    ],
    columnDefs: [
        { target: 0, title: '', className: 'all', with: '1px' },
        { target: 1, title: 'Areas', className: 'all' },
    ]

})


inputBusquedaTable('servicio_table_select', TableAreasSelect, [], [], 'col-12')




let areas_seleccionadas = [];
selectTable('#servicio_table_select', TableAreasSelect, {
    multipleSelect: true, noColumns: false, unSelect: true,
}, async function (select, data, callback) {
    console.log(data);
    if (select) {
        areas_seleccionadas.push(data.ID_AREA);
    } else {
        areas_seleccionadas.splice(data.ID_AREA, 1)
    }
})
// --------------Funciones---------------------
// --------------------------------------------



InputDragDrop('#dropCaratulaCuentaBancaria', (inputArea, salidaInput) => {

    ajaxAwaitFormData({
        id_proveedores: proveedor_id_credito, api: 10, id_tipo_archivo: 5
    }, 'proveedores_api', 'formCaratulaCuentaBancaria', { callbackAfter: true }, false, function () {
        // Siempre se ejecuta al final del proceso
        salidaInput();
        getArchivosInformacionCredito();

    })
}, { multiple: true })



InputDragDrop('#dropDatosPago', (inputArea, salidaInput) => {

    ajaxAwaitFormData({
        id_proveedores: proveedor_id_credito, api: 10, id_tipo_archivo: 6
    }, 'proveedores_api', 'formDatosPado', { callbackAfter: true }, false, function () {
        // Siempre se ejecuta al final del proceso
        salidaInput();
        getArchivosInformacionCredito();

    })
}, { multiple: true })





function getInfoCredito() {
    ajaxAwait({
        api: 13, proveedor_id: proveedor_id_credito
    }, 'proveedores_api', { callbackAfter: true }, false, function (data) {
        console.log(data);

        row = data.response.data[0]

        let dias = ifnull(row, 'Sin agregar', ['DIAS_CREDITO'], (data) => {
            data = parseInt(data);
            return data == 1 ? `${data} día` : `${data} días`;
        })
        // Dias que asignaron
        $('#credito_dias-info').html(dias)
        $('#monto_credito-info').html(ifnull(row, 'Sin agregar', ['MONTO_CREDITO'], (data) => {
            data = parseFloat(data).toFixed(2);
            return `$${data}`;
        }))

        let servicios = ifnull(row, 'Sin agregar', ['SERVICIOS_PRESTAR'], (data) => {

            console.log(row[0]['SERVICIOS_PRESTAR'], data, 'servicios')
            try {
                return data.map(servicio => `${servicio.AREA}`).join(', ');;
            } catch (error) {
                return 1;
            }
        })

        $('#servicios-info').html(servicios)
    })
}

function getArchivosInformacionCredito() {
    ajaxAwait({
        api: 11, id_proveedores: proveedor_id_credito,
    }, 'proveedores_api', { callbackAfter: true }, false, function (data) {
        // console.log(data);

        const jsonData = data.response.data;
        $('#contenedor_informacion_credito').html('')

        jsonData.forEach(item => {
            if (item.TIPO_ARCHIVO === "Caratula de Cuenta Bancaría" || item.TIPO_ARCHIVO === "Datos de Pago") {
                let $div = $('<div>').addClass('col-12 col-lg-6 mb-4');
                let $titulo = $('<h5>').text(item.TIPO_ARCHIVO).addClass('mb-3');
                $div.append($titulo);

                let $botones = $('<div>').addClass('d-flex justify-content-center mt-2');

                item.RUTA_ARCHIVO.forEach(archivo => {
                    let $boton = $('<a>')
                        .attr('href', archivo.url)
                        .attr('download', '')
                        .addClass('btn btn-danger me-2 mb-2')
                        .html('<i class="bi bi-trash-fill"></i>');
                    $botones.append($boton);
                });

                if (item.RUTA_ARCHIVO.length > 0) {
                    let primerArchivo = item.RUTA_ARCHIVO[0];
                    let archivoParaProcesar = {
                        name: primerArchivo.url.split('/').pop(),
                        type: primerArchivo.tipo === 'png' ? 'image/png' : 'application/pdf',
                        url: primerArchivo.url
                    };
                    procesarArchivo(archivoParaProcesar, $div, $botones);
                } else {
                    $div.append($botones);
                }

                $('#contenedor_informacion_credito').append($div);
            }
        });


    })
}

function procesarArchivo(file, $div, $botones) {

    var $canvasContainer = $('<div>').addClass('d-flex justify-content-center my-2');

    if (file.type === 'application/pdf') {
        pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.11.338/pdf.worker.min.js';
        var loadingTask = pdfjsLib.getDocument(file.url);
        loadingTask.promise.then(function (pdf) {
            pdf.getPage(1).then(function (page) {
                // Calculamos el escalado necesario para ajustar la altura a 400px
                var viewport = page.getViewport({ scale: 1.0 });
                var scale = 400 / viewport.height;
                var scaledViewport = page.getViewport({ scale: scale });

                var canvas = $('<canvas></canvas>').get(0);
                var context = canvas.getContext('2d');
                canvas.height = scaledViewport.height;
                canvas.width = scaledViewport.width;

                // Creamos un div para contener el canvas y asegurarnos de que esté centrado
                $canvasContainer.css('max-height', '400px').append($(canvas));

                var renderContext = {
                    canvasContext: context,
                    viewport: scaledViewport
                };
                var renderTask = page.render(renderContext);
                renderTask.promise.then(function () {
                    // Añadimos el contenedor del canvas, no el canvas directamente
                    $div.append($canvasContainer);
                    $div.append($botones); // Aseguramos que los botones se agreguen después del contenedor del canvas
                });
            });
        }, function (reason) {
            console.error(reason);
        });
    } else if (file.type.match('image.*')) {
        var $img = $('<img>', {
            src: file.url,
            class: 'img-fluid img-thumbnail my-2',
            style: 'max-height: 400px; width: auto;' // Controla la altura máxima de las imágenes
        });
        $canvasContainer.append($img);
        $div.append($canvasContainer);
        $div.append($botones);
    } else {
        console.log('Archivo no soportado:', file.name);
    }
}

