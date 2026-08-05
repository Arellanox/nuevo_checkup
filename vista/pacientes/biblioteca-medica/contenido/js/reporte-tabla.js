let solicitudBiblioteca = null;
let estudiosBiblioteca = [];

function valorEstudio(estudio, campos) {
  for (const campo of campos) {
    const valor = estudio[campo];
    if (valor !== null && valor !== undefined && String(valor).trim() !== '') return valor;
  }
  return null;
}

function textoSeguro(valor, reemplazo = 'No disponible') {
  if (valor === null || valor === undefined || String(valor).trim() === '') return reemplazo;
  return $('<div>').text(valor).html();
}

function datoFicha(etiqueta, valor, icono) {
  if (valor === null) return '';
  return `
    <div class="col-sm-6 col-lg-3">
      <div class="biblioteca-medica__dato">
        <small><i class="bi ${icono} me-1"></i>${etiqueta}</small>
        <span>${textoSeguro(valor)}</span>
      </div>
    </div>`;
}

function bloqueTecnico(titulo, icono, contenido) {
  if (contenido === null) return '';
  return `
    <details class="biblioteca-medica__tecnico p-3">
      <summary><i class="bi ${icono} me-2"></i>${titulo}</summary>
      <p class="small mb-0 mt-2">${textoSeguro(contenido)}</p>
    </details>`;
}

function bloqueEstudiosIncluidos(idServicio, esGrupo) {
  if (String(esGrupo) !== '1' || idServicio === null) return '';

  return `
    <details class="biblioteca-medica__grupo p-3" data-id-servicio="${textoSeguro(idServicio)}" data-cargado="0">
      <summary><i class="bi bi-collection me-2"></i>Contenido de este perfil</summary>
      <div class="biblioteca-medica__estudios-incluidos mt-3 small" aria-live="polite"></div>
    </details>`;
}

function tarjetaEstudio(estudio, indice) {
  const id = valorEstudio(estudio, ['ID_SERVICIO', 'ID_ESTUDIO', 'CLAVE']);
  const servicio = valorEstudio(estudio, ['SERVICIO', 'DESCRIPCION', 'NOMBRE_ESTUDIO']);
  const area = valorEstudio(estudio, ['AREA', 'NOMBRE_AREA']);
  const clasificacion = valorEstudio(estudio, ['CLASIFICACION']);
  const medida = valorEstudio(estudio, ['MEDIDA']);
  const abreviatura = valorEstudio(estudio, ['ABREVIATURA']);
  const esGrupo = valorEstudio(estudio, ['ES_GRUPO']);
  const entrega = valorEstudio(estudio, ['DIAS_DE_ENTREGA']);
  const muestra = valorEstudio(estudio, ['MUESTRA', 'TIPO_MUESTRA']);
  const contenedor = valorEstudio(estudio, ['CONTENEDOR']);
  const metodologia = valorEstudio(estudio, ['METODOLOGIA_NOMBRE', 'METODOLOGIA']);
  const conservacion = valorEstudio(estudio, ['CONSERVACION']);
  const detalle = valorEstudio(estudio, ['DETALLE_SERVICIO']);
  const indicaciones = valorEstudio(estudio, ['INDICACIONES']);
  const indicacionesLaboratorio = valorEstudio(estudio, ['INDICACIONES_LABORATORIO']);
  const motivoRechazo = valorEstudio(estudio, ['MOTIVO_RECHAZO']);
  const tipoEstudio = String(esGrupo) === '1' ? 'Grupo / perfil' : 'Estudio individual';

  return `
    <div class="col-12">
      <article class="card biblioteca-medica__card">
        <div class="biblioteca-medica__resultado" data-estudio-index="${indice}">
          <div class="biblioteca-medica__resultado-header biblioteca-medica__encabezado p-3 p-md-4 d-flex align-items-center gap-3" role="button" tabindex="0" aria-label="Abrir detalle del estudio">
            <div class="biblioteca-medica__resultado-resumen flex-grow-1">
              <div class="d-flex flex-wrap justify-content-between align-items-start gap-2 mb-1">
                <span class="biblioteca-medica__codigo">ID ${textoSeguro(id, 'SIN ID')}</span>
                <div class="d-flex flex-wrap gap-2">
                  <span class="badge text-bg-light">${textoSeguro(area, 'Bimo')}</span>
                  <span class="badge text-bg-light">${textoSeguro(tipoEstudio)}</span>
                </div>
              </div>
              <h2 class="h5 fw-bold mb-1">${textoSeguro(servicio, 'Estudio Bimo')}</h2>
              <span class="biblioteca-medica__resultado-titulo">${textoSeguro(clasificacion, 'Catálogo Bimo')} · Entrega: ${textoSeguro(entrega, 'por confirmar')}</span>
            </div>
          </div>
        </div>
      </article>
    </div>`;
}

