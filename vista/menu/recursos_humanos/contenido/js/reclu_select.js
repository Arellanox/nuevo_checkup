// DataTable para las requisiciones vacantes aprobadas
tableRequisicionesAprobadas = $("#tableRequisicionesAprobadas").DataTable({
    language: {
        url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json",
    },
    autoWidth: true,
    lengthChange: false,
    info: true,
    paging: true,
    pageLength: 10,
    order: [[5, 'desc']], // Ordenar por prioridad
    scrollY: "60vh",
    scrollCollapse: true,
    ajax: {
        dataType: "json",
        data: function (d) {
            return $.extend(d, dataTableRequisicionesAprobadas);
        },
        method: "POST",
        url: "../../../api/recursos_humanos_api.php",
        error: function (jqXHR, textStatus, errorThrown) {
            console.error("Error en AJAX:", jqXHR, textStatus, errorThrown);
            alertErrorAJAX(jqXHR, textStatus, errorThrown);
        },
        dataSrc: function(json) {
            console.log("Datos recibidos:", json); // Para debug
            return json.response.data || [];
        }
    },
    columns: [
        { data: "numero_requisicion", title: "No. Requisición" },
        { data: "puesto_nombre", title: "Cargo", defaultContent: "Sin especificar" },
        { 
            data: "estado_publicacion", 
            title: "Estado Publicación",
            render: function(data) {
                const badges = {
                    'no_publicada': '<span class="badge bg-secondary">No publicada</span>',
                    'publicada_normal': '<span class="badge bg-primary">Publicada</span>',
                    'publicada_editada': '<span class="badge bg-primary">Publicada</span>',
                    'detenida': '<span class="badge bg-warning">Detenida</span>',
                    'cerrada': '<span class="badge bg-dark">Cerrada</span>'
                };
                // Manejar valores null o undefined
                const estado = data || 'no_publicada';
                return badges[estado] || '<span class="badge bg-secondary">No publicada</span>';
            }
        },
        { data: "tipo_publicacion", title: "Tipo de Publicación",
            render: function(data) {
                const badges = {
                    'interna' : '<span class="badge bg-success">Interna</span>',
                    'externa' : '<span class="badge bg-info">Externa</span>',
                    'ambas' : '<span class="badge bg-warning">Ambas</span>'
                };
                return badges[data] || '<span class="badge bg-secondary">Sin publicación</span>';
            }
        },
        { data: "departamento_nombre", title: "Área" },
        { 
            data: "prioridad", 
            title: "Prioridad",
            render: function(data) {
                const badges = {
                    'urgente': '<span class="badge bg-danger">Urgente</span>',
                    'normal': '<span class="badge bg-primary">Normal</span>',
                    'baja': '<span class="badge bg-secondary">Baja</span>'
                };
                return badges[data] || '<span class="badge bg-light">N/A</span>';
            }
        },
        { 
            data: "fecha_inicio_publicacion", 
            title: "Fecha Publicación",
            render: function(data) {
                if (data && data !== null) {
                    return new Date(data).toLocaleDateString('es-MX');
                }
                return '-';
            }
        },
        {
            data: null,
            title: "Acciones",
            render: function(data, type, row) {
                // Manejar estado de publicación null/undefined
                let estadoPublicacion = row.estado_publicacion || 'no_publicada';
                let botones = '';
                let mostrarVerDetalles = true;
                
                switch(estadoPublicacion) {
                    case 'no_publicada':
                        botones = `
                            <button type="button" class="btn btn-sm btn-primary bg-gradient-success btn-publicar-vacante" 
                                    data-id-requisicion="${row.id_requisicion}" 
                                    data-numero="${row.numero_requisicion}"
                                    title="Publicar vacante">
                                <i class="bi bi-megaphone"></i>
                            </button>`;
                        mostrarVerDetalles = false;
                        break;
                        
                    case 'publicada_normal':
                        botones = `
                            <button class="btn btn-sm btn-primary bg-gradient-secondary btn-detener-publicacion" 
                                    data-id-publicacion="${row.id_publicacion}" 
                                    title="Detener publicación">
                                <i class="bi bi-pause-circle"></i>
                            </button>
                            <button class="btn btn-primary btn-sm bg-gradient-warning btn-editar-publicacion" 
                                    data-id-publicacion="${row.id_publicacion}"
                                    title="Editar publicación">
                                <i class="bi bi-pencil"></i>
                            </button>`;
                        break;

                    case 'publicada_editada':
                        botones = `
                            <button class="btn btn-sm btn-primary bg-gradient-secondary btn-detener-publicacion" 
                                    data-id-publicacion="${row.id_publicacion}" 
                                    title="Detener publicación">
                                <i class="bi bi-pause-circle"></i>
                            </button>
                            <button class="btn btn-primary btn-sm bg-gradient-warning btn-editar-publicacion" 
                                    data-id-publicacion="${row.id_publicacion}"
                                    title="Editar publicación">
                                <i class="bi bi-pencil"></i>
                            </button>`;
                        break;
                        
                    case 'detenida':
                        botones = `
                            <button class="btn btn-sm btn-success btn-reanudar-publicacion" 
                                    data-id-publicacion="${row.id_publicacion}" 
                                    title="Reanudar publicación">
                                <i class="bi bi-play-circle"></i>
                            </button>
                            <button class="btn btn-sm btn-dark btn-cerrar-publicacion" 
                                    data-id-publicacion="${row.id_publicacion}" 
                                    title="Cerrar publicación">
                                <i class="bi bi-x-circle"></i>
                            </button>`;
                        break;
                }
                
                // Botón de ver detalles solo si no es 'no_publicada'
                if (mostrarVerDetalles) {
                    botones += `
                        <button class="btn btn-sm btn-primary btn-ver-requisicion" 
                                data-id="${row.id_publicacion}" 
                                title="Ver detalles"
                                data-bs-target="#"
                                data-bs-toggle="modal">
                            <i class="bi bi-eye"></i>
                        </button>`;
                }
                
                return `<div class="btn-group" role="group">${botones}</div>`;
            }
        },
        // Columnas ocultas para datos adicionales
        { data: "id_requisicion", visible: false },
        { data: "id_publicacion", visible: false },
        { data: "titulo_vacante", visible: false },
        { data: "descripcion_adicional", visible: false },
        { data: "max_postulantes", visible: false },
        { data: "fecha_limite_publicacion", visible: false },
        { data: "plataformas_publicacion", visible: false },
        { data: "criterios_cierre_automatico", visible: false }
    ],
    columnDefs: [
        { targets: "_all", className: "text-center align-middle" }
    ],
    dom: 'Bl<"dataTables_toolbar">frtip',
    buttons: [
        {
            text: '<i class="bi bi-arrow-clockwise"></i> Actualizar',
            className: "btn btn-primary btn-sm",
            action: function() {
                tableRequisicionesAprobadas.ajax.reload();
            }
        },
        {
            text: '<i class="bi bi-clock-history"></i> Historial',
            className: "btn btn-gradient-secondary btn-sm",
            attr: {
                id: "btnHistorialPublicaciones",
                "data-bs-toggle": "tooltip",
                "data-bs-toggle": "tooltip",
                "data-bs-placement": "top",
                title: "Historial de movimientos",
            },
            action: function() {
                // Aquí puedes cargar el contenido del modal de transacciones si es necesario
                $("#historialPublicacionesModal").modal('show');
                tableHistorialPublicaciones.ajax.reload();
            },
        },
    ],
});

