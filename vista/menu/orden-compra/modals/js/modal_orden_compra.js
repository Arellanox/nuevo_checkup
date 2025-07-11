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

// Validación en tiempo real del número de orden
let timeoutValidacion = null;

$("#NUMERO_ORDEN_COMPRA").on('input', function() {
  const numeroOrden = $(this).val().trim();
  const idOrdenActual = $("#ID_ORDEN_COMPRA").val();
  
  // Limpiar timeout anterior
  if (timeoutValidacion) {
    clearTimeout(timeoutValidacion);
  }
  
  // Limpiar estilos anteriores
  $(this).removeClass("is-valid is-invalid");
  
  if (numeroOrden.length >= 2) { // Solo validar si tiene al menos 2 caracteres
    // Esperar 800ms después de que el usuario pare de escribir
    timeoutValidacion = setTimeout(async () => {
      try {
        const validacion = await validarNumeroOrden(numeroOrden, idOrdenActual);
        
        if (validacion.esValido) {
          $("#NUMERO_ORDEN_COMPRA").addClass("is-valid").removeClass("is-invalid");
        } else {
          $("#NUMERO_ORDEN_COMPRA").addClass("is-invalid").removeClass("is-valid");
          
          // Mostrar sugerencia de número alternativo
          if (!idOrdenActual) { // Solo para nuevas órdenes
            const sugerencia = await generarNumeroOrdenAutomatico();
            $(this).next('.input-group').find('button').attr('title', 
              `El número ya existe. Sugerencia: ${sugerencia} (Clic para usar)`);
          }
        }
      } catch (error) {
        console.error('Error en validación en tiempo real:', error);
      }
    }, 800);
  }
});

// Limpiar validaciones al abrir el modal para nueva orden
$('#registrarOrdenCompraModal').on('show.bs.modal', function() {
  $("#NUMERO_ORDEN_COMPRA").removeClass("is-valid is-invalid");
  if (timeoutValidacion) {
    clearTimeout(timeoutValidacion);
  }
});

