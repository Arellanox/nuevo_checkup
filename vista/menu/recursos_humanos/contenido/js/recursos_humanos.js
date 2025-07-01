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
  });
});
// Funcionalidad para volver al menú principal
document.addEventListener("click", function (e) {
  if (e.target.closest(".btnVolver")) {
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
    { data: "numero_requisicion", title: "No. Requisición" },
    { data: "departamento_nombre", title: "Departamento" },
    { data: "motivo_descripcion", title: "Motivo" },
    {
      data: "puesto_nombre",
      title: "Puesto",
      defaultContent: "Sin especificar",
    },
    {
      data: "prioridad",
      title: "Prioridad",
      render: function (data) {
        const badges = {
          urgente: '<span class="badge bg-danger">Urgente</span>',
          normal: '<span class="badge bg-primary">Normal</span>',
          baja: '<span class="badge bg-secondary">Baja</span>',
        };
        return badges[data] || '<span class="badge bg-light">N/A</span>';
      },
    },
    {
      data: "estatus",
      title: "Estado",
      render: function (data) {
        const badges = {
          borrador: '<span class="badge bg-light text-dark">Borrador</span>',
          pendiente: '<span class="badge bg-warning">Pendiente</span>',
          aprobada: '<span class="badge bg-success">Aprobada</span>',
          rechazada: '<span class="badge bg-danger">Rechazada</span>',
          en_proceso: '<span class="badge bg-info">En Proceso</span>',
          completada: '<span class="badge bg-dark">Completada</span>',
        };
        return badges[data] || '<span class="badge bg-light">N/A</span>';
      },
    },
    { data: "fecha_creacion", title: "Fecha Creación" },
    {
      data: null,
      title: "Acciones",
      render: function (data, type, row) {
        return `
                    <div class="btn-group" role="group">
                        <button class="btn btn-sm btn-primary btn-ver-requisicion" 
                            data-id="${
                              row.id_requisicion
                            }" title="Ver detalles">
                            <i class="bi bi-eye"></i>
                        </button>
                        <button class="btn btn-sm btn-warning btn-editar-requisicion" 
                            data-id="${row.id_requisicion}" title="Editar">
                            <i class="bi bi-pencil"></i>
                        </button>
                        ${
                          row.estatus === "borrador"
                            ? `
                        <button class="btn btn-sm btn-danger btn-eliminar-requisicion" 
                            data-id="${row.id_requisicion}" title="Eliminar">
                            <i class="bi bi-trash"></i>
                        </button>`
                            : ""
                        }
                    </div>
                `;
      },
    },
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
      // action: function () {
      //     // Limpiar formulario
      //     $('#formRegistrarVacante')[0].reset();
      //     $('#usuario_solicitante_id').val($_SESSION.id || userId);
      //     $("#registrarVacanteModal").modal("show");
      // },
    },
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
            <button class="btn btn-sm btn-warning btn-editar-departamento" data-id="${row.id_departamento}" data-descripcion="${row.descripcion}" data-activo="${row.activo}">
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
    { data: "id_puesto" },
    { data: "descripcion" },
    { data: "departamento_nombre" },
    { data: "departamento_id", visible: false }, // Ocultar columna de ID de departamento PARA SOLO TOMAR EL ID Y LA DESCRIPCION SE TRAE DEL SP
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
              data-id="${row.id_puesto}" data-descripcion="${row.descripcion}" data-departamento="${row.departamento_id}" data-activo="${row.activo}">
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
      width: "15%",
    },
    {
      data: "objetivos",
      width: "30%",
      render: function (data) {
        // Mostrar el texto completo sin truncar
        return data || "Sin objetivos";
      },
    },
    {
      data: "competencias",
      width: "30%",
      render: function (data) {
        // Mostrar el texto completo sin truncar
        return data || "Sin competencias";
      },
    },
    {
      data: "banda_salarial",
      width: "15%",
      render: function (data) {
        return data || "No definida";
      },
    },
    {
      data: null,
      width: "10%",
      render: function (data, type, row) {
        return `
          <button class="btn btn-sm btn-warning btn-editar-detalles-puesto" 
                  data-id="${row.id_puesto}" 
                  data-nombre="${row.descripcion}"
                  data-objetivos="${row.objetivos || ""}"
                  data-competencias="${row.competencias || ""}"
                  data-banda="${row.banda_salarial || ""}">
              <i class="bi bi-pencil"></i>
          </button>
        `;
      },
    },
  ],
  dom: "Bfrtip",
  columnDefs: [
    {
      targets: [1, 2], // Columnas de objetivos y competencias
      render: function (data, type, row) {
        if (type === "display") {
          // Para mostrar en pantalla, usar el texto completo con saltos de línea
          return data
            ? '<div style="white-space: pre-wrap; word-wrap: break-word; max-width: none;">' +
                data +
                "</div>"
            : row === 1
            ? "Sin objetivos"
            : "Sin competencias";
        }
        return data; // Para otros tipos (sorting, filtering) usar el dato original
      },
    },
  ],
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
  pageLength: 5, // Agregar esta línea
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
      alertErrorAJAX(jqXHR, textStatus, errorThrown);
    },
    dataSrc: "response.data",
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
            <button class="btn btn-sm btn-warning btn-editar-motivo" 
                data-id="${row.id_motivo}" 
                data-descripcion="${row.descripcion}" 
                data-activo="${row.activo}">
              <i class="bi bi-pencil"></i>
            </button>
            <button class="btn btn-sm btn-danger btn-eliminar-motivo" 
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
      text: '<i class="bi bi-funnel"></i> Filtrar',
      className: "btn btn-warning bg-gradient-filter",
      attr: {
        "data-bs-toggle": "modal",
        "data-bs-target": "#filtrarMotivosModal",
      },
      action: function () {
        $("#filtrarMotivosModal").modal("show");
      },
    },
  ],
});

