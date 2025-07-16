// Al cargar la página, solo muestra el menú principal
document.addEventListener("DOMContentLoaded", function () {
  // Oculta los módulos al inicio
  document.getElementById("modulos-rrhh").style.display = "none";

  // Oculta el botón de registrar vacante al inicio
  ocultarBotonVacante();

  // Muestra el menú principal
  document.getElementById("tab-menu").style.display = "";

  // Oculta todos los módulos
  document.querySelectorAll(".content-module").forEach((module) => {
    module.style.display = "none";
  });

  // Inicializar filtros por defecto
  window.dataTableCatPuestos = {
    filtro_estado: "1" // Por defecto mostrar solo activos
  };
});

// Cuando el usuario haga clic en una opción del menú
document.querySelectorAll("#menu-grid a").forEach(function (link) {
  link.addEventListener("click", function (e) {
    e.preventDefault();

    // Oculta el menú principal
    document.getElementById("tab-menu").style.display = "none";

    // Muestra la sección de módulos
    document.getElementById("modulos-rrhh").style.display = "block";

    // Oculta todos los módulos
    document.querySelectorAll(".content-module").forEach((module) => {
      module.style.display = "none";
    });

    // Muestra el módulo seleccionado
    const targetModule = this.getAttribute("data-target");
    document.getElementById(targetModule).style.display = "block";

    // Mostrar u ocultar el botón de vacante según el módulo
    if (targetModule === "moduloRequisicion") {
      mostrarBotonVacante();
      mostrarBotonCatalogo();
    } else {
      ocultarBotonVacante();
      ocultarBotonCatalogo();
    }

    // Mostrar u ocultar el botón de publicar vacante
    if (targetModule === "moduloReclutamiento") {
      mostrarBotonPublicarVacante();
    } else {
      ocultarBotonPublicarVacante();
    }
  });
});
// Funcionalidad para volver al menú principal
document.addEventListener("click", function (e) {
  if (e.target.closest(".btnVolver")) {
    e.preventDefault();

    // Oculta el botón de registrar vacante
    ocultarBotonVacante();
    ocultarBotonCatalogo();
    ocultarBotonPublicarVacante();

    // Oculta la sección de módulos
    document.getElementById("modulos-rrhh").style.display = "none";

    // Muestra el menú principal
    document.getElementById("tab-menu").style.display = "block";
  }
});

// Funciones para mostrar/ocultar el botón
function mostrarBotonVacante() {
  const btn = document.getElementById("btnRegistrarVacante");
  if (btn) btn.style.display = "inline-block";
}
function ocultarBotonVacante() {
  const btn = document.getElementById("btnRegistrarVacante");
  if (btn) btn.style.display = "none";
}

// Funciones para mostrar/ocultar el botón de catálogos
function mostrarBotonCatalogo() {
  const btn = document.getElementById("btnRegistrarCatalogo");
  if (btn) btn.style.display = "inline-block";
}
function ocultarBotonCatalogo() {
  const btn = document.getElementById("btnRegistrarCatalogo");
  if (btn) btn.style.display = "none";
}

//Funciones para mostrar/ocultar el botón de publicar vacante
function mostrarBotonPublicarVacante() {
  const btn = document.getElementById("btnRegistrarPublicacion");
  if (btn) btn.style.display = "inline-block";
}
function ocultarBotonPublicarVacante() {
  const btn = document.getElementById("btnRegistrarPublicacion");
  if (btn) btn.style.display = "none";
}

// DataTable para requisiciones
tableCatRequisiciones = $("#tableCatRequisiciones").DataTable({
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
            return $.extend(d, dataTableCatRequisiciones);
        },
        method: "POST",
        url: "../../../api/recursos_humanos_api.php",
        error: function (jqXHR, textStatus, errorThrown) {
            alertErrorAJAX(jqXHR, textStatus, errorThrown);
        },
        dataSrc: "response.data",
    },
    columns: [
        { data: "numero_requisicion"},
        { data: "departamento_nombre"},
        { data: "motivo_descripcion" },
        { data: "puesto_nombre", defaultContent: "Sin especificar" },
        { 
            data: "prioridad", 
            title: "Prioridad",
            render: function(data) {
                const badges = {
                  'urgente': '<span class="badge bg-gradient-secondary">Urgente</span>',
                  'normal': '<span class="badge bg-gradient-primary">Normal</span>',
                  'baja': '<span class="badge bg-secondary">Baja</span>'
                };
                return badges[data] || '<span class="badge bg-light">N/A</span>';
            }
        },
        { 
            data: "estatus", 
            render: function(data) {
                const badges = {
                  'borrador': '<span class="badge bg-gradient-warning text-dark">Borrador</span>',
                  'aprobada': '<span class="badge bg-gradient-success">Aprobada</span>',
                  'rechazada': '<span class="badge bg-gradient-secondary">Rechazada</span>',
                  'en_proceso': '<span class="badge bg-gradient-primary">En Proceso</span>'
                };
                return badges[data] || '<span class="badge bg-light">N/A</span>';
            }
        },
        { data: "fecha_creacion"},
        // Columnas ocultas - datos adicionales disponibles para el modal de detalles
        { data: "usuario_solicitante_id"},
        { data: "justificacion"},
        { data: "tipo_contrato"},
        { data: "tipo_jornada"},
        { data: "tipo_modalidad"},
        { data: "dias_trabajo"},
        { data: "dias_personalizados"},
        { data: "hora_inicio"},
        { data: "hora_fin"},
        { data: "salario_min"},
        { data: "salario_max"},
        { data: "usuario_aprobador_id"},
        { data: "fecha_aprobacion"},
        { data: "observaciones_aprobacion"},
        {
            data: null,
            title: "Acciones",
            render: function(data, type, row) {
                return `
                    <div class="btn-group" role="group">
                    ${row.estatus !== 'borrador' ? `
                        <button class="btn btn-sm btn-primary btn-ver-requisicion" 
                             data-id="${row.id_requisicion}" title="Ver detalles"
                            data-bs-target="#detallesRequisicionModal"
                            data-bs-toggle="modal">
                            <i class="bi bi-eye"></i>
                        </button>`
                        : ""
                    }

                    ${row.estatus === 'en_proceso' ? `
                        <button class="btn btn-sm btn-primary bg-gradient-success btn-aprobar-requisicion"
                            data-id="${row.id_requisicion}"
                            data-numero="${row.numero_requisicion}"
                            title="Aprobar">
                            <i class="bi bi-check-circle"></i>
                        </button>
                        <button class="btn btn-sm btn-primary bg-gradient-secondary btn-rechazar-requisicion"
                            data-id="${row.id_requisicion}"
                            data-numero="${row.numero_requisicion}"
                            title="Rechazar">
                            <i class="bi bi-x-circle"></i>
                        </button>`
                        : ""
                    }
                    
                    ${row.estatus === 'borrador' ? `
                        <button class="btn btn-sm btn-primary bg-gradient-warning btn-editar-requisicion" 
                            data-id="${row.id_requisicion}" 
                            data-bs-target="#editarRequisicionModal"
                            data-bs-toggle="modal"
                            title="Editar">
                            <i class="bi bi-pencil"></i>
                        </button>`
                        : ""
                    }
                        ${row.estatus === '' ? `
                        <button class="btn btn-sm btn-primary bg-gradient-secondary btn-eliminar-requisicion" 
                            data-id="${row.id_requisicion}" title="Eliminar">
                            <i class="bi bi-trash"></i>
                        </button>`
                            : ""
                        }
                    </div>
                `;
            }
        },
        { data: "activo", visible: false },
    ],
    columnDefs: [
        // Ajustes de estilo para todas las columnas
        { targets: "_all", className: "text-center align-middle" },
        { targets: 0, title: "No. Requisición", className: "all" },
        { targets: 1, title: "Departamento", className: "all" },
        { targets: 2, title: "Motivo", className: "all" },
        { targets: 3, title: "Puesto", className: "all" },
        { targets: 4, title: "Prioridad", className: "all" },
        { targets: 5, title: "Estado", className: "all" },
        { targets: 6, title: "Fecha creación", className: "all" },
        // Columnas ocultas con sus títulos para el modal de detalles
        { targets: 7, title: "ID Usuario Solicitante", visible: false },
        { targets: 8, title: "Justificación", visible: false },
        { targets: 9, title: "Tipo Contrato", visible: false },
        { targets: 10, title: "Tipo Jornada", visible: false },
        { targets: 11, title: "Tipo Modalidad", visible: false },
        { targets: 12, title: "Días de Trabajo", visible: false },
        { targets: 13, title: "Días Personalizados", visible: false },
        { targets: 14, title: "Hora Inicio", visible: false },
        { targets: 15, title: "Hora Fin", visible: false },
        { targets: 16, title: "Salario Mínimo", visible: false },
        { targets: 17, title: "Salario Máximo", visible: false },
        { targets: 18, title: "ID Usuario Aprobador", visible: false },
        { targets: 19, title: "Fecha Aprobación", visible: false },
        { targets: 20, title: "Observaciones Aprobación", visible: false },
        { targets: 21, title: "Acciones", className: "all" },
        { targets: 22, title: "Activo", visible: false }
    ],
    dom: 'Bl<"dataTables_toolbar">frtip',
    buttons: [
        {
            text: '<i class="bi bi-funnel-fill"></i> Filtrar Requisición',
            className: "btn btn-success bg-gradient-primary",
            attr: {
                "data-bs-toggle": "modal",
                "data-bs-target": "#",
            },
        }
    ],
});

//Data table para el catálogo de departamentos
tableCatDepartamentos = $("#tableCatDepartamentos").DataTable({
    language: {
      url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json",
    },
    autoWidth: true,
    lengthChange: false,
    info: true,
    paging: true,
    pageLength: 5, // Agregar esta línea
    scrollY: "40vh",
    scrollCollapse: true,
    ajax: {
      dataType: "json",
      data: function (d) {
        return $.extend(d, dataTableCatDepartamentos);
      },
      method: "POST",
      url: "../../../api/recursos_humanos_api.php",
      error: function (jqXHR, textStatus, errorThrown) {
        alertErrorAJAX(jqXHR, textStatus, errorThrown);
      },
      dataSrc: "response.data",
    },
    columns: [
      { data: "id_departamento" },
      { data: "descripcion" },
      {
        data: "activo",
        render: function (data) {
          return data == 1
            ? '<i class="bi bi-toggle-on fs-4 text-success"></i>'
            : '<i class="bi bi-toggle-off fs-4"></i>';
        },
      },
      {
        data: null,
        render: function (data, type, row) {
            return `
            <button class="btn btn-sm btn-primary bg-gradient-warning btn-editar-departamento" 
                data-id="${row.id_departamento}" 
                data-descripcion="${row.descripcion}" 
                data-activo="${row.activo}">
              <i class="bi bi-pencil"></i>
            </button>
            <button class="btn btn-sm btn-primary bg-gradient-secondary btn-eliminar-departamento" 
                data-id="${row.id_departamento}">
              <i class="bi bi-trash"></i>
            </button>
          `;
          },
          },
        ],
        dom: 'Bl<"dataTables_toolbar">frtip',
        buttons: [
          {
          text: '<i class="bi bi-plus-lg"></i> Nuevo Departamento',
          className: "btn btn-success bg-gradient-primary",
          attr: {
            "data-bs-toggle": "modal",
            "data-bs-target": "#registrarDepartamentoModal",
          },
          action: function () {
            $("#registrarDepartamentoModal").modal("show");
          },
          },
          {
          text: '<i class="bi bi-funnel me-2 id="iconoFiltroDepartamentos" title="Restablecer filtros"></i>Filtrar <i class="bi bi-toggle-on fs-5 text-secondary" id="toggleFiltroActivosDep" style="cursor: pointer; margin-left: 8px;"></i>',
          className: "btn btn-warning bg-gradient-filter d-flex",
          action: function () {
            //No hacer nada, el toggle se maneja por separado
          },
          },
        ],
      columnDefs: [
          { targets: 0, className: "text-center align-middle" }, // id
          { targets: 2, className: "text-center align-middle" }, // estado
          { targets: -1, className: "text-center align-middle" } // acciones
        ]
      });

