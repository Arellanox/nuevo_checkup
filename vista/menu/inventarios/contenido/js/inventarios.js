$(document).ready(function () {
  // Oculta el botón de agregar al cargar la página
  $("#btnAgregar").hide();
  $("#btnRegistrar").hide();

  /*  $('a[data-target="moduloCatEntradas"] span').on('click', function () {
  if (typeof tableCatEntradas !== "undefined") {
    tableCatEntradas.ajax.reload();
  }
  if (typeof tableCatDetallesEntradas !== "undefined") {
    tableCatDetallesEntradas.ajax.reload();
  }
  }); */

  // Al hacer clic en un enlace del menú
  $(".vertical-menu a").on("click", function (e) {
    e.preventDefault(); // Evita que el enlace navegue

    // Obtiene el ID del div que debe mostrarse
    var targetDiv = $(this).data("target");

    // Oculta todos los divs con la clase 'content-module'
    $(".content-module").hide();

    // Oculta el menú principal
    $("#tab-menu").hide();

    // Muestra el botón de agregar solo si el div es 'moduloCatArticulos'
    if (targetDiv == "moduloCatArticulos") {
      $("#btnAgregar").show();
      $("#btnRegistrar").show();
    } else {
      $("#btnAgregar").hide();
      $("#btnRegistrar").hide();
    }

    /*muestra el boton en entradas
        if (targetDiv == 'moduloCatEntradas') {
            $('#btnRegistrar').show();
        } else {
            $('#btnRegistrar').hide();
        }*/

    // Muestra el div correspondiente al enlace clicado
    $("#" + targetDiv).show();
  });

  // Agrega el botón para regresar a cada módulo de contenido al lado del título
  $(".content-module").each(function () {
    var $header = $(this).find("> .d-flex.align-items-start");
    // Busca el h2 dentro del header
    var $title = $header.find("h2");
    // Si no existe el botón, lo agrega después del h2
    if ($title.length && $header.find(".btn-back-menu").length === 0) {
      $title.before(
        '<button type="button" class="btn btn-secondary btn-back-menu px-2"><i class="bi bi-arrow-left"></i> Regresar</button>'
      );
    }
  });

  let lastNombreComercial = "";
  $("#nombre_comercial").on("input", function () {
    lastNombreComercial = $(this).val();
  });
  $("#tipo_articulo").on("change", function () {
    setTimeout(function () {
      if ($("#nombre_comercial").val() === "") {
        $("#nombre_comercial").val(lastNombreComercial);
      }
    }, 100);
  });

  // Al hacer clic en el botón regresar
  $(document).on("click", ".btn-back-menu", function () {
    $(".content-module").hide();
    $("#tab-menu").show();
    $("#btnAgregar").hide();
    rowSelected = null; // Resetea la selección de fila
    rowSelectedRequisicion = null; // Resetea la selección de requisiciones
    $("#btnRegistrar").hide();
    $("#btnEditarRequisicion").prop("disabled", true); // Deshabilita botón de editar requisiciones
    $("#titulosEntradasSalidas").text("Entradas");
  });

  // ocultar/mostrar fecha de caducidad segun el checkbox y que sea obligatorio
  $("#maneja_caducidad").trigger("change");
  $("#tipo_articulo").trigger("change");
});

$("#maneja_caducidad").on("change", function () {
  if ($(this).val() == "1") {
    $("#fechaCaducidadDiv").show();
    $("#fecha_caducidad").attr("required", true);
  } else {
    $("#fechaCaducidadDiv").hide();
    $("#fecha_caducidad").val("");
    $("#fecha_caducidad").removeAttr("required");
    $("#fecha_caducidad").removeClass("is-invalid");
  }
});

var buttonsArticulos = [];

if (edit == 1) {
  buttonsArticulos.push({
    // BOTON PARA EDITAR
    text: '<i class="bi bi-pencil-square"></i> Editar',
    className: "btn btn-secondary",
    attr: {
      //disabled: true,
      id: "btnEditarArticulo",
      "data-bs-toggle": "tooltip",
      "data-bs-placement": "top",
      title: "Editar el artículo seleccionado",
      disabled: !userPermissions.canEdit,
    },
    action: function () {
      if (rowSelected) {
        // Configurar el modal para edición con el ID del artículo
        if (typeof window.configurarModalEdicion === "function") {
          window.configurarModalEdicion(rowSelected.ID_ARTICULO);
        }

        $("#editarArticuloModal").modal("show");
        $("#editandoArticulo").text(` ${rowSelected.CLAVE_ART}`);

        // Colocar los valores básicos al formulario
        $("#editarArticuloForm #clave_art").val(rowSelected.CLAVE_ART);
        $("#editarArticuloForm #nombre_comercial").val(rowSelected.NOMBRE_COMERCIAL);

        // Estatus
        if (rowSelected.ESTATUS == 1) {
          $("#editarArticuloForm #estatus").prop("checked", true);
        } else {
          $("#editarArticuloForm #estatus").prop("checked", false);
        }

        // Campos básicos
        $("#editarArticuloForm #red_frio").val(rowSelected.RED_FRIO);
        $("#editarArticuloForm #unidad_minima").val(rowSelected.UNIDAD_MINIMA);
        $("#editarArticuloForm #contenido").val(rowSelected.CONTENIDO);
        $("#editarArticuloForm #codigo_barras").val(rowSelected.codigo_barras);

        // Campos de rendimiento
        $("#editarArticuloForm #maneja_rendimiento").val(rowSelected.MANEJA_RENDIMIENTO || "1");
        $("#editarArticuloForm #maneja_inserto").val(rowSelected.MANEJA_INSERTO || "1");
        $("#editarArticuloForm #rendimiento_estimado").val(rowSelected.RENDIMIENTO_ESTIMADO);
        $("#editarArticuloForm #rendimiento_paciente").val(rowSelected.RENDIMIENTO_PACIENTE);

        // Usar la función existente para establecer valores de selects
        setTimeout(function() {
          // Asegurar que rowSelected esté disponible globalmente
          window.rowSelected = rowSelected;
          
          establecerValoresFormularioEditar();
          
          // Cargar proveedores después de que se carguen los catálogos
          setTimeout(function() {
            if (typeof window.cargarProveedoresExistentes === "function") {
              window.cargarProveedoresExistentes(rowSelected.ID_ARTICULO);
            }
          }, 500);
        }, 200);
        $("#editarArticuloForm #inserto").val(rowSelected.INSERTO);

        // Agregar la configuración para maneja_inserto
        if (typeof rowSelected.MANEJA_INSERTO !== "undefined") {
          $("#editarArticuloForm #maneja_inserto").val(
            rowSelected.MANEJA_INSERTO
          );
        } else {
          // Si no existe en el objeto, determinar su valor según si hay datos o no
          // Si hay un valor en INSERTO, significa que debemos mostrarlo (0), de lo contrario ocultarlo (1)
          $("#editarArticuloForm #maneja_inserto").val(
            rowSelected.INSERTO && rowSelected.INSERTO.trim() !== "" ? "0" : "1"
          );
        }

        // Agregar la configuración para maneja_rendimiento
        if (typeof rowSelected.MANEJA_RENDIMIENTO !== "undefined") {
          $("#editarArticuloForm #maneja_rendimiento").val(
            rowSelected.MANEJA_RENDIMIENTO
          );
        } else {
          // Si no existe en el objeto, determinar su valor según si hay datos o no
          // Si hay un valor en RENDIMIENTO_ESTIMADO, significa que debemos mostrarlo (0), de lo contrario ocultarlo (1)
          $("#editarArticuloForm #maneja_rendimiento").val(
            rowSelected.RENDIMIENTO_ESTIMADO &&
              rowSelected.RENDIMIENTO_ESTIMADO.toString() !== "0"
              ? "0"
              : "1"
          );
        }

        // Función para actualizar la visibilidad de los campos de inserto
        function actualizarInsertoEditar() {
          if ($("#editarArticuloForm #maneja_inserto").val() == "0") {
            $("#editarArticuloForm #insertoDiv").show();
            $("#editarArticuloForm #protocoloDiv").show();
          } else {
            $("#editarArticuloForm #insertoDiv").hide();
            $("#editarArticuloForm #protocoloDiv").hide();
            $("#editarArticuloForm #inserto").val("");
            $("#editarArticuloForm #procedimiento").val("");
          }
        }

        // Función para actualizar la visibilidad de los campos de rendimiento
        function actualizarRendimientoEditar() {
          if ($("#editarArticuloForm #maneja_rendimiento").val() == "0") {
            $("#editarArticuloForm #rendimientoEstimadoDiv").show();
            $("#editarArticuloForm #rendimientoPacienteDiv").show();
          } else {
            $("#editarArticuloForm #rendimientoEstimadoDiv").hide();
            $("#editarArticuloForm #rendimientoPacienteDiv").hide();
            $("#editarArticuloForm #rendimiento_estimado").val("");
            $("#editarArticuloForm #rendimiento_paciente").val("");
          }
        }

        // Ejecutar las funciones al cargar el formulario
        actualizarInsertoEditar();
        actualizarRendimientoEditar();

        // Configurar eventos onChange
        $("#editarArticuloForm #maneja_inserto")
          .off("change")
          .on("change", actualizarInsertoEditar);

        $("#editarArticuloForm #maneja_rendimiento")
          .off("change")
          .on("change", actualizarRendimientoEditar);
      }
    },
  });
}

if (supr == 1) {
  buttonsArticulos.push({
    // BOTON PARA ELIIMAR
    text: '<i class="bi bi-trash-fill"></i> Eliminar',
    className: "btn btn-secondary",
    attr: {
      id: "btnEliminarArticulo",
      "data-bs-toggle": "tooltip",
      "data-bs-placement": "top",
      title: "Borrar un artículo permanentemente",
      disabled: !userPermissions.canDelete,
    },
    action: function () {
      if (rowSelected) {
        // procedimiento para eliminar un articulo
        alertMensajeConfirm(
          {
            title: "Estás eliminando " + rowSelected.NOMBRE_COMERCIAL + "",
            text: "¿Desea continuar?.",
            icon: "warning",
          },
          function () {
            ajaxAwait(
              {
                api: 4,
                id_articulo: rowSelected.ID_ARTICULO,
              },
              "inventarios_api",
              { callbackAfter: true },
              false,
              function (data) {
                if (data.response.code == 1) {
                  alertToast("Artículo eliminado!", "success", 4000);
                  tableCatArticulos.ajax.reload();
                }
              }
            );
          },
          1
        );
      } else {
        alertToast("Por favor, seleccione un artículo", "info", 4000);
      }
    },
  });
}

buttonsArticulos.push({
  // BOTON PARA FILTRAR LA TABLA
  text: '<i class="bi bi-funnel"></i> Filtrar',
  className: "btn btn-warning",
  attr: {
    id: "btnFiltrarArticulos",
    "data-bs-toggle": "tooltip",
    "data-bs-placement": "top",
    title: "Filtrar los artículos de la tabla",
  },
  action: function () {
    // procedimiento para filtrar la tabla
    $("#filtrarArticuloModal").modal("show");
  },
});

// DATATABLE DE ARTICULOS
tableCatArticulos = $("#tableCatArticulos").DataTable({
  language: {
    url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json",
  },
  order: [[0, "desc"]],
  autoWidth: true,
  lengthChange: false,
  info: true,
  paging: true,
  scrollY: "68vh",
  scrollX: true,
  scrollCollapse: true,
  fixedHeader: true,
  ajax: {
    dataType: "json",
    data: function (d) {
      return $.extend(d, dataTableCatArticulos);
    },
    // data: { api: 2, equipo: id_equipos },
    method: "POST",
    url: "../../../api/inventarios_api.php",
    error: function (jqXHR, textStatus, errorThrown) {
      alertErrorAJAX(jqXHR, textStatus, errorThrown);
    },
    dataSrc: "response.data",
  },
  // createdRow: function (row, data, dataIndex) {
  //     if (data.FINALIZADO == 0) {
  //         $(row).addClass('bg-warning text-black');
  //     } else if (data.FINALIZADO == 1) {
  //     }
  // },
  columns: [
    { data: "CLAVE_ART" },
    {
      data: "IMAGEN",
      render: function (data, type, row) {
        if (data) {
          return (
            '<a href="' +
            data +
            '" target="_blank"><img src="' +
            data +
            '" alt="Imagen del Artículo" style="width: 50px; height: auto;"/></a>'
          );
        } else {
          return "";
        }
      },
      className: "text-center",
    },
    { data: "NOMBRE_COMERCIAL" },
    /*
        { 
            data: 'COSTO_ULTIMA_ENTRADA',
            render: function(data, type, row) {
                if ($.isNumeric(data)) {
                    return '$' + Number(data).toLocaleString('es-MX', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
                } else {
                    return '$0.00';
                }
            }
        },
        {
            data: 'FECHA_ULTIMA_ENTRADA',
            render: function(data, type, row) {
                if (
                    data &&
                    data !== "0000-00-00" &&
                    data !== "0000-00-00 00:00:00"
                ) {
                    return data.split(' ')[0];
                } else {
                    return '';
                }
            }
        },*/

    //{ data: 'ESTATUS' },
    { data: "MARCAS" },
    {
      data: "ESTATUS",
      render: function (data, type, row) {
        if (data == 0) {
          return '<i class="bi bi-toggle-off fs-4"></i>';
        } else {
          return '<i class="bi bi-toggle-on fs-4 text-success"></i>';
        }
      },
    },
    {
      data: "RED_FRIO",
      render: function (data, type, row) {
        if (data == 1) {
          return '<i class="bi bi-snow2 text-primary fs-4" title="Refrigerado"></i>'; // Ícono de copo de nieve en azul
        } else {
          return '<i class="bi bi-thermometer-half text-warning fs-4" title="Temperatura ambiente"></i>'; // Ícono de termómetro en rojo
        }
      },
      className: "text-center",
    },
    { data: "UNIDAD_DESCRIPCION" },
    { data: "UNIDAD_MINIMA" },
    { data: "CONTENIDO" },
    { data: "TIPO_DESCRIPCION" },
    {
      data: "MANEJA_CADUCIDAD",
      render: function (data, type, row) {
        if (data == 1) {
          return '<i class="bi bi-check-circle-fill text-success"></i>';
        } else {
          return '<i class="bi bi-x-circle-fill text-danger"></i>';
        }
      },
      className: "text-center",
    },
    {
      data: "FECHA_CADUCIDAD",
      render: function (data, type, row) {
        if (data && data !== "0000-00-00" && data !== "0000-00-00 00:00:00") {
          const today = new Date();
          const caducidad = new Date(data);
          today.setHours(0, 0, 0, 0);
          caducidad.setHours(0, 0, 0, 0);
          const diffTime = caducidad - today;
          const diffDays = Math.round(diffTime / (1000 * 60 * 60 * 24));
          if (diffDays === 0 || diffDays < 0) {
            return `<span style="color:red;font-weight:bold;">${data}</span>`;
          } else if (diffDays >= 1 && diffDays <= 7) {
            return `<span style="color:goldenrod;font-weight:bold;">${data}</span>`;
          }
          return data;
        } else {
          return "Sin caducidad";
        }
      },
    },
    { data: "AREA" },
    {
      data: "COSTO_MAS_ALTO",
      render: function (data, type, row) {
        if ($.isNumeric(data)) {
          return (
            "$" +
            Number(data).toLocaleString("es-MX", {
              minimumFractionDigits: 2,
              maximumFractionDigits: 2,
            })
          );
        } else {
          return "$0.00";
        }
      },
    },
    {
      data: "INSERTO",
      render: function (data, type, row) {
        if (data) {
          return (
            '<a href="' +
            data +
            '" target="_blank"><i class="bi bi-file-earmark-pdf-fill text-danger fs-4"></i></a>'
          );
        } else {
          return data;
        }
      },
      className: "text-center",
    },
    {
      data: "PROCEDIMIENTO_PRUEBA",
      render: function (data, type, row) {
        if (data) {
          return (
            '<a href="' +
            data +
            '" target="_blank"><i class="bi bi-file-earmark-pdf-fill text-danger fs-4"></i></a>'
          );
        } else {
          return "";
        }
      },
      className: "text-center",
    },
    { data: "clave_art_sys" },
    { data: "numero_lote" },
    /* COMENTADO: Fecha de lote ya no es requerida
    {
      data: "fecha_lote",
      render: function (data, type, row) {
        if (
          !data ||
          data === "0000-00-00" ||
          data === "0000-00-00 00:00:00" ||
          data === "0000000000"
        ) {
          return "";
        }
        return data;
      },
    },
    */
    { data: "codigo_barras" },
    { data: "SUSTANCIA_ACTIVA" },
    { data: "PROVEEDORES" },
  ],
  columnDefs: [
    // Ajusta los anchos de columna según el contenido esperado
    { targets: "_all", className: "text-center align-middle" },
    { target: 0, title: "Clave Art", className: "all" },
    { target: 1, title: "Imágen del artículo", className: "all" },
    { target: 2, title: "Nombre comercial", className: "all" },
    { target: 3, title: "Marca", className: "all" },
    { target: 4, title: "Estatus", className: "all" },
    { target: 5, title: "Red frío", className: "all" },
    { target: 6, title: "Unid. venta", className: "all" },
    { target: 7, title: "Stock mínimo", className: "all", visible: false },
    { target: 8, title: "Especificaciones", className: "all", visible: false },
    { target: 9, title: "Tipo", className: "all" },
    { target: 10, title: "Maneja caducidad", className: "all", visible: false },
    { target: 11, title: "Fecha caducidad", className: "all" },
    { target: 12, title: "Área", className: "all" },
    { target: 13, title: "Costo más alto", className: "all", visible: false },
    { target: 14, title: "Inserto", className: "all", visible: false },
    { target: 15, title: "Proc. de prueba", className: "all", visible: false },
    { target: 16, title: "CAS", className: "all" },
    { target: 17, title: "Número de lote", className: "all", visible: false },
    { target: 18, title: "Fecha de lote", className: "all" },
    { target: 19, title: "Código de barras", className: "all", visible: false },
    { target: 20, title: "Sustancia", className: "all", visible: false },
    { target: 21, title: "Proveedores", className: "all", visible: false },
  ],
  dom: 'Bl<"dataTables_toolbar">frtip',
  buttons: buttonsArticulos,
});

var buttonsEntradas = [];

if (editEntradas == 1) {
  buttonsEntradas.push({
    // Boton para registrar entrada o salida
    text: '<i class="bi bi-plus"></i> Registrar movimiento',
    className: "btn btn-secondary",
    attr: {
      //disabled: true,
      id: "btnRegistrarEntrada",
      "data-bs-toggle": "tooltip",
      "data-bs-placement": "top",
      title: "Registrar movimiento del artículo seleccionado",
      disabled: !userPermissions.canEditEntradas,
    },
    action: function () {
      if (rowSelected) {
        $("#registrarEntradaModal").modal("show");
        $("#registrandoEntrada").text(
          ` ${rowSelected.NOMBRE_COMERCIAL} (Clave: ${rowSelected.CLAVE_ART})`
        );
        $("#registrandoCantidad").text(` ${rowSelected.CANTIDAD}`);

        // Colocar los valores al formulario
        $("#registrarEntradaForm #no_art").val(rowSelected.ID_ARTICULO);
        $("#registrarEntradaForm #nombre_comercial").val(
          rowSelected.NOMBRE_COMERCIAL
        );
        $("#registrarEntradaForm #id_proveedores option").each(function () {
          if ($(this).text().trim() === (rowSelected.PROVEEDOR || "").trim()) {
            $("#registrarEntradaForm #id_proveedores").val($(this).val());
          }
        });

        if (rowSelected.ESTATUS == 1) {
          $("#registrarEntradaForm #estatus").prop("checked", true);
        } else {
          $("#registrarEntradaForm #estatus").prop("checked", false);
        }

        // AGREGAR: Consultar si el artículo maneja caducidad
        if (typeof consultarManejaCaducidadRegistrar === "function") {
          consultarManejaCaducidadRegistrar(rowSelected.ID_ARTICULO);
        }
      } else {
        alertToast("Por favor, seleccione un artículo", "info", 4000);
      }
    },
  });
}

buttonsEntradas.push({
  text: '<i class="bi bi-funnel"></i> Tipo de movimiento',
  className: "btn-tipo-rad btn btn-warning",
  attr: {
    id: "btnFiltroTipoMovimiento",
    "data-bs-toggle": "tooltip",
    "data-bs-placement": "top",
    title: "Filtrar por tipo de movimiento",
  },
  action: function (e, dt, node, config) {
    rowSelected = null; // Resetea la selección de fila
    // Si el menú ya existe, lo elimina (oculta)
    if ($("#dropdownTipoMovimientoMenu").length > 0) {
      $("#dropdownTipoMovimientoMenu").remove();
      $(document).off("mousedown.dropdownTipoMovimiento");
      return;
    }
    // Si no existe, lo crea y muestra
    var $menu = $(`
    <div id="dropdownTipoMovimientoMenu" class="dropdown-menu show" style="position:absolute;z-index:9999;min-width:180px;">
      <button class="dropdown-item" data-value="1"><i class="bi bi-box-arrow-in-down"></i> Entradas</button>
      <button class="dropdown-item" data-value="2"><i class="bi bi-box-arrow-up"></i> Salidas</button>
    </div>
  `);

    // Posiciona el menú debajo del botón
    var offset = $(node).offset();
    $menu.css({
      top: offset.top + $(node).outerHeight(),
      left: offset.left,
    });

    $("body").append($menu);

    // Evento para seleccionar opción
    // $menu.on("click", ".dropdown-item", function () {
    //   var tipo = $(this).data("value");
    //   window.dataTableCatEntradas = window.dataTableCatEntradas || {};
    //   dataTableCatEntradas.id_movimiento = tipo;
    //   tableCatEntradas.ajax.reload();

    //   // Cambia visibilidad y títulos de columnas según el tipo de movimiento
    //   if (tipo == "1") {
    //     // Entradas
    //     $("#titulosEntradasSalidas").text("Entradas");
    //     tableCatEntradas.column(3).visible(true);
    //     tableCatEntradas.column(7).header().textContent = "Motivo de entrada";
    //     tableCatEntradas.column(4).header().textContent =
    //       "Fecha última entrada";
    //     tableCatEntradas.column(5).visible(true);
    //     tableCatEntradas.column(6).visible(true);
    //     tableCatDetallesEntradas.column(3).header().textContent =
    //       "Cantidad de entrada";
    //     tableCatDetallesEntradas.column(0).visible(true);
    //     tableCatDetallesEntradas.column(1).header().textContent =
    //       "Fecha y hora última entrada";
    //     tableCatDetallesEntradas.column(1).visible(true);
    //     tableCatDetallesEntradas.column(2).visible(true);
    //     tableCatDetallesEntradas.column(6).header().textContent =
    //       "Motivo de entrada";
    //     tableCatDetallesEntradas.column(7).visible(true);
    //     detalleEntradaLabel.textContent = "Detalles de entrada";

    //     //cambiar dep osicion post
    //     tableCatDetallesEntradas.column(10).visible(true);
    //     tableCatDetallesEntradas.column(11).visible(true);

    //     //Editar en detalles entradas
    //     cantidadEditarMovLabel.textContent = "Cantidad a ingresar";
    //     $("#editarMovimientoModal #costoUltimaEntradaDiv").show();
    //     $("#editarMovimientoModal #costo_ultima_entrada").prop(
    //       "required",
    //       true
    //     );
    //     $("#editarMovimientoModal #proveedorDiv").show();
    //     $("#editarMovimientoModal #id_proveedores").prop("required", true);
    //     $("#editarMovimientoModal .modal-title").html(
    //       'Editando entrada con fecha: <span id="mostrandoDetallesEntrada"></span>'
    //     );
    //     $("#editarMovimientoModal #motivo_salida_label").text(
    //       "Motivo de entrada"
    //     );

    //     $("#editarMovimientoModal #facturaEditDiv").show();
    //     $("#editarMovimientoModal #img_factura").prop("required", false);

    //     // AGREGAR: Mostrar campos de lote y caducidad para entradas
    //     $("#editarMovimientoModal #lotesCaducidadEditDiv").show();
    //     $("#editarMovimientoModal #ordenCompraDiva").show();
    //   } else {
    //     // Salidas
    //     $("#titulosEntradasSalidas").text("Salidas");
    //     tableCatEntradas.column(3).visible(false); // Oculta costo última entrada
    //     tableCatEntradas.column(7).header().textContent = "Motivo de salida";
    //     tableCatEntradas.column(4).header().textContent = "Fecha última salida";
    //     tableCatEntradas.column(5).visible(false); // Oculta costo más alto
    //     tableCatEntradas.column(6).visible(false); // Oculta proveedor
    //     tableCatDetallesEntradas.column(3).header().textContent =
    //       "Cantidad de salida";
    //     tableCatDetallesEntradas.column(0).visible(false);
    //     tableCatDetallesEntradas.column(1).header().textContent =
    //       "Fecha y hora última salida";
    //     tableCatDetallesEntradas.column(1).visible(true);
    //     tableCatDetallesEntradas.column(2).visible(false);
    //     tableCatDetallesEntradas.column(6).header().textContent =
    //       "Motivo de salida";
    //     tableCatDetallesEntradas.column(7).visible(false);
    //     tableCatDetallesEntradas.columns.adjust().draw();
    //     detalleEntradaLabel.textContent = "Detalles de salida";

    //     //Editar en detalles salidas
    //     cantidadEditarMovLabel.textContent = "Cantidad a retirar";
    //     $("#editarMovimientoModal #costoUltimaEntradaDiv").hide();
    //     $("#editarMovimientoModal #costo_ultima_entrada").prop(
    //       "required",
    //       false
    //     );
    //     $("#editarMovimientoModal #proveedorDiv").hide();
    //     $("#editarMovimientoModal #id_proveedores").prop("required", false); //false, se pone auto id 3 (SIN PROVEEDOR)
    //     $("#editarMovimientoModal .modal-title").html(
    //       'Editando salida con fecha: <span id="mostrandoDetallesEntrada"></span>'
    //     );
    //     $("#editarMovimientoModal #motivo_salida_label").text(
    //       "Motivo de salida"
    //     );

    //     $("#editarMovimientoModal #facturaEditDiv").hide();
    //     $("#editarMovimientoModal #img_factura").prop("required", false);

    //     // AGREGAR: Ocultar campos de lote y caducidad para salidas
    //     $("#editarMovimientoModal #lotesCaducidadEditDiv").hide();
    //     $("#editarMovimientoModal #ordenCompraDiva").hide();

    //     //cambiar dep osicion post

    //     tableCatDetallesEntradas.column(10).visible(false);
    //     tableCatDetallesEntradas.column(11).visible(false);
    //   }
    //   tableCatEntradas.columns.adjust().draw();
    //   $menu.remove();
    // });

    // Cierra el menú si haces click fuera
    $(document).on("mousedown.dropdownTipoMovimiento", function (event) {
      if (
        !$(event.target).closest(
          "#dropdownTipoMovimientoMenu, #btnFiltroTipoMovimiento"
        ).length
      ) {
        $menu.remove();
        $(document).off("mousedown.dropdownTipoMovimiento");
      }
    });
  },
});

if (invVerTrans == 1) {
  buttonsEntradas.push({
    // Botón para el historial de transacciones
    text: '<i class="bi bi-clock-history"></i> Transacciones',
    className: "btn-transacciones-margin btn btn-info",
    style: "left:138vh;",
    attr: {
      id: "btnHistorialEntradas",
      "data-bs-toggle": "tooltip",
      "data-bs-placement": "top",
      title: "Ver historial de transacciones",
    },
    action: function () {
      //Mostrar el modal
      $("#detalleTransaccionModal").modal("show");
      // ajaxreload de trans
      tableCatTransacciones.ajax.reload();
    },
  });
}

