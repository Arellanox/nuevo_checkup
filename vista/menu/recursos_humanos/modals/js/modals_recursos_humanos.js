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

  // Validar duplicados antes de mostrar confirmación
  validarDuplicadosArticulo("#registrarArticuloModal").then(function (
    puedeEnviar
  ) {
    if (!puedeEnviar) {
      return; // Usuario decidió no continuar
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
              // El ID del artículo recién creado está directamente en data.response.data
              const articuloId = data.response.data;
              const nombreArticulo = $(
                "#registrarArticuloForm #nombre_comercial"
              ).val();
              const claveArticulo = $(
                "#registrarArticuloForm #clave_art"
              ).val();

              $("#registrarArticuloForm")[0].reset();
              $("#registrarArticuloModal").modal("hide");

              // Mostrar alerta personalizada con opciones
              mostrarAlertaArticuloCreado(
                articuloId,
                nombreArticulo,
                claveArticulo
              );

              tableCatArticulos.ajax.reload();
              tableCatEntradas.ajax.reload();
            }
          }
        );
      },
      1
    );
  });

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

  // Validar duplicados antes de mostrar confirmación (excluyendo el artículo actual)
  validarDuplicadosArticulo(
    "#editarArticuloModal",
    rowSelected.ID_ARTICULO
  ).then(function (puedeEnviar) {
    if (!puedeEnviar) {
      return; // Usuario decidió no continuar
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
});



// Registrar/Editar Departamento
$("#registrarDepartamentoForm").submit(function (event) {
  event.preventDefault();

  var form = document.getElementById("registrarDepartamentoForm");
  var formData = new FormData(form);

  $("#departamentoDescripcion").removeClass("is-invalid");

  // Obtener el valor del checkbox de activo
  var activo;
  if ($("#registrarDepartamentoForm #departamentoActivoCheck").is(":checked")) {
    activo = 1;
  } else {
    activo = 0;
  }

  console.log("Activo tipo:", activo);

  // Obtener el ID del departamento desde el campo hidden
  let departamentoIdValue = $("#departamentoId").val();
  let esEdicion = departamentoIdValue && departamentoIdValue !== "";

  // En tu función de submit, antes del ajaxAwaitFormData, agrega:
  console.log("Valores enviados:");
  console.log("ID Departamento:", departamentoIdValue);
  console.log("Descripción:", $("#departamentoDescripcion").val());
  console.log("Activo:", activo);
  console.log("Es edición:", esEdicion);

  alertMensajeConfirm(
    {
      title: esEdicion
        ? "¿Está a punto de editar este departamento?"
        : "¿Está a punto de registrar un nuevo departamento?",
      text: "Asegúrate que los datos sean correctos.",
      icon: "warning",
    },
    function () {
      ajaxAwaitFormData(
        {
          api: 5,
          activo: activo,
          p_id_departamento: departamentoIdValue || null,
        },
        "recursos_humanos_api",
        "registrarDepartamentoForm",
        { callbackAfter: true },
        false,
        function (data) {
          if (data.response.code == 1) {
            $("#registrarDepartamentoForm")[0].reset();
            $("#registrarDepartamentoModal").modal("hide");
            alertToast(
              esEdicion ? "Departamento actualizado!" : "Departamento registrado!",
              "success",
              4000
            );
            if (tableCatDepartamentos) tableCatDepartamentos.ajax.reload();
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

// Registrar/Editar Puesto
$("#registrarPuestoForm").submit(function (event) {
  event.preventDefault();

  var form = document.getElementById("registrarPuestoForm"); //estoForm"
  var formData = new FormData(form);

  $("#puestoDescripcion").removeClass("is-invalid");

  // Obtener el valor del checkbox de activo
  var activo;
  if ($("#registrarPuestoForm #puestoActivoCheck").is(":checked")) { //estoForm"
    activo = 1;
  } else {
    activo = 0;
  }

  // Obtener el ID del puesto desde el campo hidden
  let puestoIdValue = $("#puestoId").val(); 
  let esEdicion = puestoIdValue && puestoIdValue !== "";

  alertMensajeConfirm(
    {
      title: esEdicion
        ? "¿Está a punto de editar este puesto?"
        : "¿Está a punto de registrar un nuevo puesto?",
      text: "Asegúrate que los datos sean correctos.",
      icon: "warning",
    },
    function () {
      ajaxAwaitFormData(
        {
          api: 7,
          activo: activo,
          id_puesto: puestoIdValue || null, 
        },
        "recursos_humanos_api",
        "registrarPuestoForm", 
        { callbackAfter: true },
        false,
        function (data) {
          if (data.response.code == 1) {
            $("#registrarPuestoForm")[0].reset(); 
            $("#registrarPuestoModal").modal("hide");
            alertToast(
              esEdicion ? "Puesto actualizado!" : "Puesto registrado!",
              "success",
              4000
            );
            if (tableCatPuestos) tableCatPuestos.ajax.reload();
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

  // Obtener el ID de la marca desde el campo hidden
  let marcaIdValue = $("#marcaId").val();
  let esEdicion = marcaIdValue && marcaIdValue !== "";

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
          id_marcas: marcaIdValue || null,
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
  console.log("Activo motivo:", activo);
  // Obtener el ID del motivo desde el campo hidden
  let motivoIdValue = $("#motivoId").val();
  let esEdicion = motivoIdValue && motivoIdValue !== "";
  alertMensajeConfirm(
    {
      title: esEdicion
        ? "¿Está a punto de editar este motivo?"
        : "¿Está a punto de registrar un nuevo motivo?",
      text: "Asegúrate que los datos sean correctos.",
      icon: "warning",
    },
    function () {
      ajaxAwaitFormData(
        {
          api: 11,
          activo: activo,
          id_motivos: motivoIdValue || null,
        },
        "recursos_humanos_api",
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


// Filtrar departamentos
$("#filtrarDepartamentosForm").submit(function (event) {
  event.preventDefault();

  let activo = $('input[name="activoDepartamentos"]:checked').val();

//   if (activo === "1") {
//     dataTableCatDepartamentos = { api: 2 };
//   } else if (activo === "0") {
//     dataTableCatDepartamentos = { api: 23 };
//   } else {
//     dataTableCatDepartamentos = { api: 2 };
//   }

  tableCatDepartamentos.ajax.reload();
  $("#filtrarDepartamentosModal").modal("hide");
  $("#registrarCatalogoModal").modal("show");
});

$("#resetFiltrosDepartamentosBtn").click(function () {
  $("#filtrarDepartamentosForm")[0].reset();
  dataTableCatDepartamentos = { api: 2 };
  tableCatDepartamentos.ajax.reload();
  $("#resetFiltrosDepartamentosBtn").hide();
  $("#filtrarDepartamentosModal").modal("hide");
  $("#registrarCatalogoModal").modal("show");
  alertToast("Filtros de departamentos restablecidos", "success", 4000);
});

// Filtrar tipos
function toggleResetButtonDepartamentos() {
  const anyRadioChecked = $('input[name="activoDepartamentos"]:checked').length > 0;
  if (anyRadioChecked) {
    $("#resetFiltrosDepartamentosBtn").show();
  } else {
    $("#resetFiltrosDepartamentosBtn").hide();
  }
}

$("#resetFiltrosDepartamentosBtn").hide();
$('input[type=radio][name="activoDepartamentos"]').on("change", toggleResetButtonDepartamentos);

// Filtrar unidades
$("#filtrarUnidadesForm").submit(function (event) {
  event.preventDefault();

  let activo = $('input[name="activoUnidades"]:checked').val();

  if (activo === "1") {
    dataTableCatUnidades = { api: 12 };
  } else if (activo === "0") {
    dataTableCatUnidades = { api: 22 };
  } else {
    dataTableCatUnidades = { api: 12 };
  }

  tableCatUnidades.ajax.reload();
  $("#filtrarUnidadesModal").modal("hide");
  $("#registrarCatalogoModal").modal("show");
});

$("#resetFiltrosUnidadesBtn").click(function () {
  $("#filtrarUnidadesForm")[0].reset();
  dataTableCatUnidades = { api: 12 };
  tableCatUnidades.ajax.reload();
  $("#resetFiltrosUnidadesBtn").hide();
  $("#filtrarUnidadesModal").modal("hide");
  $("#registrarCatalogoModal").modal("show");
  alertToast("Filtros de unidades restablecidos", "success", 4000);
});

// UNIDADES
function toggleResetButtonUnidades() {
  const anyRadioChecked = $('input[name="activoUnidades"]:checked').length > 0;
  if (anyRadioChecked) {
    $("#resetFiltrosUnidadesBtn").show();
  } else {
    $("#resetFiltrosUnidadesBtn").hide();
  }
}

$("#resetFiltrosUnidadesBtn").hide();
$('input[type=radio][name="activoUnidades"]').on(
  "change",
  toggleResetButtonUnidades
);

// Filtrar marcas
$("#filtrarMarcasForm").submit(function (event) {
  event.preventDefault();

  let activo = $('input[name="activoMarcas"]:checked').val();

  if (activo === "1") {
    dataTableCatMarcas = { api: 9 };
  } else if (activo === "0") {
    dataTableCatMarcas = { api: 21 };
  } else {
    dataTableCatMarcas = { api: 9 };
  }

  tableCatMarcas.ajax.reload();
  $("#filtrarMarcasModal").modal("hide");
  $("#registrarCatalogoModal").modal("show");
});

$("#resetFiltrosMarcasBtn").click(function () {
  $("#filtrarMarcasForm")[0].reset();
  dataTableCatMarcas = { api: 16 };
  tableCatMarcas.ajax.reload();
  $("#resetFiltrosMarcasBtn").hide();
  $("#filtrarMarcasModal").modal("hide");
  $("#registrarCatalogoModal").modal("show");
  alertToast("Filtros de marcas restablecidos", "success", 4000);
});

// Función para mostrar/ocultar botón reset de marcas
function toggleResetButtonMarcas() {
  const anyRadioChecked = $('input[name="activoMarcas"]:checked').length > 0;

  if (anyRadioChecked) {
    $("#resetFiltrosMarcasBtn").show();
  } else {
    $("#resetFiltrosMarcasBtn").hide();
  }
}

// Inicialmente ocultar el botón
$("#resetFiltrosMarcasBtn").hide();

// Mostrar/ocultar al cambiar radios
$('input[type=radio][name="activoMarcas"]').on(
  "change",
  toggleResetButtonMarcas
);

// Filtrar motivos
$("#filtrarMotivosForm").submit(function (event) {
  event.preventDefault();

  let activo = $('input[name="activoMotivos"]:checked').val();
  let tipoMovimiento = $("#motivosTipoMovimiento").val();

  if (activo === "0") {
    // Para inactivos usar API 24
    dataTableCatMotivos = { api: 24 };

    // Si también hay filtro de tipo, agregarlo
    if (tipoMovimiento && tipoMovimiento !== "") {
      dataTableCatMotivos.tipo_movimiento = tipoMovimiento;
    }
  } else {
    // Para activos o sin filtro de estatus usar API 15
    dataTableCatMotivos = { api: 15 };

    // Si hay filtro de tipo, agregarlo (como hace tu case 15)
    if (tipoMovimiento && tipoMovimiento !== "") {
      dataTableCatMotivos.tipo_movimiento = tipoMovimiento;
    }
  }

  tableCatMotivos.ajax.reload();
  $("#filtrarMotivosModal").modal("hide");
  $("#registrarCatalogoModal").modal("show");
});

$("#resetFiltrosMotivosBtn").click(function () {
  $("#filtrarMotivosForm")[0].reset();
  dataTableCatMotivos = { api: 15 };
  tableCatMotivos.ajax.reload();
  $("#resetFiltrosMotivosBtn").hide();
  $("#filtrarMotivosModal").modal("hide");
  $("#registrarCatalogoModal").modal("show");
  alertToast("Filtros de tipos restablecidos", "success", 4000);
});

// Función para mostrar/ocultar botón reset de motivos
function toggleResetButtonMotivos() {
  const anyRadioChecked = $('input[name="activoMotivos"]:checked').length > 0;
  const tipoMovimientoSelected =
    $("#motivoTipoMovimiento").val() !== "" &&
    $("#motivoTipoMovimiento").val() !== null;

  if (anyRadioChecked || tipoMovimientoSelected) {
    $("#resetFiltrosMotivosBtn").show();
  } else {
    $("#resetFiltrosMotivosBtn").hide();
  }
}

// Inicialmente ocultar el botón
$("#resetFiltrosMotivosBtn").hide();

// Mostrar/ocultar al cambiar radios o select
$('input[type=radio][name="activoMotivos"]').on(
  "change",
  toggleResetButtonMotivos
);
$("#motivoTipoMovimiento").on("change", toggleResetButtonMotivos);

// Filtrar proveedores
$("#filtrarProveedoresForm").submit(function (event) {
  event.preventDefault();

  let activo = $('input[name="activoProveedor"]:checked').val();

  if (activo === "1") {
    dataTableCatProveedores = { api: 16 };
  } else if (activo === "0") {
    dataTableCatProveedores = { api: 20 };
  } else {
    dataTableCatProveedores = { api: 16 };
  }

  tableCatProveedores.ajax.reload();
  $("#filtrarProveedoresModal").modal("hide");
  $("#registrarCatalogoModal").modal("show");
});

$("#resetFiltrosProveedoresBtn").click(function () {
  $("#filtrarProveedoresForm")[0].reset();
  dataTableCatProveedores = { api: 16 };
  tableCatProveedores.ajax.reload();
  $("#resetFiltrosProveedoresBtn").hide();
  $("#filtrarProveedoresModal").modal("hide");
  $("#registrarCatalogoModal").modal("show");
  alertToast("Filtros de proveedores restablecidos", "success", 4000);
});

// Función para mostrar/ocultar botón reset de proveedores
function toggleResetButtonProveedores() {
  const anyRadioChecked = $('input[name="activoProveedor"]:checked').length > 0;

  if (anyRadioChecked) {
    $("#resetFiltrosProveedoresBtn").show();
  } else {
    $("#resetFiltrosProveedoresBtn").hide();
  }
}

// Inicialmente ocultar el botón
$("#resetFiltrosProveedoresBtn").hide();

// Mostrar/ocultar al cambiar radios
$('input[type=radio][name="activoProveedor"]').on(
  "change",
  toggleResetButtonProveedores
);

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

// ==================== SUBMIT DEL FORMULARIO DE SUSTANCIAS ACTIVAS ====================
$("#registrarSustanciaForm").submit(function (event) {
  event.preventDefault();

  var sustanciaId = $("#sustanciaId").val();
  var nombre = $("#sustanciaNombre").val().trim();
  var tipo = $("#sustanciaTipo").val();
  var descripcion = $("#sustanciaDescripcion").val().trim();
  var estatus = $("#sustanciaActivaCheck").is(":checked") ? 1 : 0;

  // Validaciones
  if (!nombre) {
    alertToast("El nombre de la sustancia es obligatorio", "warning", 3000);
    return;
  }

  if (!tipo) {
    alertToast("Debe seleccionar un tipo de sustancia", "warning", 3000);
    return;
  }

  var accion = sustanciaId ? 'UPDATE' : 'CREATE';
  var tituloConfirm = sustanciaId ? "¿Actualizar sustancia activa?" : "¿Registrar nueva sustancia activa?";
  var textoConfirm = sustanciaId ? "Se actualizará la sustancia activa." : "Se creará una nueva sustancia activa.";

  alertMensajeConfirm(
    {
      title: tituloConfirm,
      text: textoConfirm,
      icon: "warning",
    },
    function () {
      ajaxAwait(
        {
          api: 38, // Usar el case 38 para CRUD de sustancias
          id_sustancia: sustanciaId || null,
          nombre: nombre,
          tipo: tipo,
          descripcion: descripcion,
          estatus: estatus,
          accion: accion,
        },
        "inventarios_api",
        { callbackAfter: true },
        false,
        function (data) {
          if (data.response.code == 1) {
            var mensaje = sustanciaId ? "Sustancia actualizada exitosamente!" : "Sustancia registrada exitosamente!";
            alertToast(mensaje, "success", 4000);
            
            $("#registrarSustanciaForm")[0].reset();
            $("#registrarSustanciaModal").modal("hide");
            
            // Recargar tabla de sustancias
            if (typeof tableCatSustancias !== "undefined") {
              tableCatSustancias.ajax.reload();
            }

            // Recargar sustancias en los selects si están abiertos los modales de artículos
            if ($("#registrarArticuloModal").hasClass("show")) {
              cargarSustanciasRegistrar();
            }
            if ($("#editarArticuloModal").hasClass("show")) {
              cargarSustanciasEditar();
            }
          } else {
            var errorMsg = data.response.message || "Error al procesar la sustancia";
            alertToast(errorMsg, "error", 4000);
          }
        }
      );
    },
    1
  );
});

// Registrar una nueva vacante/requisición
$("#formRegistrarVacante").submit(function (event) {
  event.preventDefault();

  var form = document.getElementById("formRegistrarVacante");
  var formData = new FormData(form);

  // Validaciones básicas - usar los names correctos del formulario
  var departamento = $("#departamento").val();
  var motivo = $("#motivo").val();
  var prioridad = $("#prioridad").val();
  var justificacion = $("#justificacion").val().trim();
  var tipo_contrato = $("#tipo_contrato").val();
  var tipo_jornada = $("#tipo_jornada").val();
  var escolaridad_minima = $("#escolaridad_minima").val();
  var experiencia_anos = $("#experiencia_anos").val();
  var horario_trabajo = $("#horario_trabajo").val().trim();

  // Validar campos obligatorios según el stored procedure
  if (!departamento) {
    alertToast("Debe seleccionar un departamento", "warning", 3000);
    return;
  }

  if (!motivo) {
    alertToast("Debe seleccionar un motivo", "warning", 3000);
    return;
  }

  if (!prioridad) {
    alertToast("Debe seleccionar una prioridad", "warning", 3000);
    return;
  }

  if (!justificacion) {
    alertToast("La justificación es obligatoria", "warning", 3000);
    return;
  }

  if (!tipo_contrato) {
    alertToast("Debe seleccionar el tipo de contrato", "warning", 3000);
    return;
  }

  if (!tipo_jornada) {
    alertToast("Debe seleccionar el tipo de jornada", "warning", 3000);
    return;
  }

  if (!escolaridad_minima) {
    alertToast("Debe seleccionar la escolaridad mínima", "warning", 3000);
    return;
  }

  if (!experiencia_anos) {
    alertToast("Debe seleccionar los años de experiencia", "warning", 3000);
    return;
  }

  if (!horario_trabajo) {
    alertToast("El horario de trabajo es obligatorio", "warning", 3000);
    return;
  }

  alertMensajeConfirm(
    {
      title: "¿Está a punto de registrar una nueva requisición?",
      text: "Verifique que todos los datos sean correctos.",
      icon: "warning",
    },
    function () {
      ajaxAwaitFormData(
        { 
          api: 1, // API para requisiciones
          accion: 'CREATE' // Especificar que es una creación
        },
        "recursos_humanos_api",
        "formRegistrarVacante",
        { callbackAfter: true },
        false,
        function (data) {
          if (data.response.code == 1) {
            // El ID de la requisición recién creada
            const requisicionId = data.response.data;
            const numeroRequisicion = data.response.numero_requisicion || requisicionId;

            $("#formRegistrarVacante")[0].reset();
            $("#registrarVacanteModal").modal("hide");

            alertToast(
              `Requisición #${numeroRequisicion} registrada exitosamente!`,
              "success",
              4000
            );

            // Recargar tabla de requisiciones
            tableCatRequisiciones.ajax.reload();
          } else {
            alertToast(
              data.response.message || "Error al registrar la requisición",
              "error",
              4000
            );
          }
        }
      );
    },
    1
  );

  return false;
});

// Editar Detalles del Puesto
$("#editarDetallesPuestoForm").submit(function (event) {
  event.preventDefault();

  var form = document.getElementById("editarDetallesPuestoForm");
  var formData = new FormData(form);

  // Obtener valores del formulario
  let puestoId = $("#detallePuestoId").val();
  let objetivos = $("#objetivosPuesto").val().trim();
  let competencias = $("#competenciasPuesto").val().trim();
  let bandaSalarial = $("#bandaSalarialPuesto").val().trim();
  let puestoNombre = $("#puestoNombreDetalle").val();

  // Validación básica
  if (!puestoId) {
    alertToast("Error: No se encontró el ID del puesto", "error", 3000);
    return;
  }

  console.log("Valores a enviar:");
  console.log("ID Puesto:", puestoId);
  console.log("Objetivos:", objetivos);
  console.log("Competencias:", competencias);
  console.log("Banda Salarial:", bandaSalarial);

  alertMensajeConfirm(
    {
      title: "¿Está a punto de actualizar los detalles del puesto?",
      text: `Se actualizarán los detalles del puesto: ${puestoNombre}`,
      icon: "warning",
    },
    function () {
      ajaxAwaitFormData(
        {
          api: 10, // Usar el API 10 que definimos para actualizar detalles
          id_puesto: puestoId,
          objetivos: objetivos,
          competencias: competencias,
          banda_salarial: bandaSalarial
        },
        "recursos_humanos_api",
        "editarDetallesPuestoForm",
        { callbackAfter: true },
        false,
        function (data) {
          if (data.response.code == 1) {
            $("#editarDetallesPuestoForm")[0].reset();
            $("#editarDetallesPuestoModal").modal("hide");
            alertToast("Detalles del puesto actualizados exitosamente!", "success", 4000);
            
            // Recargar las tablas relacionadas
            if (tableCatPuestosDetalles) tableCatPuestosDetalles.ajax.reload();
            if (tableCatPuestos) tableCatPuestos.ajax.reload();
            
            // Si existe una función para recargar selects de puestos en otros modales
            if (typeof cargarPuestosVacanteSelect === 'function') {
              cargarPuestosVacanteSelect();
            }
          } else {
            alertToast(
              data.response.message || "Error al actualizar los detalles del puesto",
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

// Event handlers para los botones de detalles de puestos
$(document).on('click', '.btn-ver-detalles-puesto', function() {
  const puestoId = $(this).data('id');
  const puestoNombre = $(this).data('nombre');
  
  console.log("Ver detalles del puesto:", puestoId, puestoNombre);
  
  // Filtrar la tabla de detalles por el puesto seleccionado
  if (typeof dataTableCatPuestosDetalles !== 'undefined') {
    dataTableCatPuestosDetalles.id_puesto = puestoId;
    tableCatPuestosDetalles.ajax.reload();
  }
  
  $('#detallesPuestoModalLabel').text(`Detalles del Puesto: ${puestoNombre}`);
  $('#detallesPuestoModal').modal('show');
});

$(document).on('click', '.btn-editar-detalles-puesto', function() {
  const puestoId = $(this).data('id');
  const puestoNombre = $(this).data('nombre');
  const objetivos = $(this).data('objetivos') || '';
  const competencias = $(this).data('competencias') || '';
  const banda = $(this).data('banda') || '';
  
  console.log("Editar detalles del puesto:", puestoId, puestoNombre);
  console.log("Datos actuales:", { objetivos, competencias, banda });
  
  // Llenar el formulario con los datos actuales
  $('#detallePuestoId').val(puestoId);
  $('#puestoNombreDetalle').val(puestoNombre);
  $('#objetivosPuesto').val(objetivos);
  $('#competenciasPuesto').val(competencias);
  $('#bandaSalarialPuesto').val(banda);
  
  $('#editarDetallesPuestoModalLabel').text(`Editar Detalles: ${puestoNombre}`);
  $('#editarDetallesPuestoModal').modal('show');
});

// Limpiar formulario cuando se cierre el modal de editar detalles
$('#editarDetallesPuestoModal').on('hidden.bs.modal', function() {
  $('#editarDetallesPuestoForm')[0].reset();
  
  // Si hay una bandera para reabrir el modal de catálogos
  if (typeof debeReabrirModalRequisicion !== 'undefined' && debeReabrirModalRequisicion) {
    setTimeout(function() {
      $('#registrarCatalogoModal').modal('show');
    }, 300);
  }
});

// Limpiar datos cuando se cierre el modal de ver detalles
$('#detallesPuestoModal').on('hidden.bs.modal', function() {
  // Si hay una bandera para reabrir el modal de catálogos
  if (typeof debeReabrirModalRequisicion !== 'undefined' && debeReabrirModalRequisicion) {
    setTimeout(function() {
      $('#registrarCatalogoModal').modal('show');
    }, 300);
  }
});