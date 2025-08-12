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
          { api: 1, estatus: activo },
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

// Función personalizada para mostrar alerta con opciones después de crear artículo
function mostrarAlertaArticuloCreado(
  articuloId,
  nombreArticulo,
  claveArticulo
) {
  console.log("ID del artículo creado:", articuloId); // Para depuración

  const Toast = Swal.mixin({
    toast: true,
    position: "bottom-end",
    showConfirmButton: false,
    showCloseButton: true,
    timerProgressBar: true,
    timer: 8000,
    didOpen: (toast) => {
      toast.addEventListener("mouseenter", Swal.stopTimer);
      toast.addEventListener("mouseleave", Swal.resumeTimer);
    },
  });

  Toast.fire({
    icon: "success",
    title: "¡Artículo creado exitosamente!",
    html: `
      <div style="margin-top: 10px;">
        <p><strong>${nombreArticulo}</strong> (${claveArticulo})</p>
        <div style="display: flex; gap: 8px; justify-content: center; margin-top: 15px;">
          <button id="btnIrRegistrarEntrada" class="btn btn-primary btn-sm" style="font-size: 12px; padding: 5px 10px;">
            <i class="bi bi-plus-circle"></i> Registrar entrada
          </button>
        </div>
      </div>
    `,
    didOpen: () => {
      // Evento para registrar entrada
      const btnRegistrarEntrada = document.getElementById(
        "btnIrRegistrarEntrada"
      );
      const btnEditar = document.getElementById("btnEditarArticulo");

      if (btnRegistrarEntrada) {
        btnRegistrarEntrada.addEventListener("click", () => {
          Swal.close();
          abrirModalRegistrarEntrada(articuloId, nombreArticulo, claveArticulo);
        });
      }

      // Evento para editar artículo
      if (btnEditar) {
        btnEditar.addEventListener("click", () => {
          Swal.close();
          abrirModalEditarArticulo(articuloId, nombreArticulo, claveArticulo);
        });
      }
    },
  });
}

// Función para abrir modal de registrar entrada con el artículo recién creado
function abrirModalRegistrarEntrada(articuloId, nombreArticulo, claveArticulo) {
  console.log("Buscando artículo con ID:", articuloId); // Para depuración

  // Primero, navegar a la nueva pestaña de entradas
  $(".content-module").hide();
  $("#tab-menu").hide();
  $("#moduloCatEntradasEstable").show();

  // Buscar el artículo en la tabla de entradas estables para obtener los datos completos
  tableCatEntradasEstable.ajax.reload(function () {
    // Buscar la fila correspondiente al artículo recién creado
    const data = tableCatEntradasEstable.data().toArray();
    console.log("Datos de la tabla:", data); // Para depuración

    const articuloEncontrado = data.find((item) => {
      console.log("Comparando:", item.ID_ARTICULO, "con", articuloId); // Para depuración
      return item.ID_ARTICULO == articuloId;
    });

    if (articuloEncontrado) {
      console.log("Artículo encontrado:", articuloEncontrado); // Para depuración

      // Establecer como fila seleccionada
      rowSelected = articuloEncontrado;

      // Abrir modal de registrar entrada
      $("#registrarEntradaEstableModal").modal("show");
      $("#articuloSeleccionadoEstable").text(
        ` ${nombreArticulo} (Clave: ${claveArticulo})`
      );
      $("#registrandoCantidad").text(` ${articuloEncontrado.CANTIDAD || "0"}`);

      // Colocar los valores al formulario
      $("#registrarEntradaEstableForm #no_art").val(articuloId);
      $("#registrarEntradaEstableForm #nombre_comercial").val(nombreArticulo);

      // Establecer estatus
      if (articuloEncontrado.ESTATUS == 1) {
        $("#registrarEntradaEstableForm #estatus").prop("checked", true);
      } else {
        $("#registrarEntradaEstableForm #estatus").prop("checked", false);
      }
    } else {
      console.log("No se encontró el artículo en la tabla de entradas"); // Para depuración
      // Intentar buscar directamente por nombre y clave como fallback
      const articuloPorNombre = data.find(
        (item) =>
          item.NOMBRE_COMERCIAL === nombreArticulo &&
          item.CLAVE_ART === claveArticulo
      );

      if (articuloPorNombre) {
        console.log("Artículo encontrado por nombre:", articuloPorNombre); // Para depuración
        rowSelected = articuloPorNombre;
        $("#registrarEntradaEstableModal").modal("show");
        $("#articuloSeleccionadoEstable").text(
          ` ${nombreArticulo} (Clave: ${claveArticulo})`
        );
        $("#registrandoCantidad").text(` ${articuloPorNombre.CANTIDAD || "0"}`);
      } else {
        alertToast(
          "El artículo fue creado exitosamente. Ve a la pestaña 'Entradas' para registrar una entrada.",
          "info",
          6000
        );
      }
    }
  });
}

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

