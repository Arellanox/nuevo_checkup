// Registrar una articulo
$("#registrarArticuloForm").submit(function (event) {
  event.preventDefault();

  var form = document.getElementById("registrarArticuloForm");
  var formData = new FormData(form);

  var activo;

  if ($("#regitrarArticuloForm #estatus").is(":checked")) {
    activo = 1;
  } else {
    activo = 0;
  }

  alertMensajeConfirm(
    {
      title: "¿Está a punto de registrar un artículo?",
      text: "Seleccione una opción.",
      icon: "warning",
    },
    function () {
      ajaxAwaitFormData(
        { api: 1, estatus: activo, id_proveedores: 3 },
        "inventarios_api",
        "registrarArticuloForm",
        { callbackAfter: true },
        false,
        function (data) {
          if (data.response.code == 1) {
            $("#registrarArticuloForm")[0].reset();
            $("#registrarArticuloModal").modal("hide");
            alertToast("Artículo registrado", "success", 4000);
            tableCatArticulos.ajax.reload();
            tableCatEntradas.ajax.reload();
          }
        }
      );
    },
    1
  );

  return false;
});

// editar un articulo
$("#editarArticuloForm").submit(function (event) {
  event.preventDefault();
  var form = document.getElementById("editarArticuloForm");
  var formData = new FormData(form);

  var activo;

  if ($("#editarArticuloForm #estatus").is(":checked")) {
    activo = 1;
  } else {
    activo = 0;
  }

  alertMensajeConfirm(
    {
      title: "¿Está a punto de editar este artículo?",
      text: "Asegúrate que los datos sean correctos.",
      icon: "warning",
    },
    function () {
      ajaxAwaitFormData(
        {
          api: 1,
          id_articulo: rowSelected.ID_ARTICULO,
        },
        "inventarios_api",
        "editarArticuloForm",
        { callbackAfter: true },
        false,
        function (data) {
          if (data.response.code == 1) {
            $("#editarArticuloForm")[0].reset();
            $("#editarArticuloModal").modal("hide");
            alertToast("Artículo actualizado!", "success", 4000);
            tableCatArticulos.ajax.reload();
            tableCatEntradas.ajax.reload();
          }
        }
      );
    }
  );
});

// registrar una entrada
$("#registrarEntradaForm").submit(function (event) {
  event.preventDefault();
  var form = document.getElementById("registrarEntradaForm");
  var formData = new FormData(form);

  var activo;

  if ($("#registrarEntradaForm #estatus").is(":checked")) {
    activo = 1;
  } else {
    activo = 0;
  }

  alertMensajeConfirm(
    {
      title: "¿Está a punto de registrar este movimiento?",
      text: "Asegúrate que los datos sean correctos.",
      icon: "warning",
    },
    function () {
      ajaxAwaitFormData(
        {
          api: 6,
          id_articulo: rowSelected.ID_ARTICULO,
        },
        "inventarios_api",
        "registrarEntradaForm",
        { callbackAfter: true },
        false,
        function (data) {
          if (data.response.code == 1) {
            $("#registrarEntradaForm")[0].reset();
            $("#registrarEntradaModal").modal("hide");
            alertToast("Artículo actualizado!", "success", 4000);
            tableCatEntradas.ajax.reload();
            tableCatArticulos.ajax.reload();
            tableCatDetallesEntradas.ajax.reload();
            tableCatTransacciones.ajax.reload();
            $("#cantidad").closest(".mb-3").hide();
            $("#fecha_ultima_entrada").closest(".mb-3").hide();
            $("#costo_ultima_entrada").closest(".mb-3").hide();
            $("#proveedorDiv").hide();
            $("#cantidad").prop("required", false);
            $("#fecha_ultima_entrada").prop("required", false);
            $("#costo_ultima_entrada").prop("required", false);
            $("#id_proveedores").prop("required", false);
            $("#facturaDiv").hide();
            $("#img_factura").prop("required", false);
            $("#motivoSalidaDiv").hide();
            $("#motivoSalidaDiv").prop("required", false);
            $("#registrarMovimientoButton")
              .html('<i class="bi bi-pencil-square"></i> Registrar movimiento')
              .hide();
            $("#modalTitleRegistrarEntrada").html(
              "Registrando movimiento de <strong><span id='registrandoEntrada'>" +
                ($("#registrandoEntrada").text() || "") +
                "</span></strong>"
            );
          }
        }
      );
    }
  );
});

