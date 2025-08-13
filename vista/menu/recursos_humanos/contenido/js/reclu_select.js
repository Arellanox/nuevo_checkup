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
    select: {
        style: 'single',
        info: true
    },
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
                    'no_publicada': '<span class="badge bg-gradient-secondary">No Publicada</span>',
                    'publicada_normal': '<span class="badge bg-gradient-primary">Publicada</span>',
                    'publicada_editada': '<span class="badge bg-gradient-primary">Publicada</span>',
                    'detenida': '<span class="badge bg-gradient-warning">Detenida</span>',
                    'cerrada': '<span class="badge bg-gradient-info">Cerrada</span>'
                };
                // Manejar valores null o undefined
                const estado = data || 'no_publicada';
                return badges[estado] || '<span class="badge bg-secondary">No publicada</span>';
            }
        },
        { data: "tipo_publicacion", title: "Tipo de Publicación",
            render: function(data) {
                const badges = {
                    'interna': '<span class="badge bg-gradient-primary">Interna</span>',
                    'externa': '<span class="badge bg-gradient-info">Externa</span>',
                    'ambas': '<span class="badge bg-gradient-warning">Ambas</span>'
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
        // Verificar permisos del usuario
        const tienePermisoPublicar = window.userPermissions && window.userPermissions.includes('rhRegPub');
        
        // Manejar estado de publicación null/undefined
        let estadoPublicacion = row.estado_publicacion || 'no_publicada';
        let botones = '';
        let mostrarVerDetalles = true;
        
        switch(estadoPublicacion) {
            case 'no_publicada':
                if (tienePermisoPublicar) {
                    botones = `
                        <button type="button" class="btn btn-sm btn-primary bg-gradient-info btn-publicar-vacante" 
                                data-id-requisicion="${row.id_requisicion}" 
                                data-numero="${row.numero_requisicion}"
                                title="Publicar vacante">
                            <i class="bi bi-megaphone"></i>
                        </button>`;
                } else {
                    botones = `
                        <span class="badge bg-secondary p-2" title="Sin permisos para publicar">
                            <i class="bi bi-lock"></i> Sin permisos
                        </span>`;
                }
                mostrarVerDetalles = false;
                break;
                
            case 'publicada_normal':
                if (tienePermisoPublicar) {
                    botones = `
                        <button class="btn btn-sm btn-primary bg-gradient-secondary btn-detener-publicacion" 
                                data-id-publicacion="${row.id_publicacion}" 
                                title="Detener publicación">
                            <i class="bi bi-pause-circle"></i>
                        </button>`;
                }
                break;

            case 'publicada_editada':
                if (tienePermisoPublicar) {
                    botones = `
                        <button class="btn btn-sm btn-primary bg-gradient-secondary btn-detener-publicacion" 
                                data-id-publicacion="${row.id_publicacion}" 
                                title="Detener publicación">
                            <i class="bi bi-pause-circle"></i>
                        </button>`;
                }
                break;
                
            case 'detenida':
                if (tienePermisoPublicar) {
                    botones = `
                        <button class="btn btn-sm btn-gradient-success btn-reanudar-publicacion" 
                                data-id-publicacion="${row.id_publicacion}" 
                                title="Reanudar publicación">
                            <i class="bi bi-play-circle"></i>
                        </button>
                        <button class="btn btn-primary btn-sm bg-gradient-warning btn-editar-publicacion" 
                                data-id-publicacion="${row.id_publicacion}"
                                title="Editar publicación">
                            <i class="bi bi-pencil"></i>
                        </button>
                        <button class="btn btn-sm btn-gradient-secondary-dark btn-cerrar-publicacion" 
                                data-id-publicacion="${row.id_publicacion}" 
                                title="Cerrar publicación">
                            <i class="bi bi-x-circle"></i>
                        </button>`;
                }
                break;
        }
        
        // Botón de ver detalles solo si no es 'no_publicada' (todos pueden ver)
        if (mostrarVerDetalles) {
            botones += `
                <button class="btn btn-sm btn-primary btn-ver-publicacion" 
                        data-id="${row.id_publicacion}" 
                        title="Ver detalles"
                        data-bs-target="#detallesPublicacionModal"
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
        { data: "fecha_cierre_real", visible: false },
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
                if (tienePermisoRegPub) {
                    // Aquí puedes cargar el contenido del modal de transacciones si es necesario
                    $("#historialPublicacionesModal").modal('show');
                    tableHistorialPublicaciones.ajax.reload();
                }
            },
        }
    ],
});

// Variable global para almacenar la fila seleccionada
let rowSelectedRequisicionesAprobadas = null;

// Evento para capturar la selección de filas
$('#tableRequisicionesAprobadas').on('select.dt', function(e, dt, type, indexes) {
    if (type === 'row') {
        rowSelectedRequisicionesAprobadas = dt.rows(indexes).data()[0];
        console.log('Fila seleccionada:', rowSelectedRequisicionesAprobadas);
    }
});

// Evento para capturar la deselección de filas
$('#tableRequisicionesAprobadas').on('deselect.dt', function(e, dt, type, indexes) {
    rowSelectedRequisicionesAprobadas = null;
    console.log('Fila deseleccionada');
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
                    'no_publicada': '<span class="badge bg-gradient-secondary">No Publicada</span>',
                    'publicada_normal': '<span class="badge bg-gradient-primary">Publicada</span>',
                    'publicada_editada': '<span class="badge bg-gradient-primary">Publicada</span>',
                    'detenida': '<span class="badge bg-gradient-warning">Detenida</span>',
                    'cerrada': '<span class="badge bg-gradient-info">Cerrada</span>'
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
                    'no_publicada': '<span class="badge bg-gradient-secondary">No Publicada</span>',
                    'publicada_normal': '<span class="badge bg-gradient-primary">Publicada</span>',
                    'publicada_editada': '<span class="badge bg-gradient-primary">Publicada</span>',
                    'detenida': '<span class="badge bg-gradient-warning">Detenida</span>',
                    'cerrada': '<span class="badge bg-gradient-info">Cerrada</span>'
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

// DataTable para la gestión de postulantes (placeholder)
tableGestionPostulantes = $("#tableGestionPostulantes").DataTable({
     language: {
        url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json",
    },
    autoWidth: true,
    lengthChange: false,
    info: true,
    paging: true,
    pageLength: 10,
    sorting: [4, 'desc'],
    scrollY: "60vh",
    scrollCollapse: true,
    ajax: {
        dataType: "json",
        data: function (d) {
            return $.extend(d, dataTableGestionPostulantes);
        },
        method: "POST",
        url: "../../../api/recursos_humanos_api.php",
        error: function (jqXHR, textStatus, errorThrown) {
            alertErrorAJAX(jqXHR, textStatus, errorThrown);
        },
        dataSrc: "response.data",
    },
    columns: [
        { data: "id_postulacion", visible: false, title: "ID Postulación"},
        { data: "id_publicacion", visible: false, title: "ID Publicación" },
        { data: "nombre_completo", visible: false, title: "Nombre Completo" },
        { data: "fecha_nacimiento", visible: false, title: "Fecha de Nacimiento" },
        { data: "edad", visible: false, title: "Edad"},
        { data: "sexo", visible: false, title: "Sexo" },
        { data: "estado_civil", visible: false, title: "Estado Civil" },
        { data: "telefono", visible: false, title: "Teléfono" },
        { data: "domicilio", visible: false, title: "Domicilio" },
        { data: "pregunta_1", visible: false, title: "Pregunta 1" },
        { data: "pregunta_2", visible: false, title: "Pregunta 2" },
        { data: "pregunta_3", visible: false, title: "Pregunta 3" },
        { data: "pregunta_4", visible: false, title: "Pregunta 4" },
        { data: "pregunta_5", visible: false, title: "Pregunta 5" },
        { data: "pregunta_6", visible: false, title: "Pregunta 6" },
        { data: "pregunta_7", visible: false, title: "Pregunta 7" },
        { data: "pregunta_8", visible: false, title: "Pregunta 8" },
        { data: "pregunta_9", visible: false, title: "Pregunta 9" },
        { data: "pregunta_10", visible: false, title: "Pregunta 10" },
        { data: "archivo_cv", visible: false, title: "Archivo CV" },
        { data: "archivo_curp", visible: false, title: "Archivo CURP" },
        { data: "fecha_postulacion", visible: false, title: "Fecha de Postulación" },
    ],
});

// DataTable para los postulantes aprobados
tablePostulantesAprobados = $("#tablePostulantesAprobados").DataTable({
    language: {
        url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json",
    },
    autoWidth: true,
    lengthChange: false,
    info: true,
    paging: true,
    pageLength: 10,
    order: [[3, 'desc']], // Ordenar por fecha de selección
    scrollY: "60vh",
    scrollCollapse: true,
    ajax: {
        dataType: "json",
        data: function (d) {
            return $.extend(d, dataTablePostulantesAprobados);
        },
        method: "POST",
        url: "../../../api/recursos_humanos_api.php",
        error: function (jqXHR, textStatus, errorThrown) {
            console.error("Error en AJAX:", jqXHR, textStatus, errorThrown);
            alertErrorAJAX(jqXHR, textStatus, errorThrown);
        },
        dataSrc: function(json) {
            console.log("Datos de candidatos recibidos:", json);
            return json.response.data || [];
        }
    },
    columns: [
        { 
            data: "numero_candidato", 
            title: "No. Candidato",
        },
        { 
            data: "nombre_completo", 
            title: "Nombre Completo",
        },
        { 
            data: "titulo_vacante", 
            title: "Cargo",
            render: function(data, type, row) {
                return `<div>
                    <div class="">${row.puesto_nombre}</div>
                    <small class="fw-bold text-muted">${row.departamento_nombre}</small>
                </div>`;
            }
        },
        { 
            data: "estado_candidato", 
            title: "Estado",
            render: function(data) {
                const badges = {
                    'preseleccionado': '<span class="badge bg-gradient-primary">Preseleccionado</span>',
                    'en_proceso': '<span class="badge bg-gradient-warning">En Proceso</span>',
                    'contratado': '<span class="badge bg-gradient-success">Contratado</span>',
                    'rechazado': '<span class="badge bg-gradient-secondary">Rechazado</span>',
                    'declinado': '<span class="badge bg-gradient-secondary-dark">Declinado</span>',
                    'en_espera': '<span class="badge bg-gradient-warning">En Espera</span>',
                    'finalista': '<span class="badge bg-gradient-info">Finalista</span>'
                };
                return badges[data] || `<span class="badge bg-light text-dark">${data}</span>`;
            }
        },
        { 
            data: "prioridad_proceso", 
            title: "Prioridad", visible: false,
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
            data: "fecha_seleccion", 
            title: "Fecha Selección",
            render: function(data) {
                if (data && data !== null) {
                    const fecha = new Date(data);
                    return `<div class="text-nowrap">
                        <div>${fecha.toLocaleDateString('es-MX')}
                        </div>
                    </div>`;
                }
                return '-';
            }
        },
        // En la configuración del DataTable, actualizar la columna de acciones:
{
    data: null,
    title: "Acciones",
    render: function(data, type, row) {
       
        const tienePermisoGestionarCandidatos = window.userPermissions && window.userPermissions.includes('rhGesCand');
        
        let botones = '<div class="btn-group" role="group">';
        
        // Botones según el estado actual del candidato
        switch(row.estado_candidato) {
            case 'preseleccionado':
             if (tienePermisoGestionarCandidatos) {
                botones += `
                    <button class="btn btn-sm btn-gradient-info btn-enviar-propuesta" 
                            data-id-candidato="${row.id_candidato}"
                            data-nombre="${row.nombre_completo}" 
                            title="Enviar propuesta salarial"
                            onclick="cambiarEstadoCandidato(${row.id_candidato}, 'en_espera', '${row.nombre_completo}')">
                        <i class="fas fa-paper-plane"></i>
                    </button>`;
             } else {
                botones = `
                        <span class="badge bg-secondary p-2" title="Sin permisos para gestionar candidatos">
                            <i class="bi bi-lock"></i> Sin permisos
                        </span>`;
             }
                break;
                
            case 'en_espera':
             if (tienePermisoGestionarCandidatos){
                botones += `
                    <button class="btn btn-sm btn-gradient-warning" 
                            title="En espera de respuesta" data-bs-toggle="button" aria-pressed="true"><i class="bi bi-stopwatch-fill"></i></button>`;
             } else {
                botones = `
                        <span class="badge bg-secondary p-2" title="Sin permisos para gestionar candidatos">
                            <i class="bi bi-lock"></i> Sin permisos
                        </span>`;
             }
                break;
                
            case 'en_proceso':
                // ⭐ LÓGICA PRINCIPAL: Verificar si tiene carta firmada
                if (tienePermisoGestionarCandidatos) {
                    if (row.archivo_carta && row.archivo_carta.trim() !== '' && row.archivo_carta !== 'null') {
                        // SÍ tiene carta: Mostrar botón "Abrir carta" + "Marcar finalista"
                        botones += `
                            <button class="btn btn-sm btn-gradient-info btn-abrir-carta" 
                                    title="Ver carta propuesta salarial firmada"
                                    onclick="abrirCartaSalarial('${row.archivo_carta}', '${row.nombre_completo}')">
                                <i class="fas fa-file-pdf"></i>
                            </button>
                            <button class="btn btn-sm btn-gradient-success btn-contratar-candidato" 
                                data-id-candidato="${row.id_candidato}"
                                data-nombre="${row.nombre_completo}" 
                                title="Contratar candidato"
                                onclick="cambiarEstadoCandidato(${row.id_candidato}, 'contratado', '${row.nombre_completo}')">
                                <i class="fas fa-handshake"></i>
                            </button>`;
                    } else {
                        // NO tiene carta: Mostrar botón "Generar carta"
                        botones += `
                            <button class="btn btn-sm btn-gradient-success btn-generar-carta-firmada" 
                                    data-id-candidato="${row.id_candidato}"
                                    data-nombre="${row.nombre_completo}" 
                                    title="Generar carta de propuesta firmada"
                                    onclick="generarCartaFirmada(${row.id_candidato}, '${row.nombre_completo}')">
                                <i class="fas fa-file-signature"></i>
                            </button>`;
                    }
                }
                break;
                
            case 'finalista':
                if (tienePermisoGestionarCandidatos) {
                botones += `
                    <button class="btn btn-sm btn-gradient-info btn-abrir-carta" 
                            title="Ver carta propuesta salarial firmada"
                            onclick="abrirCartaSalarial('${row.archivo_carta}', '${row.nombre_completo}')">
                        <i class="fas fa-file-pdf"></i>
                    </button>
                    <button class="btn btn-sm btn-gradient-success btn-contratar-candidato" 
                            data-id-candidato="${row.id_candidato}"
                            data-nombre="${row.nombre_completo}" 
                            title="Contratar candidato"
                            onclick="cambiarEstadoCandidato(${row.id_candidato}, 'contratado', '${row.nombre_completo}')">
                        <i class="fas fa-handshake"></i>
                    </button>`;
                }
                break;
                
            case 'contratado':
                botones += `
                    <span class="badge bg-success p-2">
                        <i class="fas fa-check"></i> Contratado
                    </span>`;
                break;
                
            case 'rechazado':
            case 'declinado':
                botones += `
                    <span class="badge bg-secondary p-2">
                        <i class="fas fa-times"></i> ${row.estado_candidato === 'rechazado' ? 'Rechazado' : 'Declinado'}
                    </span>`;
                break;
        }
        
        // Botón de rechazo (solo si no está finalizado)
        if (!['rechazado', 'contratado', 'declinado'].includes(row.estado_candidato)) {
            if (tienePermisoGestionarCandidatos) {
            botones += `
                <button class="btn btn-sm btn-gradient-secondary btn-rechazar-candidato" 
                    data-id-candidato="${row.id_candidato}"
                    data-nombre="${row.nombre_completo}" 
                    title="Rechazar candidato"
                    onclick="rechazarCandidato(${row.id_candidato}, '${row.nombre_completo}')">
                <i class="fas fa-times"></i>
                </button>`;
            } else {
            botones += `
                <span class="badge bg-secondary p-2" title="Sin permisos para gestionar candidatos">
                <i class="bi bi-lock"></i> No permitido
                </span>`;
            }
        }

        botones += '</div>';
        return botones;
    }
},
        // Columnas ocultas para datos adicionales
        { data: "id_candidato", visible: false },
        { data: "id_postulacion", visible: false },
        { data: "id_publicacion", visible: false },
        { data: "telefono", visible: false },
        { data: "edad", visible: false }
    ],
    columnDefs: [
        { targets: "_all", className: "text-center align-middle" },
        { targets: [1, 2], className: "text-start" } // Nombre y vacante alineados a la izquierda
    ],
    dom: 'Bl<"dataTables_toolbar">frtip',
    buttons: [
        {
            text: '<i class="fas fa-sync-alt"></i> Actualizar',
            className: "btn btn-primary btn-sm",
            action: function() {
                tablePostulantesAprobados.ajax.reload();
            }
        }
    ]
});

// Event listeners para los botones de publicación

$(document).on('click', '.btn-publicar-vacante', function() {
    // Validar permisos antes de continuar
    if(!window.tienePermisoRegPub) {
        alertToast('No tienes permiso para publicar vacantes', 'warning', 5000);
        return;
    }
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
    // Validar permisos antes de continuar
    if(!window.tienePermisoRegPub) {
        alertToast('No tienes permiso para editar publicaciones', 'error', 5000);
        return;
    }
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


// Event listener para ver los detalles de una publicación
$(document).on('click', '.btn-ver-publicacion', function() {
    let idPublicacion = $(this).data('id');
    const tabla = tableRequisicionesAprobadas;
    const fila = $(this).closest('tr');
    const dataClick = tabla.row(fila).data();
    
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
    $btn.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
    $btn.prop('disabled', true);

    // Llamar a la función para llenar el modal de detalles
    if (llenarModalDetallesPublicacion(publicacionData)) {
        // Solo mostrar el modal si se llenaron los datos exitosamente
        $('#detallesPublicacionModal').modal('show');
    
        // Ejecutar las habilidades INMEDIATAMENTE (para testing)
    console.log("=== EJECUTANDO HABILIDADES INMEDIATAMENTE ===");
    const habilidadesBlandas = dataClick.habilidades_blandas_descripcion || dataClick['34'] || null;
    const habilidadesTecnicas = dataClick.habilidades_tecnicas_descripcion || dataClick['35'] || null;
    
    console.log("Habilidades blandas a procesar:", habilidadesBlandas);
    console.log("Habilidades técnicas a procesar:", habilidadesTecnicas);
    
    mostrarHabilidadesComoTags(habilidadesBlandas, 'habilidadesBlandasPubContainer', 'blanda');
    mostrarHabilidadesComoTags(habilidadesTecnicas, 'habilidadesTecnicasPubContainer', 'tecnica');
    
    // También con setTimeout como respaldo  
    setTimeout(() => {
        console.log("=== EJECUTANDO HABILIDADES DESPUÉS DE MOSTRAR MODAL ===");
        console.log("Modal visible ahora:", $('#detallesPublicacionModal').is(':visible'));
        
        mostrarHabilidadesComoTags(habilidadesBlandas, 'habilidadesBlandasPubContainer', 'blanda');
        mostrarHabilidadesComoTags(habilidadesTecnicas, 'habilidadesTecnicasPubContainer', 'tecnica');
    }, 500);

    } else {
        alertToast('Error al cargar los datos de la publicación', 'error', 3000);
    }

    // Restaurar botón
    setTimeout(() => {
        $btn.html(originalHtml);
        $btn.prop('disabled', false);
    }, 500);
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

// Event listener para abrir el modal de gestión de postulantes
$(document).on('click', '#btnVerPostulantes', function() {
    console.log('🔄 Abriendo modal de gestión de postulantes...');
    let idPublicacion = $('#btnVerPostulantes').data('id-publicacion');

    console.log('📋 ID de publicación obtenido:', idPublicacion);

    if (!idPublicacion) {
        alertToast('Error: ID de publicación no válido', 'error', 3000);
        return;
    }

    // Establecer el id_publicacion en el dataTable
    dataTableGestionPostulantes.id_publicacion = idPublicacion;
    
    // Mostrar modal
    $('#gestionPostulantesModal').modal('show');
    
    // Cargar datos de postulantes
    cargarPostulantesPublicacion(idPublicacion);
});

// Event listener para cambio de estado desde dropdown
$(document).on('click', '.btn-cambiar-estado-dropdown', function(e) {
    e.preventDefault();
    
    const idPostulacion = $(this).data('id-postulacion');
    const nuevoEstado = $(this).data('nuevo-estado');
    const nombreEstado = $(this).text().trim();
    
    console.log('🔄 Cambiando estado del postulante:', idPostulacion, 'a:', nuevoEstado);
    
    // Confirmación con SweetAlert
    Swal.fire({
        title: '¿Confirmar cambio de estado?',
        html: `¿Estás seguro de cambiar el estado del postulante a <strong>${nombreEstado}</strong>?`,
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: getColorByEstado(nuevoEstado),
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Sí, cambiar',
        cancelButtonText: 'Cancelar',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            // Mostrar loading inmediatamente
            Swal.fire({
                title: 'Actualizando estado...',
                html: '<div class="spinner-border text-primary" role="status"><span class="visually-hidden">Cargando...</span></div>',
                showConfirmButton: false,
                allowOutsideClick: false
            });
            
            cambiarEstadoPostulante(idPostulacion, nuevoEstado);
        }
    });
});


// Función para publicar vacante con parámetros personalizados (SIMPLIFICADA)
function publicarVacanteConParametros(formData) {
    // Validar permisos
    if(!window.tienePermisoRegPub) {
        alertToast('No tienes permiso para publicar vacantes', 'error', 5000);
        return;
    }
    const idRequisicion = formData.id_requisicion;
    
    // Obtener datos de la fila - usar rowSelectedRequisicionesAprobadas si está disponible
    let rowData = null;
    
    if (typeof rowSelectedRequisicionesAprobadas !== 'undefined' && rowSelectedRequisicionesAprobadas && 
        rowSelectedRequisicionesAprobadas.id_requisicion == idRequisicion) {
        rowData = rowSelectedRequisicionesAprobadas;
        console.log('Usando datos de fila seleccionada:', rowData);
    } else {
        // Buscar en la tabla si no hay fila seleccionada
        rowData = tableRequisicionesAprobadas.row(function(idx, data, node) {
            return data.id_requisicion == idRequisicion;
        }).data();
        console.log('Buscando datos en tabla:', rowData);
    }
    
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
        numero_postulantes: formData.numero_postulantes || 0,
        titulo_vacante: formData.titulo_vacante,
        descripcion_adicional: formData.descripcion_adicional || 'Sin observaciones',
        estado_publicacion: 'publicada_normal', // SIEMPRE será 'publicada'
        tipo_publicacion: formData.tipo_publicacion,
        fecha_inicio_publicacion: new Date().toISOString().split('T')[0] + ' ' + new Date().toTimeString().split(' ')[0],
        fecha_limite_publicacion: fechaLimiteCompleta,
        plataformas_publicacion: JSON.stringify(plataformasSeleccionadas),
        criterios_cierre_automatico: JSON.stringify(criteriosCierre),
        max_postulantes: formData.max_postulantes,
        usuario_publicador_id: window.userId // Se agrega el ID para permisos
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
                // Mensaje para permisos
                if(mensajeError.includes("No tiene permisos")) {
                    alertToast('Verifica que tu usuario tenga permisos para publicar', 'error', 5000);
                } else {
                    alertToast('Error al publicar la vacante: ' + mensajeError, 'error', 4000);
                }
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
        'no_publicada': '<span class="badge bg-gradient-secondary">No Publicada</span>',
        'publicada_normal': '<span class="badge bg-gradient-primary">Publicada</span>',
        'publicada_editada': '<span class="badge bg-gradient-primary">Publicada</span>',
        'detenida': '<span class="badge bg-gradient-warning">Detenida</span>',
        'cerrada': '<span class="badge bg-gradient-info">Cerrada</span>'
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

// === FUNCIÓN PARA MOSTRAR HABILIDADES COMO TAGS ===
function mostrarHabilidadesComoTags(habilidadesTexto, containerId, tipo) {
    console.log(`=== mostrarHabilidadesComoTags ===`);
    console.log(`Procesando: "${habilidadesTexto}" en container "${containerId}"`);
    
    const container = $(`#${containerId}`);
    
    // Limpiar contenido previo
    container.empty();
    
    if (!habilidadesTexto || habilidadesTexto.trim() === '' || habilidadesTexto === 'null') {
        container.html('<span class="sin-habilidades">Sin habilidades especificadas</span>');
        return;
    }
    
    // Dividir las habilidades por coma
    const habilidades = habilidadesTexto.split(',').map(h => h.trim()).filter(h => h !== '');
    
    if (habilidades.length === 0) {
        container.html('<span class="sin-habilidades">Sin habilidades especificadas</span>');
        return;
    }
    
    // Crear tags para cada habilidad
    habilidades.forEach(habilidad => {
        const tagClass = tipo === 'tecnica' ? 'habilidad-tag tecnica' : 'habilidad-tag';
        
        // Estilos inline
        const baseStyle = 'display: inline-block; padding: 0.4rem 0.8rem; margin: 0.2rem 0.3rem 0.2rem 0; color: white; border-radius: 1rem; font-size: 0.75rem; font-weight: 500;';
        const bgStyle = tipo === 'tecnica' 
            ? 'background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);' 
            : 'background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);';
        
        const tag = `<span class="${tagClass}" style="${baseStyle}${bgStyle}">${habilidad}</span>`;
        container.append(tag);
    });
    
    console.log(`✅ ${habilidades.length} tags de habilidades agregados a ${containerId}`);
}

// Función para cargar postulantes de una publicación específica
function cargarPostulantesPublicacion(idPublicacion) {
    console.log('🔄 Cargando postulantes para publicación:', idPublicacion);
    
    // Mostrar loading en la lista
    $('#listaPostulantes').html(`
        <div class="text-center py-4">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Cargando...</span>
            </div>
            <p class="mt-2 text-muted">Cargando postulantes...</p>
        </div>
    `);
    
    // Limpiar detalle
    $('#detallePostulante').html(`
        <div class="text-center py-5">
            <i class="fas fa-user-plus fa-3x text-muted mb-3"></i>
            <h5 class="text-muted">Selecciona un postulante para ver sus detalles</h5>
            <p class="text-muted">Haz clic en cualquier postulante de la lista para revisar su información completa</p>
        </div>
    `);
    
    $.ajax({
        url: '../../../api/recursos_humanos_api.php',
        type: 'POST',
        dataType: 'json',
        data: {
            api: 31,
            id_publicacion: idPublicacion
        },
        success: function(response) {
            console.log('📋 Respuesta del servidor (postulantes):', response);
            
            if (response.response && response.response.code === 1 && response.response.data) {
                const postulantes = response.response.data;
                
                if (postulantes.length === 0) {
                    // Sin postulantes
                    $('#listaPostulantes').html(`
                        <div class="text-center py-4">
                            <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                            <h6 class="text-muted">Sin postulantes</h6>
                            <p class="text-muted small">Aún no hay postulaciones para esta vacante</p>
                        </div>
                    `);
                    $('#contadorPostulantes').text('0');
                } else {
                    // Mostrar postulantes
                    mostrarListaPostulantes(postulantes);
                    $('#contadorPostulantes').text(postulantes.length);
                }
                
                // Establecer título de la vacante si está disponible
                if (postulantes.length > 0 && postulantes[0].titulo_vacante) {
                    $('#tituloVacantePostulantes').text(postulantes[0].titulo_vacante);
                }
                
            } else {
                console.error('Error en respuesta:', response);
                $('#listaPostulantes').html(`
                    <div class="text-center py-4">
                        <i class="fas fa-exclamation-triangle fa-2x text-warning mb-3"></i>
                        <h6 class="text-warning">Error al cargar</h6>
                        <p class="text-muted small">No se pudieron cargar los postulantes</p>
                    </div>
                `);
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.error('Error AJAX al cargar postulantes:', textStatus, errorThrown);
            $('#listaPostulantes').html(`
                <div class="text-center py-4">
                    <i class="fas fa-exclamation-triangle fa-2x text-danger mb-3"></i>
                    <h6 class="text-danger">Error de conexión</h6>
                    <p class="text-muted small">Error al conectar con el servidor</p>
                </div>
            `);
        }
    });
}

// Función para mostrar la lista de postulantes en el HTML
function mostrarListaPostulantes(postulantes) {
    let htmlPostulantes = '';
    
    postulantes.forEach((postulante, index) => {
        // Obtener iniciales del nombre
        const iniciales = obtenerIniciales(postulante.NOMBRE_POSTULANTE || postulante.nombre_completo);
        
        // Formatear fecha de postulación
        const fechaPostulacion = formatearFecha(postulante.fecha_postulacion);
        
        // Generar HTML para cada postulante
        htmlPostulantes += `
            <div class="postulante-item" data-postulante='${JSON.stringify(postulante)}' data-index="${index}">
                <span class="estado-badge estado-${postulante.estado_postulacion}">
                    ${formatearEstadoPostulacion(postulante.estado_postulacion)}
                </span>
                
                <div class="d-flex align-items-center">
                    <div class="postulante-avatar me-3">
                        ${iniciales}
                    </div>
                    
                    <div class="flex-grow-1">
                        <div class="fw-bold text-dark mb-1" style="font-size: 0.95rem;">
                            ${postulante.NOMBRE_POSTULANTE || postulante.nombre_completo}
                        </div>
                        <div class="text-muted small d-flex align-items-center mb-1">
                            <i class="fas fa-calendar-alt me-1"></i>
                            Edad: ${postulante.edad} años
                        </div>
                        <div class="text-muted small d-flex align-items-center">
                            <i class="fas fa-clock me-1"></i>
                            ${fechaPostulacion}
                        </div>
                    </div>
                </div>
            </div>
        `;
    });
    
    $('#listaPostulantes').html(htmlPostulantes);
    
    // Agregar event listeners para seleccionar postulante
    $('.postulante-item').on('click', function() {
        // Remover clase active de otros elementos
        $('.postulante-item').removeClass('active');
        
        // Agregar clase active al elemento seleccionado
        $(this).addClass('active');
        
        // Obtener datos del postulante
        const postulante = JSON.parse($(this).attr('data-postulante'));
        
        // Mostrar detalles del postulante
        mostrarDetallePostulante(postulante);
    });
}

// Función para mostrar los detalles del postulante seleccionado
function mostrarDetallePostulante(postulante) {
    console.log('📋 Mostrando detalles del postulante:', postulante);

    const opcionesEstado = generarOpcionesEstadoPostulante(postulante);

    
    const htmlDetalle = `
        <div class="detalle-section">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6><i class="fas fa-user me-2"></i>Información Personal</h6>
                <div class="d-flex align-items-center">
                    <span class="badge estado-${postulante.estado_postulacion} fs-6 me-2">
                        ${formatearEstadoPostulacion(postulante.estado_postulacion)}
                    </span>
                    <div class="dropdown">
                        <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-cog"></i> Acciones
                        </button>
                        <ul class="dropdown-menu">
                            <li><h6 class="dropdown-header">Cambiar Estado</h6></li>
                            ${opcionesEstado}
                        </ul>
                    </div>
                </div>
            </div>
            
            <!-- DATOS GENERALES - SECCIÓN 1 -->
            <div class="row">
                <div class="col-md-6">
                    <div class="info-group">
                        <div class="info-label">Nombre Completo</div>
                        <div class="info-value">${postulante.NOMBRE_POSTULANTE || 'No especificado'}</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="info-group">
                        <div class="info-label">Apodo / Sobrenombre</div>
                        <div class="info-value">${postulante.apodo || 'No especificado'}</div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="info-group">
                        <div class="info-label">Lugar de Nacimiento</div>
                        <div class="info-value">${postulante.lugar_nacimiento || 'No especificado'}</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="info-group">
                        <div class="info-label">Fecha de Nacimiento</div>
                        <div class="info-value">${formatearFecha(postulante.fecha_nacimiento)}</div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-4">
                    <div class="info-group">
                        <div class="info-label">Edad</div>
                        <div class="info-value">${postulante.edad} años</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="info-group">
                        <div class="info-label">Sexo</div>
                        <div class="info-value">${postulante.sexo === 'M' ? 'Masculino' : 'Femenino'}</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="info-group">
                        <div class="info-label">Estado Civil</div>
                        <div class="info-value">${postulante.estado_civil || 'No especificado'}</div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-4">
                    <div class="info-group">
                        <div class="info-label">Correo Electrónico</div>
                        <div class="info-value">
                            <i class="fas fa-envelope me-2"></i>${postulante.correo_electronico || 'No especificado'}
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="info-group">
                        <div class="info-label">Teléfono</div>
                        <div class="info-value">
                            <i class="fas fa-phone me-2"></i>${postulante.telefono || 'No especificado'}
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="info-group">
                        <div class="info-label">CURP</div>
                        <div class="info-value">
                            <i class="fas fa-id-card me-2"></i>${postulante.curp || 'No especificado'}
                        </div>
                    </div>
                </div>
            </div>
            
            
            <div class="info-group">
                <div class="info-label">Domicilio</div>
                <div class="info-value">
                    <i class="fas fa-map-marker-alt me-2"></i>${postulante.domicilio || 'No especificado'}
                </div>
            </div>
        </div>
        
        <!-- EDUCACIÓN Y PROFESIÓN -->
        <div class="detalle-section">
            <h6><i class="fas fa-graduation-cap me-2"></i>Educación y Profesión</h6>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="info-group">
                        <div class="info-label">Grado de Estudios</div>
                        <div class="info-value">${postulante.grado_estudios || 'No especificado'}</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="info-group">
                        <div class="info-label">Institución de Estudios</div>
                        <div class="info-value">${postulante.institucion_estudios || 'No especificado'}</div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="info-group">
                        <div class="info-label">Profesión</div>
                        <div class="info-value">${postulante.profesion || 'No especificado'}</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="info-group">
                        <div class="info-label">Idiomas</div>
                        <div class="info-value">${postulante.idiomas || 'No especificado'}</div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- INFORMACIÓN FAMILIAR -->
        <div class="detalle-section">
            <h6><i class="fas fa-home me-2"></i>Información Familiar</h6>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="info-group">
                        <div class="info-label">Tiene Hijos</div>
                        <div class="info-value">${postulante.hijos || 'No especificado'}</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="info-group">
                        <div class="info-label">Con Quién Vive</div>
                        <div class="info-value">${postulante.con_quien_vive || 'No especificado'}</div>
                    </div>
                </div>
            </div>
            
            ${postulante.nombre_conyuge ? `
            <div class="row">
                <div class="col-md-6">
                    <div class="info-group">
                        <div class="info-label">Nombre del Cónyuge</div>
                        <div class="info-value">${postulante.nombre_conyuge}</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="info-group">
                        <div class="info-label">Ocupación del Cónyuge</div>
                        <div class="info-value">${postulante.ocupacion_conyuge || 'No especificado'}</div>
                    </div>
                </div>
            </div>
            ` : ''}
            
            ${postulante.nombre_hijos ? `
            <div class="row">
                <div class="col-md-6">
                    <div class="info-group">
                        <div class="info-label">Nombre de los Hijos</div>
                        <div class="info-value">${postulante.nombre_hijos}</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="info-group">
                        <div class="info-label">Edad de los Hijos</div>
                        <div class="info-value">${postulante.edad_hijos || 'No especificado'}</div>
                    </div>
                </div>
            </div>
            ` : ''}
            
            <div class="row">
                <div class="col-md-6">
                    <div class="info-group">
                        <div class="info-label">Ocupación de los Padres</div>
                        <div class="info-value">${postulante.ocupacion_padres || 'No especificado'}</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="info-group">
                        <div class="info-label">Ocupación de los Hermanos</div>
                        <div class="info-value">${postulante.ocupacion_hermanos || 'No especificado'}</div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- INFORMACIÓN DE SALUD -->
        <div class="detalle-section">
            <h6><i class="fas fa-heartbeat me-2"></i>Estado de Salud</h6>
            
            <div class="row">
                <div class="col-md-4">
                    <div class="info-group">
                        <div class="info-label">Condición de Salud</div>
                        <div class="info-value">
                            <span class="badge ${postulante.condicion_salud === 'excelente' ? 'bg-success' : postulante.condicion_salud === 'buena' ? 'bg-warning' : 'bg-danger'}">
                                ${postulante.condicion_salud || 'No especificado'}
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="info-group">
                        <div class="info-label">Peso</div>
                        <div class="info-value">${postulante.peso ? postulante.peso + ' kg' : 'No especificado'}</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="info-group">
                        <div class="info-label">Estatura</div>
                        <div class="info-value">${postulante.estatura ? postulante.estatura + ' cm' : 'No especificado'}</div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                     <div class="info-group">
                        <div class="info-label">Enfermedades Graves</div>
                        <div class="info-value">${postulante.enfermedad_grave ? postulante.enfermedad_grave : 'No especificado'}</div>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="info-group">
                        <div class="info-label">Padecimientos</div>
                        <div class="info-value">${formatearPadecimientos(postulante.padecimientos)}</div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="info-group">
                        <div class="info-label">Medicamentos con Prescripción</div>
                        <div class="info-value">${postulante.medicamentos_prescritos ? postulante.medicamentos_prescritos : 'No especificado'}</div>
                    </div>
                </div>

            
                <div class="col-md-6">
                    <div class="info-group">
                        <div class="info-label">Medicamentos sin Prescripción</div>
                        <div class="info-value">${postulante.medicamentos_sin_prescripcion ? postulante.medicamentos_sin_prescripcion : 'No especificado'}</div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="info-group">
                        <div class="info-label">Último Consumo de Alcohol</div>
                        <div class="info-value">${postulante.ultimo_consumo_alcohol ? postulante.ultimo_consumo_alcohol : 'No especificado'}</div>
                    </div>
                </div>

                <div class="col-md-6">
                        <div class="info-group">
                        <div class="info-label">Último Consumo de Drogas</div>
                        <div class="info-value">${postulante.ultimo_consumo_drogas ? postulante.ultimo_consumo_drogas : 'No especificado'}</div>
                    </div>
                </div>
            </div>

            
            ${postulante.informacion_adicional_salud && postulante.informacion_adicional_salud !== '' ? `
            <div class="info-group">
                <div class="info-label">Información Adicional de Salud</div>
                <div class="info-value">${postulante.informacion_adicional_salud}</div>
            </div>
            ` : ''}
        </div>
        
        <!-- ANTECEDENTES LABORALES -->
        <div class="detalle-section">
            <h6><i class="fas fa-briefcase me-2"></i>Antecedentes Laborales</h6>
            
            <div class="info-group">
                <div class="info-label">¿Cómo se enteró de la vacante?</div>
                <div class="info-value">${postulante.como_se_entero_vacante || 'No especificado'}</div>
            </div>
            
            <div class="info-group">
                <div class="info-label">¿Por qué le interesa esta vacante?</div>
                <div class="info-value">${postulante.porque_interesa_vacante || 'No especificado'}</div>
            </div>
            
            <div class="info-group">
                <div class="info-label">¿Cómo se ve en 5 años?</div>
                <div class="info-value">${postulante.vida_en_5_anos || 'No especificado'}</div>
            </div>
            
           ${postulante.historial_laboral && postulante.historial_laboral !== '' ? `
            <div class="info-group">
                <div class="info-label">Historial Laboral</div>
                <div class="info-value">
                    <div class="historial-laboral">
                        ${formatearHistorialLaboral(postulante.historial_laboral)}
                    </div>
                </div>
            </div>
            ` : ''}
        </div>
        
        <!-- DOCUMENTOS -->
        <div class="detalle-section">
            <h6><i class="fas fa-file-alt me-2"></i>Documentos</h6>
            <div class="d-flex flex-wrap gap-2">
                ${postulante.archivo_cv ? `
                    <button class="btn btn-gradient-primary" onclick="verArchivo('${postulante.archivo_cv}', 'CV - ${postulante.NOMBRE_POSTULANTE || postulante.nombre_completo}')">
                        <i class="fas fa-file-pdf me-1"></i>Ver CV
                    </button>
                ` : '<span class="text-muted small">Sin CV</span>'}
                
                ${postulante.archivo_curp ? `
                    <button class="btn btn-gradient-primary" onclick="verArchivo('${postulante.archivo_curp}', 'CURP - ${postulante.NOMBRE_POSTULANTE || postulante.nombre_completo}')">
                        <i class="fas fa-file-pdf me-1"></i>Ver CURP
                    </button>
                ` : '<span class="text-muted small">Sin CURP</span>'}
                
                ${postulante.tiene_firma_digital == 1 ? `
                    <button class="btn btn-gradient-primary" onclick="verFirmaDigital(${postulante.id_postulacion}, '${postulante.NOMBRE_POSTULANTE || postulante.nombre_completo}')">
                        <i class="fas fa-signature me-1"></i>Ver Firma Digital
                    </button>
                ` : ''}
            </div>
        </div>
        
        <!-- INFORMACIÓN ADICIONAL -->
        <div class="detalle-section">
            <h6><i class="fas fa-clock me-2"></i>Información de Postulación</h6>
            <div class="info-group">
                <div class="info-label">Fecha de Postulación</div>
                <div class="info-value">${formatearFechaCompleta(postulante.fecha_postulacion)}</div>
            </div>
        </div>
    `;
    
    $('#detallePostulante').html(htmlDetalle);
}


// Función para cambiar estado del postulante
function cambiarEstadoPostulante(idPostulacion, nuevoEstado) {
    console.log('📤 Enviando cambio de estado:', { idPostulacion, nuevoEstado });

    // Mostrar loading
    Swal.fire({
        title: 'Actualizando estado...',
        html: '<div class="spinner-border text-primary" role="status"><span class="visually-hidden">Cargando...</span></div>',
        showConfirmButton: false,
        allowOutsideClick: false
    });

    $.ajax({
        url: '../../../api/recursos_humanos_api.php',
        type: 'POST',
        dataType: 'json',
        data: {
            api: 33, // Nuevo API para cambiar estado de postulante
            id_postulacion: idPostulacion,
            nuevo_estado: nuevoEstado
        },
        success: function(response) {
            console.log('📋 Respuesta del servidor (cambio estado):', response);

            // Verificar si el cambio fue exitoso (code 1 o 2)
            let code = response.response ? response.response.code : response.code;
            if (code === 1 || code === 2) {
                const estadoFormateado = formatearEstadoPostulacion(nuevoEstado);

                Swal.fire({
                    title: '¡Estado actualizado!',
                    text: `El postulante ahora está en estado: ${estadoFormateado}`,
                    icon: 'success',
                    confirmButtonText: 'Entendido',
                    timer: 3000,
                    timerProgressBar: true
                });

                // Recargar la lista de postulantes para reflejar el cambio
                const idPublicacion = dataTableGestionPostulantes.id_publicacion;
                if (idPublicacion) {
                    cargarPostulantesPublicacion(idPublicacion);
                } else {
                    console.warn('No se pudo obtener el ID de publicación para recargar');
                }

            } else {
                console.error('Error en la respuesta:', response);
                Swal.fire({
                    title: 'Error',
                    text: response.message || 'No se pudo actualizar el estado del postulante',
                    icon: 'error',
                    confirmButtonText: 'Cerrar'
                });
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.error('Error AJAX al cambiar estado:', textStatus, errorThrown);
            console.error('Respuesta del servidor:', jqXHR.responseText);

            Swal.fire({
                title: 'Error de conexión',
                text: 'No se pudo conectar con el servidor para actualizar el estado',
                icon: 'error',
                confirmButtonText: 'Cerrar'
            });
        }
    });
}


// Función auxiliar para obtener color por estado
function getColorByEstado(estado) {
    const colores = {
        'nueva': '#6c757d',
        'preseleccionado': '#0d6efd',
        'entrevista': '#fd7e14',
        'rechazado': '#dc3545',
        'aprobado': '#198754'
    };
    return colores[estado] || '#0d6efd';
}

// Funciones auxiliares
function obtenerIniciales(nombreCompleto) {
    if (!nombreCompleto) return '??';
    const nombres = nombreCompleto.trim().split(' ');
    if (nombres.length >= 2) {
        return (nombres[0].charAt(0) + nombres[1].charAt(0)).toUpperCase();
    }
    return nombreCompleto.charAt(0).toUpperCase();
}

// Función para validar si una transición de estado es válida
function esTransicionValidaPostulante(estadoActual, nuevoEstado) {

    switch (estadoActual) {
        case 'nueva':
            // Desde nueva se puede ir a cualquier estado
            return true;
            
        case 'entrevista':
            // Desde entrevista se puede ir a preseleccionado, aprobado o rechazado
            return ['preseleccionado', 'aprobado', 'rechazado'].includes(nuevoEstado);
            
        case 'preseleccionado':
            // Desde preseleccionado se puede ir a entrevista, aprobado o rechazado
            return ['aprobado', 'entrevista', 'rechazado'].includes(nuevoEstado);
            
        case 'aprobado':
            // Desde aprobado solo se puede ir a rechazado
            return nuevoEstado === 'rechazado';
            
        case 'rechazado':
            // Desde rechazado se puede reactivar a nueva o preseleccionado
            return ['nueva', 'preseleccionado'].includes(nuevoEstado);
            
        default:
            return false;
    }
}

// Función para obtener estados válidos para un estado actual
function obtenerEstadosValidosPostulante(estadoActual) {
    const estadosValidos = [];
    const todosLosEstados = ['nueva', 'preseleccionado', 'entrevista', 'rechazado', 'aprobado'];
    
    todosLosEstados.forEach(estado => {
        if (estado !== estadoActual && esTransicionValidaPostulante(estadoActual, estado)) {
            estadosValidos.push(estado);
        }
    });
    
    return estadosValidos;
}

// Función para generar opciones de cambio de estado válidas
function generarOpcionesEstadoPostulante(postulante) {
    const estadoActual = postulante.estado_postulacion;
    const estadosValidos = obtenerEstadosValidosPostulante(estadoActual);
    
    // Configuración de estados con iconos y colores
    const configuracionEstados = {
        'nueva': {
            icono: 'fas fa-plus-circle',
            color: 'text-info',
            texto: 'Nueva'
        },
        'preseleccionado': {
            icono: 'fas fa-star',
            color: 'text-secondary',
            texto: 'Preseleccionado'
        },
        'entrevista': {
            icono: 'fas fa-eye',
            color: 'text-warning',
            texto: 'Entrevista'
        },
        'rechazado': {
            icono: 'fas fa-times-circle',
            color: 'text-danger',
            texto: 'Rechazado'
        },
        'aprobado': {
            icono: 'fas fa-check-circle',
            color: 'text-success',
            texto: 'Aprobado'
        }
    };
    
    let opciones = '';
    
    if (estadosValidos.length === 0) {
        // Si no hay estados válidos, mostrar mensaje informativo
        opciones = '<li><span class="dropdown-item text-muted small"><i class="fas fa-info-circle me-2"></i>No hay cambios disponibles</span></li>';
    } else {
        // Generar opciones válidas
        estadosValidos.forEach(estado => {
            const config = configuracionEstados[estado];
            if (config) {
                opciones += `
                    <li>
                        <a class="dropdown-item btn-cambiar-estado-dropdown" 
                           href="#" 
                           data-id-postulacion="${postulante.id_postulacion}" 
                           data-nuevo-estado="${estado}">
                            <i class="${config.icono} me-2 ${config.color}"></i>${config.texto}
                        </a>
                    </li>
                `;
            }
        });
    }
    
    return opciones;
}

function formatearEstadoPostulacion(estado) {
    const estados = {
        'nueva': 'Nueva',
        'preseleccionado': 'Preseleccionado',
        'entrevista': 'Para Entrevista',
        'rechazado': 'Rechazado',
        'aprobado': 'Aprobado'
    };
    return estados[estado] || estado;
}

function formatearFecha(fecha) {
    if (!fecha) return 'Sin fecha';
    const fechaObj = new Date(fecha);
    return fechaObj.toLocaleDateString('es-MX');
}

function formatearFechaCompleta(fecha) {
    if (!fecha) return 'Sin fecha';
    const fechaObj = new Date(fecha);
    return fechaObj.toLocaleDateString('es-MX') + ' ' + 
           fechaObj.toLocaleTimeString('es-MX', {hour: '2-digit', minute: '2-digit'});
}

function verArchivo(rutaArchivo, titulo) {
    if (!rutaArchivo) {
        alertToast('Archivo no disponible', 'warning', 3000);
        return;
    }
    
    $('#vistaPreviewLabel').text(titulo);
    $('#btnDescargarArchivo').attr('href', rutaArchivo);
    
    // Mostrar vista previa
    if (rutaArchivo.toLowerCase().includes('.pdf')) {
        $('#previewContent').html('<iframe src="' + rutaArchivo + '" type="application/pdf"></iframe>');
    } else {
        $('#previewContent').html('<div class="archivo-no-disponible"><i class="fas fa-file fa-3x mb-3"></i><h6>Vista previa no disponible</h6><p>Haz clic en "Descargar" para ver el archivo</p></div>');
    }
    
    $('#vistaPreviewModal').modal('show');
}

// Función para ver la firma digital del postulante
function verFirmaDigital(idPostulacion, nombrePostulante) {
    if (!idPostulacion) {
        alertToast('ID de postulación no válido', 'error', 3000);
        return;
    }
    
    console.log('🖋️ Obteniendo firma digital para postulación:', idPostulacion);
    
    // Mostrar loading
    Swal.fire({
        title: 'Cargando firma digital...',
        html: '<div class="spinner-border text-primary" role="status"><span class="visually-hidden">Cargando...</span></div>',
        showConfirmButton: false,
        allowOutsideClick: false
    });
    
    $.ajax({
        url: '../../../api/recursos_humanos_api.php',
        type: 'POST',
        dataType: 'json',
        data: {
            api: 32,
            id_postulacion: idPostulacion
        },
        success: function(response) {
            console.log('📋 Respuesta del servidor (firma digital):', response);
            
            // Verificar si la respuesta fue exitosa
            let code = response.response ? response.response.code : response.code;
            let data = response.response ? response.response.data : response.data;
            
            if (code === 1 && data && data.length > 0) {
                const firmaData = data[0];
                
                // Convertir tiene_firma a número para comparación (puede venir como string)
                const tieneFirma = parseInt(firmaData.tiene_firma) || 0;
                
                console.log('🔍 Datos de firma recibidos:', {
                    tiene_firma: firmaData.tiene_firma,
                    tieneFirma: tieneFirma,
                    firma_digital_length: firmaData.firma_digital ? firmaData.firma_digital.length : 0
                });
                
                if (firmaData.firma_digital && tieneFirma === 1) {
                    // La firma viene en formato base64 desde la base de datos
                    let firmaBase64 = firmaData.firma_digital;
                    
                    // Limpiar la cadena base64 (remover espacios y saltos de línea)
                    firmaBase64 = firmaBase64.replace(/\s/g, '');
                    
                    let imagenBase64;
                    
                    // Verificar si ya tiene el prefijo data:image
                    if (firmaBase64.startsWith('data:image/')) {
                        imagenBase64 = firmaBase64;
                    } else {
                        // Si no tiene el prefijo, agregarlo (asumiendo PNG por defecto)
                        imagenBase64 = `data:image/png;base64,${firmaBase64}`;
                    }
                    
                    // Mostrar modal con la firma
                    Swal.fire({
                        title: `Firma Digital`,
                        html: `
                            <div class="text-center">
                                <div class="mb-3 firma-protegida">
                                    <img src="${imagenBase64}" 
                                         alt="Firma Digital" 
                                         class="img-fluid border rounded shadow-sm firma-no-seleccionable" 
                                         style="max-width: 100%; max-height: 300px; background-color: #f8f9fa; 
                                                user-select: none; -webkit-user-select: none; -moz-user-select: none; -ms-user-select: none;
                                                pointer-events: none; -webkit-touch-callout: none; -webkit-user-drag: none;
                                                -khtml-user-drag: none; -moz-user-drag: none; -o-user-drag: none; user-drag: none;
                                                -webkit-user-modify: none; -moz-user-modify: none;"
                                         draggable="false"
                                         oncontextmenu="return false;"
                                         onselectstart="return false;"
                                         ondragstart="return false;"
                                         onmousedown="return false;">
                                </div>
                                <div class="text-muted small">
                                    <p><strong>Postulante:</strong> ${firmaData.nombre_completo}</p>
                                    <p><strong>Fecha de postulación:</strong> ${formatearFechaCompleta(firmaData.fecha_postulacion)}</p>
                                    <p><strong>Tamaño de firma:</strong> ${Math.round(parseInt(firmaData.tamaño_firma_bytes) / 1024)} KB</p>
                                    <p class="text-warning small mt-2"><i class="fas fa-shield-alt me-1"></i>Documento protegido - No copiable</p>
                                </div>
                            </div>
                        `,
                        width: '600px',
                        showConfirmButton: true,
                        confirmButtonText: 'Cerrar',
                        confirmButtonColor: '#0d6efd',
                        showCancelButton: false,
                        cancelButtonText: '',
                        cancelButtonColor: '#28a745',
                        reverseButtons: true,
                        customClass: {
                            htmlContainer: 'firma-protegida-modal'
                        },
                        didOpen: () => {
                            // Agregar estilos CSS adicionales de protección
                            const style = document.createElement('style');
                            style.textContent = `
                                .firma-protegida-modal {
                                    user-select: none !important;
                                    -webkit-user-select: none !important;
                                    -moz-user-select: none !important;
                                    -ms-user-select: none !important;
                                }
                                .firma-no-seleccionable {
                                    -webkit-user-select: none !important;
                                    -moz-user-select: none !important;
                                    -ms-user-select: none !important;
                                    user-select: none !important;
                                    -webkit-user-drag: none !important;
                                    -khtml-user-drag: none !important;
                                    -moz-user-drag: none !important;
                                    -o-user-drag: none !important;
                                    user-drag: none !important;
                                    pointer-events: none !important;
                                }
                                .firma-protegida {
                                    position: relative;
                                }
                                .firma-protegida::before {
                                    content: '';
                                    position: absolute;
                                    top: 0;
                                    left: 0;
                                    right: 0;
                                    bottom: 0;
                                    background: transparent;
                                    z-index: 1;
                                    pointer-events: none;
                                }
                            `;
                            document.head.appendChild(style);
                            
                            // Deshabilitar F12, Ctrl+Shift+I, Ctrl+U, etc. temporalmente
                            const disableDevTools = (e) => {
                                if (e.key === 'F12' || 
                                    (e.ctrlKey && e.shiftKey && e.key === 'I') ||
                                    (e.ctrlKey && e.shiftKey && e.key === 'C') ||
                                    (e.ctrlKey && e.key === 'u') ||
                                    (e.ctrlKey && e.key === 's') ||
                                    (e.ctrlKey && e.key === 'p')) {
                                    e.preventDefault();
                                    e.stopPropagation();
                                    return false;
                                }
                            };
                            
                            // Deshabilitar clic derecho en toda la modal
                            const disableRightClick = (e) => {
                                e.preventDefault();
                                return false;
                            };
                            
                            document.addEventListener('keydown', disableDevTools);
                            document.addEventListener('contextmenu', disableRightClick);
                            
                            // Limpiar event listeners cuando se cierre el modal
                            const modal = document.querySelector('.swal2-container');
                            if (modal) {
                                modal.addEventListener('DOMNodeRemoved', () => {
                                    document.removeEventListener('keydown', disableDevTools);
                                    document.removeEventListener('contextmenu', disableRightClick);
                                    if (style.parentNode) {
                                        style.parentNode.removeChild(style);
                                    }
                                });
                            }
                        },
                        willClose: () => {
                            // Limpiar protecciones al cerrar
                            const styles = document.querySelectorAll('style');
                            styles.forEach(style => {
                                if (style.textContent.includes('firma-no-seleccionable')) {
                                    style.remove();
                                }
                            });
                        }
                    }).then((result) => {
                        if (result.dismiss === Swal.DismissReason.cancel) {
                        }
                    });
                } else {
                    Swal.fire({
                        title: 'Sin firma digital',
                        text: 'Este postulante no tiene una firma digital registrada',
                        icon: 'info',
                        confirmButtonText: 'Entendido'
                    });
                }
            } else {
                console.error('Error en la respuesta o datos no encontrados:', response);
                Swal.fire({
                    title: 'Error',
                    text: response.message || 'No se pudo obtener la firma digital del postulante',
                    icon: 'error',
                    confirmButtonText: 'Cerrar'
                });
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.error('Error AJAX al obtener firma:', textStatus, errorThrown);
            console.error('Respuesta del servidor:', jqXHR.responseText);
            
            Swal.fire({
                title: 'Error de conexión',
                text: 'No se pudo conectar con el servidor para obtener la firma digital',
                icon: 'error',
                confirmButtonText: 'Cerrar'
            });
        }
    });
}

// Función para formatear el historial laboral
function formatearHistorialLaboral(historialJson) {
    if (!historialJson) return 'Sin historial laboral registrado';
    
    try {
        const historial = JSON.parse(historialJson);
        if (!Array.isArray(historial) || historial.length === 0) {
            return 'Sin historial laboral registrado';
        }
        
        let html = '<div class="table-responsive"><table class="table table-sm table-bordered">';
        html += '<thead class="table-light"><tr>';
        html += '<th>Empresa</th><th>Puesto</th><th>Sueldo</th>';
        html += '<th>Actividades</th><th>Motivo Separación</th><th>Referencias</th>';
        html += '</tr></thead><tbody>';
        
        historial.forEach(trabajo => {
            html += '<tr>';
            html += '<td>' + (trabajo.empresa || '-') + '</td>';
            html += '<td>' + (trabajo.puesto || '-') + '</td>';
            html += '<td>' + (trabajo.sueldo || '-') + '</td>';
            html += '<td>' + (trabajo.actividades || '-') + '</td>';
            html += '<td>' + (trabajo.motivo_separacion || '-') + '</td>';
            html += '<td>' + (trabajo.referencias || '-') + '</td>';
            html += '</tr>';
        });
        
        html += '</tbody></table></div>';
        return html;
    } catch (e) {
        // Si no es JSON válido, mostrar como texto plano
        return '<div class="alert alert-info small">' + historialJson + '</div>';
    }
}


// Función para formatear padecimientos como lista en 2 columnas
function formatearPadecimientos(padecimientos) {
    if (!padecimientos) return 'Ninguno';
    
    const lista = padecimientos.split(',').map(p => p.trim()).filter(p => p);
    if (lista.length === 0) return 'Ninguno';
    
    // Calcular punto de división (mitad)
    const puntoMedio = Math.ceil(lista.length / 2);
    
    // Dividir la lista por la mitad
    const columnaIzquierda = lista.slice(0, puntoMedio);
    const columnaDerecha = lista.slice(puntoMedio);
    
    let html = '<div class="row">';
    
    // Generar HTML para columna izquierda
    html += '<div class="col-6">';
    if (columnaIzquierda.length > 0) {
        html += '<ul class="list-unstyled mb-0">';
        columnaIzquierda.forEach(p => {
            html += '<li class="mb-1"><i class="fas fa-check-circle text-warning me-1"></i>' + p + '</li>';
        });
        html += '</ul>';
    }
    html += '</div>';
    
    // Generar HTML para columna derecha
    html += '<div class="col-6">';
    if (columnaDerecha.length > 0) {
        html += '<ul class="list-unstyled mb-0">';
        columnaDerecha.forEach(p => {
            html += '<li class="mb-1"><i class="fas fa-check-circle text-warning me-1"></i>' + p + '</li>';
        });
        html += '</ul>';
    }
    html += '</div>';
    
    html += '</div>';
    
    return html;
}

// Función para llenar el modal de detalles de publicación
function llenarModalDetallesPublicacion(publicacionData) {
    if (!publicacionData) {
        console.error('No se proporcionaron datos de publicación');
        return false;
    }
    
    console.log('Datos de publicación para detalles:', publicacionData);
    
    try {
        // === INFORMACIÓN GENERAL ===
        $('#numeroRequisicionPub').text('#' + publicacionData.numero_requisicion);
        
        // Estado de publicación
        const estadoBadges = {
        'no_publicada': '<span class="badge bg-gradient-secondary">No Publicada</span>',
        'publicada_normal': '<span class="badge bg-gradient-primary">Publicada</span>',
        'publicada_editada': '<span class="badge bg-gradient-primary">Publicada</span>',
        'detenida': '<span class="badge bg-gradient-warning">Detenida</span>',
        'cerrada': '<span class="badge bg-gradient-info">Cerrada</span>'
        };
        $('#badgeEstadoPublicacion').html(estadoBadges[publicacionData.estado_publicacion] || 
            '<span class="badge bg-secondary">Sin estado</span>');
        
        // Tipo de publicación
        const tipoBadges = {
            'interna': '<span class="badge bg-gradient-primary">Interna</span>',
            'externa': '<span class="badge bg-gradient-info">Externa</span>',
            'ambas': '<span class="badge bg-gradient-warning">Ambas</span>'
        };
        $('#badgeTipoPublicacion').html(tipoBadges[publicacionData.tipo_publicacion] || 
            '<span class="badge bg-secondary">Sin especificar</span>');
        
        $('#tituloVacante').text(publicacionData.titulo_vacante || 'Sin título especificado');
        $('#departamentoPublicacion').text(publicacionData.departamento_nombre || 'Sin especificar');
        $('#puestoPublicacion').text(publicacionData.puesto_nombre || 'Sin especificar');
        
        // Fecha de publicación
        if (publicacionData.fecha_inicio_publicacion) {
            let fechaInicio = new Date(publicacionData.fecha_inicio_publicacion);
            $('#fechaInicioPublicacion').text(fechaInicio.toLocaleDateString('es-MX') + ' ' + 
                fechaInicio.toLocaleTimeString('es-MX', {hour: '2-digit', minute: '2-digit'}));
        } else {
            $('#fechaInicioPublicacion').text('Sin fecha registrada');
        }
        
        $('#descripcionAdicional').text(publicacionData.descripcion_adicional || 'Sin descripción adicional');
        
        // === GESTIÓN DE POSTULANTES ===
        
        // Extraer datos de criterios de cierre
        let maxPostulantes = 'Sin límite';
        let criteriosCierreTexto = 'Fecha límite únicamente';
        
        if (publicacionData.criterios_cierre_automatico) {
            try {
                let criterios = typeof publicacionData.criterios_cierre_automatico === 'string' 
                    ? JSON.parse(publicacionData.criterios_cierre_automatico) 
                    : publicacionData.criterios_cierre_automatico;
                    
                if (criterios.max_postulantes) {
                    maxPostulantes = criterios.max_postulantes + ' postulantes';
                }
                
                let criteriosArray = [];
                if (criterios.max_postulantes) criteriosArray.push('Máx. ' + criterios.max_postulantes + ' postulantes');
                if (criterios.vacantes_cubiertas && criterios.vacantes_cubiertas > 0) criteriosArray.push('Vacantes cubiertas');
                if (criterios.fecha_limite) criteriosArray.push('Fecha límite');
                
                criteriosCierreTexto = criteriosArray.length > 0 ? criteriosArray.join(', ') : 'Sin criterios específicos';
                
            } catch (e) {
                console.warn('Error al parsear criterios de cierre:', e);
            }
        }
        
        $('#maxPostulantes').text(maxPostulantes);
        $('#criteriosCierre').text(criteriosCierreTexto);
        
        // Fecha límite
        if (publicacionData.fecha_limite_publicacion) {
            let fechaLimite = new Date(publicacionData.fecha_limite_publicacion);
            $('#fechaLimitePublicacion').text(fechaLimite.toLocaleDateString('es-MX'));
        } else {
            $('#fechaLimitePublicacion').text('Sin fecha límite');
        }
        
        // Total de postulaciones (por ahora 0, se puede conectar con API después)
        $('#totalPostulaciones').text(publicacionData.numero_postulantes || '0 postulaciones');
        
        // Plataformas de publicación
        let plataformasTexto = 'No especificadas';
        if (publicacionData.plataformas_publicacion) {
            try {
                let plataformas = typeof publicacionData.plataformas_publicacion === 'string' 
                    ? JSON.parse(publicacionData.plataformas_publicacion) 
                    : publicacionData.plataformas_publicacion;
                    
                if (Array.isArray(plataformas) && plataformas.length > 0) {
                    const plataformasNombres = {
                        'web': 'Sitio Web',
                        'linkedin': 'LinkedIn',
                        'indeed': 'Indeed',
                        'computrabajo': 'CompuTrabajo',
                        'occ': 'OCC Mundial'
                    };
                    
                    plataformasTexto = plataformas.map(p => plataformasNombres[p] || p).join(', ');
                }
            } catch (e) {
                console.warn('Error al parsear plataformas:', e);
            }
        }
        $('#plataformasPublicacion').text(plataformasTexto);
        
        // === INFORMACIÓN DEL PUESTO ===
        $('#puestoSolicitadoPub').text(publicacionData.puesto_nombre || 'Sin especificar');
        $('#tipoContratoPub').text(formatearTipoContrato(publicacionData.tipo_contrato) || 'Sin especificar');
        $('#tipoJornadaPub').text(formatearTipoJornada(publicacionData.tipo_jornada) || 'Sin especificar');
        $('#tipoModalidadPub').text(formatearTipoModalidad(publicacionData.tipo_modalidad) || 'Sin especificar');

        // === CONFIGURACIÓN DE CIERRE ===
        // Prioridad
        $('#prioridadPublicacion').html(formatearPrioridadDetalle(publicacionData.prioridad));

        // Fecha de publicación
        if (publicacionData.fecha_cierre_real) {
            let fechaCierre = new Date(publicacionData.fecha_cierre_real);
            $('#fechaCierrePublicacion').text(fechaCierre.toLocaleDateString('es-MX') + ' ' + 
                fechaCierre.toLocaleTimeString('es-MX', {hour: '2-digit', minute: '2-digit'}));
        } else {
            $('#fechaCierrePublicacion').text('Sin fecha registrada');
        }
        
        // === CONDICIONES LABORALES ===
        if (publicacionData.dias_trabajo && publicacionData.dias_trabajo === 'otro') {
            $("#diaTrabajoPub").text('Personalizado');
            $("#diaPersonalizadoPubContainer").show();
            $("#diaPersonalizadoPub").text(publicacionData.dias_personalizados || 'N/A');
        } else { 
          $("#diaTrabajoPub").text(formatearDiasTrabajo(publicacionData.dias_trabajo) || 'N/A')
          $("#diaPersonalizadoPubContainer").hide();
        }
        $('#horaInicioPub').text(publicacionData.hora_inicio || 'Sin especificar');
        $('#horaFinPub').text(publicacionData.hora_fin || 'Sin especificar');

        // === REQUISITOS DEL PERFIL ===
        $('#escolaridadMinimaPub').text(formatearEscolaridad(publicacionData.escolaridad_minima) || 'Sin especificar');
        $('#experienciaAnosPub').text(formatearExperiencia(publicacionData.experiencia_anios) || 'Sin especificar');
        $('#bandaSalarialPub').text(publicacionData.salario_min && publicacionData.salario_max ? '$' + publicacionData.salario_min + ' - $' + publicacionData.salario_max : 'No especificado');
        $('#competenciasPub').text(publicacionData.competencias || 'Sin especificar');
        $('#objetivosPub').text(publicacionData.objetivos || 'Sin especificar');
        
        // Habilidades blandas y técnicas (si están disponibles)
        // Por ahora mostrar mensaje indicativo
        $('#habilidadesBlandasPubContainer').html('<span class="sin-habilidades">No especificadas</span>');
        $('#habilidadesTecnicasPubContainer').html('<span class="sin-habilidades">No especificadas</span>');
        
        // === ESTADO DE LA PUBLICACIÓN ===
        // Última actualización (usar fecha actual si no está disponible)
        let fechaActualizacion = new Date();
        if (publicacionData.fecha_actualizacion) {
            fechaActualizacion = new Date(publicacionData.fecha_actualizacion);
        }
        $('#fechaActualizacion').text(fechaActualizacion.toLocaleDateString('es-MX') + ' ' + 
            fechaActualizacion.toLocaleTimeString('es-MX', {hour: '2-digit', minute: '2-digit'}));
        
        $('#estadoRequisicion').text(publicacionData.estatus_requisicion || 'Aprobada');
        $('#motivoRequisicionPub').text(publicacionData.motivo || 'Sin motivo especificado');
        
        // === ESTABLECER ID DE PUBLICACIÓN EN EL BOTÓN DE GESTIONAR POSTULANTES ===
        $('#btnVerPostulantes').data('id-publicacion', publicacionData.id_publicacion);
        
        // También guardarlo en localStorage como respaldo
        localStorage.setItem('idPublicacionActual', publicacionData.id_publicacion);
        
        console.log('✅ ID de publicación establecido:', publicacionData.id_publicacion);
        
        return true;
        
    } catch (error) {
        console.error('Error al llenar modal de detalles:', error);
        return false;
    }
}

// Función para editar una publicación
function actualizarPublicacionVacante(formData) {
    // Validar permiso
    if(!window.tienePermisoRegPub) {
        alertToast('No tiene permisos para editar publicaciones.', 'error', 5000);
        return;
    }
    const idPublicacion = formData.id_publicacion;
    
    // Deshabilitar botón mientras se procesa
    let btnEditar = $('.btn-editar-publicacion[data-id-publicacion="' + idPublicacion + '"]');
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
        numero_postulantes: formData.numero_postulantes || 0,
        titulo_vacante: formData.titulo_vacante,
        descripcion_adicional: formData.descripcion_adicional || 'Sin observaciones',
        estado_publicacion: 'publicada_editada', // Siempre será 'editada' al actualizar
        tipo_publicacion: formData.tipo_publicacion,
        fecha_limite_publicacion: fechaLimiteCompleta,
        plataformas_publicacion: JSON.stringify(plataformasSeleccionadas),
        criterios_cierre_automatico: JSON.stringify(criteriosCierre),
        max_postulantes: formData.max_postulantes,
        usuario_publicador_id: window.userId // Se agrega el ID para permisos
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
                alertToast('Publicación actualizada exitosamente', 'success', 3000);
                
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

// Event listeners para filtros y búsqueda de postulantes
$(document).ready(function() {
    // Filtro por estado
    $(document).on('click', '.filtro-estado', function(e) {
        e.preventDefault();
        const estadoFiltro = $(this).data('estado');
        
        // Actualizar estado activo del filtro
        $('.filtro-estado').removeClass('active');
        $(this).addClass('active');
        
        // Aplicar filtro
        if (estadoFiltro === 'todos') {
            $('.postulante-item').show();
        } else {
            $('.postulante-item').hide();
            $('.postulante-item').each(function() {
                const postulante = JSON.parse($(this).attr('data-postulante'));
                if (postulante.estado_postulacion === estadoFiltro) {
                    $(this).show();
                }
            });
        }
        
        // Actualizar contador
        const postulantesMostrados = $('.postulante-item:visible').length;
        $('#contadorPostulantes').text(postulantesMostrados);
    });
    
    // Buscador por nombre
    $(document).on('input', '#buscarPostulante', function() {
        const termino = $(this).val().toLowerCase().trim();
        
        if (termino === '') {
            $('.postulante-item').show();
        } else {
            $('.postulante-item').each(function() {
                const postulante = JSON.parse($(this).attr('data-postulante'));
                const nombre = (postulante.NOMBRE_POSTULANTE || postulante.nombre_completo || '').toLowerCase();
                
                if (nombre.includes(termino)) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        }
        
        // Actualizar contador
        const postulantesMostrados = $('.postulante-item:visible').length;
        $('#contadorPostulantes').text(postulantesMostrados);
    });
    
    // Limpiar filtros al cerrar el modal
    $('#gestionPostulantesModal').on('hidden.bs.modal', function () {
        $('#buscarPostulante').val('');
        $('.filtro-estado').removeClass('active');
        $('.filtro-estado[data-estado="todos"]').addClass('active');
        $('#contadorPostulantes').text('0');
        $('#tituloVacantePostulantes').text('Vacante: Example Vacancy');
    });
});

// MOVER TODAS ESTAS FUNCIONES FUERA DEL $(document).ready
// ===== FUNCIONES PARA GESTIÓN DE CANDIDATOS =====


// Función para cambiar estado de candidato (CORREGIDA - declaración global)
function cambiarEstadoCandidato(idCandidato, nuevoEstado, nombreCandidato) {
    console.group('🔄 CAMBIAR ESTADO CANDIDATO');
    console.log('📋 Parámetros:', { idCandidato, nuevoEstado, nombreCandidato });

    if(!window.tienePermisoGesCand) {
        alertToast('No tiene permisos para cambiar el estado de los candidatos.', 'warning', 5000);
        return;
    }
    
    let titulo, texto, textoConfirm;
    
    switch(nuevoEstado) {
        case 'en_espera':
            titulo = 'Enviar Propuesta Salarial';
            texto = `¿Está seguro de enviar la propuesta salarial a ${nombreCandidato}? Esto cambiará su estado a "En Espera".`;
            textoConfirm = 'Sí, enviar propuesta';
            break;
        case 'finalista':
            titulo = 'Marcar como Finalista';
            texto = `¿Está seguro de marcar a ${nombreCandidato} como Finalista?`;
            textoConfirm = 'Sí, es finalista';
            break;
        case 'contratado':
            titulo = 'Contratar Candidato';
            texto = `¿Está seguro de marcar a ${nombreCandidato} como Contratado? Esta acción es irreversible.`;
            textoConfirm = 'Sí, contratar';
            break;
        default:
            titulo = 'Cambiar Estado';
            texto = `¿Está seguro de cambiar el estado de ${nombreCandidato}?`;
            textoConfirm = 'Sí, cambiar';
    }

    console.log('💬 Mostrar confirmación:', titulo);

    Swal.fire({
        title: titulo,
        text: texto,
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: textoConfirm,
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        console.log('✅ Resultado de confirmación:', result);
        
        if (result.isConfirmed) {
            console.log('👍 Usuario confirmó acción');
            if (nuevoEstado === 'en_espera') {
                console.log('📝 Mostrando modal de propuesta salarial');
                mostrarModalPropuestaSalarial(idCandidato, nombreCandidato);
            } else {
                console.log('⚡ Ejecutando cambio directo');
                ejecutarCambioEstado(idCandidato, nuevoEstado);
            }
        } else {
            console.log('👎 Usuario canceló acción');
        }
        console.groupEnd();
    });
}

// Función para rechazar candidato (CORREGIDA - declaración global)
function rechazarCandidato(idCandidato, nombreCandidato) {
    console.group('❌ RECHAZAR CANDIDATO');
    console.log('📋 Parámetros:', { idCandidato, nombreCandidato });

    if(!window.tienePermisoGesCand) {
        alertToast('No tiene permisos para rechazar el estado de los candidatos.', 'warning', 5000);
        return;
    }
    
    Swal.fire({
        title: 'Rechazar Candidato',
        html: `
            <p>¿Está seguro de rechazar a <strong>${nombreCandidato}</strong>?</p>
            <div class="form-group mt-3">
                <label for="motivoRechazo">Motivo de rechazo:</label>
                <select class="form-control" id="motivoRechazo" required>
                    <option value="">Seleccione un motivo</option>
                    <option value="no_cumple_perfil">No cumple con el perfil</option>
                    <option value="salario_elevado">Expectativa salarial muy elevada</option>
                    <option value="disponibilidad">Problemas de disponibilidad</option>
                    <option value="referencias">Referencias negativas</option>
                    <option value="otro">Otro motivo</option>
                </select>
            </div>
            <div class="form-group mt-2">
                <label for="comentariosRechazo">Comentarios adicionales:</label>
                <textarea class="form-control" id="comentariosRechazo" rows="3" placeholder="Comentarios opcionales..."></textarea>
            </div>
        `,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Sí, rechazar',
        cancelButtonText: 'Cancelar',
        preConfirm: () => {
            const motivo = document.getElementById('motivoRechazo').value;
            const comentarios = document.getElementById('comentariosRechazo').value;
            
            console.log('📝 Datos del modal de rechazo:', { motivo, comentarios });
            
            if (!motivo) {
                console.warn('⚠️ No se seleccionó motivo');
                Swal.showValidationMessage('Debe seleccionar un motivo de rechazo');
                return false;
            }
            
            return { motivo, comentarios };
        }
    }).then((result) => {
        console.log('✅ Resultado del modal:', result);
        
        if (result.isConfirmed) {
            console.log('👍 Usuario confirmó rechazo');
            console.log('📋 Datos a enviar:', result.value);
            ejecutarRechazo(idCandidato, result.value.motivo, result.value.comentarios);
        } else {
            console.log('👎 Usuario canceló rechazo');
        }
        console.groupEnd();
    });
}

// Función para mostrar modal de propuesta salarial
function mostrarModalPropuestaSalarial(idCandidato, nombreCandidato) {
    // Validar permisos antes de mostrar el modal
    if (!window.tienePermisoGesCand) {
        alertToast(
            'No tiene permisos para enviar propuestas salariales.',
            'warning',
            5000
        );
        return;
    }

    Swal.fire({
            title: 'Propuesta Salarial',
            html: `
                <p>Datos de la propuesta para <strong>${nombreCandidato}</strong>:</p>
                <div class="form-group mt-3">
                    <label for="salarioOfertado">Salario ofertado (mensual):</label>
                    <input type="number" class="form-control" id="salarioOfertado" min="0" step="0.01" placeholder="0.00">
                </div>
                <div class="form-group mt-2">
                    <label for="fechaInicioPropuesta">Fecha de inicio propuesta:</label>
                    <input type="date" class="form-control" id="fechaInicioPropuesta">
                </div>
                <div class="form-group mt-2">
                    <label for="condicionesEspeciales">Condiciones especiales:</label>
                    <textarea class="form-control" id="condicionesEspeciales" rows="3" placeholder="Beneficios adicionales, horarios especiales, etc."></textarea>
                </div>
                <div class="form-group mt-2">
                    <label for="comentariosPropuesta">Comentarios:</label>
                    <textarea class="form-control" id="comentariosPropuesta" rows="2" placeholder="Comentarios adicionales..."></textarea>
                </div>
            `,
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#28a745',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Enviar Propuesta',
            cancelButtonText: 'Cancelar',
            preConfirm: () => {
                const salario = document.getElementById('salarioOfertado').value;
                const fechaInicio = document.getElementById('fechaInicioPropuesta').value;
                const condiciones = document.getElementById('condicionesEspeciales').value;
                const comentarios = document.getElementById('comentariosPropuesta').value;
                
                if (!salario || salario <= 0) {
                    Swal.showValidationMessage('Debe ingresar un salario válido');
                    return false;
                }
                
                return { salario, fechaInicio, condiciones, comentarios };
            }
        }).then((result) => {
            if (result.isConfirmed) {
                ejecutarCambioEstado(idCandidato, 'en_espera', 'Envío de propuesta salarial', result.value);
            }
        });
}

    // Función para ejecutar el cambio de estado
    function ejecutarCambioEstado(idCandidato, nuevoEstado, motivo = null, datosAdicionales = null) {
        console.group('🔄 EJECUTAR CAMBIO DE ESTADO');
        console.log('📋 Parámetros recibidos:', {
            idCandidato,
            nuevoEstado,
            motivo,
            datosAdicionales
        });

        const datos = new FormData();
        datos.append('api', '35');
        datos.append('id_candidato', idCandidato);
        datos.append('estado_candidato', nuevoEstado);
        datos.append('motivo_cambio', motivo || `Cambio a estado ${nuevoEstado}`);
        datos.append('usuario_id', window.userId); // Agregar usuario para auditoría
        
        if (datosAdicionales) {
            console.log('📝 Agregando datos adicionales:', datosAdicionales);
            if (datosAdicionales.salario) datos.append('salario_ofertado', datosAdicionales.salario);
            if (datosAdicionales.fechaInicio) datos.append('fecha_inicio_propuesta', datosAdicionales.fechaInicio);
            if (datosAdicionales.condiciones) datos.append('condiciones_especiales', datosAdicionales.condiciones);
            if (datosAdicionales.comentarios) datos.append('comentarios_rh', datosAdicionales.comentarios);
        }

        // Log de datos que se envían
        console.log('📤 Datos a enviar:');
        for (let [key, value] of datos.entries()) {
            console.log(`  ${key}: ${value}`);
        }

        fetch('../../../api/recursos_humanos_api.php', {
            method: 'POST',
            body: datos
        })
        .then(response => {
            console.log('📨 Respuesta HTTP Status:', response.status);
            
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            
            return response.text();
        })
        .then(text => {
            console.log('📄 Respuesta RAW del servidor:', text);
            
            try {
                const data = JSON.parse(text);
                console.log('📋 Respuesta JSON parseada:', data);
                
                let code = null;
                let message = null;
                
                if (data.response && data.response.code !== undefined) {
                    code = data.response.code;
                    message = data.response.message || data.response.msj;
                } else if (data.code !== undefined) {
                    code = data.code;
                    message = data.message || data.msj;
                }
                
                console.log('✅ Code extraído:', code);
                console.log('💬 Message extraído:', message);
                
                // Aceptar tanto code 1 como code 2
                if (code === 1 || code === 2) {
                    console.log('🎉 ÉXITO: Estado actualizado correctamente');
                    Swal.fire({
                        title: '¡Éxito!',
                        text: 'Estado del candidato actualizado correctamente',
                        icon: 'success',
                        timer: 2000,
                        showConfirmButton: false
                    });
                    if (typeof tablePostulantesAprobados !== 'undefined') {
                        tablePostulantesAprobados.ajax.reload();
                    }
                } else {
                    console.error('❌ ERROR: Code no exitoso:', code);
                    
                    // Mensaje específico para permisos
                    if (message && message.includes("No tiene permisos")) {
                        alertToast(
                            "No tiene permisos para gestionar candidatos. Contacte al administrador.",
                            "error",
                            5000
                        );
                    } else {
                        Swal.fire({
                            title: 'Error',
                            text: message || 'Error al actualizar el estado del candidato',
                            icon: 'error'
                        });
                    }
                }
            } catch (parseError) {
                console.error('🚨 ERROR al parsear JSON:', parseError);
                Swal.fire({
                    title: 'Error de formato',
                    text: 'La respuesta del servidor no es un JSON válido',
                    icon: 'error'
                });
            }
        })
        .catch(error => {
            console.error('🚨 ERROR en fetch:', error);
            Swal.fire({
                title: 'Error de conexión',
                text: 'Error al conectar con el servidor: ' + error.message,
                icon: 'error'
            });
        })
        .finally(() => {
            console.groupEnd();
        });
    }

    // Función para ejecutar el rechazo de candidato
    function ejecutarRechazo(idCandidato, motivo, comentarios) {
        console.group('❌ EJECUTAR RECHAZO CANDIDATO');
        console.log('📋 Parámetros recibidos:', {
            idCandidato,
            motivo,
            comentarios
        });

        // Validar permisos antes de continuar
        if (!window.tienePermisoRegPub) {
            console.error('❌ Sin permisos para rechazar candidatos');
            alertToast(
                'No tiene permisos para rechazar candidatos. Contacte al administrador.',
                'error',
                5000
            );
            return;
        }

        const datos = new FormData();
        datos.append('api', '36'); // API específica para rechazo
        datos.append('id_candidato', idCandidato);
        datos.append('estado_candidato', 'rechazado');
        datos.append('motivo_rechazo', motivo);
        datos.append('comentarios_rechazo', comentarios || '');
        datos.append('usuario_id', window.userId); // Agregar usuario para auditoría

        // Log de datos que se envían
        console.log('📤 Datos a enviar:');
        for (let [key, value] of datos.entries()) {
            console.log(`  ${key}: ${value}`);
        }

        fetch('../../../api/recursos_humanos_api.php', {
            method: 'POST',
            body: datos
        })
        .then(response => {
            console.log('📨 Respuesta HTTP Status:', response.status);
            
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            
            return response.text();
        })
        .then(text => {
            console.log('📄 Respuesta RAW del servidor:', text);
            
            try {
                const data = JSON.parse(text);
                console.log('📋 Respuesta JSON parseada:', data);
                
                let code = null;
                let message = null;
                
                if (data.response && data.response.code !== undefined) {
                    code = data.response.code;
                    message = data.response.message || data.response.msj;
                } else if (data.code !== undefined) {
                    code = data.code;
                    message = data.message || data.msj;
                }
                
                console.log('✅ Code extraído:', code);
                console.log('💬 Message extraído:', message);
                
                // Aceptar tanto code 1 como code 2
                if (code === 1 || code === 2) {
                    console.log('🎉 ÉXITO: Candidato rechazado correctamente');
                    Swal.fire({
                        title: '¡Candidato rechazado!',
                        text: 'El candidato ha sido rechazado correctamente',
                        icon: 'success',
                        timer: 2000,
                        showConfirmButton: false
                    });
                    if (typeof tablePostulantesAprobados !== 'undefined') {
                        tablePostulantesAprobados.ajax.reload();
                    }
                } else {
                    console.error('❌ ERROR: Code no exitoso:', code);
                    
                    // Mensaje específico para permisos
                    if (message && message.includes("No tiene permisos")) {
                        alertToast(
                            "No tiene permisos para rechazar candidatos. Contacte al administrador.",
                            "error",
                            5000
                        );
                    } else {
                        Swal.fire({
                            title: 'Error',
                            text: message || 'Error al rechazar el candidato',
                            icon: 'error'
                        });
                    }
                }
            } catch (parseError) {
                console.error('🚨 ERROR al parsear JSON:', parseError);
                Swal.fire({
                    title: 'Error de formato',
                    text: 'La respuesta del servidor no es un JSON válido',
                    icon: 'error'
                });
            }
        })
        .catch(error => {
            console.error('🚨 ERROR en fetch:', error);
            Swal.fire({
                title: 'Error de conexión',
                text: 'Error al conectar con el servidor: ' + error.message,
                icon: 'error'
            });
        })
        .finally(() => {
            console.groupEnd();
        });
    }

// Asignar funciones al objeto window para acceso global
window.cambiarEstadoCandidato = cambiarEstadoCandidato;
window.rechazarCandidato = rechazarCandidato;
window.ejecutarRechazo = ejecutarRechazo;
window.ejecutarCambioEstado = ejecutarCambioEstado;
window.mostrarModalPropuestaSalarial = mostrarModalPropuestaSalarial;

// ⭐ NUEVA FUNCIÓN: Generar carta de propuesta salarial firmada
window.generarCartaFirmada = async function(idCandidato, nombreCandidato) {
    try {
        const confirmResult = await Swal.fire({
            title: '¿Generar carta firmada?',
            html: `
                <p>¿Desea generar la carta de propuesta salarial firmada para:</p>
                <strong>${nombreCandidato}</strong>
                <br><br>
                <small class="text-muted">La carta se guardará en el archivo del candidato y podrá descargarse.</small>
            `,
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#28a745',
            cancelButtonColor: '#6c757d',
            confirmButtonText: '<i class="fas fa-file-signature"></i> Generar Carta',
            cancelButtonText: 'Cancelar'
        });

        if (!confirmResult.isConfirmed) return;

        Swal.fire({
            title: 'Generando carta...',
            html: `<div class="d-flex justify-content-center">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Cargando...</span>
                        </div>
                   </div>
                   <p class="mt-3">Generando documento PDF profesional...</p>`,
            allowOutsideClick: false,
            showConfirmButton: false,
            didOpen: () => Swal.showLoading()
        });

        const formData = new FormData();
        formData.append('api', '39');
        formData.append('id_candidato', idCandidato);

        const response = await fetch('../../../api/recursos_humanos_api.php', {
            method: 'POST',
            body: formData
        });

        if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);

        const rawData = await response.json();
        console.log('Respuesta generar carta RAW:', rawData);

        // Ajustar al formato que devuelve tu API
        const apiData = rawData.response?.data || rawData.data || rawData;

        if (apiData.code === 1 && apiData.data) {
            const info = apiData.data;

            await Swal.fire({
                title: '¡Carta generada exitosamente!',
                html: `
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle fa-2x text-success mb-3"></i>
                        <h5>Carta de propuesta salarial generada</h5>
                        <p><strong>Candidato:</strong> ${info.candidato}</p>
                        <p><strong>Archivo:</strong> ${info.filename}</p>
                        <p><strong>Ubicación:</strong> ${info.directorio}</p>
                    </div>
                    <div class="mt-3">
                        <button type="button" class="btn btn-primary btn-sm" onclick="descargarCartaGenerada('${info.url_path}', '${info.filename}')">
                            <i class="fas fa-download"></i> Descargar Carta
                        </button>
                    </div>
                `,
                icon: 'success',
                confirmButtonColor: '#28a745'
            });

            if (typeof tablePostulantesAprobados !== 'undefined') {
                tablePostulantesAprobados.ajax.reload();
            }

        } else {
            throw new Error(apiData.message || 'Error desconocido al generar la carta');
        }

    } catch (error) {
        console.error('Error en generarCartaFirmada:', error);

        await Swal.fire({
            title: 'Error al generar carta',
            html: `
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-triangle fa-2x text-danger mb-3"></i>
                    <p>${error.message || 'Ocurrió un error inesperado'}</p>
                </div>
                <small class="text-muted">
                    Verifique que el candidato tenga firma digital registrada y que todos los datos estén completos.
                </small>
            `,
            icon: 'error',
            confirmButtonColor: '#dc3545'
        });
    }
};


// Función auxiliar para descargar carta generada
window.descargarCartaGenerada = function(urlPath, filename) {
    const link = document.createElement('a');
    link.href = urlPath;
    link.download = filename;
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
    
    // Mostrar confirmación
    Swal.fire({
        title: 'Descarga iniciada',
        text: 'El archivo se está descargando...',
        icon: 'info',
        timer: 2000,
        showConfirmButton: false
    });
};

// Función mejorada para abrir carta salarial
window.abrirCartaSalarial = function(archivoCartaUrl, nombreCandidato) {
    console.log('abrirCartaSalarial - Parámetros recibidos:', {
        archivoCartaUrl,
        nombreCandidato,
        tipo: typeof archivoCartaUrl
    });
    
    // Validar que la URL no esté vacía o sea undefined/null
    if (!archivoCartaUrl || 
        archivoCartaUrl === 'undefined' || 
        archivoCartaUrl === 'null' || 
        archivoCartaUrl.trim() === '') {
        
        console.warn('URL de carta no válida:', archivoCartaUrl);
        
        Swal.fire({
            icon: 'warning',
            title: 'Carta no disponible',
            html: `
                <p>Este candidato no tiene una carta firmada generada aún.</p>
                <small class="text-muted">Use el botón "Generar carta" para crear el documento.</small>
            `,
            confirmButtonColor: '#007bff'
        });
        return;
    }
    
    // Normalizar la URL
    let urlFinal = archivoCartaUrl.trim();
    
    // Si no es una URL completa, construir desde el dominio base
    if (!urlFinal.startsWith('http://') && !urlFinal.startsWith('https://')) {
        const baseUrl = window.location.origin;
        const basePath = '/nuevo_checkup/';
        
        // Remover barras duplicadas
        if (urlFinal.startsWith('/')) {
            urlFinal = urlFinal.substring(1);
        }
        
        urlFinal = baseUrl + basePath + urlFinal;
    }
    
    console.log('URL final construida:', urlFinal);
    
    // Mostrar loading
    Swal.fire({
        title: 'Abriendo carta...',
        html: `
            <div class="d-flex justify-content-center">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Cargando...</span>
                </div>
            </div>
            <p class="mt-3">Cargando carta de ${nombreCandidato}</p>
        `,
        allowOutsideClick: false,
        showConfirmButton: false,
        timer: 1500
    });
    
    // Intentar abrir la URL después del loading
    setTimeout(() => {
        try {
            // Abrir en nueva ventana/pestaña
            const ventana = window.open(urlFinal, '_blank', 'width=1000,height=800,scrollbars=yes,resizable=yes');
            
            if (!ventana) {
                throw new Error('Popup bloqueado');
            }
            
            // Cerrar el loading
            Swal.close();
            
            // Toast de éxito
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                title: `Carta de ${nombreCandidato} abierta`,
                showConfirmButton: false,
                timer: 3000
            });
            
        } catch (error) {
            console.error('Error al abrir carta:', error);
            
            Swal.fire({
                icon: 'error',
                title: 'Error al abrir carta',
                html: `
                    <p>No se pudo abrir la carta para <strong>${nombreCandidato}</strong></p>
                    <small class="text-muted">
                        Verifique que el archivo existe y que no hay bloqueo de popups.
                    </small>
                    <div class="mt-3">
                        <button type="button" class="btn btn-primary btn-sm" 
                                onclick="window.open('${urlFinal}', '_blank')">
                            <i class="fas fa-external-link-alt"></i> Intentar nuevamente
                        </button>
                    </div>
                `,
                confirmButtonColor: '#dc3545'
            });
        }
    }, 1500);
};