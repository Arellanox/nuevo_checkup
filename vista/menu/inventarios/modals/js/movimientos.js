// DATATABLE DE ENTRADAS ESTABLE
tableCatEntradasEstable = $("#tableCatEntradasEstable").DataTable({
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
      return $.extend(d, dataTableCatEntradasEstable);
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
      data: "ID_ARTICULO",
      title: "ID Artículo",
      visible: false,
    },
    {
      data: "CLAVE_ART",
      title: "Clave",
      width: "50px",
    },
    {
      data: "NOMBRE_COMERCIAL",
      title: "Artículo",
    },
    {
      data: "FECHA_ENTRADA",
      title: "Fecha de Entrada",
      render: function (data) {
        if (!data || data === "0000-00-00" || data === "0000-00-00 00:00:00")
          return "-";
        return data ? moment(data).format("DD/MM/YYYY HH:mm") : "-";
      },
    },
    {
      data: "RESPONSABLE",
      title: "Responsable",
      render: function (data) {
        if (data === 0 || !data) return "-";
        return data;
      },
    },
    {
      data: "CANTIDAD",
      title: "Cantidad Ingresada",
      className: "text-center",
      render: function (data, type, row) {
        if (data === 0 || !data) return "-";
        const unidad = row.UNIDAD_MEDIDA || "unid";
        return `<span class="badge bg-primary">${data} ${unidad}</span>`;
      },
    },
    {
      data: "COSTO_UNITARIO",
      title: "Costo Unitario",
      className: "text-end",
      render: function (data) {
        if (data === 0 || !data) return "-";
        return data ? `$${parseFloat(data).toFixed(2)}` : "-";
      },
    },
    {
      data: "COSTO_TOTAL",
      title: "Costo Total",
      className: "text-end",
      render: function (data) {
        return data ? `<strong>$${parseFloat(data).toFixed(2)}</strong>` : "-";
      },
    },
    {
      data: "PROVEEDOR_NOMBRE",
      title: "Proveedor",
      render: function (data) {
        return data || "-";
      },
    },
    {
      data: "ALMACEN_NOMBRE",
      title: "Almacén",
      render: function (data) {
        return data || "Almacén principal";
      },
    },
    {
      data: "MOTIVO_DESCRIPCION",
      title: "Motivo",
      render: function (data) {
        return data || "Sin especificar";
      },
    },
    {
      data: "NUMERO_LOTE",
      title: "Lote",
      visible: false,
      render: function (data) {
        return data || "-";
      },
    },
    {
      data: "FECHA_CADUCIDAD",
      title: "Caducidad",
      render: function (data) {
        if (!data || data === "0000-00-00") return "-";
        const fechaCad = moment(data);
        const hoy = moment();
        const diasRestantes = fechaCad.diff(hoy, "days");

        let badgeClass = "bg-success";
        if (diasRestantes <= 30) badgeClass = "bg-danger";
        else if (diasRestantes <= 90) badgeClass = "bg-warning";

        return `<span class="badge ${badgeClass}">${fechaCad.format(
          "DD/MM/YYYY"
        )}</span>`;
      },
    },
    {
      data: "NUMERO_DOCUMENTO",
      title: "Número de Documento",
      render: function (data) {
        return data || "-";
      },
      visible: false,
    },
    {
      data: "DOCUMENTO_FACTURA",
      title: "Factura",
      render: function (data, type, row) {
        if (data) {
          var extension = data.split(".").pop().toLowerCase();

          if (extension === "pdf") {
            return (
              '<a href="' +
              data +
              '" target="_blank"><i class="bi bi-file-earmark-pdf-fill text-danger fs-4" title="Ver PDF"></i></a>'
            );
          } else {
            return (
              '<a href="' +
              data +
              '" target="_blank"><img src="' +
              data +
              '" alt="Imagen del Documento" style="width: 50px; height: auto;"/></a>'
            );
          }
        } else {
          return "-";
        }
      },
    },
    {
      data: "EXISTENCIA_ACTUAL",
      title: "Existencia Actual",
      className: "text-center",
      render: function (data) {
        return data !== null ? data : "-";
      },
    },
    {
      data: null,
      title: "Acciones",
      className: "all",
      orderable: false,
      width: "120px",
      render: function (data, type, row) {
        return '<button class="btn btn-warning btn-sm btn-editar-entrada" data-bs-toggle="tooltip" title="Editar entrada"><i class="bi bi-pencil-square"></i></button>';
      },
    },
  ],
  columnDefs: [{ targets: "_all", className: "text-center align-middle" }],
  dom: 'Bl<"dataTables_toolbar">frtip',
  buttons: [
    {
      text: '<i class="bi bi-plus-lg"></i> Nueva Entrada',
      className: "btn btn-success",
      action: function () {
        if (rowSelected) {
          $("#registrarEntradaEstableModal").modal("show");

          // Llenar información del artículo
          $("#articuloSeleccionadoEstable").text(rowSelected.NOMBRE_COMERCIAL);
          $("#existenciaActualTittleEstable").text(rowSelected.CANTIDAD || "0");
          $("#nombreArticuloEstable").val(rowSelected.NOMBRE_COMERCIAL);
          $("#claveArticuloEstable").val(rowSelected.CLAVE_ART || "");
          $("#existenciaActualEstable").val(rowSelected.CANTIDAD || "0");
          $("#unidadMedidaEstable").text(rowSelected.UNIDAD_MEDIDA || "unid");

          // Campos ocultos
          $("#idArticuloEstable").val(rowSelected.ID_ARTICULO);
          $("#nombreComercialEstable").val(rowSelected.NOMBRE_COMERCIAL);
          $("#noArtEstable").val(rowSelected.ID_ARTICULO);
        } else {
          alertToast("Seleccione un artículo", "warning", 4000);
        }
      },
    },
    {
      text: '<i class="bi bi-funnel"></i> Filtrar Entradas',
      className: "btn btn-warning",
      action: function () {
        $("#filtrosEntradasModal").modal("show");
      },
    },
    {
      text: '<i class="bi bi-file-earmark-arrow-down"></i> Entrada con Orden',
      className: "btn btn-info",
      action: function () {
        $("#registrarEntradaOrdenEstableModal").modal("show");
      },
    },
    {
      text: '<i class="bi bi-file-earmark-arrow-down"></i> Ver Transacciones',
      className: "btn btn-info",
      action: function () {
        $("#detalleTransaccionModal").modal("show");
      },
    },
  ],
});