//Editar una entrada
$("#editarMovimientoForm").submit(function (event) {
  event.preventDefault();
  var form = document.getElementById("editarMovimientoForm");
  var formData = new FormData(form);

  var activo;

  if ($("#editarMovimientoForm #estatus").is(":checked")) {
    activo = 1;
  } else {
    activo = 0;
  }

  alertMensajeConfirm(
    {
      title: "¿Está a punto de editar este movimiento?",
      text: "Asegúrate que los datos sean correctos.",
      icon: "warning",
    },
    function () {
      ajaxAwaitFormData(
        {
          api: 6,
          id_articulo: rowSelected.ID_ARTICULO,
          id_cat_movimientos: rowSelected.id_cat_movimientos,
          fecha_ultima_entrada: $("#fecha_ultima_entrada").val(),
          id_movimiento:
            rowSelected.id_movimiento == 1
              ? 4
              : rowSelected.id_movimiento == 2
              ? 5
              : rowSelected.id_movimiento,
        },
        "inventarios_api",
        "editarMovimientoForm",
        { callbackAfter: true },
        false,
        function (data) {
          if (data.response.code == 1) {
            $("#editarMovimientoForm")[0].reset();
            $("#editarMovimientoModal").modal("hide");
            alertToast("Movimiento actualizado!", "success", 4000);
            tableCatArticulos.ajax.reload();
            tableCatEntradas.ajax.reload();
            tableCatDetallesEntradas.ajax.reload();
            tableCatTransacciones.ajax.reload();
          }
        }
      );
    }
  );
});

// Registrar/Editar Tipo
$("#registrarTipoForm").submit(function (event) {
  event.preventDefault();

  var form = document.getElementById("registrarTipoForm");
  var formData = new FormData(form);

  $("#tipoDescripcion").removeClass("is-invalid");

  // Obtener el valor del checkbox de activo
  var activo;
  if ($("#registrarTipoForm #tipoActivoCheck").is(":checked")) {
    activo = 1;
  } else {
    activo = 0;
  }

  console.log("Activo tipo:", activo);

  let esEdicion = tipoId && tipoId !== "";

  alertMensajeConfirm(
    {
      title: esEdicion
        ? "¿Está a punto de editar este tipo?"
        : "¿Está a punto de registrar un nuevo tipo?",
      text: "Asegúrate que los datos sean correctos.",
      icon: "warning",
    },
    function () {
      ajaxAwaitFormData(
        {
          api: 10,
          activo: activo,
        },
        "inventarios_api",
        "registrarTipoForm",
        { callbackAfter: true },
        false,
        function (data) {
          if (data.response.code == 1) {
            $("#registrarTipoForm")[0].reset();
            $("#registrarTipoModal").modal("hide");
            alertToast(
              esEdicion ? "Tipo actualizado!" : "Tipo registrado!",
              "success",
              4000
            );
            if (tableCatTipos) tableCatTipos.ajax.reload();
          } else {
            alertToast(
              data.response.message || "Error al procesar la solicitud",
              "error",
              4000
            );
          }
        }
      );
    }
  );

  return false;
});

// Registrar/Editar Unidad
$("#registrarUnidadForm").submit(function (event) {
  event.preventDefault();

  var form = document.getElementById("registrarUnidadForm");
  var formData = new FormData(form);

  $("#unidadDescripcion").removeClass("is-invalid");

  // Obtener el valor del checkbox de activo
  var activo;
  if ($("#registrarUnidadForm #unidadActivoCheck").is(":checked")) {
    activo = 1;
  } else {
    activo = 0;
  }

  let esEdicion = tipoId && tipoId !== "";

  alertMensajeConfirm(
    {
      title: esEdicion
        ? "¿Está a punto de editar esta unidad?"
        : "¿Está a punto de registrar una nueva unidad?",
      text: "Asegúrate que los datos sean correctos.",
      icon: "warning",
    },
    function () {
      ajaxAwaitFormData(
        {
          api: 13,
          activo: activo,
        },
        "inventarios_api",
        "registrarUnidadForm",
        { callbackAfter: true },
        false,
        function (data) {
          if (data.response.code == 1) {
            $("#registrarUnidadForm")[0].reset();
            $("#registrarUnidadModal").modal("hide");
            alertToast(
              esEdicion ? "Unidad actualizada!" : "Unidad registrada!",
              "success",
              4000
            );
            if (tableCatUnidades) tableCatUnidades.ajax.reload();
          } else {
            alertToast(
              data.response.message || "Error al procesar la solicitud",
              "error",
              4000
            );
          }
        }
      );
    }
  );

  return false;
});

