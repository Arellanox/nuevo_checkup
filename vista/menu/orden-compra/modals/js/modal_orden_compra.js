// Registrar/Editar Proveedor
$("#registrarProveedorForm").submit(function (event) {
  event.preventDefault();

  var form = document.getElementById("registrarProveedorForm");
  var formData = new FormData(form);

  let proveedorId = $("#proveedorId").val();
  let nombre = $("#proveedorNombre").val().trim();
  let razonSocial = $("#proveedorRazonSocial").val().trim();
  let rfc = $("#proveedorRfc").val().trim();
  let contacto = $("#proveedorContacto").val().trim();
  let telefono = $("#proveedorTelefono").val().trim();
  let email = $("#proveedorEmail").val().trim();

  // Validación del nombre (obligatorio)
  if (!nombre) {
    $("#proveedorNombre").addClass("is-invalid");
    alertToast("El nombre del proveedor es obligatorio", "warning", 3000);
    return;
  }

  $("#proveedorNombre").removeClass("is-invalid");

  // Procesar archivos
  let constanciaFiscal = $("#proveedorConstanciaFiscal")[0].files[0];
  let caratulaBancaria = $("#proveedorCaratulaBancaria")[0].files[0];
  let comprobanteDomicilio = $("#proveedorComprobanteDomicilio")[0].files[0];

  // Procesar checkboxes
  var activo = $("#registrarProveedorForm #proveedorActivoCheck").is(":checked")
    ? 1
    : 0;
  var verificacionEfo = $(
    "#registrarProveedorForm #proveedorVerificacionEfo"
  ).is(":checked")
    ? 1
    : 0;

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
      // Crear objeto con todos los datos
      let datosProveedor = {
        api: 3,
        id_proveedores: proveedorId || null,
        nombre: nombre,
        razon_social: razonSocial || null,
        rfc: rfc || null,
        contacto: contacto || null,
        telefono: telefono || null,
        email: email || null,
        verificacion_efo: verificacionEfo,
        activo: activo,
      };

      // Agregar archivos si existen
      if (constanciaFiscal) {
        datosProveedor.constancia_situacion_fiscal = constanciaFiscal.name;
      }
      if (caratulaBancaria) {
        datosProveedor.caratula_bancaria = caratulaBancaria.name;
      }
      if (comprobanteDomicilio) {
        datosProveedor.comprobante_domicilio = comprobanteDomicilio.name;
      }

      ajaxAwaitFormData(
        datosProveedor,
        "orden_compra_api",
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

// Registrar/Editar Orden de Compra
$("#registrarOrdenCompraForm").submit(async function (event) {
  event.preventDefault();

  console.log("🔄 Iniciando guardado de orden de compra...");

  var form = document.getElementById("registrarOrdenCompraForm");
  var formData = new FormData(form);

  // Declarar variables fuera del try/catch para que tengan scope global
  let idOrdenCompra,
    numeroOrden,
    fechaOrden,
    estado,
    observaciones;

  try {
    idOrdenCompra = $("#ID_ORDEN_COMPRA").val();
    console.log("📋 1. ID Orden:", idOrdenCompra);

    numeroOrden = ($("#NUMERO_ORDEN_COMPRA").val() || "").trim();
    console.log("📋 2. Número Orden:", numeroOrden);

    fechaOrden = ($("#FECHA_ORDEN_COMPRA").val() || "").trim();
    console.log("📋 3. Fecha Orden:", fechaOrden);

    estado = ($("#ESTADO").val() || "").trim();
    console.log("📋 4. Estado:", estado);


    observaciones = ($("#OBSERVACIONES").val() || "").trim();
    console.log("📋 8. Observaciones:", observaciones);
  } catch (error) {
    console.error("❌ Error en la línea de obtención de valores:", error);
    alertToast("Error obteniendo datos del formulario", "error", 3000);
    return;
  }

  // Obtener proveedor principal del primer artículo (si hay artículos)
  let idProveedor = null;
  try {
    console.log("📋 9. Obteniendo proveedor...");
    if (typeof obtenerArticulosOrdenJSON !== "undefined") {
      console.log("📋 10. Función obtenerArticulosOrdenJSON existe");
      const articulosJson = obtenerArticulosOrdenJSON();
      console.log("📋 11. JSON artículos:", articulosJson);

      if (articulosJson) {
        const articulos = JSON.parse(articulosJson);
        console.log("📋 12. Artículos parseados:", articulos);

        if (articulos.length > 0) {
          idProveedor = articulos[0].id_proveedor;
          console.log("📋 13. Proveedor del primer artículo:", idProveedor);
        }
      }
    } else {
      console.log(
        "📋 Función obtenerArticulosOrdenJSON no existe - trabajando sin artículos"
      );
    }
  } catch (error) {
    console.error("❌ Error obteniendo proveedor:", error);
    idProveedor = null;
  }

  $("#NUMERO_ORDEN_COMPRA").removeClass("is-invalid");

  // Validación de la fecha (obligatoria)
  if (!fechaOrden) {
    $("#FECHA_ORDEN_COMPRA").addClass("is-invalid");
    alertToast("La fecha de orden es obligatoria", "warning", 3000);
    return;
  }

  $("#FECHA_ORDEN_COMPRA").removeClass("is-invalid");

  // Procesar checkboxes
  var activo = $("#registrarOrdenCompraForm #ACTIVO").is(":checked") ? 1 : 0;

  let esEdicion = idOrdenCompra && idOrdenCompra !== "";

  // Validar que haya artículos en la orden
  if (typeof obtenerArticulosOrdenJSON !== "undefined") {
    const articulosJson = obtenerArticulosOrdenJSON();
    const articulos = JSON.parse(articulosJson);

    if (articulos.length === 0) {
      alertToast(
        "Debe agregar al menos un artículo a la orden",
        "warning",
        3000
      );
      return;
    }

    // Validar que los artículos tengan datos completos
    const articulosIncompletos = articulos.filter(art => 
      !art.id_articulo || 
      !art.cantidad_solicitada || 
      art.cantidad_solicitada <= 0
    );

    if (articulosIncompletos.length > 0) {
      alertToast(
        "Algunos artículos tienen datos incompletos o inválidos. Verifique cantidades y precios.",
        "warning",
        4000
      );
      return;
    }
  }

  alertMensajeConfirm(
    {
      title: esEdicion
        ? "¿Está a punto de editar esta orden de compra?"
        : "¿Está a punto de registrar una nueva orden de compra?",
      text: "Asegúrate que los datos sean correctos.",
      icon: "warning",
    },
    function () {
      // Obtener detalles de artículos si la función existe
      let detallesArticulos = null;
      if (typeof obtenerArticulosOrdenJSON !== "undefined") {
        try {
          const articulosJson = obtenerArticulosOrdenJSON();
          console.log("📦 JSON de artículos obtenido:", articulosJson);
          
          if (articulosJson && articulosJson !== "[]") {
            detallesArticulos = articulosJson;
          }
        } catch (error) {
          console.error("❌ Error al obtener JSON de artículos:", error);
        }
      }

      // Crear objeto con todos los datos
      let datosOrdenCompra = {
        api: 5,
        id_orden_compra: idOrdenCompra || null,
        numero_orden: numeroOrden || null,
        fecha_orden: fechaOrden || null,
        estado: estado || null,
        id_proveedor: idProveedor || null, // Puede ser null si no hay artículos
        observaciones: observaciones || null,
        activo: activo,
        detalles_articulos: detallesArticulos // Agregar detalles de artículos
      };

      console.log("📋 Datos de la orden a enviar:", datosOrdenCompra);
      console.log("📦 Detalles de artículos enviados:", detallesArticulos);

      ajaxAwaitFormData(
        datosOrdenCompra,
        "orden_compra_api",
        "registrarOrdenCompraForm",
        { callbackAfter: true },
        false,
        function (data) {
          console.log("🎯 Respuesta del servidor para orden:", data);

          if (data.response.code == 1) {
            // Determinar el ID de la orden correctamente
            let ordenId;
            if (esEdicion) {
              ordenId = idOrdenCompra; // Para edición, usar el ID existente
            } else {
              ordenId = data.response.data; // Para nueva orden, usar el ID devuelto
            }

            console.log("🆔 ID de orden determinado:", ordenId);
            console.log("🆔 Es edición:", esEdicion);
            console.log("🆔 ID original:", idOrdenCompra);
            console.log("🆔 ID del servidor:", data.response.data);

            // Validar que tenemos un ID válido
            if (!ordenId || ordenId === null || ordenId === undefined) {
              console.error(
                "❌ Error: No se pudo determinar el ID de la orden"
              );
              alertToast(
                "Error: No se pudo obtener el ID de la orden guardada",
                "error",
                4000
              );
              return;
            }

            // Si no hay artículos o no existe la función, solo mostrar mensaje de éxito
            finalizarGuardadoOrden(esEdicion);
          } else {
            console.error("❌ Error al guardar orden:", data.response);
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

// Función para finalizar el proceso de guardado
function finalizarGuardadoOrden(esEdicion) {
  $("#registrarOrdenCompraForm")[0].reset();
  $("#registrarOrdenCompraModal").modal("hide");
  
  alertToast(
    esEdicion
      ? "Orden de compra actualizada correctamente!"
      : "Orden de compra registrada correctamente!",
    "success",
    4000
  );

  // Recargar tabla
  if (typeof tableCatOrdenesCompra !== 'undefined' && tableCatOrdenesCompra) {
    tableCatOrdenesCompra.ajax.reload();
  }
  
  // Limpiar artículos si existe la función
  if (typeof inicializarArticulosOrdenCompra !== 'undefined') {
    inicializarArticulosOrdenCompra();
  }
}