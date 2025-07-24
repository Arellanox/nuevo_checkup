// ============ BOTÓN DE REGRESO POR CADA MODULO ============ //
$(document).ready(function () {
  $(".content-module").each(function () {
    var $header = $(this).find("> .d-flex.align-items-start");
    var $title = $header.find("h2");
    if ($title.length && $header.find(".btn-back-menu").length === 0) {
      $title.before(
        '<button type="button" class="btn btn-secondary btn-back-menu px-2"><i class="bi bi-arrow-left"></i> Regresar</button>'
      );
    }
  });

  $(document).on("click", ".btn-back-menu", function () {
    $(".content-module").hide();
    $("#tab-menu").show();
  });
});

document.addEventListener("DOMContentLoaded", function () {
  document.getElementById("modulos-orden-compra").style.display = "none";
  document.getElementById("tab-menu").style.display = "";
});

document.querySelectorAll("#menu-grid a").forEach(function (link) {
  link.addEventListener("click", function (e) {
    e.preventDefault();
    document.getElementById("tab-menu").style.display = "none";
    document.getElementById("modulos-orden-compra").style.display = "";
    document.querySelectorAll(".content-module").forEach(function (mod) {
      mod.style.display = "none";
    });
    var target = link.getAttribute("data-target");
    var modulo = document.getElementById(target);
    if (modulo) {
      modulo.style.display = "";
    }
  });
});

document.addEventListener("click", function (e) {
  if (e.target.classList.contains("btn-back-menu")) {
    document.querySelectorAll(".content-module").forEach(function (mod) {
      mod.style.display = "none";
    });
    document.getElementById("modulos-orden-compra").style.display = "none";
    document.getElementById("tab-menu").style.display = "";
  }
});

// ============ DATATABLES ============ //