// Event handlers para los nuevos botones
$(document).on("click", ".btn-ver-detalles-puesto", function () {
  const puestoId = $(this).data("id");
  const puestoNombre = $(this).data("nombre");

  // Filtrar la tabla de detalles por el puesto seleccionado
  dataTableCatPuestosDetalles.id_puesto = puestoId;
  tableCatPuestosDetalles.ajax.reload();

  $("#detallesPuestoModalLabel").text(`Detalles del Puesto: ${puestoNombre}`);
  $("#detallesPuestoModal").modal("show");
});

$(document).on("click", ".btn-editar-detalles-puesto", function () {
  const puestoId = $(this).data("id");
  const puestoNombre = $(this).data("nombre");
  const objetivos = $(this).data("objetivos");
  const competencias = $(this).data("competencias");
  const banda = $(this).data("banda");

  $("#detallePuestoId").val(puestoId);
  $("#puestoNombreDetalle").val(puestoNombre);
  $("#objetivosPuesto").val(objetivos);
  $("#competenciasPuesto").val(competencias);
  $("#bandaSalarialPuesto").val(banda);

  $("#editarDetallesPuestoModal").modal("show");
});

// Cargar departamentos cuando se abre el modal
$(document).on("show.bs.modal", "#registrarPuestoModal", function () {
  cargarDepartamentosSelect();
});

// Función para cargar departamentos en el select del modal de vacantes
function cargarDepartamentosVacanteSelect() {
  $.ajax({
    url: "../../../api/recursos_humanos_api.php",
    type: "POST",
    data: { api: 6 }, // Case 6 para obtener departamentos
    success: function (response) {
      const data = JSON.parse(response);
      if (data.response && data.response.data) {
        const select = $("#departamento");
        select.empty();
        select.append('<option value="">Seleccionar departamento...</option>');

        data.response.data.forEach(function (dept) {
          if (dept.activo == 1) {
            // Solo departamentos activos
            select.append(
              `<option value="${dept.id_departamento}">${dept.descripcion}</option>`
            );
          }
        });
      }
    },
  });
}

// Función para cargar puestos en el select del modal de vacantes
function cargarPuestosVacanteSelect() {
  $.ajax({
    url: "../../../api/recursos_humanos_api.php",
    type: "POST",
    data: { api: 8 }, // Case 8 para obtener puestos
    success: function (response) {
      const data = JSON.parse(response);
      if (data.response && data.response.data) {
        const select = $("#puesto");
        select.empty();
        select.append('<option value="">Seleccionar puesto...</option>');

        data.response.data.forEach(function (puesto) {
          if (puesto.activo == 1) {
            // Solo puestos activos
            select.append(
              `<option value="${puesto.id_puesto}">${puesto.descripcion}</option>`
            );
          }
        });
      }
    },
  });
}

//Función para cargar motivos en el select del modal de vacantes
function cargarMotivosVacanteSelect() {
  $.ajax({
    url: "../../../api/recursos_humanos_api.php",
    type: "POST",
    data: { api: 12 }, // Case 12 para obtener motivos
    success: function (response) {
      const data = JSON.parse(response);
      if (data.response && data.response.data) {
        const select = $("#motivo");
        select.empty();
        select.append('<option value="">Seleccionar motivo...</option>');

        data.response.data.forEach(function (motivo) {
          if (motivo.activo == 1) {
            // Solo motivos activos
            select.append(
              `<option value="${motivo.id_motivos}">${motivo.descripcion}</option>`
            );
          }
        });
      }
    },
  });
}

// Cargar departamentos y puestos cuando se abre el modal de registrar vacante
$(document).on("show.bs.modal", "#registrarVacanteModal", function () {
  cargarDepartamentosVacanteSelect();
  cargarPuestosVacanteSelect();
  cargarMotivosVacanteSelect();
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

// ...existing code...

// Editar puesto
$(document).on("click", ".btn-editar-puesto", function () {
  var puestoId = $(this).data("id");
  var descripcion = $(this).data("descripcion");
  var departamentoId = $(this).data("departamento");
  var activo = $(this).data("activo");

  $("#registrarPuestoModalLabel").text("Editar Puesto");

  $("#puestoId").val(puestoId);
  $("#puestoDescripcion").val(descripcion);
  $("#id_departamento_puesto").val(departamentoId);
  $("#puestoActivoCheck").prop("checked", activo == 1);

  $("#registrarPuestoModal").modal("show");
});

// Resetear el modal de registrar puesto al cerrarlo
$("#registrarPuestoModal").on("hidden.bs.modal", function () {
  $("#registrarPuestoModalLabel").text("Registrar Puesto");
  $("#registrarPuestoForm")[0].reset();
  $("#puestoId").val("");
});

// Función para cargar departamentos en el select del modal de puestos
function cargarDepartamentosSelect() {
  $.ajax({
    url: "../../../api/recursos_humanos_api.php",
    type: "POST",
    data: { api: 6 }, // Case 6 para obtener departamentos
    success: function (response) {
      const data = JSON.parse(response);
      if (data.response && data.response.data) {
        const select = $("#id_departamento_puesto");

        data.response.data.forEach(function (dept) {
          if (dept.activo == 1) {
            // Solo departamentos activos
            select.append(
              `<option value="${dept.id_departamento}">${dept.descripcion}</option>`
            );
          }
        });
      }
    },
  });
}

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