// Registrar/Editar Marca
$("#registrarMarcaForm").submit(function (event) {
  event.preventDefault();

  var form = document.getElementById("registrarMarcaForm");
  var formData = new FormData(form);

  $("#marcaDescripcion").removeClass("is-invalid");

  // Obtener el valor del checkbox de activo
  var activo;
  if ($("#registrarMarcaForm #marcaActivoCheck").is(":checked")) {
    activo = 1;
  } else {
    activo = 0;
  }

  console.log("Activo marca:", activo);

  let esEdicion = tipoId && tipoId !== "";

  alertMensajeConfirm(
    {
      title: esEdicion
        ? "¿Está a punto de editar esta marca?"
        : "¿Está a punto de registrar una nueva marca?",
      text: "Asegúrate que los datos sean correctos.",
      icon: "warning",
    },
    function () {
      ajaxAwaitFormData(
        {
          api: 11,
          activo: activo,
        },
        "inventarios_api",
        "registrarMarcaForm",
        { callbackAfter: true },
        false,
        function (data) {
          if (data.response.code == 1) {
            $("#registrarMarcaForm")[0].reset();
            $("#registrarMarcaModal").modal("hide");
            alertToast(
              esEdicion ? "Marca actualizada!" : "Marca registrada!",
              "success",
              4000
            );

            if (tableCatMarcas) tableCatMarcas.ajax.reload();
          } else {
            alertToast(
              data.response.message || "Error al procesar la solicitud",
              "error",
              4000
            );
          }
        }
      );
    }
  );

  return false;
});

// Registrar/Editar Motivo
$("#registrarMotivoForm").submit(function (event) {
  event.preventDefault();

  var form = document.getElementById("registrarMotivoForm");
  var formData = new FormData(form);

  $("#motivoDescripcion").removeClass("is-invalid");

  // Obtener el valor del checkbox de activo
  var activo;
  if ($("#registrarMotivoForm #motivoActivoCheck").is(":checked")) {
    activo = 1;
  } else {
    activo = 0;
  }
  var tipoMovimiento = $("#registrarMotivoForm #motivoTipoMovimiento").val();
  console.log("Tipo de movimiento:", tipoMovimiento);

  let esEdicion = tipoId && tipoId !== "";

  alertMensajeConfirm(
    {
      title: esEdicion
        ? "¿Está a punto de editar este motivo"
        : "¿Está a punto de registrar un nuevo motivo?",
      text: "Asegúrate que los datos sean correctos.",
      icon: "warning",
    },
    function () {
      ajaxAwaitFormData(
        {
          api: 14,
          activo: activo,
          tipo_movimiento: tipoMovimiento,
        },
        "inventarios_api",
        "registrarMotivoForm",
        { callbackAfter: true },
        false,
        function (data) {
          if (data.response.code == 1) {
            $("#registrarMotivoForm")[0].reset();
            $("#registrarMotivoModal").modal("hide");
            alertToast(
              esEdicion ? "Motivo actualizado!" : "Motivo registrado!",
              "success",
              4000
            );

            if (tableCatMotivos) tableCatMotivos.ajax.reload();
          } else {
            alertToast(
              data.response.message || "Error al procesar la solicitud",
              "error",
              4000
            );
          }
        }
      );
    }
  );
  return false;
});

// Registrar/Editar Proveedor
$("#registrarProveedorForm").submit(function (event) {
  event.preventDefault();

  var form = document.getElementById("registrarProveedorForm");
  var formData = new FormData(form);

  let proveedorId = $("#proveedorId").val();
  let nombre = $("#proveedorNombre").val().trim();
  let contacto = $("#proveedorContacto").val().trim();
  let telefono = $("#proveedorTelefono").val().trim();
  let email = $("#proveedorEmail").val().trim();

  if (!nombre) {
    $("#proveedorNombre").addClass("is-invalid");
    alertToast("El nombre del proveedor es obligatorio", "warning", 3000);
    return;
  }

  $("#proveedorNombre").removeClass("is-invalid");

  var activo;
  if ($("#registrarProveedorForm #proveedorActivoCheck").is(":checked")) {
    activo = 1;
  } else {
    activo = 0;
  }
  let esEdicion = proveedorId && proveedorId !== "";

  alertMensajeConfirm(
    {
      title: esEdicion
        ? "¿Está a punto de editar este proveedor?"
        : "¿Está a punto de registrar un nuevo proveedor?",
      text: "Asegúrate que los datos sean correctos.",
      icon: "warning",
    },
    function () {
      ajaxAwaitFormData(
        {
          api: 17, // Necesitarás crear este endpoint en tu API
          id_proveedor: proveedorId || null,
          contacto: contacto,
          telefono: telefono,
          email: email,
          activo: activo,
        },
        "inventarios_api",
        "registrarProveedorForm",
        { callbackAfter: true },
        false,
        function (data) {
          if (data.response.code == 1) {
            $("#registrarProveedorForm")[0].reset();
            $("#registrarProveedorModal").modal("hide");
            alertToast(
              esEdicion ? "Proveedor actualizado!" : "Proveedor registrado!",
              "success",
              4000
            );

            // Recargar tablas y selects
            if (tableCatProveedores) tableCatProveedores.ajax.reload();
            // cargarProveedoresRegistrar();
            // cargarProveedoresEditar();
          } else {
            alertToast(
              data.response.message || "Error al procesar la solicitud",
              "error",
              4000
            );
          }
        }
      );
    }
  );

  return false;
});