// Registrar una entrada estable
$("#registrarEntradaEstableForm").submit(function (event) {
  event.preventDefault();
  var form = document.getElementById("registrarEntradaEstableForm");
  var formData = new FormData(form);

  alertMensajeConfirm(
    {
      title: "¿Está a punto de registrar esta entrada?",
      text: "Asegúrate que los datos sean correctos.",
      icon: "warning",
    },
    function () {
      ajaxAwaitFormData(
        {
          api: 6,
          id_articulo: rowSelected.ID_ARTICULO,
          esOrden: 0,
        },
        "inventarios_api",
        "registrarEntradaEstableForm",
        { callbackAfter: true },
        false,
        function (data) {
          if (data.response.code == 1) {
            $("#registrarEntradaEstableForm")[0].reset();
            $("#registrarEntradaEstableModal").modal("hide");
            alertToast("Entrada exitosa", "success", 4000);
            dataTableCatEntradasEstable.ajax.reload();
            dataTableCatDetEntradasEstable.ajax.reload();
          } else {
            alertToast(
              "Ocurrió un error al registrar la entrada",
              "error",
              4000
            );
          }
        }
      );
    }
  );
});

// Editar una entrada estable
$("#editarEntradaEstableForm").submit(function (event) {
  event.preventDefault();
  var form = document.getElementById("editarEntradaEstableForm");
  var formData = new FormData(form);
  var idEntrada = rowSelected.id_entrada;
  var idArticulo = rowSelected.ID_ARTICULO;
  console.log("idEntrada", idEntrada);

  alertMensajeConfirm(
    {
      title: "¿Está a punto de editar esta entrada?",
      text: "Asegúrate que los datos sean correctos.",
      icon: "warning",
    },
    function () {
      ajaxAwaitFormData(
        {
          api: 6,
          id_articulo: idArticulo,
          id_entrada: idEntrada,
          esOrden: 0,
        },
        "inventarios_api",
        "editarEntradaEstableForm",
        { callbackAfter: true },
        false,
        function (data) {
          if (data.response.code == 1) {
            $("#editarEntradaEstableForm")[0].reset();
            $("#editarEntradaEstableModal").modal("hide");
            alertToast("Entrada actualizada", "success", 4000);
            dataTableCatEntradasEstable.ajax.reload();
            dataTableCatDetEntradasEstable.ajax.reload();
          } else {
            alertToast(
              "Ocurrió un error al actualizar la entrada",
              "error",
              4000
            );
          }
        }
      );
    }
  );
});

