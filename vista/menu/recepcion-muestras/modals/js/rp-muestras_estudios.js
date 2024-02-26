

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
                return `<input type="checkbox" name="rechazar_value" id="si_rechazar_${meta.row}" value="1" class="dt-checkbox btn-check form-check-input" data-row-index="${meta.row}" onclick="selectOnlyThis(this, 1)">
                <label class="btn btn-outline-success" for="si_rechazar_${meta.row}">Si</label>`;
            },
            className: 'text-center',
        },
        // No
        {
            data: null, render: function (data, type, row, meta) {
                return `<input type="checkbox" name="rechazar_value" id="no_rechazar_${meta.row}" value="0" class="dt-checkbox  btn-check  form-check-input" data-row-index="${meta.row}" onclick="selectOnlyThis(this, 0)">
                <label class="btn btn-outline-danger" for="no_rechazar_${meta.row}">No</label>`;
            },
            className: 'text-center',
        },

        // Observaciones
        {
            data: null, render: function (data, type, row, meta) {
                let html = `<textarea name="comentario" class="md-textarea input-form dt-checkbox" rows="1" data-row-index="${meta.row}"></textarea>`;
                return html;
            }
        },
        // Evidencia
        {
            data: null, render: function (data, type, row, meta) {
                let html = `
                    <div class="input-group input_file_label">
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
                let html = `
                    <button type="button" data-row-index="${meta.row}"
                        class="btn btn-confirmar btn-hover me-2 d-flex align-items-center"
                        style="margin-bottom:4px;">
                            <i class="bi bi-floppy"></i>
                            <span class="d-none d-xl-block">Guardar</span>
                    </button>
                `

                return html;
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



inputBusquedaTable('pacienteEstudios', pacienteEstudios, [{
    msj: 'Filtra los pacientes con información clave.',
    place: 'top'
}], [], 'col-12')


// Observa si un input es si o no
function selectOnlyThis(checkbox, type) {
    var rowIndex = checkbox.getAttribute('data-row-index');
    console.log(rowIndex)
    var checkboxes = document.querySelectorAll('input[type="checkbox"][data-row-index="' + rowIndex + '"]');
    checkboxes.forEach((item) => {
        item.checked = false
        // Check if the checkbox is not the one clicked and has the same type (si or no)
        if (item.value == type) item.checked = true;
    });
}



// |-------------------- Observa el modal --------------------|

const modalRecepcionMuestras = document.getElementById("modalRecepcionMuestras"); // Declaramos una constante con el id del modal
// recarga el diseño de la tabla antes de que se llegue abirir el modal
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

