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
  autoWidth: true,
  lengthChange: false,
  info: true,
  paging: true,
  scrollY: "40vh",
  scrollCollapse: true,
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
      title: "Número Orden",
      render: function (data) {
        return data ? data : "-";
      },
    },
    {
      data: "FECHA_ORDEN",
      title: "Fecha Orden",
      render: function (data) {
        return data ? moment(data).format("DD/MM/YYYY") : "-";
      },
    },
    {
      data: "PROVEEDOR_RAZON_SOCIAL",
      title: "Proveedor",
      render: function (data) {
        return data ? data : "-";
      },
    },
    {
      data: "SUBTOTAL",
      title: "Subtotal",
      render: function (data) {
        return data ? `$${data}` : "$0.00";
      },
    },
    {
      data: "IVA",
      title: "IVA",
      render: function (data) {
        return data ? `${data}%` : "0%";
      },
    },
    {
      data: "TOTAL",
      title: "Total",
      render: function (data) {
        return data ? `$${data}` : "$0.00";
      },
    },
    {
      data: "OBSERVACIONES",
      title: "Observaciones",
      render: function (data) {
        return data ? data : "-";
      },
    },
    {
      data: "RESPONSABLE",
      title: "Responsable",
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
      data: "FECHA_ACTUALIZACION",
      title: "Fecha Actualización",
      render: function (data) {
        return data ? moment(data).format("DD/MM/YYYY") : "-";
      },
      visible: false,
    },
    {
      data: "ACTIVO",
      title: "Activo",
      render: function (data) {
        return data == 1
          ? "<i class='bi bi-check-lg text-success'></i>"
          : "<i class='bi bi-x-lg text-danger'></i>";
      },
    },
    {
      data: null,
      title: "Acciones",
      render: function (data, type, row) {
        return `
          <button class="btn btn-sm btn-warning btn-editar-orden-compra" 
            data-id="${row.ID_ORDEN_COMPRA}" 
            data-activo="1">
              <i class="bi bi-pencil"></i>
          </button>
          <button class="btn btn-sm btn-info btn-ver-orden-compra" 
            data-id="${row.ID_ORDEN_COMPRA}"
            data-activo="1">
              <i class="bi bi-eye"></i>
          </button>
          <button class="btn btn-sm btn-danger btn-eliminar-orden-compra" data-id="${row.ID_ORDEN_COMPRA}">
              <i class="bi bi-trash"></i>
          </button>
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

// ============================================
// FUNCIONES PARA ÓRDENES DE COMPRA
// ============================================

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
  var rowData = tableCatOrdenesCompra.row($(this).closest('tr')).data();
  
  if (!rowData) {
    alertToast("Error al obtener datos de la orden", "error", 3000);
    return;
  }

  // Llenar el modal con los datos
  $("#verOrdenCompraNumero").text(rowData.NUMERO_ORDEN || "-");
  $("#verOrdenCompraFecha").text(rowData.FECHA_ORDEN ? moment(rowData.FECHA_ORDEN).format("DD/MM/YYYY") : "-");
  $("#verOrdenCompraEstado").text(rowData.ESTADO || "-");
  $("#verOrdenCompraProveedor").text(rowData.PROVEEDOR_RAZON_SOCIAL || "-");
  $("#verOrdenCompraSubtotal").text(rowData.SUBTOTAL ? `$${parseFloat(rowData.SUBTOTAL).toFixed(2)}` : "$0.00");
  $("#verOrdenCompraIva").text(rowData.IVA ? `$${parseFloat(rowData.IVA).toFixed(2)}` : "$0.00");
  $("#verOrdenCompraTotal").text(rowData.TOTAL ? `$${parseFloat(rowData.TOTAL).toFixed(2)}` : "$0.00");
  $("#verOrdenCompraObservaciones").text(rowData.OBSERVACIONES || "Sin observaciones");
  $("#verOrdenCompraResponsable").text(rowData.RESPONSABLE || "-");
  $("#verOrdenCompraFechaCreacion").text(rowData.FECHA_CREACION ? moment(rowData.FECHA_CREACION).format("DD/MM/YYYY HH:mm") : "-");
  $("#verOrdenCompraFechaActualizacion").text(rowData.FECHA_ACTUALIZACION ? moment(rowData.FECHA_ACTUALIZACION).format("DD/MM/YYYY HH:mm") : "-");
  
  // Estado activo
  if (rowData.ACTIVO == 1) {
    $("#verOrdenCompraActivo").html('<span class="badge bg-success"><i class="bi bi-check-lg"></i> Activa</span>');
  } else {
    $("#verOrdenCompraActivo").html('<span class="badge bg-secondary"><i class="bi bi-x-lg"></i> Inactiva</span>');
  }

  // Mostrar el modal
  $("#verOrdenCompraModal").modal("show");
});

// Editar orden de compra
$(document).on("click", ".btn-editar-orden-compra", function () {
  var ordenCompraId = $(this).data("id");
  
  // Obtener los datos de la fila del DataTable
  var rowData = tableCatOrdenesCompra.row($(this).closest('tr')).data();
  
  if (!rowData) {
    alertToast("Error al obtener datos de la orden", "error", 3000);
    return;
  }

  // Cambiar el título del modal
  $("#registrarOrdenCompraModalLabel").text("Editar Orden de Compra");
  $("#btnGuardarOrdenCompra").html('<i class="bi bi-check-lg"></i> Actualizar Orden');

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

  // Inicializar artículos (por ahora vacío, se puede implementar después)
  if (typeof inicializarArticulosOrdenCompra !== 'undefined') {
    inicializarArticulosOrdenCompra();
  }

  // Mostrar el modal
  $("#registrarOrdenCompraModal").modal("show");
});

// Limpiar formulario cuando se cierre el modal de orden de compra
$("#registrarOrdenCompraModal").on("hidden.bs.modal", function () {
  $("#registrarOrdenCompraModalLabel").text("Registrar Orden de Compra");
  $("#btnGuardarOrdenCompra").html('<i class="bi bi-check-lg"></i> Guardar Orden');
  $("#registrarOrdenCompraForm")[0].reset();
  $("#ID_ORDEN_COMPRA").val("");
  
  // Limpiar validaciones
  $("#NUMERO_ORDEN_COMPRA").removeClass("is-valid is-invalid");
  
  // Reinicializar artículos
  if (typeof inicializarArticulosOrdenCompra !== 'undefined') {
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