// Datatable para el catálogo de puestos
tableCatPuestos = $("#tableCatPuestos").DataTable({
  language: {
    url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json",
  },
  autoWidth: true,
  lengthChange: false,
  info: true,
  paging: true,
  pageLength: 5,
  scrollY: "40vh",
  scrollCollapse: true,
  ajax: {
    dataType: "json",
    data: function (d) {
      // MODIFICADO: Manejar filtros correctamente
      const filtros = window.dataTableCatPuestos || {};
      
      // Si no hay filtro de estado definido, usar "1" (activos) por defecto
      const filtroEstado = filtros.filtro_estado !== undefined ? filtros.filtro_estado : "1";
      
      console.log("Enviando filtros:", {
        filtro_estado: filtroEstado,
        filtro_departamento: filtros.filtro_departamento || null
      });
      
      return {
        api: 8,
        filtro_estado: filtroEstado,
        filtro_departamento: filtros.filtro_departamento || null
      };    
    },
    method: "POST",
    url: "../../../api/recursos_humanos_api.php",
    error: function (jqXHR, textStatus, errorThrown) {
      alertErrorAJAX(jqXHR, textStatus, errorThrown);
    },
    dataSrc: "response.data",
  },

  columns: [
    { data: "id_puesto", title: "ID" },
    { data: "descripcion", title: "Descripción" },
    { data: "escolaridad_minima", visible: false },
    { data: "experiencia_anios", visible: false },
    { data: "departamento_nombre", title: "Departamento" },
    { data: "departamento_id", visible: false },
    { data: "objetivos", visible: false },
    { data: "competencias", visible: false },
    {data: "salario_min", visible: false},
    {data: "salario_max", visible: false},
    {
      data: "activo", title: "Estado",
      render: function (data) {
        return data == 1
          ? '<i class="bi bi-toggle-on fs-4 text-success"></i>'
          : '<i class="bi bi-toggle-off fs-4"></i>';
      },
    },
    { data: "id_blanda", visible: false },
    { data: "id_tecnica", visible: false },
    { 
      data: "habilidades_blandas_descripcion", 
      title: "Habilidades Blandas",
      render: function (data, type, row) {
        if (!data || data === 'Sin habilidades blandas') {
          return '<span class="text-muted fst-italic">Sin habilidades blandas</span>';
        }
        // Dividir las habilidades y crear tags organizados en filas de 2
        const habilidades = data.split(', ');
        let html = '<div class="d-flex flex-wrap" style="max-width: 200px;">';
        habilidades.forEach(function(habilidad, index) {
          const isNewRow = index % 2 === 0;
          if (isNewRow && index > 0) {
            html += '</div><div class="d-flex flex-wrap" style="max-width: 200px;">';
          }
          html += `<span class="badge bg-gradient-info text-white me-1 mb-1" style="font-size: 0.7em; padding: 0.4em 0.6em; border-radius: 12px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">${habilidad.trim()}</span>`;
        });
        html += '</div>';
        return html;
      }
    },
    { 
      data: "habilidades_tecnicas_descripcion", 
      title: "Habilidades Técnicas",
      render: function (data, type, row) {
        if (!data || data === 'Sin habilidades técnicas') {
          return '<span class="text-muted fst-italic">Sin habilidades técnicas</span>';
        }
        // Dividir las habilidades y crear tags organizados en filas de 2
        const habilidades = data.split(', ');
        let html = '<div class="d-flex flex-wrap" style="max-width: 200px;">';
        habilidades.forEach(function(habilidad, index) {
          const isNewRow = index % 2 === 0;
          if (isNewRow && index > 0) {
            html += '</div><div class="d-flex flex-wrap" style="max-width: 200px;">';
          }
          html += `<span class="badge bg-gradient-success text-white me-1 mb-1" style="font-size: 0.7em; padding: 0.4em 0.6em; border-radius: 12px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">${habilidad.trim()}</span>`;
        });
        html += '</div>';
        return html;
      }
    },
    {
      data: null, title: "Acciones",
      render: function (data, type, row) {
        return `
        <div class="d-flex justify-content-center gap-1">
          <button class="btn btn-sm btn-primary btn-ver-detalles-puesto" 
              data-id="${row.id_puesto}" 
              data-nombre="${row.descripcion}"
              data-departamento="${row.departamento_nombre}"
              data-escolaridad="${row.escolaridad_minima || ""}"
              data-experiencia="${row.experiencia_anios || ""}"
              data-objetivos="${row.objetivos || ""}"
              data-competencias="${row.competencias || ""}"
              data-salario_min="${row.salario_min || ""}"
              data-salario_max="${row.salario_max || ""}"
              data-activo="${row.activo}"
              title="Ver detalles">
            <i class="bi bi-eye"></i>
          </button>
          <button class="btn btn-sm btn-primary bg-gradient-warning btn-editar-puesto" 
              data-id="${row.id_puesto}" 
              data-escolaridad="${row.escolaridad_minima || ""}"
              data-experiencia="${row.experiencia_anios || ""}"
              data-descripcion="${row.descripcion}" 
              data-departamento="${row.id_departamento}"
              data-objetivos="${row.objetivos || ""}"
              data-competencias="${row.competencias || ""}"
              data-salario_min="${row.salario_min || ""}"
              data-salario_max="${row.salario_max || ""}"
              data-activo="${row.activo}"
              data-habilidades-blandas="${row.id_blanda || ''}"
              data-habilidades-tecnicas="${row.id_tecnica || ''}">
            <i class="bi bi-pencil"></i>
          </button>
          <button class="btn btn-sm btn-primary bg-gradient-secondary btn-eliminar-puesto" data-id="${row.id_puesto}">
            <i class="bi bi-trash"></i>
          </button>
        </div>
        `;
      },
    },
  ],
  dom: 'Bl<"dataTables_toolbar">frtip',
  buttons: [
    {
      text: '<i class="bi bi-plus-lg"></i> Nuevo Puesto',
      className: "btn btn-success bg-gradient-primary",
      attr: {
        "data-bs-toggle": "modal",
        "data-bs-target": "#registrarPuestoModal",
      },
      action: function () {
        $("#registrarPuestoModal").modal("show"); 
      },
    },
    {
      text: '<i class="bi bi-funnel"></i> Filtrar',
      className: "btn btn-warning bg-gradient-puesto-filter",
      attr: {
        id: "btnFiltroPuestos",
        "data-bs-toggle": "tooltip",
        "data-bs-placement": "top",
        title: "Filtrar puestos",
      },
      action: function (e, dt, node, config) {
        // Si el menú ya existe, lo elimina (oculta)
        if ($("#dropdownFiltrosPuestosMenu").length > 0) {
          $("#dropdownFiltrosPuestosMenu").remove();
          $(document).off("mousedown.dropdownFiltrosPuestos");
          return;
        }
        
var $menu = $(`
  <div id="dropdownFiltrosPuestosMenu" class="dropdown-menu show" style="position:absolute;z-index:9999;min-width:220px;max-height:405px;overflow-y:auto;">
    <h6 class="dropdown-header"><i class="bi bi-funnel me-2"></i>Filtrar por:</h6>
    <div class="dropdown-divider"></div>
    
    <!-- Filtro por Estado -->
    <h6 class="dropdown-header text-muted small">Estado</h6>
    <button class="dropdown-item py-1" data-filtro="estado" data-value="1">
      <i class="bi bi-toggle-on text-success me-2"></i>Activos
    </button>
    <button class="dropdown-item py-1" data-filtro="estado" data-value="0">
      <i class="bi bi-toggle-off text-secondary me-2"></i>Inactivos
    </button>
    <button class="dropdown-item py-1" data-filtro="estado" data-value="">
      <i class="bi bi-list me-2"></i>Todos
    </button>
    
    <div class="dropdown-divider my-1"></div>
    
    <!-- Filtro por Departamento -->
    <h6 class="dropdown-header text-muted small">Departamento</h6>
    <div id="departamentosDropdown" style="max-height:120px;overflow-y:auto;">
      <div class="dropdown-item-text text-center py-2">
        <div class="spinner-border spinner-border-sm text-primary" role="status">
          <span class="visually-hidden">Cargando...</span>
        </div>
        <small class="d-block mt-1">Cargando...</small>
      </div>
    </div>
    
    <div class="dropdown-divider my-1"></div>
    
    <!-- Botones de acción -->
    <div class="px-2 py-1">
      <button class="btn btn-sm btn-outline-secondary w-100" id="limpiarFiltrosPuestos">
        <i class="bi bi-arrow-clockwise me-1"></i>Limpiar Filtros
      </button>
    </div>
  </div>
`);


        // Posiciona el menú debajo del botón
        var offset = $(node).offset();
        $menu.css({
          top: offset.top + $(node).outerHeight(),
          left: offset.left,
        });

        $("body").append($menu);

        // Cargar departamentos dinámicamente
        cargarDepartamentosDropdown();

         setTimeout(function() {
      marcarFiltrosActivos($menu);
    }, 100);

        // Evento para seleccionar filtros
        $menu.on("click", "[data-filtro]", function (e) {
          e.preventDefault();
          var $item = $(this);
          var filtro = $(this).data("filtro");
          var valor = $(this).data("value");
          
          console.log(`Filtro aplicado: ${filtro} = ${valor}`);

          // Remover clase activa de otros elementos del mismo grupo
          $menu.find(`[data-filtro="${filtro}"]`).removeClass("active bg-primary text-white");
      
      // Agregar clase activa al elemento seleccionado
      $item.addClass("active bg-primary text-white");

          
          // Aplicar filtro según el tipo
          window.dataTableCatPuestos = window.dataTableCatPuestos || {};
          
          switch(filtro) {
            case 'estado':
              dataTableCatPuestos.filtro_estado = valor;
              break;
            case 'departamento':
              dataTableCatPuestos.filtro_departamento = valor;
              break;
            // case 'escolaridad':
            //   dataTableCatPuestos.filtro_escolaridad = valor;
            //   break;
          }
          
          // Recargar tabla con filtros
          tableCatPuestos.ajax.reload();
          
          // Mostrar notificación
          const tipoFiltro = filtro.charAt(0).toUpperCase() + filtro.slice(1);
          const valorTexto = valor === "" ? "Todos" : $(this).text().trim();
          alertToast(`Filtro aplicado: ${tipoFiltro} - ${valorTexto}`, 'info', 2000);
          
           // Cerrar menú después de seleccionar
           $("#dropdownFiltrosPuestosMenu").hide();
          $(document).off("mousedown.dropdownFiltrosPuestos");
        });

        // Evento para limpiar filtros
        $menu.on("click", "#limpiarFiltrosPuestos", function (e) {
          e.preventDefault();
          
          // MODIFICADO: Limpiar filtros pero mantener "Activos" como default
  window.dataTableCatPuestos = window.dataTableCatPuestos || {};
  dataTableCatPuestos.filtro_estado = "1"; // Siempre volver a activos
  delete dataTableCatPuestos.filtro_departamento;
          // delete dataTableCatPuestos.filtro_escolaridad;

      // MODIFICADO: Marcar "Activos" como activo en estado y "Todos" en departamento
  $menu.find('[data-filtro="estado"]').removeClass("active bg-primary text-white");
  $menu.find('[data-filtro="estado"][data-value="1"]').addClass("active bg-primary text-white");
  $menu.find('[data-filtro="departamento"]').removeClass("active bg-primary text-white");
  $menu.find('[data-filtro="departamento"][data-value=""]').addClass("active bg-primary text-white");
      
          
          // Recargar tabla sin filtros
          tableCatPuestos.ajax.reload();
          
          alertToast('Filtros limpiados', 'success', 2000);
          
          // Cerrar menú
          $("#dropdownFiltrosPuestosMenu").remove();
          $(document).off("mousedown.dropdownFiltrosPuestos");
        });

        // Cerrar el menú si se hace clic fuera de él
        $(document).on("mousedown.dropdownFiltrosPuestos", function (e) {
          if (!$(e.target).closest("#dropdownFiltrosPuestosMenu, #btnFiltroPuestos").length) {
            $("#dropdownFiltrosPuestosMenu").remove();
            $(document).off("mousedown.dropdownFiltrosPuestos");
          }
        });
      },
    },
  ],
  columnDefs: [
    { targets: 0, className: "text-center align-middle" }, // id
    { targets: 4, className: "text-center align-middle" }, // estado
    { targets: -1, className: "text-center align-middle" } // acciones
  ]
});


//Data table para el catálogo de motivos
tableCatMotivos = $("#tableCatMotivos").DataTable({
    language: {
      url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json",
    },
    autoWidth: true,
    lengthChange: false,
    info: true,
    paging: true,
    pageLength: 5,
    scrollY: "40vh",
    scrollCollapse: true,
    ajax: {
      dataType: "json",
      data: function (d) {
        return $.extend(d, dataTableCatMotivos);
      },
      method: "POST",
      url: "../../../api/recursos_humanos_api.php",
      error: function (jqXHR, textStatus, errorThrown) {
        console.error("Error en AJAX de motivos:", textStatus, errorThrown);
        console.error("Respuesta completa:", jqXHR.responseText);
        alertErrorAJAX(jqXHR, textStatus, errorThrown);
      },
      dataSrc: function(json) {
        // Validar la respuesta antes de devolver los datos
        console.log("Respuesta del servidor para motivos:", json);
        
        if (json && json.response && json.response.data && Array.isArray(json.response.data)) {
          return json.response.data;
        } else {
          console.error("Respuesta inválida del servidor para motivos:", json);
          alertToast("Error: No se pudieron cargar los motivos", "error", 4000);
          return []; // Devolver array vacío para evitar el error
        }
      }
    },
    columns: [
      { data: "id_motivo" },
      { data: "descripcion" },
      {
        data: "activo",
        render: function (data) {
          return data == 1
            ? '<i class="bi bi-toggle-on fs-4 text-success"></i>'
            : '<i class="bi bi-toggle-off fs-4"></i>';
        },
      },
      {
        data: null,
        render: function (data, type, row) {
            return `
            <button class="btn btn-sm btn-primary bg-gradient-warning btn-editar-motivo" 
                data-id="${row.id_motivo}" 
                data-descripcion="${row.descripcion}" 
                data-activo="${row.activo}">
              <i class="bi bi-pencil"></i>
            </button>
            <button class="btn btn-sm btn-primary bg-gradient-secondary btn-eliminar-motivo" 
                data-id="${row.id_motivo}">
              <i class="bi bi-trash"></i>
            </button>
          `;
          },
          },
        ],
        dom: 'Bl<"dataTables_toolbar">frtip',
        buttons: [
          {
          text: '<i class="bi bi-plus-lg"></i> Nuevo Motivo',
          className: "btn btn-success bg-gradient-primary",
          attr: {
            "data-bs-toggle": "modal",
            "data-bs-target": "#registrarMotivoModal",
          },
          action: function () {
            $("#registrarMotivoModal").modal("show");
          },
          },
          {
          text: '<i class="bi bi-funnel me-2"></i>Filtrar <i class="bi bi-toggle-on fs-5 text-secondary" id="toggleFiltroActivosMov" style="cursor: pointer; margin-left: 8px;" title="Mostrando activos - Click para ver inactivos"></i>',
          className: "btn btn-warning bg-gradient-filter d-flex align-items-center",
          action: function () {
            // No hacer nada, el toggle se maneja por separado
          },
          },
        ],
        columnDefs: [
          { targets: 0, className: "text-center align-middle" }, // id
          { targets: 2, className: "text-center align-middle" }, // estado
          { targets: -1, className: "text-center align-middle" } // acciones
        ]
      });

