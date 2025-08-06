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
    // {
    //   data: null,
    //   title: "Acciones",
    //   className: "all",
    //   orderable: false,
    //   width: "120px",
    //   render: function (data, type, row) {
    //     return '<button class="btn btn-warning btn-sm btn-editar-entrada" data-bs-toggle="tooltip" title="Editar entrada"><i class="bi bi-pencil-square"></i></button>';
    //   },
    // },
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
    // {
    //   text: '<i class="bi bi-funnel"></i> Filtrar Entradas',
    //   className: "btn btn-warning",
    //   action: function () {
    //     $("#filtrosEntradasModal").modal("show");
    //   },
    // },
    {
      text: '<i class="bi bi-file-earmark-arrow-down"></i> Entrada con Orden',
      className: "btn btn-warning",
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

// DATATABLE DE DETALLES DE ENTRADA
tableCatDetEntradasEstable = $("#tableCatDetEntradasEstable").DataTable({
  order: [[0, "desc"]],
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
      data: "id_entrada",
      title: "ID Detalle de Entrada",
      visible: false,
    },
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
      data: "fecha_compra",
      title: "Fecha de Compra",
      render: function (data) {
        if (!data || data === "0000-00-00" || data === "0000-00-00 00:00:00")
          return "-";
        return data ? moment(data).format("DD/MM/YYYY") : "-";
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
      data: "costo_unitario",
      title: "Costo Unitario",
      render: function (data) {
        return data ? data : "-";
      },
      visible: false,
    },
    {
      data: "PROVEEDOR",
      title: "Proveedor",
      render: function (data) {
        return data ? data : "-";
      },
    },
    {
      data: "id_proveedores",
      title: "ID Proveedor",
      visible: false,
    },
    {
      data: "FACTURA_NUM",
      title: "Factura",
      visible: false,
    },
    {
      data: "FACTURA_IMG",
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
    {
      data: "id_motivo",
      title: "ID Motivo",
      visible: false,
    },
    // {
    //   data: "orden_compra_numero",
    //   title: "Orden de Compra",
    //   render: function (data) {
    //     return data ? data : "-";
    //   },
    // },
    {
      data: "orden_compra_documento",
      title: "Orden de Compra",
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
              '" alt="Imagen de la orden de compra" style="width: 50px; height: auto;"/></a>'
            );
          }
        } else {
          return "-";
        }
      },
    },
    {
      data: "observaciones",
      title: "Observaciones",
      render: function (data) {
        return data ? data : "-";
      },
    },
    {
      data: "NOMBRE_COMERCIAL",
      title: "Artículo",
      render: function (data) {
        return data ? data : "-";
      },
      visible: false,
    },
    {
      data: "CLAVE_ART",
      title: "Clave",
      render: function (data) {
        return data ? data : "-";
      },
      visible: false,
    },
    {
      data: "ID_ARTICULO",
      title: "ID Artículo",
      visible: false,
    },
    {
      data: "NUMERO_LOTE",
      title: "Lote",
      render: function (data) {
        return data ? data : "-";
      },
      visible: false,
    },
    {
      data: "FECHA_CADUCIDAD",
      title: "Caducidad",
      render: function (data) {
        return data ? data : "-";
      },
      visible: false,
    },
    {
      data: null,
      title: "Acciones",
      render: function (data, type, row) {
        if (row.MOTIVO !== "Por orden de compra") {
          return `
          <button
          data-id-entrada="${row.id_entrada}"
          data-id-articulo="${row.ID_ARTICULO}"
          data-articulo="${row.NOMBRE_COMERCIAL}"
          data-clave="${row.CLAVE_ART}"
          data-numero-factura="${row.FACTURA_NUM}"
          data-documento-factura="${row.FACTURA_IMG}"
          data-proveedor="${row.PROVEEDOR}"
          data-id-proveedor="${row.id_proveedores}"
          data-fecha-entrada="${row.fecha_entrada}"
          data-fecha-compra="${row.fecha_compra}"
          data-lote="${row.NUMERO_LOTE}"
          data-fecha-caducidad="${row.FECHA_CADUCIDAD}"
          data-cantidad="${row.CANTIDAD_ENTRADA}"
          data-precio-unitario="${row.costo_unitario}"
          data-motivo="${row.MOTIVO}"
          data-id-motivo="${row.id_motivo}"
          data-observaciones="${row.observaciones}"
          type="button" class="btn btn-warning btn-sm btn-editar-entrada" data-bs-toggle="tooltip" title="Editar entrada"><i class="bi bi-pencil-square"></i></button>
          `;
        } else {
          return "-";
        }
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
  ],
});

