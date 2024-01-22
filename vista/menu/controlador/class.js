// Configura
function setConfig(defaults, config) {
  // Función recursiva para manejar propiedades anidadas
  function mergeDefaults(defaults, config) {
    Object.entries(defaults).forEach(([key, defaultValue]) => {
      if (typeof defaultValue === 'object' && defaultValue !== null && !Array.isArray(defaultValue)) {
        // Si la propiedad es un objeto (y no un array), llama recursivamente
        config[key] = config[key] || {}; // Asegúrate de que exista un objeto para mergear
        mergeDefaults(defaultValue, config[key]);
      } else {
        // Si la propiedad no es un objeto, o es un array, simplemente la copiamos
        config[key] = config.hasOwnProperty(key) ? config[key] : defaultValue;
      }
    });
  }

  // Copia superficial de config para evitar la modificación del objeto original
  let configCopy = { ...config };
  mergeDefaults(defaults, configCopy);
  return configCopy;
}



class GuardarArreglo {
  array = new Array();
  selectID;
  guardado;
  acumulativo = 0;

  constructor(array) {
    this.array = array
  }
  //Guarda el arreglo
  get array() {
    return this.array;
  }
  set array(newArray) {
    // newName = newName.trim();
    // console.log(newArray)
    if (Array.isArray(newArray)) {
      this.array = newArray;
    }
  }

  //Guarda el seleccionado
  set selectID(id) {
    if (true) {
      this.selectID = id;
    }
  }

  get selectID() {
    return this.selectID;
  }

  //Guarda el seleccionado
  setguardado(id) {
    if (true) {
      this.guardado = id;
    }
  }

  getguardado() {
    return this.guardado;
  }

  acumularSuma(number, reset = false) {
    // check if the passed value is a number
    if (typeof x == 'number' && !isNaN(x)) {
      // check if it is integer
      if (Number.isInteger(x)) {
        this.acumulativo += number;
        return 1
      } else {
        this.acumulativo += number;
        return 1
      }
    } else {
      try {
        if (parseInt(number)) {
          this.acumulativo += parseInt(number);
          return 1
        } else {
          if (reset)
            this.acumulativo = 0;
          return 0
        }
      } catch (error) {

      }
    }
  }

  acumularResta(number) {
    this.acumulativo -= number;
  }

  get acumular() {
    return this.acumulativo;
  }

}

const objectoArreglo = new GuardarArreglo([1, 2, 3, 4])

var Base64 = (function () {

  var ALPHA = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/';

  var Base64 = function () { };

  var _encode = function (value) {

    if (typeof (value) !== 'number') {
      throw 'Value is not number!';
    }

    var result = '',
      mod;
    do {
      mod = value % 64;
      result = ALPHA.charAt(mod) + result;
      value = Math.floor(value / 64);
    } while (value > 0);

    return result;
  };

  var _decode = function (value) {

    var result = 0;
    for (var i = 0, len = value.length; i < len; i++) {
      result *= 64;
      result += ALPHA.indexOf(value[i]);
    }

    return result;
  };

  Base64.prototype = {
    constructor: Base64,
    encode: _encode,
    decode: _decode
  };

  return Base64;

})();







class TableNew {

  tableID;
  status;
  dataAjax;
  api;
  renderTable;

  //Variables propias
  table = false;


  constructor(tableID = 'FormId') {
    // this.array = array
    this.renderTable = render;
  }