// DataTable para el historial de publicaciones
tableHistorialPublicaciones = $("#tableHistorialPublicaciones").DataTable({
    language: {
        url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json",
    },
    autoWidth: true,
    lengthChange: false,
    info: true,
    paging: true,
    pageLength: 6,
    order: [[10, 'desc']], // Ordenar por prioridad
    scrollY: "60vh",
    scrollCollapse: true,
    ajax: {
        dataType: "json",
        data: function (d) {
            return $.extend(d, dataTableHistorialPublicaciones);
        },
        method: "POST",
        url: "../../../api/recursos_humanos_api.php",
        error: function (jqXHR, textStatus, errorThrown) {
            console.error("Error en AJAX:", jqXHR, textStatus, errorThrown);
            console.log("Respuesta del servidor:", jqXHR.responseText);
            alertErrorAJAX(jqXHR, textStatus, errorThrown);
        },
        dataSrc: function(json) {
            console.log("Datos recibidos del servidor:", json);
            if (json.response && json.response.data) {
                return json.response.data;
            } else if (json.data) {
                return json.data;
            }
            console.error("Estructura de datos inesperada:", json);
            return [];
        }
    },
    columns: [
        { data: "id_historial", title: "ID Historial" },
        {
            data: "numero_requisicion",
            title: "No. Requisición",
            render: function(data, type, row) {
                return `<span class="fw-bold text-primary">#${data}</span>`;
            }
        },
        { data: "titulo_vacante", title: "Vacante Publicada" },
        { data: "departamento_nombre", title: "Departamento" },
        { data: "id_publicacion", title: "ID Publicación", visible: false },
        { data: "puesto_nombre", visible: false },
        {
            data: "estado_anterior",
            title: "Estado Anterior",
            visible: false,
            render: function(data) {
                if (!data) return '<span class="badge bg-secondary">Inicial</span>';

                const badges = {
                    'no_publicada': '<span class="badge bg-secondary">No publicada</span>',
                    'publicada_normal': '<span class="badge bg-success">Publicada</span>',
                    'publicada_editada': '<span class="badge bg-info">Publicada (Editada)</span>',
                    'detenida': '<span class="badge bg-warning">Pausada</span>',
                    'cerrada': '<span class="badge bg-danger">Cerrada</span>'
                };
                return badges[data] || `<span class="badge bg-light text-dark">${data}</span>`;
            }
        },
        { 
            data: "estado_nuevo", 
            title: "Estado Nuevo",
            visible: false,
            render: function(data) {
                const badges = {
                    'no_publicada': '<span class="badge bg-secondary">No publicada</span>',
                    'publicada_normal': '<span class="badge bg-success">Publicada</span>',
                    'publicada_editada': '<span class="badge bg-info">Publicada (Editada)</span>',
                    'detenida': '<span class="badge bg-warning">Pausada</span>',
                    'cerrada': '<span class="badge bg-danger">Cerrada</span>'
                };
                return badges[data] || `<span class="badge bg-light text-dark">${data}</span>`;
            }
        },
        { 
            data: "comentarios", 
            title: "Comentarios"
        },
        { data: "usuario_responsable", title: "Responsable" },
        { 
            data: "fecha_cambio", 
            title: "Fecha/Hora",
            render: function(data) {
                if (data && data !== null) {
                    const fecha = new Date(data);
                    return `<div class="text-nowrap">
                        <div class="fw-bold">${fecha.toLocaleDateString('es-MX')}</div>
                        <small class="text-muted">${fecha.toLocaleTimeString('es-MX', {hour: '2-digit', minute: '2-digit'})}</small>
                    </div>`;
                }
                return '-';
            }
        },
        // Columnas ocultas para datos adicionales del modal
        { data: "tipo_publicacion", visible: false },
        { data: "fecha_inicio_publicacion", visible: false },
        { data: "fecha_limite_publicacion", visible: false },
        { data: "prioridad", visible: false }
    ],
    columnDefs: [
        { targets: "_all", className: "text-center align-middle" },
        { targets: [2, 9], className: "text-start" } // Título y comentarios alineados a la izquierda
    ],
    dom: 'Bl<"dataTables_toolbar">frtip',
    buttons: [],
});