// Surtir una orden de compra
$("#formSurtirOrdenCompraIndividual").submit(function (event) {
  event.preventDefault();
  var form = document.getElementById("formSurtirOrdenCompraIndividual");
  var formData = new FormData(form);
  var idArticulo = $("#idArticuloSurtirOC").val();
  var fechaEntrada = $("#fecha_entrada_orden").val();
  var ordenCompra = $("#idOrdenCompraSurtirOC").val();
  var idProveedores = $("#id_proveedor_surtir_oc").val();
  alertMensajeConfirm(
    {
      title: "¿Está a punto de registrar esta entrada?",
      text: "Asegúrate que los datos sean correctos.",
      icon: "warning",
    },
    function () {
      ajaxAwaitFormData(
        {
          api: 6,
          id_articulo: parseInt(idArticulo),
          id_motivo: 11,
          esOrden: 1,
          fecha_entrada: fechaEntrada,
          id_orden_compra: ordenCompra,
          id_proveedores: idProveedores,
        },
        "inventarios_api",
        "formSurtirOrdenCompraIndividual",
        { callbackAfter: true },
        false,
        function (data) {
          if (data.response.code == 1) {
            $("#formSurtirOrdenCompraIndividual")[0].reset();
            $("#surtirOrdenCompraIndividualModal").modal("hide");
            alertToast("Entrada exitosa", "success", 4000);
            tableCatOrdenesCompraArticulos.ajax.reload();
            tableCatEntradasEstable.ajax.reload();
            tableCatDetEntradasEstable.ajax.reload();
            tableCatTransacciones.ajax.reload();
          } else {
            alertToast(
              "Ocurrió un error al registrar la entrada",
              "error",
              4000
            );
          }
        }
      );
    }
  );
});

// // Registrar un movimiento (entrada o salida)
// $("#registrarEntradaForm").submit(function (event) {
//   event.preventDefault();
//   var form = document.getElementById("registrarEntradaForm");
//   var formData = new FormData(form);

//   // Obtener el estatus (si existe en tu formulario)
//   var activo = $("#registrarEntradaForm #estatus").is(":checked") ? 1 : 0;
//   formData.append("activo", activo);

//   alertMensajeConfirm(
//     {
//       title: "¿Está a punto de registrar este movimiento?",
//       text: "Asegúrate que los datos sean correctos.",
//       icon: "warning",
//     },
//     function () {
//       ajaxAwaitFormData(
//         {
//           api: 6,
//           id_articulo: rowSelected.ID_ARTICULO,
//         },
//         "inventarios_api",
//         "registrarEntradaForm",
//         { callbackAfter: true },
//         false,
//         function (data) {
//           if (data.response.code == 1) {
//             // Resetear y ocultar elementos
//             $("#registrarEntradaForm")[0].reset();
//             $("#registrarEntradaModal").modal("hide");

//             // Mostrar notificación
//             alertToast("Movimiento registrado correctamente!", "success", 4000);

//             // Recargar tablas
//             tableCatEntradas.ajax.reload();
//             tableCatArticulos.ajax.reload();
//             tableCatDetallesEntradas.ajax.reload();
//             tableCatTransacciones.ajax.reload();

//             // Resetear visibilidad de los elementos
//             $("#precio-compra-container").hide();
//             $("#cantidad-container").hide();
//             $("#entrada-details-card").hide();
//             $("#motivo-card").hide();
//             $("#doc-extra-card").hide();
//             $("#lotesCaducidadDiv").hide();

//             // Resetear campos requeridos
//             $("#cantidad").prop("required", false);
//             $("#costo_ultima_entrada").prop("required", false);
//             $("#id_proveedores").prop("required", false);
//             $("#img_factura").prop("required", false);
//             $("#motivo_salida").prop("required", false);

//             // Resetear botón y título
//             $("#registrarMovimientoButton")
//               .html('<i class="bi bi-pencil-square"></i> Registrar movimiento')
//               .hide();

//             $("#modalTitleRegistrarEntrada").html(
//               "Registrando movimiento de <strong><span id='registrandoEntrada'>" +
//                 ($("#registrandoEntrada").text() || "") +
//                 "</span></strong>"
//             );

//             // Limpiar cálculo de costo total
//             $("#costoTotal").hide();
//             $("#costoTotalValor").text("0.00");
//           } else {
//             alertToast("Error al registrar el movimiento", "error", 4000);
//           }
//         }
//       );
//     }
//   );
// });

// //Editar una entrada
// $("#editarMovimientoForm").submit(function (event) {
//   event.preventDefault();
//   var form = document.getElementById("editarMovimientoForm");
//   var formData = new FormData(form);

//   var activo;

//   if ($("#editarMovimientoForm #estatus").is(":checked")) {
//     activo = 1;
//   } else {
//     activo = 0;
//   }

