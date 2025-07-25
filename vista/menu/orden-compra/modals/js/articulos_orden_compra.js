// ============================================
// GESTIÓN DE ARTÍCULOS EN ÓRDENES DE COMPRA
// ============================================

// Variables globales
let articulosDisponibles = [];
let articulosOrdenCompra = [];
let contadorArticulos = 0;

// ============================================
// INICIALIZACIÓN
// ============================================

$(document).ready(function () {
  console.log('🚀 Iniciando sistema de artículos para órdenes de compra');
  
  // Verificar que los elementos existen
  if ($('#registrarOrdenCompraModal').length === 0) {
    console.error('❌ Modal #registrarOrdenCompraModal no encontrado');
  } else {
    console.log('✅ Modal #registrarOrdenCompraModal encontrado');
  }
  
  if ($('#btnAgregarArticulo').length === 0) {
    console.error('❌ Botón #btnAgregarArticulo no encontrado');
  } else {
    console.log('✅ Botón #btnAgregarArticulo encontrado');
  }

  // Inicializar eventos cuando se abra el modal principal
  $('#registrarOrdenCompraModal').on('shown.bs.modal', function () {
    console.log('📱 Modal de orden de compra abierto, inicializando artículos');
    inicializarArticulosOrdenCompra();
  });

  // Eventos del botón "Agregar Artículo" - usando delegación de eventos
  $(document).on('click', '#btnAgregarArticulo', function () {
    console.log('🔘 Botón Agregar Artículo clickeado');
    abrirModalSeleccionarArticulo();
  });
  
  // También registrar directamente (backup)
  $('#btnAgregarArticulo').on('click', function () {
    console.log('🔘 Botón Agregar Artículo clickeado (directo)');
    abrirModalSeleccionarArticulo();
  });

  // Eventos de búsqueda y filtros en el modal de selección
  $('#buscarArticulo').on('input', filtrarArticulosDisponibles);
  $('#filtroStock').on('change', filtrarArticulosDisponibles);
  $('#btnLimpiarFiltros').on('click', limpiarFiltrosArticulos);

  // Eventos del modal de configuración de artículo
  $('#btnConfirmarArticuloOrden').on('click', confirmarAgregarArticulo);

  // Eventos del modal de edición de artículo
  $('#btnConfirmarEdicionOrden').on('click', confirmarEditarArticulo);
});

// ============================================
// FUNCIONES PRINCIPALES
// ============================================

function inicializarArticulosOrdenCompra() {
  articulosOrdenCompra = [];
  contadorArticulos = 0;
  actualizarTablaArticulosOrden();
  actualizarContadorArticulos();
}

function abrirModalSeleccionarArticulo() {
  console.log('🎯 Ejecutando abrirModalSeleccionarArticulo');
  
  // Verificar que el modal existe
  if ($('#seleccionarArticuloModal').length === 0) {
    console.error('❌ Modal #seleccionarArticuloModal no encontrado');
    alert('Error: No se encontró el modal de selección de artículos');
    return;
  }
  
  console.log('✅ Modal de selección encontrado, abriendo...');
  
  // Mostrar modal y cargar artículos
  $('#seleccionarArticuloModal').modal('show');
  cargarArticulosDisponibles();
}

function cargarArticulosDisponibles() {
  console.log('📦 Cargando artículos disponibles...');
  
  // Mostrar loading
  $('#filaLoadingArticulos').show();
  
  $.ajax({
    url: '../../../api/orden_compra_api.php',
    type: 'POST',
    dataType: 'json',
    data: {
      api: 7,
      id_almacen: 1 // Por ahora fijo en almacén BIMO
    },
    success: function (response) {
      console.log('📥 Respuesta del servidor:', response);
      
      if (response.response && response.response.data) {
        articulosDisponibles = response.response.data;
        console.log(`✅ ${articulosDisponibles.length} artículos cargados`);
        mostrarArticulosDisponibles();
      } else {
        console.error('❌ Respuesta del servidor sin datos:', response);
        alertToast('No se pudieron cargar los artículos', 'error', 3000);
      }
    },
    error: function (xhr, status, error) {
      console.error('❌ Error AJAX al cargar artículos:', {xhr, status, error});
      alertToast('Error al cargar artículos disponibles', 'error', 3000);
    },
    complete: function () {
      $('#filaLoadingArticulos').hide();
    }
  });
}