// Event listeners para los botones de publicación

$(document).on('click', '.btn-publicar-vacante', function() {
    let idRequisicion = $(this).data('id-requisicion');
    let numeroRequisicion = $(this).data('numero');
    
    // Buscar datos de la requisición
    let requisicionData = tableRequisicionesAprobadas.row(function(idx, data, node) {
        return data.id_requisicion == idRequisicion;
    }).data();
    
    if (!requisicionData) {
        alertToast('Error: No se encontraron los datos de la requisición', 'error', 4000);
        return;
    }
    
    // Establecer fecha límite por defecto (30 días)
    let fechaLimiteDefault = new Date();
    fechaLimiteDefault.setDate(fechaLimiteDefault.getDate() + 30);
    let fechaFormateada = fechaLimiteDefault.toISOString().split('T')[0];
    
    // Generar título automáticamente
    const tituloGenerado = `Vacante: ${requisicionData.puesto_nombre || 'Sin especificar'}`;
    
    // Llenar los datos del modal
    $('#id_requisicion_pub').val(idRequisicion);
    $('#titulo_vacante_hidden').val(tituloGenerado);
    $('#numero_requisicion_display').text('#' + (numeroRequisicion || requisicionData.numero_requisicion));
    $('#puesto_nombre_display').text(requisicionData.puesto_nombre || 'Sin especificar');
    $('#departamento_nombre_display').text(requisicionData.departamento_nombre || 'Sin especificar');
    $('#titulo_vacante_display').text(tituloGenerado);
    
    // Establecer badge de prioridad
    const prioridadBadges = {
        'urgente': '<span class="badge bg-danger">Urgente</span>',
        'normal': '<span class="badge bg-primary">Normal</span>',
        'baja': '<span class="badge bg-secondary">Baja</span>'
    };
    $('#prioridad_display').html(prioridadBadges[requisicionData.prioridad] || '<span class="badge bg-light">N/A</span>');
    
    // Pre-llenar campos
    // $('#fecha_limite_publicacion').val(fechaFormateada);
    // $('#fecha_limite_publicacion').attr('min', new Date().toISOString().split('T')[0]);
    // $('#max_postulantes').val();
    
    // Resetear formulario
    $('#tipo_publicacion').val('');
    $('#descripcion_adicional').val('');
    
    // Limpiar configuración avanzada
    $('#configAvanzada').removeClass('show');
    $('input[name="plataformas[]"]').prop('checked', false);
    $('#plataforma_web').prop('checked', true); // Web siempre marcado por defecto
    
    // Mostrar el modal
    $('#publicarVacanteModal').modal('show');
});