// Función para guardar detalles de artículos de la orden
function guardarDetallesOrdenCompra(idOrdenCompra, articulosJson, esEdicion) {
  console.log('💾 === INICIANDO GUARDADO DE DETALLES ===');
  console.log('💾 ID Orden recibido:', idOrdenCompra);
  console.log('💾 Tipo de ID:', typeof idOrdenCompra);
  console.log('💾 JSON de artículos:', articulosJson);
  console.log('💾 Es edición:', esEdicion);
  
  // 🚨 VALIDACIÓN CRÍTICA DEL ID
  console.log('🚨 === VALIDACIÓN CRÍTICA DEL ID ===');
  console.log('🚨 ID Original:', idOrdenCompra);
  console.log('🚨 Es null:', idOrdenCompra === null);
  console.log('🚨 Es undefined:', idOrdenCompra === undefined);
  console.log('🚨 Es string vacío:', idOrdenCompra === '');
  console.log('🚨 Es número:', !isNaN(idOrdenCompra));
  console.log('🚨 Es mayor que 0:', idOrdenCompra > 0);
  console.log('🚨 Conversión a número:', Number(idOrdenCompra));
  
  // Validar que el ID es válido
  if (!idOrdenCompra || idOrdenCompra === null || idOrdenCompra === undefined || idOrdenCompra === '' || isNaN(idOrdenCompra) || Number(idOrdenCompra) <= 0) {
    console.error('❌ Error: ID de orden inválido para guardar detalles');
    console.error('❌ ID problemático:', idOrdenCompra);
    alertToast('Error: ID de orden inválido para guardar detalles', 'error', 4000);
    return;
  }
  
  // Convertir a número para asegurar formato correcto
  const idOrdenFinal = Number(idOrdenCompra);
  console.log('✅ ID Final convertido:', idOrdenFinal);
  
  // Validar que hay artículos
  try {
    const articulos = JSON.parse(articulosJson);
    if (!articulos || articulos.length === 0) {
      console.warn('⚠️ No hay artículos para guardar');
      finalizarGuardadoOrden(esEdicion);
      return;
    }
    console.log('💾 Cantidad de artículos a guardar:', articulos.length);
    console.log('💾 Primer artículo de muestra:', articulos[0]);
  } catch (error) {
    console.error('❌ Error parseando JSON de artículos:', error);
    alertToast('Error en los datos de artículos', 'error', 4000);
    return;
  }
  
  const datosDetalles = {
    api: 8,
    id_orden_compra: idOrdenFinal,  // Usar ID convertido
    detalles_json: articulosJson
  };
  
  console.log('💾 === DATOS FINALES A ENVIAR ===');
  console.log('💾 API:', datosDetalles.api);
  console.log('💾 ID Orden Final:', datosDetalles.id_orden_compra);
  console.log('💾 Tipo ID Final:', typeof datosDetalles.id_orden_compra);
  console.log('💾 JSON Detalles:', datosDetalles.detalles_json);
  
  $.ajax({
    url: '../../../api/orden_compra_api.php',
    type: 'POST',
    dataType: 'json',
    data: datosDetalles,
    success: function (response) {
      console.log('💾 === RESPUESTA DEL SERVIDOR ===');
      console.log('💾 Respuesta completa:', response);
      console.log('💾 Código de respuesta:', response.response?.code);
      console.log('💾 Mensaje:', response.response?.message);
      
      if (response.response && response.response.code == 1) {
        console.log('✅ Detalles guardados exitosamente');
        finalizarGuardadoOrden(esEdicion);
      } else {
        console.error('❌ Error en respuesta del servidor:', response.response);
        
        // Mostrar información específica del error
        const mensaje = response.response?.message || response.response?.msj || 'Error desconocido';
        console.error('❌ Mensaje de error específico:', mensaje);
        
        alertToast(
          'La orden se guardó pero hubo un error al guardar los artículos: ' + mensaje,
          'warning',
          6000
        );
        
        // Log adicional para debugging
        console.error('❌ Para reproducir el error, ejecuta en DB:');
        console.error(`❌ CALL sp_inventarios_orden_compra_detalle_g(${idOrdenFinal}, '${articulosJson}')`);
      }
    },
    error: function (xhr, status, error) {
      console.error('❌ === ERROR AJAX COMPLETO ===');
      console.error('❌ Status HTTP:', xhr.status);
      console.error('❌ Status Texto:', status);
      console.error('❌ Error:', error);
      console.error('❌ Response Text completo:', xhr.responseText);
      console.error('❌ Headers de respuesta:', xhr.getAllResponseHeaders());
      
      // Intentar parsear la respuesta como JSON si es posible
      try {
        const errorResponse = JSON.parse(xhr.responseText);
        console.error('❌ Error parseado como JSON:', errorResponse);
      } catch (e) {
        console.error('❌ No se pudo parsear la respuesta de error como JSON');
      }
      
      alertToast(
        'La orden se guardó pero hubo un error de conexión al guardar los artículos',
        'warning',
        4000
      );
    }
  });
}

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

// Función para validar número de orden
async function validarNumeroOrden(numeroOrden, idOrdenActual = null) {
  return new Promise((resolve, reject) => {
    $.ajax({
      url: '../../../api/orden_compra_api.php',
      type: 'POST',
      dataType: 'json',
      data: {
        api: 10,
        numero_orden: numeroOrden,
        id_orden_compra: idOrdenActual
      },
      success: function(response) {
        if (response.response && response.response.code == 1) {
          const existe = response.response.data.existe;
          resolve({
            esValido: !existe,
            mensaje: existe ? `El número de orden "${numeroOrden}" ya existe. Ingrese un número diferente.` : 'Número válido'
          });
        } else {
          reject(new Error('Error en la validación'));
        }
      },
      error: function(xhr, status, error) {
        console.error('Error validando número de orden:', error);
        reject(new Error('Error de conexión'));
      }
    });
  });
}