$(document).on("click", ".btn-editar-entrada", function () {
  //pendiente darle func en modal_inventarios.js
  $("#articuloSeleccionadoEstableEditar").text(rowSelected.NOMBRE_COMERCIAL);
  $("#existenciaActualTittleEstableEditar").text(
    rowSelected.EXISTENCIA_ACTUAL || "-"
  );
  $("#numeroFacturaEstableEditar").val(rowSelected.NUMERO_DOCUMENTO);
  $("#numeroLoteEstableEditar").val(rowSelected.NUMERO_LOTE);
  $("#cantidadEstableEditar").val(rowSelected.CANTIDAD);
  $("#precioCompraEstableEditar").val(rowSelected.COSTO_UNITARIO);
  var fechaSolo = rowSelected.FECHA_ENTRADA
    ? rowSelected.FECHA_ENTRADA.split(" ")[0]
    : "";
  $("#fechaCompraEstableEditar").val(fechaSolo);
  $("#fechaCaducidadEstableEditar").val(rowSelected.FECHA_CADUCIDAD);
  $("#motivoEntradaEstableEditar").val(rowSelected.MOTIVO_DESCRIPCION);
  $("#proveedorEstableEditar").val(rowSelected.ID_PROVEEDORES);
  $("#observacionesEstableEditar").val(rowSelected.OBSERVACIONES);
  $("#unidadMedidaEstableEditar").text(rowSelected.UNIDAD_MEDIDA);

  $("#editarEntradaEstableModal").modal("show");
});

selectDatatable(
  "tableCatEntradasEstable",
  tableCatEntradasEstable,
  0,
  0,
  0,
  0,
  async function (select, dataClick) {
    rowSelected = dataClick;
  },
  async function () {
    $("#detalleArticuloSeleccionadoEstable").text(rowSelected.NOMBRE_COMERCIAL);
    $("#detalleArticuloSeleccionadoTableEstable").text(
      rowSelected.NOMBRE_COMERCIAL
    );
    dataTableCatDetEntradasEstable = {
      api: 7,
      id_articulo: rowSelected.ID_ARTICULO,
    };
    tableCatDetEntradasEstable.ajax.reload();
    $("#detalleEntradaEstableModal").modal("show");
  }
);

