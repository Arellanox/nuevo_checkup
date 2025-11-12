

// Tabla de los estudios
dataJsonMuestras = { api: 6, id_turno: 0 }
pacienteEstudios = $('#pacienteEstudios').DataTable({
    language: {
        url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
    },
    lengthChange: false,
    info: true,
    paging: false,
    scrollY: "auto",
    scrollCollapse: true,
    ajax: {
        dataType: 'json',
        data: function (d) {
            return $.extend(d, dataJsonMuestras);
        },
        method: 'POST',
        url: `${http}${servidor}/${appname}/api/recepcion_api.php`,
        complete: function () {
            loader("Out", 'bottom')

            autosize($('textarea'));
        },
        error: function (jqXHR, exception, data) {
            alertErrorAJAX(jqXHR, exception, data)
            // console.log('Error')
        },
        dataSrc: 'response.data'
    },
    columns: [
        { data: 'GRUPO' },
        {
            data: null, render: function (data, type, row, meta) {
                return `${row.CONTENEDOR} - ${row.MUESTRA}`;
            }
        },
        // Si
        {
            data: null, render: function (data, type, row, meta) {
                var checkedAttr = row.muestra_muestra_tomada == 1 ? 'checked' : '';

                return `<input type="checkbox" name="rechazar_value" id="si_rechazar_${meta.row}"
                    value="1" class="dt-checkbox btn-check form-check-input" data-row-index="${meta.row}" onclick="selectOnlyThis(this, 1)" 
                    ${checkedAttr}
                >
                <label class="btn btn-outline-success" for="si_rechazar_${meta.row}">Si</label>`;
            },
            className: 'text-center',
        },
        // No
        {
            data: null, render: function (data, type, row, meta) {
                var checkedAttr = row.muestra_muestra_tomada == 0 ? 'checked' : '';

                return `<input type="checkbox" name="rechazar_value" id="no_rechazar_${meta.row}" 
                    value="0" class="dt-checkbox  btn-check  form-check-input" data-row-index="${meta.row}" 
                    onclick="selectOnlyThis(this, 0)"
                    ${checkedAttr}
                >
                <label class="btn btn-outline-danger" for="no_rechazar_${meta.row}">No</label>`;
            },
            className: 'text-center',
        },

        // Observaciones
        {
            data: null, render: function (data, type, row, meta) {
                let html = `<textarea name="comentario" class="md-textarea input-form dt-checkbox" rows="1" data-row-index="${meta.row}">${row.muestra_observaciones}</textarea>`;
                return html;
            }
        },
        // Evidencia
        {
            data: null, render: function (data, type, row, meta) {
                console.log('=====')
                console.log(data, type, row, meta)
                console.log('=====')

                let html = `
                    <div class="input-group input_file_label">
                        <img src="${row.muestra_evidencia}" alt="Imagen subida" width="100px">
                        <input type="file" class="custom-file-input dt-checkbox" id="customFile" aria-describedby="inputGroupFileAddon04" onchange="updateLabel(this)" data-row-index="${meta.row}">
                        <label class="custom-file-label text-center" for="customFile" data-browse="Seleccionar archivo">Subir Archivo</label>
                    </div>
                `
                return html;
            }
        },
        // Boton
        {
            data: null, render: function (data, type, row, meta) {
                return `
                    <button type="button" data-row-index="${meta.row}"
                        class="btn btn-confirmar btn-hover btn-guardar-estudio me-2 d-flex align-items-center"
                        style="margin-bottom:4px;">
                            <i class="bi bi-floppy"></i>
                            <span class="d-none d-xl-block">Guardar</span>
                    </button>
                `;
            }
        }
        // {defaultContent: 'En progreso...'}
    ],
    columnDefs: [
        { title: "Estudios", width: "22.97%", targets: 0, className: "all" },
        { title: "Tubo/Muestra", width: "17.08%", targets: 1, className: "desktop" },
        { title: "Si", width: "5.31%", targets: 2, className: "all" },
        { title: "No", width: "6.27%", targets: 3, className: "all" },
        { title: "Observaciones", width: "23%", targets: 4, className: "min-tablet-l" },
        { title: "Evidencia", width: "14.26%", targets: 5, className: "min-tablet" },
        { title: "#", width: "9.15%", targets: 6, className: "all" }
    ]
});

const modalRecepcionMuestras = document.getElementById("modalRecepcionMuestras");
modalRecepcionMuestras.addEventListener("show.bs.modal", (event) => {
    setTimeout(() => {
        $.fn.dataTable
            .tables({
                visible: true,
                api: true
            })
            .columns.adjust();
    }, 250);
});

inputBusquedaTable('pacienteEstudios', pacienteEstudios, [{
    msj: 'Filtra los pacientes con información clave.',
    place: 'top'
}], [], 'col-12')

// Observa si un input es si o no
function selectOnlyThis(checkbox, type) {
    var rowIndex = checkbox.getAttribute('data-row-index');
    var checkboxes = document.querySelectorAll('input[type="checkbox"][data-row-index="' + rowIndex + '"]');
    checkboxes.forEach((item) => {
        item.checked = item.value == type;
    });
}

// Formulario
$('#pacienteEstudios tbody').on('click', '.btn-guardar-estudio', function () {
    // Obtener la fila
    var row = pacienteEstudios.row($(this).closest('tr'));
    var rowData = row.data();
    var rowIndex = row.index();

    // Obtener valores de los inputs personalizados en la fila
    var checkboxes = $(this).closest('tr').find('input[type="checkbox"][name="rechazar_value"]');
    var rechazarValue = null;
    checkboxes.each(function() {
        if ($(this).is(':checked')) {
            rechazarValue = $(this).val();
        }
    });

    // Obtener el comentario (textarea)
    var comentario = $(this).closest('tr').find('textarea[name="comentario"]').val();

    // Obtener el archivo
    var fileInput = $(this).closest('tr').find('input[type="file"]')[0];
    var archivo = fileInput && fileInput.files.length > 0 ? fileInput.files[0] : null;

    // Validar antes de enviar
    if (rechazarValue === null) {
        alert('Por favor selecciona Si o No');
        return;
    }

    // Preparar FormData para enviar al servidor (incluye archivo)
    var formData = new FormData();
    formData.append('api', 25); // Ajusta según tu API
    formData.append('turno_id', dataJsonMuestras.id_turno);
    //formData.append('grupo', rowData.GRUPO);
    formData.append('tipo_muestra', rowData.MUESTRA + ' - '+ rowData.CONTENEDOR);
    formData.append('muestra_tomada', rechazarValue);
    formData.append('observaciones', comentario);
    formData.append('estudio_id', rowData.ID_SERVICIO);

    if (archivo) {
        formData.append('evidencia', archivo);
    }

    //console.log(rowData)

    // Datos de la fila original de DataTables
    //console.log('Datos de la fila:', rowData);
    //console.log('Contendor:', rowData.CONTENEDOR)
    //console.log('muestra', rowData.MUESTRA);
    //console.log('Índice de fila:', rowIndex);
    //console.log('¿Rechazar?:', rechazarValue); // "1" para Sí, "0" para No
    //console.log('Comentario:', comentario);
    //console.log('Archivo:', archivo);
    //console.log(dataJsonMuestras.id_turno)
    //console.log(rowData)

    ajaxAwaitByFormData(formData, 'recepcion_api', {callbackAfter: true, alertBefore: false}, false, (data) => {
        //console.log(data)
        alertToast('Comentario añaido exitosamente.', 'success')
        //alert('Estudio guardado correctamente');
    });
});