// DataTable para el catalogo de habilidades blandas
tableCatBlandas = $("#tableCatBlandas").DataTable({
    language: {
      url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json",
    },
    autoWidth: true,
    lengthChange: false,
    info: true,
    paging: true,
    pageLength: 5, // Agregar esta línea
    scrollY: "40vh",
    scrollCollapse: true,
    ajax: {
      dataType: "json",
      data: function (d) {
        return $.extend(d, dataTableCatBlandas);
      },
      method: "POST",
      url: "../../../api/recursos_humanos_api.php",
      error: function (jqXHR, textStatus, errorThrown) {
        alertErrorAJAX(jqXHR, textStatus, errorThrown);
      },
      dataSrc: "response.data",
    },
    columns: [
      { data: "id_blanda" },
      { data: "descripcion" },
      {
        data: "activo",
        render: function (data) {
          return data == 1
            ? '<i class="bi bi-toggle-on fs-4 text-success"></i>'
            : '<i class="bi bi-toggle-off fs-4"></i>';
        },
      },
      {
        data: null,
        render: function (data, type, row) {
            return `
            <button class="btn btn-sm btn-primary bg-gradient-warning btn-editar-blanda" 
                data-id="${row.id_blanda}" 
                data-descripcion="${row.descripcion}" 
                data-activo="${row.activo}">
              <i class="bi bi-pencil"></i>
            </button>
            <button class="btn btn-sm btn-primary bg-gradient-secondary btn-eliminar-blanda" 
                data-id="${row.id_blanda}">
              <i class="bi bi-trash"></i>
            </button>
          `;
          },
          },
        ],
        dom: 'Bl<"dataTables_toolbar">frtip',
        buttons: [
          {
          text: '<i class="bi bi-plus-lg"></i> Nuevo Habilidad Blanda',
          className: "btn btn-success bg-gradient-primary",
          attr: {
            "data-bs-toggle": "modal",
            "data-bs-target": "#registrarBlandasModal",
          },
          action: function () {
            $("#registrarBlandasModal").modal("show");
          },
          },
          {
          text: '<i class="bi bi-funnel me-2"></i>Filtrar <i class="bi bi-toggle-on fs-5 text-secondary" id="toggleFiltroActivosBla" style="cursor: pointer; margin-left: 8px;"></i>',
          className: "btn btn-warning bg-gradient-filter d-flex align-items-center",
          action: function () {
          },
          },
        ],
        columnDefs: [
          { targets: 0, className: "text-center align-middle" }, // id
          { targets: 2, className: "text-center align-middle" }, // estado
          { targets: -1, className: "text-center align-middle" } // acciones
        ]
      });

// DataTable para el catalogo de habilidades técnicas
tableCatTecnicas = $("#tableCatTecnicas").DataTable({
    language: {
      url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json",
    },
    autoWidth: true,
    lengthChange: false,
    info: true,
    paging: true,
    pageLength: 5,
    scrollY: "40vh",
    scrollCollapse: true,
    ajax: {
      dataType: "json",
      data: function (d) {
        return $.extend(d, dataTableCatTecnicas);
      },
      method: "POST",
      url: "../../../api/recursos_humanos_api.php",
      error: function (jqXHR, textStatus, errorThrown) {
        alertErrorAJAX(jqXHR, textStatus, errorThrown);
      },
      dataSrc: "response.data",
    },
    columns: [
      { data: "id_tecnica" },
      { data: "descripcion" },
      {
        data: "activo",
        render: function (data) {
          return data == 1
            ? '<i class="bi bi-toggle-on fs-4 text-success"></i>'
            : '<i class="bi bi-toggle-off fs-4"></i>';
        },
      },
      {
        data: null,
        render: function (data, type, row) {
            return `
            <button class="btn btn-sm btn-primary bg-gradient-warning btn-editar-tecnica" 
                data-id="${row.id_tecnica}" 
                data-descripcion="${row.descripcion}" 
                data-activo="${row.activo}">
              <i class="bi bi-pencil"></i>
            </button>
            <button class="btn btn-sm btn-primary bg-gradient-secondary btn-eliminar-tecnica" 
                data-id="${row.id_tecnica}">
              <i class="bi bi-trash"></i>
            </button>
          `;
          },
          },
        ],
        dom: 'Bl<"dataTables_toolbar">frtip',
        buttons: [
          {
          text: '<i class="bi bi-plus-lg"></i> Nueva Habilidad Técnica',
          className: "btn btn-success bg-gradient-primary",
          attr: {
            "data-bs-toggle": "modal",
            "data-bs-target": "#registrarTecnicasModal",
          },
          action: function () {
            $("#registrarTecnicasModal").modal("show");
          },
          },
          {
          text: '<i class="bi bi-funnel me-2"></i>Filtrar <i class="bi bi-toggle-on fs-5 text-secondary" id="toggleFiltroActivosTec" style="cursor: pointer; margin-left: 8px;"></i>',
          className: "btn btn-warning bg-gradient-filter d-flex align-items-center",
          action: function () {
          },
          },
        ],
        columnDefs: [
          { targets: 0, className: "text-center align-middle" }, // id
          { targets: 2, className: "text-center align-middle" }, // estado
          { targets: -1, className: "text-center align-middle" } // acciones
        ]
      });

// Event handlers para los nuevos botones
$(document).on("click", ".btn-ver-detalles-puesto", function () {
  const puestoId = $(this).data("id");
  const puestoNombre = $(this).data("nombre");

  // Filtrar la tabla de detalles por el puesto seleccionado
  dataTableCatPuestosDetalles.id_puesto = puestoId;

  $("#detallesPuestoModalLabel").text(`Detalles del Puesto: ${puestoNombre}`);
  $("#detallesPuestoModal").modal("show");
});



// Cargar departamentos cuando se abre el modal de puestos
$(document).on('show.bs.modal', '#registrarPuestoModal', function () {
    cargarDepartamentos('#id_departamento_puesto');
});

// Cargar catálogos cuando se abre el modal de registrar vacante
$(document).on('show.bs.modal', '#registrarVacanteModal', function () {
    cargarDepartamentos('#departamento');
    cargarPuestos('#puesto');
    cargarMotivos('#motivo');
});

$(document).on('show.bs.modal', '#editarRequisicionModal', function () {
    cargarDepartamentos('#editarDepartamento');
    cargarPuestos('#editarPuesto');
    cargarMotivos('#editarMotivo');
});

// Función genérica para cargar departamentos en cualquier select
function cargarDepartamentos(selectId, incluirTodos = false) {
    return new Promise((resolve, reject) => {
        $.ajax({
            url: '../../../api/recursos_humanos_api.php',
            type: 'POST',
            data: { api: 6 }, // Case 6 para obtener departamentos
            success: function(response) {
                try {
                    const data = JSON.parse(response);
                    if (data.response && data.response.data) {
                        const select = $(selectId);
                        
                        if (select.length === 0) {
                            console.error(`Select con ID ${selectId} no encontrado`);
                            reject(`Select ${selectId} no encontrado`);
                            return;
                        }
                        
                        // Solo limpiar el select si está dentro del modal de registrar vacante
                        if ($(selectId).closest('#registrarVacanteModal').length > 0) {
                          select.empty();
                        }
                        
                        // Opción por defecto
                        select.append('<option value="">Seleccionar departamento...</option>');
                        
                        // Opción "Todos" si se requiere (útil para filtros)
                        if (incluirTodos) {
                            select.append('<option value="todos">Todos los departamentos</option>');
                        }
                        
                        // Cargar departamentos activos
                        data.response.data.forEach(function(dept) {
                            if (dept.activo == 1) {
                                select.append(`<option value="${dept.id_departamento}">${dept.descripcion}</option>`);
                            }
                        });
                        
                        console.log(`Departamentos cargados en ${selectId}`);
                        resolve(data.response.data);
                    } else {
                        console.error('Error en respuesta de departamentos:', data);
                        reject('Error en respuesta del servidor');
                    }
                } catch (error) {
                    console.error('Error al parsear respuesta de departamentos:', error);
                    reject('Error al parsear respuesta');
                }
            },
            error: function(xhr, status, error) {
                console.error('Error AJAX al cargar departamentos:', error);
                reject('Error de conexión');
            }
        });
    });
}

// Función genérica para cargar motivos en cualquier select
function cargarMotivos(selectId, incluirTodos = false) {
    return new Promise((resolve, reject) => {
        $.ajax({
            url: '../../../api/recursos_humanos_api.php',
            type: 'POST',
            data: { api: 12 }, // Case 12 para obtener motivos
            success: function(response) {
                try {
                    const data = JSON.parse(response);
                    if (data.response && data.response.data) {
                        const select = $(selectId);
                        
                        if (select.length === 0) {
                            console.error(`Select con ID ${selectId} no encontrado`);
                            reject(`Select ${selectId} no encontrado`);
                            return;
                        }
                        
                        // Solo limpiar el select si está dentro del modal de registrar vacante
                        if ($(selectId).closest('#registrarVacanteModal').length > 0) {
                          select.empty();
                        }

                        select.append('<option value="">Seleccionar motivo...</option>');
                        
                        if (incluirTodos) {
                            select.append('<option value="todos">Todos los motivos</option>');
                        }
                        
                        data.response.data.forEach(function(motivo) {
                            if (motivo.activo == 1) {
                                select.append(`<option value="${motivo.id_motivo}">${motivo.descripcion}</option>`);
                            }
                        });
                        
                        console.log(`Motivos cargados en ${selectId}`);
                        resolve(data.response.data);
                    } else {
                        reject('Error en respuesta del servidor');
                    }
                } catch (error) {
                    reject('Error al parsear respuesta');
                }
            },
            error: function(xhr, status, error) {
                reject('Error de conexión');
            }
        });
    });
}

// Función genérica para cargar puestos en cualquier select
function cargarPuestos(selectId, incluirTodos = false, filtrarPorDepartamento = null) {
    return new Promise((resolve, reject) => {
        $.ajax({
            url: '../../../api/recursos_humanos_api.php',
            type: 'POST',
            data: { api: 8 }, // Case 8 para obtener puestos
            success: function(response) {
                try {
                    const data = JSON.parse(response);
                    if (data.response && data.response.data) {
                        const select = $(selectId);
                        
                        if (select.length === 0) {
                            console.error(`Select con ID ${selectId} no encontrado`);
                            reject(`Select ${selectId} no encontrado`);
                            return;
                        }
                        
                        select.empty();
                        select.append('<option value="">Seleccionar puesto...</option>');
                        
                        if (incluirTodos) {
                            select.append('<option value="todos">Todos los puestos</option>');
                        }
                        
                        // Filtrar puestos si se especifica un departamento
                        let puestosFiltrados = data.response.data;
                        if (filtrarPorDepartamento) {
                            puestosFiltrados = data.response.data.filter(puesto => 
                                puesto.id_departamento == filtrarPorDepartamento && puesto.activo == 1
                            );
                        } else {
                            puestosFiltrados = data.response.data.filter(puesto => puesto.activo == 1);
                        }
                        
                        puestosFiltrados.forEach(function(puesto) {
                            select.append(`<option value="${puesto.id_puesto}">${puesto.descripcion}</option>`);
                        });
                        
                        console.log(`Puestos cargados en ${selectId}`);
                        resolve(puestosFiltrados);
                    } else {
                        reject('Error en respuesta del servidor');
                    }
                } catch (error) {
                    reject('Error al parsear respuesta');
                }
            },
            error: function(xhr, status, error) {
                reject('Error de conexión');
            }
        });
    });
}


function marcarFiltrosActivos($menu) {
  // Obtener filtros activos actuales
  const filtroEstado = dataTableCatPuestos.filtro_estado;
  const filtroDepartamento = dataTableCatPuestos.filtro_departamento;

  console.log('Marcando filtros activos:', { filtroEstado, filtroDepartamento });

  // Marcar filtro de estado activo
  if (filtroEstado !== undefined) {
    $menu.find(`[data-filtro="estado"][data-value="${filtroEstado}"]`).addClass("active bg-primary text-white");
  } else {
    $menu.find('[data-filtro="estado"][data-value="1"]').addClass("active bg-primary text-white");
  }

  // Marcar filtro de departamento activo
  if (filtroDepartamento !== undefined && filtroDepartamento !== "") {
    $menu.find(`[data-filtro="departamento"][data-value="${filtroDepartamento}"]`).addClass("active bg-primary text-white");
  } else {
    $menu.find('[data-filtro="departamento"][data-value=""]').addClass("active bg-primary text-white");
  }
}