// DATATABLE DE DETALLES DE ENTRADA
tableCatDetEntradasEstable = $("#tableCatDetEntradasEstable").DataTable({
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
      return $.extend(d, dataTableCatDetEntradasEstable);
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
      data: "fecha_entrada",
      title: "Fecha de Entrada",
      render: function (data) {
        if (!data || data === "0000-00-00" || data === "0000-00-00 00:00:00")
          return "-";
        return data ? moment(data).format("DD/MM/YYYY HH:mm") : "-";
      },
    },
    {
      data: "CANTIDAD_ENTRADA",
      title: "Cantidad Ingresada",
      className: "text-center",
      render: function (data) {
        return data ? data : "-";
      },
    },
    {
      data: "PROVEEDOR",
      title: "Proveedor",
      render: function (data) {
        return data ? data : "-";
      },
    },
    {
      data: "FACTURA",
      title: "Factura",
      render: function (data, type, row) {
        if (data) {
          var extension = data.split(".").pop().toLowerCase();

          if (extension === "pdf") {
            return (
              '<a href="' +
              data +
              '" target="_blank"><i class="bi bi-file-earmark-pdf-fill text-danger fs-4" title="Ver PDF"></i></a>'
            );
          } else {
            return (
              '<a href="' +
              data +
              '" target="_blank"><img src="' +
              data +
              '" alt="Imagen del Documento" style="width: 50px; height: auto;"/></a>'
            );
          }
        } else {
          return "-";
        }
      },
    },
    {
      data: "RESPONSABLE",
      title: "Responsable",
      render: function (data) {
        return data ? data : "-";
      },
    },
    {
      data: "MOTIVO",
      title: "Motivo",
      render: function (data) {
        return data ? data : "-";
      },
    },
    // {
    //   data: "OBSERVACIONES",
    //   title: "Observaciones",
    //   render: function (data) {
    //     return data ? data : "-";
    //   },
    // },
  ],
  columnDefs: [{ targets: "_all", className: "text-center align-middle" }],
  dom: 'Bl<"dataTables_toolbar">frtip',
  buttons: [
    {
      text: '<i class="bi bi-funnel"></i> Filtrar',
      className: "btn btn-warning",
      action: function () {
        $("#filtrosEntradasModal").modal("show");
      },
    },
  ],
});

// DATATABLE DE ARTICULOS DE ORDEN DE COMPRA
tableCatOrdenesCompraArticulos = $("#tableCatOrdenesCompraArticulos").DataTable(
  {
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
        return $.extend(d, dataTableCatOrdenesCompraArticulos);
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
        data: "ARTICULO_CLAVE",
        title: "Clave",
        render: function (data) {
          return data ? data : "-";
        },
      },
      {
        data: "ARTICULO_NOMBRE",
        title: "Artículo",
        render: function (data) {
          return data ? data : "-";
        },
      },
      {
        data: "cantidad_solicitada",
        title: "Cantidad Ordenada",
        className: "text-center",
        render: function (data) {
          return data ? data : "-";
        },
      },
      // {
      //   data: "CANTIDAD_RECIBIDA",
      //   title: "Cantidad Recibida",
      //   render: function (data) {
      //     return data ? data : "-";
      //   },
      // },
      // {
      //   data: "CANTIDAD_A_SURTIR",
      //   title: "Cantidad a Surtir",
      // },
      {
        data: "PRECIO_UNITARIO",
        title: "Precio Unitario",
        render: function (data) {
          return data ? `$${parseFloat(data).toFixed(2)}` : "-";
        },
      },
      {
        data: "PROVEEDOR_NOMBRE",
        title: "Proveedor",
        render: function (data) {
          return data ? data : "-";
        },
      },

      // {
      //   data: "DOCUMENTO",
      //   title: "Documento",

      //   render: function (data, type, row) {
      //     if (data) {
      //       var extension = data.split(".").pop().toLowerCase();

      //       if (extension === "pdf") {
      //         return (
      //           '<a href="' +
      //           data +
      //           '" target="_blank"><i class="bi bi-file-earmark-pdf-fill text-danger fs-4" title="Ver PDF"></i></a>'
      //         );
      //       } else {
      //         return (
      //           '<a href="' +
      //           data +
      //           '" target="_blank"><img src="' +
      //           data +
      //           '" alt="Imagen del Documento" style="width: 50px; height: auto;"/></a>'
      //         );
      //       }
      //     } else {
      //       return "-";
      //     }
      //   },
      // },
      // {
      //   data: "LOTE",
      //   title: "Lote",
      //   render: function (data) {
      //     return data ? data : "-";
      //   },
      // },
      // {
      //   data: "FECHA_CADUCIDAD",
      //   title: "Caducidad",
      //   render: function (data) {
      //     if (!data || data === "0000-00-00" || data === "0000-00-00 00:00:00")
      //       return "-";
      //     return data ? moment(data).format("DD/MM/YYYY HH:mm") : "-";
      //   },
      // },
      {
        data: "observaciones_detalle",
        title: "Observaciones",
        render: function (data) {
          return data ? data : "-";
        },
      },
      {
        data: null,
        title: "Acciones",
        render: function (data, type, row) {
          return `
          <button type="button" class="btn btn-warning btn-sm btn-surtir-orden-compra" data-bs-toggle="tooltip" title="Surtir orden de compra"><i class="bi bi-box-seam"></i></button>
        `;
        },
      },
    ],
    columnDefs: [{ targets: "_all", className: "text-center align-middle" }],
    dom: 'Bl<"dataTables_toolbar">frtip',
    buttons: [
      // {
      //   text: '<i class="bi bi-funnel"></i> Filtrar',
      //   className: "btn btn-warning",
      //   action: function () {
      //     $("#filtrosEntradasModal").modal("show");
      //   },
      // },
      {
        text: '<i class="bi bi-box-seam"></i> Ingresar todo',
        className: "btn btn-success",
        action: function () {
          $("#surtirOrdenCompraModal").modal("show");
        },
      },
    ],
  }
);

