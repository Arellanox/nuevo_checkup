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
    $("#btnRegistrar").hide();
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
        $("#editarArticuloModal").modal("show");
        $("#editandoArticulo").text(` ${rowSelected.CLAVE_ART}`);

        // Colocar los valores al formulario
        $("#editarArticuloForm #no_art").val(rowSelected.NO_ART);
        $("#editarArticuloForm #clave_art").val(rowSelected.CLAVE_ART);
        $("#editarArticuloForm #nombre_comercial").val(
          rowSelected.NOMBRE_COMERCIAL
        );

        $("#editarArticuloForm #id_marcas").val(rowSelected.MARCAS);

        if (rowSelected.ESTATUS == 1) {
          $("#editarArticuloForm #estatus").prop("checked", true);
        } else {
          $("#editarArticuloForm #estatus").prop("checked", false);
        }
        $("#editarArticuloForm #red_frio").val(rowSelected.RED_FRIO);
        $("#editarArticuloForm #unidad_venta").val(rowSelected.UNIDAD_VENTA);
        $("#editarArticuloForm #unidad_minima").val(rowSelected.UNIDAD_MINIMA);
        $("#editarArticuloForm #contenido").val(rowSelected.CONTENIDO);
        $("#editarArticuloForm #tipo_articulo").val(
          rowSelected.TIPO_ARTICULO_ID
        );

        // Validación para tipo_articulo (Reactivo)
        if (rowSelected.TIPO_ARTICULO_ID == 1) {
          $("#editarArticuloForm #rendimientoEstimadoDiv").show();
          $("#editarArticuloForm #rendimientoPacienteDiv").show();
          $("#editarArticuloForm #insertoDiv").show();
          $("#editarArticuloForm #protocoloDiv").show();
        } else {
          $("#editarArticuloForm #rendimientoEstimadoDiv").hide();
          $("#editarArticuloForm #rendimientoPacienteDiv").hide();
          $("#editarArticuloForm #insertoDiv").hide();
          $("#editarArticuloForm #protocoloDiv").hide();
          $("#editarArticuloForm #rendimiento_estimado").val("");
          $("#editarArticuloForm #rendimiento_paciente").val("");
          $("#editarArticuloForm #inserto").val("");
          $("#editarArticuloForm #procedimiento").val("");
        }
        $("#editarArticuloForm #tipo_articulo")
          .off("change")
          .on("change", function () {
            if ($(this).val() == "1") {
              $("#editarArticuloForm #rendimientoEstimadoDiv").show();
              $("#editarArticuloForm #rendimientoPacienteDiv").show();
              $("#editarArticuloForm #insertoDiv").show();
              $("#editarArticuloForm #protocoloDiv").show();
            } else {
              $("#editarArticuloForm #rendimientoEstimadoDiv").hide();
              $("#editarArticuloForm #rendimientoPacienteDiv").hide();
              $("#editarArticuloForm #insertoDiv").hide();
              $("#editarArticuloForm #protocoloDiv").hide();
              $("#editarArticuloForm #rendimiento_estimado").val("");
              $("#editarArticuloForm #rendimiento_paciente").val("");
              $("#editarArticuloForm #inserto").val("");
              $("#editarArticuloForm #procedimiento").val("");
            }
          });
        $("#editarArticuloForm #maneja_caducidad").val(
          rowSelected.MANEJA_CADUCIDAD
        );

        $("#editarArticuloForm #fecha_caducidad").val(
          rowSelected.FECHA_CADUCIDAD
        );

        //para mostrar la fecha de caducidad traida de la bd y si no maneja caducidad ocultar el campo
        if (rowSelected.MANEJA_CADUCIDAD == 1) {
          $("#editarArticuloForm #fecha_caducidad").closest(".mb-3").show();
        } else {
          $("#editarArticuloForm #fecha_caducidad").closest(".mb-3").hide();
          $("#editarArticuloForm #fecha_caducidad").val("");
        }
        $("#editarArticuloForm #maneja_caducidad")
          .off("change")
          .on("change", function () {
            if ($(this).val() == "1") {
              $("#editarArticuloForm #fecha_caducidad").closest(".mb-3").show();
            } else {
              $("#editarArticuloForm #fecha_caducidad").closest(".mb-3").hide();
              $("#editarArticuloForm #fecha_caducidad").val("");
            }
          });

        $("#editarArticuloForm #costo_mas_alto").val(
          rowSelected.COSTO_MAS_ALTO
        );
        $("#editarArticuloForm #costo_ultima_entrada").val(
          rowSelected.COSTO_ULTIMA_ENTRADA
        );
        $("#editarArticuloForm #fecha_ultima_entrada").val(
          rowSelected.FECHA_ULTIMA_ENTRADA
            ? rowSelected.FECHA_ULTIMA_ENTRADA.split(" ")[0]
            : ""
        );

        $("#editarArticuloForm #codigo_barras").val(
          rowSelected.codigo_barras
        );

        $("#editarArticuloForm #numero_lote").val(
          rowSelected.numero_lote
        );

        $("#editarArticuloForm #fecha_lote").val(
          rowSelected.fecha_lote
        );

        $("#editarArticuloForm #area_id").val(rowSelected.AREA_ID);
        $("#editarArticuloForm #rendimiento_estimado").val(
          rowSelected.RENDIMIENTO_ESTIMADO
        );
        $("#editarArticuloForm #rendimiento_paciente").val(rowSelected.RENDIMIENTO_PACIENTE);
        $("#editarArticuloForm #inserto").val(rowSelected.INSERTO);

        // Agregar la configuración para maneja_inserto
      if (typeof rowSelected.MANEJA_INSERTO !== "undefined") {
        $("#editarArticuloForm #maneja_inserto").val(rowSelected.MANEJA_INSERTO);
      } else {
        // Si no existe en el objeto, determinar su valor según si hay datos o no
        // Si hay un valor en INSERTO, significa que debemos mostrarlo (0), de lo contrario ocultarlo (1)
        $("#editarArticuloForm #maneja_inserto").val(
          rowSelected.INSERTO && rowSelected.INSERTO.trim() !== "" ? "0" : "1"
        );
      }

      // Agregar la configuración para maneja_rendimiento
      if (typeof rowSelected.MANEJA_RENDIMIENTO !== "undefined") {
        $("#editarArticuloForm #maneja_rendimiento").val(rowSelected.MANEJA_RENDIMIENTO);
      } else {
      // Si no existe en el objeto, determinar su valor según si hay datos o no
      // Si hay un valor en RENDIMIENTO_ESTIMADO, significa que debemos mostrarlo (0), de lo contrario ocultarlo (1)
        $("#editarArticuloForm #maneja_rendimiento").val(
          rowSelected.RENDIMIENTO_ESTIMADO && rowSelected.RENDIMIENTO_ESTIMADO.toString() !== "0" ? "0" : "1"
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
    { data: "UNIDAD_VENTA" },
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
          return "";
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
      }
    },
    { data: "codigo_barras" }
    ,
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
    { target: 7, title: "Unid. mínima", className: "all" },
    { target: 8, title: "Contenido", className: "all" },
    { target: 9, title: "Tipo", className: "all" },
    { target: 10, title: "Maneja caducidad", className: "all" },
    { target: 11, title: "Fecha caducidad", className: "all" },
    { target: 12, title: "Área", className: "all" },
    { target: 13, title: "Costo más alto", className: "all" },
    { target: 14, title: "Inserto", className: "all" },
    { target: 15, title: "Proc. de prueba", className: "all" },
    { target: 16, title: "CAS", className: "all" },
    { target: 17, title: "Número de lote", className: "all" },
    { target: 18, title: "Fecha de lote", className: "all" },
    { target: 19, title: "Código de barras", className: "all", visible: false },
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
    $menu.on("click", ".dropdown-item", function () {
      var tipo = $(this).data("value");
      window.dataTableCatEntradas = window.dataTableCatEntradas || {};
      dataTableCatEntradas.id_movimiento = tipo;
      tableCatEntradas.ajax.reload();

      // Cambia visibilidad y títulos de columnas según el tipo de movimiento
      if (tipo == "1") {
        // Entradas
        $("#titulosEntradasSalidas").text("Entradas");
        tableCatEntradas.column(3).visible(true);
        tableCatEntradas.column(7).header().textContent = "Motivo de entrada";
        tableCatEntradas.column(4).header().textContent =
          "Fecha última entrada";
        tableCatEntradas.column(5).visible(true);
        tableCatEntradas.column(6).visible(true);
        tableCatDetallesEntradas.column(3).header().textContent =
          "Cantidad de entrada";
        tableCatDetallesEntradas.column(0).header().textContent =
          "Fecha y hora última entrada";
        tableCatDetallesEntradas.column(1).visible(true);
        tableCatDetallesEntradas.column(2).visible(true);
        tableCatDetallesEntradas.column(6).header().textContent =
          "Motivo de entrada";
        tableCatDetallesEntradas.column(7).visible(true);
        detalleEntradaLabel.textContent = "Detalles de entrada";

        //Editar en detalles entradas
        cantidadEditarMovLabel.textContent = "Cantidad a ingresar";
        $("#editarMovimientoModal #costoUltimaEntradaDiv").show();
        $("#editarMovimientoModal #costo_ultima_entrada").prop(
          "required",
          true
        );
        $("#editarMovimientoModal #proveedorDiv").show();
        $("#editarMovimientoModal #id_proveedores").prop("required", true);
        $("#editarMovimientoModal .modal-title").html(
          'Editando entrada con fecha: <span id="mostrandoDetallesEntrada"></span>'
        );
        $("#editarMovimientoModal #motivo_salida_label").text(
          "Motivo de entrada"
        );
      } else {
        // Salidas
        $("#titulosEntradasSalidas").text("Salidas");
        tableCatEntradas.column(3).visible(false); // Oculta costo última entrada
        tableCatEntradas.column(7).header().textContent = "Motivo de salida";
        tableCatEntradas.column(4).header().textContent = "Fecha última salida";
        tableCatEntradas.column(5).visible(false); // Oculta costo más alto
        tableCatEntradas.column(6).visible(false); // Oculta proveedor
        tableCatDetallesEntradas.column(3).header().textContent =
          "Cantidad de salida";
        tableCatDetallesEntradas.column(0).header().textContent =
          "Fecha y hora última salida";
        tableCatDetallesEntradas.column(1).visible(false);
        tableCatDetallesEntradas.column(2).visible(false);
        tableCatDetallesEntradas.column(6).header().textContent =
          "Motivo de salida";
        tableCatDetallesEntradas.column(7).visible(true);
        tableCatDetallesEntradas.columns.adjust().draw();
        detalleEntradaLabel.textContent = "Detalles de salida";

        //Editar en detalles salidas
        cantidadEditarMovLabel.textContent = "Cantidad a retirar";
        $("#editarMovimientoModal #costoUltimaEntradaDiv").hide();
        $("#editarMovimientoModal #costo_ultima_entrada").prop(
          "required",
          false
        );
        $("#editarMovimientoModal #proveedorDiv").hide();
        $("#editarMovimientoModal #id_proveedores").prop("required", false); //false, se pone auto id 3 (SIN PROVEEDOR)
        $("#editarMovimientoModal .modal-title").html(
          'Editando salida con fecha: <span id="mostrandoDetallesEntrada"></span>'
        );
        $("#editarMovimientoModal #motivo_salida_label").text(
          "Motivo de salida"
        );
      }
      tableCatEntradas.columns.adjust().draw();
      $menu.remove();
    });

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
    { data: "CANTIDAD" },
    { data: "USUARIO" },
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
  ],
  dom: 'Bl<"dataTables_toolbar">frtip',
  buttons: buttonsEntradas,
});

