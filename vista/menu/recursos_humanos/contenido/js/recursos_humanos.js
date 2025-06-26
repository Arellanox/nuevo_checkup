// Al cargar la página, solo muestra el menú principal
        document.addEventListener("DOMContentLoaded", function () {
            // Oculta los módulos al inicio
            document.getElementById("modulos-rrhh").style.display = "none";

            // Oculta el botón de registrar vacante al inicio
            ocultarBotonVacante();

            // Muestra el menú principal
            document.getElementById("tab-menu").style.display = "";
            
            // Oculta todos los módulos
            document.querySelectorAll('.content-module').forEach(module => {
                module.style.display = 'none';
            });
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
                document.querySelectorAll('.content-module').forEach(module => {
                    module.style.display = 'none';
                });
                
                // Muestra el módulo seleccionado
                const targetModule = this.getAttribute('data-target');
                document.getElementById(targetModule).style.display = 'block';

                // Mostrar u ocultar el botón de vacante según el módulo
                if (targetModule === "moduloRequisicion") {
                    mostrarBotonVacante();
                    mostrarBotonCatalogo();
                } else {
                    ocultarBotonVacante();
                    ocultarBotonCatalogo();
                }
            });
        });
        // Funcionalidad para volver al menú principal
    document.addEventListener('click', function(e) {
        if (e.target.closest('.btnVolver')) {
            e.preventDefault();

            // Oculta el botón de registrar vacante
            ocultarBotonVacante();
            ocultarBotonCatalogo();
            
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





//Data table para las vacantes
tableCatVacantes = $("#tableCatVacantes").DataTable({
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
            return $.extend(d, dataTableCatVacantes);
        },
        method: "POST",
        url: "../../../api/recursos_humanos_api.php",
        error: function (jqXHR, textStatus, errorThrown) {
            alertErrorAJAX(jqXHR, textStatus, errorThrown);
        },
        dataSrc: "response.data",
    },
    columns: [],
    dom: '',
    buttons: [],
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
            <button class="btn btn-sm btn-warning btn-editar-departamento" 
                data-id="${row.id_departamento}" 
                data-nombre="${row.descripcion}" 
                data-activo="${row.activo}">
              <i class="bi bi-pencil"></i>
            </button>
            <button class="btn btn-sm btn-danger btn-eliminar-departamento" 
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
          text: '<i class="bi bi-funnel"></i> Filtrar',
          className: "btn btn-warning bg-gradient-filter",
          attr: {
            "data-bs-toggle": "modal",
            "data-bs-target": "#filtrarDepartamentosModal",
          },
          action: function () {
            $("#filtrarDepartamentosModal").modal("show");
          },
          },
        ],
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
    pageLength: 5, // Agregar esta línea
    scrollY: "40vh",
    scrollCollapse: true,
    ajax: {
      dataType: "json",
      data: function (d) {
        return $.extend(d, dataTableCatPuestos);
      },
      method: "POST",
      url: "../../../api/recursos_humanos_api.php",
      error: function (jqXHR, textStatus, errorThrown) {
        alertErrorAJAX(jqXHR, textStatus, errorThrown);
      },
      dataSrc: "response.data",
    },
    columns: [
      { data: "id_puesto"},
      { data: "descripcion"},
      { data: "departamento_nombre"}, // Nueva columna
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
      <button class="btn btn-sm btn-info btn-ver-detalles-puesto" 
              data-id="${row.id_puesto}" 
              data-nombre="${row.descripcion}"
              title="Ver detalles">
          <i class="bi bi-eye"></i>
      </button>
      <button class="btn btn-sm btn-warning btn-editar-puesto" 
              data-id="${row.id_puesto}" 
              data-nombre="${row.descripcion}" 
              data-departamento="${row.id_departamento}"
              data-activo="${row.activo}">
          <i class="bi bi-pencil"></i>
      </button>
      <button class="btn btn-sm btn-danger btn-eliminar-puesto" data-id="${row.id_puesto}">
          <i class="bi bi-trash"></i>
      </button>
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
        className: "btn btn-warning btn-warning bg-gradient-filter",
        attr: {
          "data-bs-toggle": "modal",
          "data-bs-target": "#filtrarPuestosModal",
        },
        action: function () {
          $("#filtrarPuestosModal").modal("show");
        },
      },
    ],
  });