$(document).on("click", ".btn-surtir-orden-compra", function () {
  
  $("#surtirOrdenCompraIndividualModal").modal("show");
});

// ESTILOS PARA LA BARRA DE BUSQUEDA DE ENTRADAS
setTimeout(() => {
  inputBusquedaTable(
    "tableCatEntradasEstable",
    tableCatEntradasEstable,
    [
      {
        msj: "Filtre los registros por coincidencia",
        place: "top",
      },
    ],
    [],
    "col-12"
  );
  tableCatEntradasEstable.columns.adjust().draw();
}, 1000);

setTimeout(() => {
  inputBusquedaTable(
    "tableCatDetEntradasEstable",
    tableCatDetEntradasEstable,
    [
      {
        msj: "Filtre los registros por coincidencia",
        place: "top",
      },
    ],
    [],
    "col-12"
  );
  tableCatDetEntradasEstable.columns.adjust().draw();
}, 1000);

setTimeout(() => {
  inputBusquedaTable(
    "tableCatOrdenesCompraArticulos",
    tableCatOrdenesCompraArticulos,
    [
      {
        msj: "Filtre los registros por coincidencia",
        place: "top",
      },
    ],
    [],
    "col-12"
  );
  tableCatOrdenesCompraArticulos.columns.adjust().draw();
}, 1000);

// ==================== FUNCIONALIDADES PARA CARGAR CATÁLOGOS ====================
function cargarCatalogoEnSelect(selectorSelect, opciones, callback) {
  const config = {
    soloActivos: true,
    soloAprobadas: true,
    ...opciones,
  };

  $.ajax({
    url: "../../../api/inventarios_api.php",
    type: "POST",
    dataType: "json",
    data: { api: config.api },

    success: function (response) {
      if (response.response && response.response.code == 1) {
        const selectElement = $(selectorSelect);
        const valorActual = selectElement.val();

        selectElement
          .empty()
          .append(`<option value="">${config.placeholder}</option>`);

        let totalElementos = 0;
        response.response.data.forEach(function (item) {
          const esActivo = item.activo == 1 || item.ACTIVO == 1;
          const esAprobada =
            item.estado == "aprobada" || item.ESTADO == "aprobada";
          if (!config.soloActivos || esActivo) {
            if (!config.soloAprobadas || esAprobada) {
              selectElement.append(
                `<option value="${item[config.campoId]}">${
                  item[config.campoTexto]
                }</option>`
              );
            }
            totalElementos++;
          }
        });

        if (valorActual) selectElement.val(valorActual);

        if (callback && typeof callback === "function") callback();
      } else {
        alertToast(`Error al cargar ${config.placeholder}`, "error", 3000);
      }
    },

    error: function (xhr, status, error) {
      alertToast(
        `Error de conexión al cargar ${config.placeholder}`,
        "error",
        3000
      );
    },
  });
}

function cargarProveedoresEstable() {
  cargarCatalogoEnSelect("#registrarEntradaEstableModal #proveedorEstable", {
    api: 16,
    campoId: "id_proveedores",
    campoTexto: "nombre",
    placeholder: "Seleccione un proveedor",
    soloActivos: true,
  });
}

function cargarMotivosEstable() {
  cargarCatalogoEnSelect(
    "#registrarEntradaEstableModal #motivoEntradaEstable",
    {
      api: 15,
      campoId: "id_motivos",
      campoTexto: "descripcion",
      placeholder: "Seleccione un motivo",
      soloActivos: true,
    }
  );
}

function cargarOrdenesCompraEstable() {
  cargarCatalogoEnSelect(
    "#registrarEntradaOrdenEstableModal #ordenCompraSelect",
    {
      api: 44,
      campoId: "ID_ORDEN_COMPRA",
      campoTexto: "NUMERO_ORDEN",
      placeholder: "Seleccione una orden de compra",
      soloAprobadas: true,
    }
  );
}

cargarOrdenesCompraEstable();
cargarProveedoresEstable();
cargarMotivosEstable();