// DATATABLE DE ENTRADAS
tableCatEntradas = $("#tableCatEntradas").DataTable({
  order: [
    [4, "desc"],
    [0, "desc"],
  ],
  autoWidth: true,
  language: {
    url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json",
  },
  lengthChange: false,
  info: true,
  paging: true,
  sorting: true,
  scrollY: "68vh",
  scrollX: true,
  scrollCollapse: true,
  fixedHeader: true,
  ajax: {
    dataType: "json",
    data: function (d) {
      return $.extend(d, dataTableCatEntradas);
    },
    method: "POST",
    url: "../../../api/inventarios_api.php",
    error: function (jqXHR, textStatus, errorThrown) {
      alertErrorAJAX(jqXHR, textStatus, errorThrown);
    },
    dataSrc: "response.data",
  },
  columns: [
    { data: "CLAVE_ART" },
    {
      data: "IMAGEN",
      render: function (data, type, row) {
        if (data) {
          return (
            '<a href="' +
            data +
            '" target="_blank"><img src="' +
            data +
            '" alt="Imagen del Artículo" style="width: 50px; height: auto;"/></a>'
          );
        } else {
          return "";
        }
      },
      className: "text-center",
    },
    { data: "NOMBRE_COMERCIAL" },
    {
      data: "COSTO_ULTIMA_ENTRADA",
      render: function (data, type, row) {
        if ($.isNumeric(data)) {
          return (
            "$" +
            Number(data).toLocaleString("es-MX", {
              minimumFractionDigits: 2,
              maximumFractionDigits: 2,
            })
          );
        } else {
          return "$0.00";
        }
      },
    },
    {
      data: "FECHA_ULTIMA_ENTRADA",
      // Render personalizado para manejar fechas vacías en el ordenamiento
      render: function (data, type, row) {
        if (type === "sort" || type === "type") {
          // Para ordenamiento: fechas vacías van al principio (valor alto)
          return data
            ? new Date(data).getTime()
            : new Date().getTime() + 86400000; // +1 día para que vaya arriba
        }
        // Para display normal
        return data || "";
      },
    },
    {
      data: "COSTO_MAS_ALTO",
      render: function (data, type, row) {
        if ($.isNumeric(data)) {
          return (
            "$" +
            Number(data).toLocaleString("es-MX", {
              minimumFractionDigits: 2,
              maximumFractionDigits: 2,
            })
          );
        } else {
          return "$0.00";
        }
      },
    },
    { data: "PROVEEDOR" },
    {
      data: "MOTIVO_SALIDA",
    },
    {
      data: "CANTIDAD",
      render: function(data, type, row) {
        return Math.round(data);
      }
    },
    { data: "USUARIO" },
    { data: "ORDEN_COMPRA" },
    {
      data: "IMAGEN_ORDEN_COMPRA",
      render: function (data, type, row) {
        if (data) {
          // Obtener la extensión del archivo
          var extension = data.split(".").pop().toLowerCase();

          if (extension === "pdf") {
            // Si es PDF, mostrar icono de PDF
            return (
              '<a href="' +
              data +
              '" target="_blank"><i class="bi bi-file-earmark-pdf-fill text-danger fs-4" title="Ver PDF"></i></a>'
            );
          } else {
            // Si es imagen, mostrar como antes
            return (
              '<a href="' +
              data +
              '" target="_blank"><img src="' +
              data +
              '" alt="Imagen del Documento" style="width: 50px; height: auto;"/></a>'
            );
          }
        } else {
          return "Sin documento";
        }
      },
      className: "text-center",
    },
  ],
  columnDefs: [
    //editar los numeros segun las columnas que quieras, editar el tittle es el header de las tablas
    { target: 0, title: "Clave Art", className: "all" },
    { target: 1, title: "Imágen del artículo", className: "all" },
    { target: 2, title: "Nombre comercial", className: "all" },
    { target: 3, title: "Costo última entrada", className: "all" },
    { target: 4, title: "Fecha última entrada", className: "all" },
    { target: 5, title: "Costo más alto", className: "all" },
    { target: 6, title: "Proveedor", className: "all" },
    { target: 7, title: "Motivo de entrada", className: "all" },
    { target: 8, title: "Cantidad total en almacén", className: "all" },
    { target: 9, title: "Responsable", className: "all" },
    { target: 10, title: "Orden de compra", className: "all" },
    { target: 11, title: "Imagen de orden de compra", className: "all" },
  ],
  dom: 'Bl<"dataTables_toolbar">frtip',
  buttons: buttonsEntradas,
});

// DATATABLE DE DETALLES ENTRADAS
var tableCatDetallesEntradas = $("#tableCatDetallesEntradas").DataTable({
  order: [1, "desc"],
  autoWidth: false,
  language: {
    url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json",
  },
  lengthChange: false,
  info: true,
  paging: true,
  sorting: true,
  scrollY: "68vh",
  scrollX: true,
  scrollCollapse: true,
  fixedHeader: true,
  ajax: {
    dataType: "json",
    data: function (d) {
      return {
        api: 7,
        id_articulo: rowSelected ? rowSelected.ID_ARTICULO : 0,
        id_movimiento:
          window.dataTableCatEntradas &&
          window.dataTableCatEntradas.id_movimiento
            ? window.dataTableCatEntradas.id_movimiento
            : 1,
      };
    },
    method: "POST",
    url: "../../../api/inventarios_api.php",
    error: function (jqXHR, textStatus, errorThrown) {
      alertErrorAJAX(jqXHR, textStatus, errorThrown);
    },
    dataSrc: "response.data",
  },
  columns: [
    { data: "PROVEEDOR" },
    {
      data: "FECHA_ULTIMA_ENTRADA",
    },
    {
      data: "COSTO_ULTIMA_ENTRADA",
      render: function (data, type, row) {
        if ($.isNumeric(data)) {
          return (
            "$" +
            Number(data).toLocaleString("es-MX", {
              minimumFractionDigits: 2,
              maximumFractionDigits: 2,
            })
          );
        } else {
          return "";
        }
      },
    },
    { data: "CANTIDAD" },
    {
      data: null,
      render: function (data, type, row) {
        const cantidad = parseFloat(row.CANTIDAD) || 0;
        const costoUnitario = parseFloat(row.COSTO_ULTIMA_ENTRADA) || 0;

        if (cantidad > 0 && costoUnitario > 0) {
          const costoTotal = cantidad * costoUnitario;
          return (
            "$" +
            costoTotal.toLocaleString("es-MX", {
              minimumFractionDigits: 2,
              maximumFractionDigits: 2,
            })
          );
        } else {
          return "$0.00";
        }
      },
    },
    { data: "id_cat_movimientos" },
    { data: "id_movimiento" },
    { data: "MOTIVO_SALIDA" },
    {
      data: "imagen_documento",
      render: function (data, type, row) {
        if (data) {
          // Obtener la extensión del archivo
          var extension = data.split(".").pop().toLowerCase();

          if (extension === "pdf") {
            // Si es PDF, mostrar icono de PDF
            return (
              '<a href="' +
              data +
              '" target="_blank"><i class="bi bi-file-earmark-pdf-fill text-danger fs-4" title="Ver PDF"></i></a>'
            );
          } else {
            // Si es imagen, mostrar como antes
            return (
              '<a href="' +
              data +
              '" target="_blank"><img src="' +
              data +
              '" alt="Imagen del Documento" style="width: 50px; height: auto;"/></a>'
            );
          }
        } else {
          return "Sin documento";
        }
      },
      className: "text-center",
    },
    { data: "RESPONSABLE" },
    { data: "orden_compra" },
    {
      data: "IMAGEN_ORDEN_COMPRA",
      render: function (data, type, row) {
        if (data) {
          // Obtener la extensión del archivo
          var extension = data.split(".").pop().toLowerCase();

          if (extension === "pdf") {
            // Si es PDF, mostrar icono de PDF
            return (
              '<a href="' +
              data +
              '" target="_blank"><i class="bi bi-file-earmark-pdf-fill text-danger fs-4" title="Ver PDF"></i></a>'
            );
          } else {
            // Si es imagen, mostrar como antes
            return (
              '<a href="' +
              data +
              '" target="_blank"><img src="' +
              data +
              '" alt="Imagen del Documento" style="width: 50px; height: auto;"/></a>'
            );
          }
        } else {
          return "Sin documento";
        }
      },
      className: "text-center",
    },
  ],
  columnDefs: [
    { targets: 0, title: "Proveedor", className: "all" },
    { targets: 1, title: "Fecha y hora última entrada", className: "all" },
    { targets: 2, title: "Costo última entrada", className: "all" },
    { targets: 3, title: "Cantidad de entrada", className: "all" },
    { targets: 4, title: "Costo total de entrada", className: "all" },
    { targets: 5, visible: false },
    { targets: 6, visible: false },
    { targets: 7, title: "Motivo de entrada", className: "all" },
    { targets: 8, title: "Documento", className: "all" },
    { targets: 9, title: "Responsable", className: "all" },
    { targets: 10, title: "Orden de compra", className: "all" },
    { targets: 11, title: "Imagen de orden de compra", className: "all" },
  ],
});

//DATATABLE DE REQUISICIONES
tableCatRequisiciones = $("#tableCatRequisiciones").DataTable({
  order: [[1, "desc"]], // Ordenar por fecha de creación
  autoWidth: false,
  language: {
    url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json",
  },
  lengthChange: false,
  info: true,
  paging: true,
  sorting: true,
  scrollY: "68vh",
  scrollX: true,
  scrollCollapse: true,
  fixedHeader: true,
  ajax: {
    dataType: "json",
    data: function (d) {
      return $.extend(d, dataTableCatRequisiciones);
    },
    method: "POST",
    url: "../../../api/inventarios_api.php",
    error: function (jqXHR, textStatus, errorThrown) {
      console.error(
        "Error en DataTable Requisiciones:",
        jqXHR.responseText || textStatus || errorThrown || "Error desconocido"
      );
      alertErrorAJAX(jqXHR, textStatus, errorThrown);
    },
    dataSrc: function (json) {
      console.log("Datos recibidos para requisiciones:", json);
      if (json.response && json.response.data) {
        return json.response.data;
      } else if (json.data) {
        return json.data;
      } else if (Array.isArray(json)) {
        return json;
      } else {
        console.error("Estructura de datos no reconocida:", json);
        return [];
      }
    },
  },
  columns: [
    { data: "numero_requisicion" },
    { data: "fecha_creacion" },
    { data: "area_solicitante" },
    { data: "solicitante" },
    {
      data: "prioridad",
      render: function (data, type, row) {
        const badges = {
          urgente: "badge bg-danger",
          normal: "badge bg-primary",
          baja: "badge bg-secondary",
        };
        const badgeClass = badges[data] || "badge bg-light text-dark";
        return `<span class="${badgeClass}">${
          data ? data.charAt(0).toUpperCase() + data.slice(1) : ""
        }</span>`;
      },
    },
    {
      data: "estatus",
      render: function (data, type, row) {
        const badges = {
          borrador: "badge bg-warning text-dark",
          pendiente: "badge bg-info",
          aprobada: "badge bg-primary",
          rechazada: "badge bg-danger",
          parcialmente_surtida: "badge bg-warning",
          completada: "badge bg-success",
          pausada: "badge bg-secondary",
        };
        const badgeClass = badges[data] || "badge bg-light text-dark";
        return `<span class="${badgeClass}">${
          data
            ? data.charAt(0).toUpperCase() + data.slice(1).replace("_", " ")
            : ""
        }</span>`;
      },
    },
    {
      data: "fecha_limite",
      render: function (data, type, row) {
        if (!data) return "-";
        // Si el data ya viene formateado del SP, usarlo directo
        return data;
      },
    },
    /*{ 
      data: "total_estimado",
      render: function(data, type, row) {
        if (!data || data === '0.00') return '$0.00';
        return data.toString().includes('$') ? data : `$${parseFloat(data).toFixed(2)}`;
      }
    },*/
    {
      data: "total_articulos",
      render: function (data, type, row) {
        return data || "0";
      },
    },
    {
      data: "aprobador",
      render: function (data, type, row) {
        return data || "-";
      },
    },
    {
      data: "fecha_aprobacion",
      render: function (data, type, row) {
        return data || "-";
      },
    },
    {
      data: "alerta_tiempo",
      render: function (data, type, row) {
        const alerts = {
          Vencida: "badge bg-danger",
          "Por vencer": "badge bg-warning text-dark",
          Normal: "badge bg-success",
        };
        const alertClass = alerts[data] || "badge bg-light text-dark";
        return `<span class="${alertClass}">${data || "Normal"}</span>`;
      },
    },
    {
      data: "justificacion",
      render: function (data, type, row) {
        if (!data) return "-";
        if (data.length > 50) {
          return `<span title="${data}">${data.substring(0, 50)}...</span>`;
        }
        return data;
      },
    },
    {
      data: "observaciones_aprobacion",
      render: function (data, type, row) {
        if (!data) return "-";
        if (data.length > 30) {
          return `<span title="${data}">${data.substring(0, 30)}...</span>`;
        }
        return data;
      },
    },
    {
      data: null,
      render: function (data, type, row) {
        // Determinar qué botones mostrar
        const showApprovalButtons = row.estatus === "pendiente";
        const showViewDetails = row.estatus === "completada" || row.estatus === "parcialmente_surtida";
        const showSurtir = row.estatus === "aprobada" || row.estatus === "parcialmente_surtida";

        // Si no hay botones que mostrar
        if (!showApprovalButtons && !showViewDetails && !showSurtir) {
          return '<span class="text-muted">-</span>';
        }

        let buttons = "";

        // Botones de aprobación (solo cuando está pendiente)
        if (showApprovalButtons) {
          buttons += `
            <div class="d-flex gap-1 justify-content-center">
              <button class="btn btn-sm btn-success btn-aprobar-requisicion" data-id="${row.id_requisicion}" title="Aprobar">
                <i class="bi bi-check-circle"></i>
              </button>
              <button class="btn btn-sm btn-danger btn-rechazar-requisicion" data-id="${row.id_requisicion}" title="Rechazar">
                <i class="bi bi-x-circle"></i>
              </button>
            </div>
          `;
        }

        // Botones de ver detalles y surtir (cuando ambos deben mostrarse juntos)
        if (showViewDetails && showSurtir) {
          buttons += `
            <div class="d-flex gap-1 justify-content-center">
              <button class="btn btn-sm btn-info btn-ver-surtimiento" data-id="${row.id_requisicion}" data-surtimiento-id="${row.id_surtimiento}" title="Ver detalles del surtimiento">
                <i class="bi bi-eye"></i>
              </button>
              <button id="btnSurtirRequisicion" class="btn btn-sm btn-warning" title="Surtir requisición">
                <i class="bi bi-box-seam"></i>
              </button>
            </div>
          `;
        }
        // Solo mostrar ver detalles
        else if (showViewDetails && !showSurtir) {
          buttons += `
            <div class="d-flex gap-1 justify-content-center">
              <button class="btn btn-sm btn-info btn-ver-surtimiento" data-id="${row.id_requisicion}" data-surtimiento-id="${row.id_surtimiento}" title="Ver detalles del surtimiento">
                <i class="bi bi-eye"></i>
              </button>
            </div>
          `;
        }
        // Solo mostrar surtir
        else if (!showViewDetails && showSurtir) {
          buttons += `
            <div class="d-flex gap-1 justify-content-center">
              <button id="btnSurtirRequisicion" class="btn btn-sm btn-warning" title="Surtir requisición">
                <i class="bi bi-box-seam"></i>
              </button>
            </div>
          `;
        }

        return buttons;
      },
    },
    {
      data: "id_surtimiento",
    },
  ],
  columnDefs: [
    { targets: 0, title: "Número", className: "all", width: "100px" },
    { targets: 1, title: "F. Creación", className: "all", width: "120px" },
    { targets: 2, title: "Área", className: "all", width: "120px" },
    { targets: 3, title: "Solicitante", className: "all", width: "150px" },
    { targets: 4, title: "Prioridad", className: "all", width: "80px" },
    { targets: 5, title: "Estado", className: "all", width: "100px" },
    { targets: 6, title: "F. Límite", className: "all", width: "100px" },
    /*{ targets: 7, title: "Total", className: "all", width: "90px" },*/
    { targets: 7, title: "Arts.", className: "all", width: "60px" },
    { targets: 8, title: "Revisado por", className: "desktop", width: "120px" },
    { targets: 9, title: "F. Revisión", className: "desktop", width: "120px" },
    { targets: 10, title: "Alerta", className: "all", width: "80px" },
    {
      targets: 11,
      title: "Justificación",
      className: "desktop",
      width: "200px",
    },
    {
      targets: 12,
      title: "Observaciones",
      className: "desktop",
      width: "150px",
    },
    {
      targets: 13,
      title: "Acciones",
      className: "all",
      orderable: false,
      width: "120px",
    },
    { targets: 14, title: "ID Surtimiento", visible: false },
  ],
  dom: 'Bl<"dataTables_toolbar">frtip',
  buttons: [
    {
      text: '<i class="bi bi-plus-lg"></i> Nueva Requisición',
      className: "btn btn-success",
      action: function () {
        $("#registrarRequisicionModal").modal("show");
      },
    },
    {
      text: '<i class="bi bi-pencil-square"></i> Editar',
      className: "btn btn-secondary",
      attr: {
        id: "btnEditarRequisicion",
        "data-bs-toggle": "tooltip",
        "data-bs-placement": "top",
        title: "Editar la requisición seleccionada",
        disabled: true,
      },
      action: function () {
        if (
          rowSelectedRequisicion &&
          rowSelectedRequisicion.estatus === "borrador"
        ) {
          cargarDatosRequisicionCompletos();
          $("#editarRequisicionModal").modal("show");
        } else {
          alertToast(
            "Por favor, seleccione una requisición en estado BORRADOR",
            "info",
            4000
          );
        }
      },
    },
    {
      text: '<i class="bi bi-arrow-clockwise"></i> Actualizar',
      className: "btn btn-info",
      attr: {
        id: "btnActualizarRequisiciones",
        "data-bs-toggle": "tooltip",
        "data-bs-placement": "top",
        title: "Actualizar lista de requisiciones",
      },
      action: function () {
        // Mostrar indicador de carga
        alertToast("Actualizando requisiciones...", "info", 2000);

        // Recargar los datos del datatable
        tableCatRequisiciones.ajax.reload(function (json) {
          // Callback después de la recarga
          if (json && json.response && json.response.code === 1) {
            alertToast(
              "Requisiciones actualizadas correctamente",
              "success",
              3000
            );

            // Limpiar selección actual
            rowSelectedRequisicion = null;
            $("#btnEditarRequisicion").prop("disabled", true);
            $("#btnEditarRequisicion")
              .removeClass("btn-secondary")
              .addClass("btn-outline-secondary");
          } else {
            alertToast("Error al actualizar las requisiciones", "error", 3000);
          }
        }, false); // false para que no resetee la paginación
      },
    },
    // {
    //   text: '<i class="bi bi-funnel"></i> Filtrar',
    //   className: "btn btn-warning",
    //   action: function() {
    //     // Aquí puedes agregar un modal de filtros si lo necesitas
    //     console.log("Filtros de requisiciones");
    //   }
    // }
  ],
});

// Variable para la fila seleccionada de requisiciones
var rowSelectedRequisicion = null;

// Selección y eventos para tableCatRequisiciones
selectDatatable(
  "tableCatRequisiciones",
  tableCatRequisiciones,
  0,
  0,
  0,
  0,
  async function (select, dataClick) {
    // CUANDO SELECCIONAN UNA FILA DE LA TABLA DE REQUISICIONES
    rowSelectedRequisicion = dataClick;

    // Habilitar/deshabilitar botón de editar según el estado
    if (
      rowSelectedRequisicion &&
      rowSelectedRequisicion.estatus === "borrador"
    ) {
      $("#btnEditarRequisicion").prop("disabled", false);
      $("#btnEditarRequisicion")
        .removeClass("btn-outline-secondary")
        .addClass("btn-secondary");
    } else {
      $("#btnEditarRequisicion").prop("disabled", true);
      $("#btnEditarRequisicion")
        .removeClass("btn-secondary")
        .addClass("btn-outline-secondary");
    }
  },
  async function () {
    // DOBLE CLICK - Mostrar modal de detalles
    if (rowSelectedRequisicion) {
      cargarDetallesRequisicionCompletos();
      $("#detalleRequisicionModal").modal("show");
    }
  }
);

selectDatatable(
  "tableCatDetallesEntradas",
  tableCatDetallesEntradas,
  0,
  0,
  0,
  0,
  async function (select, dataClick) {
    rowSelected = dataClick;
    //console.log("id de movimiento seleccionado:", rowSelected.id_movimiento);
    //console.log("id de movimiento seleccionado:", rowSelected.PROVEEDOR);
  },
  async function () {
    // Validar si hay registros en la tabla
    if (tableCatDetallesEntradas.data().count() === 0) {
      rowSelected = null; // Limpia la selección
      $("#tableCatEntradas tbody tr.selected").removeClass("selected");
      alertToast("No hay registros para editar.", "info", 3000);
      return;
    }
    $("#editarMovimientoModal").modal("show");
    $("#detalleEntradaModal").modal("hide");
    $("#mostrandoDetallesEntrada").html(
      `<strong>${rowSelected.FECHA_ULTIMA_ENTRADA}</strong>`
    );
    $("#editarMovimientoModal #cantidad").val(rowSelected.CANTIDAD);
    $("#editarMovimientoModal #costo_ultima_entrada").val(
      rowSelected.COSTO_ULTIMA_ENTRADA
    );

    $("#editarMovimientoModal #orden_compra").val(rowSelected.orden_compra);

    //AGREGAR: Establecer valores de lote y caducidad directamente desde rowSelected
    $("#editarMovimientoModal #numero_lote").val(rowSelected.NUMERO_LOTE || "");

    // COMENTADO: Fecha de lote ya no es requerida
    /*
    if (rowSelected.FECHA_LOTE && rowSelected.FECHA_LOTE !== '0000-00-00') {
      var fechaLote = rowSelected.FECHA_LOTE;
      if (fechaLote.includes(' ')) {
        fechaLote = fechaLote.split(' ')[0];
      }
      $("#editarMovimientoModal #fecha_lote").val(fechaLote);
    } else {
      $("#editarMovimientoModal #fecha_lote").val('');
    }
    */
    // Asegurar que fecha_lote siempre sea null/vacío
    $("#editarMovimientoModal #fecha_lote").val("");

    // Formatear fecha de caducidad para input de tipo date
    if (
      rowSelected.FECHA_CADUCIDAD &&
      rowSelected.FECHA_CADUCIDAD !== "0000-00-00"
    ) {
      var fechaCaducidad = rowSelected.FECHA_CADUCIDAD;
      if (fechaCaducidad.includes(" ")) {
        fechaCaducidad = fechaCaducidad.split(" ")[0];
      }
      $("#editarMovimientoModal #fecha_caducidad").val(fechaCaducidad);
    } else {
      $("#editarMovimientoModal #fecha_caducidad").val("");
    }

    //MODIFICACION AQUI ME QUEDE
    establecerValoresActuales({
      proveedor: rowSelected.PROVEEDOR,
      motivo: rowSelected.MOTIVO_SALIDA,
      cantidad: rowSelected.CANTIDAD,
      costo: rowSelected.COSTO_ULTIMA_ENTRADA,
    });
  }
);

// seleccionar la fila de la tabla de entradas
selectDatatable(
  "tableCatEntradas",
  tableCatEntradas,
  0,
  0,
  0,
  0,
  async function (select, dataClick) {
    rowSelected = dataClick;
  },
  async function () {
    $("#imagenProductoa").attr("src", rowSelected.IMAGEN);
    $("#verImagenArta").attr("href", rowSelected.IMAGEN);
    $("#mostrandoEntrada").html(
      `<strong>${rowSelected.NOMBRE_COMERCIAL}</strong> <span class="text-muted" style="font-size:0.95em;">&mdash; CLAVE: <b>${rowSelected.CLAVE_ART}</b></span>`
    );
    if (
      rowSelected.CANTIDAD &&
      rowSelected.CANTIDAD !== "null" &&
      rowSelected.CANTIDAD !== null &&
      rowSelected.COSTO_MAS_ALTO &&
      rowSelected.COSTO_MAS_ALTO !== "null" &&
      rowSelected.COSTO_MAS_ALTO !== null
    ) {
      $("#costoMasAltoEntrada").html(
        `<span class="fw-semibold text-secondary">Costo más alto:</span> <span class="text-success fw-bold">$${Number(
          rowSelected.COSTO_MAS_ALTO
        ).toLocaleString("es-MX", {
          minimumFractionDigits: 2,
          maximumFractionDigits: 2,
        })}</span>`
      );
      $("#totalUnidades").html(
        `- Total de unidades en almacén: <span style="color: red;">${rowSelected.CANTIDAD}</span>`
      );
    } else {
      $("#costoMasAltoEntrada").html("SIN REGISTROS");
      $("#totalUnidades").text("");
    }
    tableCatDetallesEntradas.ajax.reload();
    $("#detalleEntradaModal").modal("show");
  }
);