// Función para cargar departamentos en el dropdown de filtros
function cargarDepartamentosDropdown() {
  $.ajax({
    url: '../../../api/recursos_humanos_api.php',
    type: 'POST',
    data: { api: 6 }, // Case 6 para obtener departamentos
    success: function(response) {
      try {
        const data = JSON.parse(response);
        if (data.response && data.response.data) {
          let opciones = `
            <button class="dropdown-item py-1" data-filtro="departamento" data-value="">
              <i class="bi bi-building me-2"></i>Todos
            </button>
          `;

          data.response.data.forEach(function(dept) {
            if (dept.activo == 1) {
              opciones += `
                <button class="dropdown-item py-1" data-filtro="departamento" data-value="${dept.id_departamento}" title="${dept.descripcion}">
                  <i class="bi bi-building me-2"></i>${dept.descripcion.length > 20 ? dept.descripcion.substring(0, 20) + '...' : dept.descripcion}
                </button>
              `;
            }
          });

          $('#departamentosDropdown').html(opciones);

          // Marcar el filtro activo después de cargar los departamentos
          setTimeout(function() {
            marcarFiltrosActivos($("#dropdownFiltrosPuestosMenu"));
          }, 50);

        } else {
          $('#departamentosDropdown').html(`
            <div class="dropdown-item-text text-center text-muted py-2">
              <i class="bi bi-exclamation-circle"></i> Error al cargar
            </div>
          `);
        }
      } catch (error) {
        $('#departamentosDropdown').html(`
          <div class="dropdown-item-text text-center text-muted py-2">
            <i class="bi bi-exclamation-circle"></i> Error
          </div>
        `);
      }
    },
    error: function() {
      $('#departamentosDropdown').html(`
        <div class="dropdown-item-text text-center text-muted py-2">
          <i class="bi bi-wifi-off"></i> Sin conexión
        </div>
      `);
    }
  });
}

// ==================== EVENTOS PARA APROBACIÓN/RECHAZO DE REQUISICIONES ====================

// Eventos para botones de acción en la tabla de requisiciones
$(document).on("click", ".btn-aprobar-requisicion", function (e) {
  e.preventDefault();
  e.stopImmediatePropagation();

  let idRequisicion = $(this).data("id");
  let numeroRequisicion = $(this).data("numero");
  
  console.log("Aprobar requisición desde tabla:", idRequisicion);

  if (!idRequisicion) {
    alertToast("ID de requisición no válido", "warning", 3000);
    return;
  }

  // Buscar la requisición en los datos de la tabla
  let requisicionData = null;
  if (tableCatRequisiciones && tableCatRequisiciones.data()) {
    requisicionData = tableCatRequisiciones
      .data()
      .toArray()
      .find((req) => req.id_requisicion == idRequisicion);
  }

  if (!requisicionData) {
    alertToast("No se encontraron datos de la requisición", "warning", 3000);
    return;
  }

  if (requisicionData.estatus !== "en_proceso") {
    alertToast(
      "Solo se pueden aprobar requisiciones en estado 'En Proceso'",
      "warning",
      4000
    );
    return;
  }

  // Solicitar observaciones para la aprobación (opcional)
  Swal.fire({
    title: "Aprobar Requisición",
    text: `Requisición: ${numeroRequisicion || requisicionData.numero_requisicion}`,
    input: "textarea",
    inputPlaceholder: "Observaciones de aprobación (opcional)...",
    inputAttributes: {
      "aria-label": "Observaciones de aprobación",
    },
    showCancelButton: true,
    confirmButtonText: "Aprobar",
    cancelButtonText: "Cancelar",
    confirmButtonColor: "#28a745",
    cancelButtonColor: "#6c757d",
    allowOutsideClick: false,
    preConfirm: (observaciones) => {
      // Las observaciones son opcionales para aprobación
      return observaciones || "Sin observaciones";
    }
  }).then((result) => {
    if (result.isConfirmed) {
      procesarAprobacionRechazoTabla(
        "aprobar",
        idRequisicion,
        result.value
      );
    }
  });
});

$(document).on("click", ".btn-rechazar-requisicion", function (e) {
  e.preventDefault();
  e.stopImmediatePropagation();

  let idRequisicion = $(this).data("id");
  console.log("Rechazar requisición desde tabla:", idRequisicion);

  if (!idRequisicion) {
    alertToast("ID de requisición no válido", "warning", 3000);
    return;
  }

  // Buscar la requisición en los datos de la tabla
  let requisicionData = null;
  if (tableCatRequisiciones && tableCatRequisiciones.data()) {
    requisicionData = tableCatRequisiciones
      .data()
      .toArray()
      .find((req) => req.id_requisicion == idRequisicion);
  }

  if (!requisicionData) {
    alertToast("No se encontraron datos de la requisición", "warning", 3000);
    return;
  }

  if (requisicionData.estatus !== "en_proceso") {
    alertToast(
      "Solo se pueden rechazar requisiciones en estado Pendiente",
      "warning",
      4000
    );
    return;
  }

  // Solicitar observaciones para el rechazo
  Swal.fire({
    title: "Rechazar Requisición",
    text: `Ingrese las observaciones para rechazar la requisición ${requisicionData.numero_requisicion}:`,
    input: "textarea",
    inputPlaceholder:
      "Las observaciones son obligatorias para rechazar una requisición...",
    inputAttributes: {
      "aria-label": "Observaciones de rechazo",
    },
    showCancelButton: true,
    confirmButtonText: "Rechazar",
    cancelButtonText: "Cancelar",
    confirmButtonColor: "#dc3545",
    cancelButtonColor: "#6c757d",
    inputValidator: (value) => {
      if (!value || value.trim() === "") {
        return "Las observaciones son obligatorias para rechazar una requisición";
      }
    },
  }).then((result) => {
    if (result.isConfirmed && result.value && result.value.trim()) {
      procesarAprobacionRechazoTabla(
        "rechazar",
        idRequisicion,
        result.value.trim()
      );
    }
  });
});



// Event listener para cambio de departamento en vacantes (filtrar puestos)
$(document).on('change', '#departamento', function() {
    const departamentoId = $(this).val();
    console.log("Departamento seleccionado:", departamentoId);
    
    if (departamentoId && departamentoId !== '') {
        cargarPuestos('#puesto', false, departamentoId);
    } else {
        // Si no se selecciona departamento, cargar todos los puestos
        cargarPuestos('#puesto');
    }
});




// Editar departamento
$(document).on("click", ".btn-editar-departamento", function () {
  var departamentoId = $(this).data("id");
  var descripcion = $(this).data("descripcion");
  var activo = $(this).data("activo");

  $("#registrarDepartamentoModalLabel").text("Editar Departamento");

  $("#departamentoId").val(departamentoId);
  $("#departamentoDescripcion").val(descripcion);
  $("#departamentoActivoCheck").prop("checked", activo == 1);

  $("#registrarDepartamentoModal").modal("show");
});

// Resetear el modal de registrar departamento al cerrarlo
$("#registrarDepartamentoModal").on("hidden.bs.modal", function () {
  $("#registrarDepartamentoModalLabel").text("Registrar Departamento");
  $("#registrarDepartamentoForm")[0].reset();
  $("#departamentoId").val("");
});

// Eliminar departamento
$(document).on("click", ".btn-eliminar-departamento", function () {
  var departamentoId = $(this).data("id");
  var activo = $(this).data("activo");

  console.log(
    "Eliminando departamento:",
    departamentoId,
    "Activo actual:",
    activo
  );

  alertMensajeConfirm(
    {
      title: "¿Está a punto de eliminar este departamento?",
      text: "Asegúrate que la acción sea correcta.",
      icon: "warning",
    },
    function () {
      $.ajax({
        url: "../../../api/recursos_humanos_api.php",
        type: "POST",
        data: {
          api: 14,
          id_departamento: departamentoId,
          activo: 0,
        },
        beforeSend: function () {
          console.log("Enviando datos:", {
            api: 14,
            id_departamento: departamentoId,
            activo: 0,
          });
        },
        success: function (response) {
          console.log("Respuesta del servidor:", response);

          let data;
          try {
            data =
              typeof response === "string" ? JSON.parse(response) : response;
          } catch (e) {
            console.error("Error parseando respuesta:", e);
            alertToast("Error en la respuesta del servidor", "error", 4000);
            return;
          }

          if (data.response && data.response.code == 1) {
            console.log("Departamento eliminado correctamente:", data);
            alertToast("Departamento eliminado!", "success", 4000);
            if (tableCatDepartamentos) tableCatDepartamentos.ajax.reload();
          } else {
            alertToast(
              data.response?.message || "Error al procesar la solicitud",
              "error",
              4000
            );
          }
        },
        error: function (xhr, status, error) {
          console.error("Error AJAX:", error);
          console.error("Respuesta:", xhr.responseText);
          alertToast("Error de conexión", "error", 4000);
        },
      });
    }
  );
});

// Editar puesto - UNIFICADO CON TODOS LOS CAMPOS
$(document).on("click", ".btn-editar-puesto", function () {
  var $btnEditar = $(this); // Guardar referencia al botón
  var puestoId = $btnEditar.data("id");
  var descripcion = $btnEditar.data("descripcion");
  var departamentoId = $btnEditar.data("departamento");
  var activo = $btnEditar.data("activo");
  
  // Datos adicionales de perfil del puesto
  var escolaridadMinima = $btnEditar.data("escolaridad") || "";
  var experienciaAnios = $btnEditar.data("experiencia") || "";
  var objetivos = $btnEditar.data("objetivos") || "";
  var competencias = $btnEditar.data("competencias") || "";
  var salarioMinimo = $btnEditar.data('salario_min') || "";
  var salarioMaximo = $btnEditar.data('salario_max') || "";
  
  // Obtener habilidades existentes del puesto (si están disponibles)
  var habilidadesBlandas = $btnEditar.data('habilidades-blandas') || "";
  var habilidadesTecnicas = $btnEditar.data('habilidades-tecnicas') || "";

  console.log("=== DEBUG EDITAR PUESTO UNIFICADO ===");
  console.log("Puesto ID:", puestoId);
  console.log("Descripción:", descripcion);
  console.log("Departamento ID:", departamentoId);
  console.log("Activo:", activo);
  console.log("Escolaridad Mínima:", escolaridadMinima);
  console.log("Experiencia Años:", experienciaAnios);
  console.log("Objetivos:", objetivos);
  console.log("Competencias:", competencias);
  console.log("Salario Minimo:", salarioMinimo);
  console.log("Salario Maximo:", salarioMaximo);
  console.log("Habilidades Blandas raw:", habilidadesBlandas);
  console.log("Habilidades Técnicas raw:", habilidadesTecnicas);

  // Variables para almacenar los IDs de habilidades procesados
  var habilidadesBlandasIds = [];
  var habilidadesTecnicasIds = [];

  // Cambiar título del modal
  $("#registrarPuestoModalLabel").text("Editar Puesto");
  
  // Llenar campos básicos del puesto
  $("#puestoId").val(puestoId);
  $("#puestoDescripcion").val(descripcion);
  $("#puestoActivoCheck").prop("checked", activo == 1);

  // Llenar campos de perfil del puesto
  $("#detalle_escolaridad_minima").val(escolaridadMinima);
  $("#detalle_experiencia_anios").val(experienciaAnios);
  $("#objetivosPuesto").val(objetivos);
  $("#competenciasPuesto").val(competencias);
  $("#salario_min").val(salarioMinimo);
  $("#salario_max").val(salarioMaximo);

  // Procesar habilidades existentes del puesto ANTES de cargar departamentos
  console.log("Habilidades Blandas raw (tipo):", typeof habilidadesBlandas, habilidadesBlandas);
  console.log("Habilidades Técnicas raw (tipo):", typeof habilidadesTecnicas, habilidadesTecnicas);
  
  // Procesar habilidades blandas
  if (habilidadesBlandas && Array.isArray(habilidadesBlandas) && habilidadesBlandas.length > 0) {
    habilidadesBlandasIds = habilidadesBlandas;
    console.log("Habilidades blandas procesadas:", habilidadesBlandasIds);
  } else if (habilidadesBlandas && typeof habilidadesBlandas === 'string' && habilidadesBlandas.trim() !== "") {
    try {
      habilidadesBlandasIds = JSON.parse(habilidadesBlandas);
      if (!Array.isArray(habilidadesBlandasIds)) habilidadesBlandasIds = [];
    } catch (e) {
      console.warn("Error al parsear habilidades blandas:", e);
      habilidadesBlandasIds = [];
    }
  }
  
  // Procesar habilidades técnicas
  if (habilidadesTecnicas && Array.isArray(habilidadesTecnicas) && habilidadesTecnicas.length > 0) {
    habilidadesTecnicasIds = habilidadesTecnicas;
    console.log("Habilidades técnicas procesadas:", habilidadesTecnicasIds);
  } else if (habilidadesTecnicas && typeof habilidadesTecnicas === 'string' && habilidadesTecnicas.trim() !== "") {
    try {
      habilidadesTecnicasIds = JSON.parse(habilidadesTecnicas);
      if (!Array.isArray(habilidadesTecnicasIds)) habilidadesTecnicasIds = [];
    } catch (e) {
      console.warn("Error al parsear habilidades técnicas:", e);
      habilidadesTecnicasIds = [];
    }
  }

  // CORREGIDO: Cargar departamentos y DESPUÉS seleccionar el correcto
  cargarDepartamentos('#id_departamento_puesto')
    .then(function(departamentos) {
      console.log('Departamentos cargados para edición de puesto:', departamentos.length);
      
      // Preseleccionar el departamento DESPUÉS de cargar las opciones
      $("#id_departamento_puesto").val(departamentoId);
      console.log(`Departamento preseleccionado: ${departamentoId}`);
      
      // Verificar que los campos de perfil se asignaron correctamente
      setTimeout(function() {
        console.log("=== VERIFICACIÓN DESPUÉS DE CARGAR ===");
        console.log("Escolaridad en select:", $("#detalle_escolaridad_minima").val());
        console.log("Experiencia en select:", $("#detalle_experiencia_anios").val());
        console.log("Objetivos:", $("#objetivosPuesto").val());
        console.log("Competencias:", $("#competenciasPuesto").val());
        console.log("Habilidades Blandas IDs cargados:", habilidadesBlandasIds);
        console.log("Habilidades Técnicas IDs cargados:", habilidadesTecnicasIds);
      }, 100);
    })
    .catch(function(error) {
      console.error('Error al cargar departamentos para edición de puesto:', error);
      alertToast("Error al cargar los departamentos", "error", 3000);
    });

  $("#registrarPuestoModal").modal("show");
  
  // Esperar a que el modal se abra completamente antes de establecer las habilidades
  setTimeout(() => {
    // Establecer las habilidades en el sistema de tags
    if (window.habilidadesManager && typeof window.habilidadesManager.establecerHabilidadesSeleccionadas === 'function') {
      // Esperar a que se inicialicen las habilidades y luego establecer las seleccionadas
      window.habilidadesManager.inicializarHabilidades().then(() => {
        console.log("Estableciendo habilidades existentes:", habilidadesBlandasIds, habilidadesTecnicasIds);
        window.habilidadesManager.establecerHabilidadesSeleccionadas(habilidadesBlandasIds, habilidadesTecnicasIds);
      }).catch(error => {
        console.error("Error al inicializar habilidades:", error);
      });
    } else {
      console.warn("habilidadesManager no está disponible");
    }
  }, 300);
});

