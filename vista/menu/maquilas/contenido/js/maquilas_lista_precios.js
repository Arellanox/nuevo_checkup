let tablaServicios; // variable global para DataTable

//---Modal listado de precios por laboratorios
$('#btn-modal-lista-precios').on('click', function (event) {
    event.preventDefault();
    $('#modalListaPreciosEstLab').modal('show');
    rellenarOrdenarSelect('#select-laboratorios-maquila-by-list', 'laboratorio_maquila_api', 2, 'ID_LABORATORIO', 'DESCRIPCION');
})

$('#btn-confirm-laboratorio').on('click', function (event) { //---Consultar API para obtener los servicios y estudios del laboratorio seleccionado
    event.preventDefault();

    ajaxAwait({
        api: 10,
        LABORATORIO_MAQUILA_ID: $('#select-laboratorios-maquila-by-list').val()
    }, 'laboratorio_solicitud_maquila_api', { callbackAfter: true }, false, function (response) {
        $('#empty_message').css('display', 'none');
        $('#btn-confirm-laboratorio').css('background', '#30614f');

        $('#TablaListadoPreciosEstudiosLab tbody').empty();

        inicializarTablaServicios(response.response.data)
    });
});

function inicializarTablaServicios(servicios) {
    // Destruir tabla anterior si existe
    if ($.fn.DataTable.isDataTable('#TablaListadoPreciosEstudiosLab')) {
        $('#TablaListadoPreciosEstudiosLab').DataTable().destroy();
        $('#TablaListadoPreciosEstudiosLab tbody').empty();
    }

    // Inicializar DataTable
    tablaServicios = $('#TablaListadoPreciosEstudiosLab').DataTable({
        language: { url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json" },
        scrollCollapse: true,
        deferRender: true,
        scrollY: '45vh',
        paging: true,
        ordering: false,
        info: true,
        data: servicios,
        columns: [
            {
                className: 'dt-control',
                orderable: false,
                data: null,
                defaultContent: '',
                render: function(data, type, row, meta) {
                    return meta.row + 1; // número de fila
                },
                width: "20px"
            },
            {
                data: 'DESCRIPCION',
                render: function (data, type, row) {
                    return `
                        <span class="badge badge-${row.ES_GRUPO ? 'primary' : 'secondary'}">
                            ${row.ES_GRUPO ? 'GRUPO' : 'INDIVIDUAL'}
                        </span>
                        ${data} ${row.ABREVIATURA ? `<small class="text-muted">(${row.ABREVIATURA})</small>` : ''}
                        <br><small class="text-success">Precio: ${parseFloat(row.PRECIO_VENTA || 0).toFixed(2)}</small>
                    `;
                }
            },
            {
                data: 'ESTUDIOS',
                render: function (data) {
                    return `<span class="badge badge-info">${data.length} estudio${data.length > 1 ? 's' : ''}</span>`;
                }
            }
        ]
    });

    // Click para expandir/contraer child row
    $('#TablaListadoPreciosEstudiosLab tbody').off('click', 'td.dt-control').on('click', 'td.dt-control', function () {
        const tr = $(this).closest('tr');
        const row = tablaServicios.row(tr);

        if (row.child.isShown()) {
            row.child.hide();
            tr.removeClass('shown');
            $(this).find('i').removeClass('bi-caret-down-fill').addClass('bi-caret-right-fill');
        } else {
            row.child(formatearEstudiosListaPrecios(row.data().ESTUDIOS)).show();
            tr.addClass('shown');
            $(this).find('i').removeClass('bi-caret-right-fill').addClass('bi-caret-down-fill');
        }
    });

    inputBusquedaTable('TablaListadoPreciosEstudiosLab', tablaServicios, [
        {
            msj: 'Filtra la tabla con palabras u oraciones que coincidan en el campo de busqueda',
            place: 'left'
        },
    ])

}

function formatearEstudiosListaPrecios(estudios) {
    if (!Array.isArray(estudios) || estudios.length === 0) {
        return '<div class="p-2 text-muted">Sin estudios relacionados.</div>';
    }

    let table = `
        <div class="table-responsive">
            <table class="table align-items-center mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Catalogo Original</th>
                        <th>Catalogo Laboratorio Ext.</th>
                    </tr>
                </thead>
                <tbody>
    `;

    estudios.forEach((estudio, index) => {
        const alias = estudio.ALIAS || {};
        const precioLab = alias.PRECIO ? parseFloat(alias.PRECIO).toFixed(2) : 'Sin precio';
        const clavelab = alias.LAB_ESTUDIO_CLAVE || 'Sin clave';
        const nombreAlias = alias.LAB_ESTUDIO_NOMBRE || 'Sin alias';
        const idAlias = alias.ID_ALIAS;
        const precioVenta = estudio.PRECIO_VENTA ? parseFloat(estudio.PRECIO_VENTA).toFixed(2) : 'Sin precio';

        table += `
            <tr class='tr-estudio-details' style="cursor: pointer" data-id-alias="${idAlias}" data-abreviatura="${clavelab}" data-alias="${nombreAlias}" data-precio="${precioLab}">
                 <td>
                    ${index + 1}
                 </td>
                <td>
                    <p><i class="bi bi-box2-heart"></i> <strong>Estudios:</strong> ${estudio.DESCRIPCION}</p>
                    <p><i class="bi bi-tag"></i> <strong>Abreviatura:</strong> ${estudio.ABREVIATURA || ''}</p>
                    <p><i class="bi bi-currency-dollar"></i> <strong>Precio:</strong> ${precioVenta}</p>
                </td>
                <td  style="position: relative; ">
                    <p style="color: #007bff;"><i class="bi bi-box2-heart"></i> <strong>Estudios:</strong> ${alias.LAB_ESTUDIO_NOMBRE || 'Sin alias'}</p>
                    <p style="color: #007bff;"><i class="bi bi-tag"></i> <strong>Abreviatura.:</strong> ${alias.LAB_ESTUDIO_CLAVE || 'Sin clave'}</p>
                    <p style="color: #007bff;"><i class="bi bi-currency-dollar"></i> <strong>Precio:</strong> ${alias.PRECIO ? parseFloat(alias.PRECIO).toFixed(2) : 'Sin precio'}</p>
                    
                    <span class="badge ${idAlias ? 'badge-info' : 'badge-warning'}" style="position: absolute; top: 4px; right: 10px; color: white !important;">
                        ${idAlias ? 'Actualizado' : 'Sin actualizar'}
                    </span>
                </td>
            </tr>
        `;
    });

    table += '</tbody></table></div>';
    return table;
}