  createTable(dataAjax, api, columns, columnsDefs) {
    this.dataAjax = dataAjax;
    this.columns = columns;
    this.api = api;
    this.columnDefs = columnsDefs

    if (!$.fn.DataTable.isDataTable(`#${tableID}`))
      this.table = $(`#${this.tableID}`).DataTable({
        language: { url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json", },
        scrollY: autoHeightDiv(0, 374),
        scrollCollapse: true,
        lengthChange: false,
        // info: false,
        paging: false,
        ajax: {
          dataType: 'json',
          data: function (d) { return $.extend(d, this.dataAjax); },
          method: 'POST',
          url: `${http}${servidor}/${appname}/api/${this.api}.php`,
          beforeSend: function () { },
          complete: function () { resolve(1) },
          error: function (jqXHR, textStatus, errorThrown) {
            alertErrorAJAX(jqXHR, textStatus, errorThrown);
          },
          dataSrc: 'response.data'
        },
        columns: this.columns,
        columnDefs: this.columnDefs,
      })
  }

  actualizarTable() {
    this.table.ajax.reload();
  }


}








// Galeria de fotos dinamicas
class CargadorProgresivo {
  constructor(config) {
    config = setConfig({
      contenedor: 'divPadre',
      html_case: '--',
      datos: {},
      itemsIniciales: '',
      itemsPorCarga: '',
      html: {
        imagenes_css: {
          height: 'auto',
          width: 'auto'
        },
        divElement: {
          class: 'col-lg-4 col-md-6 mb-4'
        }
      },
      detalles: false,
    }, config)

    this.config = config
    this.contenedor = document.getElementById(config.contenedor);
    this.contenedor.innerHTML = ''; // <-- Cuando se inicialice, borramos todo
    this.datos = config.datos;
    this.itemsIniciales = config.itemsIniciales;
    this.itemsPorCarga = config.itemsPorCarga;
    this.currentIndex = 0;

    this.loadInitialItems(); // Carga inicial
    this.addScrollListener();
  }

  loadItems(n) {
    // Obten las configuraciones previas
    const config = this.config;
    const totalItems = this.datos.length;
    const nextIndex = Math.min(this.currentIndex + n, totalItems);

    for (let i = this.currentIndex; i < nextIndex; i++) {
      const elemento = this.datos[i];
      // Elige el tipo de html a usar
      const html = this.tipo_html(this.config.html_case, elemento);

      this.contenedor.innerHTML += html;
    }

    this.currentIndex = nextIndex;
  }

  loadInitialItems() {
    this.loadItems(this.itemsIniciales);
  }

  loadMoreItems() {
    this.loadItems(this.itemsPorCarga);
  }

  checkLoadMore() {
    const rect = this.contenedor.getBoundingClientRect();
    if (rect.bottom <= window.innerHeight) {
      this.loadMoreItems();
    }
  }

  addScrollListener() {
    window.addEventListener('scroll', () => this.checkLoadMore());
  }

  tipo_html(type, elemento) {
    switch (type) {
      case 'PROMOCIONES_BIMO': return this.promociones_bimo(elemento);

      default: return type;
    }
  }