// Event listener para botón editar publicación (SIMPLIFICADO)
$(document).on('click', '.btn-editar-publicacion', function() {
    let idPublicacion = $(this).data('id-publicacion');
    
    if (!idPublicacion) {
        alertToast('ID de publicación no válido', 'error', 3000);
        return;
    }
    
    // Buscar datos de la publicación en la tabla
    let publicacionData = tableRequisicionesAprobadas.row(function(idx, data, node) {
        return data.id_publicacion == idPublicacion;
    }).data();
    
    if (!publicacionData) {
        alertToast('Error: No se encontraron los datos de la publicación', 'error', 4000);
        return;
    }
    
    // Mostrar loading en el botón mientras se cargan los datos
    const $btn = $(this);
    const originalHtml = $btn.html();
    $btn.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Cargando...');
    $btn.prop('disabled', true);

    // Llamar a la función para llenar el modal
    if (llenarModalEdicionPublicacion(publicacionData)) {
        // Solo mostrar el modal si se llenaron los datos exitosamente
        $('#editarPublicacionModal').modal('show');
    } else {
        alertToast('Error al cargar los datos de la publicación', 'error', 3000);
    }

    // Restaurar botón
    $btn.html(originalHtml);
    $btn.prop('disabled', false);
});


// Event listener para detener publicación
$(document).on('click', '.btn-detener-publicacion', function() {
    let idPublicacion = $(this).data('id-publicacion');
    
    Swal.fire({
        title: '¿Pausar publicación?',
        text: 'La publicación se pausará temporalmente y podrá ser reactivada después',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#ffc107',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Sí, pausar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            cambiarEstadoPublicacion(idPublicacion, 'detenida', 'Publicación pausada temporalmente');
        }
    });
});