// Resetear el modal de registrar puesto al cerrarlo
$("#registrarPuestoModal").on("hidden.bs.modal", function () {
  $("#registrarPuestoModalLabel").text("Registrar Puesto");
  $("#registrarPuestoForm")[0].reset();
  $("#puestoId").val("");
  
  // Limpiar también los campos de perfil
  $("#detalle_escolaridad_minima").val("");
  $("#detalle_experiencia_anios").val("");
  $("#objetivosPuesto").val("");
  $("#competenciasPuesto").val("");
  $("#salario_min").val("");
  $("#salario_max").val("");
  
  // Limpiar las habilidades seleccionadas
  if (window.habilidadesManager && typeof window.habilidadesManager.establecerHabilidadesSeleccionadas === 'function') {
    window.habilidadesManager.establecerHabilidadesSeleccionadas([], []);
  }
});


// Eliminar puesto
$(document).on("click", ".btn-eliminar-puesto", function () {
  var puestoId = $(this).data("id");
  var activo = $(this).data("activo");

  console.log("Eliminando puesto:", puestoId, "Activo:", activo);

  alertMensajeConfirm(
    {
      title: "¿Está a punto de eliminar este puesto?",
      text: "Asegúrate que la acción sea correcta.",
      icon: "warning",
    },
    function () {
      $.ajax({
        url: "../../../api/recursos_humanos_api.php",
        type: "POST",
        data: {
          api: 15,
          id_puesto: puestoId,
          activo: 0,
        },
        beforeSend: function () {
          console.log("Enviando datos:", {
            api: 15,
            id_puesto: puestoId,
            activo: 0,
          });
        },
        success: function (response) {
          console.log("Respuesta del servidor:", response);

          let data;
          try {
            data =
              typeof response === "string" ? JSON.parse(response) : response;
          } catch (e) {
            console.error("Error parseando respuesta:", e);
            alertToast("Error en la respuesta del servidor", "error", 4000);
            return;
          }

          if (data.response && data.response.code == 1) {
            console.log("Puesto eliminado correctamente:", data);
            alertToast("Puesto eliminado!", "success", 4000);
            if (tableCatPuestos) tableCatPuestos.ajax.reload();
          } else {
            alertToast(
              data.response?.message || "Error al procesar la solicitud",
              "error",
              4000
            );
          }
        },
        error: function (xhr, status, error) {
          console.error("Error AJAX:", error);
          console.error("Respuesta:", xhr.responseText);
          alertToast("Error de conexión", "error", 4000);
        },
      });
    }
  );
});

// Event handlers para los botones de detalles de puestos
$(document).on("click", ".btn-ver-detalles-puesto", function (e) {
  // Prevenir múltiples clics
  if ($(this).hasClass('processing')) {
    return;
  }
  
  $(this).addClass('processing');
  
  var puestoId = $(this).data("id");
  var descripcion = $(this).data("nombre");
  
  // Obtener los datos del row de la DataTable
  var row = tableCatPuestos.row($(this).closest('tr')).data();
  
  console.log("=== DEBUG VER DETALLES PUESTO ===");
  console.log("Puesto ID:", puestoId);
  console.log("Descripción:", descripcion);
  console.log("Datos del row:", row);

  // Llenar los campos de información básica
  $("#detallePuestoNombre").text(row.descripcion || "-");
  $("#detallePuestoDepartamento").text(row.departamento_nombre || "-");
  
  // Mostrar estado del puesto con estilos mejorados
  var estadoBadge = row.activo == 1 
    ? '<span class="badge bg-success">Activo</span>' 
    : '<span class="badge bg-secondary">Inactivo</span>';
  $("#detallePuestoEstado").html(estadoBadge);

  // Llenar campos de perfil del puesto con mejor formateo
  $("#detalleEscolaridadMinima").text(row.escolaridad_minima || "No especificada");
  $("#detalleExperienciaAnios").text(row.experiencia_anios ? row.experiencia_anios : "No especificada");
  $("#detalleObjetivos").text(row.objetivos || "No definidos");
  $("#detalleCompetencias").text(row.competencias || "No definidas");
  $("#detalleSalarioMin").text(`$${row.salario_min || 0} - `);
  $("#detalleSalarioMax").text(`$${row.salario_max || 0}`);

  // Llenar habilidades blandas con badges coloridas
  if (row.habilidades_blandas_descripcion && row.habilidades_blandas_descripcion !== 'Sin habilidades blandas') {
    const habilidadesBlandas = row.habilidades_blandas_descripcion.split(', ');
    let htmlBlandas = '<div class="d-flex flex-wrap" style="max-width: 100%;">';
    habilidadesBlandas.forEach(function(habilidad, index) {
      const isNewRow = index % 2 === 0;
      if (isNewRow && index > 0) {
        htmlBlandas += '</div><div class="d-flex flex-wrap" style="max-width: 100%;">';
      }
      htmlBlandas += `<span class="badge bg-gradient-info text-white me-1 mb-1" style="font-size: 0.7em; padding: 0.4em 0.6em; border-radius: 12px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">${habilidad.trim()}</span>`;
    });
    htmlBlandas += '</div>';
    $("#detalleHabilidadesBlandas").html(htmlBlandas);
  } else {
    $("#detalleHabilidadesBlandas").html('<span class="text-muted fst-italic">Sin habilidades blandas</span>');
  }

  // Llenar habilidades técnicas con badges coloridas
  if (row.habilidades_tecnicas_descripcion && row.habilidades_tecnicas_descripcion !== 'Sin habilidades técnicas') {
    const habilidadesTecnicas = row.habilidades_tecnicas_descripcion.split(', ');
    let htmlTecnicas = '<div class="d-flex flex-wrap" style="max-width: 100%;">';
    habilidadesTecnicas.forEach(function(habilidad, index) {
      const isNewRow = index % 2 === 0;
      if (isNewRow && index > 0) {
        htmlTecnicas += '</div><div class="d-flex flex-wrap" style="max-width: 100%;">';
      }
      htmlTecnicas += `<span class="badge bg-gradient-success text-white me-1 mb-1" style="font-size: 0.7em; padding: 0.4em 0.6em; border-radius: 12px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">${habilidad.trim()}</span>`;
    });
    htmlTecnicas += '</div>';
    $("#detalleConocimientosTecnicos").html(htmlTecnicas);
  } else {
    $("#detalleConocimientosTecnicos").html('<span class="text-muted fst-italic">Sin habilidades técnicas</span>');
  }

  // Actualizar título del modal con mejor formato
  $("#detallesPuestoModalLabel").html(`<i class="bi bi-eye me-2"></i>Detalles del Puesto: ${row.descripcion}`);
  
  // Mostrar el modal con efecto
  $("#detallesPuestoModal").modal("show");
  
  // Remover la clase de procesamiento después de un breve delay
  setTimeout(() => {
    $(this).removeClass('processing');
  }, 500);
});



// Editar motivo
$(document).on("click", ".btn-editar-motivo", function () {
  var motivoId = $(this).data("id");
  var descripcion = $(this).data("descripcion");
  var activo = $(this).data("activo");
  console.log("Motivo ID:", motivoId);

  $("#registrarMotivoModalLabel").text("Editar Motivo");

  $("#motivoId").val(motivoId);
  $("#motivoDescripcion").val(descripcion);
  $("#motivoActivoCheck").prop("checked", activo == 1);
  $("#registrarMotivoModal").modal("show");
});

// Resetear el modal de registrar motivo al cerrarlo
$("#registrarMotivoModal").on("hidden.bs.modal", function () {
  $("#registrarMotivoModalLabel").text("Registrar Motivo");
  $("#registrarMotivoForm")[0].reset();
  $("#motivoId").val("");
});

// Eliminar motivo
$(document).on("click", ".btn-eliminar-motivo", function () {
  var motivoId = $(this).data("id");
  var activo = $(this).data("activo");

  console.log("Eliminando motivo:", motivoId, "Activo:", activo);

  alertMensajeConfirm(
    {
      title: "¿Está a punto de eliminar este motivo?",
      text: "Asegúrate que la acción sea correcta.",
      icon: "warning",
    },
    function () {
      $.ajax({
        url: "../../../api/recursos_humanos_api.php",
        type: "POST",
        data: {
          api: 16,
          id_motivo: motivoId,
          activo: 0,
        },
        beforeSend: function () {
          console.log("Enviando datos:", {
            api: 16,
            id_motivo: motivoId,
            activo: 0,
          });
        },
        success: function (response) {
          console.log("Respuesta del servidor:", response);

          let data;
          try {
            data =
              typeof response === "string" ? JSON.parse(response) : response;
          } catch (e) {
            console.error("Error parseando respuesta:", e);
            alertToast("Error en la respuesta del servidor", "error", 4000);
            return;
          }

          if (data.response && data.response.code == 1) {
            console.log("Motivo eliminado correctamente:", data);
            alertToast("Motivo eliminado!", "success", 4000);
            if (tableCatMotivos) tableCatMotivos.ajax.reload();
          } else {
            alertToast(
              data.response?.message || "Error al procesar la solicitud",
              "error",
              4000
            );
          }
        },
        error: function (xhr, status, error) {
          console.error("Error AJAX:", error);
          console.error("Respuesta:", xhr.responseText);
          alertToast("Error de conexión", "error", 4000);
        },
      });
    }
  );
});

// Editar blanda
$(document).on("click", ".btn-editar-blanda", function () {
  var blandaId = $(this).data("id");
  var descripcion = $(this).data("descripcion");
  var activo = $(this).data("activo");
  console.log("Blanda ID:", blandaId);

  $("#registrarBlandasModalLabel").text("Editar habilidad blanda");

  $("#blandasId").val(blandaId);
  $("#blandasDescripcion").val(descripcion);
  $("#blandasActivoCheck").prop("checked", activo == 1);
  $("#registrarBlandasModal").modal("show");
});

// Resetear el modal de registrar blanda al cerrarlo
$("#registrarBlandasModal").on("hidden.bs.modal", function () {
  $("#registrarBlandasModalLabel").text("Registrar Blandas");
  $("#registrarBlandasForm")[0].reset();
  $("#blandasId").val("");
});

// Eliminar blanda
$(document).on("click", ".btn-eliminar-blanda", function () {
  var blandaId = $(this).data("id");
  var activo = $(this).data("activo");
  alertMensajeConfirm(
    {
      title: "¿Está a punto de eliminar esta habilidad blanda?",
      text: "Asegúrate que la acción sea correcta.",
      icon: "warning",
    },
    function () {
      $.ajax({
        url: "../../../api/recursos_humanos_api.php",
        type: "POST",
        data: {
          api: 20,
          id_blanda: blandaId,
          activo: 0,
        },
        beforeSend: function () {
          console.log("Enviando datos:", {
            api: 20,
            id_blanda: blandaId,
            activo: 0,
          });
        },
        success: function (response) {
          console.log("Respuesta del servidor:", response);

          let data;
          try {
            data =
              typeof response === "string" ? JSON.parse(response) : response;
          } catch (e) {
            console.error("Error parseando respuesta:", e);
            alertToast("Error en la respuesta del servidor", "error", 4000);
            return;
          }

          if (data.response && data.response.code == 1) {
            console.log("Habilidad blanda eliminada correctamente:", data);
            alertToast("Habilidad blanda eliminada!", "success", 4000);
            if (tableCatBlandas) tableCatBlandas.ajax.reload();
          } else {
            alertToast(
              data.response?.message || "Error al procesar la solicitud",
              "error",
              4000
            );
          }
        },
        error: function (xhr, status, error) {
          console.error("Error AJAX:", error);
          console.error("Respuesta:", xhr.responseText);
          alertToast("Error de conexión", "error", 4000);
        },
      });
    }
  );
});