//   alertMensajeConfirm(
//     {
//       title: "¿Está a punto de editar este movimiento?",
//       text: "Asegúrate que los datos sean correctos.",
//       icon: "warning",
//     },
//     function () {
//       ajaxAwaitFormData(
//         {
//           api: 6,
//           id_articulo: rowSelected.ID_ARTICULO,
//           id_cat_movimientos: rowSelected.id_cat_movimientos,
//           fecha_ultima_entrada: $("#fecha_ultima_entrada").val(),
//           id_movimiento:
//             rowSelected.id_movimiento == 1
//               ? 4
//               : rowSelected.id_movimiento == 2
//               ? 5
//               : rowSelected.id_movimiento,
//         },
//         "inventarios_api",
//         "editarMovimientoForm",
//         { callbackAfter: true },
//         false,
//         function (data) {
//           if (data.response.code == 1) {
//             $("#editarMovimientoForm")[0].reset();
//             $("#editarMovimientoModal").modal("hide");
//             alertToast("Movimiento actualizado!", "success", 4000);
//             tableCatArticulos.ajax.reload();
//             tableCatEntradas.ajax.reload();
//             tableCatDetallesEntradas.ajax.reload();
//             tableCatTransacciones.ajax.reload();
//           }
//         }
//       );
//     }
//   );
// });

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

  // Obtener el ID del tipo desde el campo hidden
  let tipoIdValue = $("#tipoId").val();
  let esEdicion = tipoIdValue && tipoIdValue !== "";

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
          id_tipo: tipoIdValue || null,
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

  // Obtener el ID de la unidad desde el campo hidden
  let unidadIdValue = $("#unidadId").val();
  let esEdicion = unidadIdValue && unidadIdValue !== "";

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
          id_unidades: unidadIdValue || null,
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
  var tipoMovimiento = $("#registrarMotivoForm #motivoTipoMovimiento").val();
  console.log("Tipo de movimiento:", tipoMovimiento);

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
          api: 14,
          activo: activo,
          tipo_movimiento: tipoMovimiento,
          id_motivos: motivoIdValue || null,
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
          api: 17,
          id_proveedores: proveedorId || null,
          nombre: nombre,
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

// Filtrar tipos
$("#filtrarTiposForm").submit(function (event) {
  event.preventDefault();

  let activo = $('input[name="activoTipos"]:checked').val();

  if (activo === "1") {
    dataTableCatTipos = { api: 2 };
  } else if (activo === "0") {
    dataTableCatTipos = { api: 23 };
  } else {
    dataTableCatTipos = { api: 2 };
  }

  tableCatTipos.ajax.reload();
  $("#filtrarTiposModal").modal("hide");
  $("#registrarCatalogoModal").modal("show");
});

$("#resetFiltrosTiposBtn").click(function () {
  $("#filtrarTiposForm")[0].reset();
  dataTableCatTipos = { api: 2 };
  tableCatTipos.ajax.reload();
  $("#resetFiltrosTiposBtn").hide();
  $("#filtrarTiposModal").modal("hide");
  $("#registrarCatalogoModal").modal("show");
  alertToast("Filtros de tipos restablecidos", "success", 4000);
});

// Filtrar tipos
function toggleResetButtonTipos() {
  const anyRadioChecked = $('input[name="activoTipos"]:checked').length > 0;
  if (anyRadioChecked) {
    $("#resetFiltrosTiposBtn").show();
  } else {
    $("#resetFiltrosTiposBtn").hide();
  }
}

$("#resetFiltrosTiposBtn").hide();
$('input[type=radio][name="activoTipos"]').on("change", toggleResetButtonTipos);

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

  var accion = sustanciaId ? "UPDATE" : "CREATE";
  var tituloConfirm = sustanciaId
    ? "¿Actualizar sustancia activa?"
    : "¿Registrar nueva sustancia activa?";
  var textoConfirm = sustanciaId
    ? "Se actualizará la sustancia activa."
    : "Se creará una nueva sustancia activa.";

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
            var mensaje = sustanciaId
              ? "Sustancia actualizada exitosamente!"
              : "Sustancia registrada exitosamente!";
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
            var errorMsg =
              data.response.message || "Error al procesar la sustancia";
            alertToast(errorMsg, "error", 4000);
          }
        }
      );
    },
    1
  );
});