// DATATABLE DE ORDENES DE COMPRA
tableCatOrdenesCompra = $("#tableCatOrdenesCompra").DataTable({
  language: {
    url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json",
  },
  autoWidth: false,
  lengthChange: false,
  info: true,
  paging: true,
  scrollY: "40vh",
  responsive: false,
  scrollCollapse: true,
  columnDefs: [
    { targets: -1, responsivePriority: 1 }, // Asegura que la columna de acciones siempre esté visible
  ],
  ajax: {
    dataType: "json",
    data: function (d) {
      return $.extend(d, dataTableCatOrdenesCompra);
    },
    method: "POST",
    url: "../../../api/orden_compra_api.php",
    error: function (jqXHR, textStatus, errorThrown) {
      alertErrorAJAX(jqXHR, textStatus, errorThrown);
    },
    dataSrc: "response.data",
  },
  columns: [
    {
      data: "ID_ORDEN_COMPRA",
      title: "ID",
      render: function (data) {
        return data ? data : "-";
      },
    },
    {
      data: "NUMERO_ORDEN",
      title: "Número de Orden",
      render: function (data) {
        return data ? data : "-";
      },
    },
    {
      data: "FECHA_ORDEN",
      title: "Fecha de Orden",
      render: function (data) {
        return data ? moment(data).format("DD/MM/YYYY") : "-";
      },
    },
    {
      data: "ESTADO",
      title: "Estado",
      render: function (data) {
        if (!data) return "-";
        if (data === "pendiente") {
          return `<span class="badge bg-primary">${
            data.charAt(0).toUpperCase() + data.slice(1).toLowerCase()
          }</span>`;
        } else if (data === "borrador") {
          return `<span class="badge bg-secondary">${
            data.charAt(0).toUpperCase() + data.slice(1).toLowerCase()
          }</span>`;
        } else if (data === "aprobada") {
          return `<span class="badge bg-success">${
            data.charAt(0).toUpperCase() + data.slice(1).toLowerCase()
          }</span>`;
        } else if (data === "rechazada") {
          return `<span class="badge bg-danger">${
            data.charAt(0).toUpperCase() + data.slice(1).toLowerCase()
          }</span>`;
        } else if (data === "enviada") {
          return `<span class="badge bg-info">${
            data.charAt(0).toUpperCase() + data.slice(1).toLowerCase()
          }</span>`;
        } else {
          return `<span class="badge bg-warning">${
            data.charAt(0).toUpperCase() + data.slice(1).toLowerCase()
          }</span>`;
        }
      },
    },
    {
      data: "PROVEEDOR_RAZON_SOCIAL",
      title: "Proveedor Principal",
      render: function (data) {
        return data ? data : "-";
      },
      visible: false,
    },
    {
      data: "CANTIDAD_ARTICULOS",
      title: "# Artículos",
      render: function (data) {
        return data ? data : "0";
      },
    },
    {
      data: "PROVEEDORES_ARTICULOS",
      title: "Proveedores de Artículos",
      render: function (data) {
        if (!data || data === "") {
          return "-";
        }
        if (data.length > 40) {
          return `<span title="${data}" data-bs-toggle="tooltip">${data.substring(
            0,
            37
          )}...</span>`;
        }
        return data;
      },
    },
    {
      data: "SUBTOTAL",
      title: "Subtotal",
      render: function (data) {
        return data ? `$${parseFloat(data).toFixed(2)}` : "$0.00";
      },
      visible: false,
    },
    {
      data: "IVA",
      title: "IVA",
      render: function (data) {
        return data ? `$${parseFloat(data).toFixed(2)}` : "$0.00";
      },
      visible: false,
    },
    {
      data: "TOTAL",
      title: "Total",
      render: function (data) {
        return data ? `$${parseFloat(data).toFixed(2)}` : "$0.00";
      },
    },
    {
      data: "OBSERVACIONES",
      title: "Observaciones",
      render: function (data) {
        if (!data || data === "") {
          return "-";
        }
        if (data.length > 30) {
          return `<span title="${data}" data-bs-toggle="tooltip">${data.substring(
            0,
            27
          )}...</span>`;
        }
        return data;
      },
      visible: false,
    },
    {
      data: "USUARIO_CREACION_NOMBRE",
      title: "Creado por",
      render: function (data) {
        return data ? data : "-";
      },
    },
    {
      data: "FECHA_CREACION",
      title: "Fecha Creación",
      render: function (data) {
        return data ? moment(data).format("DD/MM/YYYY") : "-";
      },
      visible: false,
    },
    {
      data: "USUARIO_APROBACION_RECHAZO_NOMBRE",
      title: "Aprobado/Rechazado por",
      render: function (data) {
        return data ? data : "-";
      },
    },
    {
      data: "FECHA_APROBACION_RECHAZO",
      title: "Fecha Aprobación/Rechazo",
      render: function (data) {
        return data ? moment(data).format("DD/MM/YYYY HH:mm") : "-";
      },
    },
    {
      data: "OBSERVACIONES_APROBACION_RECHAZO",
      title: "Observaciones Aprobación",
      render: function (data) {
        if (!data || data === "") {
          return "-";
        }
        if (data.length > 30) {
          return `<span title="${data}" data-bs-toggle="tooltip">${data.substring(
            0,
            27
          )}...</span>`;
        }
        return data;
      },
    },
    {
      data: "FECHA_ACTUALIZACION",
      title: "Última Actualización",
      render: function (data) {
        return data ? moment(data).format("DD/MM/YYYY HH:mm") : "-";
      },
      visible: false,
    },
    {
      data: "ARTICULOS_DETALLE",
      title: "Artículos Detalle",
      render: function (data) {
        return data ? JSON.stringify(data) : "[]";
      },
      visible: false, // Columna oculta para almacenar los artículos
    },
    {
      data: null,
      title: "Acciones",
      width: "130px",
      orderable: false,
      className: "text-center acciones-columna",
      render: function (data, type, row) {
        return `
        ${
          row.ESTADO === "pendiente"
            ? `
          <button class="btn btn-sm btn-info btn-ver-orden-compra" 
            data-id="${row.ID_ORDEN_COMPRA}"
            title="Ver detalles">
              <i class="bi bi-eye"></i>
          </button>
          <button class="btn btn-sm btn-success btn-aceptar-orden-compra" 
            data-id="${row.ID_ORDEN_COMPRA}"
            title="Aceptar orden">
              <i class="bi bi-check-lg"></i>
          </button>
          <button class="btn btn-sm btn-danger btn-rechazar-orden-compra" 
            data-id="${row.ID_ORDEN_COMPRA}"
            title="Rechazar orden">
              <i class="bi bi-x-lg"></i>
          </button>
        `
            : row.ESTADO === "borrador"
            ? `
          <button class="btn btn-sm btn-info btn-ver-orden-compra" 
            data-id="${row.ID_ORDEN_COMPRA}"
            title="Ver detalles">
              <i class="bi bi-eye"></i>
          </button>
          <button class="btn btn-sm btn-warning btn-editar-orden-compra" 
            data-id="${row.ID_ORDEN_COMPRA}"
            title="Editar orden">
              <i class="bi bi-pencil"></i>
          </button>
        `
            : row.ESTADO === "aprobada" ||
              row.ESTADO === "rechazada" ||
              row.ESTADO === "enviada"
            ? `
          <button class="btn btn-sm btn-info btn-ver-orden-compra" 
            data-id="${row.ID_ORDEN_COMPRA}"
            title="Ver detalles">
              <i class="bi bi-eye"></i>
          </button>
        `
            : `
          <button class="btn btn-sm btn-info btn-ver-orden-compra" 
            data-id="${row.ID_ORDEN_COMPRA}"
            title="Ver detalles">
              <i class="bi bi-eye"></i>
          </button>
        `
        }
        `;
      },
    },
  ],
  dom: 'Bl<"dataTables_toolbar">frtip',
  buttons: [
    {
      text: '<i class="bi bi-plus-lg"></i> Nueva Orden de Compra',
      className: "btn btn-success",
      attr: {
        "data-bs-toggle": "modal",
        "data-bs-target": "#registrarOrdenCompraModal",
      },
      action: function () {
        $("#registrarOrdenCompraModal").modal("show");
      },
    },
  ],
});