function cargarEstudiosIncluidos($grupo) {
  const idServicio = $grupo.data('id-servicio');
  const $contenedor = $grupo.find('.biblioteca-medica__estudios-incluidos');

  if ($grupo.data('cargado') || !idServicio) return;

  $grupo.data('cargado', 1);
  $contenedor.html('<div class="text-muted"><span class="spinner-border spinner-border-sm me-2" role="status"></span>Consultando estudios incluidos…</div>');

  $.ajax({
    dataType: 'json',
    data: { api: 12, ID_GRUPO_SERVICIO: idServicio },
    method: 'POST',
    url: `${http}${servidor}/${appname}/api/laboratorio_solicitud_maquila_api.php`,
    success: function (respuesta) {
      const estudios = respuesta?.response?.data || [];

      if (!Array.isArray(estudios) || estudios.length === 0) {
        $contenedor.html('<span class="text-muted">No hay estudios individuales registrados para este perfil.</span>');
        return;
      }

      const lista = estudios.map(function (estudio) {
        const nombre = textoSeguro(valorEstudio(estudio, ['NOMBRE_ESTUDIO', 'SERVICIO', 'DESCRIPCION']), 'Estudio individual');
        const abreviatura = valorEstudio(estudio, ['ABREVIATURA']);
        const textoAbreviatura = abreviatura !== null ? `<small class="text-muted ms-1">(${textoSeguro(abreviatura)})</small>` : '';
        return `<li class="list-group-item biblioteca-medica__estudio-incluido">${nombre}${textoAbreviatura}</li>`;
      }).join('');

      $contenedor.html(`<ul class="list-group list-group-flush">${lista}</ul>`);
    },
    error: function (jqXHR, textStatus, errorThrown) {
      $grupo.data('cargado', 0);
      $contenedor.html('<span class="text-danger">No fue posible cargar los estudios incluidos. Intenta nuevamente.</span>');
      if (typeof alertErrorAJAX === 'function') alertErrorAJAX(jqXHR, textStatus, errorThrown);
    }
  });
}

function mostrarResultadosBiblioteca(estudios) {
  estudiosBiblioteca = Array.isArray(estudios) ? estudios : [];
  const $resultados = $('#resultados-biblioteca');
  const hayResultados = estudiosBiblioteca.length > 0;

  $('#estado-busqueda').addClass('d-none');
  $('#sin-resultados').toggleClass('d-none', hayResultados);
  $resultados.toggleClass('d-none', !hayResultados);
  $resultados.html(hayResultados ? estudiosBiblioteca.map(tarjetaEstudio).join('') : '');
}

