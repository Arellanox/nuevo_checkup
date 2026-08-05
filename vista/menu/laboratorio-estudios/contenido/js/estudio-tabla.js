// Variables locales
var SelectEstudios = false;

var tablaServicio = $('#TablaEstudioServicio').DataTable({
    language: {
        url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json",
    },
    scrollY: '58vh', //347px  scrollCollapse: true,
    lengthMenu: [[15, 20, 25, 30, 35, 40, 45, 50, -1], [15, 20, 25, 30, 35, 40, 45, 50, "All"]],
    ajax: {
        dataType: 'json',
        data: {api: 2, id_area: '6,12', tipgrupo: 0},
        method: 'POST',
        url: '../../../api/servicios_api.php',
        beforeSend: function () {
            loader("In")
        },
        complete: function () {
            loader("Out")
        },
        dataSrc: ''
    },
    columns: [
        {data: 'COUNT'},
        {data: 'ID_SERVICIO'},
        {data: 'DESCRIPCION'},
        {data: 'ABREVIATURA'},
        {data: 'CLASIFICACION_EXAMEN'},
        {data: 'DESCRIPCION_AREA'},
        {
            data: 'LABORATORIO', render: function (data, row, type) {
                if (row.LABORATORIO_ID == null) {
                    return ''
                } else {
                    return data
                }
            }
        },
        {
            data: 'SE_MAQUILA', render: function (data) {
                if (data === '0') {
                    return ''
                } else {
                    return 'Maquilado'
                }
            }
        },
        { data: 'ACTIVO' },
        {
            data: 'VENTA_INDIVIDUAL', render: function(data, type, row){
                var checked = data == 1 ? 'checked' : ''; 
                
                return `<input type="checkbox" class="chk-venta-individual" data-id="${row.ID_SERVICIO}" ${checked} style="transform: scale(1.8); cursor: pointer;">`;
            }
        }
        // {defaultContent: 'En progreso...'}
    ],
    columnDefs: [
        // { width: '100%' },
        {"width": "3px", "targets": [0, 4]},
    ],

    dom: 'Blfrtip',
    buttons: [
        {
            text: '<i class="bi bi-pencil-square"></i> Editar',
            className: 'btn btn-pantone-7408',
            action: function () {
                if (array_selected != null) {
                    getDataFirst(1, array_selected['ID_SERVICIO'])
                } else {
                    alertSelectTable();
                }
            }
        },
        {
            text: '<i class="bi bi-rulers"></i> Referencia',
            className: 'btn btn-pantone-325 ',
            action: function () {

                if (!SelectEstudios) {
                    alertSelectTable();
                    return false;
                }

                TablaValoresReferencia.clear().draw()
                TablaValoresReferencia.ajax.reload()
                $(myModal).trigger("reset");

                $('#titleValoresReferencia').html(`Asignar valores de referencia al servicio: (<b>${array_selected['DESCRIPCION']}</b>)`);

                $('#modalReferencia').modal('show');
            }
        },
        {
            extend: 'excelHtml5',
            text: '<i class="fa fa-file-excel-o"></i> Excel',
            className: 'btn btn-success',
            titleAttr: 'Excel',
            attr: {
                'data-bs-toggle': "tooltip",
                'data-bs-placement': "top",
                title: "Genere el formato por toda la tabla de pacientes o filtrado (Filtrado por: Fecha, Procedencia...)"
            }
            // exportOptions: {
            //   // Especifica las columnas que deseas exportar
            //   columns: [0, 1, 8, 3, 2, 4, 6, 7, 5, 9, 10, 11]
            // }

        },
        {
            text: '<i class="bi bi-trash-fill"></i> Inhabilitar',
            className: 'btn btn-danger',
            action: function (){
                if(array_selected != null){
                    // si algo esta seleccionado, continuamos con el proceso de inhabilitar
                    alertMensajeConfirm(
                        {
                            title: '¿Inhabilitar estudio ' + array_selected['DESCRIPCION'] + '?',
                            text: 'Calma, se puede activar nuevamente después',
                            icon: 'warning',
                        },function(){
                            // proceso en caso de presionar el boton de confirmar
                            ajaxAwait(
                              {api: 4, servicio_id: array_selected['ID_SERVICIO']}, 'laboratorio_api', {callbackAfter: true}, false, (data) => {
                                
                                if(data.response.code == 1){
                                    alertToast("Servicio desactivado", 'info', 5000);
                                    tablaServicio.ajax.reload();
                                } else {
                                    alertToast("Imposible desactivar");
                                }

                                   
                              })
                        }, 1
                    )
                } else {
                    // de lo contrario, avisamos que debe seleccionar algo primero
                    alertSelectTable()
                }
            }
        }
    ],
})