// DATATABLE DE DETALLES ENTRADAS
var tableCatDetallesEntradas = $("#tableCatDetallesEntradas").DataTable({
  order: [0, "desc"],
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
    { data: "PROVEEDOR" },
    { data: "CANTIDAD" },
    { data: "id_cat_movimientos" },
    { data: "id_movimiento" },
    { data: "MOTIVO_SALIDA" },
    { data: "RESPONSABLE" },
  ],
  columnDefs: [
    { targets: 0, title: "Fecha y hora última entrada", className: "all" },
    { targets: 1, title: "Costo última entrada", className: "all" },
    { targets: 2, title: "Proveedor", className: "all" },
    { targets: 3, title: "Cantidad de entrada", className: "all" },
    { targets: 4, visible: false },
    { targets: 5, visible: false },
    { targets: 6, title: "Motivo de entrada", className: "all" },
    { targets: 7, title: "Responsable", className: "all" },
  ],
});

// DATATABLE DE TRANSACCIONES
tableCatTransacciones = $("#tableCatTransacciones").DataTable({
  order: [[3, "desc"]],
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
      return $.extend(d, dataTableCatTransacciones);
    },
    method: "POST",
    url: "../../../api/inventarios_api.php",
    error: function (jqXHR, textStatus, errorThrown) {
      alertErrorAJAX(jqXHR, textStatus, errorThrown);
    },
    dataSrc: "response.data",
  },  columns: [
    { data: "CLAVE_ART" },
    { data: "NOMBRE_COMERCIAL" },
    { data: "CANTIDAD" },
    { data: "FECHA_TRANSACCION" },
    {
      data: "COSTO_ULTIMA_TRANSACCION",
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
    { data: "TIPO_MOVIMIENTO" },
    { data: "MOTIVO_SALIDA" },
    { data: "RESPONSABLE" },
  ],  columnDefs: [
    { targets: 0, title: "Clave Artículo", className: "all" },
    { targets: 1, title: "Nombre Comercial", className: "all" },
    { targets: 2, title: "Cantidad", className: "all" },
    { targets: 3, title: "Fecha Transacción", className: "all" },
    { targets: 4, title: "Costo Última Transacción", className: "all" },
    { targets: 5, title: "Proveedor", className: "all" },
    { targets: 6, title: "Tipo de Movimiento", className: "all" },
    { targets: 7, title: "Motivo", className: "all" },
    { targets: 8, title: "Responsable", className: "all" },
  ],
  dom: 'Bl<"dataTables_toolbar">frtip',
  buttons: [],
});

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

    //MODIFICACION AQUI ME QUEDE
    establecerValoresActuales({
      proveedor: rowSelected.PROVEEDOR,
      motivo: rowSelected.MOTIVO_SALIDA,
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

    $("#unidadVenta").text(rowSelected.UNIDAD_VENTA);
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
    $("#numeroLote").text(rowSelected.numero_lote ? rowSelected.numero_lote : "Sin registros");
    $("#fechaLote").text(
  !rowSelected.fecha_lote || 
  rowSelected.fecha_lote === "0000-00-00" || 
  rowSelected.fecha_lote === "0000-00-00 00:00:00" || 
  rowSelected.fecha_lote === "00000000" 
    ? "Sin registros" 
    : rowSelected.fecha_lote
);
// $("#codigoBarras").text(rowSelected.codigo_barras ? rowSelected.codigo_barras : "Sin registros");
    
    // Por esta nueva lógica:
    if (rowSelected.codigo_barras && rowSelected.codigo_barras.trim() !== '') {
      // Mostrar el código como texto en el elemento original
      $("#codigoBarras").text(rowSelected.codigo_barras);
      
      // Generar y mostrar el código de barras visual
      mostrarCodigoBarrasInteligente(rowSelected.codigo_barras);
    } else {
      // Si no hay código de barras
      $("#codigoBarras").text("Sin registros");
      
      // Ocultar el contenedor del código visual
      if (document.getElementById('codigoBarrasContainer')) {
        document.getElementById('codigoBarrasContainer').style.display = 'none';
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
      rowSelected.PROVEEDORES
        ? rowSelected.PROVEEDORES.split("|")
            .filter(
              (proveedor) =>
                proveedor.trim().toUpperCase() !== "SIN PROVEEDOR" &&
                proveedor.trim() !== "3"
            )
            .map((proveedor) => `<br><span>${proveedor}</span>`)
            .join("") || "No hay proveedores registrados."
        : "No hay proveedores registrados."
    );

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
    "tableCatTransacciones",
    tableCatTransacciones,
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

$("#detalleProductoModal").on("shown.bs.modal", function () {
  if (rowSelected.RED_FRIO == 1) {
    createSnowflakes();
  } else {
    // createHeatWaves();
    // createWarmGlow();
    createThermometer();
  }
});

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

tableCatTransacciones.on("draw", function () {
  $(".dataTable th, .dataTable td").css({
    "text-align": "center",
    "vertical-align": "middle",
  });
});

// Guarda la instancia de FixedHeader para poder destruirla
let fixedHeaderTransacciones = null;

// Al abrir el modal, inicializa FixedHeader si no existe
$("#detalleTransaccionModal").on("shown.bs.modal", function () {
  if (!fixedHeaderTransacciones) {
    fixedHeaderTransacciones = new $.fn.dataTable.FixedHeader(
      tableCatTransacciones
    );
  }
  // Ajusta el header por si acaso
  fixedHeaderTransacciones.adjust();
});

// Al cerrar el modal, destruye el FixedHeader y elimina el header flotante
$("#detalleTransaccionModal").on("hidden.bs.modal", function () {
  if (fixedHeaderTransacciones) {
    fixedHeaderTransacciones.destroy();
    fixedHeaderTransacciones = null;
  }
  // Elimina cualquier header flotante que haya quedado
  $(".fixedHeader-floating").remove();
  $(".fixedHeader-locked").remove();
});

//cargas dinamica
$(document).ready(function () {
  // ==================== CARGAS PARA MODAL REGISTRAR ====================
  $("#registrarArticuloModal").on("show.bs.modal", function () {
    cargarTiposRegistrar();
    cargarMarcasRegistrar();
    cargarUnidadesRegistrar();
    cargarAreasRegistrar();
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
    cargarTiposEditar();
    cargarMarcasEditar();
    cargarUnidadesEditar();
    cargarAreasEditar();
    // No cargar proveedores aquí porque no está en el formulario de editar
  });

   // ==================== CARGAS PARA MODAL FILTRAR ====================
  $("#filtrarArticuloModal").on("show.bs.modal", function () {
    cargarTiposFiltrar();
    cargarAreasFiltrar();
  });

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

  function cargarAreasEditar() {
    cargarCatalogoEnModal("#editarArticuloModal #area_id", {
      api: 18,
      campoId: "ID_AREA", // Usar el campo que devuelve tu SP
      campoTexto: "DESCRIPCION",
      placeholder: "Seleccione un área",
    });
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

  function cargarTiposEditar() {
    cargarCatalogoEnModal("#editarArticuloModal #tipo_articulo", {
      api: 2,
      campoId: "ID_TIPO",
      campoTexto: "DESCRIPCION",
      placeholder: "Seleccione un tipo",
    });
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

  function cargarMarcasEditar() {
    cargarCatalogoEnModal("#editarArticuloModal #id_marcas", {
      api: 9,
      campoId: "id_marcas",
      campoTexto: "descripcion",
      placeholder: "Seleccione una marca",
    });
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

  function cargarUnidadesEditar() {
    cargarCatalogoEnModal("#editarArticuloModal #unidad_venta", {
      api: 12, // API para unidades activas
      campoId: "id_unidades",
      campoTexto: "descripcion",
      placeholder: "Seleccione unidad de venta",
    });
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

  // ==================== FUNCIÓN GENÉRICA PARA CARGAR CATÁLOGOS ====================
  function cargarCatalogoEnModal(selectorSelect, opciones) {
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

          console.log(`${opciones.placeholder} cargados en:`, selectorSelect);
        } else {
          console.log(`Error al cargar ${opciones.placeholder}:`, response);
          alertToast(`Error al cargar ${opciones.placeholder}`, "error", 3000);
        }
      },
      error: function (xhr, status, error) {
        console.log("Error AJAX:", error);
        alertToast(
          `Error de conexión al cargar ${opciones.placeholder}`,
          "error",
          3000
        );
      },
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

// catalogos, mostrar las tablas
var tableCatTipos,
  tableCatUnidades,
  tableCatMarcas,
  tableCatMotivos,
  tableCatProveedores;
var rowSelectedCatalogo = null;

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
      method: "POST",
      url: "../../../api/inventarios_api.php",
      data: { api: 2 },
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
      method: "POST",
      url: "../../../api/inventarios_api.php",
      data: { api: 12 },
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
                        <button class="btn btn-sm btn-warning btn-editar-marca" data-id="${row.id_unidades}" data-descripcion="${row.descripcion}" data-activo="${row.activo}">
                            <i class="bi bi-pencil"></i>
                        </button>
                        <button class="btn btn-sm btn-danger btn-eliminar-marca" data-id="${row.id_unidades}">
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
      method: "POST",
      url: "../../../api/inventarios_api.php",
      data: { api: 9 },
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
      method: "POST",
      url: "../../../api/inventarios_api.php",
      data: { api: 15 },
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
      method: "POST",
      url: "../../../api/inventarios_api.php",
      data: { api: 16 }, // Nueva API para proveedores
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

    // Ajustar columnas
    tableCatTipos.columns.adjust().draw();
    tableCatMarcas.columns.adjust().draw();
    tableCatUnidades.columns.adjust().draw();
    tableCatMotivos.columns.adjust().draw();
    tableCatProveedores.columns.adjust().draw();
  }, 1000);

  inicializarEventosCatalogos();
}

