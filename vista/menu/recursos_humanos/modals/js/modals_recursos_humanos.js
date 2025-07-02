// Catalogos de Recursos Humanos
// Registrar/Editar Departamento
$("#registrarDepartamentoForm").submit(function (event) {
  event.preventDefault();

  var form = document.getElementById("registrarDepartamentoForm");
  var formData = new FormData(form);

  $("#departamentoDescripcion").removeClass("is-invalid");

  var activo;
  if ($("#registrarDepartamentoForm #departamentoActivoCheck").is(":checked")) {
    activo = 1;
  } else {
    activo = 0;
  }

  let departamentoIdValue = $("#departamentoId").val();
  let esEdicion = departamentoIdValue && departamentoIdValue !== "";

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
              esEdicion
                ? "Departamento actualizado!"
                : "Departamento registrado!",
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

  var form = document.getElementById("registrarPuestoForm");
  var formData = new FormData(form);

  $("#puestoDescripcion").removeClass("is-invalid");

  var activo;
  if ($("#registrarPuestoForm #puestoActivoCheck").is(":checked")) {
    activo = 1;
  } else {
    activo = 0;
  }

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

// Registrar/Editar Motivo
$("#registrarMotivoForm").submit(function (event) {
  event.preventDefault();

  var form = document.getElementById("registrarMotivoForm");
  var formData = new FormData(form);

  $("#motivoDescripcion").removeClass("is-invalid");

  var activo;
  if ($("#registrarMotivoForm #motivoActivoCheck").is(":checked")) {
    activo = 1;
  } else {
    activo = 0;
  }

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
        },
        "recursos_humanos_api",
        "registrarMotivoForm",
        { callbackAfter: true },
        false,
        function (data) {
          if (data.response.code == 1) {
            $("#registrarMotivoForm")[0].reset();
            $("#registrarMotivoModal").modal("hide");
            console.log("Motivo ID:", motivoIdValue);
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

// Requisiciones de Recursos Humanos
// Registrar una nueva vacante/requisición
// Poner aqui la logica para registrar una nueva vacante

//Ver/Editar detalles de un puesto en requisición
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
          banda_salarial: bandaSalarial,
        },
        "recursos_humanos_api",
        "editarDetallesPuestoForm",
        { callbackAfter: true },
        false,
        function (data) {
          if (data.response.code == 1) {
            $("#editarDetallesPuestoForm")[0].reset();
            $("#editarDetallesPuestoModal").modal("hide");
            alertToast(
              "Detalles del puesto actualizados exitosamente!",
              "success",
              4000
            );

            // Recargar las tablas relacionadas
            if (tableCatPuestosDetalles) tableCatPuestosDetalles.ajax.reload();
            if (tableCatPuestos) tableCatPuestos.ajax.reload();

            // Si existe una función para recargar selects de puestos en otros modales
            if (typeof cargarPuestosVacanteSelect === "function") {
              cargarPuestosVacanteSelect();
            }
          } else {
            alertToast(
              data.response.message ||
                "Error al actualizar los detalles del puesto",
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
$(document).on("click", ".btn-ver-detalles-puesto", function () {
  const puestoId = $(this).data("id");
  const puestoNombre = $(this).data("nombre");

  console.log("Ver detalles del puesto:", puestoId, puestoNombre);

  // Filtrar la tabla de detalles por el puesto seleccionado
  if (typeof dataTableCatPuestosDetalles !== "undefined") {
    dataTableCatPuestosDetalles.id_puesto = puestoId;
    tableCatPuestosDetalles.ajax.reload();
  }

  $("#detallesPuestoModalLabel").text(`Detalles del Puesto: ${puestoNombre}`);
  $("#detallesPuestoModal").modal("show");
});

$(document).on("click", ".btn-editar-detalles-puesto", function () {
  const puestoId = $(this).data("id");
  const puestoNombre = $(this).data("nombre");
  const objetivos = $(this).data("objetivos") || "";
  const competencias = $(this).data("competencias") || "";
  const banda = $(this).data("banda") || "";

  console.log("Editar detalles del puesto:", puestoId, puestoNombre);
  console.log("Datos actuales:", { objetivos, competencias, banda });

  // Llenar el formulario con los datos actuales
  $("#detallePuestoId").val(puestoId);
  $("#puestoNombreDetalle").val(puestoNombre);
  $("#objetivosPuesto").val(objetivos);
  $("#competenciasPuesto").val(competencias);
  $("#bandaSalarialPuesto").val(banda);

  $("#editarDetallesPuestoModalLabel").text(`Editar Detalles: ${puestoNombre}`);
  $("#editarDetallesPuestoModal").modal("show");
});

// Limpiar formulario cuando se cierre el modal de editar detalles
$("#editarDetallesPuestoModal").on("hidden.bs.modal", function () {
  $("#editarDetallesPuestoForm")[0].reset();

  // Si hay una bandera para reabrir el modal de catálogos
  if (
    typeof debeReabrirModalRequisicion !== "undefined" &&
    debeReabrirModalRequisicion
  ) {
    setTimeout(function () {
      $("#registrarCatalogoModal").modal("show");
    }, 300);
  }
});

// Limpiar datos cuando se cierre el modal de ver detalles
$("#detallesPuestoModal").on("hidden.bs.modal", function () {
  // Si hay una bandera para reabrir el modal de catálogos
  if (
    typeof debeReabrirModalRequisicion !== "undefined" &&
    debeReabrirModalRequisicion
  ) {
    setTimeout(function () {
      $("#registrarCatalogoModal").modal("show");
    }, 300);
  }
});