function construirTextoCompartir(estudio) {
  const nombre = valorEstudio(estudio, ['SERVICIO', 'DESCRIPCION', 'NOMBRE_ESTUDIO']);
  const abreviatura = valorEstudio(estudio, ['ABREVIATURA']);
  const clasificacion = valorEstudio(estudio, ['CLASIFICACION']);
  const entrega = valorEstudio(estudio, ['DIAS_DE_ENTREGA']);
  const muestra = valorEstudio(estudio, ['MUESTRA', 'TIPO_MUESTRA']);
  const contenedor = valorEstudio(estudio, ['CONTENEDOR']);
  const conservacion = valorEstudio(estudio, ['CONSERVACION']);
  const indicaciones = valorEstudio(estudio, ['INDICACIONES', 'INDICACIONES_LABORATORIO']);
  const texto = `Información del estudio:\n
Estudio: ${textoSeguro(nombre, 'Sin nombre')}\nAbreviatura: ${textoSeguro(abreviatura, 'No disponible')}\nÁrea: ${textoSeguro(clasificacion, 'No disponible')}\nEntrega: ${textoSeguro(entrega, 'Por confirmar')}\nMuestra: ${textoSeguro(muestra, 'No especificada')}\nContenedor: ${textoSeguro(contenedor, 'No especificado')}\nConservación: ${textoSeguro(conservacion, 'No aplica')}\n\nIndicaciones: ${textoSeguro(indicaciones, 'Consulta con tu médico o con el laboratorio antes de tu visita.')}\n\nRecuerda confirmar esta información con el personal de Bimo y la orden médica correspondiente.`;
  return texto;
}

function construirContenidoModal(estudio) {
  const id = valorEstudio(estudio, ['ID_SERVICIO', 'ID_ESTUDIO', 'CLAVE']);
  const servicio = valorEstudio(estudio, ['SERVICIO', 'DESCRIPCION', 'NOMBRE_ESTUDIO']);
  const area = valorEstudio(estudio, ['AREA', 'NOMBRE_AREA']);
  const clasificacion = valorEstudio(estudio, ['CLASIFICACION']);
  const medida = valorEstudio(estudio, ['MEDIDA']);
  const abreviatura = valorEstudio(estudio, ['ABREVIATURA']);
  const esGrupo = valorEstudio(estudio, ['ES_GRUPO']);
  const entrega = valorEstudio(estudio, ['DIAS_DE_ENTREGA']);
  const muestra = valorEstudio(estudio, ['MUESTRA', 'TIPO_MUESTRA']);
  const contenedor = valorEstudio(estudio, ['CONTENEDOR']);
  const metodologia = valorEstudio(estudio, ['METODOLOGIA_NOMBRE', 'METODOLOGIA']);
  const conservacion = valorEstudio(estudio, ['CONSERVACION']);
  const detalle = valorEstudio(estudio, ['DETALLE_SERVICIO']);
  const indicaciones = valorEstudio(estudio, ['INDICACIONES']);
  const indicacionesLaboratorio = valorEstudio(estudio, ['INDICACIONES_LABORATORIO']);
  const motivoRechazo = valorEstudio(estudio, ['MOTIVO_RECHAZO']);
  const tipoEstudio = String(esGrupo) === '1' ? 'Grupo / perfil' : 'Estudio individual';

  return `
    <div class="row g-4">
      <div class="col-12">
        <div class="d-flex flex-column flex-md-row justify-content-between gap-3">
          <div>
            <h3 class="mb-1">${textoSeguro(servicio, 'Estudio Bimo')}</h3>
            <p class="mb-0 text-muted">${textoSeguro(clasificacion, 'Catálogo Bimo')} · Entrega: ${textoSeguro(entrega, 'por confirmar')}</p>
          </div>
          <div class="text-md-end">
            <div class="badge bg-light text-dark mb-2">${textoSeguro(area, 'Bimo')}</div>
            <div class="badge bg-light text-dark">${textoSeguro(tipoEstudio)}</div>
          </div>
        </div>
      </div>
      <div class="col-12">
        <p class="mb-4">${detalle !== null ? textoSeguro(detalle) : 'Consulta los requisitos y datos operativos de este estudio en Bimo.'}</p>
      </div>
      <div class="col-12 col-lg-6">
        <div class="biblioteca-medica__seccion-titulo mb-2">Datos del estudio</div>
        <div class="row g-2">
          ${datoFicha('Área de estudio', clasificacion, 'bi-tag')}
          ${datoFicha('Abreviatura', abreviatura, 'bi-upc')}
          ${datoFicha('Tiempo de entrega', entrega, 'bi-clock')}
          ${datoFicha('Medida', medida, 'bi-rulers')}
        </div>
      </div>
      <div class="col-12 col-lg-6">
        <div class="biblioteca-medica__seccion-titulo mb-2">Toma y manejo de muestra</div>
        <div class="row g-2">
          ${datoFicha('Tipo de muestra', muestra, 'bi-droplet')}
          ${datoFicha('Contenedor', contenedor, 'bi-box-seam')}
          ${datoFicha('Conservación', conservacion ? String(conservacion).toUpperCase() : null, 'bi-thermometer-half')}
          ${datoFicha('Metodología', metodologia, 'bi-clipboard2-pulse')}
        </div>
      </div>
      <div class="col-12">
        <div class="biblioteca-medica__seccion-titulo mb-2">Indicaciones importantes</div>
        <div class="row g-2">
          ${datoFicha('Indicaciones del estudio', indicaciones, 'bi-card-checklist')}
          ${datoFicha('Indicaciones laboratorio', indicacionesLaboratorio, 'bi-building-gear')}
          ${datoFicha('Criterios de rechazo', motivoRechazo, 'bi-exclamation-triangle')}
        </div>
      </div>
      ${String(esGrupo) === '1' ? `
      <div class="col-12">
        <div class="biblioteca-medica__seccion-titulo mb-2">Contenido del perfil</div>
        <div id="modal-estudios-incluidos" class="small text-muted">Cargando estudios incluidos…</div>
      </div>` : ''}
    </div>`;
}

