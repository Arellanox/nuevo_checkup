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
      data: "ID_ENTRADA",
      title: "ID",
      width: "50px",
    },
    {
      data: "FECHA_ENTRADA",
      title: "Fecha de Entrada",
      render: function (data) {
        return data ? moment(data).format("DD/MM/YYYY HH:mm") : "-";
      },
    },
    {
      data: "NOMBRE_COMERCIAL",
      title: "Artículo",
      render: function (data, type, row) {
        return `<strong>${data}</strong><br><small class="text-muted">Clave: ${
          row.CLAVE_ART || "-"
        }</small>`;
      },
    },
    {
      data: "CANTIDAD",
      title: "Cantidad Ingresada",
      className: "text-center",
      render: function (data, type, row) {
        const unidad = row.UNIDAD_MEDIDA || "unid";
        return `<span class="badge bg-primary">${data} ${unidad}</span>`;
      },
    },
    {
      data: "COSTO_UNITARIO",
      title: "Costo Unitario",
      className: "text-end",
      render: function (data) {
        return data ? `$${parseFloat(data).toFixed(2)}` : "$0.00";
      },
    },
    {
      data: "COSTO_TOTAL",
      title: "Costo Total",
      className: "text-end",
      render: function (data) {
        return data
          ? `<strong>$${parseFloat(data).toFixed(2)}</strong>`
          : "$0.00";
      },
    },
    {
      data: "PROVEEDOR_NOMBRE",
      title: "Proveedor",
      render: function (data) {
        return data || "Sin proveedor";
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
      visible: false,
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
      data: "DOCUMENTO_FACTURA",
      title: "Factura",
      render: function (data) {
        return data
          ? '<i class="bi bi-receipt text-primary" title="Factura"></i>'
          : "-";
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
      data: "ESTADO_CADUCIDAD",
      title: "Estado Caducidad",
      render: function (data) {
        return data || "-";
      },
    },
    // Puedes agregar más columnas si necesitas mostrar más campos del SP
    {
      data: null,
      title: "Acciones",
      orderable: false,
      className: "text-center",
      width: "120px",
      render: function (data, type, row) {
        return `
                <button class="btn btn-sm btn-info btn-ver-entrada" 
                    data-id="${row.ID_ENTRADA}" title="Ver detalles">
                    <i class="bi bi-eye"></i>
                </button>
                <button class="btn btn-sm btn-warning btn-editar-entrada" 
                    data-id="${row.ID_ENTRADA}" title="Editar entrada">
                    <i class="bi bi-pencil"></i>
                </button>
                <button class="btn btn-sm btn-danger btn-anular-entrada" 
                    data-id="${row.ID_ENTRADA}" title="Anular entrada">
                    <i class="bi bi-x-lg"></i>
                </button>
            `;
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
        $("#entradaConOrdenModal").modal("show");
      },
    },
  ],
  select: {
    style: "single",
  },
});

$("#tableCatEntradasEstable tbody").on("click", "tr", function () {
  $("#tableCatEntradasEstable tbody tr.selected").removeClass("selected");
  $(this).addClass("selected");
  rowSelected = tableCatEntradasEstable.row(this).data();
});

// ESTILOS PARA LA BARRA DE BUSQUEDA DE PROVEEDORES
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

// ==================== FUNCIONALIDADES PARA CARGAR CATÁLOGOS ====================
function cargarCatalogoEnSelect(selectorSelect, opciones, callback) {
  const config = {
    soloActivos: true,
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
          if (!config.soloActivos || esActivo) {
            selectElement.append(
              `<option value="${item[config.campoId]}">${
                item[config.campoTexto]
              }</option>`
            );
            totalElementos++;
          }
        });

        if (valorActual) selectElement.val(valorActual);

        console.log(
          `✅ Catálogo cargado: ${totalElementos} elementos en ${selectorSelect}`
        );

        if (callback && typeof callback === "function") callback();
      } else {
        alertToast(`Error al cargar ${config.placeholder}`, "error", 3000);
        console.error("Error en respuesta API:", response);
      }
    },

    error: function (xhr, status, error) {
      alertToast(
        `Error de conexión al cargar ${config.placeholder}`,
        "error",
        3000
      );
      console.error("Error AJAX:", { xhr, status, error });
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
  cargarCatalogoEnSelect("#registrarEntradaEstableModal #motivoEntradaEstable", {
    api: 15,
    campoId: "id_motivos",
    campoTexto: "descripcion",
    placeholder: "Seleccione un motivo",
    soloActivos: true,
  });
}

cargarProveedoresEstable();
cargarMotivosEstable();