// Event listener para reanudar publicación
$(document).on('click', '.btn-reanudar-publicacion', function() {
    let idPublicacion = $(this).data('id-publicacion');
    
    Swal.fire({
        title: '¿Reactivar publicación?',
        text: 'La publicación volverá a estar disponible para postulantes',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#28a745',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Sí, reactivar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            // Reactivar con estado normal (no editada)
            cambiarEstadoPublicacion(idPublicacion, 'publicada_normal', 'Publicación reactivada');
        }
    });
});



// Cerrar la publicación
$(document).on('click', '.btn-cerrar-publicacion', function() {
    let idPublicacion = $(this).data('id-publicacion');
    
    Swal.fire({
        title: '¿Cerrar publicación?',
        text: 'Esta acción es permanente y no se puede deshacer',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Sí, cerrar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            cambiarEstadoPublicacion(idPublicacion, 'cerrada', 'Publicación cerrada definitivamente');
        }
    });
});

// Función para publicar vacante con parámetros personalizados (SIMPLIFICADA)
function publicarVacanteConParametros(formData) {
    const idRequisicion = formData.id_requisicion;
    
    // Obtener datos de la fila
    let rowData = tableRequisicionesAprobadas.row(function(idx, data, node) {
        return data.id_requisicion == idRequisicion;
    }).data();
    
    if (!rowData) {
        alertToast('Error: No se encontraron los datos de la requisición', 'error', 4000);
        return;
    }
    
    // Deshabilitar botón mientras se procesa
    let btnPublicar = $(`.btn-publicar-vacante[data-id-requisicion="${idRequisicion}"]`);
    btnPublicar.prop('disabled', true);
    
    // Obtener plataformas seleccionadas
    let plataformasSeleccionadas = [];
    $('input[name="plataformas[]"]:checked').each(function() {
        plataformasSeleccionadas.push($(this).val());
    });
    
    // Obtener criterios de cierre
    let criteriosCierre = {
        max_postulantes: parseInt(formData.max_postulantes),
        vacantes_cubiertas: $('#cierre_por_vacantes').is(':checked') ? 1 : 0,
        fecha_limite: true
    };
    
    // Formatear fecha límite con hora de cierre
    let fechaLimiteCompleta = formData.fecha_limite_publicacion + ' 23:59:59';
    
    let datosPublicacion = {
        api: 26,
        id_requisicion: idRequisicion,
        titulo_vacante: formData.titulo_vacante,
        descripcion_adicional: formData.descripcion_adicional || 'Sin observaciones',
        estado_publicacion: 'publicada_normal', // SIEMPRE será 'publicada'
        tipo_publicacion: formData.tipo_publicacion,
        fecha_inicio_publicacion: new Date().toISOString().split('T')[0] + ' ' + new Date().toTimeString().split(' ')[0],
        fecha_limite_publicacion: fechaLimiteCompleta,
        plataformas_publicacion: JSON.stringify(plataformasSeleccionadas),
        criterios_cierre_automatico: JSON.stringify(criteriosCierre),
        max_postulantes: formData.max_postulantes
    };
    
    console.log('Datos de publicación enviados:', datosPublicacion);
    
    $.ajax({
        url: '../../../api/recursos_humanos_api.php',
        type: 'POST',
        dataType: 'json',
        data: datosPublicacion,
        success: function(response) {
            console.log('Respuesta del servidor:', response);
            
            // Verificar múltiples condiciones de éxito
            let esExitoso = false;
            
            if (response.response && (response.response.code == 1 || response.response.code == 2)) {
                esExitoso = true;
            } else if (response.response && response.response.data && response.response.data.length > 0) {
                let primeraFila = response.response.data[0];
                if (primeraFila.RESULT === "SUCCESS" || primeraFila.MESSAGE) {
                    esExitoso = true;
                }
            } else if (response.success || response.code == 1 || response.code == 2) {
                esExitoso = true;
            }
            
            if (esExitoso) {
                let tipoMensaje = '';
                switch(formData.tipo_publicacion) {
                    case 'interna':
                        tipoMensaje = 'publicada INTERNAMENTE';
                        break;
                    case 'externa':
                        tipoMensaje = 'publicada EXTERNAMENTE';
                        break;
                    case 'ambas':
                        tipoMensaje = 'publicada INTERNA Y EXTERNAMENTE';
                        break;
                }
                
                alertToast(`Vacante ${tipoMensaje} exitosamente (Máx. ${formData.max_postulantes} postulantes, límite: ${formData.fecha_limite_publicacion})`, 'success', 4000);
                
                // Cerrar modal
                $('#publicarVacanteModal').modal('hide');
                
                // Recargar tabla después de un pequeño delay
                setTimeout(function() {
                    try {
                        if (typeof tableRequisicionesAprobadas !== 'undefined' && tableRequisicionesAprobadas) {
                            tableRequisicionesAprobadas.ajax.reload(function(json) {
                                console.log('Tabla recargada después de publicación');
                            }, false);
                        }
                    } catch (error) {
                        console.error('Error al recargar tabla:', error);
                    }
                }, 500);
            } else {
                console.error('Error al publicar vacante:', response);
                let mensajeError = response.response && response.response.message 
                    ? response.response.message 
                    : (response.message || 'Error desconocido');
                alertToast('Error al publicar la vacante: ' + mensajeError, 'error', 4000);
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.error('Error AJAX:', textStatus, errorThrown, jqXHR.responseText);
            alertToast('Error de conexión al publicar la vacante', 'error', 4000);
        },
        complete: function() {
            // Rehabilitar botón
            btnPublicar.prop('disabled', false);
        }
    });
}

// Función para llenar datos en el modal de edición de publicación
function llenarModalEdicionPublicacion(publicacionData) {
    if (!publicacionData) {
        console.error('No se proporcionaron datos de publicación');
        return false;
    }
    
    console.log('Datos recibidos completos:', publicacionData);
    
    // Generar título automáticamente
    const tituloEditGenerado = `Vacante: ${publicacionData.puesto_nombre || 'Sin especificar'}`;
    
    // === CAMPOS OCULTOS ===
    $('#id_publicacion_edit').val(publicacionData.id_publicacion);
    $('#id_requisicion_edit').val(publicacionData.id_requisicion);
    $('#editarTituloVacanteHidden').val(tituloEditGenerado);
    
    // === INFORMACIÓN DE LA PUBLICACIÓN (solo lectura) ===
    $('#editarTituloVacanteDisplay').text(tituloEditGenerado);
    $('#editarNumeroRequisicionDisplay').text('#' + publicacionData.numero_requisicion);
    $('#editarPuestoNombreDisplay').text(publicacionData.puesto_nombre || 'Sin especificar');
    $('#editarDepartamentoNombreDisplay').text(publicacionData.departamento_nombre || 'Sin especificar');
    
    // Establecer badge de estado actual
    const estadoBadges = {
        'no_publicada': '<span class="badge bg-secondary">No Publicada</span>',
        'publicada_normal': '<span class="badge bg-success">Publicada</span>',
        'publicada_editada': '<span class="badge bg-success">Publicada</span>',
        'detenida': '<span class="badge bg-warning">Detenida</span>',
        'cerrada': '<span class="badge bg-danger">Cerrada</span>'
    };
    $('#editarEstadoActualDisplay').html(estadoBadges[publicacionData.estado_publicacion] || '<span class="badge bg-light text-dark">' + publicacionData.estado_publicacion + '</span>');
    
    // === CONFIGURACIÓN DE PUBLICACIÓN (campos editables) ===
    
    // Tipo de publicación
    $('#editarTipoPublicacion').val(publicacionData.tipo_publicacion || '');

    // Fecha límite
    if (publicacionData.fecha_limite_publicacion) {
        let fechaLimite = new Date(publicacionData.fecha_limite_publicacion);
        $('#editarFechaLimite').val(fechaLimite.toISOString().split('T')[0]);
    }
    // Establecer fecha mínima (hoy)
    $('#editarFechaLimite').attr('min', new Date().toISOString().split('T')[0]);

    // Máximo postulantes - extraer de criterios_cierre_automatico
    let maxPostulantes = 20; // valor por defecto
    if (publicacionData.criterios_cierre_automatico) {
        try {
            let criterios = typeof publicacionData.criterios_cierre_automatico === 'string' 
                ? JSON.parse(publicacionData.criterios_cierre_automatico) 
                : publicacionData.criterios_cierre_automatico;
            if (criterios && criterios.max_postulantes) {
                maxPostulantes = criterios.max_postulantes;
            }
        } catch (e) {
            console.warn('Error al parsear criterios de cierre:', e);
        }
    }
    $('#editarMaxPostulantes').val(maxPostulantes);

    // Descripción adicional
    $('#editarDescripcionAdicional').val(publicacionData.descripcion_adicional || '');

    // === CONFIGURACIÓN AVANZADA ===
    
    // Resetear plataformas
    $('input[name="plataformas[]"]', '#formEditarPublicacion').prop('checked', false);
    
    // Plataformas de publicación
    if (publicacionData.plataformas_publicacion) {
        try {
            let plataformas = typeof publicacionData.plataformas_publicacion === 'string' 
                ? JSON.parse(publicacionData.plataformas_publicacion) 
                : publicacionData.plataformas_publicacion;
            if (Array.isArray(plataformas)) {
                plataformas.forEach(function(plataforma) {
                    $(`#editarPlataforma_${plataforma}`).prop('checked', true);
                });
            }
        } catch (e) {
            console.warn('Error al parsear plataformas:', e);
            // Por defecto marcar web
            $('#editarPlataforma_web').prop('checked', true);
        }
    } else {
        // Por defecto marcar web
        $('#editarPlataforma_web').prop('checked', true);
    }
    
    // Criterios de cierre - vacantes cubiertas
    $('#editarCierrePorVacantes').prop('checked', false); // resetear
    if (publicacionData.criterios_cierre_automatico) {
        try {
            let criterios = typeof publicacionData.criterios_cierre_automatico === 'string' 
                ? JSON.parse(publicacionData.criterios_cierre_automatico) 
                : publicacionData.criterios_cierre_automatico;
            if (criterios && criterios.vacantes_cubiertas && criterios.vacantes_cubiertas > 0) {
                $('#editarCierrePorVacantes').prop('checked', true);
            }
        } catch (e) {
            console.warn('Error al parsear criterios de vacantes cubiertas:', e);
        }
    }
    
    // Colapsar configuración avanzada
    $('#configAvanzadaEdit').removeClass('show');
    
    return true;
}

// Función para editar una publicación
function actualizarPublicacionVacante(formData) {
    const idPublicacion = formData.id_publicacion;
    
    // Deshabilitar botón mientras se procesa
    let btnEditar = $(`.btn-editar-publicacion[data-id-publicacion="${idPublicacion}"]`);
    btnEditar.prop('disabled', true);
    
    // Obtener plataformas seleccionadas
    let plataformasSeleccionadas = [];
    $('input[name="plataformas[]"]:checked', '#formEditarPublicacion').each(function() {
        plataformasSeleccionadas.push($(this).val());
    });
    
    // Obtener criterios de cierre
    let criteriosCierre = {
        max_postulantes: parseInt(formData.max_postulantes),
        vacantes_cubiertas: $('#cierre_por_vacantes_edit').is(':checked') ? 1 : 0,
        fecha_limite: true
    };
    
    // Formatear fecha límite con hora de cierre
    let fechaLimiteCompleta = formData.fecha_limite_publicacion + ' 23:59:59';
    
    let datosActualizacion = {
        api: 26, // Usar el mismo case para actualizar
        id_publicacion: idPublicacion, // IMPORTANTE: Incluir ID para actualización
        id_requisicion: formData.id_requisicion,
        titulo_vacante: formData.titulo_vacante,
        descripcion_adicional: formData.descripcion_adicional || 'Sin observaciones',
        estado_publicacion: 'publicada_editada', // Siempre será 'editada' al actualizar
        tipo_publicacion: formData.tipo_publicacion,
        fecha_limite_publicacion: fechaLimiteCompleta,
        plataformas_publicacion: JSON.stringify(plataformasSeleccionadas),
        criterios_cierre_automatico: JSON.stringify(criteriosCierre),
        max_postulantes: formData.max_postulantes
    };
    
    console.log('Datos de actualización enviados:', datosActualizacion);
    
    $.ajax({
        url: '../../../api/recursos_humanos_api.php',
        type: 'POST',
        dataType: 'json',
        data: datosActualizacion,
        success: function(response) {
            console.log('Respuesta del servidor (actualización):', response);
            
            // Verificar múltiples condiciones de éxito
            let esExitoso = false;
            
            if (response.response && (response.response.code == 1 || response.response.code == 2)) {
                esExitoso = true;
            } else if (response.response && response.response.data && response.response.data.length > 0) {
                let primeraFila = response.response.data[0];
                if (primeraFila.RESULT === "SUCCESS" || primeraFila.MESSAGE) {
                    esExitoso = true;
                }
            } else if (response.success || response.code == 1 || response.code == 2) {
                esExitoso = true;
            }
            
            if (esExitoso) {
                alertToast(`Publicación actualizada exitosamente`, 'success', 3000);
                
                // Cerrar modal
                $('#editarPublicacionModal').modal('hide');
                
                // Recargar tabla después de un pequeño delay
                setTimeout(function() {
                    try {
                        if (typeof tableRequisicionesAprobadas !== 'undefined' && tableRequisicionesAprobadas) {
                            tableRequisicionesAprobadas.ajax.reload(function(json) {
                                console.log('Tabla recargada después de actualización');
                            }, false);
                        }
                    } catch (error) {
                        console.error('Error al recargar tabla:', error);
                    }
                }, 500);
            } else {
                console.error('Error al actualizar publicación:', response);
                let mensajeError = response.response && response.response.message 
                    ? response.response.message 
                    : (response.message || 'Error desconocido');
                alertToast('Error al actualizar la publicación: ' + mensajeError, 'error', 4000);
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.error('Error AJAX (actualización):', textStatus, errorThrown, jqXHR.responseText);
            alertToast('Error de conexión al actualizar la publicación', 'error', 4000);
        },
        complete: function() {
            // Rehabilitar botón
            btnEditar.prop('disabled', false);
        }
    });
}



// Función para cambiar estado de publicación (SIMPLIFICADA)
function cambiarEstadoPublicacion(idPublicacion, nuevoEstado, motivo) {
    $.ajax({
        url: '../../../api/recursos_humanos_api.php',
        type: 'POST',
        dataType: 'json',
        data: {
            api: 27,
            id_publicacion: idPublicacion,
            estado_publicacion: nuevoEstado,
            motivo_cierre: motivo
        },
        success: function(response) {
            console.log('Respuesta del servidor:', response);
            
            let mensaje = '';
            switch(nuevoEstado) {
                case 'publicada_normal':
                    mensaje = 'Publicación activada exitosamente';
                    break;
                case 'publicada_editada':
                    mensaje = 'Publicación actualizada y reactivada';
                    break;
                case 'detenida':
                    mensaje = 'Publicación pausada exitosamente';
                    break;
                case 'cerrada':
                    mensaje = 'Publicación cerrada definitivamente';
                    break;
                default:
                    mensaje = `Estado cambiado a: ${nuevoEstado}`;
            }
            
            alertToast(mensaje, 'success', 3000);
            
            // Recargar tabla
            if (typeof tableRequisicionesAprobadas !== 'undefined' && tableRequisicionesAprobadas) {
                tableRequisicionesAprobadas.ajax.reload(function(json) {
                    console.log('Tabla recargada después de cambio de estado');
                }, false);
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.error('Error:', textStatus, errorThrown, jqXHR.responseText);
            alertToast('Error de conexión al cambiar estado', 'error', 4000);
        }
    });
}