function mostrarArticulosDisponibles() {
  const tbody = $('#tablaSeleccionArticulos tbody');
  tbody.empty();

  if (articulosDisponibles.length === 0) {
    tbody.append(`
      <tr>
        <td colspan="8" class="text-center text-muted">
          <i class="bi bi-inbox"></i><br />
          No hay artículos disponibles con proveedores asignados
        </td>
      </tr>
    `);
    return;
  }

  articulosDisponibles.forEach(function (articulo) {
    // Determinar clase de stock
    let stockClass = 'text-success';
    let stockIcon = 'bi-check-circle';
    
    if (parseFloat(articulo.CANTIDAD_ACTUAL) === 0) {
      stockClass = 'text-danger';
      stockIcon = 'bi-x-circle';
    } else if (parseFloat(articulo.CANTIDAD_ACTUAL) <= parseFloat(articulo.CANTIDAD_MINIMA)) {
      stockClass = 'text-warning';
      stockIcon = 'bi-exclamation-triangle';
    }

    // Procesar proveedores para mostrar
    let proveedoresDisplay = articulo.PROVEEDORES_DISPLAY || 'Sin proveedores';
    if (proveedoresDisplay.includes('★')) {
      proveedoresDisplay = proveedoresDisplay.replace(/★/g, '<i class="bi bi-star-fill text-warning"></i>');
    }

    const fila = `
      <tr data-articulo-id="${articulo.ID_ARTICULO}">
        <td><span class="badge bg-light text-dark">${articulo.CLAVE_ART}</span></td>
        <td>
          <div class="fw-semibold">${articulo.NOMBRE_COMERCIAL}</div>
          <small class="text-muted">${articulo.TIPO_ARTICULO || 'Sin tipo'}</small>
        </td>
        <td>${articulo.MARCA || 'Sin marca'}</td>
        <td>
          <div class="${stockClass}">
            <i class="bi ${stockIcon}"></i> ${parseFloat(articulo.CANTIDAD_ACTUAL).toFixed(2)}
          </div>
        </td>
        <td>${articulo.UNIDAD_DESCRIPCION || 'N/A'}</td>
        <td>
          <small class="text-muted">
            Min: ${parseFloat(articulo.CANTIDAD_MINIMA).toFixed(2)}<br>
            Max: ${parseFloat(articulo.CANTIDAD_MAXIMA).toFixed(2)}
          </small>
        </td>
        <td>
          <div class="small">${proveedoresDisplay}</div>
        </td>
        <td>
          <button class="btn btn-sm btn-primary btn-seleccionar-articulo" 
                  data-articulo='${JSON.stringify(articulo).replace(/'/g, "&#39;")}'>
            <i class="bi bi-plus-circle"></i> Seleccionar
          </button>
        </td>
      </tr>
    `;
    tbody.append(fila);
  });

  // Agregar eventos a los botones de selección
  $('.btn-seleccionar-articulo').on('click', function () {
    const articuloData = JSON.parse($(this).attr('data-articulo').replace(/&#39;/g, "'"));
    seleccionarArticuloParaOrden(articuloData);
  });
}

function seleccionarArticuloParaOrden(articulo) {
  // Verificar si el artículo ya está en la orden
  const yaExiste = articulosOrdenCompra.some(item => item.id_articulo === articulo.ID_ARTICULO);
  
  if (yaExiste) {
    alertToast('Este artículo ya está agregado a la orden', 'warning', 3000);
    return;
  }

  // Cerrar modal de selección y abrir modal de configuración
  $('#seleccionarArticuloModal').modal('hide');
  
  // Llenar datos del modal de configuración
  llenarModalConfiguracion(articulo);
  
  // Mostrar modal de configuración
  $('#configurarArticuloOrdenModal').modal('show');
}

function llenarModalConfiguracion(articulo) {
  // Guardar información del artículo
  $('#configurarArticuloId').val(articulo.ID_ARTICULO);
  $('#configurarArticuloJson').val(JSON.stringify(articulo));
  
  // Llenar información del artículo
  $('#configurarArticuloClave').text(articulo.CLAVE_ART);
  $('#configurarArticuloNombre').text(articulo.NOMBRE_COMERCIAL);
  $('#configurarArticuloStock').text(parseFloat(articulo.CANTIDAD_ACTUAL).toFixed(2));
  $('#configurarArticuloUnidad').text(articulo.UNIDAD_DESCRIPCION || 'N/A');
  $('#configurarUnidadSpan').text(articulo.UNIDAD_DESCRIPCION || 'Unidad');

  // Llenar select de proveedores
  const selectProveedor = $('#configurarProveedor');
  selectProveedor.empty().append('<option value="">Seleccione un proveedor</option>');
  
  try {
    const proveedores = JSON.parse(articulo.PROVEEDORES_JSON || '[]');
    proveedores.forEach(function (proveedor) {
      const esPrincipal = proveedor.es_principal == 1 ? ' ★' : '';
      selectProveedor.append(`
        <option value="${proveedor.id}" ${proveedor.es_principal == 1 ? 'selected' : ''}>
          ${proveedor.nombre}${esPrincipal}
        </option>
      `);
    });
  } catch (e) {
    console.error('Error al procesar proveedores:', e);
  }

  // Limpiar campos
  $('#configurarCantidad').val('');
  $('#configurarObservaciones').val('');
}


function confirmarAgregarArticulo() {
  // Validar campos obligatorios
  const cantidad = parseFloat($('#configurarCantidad').val());
  const idProveedor = $('#configurarProveedor').val();
  
  if (!cantidad || cantidad <= 0) {
    alertToast('La cantidad debe ser mayor a 0', 'warning', 3000);
    $('#configurarCantidad').focus();
    return;
  }
  
  if (!idProveedor) {
    alertToast('Debe seleccionar un proveedor', 'warning', 3000);
    $('#configurarProveedor').focus();
    return;
  }

  // Obtener datos del artículo
  const articuloData = JSON.parse($('#configurarArticuloJson').val());
  const observaciones = $('#configurarObservaciones').val();
  
  // Obtener nombre del proveedor seleccionado
  const nombreProveedor = $('#configurarProveedor option:selected').text();

  // Crear objeto del artículo para la orden
  const articuloOrden = {
    id_articulo: articuloData.ID_ARTICULO,
    clave_articulo: articuloData.CLAVE_ART,
    nombre_articulo: articuloData.NOMBRE_COMERCIAL,
    unidad: articuloData.UNIDAD_DESCRIPCION || 'N/A',
    cantidad_actual: parseFloat(articuloData.CANTIDAD_ACTUAL),
    id_proveedor: idProveedor,
    nombre_proveedor: nombreProveedor.replace(' ★', ''),
    cantidad_solicitada: cantidad,
    observaciones_detalle: observaciones,
    indice: contadorArticulos++
  };

  // Agregar a la lista
  articulosOrdenCompra.push(articuloOrden);
  
  // Actualizar tabla y contadores
  actualizarTablaArticulosOrden();
  actualizarContadorArticulos();
  
  // Cerrar modal
  $('#configurarArticuloOrdenModal').modal('hide');
  
  alertToast('Artículo agregado a la orden correctamente', 'success', 3000);
}

function actualizarTablaArticulosOrden() {
  const tbody = $('#tablaArticulosRequisicion tbody');
  tbody.empty();

  if (articulosOrdenCompra.length === 0) {
    tbody.append(`
      <tr id="filaVaciaArticulos">
        <td colspan="4" class="text-center text-muted">
          <i class="bi bi-inbox"></i><br />
          No hay artículos agregados
        </td>
      </tr>
    `);
    return;
  }

  articulosOrdenCompra.forEach(function (articulo, index) {
    const fila = `
      <tr data-indice="${index}">
        <td>
          <div class="fw-semibold">${articulo.nombre_articulo}</div>
          <small class="text-muted">
            <i class="bi bi-tag"></i> ${articulo.clave_articulo} | 
            <i class="bi bi-building"></i> ${articulo.nombre_proveedor}
          </small>
          <br>
          <small class="text-info">Stock actual: ${articulo.cantidad_actual.toFixed(2)} ${articulo.unidad}</small>
        </td>
        <td>
          <div class="text-center">
            <span class="fw-semibold">${articulo.cantidad_solicitada.toFixed(2)}</span>
            <br>
            <small class="text-muted">${articulo.unidad}</small>
          </div>
        </td>
        <td>
          ${articulo.observaciones_detalle ? 
            `<small class="text-muted">${articulo.observaciones_detalle}</small>` : 
            '<small class="text-muted">Sin observaciones</small>'
          }
        </td>
        <td>
          <div class="btn-group-vertical" role="group">
            <button type="button" class="btn btn-sm btn-outline-warning btn-editar-articulo" 
                    data-indice="${index}">
              <i class="bi bi-pencil"></i>
            </button>
            <button type="button" class="btn btn-sm btn-outline-danger btn-quitar-articulo" 
                    data-indice="${index}">
              <i class="bi bi-trash"></i>
            </button>
          </div>
        </td>
      </tr>
    `;
    tbody.append(fila);
  });

  // Agregar eventos a los botones
  $('.btn-editar-articulo').on('click', function () {
    const indice = parseInt($(this).data('indice'));
    editarArticuloOrden(indice);
  });

  $('.btn-quitar-articulo').on('click', function () {
    const indice = parseInt($(this).data('indice'));
    quitarArticuloOrden(indice);
  });
}

function actualizarContadorArticulos() {
  $('#contadorArticulos').text(`${articulosOrdenCompra.length} artículo${articulosOrdenCompra.length !== 1 ? 's' : ''}`);
}


function editarArticuloOrden(indice) {
  const articulo = articulosOrdenCompra[indice];
  
  // Llenar datos del modal de edición
  $('#editarArticuloId').val(articulo.id_articulo);
  $('#editarIndiceTabla').val(indice);
  $('#editarArticuloNombre').text(articulo.nombre_articulo);
  $('#editarArticuloStock').text(`${articulo.cantidad_actual.toFixed(2)} ${articulo.unidad}`);
  
  // Llenar campos actuales
  $('#editarCantidad').val(articulo.cantidad_solicitada);
  $('#editarObservaciones').val(articulo.observaciones_detalle);
  
  // Llenar select de proveedores (necesitamos obtener los proveedores del artículo original)
  cargarProveedoresParaEdicion(articulo.id_articulo, articulo.id_proveedor);
  
  // Mostrar modal
  $('#editarArticuloOrdenModal').modal('show');
}

function cargarProveedoresParaEdicion(idArticulo, idProveedorSeleccionado) {
  // Buscar el artículo en los disponibles para obtener sus proveedores
  const articuloOriginal = articulosDisponibles.find(art => art.ID_ARTICULO == idArticulo);
  
  const selectProveedor = $('#editarProveedor');
  selectProveedor.empty().append('<option value="">Seleccione un proveedor</option>');
  
  if (articuloOriginal && articuloOriginal.PROVEEDORES_JSON) {
    try {
      const proveedores = JSON.parse(articuloOriginal.PROVEEDORES_JSON);
      proveedores.forEach(function (proveedor) {
        const esPrincipal = proveedor.es_principal == 1 ? ' ★' : '';
        const isSelected = proveedor.id == idProveedorSeleccionado ? 'selected' : '';
        selectProveedor.append(`
          <option value="${proveedor.id}" ${isSelected}>
            ${proveedor.nombre}${esPrincipal}
          </option>
        `);
      });
    } catch (e) {
      console.error('Error al procesar proveedores para edición:', e);
    }
  }
}

function confirmarEditarArticulo() {
  const indice = parseInt($('#editarIndiceTabla').val());
  const cantidad = parseFloat($('#editarCantidad').val());
  const idProveedor = $('#editarProveedor').val();
  
  if (!cantidad || cantidad <= 0) {
    alertToast('La cantidad debe ser mayor a 0', 'warning', 3000);
    $('#editarCantidad').focus();
    return;
  }
  
  if (!idProveedor) {
    alertToast('Debe seleccionar un proveedor', 'warning', 3000);
    $('#editarProveedor').focus();
    return;
  }

  // Actualizar datos del artículo
  const observaciones = $('#editarObservaciones').val();
  const nombreProveedor = $('#editarProveedor option:selected').text();

  articulosOrdenCompra[indice].id_proveedor = idProveedor;
  articulosOrdenCompra[indice].nombre_proveedor = nombreProveedor.replace(' ★', '');
  articulosOrdenCompra[indice].cantidad_solicitada = cantidad;
  articulosOrdenCompra[indice].observaciones_detalle = observaciones;
  
  // Actualizar tabla y totales
  actualizarTablaArticulosOrden();
  
  // Cerrar modal
  $('#editarArticuloOrdenModal').modal('hide');
  
  alertToast('Artículo actualizado correctamente', 'success', 3000);
}

function quitarArticuloOrden(indice) {
  const articulo = articulosOrdenCompra[indice];
  
  alertMensajeConfirm(
    {
      title: '¿Quitar artículo?',
      text: `¿Está seguro de quitar "${articulo.nombre_articulo}" de la orden?`,
      icon: 'warning'
    },
    function () {
      articulosOrdenCompra.splice(indice, 1);
      actualizarTablaArticulosOrden();
      actualizarContadorArticulos();
      alertToast('Artículo quitado de la orden', 'info', 3000);
    }
  );
}

// ============================================
// FUNCIONES DE FILTRADO
// ============================================

function filtrarArticulosDisponibles() {
  const textoBusqueda = $('#buscarArticulo').val().toLowerCase();
  const filtroStock = $('#filtroStock').val();
  
  $('#tablaSeleccionArticulos tbody tr').each(function () {
    const fila = $(this);
    const idArticulo = fila.data('articulo-id');
    
    if (!idArticulo) return; // Skip non-data rows
    
    // Buscar artículo correspondiente
    const articulo = articulosDisponibles.find(art => art.ID_ARTICULO == idArticulo);
    if (!articulo) return;
    
    let mostrar = true;
    
    // Filtro por texto
    if (textoBusqueda) {
      const textoFila = (
        articulo.CLAVE_ART + ' ' +
        articulo.NOMBRE_COMERCIAL + ' ' +
        (articulo.MARCA || '') + ' ' +
        (articulo.PROVEEDORES_DISPLAY || '')
      ).toLowerCase();
      
      mostrar = mostrar && textoFila.includes(textoBusqueda);
    }
    
    // Filtro por stock
    if (filtroStock && mostrar) {
      const cantidadActual = parseFloat(articulo.CANTIDAD_ACTUAL);
      const cantidadMinima = parseFloat(articulo.CANTIDAD_MINIMA);
      
      switch (filtroStock) {
        case 'disponible':
          mostrar = cantidadActual > 0;
          break;
        case 'minimo':
          mostrar = cantidadActual > 0 && cantidadActual <= cantidadMinima;
          break;
        case 'agotado':
          mostrar = cantidadActual === 0;
          break;
      }
    }
    
    fila.toggle(mostrar);
  });
}

function limpiarFiltrosArticulos() {
  $('#buscarArticulo').val('');
  $('#filtroStock').val('');
  filtrarArticulosDisponibles();
}

// ============================================
// FUNCIONES DE EXPORTACIÓN PARA USO EXTERNO
// ============================================

// Función para obtener los artículos de la orden (para usar al guardar)
function obtenerArticulosOrdenJSON() {
  return JSON.stringify(articulosOrdenCompra.map(function (articulo) {
    return {
      id_articulo: articulo.id_articulo,
      id_proveedor: articulo.id_proveedor,
      codigo_articulo: articulo.clave_articulo,
      descripcion_articulo: articulo.nombre_articulo,
      cantidad_solicitada: articulo.cantidad_solicitada,
      observaciones_detalle: articulo.observaciones_detalle
    };
  }));
}

// Exponer funciones globalmente
window.obtenerArticulosOrdenJSON = obtenerArticulosOrdenJSON;
window.inicializarArticulosOrdenCompra = inicializarArticulosOrdenCompra; 