function abrirModalEstudio(estudio, indice) {
  $('#modalDetalleEstudio .modal-body').html(construirContenidoModal(estudio));
  $('#modalDetalleEstudio').data('estudio-index', indice);
  const texto = construirTextoCompartir(estudio) + '\n\nMás información: ' + window.location.href;
  $('#btn-compartir-whatsapp').attr('href', `https://wa.me/?text=${encodeURIComponent(texto)}`);
  $('#modalDetalleEstudio').modal('show');

  if (String(valorEstudio(estudio, ['ES_GRUPO'])) === '1') {
    cargarEstudiosIncluidosModal(valorEstudio(estudio, ['ID_SERVICIO', 'ID_GRUPO_SERVICIO', 'CLAVE']));
  }
}

function copiarTextoEstudio() {
  const indice = $('#modalDetalleEstudio').data('estudio-index');
  const estudio = estudiosBiblioteca[indice];
  if (!estudio) return;

  const texto = construirTextoCompartir(estudio) + '\n\nMás información: ' + window.location.href;
  const $boton = $('#btn-copiar-texto');

  const mostrarExito = function () {
    const textoOriginal = $boton.text();
    $boton.prop('disabled', true).text('Texto copiado');
    setTimeout(function () {
      $boton.prop('disabled', false).html('<i class="bi bi-clipboard me-2"></i>Copiar texto');
    }, 1500);
  };

  if (navigator.clipboard && navigator.clipboard.writeText) {
    navigator.clipboard.writeText(texto).then(mostrarExito).catch(function () {
      fallbackCopyText(texto, mostrarExito);
    });
  } else {
    fallbackCopyText(texto, mostrarExito);
  }
}

function fallbackCopyText(texto, callback) {
  const $textarea = $('<textarea>').css({ position: 'fixed', left: '-9999px', top: '-9999px' }).val(texto).appendTo('body');
  $textarea.focus().select();
  try {
    document.execCommand('copy');
    callback();
  } catch (err) {
    console.warn('No fue posible copiar el texto:', err);
  }
  $textarea.remove();
}