selectDatatable(
  "tableCatArticulos",
  tableCatArticulos,
  0,
  0,
  0,
  0,
  async function (select, dataClick) {
    // CUANDO SELECCIONAN UNA FILA DE LA TABLA
    // ACTUALIZAMOS EL VALOR DE LA VARIABLE `rowSelected` con los de la fila seleccionada.
    rowSelected = dataClick;
  },
  async function () {
    // DOBLE CLICK
    // llenamos el modal de detalles para mostrarlo al usuario.
    $("#claveArticulo").text(rowSelected.CLAVE_ART);
    if (
      rowSelected.COSTO_ULTIMA_ENTRADA &&
      rowSelected.COSTO_ULTIMA_ENTRADA !== "null" &&
      rowSelected.COSTO_ULTIMA_ENTRADA !== null
    ) {
      $("#costoUltimaEntrada").text(
        "$" +
          Number(rowSelected.COSTO_ULTIMA_ENTRADA).toLocaleString("es-MX", {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2,
          })
      );
    } else {
      $("#costoUltimaEntrada").text("Sin registros");
    }

    if (
      rowSelected.COSTO_MAS_ALTO &&
      rowSelected.COSTO_MAS_ALTO !== "null" &&
      rowSelected.COSTO_MAS_ALTO !== null
    ) {
      $("#costoMasAlto").text(
        "$" +
          Number(rowSelected.COSTO_MAS_ALTO).toLocaleString("es-MX", {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2,
          })
      );
    } else {
      $("#costoMasAlto").text("Sin registros");
    }

    //Ocultar la fecha de ultima entrada si no hay en detalles
    if (
      rowSelected.FECHA_ULTIMA_ENTRADA &&
      rowSelected.FECHA_ULTIMA_ENTRADA !== "0000-00-00" &&
      rowSelected.FECHA_ULTIMA_ENTRADA !== "0000-00-00 00:00:00"
    ) {
      $("#fechaUltimaEntrada").text(
        rowSelected.FECHA_ULTIMA_ENTRADA.split(" ")[0]
      );
    } else {
      $("#fechaUltimaEntrada").text("Sin registros");
    }

    $("#unidadVenta").text(rowSelected.UNIDAD_DESCRIPCION);
    $("#unidadMinima").text(rowSelected.UNIDAD_MINIMA);
    $("#contenidoDetalle").text(rowSelected.CONTENIDO);
    $("#tipo").text(rowSelected.TIPO_DESCRIPCION);
    $("#manejaCaducidad").html(
      rowSelected.MANEJA_CADUCIDAD == 1
        ? '<i class="bi bi-check-circle-fill text-success"></i>'
        : '<i class="bi bi-x-circle-fill text-danger"></i>'
    );

    // Ocultar la fecha de caducidad si no maneja caducidad en detalles
    if (
      rowSelected.FECHA_CADUCIDAD &&
      rowSelected.FECHA_CADUCIDAD !== "0000-00-00" &&
      rowSelected.FECHA_CADUCIDAD !== "0000-00-00 00:00:00"
    ) {
      $("#fechaCaducidad").text(rowSelected.FECHA_CADUCIDAD);
      $("#fechaCaducidad1").show();
    } else {
      $("#fechaCaducidad1").hide();
    }

    $("#estatusArt").html(
      rowSelected.ESTATUS == 1 ? "<span>ACTIVO</span>" : "<span>INACTIVO</span>"
    );
    if (rowSelected.ESTATUS == 1) {
      $("#estatusArt").addClass("bg-success-subtle");
      $("#estatusArt").removeClass("bg-dark-subtle");
    } else {
      $("#estatusArt").addClass("bg-dark-subtle");
      $("#estatusArt").removeClass("bg-success-subtle");
    }

    // EDITAR que al editar aparezca la fecha actual de ese articulo en la bd
    $("#editarArticuloForm #fechaCaducidad").val(fechaCaducidad);
    $("#areaDetalle").text(rowSelected.AREA);
    $("#marcaDetalle").text(rowSelected.MARCAS);
    $("#numeroLote").text(
      rowSelected.numero_lote ? rowSelected.numero_lote : "Sin registros"
    );
    // COMENTADO: Fecha de lote ya no es requerida
    /*
    $("#fechaLote").text(
      !rowSelected.fecha_lote ||
        rowSelected.fecha_lote === "0000-00-00" ||
        rowSelected.fecha_lote === "0000-00-00 00:00:00" ||
        rowSelected.fecha_lote === "00000000"
        ? "Sin registros"
        : rowSelected.fecha_lote
    );
    */
    $("#fechaLote").text("No aplica");
    // $("#codigoBarras").text(rowSelected.codigo_barras ? rowSelected.codigo_barras : "Sin registros");

    // Por esta nueva lógica:
    if (rowSelected.codigo_barras && rowSelected.codigo_barras.trim() !== "") {
      // Mostrar el código como texto en el elemento original
      $("#codigoBarras").text(rowSelected.codigo_barras);

      // Generar y mostrar el código de barras visual
      mostrarCodigoBarrasInteligente(rowSelected.codigo_barras);
    } else {
      // Si no hay código de barras
      $("#codigoBarras").text("Sin registros");

      // Ocultar el contenedor del código visual
      if (document.getElementById("codigoBarrasContainer")) {
        document.getElementById("codigoBarrasContainer").style.display = "none";
      }
    }

    if (
      rowSelected.RENDIMIENTO_ESTIMADO &&
      rowSelected.RENDIMIENTO_ESTIMADO !== "0"
    ) {
      $("#rendimientoEstimado").text(rowSelected.RENDIMIENTO_ESTIMADO);
      $("#rendimientoEstimado1").show();
    } else {
      $("#rendimientoEstimado1").hide();
    }
    if (
      rowSelected.RENDIMIENTO_PACIENTE &&
      rowSelected.RENDIMIENTO_PACIENTE !== "0"
    ) {
      $("#rendimientoPaciente").text(rowSelected.RENDIMIENTO_PACIENTE);
      $("#rendimientoPaciente1").show();
    } else {
      $("#rendimientoPaciente1").hide();
    }
    $("#nombreComercial").html(
      `${rowSelected.NOMBRE_COMERCIAL} ${
        rowSelected.RED_FRIO == 1
          ? '<span class="badge text-bg-primary"><i class="bi bi-snow2 fs-4" title="Refrigerado"></i></span>'
          : '<span class="badge text-bg-warning"><i class="bi bi-thermometer-half fs-4" title="Temperatura ambiente"></i></span>'
      }`
    );
    $("#imagenProducto").attr("src", rowSelected.IMAGEN);
    $("#verImagenArt").attr("href", rowSelected.IMAGEN);

    if (!rowSelected.INSERTO) {
      $("#verInsertoBtn").hide();
      $("#verInsertoBtn").attr("disabled", true);
      $("#verInsertoBtn").removeClass("btn-danger");
      $("#verInsertoBtn").addClass("btn-outline-danger");
      $("#verInsertoBtn").on("click", function (e) {
        if ($(this).attr("disabled")) {
          e.preventDefault(); // Evita que el enlace funcione
        }
      });
    } else {
      $("#verInsertoBtn").show();
      $("#verInsertoBtn").attr("disabled", false);
      $("#verInsertoBtn").attr("href", rowSelected.INSERTO);
      $("#verInsertoBtn").removeClass("btn-outline-danger");
      $("#verInsertoBtn").addClass("btn-danger");
    }

    if (!rowSelected.PROCEDIMIENTO_PRUEBA) {
      $("#verProcedimientoBtn").hide();
      $("#verProcedimientoBtn").attr("disabled", true);
      $("#verProcedimientoBtn").removeClass("btn-secondary");
      $("#verProcedimientoBtn").addClass("btn-outline-secondary");
      $("#verProcedimientoBtn").on("click", function (e) {
        if ($(this).attr("disabled")) {
          e.preventDefault(); // Evita que el enlace funcione
        }
      });
    } else {
      $("#verProcedimientoBtn").show();
      $("#verProcedimientoBtn").attr("disabled", false);
      $("#verProcedimientoBtn").removeClass("btn-outline-secondary");
      $("#verProcedimientoBtn").addClass("btn-secondary");
      $("#verProcedimientoBtn").attr("href", rowSelected.PROCEDIMIENTO_PRUEBA);
    }

    //mostrar proveedores del articulo seleccionado
    $("#proveedoresArt").html(
      rowSelected.PROVEEDORES && rowSelected.PROVEEDORES !== "Sin proveedor"
        ? rowSelected.PROVEEDORES.split("|")
            .filter(proveedor => proveedor.trim() !== "")
            .map((proveedor, index) => {
              // Determinar si es el proveedor principal (generalmente el primero en la lista)
              const isPrincipal = index === 0;
              const iconClass = isPrincipal ? 'bi-star-fill text-warning' : 'bi-building';
              const badgeClass = isPrincipal ? 'badge bg-primary' : 'badge bg-secondary';
              const titleText = isPrincipal ? 'Proveedor Principal' : 'Proveedor';
              
              return `
                <div class="d-flex align-items-center mb-1">
                  <i class="bi ${iconClass} me-2" title="${titleText}"></i>
                  <span class="${badgeClass}">${proveedor.trim()}</span>
                </div>
              `;
            })
            .join("") || "No hay proveedores registrados."
        : "No hay proveedores registrados."
    );

    $("#SUSTANCIA_ACTIVA").text(rowSelected.SUSTANCIA_ACTIVA);

    // AGREGAR: Llenar los nuevos campos del modal de detalles
    // Sustancia activa (buscar el nombre si hay ID)
    if (
      rowSelected.SUSTANCIA_ACTIVA &&
      rowSelected.SUSTANCIA_ACTIVA !== "null" &&
      rowSelected.SUSTANCIA_ACTIVA !== null
    ) {
      $("#sustanciaActiva").text(rowSelected.SUSTANCIA_ACTIVA);
    } else {
      $("#sustanciaActiva").text("Sin asignar");
    }

    // Stock mínimo
    $("#stockMinimo").text(rowSelected.UNIDAD_MINIMA || "Sin definir");

    // Costo más alto (duplicar la lógica existente)
    if (
      rowSelected.COSTO_MAS_ALTO &&
      rowSelected.COSTO_MAS_ALTO !== "null" &&
      rowSelected.COSTO_MAS_ALTO !== null
    ) {
      $("#costoMasAltoDetalle").text(
        "$" +
          Number(rowSelected.COSTO_MAS_ALTO).toLocaleString("es-MX", {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2,
          })
      );
    } else {
      $("#costoMasAltoDetalle").text("Sin registros");
    }

    // Enlaces a documentos
    if (rowSelected.INSERTO && rowSelected.INSERTO.trim() !== "") {
      $("#insertoLink").html(
        '<a href="' +
          rowSelected.INSERTO +
          '" target="_blank" class="btn btn-sm btn-outline-danger"><i class="bi bi-file-earmark-pdf"></i> Ver inserto</a>'
      );
      $("#insertoDetalle").show();
    } else {
      $("#insertoLink").html('<span class="text-muted">No disponible</span>');
      $("#insertoDetalle").show();
    }

    if (
      rowSelected.PROCEDIMIENTO_PRUEBA &&
      rowSelected.PROCEDIMIENTO_PRUEBA.trim() !== ""
    ) {
      $("#procedimientoLink").html(
        '<a href="' +
          rowSelected.PROCEDIMIENTO_PRUEBA +
          '" target="_blank" class="btn btn-sm btn-outline-secondary"><i class="bi bi-file-earmark-pdf"></i> Ver procedimiento</a>'
      );
      $("#procedimientoDetalle").show();
    } else {
      $("#procedimientoLink").html(
        '<span class="text-muted">No disponible</span>'
      );
      $("#procedimientoDetalle").show();
    }

    //mostrar el modal
    $("#detalleProductoModal").modal("show");
  }
);

//estilos para la barra de busqueda
setTimeout(() => {
  inputBusquedaTable(
    "tableCatArticulos",
    tableCatArticulos,
    [
      {
        msj: "Filtre los registros por coincidencia",
        place: "top",
      },
    ],
    [],
    "col-12"
  );
  tableCatArticulos.columns.adjust().draw();
}, 1000);

setTimeout(() => {
  inputBusquedaTable(
    "tableCatDetallesEntradas",
    tableCatDetallesEntradas,
    [
      {
        msj: "Filtre los registros por coincidencia",
        place: "top",
      },
    ],
    [],
    "col-12"
  );
  tableCatArticulos.columns.adjust().draw();
}, 1000);


setTimeout(() => {
  inputBusquedaTable(
    "tableCatEntradas",
    tableCatEntradas,
    [
      {
        msj: "Filtre los registros por coincidencia",
        place: "top",
      },
    ],
    [],
    "col-12"
  );

  // resuelve el problema de ancho de las columnas en el titulo
  tableCatEntradas.columns.adjust().draw();
}, 1000);

setTimeout(() => {
  inputBusquedaTable(
    "tableCatRequisiciones",
    tableCatRequisiciones,
    [
      {
        msj: "Filtre las requisiciones por coincidencia",
        place: "top",
      },
    ],
    [],
    "col-12"
  );
  tableCatRequisiciones.columns.adjust().draw();
}, 1000);

// abrir modal para registrar un articulo
$("#btnNuevoArticulo").click(function () {
  $("#registrarArticuloModal").modal("show");
});

//preguntar si sirve
//rellenarSelect('.tipo_articulo', 'inventarios_api', 2, 'ID_TIPO', 'DESCRIPCION');

$(document).ready(function () {
  // Desactivar checkbox al seleccionar un radio button
  $('input[type="radio"]').on("change", function () {
    let checkboxId = "ignore_" + $(this).attr("name");
    $("#" + checkboxId).prop("checked", false);
  });
});

// $("#detalleProductoModal").on("shown.bs.modal", function () {
//   if (rowSelected.RED_FRIO == 1) {
//     createSnowflakes();
//   } else {
//     // createHeatWaves();
//     // createWarmGlow();
//     createThermometer();
//   }
// });

$("#detalleProductoModal").on("hidden.bs.modal", function () {
  $("#snowAnimation").empty(); // Remueve los copos al cerrar el modal
  $("#animation").empty();
  // $('#heatWaveAnimation').empty();
  // $('#warmGlowEffect').empty();
});

function createThermometer() {
  let svgContainer = $("#animation");
  let thermometer =
    $(`<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" width="200" height="200">
                      <!-- Termómetro -->
                      <g fill="#BDBDBD">
                          <rect x="28" y="8" width="8" height="40" rx="4" ry="4"/>
                          <circle cx="32" cy="52" r="12"/>
                      </g>
                      
                      <!-- Mercurio -->
                      <g fill="#FF5252">
                          <rect x="30" y="26" width="4" height="22" id="mercury"/>
                          <circle cx="32" cy="52" r="8"/>
                      </g>
                      
                      <!-- Animación del nivel de mercurio -->
                      <animate xlink:href="#mercury" attributeName="y" values="26;20;26" dur="3s" repeatCount="indefinite" />
                      <animate xlink:href="#mercury" attributeName="height" values="22;28;22" dur="3s" repeatCount="indefinite" />
                  </svg>`);
  let icono = $(``);
  svgContainer.append(thermometer);
}

function createSnowflakes() {
  let snowContainer = $("#snowAnimation");
  let snowflakeCount = 50; // Cantidad de copos de nieve

  for (let i = 0; i < snowflakeCount; i++) {
    let snowflake = $(
      '<div class="snowflake"><i class="bi bi-snow2 text-primary fs-4" title="Refrigerado"></i></div>'
    );
    let leftPosition = Math.random() * 100; // Posición horizontal aleatoria
    let delay = Math.random() * 5; // Retraso aleatorio en la animación
    let duration = 5 + Math.random() * 5; // Duración aleatoria de la caída

    snowflake.css({
      left: `${leftPosition}%`,
      animationDelay: `${delay}s`,
      animationDuration: `${duration}s`,
    });

    snowContainer.append(snowflake);
  }
}

function createWarmGlow() {
  let glowContainer = $("#warmGlowEffect");
  let glowCount = 10; // Cantidad de destellos

  for (let i = 0; i < glowCount; i++) {
    let glow = $('<div class="warm-glow"></div>');
    let topPosition = Math.random() * 100;
    let leftPosition = Math.random() * 100;
    let delay = Math.random() * 2; // Retraso aleatorio

    glow.css({
      top: `${topPosition}%`,
      left: `${leftPosition}%`,
      animationDelay: `${delay}s`,
    });

    glowContainer.append(glow);
  }
}

function createHeatWaves() {
  let heatContainer = $("#heatWaveAnimation");
  let waveCount = 10; // Número de ondas

  for (let i = 0; i < waveCount; i++) {
    let heatwave = $('<div class="heatwave"></div>');
    let topPosition = Math.random() * 100; // Posición vertical aleatoria
    let leftPosition = Math.random() * 100; // Posición horizontal aleatoria
    let delay = Math.random() * 4; // Retraso aleatorio en la animación

    heatwave.css({
      top: `${topPosition}%`,
      left: `${leftPosition}%`,
      animationDelay: `${delay}s`,
    });

    heatContainer.append(heatwave);
  }
}

// CSS for .btn-back-menu
$(".btn-back-menu").css({
  display: "inline-block",
  width: "auto",
  marginBottom: "16px",
  marginTop: "4px",
});

// Centrar y mantener en una sola línea el texto de headers y celdas de todas las DataTables
$(".dataTable th, .dataTable td").css({
  "text-align": "center",
  "vertical-align": "middle",
});

// Aplica estilos cada vez que se dibuje la tabla de artículos
tableCatArticulos.on("draw", function () {
  $(".dataTable th, .dataTable td").css({
    "text-align": "center",
    "vertical-align": "middle",
  });
});

tableCatEntradas.on("draw", function () {
  $(".dataTable th, .dataTable td").css({
    "text-align": "center",
    "vertical-align": "middle",
  });
});

tableCatDetallesEntradas.on("draw", function () {
  $(".dataTable th, .dataTable td").css({
    "text-align": "center",
    "vertical-align": "middle",
  });
});


tableCatRequisiciones.on("draw", function () {
  $(".dataTable th, .dataTable td").css({
    "text-align": "center",
    "vertical-align": "middle",
  });
});