$("#TablaEstudioServicio tbody").on('change', '.chk-venta-individual', function(){
    var checkbox = $(this);
    var id = checkbox.data('id');
    var estado = checkbox.is(":checked") ? 1 : 0;

    ajaxAwait(
        { api: 18, id_servicio: id, estado: estado }, 'servicios_api', {callbackAfter: true}, false, (data) => {
        
        if(data.response.code == 1){
            alertToast("Estado cambiado con éxito", 'info', 5000);
        } else {
            alertToast("Ha ocurrido un error");
        }

            
    })
})

selectDatatable("TablaEstudioServicio", tablaServicio, 0, 0, 0, 0, function (select, selectData) {

    if (select) {
        obtenerPanelInformacion(1, 'servicios_api', 'estudio');
        SelectEstudios = true;

        DataReferencia.servicio_id = array_selected['ID_SERVICIO']
        //   console.log(select);
        //   infoServicioEdit = getInfoServicioLab(select['ID_SERVICIO']);
        //   console.log(infoServicioEdit)
        //   // obtenerPanelInformacion(1, infoServicioEdit, 'signos-vitales', '#signos-vitales'); //<-- en la opcion 2 mando arreglo, pero deberia estar la api donde ira, pero el case necesita la info, no busca en ajax
    } else {
        SelectEstudios = false;

        //   infoServicioEdit = false;
        //   // obtenerPanelInformacion(0, null, 'signos-vitales', '#signos-vitales'); //<-- en la opcion 2 mando arreglo, pero deberia estar la api donde ira, pero el case necesita la info, no busca en ajax

    }

}, function (data) {
    if (!data) return;
    mostrarDetalleEstudio(data);
})

function mostrarDetalleEstudio(data) {
    const estudioConsulta = data?.DESCRIPCION || data?.ABREVIATURA || data?.ID_SERVICIO;
    if (!estudioConsulta) {
        return;
    }

    const $modal = $('#modalDetalleEstudio');
    $modal.find('.modal-title').text(data?.DESCRIPCION || 'Detalle del estudio');
    $modal.find('.modal-body').html(`
        <div class="text-center py-5">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Cargando...</span>
            </div>
            <p class="mt-3 mb-0">Buscando información del estudio…</p>
        </div>
    `);
    $modal.modal('show');

    $.ajax({
        url: `${http}${servidor}/${appname}/api/recepcion_api.php`,
        method: 'POST',
        dataType: 'json',
        data: {
            api: 15,
            estudio: estudioConsulta
        },
        success: function (response) {
            const resultado = response?.response?.data || response;
            const estudio = Array.isArray(resultado) ? resultado[0] : resultado;
            if (estudio) {
                $modal.find('.modal-title').text(estudio.DESCRIPCION || data.DESCRIPCION || 'Detalle del estudio');
                $modal.find('.modal-body').html(construirContenidoModalEstudio(estudio));
            } else {
                $modal.find('.modal-body').html('<div class="text-center text-danger py-5">No se encontró información del estudio.</div>');
            }
        },
        error: function () {
            $modal.find('.modal-body').html('<div class="text-center text-danger py-5">No se pudo cargar la información. Intenta nuevamente.</div>');
        }
    });
}