$("#filtrarArticuloForm").submit(function (event) {
  event.preventDefault();

  // Solo asigna el filtro si hay selección, si no, elimina la propiedad
  let activo = $('input[name="activo"]:checked').val();
  let redFrio = $('input[name="redFrio"]:checked').val();
  let tipoArticulo = $("#tipoArticulo").val();
  let manejaCaducidad = $('input[name="manejaCaducidad"]:checked').val();
  let area = $("#area").val();

  // Limpia el objeto antes de asignar
  dataTableCatArticulos = { api: 3 };

  if (activo !== undefined) dataTableCatArticulos.estatus = activo;
  if (redFrio !== undefined) dataTableCatArticulos.red_frio = redFrio;
  if (tipoArticulo !== "" && tipoArticulo !== null)
    dataTableCatArticulos.tipo_articulo = tipoArticulo;
  if (manejaCaducidad !== undefined)
    dataTableCatArticulos.maneja_caducidad = manejaCaducidad;
  if (area !== "" && area !== null) dataTableCatArticulos.area_id = area;

  console.log(dataTableCatArticulos);

  tableCatArticulos.ajax.reload();
  $("#filtrarArticuloModal").modal("hide");
});

// Restablecer filtros
$("#resetFiltrosBtn").click(function () {
  $("#filtrarArticuloForm")[0].reset();
  // Limpia los filtros del objeto
  dataTableCatArticulos = { api: 3 };
  tableCatArticulos.ajax.reload();
  $("#resetFiltrosBtn").hide(); // Oculta el botón inmediatamente después de resetear
  $("#filtrarArticuloModal").modal("hide"); // Cierra el modal
  alertToast("Filtros restablecidos", "success", 4000);
});

function toggleFieldset(checkbox, fieldset) {
  $(checkbox).change(function () {
    const isChecked = $(this).is(":checked");
    $(fieldset).find("input, select").prop("disabled", isChecked);
  });
}

toggleFieldset("#ignorarActivo", "#activoRadios");
toggleFieldset("#ignorarRedFrio", "#redFrioRadios");
toggleFieldset("#ignorarTipoArticulo", "#tipoArticulo");
toggleFieldset("#ignorarManejaCaducidad", "#manejaCaducidadRadios");
toggleFieldset("#ignorarArea", "#area");

$("input[type=radio]").change(function () {
  const checkboxId = $(this)
    .closest(".card-body")
    .find(".form-check-input")
    .attr("id");
  $("#" + checkboxId).prop("checked", false);
});

function toggleResetButton() {
  const anyRadioChecked =
    $('input[name="activo"]:checked').length > 0 ||
    $('input[name="redFrio"]:checked').length > 0 ||
    $('input[name="manejaCaducidad"]:checked').length > 0;
  const tipoArticuloSelected =
    $("#tipoArticulo").val() !== "" && $("#tipoArticulo").val() !== null;
  const areaSelected = $("#area").val() !== "" && $("#area").val() !== null;

  if (anyRadioChecked || tipoArticuloSelected || areaSelected) {
    $("#resetFiltrosBtn").show();
  } else {
    $("#resetFiltrosBtn").hide();
  }
}

// Inicialmente ocultar el botón
$("#resetFiltrosBtn").hide();

// Mostrar/ocultar al cambiar radios o select
$(
  'input[type=radio][name="activo"], input[type=radio][name="redFrio"], input[type=radio][name="manejaCaducidad"]'
).on("change", toggleResetButton);
$("#tipoArticulo").on("change", toggleResetButton);
$("#area").on("change", toggleResetButton);