//cargas dinamica
$(document).ready(function () {
  // ==================== CARGAS PARA MODAL REGISTRAR ====================
  $("#registrarArticuloModal").on("show.bs.modal", function () {
    cargarTiposRegistrar();
    cargarMarcasRegistrar();
    cargarUnidadesRegistrar();
    cargarSustanciasRegistrar();
    // cargarAreasRegistrar(); No se utiliza
    // No cargar proveedores aquí porque no está en el formulario de registrar
  });

  // Agregar a tu script existente en el modal
  $("#registrarEntradaModal").on("show.bs.modal", function () {
    // Cargar proveedores dinámicamente
    cargarProveedoresEntrada();
    // Cargar motivos de salida dinámicamente
    cargarMotivosSalida();
  });

  function cargarProveedoresEntrada() {
    cargarCatalogoEnModal("#registrarEntradaModal #id_proveedores", {
      api: 16, // API para proveedores activos
      campoId: "id_proveedores",
      campoTexto: "nombre",
      placeholder: "Seleccione...",
    });
  }

  function cargarMotivosSalida() {
    cargarCatalogoEnModal("#registrarEntradaModal #motivo_salida", {
      api: 15, // API para motivos activos
      campoId: "id_motivos",
      campoTexto: "descripcion",
      placeholder: "Seleccione un motivo de salida",
    });
  }

  // ==================== CARGAS PARA MODAL EDITAR ====================
  $("#editarArticuloModal").on("show.bs.modal", function () {
    // Cargar todos los catálogos primero sin callbacks
    cargarTiposEditar();
    cargarMarcasEditar();
    // cargarAreasEditar();
    cargarUnidadesEditar();
    cargarSustanciasEditar();

    // Esperar un momento para que se carguen los catálogos y luego establecer valores
    setTimeout(function () {
      establecerValoresFormularioEditar();
    }, 500);
  });

  $("#filtrarArticuloModal").on("show.bs.modal", function () {
    cargarTiposFiltrar();
    cargarAreasFiltrar();
  });

  // ==================== FUNCIÓN PARA ESTABLECER VALORES DEL FORMULARIO ====================
  function establecerValoresFormularioEditar() {
    if (!rowSelected) return;

    console.log("Estableciendo valores del formulario con rowSelected:", rowSelected);

    // Establecer tipo de artículo
    const tipoId = rowSelected.TIPO_ARTICULO_ID || rowSelected.ID_TIPO;
    if (tipoId) {
      $("#editarArticuloForm #tipo_articulo").val(tipoId);
      // Trigger change para mostrar/ocultar campos dependientes
      $("#editarArticuloForm #tipo_articulo").trigger('change');
    }

    // Establecer marca
    if (rowSelected.ID_MARCAS) {
      $("#editarArticuloForm #id_marcas").val(rowSelected.ID_MARCAS);
    } else if (rowSelected.MARCAS) {
      $("#editarArticuloForm #id_marcas option").each(function () {
        if ($(this).text().trim() === rowSelected.MARCAS.trim()) {
          $("#editarArticuloForm #id_marcas").val($(this).val());
          return false;
        }
      });
    }

    // Establecer área
    if (rowSelected.AREA_ID) {
      $("#editarArticuloForm #area_id").val(rowSelected.AREA_ID);
    } else if (rowSelected.AREA) {
      $("#editarArticuloForm #area_id option").each(function () {
        if ($(this).text().trim() === rowSelected.AREA.trim()) {
          $("#editarArticuloForm #area_id").val($(this).val());
          return false;
        }
      });
    }

    // Establecer unidad de venta
    if (rowSelected.UNIDAD_VENTA_ID) {
      $("#editarArticuloForm #unidad_venta").val(rowSelected.UNIDAD_VENTA_ID);
    } else if (rowSelected.UNIDAD_VENTA) {
      $("#editarArticuloForm #unidad_venta").val(rowSelected.UNIDAD_VENTA);
    }

    // Establecer sustancia activa
    if (rowSelected.ID_SUSTANCIA) {
      $("#editarArticuloForm #id_sustancia").val(rowSelected.ID_SUSTANCIA);
    }

    // Establecer campos de rendimiento y trigger change events
    if (rowSelected.MANEJA_RENDIMIENTO !== undefined) {
      $("#editarArticuloForm #maneja_rendimiento").val(rowSelected.MANEJA_RENDIMIENTO);
      $("#editarArticuloForm #maneja_rendimiento").trigger('change');
    }

    // Establecer campos de inserto y trigger change events
    if (rowSelected.MANEJA_INSERTO !== undefined) {
      $("#editarArticuloForm #maneja_inserto").val(rowSelected.MANEJA_INSERTO);
      $("#editarArticuloForm #maneja_inserto").trigger('change');
    }

    console.log("Valores establecidos correctamente");
  }

  // ==================== CARGAS PARA MODAL REGISTRAR ENTRADA ====================
  $("#registrarEntradaModal").on("show.bs.modal", function () {
    cargarProveedoresEntrada();
    cargarMotivosEntrada();
  });

  // ==================== FUNCIONES PARA AREAS ====================
  function cargarAreasRegistrar() {
    cargarCatalogoEnModal("#registrarArticuloModal #area_id", {
      api: 18,
      campoId: "ID_AREA", // Usar el campo que devuelve tu SP
      campoTexto: "DESCRIPCION",
      placeholder: "Seleccione un área",
    });
  }

  function cargarAreasEditar(callback) {
    cargarCatalogoEnModal(
      "#editarArticuloModal #area_id",
      {
        api: 18,
        campoId: "ID_AREA", // Usar el campo que devuelve tu SP
        campoTexto: "DESCRIPCION",
        placeholder: "Seleccione un área",
      },
      callback
    );
  }

  function cargarAreasFiltrar() {
    cargarCatalogoEnModal("#filtrarArticuloModal #area", {
      api: 18,
      campoId: "ID_AREA", // Usar el campo que devuelve tu SP
      campoTexto: "DESCRIPCION",
      placeholder: "Seleccione un área",
    });
  }

  // ==================== FUNCIONES PARA TIPOS ====================
  function cargarTiposRegistrar() {
    cargarCatalogoEnModal("#registrarArticuloModal #tipo_articulo", {
      api: 2,
      campoId: "ID_TIPO",
      campoTexto: "DESCRIPCION",
      placeholder: "Seleccione un tipo",
    });
  }

  function cargarTiposEditar(callback) {
    cargarCatalogoEnModal(
      "#editarArticuloModal #tipo_articulo",
      {
        api: 2,
        campoId: "ID_TIPO",
        campoTexto: "DESCRIPCION",
        placeholder: "Seleccione un tipo",
      },
      callback
    );
  }

  function cargarTiposFiltrar() {
    cargarCatalogoEnModal("#filtrarArticuloModal #tipoArticulo", {
      api: 2,
      campoId: "ID_TIPO",
      campoTexto: "DESCRIPCION",
      placeholder: "Seleccione un tipo",
    });
  }

  // ==================== FUNCIONES PARA MARCAS ====================
  function cargarMarcasRegistrar() {
    cargarCatalogoEnModal("#registrarArticuloModal #id_marcas", {
      api: 9,
      campoId: "id_marcas",
      campoTexto: "descripcion",
      placeholder: "Seleccione una marca",
    });
  }

  function cargarMarcasEditar(callback) {
    cargarCatalogoEnModal(
      "#editarArticuloModal #id_marcas",
      {
        api: 9,
        campoId: "id_marcas",
        campoTexto: "descripcion",
        placeholder: "Seleccione una marca",
      },
      callback
    );
  }

  // ==================== FUNCIONES PARA UNIDADES ====================
  function cargarUnidadesRegistrar() {
    cargarCatalogoEnModal("#registrarArticuloModal #unidad_venta", {
      api: 12, // API para unidades activas
      campoId: "id_unidades",
      campoTexto: "descripcion",
      placeholder: "Seleccione unidad de venta",
    });
  }

  function cargarUnidadesEditar(callback) {
    cargarCatalogoEnModal(
      "#editarArticuloModal #unidad_venta",
      {
        api: 12, // API para unidades activas
        campoId: "id_unidades",
        campoTexto: "descripcion",
        placeholder: "Seleccione unidad de venta",
      },
      callback
    );
  }

  // ==================== FUNCIONES PARA SUSTANCIAS ACTIVAS ====================
  function cargarSustanciasRegistrar() {
    cargarCatalogoEnModal("#registrarArticuloForm #id_sustancia", {
      api: 37, // API para sustancias activas usando stored procedure simple
      campoId: "ID_SUSTANCIA",
      campoTexto: "NOMBRE",
      placeholder: "Seleccione una sustancia activa",
    });
  }

  function cargarSustanciasEditar(callback) {
    cargarCatalogoEnModal(
      "#editarArticuloForm #id_sustancia",
      {
        api: 37, // API para sustancias activas usando stored procedure simple
        campoId: "ID_SUSTANCIA",
        campoTexto: "NOMBRE",
        placeholder: "Seleccione una sustancia activa",
      },
      callback
    );
  }

  // ==================== FUNCIONES PARA PROVEEDORES (solo para entradas) ====================
  function cargarProveedoresEntrada() {
    cargarCatalogoEnModal("#registrarEntradaModal #id_proveedores", {
      api: 16, // API para proveedores activos
      campoId: "id_proveedores",
      campoTexto: "nombre",
      placeholder: "Seleccione un proveedor",
    });
  }

  // ==================== FUNCIONES PARA MOTIVOS ====================
  function cargarMotivosEntrada() {
    cargarCatalogoEnModal("#registrarEntradaModal #motivo_salida", {
      api: 15, // API para motivos activos
      campoId: "id_motivos",
      campoTexto: "descripcion",
      placeholder: "Seleccione un motivo",
      filtroTipo: "salida", // Solo motivos de salida
    });
  }

  // ==================== FUNCIÓN AUXILIAR PARA BUSCAR UNIDAD DE VENTA ====================
  function buscarYSeleccionarUnidadVenta(unidadTexto) {
    if (!unidadTexto) return false;

    const selector = "#editarArticuloForm #unidad_venta";
    const unidadBuscada = unidadTexto.trim().toLowerCase();
    let encontrado = false;

    // Primero busqueda exacta
    $(selector + " option").each(function () {
      const opcionTexto = $(this).text().trim().toLowerCase();
      if (opcionTexto === unidadBuscada) {
        $(selector).val($(this).val());
        console.log(
          "Encontrado por coincidencia exacta:",
          $(this).text(),
          "ID:",
          $(this).val()
        );
        encontrado = true;
        return false;
      }
    });

    // Si no se encontró, buscar por coincidencias parciales
    if (!encontrado) {
      $(selector + " option").each(function () {
        const opcionTexto = $(this).text().trim().toLowerCase();
        if (
          opcionTexto.includes(unidadBuscada) ||
          unidadBuscada.includes(opcionTexto)
        ) {
          $(selector).val($(this).val());
          console.log(
            "Encontrado por coincidencia parcial:",
            $(this).text(),
            "ID:",
            $(this).val()
          );
          encontrado = true;
          return false;
        }
      });
    }

    return encontrado;
  }

  // ==================== FUNCIÓN GENÉRICA PARA CARGAR CATÁLOGOS ====================
  function cargarCatalogoEnModal(selectorSelect, opciones, callback) {
    $.ajax({
      url: "../../../api/inventarios_api.php",
      type: "POST",
      dataType: "json",
      data: {
        api: opciones.api,
        tipo_movimiento: opciones.filtroTipo || null,
      },
      success: function (response) {
        if (response.response && response.response.code == 1) {
          let selectElement = $(selectorSelect);
          let valorActual = selectElement.val();

          selectElement.empty();
          selectElement.append(
            `<option value="">${opciones.placeholder}</option>`
          );

          // Filtrar datos si es necesario (para motivos por tipo)
          let datos = response.response.data;
          if (opciones.filtroTipo && opciones.api === 15) {
            datos = datos.filter(
              (item) =>
                item.tipo_movimiento === opciones.filtroTipo ||
                item.tipo_movimiento === "ambos"
            );
          }

          datos.forEach(function (item) {
            selectElement.append(
              `<option value="${item[opciones.campoId]}">${
                item[opciones.campoTexto]
              }</option>`
            );
          });

          // Mantener la selección previa si existe
          if (valorActual) {
            selectElement.val(valorActual);
          }

          // Ejecutar callback si existe
          if (callback && typeof callback === "function") {
            callback();
          }
        } else {
          alertToast(`Error al cargar ${opciones.placeholder}`, "error", 3000);
        }
      },
      error: function (xhr, status, error) {
        alertToast(
          `Error de conexión al cargar ${opciones.placeholder}`,
          "error",
          3000
        );
      },
    });
  }

  // ==================== FUNCIONES PARA REQUISICIONES ====================

  // Variables globales para requisiciones
  var articulosRequisicion = [];
  var contadorArticulos = 0;
  var totalEstimadoRequisicion = 0;

  // Cargar áreas cuando se abre el modal de registrar requisición
  $("#registrarRequisicionModal").on("show.bs.modal", function () {
    cargarAreasRequisicion();
    establecerFechaMinima();
    limpiarFormularioRequisicion();
  });

  function cargarAreasRequisicion() {
    cargarCatalogoEnModal("#registrarRequisicionModal #areaSolicitante", {
      api: 18, // API para áreas
      campoId: "ID_AREA",
      campoTexto: "DESCRIPCION",
      placeholder: "Seleccione un área",
    });
  }

  function establecerFechaMinima() {
    const hoy = new Date();
    const manana = new Date(hoy);
    manana.setDate(hoy.getDate() + 1);

    const fechaMinima = manana.toISOString().split("T")[0];
    $("#fechaLimite").attr("min", fechaMinima);
  }

  function limpiarFormularioRequisicion() {
    $("#formRegistrarRequisicion")[0].reset();
    $("#prioridad").val("normal");
    $("#estatusRequisicion").val("borrador");
    articulosRequisicion = [];
    contadorArticulos = 0;
    totalEstimadoRequisicion = 0;
    actualizarTablaArticulos();
    actualizarContadorYTotal();
  }

  // Evento para agregar artículo
  $("#btnAgregarArticulo").on("click", function () {
    cargarArticulosParaSeleccion();
    $("#seleccionarArticuloModal").modal("show");
  });

  function cargarArticulosParaSeleccion() {
    $.ajax({
      url: "../../../api/inventarios_api.php",
      type: "POST",
      dataType: "json",
      data: { api: 4, id_movimiento: 1 }, // Solo artículos activos
      success: function (response) {
        if (response.response && response.response.code == 1) {
          let tbody = $("#tablaSeleccionArticulos tbody");
          tbody.empty();

          response.response.data.forEach(function (articulo) {
            let fila = `
              <tr>
                <td>${articulo.CLAVE_ART}</td>
                <td class="text-truncate-custom" title="${
                  articulo.NOMBRE_COMERCIAL
                }">
                  ${articulo.NOMBRE_COMERCIAL}
                </td>
                <td>${articulo.MARCAS || "-"}</td>
                <td class="text-center">
                  <span class="badge ${
                    articulo.CANTIDAD > 0 ? "bg-success" : "bg-danger"
                  }">
                    ${articulo.CANTIDAD || 0}
                  </span>
                </td>
                <td class="text-center">
                  <button class="btn btn-sm btn-primary btn-seleccionar-articulo" 
                          data-id="${articulo.ID_ARTICULO}"
                          data-nombre="${articulo.NOMBRE_COMERCIAL}"
                          data-clave="${articulo.CLAVE_ART}">
                    <i class="bi bi-plus-circle"></i> Agregar
                  </button>
                </td>
              </tr>
            `;
            tbody.append(fila);
          });
        }
      },
      error: function (xhr, status, error) {
        alertToast("Error al cargar los artículos", "error", 3000);
      },
    });
  }

  // Filtro de búsqueda en tabla de selección de artículos
  $("#buscarArticulo").on("input", function () {
    let filtro = $(this).val().toLowerCase();
    $("#tablaSeleccionArticulos tbody tr").each(function () {
      let textoFila = $(this).text().toLowerCase();
      $(this).toggle(textoFila.includes(filtro));
    });
  });

  // Seleccionar artículo de la tabla
  $(document).on("click", ".btn-seleccionar-articulo", function () {
    let articuloId = $(this).data("id");
    let nombreArticulo = $(this).data("nombre");
    let claveArticulo = $(this).data("clave");
    let observaciones = $(this).data("observaciones") || "Sin observaciones";

    // Verificar si ya está agregado
    if (articulosRequisicion.find((art) => art.id == articuloId)) {
      alertToast(
        "Este artículo ya está agregado a la requisición",
        "warning",
        3000
      );
      return;
    }

    // Agregar al array
    let nuevoArticulo = {
      id: articuloId,
      nombre: nombreArticulo,
      clave: claveArticulo,
      cantidad: 1,
      observaciones: observaciones,
    };

    articulosRequisicion.push(nuevoArticulo);
    contadorArticulos++;

    actualizarTablaArticulos();
    actualizarContadorYTotal();

    $("#seleccionarArticuloModal").modal("hide");
    alertToast(
      `Artículo "${nombreArticulo}" agregado exitosamente`,
      "success",
      2000
    );
  });

  function actualizarTablaArticulos() {
    let tbody = $("#tablaArticulosRequisicion tbody");
    tbody.empty();

    if (articulosRequisicion.length === 0) {
      tbody.append(`
        <tr id="filaVaciaArticulos">
          <td colspan="4" class="text-center text-muted">
            <i class="bi bi-inbox"></i><br>
            No hay artículos agregados
          </td>
        </tr>
      `);
    } else {
      articulosRequisicion.forEach(function (articulo, index) {
        let fila = `
          <tr>
            <td>
              <strong>${articulo.clave}</strong><br>
              <small class="text-muted">${articulo.nombre}</small>
            </td>
            <td class="text-center">
              <span class="badge bg-primary">${articulo.cantidad}</span>
            </td>
            <td class="text-center">
              <span class="badge bg-primary">${articulo.observaciones}</span>
            </td>
            <td class="text-center">
              <i class="bi bi-pencil btn-editar-articulo me-2" 
                 data-index="${index}" 
                 title="Editar cantidad"></i>
              <i class="bi bi-trash btn-eliminar-articulo" 
                 data-index="${index}" 
                 title="Eliminar artículo"></i>
            </td>
          </tr>
        `;
        tbody.append(fila);
      });
    }
  }

  function actualizarContadorYTotal() {
    $("#contadorArticulos").text(
      `${contadorArticulos} artículo${contadorArticulos !== 1 ? "s" : ""}`
    );
  }

  // Editar artículo
  $(document).on("click", ".btn-editar-articulo", function () {
    let index = $(this).data("index");
    let articulo = articulosRequisicion[index];
    console.log("Editar artículo:", articulo);

    $("#editarArticuloId").val(articulo.id);
    $("#editarIndiceTabla").val(index);
    $("#editarNombreArticulo").text(`${articulo.clave} - ${articulo.nombre}`);
    $("#editarCantidad").val(articulo.cantidad);
    $("#editarObservaciones").val(articulo.observaciones);

    $("#editarArticuloRequisicionModal").modal("show");
  });

  // Confirmar edición
  $("#btnConfirmarEdicion").on("click", function () {
    let index = parseInt($("#editarIndiceTabla").val());
    let cantidad = parseFloat($("#editarCantidad").val());

    if (cantidad <= 0) {
      alertToast("La cantidad debe ser mayor a 0", "warning", 3000);
      return;
    }

    let observaciones = $("#editarObservaciones").val().trim();

    articulosRequisicion[index].cantidad = cantidad;
    articulosRequisicion[index].observaciones = observaciones;

    actualizarTablaArticulos();
    actualizarContadorYTotal();

    $("#editarArticuloRequisicionModal").modal("hide");
    alertToast("Artículo actualizado exitosamente", "success", 2000);
  });

  // Eliminar artículo
  $(document).on("click", ".btn-eliminar-articulo", function () {
    let index = $(this).data("index");
    let articulo = articulosRequisicion[index];

    alertMensajeConfirm(
      {
        title: "Eliminar Artículo",
        text: `¿Está seguro de eliminar "${articulo.nombre}" de la requisición?`,
        icon: "warning",
      },
      function () {
        articulosRequisicion.splice(index, 1);
        contadorArticulos--;

        actualizarTablaArticulos();
        actualizarContadorYTotal();

        alertToast("Artículo eliminado de la requisición", "success", 2000);
      }
    );
  });

  // Validar formulario antes de enviar
  $("#formRegistrarRequisicion").on("submit", function (e) {
    e.preventDefault();

    if (!validarFormularioRequisicion()) {
      return;
    }

    guardarRequisicion();
  });

  function validarFormularioRequisicion() {
    // Validar campos básicos
    let area = $("#areaSolicitante").val();
    let justificacion = $("#justificacion").val().trim();
    let fechaLimite = $("#fechaLimite").val();
    let prioridad = $("#prioridad").val();

    if (!area) {
      alertToast("Debe seleccionar un área solicitante", "warning", 3000);
      return false;
    }

    if (justificacion.length < 10) {
      alertToast(
        "La justificación debe tener al menos 10 caracteres",
        "warning",
        3000
      );
      return false;
    }

    if (!fechaLimite) {
      alertToast("Debe especificar una fecha límite", "warning", 3000);
      return false;
    }

    // Validar que la fecha sea futura
    let hoy = new Date();
    let fechaSeleccionada = new Date(fechaLimite);
    if (fechaSeleccionada <= hoy) {
      alertToast("La fecha límite debe ser posterior a hoy", "warning", 3000);
      return false;
    }

    if (!prioridad) {
      alertToast("Debe seleccionar una prioridad", "warning", 3000);
      return false;
    }

    // Validar artículos
    if (articulosRequisicion.length === 0) {
      alertToast(
        "Debe agregar al menos un artículo a la requisición",
        "warning",
        3000
      );
      return false;
    }

    return true;
  }

  function guardarRequisicion(reintentos = 0) {
    let datosRequisicion = {
      api: 26, // API para guardar requisición
      area_solicitante_id: parseInt($("#areaSolicitante").val()),
      fecha_limite: $("#fechaLimite").val(),
      prioridad: $("#prioridad").val(),
      justificacion: $("#justificacion").val().trim(),
      estatus: $("#estatusRequisicion").val(),
    };

    console.log("Enviando datos de requisición:", datosRequisicion);

    $.ajax({
      url: "../../../api/inventarios_api.php",
      type: "POST",
      data: datosRequisicion,
      dataType: "json",
      success: function (response) {
        console.log(
          "Respuesta COMPLETA de guardar requisición:",
          JSON.stringify(response, null, 2)
        );

        if (
          response.response &&
          response.response.code == 1 &&
          response.response.data
        ) {
          let requisicionId = null;
          let numeroRequisicion = null;

          // Manejar diferentes formatos de respuesta
          if (
            Array.isArray(response.response.data) &&
            response.response.data.length > 0
          ) {
            // Formato esperado: array con objeto
            console.log(
              "Datos de respuesta (array):",
              response.response.data[0]
            );
            requisicionId = response.response.data[0].id_requisicion;
            numeroRequisicion = response.response.data[0].numero_requisicion;
          } else if (
            typeof response.response.data === "object" &&
            response.response.data.id_requisicion
          ) {
            // Formato alternativo: objeto directo
            console.log("Datos de respuesta (objeto):", response.response.data);
            requisicionId = response.response.data.id_requisicion;
            numeroRequisicion = response.response.data.numero_requisicion;
          } else if (
            typeof response.response.data === "string" ||
            typeof response.response.data === "number"
          ) {
            // Formato actual: solo el ID como string/number
            console.log(
              "Datos de respuesta (ID solo):",
              response.response.data
            );
            requisicionId = response.response.data;
            numeroRequisicion = `REQ-${new Date().getFullYear()}-${String(
              requisicionId
            ).padStart(4, "0")}`;
            console.log("Número de requisición generado:", numeroRequisicion);
          }

          console.log(
            "Requisición guardada exitosamente. ID:",
            requisicionId,
            "Número:",
            numeroRequisicion
          );

          if (requisicionId) {
            // Guardar detalles de artículos
            guardarDetallesRequisicion(requisicionId, numeroRequisicion);
          } else {
            console.error("ID de requisición no encontrado en la respuesta");
            alertToast(
              "Error: No se pudo obtener el ID de la requisición guardada",
              "error",
              4000
            );
          }
        } else {
          console.error("Error en respuesta de requisición:", response);
          let errorMsg =
            response.response &&
            response.response.data &&
            response.response.data[0] &&
            response.response.data[0].ERROR
              ? response.response.data[0].ERROR
              : "Error al guardar la requisición";

          // Verificar si es error de duplicado y reintentar
          if (
            errorMsg.includes("Duplicate entry") &&
            errorMsg.includes("numero_requisicion") &&
            reintentos < 3
          ) {
            console.log(
              `Error de duplicado detectado. Reintentando... (${
                reintentos + 1
              }/3)`
            );
            setTimeout(() => {
              guardarRequisicion(reintentos + 1);
            }, 1000 + reintentos * 500); // Delay incremental: 1s, 1.5s, 2s
          } else {
            alertToast(errorMsg, "error", 4000);
          }
        }
      },
      error: function (xhr, status, error) {
        console.error("Error AJAX al guardar requisición:", xhr.responseText);
        alertToast(
          "Error de conexión al guardar la requisición",
          "error",
          4000
        );
      },
    });
  }

  function guardarDetallesRequisicion(requisicionId, numeroRequisicion) {
    let detallesGuardados = 0;
    let totalDetalles = articulosRequisicion.length;

    articulosRequisicion.forEach(function (articulo) {
      let datosDetalle = {
        api: 27, // API para guardar detalles
        requisicion_id: requisicionId,
        articulo_id: articulo.id,
        cantidad_solicitada: articulo.cantidad,
        observaciones: articulo.observaciones || "Sin observaciones",
        operacion: "INSERT",
      };

      console.log("Enviando datos del detalle:", datosDetalle);
      console.log("Operación específica:", datosDetalle.operacion);
      console.log("Tipo de operación:", typeof datosDetalle.operacion);

      $.ajax({
        url: "../../../api/inventarios_api.php",
        type: "POST",
        data: datosDetalle,
        dataType: "json",
        success: function (response) {
          console.log(
            `Respuesta del detalle ${detallesGuardados + 1}:`,
            response
          );

          // Verificar si es exitoso por código 1, 2 o por mensaje de éxito
          let esExitoso = false;
          if (
            response.response &&
            (response.response.code == 1 || response.response.code == 2)
          ) {
            esExitoso = true;
          } else if (
            response === "Operación completada exitosamente." ||
            (typeof response === "string" && response.includes("exitosamente"))
          ) {
            esExitoso = true;
          } else if (
            response.response &&
            (response.response.msj || response.response.message) &&
            (response.response.msj === "Operación completada exitosamente." ||
              response.response.message ===
                "Operación completada exitosamente." ||
              (response.response.msj &&
                response.response.msj.includes("exitosamente")) ||
              (response.response.message &&
                response.response.message.includes("exitosamente")))
          ) {
            esExitoso = true;
          }

          if (esExitoso) {
            detallesGuardados++;
            console.log(
              `Detalle ${detallesGuardados} de ${totalDetalles} guardado exitosamente`
            );

            if (detallesGuardados === totalDetalles) {
              // Todos los detalles guardados exitosamente
              alertToast(
                `Requisición ${numeroRequisicion} guardada exitosamente`,
                "success",
                4000
              );
              $("#registrarRequisicionModal").modal("hide");

              // Limpiar formulario para próxima requisición
              limpiarFormularioRequisicion();

              // Recargar tabla de requisiciones
              if (typeof tableCatRequisiciones !== "undefined") {
                tableCatRequisiciones.ajax.reload();
              }
            }
          } else {
            console.error("Error al guardar detalle:", response);
            let errorMsg =
              response.response &&
              response.response.data &&
              response.response.data[0] &&
              response.response.data[0].ERROR
                ? response.response.data[0].ERROR
                : "Error al guardar los detalles de la requisición";
            alertToast(errorMsg, "error", 4000);
          }
        },
        error: function (xhr, status, error) {
          console.error("Error AJAX al guardar detalle:", xhr.responseText);
          alertToast(
            "Error de conexión al guardar los detalles",
            "error",
            4000
          );
        },
      });
    });
  }

  // ==================== FUNCIÓN ESPECÍFICA PARA MOTIVOS POR TIPO ====================
  function cargarMotivosPorTipo(selectorSelect, tipoMovimiento) {
    cargarCatalogoEnModal(selectorSelect, {
      api: 15, // API para motivos activos
      campoId: "id_motivos",
      campoTexto: "descripcion",
      placeholder: `Seleccione un motivo de ${tipoMovimiento}`,
      filtroTipo: tipoMovimiento,
    });
  }

  // ==================== EVENTOS PARA EDICIÓN DE REQUISICIONES ====================

  // Evento para agregar artículo en edición
  $("#btnEditarAgregarArticulo").on("click", function () {
    cargarArticulosParaSeleccionEditar();

    // Configurar el modal como anidado
    $("#seleccionarArticuloModal").modal({
      backdrop: true,
      keyboard: true,
    });

    // Ajustar z-index manualmente después de mostrar
    $("#seleccionarArticuloModal").on("shown.bs.modal", function () {
      $(this).css("z-index", 1060);
      $(".modal-backdrop").last().css("z-index", 1059);
    });

    $("#seleccionarArticuloModal").modal("show");
  });

  // Seleccionar artículo para edición
  $(document).on("click", ".btn-seleccionar-articulo-editar", function () {
    let articuloId = $(this).data("id");
    let nombreArticulo = $(this).data("nombre");
    let claveArticulo = $(this).data("clave");

    // Verificar si ya está agregado
    if (articulosRequisicionEditar.find((art) => art.id == articuloId)) {
      alertToast(
        "Este artículo ya está agregado a la requisición",
        "warning",
        3000
      );
      return;
    }

    // Agregar al array
    let nuevoArticulo = {
      id: articuloId,
      nombre: nombreArticulo,
      clave: claveArticulo,
      cantidad: 1,
      detalle_id: null, // Nuevo artículo, sin ID de detalle
    };

    articulosRequisicionEditar.push(nuevoArticulo);
    contadorArticulosEditar++;

    actualizarTablaArticulosEditar();
    actualizarContadorYTotalEditar();

    $("#seleccionarArticuloModal").modal("hide");
    alertToast(
      `Artículo "${nombreArticulo}" agregado exitosamente`,
      "success",
      2000
    );
  });

  // Editar artículo en edición
  $(document).on("click", ".btn-editar-articulo-editar", function () {
    let index = $(this).data("index");
    let articulo = articulosRequisicionEditar[index];

    $("#editarArticuloIdEdicion").val(articulo.id);
    $("#editarIndiceTablaEdicion").val(index);
    $("#editarNombreArticuloEdicion").text(
      `${articulo.clave} - ${articulo.nombre}`
    );
    $("#editarCantidadEdicion").val(articulo.cantidad);

    $("#editarArticuloEdicionModal").modal("show");
  });

  // Confirmar edición de artículo
  $(document).on("click", "#btnConfirmarEdicionArticulo", function () {
    let index = parseInt($("#editarIndiceTablaEdicion").val());
    let cantidad = parseFloat($("#editarCantidadEdicion").val());

    if (cantidad <= 0) {
      alertToast("La cantidad debe ser mayor a 0", "warning", 3000);
      return;
    }

    articulosRequisicionEditar[index].cantidad = cantidad;

    actualizarTablaArticulosEditar();
    actualizarContadorYTotalEditar();

    $("#editarArticuloEdicionModal").modal("hide");
    alertToast("Artículo actualizado exitosamente", "success", 2000);
  });

  // Eliminar artículo en edición
  $(document).on("click", ".btn-eliminar-articulo-editar", function () {
    let index = $(this).data("index");
    let articulo = articulosRequisicionEditar[index];

    alertMensajeConfirm(
      {
        title: "Eliminar Artículo",
        text: `¿Está seguro de eliminar "${articulo.nombre}" de la requisición?`,
        icon: "warning",
      },
      function () {
        articulosRequisicionEditar.splice(index, 1);
        contadorArticulosEditar--;

        actualizarTablaArticulosEditar();
        actualizarContadorYTotalEditar();

        alertToast("Artículo eliminado de la requisición", "success", 2000);
      }
    );
  });

  // Guardar cambios de la requisición
  $(document)
    .off("submit", "#formEditarRequisicion")
    .on("submit", "#formEditarRequisicion", function (e) {
      e.preventDefault();
      e.stopImmediatePropagation();

      console.log("Evento GLOBAL submit formulario requisición disparado");

      if (!validarFormularioRequisicionEditar()) {
        return;
      }

      actualizarRequisicion();
    });

  // ==================== EVENTOS PARA CAMBIO DE TIPO DE MOVIMIENTO ====================
  $(document).on("change", "#tipo_movimiento_entrada", function () {
    const tipoSeleccionado = $(this).val();
    if (tipoSeleccionado === "1") {
      // Entrada
      cargarMotivosPorTipo("#registrarEntradaModal #motivo_entrada", "entrada");
    } else if (tipoSeleccionado === "2") {
      // Salida
      cargarMotivosPorTipo("#registrarEntradaModal #motivo_salida", "salida");
    }
  });
});

// ==================== FUNCIONES GLOBALES PARA EDICIÓN DE REQUISICIONES ====================

// Variables globales para edición de requisiciones
var articulosRequisicionEditar = [];
var contadorArticulosEditar = 0;
var totalEstimadoRequisicionEditar = 0;

// Cargar datos completos de la requisición seleccionada
function cargarDatosRequisicionCompletos() {
  if (!rowSelectedRequisicion) {
    alertToast("No hay una requisición seleccionada", "error", 3000);
    return;
  }

  console.log("Cargando datos de requisición:", rowSelectedRequisicion);

  // Llenar campos básicos directamente
  $("#editarIdRequisicion").val(rowSelectedRequisicion.id_requisicion);
  $("#numeroRequisicionEditar").text(rowSelectedRequisicion.numero_requisicion);
  $("#editarJustificacion").val(rowSelectedRequisicion.justificacion || "");
  $("#editarFechaLimite").val(rowSelectedRequisicion.fecha_limite);
  $("#editarPrioridad").val(rowSelectedRequisicion.prioridad || "normal");
  $("#editarEstatusRequisicion").val(
    rowSelectedRequisicion.estatus || "borrador"
  );

  // Establecer fecha mínima
  establecerFechaMinimaEditar();

  // Cargar áreas y después seleccionar la correcta
  cargarAreasParaEdicion(function () {
    // Una vez cargadas las áreas, buscar y seleccionar por texto
    buscarYSeleccionarAreaPorTexto(rowSelectedRequisicion.area_solicitante);
  });

  // Cargar artículos de la requisición
  cargarArticulosDeRequisicion(rowSelectedRequisicion.id_requisicion);
}

function establecerFechaMinimaEditar() {
  const hoy = new Date();
  const manana = new Date(hoy);
  manana.setDate(hoy.getDate() + 1);

  const fechaMinima = manana.toISOString().split("T")[0];
  $("#editarFechaLimite").attr("min", fechaMinima);
}

function cargarAreasParaEdicion(callback) {
  cargarCatalogoEnModal(
    "#editarAreaSolicitante",
    {
      api: 18, // API para áreas
      campoId: "ID_AREA",
      campoTexto: "DESCRIPCION",
      placeholder: "Seleccione un área",
    },
    callback
  );
}

function buscarYSeleccionarAreaPorTexto(textoArea) {
  // Buscar el option que coincida con el texto del área
  $("#editarAreaSolicitante option").each(function () {
    if ($(this).text().trim() === textoArea.trim()) {
      $("#editarAreaSolicitante").val($(this).val());
      return false; // Romper el loop
    }
  });
}

function cargarArticulosDeRequisicion(requisicionId) {
  $.ajax({
    url: "../../../api/inventarios_api.php",
    type: "POST",
    dataType: "json",
    data: { api: 28, requisicion_id: requisicionId },
    success: function (response) {
      console.log("Respuesta completa de artículos de requisición:", response);

      if (
        response.response &&
        response.response.code == 1 &&
        response.response.data
      ) {
        console.log("Datos de respuesta:", response.response.data);
        console.log("Primer elemento de datos:", response.response.data[0]);

        articulosRequisicionEditar = [];
        contadorArticulosEditar = 0;
        totalEstimadoRequisicionEditar = 0;

        response.response.data.forEach(function (detalle, index) {
          console.log(`Procesando detalle ${index}:`, detalle);
          console.log("Propiedades del detalle:", Object.keys(detalle));

          // Mapear campos con diferentes posibles nombres
          let articulo = {
            id:
              detalle.articulo_id || detalle.ID_ARTICULO || detalle.id_articulo,
            nombre:
              detalle.nombre_comercial ||
              detalle.NOMBRE_COMERCIAL ||
              detalle.nombre_articulo,
            clave:
              detalle.clave_art || detalle.CLAVE_ART || detalle.clave_articulo,
            cantidad:
              parseFloat(
                detalle.cantidad_solicitada || detalle.CANTIDAD_SOLICITADA
              ) || 1,
            precio:
              parseFloat(detalle.precio_estimado || detalle.PRECIO_ESTIMADO) ||
              0,
            subtotal: 0, // Se calculará después
            detalle_id: detalle.id_detalle || detalle.ID_DETALLE,
          };

          // Calcular subtotal
          articulo.subtotal = articulo.cantidad * articulo.precio;

          console.log("Artículo procesado:", articulo);

          articulosRequisicionEditar.push(articulo);
          contadorArticulosEditar++;
        });

        actualizarTablaArticulosEditar();
        actualizarContadorYTotalEditar();

        console.log(
          "Artículos cargados para edición:",
          articulosRequisicionEditar
        );
      } else {
        // No hay artículos o error
        console.log("No se encontraron artículos o hubo un error:", response);
        articulosRequisicionEditar = [];
        contadorArticulosEditar = 0;
        totalEstimadoRequisicionEditar = 0;
        actualizarTablaArticulosEditar();
        actualizarContadorYTotalEditar();
      }
    },
    error: function (xhr, status, error) {
      console.error("Error al cargar artículos de requisición:", error);
      console.error("Respuesta del servidor:", xhr.responseText);
      alertToast(
        "Error al cargar los artículos de la requisición",
        "error",
        3000
      );

      // Limpiar en caso de error
      articulosRequisicionEditar = [];
      contadorArticulosEditar = 0;
      totalEstimadoRequisicionEditar = 0;
      actualizarTablaArticulosEditar();
      actualizarContadorYTotalEditar();
    },
  });
}