// Editar habilidad técnica
$(document).on("click", ".btn-editar-tecnica", function () {
  var tecnicaId = $(this).data("id");
  var descripcion = $(this).data("descripcion");
  var activo = $(this).data("activo");
  console.log("Técnica ID:", tecnicaId);

  $("#registrarTecnicasModalLabel").text("Editar habilidad técnica");

  $("#tecnicasId").val(tecnicaId);
  $("#tecnicasDescripcion").val(descripcion);
  $("#tecnicasActivoCheck").prop("checked", activo == 1);
  $("#registrarTecnicasModal").modal("show");
});

// Eliminar habilidad técnica
$(document).on("click", ".btn-eliminar-tecnica", function () {
  var tecnicaId = $(this).data("id");
  var descripcion = $(this).closest("tr").find("td:eq(1)").text();
  
  alertMensajeConfirm(
    {
      title: "¿Está seguro de eliminar esta habilidad técnica?",
      text: `Se eliminará la habilidad técnica: ${descripcion}`,
      icon: "warning",
    },
    function () {
      ajaxAwaitFormData(
        {
          api: 23,
          id_tecnica: tecnicaId,
        },
        "recursos_humanos_api",
        null,
        { callbackAfter: true },
        false,
        function (data) {
          if (data.response.code == 1) {
            alertToast("Habilidad técnica eliminada exitosamente!", "success", 4000);
            if (tableCatTecnicas) tableCatTecnicas.ajax.reload();
          } else {
            alertToast(
              data.response.message || "Error al eliminar la habilidad técnica",
              "error",
              4000
            );
                   }
        }
      );
    }
  );
});

// Resetear el modal de registrar técnica al cerrarlo
$("#registrarTecnicasModal").on("hidden.bs.modal", function () {
  $("#registrarTecnicasModalLabel").text("Registrar Habilidad Técnica");
  $("#registrarTecnicasForm")[0].reset();
  $("#tecnicasId").val("");
});

// Eliminar requisición (desactivar)
$(document).on("click", ".btn-eliminar-requisicion", function () {
  var requisicionId = $(this).data("id");
  var activo = $(this).data("activo");

  console.log("Eliminando requisición:", requisicionId, "Activo:", activo);

  alertMensajeConfirm(
    {
      title: "¿Está a punto de eliminar este requisición?",
      text: "Asegúrate que la acción sea correcta.",
      icon: "warning",
    },
    function () {
      $.ajax({
        url: "../../../api/recursos_humanos_api.php",
        type: "POST",
        data: {
          api: 17,
          id_requisicion: requisicionId,
          activo: 0,
        },
        beforeSend: function () {
          console.log("Enviando datos:", {
            api: 16,
            id_requisicion: requisicionId,
            activo: 0,
          });
        },
        success: function (response) {
          console.log("Respuesta del servidor:", response);

          let data;
          try {
            data =
              typeof response === "string" ? JSON.parse(response) : response;
          } catch (e) {
            console.error("Error parseando respuesta:", e);
            alertToast("Error en la respuesta del servidor", "error", 4000);
            return;
          }

          if (data.response && data.response.code == 1) {
            console.log("Requisicion eliminado correctamente:", data);
            alertToast("Requisicion eliminado!", "success", 4000);
            if (tableCatRequisiciones) tableCatRequisiciones.ajax.reload();
          } else {
            alertToast(
              data.response?.message || "Error al procesar la solicitud",
              "error",
              4000
            );
          }
        },
        error: function (xhr, status, error) {
          console.error("Error AJAX:", error);
          console.error("Respuesta:", xhr.responseText);
          alertToast("Error de conexión", "error", 4000);
        },
      });
    }
  );
});

// ===== FUNCIONES PARA EL MODAL DE DETALLES DE REQUISICIÓN =====