function construirContenidoModalEstudio(estudio) {
    const nombre = textSafe(estudio.DESCRIPCION || estudio.SERVICIO || estudio.NOMBRE_ESTUDIO, 'Sin nombre');
    const clasificacion = textSafe(estudio.CLASIFICACION_EXAMEN || estudio.CLASIFICACION, 'No disponible');
    const area = textSafe(estudio.DESCRIPCION_AREA || estudio.AREA, 'No disponible');
    const entrega = textSafe(estudio.DIAS_DE_ENTREGA, 'Por confirmar');
    const muestra = textSafe(estudio.MUESTRA || estudio.TIPO_MUESTRA, 'No especificada');
    const contenedor = textSafe(estudio.CONTENEDOR, 'No especificado');
    const conservacion = textSafe(estudio.CONSERVACION, 'No aplica');
    const metodologia = textSafe(estudio.METODOLOGIA_NOMBRE || estudio.METODO || estudio.METODOLOGIA, 'No disponible');
    const detalle = textSafe(estudio.DETALLE_SERVICIO || estudio.DESCRIPCION_DETALLE, 'No hay detalles adicionales.');
    const indicaciones = textSafe(estudio.INDICACIONES || estudio.INDICACIONES_LABORATORIO, 'No hay indicaciones específicas.');
    const motivoRechazo = textSafe(estudio.MOTIVO_RECHAZO, 'Sin criterios de rechazo definidos.');
    const laboratorio = textSafe(estudio.LABORATORIO, 'No disponible');
    const laboratorioMaquila = textSafe(estudio.LABORATORIO_MAQUILA, 'No disponible');
    const esGrupo = String(estudio.ES_GRUPO) === '1';
    const activo = estudio.ACTIVO == 1 || estudio.ACTIVO === '1' ? 'Activo' : 'Inactivo';
    const ventaIndividual = estudio.VENTA_INDIVIDUAL == 1 || estudio.VENTA_INDIVIDUAL === '1' ? 'Sí' : 'No';
    const seMaquila = estudio.SE_MAQUILA == 1 || estudio.SE_MAQUILA === '1' ? 'Sí' : 'No';

    return `
        <div class="row gy-4">
            <div class="col-12">
                <div class="d-flex flex-column flex-md-row justify-content-between gap-3 align-items-start">
                    <div>
                        <h5 class="mb-1">${nombre}</h5>
                        <p class="text-muted mb-0">${clasificacion} · Entrega: ${entrega}</p>
                    </div>
                    <div class="d-flex flex-wrap gap-2">
                        <span class="badge bg-primary">${area}</span>
                        <span class="badge bg-${activo === 'Activo' ? 'success' : 'secondary'}">${activo}</span>
                        <span class="badge bg-info text-dark">Venta individual: ${ventaIndividual}</span>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="mb-3 text-uppercase text-secondary small fw-semibold">Datos del estudio</div>
                ${renderFicha('Área', area, 'bi-tags')}
                ${renderFicha('Abreviatura', estudio.ABREVIATURA, 'bi-upc-scan')}
                ${renderFicha('Tiempo de entrega', entrega, 'bi-clock')}
                ${renderFicha('Metodología', metodologia, 'bi-clipboard2-pulse')}
                ${renderFicha('Laboratorio', laboratorio, 'bi-building')}
                ${renderFicha('Maquilado', seMaquila, 'bi-box-seam')}
                ${seMaquila ? renderFicha('Laboratorio maquila', laboratorioMaquila, 'bi-tools') : ''}
            </div>
            <div class="col-12 col-lg-6">
                <div class="mb-3 text-uppercase text-secondary small fw-semibold">Toma y manejo de muestra</div>
                ${renderFicha('Tipo de muestra', muestra, 'bi-droplet')}
                ${renderFicha('Contenedor', contenedor, 'bi-box-seam')}
                ${renderFicha('Conservación', conservacion, 'bi-thermometer-half')}
                ${renderFicha('Estatus', activo, 'bi-check-circle')}
                ${renderFicha('Venta individual', ventaIndividual, 'bi-cart-check')}
            </div>
            <div class="col-12">
                <div class="mb-2 text-uppercase text-secondary small fw-semibold">Detalle</div>
                <div class="p-3 rounded-3 bg-light text-muted">${detalle}</div>
            </div>
            <div class="col-12">
                <div class="mb-2 text-uppercase text-secondary small fw-semibold">Indicaciones</div>
                <div class="p-3 rounded-3 bg-light text-muted">${indicaciones}</div>
            </div>
            <div class="col-12">
                <div class="mb-2 text-uppercase text-secondary small fw-semibold">Criterios de rechazo</div>
                <div class="p-3 rounded-3 bg-light text-muted">${motivoRechazo}</div>
            </div>
            ${esGrupo ? `
            <div class="col-12">
                <div class="mb-2 text-uppercase text-secondary small fw-semibold">Es un grupo / perfil</div>
                <div class="p-3 rounded-3 bg-light text-muted">Este estudio pertenece a un grupo o perfil de laboratorio.</div>
            </div>
            ` : ''}
        </div>
    `;
}

function textSafe(value, fallback = '-') {
    if (value === null || value === undefined) return fallback;
    if (typeof value === 'string' && value.trim() === '') return fallback;
    return String(value);
}

function renderFicha(label, value, icon) {
    if (value === null || value === undefined || String(value).trim() === '') {
        return '';
    }
    return `
        <div class="d-flex align-items-start gap-2 mb-3">
            <i class="bi ${icon} text-primary fs-5"></i>
            <div>
                <div class="fw-semibold">${textSafe(label)}</div>
                <div class="text-muted">${textSafe(value)}</div>
            </div>
        </div>
    `;
}

inputBusquedaTable('TablaEstudioServicio', tablaServicio, [], [], 'col-12')