function actualizarTablaArticulosEditar() {
  let tbody = $("#tablaEditarArticulosRequisicion tbody");
  tbody.empty();

  if (articulosRequisicionEditar.length === 0) {
    tbody.append(`
      <tr id="filaVaciaArticulosEditar">
        <td colspan="3" class="text-center text-muted">
          <i class="bi bi-inbox"></i><br>
          No hay artículos agregados
        </td>
      </tr>
    `);
  } else {
    articulosRequisicionEditar.forEach(function (articulo, index) {
      let fila = `
        <tr>
          <td>
            <strong>${articulo.clave}</strong><br>
            <small class="text-muted">${articulo.nombre}</small>
          </td>
          <td class="text-center">
            <span class="badge bg-primary">${articulo.cantidad}</span>
          </td>
          <td class="text-center">
            <i class="bi bi-pencil btn-editar-articulo-editar me-2" 
               data-index="${index}" 
               title="Editar cantidad"></i>
            <i class="bi bi-trash btn-eliminar-articulo-editar" 
               data-index="${index}" 
               title="Eliminar artículo"></i>
          </td>
        </tr>
      `;
      tbody.append(fila);
    });
  }
}

function actualizarContadorYTotalEditar() {
  $("#contadorArticulosEditar").text(
    `${contadorArticulosEditar} artículo${
      contadorArticulosEditar !== 1 ? "s" : ""
    }`
  );
}

function cargarArticulosParaSeleccionEditar() {
  $.ajax({
    url: "../../../api/inventarios_api.php",
    type: "POST",
    dataType: "json",
    data: { api: 4, id_movimiento: 1 }, // Solo artículos activos
    success: function (response) {
      if (response.response && response.response.code == 1) {
        let tbody = $("#tablaSeleccionArticulos tbody");
        tbody.empty();

        response.response.data.forEach(function (articulo) {
          let fila = `
            <tr>
              <td>${articulo.CLAVE_ART}</td>
              <td class="text-truncate-custom" title="${
                articulo.NOMBRE_COMERCIAL
              }">
                ${articulo.NOMBRE_COMERCIAL}
              </td>
              <td>${articulo.MARCAS || "-"}</td>
              <td class="text-center">
                <span class="badge ${
                  articulo.CANTIDAD > 0 ? "bg-success" : "bg-danger"
                }">
                  ${articulo.CANTIDAD || 0}
                </span>
              </td>
              <td class="text-center">
                <button class="btn btn-sm btn-primary btn-seleccionar-articulo-editar" 
                        data-id="${articulo.ID_ARTICULO}"
                        data-nombre="${articulo.NOMBRE_COMERCIAL}"
                        data-clave="${articulo.CLAVE_ART}">
                  <i class="bi bi-plus-circle"></i> Agregar
                </button>
              </td>
            </tr>
          `;
          tbody.append(fila);
        });
      }
    },
    error: function (xhr, status, error) {
      alertToast("Error al cargar los artículos", "error", 3000);
    },
  });
}

function validarFormularioRequisicionEditar() {
  // Validar campos básicos
  let area = $("#editarAreaSolicitante").val();
  let justificacion = $("#editarJustificacion").val().trim();
  let fechaLimite = $("#editarFechaLimite").val();
  let prioridad = $("#editarPrioridad").val();

  if (!area) {
    alertToast("Debe seleccionar un área solicitante", "warning", 3000);
    return false;
  }

  if (justificacion.length < 10) {
    alertToast(
      "La justificación debe tener al menos 10 caracteres",
      "warning",
      3000
    );
    return false;
  }

  if (!fechaLimite) {
    alertToast("Debe especificar una fecha límite", "warning", 3000);
    return false;
  }

  // Validar que la fecha sea futura
  let hoy = new Date();
  let fechaSeleccionada = new Date(fechaLimite);
  if (fechaSeleccionada <= hoy) {
    alertToast("La fecha límite debe ser posterior a hoy", "warning", 3000);
    return false;
  }

  if (!prioridad) {
    alertToast("Debe seleccionar una prioridad", "warning", 3000);
    return false;
  }

  // Validar artículos
  if (articulosRequisicionEditar.length === 0) {
    alertToast(
      "Debe agregar al menos un artículo a la requisición",
      "warning",
      3000
    );
    return false;
  }

  return true;
}

function actualizarRequisicion() {
  let datosRequisicion = {
    api: 29, // API para actualizar requisición
    id_requisicion: parseInt($("#editarIdRequisicion").val()),
    area_solicitante_id: parseInt($("#editarAreaSolicitante").val()),
    fecha_limite: $("#editarFechaLimite").val(),
    prioridad: $("#editarPrioridad").val(),
    justificacion: $("#editarJustificacion").val().trim(),
    estatus: $("#editarEstatusRequisicion").val(),
  };

  console.log("Actualizando requisición:", datosRequisicion);

  $.ajax({
    url: "../../../api/inventarios_api.php",
    type: "POST",
    data: datosRequisicion,
    dataType: "json",
    success: function (response) {
      console.log("Respuesta de actualizar requisición:", response);

      if (response.response && response.response.code == 1) {
        // Requisición actualizada, ahora actualizar los artículos
        actualizarDetallesRequisicion();
      } else {
        let errorMsg =
          response.response &&
          response.response.data &&
          response.response.data[0] &&
          response.response.data[0].ERROR
            ? response.response.data[0].ERROR
            : "Error al actualizar la requisición";
        alertToast(errorMsg, "error", 4000);
      }
    },
    error: function (xhr, status, error) {
      console.error("Error AJAX al actualizar requisición:", xhr.responseText);
      alertToast(
        "Error de conexión al actualizar la requisición",
        "error",
        4000
      );
    },
  });
}

function actualizarDetallesRequisicion() {
  let requisicionId = parseInt($("#editarIdRequisicion").val());
  let detallesActualizados = 0;
  let totalDetalles = articulosRequisicionEditar.length;

  articulosRequisicionEditar.forEach(function (articulo) {
    let datosDetalle = {
      api: 27, // API para manejar detalles
      requisicion_id: requisicionId,
      articulo_id: articulo.id,
      cantidad_solicitada: articulo.cantidad,
      operacion: articulo.detalle_id ? "UPDATE" : "INSERT",
    };

    if (articulo.detalle_id) {
      datosDetalle.id_detalle = articulo.detalle_id;
    }

    console.log("Actualizando detalle:", datosDetalle);

    $.ajax({
      url: "../../../api/inventarios_api.php",
      type: "POST",
      data: datosDetalle,
      dataType: "json",
      success: function (response) {
        console.log(
          `Respuesta del detalle ${detallesActualizados + 1}:`,
          response
        );

        // Verificar si es exitoso
        let esExitoso = false;
        if (
          response.response &&
          (response.response.code == 1 || response.response.code == 2)
        ) {
          esExitoso = true;
        } else if (
          response === "Operación completada exitosamente." ||
          (typeof response === "string" && response.includes("exitosamente"))
        ) {
          esExitoso = true;
        }

        if (esExitoso) {
          detallesActualizados++;

          if (detallesActualizados === totalDetalles) {
            // Todos los detalles actualizados exitosamente
            alertToast("Requisición actualizada exitosamente", "success", 4000);
            $("#editarRequisicionModal").modal("hide");

            // Recargar tabla de requisiciones con manejo de errores
            setTimeout(function () {
              if (
                typeof tableCatRequisiciones !== "undefined" &&
                tableCatRequisiciones.ajax
              ) {
                try {
                  tableCatRequisiciones.ajax.reload(function (json) {
                    console.log(
                      "Tabla de requisiciones recargada exitosamente"
                    );
                  }, false); // false = no reset de paginación
                } catch (error) {
                  console.error(
                    "Error al recargar tabla de requisiciones:",
                    error
                  );
                  // Recargar la página como alternativa
                  setTimeout(function () {
                    location.reload();
                  }, 1000);
                }
              } else {
                console.log(
                  "DataTable de requisiciones no disponible para recarga"
                );
              }
            }, 500);
          }
        } else {
          console.error("Error al actualizar detalle:", response);
          alertToast(
            "Error al actualizar los detalles de la requisición",
            "error",
            4000
          );
        }
      },
      error: function (xhr, status, error) {
        console.error("Error AJAX al actualizar detalle:", xhr.responseText);
        alertToast(
          "Error de conexión al actualizar los detalles",
          "error",
          4000
        );
      },
    });
  });
}

// También necesitamos cargarCatalogoEnModal disponible globalmente
function cargarCatalogoEnModal(selectorSelect, opciones, callback) {
  $.ajax({
    url: "../../../api/inventarios_api.php",
    type: "POST",
    dataType: "json",
    data: {
      api: opciones.api,
      tipo_movimiento: opciones.filtroTipo || null,
    },
    success: function (response) {
      if (response.response && response.response.code == 1) {
        let selectElement = $(selectorSelect);
        let valorActual = selectElement.val();

        selectElement.empty();
        selectElement.append(
          `<option value="">${opciones.placeholder}</option>`
        );

        // Filtrar datos si es necesario (para motivos por tipo)
        let datos = response.response.data;
        if (opciones.filtroTipo && opciones.api === 15) {
          datos = datos.filter(
            (item) =>
              item.tipo_movimiento === opciones.filtroTipo ||
              item.tipo_movimiento === "ambos"
          );
        }

        datos.forEach(function (item) {
          selectElement.append(
            `<option value="${item[opciones.campoId]}">${
              item[opciones.campoTexto]
            }</option>`
          );
        });

        // Mantener la selección previa si existe
        if (valorActual) {
          selectElement.val(valorActual);
        }

        // Ejecutar callback si existe
        if (callback && typeof callback === "function") {
          callback();
        }
      } else {
        alertToast(`Error al cargar ${opciones.placeholder}`, "error", 3000);
      }
    },
    error: function (xhr, status, error) {
      alertToast(
        `Error de conexión al cargar ${opciones.placeholder}`,
        "error",
        3000
      );
    },
  });
}

// catalogos, mostrar las tablas
var tableCatTipos,
  tableCatUnidades,
  tableCatMarcas,
  tableCatMotivos,
  tableCatProveedores,
  tableCatSustancias;
var rowSelectedCatalogo = null;

// Variables de filtro para DataTables de catálogos
var dataTableCatTipos = { api: 2 };
var dataTableCatUnidades = { api: 12 };
var dataTableCatMarcas = { api: 9 };
var dataTableCatMotivos = { api: 15 };
var dataTableCatProveedores = { api: 16 };
var dataTableCatSustancias = { api: 37 }; // API para listar sustancias activas

$("#registrarCatalogoModal").on("shown.bs.modal", function () {
  // solo inicializar si no existen las tablas
  if (!tableCatTipos) {
    inicializarDataTablesCatalogos();
  }
});

