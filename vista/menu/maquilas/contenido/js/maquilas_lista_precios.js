
//---Modal listado de precios por laboratorios
$('#btn-modal-lista-precios').on('click', function (event) {
    event.preventDefault();
    $('#modalListaPreciosEstLab').modal('show');
    rellenarOrdenarSelect('#select-laboratorios-maquila-by-list', 'laboratorio_maquila_api', 2, 'ID_LABORATORIO', 'DESCRIPCION');
})

$('#btn-confirm-laboratorio').on('click', function (event) { //---Consultar API para obtener los servicios y estudios del laboratorio seleccionado
    event.preventDefault();
    getServiciosAndEstudiosAlias();
});

function getServiciosAndEstudiosAlias(){
    ajaxAwait({
        api: 10,
        LABORATORIO_MAQUILA_ID: $('#select-laboratorios-maquila-by-list').val()
    }, 'laboratorio_solicitud_maquila_api', { callbackAfter: true }, false, function (response) {
        $('#empty_message').css('display', 'none');
        $('#btn-confirm-laboratorio').css('background', '#30614f');

        $('#TablaListadoPreciosEstudiosLab tbody').empty();

        inicializarTablaServicios(response.response.data)
    });
}

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
        ajax: {
            dataType: 'json',
            data: function (d) {
                return {
                    api: 10,
                    LABORATORIO_MAQUILA_ID: $('#select-laboratorios-maquila-by-list').val()
                }
            },
            method: 'POST',
            url: `${http}${servidor}/${appname}/api/laboratorio_solicitud_maquila_api.php`,
            complete: function () {

                TablaVistaMedicosTratantes.columns.adjust().draw()
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alertErrorAJAX(jqXHR, textStatus, errorThrown);
            },
            dataSrc: 'response.data'
        },
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
                        <br>
                        <div class="d-flex gap-4">
                            <small class="text-success">Precio: <span class="text-muted">$${parseFloat(row.GRUPO_PRECIO || 0).toFixed(2)}</span></small>
                            <small class="text-success">Grupo Nombre: <span class="text-muted"> ${row.GRUPO_LAB_ESTUDIO_NOMBRE ?? 'Sin establecer'}</span></small>
                        </div>
                    `;
                }
            },
            {
                data: 'ESTUDIOS',
                render: function (data, type, row) {
                    return `
                        <div class="d-block">
                            <span class="badge badge-info d-block w-max" style="border-radius: 10px 10px 0 0">
                                ${data.length} estudio${data.length > 1 ? 's' : ''}
                            </span>
                            <button 
                                onclick="asociarEstudios(null, ${row.ID_SERVICIO}, $('#select-laboratorios-maquila-by-list').val())" 
                                class="btn btn-confirmar p-1 text-xs text-white" 
                                style="width: 100%; border-radius: 0 0 10px 10px; font-size: 13px; font-weight: bold"
                            >Actualizar</button>
                        </div>
                    `;
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
        const idAlias = alias.ID_ALIAS;
        const precioVenta = estudio.PRECIO_VENTA ? parseFloat(estudio.PRECIO_VENTA).toFixed(2) : 'Sin precio';

        table += `
            <tr 
            data-bs-toggle="tooltip" data-bs-title="Clic para actualizar la información" data-bs-placement="right"
            onclick="asociarEstudios(${idAlias || null}, ${estudio.ID_ESTUDIO}, $('#select-laboratorios-maquila-by-list').val())" class='tr-estudio-details' style="cursor: pointer">
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

/*
let seletedTempLabId, selectedTempEstudioId, tempIdAlias;

function asociarEstudios(idAlias, estudioId, claveAlias, nombreAlias, precioAlias) {
    seletedTempLabId = $('#select-laboratorios-maquila-by-list').val();
    tempIdAlias = idAlias;
    selectedTempEstudioId = estudioId;

    $('#asociar_alias_estudio').val(nombreAlias != 'Sin alias' ? nombreAlias : '');
    $('#asociar_clave_estudio').val(claveAlias != 'Sin clave' ? claveAlias : '');
    $('#asociar_precio_estudio').val(precioAlias != 'Sin precio' ? precioAlias : 0);

    $('#modalAsociarEstudio').modal('show');
}

$("#btn_confirm_alias").on("click", function () {
    const precio = $('#asociar_precio_estudio').val();
    const clave = $('#asociar_clave_estudio').val();
    const alias = $('#asociar_alias_estudio').val();

    if (seletedTempLabId.length > 0 && clave.length > 0 && alias.length > 0) {
        alertMensajeConfirm({
            title: '¿Seguro de Registrar/Actualizar?',
            html: `Se registrará el Alías <strong>${alias}</strong> con la Cláve <strong>${clave}</strong>`,
            icon: 'warning',
            confirmButtonText: 'Registrar Alias',
        }, () => {
            ajaxAwait({
                SERVICIO_ESTUDIO_ID: selectedTempEstudioId,
                NOMBRE_ALIAS_ESTUDIO: alias,
                CLAVE_ALIAS_ESTUDIO: clave,
                PRECIO_ALIAS_ESTUDIO: precio ?? 0,
                LABORATORIO_MAQUILA_ID: seletedTempLabId,
                api: 9
            }, 'laboratorio_solicitud_maquila_api', {callbackAfter: true}, false, () => {
                alertMensaje('info', '¡Alias Registrado!', 'El alias se ha registrado con exito.');
                //getServiciosAndEstudiosAlias();
                //tablaServicios.ajax.reload()

                $('#modalAsociarEstudio').modal('hide');
            });
        }, 1);
    } else {
        alertToast('Selecciona un estudio, ingresa un alias e ingresa la clave del estudio.', 'warning', 4000);
    }
});

$(".btn-refresh").on("click", function () {
    tablaServicios.ajax.reload();
    alertMensaje("success", "Tabla actualizada!", "Ahora los cambios son visibles")
})*/