$(document).on("click", ".btn-editar-entrada", function () {
  var articulo = $(this).data("articulo");
  var clave = $(this).data("clave");
  var cantidad = $(this).data("cantidad");
  var proveedor = $(this).data("proveedor");
  var idProveedor = $(this).data("id-proveedor");
  var fechaEntrada = $(this).data("fecha-entrada");
  var fechaCompra = $(this).data("fecha-compra");
  var precioUnitario = $(this).data("precio-unitario");
  var numeroFactura = $(this).data("numero-factura");
  var documentoFactura = $(this).data("documento-factura");
  var lote = $(this).data("lote");
  var fechaCaducidad = $(this).data("fecha-caducidad");
  var motivo = $(this).data("motivo");
  var idMotivo = $(this).data("id-motivo");
  var observaciones = $(this).data("observaciones");
  var idEntrada = $(this).data("id-entrada");
  var idArticulo = $(this).data("id-articulo");

  $("#nombreArticuloEstableEditar").val(articulo);
  $("#articuloSeleccionadoEstableEditar").text(articulo);
  $("#claveArticuloEstableEditar").val(clave);
  $("#existenciaActualTittleEstableEditar").text(cantidad || "-");
  $("#proveedorEstableEditar").val(idProveedor);
  $("#fechaCompraEstableEditar").val(fechaCompra);
  $("#cantidadEstableEditar").val(cantidad);
  $("#precioCompraEstableEditar").val(precioUnitario);
  $("#numeroFacturaEstableEditar").val(numeroFactura);
  // $("#documentoFacturaEstableEditar").val(documentoFactura);
  $("#numeroLoteEstableEditar").val(lote);
  $("#fechaCaducidadEstableEditar").val(fechaCaducidad);
  $("#motivoEntradaEstableEditar").val(idMotivo);
  $("#observacionesEstableEditar").val(observaciones);

  $("#idEntradaEstableEditar").val(idEntrada);
  $("#idArticuloEstableEditar").val(idArticulo);
  console.log("idEntrada", idEntrada);
  console.log("idArticulo", idArticulo);

  $("#editarEntradaEstableModal").modal("show");
});