// Función para generar número de orden automático
async function generarNumeroOrdenAutomatico() {
  const ahora = new Date();
  const año = ahora.getFullYear().toString().slice(-2);
  const mes = (ahora.getMonth() + 1).toString().padStart(2, '0');
  const dia = ahora.getDate().toString().padStart(2, '0');
  
  // Formato: OC-YYMMDD-XXX (donde XXX es un contador)
  const prefijo = `OC-${año}${mes}${dia}`;
  
  for (let i = 1; i <= 999; i++) {
    const numero = `${prefijo}-${i.toString().padStart(3, '0')}`;
    
    try {
      const validacion = await validarNumeroOrden(numero);
      if (validacion.esValido) {
        return numero;
      }
    } catch (error) {
      console.error('Error validando número automático:', error);
      break;
    }
  }
  
  // Si no encuentra uno disponible, usar timestamp
  return `OC-${Date.now()}`;
}

// Función para el botón de generar número automático
async function generarNumeroAutomatico() {
  try {
    $("#NUMERO_ORDEN_COMPRA").prop('disabled', true);
    const numeroGenerado = await generarNumeroOrdenAutomatico();
    $("#NUMERO_ORDEN_COMPRA").val(numeroGenerado);
    $("#NUMERO_ORDEN_COMPRA").removeClass("is-invalid");
    alertToast(`Número generado: ${numeroGenerado}`, "success", 3000);
  } catch (error) {
    console.error('Error generando número:', error);
    alertToast("Error al generar número automático", "error", 3000);
  } finally {
    $("#NUMERO_ORDEN_COMPRA").prop('disabled', false);
  }
}