function cargarEstudiosIncluidosModal(idServicio) {
  const $contenedor = $('#modal-estudios-incluidos');
  if (!$contenedor.length || !idServicio) return;

  $contenedor.html('<div class="text-muted"><span class="spinner-border spinner-border-sm me-2" role="status"></span>Consultando estudios incluidos…</div>');

  $.ajax({
    dataType: 'json',
    data: { api: 12, ID_GRUPO_SERVICIO: idServicio },
    method: 'POST',
    url: `${http}${servidor}/${appname}/api/laboratorio_solicitud_maquila_api.php`,
    success: function (respuesta) {
      const estudios = respuesta?.response?.data || [];

      if (!Array.isArray(estudios) || estudios.length === 0) {
        $contenedor.html('<span class="text-muted">No hay estudios individuales registrados para este perfil.</span>');
        return;
      }

      const lista = estudios.map(function (estudio) {
        const nombre = textoSeguro(valorEstudio(estudio, ['NOMBRE_ESTUDIO', 'SERVICIO', 'DESCRIPCION']), 'Estudio individual');
        const abreviatura = valorEstudio(estudio, ['ABREVIATURA']);
        const textoAbreviatura = abreviatura !== null ? `<small class="text-muted ms-1">(${textoSeguro(abreviatura)})</small>` : '';
        return `<li class="list-group-item biblioteca-medica__estudio-incluido">${nombre}${textoAbreviatura}</li>`;
      }).join('');

      $contenedor.html(`<ul class="list-group list-group-flush">${lista}</ul>`);
    },
    error: function (jqXHR, textStatus, errorThrown) {
      $contenedor.html('<span class="text-danger">No fue posible cargar los estudios incluidos. Intenta nuevamente.</span>');
      if (typeof alertErrorAJAX === 'function') alertErrorAJAX(jqXHR, textStatus, errorThrown);
    }
  });
}

$(document).on('click', '.biblioteca-medica__resultado-header', function () {
  const indice = $(this).closest('.biblioteca-medica__resultado').data('estudio-index');
  const estudio = estudiosBiblioteca[indice];
  if (estudio) abrirModalEstudio(estudio, indice);
});

$(document).on('click', '#btn-copiar-texto', function () {
  copiarTextoEstudio();
});

function buscarEstudiosBiblioteca(consulta) {
  if (solicitudBiblioteca) solicitudBiblioteca.abort();

  $('#estado-busqueda').removeClass('d-none').html('<div class="text-muted"><span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Buscando estudios…</div>');
  $('#resultados-biblioteca, #sin-resultados').addClass('d-none');

  solicitudBiblioteca = $.ajax({
    dataType: 'json',
    data: { api: 15, estudio: consulta },
    method: 'POST',
    url: `${http}${servidor}/${appname}/api/recepcion_api.php`,
    beforeSend: function () { loader('In'); },
    complete: function () {
      loader('Out', 'bottom');
      solicitudBiblioteca = null;
    },
    success: function (respuesta) {
      mostrarResultadosBiblioteca(respuesta?.response?.data || []);
    },
    error: function (jqXHR, textStatus, errorThrown) {
      if (textStatus !== 'abort') {
        $('#estado-busqueda').removeClass('d-none').text('No fue posible consultar los estudios. Intenta nuevamente.');
        $('#resultados-biblioteca, #sin-resultados').addClass('d-none');
        if (typeof alertErrorAJAX === 'function') alertErrorAJAX(jqXHR, textStatus, errorThrown);
      }
    }
  });
}

$('#form-buscar-estudio').on('submit', function (evento) {
  evento.preventDefault();
  const consulta = $('#buscar-biblioteca').val().trim();

  if (!consulta) {
    $('#buscar-biblioteca').trigger('focus');
    return;
  }

  buscarEstudiosBiblioteca(consulta);
});

$(document).on('click', '.biblioteca-medica__grupo summary', function () {
  const $grupo = $(this).closest('.biblioteca-medica__grupo');

  // El estado "open" cambia después del clic sobre el summary.
  setTimeout(function () {
    if ($grupo.prop('open')) cargarEstudiosIncluidos($grupo);
  }, 0);
});

$(document).on('click', '.biblioteca-medica__resultado > summary', function () {
  const $resultadoActual = $(this).closest('.biblioteca-medica__resultado');

  // Mantiene visible una sola ficha completa y facilita comparar resultados extensos.
  setTimeout(function () {
    if ($resultadoActual.prop('open')) {
      $('.biblioteca-medica__resultado').not($resultadoActual).prop('open', false);
    }
  }, 0);
});