// Función para cargar los detalles de una requisición
function cargarDetallesRequisicion(idRequisicion) {
    console.log("Cargando detalles de requisición:", idRequisicion);
    
    // Mostrar loading en el modal
    $('#detallesVacanteModal .modal-body').html(`
        <div class="text-center py-5">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Cargando...</span>
            </div>
            <p class="mt-3 text-muted">Cargando detalles de la requisición...</p>
        </div>
    `);
    
    $.ajax({
        url: 'api/recursos_humanos_api.php',
        method: 'POST',
        data: {
            action: 'obtener_detalles_requisicion',
            id_requisicion: idRequisicion
        },
        dataType: 'json',
        success: function(response) {
            console.log("Respuesta detalles requisición:", response);
            
            if (response.success && response.data) {
                const data = response.data;
                
                // Restaurar el contenido original del modal y llenarlo con los datos
                $('#detallesVacanteModal .modal-body').html($('#detalles_vacante_content').html());
                
                // Llenar información general
                $('#detalle_numero_requisicion').text(data.numero_requisicion || '-');
                $('#detalle_fecha_solicitud').text(data.fecha_solicitud || '-');
                $('#detalle_solicitante').text(data.solicitante || '-');
                $('#detalle_departamento').text(data.departamento || '-');
                $('#detalle_motivo').text(data.motivo || '-');
                
                // Llenar prioridad con badge formateado
                $('#detalle_prioridad').html(formatearPrioridadDetalle(data.prioridad));
                
                // Llenar estatus con badge formateado
                $('#detalle_estatus').html(formatearEstatusDetalle(data.estatus));
                
                // Llenar detalles del puesto
                $('#detalle_puesto').text(data.puesto || '-');
                $('#detalle_tipo_contrato').text(formatearTipoContrato(data.tipo_contrato) || '-');
                $('#detalle_tipo_jornada').text(formatearTipoJornada(data.tipo_jornada) || '-');
                $('#detalle_tipo_modalidad').text(formatearTipoModalidad(data.tipo_modalidad) || '-');
                
                // Llenar perfil deseado
                $('#detalle_escolaridad_minima').text(formatearEscolaridad(data.escolaridad_minima) || '-');
                $('#detalle_experiencia_anos').text(formatearExperiencia(data.experiencia_anios) || '-');
                $('#detalle_experiencia_area').text(data.experiencia_area || '-');
                $('#detalle_objetivos').text(data.objetivos || '-');
                $('#detalle_competencias').text(data.competencias || '-');
                $('#detalle_idiomas').text(data.idiomas || '-');
                // Llenar conocimientos técnicos y habilidades (usar divs en lugar de p)
                $('#detalle_conocimientos_tecnicos').text(data.conocimientos_tecnicos || '-');
                $('#detalle_habilidades_blandas').text(data.habilidades_blandas || '-');
                
                // Llenar condiciones laborales
                $('#detalle_dias_trabajo').text(formatearDiasTrabajo(data.dias_trabajo) || '-');
                $('#detalle_dias_personalizados').text(data.dias_personalizados || '-');
                $('#detalle_horario_trabajo').text(data.horario_trabajo || '-');
                                
                // Llenar justificación (usar div en lugar de p)
                $('#detalle_justificacion').text(data.justificacion || '-');
                
                // Mostrar información de aprobación si existe
                if (data.usuario_aprobador || data.fecha_aprobacion) {
                    $('#card_aprobacion').show();
                    $('#detalle_usuario_aprobador').text(data.usuario_aprobador || '-');
                    $('#detalle_fecha_aprobacion').text(data.fecha_aprobacion || '-');
                    $('#detalle_observaciones_aprobacion').text(data.observaciones_aprobacion || '-');
                } else {
                    $('#card_aprobacion').hide();
                }
                
                // Guardar el ID en el botón de editar
                $('#btn_editar_desde_detalle').data('requisicion-id', idRequisicion);
                
            } else {
                $('#detallesVacanteModal .modal-body').html(`
                    <div class="text-center py-5">
                        <i class="bi bi-exclamation-triangle text-warning" style="font-size: 3rem;"></i>
                        <p class="mt-3 text-muted">No se pudieron cargar los detalles de la requisición</p>
                    </div>
                `);
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.error("Error al cargar detalles:", textStatus, errorThrown);
            alertErrorAJAX(jqXHR, textStatus, errorThrown);
            
            $('#detallesVacanteModal .modal-body').html(`
                <div class="text-center py-5">
                    <i class="bi bi-exclamation-triangle text-danger" style="font-size: 3rem;"></i>
                    <p class="mt-3 text-muted">Error al cargar los detalles de la requisición</p>
                </div>
            `);
        }
    });
}

// === FUNCIÓN PARA ACTUALIZAR TEXTOS DE LA SECCIÓN DE OBSERVACIONES SEGÚN EL ESTATUS ===
function actualizarTextosSeccionObservaciones(estatus) {
    const configuraciones = {
        'aprobada': {
            titulo: 'Aprobación y Observaciones',
            usuario: 'Aprobado por:',
            fecha: 'Fecha de Aprobación:',
            observaciones: 'Observaciones de Aprobación:',
            colorHeader: 'bg-gradient-details'
            
        },
        'rechazada': {
            titulo: 'Rechazo y Observaciones',
            usuario: 'Rechazado por:',
            fecha: 'Fecha de Rechazo:',
            observaciones: 'Observaciones de Rechazo:',
            colorHeader: 'bg-gradient-details'
            },
        'en_proceso': {
            titulo: 'Estado y Observaciones',
            usuario: 'Evaluado por:',
            fecha: 'Fecha de Evaluación:',
            observaciones: 'Observaciones de Evaluación:',
            colorHeader: 'bg-gradient-details'
            
        },
        'completada': {
            titulo: 'Finalización y Observaciones',
            usuario: 'Completado por:',
            fecha: 'Fecha de Finalización:',
            observaciones: 'Observaciones de Finalización:',
            colorHeader: 'bg-gradient-details'
            
        },
        'borrador': {
            titulo: 'Estado y Observaciones',
            usuario: 'Creado por:',
            fecha: 'Fecha de Creación:',
            observaciones: 'Observaciones:',
            colorHeader: 'bg-gradient-details'
            
        },
        'default': {
            titulo: 'Estado y Observaciones',
            usuario: 'Procesado por:',
            fecha: 'Fecha de Proceso:',
            observaciones: 'Observaciones:',
            colorHeader: 'bg-gradient-details'
            
        }
    };
    
    const config = configuraciones[estatus] || configuraciones['default'];
    
    // Actualizar textos
    $("#tituloSeccionObservaciones").text(config.titulo);
    $("#etiquetaUsuarioAccion").text(config.usuario);
    $("#etiquetaFechaAccion").text(config.fecha);
    $("#etiquetaObservacionesAccion").text(config.observaciones);
    
    // Actualizar color del header de la card
    const cardHeader = $("#tituloSeccionObservaciones").closest('.card-header');
    cardHeader.removeClass('bg-gradient-details bg-success bg-danger bg-info bg-dark bg-warning bg-secondary');
    cardHeader.addClass(config.colorHeader);
    
    console.log(`Textos de sección actualizados para estatus: ${estatus}`);
}

// Funciones auxiliares para formatear datos en el modal de detalles
function formatearPrioridadDetalle(prioridad) {
    const badges = {
        'urgente': '<span class="badge bg-gradient-secondary">Urgente</span>',
        'normal': '<span class="badge bg-gradient-primary">Normal</span>',
        'baja': '<span class="badge bg-secondary">Baja</span>'
    };
    return badges[prioridad] || '<span class="badge bg-light text-dark">N/A</span>';
}

function formatearEstatusDetalle(estatus) {
    const badges = {
        'borrador': '<span class="badge bg-gradient-warning text-dark">Borrador</span>',
        'aprobada': '<span class="badge bg-gradient-success">Aprobada</span>',
        'rechazada': '<span class="badge bg-gradient-secondary">Rechazada</span>',
        'en_proceso': '<span class="badge bg-gradient-primary">En Proceso</span>'
    };
    return badges[estatus] || '<span class="badge bg-light text-dark">N/A</span>';
}

function formatearTipoContrato(tipo) {
    const tipos = {
        'permanente': 'Permanente',
        'temporal': 'Temporal'
    };
    return tipos[tipo] || tipo;
}

function formatearTipoJornada(tipo) {
    const tipos = {
        'tiempo_completo': 'Tiempo Completo',
        'medio_tiempo': 'Medio Tiempo'
    };
    return tipos[tipo] || tipo;
}

function formatearTipoModalidad(tipo) {
  const tipos = {
    'presencial': 'Presencial',
    'remoto': 'Remoto',
    'hibrido': 'Híbrido'
  };
  return tipos[tipo] || tipo;
}

function formatearDiasTrabajo(dia) {
  const dias = {
    'L-V': 'Lunes a Viernes',
    'L-S': 'Lunes a Sábado',
    'L-D': 'Lunes a Domingo',
    'fines_semana': 'Fines de Semana',
    'otro': 'Personalizado'
  };
  return dias[dia] || dia;
}

function formatearEscolaridad(escolaridad) {
    const escolaridades = {
        'primaria': 'Primaria',
        'secundaria': 'Secundaria',
        'preparatoria': 'Preparatoria/Bachillerato',
        'tecnico': 'Técnico',
        'licenciatura': 'Licenciatura',
        'maestria': 'Maestría',
        'doctorado': 'Doctorado'
    };
    return escolaridades[escolaridad] || escolaridad;
}

function formatearExperiencia(experiencia) {
    if (!experiencia) return 'No especificado';
    
    const experiencias = {
        'Sin experiencia': 'Sin experiencia',
        '1 año': '1 año',
        '2 años': '2 años',
        '3 años': '3 años',
        '4 años': '4 años',
        'más de 5 años': 'Más de 5 años'
    };
    return experiencias[experiencia] || experiencia;
}

// Event listener para el botón de ver detalles en la tabla
$(document).on('click', '.btn-ver-requisicion', function() {
    // Obtener la fila de datos de DataTables
    const tabla = tableCatRequisiciones;
    const fila = $(this).closest('tr');
    const dataClick = tabla.row(fila).data();
    
    console.log("Datos de la requisición seleccionada:", dataClick);
    
    // Llenar el modal con los datos de la requisición
    llenarModalDetallesRequisicion(dataClick);
    
    // Mostrar el modal
    $("#detallesRequisicionModal").modal("show");
    
    // Ejecutar las habilidades INMEDIATAMENTE (para testing)
    console.log("=== EJECUTANDO HABILIDADES INMEDIATAMENTE ===");
    const habilidadesBlandas = dataClick.habilidades_blandas_descripcion || dataClick['34'] || null;
    const habilidadesTecnicas = dataClick.habilidades_tecnicas_descripcion || dataClick['35'] || null;
    
    console.log("Habilidades blandas a procesar:", habilidadesBlandas);
    console.log("Habilidades técnicas a procesar:", habilidadesTecnicas);
    
    mostrarHabilidadesComoTags(habilidadesBlandas, 'detallesHabilidadesBlandasContainer', 'blanda');
    mostrarHabilidadesComoTags(habilidadesTecnicas, 'detallesHabilidadesTecnicasContainer', 'tecnica');
    
    // También con setTimeout como respaldo  
    setTimeout(() => {
        console.log("=== EJECUTANDO HABILIDADES DESPUÉS DE MOSTRAR MODAL ===");
        console.log("Modal visible ahora:", $('#detallesRequisicionModal').is(':visible'));
        
        mostrarHabilidadesComoTags(habilidadesBlandas, 'detallesHabilidadesBlandasContainer', 'blanda');
        mostrarHabilidadesComoTags(habilidadesTecnicas, 'detallesHabilidadesTecnicasContainer', 'tecnica');
    }, 500);
});

// Event handler para editar requisición desde la tabla
$(document).on('click', '.btn-editar-requisicion', function() {
    const requisicionId = $(this).data('id');
    console.log("Editando requisición desde tabla:", requisicionId);
    
    if (!requisicionId) {
        alertToast("Error: No se encontró el ID de la requisición", "error", 3000);
        return;
    }
    
    // Mostrar indicador de carga en el botón
    const originalHtml = $(this).html();
    $(this).html('<i class="spinner-border spinner-border-sm"></i>');
    $(this).prop('disabled', true);
    
    // Obtener los datos de la requisición
    obtenerRequisicionPorId(requisicionId)
        .then(requisicionData => {
            console.log("Datos de requisición obtenidos:", requisicionData);
            
            // Cargar el formulario de edición con los datos de la requisición
            llenarModalEditarRequisicion(requisicionData);
            
            // Mostrar el modal de edición
            $("#editarRequisicionModal").modal("show");
        })
        .catch(error => {
            console.error("Error al obtener datos de la requisición:", error);
            alertToast("Error al cargar los datos de la requisición", "error", 3000);
        })
        .finally(() => {
            // Restaurar botón
            $(this).html(originalHtml);
            $(this).prop('disabled', false);
        });
});

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

// Función para llenar el modal de detalles con los datos de la requisición
function llenarModalDetallesRequisicion(data) {
    try {
        // === INFORMACIÓN GENERAL ===
        $("#numeroRequisicion").text(data.numero_requisicion || 'N/A');
        $("#departamentoRequisicion").text(data.departamento_nombre || 'N/A');
        $("#motivoRequisicion").text(data.motivo_descripcion || 'N/A');
        
        // Formatear fecha de creación
        let fechaCreacion = 'N/A';
        if (data.fecha_creacion) {
            fechaCreacion = formatearFecha(data.fecha_creacion);
        }
        $("#fechaCreacion").text(fechaCreacion);
        
        // Usuario solicitante (necesitarás obtener el nombre del usuario por ID)
        $("#usuarioSolicitante").text(data.solicitante || `ID: ${data.usuario_solicitante_id}` || 'N/A');
        
        // === BADGES DE PRIORIDAD Y ESTATUS ===
        $("#badgePrioridad").html(formatearPrioridadBadge(data.prioridad));
        $("#badgeEstatus").html(formatearEstatusBadge(data.estatus));
        
        // === INFORMACIÓN DEL PUESTO ===
        $("#puestoSolicitado").text(data.puesto_nombre || 'N/A');
        $("#tipoContrato").text(formatearTipoContrato(data.tipo_contrato) || 'N/A');
        $("#tipoJornada").text(formatearTipoJornada(data.tipo_jornada) || 'N/A');
        $("#tipoModalidad").text(formatearTipoModalidad(data.tipo_modalidad) || 'N/A');
        $("#diaTrabajo").text(formatearDiasTrabajo(data.dias_trabajo) || 'N/A');
        if (data.dias_personalizados && data.dias_personalizados !== '' && data.dias_personalizados !== 'N/A') {
            $("#diaPersonalizado").text(data.dias_personalizados);
            $("#diaPersonalizadoContainer").show();
        } else {
            $("#diaPersonalizadoContainer").hide();
        }
        $("#horaInicio").text(data.hora_inicio || 'N/A');
        $("#horaFin").text(data.hora_fin || 'N/A');
        
        // === REQUISITOS ACADÉMICOS ===
        $("#escolaridadMinima").text(formatearEscolaridad(data.escolaridad_minima) || 'N/A');
        $("#experienciaAnos").text(formatearExperiencia(data.experiencia_anios) || 'N/A');
        $("#objetivoss").text(data.objetivos || 'N/A');
        $("#competenciass").text(data.competencias || 'N/A');
        $("#bandaSalarialPuesto").text(data.salario_min && data.salario_max ? `$${data.salario_min} - $${data.salario_max}` : 'No especificado');
        
        // === HABILIDADES COMO TAGS ===
        console.log("=== DEBUG HABILIDADES (PRIMERA EJECUCIÓN) ===");
        console.log("Data completa:", data);
        console.log("Objetivos del puesto:", data.objetivos);
        console.log("Competencias del puesto:", data.competencias);
        console.log("Habilidades blandas (propiedad):", data.habilidades_blandas_descripcion);
        console.log("Habilidades técnicas (propiedad):", data.habilidades_tecnicas_descripcion);
        console.log("Habilidades blandas (índice 34):", data['34']);
        console.log("Habilidades técnicas (índice 35):", data['35']);
        
        // Intentar obtener las habilidades de diferentes formas
        const habilidadesBlandas = data.habilidades_blandas_descripcion || data['34'] || null;
        const habilidadesTecnicas = data.habilidades_tecnicas_descripcion || data['35'] || null;
        
        console.log("Habilidades blandas finales:", habilidadesBlandas);
        console.log("Habilidades técnicas finales:", habilidadesTecnicas);
        
        // COMENTADO: Se ejecutará después de mostrar el modal
        // mostrarHabilidadesComoTags(habilidadesBlandas, 'habilidadesBlandasTags', 'blanda');
        // mostrarHabilidadesComoTags(habilidadesTecnicas, 'habilidadesTecnicasTags', 'tecnica');
        
        // Verificar qué modal está siendo usado
        console.log("=== VERIFICACIÓN MODAL (ANTES DE MOSTRAR) ===");
        console.log("Modal detallesRequisicionModal visible:", $('#detallesRequisicionModal').is(':visible'));
        console.log("Modal detallesVacanteModal visible:", $('#detallesVacanteModal').is(':visible'));
        console.log("Containers en modal activo:");
        console.log("- detallesHabilidadesBlandasContainer encontrado:", $('#detallesHabilidadesBlandasContainer').length);
        console.log("- detallesHabilidadesTecnicasContainer encontrado:", $('#detallesHabilidadesTecnicasContainer').length);
        
        // === JUSTIFICACIÓN ===
        $("#justificacionRequisicion").text(data.justificacion || 'Sin descripción');
        
        // === INFORMACIÓN DE APROBACIÓN/RECHAZO - DINÁMICO SEGÚN ESTATUS ===
        actualizarTextosSeccionObservaciones(data.estatus);
        $("#usuarioAprobador").text(data.aprobador || 'Aún sin evaluar');
        $("#fechaAprobacion").text(data.fecha_aprobacion ? formatearFecha(data.fecha_aprobacion) : 'Aún sin evaluar');
        $("#observacionesAprobacion").text(data.observaciones_aprobacion || 'Aún sin observaciones');
        
        console.log("Modal de detalles llenado correctamente");
        
    } catch (error) {
        console.error("Error al llenar el modal de detalles:", error);
        alertToast("Error al cargar los detalles de la requisición", "error", 3000);
    }
}

// Función para llenar el modal de edición de requisiciones
function llenarModalEditarRequisicion(data) {
  try {
    console.log("Llenando modal de edición con datos:", data);
    
    // === CAMPOS OCULTOS ===
    $("#editar_id_requisicion").val(data.id_requisicion || '');
    // $("#editar_numero_requisicion").val(data.numero_requisicion || '');
    // $("#editar_usuario_solicitante_id").val(data.usuario_solicitante_id || '');
    // $("#editar_fecha_creacion").val(data.fecha_creacion || '');
    
    // === INFORMACIÓN DE LA REQUISICIÓN ===
    $("#editarNumeroDisplay").val(data.numero_requisicion || 'N/A');
    
    // Formatear fecha de creación
    let fechaCreacion = 'N/A';
    if (data.fecha_creacion) {
      fechaCreacion = formatearFecha(data.fecha_creacion);
    }
    $("#editarFechaDisplay").val(fechaCreacion);
    $("#editarSolicitanteDisplay").val(data.solicitante || `ID: ${data.usuario_solicitante_id}` || 'N/A');
    
    // === INFORMACIÓN GENERAL ===
    $("#editarEstatus").val(data.estatus || 'borrador');
    $("#editarPrioridad").val(data.prioridad || 'normal');
    
    // === DETALLES DEL PUESTO ===
    $("#editarTipoContrato").val(data.tipo_contrato || '');
    $("#editarTipoJornada").val(data.tipo_jornada || '');
    $("#editarTipoModalidad").val(data.tipo_modalidad || '');
    
    // === CONDICIONES LABORALES ===
    $("#editarDiasTrabajo").val(data.dias_trabajo || '');
    $("#editarDiasPersonalizados").val(data.dias_personalizados || '');
    $("#editarHoraInicio").val(data.hora_inicio || '');
    $("#editarHoraFin").val(data.hora_fin || '');
    
    // === JUSTIFICACIÓN ===
    $("#editarJustificacion").val(data.justificacion || '');
    
    // === OBSERVACIONES DE APROBACIÓN ===
    $("#editarObservacionesAprobacion").val(data.observaciones_aprobacion || '');
    
    // Mostrar/ocultar sección de observaciones según el estatus
    if (data.estatus === 'aprobada' || data.estatus === 'rechazada' || data.estatus === 'en_proceso') {
      $("#editarSeccionObservaciones").show();
      $("#editarEstatusDisplay").html(formatearEstatusBadge(data.estatus));
    } else {
      $("#editarSeccionObservaciones").hide();
    }

    // CORREGIDO: Cargar departamentos y DESPUÉS seleccionar el correcto
  cargarDepartamentos('#editarDepartamento')
    .then(function(departamentos) {
      console.log('Departamentos cargados para edición de requisición:', departamentos.length);
      
      // Preseleccionar el departamento DESPUÉS de cargar las opciones
      $("#editarDepartamento").val(data.id_departamento);
      console.log(`Departamento preseleccionado: ${data.id_departamento}`);
       // Cargar puestos del departamento seleccionado
        if (data.id_departamento) {
          return cargarPuestos('#editarPuesto', false, data.id_departamento);
        }
      })
      .then(function() {
        // Preseleccionar el puesto DESPUÉS de cargar las opciones
        if (data.id_puesto) {
          $("#editarPuesto").val(data.id_puesto);
          console.log(`Puesto preseleccionado: ${data.id_puesto}`);
        }
      })
      .catch(error => {
        console.error("Error al cargar catálogos:", error);
        alertToast("Error al cargar los catálogos", "error", 3000);
      });
    
    cargarMotivos('#editarMotivo')
    .then(function(motivos) {
      console.log('Motivos cargados para edición de requisición:', motivos.length);
      // Preseleccionar el motivo DESPUÉS de cargar las opciones
      $("#editarMotivo").val(data.id_motivo);
      console.log(`Motivo preseleccionado: ${data.id_motivo}`);
    })
    .catch(error => {
      console.error("Error al cargar motivos:", error);
      alertToast("Error al cargar los motivos", "error", 3000);
    });
    
    // === MANEJAR DÍAS DE TRABAJO ===
    // Mostrar/ocultar campos según el tipo de días seleccionado
    if (data.dias_trabajo === 'otro') {
      $("#diasPersonalizadosContainer").show();
      $("#editarHorasTrabajoContainer").show();
      $("#editarDiasPersonalizados").attr('required', true);
      // $("#editarDiasTrabajoContainer").hide();
      // Remover required del select de días de trabajo
      $("#editarDiasTrabajo").removeAttr('required');
    } else if (data.dias_trabajo && data.dias_trabajo !== '') {
      $("#diasPersonalizadosContainer").hide();
      $("#editarHorasTrabajoContainer").show();
    } else {
      $("#diasPersonalizadosContainer").hide();
      $("#editarHorasTrabajoContainer").hide();
    }
    
  } catch (error) {
    console.error("Error al llenar el modal de edición:", error);
    alertToast("Error al cargar los datos de la requisición", "error", 3000);
  }
}

// Función para obtener los datos de una requisición específica
function obtenerRequisicionPorId(idRequisicion) {
    return new Promise((resolve, reject) => {
        $.ajax({
            url: '../../../api/recursos_humanos_api.php',
            type: 'POST',
            data: { api: 2 }, // Case 2 para obtener todas las requisiciones
            success: function(response) {
                try {
                    const data = JSON.parse(response);
                    if (data.response && data.response.data) {
                        // Filtrar por ID específico
                        const requisicion = data.response.data.find(req => req.id_requisicion == idRequisicion);
                        if (requisicion) {
                            resolve(requisicion);
                        } else {
                            reject('Requisición no encontrada');
                        }
                    } else {
                        reject('Error en respuesta del servidor');
                    }
                } catch (error) {
                    reject('Error al parsear respuesta');
                }
            },
            error: function(xhr, status, error) {
                reject('Error de conexión');
            }
        });
    });
}


// === FUNCIÓN PARA ACTUALIZAR ETIQUETAS EN EL FORMULARIO DE EDICIÓN ===
function actualizarEtiquetasFormularioEdicion(estatus) {
    const configuraciones = {
        'aprobada': {
            etiqueta: 'Observaciones de Aprobación/Rechazo',
            placeholder: 'Agregar observaciones sobre la aprobación o comentarios adicionales...',
            ayuda: 'Opcional: Agregue comentarios sobre la decisión de aprobación'
        },
        'rechazada': {
            etiqueta: 'Observaciones de Rechazo',
            placeholder: 'Especificar las razones del rechazo de la requisición...',
            ayuda: 'Obligatorio: Especifique las razones del rechazo'
        },
        'en_proceso': {
            etiqueta: 'Observaciones de Evaluación',
            placeholder: 'Agregar comentarios sobre el proceso de evaluación...',
            ayuda: 'Opcional: Agregue observaciones sobre el proceso de evaluación'
        },
        'borrador': {
            etiqueta: 'Observaciones',
            placeholder: 'Agregar observaciones o comentarios...',
            ayuda: 'Opcional: Agregue comentarios adicionales'
        },
        'completada': {
            etiqueta: 'Observaciones de Finalización',
            placeholder: 'Agregar observaciones sobre la finalización...',
            ayuda: 'Opcional: Agregue comentarios sobre la finalización'
        }
    };
    
    const config = configuraciones[estatus] || configuraciones['borrador'];
    
    // Actualizar etiqueta
    $('label[for="editarObservacionesAprobacion"]').html(`<i class="bi bi-chat-text me-1"></i>${config.etiqueta}`);
    
    // Actualizar placeholder
    $('#editarObservacionesAprobacion').attr('placeholder', config.placeholder);
    
    // Actualizar texto de ayuda
    $('#editarSeccionObservaciones .form-text').html(`<i class="bi bi-pencil me-1"></i>${config.ayuda}`);
    
    console.log(`Etiquetas del formulario actualizadas para estatus: ${estatus}`);
}

// Función para procesar aprobación/rechazo desde la tabla
function procesarAprobacionRechazoTabla(accion, idRequisicion, observaciones) {
  console.log(
    `Procesando ${accion} de requisición desde tabla:`,
    idRequisicion
  );

  // Buscar y deshabilitar los botones de la fila específica
  let btnAprobar = $(`.btn-aprobar-requisicion[data-id="${idRequisicion}"]`);
  let btnRechazar = $(`.btn-rechazar-requisicion[data-id="${idRequisicion}"]`);

  btnAprobar.prop("disabled", true);
  btnRechazar.prop("disabled", true);

  $.ajax({
    url: "../../../api/recursos_humanos_api.php",
    type: "POST",
    dataType: "json",
    data: {
      api: 4, // Usar el nuevo case 4 para aprobaciones
      id_requisicion: idRequisicion,
      accion: accion,
      observaciones_aprobacion: observaciones,
    },
    success: function (response) {
      console.log(`Respuesta de ${accion} desde tabla:`, response);

      // Verificar múltiples condiciones de éxito
      let esExitoso = false;

      if (
        response.response &&
        (response.response.code == 1 || response.response.code == 2)
      ) {
        esExitoso = true;
      } else if (
        response.response &&
        response.response.data &&
        response.response.data.length > 0
      ) {
        let primeraFila = response.response.data[0];
        if (primeraFila.RESULT === "SUCCESS" || primeraFila.MESSAGE) {
          esExitoso = true;
        }
      } else if (response.code == 1 || response.code == 2) {
        esExitoso = true;
      }

      if (esExitoso) {
        // Éxito
        let mensaje = accion === "aprobar" ? "aprobada" : "rechazada";
        alertToast(`Requisición ${mensaje} exitosamente`, "success", 3000);

        // Recargar la tabla principal
        setTimeout(function () {
          try {
            if (
              typeof tableCatRequisiciones !== "undefined" &&
              tableCatRequisiciones
            ) {
              tableCatRequisiciones.ajax.reload(function (json) {
                console.log(
                  "Tabla de requisiciones recargada después de aprobación/rechazo desde tabla"
                );
              }, false);
            }
          } catch (error) {
            console.error("Error al recargar tabla principal:", error);
          }
        }, 500);
      } else {
        // Error
        console.error(`Error al ${accion} requisición desde tabla:`, response);
        let mensajeError =
          response.response && response.response.message
            ? response.response.message
            : `Error al ${accion} la requisición`;
        alertToast(mensajeError, "error", 4000);
      }
    },
    error: function (xhr, status, error) {
      console.error(
        `Error AJAX al ${accion} requisición desde tabla:`,
        xhr.responseText
      );
      alertToast(
        `Error de conexión al ${accion} la requisición`,
        "error",
        4000
      );
    },
    complete: function () {
      // Rehabilitar botones
      btnAprobar.prop("disabled", false);
      btnRechazar.prop("disabled", false);
    },
  });
}

// Event listener para cambio de días de trabajo en el modal de edición
$(document).on('change', '#editarDiasTrabajo', function() {
    const diasTrabajo = $(this).val();
    console.log("Días de trabajo seleccionados en edición:", diasTrabajo);
    
    if (diasTrabajo === 'Otro') {
        $("#diasPersonalizadosContainer").show();
        $("#editarHorasTrabajoContainer").show();
        $("#editarDiasPersonalizados").attr('required', true);
    } else if (diasTrabajo && diasTrabajo !== '') {
        $("#diasPersonalizadosContainer").hide();
        $("#editarHorasTrabajoContainer").show();
        $("#editarDiasPersonalizados").attr('required', false);
    } else {
        $("#diasPersonalizadosContainer").hide();
        $("#editarHorasTrabajoContainer").hide();
        $("#editarDiasPersonalizados").attr('required', false);
    }
});

// Event listener para cambio de departamento en el modal de edición (filtrar puestos)
$(document).on('change', '#editarDepartamento', function() {
    const departamentoId = $(this).val();
    console.log("Departamento seleccionado en edición:", departamentoId);
    
    if (departamentoId && departamentoId !== '') {
        cargarPuestos('#editarPuesto', false, departamentoId);
    } else {
        // Si no se selecciona departamento, cargar todos los puestos
        cargarPuestos('#editarPuesto');
    }
});

// === EVENTO PARA MANEJAR CAMBIO DE ESTATUS ===
$(document).on('change', '#editarEstatus', function() {
    const estatusSeleccionado = $(this).val();
    const seccionObservaciones = $('#editarSeccionObservaciones');
    const estatusDisplay = $('#editarEstatusDisplay');
    
    console.log('Estado seleccionado:', estatusSeleccionado);
    
    // Limpiar mensajes anteriores
    $('#mensaje-ayuda-estado').remove();
    
    // Actualizar el badge de estado
    actualizarBadgeEstado(estatusSeleccionado, estatusDisplay);
    
    // Mostrar/ocultar sección de observaciones según el estado
    if (estatusSeleccionado && estatusSeleccionado !== 'borrador') {
        // Mostrar sección de observaciones con animación
        seccionObservaciones.slideDown(300);
        
        // Mostrar mensaje de ayuda según el estado
        if (estatusSeleccionado === 'en_proceso') {
            mostrarMensajeAyuda('La requisición está en proceso de aprobación. Al actualizar la requisición tendrá que esperar a que un supervisor tome acciones.', 'info');
        } else if (estatusSeleccionado === 'aprobada') {
            mostrarMensajeAyuda('La requisición ha sido aprobada. Agrega observaciones sobre la aprobación.', 'success');
        } else if (estatusSeleccionado === 'rechazada') {
            mostrarMensajeAyuda('La requisición ha sido rechazada. Es necesario especificar las razones del rechazo.', 'warning');
        }
        
    } else {
        // Ocultar sección de observaciones
        seccionObservaciones.slideUp(300);
        
        // Limpiar campos de observaciones
        $('#editarObservacionesAprobacion').val('');
    }
});

// === FUNCIÓN PARA ACTUALIZAR BADGE DE ESTADO ===
function actualizarBadgeEstado(estado, elemento) {
    const badges = {
        'borrador': '<span class="badge bg-gradient-warning text-dark">Borrador</span>',
        'aprobada': '<span class="badge bg-gradient-success">Aprobada</span>',
        'rechazada': '<span class="badge bg-gradient-secondary">Rechazada</span>',
        'en_proceso': '<span class="badge bg-gradient-primary">En Proceso</span>'
    };
    
    elemento.html(badges[estado] || '<span class="badge bg-secondary fs-6">Desconocido</span>');
}

// === FUNCIÓN PARA MOSTRAR MENSAJES DE AYUDA ===
function mostrarMensajeAyuda(mensaje, tipo) {
    // Remover mensaje anterior si existe
    $('#mensaje-ayuda-estado').remove();
    
    const alertClass = 'alert-' + tipo;
    const iconos = {
        'info': 'bi-info-circle',
        'success': 'bi-check-circle',
        'warning': 'bi-exclamation-triangle',
        'danger': 'bi-exclamation-triangle'
    };
    
    const icono = iconos[tipo] || 'bi-info-circle';
    
    const mensajeHtml = `
        <div class="alert ${alertClass} alert-dismissible fade show mt-2" role="alert" id="mensaje-ayuda-estado">
            <i class="bi ${icono} me-2"></i>
            ${mensaje}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    `;
    
    $('#editarSeccionObservaciones .card-body').prepend(mensajeHtml);
    
    // Auto-ocultar después de 8 segundos
    setTimeout(function() {
        $('#mensaje-ayuda-estado').fadeOut();
    }, 8000);
}

// === FUNCIÓN PARA INICIALIZAR ESTADO AL ABRIR EL MODAL ===
function inicializarEstadoModal() {
    const estatusActual = $('#editarEstatus').val();
    console.log('Inicializando estado del modal:', estatusActual);
    
    if (estatusActual && estatusActual !== 'borrador') {
        // Mostrar sección de observaciones sin animación
        $('#editarSeccionObservaciones').show();
        
        // Actualizar el badge de estado
        const estatusDisplay = $('#editarEstatusDisplay');
        actualizarBadgeEstado(estatusActual, estatusDisplay);
    } else {
        // Ocultar sección de observaciones
        $('#editarSeccionObservaciones').hide();
    }
}

// Resetear el modal de edición al cerrarlo
$(document).on('hidden.bs.modal', '#editarRequisicionModal', function() {
    console.log("Modal de edición cerrado - limpiando formulario");
    $("#formEditarRequisicion")[0].reset();
    
    // Ocultar campos opcionales
    $("#diasPersonalizadosContainer").hide();
    $("#editarHorasTrabajoContainer").hide();
    $("#editarSeccionObservaciones").hide();
    
    // Limpiar campos ocultos
    $("#editar_id_requisicion").val("");
    $("#editar_numero_requisicion").val("");
    $("#editar_usuario_solicitante_id").val("");
    $("#editar_fecha_creacion").val("");
    
    // Limpiar mensajes de ayuda
    $('#mensaje-ayuda-estado').remove();
});

// === FUNCIONES AUXILIARES PARA FORMATEAR DATOS ===

function formatearFecha(fecha) {
    if (!fecha) return 'N/A';
    
    try {
        const fechaObj = new Date(fecha);
        return fechaObj.toLocaleDateString('es-ES', {
            year: 'numeric',
            month: 'long',
            day: 'numeric',
            hour: '2-digit',
            minute: '2-digit'
        });
    } catch (error) {
        return fecha; // Devolver la fecha original si hay error
    }
}

function formatearPrioridadBadge(prioridad) {
    const badges = {
        'urgente': '<span class="badge bg-gradient-secondary">Urgente</span>',
        'normal': '<span class="badge bg-gradient-primary">Normal</span>',
        'baja': '<span class="badge bg-secondary">Baja</span>'
    };
    return badges[prioridad] || '<span class="badge bg-light text-dark">N/A</span>';
}

function formatearEstatusBadge(estatus) {
    const badges = {
        'borrador': '<span class="badge bg-gradient-warning text-dark">Borrador</span>',
        'aprobada': '<span class="badge bg-gradient-success">Aprobada</span>',
        'rechazada': '<span class="badge bg-gradient-secondary">Rechazada</span>',
        'en_proceso': '<span class="badge bg-gradient-primary">En Proceso</span>'
    };
    return badges[estatus] || '<span class="badge bg-light text-dark">N/A</span>';
}