// Registrar/Editar Orden de Compra
$("#registrarOrdenCompraForm").submit(async function (event) {
  event.preventDefault();
  
  console.log('🔄 Iniciando guardado de orden de compra...');

  var form = document.getElementById("registrarOrdenCompraForm");
  var formData = new FormData(form);

  // Declarar variables fuera del try/catch para que tengan scope global
  let idOrdenCompra, numeroOrden, fechaOrden, estado, subtotal, iva, total, observaciones;

  try {
    idOrdenCompra = $("#ID_ORDEN_COMPRA").val();
    console.log('📋 1. ID Orden:', idOrdenCompra);
    
    numeroOrden = ($("#NUMERO_ORDEN_COMPRA").val() || "").trim();
    console.log('📋 2. Número Orden:', numeroOrden);
    
    fechaOrden = ($("#FECHA_ORDEN_COMPRA").val() || "").trim();
    console.log('📋 3. Fecha Orden:', fechaOrden);
    
    estado = ($("#ESTADO").val() || "").trim();
    console.log('📋 4. Estado:', estado);
    
    subtotal = ($("#SUBTOTAL").val() || "0").trim();
    console.log('📋 5. Subtotal:', subtotal);
    
    iva = ($("#IVA").val() || "0").trim();
    console.log('📋 6. IVA:', iva);
    
    total = ($("#TOTAL").val() || "0").trim();
    console.log('📋 7. Total:', total);
    
    observaciones = ($("#OBSERVACIONES").val() || "").trim();
    console.log('📋 8. Observaciones:', observaciones);
  } catch(error) {
    console.error('❌ Error en la línea de obtención de valores:', error);
    alertToast("Error obteniendo datos del formulario", "error", 3000);
    return;
  }
  
  // Obtener proveedor principal del primer artículo (si hay artículos)
  let idProveedor = null;
  try {
    console.log('📋 9. Obteniendo proveedor...');
    if (typeof obtenerArticulosOrdenJSON !== 'undefined') {
      console.log('📋 10. Función obtenerArticulosOrdenJSON existe');
      const articulosJson = obtenerArticulosOrdenJSON();
      console.log('📋 11. JSON artículos:', articulosJson);
      
      if (articulosJson) {
        const articulos = JSON.parse(articulosJson);
        console.log('📋 12. Artículos parseados:', articulos);
        
        if (articulos.length > 0) {
          idProveedor = articulos[0].id_proveedor;
          console.log('📋 13. Proveedor del primer artículo:', idProveedor);
        }
      }
    } else {
      console.log('📋 Función obtenerArticulosOrdenJSON no existe - trabajando sin artículos');
    }
  } catch(error) {
    console.error('❌ Error obteniendo proveedor:', error);
    idProveedor = null;
  }

  // Validación del número de orden (obligatorio)
  if (!numeroOrden) {
    $("#NUMERO_ORDEN_COMPRA").addClass("is-invalid");
    alertToast("El número de orden es obligatorio", "warning", 3000);
    return;
  }

  $("#NUMERO_ORDEN_COMPRA").removeClass("is-invalid");
  
  // Validar si el número de orden ya existe
  console.log('🔍 Validando número de orden:', numeroOrden);
  
  try {
    const validacionOrden = await validarNumeroOrden(numeroOrden, idOrdenCompra);
    if (!validacionOrden.esValido) {
      $("#NUMERO_ORDEN_COMPRA").addClass("is-invalid");
      alertToast(validacionOrden.mensaje, "warning", 4000);
      return;
    }
    console.log('✅ Número de orden válido');
  } catch (error) {
    console.error('❌ Error validando número de orden:', error);
    alertToast("Error al validar el número de orden", "error", 3000);
    return;
  }

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
  if (typeof obtenerArticulosOrdenJSON !== 'undefined') {
    const articulosJson = obtenerArticulosOrdenJSON();
    const articulos = JSON.parse(articulosJson);
    
    if (articulos.length === 0) {
      alertToast("Debe agregar al menos un artículo a la orden", "warning", 3000);
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
      // Crear objeto con todos los datos  
      let datosOrdenCompra = {
        api: 5,
        id_orden_compra: idOrdenCompra || null,
        numero_orden: numeroOrden || null,
        fecha_orden: fechaOrden || null,
        estado: estado || null,
        id_proveedor: idProveedor || null, // Puede ser null si no hay artículos
        subtotal: subtotal || 0,
        iva: iva || 0,
        total: total || 0,
        observaciones: observaciones || null,
        activo: activo,
      };
      
      console.log('📋 Datos de la orden a enviar:', datosOrdenCompra);

      ajaxAwaitFormData(
        datosOrdenCompra,
        "orden_compra_api",
        "registrarOrdenCompraForm",
        { callbackAfter: true },
        false,
        function (data) {
          console.log('🎯 Respuesta del servidor para orden:', data);
          
          if (data.response.code == 1) {
            // Determinar el ID de la orden correctamente
            let ordenId;
            if (esEdicion) {
              ordenId = idOrdenCompra; // Para edición, usar el ID existente
            } else {
              ordenId = data.response.data; // Para nueva orden, usar el ID devuelto
            }
            
            console.log('🆔 ID de orden determinado:', ordenId);
            console.log('🆔 Es edición:', esEdicion);
            console.log('🆔 ID original:', idOrdenCompra);
            console.log('🆔 ID del servidor:', data.response.data);
            
            // Validar que tenemos un ID válido
            if (!ordenId || ordenId === null || ordenId === undefined) {
              console.error('❌ Error: No se pudo determinar el ID de la orden');
              alertToast("Error: No se pudo obtener el ID de la orden guardada", "error", 4000);
              return;
            }
            
            // Si se guardó correctamente, ahora guardar los detalles de artículos
            if (typeof obtenerArticulosOrdenJSON !== 'undefined') {
              const articulosJson = obtenerArticulosOrdenJSON();
              
              if (articulosJson && JSON.parse(articulosJson).length > 0) {
                console.log('💾 Iniciando guardado de detalles con ID:', ordenId);
                guardarDetallesOrdenCompra(ordenId, articulosJson, esEdicion);
                return;
              }
            }
            
            // Si no hay artículos o no existe la función, solo mostrar mensaje de éxito
            finalizarGuardadoOrden(esEdicion);
          } else {
            console.error('❌ Error al guardar orden:', data.response);
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