  //Galeria de fotos (HTML)
  promociones_bimo(dato) {
    // Obten las configuraciones previas
    const config = this.config;

    let detalle = '', registro_html = '', pausado_html = '', boton = "";
    if (config.detalles) {
      let pausa = dato.PAUSADO == '1' ? 'Si' : 'No';

      registro_html = `<strong>Registro:</strong> ${dato.REGISTRADO_POR}</br>`
      pausado_html = `<strong>Pausado:</strong> <span class="edit_format" input-name="pausado" type-input="select", value-save="${dato.PAUSADO}">${pausa}</span>`

      boton = `
        <!-- Boton para cambiar texto a inputs -->
        <button class="btn btn-pantone-325 btn-sm edit-button" data-bs-id_promocion="${dato.ID_PROMOCION}" type="button">
          <i class="bi bi-pencil"></i>
        </button>
        <!-- Boton para guardar texto a inputs -->
        <button class="btn btn-success btn-sm save-button mx-2" data-bs-id_promocion="${dato.ID_PROMOCION}" type="button" style="display: none">
          <i class="bi bi-save"></i>
        </button>
        <!-- Boton para cancelar texto a inputs -->
        <button class="btn btn-pantone-7408 btn-sm cancel-button" data-bs-id_promocion="${dato.ID_PROMOCION}" type="button" style="display: none">
          <i class="bi bi-x-lg"></i>
        </button>
        `
    }

    detalle = `
      <p class="none-p">
        ${registro_html}
        <strong>Vigencia:</strong> </br>
          <!-- Campos de vigencia -->
          <span class="edit_format" input-name="fecha_inicio" type-input="date" value-save="${dato.FECHA_INICIO}" data-width="45%">${formatoFecha2(ifnull(dato, '0000-00-00', ['FECHA_INICIO']), [0, 1, 5, 2, 0, 0, 0])}</span> - <span class="edit_format" input-name="fecha_fin" type-input="date" value-save="${dato.FECHA_FIN}" data-width="45%">${formatoFecha2(ifnull(dato, '0000-00-00', ['FECHA_FIN']), [0, 1, 5, 2, 0, 0, 0])}</span></br>
        ${pausado_html}
      </p>
    `
    let vigencia = {
      1: {
        nombre: 'Por Vencer',
        span_color: 'warning'
      },
      2: {
        nombre: 'Proximamente',
        span_color: 'info'
      },
      3: {
        nombre: 'Vigente',
        span_color: 'success'
      },
      4: {
        nombre: 'Vencido',
        span_color: 'danger'
      },
      5: {
        nombre: 'NO ESTATUS',
        span_color: 'danger'
      },
    };
    vigencia = vigencia[ifnull_class(dato, 5, ['ESTATUS'])]; // 3 por defecto

    // estilosComoTexto(imagenes_css)
    var html = `<div class="${config.html.divElement.class} fadeIn ">
              <div class="bg-white rounded shadow-sm tarjeta-flexible">
                <img src="${ifnull(dato, '', { ARCHIVOS: { '0': 'url' } })}" alt="" class="img-fluid card-img-top imagen-tarjeta" style="${this.estilosComoTexto(config.html.imagenes_css)}">
                <div class="p-4 contenido-tarjeta">
                  
                  <!-- Formulario por clase para editar -->
                  <form class="formEditarGalleria"> 
                    <div class="row mb-1 titulo-tarjeta">
                      <!-- Primer campo (titulo) -->
                      <div class="col-12 col-lg-8">
                        <h5 class="text-dark edit_format mb-0" input-name="titulo" type-input="text" value-save="${dato.TITULO}">${dato.TITULO}</h5>
                      </div>
                      <div class="col-12 col-lg-4 d-flex justify-content-center align-items-center">
                        ${boton}
                      </div>
                    </div>
                    
                    <!-- Segundo campo (descripcion) -->
                    <div class="mb-1 cuerpo-tarjeta">
                      <p class="small text-muted mb-0 edit_format" input-name="descripcion" type-input="text" value-save="${dato.DESCRIPCION}">${dato.DESCRIPCION}</p
                      ${detalle}
                    </div>
                    
                    <div class="pie-tarjeta">
                      <div class="d-flex align-items-center justify-content-between rounded-pill bg-light px-3 py-2 mt-4">
                        <p class="small mb-0"><i class="fa fa-picture-o mr-2"></i><span class="font-weight-bold">${ifnull(dato, '', { ARCHIVOS: { '0': 'tipo' } })}</span></p>
                        <div class="badge text-bg-${vigencia.span_color} px-3 rounded-pill font-weight-normal text-white">${vigencia.nombre}</div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>`;
    return html;
  }

  estilosComoTexto(objetoEstilos) {
    return Object.entries(objetoEstilos)
      .map(([key, value]) => `${this.camelCaseToKebabCase(key)}: ${value}`)
      .join('; ');
  }

  camelCaseToKebabCase(string) {
    return string.replace(/([a-z0-9])([A-Z])/g, '$1-$2').toLowerCase();
  }
}



// Valida
function ifnull_class(data, siNull = '', values = [
  'option1',
  {
    'option2': [
      'suboption1',
      {
        'suboption2': ['valor']
      }
    ],
    'option3': 'suboption1'
  },
  'option4',
]) {

  values = ((typeof values === 'object' && !Array.isArray(values)) || (typeof values === 'string'))
    ? [values]
    : values;

  // Comprobar si el dato es nulo o no es un objeto
  if (!data || typeof data !== 'object') {
    if (data === undefined || data === null || data === 'NaN' || data === '' || data === NaN) {
      switch (siNull) {
        case 'number': return 0
        case 'boolean': return data ? true : false;
        default: return siNull;
      }
    } else {

      let data_modificado = escapeHtmlEntities(`${data}`);

      switch (siNull) {
        case 'number':
          // No hará modificaciones
          break;
        case 'boolean': return ifnull_class(data, false) ? true : false;
        default:
          //Agregará las modificaciones nuevas
          data = data_modificado
          break;
      }

      return data;
    }
  }
  // Iterar a través de las claves en values
  for (const key of values) {
    if (typeof key === 'string' && key in data) {
      const result = ifnull_class(data[key], false);
      if (result) {
        return result;
      }
      // return result || siNull;
    } else if (typeof key === 'object') {
      for (const nestedKey in key) {
        const result = ifnull_class(data[nestedKey], siNull, [key[nestedKey]]);
        if (result) return result
      }
    }
  }


  return siNull;
}