// aceptar orden de compra desde tabla
$(document).on("click", ".btn-aceptar-orden-compra", function (e) {
  e.preventDefault();
  e.stopImmediatePropagation();

  let idOrdenCompra = $(this).data("id");
  console.log("Aceptar orden de compra desde tabla:", idOrdenCompra);

  if (!idOrdenCompra) {
    alertToast("ID de orden de compra no válido", "warning", 3000);
    return;
  }

  // Buscar la orden de compra en los datos de la tabla
  let ordenCompraData = null;
  if (tableCatOrdenesCompra && tableCatOrdenesCompra.data()) {
    ordenCompraData = tableCatOrdenesCompra
      .data()
      .toArray()
      .find((ord) => ord.ID_ORDEN_COMPRA == idOrdenCompra);
  }

  if (!ordenCompraData) {
    alertToast(
      "No se encontraron datos de la orden de compra",
      "warning",
      3000
    );
    return;
  }

  if (ordenCompraData.ESTADO !== "pendiente") {
    alertToast(
      "Solo se pueden aceptar ordenes de compra en estado PENDIENTE",
      "warning",
      4000
    );
    return;
  }

  alertMensajeConfirm(
    {
      title: "Aceptar Orden de Compra",
      text: `¿Está seguro de aceptar la orden de compra ${ordenCompraData.NUMERO_ORDEN}?`,
      icon: "question",
      showCancelButton: true,
      confirmButtonText: "Sí, aceptar",
      cancelButtonText: "Cancelar",
      confirmButtonColor: "#28a745",
    },
    function () {
      // Solicitar observaciones para el aceptar
      Swal.fire({
        title: "Motivo de la aceptación",
        text: "Ingrese el motivo por el cual acepta esta orden de compra:",
        input: "textarea",
        inputPlaceholder: "Escriba aquí el motivo de la aceptación...",
        showCancelButton: true,
        confirmButtonText: "Aceptar orden",
        cancelButtonText: "Cancelar",
        confirmButtonColor: "#28a745",
        inputValidator: (value) => {
          if (!value || value.trim() === "") {
            return "Debe especificar un motivo para aceptar la orden";
          }
        },
      }).then((result) => {
        if (result.isConfirmed && result.value) {
          const observaciones = result.value;
          $.ajax({
            url: "../../../api/orden_compra_api.php",
            type: "POST",
            data: {
              api: 12,
              id_orden_compra: idOrdenCompra,
              accion: "aceptar",
              observaciones: observaciones,
            },
            beforeSend: function () {
              console.log("Enviando datos:", {
                api: 12,
                id_orden_compra: idOrdenCompra,
                accion: "aceptar",
                observaciones: observaciones,
              });
            },
            success: function (response) {
              console.log("Respuesta del servidor:", response);

              let data;
              try {
                data =
                  typeof response === "string"
                    ? JSON.parse(response)
                    : response;
              } catch (e) {
                console.error("Error parseando respuesta:", e);
                alertToast("Error en la respuesta del servidor", "error", 4000);
                return;
              }

              if (data.response && data.response.code == 1) {
                console.log("Orden de compra aceptada correctamente:", data);
                alertToast(
                  data.response.message ||
                    "Orden de compra aceptada exitosamente!",
                  "success",
                  4000
                );
                if (tableCatOrdenesCompra) tableCatOrdenesCompra.ajax.reload();
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
      });
    }
  );
});

// rechazar orden de compra desde tabla
$(document).on("click", ".btn-rechazar-orden-compra", function (e) {
  e.preventDefault();
  e.stopImmediatePropagation();

  let idOrdenCompra = $(this).data("id");
  console.log("Rechazar orden de compra desde tabla:", idOrdenCompra);

  if (!idOrdenCompra) {
    alertToast("ID de orden de compra no válido", "warning", 3000);
    return;
  }

  // Buscar la orden de compra en los datos de la tabla
  let ordenCompraData = null;
  if (tableCatOrdenesCompra && tableCatOrdenesCompra.data()) {
    ordenCompraData = tableCatOrdenesCompra
      .data()
      .toArray()
      .find((ord) => ord.ID_ORDEN_COMPRA == idOrdenCompra);
  }

  if (!ordenCompraData) {
    alertToast(
      "No se encontraron datos de la orden de compra",
      "warning",
      3000
    );
    return;
  }

  if (ordenCompraData.ESTADO !== "pendiente") {
    alertToast(
      "Solo se pueden rechazar ordenes de compra en estado PENDIENTE",
      "warning",
      4000
    );
    return;
  }

  alertMensajeConfirm(
    {
      title: "Rechazar Orden de Compra",
      text: `¿Está seguro de rechazar la orden de compra ${ordenCompraData.NUMERO_ORDEN}?`,
      icon: "warning",
      showCancelButton: true,
      confirmButtonText: "Sí, rechazar",
      cancelButtonText: "Cancelar",
      confirmButtonColor: "#dc3545",
    },
    function () {
      // Solicitar observaciones para el rechazo
      Swal.fire({
        title: "Motivo del rechazo",
        text: "Ingrese el motivo por el cual rechaza esta orden de compra:",
        input: "textarea",
        inputPlaceholder: "Escriba aquí el motivo del rechazo...",
        showCancelButton: true,
        confirmButtonText: "Rechazar orden",
        cancelButtonText: "Cancelar",
        confirmButtonColor: "#dc3545",
        inputValidator: (value) => {
          if (!value || value.trim() === "") {
            return "Debe especificar un motivo para rechazar la orden";
          }
        },
      }).then((result) => {
        if (result.isConfirmed && result.value) {
          const observaciones = result.value;
          $.ajax({
            url: "../../../api/orden_compra_api.php",
            type: "POST",
            data: {
              api: 12,
              id_orden_compra: idOrdenCompra,
              accion: "rechazar",
              observaciones: observaciones,
            },
            beforeSend: function () {
              console.log("Enviando datos:", {
                api: 12,
                id_orden_compra: idOrdenCompra,
                accion: "rechazar",
                observaciones: observaciones,
              });
            },
            success: function (response) {
              console.log("Respuesta del servidor:", response);

              let data;
              try {
                data =
                  typeof response === "string"
                    ? JSON.parse(response)
                    : response;
              } catch (e) {
                console.error("Error parseando respuesta:", e);
                alertToast("Error en la respuesta del servidor", "error", 4000);
                return;
              }

              if (data.response && data.response.code == 1) {
                console.log("Orden de compra rechazada correctamente:", data);
                alertToast(
                  data.response.message ||
                    "Orden de compra rechazada exitosamente!",
                  "success",
                  4000
                );
                if (tableCatOrdenesCompra) tableCatOrdenesCompra.ajax.reload();
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
      });
    }
  );
});

// ESTILOS PARA LA BARRA DE BUSQUEDA DE ORDENES DE COMPRA
setTimeout(() => {
  inputBusquedaTable(
    "tableCatOrdenesCompra",
    tableCatOrdenesCompra,
    [
      {
        msj: "Filtre los registros por coincidencia",
        place: "top",
      },
    ],
    [],
    "col-12"
  );
  tableCatOrdenesCompra.columns.adjust().draw();

  // Inicializar tooltips para las columnas que pueden tener texto largo
  $("#tableCatOrdenesCompra").on("draw.dt", function () {
    $('[data-bs-toggle="tooltip"]').tooltip();
  });

  // CSS para evitar que los botones de acción se colapsen
  if (!document.getElementById("ordenes-compra-styles")) {
    const style = document.createElement("style");
    style.id = "ordenes-compra-styles";
    style.textContent = `
      .acciones-columna {
        white-space: nowrap !important;
        min-width: 130px !important;
      }
      
      #tableCatOrdenesCompra th:last-child,
      #tableCatOrdenesCompra td:last-child {
        min-width: 130px !important;
        width: 130px !important;
      }
      
      .acciones-columna .btn {
        margin: 0 1px;
      }
      
      /* Animación para el loading */
      .spin {
        animation: spin 1s linear infinite;
      }
      
      @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
      }
    `;
    document.head.appendChild(style);
  }
}, 1000);

// DATATABLE DE PROVEEDORES
tableCatProveedores = $("#tableCatProveedores").DataTable({
  language: {
    url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json",
  },
  autoWidth: true,
  lengthChange: false,
  info: true,
  paging: true,
  scrollY: "40vh",
  scrollCollapse: true,
  ajax: {
    dataType: "json",
    data: function (d) {
      return $.extend(d, dataTableCatProveedores);
    },
    method: "POST",
    url: "../../../api/orden_compra_api.php",
    error: function (jqXHR, textStatus, errorThrown) {
      alertErrorAJAX(jqXHR, textStatus, errorThrown);
    },
    dataSrc: "response.data",
  },
  columns: [
    { data: "id_proveedores", title: "ID" },
    { data: "nombre", title: "Nombre" },
    { data: "razon_social", title: "Razón Social" },
    { data: "rfc", title: "RFC" },
    {
      data: "constancia_situacion_fiscal",
      title: "Constancia Fiscal",
      render: function (data) {
        return data ? `<a href="${data}" target="_blank">Ver archivo</a>` : "";
      },
      visible: false,
    },
    {
      data: "caratula_bancaria",
      title: "Carátula Bancaria",
      render: function (data) {
        return data ? `<a href="${data}" target="_blank">Ver archivo</a>` : "";
      },
      visible: false,
    },
    {
      data: "comprobante_domicilio",
      title: "Comprobante Domicilio",
      render: function (data) {
        return data ? `<a href="${data}" target="_blank">Ver archivo</a>` : "";
      },
      visible: false,
    },
    {
      data: "verificacion_efo",
      title: "Verificación EFO",
      render: function (data) {
        return data == 1
          ? "<i class='bi bi-check-lg text-success'></i>"
          : "<i class='bi bi-x-lg text-danger'></i>";
      },
    },
    { data: "contacto", title: "Contacto" },
    { data: "telefono", title: "Teléfono" },
    { data: "email", title: "Email" },
    { data: "fecha_creacion", title: "Fecha Creación", visible: false },
    {
      data: "fecha_actualizacion",
      title: "Fecha Actualización",
      visible: false,
    },
    {
      data: null,
      title: "Acciones",
      render: function (data, type, row) {
        return `
          <button class="btn btn-sm btn-warning btn-editar-proveedor" 
            data-id="${row.id_proveedores}" 
            data-nombre="${row.nombre}" 
            data-razon_social="${row.razon_social}" 
            data-rfc="${row.rfc}" 
            data-constancia_situacion_fiscal="${row.constancia_situacion_fiscal}" 
            data-caratula_bancaria="${row.caratula_bancaria}" 
            data-comprobante_domicilio="${row.comprobante_domicilio}" 
            data-verificacion_efo="${row.verificacion_efo}" 
            data-contacto="${row.contacto}" 
            data-telefono="${row.telefono}" 
            data-email="${row.email}" 
            data-fecha_creacion="${row.fecha_creacion}" 
            data-fecha_actualizacion="${row.fecha_actualizacion}" 
            data-activo="1">
              <i class="bi bi-pencil"></i>
          </button>
          <button class="btn btn-sm btn-info btn-ver-proveedor" 
            data-id="${row.id_proveedores}"
            data-nombre="${row.nombre}"
            data-razon_social="${row.razon_social}"
            data-rfc="${row.rfc}"
            data-constancia_situacion_fiscal="${row.constancia_situacion_fiscal}"
            data-caratula_bancaria="${row.caratula_bancaria}"
            data-comprobante_domicilio="${row.comprobante_domicilio}"
            data-verificacion_efo="${row.verificacion_efo}"
            data-contacto="${row.contacto}"
            data-telefono="${row.telefono}"
            data-email="${row.email}"
            data-fecha_creacion="${row.fecha_creacion}"
            data-fecha_actualizacion="${row.fecha_actualizacion}"
            data-activo="1">
              <i class="bi bi-eye"></i>
          </button>
          <button class="btn btn-sm btn-danger btn-eliminar-proveedor" data-id="${row.id_proveedores}">
              <i class="bi bi-trash"></i>
          </button>
        `;
      },
    },
  ],
  dom: 'Bl<"dataTables_toolbar">frtip',
  buttons: [
    {
      text: '<i class="bi bi-plus-lg"></i> Nuevo Proveedor',
      className: "btn btn-success",
      attr: {
        "data-bs-toggle": "modal",
        "data-bs-target": "#registrarProveedorModal",
      },
      action: function () {
        $("#registrarProveedorModal").modal("show");
      },
    },
    {
      text: '<i class="bi bi-funnel"></i> Filtrar Proveedores',
      className: "btn btn-warning",
      attr: {
        "data-bs-toggle": "modal",
        "data-bs-target": "#filtrarProveedoresModal",
      },
      action: function () {
        $("#filtrarProveedoresModal").modal("show");
      },
    },
  ],
});

// ESTILOS PARA LA BARRA DE BUSQUEDA DE PROVEEDORES
setTimeout(() => {
  inputBusquedaTable(
    "tableCatProveedores",
    tableCatProveedores,
    [
      {
        msj: "Filtre los registros por coincidencia",
        place: "top",
      },
    ],
    [],
    "col-12"
  );
  tableCatProveedores.columns.adjust().draw();
}, 1000);

// ============ FUNCIONALIDADES DE BOTONES POR DATATABLE ============ //

// Editar proveedor
$(document).on("click", ".btn-editar-proveedor", function () {
  var proveedorId = $(this).data("id");
  var nombre = $(this).data("nombre");
  var razonSocial = $(this).data("razon_social");
  var rfc = $(this).data("rfc");
  var constanciaFiscal = $(this).data("constancia_situacion_fiscal");
  var caratulaBancaria = $(this).data("caratula_bancaria");
  var comprobanteDomicilio = $(this).data("comprobante_domicilio");
  var verificacionEfo = $(this).data("verificacion_efo");
  var contacto = $(this).data("contacto");
  var telefono = $(this).data("telefono");
  var email = $(this).data("email");
  var activo = $(this).data("activo");

  // Cambiar el título del modal
  $("#registrarProveedorModalLabel").text("Editar Proveedor");

  // Llenar el formulario con los datos
  $("#proveedorId").val(proveedorId);
  $("#proveedorNombre").val(nombre);
  $("#proveedorRazonSocial").val(razonSocial);
  $("#proveedorRfc").val(rfc);
  // Los campos de archivo no se pueden llenar por seguridad del navegador, pero puedes mostrar el nombre del archivo si quieres
  if (constanciaFiscal) {
    $("#proveedorConstanciaFiscal")
      .siblings(".form-text")
      .text("Archivo actual: " + constanciaFiscal);
  } else {
    $("#proveedorConstanciaFiscal")
      .siblings(".form-text")
      .text("Formatos: PDF, JPG, PNG");
  }
  if (caratulaBancaria) {
    $("#proveedorCaratulaBancaria")
      .siblings(".form-text")
      .text("Archivo actual: " + caratulaBancaria);
  } else {
    $("#proveedorCaratulaBancaria")
      .siblings(".form-text")
      .text("Formatos: PDF, JPG, PNG");
  }
  if (comprobanteDomicilio) {
    $("#proveedorComprobanteDomicilio")
      .siblings(".form-text")
      .text("Archivo actual: " + comprobanteDomicilio);
  } else {
    $("#proveedorComprobanteDomicilio")
      .siblings(".form-text")
      .text("Formatos: PDF, JPG, PNG");
  }
  $("#proveedorVerificacionEfo").prop("checked", verificacionEfo == 1);
  $("#proveedorContacto").val(contacto);
  $("#proveedorTelefono").val(telefono);
  $("#proveedorEmail").val(email);
  $("#proveedorActivoCheck").prop("checked", activo == 1);

  // Mostrar el modal
  $("#registrarProveedorModal").modal("show");
});

// Limpiar formulario cuando se cierra el modal de proveedor
$("#registrarProveedorModal").on("hidden.bs.modal", function () {
  $("#registrarProveedorModalLabel").text("Registrar Proveedor");
  $("#registrarProveedorForm")[0].reset();
  $("#proveedorId").val("");
});

// Eliminar proveedor
$(document).on("click", ".btn-eliminar-proveedor", function () {
  var proveedorId = $(this).data("id");
  var activo = $(this).data("activo");

  alertMensajeConfirm(
    {
      title: "¿Está a punto de eliminar este proveedor?",
      text: "Asegúrate que la acción sea correcta.",
      icon: "warning",
    },
    function () {
      $.ajax({
        url: "../../../api/orden_compra_api.php",
        type: "POST",
        data: {
          api: 4,
          id_proveedores: proveedorId,
          activo: 0,
        },
        beforeSend: function () {
          console.log("Enviando datos:", {
            api: 4,
            id_proveedores: proveedorId,
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
            console.log("Proveedor eliminado correctamente:", data);
            alertToast("Proveedor eliminado!", "success", 4000);
            if (tableCatProveedores) tableCatProveedores.ajax.reload();
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

// Ver proveedor
$(document).on("click", ".btn-ver-proveedor", function () {
  var proveedorId = $(this).data("id");
  var nombre = $(this).data("nombre");
  var razonSocial = $(this).data("razon_social");
  var rfc = $(this).data("rfc");
  var constanciaFiscal = $(this).data("constancia_situacion_fiscal");
  var caratulaBancaria = $(this).data("caratula_bancaria");
  var comprobanteDomicilio = $(this).data("comprobante_domicilio");
  var verificacionEfo = $(this).data("verificacion_efo");
  var contacto = $(this).data("contacto");
  var telefono = $(this).data("telefono");
  var email = $(this).data("email");
  var fechaCreacion = $(this).data("fecha_creacion");
  var fechaActualizacion = $(this).data("fecha_actualizacion");
  var activo = $(this).data("activo");

  // Mostrar el modal
  $("#verProveedorModal").modal("show");
});

// Eliminar orden de compra
$(document).on("click", ".btn-eliminar-orden-compra", function () {
  var ordenCompraId = $(this).data("id");

  alertMensajeConfirm(
    {
      title: "¿Está a punto de eliminar esta orden de compra?",
      text: "La orden será marcada como inactiva. Esta acción se puede revertir.",
      icon: "warning",
    },
    function () {
      $.ajax({
        url: "../../../api/orden_compra_api.php",
        type: "POST",
        data: {
          api: 11,
          id_orden_compra: ordenCompraId,
        },
        beforeSend: function () {
          console.log("Enviando datos:", {
            api: 11,
            id_orden_compra: ordenCompraId,
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
            console.log("Orden de compra eliminada correctamente:", data);
            alertToast("Orden de compra eliminada!", "success", 4000);
            if (tableCatOrdenesCompra) tableCatOrdenesCompra.ajax.reload();
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

// Ver orden de compra
$(document).on("click", ".btn-ver-orden-compra", function () {
  var ordenCompraId = $(this).data("id");

  // Obtener los datos de la fila del DataTable
  var rowData = tableCatOrdenesCompra.row($(this).closest("tr")).data();

  if (!rowData) {
    alertToast("Error al obtener datos de la orden", "error", 3000);
    return;
  }

  // Llenar el modal con los datos
  $("#verOrdenCompraNumero").text(rowData.NUMERO_ORDEN || "-");
  $("#verOrdenCompraFecha").text(
    rowData.FECHA_ORDEN ? moment(rowData.FECHA_ORDEN).format("DD/MM/YYYY") : "-"
  );

  // Estado con formato mejorado
  let estadoHtml = "";
  if (rowData.ESTADO === "pendiente") {
    estadoHtml = `<span class="badge bg-primary fs-6"><i class="bi bi-clock"></i> ${
      rowData.ESTADO.charAt(0).toUpperCase() + rowData.ESTADO.slice(1)
    }</span>`;
  } else if (rowData.ESTADO === "borrador") {
    estadoHtml = `<span class="badge bg-secondary fs-6"><i class="bi bi-pencil"></i> ${
      rowData.ESTADO.charAt(0).toUpperCase() + rowData.ESTADO.slice(1)
    }</span>`;
  } else if (rowData.ESTADO === "aprobada") {
    estadoHtml = `<span class="badge bg-success fs-6"><i class="bi bi-check-lg"></i> Aceptada</span>`;
  } else if (rowData.ESTADO === "rechazada") {
    estadoHtml = `<span class="badge bg-danger fs-6"><i class="bi bi-x-lg"></i> Rechazada</span>`;
  } else if (rowData.ESTADO === "enviada") {
    estadoHtml = `<span class="badge bg-info fs-6"><i class="bi bi-send"></i> ${
      rowData.ESTADO.charAt(0).toUpperCase() + rowData.ESTADO.slice(1)
    }</span>`;
  } else {
    estadoHtml = `<span class="badge bg-warning fs-6">${
      rowData.ESTADO || "-"
    }</span>`;
  }
  $("#verOrdenCompraEstado").html(estadoHtml);

  $("#verOrdenCompraProveedor").text(rowData.PROVEEDOR_RAZON_SOCIAL || "-");

  // Información de artículos y proveedores
  $("#verOrdenCompraCantidadArticulos").text(rowData.CANTIDAD_ARTICULOS || "0");
  $("#verOrdenCompraCantidadProveedoresArticulos").text(
    rowData.CANTIDAD_PROVEEDORES_ARTICULOS || "0"
  );
  $("#verOrdenCompraProveedoresArticulos").text(
    rowData.PROVEEDORES_ARTICULOS || "Sin proveedores de artículos"
  );

  // Información financiera
  $("#verOrdenCompraSubtotal").text(
    rowData.SUBTOTAL ? `$${parseFloat(rowData.SUBTOTAL).toFixed(2)}` : "$0.00"
  );
  $("#verOrdenCompraIva").text(
    rowData.IVA ? `$${parseFloat(rowData.IVA).toFixed(2)}` : "$0.00"
  );
  $("#verOrdenCompraTotal").text(
    rowData.TOTAL ? `$${parseFloat(rowData.TOTAL).toFixed(2)}` : "$0.00"
  );

  // Observaciones
  $("#verOrdenCompraObservaciones").text(
    rowData.OBSERVACIONES || "Sin observaciones"
  );
  $("#verOrdenCompraObservacionesAprobacion").text(
    rowData.OBSERVACIONES_APROBACION_RECHAZO || "Sin observaciones"
  );

  // Personal involucrado
  $("#verOrdenCompraResponsable").text(rowData.USUARIO_CREACION_NOMBRE || "-");
  $("#verOrdenCompraResponsableTimeLine").text(
    rowData.USUARIO_CREACION_NOMBRE || "-"
  );
  $("#verOrdenCompraUsuarioAprobacion").text(
    rowData.USUARIO_APROBACION_RECHAZO_NOMBRE || "-"
  );
  $("#verOrdenCompraFechaAprobacion").text(
    rowData.FECHA_APROBACION_RECHAZO
      ? moment(rowData.FECHA_APROBACION_RECHAZO).format("DD/MM/YYYY HH:mm")
      : "-"
  );
  $("#verOrdenCompraFechaAprobacion").text(
    rowData.FECHA_APROBACION_RECHAZO
      ? moment(rowData.FECHA_APROBACION_RECHAZO).format("DD/MM/YYYY HH:mm")
      : "-"
  );
  $("#verOrdenCompraUsuarioAprobacion").text(
    rowData.USUARIO_APROBACION_RECHAZO_NOMBRE || "-"
  );

  // Estado activo
  if (rowData.ACTIVO == 1) {
    $("#verOrdenCompraActivo").html(
      '<span class="badge bg-success fs-6"><i class="bi bi-check-lg"></i> Activa</span>'
    );
  } else {
    $("#verOrdenCompraActivo").html(
      '<span class="badge bg-secondary fs-6"><i class="bi bi-x-lg"></i> Inactiva</span>'
    );
  }

  // Historial de fechas
  $("#verOrdenCompraFechaCreacion").text(
    rowData.FECHA_CREACION
      ? moment(rowData.FECHA_CREACION).format("DD/MM/YYYY HH:mm")
      : "-"
  );
  $("#verOrdenCompraFechaActualizacion").text(
    rowData.FECHA_ACTUALIZACION
      ? moment(rowData.FECHA_ACTUALIZACION).format("DD/MM/YYYY HH:mm")
      : "-"
  );

  // Cargar y mostrar artículos mediante API
  cargarArticulosOrdenCompra(ordenCompraId);

  // Mostrar el modal
  $("#verOrdenCompraModal").modal("show");
});

// Editar orden de compra
$(document).on("click", ".btn-editar-orden-compra", function () {
  var ordenCompraId = $(this).data("id");

  // Obtener los datos de la fila del DataTable
  var rowData = tableCatOrdenesCompra.row($(this).closest("tr")).data();

  if (!rowData) {
    alertToast("Error al obtener datos de la orden", "error", 3000);
    return;
  }

  // Cambiar el título del modal
  $("#registrarOrdenCompraModalLabel").text("Editar Orden de Compra");
  $("#btnGuardarOrdenCompra").html(
    '<i class="bi bi-check-lg"></i> Actualizar Orden'
  );

  // Llenar el formulario con los datos existentes
  $("#ID_ORDEN_COMPRA").val(ordenCompraId);
  $("#NUMERO_ORDEN_COMPRA").val(rowData.NUMERO_ORDEN || "");
  $("#FECHA_ORDEN_COMPRA").val(rowData.FECHA_ORDEN || "");
  $("#ESTADO").val(rowData.ESTADO || "");
  $("#SUBTOTAL").val(rowData.SUBTOTAL || "0.00");
  $("#IVA").val(rowData.IVA || "0.00");
  $("#TOTAL").val(rowData.TOTAL || "0.00");
  $("#OBSERVACIONES").val(rowData.OBSERVACIONES || "");
  $("#ACTIVO").prop("checked", rowData.ACTIVO == 1);

  // Limpiar validaciones previas
  $("#NUMERO_ORDEN_COMPRA").removeClass("is-valid is-invalid");

  // Cargar los artículos existentes para edición
  cargarArticulosParaEdicion(ordenCompraId);

  // Mostrar el modal
  $("#registrarOrdenCompraModal").modal("show");
});

// Limpiar formulario cuando se cierre el modal de orden de compra
$("#registrarOrdenCompraModal").on("hidden.bs.modal", function () {
  $("#registrarOrdenCompraModalLabel").text("Registrar Orden de Compra");
  $("#btnGuardarOrdenCompra").html(
    '<i class="bi bi-check-lg"></i> Guardar Orden'
  );
  $("#registrarOrdenCompraForm")[0].reset();
  $("#ID_ORDEN_COMPRA").val("");

  // Limpiar validaciones
  $("#NUMERO_ORDEN_COMPRA").removeClass("is-valid is-invalid");

  // Limpiar artículos cargados para edición
  window.articulosOrdenCompraEditando = null;

  // Limpiar resumen de artículos si existe
  if ($("#articulosResumenEdicion").length) {
    $("#articulosResumenEdicion").html("");
  }

  // Reinicializar artículos
  if (typeof inicializarArticulosOrdenCompra !== "undefined") {
    inicializarArticulosOrdenCompra();
  }
});

// ==================== FUNCIONALIDADES PARA CARGAR CATÁLOGOS ====================
function cargarCatalogoEnSelect(selectorSelect, opciones, callback) {
  const config = {
    soloActivos: true,
    ...opciones,
  };

  $.ajax({
    url: "../../../api/orden_compra_api.php",
    type: "POST",
    dataType: "json",
    data: { api: config.api },

    success: function (response) {
      if (response.response && response.response.code == 1) {
        const selectElement = $(selectorSelect);
        const valorActual = selectElement.val();

        selectElement
          .empty()
          .append(`<option value="">${config.placeholder}</option>`);

        let totalElementos = 0;
        response.response.data.forEach(function (item) {
          const esActivo = item.activo == 1 || item.ACTIVO == 1;
          if (!config.soloActivos || esActivo) {
            selectElement.append(
              `<option value="${item[config.campoId]}">${
                item[config.campoTexto]
              }</option>`
            );
            totalElementos++;
          }
        });

        if (valorActual) selectElement.val(valorActual);

        console.log(
          `✅ Catálogo cargado: ${totalElementos} elementos en ${selectorSelect}`
        );

        if (callback && typeof callback === "function") callback();
      } else {
        alertToast(`Error al cargar ${config.placeholder}`, "error", 3000);
        console.error("Error en respuesta API:", response);
      }
    },

    error: function (xhr, status, error) {
      alertToast(
        `Error de conexión al cargar ${config.placeholder}`,
        "error",
        3000
      );
      console.error("Error AJAX:", { xhr, status, error });
    },
  });
}
function cargarProveedoresOrdenCompra() {
  cargarCatalogoEnSelect("#registrarOrdenCompraModal #ID_PROVEEDOR", {
    api: 2,
    campoId: "id_proveedores",
    campoTexto: "nombre",
    placeholder: "Seleccione un proveedor",
    soloActivos: true,
  });
}
cargarProveedoresOrdenCompra();

// ==================== FUNCIÓN PARA CARGAR ARTÍCULOS DE LA ORDEN ====================
function cargarArticulosOrdenCompra(idOrdenCompra) {
  if (!idOrdenCompra) {
    $("#verOrdenCompraArticulos").html(
      '<span class="badge bg-light text-dark">Sin artículos</span>'
    );
    return;
  }

  // Mostrar loading
  $("#verOrdenCompraArticulos").html(
    '<span class="badge bg-secondary"><i class="bi bi-arrow-repeat spin"></i> Cargando...</span>'
  );

  $.ajax({
    url: "../../../api/orden_compra_api.php",
    type: "POST",
    dataType: "json",
    data: {
      api: 13,
      id_orden_compra: idOrdenCompra,
    },
    success: function (response) {
      console.log("Artículos de orden de compra:", response);

      if (
        response.response &&
        response.response.code == 1 &&
        response.response.data
      ) {
        const articulos = response.response.data;

        if (articulos.length > 0) {
          let articulosHtml = "";
          let proveedoresSet = new Set();

          articulos.forEach(function (articulo) {
            // Agregar badge por cada artículo
            articulosHtml += `
              <span class="badge bg-primary me-1 mb-1" title="Cantidad: ${
                articulo.cantidad_solicitada || 0
              } | Precio: $${parseFloat(articulo.PRECIO_UNITARIO || 0).toFixed(
              2
            )}">
                <i class="bi bi-box me-1"></i>${
                  articulo.DESCRIPCION_ARTICULO ||
                  articulo.CODIGO_ARTICULO ||
                  "Artículo"
                }
              </span>
            `;

            // Recopilar proveedores únicos
            if (articulo.PROVEEDOR_NOMBRE) {
              proveedoresSet.add(articulo.PROVEEDOR_NOMBRE);
            }
          });

          // Mostrar artículos
          $("#verOrdenCompraArticulos").html(articulosHtml);

          // Mostrar proveedores únicos
          if (proveedoresSet.size > 0) {
            let proveedoresHtml = "";
            proveedoresSet.forEach(function (proveedor) {
              proveedoresHtml += `<span class="badge bg-info me-1 mb-1"><i class="bi bi-building me-1"></i>${proveedor}</span>`;
            });
            $("#verOrdenCompraProveedoresArticulos").html(proveedoresHtml);
          } else {
            $("#verOrdenCompraProveedoresArticulos").html(
              '<span class="badge bg-light text-dark">Sin proveedores definidos</span>'
            );
          }
        } else {
          $("#verOrdenCompraArticulos").html(
            '<span class="badge bg-light text-dark">Sin artículos</span>'
          );
          $("#verOrdenCompraProveedoresArticulos").html(
            '<span class="badge bg-light text-dark">Sin proveedores</span>'
          );
        }
      } else {
        $("#verOrdenCompraArticulos").html(
          '<span class="badge bg-warning text-dark">Error al cargar artículos</span>'
        );
        $("#verOrdenCompraProveedoresArticulos").html(
          '<span class="badge bg-warning text-dark">Error al cargar proveedores</span>'
        );
      }
    },
    error: function (xhr, status, error) {
      console.error("Error cargando artículos:", error);
      $("#verOrdenCompraArticulos").html(
        '<span class="badge bg-danger">Error de conexión</span>'
      );
      $("#verOrdenCompraProveedoresArticulos").html(
        '<span class="badge bg-danger">Error de conexión</span>'
      );
    },
  });
}

// ==================== FUNCIÓN PARA CARGAR ARTÍCULOS PARA EDICIÓN ====================
function cargarArticulosParaEdicion(idOrdenCompra) {
  if (!idOrdenCompra) {
    console.log("No hay ID de orden de compra para cargar artículos");
    // Inicializar formulario vacío si no hay función específica
    if (typeof inicializarArticulosOrdenCompra !== "undefined") {
      inicializarArticulosOrdenCompra();
    }
    return;
  }

  console.log("Cargando artículos para edición de orden:", idOrdenCompra);

  $.ajax({
    url: "../../../api/orden_compra_api.php",
    type: "POST",
    dataType: "json",
    data: {
      api: 13,
      id_orden_compra: idOrdenCompra,
    },
    success: function (response) {
      console.log("Artículos cargados para edición:", response);

      if (
        response.response &&
        response.response.code == 1 &&
        response.response.data
      ) {
        const articulos = response.response.data;

        // Aquí puedes implementar la lógica específica para poblar el formulario de edición
        // Por ejemplo, si tienes una tabla de artículos en el modal de edición:

        if (typeof poblarTablaArticulosEdicion === "function") {
          // Si existe una función específica para poblar la tabla de edición
          poblarTablaArticulosEdicion(articulos);
        } else {
          // Implementación básica - mostrar información en consola
          console.log(
            `✅ ${articulos.length} artículos cargados para edición:`,
            articulos
          );

          // Mostrar un resumen en el formulario (opcional)
          if ($("#articulosResumenEdicion").length) {
            let resumenHtml = `<small class="text-muted">Cargados ${articulos.length} artículos existentes</small>`;
            $("#articulosResumenEdicion").html(resumenHtml);
          }

          // Almacenar los artículos en una variable global para uso posterior
          window.articulosOrdenCompraEditando = articulos;
        }
      } else {
        console.log("No se encontraron artículos para esta orden");
        alertToast("No se encontraron artículos para esta orden", "info", 3000);

        // Inicializar formulario vacío
        if (typeof inicializarArticulosOrdenCompra !== "undefined") {
          inicializarArticulosOrdenCompra();
        }
      }
    },
    error: function (xhr, status, error) {
      console.error("Error cargando artículos para edición:", error);
      alertToast("Error al cargar artículos existentes", "error", 3000);

      // Inicializar formulario vacío en caso de error
      if (typeof inicializarArticulosOrdenCompra !== "undefined") {
        inicializarArticulosOrdenCompra();
      }
    },
  });
}
