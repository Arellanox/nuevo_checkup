

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
                return `<input type="radio" name="rechazar_value" id="si_rechazar_${meta.row}" value="1" class="dt-checkbox btn-check form-check-input" data-row-index="${meta.row}" onclick="selectOnlyThis(this, 1)">
                <label class="btn btn-outline-success" for="si_rechazar_${meta.row}">Si</label>`;
            },
            className: 'text-center',
        },
        // No
        {
            data: null, render: function (data, type, row, meta) {
                return `<input type="radio" name="rechazar_value" id="no_rechazar_${meta.row}" value="0" class="dt-checkbox  btn-check  form-check-input" data-row-index="${meta.row}" onclick="selectOnlyThis(this, 0)">
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
                        <input type="file" name="capturas_evidencia" class="custom-file-input dt-checkbox" id="customFile_${meta.row}" aria-describedby="inputGroupFileAddon04" onchange="updateLabel(this)" data-row-index="${meta.row}">
                        <label class="custom-file-label text-center" for="customFile_${meta.row}" data-browse="Seleccionar archivo">Subir Archivo</label>
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
                        class="btn btn-save_dataMuestra btn-hover me-2 d-flex align-items-center"
                        style="margin-bottom:4px;">
                            <i class="bi bi-floppy btn-save_dataMuestra"></i>
                            <span class="d-none d-xl-block btn-save_dataMuestra">Guardar</span>
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

selectTable('#pacienteEstudios', pacienteEstudios, {
    OnlyData: true,
    ClickClass: [
        {
            class: 'btn-save_dataMuestra',
            callback: function (data, elementClick, tr) {
                // Data siendo los datos del row
                // Obtenemos el índice de la fila del botón que se presionó
                // let rowIndex = $(this).data('row-index');

                let row = pacienteEstudios.row(tr);
                let rowIndex = row.index(); // Obtiene el índice de la fila

                // Inicializamos un objeto para almacenar los datos de la fila
                let datosFila = {
                    rowIndex: rowIndex,
                };

                // Buscamos todos los inputs y textareas dentro de la fila
                $(`[data-row-index="${rowIndex}"], [data-row-index="${rowIndex}"]`).each(function () {
                    let $elemento = $(this);
                    let nombre = $elemento.attr('name');
                    let tipo = $elemento.prop('type');
                    let valor = null;


                });

                // Aquí puedes procesar los datos de la fila como necesites
                console.log(datosFila);

            },
            selected: true
        },
    ]
})




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


/*
 // Obtenemos el índice de la fila del botón que se presionó
        let rowIndex = $(this).data('row-index');

        // Inicializamos un objeto para almacenar los datos de la fila
        let datosFila = {
            rowIndex: rowIndex,
            elementos: []
        };

        // Buscamos todos los elementos con clase 'dt-checkbox' que estén en la misma fila que el botón
        $(`.dt-checkbox[data-row-index="${rowIndex}"]`).each(function() {
            let $elemento = $(this);
            let tipo = $elemento.prop('tagName').toLowerCase(); // 'input' o 'textarea'
            let valor = null;

            // Verificamos el tipo de elemento y recuperamos los datos correspondientes
            if ($elemento.attr('type') === 'checkbox') {
                tipo += ' checkbox';
                valor = $elemento.is(':checked');
            } else if ($elemento.attr('type') === 'file') {
                tipo += ' file';
                valor = $elemento[0].files.length > 0 ? $elemento[0].files[0].name : '';
            } else if (tipo === 'textarea') {
                valor = $elemento.val();
            }

            // Añadimos los datos del elemento al arreglo de elementos de la fila
            datosFila.elementos.push({
                tipo: tipo,
                valor: valor
            });
        });

        // Aquí puedes procesar los datos de la fila como necesites
        console.log(datosFila);

        */