// Nueva DataTable para detalles de puestos
tableCatPuestosDetalles = $("#tableCatPuestosDetalles").DataTable({
  language: {
    url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json",
  },
  autoWidth: false, // Cambiar a false para mejor control
  lengthChange: false,
  info: true,
  paging: true,
  pageLength: 5,
  scrollY: "40vh",
  scrollCollapse: true,
  scrollX: true, // Agregar scroll horizontal para contenido amplio
  ajax: {
    dataType: "json",
    data: function (d) {
      return $.extend(d, dataTableCatPuestosDetalles);
    },
    method: "POST",
    url: "../../../api/recursos_humanos_api.php",
    error: function (jqXHR, textStatus, errorThrown) {
      alertErrorAJAX(jqXHR, textStatus, errorThrown);
    },
    dataSrc: "response.data",
  },
  columns: [
    { 
      data: "descripcion",
      width: "15%"
    },
    { 
      data: "objetivos",
      width: "30%",
      render: function(data) {
        // Mostrar el texto completo sin truncar
        return data || 'Sin objetivos';
      }
    },
    { 
      data: "competencias",
      width: "30%",
      render: function(data) {
        // Mostrar el texto completo sin truncar
        return data || 'Sin competencias';
      }
    },
    { 
      data: "banda_salarial",
      width: "15%",
      render: function(data) {
        return data || 'No definida';
      }
    },
    {
      data: null,
      width: "10%",
      render: function (data, type, row) {
        return `
          <button class="btn btn-sm btn-warning btn-editar-detalles-puesto" 
                  data-id="${row.id_puesto}" 
                  data-nombre="${row.descripcion}"
                  data-objetivos="${row.objetivos || ''}"
                  data-competencias="${row.competencias || ''}"
                  data-banda="${row.banda_salarial || ''}">
              <i class="bi bi-pencil"></i>
          </button>
        `;
      },
    },
  ],
  dom: 'Bfrtip',
  columnDefs: [
    {
      targets: [1, 2], // Columnas de objetivos y competencias
      render: function(data, type, row) {
        if (type === 'display') {
          // Para mostrar en pantalla, usar el texto completo con saltos de línea
          return data ? '<div style="white-space: pre-wrap; word-wrap: break-word; max-width: none;">' + data + '</div>' : (row === 1 ? 'Sin objetivos' : 'Sin competencias');
        }
        return data; // Para otros tipos (sorting, filtering) usar el dato original
      }
    }
  ]
});

// Event handlers para los nuevos botones
$(document).on('click', '.btn-ver-detalles-puesto', function() {
  const puestoId = $(this).data('id');
  const puestoNombre = $(this).data('nombre');
  
  // Filtrar la tabla de detalles por el puesto seleccionado
  dataTableCatPuestosDetalles.id_puesto = puestoId;
  tableCatPuestosDetalles.ajax.reload();
  
  $('#detallesPuestoModalLabel').text(`Detalles del Puesto: ${puestoNombre}`);
  $('#detallesPuestoModal').modal('show');
});

$(document).on('click', '.btn-editar-detalles-puesto', function() {
  const puestoId = $(this).data('id');
  const puestoNombre = $(this).data('nombre');
  const objetivos = $(this).data('objetivos');
  const competencias = $(this).data('competencias');
  const banda = $(this).data('banda');
  
  $('#detallePuestoId').val(puestoId);
  $('#puestoNombreDetalle').val(puestoNombre);
  $('#objetivosPuesto').val(objetivos);
  $('#competenciasPuesto').val(competencias);
  $('#bandaSalarialPuesto').val(banda);
  
  $('#editarDetallesPuestoModal').modal('show');
});


