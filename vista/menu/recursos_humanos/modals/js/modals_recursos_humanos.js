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

// Registrar/Editar Blandas
$("#registrarBlandasForm").submit(function (event) {
  event.preventDefault();

  var form = document.getElementById("registrarBlandasForm");
  var formData = new FormData(form);

  $("#blandasDescripcion").removeClass("is-invalid");

  var activo;
  if ($("#registrarBlandasForm #blandasActivoCheck").is(":checked")) {
    activo = 1;
  } else {
    activo = 0;
  }

  let blandasIdValue = $("#blandasId").val();
  let esEdicion = blandasIdValue && blandasIdValue !== "";

  alertMensajeConfirm(
    {
      title: esEdicion
        ? "¿Está a punto de editar esta habilidad blanda?"
        : "¿Está a punto de registrar una nueva habilidad blanda?",
      text: "Asegúrate que los datos sean correctos.",
      icon: "warning",
    },
    function () {
      ajaxAwaitFormData(
        {
          api: 19,
          activo: activo,
        },
        "recursos_humanos_api",
        "registrarBlandasForm",
        { callbackAfter: true },
        false,
        function (data) {
          if (data.response.code == 1) {
            console.log("Blanda ID:", blandasIdValue);
            $("#registrarBlandasForm")[0].reset();
            $("#registrarBlandasModal").modal("hide");
            alertToast(
              esEdicion ? "Habilidad blanda actualizada!" : "Habilidad blanda registradoa!",
              "success",
              4000
            );
            if (tableCatBlandas) tableCatBlandas.ajax.reload();
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

// Registrar/Editar Técnicas
$("#registrarTecnicasForm").submit(function (event) {
  event.preventDefault();

  var form = document.getElementById("registrarTecnicasForm");
  var formData = new FormData(form);

  $("#tecnicasDescripcion").removeClass("is-invalid");

  var activo;
  if ($("#registrarTecnicasForm #tecnicasActivoCheck").is(":checked")) {
    activo = 1;
  } else {
    activo = 0;
  }

  let tecnicasIdValue = $("#tecnicasId").val();
  let esEdicion = tecnicasIdValue && tecnicasIdValue !== "";

  alertMensajeConfirm(
    {
      title: esEdicion
        ? "¿Está a punto de editar esta habilidad técnica?"
        : "¿Está a punto de registrar una nueva habilidad técnica?",
      text: "Asegúrate que los datos sean correctos.",
      icon: "warning",
    },
    function () {
      ajaxAwaitFormData(
        {
          api: 22,
          activo: activo,
        },
        "recursos_humanos_api",
        "registrarTecnicasForm",
        { callbackAfter: true },
        false,
        function (data) {
          if (data.response.code == 1) {
            console.log("Técnica ID:", tecnicasIdValue);
            $("#registrarTecnicasForm")[0].reset();
            $("#registrarTecnicasModal").modal("hide");
            alertToast(
              esEdicion ? "Habilidad técnica actualizada!" : "Habilidad técnica registrada!",
              "success",
              4000
            );
            if (tableCatTecnicas) tableCatTecnicas.ajax.reload();
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


// Registrar una nueva requisición de vacante - VARIABLES UNIFICADAS
$("#formRegistrarVacante").submit(function (event) {
    event.preventDefault();

    // Agregar el campo oculto usuario_solicitante_id si no está presente
    var usuarioSolicitanteId = $("#usuario_solicitante_id").val();
    // if (!usuarioSolicitanteId || usuarioSolicitanteId === '') {
    //     $("#usuario_solicitante_id").val('118'); // Tu ID de sesión o valor por defecto
    // }

    var form = document.getElementById("formRegistrarVacante");
    var formData = new FormData(form);

    // Validaciones básicas usando las variables unificadas
    var id_departamento = $("#departamento").val(); // name="id_departamento"
    var id_motivo = $("#motivo").val(); // name="id_motivo"
    var prioridad = $("#prioridad").val();
    var justificacion = $("#justificacion").val().trim();
    var tipo_contrato = $("#tipo_contrato").val();
    var tipo_jornada = $("#tipo_jornada").val();
    var escolaridad_minima = $("#escolaridad_minima").val();
    var experiencia_anos = $("#experiencia_anos").val();
    var horario_trabajo = $("#horario_trabajo").val().trim();

    // Validar campos obligatorios
    if (!id_departamento) {
        alertToast("Debe seleccionar un departamento", "warning", 3000);
        return;
    }

    if (!id_motivo) {
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

    // DEBUG: Verificar que los datos se envían correctamente
    console.log("=== DEBUG FORMULARIO REQUISICIÓN ===");
    console.log("ID Departamento:", id_departamento);
    console.log("ID Motivo:", id_motivo);
    console.log("ID Puesto:", $("#puesto").val());
    console.log("Usuario Solicitante ID:", $("#usuario_solicitante_id").val());
    
    // Mostrar todos los datos del formulario
    for (let pair of formData.entries()) {
        console.log(pair[0] + ': ' + pair[1]);
    }

    alertMensajeConfirm(
        {
            title: "¿Está a punto de registrar esta requisición?",
            text: "Verifique que todos los datos sean correctos.",
            icon: "warning",
        },
        function () {
            ajaxAwaitFormData(
                {
                    api: 1, // API para crear/actualizar requisiciones
                },
                "recursos_humanos_api",
                "formRegistrarVacante",
                { callbackAfter: true },
                false,
                function (data) {
                    console.log("=== RESPUESTA DEL SERVIDOR ===");
                    console.log("Respuesta completa:", data);
                    
                    if (data.response.code == 1) {
                        // Limpiar formulario
                        $("#formRegistrarVacante")[0].reset();
                        $("#registrarVacanteModal").modal("hide");

                        // Obtener el número de requisición de la respuesta
                        let numeroRequisicion = "N/A";
                        if (data.response.data && data.response.data.numero_requisicion) {
                            numeroRequisicion = data.response.data.numero_requisicion;
                        }

                        alertToast(
                            `Requisición #${numeroRequisicion} registrada exitosamente!`,
                            "success",
                            4000
                        );

                        // Recargar tabla de requisiciones si existe
                        if (typeof tableCatRequisiciones !== 'undefined' && tableCatRequisiciones) {
                            tableCatRequisiciones.ajax.reload();
                        }
                        
                        // También recargar si se llama con otro nombre
                        if (typeof tableRequisiciones !== 'undefined' && tableRequisiciones) {
                            tableRequisiciones.ajax.reload();
                        }
                    } else {
                        console.error("Error en la respuesta:", data);
                        
                        // Mostrar mensaje de error más específico
                        let mensajeError = "Error al registrar la requisición";
                        if (data.response && data.response.message) {
                            mensajeError = data.response.message;
                        }
                        
                        // Mostrar debug si está disponible
                        if (data.response && data.response.debug) {
                            console.error("Debug del servidor:", data.response.debug);
                        }
                        
                        alertToast(mensajeError, "error", 4000);
                    }
                }
            );
        },
        1
    );

    return false;
});