// aqui poner las datatabls para inicializarlas
function inicializarDataTablesCatalogos() {
  // DATATABLE DE TIPOS
  tableCatTipos = $("#tableCatTipos").DataTable({
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
        return $.extend(d, dataTableCatTipos);
      },
      method: "POST",
      url: "../../../api/inventarios_api.php",
      error: function (jqXHR, textStatus, errorThrown) {
        alertErrorAJAX(jqXHR, textStatus, errorThrown);
      },
      dataSrc: "response.data",
    },
    columns: [
      { data: "ID_TIPO" },
      { data: "DESCRIPCION" },
      {
        data: "ACTIVO",
        render: function (data) {
          return data == 1
            ? '<i class="bi bi-toggle-on fs-4 text-success"></i>'
            : '<i class="bi bi-toggle-off fs-4"></i>';
        },
      },
      {
        data: null,
        render: function (data, type, row) {
          return `
                        <button class="btn btn-sm btn-warning btn-editar-tipo" data-id="${row.ID_TIPO}" data-descripcion="${row.DESCRIPCION}" data-activo="${row.ACTIVO}">
                            <i class="bi bi-pencil"></i>
                        </button>
                        <button class="btn btn-sm btn-danger btn-eliminar-tipo" data-id="${row.ID_TIPO}">
                            <i class="bi bi-trash"></i>
                        </button>
                    `;
        },
      },
    ],
    // AGREGAR BOTÓN PERSONALIZADO
    dom: 'Bl<"dataTables_toolbar">frtip',
    buttons: [
      {
        text: '<i class="bi bi-plus-lg"></i> Nuevo Tipo',
        className: "btn btn-success",
        attr: {
          "data-bs-toggle": "modal",
          "data-bs-target": "#registrarTipoModal",
        },
        action: function () {
          $("#registrarTipoModal").modal("show");
        },
      },
      {
        text: '<i class="bi bi-funnel"></i> Filtrar Tipos',
        className: "btn btn-warning",
        attr: {
          "data-bs-toggle": "modal",
          "data-bs-target": "#filtrarTiposModal",
        },
        action: function () {
          $("#filtrarTiposModal").modal("show");
        },
      },
    ],
  });

  // DATATABLE DE UNIDADES
  tableCatUnidades = $("#tableCatUnidades").DataTable({
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
        return $.extend(d, dataTableCatUnidades);
      },
      method: "POST",
      url: "../../../api/inventarios_api.php",
      error: function (jqXHR, textStatus, errorThrown) {
        alertErrorAJAX(jqXHR, textStatus, errorThrown);
      },
      dataSrc: "response.data",
    },
    columns: [
      { data: "id_unidades" },
      { data: "descripcion" },
      {
        data: "activo",
        render: function (data) {
          return data == 1
            ? '<i class="bi bi-toggle-on fs-4 text-success"></i>'
            : '<i class="bi bi-toggle-off fs-4"></i>';
        },
      },
      {
        data: null,
        render: function (data, type, row) {
          return `
                        <button class="btn btn-sm btn-warning btn-editar-unidad" data-id="${row.id_unidades}" data-descripcion="${row.descripcion}" data-activo="${row.activo}">
                            <i class="bi bi-pencil"></i>
                        </button>
                        <button class="btn btn-sm btn-danger btn-eliminar-unidad" data-id="${row.id_unidades}">
                            <i class="bi bi-trash"></i>
                        </button>
        `;
        },
      },
    ],
    // AGREGAR BOTÓN PERSONALIZADO
    dom: 'Bl<"dataTables_toolbar">frtip',
    buttons: [
      {
        text: '<i class="bi bi-plus-lg"></i> Nueva Unidad',
        className: "btn btn-success",
        attr: {
          "data-bs-toggle": "modal",
          "data-bs-target": "#registrarUnidadModal",
        },
        action: function () {
          $("#registrarUnidadModal").modal("show");
        },
      },
      {
        text: '<i class="bi bi-funnel"></i> Filtrar Unidades',
        className: "btn btn-warning",
        attr: {
          "data-bs-toggle": "modal",
          "data-bs-target": "#filtrarUnidadesModal",
        },
        action: function () {
          $("#filtrarUnidadesModal").modal("show");
        },
      },
    ],
  });

  // DATATABLE DE MARCAS
  tableCatMarcas = $("#tableCatMarcas").DataTable({
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
        return $.extend(d, dataTableCatMarcas);
      },
      method: "POST",
      url: "../../../api/inventarios_api.php",
      error: function (jqXHR, textStatus, errorThrown) {
        alertErrorAJAX(jqXHR, textStatus, errorThrown);
      },
      dataSrc: "response.data",
    },
    columns: [
      { data: "id_marcas" },
      { data: "descripcion" },
      {
        data: "activo",
        render: function (data) {
          return data == 1
            ? '<i class="bi bi-toggle-on fs-4 text-success"></i>'
            : '<i class="bi bi-toggle-off fs-4"></i>';
        },
      },
      {
        data: null,
        render: function (data, type, row) {
          return `
                        <button class="btn btn-sm btn-warning btn-editar-marca" data-id="${row.id_marcas}" data-descripcion="${row.descripcion}" data-activo="${row.activo}">
                            <i class="bi bi-pencil"></i>
                        </button>
                        <button class="btn btn-sm btn-danger btn-eliminar-marca" data-id="${row.id_marcas}">
                            <i class="bi bi-trash"></i>
                        </button>
        `;
        },
      },
    ],
    // AGREGAR BOTÓN PERSONALIZADO
    dom: 'Bl<"dataTables_toolbar">frtip',
    buttons: [
      {
        text: '<i class="bi bi-plus-lg"></i> Nueva Marca',
        className: "btn btn-success",
        attr: {
          "data-bs-toggle": "modal",
          "data-bs-target": "#registrarMarcaModal",
        },
        action: function () {
          $("#registrarMarcaModal").modal("show");
        },
      },
      {
        text: '<i class="bi bi-funnel"></i> Filtrar Marcas',
        className: "btn btn-warning",
        attr: {
          "data-bs-toggle": "modal",
          "data-bs-target": "#filtrarMarcassModal",
        },
        action: function () {
          $("#filtrarMarcasModal").modal("show");
        },
      },
    ],
  });

  //DATATABLE DE MOTIVOS
  tableCatMotivos = $("#tableCatMotivos").DataTable({
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
        return $.extend(d, dataTableCatMotivos);
      },
      method: "POST",
      url: "../../../api/inventarios_api.php",
      error: function (jqXHR, textStatus, errorThrown) {
        alertErrorAJAX(jqXHR, textStatus, errorThrown);
      },
      dataSrc: "response.data",
    },
    columns: [
      { data: "id_motivos" },
      { data: "descripcion" },
      {
        data: "activo",
        render: function (data) {
          return data == 1
            ? '<i class="bi bi-toggle-on fs-4 text-success"></i>'
            : '<i class="bi bi-toggle-off fs-4"></i>';
        },
      },
      {
        data: "tipo_movimiento",
        render: function (data) {
          let badgeClass = "";
          let texto = "";

          switch (data) {
            case "entrada":
              badgeClass = "bg-success";
              texto = "Entrada";
              break;
            case "salida":
              badgeClass = "bg-danger";
              texto = "Salida";
              break;
            case "ambos":
              badgeClass = "bg-info";
              texto = "Ambos";
              break;
            default:
              badgeClass = "bg-secondary";
              texto = "No definido";
          }

          return `<span class="badge ${badgeClass}">${texto}</span>`;
        },
      },
      {
        data: null,
        render: function (data, type, row) {
          return `
                        <button class="btn btn-sm btn-warning btn-editar-motivo" data-id="${row.id_motivos}" data-descripcion="${row.descripcion}" data-activo="${row.activo}" data-tipo-movimiento="${row.tipo_movimiento}">
                            <i class="bi bi-pencil"></i>
                        </button>
                        <button class="btn btn-sm btn-danger btn-eliminar-motivo" data-id="${row.id_motivos}">
                            <i class="bi bi-trash"></i>
                        </button>
        `;
        },
      },
    ],
    // AGREGAR BOTÓN PERSONALIZADO
    dom: 'Bl<"dataTables_toolbar">frtip',
    buttons: [
      {
        text: '<i class="bi bi-plus-lg"></i> Nuevo motivo',
        className: "btn btn-success",
        attr: {
          "data-bs-toggle": "modal",
          "data-bs-target": "#registrarMotivoModal",
        },
        action: function () {
          $("#registrarMotivoModal").modal("show");
        },
      },
      {
        text: '<i class="bi bi-funnel"></i> Filtrar Motivos',
        className: "btn btn-warning",
        attr: {
          "data-bs-toggle": "modal",
          "data-bs-target": "#filtrarMotivosModal",
        },
        action: function () {
          $("#filtrarMotivosModal").modal("show");
        },
      },
    ],
  });

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
      url: "../../../api/inventarios_api.php",
      error: function (jqXHR, textStatus, errorThrown) {
        alertErrorAJAX(jqXHR, textStatus, errorThrown);
      },
      dataSrc: "response.data",
    },
    columns: [
      { data: "id_proveedores" },
      { data: "nombre" },
      { data: "contacto" },
      { data: "telefono" },
      {
        data: "activo",
        render: function (data) {
          return data == 1
            ? '<i class="bi bi-toggle-on fs-4 text-success"></i>'
            : '<i class="bi bi-toggle-off fs-4"></i>';
        },
      },
      {
        data: null,
        render: function (data, type, row) {
          return `
                    <button class="btn btn-sm btn-warning btn-editar-proveedor" data-id="${row.id_proveedores}" data-nombre="${row.nombre}" data-contacto="${row.contacto}" data-telefono="${row.telefono}" data-email="${row.email}" data-activo="${row.activo}">
                        <i class="bi bi-pencil"></i>
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

  // DATATABLE DE SUSTANCIAS ACTIVAS
  tableCatSustancias = $("#tableCatSustancias").DataTable({
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
        return $.extend(d, dataTableCatSustancias);
      },
      method: "POST",
      url: "../../../api/inventarios_api.php",
      error: function (jqXHR, textStatus, errorThrown) {
        alertErrorAJAX(jqXHR, textStatus, errorThrown);
      },
      dataSrc: "response.data",
    },
    columns: [
      { data: "ID_SUSTANCIA" },
      { data: "NOMBRE" },
      {
        data: "TIPO",
        render: function (data) {
          // Capitalizar primera letra
          return data.charAt(0).toUpperCase() + data.slice(1);
        },
      },
      {
        data: "ESTATUS",
        render: function (data) {
          return data == 1
            ? '<i class="bi bi-toggle-on fs-4 text-success"></i>'
            : '<i class="bi bi-toggle-off fs-4"></i>';
        },
      },
      {
        data: null,
        render: function (data, type, row) {
          return `
                    <button class="btn btn-sm btn-warning btn-editar-sustancia" 
                            data-id="${row.ID_SUSTANCIA}" 
                            data-nombre="${row.NOMBRE}" 
                            data-tipo="${row.TIPO}" 
                            data-descripcion="${row.DESCRIPCION || ""}" 
                            data-estatus="${row.ESTATUS}">
                        <i class="bi bi-pencil"></i>
                    </button>
                    <button class="btn btn-sm btn-danger btn-eliminar-sustancia" data-id="${
                      row.ID_SUSTANCIA
                    }">
                        <i class="bi bi-trash"></i>
                    </button>
                `;
        },
      },
    ],
    dom: 'Bl<"dataTables_toolbar">frtip',
    buttons: [
      {
        text: '<i class="bi bi-plus-lg"></i> Nueva Sustancia',
        className: "btn btn-success",
        attr: {
          "data-bs-toggle": "modal",
          "data-bs-target": "#registrarSustanciaModal",
        },
        action: function () {
          $("#registrarSustanciaModal").modal("show");
        },
      },
    ],
  });

  // Aplicar la función inputBusquedaTable después de la inicialización
  setTimeout(() => {
    inputBusquedaTable(
      "tableCatTipos",
      tableCatTipos,
      [
        {
          msj: "Buscar tipos...",
          place: "top",
        },
      ],
      [],
      "col-12"
    );

    inputBusquedaTable(
      "tableCatMarcas",
      tableCatMarcas,
      [
        {
          msj: "Buscar marcas...",
          place: "top",
        },
      ],
      [],
      "col-12"
    );

    inputBusquedaTable(
      "tableCatUnidades",
      tableCatUnidades,
      [
        {
          msj: "Buscar unidades...",
          place: "top",
        },
      ],
      [],
      "col-12"
    );

    inputBusquedaTable(
      "tableCatMotivos",
      tableCatMotivos,
      [
        {
          msj: "Buscar motivos...",
          place: "top",
        },
      ],
      [],
      "col-12"
    );
    inputBusquedaTable(
      "tableCatProveedores",
      tableCatProveedores,
      [
        {
          msj: "Buscar proveedores...",
          place: "top",
        },
      ],
      [],
      "col-12"
    );

    inputBusquedaTable(
      "tableCatSustancias",
      tableCatSustancias,
      [
        {
          msj: "Buscar sustancias activas...",
          place: "top",
        },
      ],
      [],
      "col-12"
    );

    // Ajustar columnas
    tableCatTipos.columns.adjust().draw();
    tableCatMarcas.columns.adjust().draw();
    tableCatUnidades.columns.adjust().draw();
    tableCatMotivos.columns.adjust().draw();
    tableCatProveedores.columns.adjust().draw();
    tableCatSustancias.columns.adjust().draw();
  }, 1000);

  inicializarEventosCatalogos();
}

// Función para inicializar los eventos de los catálogos
function inicializarEventosCatalogos() {
  // ==================== EVENTOS PARA TIPOS ====================
  // Evento para botón editar tipo
  $(document).on("click", ".btn-editar-tipo", function () {
    var tipoId = $(this).data("id");
    var descripcion = $(this).data("descripcion");
    var activo = $(this).data("activo");

    // Cambiar el título del modal
    $("#registrarTipoModalLabel").text("Editar Tipo");

    // Llenar el formulario con los datos
    $("#tipoId").val(tipoId);
    $("#tipoDescripcion").val(descripcion);
    $("#tipoActivoCheck").prop("checked", activo == 1);

    // Mostrar el modal
    $("#registrarTipoModal").modal("show");
  });

  // Evento para limpiar el formulario cuando se cierra el modal de tipo
  $("#registrarTipoModal").on("hidden.bs.modal", function () {
    $("#registrarTipoModalLabel").text("Registrar Tipo");
    $("#registrarTipoForm")[0].reset();
    $("#tipoId").val("");
  });

  // ==================== EVENTOS PARA UNIDADES ====================
  // Evento para botón editar unidad
  $(document).on("click", ".btn-editar-unidad", function () {
    var unidadId = $(this).data("id");
    var descripcion = $(this).data("descripcion");
    var activo = $(this).data("activo");

    // Cambiar el título del modal
    $("#registrarUnidadModalLabel").text("Editar Unidad");

    // Llenar el formulario con los datos
    $("#unidadId").val(unidadId);
    $("#unidadDescripcion").val(descripcion);
    $("#unidadActivoCheck").prop("checked", activo == 1);

    // Mostrar el modal
    $("#registrarUnidadModal").modal("show");
  });

  // Evento para limpiar el formulario cuando se cierra el modal de unidad
  $("#registrarUnidadModal").on("hidden.bs.modal", function () {
    $("#registrarUnidadModalLabel").text("Registrar Unidad");
    $("#registrarUnidadForm")[0].reset();
    $("#unidadId").val("");
  });

  // ==================== EVENTOS PARA MARCAS ====================
  // Evento para botón editar marca
  $(document).on("click", ".btn-editar-marca", function () {
    var marcaId = $(this).data("id");
    var descripcion = $(this).data("descripcion");
    var activo = $(this).data("activo");

    // Cambiar el título del modal
    $("#registrarMarcaModalLabel").text("Editar Marca");

    // Llenar el formulario con los datos
    $("#marcaId").val(marcaId);
    $("#marcaDescripcion").val(descripcion);
    $("#marcaActivoCheck").prop("checked", activo == 1);

    // Mostrar el modal
    $("#registrarMarcaModal").modal("show");
  });

  // Evento para limpiar el formulario cuando se cierra el modal de marca
  $("#registrarMarcaModal").on("hidden.bs.modal", function () {
    $("#registrarMarcaModalLabel").text("Registrar Marca");
    $("#registrarMarcaForm")[0].reset();
    $("#marcaId").val("");
  });

  // ==================== EVENTOS PARA MOTIVOS ====================
  // Evento para botón editar motivo
  $(document).on("click", ".btn-editar-motivo", function () {
    var motivoId = $(this).data("id");
    var descripcion = $(this).data("descripcion");
    var activo = $(this).data("activo");
    var tipoMovimiento = $(this).data("tipo-movimiento");

    // Cambiar el título del modal
    $("#registrarMotivoModalLabel").text("Editar Motivo");

    // Llenar el formulario con los datos
    $("#motivoId").val(motivoId);
    $("#motivoDescripcion").val(descripcion);
    $("#motivoActivoCheck").prop("checked", activo == 1);
    $("#motivoTipoMovimiento").val(tipoMovimiento);

    // Mostrar el modal
    $("#registrarMotivoModal").modal("show");
  });

  // Evento para limpiar el formulario cuando se cierra el modal de motivo
  $("#registrarMotivoModal").on("hidden.bs.modal", function () {
    $("#registrarMotivoModalLabel").text("Registrar Motivo");
    $("#registrarMotivoForm")[0].reset();
    $("#motivoId").val("");
  });

  // ==================== EVENTOS PARA PROVEEDORES ====================
  // Evento para botón editar proveedor
  $(document).on("click", ".btn-editar-proveedor", function () {
    var proveedorId = $(this).data("id");
    var nombre = $(this).data("nombre");
    var contacto = $(this).data("contacto");
    var telefono = $(this).data("telefono");
    var email = $(this).data("email");
    var activo = $(this).data("activo");

    // Cambiar el título del modal
    $("#registrarProveedorModalLabel").text("Editar Proveedor");

    // Llenar el formulario con los datos
    $("#proveedorId").val(proveedorId);
    $("#proveedorNombre").val(nombre);
    $("#proveedorContacto").val(contacto);
    $("#proveedorTelefono").val(telefono);
    $("#proveedorEmail").val(email);
    $("#proveedorActivoCheck").prop("checked", activo == 1);

    // Mostrar el modal
    $("#registrarProveedorModal").modal("show");
  });

  // Evento para limpiar el formulario cuando se cierra el modal de proveedor
  $("#registrarProveedorModal").on("hidden.bs.modal", function () {
    $("#registrarProveedorModalLabel").text("Registrar Proveedor");
    $("#registrarProveedorForm")[0].reset();
    $("#proveedorId").val("");
  });

  // ==================== EVENTOS PARA ELIMINAR (DESACTIVAR) ====================
  // Evento para botón eliminar tipo
  $(document).on("click", ".btn-eliminar-tipo", function () {
    var tipoId = $(this).data("id");
    var tipoDescripcion = $(this).closest("tr").find("td:eq(1)").text(); // Obtener descripción de la fila

    alertMensajeConfirm(
      {
        title: "Estás desactivando el tipo: " + tipoDescripcion,
        text: "¿Desea continuar? Esta acción ocultará el tipo de las listas.",
        icon: "warning",
      },
      function () {
        ajaxAwait(
          {
            api: 10, // API para tipos (usar la misma que para insertar/actualizar)
            id_tipo: tipoId,
            descripcion: tipoDescripcion,
            activo: 0, // Desactivar
          },
          "inventarios_api",
          { callbackAfter: true },
          false,
          function (data) {
            if (data.response.code == 1) {
              alertToast("Tipo desactivado correctamente!", "success", 4000);
              tableCatTipos.ajax.reload();
            } else {
              alertToast("Error al desactivar el tipo", "error", 4000);
            }
          }
        );
      },
      1
    );
  });

  // Evento para botón eliminar unidad
  $(document).on("click", ".btn-eliminar-unidad", function () {
    var unidadId = $(this).data("id");
    var unidadDescripcion = $(this).closest("tr").find("td:eq(1)").text(); // Obtener descripción de la fila

    alertMensajeConfirm(
      {
        title: "Estás desactivando la unidad: " + unidadDescripcion,
        text: "¿Desea continuar? Esta acción ocultará la unidad de las listas.",
        icon: "warning",
      },
      function () {
        ajaxAwait(
          {
            api: 13, // API para unidades (usar la misma que para insertar/actualizar)
            id_unidades: unidadId,
            descripcion: unidadDescripcion,
            activo: 0, // Desactivar
          },
          "inventarios_api",
          { callbackAfter: true },
          false,
          function (data) {
            if (data.response.code == 1) {
              alertToast("Unidad desactivada correctamente!", "success", 4000);
              tableCatUnidades.ajax.reload();
            } else {
              alertToast("Error al desactivar la unidad", "error", 4000);
            }
          }
        );
      },
      1
    );
  });

  // Evento para botón eliminar marca
  $(document).on("click", ".btn-eliminar-marca", function () {
    var marcaId = $(this).data("id");
    var marcaDescripcion = $(this).closest("tr").find("td:eq(1)").text(); // Obtener descripción de la fila

    alertMensajeConfirm(
      {
        title: "Estás desactivando la marca: " + marcaDescripcion,
        text: "¿Desea continuar? Esta acción ocultará la marca de las listas.",
        icon: "warning",
      },
      function () {
        ajaxAwait(
          {
            api: 11, // API para marcas (usar la misma que para insertar/actualizar)
            id_marcas: marcaId,
            descripcion: marcaDescripcion,
            activo: 0, // Desactivar
          },
          "inventarios_api",
          { callbackAfter: true },
          false,
          function (data) {
            if (data.response.code == 1) {
              alertToast("Marca desactivada correctamente!", "success", 4000);
              tableCatMarcas.ajax.reload();
            } else {
              alertToast("Error al desactivar la marca", "error", 4000);
            }
          }
        );
      },
      1
    );
  });

  // Evento para botón eliminar motivo
  $(document).on("click", ".btn-eliminar-motivo", function () {
    var motivoId = $(this).data("id");
    var motivoDescripcion = $(this).closest("tr").find("td:eq(1)").text(); // Obtener descripción de la fila
    var tipoMovimiento = $(this).data("tipo-movimiento"); // Obtener tipo de movimiento

    alertMensajeConfirm(
      {
        title: "Estás desactivando el motivo: " + motivoDescripcion,
        text: "¿Desea continuar? Esta acción ocultará el motivo de las listas.",
        icon: "warning",
      },
      function () {
        ajaxAwait(
          {
            api: 14, // API para motivos (usar la misma que para insertar/actualizar)
            id_motivos: motivoId,
            descripcion: motivoDescripcion,
            tipo_movimiento: tipoMovimiento,
            activo: 0, // Desactivar
          },
          "inventarios_api",
          { callbackAfter: true },
          false,
          function (data) {
            if (data.response.code == 1) {
              alertToast("Motivo desactivado correctamente!", "success", 4000);
              tableCatMotivos.ajax.reload();
            } else {
              alertToast("Error al desactivar el motivo", "error", 4000);
            }
          }
        );
      },
      1
    );
  });

  // Evento para botón eliminar proveedor
  $(document).on("click", ".btn-eliminar-proveedor", function () {
    var proveedorId = $(this).data("id");
    // Obtener los datos de las celdas de la tabla
    var $row = $(this).closest("tr");
    var proveedorNombre = $row.find("td:eq(1)").text(); // Columna del nombre
    var proveedorContacto = $row.find("td:eq(2)").text(); // Columna del contacto
    var proveedorTelefono = $row.find("td:eq(3)").text(); // Columna del teléfono
    // El email no está visible en la tabla, pero lo necesitamos para el SP
    // Obtenerlo del botón de editar que sí tiene todos los data attributes
    var proveedorEmail = $row.find(".btn-editar-proveedor").data("email");

    alertMensajeConfirm(
      {
        title: "Estás desactivando el proveedor: " + proveedorNombre,
        text: "¿Desea continuar? Esta acción ocultará el proveedor de las listas.",
        icon: "warning",
      },
      function () {
        ajaxAwait(
          {
            api: 17, // API para proveedores (usar la misma que para insertar/actualizar)
            id_proveedores: proveedorId,
            nombre: proveedorNombre,
            contacto: proveedorContacto,
            telefono: proveedorTelefono,
            email: proveedorEmail,
            activo: 0, // Desactivar
          },
          "inventarios_api",
          { callbackAfter: true },
          false,
          function (data) {
            if (data.response.code == 1) {
              alertToast(
                "Proveedor desactivado correctamente!",
                "success",
                4000
              );
              tableCatProveedores.ajax.reload();
            } else {
              alertToast("Error al desactivar el proveedor", "error", 4000);
            }
          }
        );
      },
      1
    );
  });

  // ==================== EVENTOS PARA SUSTANCIAS ACTIVAS ====================
  // Evento para botón editar sustancia
  $(document).on("click", ".btn-editar-sustancia", function () {
    var sustanciaId = $(this).data("id");
    var nombre = $(this).data("nombre");
    var tipo = $(this).data("tipo");
    var descripcion = $(this).data("descripcion");
    var estatus = $(this).data("estatus");

    // Cambiar el título del modal
    $("#registrarSustanciaModalLabel").text("Editar Sustancia Activa");

    // Llenar el formulario con los datos
    $("#sustanciaId").val(sustanciaId);
    $("#sustanciaNombre").val(nombre);
    $("#sustanciaTipo").val(tipo);
    $("#sustanciaDescripcion").val(descripcion);
    $("#sustanciaActivaCheck").prop("checked", estatus == 1);

    // Mostrar el modal
    $("#registrarSustanciaModal").modal("show");
  });

  // Evento para limpiar el formulario cuando se cierra el modal de sustancia
  $("#registrarSustanciaModal").on("hidden.bs.modal", function () {
    $("#registrarSustanciaModalLabel").text("Registrar Sustancia Activa");
    $("#registrarSustanciaForm")[0].reset();
    $("#sustanciaId").val("");
  });

  // Evento para botón eliminar sustancia
  $(document).on("click", ".btn-eliminar-sustancia", function () {
    var sustanciaId = $(this).data("id");
    var sustanciaNombre = $(this).closest("tr").find("td:eq(1)").text(); // Obtener nombre de la fila

    alertMensajeConfirm(
      {
        title: "Estás desactivando la sustancia: " + sustanciaNombre,
        text: "¿Desea continuar? Esta acción ocultará la sustancia de las listas.",
        icon: "warning",
      },
      function () {
        ajaxAwait(
          {
            api: 38, // API para CRUD de sustancias en inventarios_api
            id_sustancia: sustanciaId,
            accion: "DELETE",
          },
          "inventarios_api",
          { callbackAfter: true },
          false,
          function (data) {
            if (data.response.code == 1) {
              alertToast(
                "Sustancia desactivada correctamente!",
                "success",
                4000
              );
              tableCatSustancias.ajax.reload();
            } else {
              alertToast("Error al desactivar la sustancia", "error", 4000);
            }
          }
        );
      },
      1
    );
  });
}

// ==================== FUNCIONES PARA VALIDACIÓN DE DUPLICADOS ====================

// Función para validar duplicados antes de enviar el formulario
function validarDuplicadosArticulo(formulario, articuloId = null) {
  const nombreComercial = $(formulario + " #nombre_comercial").val();
  const unidadVenta = $(formulario + " #unidad_venta").val();
  const marcaId = $(formulario + " #id_marcas").val();
  const contenido = $(formulario + " #contenido").val();

  // Solo validar si todos los campos están completos
  if (!nombreComercial || !unidadVenta || !marcaId) {
    return Promise.resolve(true); // Permitir continuar si faltan datos
  }

  return new Promise((resolve) => {
    $.ajax({
      url: "../../../api/inventarios_api.php",
      type: "POST",
      dataType: "json",
      data: {
        api: 19, // Nueva API para validar duplicados
        nombre_comercial: nombreComercial.trim(),
        unidad_venta: unidadVenta,
        id_marcas: marcaId,
        contenido: contenido.trim(),
        id_articulo_actual: articuloId,
      },
      success: function (response) {
        if (response.response && response.response.code === 2) {
          // Se encontró un duplicado
          const articulo = response.response.data;
          const mensaje =
            `⚠️ **Posible Duplicado Detectado**\n\n` +
            `Ya existe un artículo con las mismas características:\n\n` +
            `• **Nombre:** ${articulo.NOMBRE_COMERCIAL}\n` +
            `• **Clave:** ${articulo.CLAVE_ART}\n` +
            `• **Unidad:** ${articulo.UNIDAD_DESCRIPCION}\n` +
            `• **Marca:** ${articulo.MARCA_DESCRIPCION}\n` +
            `• **Especificaciones:** ${
              articulo.CONTENIDO || "Sin especificaciones"
            }\n\n` +
            `¿Desea continuar de todas formas?`;

          // Mostrar confirmación al usuario
          alertMensajeConfirm(
            {
              title: "Duplicado Detectado",
              text: mensaje,
              icon: "warning",
              showCancelButton: true,
              confirmButtonText: "Sí, continuar",
              cancelButtonText: "No, revisar datos",
            },
            function () {
              resolve(true); // Usuario acepta continuar
            },
            function () {
              resolve(false); // Usuario cancela
            }
          );
        } else {
          resolve(true); // No hay duplicados, continuar
        }
      },
      error: function (xhr, status, error) {
        console.log("Error al validar duplicados:", error);
        resolve(true); // En caso de error, permitir continuar
      },
    });
  });
}

// Función para validar en tiempo real mientras el usuario escribe
function validarDuplicadosEnTiempoReal(formulario, articuloId = null) {
  const nombreComercial = $(formulario + " #nombre_comercial").val();
  const unidadVenta = $(formulario + " #unidad_venta").val();
  const marcaId = $(formulario + " #id_marcas").val();
  const contenido = $(formulario + " #contenido").val();

  // Limpiar alertas previas
  $(formulario + " .alerta-duplicado").remove();

  if (!nombreComercial || !unidadVenta || !marcaId) {
    return; // No validar si faltan datos
  }

  $.ajax({
    url: "../../../api/inventarios_api.php",
    type: "POST",
    dataType: "json",
    data: {
      api: 19,
      nombre_comercial: nombreComercial.trim(),
      unidad_venta: unidadVenta,
      id_marcas: marcaId,
      contenido: contenido.trim(),
      id_articulo_actual: articuloId,
    },
    success: function (response) {
      if (response.response && response.response.code === 2) {
        const articulo = response.response.data;
        const alerta = `
                    <div class="alert alert-warning alerta-duplicado mt-2" role="alert">
                        <strong>⚠️ Posible duplicado:</strong> Ya existe "${articulo.NOMBRE_COMERCIAL}" 
                        (${articulo.CLAVE_ART}) con la misma unidad y marca.
                    </div>
                `;
        $(formulario + " #nombre_comercial")
          .closest(".mb-3")
          .append(alerta);
      }
    },
    error: function (xhr, status, error) {
      console.log("Error al validar duplicados en tiempo real:", error);
    },
  });
}

// Eventos para validación en tiempo real
$(document).ready(function () {
  // Validación en tiempo real para modal de registro
  $(
    "#registrarArticuloModal #nombre_comercial, #registrarArticuloModal #unidad_venta, #registrarArticuloModal #id_marcas, #registrarArticuloModal #contenido"
  ).on("change blur", function () {
    setTimeout(function () {
      validarDuplicadosEnTiempoReal("#registrarArticuloModal");
    }, 500); // Delay para evitar muchas llamadas
  });

  // Validación en tiempo real para modal de edición
  $(
    "#editarArticuloModal #nombre_comercial, #editarArticuloModal #unidad_venta, #editarArticuloModal #id_marcas, #editarArticuloModal #contenido"
  ).on("change blur", function () {
    setTimeout(function () {
      const articuloId = rowSelected ? rowSelected.ID_ARTICULO : null;
      validarDuplicadosEnTiempoReal("#editarArticuloModal", articuloId);
    }, 500);
  });

  // Limpiar alertas al abrir modales
  $("#registrarArticuloModal, #editarArticuloModal").on(
    "show.bs.modal",
    function () {
      $(this).find(".alerta-duplicado").remove();
    }
  );
});

// ==================== EVENTOS GLOBALES PARA EDICIÓN DE REQUISICIONES ====================
// Estos eventos están fuera del $(document).ready() para asegurar el scope correcto

// Evento para agregar artículo en edición
$(document).on("click", "#btnEditarAgregarArticulo", function () {
  cargarArticulosParaSeleccionEditar();

  // Configurar el modal como anidado
  $("#seleccionarArticuloModal").modal({
    backdrop: true,
    keyboard: true,
  });

  // Ajustar z-index manualmente después de mostrar
  $("#seleccionarArticuloModal").on("shown.bs.modal", function () {
    $(this).css("z-index", 1060);
    $(".modal-backdrop").last().css("z-index", 1059);
  });

  $("#seleccionarArticuloModal").modal("show");
});

// Seleccionar artículo para edición
$(document).on("click", ".btn-seleccionar-articulo-editar", function () {
  let articuloId = $(this).data("id");
  let nombreArticulo = $(this).data("nombre");
  let claveArticulo = $(this).data("clave");
  let precioReferencia = parseFloat($(this).data("precio")) || 0;

  // Verificar si ya está agregado
  if (articulosRequisicionEditar.find((art) => art.id == articuloId)) {
    alertToast(
      "Este artículo ya está agregado a la requisición",
      "warning",
      3000
    );
    return;
  }

  // Agregar al array
  let nuevoArticulo = {
    id: articuloId,
    nombre: nombreArticulo,
    clave: claveArticulo,
    cantidad: 1,
    precio: precioReferencia,
    subtotal: precioReferencia * 1,
    detalle_id: null, // Nuevo artículo, sin ID de detalle
  };

  articulosRequisicionEditar.push(nuevoArticulo);
  contadorArticulosEditar++;

  actualizarTablaArticulosEditar();
  actualizarContadorYTotalEditar();

  // Cerrar modal con limpieza de eventos
  $("#seleccionarArticuloModal").off("shown.bs.modal").modal("hide");

  alertToast(
    `Artículo "${nombreArticulo}" agregado exitosamente`,
    "success",
    2000
  );
});

// Editar artículo en edición
$(document).on("click", ".btn-editar-articulo-editar", function () {
  let index = $(this).data("index");
  let articulo = articulosRequisicionEditar[index];

  $("#editarArticuloIdEdicion").val(articulo.id);
  $("#editarIndiceTablaEdicion").val(index);
  $("#editarNombreArticuloEdicion").text(
    `${articulo.clave} - ${articulo.nombre}`
  );
  $("#editarCantidadEdicion").val(articulo.cantidad);
  $("#editarPrecioEdicion").val(articulo.precio);

  calcularSubtotalEdicionEditar();
  $("#editarArticuloEdicionModal").modal("show");
});

// Eliminar artículo en edición (EVENTO GLOBAL)
$(document)
  .off(
    "click",
    "#tablaEditarArticulosRequisicion .btn-eliminar-articulo-editar"
  )
  .on(
    "click",
    "#tablaEditarArticulosRequisicion .btn-eliminar-articulo-editar",
    function (e) {
      e.preventDefault();
      e.stopImmediatePropagation(); // Evitar propagación múltiple

      let index = $(this).data("index");

      console.log("Evento GLOBAL ESPECÍFICO eliminar disparado. Index:", index);
      console.log("Artículos disponibles:", articulosRequisicionEditar);

      if (index === undefined || index === null || index < 0) {
        alertToast(
          "Error: No se pudo identificar el artículo a eliminar",
          "error",
          3000
        );
        return;
      }

      if (index >= articulosRequisicionEditar.length) {
        alertToast("Error: Índice de artículo inválido", "error", 3000);
        return;
      }

      let articulo = articulosRequisicionEditar[index];

      if (!articulo) {
        alertToast("Error: Artículo no encontrado", "error", 3000);
        return;
      }

      console.log("Artículo a eliminar:", articulo);

      alertMensajeConfirm(
        {
          title: "Eliminar Artículo",
          text: `¿Está seguro de eliminar "${articulo.nombre}" de la requisición?`,
          icon: "warning",
          showCancelButton: true,
          confirmButtonText: "Sí, eliminar",
          cancelButtonText: "Cancelar",
        },
        function () {
          // Confirmar eliminación
          console.log("Eliminando artículo en índice:", index);
          console.log(
            "Array antes de eliminar:",
            JSON.stringify(articulosRequisicionEditar)
          );

          // Si el artículo tiene detalle_id, eliminarlo de la base de datos
          if (
            articulo.detalle_id &&
            articulo.detalle_id !== null &&
            articulo.detalle_id !== "null"
          ) {
            console.log(
              "Eliminando artículo de la base de datos. ID detalle:",
              articulo.detalle_id
            );

            $.ajax({
              url: "../../../api/inventarios_api.php",
              type: "POST",
              dataType: "json",
              data: {
                api: 30,
                id_detalle: articulo.detalle_id,
                requisicion_id: rowSelectedRequisicion.id_requisicion,
              },
              success: function (response) {
                console.log("Respuesta de eliminación física:", response);
                console.log("Tipo de response:", typeof response);
                console.log("response.response:", response.response);
                console.log(
                  "response.response.code:",
                  response.response ? response.response.code : "undefined"
                );
                console.log(
                  "response.response.data:",
                  response.response ? response.response.data : "undefined"
                );

                // Verificar múltiples condiciones de éxito
                let esExitoso = false;

                if (
                  response.response &&
                  (response.response.code == 1 || response.response.code == 2)
                ) {
                  esExitoso = true;
                } else if (
                  response.response &&
                  response.response.msj === "SUCCESS"
                ) {
                  // Verificar mensaje de éxito específico
                  esExitoso = true;
                } else if (
                  response.response &&
                  response.response.data &&
                  response.response.data.length > 0
                ) {
                  // Verificar si hay datos que indiquen éxito
                  let primeraFila = response.response.data[0];
                  if (primeraFila.RESULT === "SUCCESS" || primeraFila.MESSAGE) {
                    esExitoso = true;
                  }
                } else if (response.code == 1 || response.code == 2) {
                  // Verificar en el nivel superior
                  esExitoso = true;
                }

                if (esExitoso) {
                  // Eliminación exitosa en base de datos
                  console.log(
                    "Artículo eliminado exitosamente de la base de datos"
                  );

                  // Eliminar del array local
                  articulosRequisicionEditar.splice(index, 1);
                  contadorArticulosEditar--;

                  // Actualizar la tabla y contadores
                  actualizarTablaArticulosEditar();
                  actualizarContadorYTotalEditar();

                  // Si no quedan artículos, recargar la tabla principal
                  if (articulosRequisicionEditar.length === 0) {
                    console.log(
                      "No quedan artículos, recargando tabla principal..."
                    );
                    setTimeout(function () {
                      try {
                        if (
                          typeof tableCatRequisiciones !== "undefined" &&
                          tableCatRequisiciones
                        ) {
                          tableCatRequisiciones.ajax.reload(function (json) {
                            console.log(
                              "Tabla de requisiciones recargada después de eliminar último artículo"
                            );
                          }, false);
                        }
                      } catch (error) {
                        console.error(
                          "Error al recargar tabla principal:",
                          error
                        );
                      }
                    }, 500);
                  }

                  alertToast(
                    "Artículo eliminado permanentemente de la requisición",
                    "success",
                    2000
                  );
                } else {
                  console.error(
                    "Error al eliminar artículo de la base de datos:",
                    response
                  );
                  alertToast(
                    "Error al eliminar el artículo de la base de datos",
                    "error",
                    3000
                  );
                }
              },
              error: function (xhr, status, error) {
                console.error(
                  "Error AJAX al eliminar artículo:",
                  xhr.responseText
                );
                alertToast(
                  "Error de conexión al eliminar el artículo",
                  "error",
                  3000
                );
              },
            });
          } else {
            // Artículo nuevo, solo eliminar del array local
            console.log(
              "Eliminando artículo nuevo (sin detalle_id) solo del array local"
            );

            articulosRequisicionEditar.splice(index, 1);
            contadorArticulosEditar--;

            // Actualizar la tabla y contadores
            actualizarTablaArticulosEditar();
            actualizarContadorYTotalEditar();

            alertToast("Artículo eliminado de la requisición", "success", 2000);
          }

          console.log(
            "Array después de eliminar:",
            JSON.stringify(articulosRequisicionEditar)
          );
        }
      );
    }
  );

// Calcular subtotal en modal de edición para artículos
$(document).on(
  "input",
  "#editarCantidadEdicion, #editarPrecioEdicion",
  function () {
    calcularSubtotalEdicionEditar();
  }
);

// Confirmar edición de artículo
$(document).on("click", "#btnConfirmarEdicionArticulo", function () {
  let index = parseInt($("#editarIndiceTablaEdicion").val());
  let cantidad = parseFloat($("#editarCantidadEdicion").val());
  let precio = parseFloat($("#editarPrecioEdicion").val()) || 0;

  if (cantidad <= 0) {
    alertToast("La cantidad debe ser mayor a 0", "warning", 3000);
    return;
  }

  articulosRequisicionEditar[index].cantidad = cantidad;
  articulosRequisicionEditar[index].precio = precio;
  articulosRequisicionEditar[index].subtotal = cantidad * precio;

  actualizarTablaArticulosEditar();
  actualizarContadorYTotalEditar();

  $("#editarArticuloEdicionModal").modal("hide");
  alertToast("Artículo actualizado exitosamente", "success", 2000);
});

// Función para manejar modales anidados correctamente
function configurarModalAnidado(modalId) {
  $(modalId).on("show.bs.modal", function () {
    // Asegurar z-index correcto
    setTimeout(function () {
      $(modalId).css("z-index", 1060);
      $(".modal-backdrop").last().css("z-index", 1059);
    }, 10);
  });

  $(modalId).on("hidden.bs.modal", function () {
    // Limpiar eventos duplicados
    $(this).off("shown.bs.modal");
  });
}

// Configurar modales anidados al cargar
configurarModalAnidado("#seleccionarArticuloModal");
configurarModalAnidado("#editarArticuloEdicionModal");

// ==================== FUNCIÓN PARA CARGAR DETALLES COMPLETOS DE REQUISICIÓN ====================
function cargarDetallesRequisicionCompletos() {
  if (!rowSelectedRequisicion) {
    alertToast("Por favor, seleccione una requisición", "warning", 3000);
    return;
  }

  console.log(
    "Cargando detalles completos de requisición:",
    rowSelectedRequisicion
  );

  // Cargar información básica
  $("#numeroRequisicionDetalle").text(
    rowSelectedRequisicion.numero_requisicion
  );
  $("#detalleNumero").text(rowSelectedRequisicion.numero_requisicion);
  $("#detalleArea").text(rowSelectedRequisicion.area_solicitante);
  $("#detalleSolicitante").text(rowSelectedRequisicion.solicitante);
  $("#detalleFechaCreacion").text(rowSelectedRequisicion.fecha_creacion);
  $("#detalleFechaLimite").text(rowSelectedRequisicion.fecha_limite || "-");
  $("#detalleTotalEstimado").text(
    rowSelectedRequisicion.total_estimado || "$0.00"
  );
  $("#detalleJustificacion").text(rowSelectedRequisicion.justificacion || "-");

  // Configurar prioridad con badge
  const prioridadBadges = {
    urgente: "badge bg-danger",
    normal: "badge bg-primary",
    baja: "badge bg-secondary",
  };
  const prioridadClass =
    prioridadBadges[rowSelectedRequisicion.prioridad] ||
    "badge bg-light text-dark";
  $("#detallePrioridad").html(
    `<span class="${prioridadClass}">${
      rowSelectedRequisicion.prioridad
        ? rowSelectedRequisicion.prioridad.charAt(0).toUpperCase() +
          rowSelectedRequisicion.prioridad.slice(1)
        : ""
    }</span>`
  );

  // Configurar estado con badge
  const estatusBadges = {
    borrador: "badge bg-warning text-dark",
    pendiente: "badge bg-info",
    aprobada: "badge bg-primary",
    rechazada: "badge bg-danger",
    parcialmente_surtida: "badge bg-warning",
    completada: "badge bg-success",
    pausada: "badge bg-secondary",
  };
  const estatusClass =
    estatusBadges[rowSelectedRequisicion.estatus] || "badge bg-light text-dark";
  $("#detalleEstatus")
    .removeClass()
    .addClass(estatusClass)
    .text(
      rowSelectedRequisicion.estatus
        ? rowSelectedRequisicion.estatus.charAt(0).toUpperCase() +
            rowSelectedRequisicion.estatus.slice(1).replace("_", " ")
        : ""
    );

  // Información de aprobación
  if (
    rowSelectedRequisicion.aprobador &&
    rowSelectedRequisicion.fecha_aprobacion
  ) {
    $("#detalleAprobadoPor").text(rowSelectedRequisicion.aprobador);
    $("#detalleFechaAprobacion").text(rowSelectedRequisicion.fecha_aprobacion);
    $("#cardObservacionesAprobacion").show();

    if (rowSelectedRequisicion.observaciones_aprobacion) {
      $("#detalleObservacionesAprobacion").text(
        rowSelectedRequisicion.observaciones_aprobacion
      );
    } else {
      $("#detalleObservacionesAprobacion").text("Sin observaciones");
    }
  } else {
    $("#cardObservacionesAprobacion").hide();
  }

  // Mostrar/ocultar sección de acciones según el estado
  if (rowSelectedRequisicion.estatus === "pendiente") {
    $("#cardAccionesAprobacion").show();
    $("#cardAccionesSurtimiento").hide();
  } else if (
    rowSelectedRequisicion.estatus === "aprobada" ||
    rowSelectedRequisicion.estatus === "parcialmente_surtida"
  ) {
    $("#cardAccionesAprobacion").hide();
    $("#cardAccionesSurtimiento").show();
  } else {
    $("#cardAccionesAprobacion").hide();
    $("#cardAccionesSurtimiento").hide();
  }

  // Mostrar/ocultar botón de imprimir solo cuando la requisición esté completada
  if (rowSelectedRequisicion.estatus === "completada") {
    $("#btnImprimirRequisicion").show();
  } else {
    $("#btnImprimirRequisicion").hide();
  }

  if (
    rowSelectedRequisicion.estatus === "parcialmente_surtida" ||
    rowSelectedRequisicion.estatus === "completada"
  ) {
    $("#btnDetalleSurtimiento").show();
  } else {
    $("#btnDetalleSurtimiento").hide();
  }

  if (
    rowSelectedRequisicion.estatus === "aprobada" ||
    rowSelectedRequisicion.estatus === "completada" ||
    rowSelectedRequisicion.estatus === "pendiente"
  ) {
    $("#btnGenerarExcel").show();
  } else {
    $("#btnGenerarExcel").hide();
  }

  // Cargar artículos de la requisición
  cargarArticulosDetalle(rowSelectedRequisicion.id_requisicion);

  // Cargar historial (opcional - por ahora lo dejamos como placeholder)
  cargarHistorialRequisicion(rowSelectedRequisicion.id_requisicion);

  // Cargar evidencias de surtimiento si existe
  cargarEvidenciasSurtimiento(rowSelectedRequisicion.id_requisicion);
}

// Función para cargar artículos en el modal de detalles
function cargarArticulosDetalle(requisicionId) {
  console.log(
    "Cargando artículos para modal de detalles. ID requisición:",
    requisicionId
  );

  $.ajax({
    url: "../../../api/inventarios_api.php",
    type: "POST",
    dataType: "json",
    data: {
      api: 28, // Mismo endpoint que usa la edición
      requisicion_id: requisicionId,
    },
    success: function (response) {
      console.log("Respuesta de artículos para detalles:", response);

      let tbody = $("#tablaDetalleArticulos tbody");
      tbody.empty();

      if (
        response.response &&
        response.response.code == 1 &&
        response.response.data &&
        response.response.data.length > 0
      ) {
        response.response.data.forEach(function (detalle) {
          // Mapear campos como en la función de edición
          let articulo = {
            nombre:
              detalle.nombre_comercial ||
              detalle.NOMBRE_COMERCIAL ||
              detalle.nombre_articulo ||
              "N/A",
            clave:
              detalle.clave_art ||
              detalle.CLAVE_ART ||
              detalle.clave_articulo ||
              "N/A",
            cantidad_solicitada:
              detalle.cantidad_solicitada || detalle.CANTIDAD_SOLICITADA || 0,
            cantidad_aprobada:
              detalle.cantidad_aprobada || detalle.CANTIDAD_APROBADA || "-",
            cantidad_surtida:
              detalle.cantidad_surtida || detalle.CANTIDAD_SURTIDA || "-",
            observaciones:
              detalle.observaciones || detalle.OBSERVACIONES ||" Sin observaciones ",
          };

          let fila = `
            <tr>
              <td>
                <strong>${articulo.nombre}</strong><br>
                <small class="text-muted">${articulo.clave}</small>
              </td>
              <td class="text-center">${articulo.cantidad_solicitada}</td>
              <td class="text-center">${articulo.cantidad_aprobada}</td>
              <td class="text-center">${articulo.cantidad_surtida}</td>
              <td class="text-center">${articulo.observaciones}</td>
            </tr>
          `;

          tbody.append(fila);
        });
      } else {
        tbody.append(`
          <tr>
            <td colspan="4" class="text-center text-muted">
              <i class="bi bi-inbox"></i><br>
              No hay artículos en esta requisición
            </td>
          </tr>
        `);
      }
    },
    error: function (xhr, status, error) {
      console.error(
        "Error al cargar artículos para detalles:",
        xhr.responseText
      );
      $("#tablaDetalleArticulos tbody").html(`
        <tr>
          <td colspan="4" class="text-center text-danger">
            Error al cargar artículos
          </td>
        </tr>
      `);
    },
  });
}

// Función para cargar historial con seguimiento de surtimientos
function cargarHistorialRequisicion(requisicionId) {
  console.log("Cargando historial de requisición:", requisicionId);

  // Crear timeline básico primero
  let timeline = $("#timelineHistorial");
  timeline.empty();

  // Evento: Creación
  timeline.append(`
    <div class="timeline-item">
      <div class="d-flex align-items-start">
        <div class="me-3">
          <i class="bi bi-plus-circle text-primary" style="font-size: 1.2em;"></i>
        </div>
        <div class="flex-grow-1">
          <div class="timeline-date">${new Date(
            rowSelectedRequisicion.fecha_creacion
          ).toLocaleString("es-MX")}</div>
          <div><strong>Requisición creada</strong></div>
          <div class="text-muted small">La requisición fue creada y está en estado BORRADOR</div>
          <div class="text-muted small">Por: ${
            rowSelectedRequisicion.solicitante
          }</div>
        </div>
      </div>
    </div>
  `);

  // Evento: Enviada para aprobación (si no está en borrador)
  if (rowSelectedRequisicion.estatus !== "borrador") {
    timeline.append(`
      <div class="timeline-item">
        <div class="d-flex align-items-start">
          <div class="me-3">
            <i class="bi bi-send text-info" style="font-size: 1.2em;"></i>
          </div>
          <div class="flex-grow-1">
            <div class="timeline-date">${new Date(
              rowSelectedRequisicion.fecha_creacion
            ).toLocaleString("es-MX")}</div>
            <div><strong>Enviada para aprobación</strong></div>
            <div class="text-muted small">La requisición fue enviada para revisión</div>
            <div class="text-muted small">Por: ${
              rowSelectedRequisicion.solicitante
            }</div>
          </div>
        </div>
      </div>
    `);
  }

  // Evento: Aprobación/Rechazo
  if (rowSelectedRequisicion.fecha_aprobacion) {
    let esRechazada = rowSelectedRequisicion.estatus === "rechazada";
    let iconoAprobacion = esRechazada
      ? "bi-x-circle text-danger"
      : "bi-check-circle text-success";
    let eventoAprobacion = esRechazada
      ? "Requisición rechazada"
      : "Requisición aprobada";

    timeline.append(`
      <div class="timeline-item">
        <div class="d-flex align-items-start">
          <div class="me-3">
            <i class="${iconoAprobacion}" style="font-size: 1.2em;"></i>
          </div>
          <div class="flex-grow-1">
            <div class="timeline-date">${new Date(
              rowSelectedRequisicion.fecha_aprobacion
            ).toLocaleString("es-MX")}</div>
            <div><strong>${eventoAprobacion}</strong></div>
            <div class="text-muted small">${
              rowSelectedRequisicion.observaciones_aprobacion ||
              "Sin observaciones"
            }</div>
            <div class="text-muted small">Por: ${
              rowSelectedRequisicion.aprobador
            }</div>
          </div>
        </div>
      </div>
    `);
  }

  // Cargar eventos de surtimiento si la requisición está aprobada
  if (
    rowSelectedRequisicion.estatus === "aprobada" ||
    rowSelectedRequisicion.estatus === "parcialmente_surtida" ||
    rowSelectedRequisicion.estatus === "completada"
  ) {
    cargarEventosSurtimiento(requisicionId, timeline);
  }
}

// Función para cargar eventos de surtimiento
function cargarEventosSurtimiento(requisicionId, timeline) {
  // Siempre mostrar "pendiente de surtimiento" después de la aprobación
  timeline.append(`
    <div class="timeline-item">
      <div class="d-flex align-items-start">
        <div class="me-3">
          <i class="bi bi-clock text-warning" style="font-size: 1.2em;"></i>
        </div>
        <div class="flex-grow-1">
          <div class="timeline-date">Pendiente</div>
          <div><strong>Pendiente de surtimiento</strong></div>
          <div class="text-muted small">La requisición está aprobada y lista para surtir</div>
        </div>
      </div>
    </div>
  `);

  $.ajax({
    url: "../../../api/inventarios_api.php",
    type: "POST",
    dataType: "json",
    data: {
      api: 35, // Nuevo endpoint específico para surtimientos
      requisicion_id: requisicionId,
    },
    success: function (response) {
      console.log("Eventos de surtimiento:", response);

      if (
        response &&
        response.code == 1 &&
        response.data &&
        response.data.length > 0
      ) {
        response.data.forEach(function (surtimiento) {
          let fechaFormateada = new Date(
            surtimiento.fecha_surtimiento
          ).toLocaleString("es-MX");
          let iconoSurtimiento =
            surtimiento.estatus === "completo"
              ? "bi-box-seam text-success"
              : "bi-box text-warning";
          let eventoTitulo =
            surtimiento.estatus === "completo"
              ? "Surtimiento completo"
              : "Surtimiento parcial";

          let descripcion = `Se entregaron ${surtimiento.total_entregado} unidad(es)`;
          if (surtimiento.persona_recibe) {
            descripcion += ` a ${surtimiento.persona_recibe}`;
          }
          if (surtimiento.total_evidencias > 0) {
            descripcion += ` (${surtimiento.total_evidencias} evidencia${
              surtimiento.total_evidencias > 1 ? "s" : ""
            })`;
          }
          if (surtimiento.observaciones) {
            descripcion += `<br><small>Obs: ${surtimiento.observaciones}</small>`;
          }

          timeline.append(`
            <div class="timeline-item">
              <div class="d-flex align-items-start">
                <div class="me-3">
                  <i class="${iconoSurtimiento}" style="font-size: 1.2em;"></i>
                </div>
                <div class="flex-grow-1">
                  <div class="timeline-date">${fechaFormateada}</div>
                  <div><strong>${eventoTitulo}</strong></div>
                  <div class="text-muted small">${descripcion}</div>
                  <div class="text-muted small">Por: ${
                    surtimiento.usuario_surtidor || "Usuario no disponible"
                  }</div>
                </div>
              </div>
            </div>
          `);
        });
      }

      // Verificar si la requisición está completada (fuera del if de surtimientos)
      console.log(
        "Verificando estatus para finalización:",
        rowSelectedRequisicion.estatus
      );
      console.log("rowSelectedRequisicion completo:", rowSelectedRequisicion);

      if (
        rowSelectedRequisicion.estatus === "completada" ||
        rowSelectedRequisicion.estatus === "completado"
      ) {
        console.log(
          "Agregando eventos de surtimiento completado y finalización"
        );

        // Primero: Surtimiento completado
        timeline.append(`
          <div class="timeline-item">
            <div class="d-flex align-items-start">
              <div class="me-3">
                <i class="bi bi-box-seam-fill text-success" style="font-size: 1.2em;"></i>
              </div>
              <div class="flex-grow-1">
                <div class="timeline-date">Surtido</div>
                <div><strong>Surtimiento completado</strong></div>
                <div class="text-muted small">Todos los artículos han sido entregados</div>
              </div>
            </div>
          </div>
        `);

        // Después: Requisición finalizada
        timeline.append(`
          <div class="timeline-item">
            <div class="d-flex align-items-start">
              <div class="me-3">
                <i class="bi bi-check-circle-fill text-success" style="font-size: 1.2em;"></i>
              </div>
              <div class="flex-grow-1">
                <div class="timeline-date">Finalizada</div>
                <div><strong>Requisición finalizada</strong></div>
                <div class="text-muted small">El proceso de requisición ha sido completado exitosamente</div>
              </div>
            </div>
          </div>
        `);
      } else {
        console.log(
          "La requisición no está completada, estatus actual:",
          rowSelectedRequisicion.estatus
        );
      }
    },
    error: function (xhr, status, error) {
      console.error("Error al cargar eventos de surtimiento:", error);
    },
  });
}

// ==================== EVENTOS PARA APROBACIÓN/RECHAZO DE REQUISICIONES ====================

// Eventos para botones de acción en la tabla de requisiciones
$(document).on("click", ".btn-aprobar-requisicion", function (e) {
  e.preventDefault();
  e.stopImmediatePropagation();

  let idRequisicion = $(this).data("id");
  console.log("Aprobar requisición desde tabla:", idRequisicion);

  if (!idRequisicion) {
    alertToast("ID de requisición no válido", "warning", 3000);
    return;
  }

  // Buscar la requisición en los datos de la tabla
  let requisicionData = null;
  if (tableCatRequisiciones && tableCatRequisiciones.data()) {
    requisicionData = tableCatRequisiciones
      .data()
      .toArray()
      .find((req) => req.id_requisicion == idRequisicion);
  }

  if (!requisicionData) {
    alertToast("No se encontraron datos de la requisición", "warning", 3000);
    return;
  }

  if (requisicionData.estatus !== "pendiente") {
    alertToast(
      "Solo se pueden aprobar requisiciones en estado PENDIENTE",
      "warning",
      4000
    );
    return;
  }

  alertMensajeConfirm(
    {
      title: "Aprobar Requisición",
      text: `¿Está seguro de aprobar la requisición ${requisicionData.numero_requisicion}?`,
      icon: "question",
      showCancelButton: true,
      confirmButtonText: "Sí, aprobar",
      cancelButtonText: "Cancelar",
      confirmButtonColor: "#28a745",
    },
    function () {
      procesarAprobacionRechazoTabla("aprobar", idRequisicion, "");
    }
  );
});

$(document).on("click", ".btn-rechazar-requisicion", function (e) {
  e.preventDefault();
  e.stopImmediatePropagation();

  let idRequisicion = $(this).data("id");
  console.log("Rechazar requisición desde tabla:", idRequisicion);

  if (!idRequisicion) {
    alertToast("ID de requisición no válido", "warning", 3000);
    return;
  }

  // Buscar la requisición en los datos de la tabla
  let requisicionData = null;
  if (tableCatRequisiciones && tableCatRequisiciones.data()) {
    requisicionData = tableCatRequisiciones
      .data()
      .toArray()
      .find((req) => req.id_requisicion == idRequisicion);
  }

  if (!requisicionData) {
    alertToast("No se encontraron datos de la requisición", "warning", 3000);
    return;
  }

  if (requisicionData.estatus !== "pendiente") {
    alertToast(
      "Solo se pueden rechazar requisiciones en estado PENDIENTE",
      "warning",
      4000
    );
    return;
  }

  // Solicitar observaciones para el rechazo
  Swal.fire({
    title: "Rechazar Requisición",
    text: `Ingrese las observaciones para rechazar la requisición ${requisicionData.numero_requisicion}:`,
    input: "textarea",
    inputPlaceholder:
      "Las observaciones son obligatorias para rechazar una requisición...",
    inputAttributes: {
      "aria-label": "Observaciones de rechazo",
    },
    showCancelButton: true,
    confirmButtonText: "Rechazar",
    cancelButtonText: "Cancelar",
    confirmButtonColor: "#dc3545",
    cancelButtonColor: "#6c757d",
    inputValidator: (value) => {
      if (!value || value.trim() === "") {
        return "Las observaciones son obligatorias para rechazar una requisición";
      }
    },
  }).then((result) => {
    if (result.isConfirmed && result.value && result.value.trim()) {
      procesarAprobacionRechazoTabla(
        "rechazar",
        idRequisicion,
        result.value.trim()
      );
    }
  });
});

// Evento para ver detalles del surtimiento
$(document).on("click", ".btn-ver-surtimiento", function (e) {
  e.preventDefault();
  e.stopImmediatePropagation();

  let idRequisicion = $(this).data("id");
  let idSurtimiento = $(this).data("surtimiento-id");

  console.log(
    "Ver surtimiento - Requisición:",
    idRequisicion,
    "Surtimiento:",
    idSurtimiento
  );

  if (!idRequisicion || !idSurtimiento) {
    alertToast("ID de requisición o surtimiento no válido", "warning", 3000);
    return;
  }

  // Buscar la requisición en la tabla para establecer rowSelectedRequisicion
  let requisicionData = null;
  if (tableCatRequisiciones && tableCatRequisiciones.data()) {
    requisicionData = tableCatRequisiciones
      .data()
      .toArray()
      .find((req) => req.id_requisicion == idRequisicion);
  }

  if (requisicionData) {
    // Asegurarnos de que el id_surtimiento esté disponible
    requisicionData.id_surtimiento = idSurtimiento;
    // Establecer la fila seleccionada temporalmente
    rowSelectedRequisicion = requisicionData;

    // Llamar a la función existente
    mostrarDetalleSurtimiento();
  } else {
    alertToast("No se encontraron datos de la requisición", "warning", 3000);
  }
});

// Función para procesar aprobación/rechazo desde la tabla
function procesarAprobacionRechazoTabla(accion, idRequisicion, observaciones) {
  console.log(
    `Procesando ${accion} de requisición desde tabla:`,
    idRequisicion
  );

  // Buscar y deshabilitar los botones de la fila específica
  let btnAprobar = $(`.btn-aprobar-requisicion[data-id="${idRequisicion}"]`);
  let btnRechazar = $(`.btn-rechazar-requisicion[data-id="${idRequisicion}"]`);

  btnAprobar.prop("disabled", true);
  btnRechazar.prop("disabled", true);

  $.ajax({
    url: "../../../api/inventarios_api.php",
    type: "POST",
    dataType: "json",
    data: {
      api: 31,
      id_requisicion: idRequisicion,
      accion: accion,
      observaciones_aprobacion: observaciones,
    },
    success: function (response) {
      console.log(`Respuesta de ${accion} desde tabla:`, response);

      // Verificar múltiples condiciones de éxito
      let esExitoso = false;

      if (
        response.response &&
        (response.response.code == 1 || response.response.code == 2)
      ) {
        esExitoso = true;
      } else if (
        response.response &&
        response.response.data &&
        response.response.data.length > 0
      ) {
        let primeraFila = response.response.data[0];
        if (primeraFila.RESULT === "SUCCESS" || primeraFila.MESSAGE) {
          esExitoso = true;
        }
      } else if (response.code == 1 || response.code == 2) {
        esExitoso = true;
      }

      if (esExitoso) {
        // Éxito
        let mensaje = accion === "aprobar" ? "aprobada" : "rechazada";
        alertToast(`Requisición ${mensaje} exitosamente`, "success", 3000);

        // Recargar la tabla principal
        setTimeout(function () {
          try {
            if (
              typeof tableCatRequisiciones !== "undefined" &&
              tableCatRequisiciones
            ) {
              tableCatRequisiciones.ajax.reload(function (json) {
                console.log(
                  "Tabla de requisiciones recargada después de aprobación/rechazo desde tabla"
                );
              }, false);
            }
          } catch (error) {
            console.error("Error al recargar tabla principal:", error);
          }
        }, 500);
      } else {
        // Error
        console.error(`Error al ${accion} requisición desde tabla:`, response);
        let mensajeError =
          response.response && response.response.message
            ? response.response.message
            : `Error al ${accion} la requisición`;
        alertToast(mensajeError, "error", 4000);
      }
    },
    error: function (xhr, status, error) {
      console.error(
        `Error AJAX al ${accion} requisición desde tabla:`,
        xhr.responseText
      );
      alertToast(
        `Error de conexión al ${accion} la requisición`,
        "error",
        4000
      );
    },
    complete: function () {
      // Rehabilitar botones
      btnAprobar.prop("disabled", false);
      btnRechazar.prop("disabled", false);
    },
  });
}

// Evento para aprobar requisición (desde modal de detalles)
$(document).on("click", "#btnAprobarRequisicion", function () {
  if (!rowSelectedRequisicion) {
    alertToast("No hay requisición seleccionada", "warning", 3000);
    return;
  }

  if (rowSelectedRequisicion.estatus !== "pendiente") {
    alertToast(
      "Solo se pueden aprobar requisiciones en estado PENDIENTE",
      "warning",
      4000
    );
    return;
  }

  let observaciones = $("#observacionesAprobacion").val().trim();

  alertMensajeConfirm(
    {
      title: "Aprobar Requisición",
      text: `¿Está seguro de aprobar la requisición ${rowSelectedRequisicion.numero_requisicion}?`,
      icon: "question",
      showCancelButton: true,
      confirmButtonText: "Sí, aprobar",
      cancelButtonText: "Cancelar",
      confirmButtonColor: "#28a745",
    },
    function () {
      procesarAprobacionRechazo("aprobar", observaciones);
    }
  );
});

// Evento para rechazar requisición
$(document).on("click", "#btnRechazarRequisicion", function () {
  if (!rowSelectedRequisicion) {
    alertToast("No hay requisición seleccionada", "warning", 3000);
    return;
  }

  if (rowSelectedRequisicion.estatus !== "pendiente") {
    alertToast(
      "Solo se pueden rechazar requisiciones en estado PENDIENTE",
      "warning",
      4000
    );
    return;
  }

  let observaciones = $("#observacionesAprobacion").val().trim();

  if (!observaciones) {
    alertToast(
      "Las observaciones son obligatorias para rechazar una requisición",
      "warning",
      4000
    );
    $("#observacionesAprobacion").focus();
    return;
  }

  alertMensajeConfirm(
    {
      title: "Rechazar Requisición",
      text: `¿Está seguro de rechazar la requisición ${rowSelectedRequisicion.numero_requisicion}?`,
      icon: "warning",
      showCancelButton: true,
      confirmButtonText: "Sí, rechazar",
      cancelButtonText: "Cancelar",
      confirmButtonColor: "#dc3545",
    },
    function () {
      procesarAprobacionRechazo("rechazar", observaciones);
    }
  );
});

// Función para procesar aprobación o rechazo
function procesarAprobacionRechazo(accion, observaciones) {
  console.log(
    `Procesando ${accion} de requisición:`,
    rowSelectedRequisicion.id_requisicion
  );

  // Deshabilitar botones para evitar doble clic
  $("#btnAprobarRequisicion, #btnRechazarRequisicion").prop("disabled", true);

  $.ajax({
    url: "../../../api/inventarios_api.php",
    type: "POST",
    dataType: "json",
    data: {
      api: 31,
      id_requisicion: rowSelectedRequisicion.id_requisicion,
      accion: accion,
      observaciones_aprobacion: observaciones,
    },
    success: function (response) {
      console.log(`Respuesta de ${accion}:`, response);

      // Verificar múltiples condiciones de éxito
      let esExitoso = false;

      if (
        response.response &&
        (response.response.code == 1 || response.response.code == 2)
      ) {
        esExitoso = true;
      } else if (
        response.response &&
        response.response.data &&
        response.response.data.length > 0
      ) {
        let primeraFila = response.response.data[0];
        if (primeraFila.RESULT === "SUCCESS" || primeraFila.MESSAGE) {
          esExitoso = true;
        }
      } else if (response.code == 1 || response.code == 2) {
        esExitoso = true;
      }

      if (esExitoso) {
        // Éxito
        let mensaje = accion === "aprobar" ? "aprobada" : "rechazada";
        alertToast(`Requisición ${mensaje} exitosamente`, "success", 3000);

        // Actualizar el estado local de la requisición
        rowSelectedRequisicion.estatus =
          accion === "aprobar" ? "aprobada" : "rechazada";
        rowSelectedRequisicion.fecha_aprobacion = new Date().toLocaleString();
        rowSelectedRequisicion.observaciones_aprobacion = observaciones;

        // Recargar la tabla principal
        setTimeout(function () {
          try {
            if (
              typeof tableCatRequisiciones !== "undefined" &&
              tableCatRequisiciones
            ) {
              tableCatRequisiciones.ajax.reload(function (json) {
                console.log(
                  "Tabla de requisiciones recargada después de aprobación/rechazo"
                );
              }, false);
            }
          } catch (error) {
            console.error("Error al recargar tabla principal:", error);
          }
        }, 500);

        // Cerrar el modal de detalles
        $("#detalleRequisicionModal").modal("hide");

        // Limpiar observaciones
        $("#observacionesAprobacion").val("");
      } else {
        // Error
        console.error(`Error al ${accion} requisición:`, response);
        let mensajeError =
          response.response && response.response.message
            ? response.response.message
            : `Error al ${accion} la requisición`;
        alertToast(mensajeError, "error", 4000);
      }
    },
    error: function (xhr, status, error) {
      console.error(`Error AJAX al ${accion} requisición:`, xhr.responseText);
      alertToast(
        `Error de conexión al ${accion} la requisición`,
        "error",
        4000
      );
    },
    complete: function () {
      // Rehabilitar botones
      $("#btnAprobarRequisicion, #btnRechazarRequisicion").prop(
        "disabled",
        false
      );
    },
  });
}

console.log(
  "Eventos globales de edición de requisiciones cargados correctamente"
);

// ==================== FUNCIONALIDAD DE SURTIMIENTO ====================
console.log("🚀 Módulo de surtimiento cargado correctamente");

// ==================== FUNCIONALIDAD DE IMPRESIÓN ====================

// Evento para imprimir requisición
$(document).on("click", "#btnImprimirRequisicion", function () {
  if (!rowSelectedRequisicion) {
    alertToast(
      "No hay requisición seleccionada para imprimir",
      "warning",
      3000
    );
    return;
  }

  imprimirDetalleRequisicion();
});

// Función para generar e imprimir el detalle de la requisición
function imprimirDetalleRequisicion() {
  console.log(
    "Generando vista de impresión para requisición:",
    rowSelectedRequisicion
  );

  // Obtener los artículos actuales de la tabla
  let articulosImprimir = [];
  $("#tablaDetalleArticulos tbody tr").each(function () {
    if ($(this).find("td").length > 1) {
      // Evitar filas vacías
      let articulo = {
        nombre: $(this).find("td:eq(0) strong").text(),
        clave: $(this).find("td:eq(0) small").text(),
        solicitado: $(this).find("td:eq(1)").text(),
        aprobado: $(this).find("td:eq(2)").text(),
        surtido: $(this).find("td:eq(3)").text(),
        // precio: $(this).find('td:eq(4)').text()
      };
      articulosImprimir.push(articulo);
    }
  });

  // Obtener información de aprobación si existe
  let infoAprobacion = "";
  if ($("#cardObservacionesAprobacion").is(":visible")) {
    infoAprobacion = `
      <div class="mt-4">
        <h6><strong>Información de Aprobación</strong></h6>
        <p><strong>Aprobado por:</strong> ${$("#detalleAprobadoPor").text()}</p>
        <p><strong>Fecha de aprobación:</strong> ${$(
          "#detalleFechaAprobacion"
        ).text()}</p>
        <p><strong>Observaciones:</strong> ${$(
          "#detalleObservacionesAprobacion"
        ).text()}</p>
      </div>
    `;
  }

  // Crear contenido HTML para impresión
  let contenidoImpresion = `
    <!DOCTYPE html>
    <html>
    <head>
      <meta charset="UTF-8">
      <title>Requisición ${rowSelectedRequisicion.numero_requisicion}</title>
      <style>
        body {
          font-family: Arial, sans-serif;
          font-size: 12px;
          line-height: 1.4;
          margin: 20px;
          color: #333;
        }
        .header {
          text-align: center;
          border-bottom: 2px solid #333;
          padding-bottom: 15px;
          margin-bottom: 20px;
        }
        .header h1 {
          margin: 0;
          font-size: 20px;
          color: #2c3e50;
        }
        .header h2 {
          margin: 5px 0 0 0;
          font-size: 16px;
          color: #666;
        }
        .info-section {
          margin-bottom: 20px;
        }
        .info-section h3 {
          background-color: #f8f9fa;
          padding: 8px;
          margin: 0 0 10px 0;
          border-left: 4px solid #007bff;
          font-size: 14px;
        }
        .info-grid {
          display: grid;
          grid-template-columns: 1fr 1fr;
          gap: 15px;
          margin-bottom: 15px;
        }
        .info-item {
          margin-bottom: 8px;
        }
        .info-item strong {
          display: inline-block;
          width: 120px;
          color: #495057;
        }
        .table {
          width: 100%;
          border-collapse: collapse;
          margin-top: 10px;
        }
        .table th,
        .table td {
          border: 1px solid #dee2e6;
          padding: 8px;
          text-align: left;
        }
        .table th {
          background-color: #f8f9fa;
          font-weight: bold;
          font-size: 11px;
        }
        .table td {
          font-size: 10px;
        }
        .table .text-center {
          text-align: center;
        }
        .table .text-end {
          text-align: right;
        }
        .justificacion {
          background-color: #f8f9fa;
          padding: 12px;
          border-radius: 4px;
          border-left: 4px solid #007bff;
          margin-top: 10px;
        }
        .footer {
          margin-top: 30px;
          padding-top: 15px;
          border-top: 1px solid #ddd;
          text-align: center;
          font-size: 10px;
          color: #666;
        }
        @media print {
          body { margin: 10px; }
          .no-print { display: none; }
        }
      </style>
    </head>
    <body>
      <div class="header">
        <h1>DETALLE DE REQUISICIÓN</h1>
        <h2>${rowSelectedRequisicion.numero_requisicion}</h2>
      </div>
      
      <div class="info-section">
        <h3>Información General</h3>
        <div class="info-grid">
          <div>
            <div class="info-item"><strong>Número:</strong> ${
              rowSelectedRequisicion.numero_requisicion
            }</div>
            <div class="info-item"><strong>Área Solicitante:</strong> ${
              rowSelectedRequisicion.area_solicitante
            }</div>
            <div class="info-item"><strong>Solicitante:</strong> ${
              rowSelectedRequisicion.solicitante
            }</div>
            <div class="info-item"><strong>Fecha Creación:</strong> ${
              rowSelectedRequisicion.fecha_creacion
            }</div>
          </div>
          <div>
            <div class="info-item"><strong>Fecha Límite:</strong> ${
              rowSelectedRequisicion.fecha_limite || "No especificada"
            }</div>
            <div class="info-item"><strong>Prioridad:</strong> ${
              rowSelectedRequisicion.prioridad
                ? rowSelectedRequisicion.prioridad.charAt(0).toUpperCase() +
                  rowSelectedRequisicion.prioridad.slice(1)
                : "No especificada"
            }</div>
            <div class="info-item"><strong>Estado:</strong> ${
              rowSelectedRequisicion.estatus
                ? rowSelectedRequisicion.estatus.charAt(0).toUpperCase() +
                  rowSelectedRequisicion.estatus.slice(1).replace("_", " ")
                : "No especificado"
            }</div>

          </div>
        </div>
        
        <div class="justificacion">
          <strong>Justificación:</strong><br>
          ${
            rowSelectedRequisicion.justificacion ||
            "Sin justificación especificada"
          }
        </div>
        
        ${infoAprobacion}
      </div>
      
      <div class="info-section">
        <h3>Artículos Solicitados</h3>
        <table class="table">
          <thead>
            <tr>
              <th style="width: 40%;">Artículo</th>
              <th class="text-center" style="width: 12%;">Solicitado</th>
              <th class="text-center" style="width: 12%;">Aprobado</th>
              <th class="text-center" style="width: 12%;">Surtido</th>
              <!-- <th class="text-end" style="width: 24%;">Precio Estimado</th> -->
            </tr>
          </thead>
          <tbody>
            ${articulosImprimir
              .map(
                (articulo) => `
              <tr>
                <td>
                  <strong>${articulo.nombre}</strong><br>
                  <small style="color: #666;">${articulo.clave}</small>
                </td>
                <td class="text-center">${articulo.solicitado}</td>
                <td class="text-center">${articulo.aprobado}</td>
                <td class="text-center">${articulo.surtido}</td>
              </tr>
            `
              )
              .join("")}
          </tbody>
        </table>
      </div>
      
      <div class="footer">
        <p>Documento generado el ${new Date().toLocaleString(
          "es-MX"
        )} | BimOS Almacén</p>
      </div>
    </body>
    </html>
  `;

  // Abrir ventana de impresión
  let ventanaImpresion = window.open("", "_blank", "width=800,height=600");
  ventanaImpresion.document.write(contenidoImpresion);
  ventanaImpresion.document.close();

  // Esperar a que cargue e imprimir
  ventanaImpresion.onload = function () {
    setTimeout(function () {
      ventanaImpresion.focus();
      ventanaImpresion.print();
    }, 500);
  };

  console.log("Vista de impresión generada exitosamente");
}

// Variables globales para surtimiento
var articulosSurtimiento = [];
var imagenesEvidencia = [];

// Evento para abrir modal de surtimiento
$(document).on("click", "#btnSurtirRequisicion", function () {
  console.log(
    "🔘 Clic en botón surtir. rowSelectedRequisicion:",
    rowSelectedRequisicion
  );

  // Si no hay rowSelectedRequisicion, intentar obtener datos del modal de detalles
  if (!rowSelectedRequisicion) {
    console.log(
      "⚠️ No hay rowSelectedRequisicion, intentando obtener del modal"
    );

    // Intentar construir el objeto desde los datos visibles en el modal
    let idRequisicion = $("#detalleNumero").text();
    let numeroRequisicion = $("#numeroRequisicionDetalle").text();

    if (idRequisicion) {
      // Buscar en la tabla de requisiciones el registro completo
      let filaEncontrada = null;
      if (tableCatRequisiciones && tableCatRequisiciones.data()) {
        tableCatRequisiciones
          .data()
          .toArray()
          .forEach(function (fila) {
            if (fila.numero_requisicion === numeroRequisicion) {
              filaEncontrada = fila;
            }
          });
      }

      if (filaEncontrada) {
        console.log("✅ Requisición encontrada en tabla:", filaEncontrada);
        rowSelectedRequisicion = filaEncontrada;
      } else {
        alertToast(
          "No se pudo identificar la requisición. Cierre el modal y seleccione una fila de la tabla.",
          "error",
          4000
        );
        return;
      }
    } else {
      alertToast("No hay una requisición seleccionada", "error", 3000);
      return;
    }
  }

  console.log("✅ Cargando datos de surtimiento para:", rowSelectedRequisicion);
  cargarDatosSurtimiento();
  $("#surtirRequisicionModal").modal("show");
});

function cargarDatosSurtimiento() {
  console.log("📦 Cargando datos para surtimiento:", rowSelectedRequisicion);

  if (!rowSelectedRequisicion || !rowSelectedRequisicion.id_requisicion) {
    console.error("❌ Error: rowSelectedRequisicion no válida");
    alertToast("Error: Datos de requisición no válidos", "error", 3000);
    return;
  }

  // Limpiar datos previos
  articulosSurtimiento = [];

  console.log("📝 Llenando campos básicos del modal");

  // Llenar campos básicos
  $("#surtirIdRequisicion").val(rowSelectedRequisicion.id_requisicion);
  $("#numeroRequisicionSurtir").text(rowSelectedRequisicion.numero_requisicion);

  // Establecer fecha actual
  const ahora = new Date();
  const fechaActual = ahora.toISOString().slice(0, 16);
  $("#fechaEntrega").val(fechaActual);

  // Limpiar formulario
  $("#personaRecibe").val("");
  $("#observacionesSurtimiento").val("");
  $("#evidenciaFotografica").val("");
  $("#previewImagenes").hide();
  $("#contenedorImagenes").empty();

  console.log(
    "📊 Cargando artículos para ID requisición:",
    rowSelectedRequisicion.id_requisicion
  );

  // Cargar artículos de la requisición para surtir
  cargarArticulosParaSurtir(rowSelectedRequisicion.id_requisicion);
}

function cargarArticulosParaSurtir(requisicionId) {
  console.log(
    "🔄 Iniciando carga de artículos para requisición ID:",
    requisicionId
  );

  // Primero cargar los detalles de la requisición
  $.ajax({
    url: "../../../api/inventarios_api.php",
    type: "POST",
    dataType: "json",
    data: { api: 28, requisicion_id: requisicionId },
    success: function (response) {
      console.log("📋 Respuesta detalles de requisición (API 28):", response);

      if (
        response.response &&
        response.response.code == 1 &&
        response.response.data
      ) {
        articulosSurtimiento = [];
        let articulosTemp = [];

        // Mapear datos de la requisición
        response.response.data.forEach(function (detalle) {
          let articulo = {
            id: detalle.articulo_id || detalle.ID_ARTICULO,
            nombre: detalle.nombre_comercial || detalle.NOMBRE_COMERCIAL,
            clave: detalle.clave_art || detalle.CLAVE_ART,
            cantidad_aprobada:
              parseFloat(
                detalle.cantidad_aprobada || detalle.CANTIDAD_APROBADA
              ) || 0,
            cantidad_surtida:
              parseFloat(
                detalle.cantidad_surtida || detalle.CANTIDAD_SURTIDA
              ) || 0,
            cantidad_a_entregar: 0, // Se calculará
            stock_actual: 0, // Se obtendrá del inventario
            detalle_id: detalle.id_detalle || detalle.ID_DETALLE,
          };

          // Calcular cantidad pendiente de entregar
          articulo.cantidad_a_entregar = Math.max(
            0,
            articulo.cantidad_aprobada - articulo.cantidad_surtida
          );

          articulosTemp.push(articulo);
        });

        // Ahora cargar el stock actual de los artículos desde el inventario
        cargarStockArticulosSurtimiento(articulosTemp);
      }
    },
    error: function (xhr, status, error) {
      console.error("❌ Error al cargar artículos para surtir (API 28):", {
        status: status,
        error: error,
        responseText: xhr.responseText,
        requisicionId: requisicionId,
      });
      alertToast(
        "Error al cargar artículos para surtir: " + error,
        "error",
        4000
      );
    },
  });
}

function cargarStockArticulosSurtimiento(articulosTemp) {
  // Cargar todos los artículos del inventario para obtener el stock
  $.ajax({
    url: "../../../api/inventarios_api.php",
    type: "POST",
    dataType: "json",
    data: { api: 4, id_movimiento: 1 }, // API que trae los artículos con stock
    success: function (response) {
      console.log("Stock de artículos:", response);

      if (
        response.response &&
        response.response.code == 1 &&
        response.response.data
      ) {
        // Crear un mapa de stock por ID de artículo
        let stockMap = {};
        response.response.data.forEach(function (item) {
          let articuloId = item.ID_ARTICULO || item.articulo_id;
          let cantidad = parseFloat(item.CANTIDAD || item.cantidad) || 0;
          stockMap[articuloId] = cantidad;
        });

        // Combinar los datos de requisición con el stock
        articulosSurtimiento = articulosTemp.map(function (articulo) {
          articulo.stock_actual = stockMap[articulo.id] || 0;
          return articulo;
        });

        console.log("Artículos con stock combinado:", articulosSurtimiento);

        actualizarTablaSurtimiento();
        actualizarResumenSurtimiento();
      } else {
        // Si no se puede obtener el stock, usar los artículos sin stock
        articulosSurtimiento = articulosTemp;
        alertToast(
          "No se pudo cargar el stock actual. Los valores pueden no ser exactos.",
          "warning",
          4000
        );

        actualizarTablaSurtimiento();
        actualizarResumenSurtimiento();
      }
    },
    error: function (xhr, status, error) {
      console.error("Error al cargar stock de artículos:", error);
      // Usar los artículos sin stock si hay error
      articulosSurtimiento = articulosTemp;
      alertToast(
        "Error al cargar stock. Los valores pueden no ser exactos.",
        "warning",
        4000
      );

      actualizarTablaSurtimiento();
      actualizarResumenSurtimiento();
    },
  });
}

function actualizarTablaSurtimiento() {
  let tbody = $("#tablaSurtirArticulos tbody");
  tbody.empty();

  if (articulosSurtimiento.length === 0) {
    tbody.append(`
      <tr>
        <td colspan="6" class="text-center text-muted">
          <i class="bi bi-inbox"></i><br>
          No hay artículos para surtir
        </td>
      </tr>
    `);
    return;
  }

  articulosSurtimiento.forEach(function (articulo, index) {
    let estadoBadge = "";
    let claseStock = "";

    // Determinar estado del artículo
    if (articulo.cantidad_a_entregar === 0) {
      estadoBadge = '<span class="badge badge-completo">Completo</span>';
    } else if (articulo.stock_actual < articulo.cantidad_a_entregar) {
      estadoBadge = '<span class="badge badge-sin-stock">Sin Stock</span>';
      claseStock = "stock-bajo";
    } else {
      estadoBadge = '<span class="badge badge-pendiente">Pendiente</span>';
      claseStock = "stock-suficiente";
    }

    // Calcular máximo a entregar (no puede ser más que el stock o la cantidad pendiente)
    let maxEntregar = Math.min(
      articulo.cantidad_a_entregar,
      articulo.stock_actual
    );

    let fila = `
      <tr class="${claseStock}">
        <td>
          <strong>${articulo.nombre}</strong><br>
          <small class="text-muted">${articulo.clave}</small>
        </td>
        <td class="text-center">
          <span class="badge bg-primary">${articulo.cantidad_aprobada}</span>
        </td>
        <td class="text-center">
          <span class="badge bg-success">${articulo.cantidad_surtida}</span>
        </td>
        <td class="text-center">
          <input type="number" 
                 class="form-control input-cantidad-surtir" 
                 data-index="${index}"
                 min="0" 
                 max="${maxEntregar}"
                 value="${maxEntregar}"
                 ${articulo.cantidad_a_entregar === 0 ? "disabled" : ""}>
        </td>
        <td class="text-center">
          <span class="badge ${
            articulo.stock_actual < articulo.cantidad_a_entregar
              ? "bg-danger"
              : "bg-success"
          }">
            ${articulo.stock_actual}
          </span>
        </td>
        <td class="text-center">
          ${estadoBadge}
        </td>
      </tr>
    `;

    tbody.append(fila);
  });
}

// Evento para cambio en cantidades a entregar
$(document).on("input", ".input-cantidad-surtir", function () {
  let index = $(this).data("index");
  let cantidadAEntregar = parseFloat($(this).val()) || 0;

  // Actualizar el array
  articulosSurtimiento[index].cantidad_a_entregar_actual = cantidadAEntregar;

  actualizarResumenSurtimiento();
});

function actualizarResumenSurtimiento() {
  let totalArticulos = articulosSurtimiento.length;
  let articulosCompletos = 0;
  let articulosParciales = 0;
  let articulosPendientes = 0;

  articulosSurtimiento.forEach(function (articulo, index) {
    let cantidadAEntregar =
      parseFloat($(`input[data-index="${index}"]`).val()) || 0;
    let cantidadPendiente =
      articulo.cantidad_aprobada - articulo.cantidad_surtida;

    if (cantidadPendiente === 0 || cantidadAEntregar === cantidadPendiente) {
      articulosCompletos++;
    } else if (cantidadAEntregar > 0 && cantidadAEntregar < cantidadPendiente) {
      articulosParciales++;
    } else {
      articulosPendientes++;
    }
  });

  $("#contadorArticulosSurtir").text(
    `${totalArticulos} artículo${totalArticulos !== 1 ? "s" : ""}`
  );
  $("#totalArticulos").text(totalArticulos);
  $("#articulosCompletos").text(articulosCompletos);
  $("#articulosParciales").text(articulosParciales);
  $("#articulosPendientes").text(articulosPendientes);
}

// Manejo de evidencia fotográfica
$("#evidenciaFotografica").on("change", function () {
  let archivos = this.files;

  if (archivos.length > 0) {
    $("#previewImagenes").show();
    $("#contenedorImagenes").empty();

    Array.from(archivos).forEach(function (archivo, index) {
      if (archivo.type.startsWith("image/")) {
        let reader = new FileReader();
        reader.onload = function (e) {
          let imagenContainer = $(`
            <div class="imagen-container" data-file-index="${index}">
              <img src="${
                e.target.result
              }" class="preview-imagen" alt="Evidencia ${index + 1}">
              <button type="button" class="btn-eliminar-imagen" data-index="${index}">×</button>
            </div>
          `);
          $("#contenedorImagenes").append(imagenContainer);
        };
        reader.readAsDataURL(archivo);
      }
    });
  } else {
    $("#previewImagenes").hide();
  }
});

// Eliminar imagen de evidencia
$(document).on("click", ".btn-eliminar-imagen", function () {
  let index = $(this).data("index");
  $(this).parent().remove();

  // Para eliminar archivos del input, necesitamos recrear el FileList
  // Por simplicidad, mostramos warning para el usuario
  let totalImagenes = $("#contenedorImagenes .imagen-container").length;
  if (totalImagenes === 0) {
    $("#previewImagenes").hide();
    $("#evidenciaFotografica").val(""); // Limpiar input
  } else {
    alertToast(
      "Imagen eliminada de la vista. Para eliminar del envío, vuelve a seleccionar los archivos.",
      "info",
      3000
    );
  }
});

// Guardar surtimiento
$("#btnGuardarSurtimiento").on("click", function () {
  if (!validarFormularioSurtimiento()) {
    return;
  }

  guardarSurtimiento();
});

function validarFormularioSurtimiento() {
  let fechaEntrega = $("#fechaEntrega").val();

  if (!fechaEntrega) {
    alertToast("La fecha de entrega es obligatoria", "warning", 3000);
    return false;
  }

  // Verificar que al menos un artículo tenga cantidad mayor a 0
  let hayEntregas = false;
  $(".input-cantidad-surtir").each(function () {
    if (parseFloat($(this).val()) > 0) {
      hayEntregas = true;
      return false; // break
    }
  });

  if (!hayEntregas) {
    alertToast(
      "Debe entregar al menos una cantidad de algún artículo",
      "warning",
      3000
    );
    return false;
  }

  return true;
}

function guardarSurtimiento() {
  let requisicionId = $("#surtirIdRequisicion").val();
  let fechaEntrega = $("#fechaEntrega").val();
  let personaRecibe = $("#personaRecibe").val();
  let observaciones = $("#observacionesSurtimiento").val();

  // Recopilar artículos con cantidades a entregar
  let articulosAEntregar = [];
  $(".input-cantidad-surtir").each(function (index) {
    let cantidadAEntregar = parseFloat($(this).val()) || 0;
    if (cantidadAEntregar > 0) {
      articulosAEntregar.push({
        detalle_requisicion_id: articulosSurtimiento[index].detalle_id,
        articulo_id: articulosSurtimiento[index].id,
        cantidad_entregada: cantidadAEntregar,
      });
    }
  });

  console.log(
    "Procesando surtimiento para requisición:",
    requisicionId,
    "- Artículos a entregar:",
    articulosAEntregar.length
  );

  // Mostrar indicador de carga
  alertToast("Procesando surtimiento...", "info", 1000);

  // Preparar FormData para incluir archivos
  let formData = new FormData();
  formData.append("api", 32);
  formData.append("requisicion_id", requisicionId);
  formData.append("fecha_surtimiento", fechaEntrega);
  formData.append("persona_recibe", personaRecibe);
  formData.append("observaciones", observaciones);
  formData.append("articulos", JSON.stringify(articulosAEntregar));

  // Agregar imágenes de evidencia si existen
  let archivosEvidencia = $("#evidenciaFotografica")[0].files;
  if (archivosEvidencia && archivosEvidencia.length > 0) {
    console.log(
      "Agregando evidencias al FormData:",
      archivosEvidencia.length,
      "archivos"
    );

    // Crear un objeto Files compatible con guardarFiles()
    let filesArray = [];
    for (let i = 0; i < archivosEvidencia.length; i++) {
      console.log(
        "Archivo",
        i,
        ":",
        archivosEvidencia[i].name,
        "- Tamaño:",
        archivosEvidencia[i].size
      );
      filesArray.push(archivosEvidencia[i]);
      formData.append("evidencia_fotografica[]", archivosEvidencia[i]);
    }
    formData.append("total_evidencias", archivosEvidencia.length);
  } else {
    console.log("No hay archivos de evidencia seleccionados");
    formData.append("total_evidencias", 0);
  }

  // Llamada AJAX real al API
  $.ajax({
    url: "../../../api/inventarios_api.php",
    type: "POST",
    dataType: "json",
    data: formData,
    processData: false,
    contentType: false,
    success: function (response) {
      console.log("Respuesta del servidor:", response);

      // Manejar la estructura anidada de respuesta del API
      let apiResponse =
        response.response && response.response.data
          ? response.response.data
          : response;

      if (apiResponse && apiResponse.code == 1) {
        alertToast("Surtimiento guardado exitosamente", "success", 3000);

        // Cerrar modal de surtimiento
        $("#surtirRequisicionModal").modal("hide");

        // Cerrar modal de detalles también
        $("#detalleRequisicionModal").modal("hide");

        // Recargar tabla de requisiciones con un pequeño delay
        setTimeout(function () {
          tableCatRequisiciones.ajax.reload(null, false); // false = mantener paginación
        }, 500);
      } else {
        let mensaje =
          apiResponse && apiResponse.message
            ? apiResponse.message
            : "Error desconocido";
        alertToast(
          "Error al guardar el surtimiento: " + mensaje,
          "error",
          4000
        );
        console.error("Error del servidor:", response);
      }
    },
    error: function (xhr, status, error) {
      console.error("Error al guardar surtimiento:", {
        status: status,
        error: error,
        responseText: xhr.responseText,
      });
      alertToast("Error de conexión al guardar el surtimiento", "error", 4000);
    },
  });
}

// ==================== FUNCIONALIDAD DE EVIDENCIAS DE SURTIMIENTO ====================

function cargarEvidenciasSurtimiento(requisicionId) {
  console.log("🔍 Cargando evidencias para requisición ID:", requisicionId);
  console.log("🔍 Tipo de requisicionId:", typeof requisicionId);

  $.ajax({
    url: "../../../api/inventarios_api.php",
    type: "POST",
    dataType: "json",
    data: {
      api: 33, // Nuevo endpoint para evidencias
      requisicion_id: requisicionId,
    },
    success: function (response) {
      console.log("Evidencias de surtimiento:", response);

      // Verificar diferentes estructuras de respuesta
      let evidencias = [];
      if (
        response &&
        response.response &&
        response.response.data &&
        response.response.data.data
      ) {
        evidencias = response.response.data.data;
        console.log(
          "📷 Usando estructura anidada response.response.data.data:",
          evidencias
        );
      } else if (response && response.response && response.response.data) {
        evidencias = response.response.data;
        console.log("📷 Usando estructura response.response.data:", evidencias);
      } else if (response && response.data) {
        evidencias = response.data;
        console.log("📷 Usando estructura response.data:", evidencias);
      }

      console.log("📷 Evidencias procesadas:", evidencias);
      console.log("📷 Total evidencias:", evidencias.length);

      if (evidencias && evidencias.length > 0) {
        mostrarEvidencias(evidencias);
      } else {
        console.warn(
          "⚠️ No se encontraron evidencias para requisición ID:",
          requisicionId
        );
        ocultarEvidencias();
      }
    },
    error: function (xhr, status, error) {
      console.error("Error al cargar evidencias:", error);
      console.error("Respuesta completa:", xhr.responseText);
      ocultarEvidencias();
    },
  });
}

function mostrarEvidencias(evidencias) {
  let galeria = $("#galeriaEvidenciasSurtimiento");
  galeria.empty();

  evidencias.forEach(function (evidencia, index) {
    let fechaFormateada = new Date(evidencia.fecha_surtimiento).toLocaleString(
      "es-MX"
    );

    // Obtener la extensión del archivo (como en el patrón del DataTable)
    let extension = evidencia.ruta_archivo.split(".").pop().toLowerCase();
    let contenidoImagen = "";

    if (extension === "pdf") {
      // Si es PDF, mostrar icono de PDF (siguiendo el patrón del DataTable)
      contenidoImagen = `
        <a href="${evidencia.ruta_archivo}" target="_blank" class="text-decoration-none">
          <i class="bi bi-file-earmark-pdf-fill text-danger" style="font-size: 3rem;" title="Ver PDF"></i>
        </a>
      `;
    } else {
      // Si es imagen, mostrar como antes (siguiendo el patrón del DataTable)
      contenidoImagen = `
        <a href="${evidencia.ruta_archivo}" target="_blank">
          <img src="${evidencia.ruta_archivo}" 
               alt="${evidencia.descripcion}" 
               class="evidencia-thumbnail">
        </a>
      `;
    }

    let card = `
      <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-3">
        <div class="evidencia-container text-center">
          ${contenidoImagen}
          <div class="evidencia-info mt-2">
            <small class="fw-bold d-block">${
              evidencia.descripcion || "Evidencia"
            }</small>
            <small class="text-muted d-block">${fechaFormateada}</small>
            <small class="text-muted d-block">Por: ${
              evidencia.persona_recibe || "N/A"
            }</small>
          </div>
        </div>
      </div>
    `;

    galeria.append(card);
  });

  $("#contadorEvidencias").text(
    `${evidencias.length} imagen${evidencias.length !== 1 ? "es" : ""}`
  );
  $("#cardEvidenciasSurtimiento").show();
  $("#sinEvidencias").hide();
}

function ocultarEvidencias() {
  $("#cardEvidenciasSurtimiento").hide();
}

function mostrarEvidenciaAmpliada(
  rutaArchivo,
  descripcion,
  fecha,
  personaRecibe
) {
  $("#evidenciaImagenAmpliada").attr("src", rutaArchivo);
  $("#evidenciaDescripcion").text(descripcion || "Sin descripción");
  $("#evidenciaFecha").text(fecha || "No disponible");
  $("#evidenciaPersonaRecibe").text(personaRecibe || "No disponible");
  $("#evidenciaDescargar").attr("href", rutaArchivo);

  $("#evidenciaModal").modal("show");
}

console.log("Funcionalidad de surtimiento cargada correctamente");

// Verificar inmediatamente si jQuery está disponible
if (typeof $ === "undefined") {
  console.error("❌ jQuery no está disponible");
} else {
  console.log("✅ jQuery disponible");
}

// La función consultarDatosMovimientoCompletos ya no es necesaria
// Los datos ahora vienen directamente en rowSelected desde el DataTable