// Función para cargar departamentos en el select del modal de puestos
function cargarDepartamentosSelect() {
    $.ajax({
        url: '../../../api/recursos_humanos_api.php',
        type: 'POST',
        data: { api: 6 }, // Case 6 para obtener departamentos
        success: function(response) {
            const data = JSON.parse(response);
            if (data.response && data.response.data) {
                const select = $('#id_departamento_puesto');
                select.empty();
                select.append('<option value="">Seleccionar departamento...</option>');
                
                data.response.data.forEach(function(dept) {
                    if (dept.activo == 1) { // Solo departamentos activos
                        select.append(`<option value="${dept.id_departamento}">${dept.descripcion}</option>`);
                    }
                });
            }
        }
    });
}

// Cargar departamentos cuando se abre el modal
$(document).on('show.bs.modal', '#registrarPuestoModal', function () {
    cargarDepartamentosSelect();
});


// Función para cargar departamentos en el select del modal de vacantes
function cargarDepartamentosVacanteSelect() {
    $.ajax({
        url: '../../../api/recursos_humanos_api.php',
        type: 'POST',
        data: { api: 6 }, // Case 6 para obtener departamentos
        success: function(response) {
            const data = JSON.parse(response);
            if (data.response && data.response.data) {
                const select = $('#departamento');
                select.empty();
                select.append('<option value="">Seleccionar departamento...</option>');
                
                data.response.data.forEach(function(dept) {
                    if (dept.activo == 1) { // Solo departamentos activos
                        select.append(`<option value="${dept.id_departamento}">${dept.descripcion}</option>`);
                    }
                });
            }
        }
    });
}

// Función para cargar puestos en el select del modal de vacantes
function cargarPuestosVacanteSelect() {
    $.ajax({
        url: '../../../api/recursos_humanos_api.php',
        type: 'POST',
        data: { api: 8 }, // Case 8 para obtener puestos
        success: function(response) {
            const data = JSON.parse(response);
            if (data.response && data.response.data) {
                const select = $('#puesto');
                select.empty();
                select.append('<option value="">Seleccionar puesto...</option>');
                
                data.response.data.forEach(function(puesto) {
                    if (puesto.activo == 1) { // Solo puestos activos
                        select.append(`<option value="${puesto.id_puesto}">${puesto.descripcion}</option>`);
                    }
                });
            }
        }
    });
}

// Cargar departamentos y puestos cuando se abre el modal de registrar vacante
$(document).on('show.bs.modal', '#registrarVacanteModal', function () {
    cargarDepartamentosVacanteSelect();
    cargarPuestosVacanteSelect();
});

// Event listener para botones de editar departamento
$(document).on('click', '.btn-editar-departamento', function() {
    const id = $(this).data('id');
    const nombre = $(this).data('nombre');
    const activo = $(this).data('activo');
    
    // Llenar el formulario con los datos
    $('#departamentoId').val(id);
    $('#departamentoDescripcion').val(nombre);
    
    // Establecer el estado del checkbox
    if (activo == 1) {
        $('#departamentoActivoCheck').prop('checked', true);
    } else {
        $('#departamentoActivoCheck').prop('checked', false);
    }
    
    // Cambiar el título del modal
    $('#registrarDepartamentoModalLabel').text('Editar Departamento');
    
    // Abrir el modal
    $('#registrarDepartamentoModal').modal('show');
});

// Event listener para limpiar el formulario al abrir modal para nuevo registro
$(document).on('show.bs.modal', '#registrarDepartamentoModal', function(e) {
    // Si no fue disparado por un botón de editar, limpiar formulario
    if (!$(e.relatedTarget).hasClass('btn-editar-departamento')) {
        $('#registrarDepartamentoForm')[0].reset();
        $('#departamentoId').val('');
        $('#departamentoActivoCheck').prop('checked', true);
        $('#registrarDepartamentoModalLabel').text('Registrar Departamento');
    }
});

