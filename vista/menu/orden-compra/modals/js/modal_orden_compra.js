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