// DATATABLE DE SALIDAS ESTABLE
tableCatSalidasEstable = $("#tableCatSalidasEstable").DataTable({
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
      return $.extend(d, dataTableCatSalidasEstable);
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
    // {
    //   data: null,
    //   title: "Acciones",
    //   className: "all",
    //   orderable: false,
    //   width: "120px",
    //   render: function (data, type, row) {
    //     return '<button class="btn btn-warning btn-sm btn-editar-entrada" data-bs-toggle="tooltip" title="Editar entrada"><i class="bi bi-pencil-square"></i></button>';
    //   },
    // },
  ],
  columnDefs: [{ targets: "_all", className: "text-center align-middle" }],
  dom: 'Bl<"dataTables_toolbar">frtip',
  buttons: [
    {
      text: '<i class="bi bi-plus-lg"></i> Nueva Salida',
      className: "btn btn-success",
      action: function () {
        if (rowSelected) {
          $("#registrarSalidaEstableModal").modal("show");

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
    // {
    //   text: '<i class="bi bi-funnel"></i> Filtrar Entradas',
    //   className: "btn btn-warning",
    //   action: function () {
    //     $("#filtrosEntradasModal").modal("show");
    //   },
    // },
    {
      text: '<i class="bi bi-file-earmark-arrow-down"></i> Salida con Requisición',
      className: "btn btn-warning",
      action: function () {
        $("#registrarSalidaOrdenEstableModal").modal("show");
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

// DATATABLE DE DETALLES DE SALIDA
tableCatDetSalidasEstable = $("#tableCatDetSalidasEstable").DataTable({
  order: [[0, "desc"]],
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
      return $.extend(d, dataTableCatDetSalidasEstable);
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
      data: "id_salida",
      title: "ID Detalle de Salida",
      visible: false,
    },
    {
      data: "fecha_salida",
      title: "Fecha de Salida",
      render: function (data) {
        if (!data || data === "0000-00-00" || data === "0000-00-00 00:00:00")
          return "-";
        return data ? moment(data).format("DD/MM/YYYY HH:mm") : "-";
      },
    },
    {
      data: "fecha_requerida",
      title: "Fecha Requerida",
      render: function (data) {
        if (!data || data === "0000-00-00" || data === "0000-00-00 00:00:00")
          return "-";
        return data ? moment(data).format("DD/MM/YYYY") : "-";
      },
    },
    {
      data: "CANTIDAD_SALIDA",
      title: "Cantidad Salida",
      className: "text-center",
      render: function (data) {
        return data ? data : "-";
      },
    },
    {
      data: "costo_unitario_salida",
      title: "Costo Unitario",
      render: function (data) {
        return data ? data : "-";
      },
      visible: false,
    },
    {
      data: "PROVEEDOR_NOMBRE",
      title: "Proveedor",
      render: function (data) {
        return data ? data : "-";
      },
    },
    {
      data: "ID_PROVEEDORES",
      title: "ID Proveedor",
      visible: false,
    },
    {
      data: "NUMERO_DOCUMENTO",
      title: "Factura",
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
      data: "RESPONSABLE_NOMBRE",
      title: "Responsable",
      render: function (data) {
        return data ? data : "-";
      },
    },
    {
      data: "MOTIVO_DESCRIPCION",
      title: "Motivo",
      render: function (data) {
        return data ? data : "-";
      },
    },
    {
      data: "ID_MOTIVO",
      title: "ID Motivo",
      visible: false,
    },
    // {
    //   data: "orden_compra_numero",
    //   title: "Orden de Compra",
    //   render: function (data) {
    //     return data ? data : "-";
    //   },
    // },
    {
      data: "ORDEN_COMPRA_DOCUMENTO",
      title: "Orden de Compra",
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
              '" alt="Imagen de la orden de compra" style="width: 50px; height: auto;"/></a>'
            );
          }
        } else {
          return "-";
        }
      },
    },
    {
      data: "observaciones",
      title: "Observaciones",
      render: function (data) {
        return data ? data : "-";
      },
    },
    {
      data: "NOMBRE_COMERCIAL",
      title: "Artículo",
      render: function (data) {
        return data ? data : "-";
      },
      visible: false,
    },
    {
      data: "CLAVE_ART",
      title: "Clave",
      render: function (data) {
        return data ? data : "-";
      },
      visible: false,
    },
    {
      data: "ID_ARTICULO",
      title: "ID Artículo",
      visible: false,
    },
    {
      data: "NUMERO_LOTE",
      title: "Lote",
      render: function (data) {
        return data ? data : "-";
      },
      visible: false,
    },
    {
      data: "FECHA_CADUCIDAD",
      title: "Caducidad",
      render: function (data) {
        return data ? data : "-";
      },
      visible: false,
    },
    {
      data: null,
      title: "Acciones",
      render: function (data, type, row) {
        if (row.MOTIVO !== "Por orden de compra") {
          return `
          <button
          data-id-entrada="${row.id_entrada}"
          data-id-articulo="${row.ID_ARTICULO}"
          data-articulo="${row.NOMBRE_COMERCIAL}"
          data-clave="${row.CLAVE_ART}"
          data-numero-factura="${row.FACTURA_NUM}"
          data-documento-factura="${row.FACTURA_IMG}"
          data-proveedor="${row.PROVEEDOR}"
          data-id-proveedor="${row.id_proveedores}"
          data-fecha-entrada="${row.fecha_entrada}"
          data-fecha-compra="${row.fecha_compra}"
          data-lote="${row.NUMERO_LOTE}"
          data-fecha-caducidad="${row.FECHA_CADUCIDAD}"
          data-cantidad="${row.CANTIDAD_ENTRADA}"
          data-precio-unitario="${row.costo_unitario}"
          data-motivo="${row.MOTIVO}"
          data-id-motivo="${row.id_motivo}"
          data-observaciones="${row.observaciones}"
          type="button" class="btn btn-warning btn-sm btn-editar-entrada" data-bs-toggle="tooltip" title="Editar entrada"><i class="bi bi-pencil-square"></i></button>
          `;
        } else {
          return "-";
        }
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
        data: "id_proveedor",
        title: "ID Proveedor",
        visible: false,
      },
      {
        data: "ID_ARTICULO",
        title: "ID Artículo",
        visible: false,
      },
      {
        data: "ID_ORDEN_COMPRA",
        title: "ID Orden de Compra",
        visible: false,
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
        title: "Cantidad Solicitada",
        className: "text-center",
        render: function (data) {
          return data ? data : "-";
        },
      },
      {
        data: "cantidad_recibida",
        title: "Cantidad Recibida",
        render: function (data) {
          return data ? data : "-";
        },
      },
      {
        data: "CANTIDAD_A_SURTIR",
        title: "Cantidad a Surtir",
        render: function (data, type, row) {
          if (row.cantidad_recibida === row.cantidad_solicitada) {
            return "-";
          } else {
            return row.cantidad_solicitada - row.cantidad_recibida || 0;
          }
        },
      },
      // {
      //   data: "PRECIO_UNITARIO_ODC",
      //   title: "Precio Unitario",
      //   render: function (data) {
      //     return data ? `$${parseFloat(data).toFixed(2)}` : "-";
      //   },
      // },
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
          if (
            row.cantidad_recibida === row.cantidad_solicitada &&
            row.cantidad_recibida >= row.cantidad_solicitada
          ) {
            return `<button type="button" class="btn btn-success btn-sm" disabled><i class="bi bi-check-circle-fill"></i> Completado</button>`;
          } else {
            return `
            <button 
            data-nombre-articulo="${row.ARTICULO_NOMBRE}" 
            data-clave-articulo="${row.ARTICULO_CLAVE}" 
            data-id-orden-compra="${row.ID_ORDEN_COMPRA}"
            data-id-articulo="${row.ID_ARTICULO}"
            data-cantidad-solicitada="${row.cantidad_solicitada}"
            data-cantidad-recibida="${row.cantidad_recibida}"
            data-id-proveedor="${row.id_proveedor}"
            data-proveedor="${row.PROVEEDOR_NOMBRE}"
            type="button" class="btn btn-warning btn-sm btn-surtir-orden-compra" data-bs-toggle="tooltip" title="Surtir orden de compra"><i class="bi bi-box-seam"></i></button>
        `;
          }
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
      // {
      //   text: '<i class="bi bi-box-seam"></i> Ingresar todo',
      //   className: "btn btn-success",
      //   action: function () {
      //     $("#surtirOrdenCompraModal").modal("show");
      //   },
      // },
    ],
  }
);

$(document).on("click", ".btn-surtir-orden-compra", function () {
  var nombreArticulo = $(this).data("nombre-articulo");
  var claveArticulo = $(this).data("clave-articulo");
  var cantidadSolicitada = $(this).data("cantidad-solicitada");
  var cantidadRecibida = $(this).data("cantidad-recibida") || "-";
  var idArticulo = $(this).data("id-articulo");
  var idOrdenCompra = $(this).data("id-orden-compra");
  var idProveedor = $(this).data("id-proveedor");
  var proveedor = $(this).data("proveedor");
  $("#nombreArticuloSurtirOC").text(nombreArticulo);
  $("#nombreArticuloSurtirOCInput").val(nombreArticulo);
  $("#claveArticuloSurtirOC").val(claveArticulo);
  $("#cantidadOrdenadaSurtirOC").val(cantidadSolicitada);
  $("#cantidadRecibidaSurtirOC").val(cantidadRecibida);
  $("#idArticuloSurtirOC").val(idArticulo);
  $("#idOrdenCompraSurtirOC").val(idOrdenCompra);
  $("#idProveedorSurtirOC").val(proveedor);
  $("#id_proveedor_surtir_oc").val(idProveedor);
  $("#surtirOrdenCompraIndividualModal").modal("show");
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
  },
  columns: [
    {
      data: "CLAVE_ART",
      title: "Clave",
      render: function (data) {
        return data ? data : "-";
      },
    },
    {
      data: "NOMBRE_COMERCIAL",
      title: "Nombre",
      render: function (data) {
        return data ? data : "-";
      },
    },
    {
      data: "CANTIDAD",
      title: "Cantidad",
      render: function (data) {
        return data ? data : "-";
      },
    },
    {
      data: "FECHA_TRANSACCION",
      title: "Fecha",
      render: function (data) {
        return data ? data : "-";
      },
    },
    {
      data: "COSTO_ULTIMA_TRANSACCION",
      title: "Costo Unitario",
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
      data: "RESPONSABLE",
      title: "Responsable",
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
      data: "IMAGEN_DOCUMENTO",
      title: "Documento o factura",
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
    },
    {
      data: "MOTIVO_ENTRADA",
      title: "Motivo",
      render: function (data) {
        return data ? data : "-";
      },
    },
    {
      data: "ORDEN_COMPRA",
      title: "Número de orden",
      render: function (data) {
        return data ? data : "-";
      },
    },
    {
      data: "IMAGEN_ORDEN_COMPRA",
      title: "Documento de orden de compra",
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
    },
  ],
  dom: 'Bl<"dataTables_toolbar">frtip',
  buttons: [],
});

// ESTILOS PARA LA BARRA DE BUSQUEDA DE ENTRADAS
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
            item.estado == "aprobada" ||
            item.ESTADO == "aprobada" ||
            item.ESTADO == "parcial";
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
  cargarCatalogoEnSelect(
    "#registrarEntradaEstableModal #proveedorEstable, #editarEntradaEstableModal #proveedorEstableEditar",
    {
      api: 16,
      campoId: "id_proveedores",
      campoTexto: "nombre",
      placeholder: "Seleccione un proveedor",
      soloActivos: true,
      soloAprobadas: false,
    }
  );
}

function cargarMotivosEstable() {
  cargarCatalogoEnSelect(
    "#registrarEntradaEstableModal #motivoEntradaEstable, #editarEntradaEstableModal #motivoEntradaEstableEditar",
    {
      api: 15,
      campoId: "id_motivos",
      campoTexto: "descripcion",
      placeholder: "Seleccione un motivo",
      soloActivos: true,
      soloAprobadas: false,
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
