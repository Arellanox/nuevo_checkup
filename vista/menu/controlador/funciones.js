//Formatear Fecha de sql
function formatoFecha(texto) {
  if (texto)
    return texto.replace(/^(\d{4})-(\d{2})-(\d{2})$/g, '$3/$2/$1');

  return '';
}

//formatea la Edad de sql
function formatoEdad(texto) {
  if (texto) {
    // Convierte la cadena en un número
    var numero = parseFloat(texto);

    // Verifica si el número tiene decimales y cuántos
    var decimales = (numero % 1 !== 0) ? texto.split('.')[1].length : 0;

    // Utiliza toFixed para formatear el número con la cantidad correcta de decimales
    return numero.toFixed(decimales).replace(/^(\d{4})-(\d{2})-(\d{2})$/g, '$3/$2/$1');
  }

  return '';
}

jQuery.fn.exists = function () { return this.length > 0; }

function formatoFechaSQL(fecha, formato) {
  const map = {
    dd: fecha.getDate(),
    mm: fecha.getMonth() + 1,
    // yy: fecha.getFullYear().toString().slice(-2),
    yy: fecha.getFullYear()
  }

  return formato.replace(/dd|mm|yy|yyy/gi, matched => map[matched]);
}

function formatoFecha2(fecha, optionsDate = [3, 1, 2, 2, 1, 1, 1], formatMat = 'best fit') {
  if (fecha == null)
    return '';
  // let options = {
  //   hourCycle: 'h12', //<-- Formato de 12 horas
  //   timeZone: 'America/Mexico_City'
  // } // p.m. - a.m.

  const options = {
    timeZone: 'America/Mexico_City',
    hourCycle: 'h12',
    weekday: ['narrow', 'short', 'long'][optionsDate[0] - 1],
    year: ['numeric', '2-digit'][optionsDate[1] - 1],
    month: ['narrow', 'short', 'long', 'numeric', '2-digit'][optionsDate[2] - 1],
    day: ['numeric', '2-digit'][optionsDate[3] - 1],
    hour: ['numeric', '2-digit'][optionsDate[4] - 1],
    minute: ['numeric', '2-digit'][optionsDate[5] - 1],
    seconds: ['numeric', '2-digit'][optionsDate[6] - 1]
  };

  let date;
  if (fecha.length == 10) {
    date = new Date(fecha + 'T00:00:00')
  } else {
    date = new Date(fecha)
  }

  // //console.log(date)
  return date.toLocaleDateString('es-MX', options)
}


// Función para convertir un arreglo a texto
function arrayATexto(arr) {
  return arr.join(', '); // Usa ', ' como separador
}



// Reinicia los collapse para medicos tratantes
function reset_email_inputs_medicos() {
  // Ocultar solo los collapses de confirmación de correo
  $('.email-collapse').collapse('hide');

  // Vaciar todos los inputs de correo y confirmación
  $('.email-medicoTratante').val('');

  // Ocultar mensajes de error asociados a los collapses de correo
  $('.email-collapse').find('.error-message').hide();

  // Desbloquear todos los botones asociados a los collapses de correo
  $('.btn_confirmar_correo').prop('disabled', false);
}


function calcularEdad(fecha) {
  var hoy = new Date(), cumpleanos = new Date(fecha);
  var edad = hoy.getFullYear() - cumpleanos.getFullYear();
  var m = hoy.getMonth() - cumpleanos.getMonth();

  if (m < 0 || (m === 0 && hoy.getDate() < cumpleanos.getDate()))
    edad--;
  return edad;
}

function calcularEdad2(fecha) {
  var hoy = new Date();
  var cumpleanos = new Date(fecha);
  var edadEnAnos = hoy.getFullYear() - cumpleanos.getFullYear();
  var m = hoy.getMonth() - cumpleanos.getMonth();
  var d = hoy.getDate() - cumpleanos.getDate();

  if (m < 0 || (m === 0 && d < 0)) {
    edadEnAnos--;
    m += 12; // Ajusta los meses cuando el día de hoy es antes del día de cumpleaños.
  }

  if (edadEnAnos > 0) {
    return { numero: edadEnAnos, tipo: 'año' + (edadEnAnos > 1 ? 's' : '') };
  } else if (m > 0) {
    return { numero: m, tipo: 'mes' + (m > 1 ? 'es' : '') };
  } else {
    // Calcular la diferencia en días si no hay diferencia en meses o años.
    var fechaCumpleanosEsteAno = new Date(hoy.getFullYear(), cumpleanos.getMonth(), cumpleanos.getDate());
    var diferenciaDias = Math.floor((hoy - fechaCumpleanosEsteAno) / (1000 * 60 * 60 * 24));
    if (diferenciaDias < 0) {
      diferenciaDias += new Date(hoy.getFullYear(), hoy.getMonth(), 0).getDate(); // Ajuste si el día de hoy es antes del día de cumpleaños en este mes.
    }

    var semanas = Math.floor(diferenciaDias / 7);
    if (semanas > 0) {
      return { numero: semanas, tipo: 'semana' + (semanas > 1 ? 's' : '') };
    } else {
      return { numero: diferenciaDias, tipo: 'día' + (diferenciaDias > 1 ? 's' : '') };
    }
  }
}


// Revisar sesión
function validarVista(area, reload = true) {
  if (!area.length)
    return si(reload)

  try {
    if (session['vista'][area] == 1) {
      validar = true
      return 1
    } else {
      return si(reload)
    }
  } catch (error) {
    return si(reload)
  }

  function si(reload) {
    if (reload) {
      validar = false
      alertMensajeConfirm({
        title: "¡No tiene permitido estar aqui!",
        text: "No tiene permiso para usar esta area",
        icon: "info",
        confirmButtonColor: "#d33",
        confirmButtonText: "Aceptar",
        allowOutsideClick: false
      }, function () {
        destroySession();
        window.location.replace(http + servidor + "/" + appname + "/vista/login/");
      })
      return false;
    } else {
      return false;
    }
  }
}

//Revisar permisos
function validarPermiso(permiso, reload = false) {
  try {
    if (session['permisos'][permiso] == 1 || session['permisos'][permiso] == '1') {
      //console.log(true)
      return true
    } else {
      //console.log(session['permisos'])
      //console.log(false)
      if (reload)
        window.location.reload()
      return false;
    }
  } catch (error) {
    //console.log(error)
    if (reload)
      window.location.reload()
    return false;
  }
}

//Mensaje para area 
function avisoArea(tip = 0) {
  if (tip == 0) {
    alertMensajeConfirm({
      title: 'Area no disponible',
      message: 'Probablemente no ha seleccionado un area correcta',
      icon: 'info'
    })
  }
}


// Configuracion de ajax
const configAjaxAwait = {
  alertBefore: false, //Alerta por defecto, "Estamos cargando la solucitud" <- Solo si la api consume tiempo
  response: true, //Si la api tiene la estructura correcta (response.code)
  callbackBefore: false, //Activa la function antes de enviar datos, before
  callbackAfter: false, //Activa una funcion para tratar datos enviados desde ajax, osea success
  returnData: true, // regresa los datos o confirmado (1)
  WithoutResponseData: false, //Manda los datos directos
  resetForm: false, //Reinicia el formulario en ajaxAwaitFormData,
  ajaxComplete: () => { }, //Mete una funcion para cuando se complete
  ajaxError: () => { }, //Mete una funcion para cuando de error
  formJquery: null, // Manda como variable el formulario ubicado, esto si el formulario esta por clases y lo mandas por jquery
}

//Ajax Async (NO FORM DATA SUPPORT)
async function ajaxAwait(dataJson, apiURL,
  config = {
    alertBefore: false
  },
  //Callback
  callbackBefore = function (data) {
    alertMsj({
      title: 'Espera un momento...',
      text: 'Estamos cargando tu solicitud, esto puede demorar un rato',
      icon: 'info',
      showCancelButton: false
    })
  },
  //Callback, antes de devolver la data
  callbackSuccess = function (data) {
    console.log('callback ajaxAwait por defecto')
  }
) {
  return new Promise(function (resolve, reject) {
    //Configura la funcion misma
    config = setConfig(configAjaxAwait, config)

    $.ajax({
      url: `${http}${servidor}/${appname}/api/${apiURL}.php`,
      data: dataJson,
      dataType: 'json',
      type: 'POST',
      beforeSend: function () {
        config.callbackBefore ? callbackBefore() : 1;
      },
      success: function (data) {
        let row = data;
        try {
          if (config.response) {
            if (mensajeAjax(row)) {
              config.callbackAfter ? callbackSuccess(config.WithoutResponseData ? row.response.data : row) : 1;
              config.returnData ? resolve(config.WithoutResponseData ? row.response.data : row) : resolve(1)
            }
          } else {
            config.callbackAfter ? callbackSuccess(config.WithoutResponseData ? row.response.data : row) : 1;
            config.returnData ? resolve(config.WithoutResponseData ? row.response.data : row) : resolve(1)
          }
        } catch (error) {
          alertMensaje('error', 'Error', 'Datos/Configuración erronea', error);
          console.error(error);
        }

      },
      error: function (jqXHR, exception, data) {
        alertErrorAJAX(jqXHR, exception, data)
        console.log('Error')
      },
    })
  });
}

//Ajax Async FormData (¡ Dejar de usar !)
async function ajaxAwaitFormData(dataJson = { api: 0, }, apiURL, form = 'OnlyForm'  /* <-- Formulario sin # */,
  config = {
    alertBefore: false
  },
  //Callback antes de enviar datos
  callbackBefore = () => {
    alertMsj({
      title: 'Espera un momento...',
      text: 'Estamos cargando tu solicitud, esto puede demorar un rato',
      icon: 'info',
      showCancelButton: false
    })
  },
  //Callback, antes de devolver la data
  callbackSuccess = () => {
    console.log('callback ajaxAwait por defecto')
  }
) {
  // formData.set('api', 10);
  return new Promise(function (resolve, reject) {
    //Configura la funcion misma
    config = setConfig(configAjaxAwait, config)

    // Si mandas el form de jquery, mandalo a nativo
    let formID = document.getElementById(form);
    if (config.formJquery) {
      formID = config.formJquery[0];
    }

    let formData = new FormData(formID);

    for (const key in dataJson) {
      if (Object.hasOwnProperty.call(dataJson, key)) {
        const element = dataJson[key];
        if (!ifnull(formData.get(`${key}`), false)) {
          formData.set(`${key}`, element);
        }
      }
    }


    $.ajax({
      url: `${http}${servidor}/${appname}/api/${apiURL}.php`,
      data: formData,
      processData: false,
      contentType: false,
      dataType: 'json',
      type: 'POST',
      beforeSend: function () {
        config.callbackBefore ? callbackBefore() : 1;
      },
      success: function (data) {
        config.resetForm ? formID.reset() : false;
        if (config.response) {
          if (mensajeAjax(data)) {
            config.callbackAfter ? callbackSuccess(config.WithoutResponseData ? data.response.data : data) : 1;
            config.returnData ? resolve(config.WithoutResponseData ? data.response.data : data) : resolve(1)
          }
        } else {
          config.callbackAfter ? callbackSuccess(config.WithoutResponseData ? data.response.data : data) : 1;
          config.returnData ? resolve(config.WithoutResponseData ? data.response.data : data) : resolve(1)
        }

      },
      // complete: ajaxComplete(),
      error: function (jqXHR, exception, data) {
        // ajaxError()
        alertErrorAJAX(jqXHR, exception, data)
      },
    })
  });
}




// Verificar si tiene una sesión activa
function loggin(callback, tipoUrl = 1) {
  if (tipoUrl != 3) {
    $.ajax({
      url: http + servidor + "/" + appname + "/api/usuarios_api.php",
      type: "POST",
      data: {
        api: 8
      },
      dataType: 'json',
      success: function (data) {
        if (mensajeAjax(data)) {
          // //console.log(data);
          if (data['response']['code'] == 1) {
            validar = true
            callback(1)
          } else {
            // alert(tipoUrl);
            switch (tipoUrl) {
              case 1:
                destroySession();
                window.location.replace = http + servidor + '/' + appname + '/vista/login/?page=' + window.location;
                break;
              case 2:
                destroySession();
                window.location.replace = http + servidor + '/' + appname + '/vista/login/';
                break;
              default:
                destroySession();
                window.location.replace = 'https://www.google.com/';
                break;
            }
          }
        }
      },
      error: function (jqXHR, exception, data) {
        alertErrorAJAX(jqXHR, exception, data)
      },
    });
  } else {
    validar = true
    callback(1);
  }
}

function destroySession() {
  $.ajax({
    url: http + servidor + "/" + appname + "/api/login_api.php",
    type: "POST",
    data: {
      api: 2
    }
  });
}


//Obtener numero rando
function getRandomInt(max) {
  return Math.floor(Math.random() * max);
}

function getRandomString() {
  var n = Math.floor(Math.random() * 11);
  var k = Math.floor(Math.random() * 1000000);
  var m = String.fromCharCode(n) + k;
  return m;
}

// Checa si es un numero
function checkNumber(x, transform = 0) {
  // check if the passed value is a number
  if (typeof x == 'number' && !isNaN(x)) {
    // check if it is integer
    if (Number.isInteger(x)) {
      return 1
    } else {
      return 1
    }
  } else {
    if (transform)
      return parseInt(x); //Entero
    return 0
  }
}


function ifnull(data, siNull = '', values = [
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
        case 'boolean': return ifnull(data, false) ? true : false;
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
      const result = ifnull(data[key], false);
      if (result) {
        return result;
      }
      // return result || siNull;
    } else if (typeof key === 'object') {
      for (const nestedKey in key) {
        const result = ifnull(data[nestedKey], siNull, [key[nestedKey]]);
        if (result) return result
      }
    }
  }


  try {
    if (data.length) {
      return data
    }
  } catch (error) {
    console.error('El objeto no es texto');
  }

  return siNull;
}


// Verifica si rellenó todo
function requiredInputLeft(formId) {
  let todosLlenos = false; // Asumiendo que los datos estan rellenados

  // Almacenar los grupos de radio verificados para no repetir la verificación
  let radioVerificados = {};

  $(`#${formId} .required_input`).each(function () {
    // Para campos de texto y número, verifica si están vacíos
    if (this.type === 'text' || this.type === 'number') {
      if (!ifnull(this, false, ['value'])) {
        todosLlenos = true; // Marca si falta campos por marcar
        return false; // Salir del bucle
      }
    }
    // Para botones de radio, verifica si alguno del mismo grupo está seleccionado
    else if (this.type === 'radio') {
      // Si el grupo de radio ya fue verificado, saltarlo
      if (radioVerificados[this.name]) return true;

      if (!$(`input[name="${this.name}"]:checked`).length) {
        todosLlenos = true; // Marca si falta campos por marcar
        return false; // Salir del bucle
      }
      // Marcar el grupo de radio como verificado
      radioVerificados[this.name] = true;
    }
  });

  return todosLlenos;
}



function htmlCaracter(data) {

  st = document.getElementById('ent').value;
  st = st.replace(/&/g, "&amp;");
  st = st.replace(/</g, "&lt;");
  st = st.replace(/>/g, "&gt;");
  st = st.replace(/"/g, "&quot;");
  document.getElementById('result').innerHTML = '' + st;
}

// function escapeHtmlEntities(input) {
//   if (!input || typeof input !== 'string') {
//     return input;
//   }

//   const replacements = {
//     '"': '&quot;',
//     '&': '&amp;',
//     '<': '&lt;',
//     '>': '&gt;',
//     "'": '&apos;',
//     '-': '&ndash;',
//     '—': '&mdash;',
//     '\u00A0': '&nbsp;',
//     '\u2013': '&ndash;',
//     '\u2014': '&mdash;',
//     '\u2018': '&apos;',
//     '\u2019': '&apos;',
//     '\u201C': '&quot;',
//     '\u201D': '&quot;',
//     '\u2022': '&bull;',
//     '\u2026': '&hellip;',
//     '\u2032': '&prime;',
//     '\u2033': '&Prime;',
//     '\u00AE': '&reg;',
//     '\u2122': '&trade;'
//     // Agrega más reemplazos aquí si es necesario
//   };



//   const regex = new RegExp(Object.keys(replacements).join('|'), 'g');
//   return input.replace(regex, match => replacements[match]);
// }

function escapeHtmlEntities(input) {
  if (!input || typeof input !== 'string') {
    return input;
  }

  const replacements = {
    '"': '&quot;',
    '<': '&lt;',
    '>': '&gt;',
    "'": '&apos;',
    // '-': '&ndash;',
    // '—': '&mdash;',
    // '\u00A0': '&nbsp;',
    // '\u2013': '&ndash;',
    // '\u2014': '&mdash;',
    // '\u2018': '&apos;',
    // '\u2019': '&apos;',
    // '\u201C': '&quot;',
    // '\u201D': '&quot;',
    // '\u2022': '&bull;',
    // '\u2026': '&hellip;',
    // '\u2032': '&prime;',
    // '\u2033': '&Prime;',
    // '\u00AE': '&reg;',
    // '\u2122': '&trade;'
  };

  const regex = new RegExp(Object.keys(replacements).join('|'), 'g');

  const result = input.replace(regex, match => replacements[match]);

  // Si el resultado aún contiene un & no reemplazado y no es seguido por caracteres, reemplazarlo con &amp;
  if (result.includes('&') && !/[a-zA-Z0-9#]/.test(result.charAt(result.indexOf('&') + 1))) {
    return result.replace('&', '&amp;');
  }

  return result;
}



function firstMayus(str) {
  str = str.charAt(0).toUpperCase() + str.slice(1);
  return str;
}

function truncate(str, maxlength) {
  return (str.length > maxlength) ?
    str.slice(0, maxlength - 1) + '…' : str;
}

//Especifico para areas dinamicas de un valor
function deletePositionString(str, position) {
  str = str.slice(0, position);
  return str;
}

function deleteSpace(str) {
  return str.replace(/ /g, "");
}


$(window).resize(function () {
  //aqui el codigo que se ejecutara cuando se redimencione la ventana
  // var alto=$(window).height();
  // var ancho=$(window).width();
  // alert("alto: "+alto+" ancho:"+ancho);

  $.fn.dataTable
    .tables({
      visible: true,
      api: true
    })
    .columns.adjust();
})

$(document).on('change click', 'input[type="file"]', function () {
  // //console.log($(this)[0])
  if ($(this)[0].files.length > 1) {
    var filename = `${$(this)[0].files.length} Archivos...`;
  } else {
    var filename = $(this).val().split('\\').pop();
    var extension = $(this).val().split('.').pop();

    var filename = filename.replace(`.${extension}`, '')

  }


  // //console.log(filename);
  var label = $(this).parent('div').find('label[class="input-file-label"]')
  if ($(this).val() == '') {
    label.html(`<i class="bi bi-box-arrow-up"></i> Seleccione un archivo`)
  } else {
    label.html(`File: ${truncate(filename, 15)} | ${extension}`)
  }
})

function resetInputLabel() {
  const label = $(`input[type="file"]`).parent('div').find('label[class="input-file-label"]')
  label.html(`<i class="bi bi-box-arrow-up"></i> Seleccione un archivo`)
}

// config = myfunctionconfig(config);

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

// Esta funcion solo funciona para un solo input,
// si hay mas de uno debe llamarse tantas veces sea posible
let selectedFilesCount = 0;
function InputDragDrop(divPadre, callback = () => { console.log('callback default') }, config = { /*Configuracion */ }) {
  // Setea para no perder configuracion
  config = setConfig(
    // nuevas configuraciones
    {
      multiple: false,
      dropArea: {
        background: '#ffffff00',
        border: '2px dashed rgb(0 79 90 / 17%)'
      }
    }, config
  )

  let dropArea = $(divPadre) // <- Recomendaible una ID tipo #divPadre
  let inputArea = $(divPadre).find('input'); // <- Deseable a que solo exista un input
  let labelArea = $(divPadre).find('label');// <- Si deseas modificar el texto del div añadelo
  let divCarga = $(divPadre).find('div')//<- Opcional se agrego para hacer un Spinners de bootraps


  // Personalización 
  if (ifnull(config, false, ['width'])) {
    dropArea.css('width', config.width)
    dropArea.css(config.dropArea); // <--
  }


  // Antes de configurar la funcionalidad para el nuevo paciente, realiza la limpieza
  dropArea.off();
  labelArea.off();

  // Restaura los elementos DOM al estado original
  inputArea.val(''); // Elimina cualquier archivo seleccionado previamente
  labelArea.html(`Sube tu archivo arrastrándolo aquí`) // Restaura el texto original
  selectedFilesCount = 0; // Reinicia el contador si es necesario

  // Efecto de hover
  // Aviso al input que hay un archivo encima de él
  let hoverInput = (cambio = false) => {

    if (cambio) {
      // Entrada 
      dropArea.addClass('hover_dropDrag');


    } else {
      // Salida
      dropArea.removeClass('hover_dropDrag');

    }

  }

  // Efecto de cargando, subiendo
  // Avisa se coloca aqui mismo antes de ejecutar callback
  let cargandoInput = () => {
    // Valida el tipo de archivo a mandar


    //efecto para cambiar de color el div
    dropArea.css({
      // "color": "red",
      // "font-size": "18px",
      // "background-color": "yellow",
      "border-color": "#00bbb9",
      "background-color": "#c6cacc"

    });
    dropArea.css("font-weight", "bold");
    labelArea.html('Cargando...')
    divCarga.css({ 'display': 'inline-block' })
  }

  // Efecto de cargando e imagen subida lista;
  // Aviso que debe ejecutar callback para saber si ya se subió
  let salidaInput = (config = { /*Config de salida*/ }) => {

    config = setConfig({
      msj: {
        msj: 'Archivo actualizado',
        pregunta: '¿Deseas subir otro archivo?'
      },
      dropArea_css: {
        background: '#f4fdff',
        border: '2px dashed rgb(0 79 90 / 17%)',
      },
      strong: {
        class: 'none-p',
        style: `borderBottom: '1px solid'`
      }
    }, config)

    // Crear efecto de imagen subida
    // Previene errores y versionalidad
    if (typeof config === 'string') {
      // La variable es un string
      msj = config;
    } else {
      msj = config.msj.msj;
    }
    // 

    // console.log('Salida de input')
    labelArea.html(`${msj} </br > <strong class="${config.strong.class}" style="${config.strong.style}">${config.msj.pregunta}</strong>`)
    divCarga.css({ 'display': 'none' })

    dropArea.css(config.dropArea_css)
  }


  let envioFiles = () => {

    const files = inputArea[0].files;
    if (config.multiple || files.length <= 1) {
      callback(inputArea, salidaInput);
    } else {

      divCarga.css({ 'display': 'none' })

      dropArea.css({
        'background': '#f4fdff',
        'border': '2px dashed rgb(0 79 90 / 17%)'
      })
      labelArea.html('No puedes subir más de un archivo.');
      // alert('No puedes subir más de un archivo.');
      // Restaura el contador de archivos seleccionados
      selectedFilesCount = 0;
      // Restaura el input de archivos
      inputArea.val('No puedes subir más de un archivo.');
    }
    // callback(inputArea, salidaInput);
  }


  dropArea.on('dragenter dragover', function (e) {
    // Prevenir recarga y propagation a otros input
    e.preventDefault();
    e.stopPropagation();

    hoverInput(1)// <- Agrega efecto de entrada
  })

  dropArea.on('dragleave', function (e) {
    // Prevenir recarga y propagation a otros input
    e.preventDefault();
    e.stopPropagation();
    hoverInput(0) // <- Agrega efecto de salida
  })

  // Majeno de arrastrar y soltar
  dropArea.on('drop', function (e) {

    const files = e.originalEvent.dataTransfer.files;
    inputArea[0].files = files;

    hoverInput(0) // <- Agrega efecto de salida y soltar

    // Prevenir recarga y propagation a otros input
    e.preventDefault();
    e.stopPropagation();

    // Dar el efecto de cargando o subiendo
    cargandoInput()

    // callback
    envioFiles() // <- Recordar que debes terminar el proceso de cargando a salida

  })

  inputArea.on('change', function () { // <- se cambio por labelArea
    // Dar el efecto de cargando o subiendo
    cargandoInput()

    // callback
    envioFiles() // <- Recordar que debes terminar el proceso de cargando a salida
  })



  const resetInputDrag = function resetInputDrag() {

    // Resetear los estilos al estado inicial
    dropArea.removeClass('hover_dropDrag').css({
      'border-color': 'rgb(0 79 90 / 17%)',
      'background-color': 'transparent', // Suponiendo que el fondo inicial es transparente
      'color': 'black', // Si el texto inicial es negro
      // Restablecer cualquier otro estilo que sea necesario
    });

    // También debes asegurarte de que el contenido de la zona de arrastre se restablezca
    const labelArea = dropArea.find('label');
    labelArea.text('Sube tu archivo arrastrándolo aquí'); // O el texto inicial que desees
  }

  return {
    resetInputDrag: resetInputDrag
  };

}


let lightbox = '#lightbox';
let lightbox_img = '#lightbox-img'
// $(document).on('click', '.lightbox-image', (e) => {
//   let imgSrc = $(this).prop('src');
//   alert(imgSrc.split(',')[1]);

//   let img = $(this)
//   $(lightbox_img).prop('src', (img.prop("src")).split(',')[1])
//   $(lightbox).css('display', 'flex');
//   console.log($(lightbox), img)
//   console.log('¡Imagen abierta!')
// })

// $(document).on('click', '#lightbox', (e) => {
//   $(lightbox).css('display', 'none')
// })



function resetInputFile() {
  $('input[type="file"]').each(function () {
    $(this).val('')
    var label = $(this).parent('div').find('label[class="input-file-label"]')
    label.html(`< i class= "bi bi-box-arrow-up" ></ > Seleccione un archivo`)
  });
}

//Devuelve la area
function getAreaActiva() {
  hash = window.location.hash.substring(1);
  switch (hash) {
    case "ULTRASONIDO": return 11;
    case "RX": return 8;
    case "ESPIROMETRIA": return 5;
    case "ELECTROCARDIOGRAMA": return 10;
    case "AUDIOMETRIA": return 4;
    case "OFTALMOLOGIA": return 3;
  }
}

// Omitir paciente actual
function pasarPacienteTurno(id_turno, id_area, liberar = 0, callback) {
  switch (liberar) {
    case 1:
      options = {
        title: "¿Desea liberar el turno?",
        text: "Se le otorgará otro paciente de la lista.",
        icon: "info",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Sí, liberar",
        cancelButtonText: "Cancelar",
        allowOutsideClick: false
      }
      break;
    case 0:
      options = {
        title: "¿Está seguro omitir este paciente?",
        text: "¡Este paciente se mandará al final de la lista!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Sí, omitir",
        cancelButtonText: "Cancelar",
        allowOutsideClick: false
      }
      break;
    default:
      break;
  }

  Swal.fire(options).then((result) => {
    if (result.isConfirmed) {
      // $('#submit-registrarEstudio').prop('disabled', true);
      // Esto va dentro del AJAX
      $.ajax({
        data: {
          api: 3,
          id_area: id_area,
          liberar: liberar
        },
        url: "../../../api/turnos_api.php",
        type: "POST",
        success: function (data) {
          data = jQuery.parseJSON(data);
          if (mensajeAjax(data)) {
            Toast.fire({
              icon: "success",
              title: "¡Paciente omitido!",
              timer: 2000,
            });
            callback(data)
          }
        },
        error: function (jqXHR, exception, data) {
          alertErrorAJAX(jqXHR, exception, data)
        },
      });
    }
  });
}

//Obtener paciente actual
function buscarPaciente(id_area, callback = function (data) { }) {
  alertMensajeConfirm({
    title: '¿Desea llamar al siguiente paciente?',
    text: "",
    icon: "info",
    showCancelButton: true,
    confirmButtonColor: "#d33",
    cancelButtonColor: "#3085d6",
  }, $.ajax({
    data: {
      api: 2,
      id_area: id_area
    },
    url: http + servidor + "/" + appname + "/api/turnero_api.php",
    // url: "../../../api/turneador_api.php",
    type: "POST",
    success: function (data) {
      data = jQuery.parseJSON(data);
      callback(data);
    },
    error: function (jqXHR, exception, data) {
      alertErrorAJAX(jqXHR, exception, data)
    },
  }), 1)
}


//Control de turnos 
function omitirPaciente(areaFisica) {
  alertMensajeConfirm({
    title: '¿Deseas omitir tu paciente actual?',
    text: "El paciente actual volverá a la lista de espera.",
    icon: "info",
    showCancelButton: true,
    confirmButtonColor: "#d33",
    cancelButtonColor: "#3085d6",
  }, function () {
    $.ajax({
      url: `${http}${servidor}/${appname}/api/turnero_api.php`,
      type: 'POST',
      dataType: 'json',
      data: { api: 3, area_fisica_id: areaFisica },
      success: function (data) {
        if (mensajeAjax(data)) {
          let row = data.response.data;
          console.log(row);
          // miStorage.setItem('paciente_actual_turno', row['NEXT']['turno_id'])
          // miStorage.setItem('paciente_actual_nombre', row['NEXT']['paciente'])
          pacienteTurnoActivo.selectID = row['NEXT']['turno_id'];
          pacienteTurnoActivo.setguardado(row['NEXT']['paciente']);
          $('#paciente_turno').html(row['NEXT']['paciente'])
          alertMsj({
            title: row['NEXT']['paciente'],
            text: `Es su siguiente paciente, acabas de omitir al paciente ${row['OMITTED']['paciente']}`,
            footer: 'Los pacientes omitidos serán saltados al final de la fila',
            icon: 'success',
            timer: 5000,
            showCancelButton: false,
            timerProgressBar: true,
          })

        }
      },
      error: function (jqXHR, exception, data) {
        alertErrorAJAX(jqXHR, exception, data)
      },
    })
  }, 1)
}

function llamarPaciente(areaFisica) {
  //console.log(areaFisica)
  alertMensajeConfirm({
    title: '¿Deseas llamar a un paciente?',
    text: "Un paciente llamado se mostrará en pantalla",
    icon: "info",
    showCancelButton: true,
    confirmButtonColor: "#d33",
    cancelButtonColor: "#3085d6",
  }, function () {
    $.ajax({
      url: http + servidor + "/" + appname + "/api/turnero_api.php",
      type: 'POST',
      dataType: 'json',
      data: { api: 2, area_fisica_id: areaFisica },
      success: function (data) {
        if (mensajeAjax(data)) {
          let row = data.response.data[0];
          // miStorage.setItem('paciente_actual_turno', row['ID_TURNO'])
          // miStorage.setItem('paciente_actual_nombre', row['PACIENTE'])
          pacienteTurnoActivo.selectID = row['ID_TURNO'];
          pacienteTurnoActivo.setguardado(row['PACIENTE']);
          $('#paciente_turno').html(row['PACIENTE'])
          alertMsj({
            title: row['PACIENTE'],
            text: 'Es su siguiente paciente',
            icon: 'success',
            timer: 5000,
            showCancelButton: false,
            timerProgressBar: true,
          })
        }
      },
      error: function (jqXHR, exception, data) {
        alertErrorAJAX(jqXHR, exception, data)
      },
    })
  }, 1)
}

function liberarPaciente(areaFisica, turno) {
  alertMensajeConfirm({
    title: '¿Deseas liberar el turno de este paciente?',
    text: "El paciente volverá a la lista de espera.",
    icon: "info",
    showCancelButton: true,
    confirmButtonColor: "#d33",
    cancelButtonColor: "#3085d6",
  }, function () {
    $.ajax({
      url: http + servidor + "/" + appname + "/api/turnero_api.php",
      type: 'POST',
      dataType: 'json',
      data: { api: 1, area_fisica_id: areaFisica, turno_id: turno },
      success: function (data) {
        if (mensajeAjax(data)) {
          if (data.response.data == 1) {
            // miStorage.removeItem('paciente_actual_turno')
            // miStorage.removeItem('paciente_actual_nombre')
            pacienteTurnoActivo.selectID = null;
            pacienteTurnoActivo.setguardado(null);
            $('#paciente_turno').html('Liberado')
            alertMsj({
              title: "¡Paciente liberado!",
              text: "Ya puedes llamar a un nuevo paciente al área : )",
              icon: "success",
              showCancelButton: false,
              timer: 8000,
              timerProgressBar: true,
            })
          }
        }
      },
      error: function (jqXHR, exception, data) {
        alertErrorAJAX(jqXHR, exception, data)
      },
    })
  }, 1)
}

function pasarPaciente() {
  alertMensajeConfirm({
    title: '¿Deseas enviar un paciente a otra área disponible?',
    text: "No podrás revertir esta acción.",
    icon: "info",
    showCancelButton: true,
    confirmButtonColor: "#d33",
    cancelButtonColor: "#3085d6",
  }, function () {
    $.ajax({
      url: `${http}${servidor} / ${appname} / api / turnero_api.php`,
      type: 'POST',
      dataType: 'json',
      data: { api: 7 },
      success: function (data) {
        if (mensajeAjax(data)) {
          let row = data.response.data;
          // miStorage.setItem('paciente_actual_turno', row['ID_TURNO'])
          // miStorage.setItem('paciente_actual_nombre', row['PACIENTE'])
          pacienteTurnoActivo.selectID = row['ID_TURNO'];
          pacienteTurnoActivo.setguardado(row['PACIENTE']);
          // $('#paciente_turno').html(row['PACIENTE'])
          alertMsj({
            text: `Es el siguiente paciente en el área de ${row['AREA_FISICA']}.`,
            title: row['PACIENTE'],
            icon: 'success',
            timer: 5000,
            showCancelButton: false,
            timerProgressBar: true,
          })
        }
      },
      error: function (jqXHR, exception, data) {
        alertErrorAJAX(jqXHR, exception, data)
      },
    })
  }, 1)
}




// Validar la vista (OBSOLETOXD)
function redireccionarVista(vista, callback) {
  if (session.vista[vista] == 1 ? true : false) {
    callback();
  } else {
    window.location.href = http + servidor + '/' + appname + '/vista/login/';
  }
}



function DownloadFromUrl(fileURL, fileName) {
  var link = document.createElement('a');
  link.href = fileURL;
  link.download = fileName;
  document.body.appendChild(link);
  link.click();
  document.body.removeChild(link);
}

//Para el campo de preregistro
function deshabilitarVacunaExtra(vacuna, div) {
  if (vacuna != "OTRA") {
    $("#" + div).fadeOut(400);
  } else {
    $("#" + div).fadeIn(400);
  }
}

function desactivarCampo(div, fade) {
  if (fade == 1) {
    $(div).fadeIn(400);
  } else {
    $(div + ": input").val("");
    $(div).fadeOut(400);
  }
}

// Notifiación  movil
if (window.innerWidth <= 768) {
  position = 'top';
} else {
  position = 'top';
  // position = 'top-start';
}

const Toast = Swal.mixin({
  toast: true,
  position: position,
  showConfirmButton: false,
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
});

function isJson(str) {

  // //console.log(typeof str)

  if (typeof str === 'object') {
    return true;
  } else {
    return false;
  }
  // return false;
  // try {
  //   JSON.parse(str);
  // } catch (e) {
  //   return false;
  // }
  // return true;
}

// Obtener segmentos por procedencia en select
function getSegmentoByProcedencia(id, select) {
  return new Promise(resolve => {
    $('#' + select).find('option').remove().end()
    $.ajax({
      url: http + servidor + "/" + appname + "/api/segmentos_api.php",
      type: "POST",
      data: {
        id: id,
        api: 6
      },
      success: function (data) {
        var data = jQuery.parseJSON(data);
        if (mensajeAjax(data)) {
          if (data['response']['data'].length > 0) {
            for (var i = 0; i < data['response']['data'].length; i++) {
              var o = new Option("option text", data['response']['data'][i]['id']);
              $(o).html(data['response']['data'][i]['segmento']);
              $('#' + select).append(o);
            }
          } else {
            var o = new Option("option text", null);
            $(o).html('No contiene segmentos');
            $('#' + select).append(o);
          }
        }
      },
      complete: function () {
        resolve(1);
      },
      error: function (jqXHR, exception, data) {
        alertErrorAJAX(jqXHR, exception, data)
      },
    });
  });
}

function setSegmentoOption(select, idProcedencia, idSegmento) {
  var select = document.getElementById(select),
    length = select.options.length;
  while (length--) {
    select.remove(length);
  }
  $.ajax({
    url: http + servidor + "/" + appname + "/api/segmentos_api.php",
    type: "POST",
    data: {
      id: idProcedencia,
      api: 6
    },
    success: function (data) {
      var data = jQuery.parseJSON(data);
      if (mensajeAjax(data)) {
        if (data['response']['data'].length > 0) {
          for (var i = 0; i < data['response']['data'].length; i++) {
            var content = data['response']['data'][i]['segmento'];
            var value = data['response']['data'][i]['id'];
            var el = document.createElement("option");
            el.textContent = content;
            el.value = value;
            if (value == idSegmento) {
              el.selected = true;
            }
            select.appendChild(el);
          }
        } else {
          var content = "No contiene segmentos";
          var value = "";
          var el = document.createElement("option");
          el.textContent = content;
          el.value = value;

          select.appendChild(el);
        }
      }
    },
    error: function (jqXHR, exception, data) {
      alertErrorAJAX(jqXHR, exception, data)
    },
  });

  return true;
}


// Obtener procedencias en select
function getProcedencias(select) {
  return new Promise(resolve => {
    $('#' + select).find('option').remove().end()
    $.ajax({
      url: http + servidor + "/" + appname + "/api/clientes_api.php",
      type: "POST",
      data: {
        api: 2
      },
      dataType: "json",
      success: function (data) {
        if (mensajeAjax(data)) {
          for (var i = 0; i < data['response']['data'].length; i++) {
            var o = new Option("option text", data['response']['data'][i]['ID_CLIENTE']);
            $(o).html(data['response']['data'][i]['NOMBRE_COMERCIAL']);
            $('#' + select).append(o);
          }
        }
      },
      complete: function () {
        resolve(1);
      },
      error: function (jqXHR, exception, data) {
        alertErrorAJAX(jqXHR, exception, data)
      },
    })
  });
}


function setProcedenciaOption(select, idProcedencia) {
  var select = document.getElementById(select),
    length = select.options.length;
  while (length--) {
    select.remove(length);
  }
  $.ajax({
    url: http + servidor + "/" + appname + "/api/clientes_api.php",
    type: "POST",
    data: {
      api: 2
    },
    dataType: "json",
    success: function (data) {
      if (mensajeAjax(data)) {
        for (var i = 0; i < data['response']['data'].length; i++) {
          var content = data['response']['data'][i]['NOMBRE_COMERCIAL'];
          var value = data['response']['data'][i]['ID_CLIENTE'];
          var el = document.createElement("option");
          el.textContent = content;
          el.value = value;
          if (value == idProcedencia) {
            el.selected = true;
          }
          select.appendChild(el);

        }
      }
    },
    error: function (jqXHR, exception, data) {
      alertErrorAJAX(jqXHR, exception, data)
    },
  });
  return true;
}

// Obtener cargo y tipos de usuarios
function rellenarSelect(select = false, api, apinum, v, c, values = {}, callback = function (array) { }) {
  return new Promise(resolve => {
    values.api = apinum;

    let htmlContent;
    // Crear arreglo de contenido
    if (!Number.isInteger(c)) {
      htmlContent = c.split('.');
    }

    $(select).find('option').remove().end()

    $.ajax({
      url: http + servidor + "/" + appname + "/api/" + api + ".php",
      data: values,
      type: "POST",
      // dataType: "json",
      success: function (data) {

        if (typeof data == "string" && data.indexOf('response') > -1) {
          data = JSON.parse(data);
          if (!mensajeAjax(data))
            return false;
          data = data['response']['data'];
          // data = data['data'];
        } else {
          data = JSON.parse(data);
        }

        let selectHTML = '';
        for (const key in data) {
          if (Object.hasOwnProperty.call(data, key)) {
            const element = data[key];
            // Crear el contenido del select por numero o arreglo
            if (Array.isArray(htmlContent)) {
              datao = "";
              for (var a = 0; a < htmlContent.length; a++) {
                if (element[htmlContent[a]] != null) {
                  if (datao == '') {

                    datao += element[htmlContent[a]];
                  } else {
                    datao += " - " + element[htmlContent[a]];
                  }
                }
                // //console.log(datao)

              }
            } else {
              datao = element[c];
            }
            // Rellenar select con Jquery
            var o = new Option("option text", element[v]);
            $(o).html(datao);
            selectHTML += $(o)[0].outerHTML
            if (select) {
              $(select).append(o);
            }
          }
        }

        // //console.log(data);
        callback(data, selectHTML);
      },
      complete: function (data) {
        resolve(1);
      },
      error: function (jqXHR, exception, data) {
        alertErrorAJAX(jqXHR, exception, data)
      },
    })
  });
}

function setSelectContent(array, select, v, c, reset = 1, selected) {
  //console.log(array);
  if (reset) $(select).find('option').remove().end()
  for (const key in array) {
    if (Object.hasOwnProperty.call(array, key)) {
      const element = array[key];
      //console.log(element)
      var o = new Option("option text", element[v]);
      $(o).html(element[c]);
      $(select).append(o);
    }
  }
}


function optionElement(select, value, content) {
  var o = new Option("option text", value);
  $(o).html(content);
  $(select).append(o);
  el.setAttribute('selected', 'selected');
}


$(window).on('hashchange', function (e) {
  var hash = window.location.hash.substring(1);
  switch (hash) {
    case 'LogOut':
      // window.location.hash = '';
      window.location.href = http + servidor + '/' + appname + '/vista/login/';
      break;
    default:
      break;
  }
});

function getParameterByName(name) {
  name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
  var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
    results = regex.exec(location.search);
  return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}


function loader(fade, scroll = null) {
  if (fade == 'Out') {
    $("#loader").fadeOut(100);
    $('body').removeClass('overflow-hidden');
    // let alturanav = $('nav [class="navbar navbar-expand-lg border-3 border-bottom border-dark bg-navbar"]').height()
    // //console.log(alturanav)
    // $("html, body").animate({ scrollTop: alturanav + "px" });
    // alert("salir");
  } else if (fade == 'In') {
    $("html, body").animate({ scrollTop: "0px" });
    $("#loader").fadeIn(100);
    $('body').addClass('overflow-hidden')
    // alert("entrar");
  }
  if (scroll == 'bottom') {
    let altura = $(document).height();
    $("html, body").animate({ scrollTop: altura + "px" });
  }


}

function loaderDiv(fade, div = null, loader, loaderDiv1 = null, seconds = 50, scroll = 0) {
  switch (fade) {
    case "Out":
      if (div != null) {
        $(div).fadeIn(seconds);
      }

      if (loaderDiv1 != null) {
        $(loaderDiv1).fadeOut(seconds);
      }
      $(loader).fadeOut(seconds);
      // alert("salir");
      break;

    case "In":
      if (div != null) {
        $(div).fadeOut(seconds);
      }
      if (loaderDiv1 != null) {
        $(loaderDiv1).fadeIn(seconds);
      }
      $(loader).fadeIn(seconds);
      // alert("entrar");
      break;

    default:
    // //console.log('LoaderDiv se perdió...')
  }
  // if (scroll == 'bottom') {
  //   let altura = $(document).height();
  //   $("html, body").animate({ scrollTop: altura + "px" });
  // }
}

//Poder ajustar responsivamente una ventana en windows
function autoHeightDiv(div, resta, tipe = 'px') {
  var ventana_alto = $(window).height();
  ventana_alto_porcentaje = Math.floor(ventana_alto * resta) / 100;

  if (div == 0) {
    if (tipe == 'px')
      return (ventana_alto - resta);
    if (tipe == '%')
      return (ventana_alto_porcentaje);
  } else {
    if (tipe == 'px')
      $(div).height(ventana_alto - resta);
    if (tipe == '%')
      $(div).height(ventana_alto_porcentaje);
    return 0;
  }
}

// Mismas funciones, diferentes nombres por no querer cambiar el nombre donde lo llaman xd
function alertSelectTable(msj = 'No ha seleccionado ningún registro', icon = 'error', timer = 2000) {
  Toast.fire({
    icon: icon,
    title: msj,
    timer: timer,
    // width: 'auto'
  });
}

function alertToast(msj = 'No ha seleccionado ningún registro', icon = 'error', timer = 3000) {
  Toast.fire({
    icon: icon,
    title: msj,
    timer: timer,
    // width: 'auto'
  });
}
// 


function alertMensaje(icon = 'success', title = '¡Completado!', text = 'Datos completados', footer = null, html = null, timer = null) {
  Swal.fire({
    icon: icon,
    title: title,
    text: text,
    html: html,
    footer: footer,
    timer: timer
    // width: 'auto',
  })
}

function alertMsj(options, callback = function () { }) {

  // Configuración predeterminada
  options = setConfig(
    {
      "title": "¿Desea realizar esta acción?",
      "text": "Probablemente no podrá revertirlo",
      "icon": "warning",
      "showCancelButton": true,
      showConfirmButton: true,
      "confirmButtonColor": "#3085d6",
      "cancelButtonColor": "#d33",
      "confirmButtonText": "Aceptar",
      "cancelButtonText": "Cancelar",
      "allowOutsideClick": false,
      allowEscapeKey: true,
    }
    , options)


  Swal.fire(options).then((result) => {
    callback(result);
  })
}

function alertMensajeConfirm(options, callback = function () { }, set = 0, callbackDenied = function () { }, callbackCanceled = function () {

}) {

  //Options si existe
  switch (set) {
    case 1:
      if (!options.hasOwnProperty('title'))
        options['title'] = "¿Desea realizar esta acción?"

      if (!options.hasOwnProperty('text'))
        options['text'] = "Probablemente no podrá revertirlo"

      if (!options.hasOwnProperty('icon'))
        options['icon'] = 'warning'

      if (!options.hasOwnProperty('showCancelButton'))
        options['showCancelButton'] = true

      if (!options.hasOwnProperty('confirmButtonColor'))
        options['confirmButtonColor'] = '#3085d6'

      if (!options.hasOwnProperty('cancelButtonColor'))
        options['cancelButtonColor'] = '#d33'

      if (!options.hasOwnProperty('confirmButtonText'))
        options['confirmButtonText'] = 'Aceptar'

      if (!options.hasOwnProperty('cancelButtonText'))
        options['cancelButtonText'] = 'Cancelar'

      if (!options.hasOwnProperty('allowOutsideClick'))
        options['allowOutsideClick'] = false
      // if (options.hasOwnProperty('timer'))
      //   options['timer'] = 4000
      // if (options.hasOwnProperty('timerProgressBar'))
      //   options['timerProgressBar'] = true
      //
      break;
    default:
      if (!options) {
        options = {
          title: "¿Desea realizar esta acción?",
          text: "Probablemente no podrá revertirlo",
          icon: "info",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Aceptar",
          cancelButtonText: "Cancelar",
          // allowOutsideClick: false
          // timer: 4000,
          // timerProgressBar: true,
          //   showDenyButton: true,
          // denyButtonText: `Don't save`,
          // denyButtonColor: "#d33";
        }
      }
      break;
  }


  Swal.fire(options).then((result) => {
    if (result.isConfirmed || result.dismiss === "timer") {
      callback()
    } else if (result.isDenied) {
      callbackDenied();
    } else if (result.dismiss === Swal.DismissReason.cancel) {
      callbackCanceled();
    }
  })
}

//Valida la  contraseña del usuario para ejecutar algunas acciones
function alertPassConfirm(alert = {
  title: 'Titulo por defecto :)',
  icon: 'info'
}, callback = () => { }) {
  Swal.fire({
    title: alert['title'],
    // text: 'Se creará el grupo con los pacientes seleccionados, ¡No podrás revertir los cambios',
    icon: alert['icon'],
    showCancelButton: true,
    confirmButtonText: 'Confirmar',
    cancelButtonText: 'Cancelar',
    showLoaderOnConfirm: true,
    // inputAttributes: {
    //   autocomplete: false
    // },
    // input: 'password',
    html: `<form autocomplete="off" onsubmit="formpassword(); return false;"><input type="password" id="password-confirmar" class="form-control input-color" autocomplete="off" placeholder="${alert['placeholder'] ? alert['placeholder'] : 'Ingrese su contraseña para confirmar'}"></form>`,
    // confirmButtonText: 'Sign in',
    focusConfirm: false,
    didOpen: () => {
      const passwordField = document.getElementById('password-confirmar');
      passwordField.setAttribute('autocomplete', 'new-password');
    },
    preConfirm: () => {
      const password = Swal.getPopup().querySelector('#password-confirmar').value;


      switch (alert['fetch']) {
        case 'turnero':
          url_fetch = `${http}${servidor}/${appname}/api/turnero_api.php?api=8&clave_secreta=${password}`
          break;

        default:
          url_fetch = `${http}${servidor}/${appname}/api/usuarios_api.php?api=9&password=${password}`
          break;
      }


      return fetch(url_fetch)
        .then(response => {
          if (!response.ok) {
            throw new Error(response.statusText)
          }
          return response.json()
        })
        .catch(error => {
          Swal.showValidationMessage(
            `Request failed: ${error}`
          )
        });
    },
    allowOutsideClick: () => !Swal.isLoading()
  }).then((result) => {
    if (result.isConfirmed) {
      if (result.value.status == 1) {
        callback();
      } else {
        alertSelectTable('¡Está incorrecto!', 'error')
      }
    }


  })
}

function formpassword() {
  //No submit form with enter

}

// Levenshtein
function detectCoincidence(input, api, config = {}) {
  // alert(1);
  $(document).on('change', `${input}`, function (e) {
    // alert(2);
    e.preventDefault();

    ajaxAwait({
      api: 5, nombre_medico: $(input).val(),
    }, 'medicos_tratantes_api', { callbackAfter: true }, false, (data) => {

      const names = data.response.data;

      const html = names.map(name => {
        return `<span class="chip btn-pantone-7541 ">${name}</span>`;
      }).join(' ');

      if (html !== '') {
        $(`#${'suggestionsList'}`).html(html);
        $(`#${'suggestionsBox'}`)
          .removeClass('d-none')
          .addClass('animate__animated animate__fadeIn');
      } else {
        $(`#${'suggestionsBox'}`).addClass('d-none');
      }
    });

    // Añadir listener de clic a los chips
    $(".chip").click(function () {
      const textToCopy = $(this).text();
      const tempInput = $("<input>");
      $("body").append(tempInput);
      tempInput.val(textToCopy).select();
      document.execCommand("copy");
      tempInput.remove();

      alertToast("Nombre copiado: " + textToCopy, 'info');
    });
  });
}



function mensajeAjax(data, modulo = null) {
  if (modulo != null) {
    text = ' No pudimos cargar'
  }

  try {
    switch (data['response']['code']) {
      case 1:
        return 1;
        break;
      case 2:
        Swal.fire({
          icon: 'error',
          title: 'Oops...',
          text: '¡Ha ocurrido un error!',
          footer: 'Respuesta: ' + data['response']['msj']
        })
        break;
      case "repetido":
        Swal.fire({
          icon: 'error',
          title: 'Oops...',
          text: '¡Usted ya está registrado!',
          footer: 'Utilice su CURP para registrarse en una nueva prueba'
        })
        break;
      case "login":
        Swal.fire({
          icon: 'error',
          title: 'Oops...',
          text: 'Respuesta: ' + data['response']['msj']
        })
        break;
      case "Token": case "Usernovalid":
        alertMensajeConfirm({
          title: "¡Sesión no valida!",
          text: "El token de su sesión ha caducado, vuelva iniciar sesión",
          footer: "Redireccionando pantalla...",
          icon: "info",
          confirmButtonColor: "#d33",
          confirmButtonText: "Aceptar",
          cancelButtonText: false,
          allowOutsideClick: false,
          timer: 4000,
          timerProgressBar: true,
        }, function () {
          destroySession();
          window.location.replace(http + servidor + "/" + appname + "/vista/login/");
        })

        break;
      case "turnero":
        alertMensajeConfirm({
          title: "Oops",
          text: `${data['response']['msj']}`,
          footer: "Tal vez deberias intentarlo nuevamente",
          icon: "warning",
        })

        break;
      default:
        Swal.fire({
          icon: 'error',
          title: 'Oops...',
          text: 'Hubo un problema!',
          footer: 'No sabemos que pasó, reporta este problema...'
        })
    }
  } catch (error) {
    alertMensaje('warning', 'Error:', 'No se puedo resolver un conflicto interno con validación, si el problema persiste reporte al encargado de area de esto.', '[Error: api no valida, "response: {code: XXXX}", no existe]')
    return 0
  }
  return 0;
}

function alertErrorAJAX(jqXHR, exception, data) {
  var msg = '';
  //Status AJAX
  // console.log(jqXHR, exception, data)

  switch (jqXHR.status) {
    case 0:
      if (exception != 'abort') {
        alertToast('Sin conexión a internet', 'warning'); return 0
      };
    case 404: //console.log('Requested page not found. [404]'); return 0;
    case 500: alertToast('Internal Server Error', 'info'); return 0;
  }

  switch (exception) {
    case 'parsererror': alertMensaje('info', 'Error del servidor', 'Algo ha pasado, estamos trabajando para resolverlo', 'Mensaje de error: ' + data); return 0
    case 'timeout': //console.log('timeout'); return 0
    case 'abort': return 0
  }

  //console.log(jqXHR.responseText);

}

// $(document).on('click', '#btn-beneficiarios-ujat', function (e) {
//   if (session['permiso']['ExcelInfoBeneUjat']) {
//     $.post("", {
//       tipModalDocumento: 'ExcelInfoBeneUjat'
//     }, function (html) {
//       $("#header-js").html(html);
//     });
//   }
// })




let touchtimeFunction
function detectDobleclick() {
  if (touchtimeFunction == 0) {
    // set first click
    touchtimeFunction = new Date().getTime();
    return false;
  } else {
    // compare first click to this click and see if they occurred within double click threshold
    if (((new Date().getTime()) - touchtimeFunction) < 800) {
      // double click occurred
      touchtimeFunction = 0;
      return true;
    } else {
      // not a double click so set as a new first click
      touchtimeFunction = new Date().getTime();
      return false;
    }
  }
}


//FUNCTION OBSOLETA PARA MOBILE
//Control de tablas
function dblclickDatatable(tablename, datatable, callback = function () { }) {
  // Seleccion del registro
  $(tablename).on('dblclick', 'tr', function () {
    callback(datatable.row(this).data())
  });
}
//

//Solo doble click
var dobleClickSelecTable = false; //Ultimo select ()
function selectDatatabledblclick(callback = function (selected, data) { }, tablename, datatable, disabledDblclick = false) {
  // console.log(tablename)
  if (!disabledDblclick)
    dobleClickSelecTable = false
  $(tablename).on('click', 'tr', function () {
    if (!detectDobleclick())
      return false;
    //Funcion
    if (dobleClickSelecTable != datatable.row(this).data()) {
      //console.log($(this).hasClass('selected'))
      if ($(this).hasClass('selected') == true) {
        dobleClickSelecTable = false
        datatable.$('tr.selected').removeClass('selected');
        // array_selected = datatable.row(this).data()

        return callback(0, null, row);
      }
    }
    if (disabledDblclick == false)
      dobleClickSelecTable = datatable.row(this).data()
    datatable.$('tr.selected').removeClass('selected');
    $(this).addClass('selected');
    array_selected = datatable.row(this).data()
    return callback(1, array_selected, this)

  });
}
$.fn.dataTable.ext.errMode = 'throw';
//Doble y de solo un click
var dobleClickSelecTable = false; //Ultimo select ()
function selectDatatable(tablename, datatable, panel, api = {}, tipPanel = {}, idPanel = {
  0: "#panel-informacion"
}, callback = null, callbackDoubleclick = function (data) {
  console.log('hAzZ dAdo dobBlE cLIk aLa TabBlLa')
}) {
  //Se deben enviar las ultimas 3 variables en arreglo y deben coincidir en longitud
  // //console.log(typeof tipPanel);
  if (typeof tipPanel == "string") {
    // Convierte String a Object
    api = {
      0: api
    };
    tipPanel = {
      0: tipPanel
    };
  } else {
    // Coloca por defecto la ID de panel si no existe ID de envio
    if (idPanel[0] == null) {
      idPanel[0] = "#panel-informacion";
    }
  }
  if (typeof tablename === 'string') {
    tablename = '#' + tablename;
  }
  // //console.log(tablename)
  // //console.log(idPanel)
  $(tablename).on('click', 'tr', function () {

    //Doble Click
    if (detectDobleclick()) {
      if (dobleClickSelecTable == datatable.row(this).data()) {
        callbackDoubleclick(datatable.row(this).data())
      }
    }

    //Solo un click
    if (dobleClickSelecTable != datatable.row(this).data()) {
      if ($(this).hasClass('selected')) {
        dobleClickSelecTable = false
        $(this).removeClass('selected');
        for (var i = 0; i < Object.keys(tipPanel).length; i++) {
          obtenerPanelInformacion(0, api, tipPanel[i], idPanel[i])
        }
        if (callback != null) {
          return callback(0, null);
        }
      } else {
        dobleClickSelecTable = datatable.row(this).data();
        datatable.$('tr.selected').removeClass('selected');
        $(this).addClass('selected');
        array_selected = datatable.row(this).data();
        if (array_selected != null) {
          if (panel) {
            // Lee los 3 objetos para llamar a la funcion
            for (var i = 0; i < Object.keys(tipPanel).length; i++) {
              obtenerPanelInformacion(array_selected['ID_TURNO'], api[i], tipPanel[i], idPanel[i])
            }
          }
          if (callback != null) {
            // alert('select')
            // //console.log(array_selected)
            return callback(1, array_selected); // Primer parametro es seleccion y segundo el arreglo del select del registro
          }
        } else {
          for (var i = 0; i < Object.keys(tipPanel).length; i++) {
            obtenerPanelInformacion(0, api, tipPanel[i], idPanel[i])
          }
          if (callback != null) {
            return callback(0, array_selected);
          }
        }

      }
    } else {
      // //console.log(false)
    }
  })
}

//
function inputBusquedaTable(
  tablename, //<-- Sin #
  datatable, //<-- TablaObjeto
  tooltip = [
    {
      msj: 'Hola, soy un tooltip por defecto :)',
      place: 'bottom'
    },
    {
      msj: 'Aqui puedo ocultar mensajes para ayudarte',
      place: 'right'
    }
  ], //<- tooltips
  tooltipinput =
    {
      msj: 'Filtra la lista por coincidencias',
      place: 'top'
    },
  classInput = 'col-sm-12 col-md-6',
  classList = 'col-sm-12 col-md-6',
) {
  setTimeout(() => {
    // Obtener elementos
    const select = $(`#${tablename}_length label select`).first();
    const filterDiv = $(`#${tablename}_filter`).first();
    const input = $(`#${tablename}_filter label input`).first();
    const label = $(`#${tablename}_filter label`).first();

    // Configurar tooltips
    tooltipinput['msj'] = tooltipinput['msj'] || 'Filtra la lista por coincidencias';
    tooltipinput['place'] = tooltipinput['place'] || 'top';

    select.removeClass().addClass('input-form');
    removeTextNode(label);

    input.removeClass().addClass('input-form form-control')
      .attr({
        'placeholder': "Filtrar coincidencias",
        'style': 'margin: 0px !important',
        'data-bs-toggle': "tooltip",
        'data-bs-placement': tooltipinput['place'],
        title: tooltipinput['msj']
      });

    const newDivElement = $('<div>').addClass('text-center mt-2');
    const newInputGroupDiv = $('<div>').addClass('input-group flex-nowrap');
    newInputGroupDiv.append(createTooltipHtml(tooltip)).append(input);
    newDivElement.append(newInputGroupDiv);

    filterDiv.after(newDivElement);
    $(`#${tablename}_wrapper`).children('div [class="row"]').eq(1).css('zoom', '90%');

    let divList = filterDiv.parent();
    divList.removeClass('col-sm-12 col-md-6');
    divList.addClass(classInput)

    filterDiv.empty();

  }, 300);

}

function removeTextNode(node) {
  node.contents().filter(function () {
    return this.nodeType === 3; // Filtra los nodos de texto
  }).remove();
}

function createTooltipHtml(tooltipData) {
  let html = '';
  for (const key in tooltipData) {
    if (Object.hasOwnProperty.call(tooltipData, key)) {
      const element = tooltipData[key];
      html += `
                <span class="input-span" id="addon-wrapping" data-bs-toggle="tooltip" 
                    data-bs-placement="${element['place']}" title="${element['msj']}" 
                    style="margin-bottom: 0px !important">
                    <i class="bi bi-info-circle"></i>
                </span>`;
    }
  }
  return html;
}
//


//Detecta la dimension del dispositivo para saber si es movil o escritorio
function isMovil(callback = (response) => { }) {
  var esTabletaVertical = /iPad/i.test(navigator.userAgent)
  // && window.innerHeight > window.innerWidth;
  var esDispositivoMovil = /Android|webOS|iPhone|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) || esTabletaVertical;

  if (esDispositivoMovil)
    callback(esDispositivoMovil);
  return esDispositivoMovil;

  let width = window.innerWidth;
  let height = window.innerHeight;

  if ((width <= 768 && height <= 1366) || (height <= 1366 && width <= 1366)) {
    callback(true);
    return true;
  } else {
    return false;
  }
}

//Visualiza los botones de navegacion
function selecTableTabs() {
  isMovil() ? $('.tab-page-table').fadeIn(0) : $('.tab-page-table').fadeOut(0);
}

// Para la version movil crea y visualiza columnas
function getBtnTabs(config, reloadName) {
  if (config.tabs) {
    let row = config.tabs;
    let html = `<ul class="nav nav-tabs mt-2 tab-page-table" style="display:none">`;
    for (const key in row) {
      if (Object.hasOwnProperty.call(row, key)) {
        const element = row[key];

        html += `<li class="nav-item">
                    <a class="nav-link ${element.class ? element.class : ''} tab-table" data-id-column="${element['element']}" data-reload-column="${reloadName}" id="tab-btn-${element.title}" style="cursor: pointer">${element.title}</a>
                  </li>`;
      }
    }
    html += `</ul>`
    $(config['tab-id']).html(html)

    return true;
  }
}

//Visualiza la columna solo en movil
let dinamicTabFunction = false;
let documentClick = false;
let loader_selectTable = false;  //No usar, en desuso global, solo en selectTable
function dinamicTabs() {
  // dinamicTabFunction = false;
  // // loader = loader
  // isMovil(() => {
  //   dinamicTabFunction = () => {
  //     // console.log('IS MOVIL')
  //     documentClick = false;
  //     // documentClick = 
  //   }

  //   dinamicTabFunction();
  // })

}

// Cambio de tab
$(document).on('click', '.tab-table', function () {
  // loader = loader
  let btn = $(this);
  isMovil(() => {
    if (!btn.hasClass('active')) {

      $('.tab-first').fadeOut(100);
      $('.tab-second').fadeOut(0);

      $('.tab-table').removeClass('active');
      btn.addClass('active');

      setTimeout(() => {
        let id = btn.attr('data-id-column');
        let loader = btn.attr('data-reload-column');
        // console.log(id);
        let loaderVisible = false;

        // console.log(loader_selectTable)
        loaderVisible = function () {
          // console.log($(loader_selectTable))
          if ($(loader).is(":hidden")) {
            $(`${id}`).fadeIn(100);
            $.fn.dataTable
              .tables({
                visible: true,
                api: true
              })
              .columns.adjust();

            loaderVisible = false;
          } else {
            // console.log(loader)
            setTimeout(() => {
              loaderVisible();
            }, 150);
          }
        }
        loaderVisible()
      }, 100);
    }
  })
})

//Agrega el circulo para cargar el panel
function setReloadSelecTable(name, param) {
  let html = `<div class="col-12 col-xl-9 d-flex justify-content-center align-items-center" id='loaderDiv-${name}' style="max-height: 75vh; display:none">
    <div class="preloader" id="loader-${name}"></div>
  </div>`;

  $('#reload-selectable').addClass(`col-12 ${param[0]} d-flex justify-content-center align-items-center`)
  $('#reload-selectable').css('max-height', '75vh')
  $('#reload-selectable').attr("style", "display: none !important");
  $('#reload-selectable').html(`<div class="preloader" id="loader-${name}"></div>`)
  $('#reload-selectable').addClass('loader-tab')

  // $('#reload-selectable').fadeOut('slow');
  $('#reload-selectable').attr('id', `loaderDiv-${name}`)
}

// Sin uso
function reloadSelectTable() {
  if (isMovil()) {
    //Manda al principio
    try {
      $(`.tab-table`)[0].click();
    } catch (error) {
      console.log('BTN class: tab-table not found')
    }
    $('.loader-tab').fadeOut(0)
  } else {
    $('.tab-second').fadeOut();
    // console.log($('.tab-first'))
    $('.tab-first').fadeIn();
    $('.loader-tab').fadeOut(0)
  }

}

//Evalua el estado de click de selectTable
// Arreglo de clases a ignorar
let ignoredClasses = [
  'noClicked', //Algun elemento que podamos crear para que no implique selección
  'dtr-control', //Cuando le da click al primer td con el boton + de visualizar mas columnas
  'child',  //Cuando muestra las columnas ocultas de un regitro
  'dataTables_empty', //Cuando la  tabla esta vacia, no selecciona
];
// Función para verificar si un elemento tiene alguna de las clases ignoradas
const hasIgnoredClass = (elem) => ignoredClasses.some(className => elem.classList.contains(className));

function eventClassClick(event, tr, config, data) {
  //Evalua donde está dando click el usuario
  var clickedElement = event.target;
  ignoredClasses.push(config.ignoreClass) //Ignora el click por algun objeto en clase
  // var computedStyle = window.getComputedStyle(clickedElement, '::before');
  // computedStyle.getPropertyValue('property') === 'value'
  // console.log(computedStyle.getPropertyValue('property') === 'value')
  //Cancela la funcion si el elemento que hace click tiene la siguiente clase
  if (hasIgnoredClass(clickedElement)
    || hasIgnoredClass(tr)
    || $(tr).find('td').hasClass('dataTables_empty') //Ignora si no hay datos que mostrar (serverside)
  )
    return [true, false];

  //Evalua si hay eventos extras que ejecutar
  let rowClick = config.ClickClass;
  for (const key in rowClick) {
    if (Object.hasOwnProperty.call(rowClick, key)) {
      const element = rowClick[key];

      if ($(clickedElement).hasClass(`${element.class}`)) {
        element.callback(data, clickedElement, tr)
        return [true, element.selected];
      }

    }

  }

  return [false, false];
}

function resizeConfigMovil(config, loaderName) {
  if (config.movil) {
    //Cambia la vista del dispositivo
    getBtnTabs(config, loaderName);
    //Activa los botones si es movil
    // console.log(`#loaderDiv-${nameTable}`)

    dinamicTabs()
    //Evalua el tipo de dispositivo
    selecTableTabs()
  }
}

//selectDataTableMovilEdition
let dataDobleSelect, selectTableTimeOutClick, selectTableClickCount = 0, selectCounTableTime = false;
function selectTable(tablename, datatable,
  config = {
    dblClick: false,
  },
  callbackClick = (select = 1, dataRow = [], callback, tr = '1', row = []) => { },
  callbackDblClick = (select = 1, dataRow = [], callback, tr = '1', row = []) => { }
) {
  //manda valores por defecto
  config = setConfig(
    {
      dblClick: false, // Aceptar doble click
      unSelect: false, // Deseleccionar un registro
      anotherClass: 'other-for-table', //Cuando sea seleccionado, se agrega la clase, sino se quita
      ignoreClass: '',
      tabs: [
        {
          title: 'Pacientes',
          element: '#tab-paciente',
          class: 'active',
        },
        {
          title: 'Información',
          element: '#tab-informacion',
          class: 'disabled tab-select'
        },
        {
          title: 'Reporte',
          element: '#tab-reporte',
          class: 'disabled tab-select'
        },
      ],
      "tab-id": '#tab-button',
      "tab-default": 'Reporte',  //Por default, al dar click, abre aqui
      reload: false, //Activa la rueda [Example:  reload: ['col-xl-9'] ]
      movil: false, //Activa la version movil
      multipleSelect: false,
      OnlyData: false,
      noColumns: false,
      // alwaySelected: false,
      ClickClass: [
        {
          class: '.',
          callback: function (data) {

          },
          selected: true
        },
        {
          class: '.',
          callback: function (data) {

          },
          selected: false
        }
      ],
      divPadre: false, //Busca dentro del div las clases, si no hay buscará cualquiera
      timeOut: false // Mantiene un tiempo de espeera entre clicks ( {time: 1000} )
    }, config)

  //Nombrando para usarlo
  let tableString = tablename.replace('#', '')

  //Permite el reload y lo dibuja
  if (config.reload)
    setReloadSelecTable(tableString, config.reload)

  loader_selectTable = `#loaderDiv-${tableString}`
  //Activa las funciones moviles,
  resizeConfigMovil(config, loader_selectTable);
  resize = false;
  // $(window).resize(function () {
  //   //Toma un tiempo para poder refrescar cambios y no 
  //   //hacerlo cada vez que hay un pequeño pixel de cambio
  //   clearTimeout(resize);
  //   resize = setTimeout(() => {
  //     resizeConfigMovil(config, nameTable);
  //   }, 500);
  // })

  //Callback para procesos, ejemplo: quitar loader y mostrar columnas en escritorio
  let callback = (type = 'Out' || 'In') => {
    if (type === 'In') {
      if (!isMovil() || !config.movil) {
        $('.tab-second').fadeIn(200)
      }

      $.fn.dataTable
        .tables({
          visible: true,
          api: true
        })
        .columns.adjust();

    }
    $(loader_selectTable).attr("style", "display: none !important");

    if (config.timeOut)
      // Termina el tiempo de espera de los objetos seegun lo programado
      selectCounTableTime = false;
  }


  //Table Click Registro
  $(`${tablename}`).on(`click`, `tr`, function (event) {

    if (selectCounTableTime && config.timeOut)
      return 'No action';

    if (config.timeOut)
      // Da un tiempo de espera
      selectCounTableTime = true;


    //Obtener datos, tr, row e información del row
    let tr = this
    let row = datatable.row(tr);
    let dataRow = row.data();

    // let td = $(event.target).is('td')

    // Verifica si el clic se hizo en un enlace o dentro de un enlace
    if ($(event.target).closest('a').length) {
      // Si el clic fue dentro de un enlace, simplemente sal de la función.
      // Esto permitirá que el comportamiento predeterminado del enlace se ejecute sin interferencias.
      return;
    }


    //Evalua si el objeto es correcto a su click
    let dataClick = eventClassClick(event, tr, config, dataRow);
    if (dataClick[0]) {
      //Verifica si deseas seleccionar o no 
      if (dataClick[1]) {
        //Verifica si ya esta seleccionado
        if (!$(tr).hasClass('selected')) {

          //Reselecciona el tr que interactuas
          selectTable_resetSelect(tr, config)

          //Activar otros tab
          $(`.tab-select`).removeClass('disabled');
          //Reselecciona
          if (config['tab-default']) {
            $(`#tab-btn-${config['tab-default']}`).click();
          }
          //Ejecuta funcion personalizada
          callbackClick(1, dataRow, callback, tr, row);
        }
      }

      return false;
    }

    // Si desea solo obtener los datos
    if (config.OnlyData) {
      return callbackClick(1, dataRow, function (data) { return 'No action' }, tr, row);
    }


    array_selected = row.data();

    selectTableClickCount++;

    if ($(tr).hasClass('selected')) {

      clearTimeout(selectTableTimeOutClick)


      selectTableTimeOutClick = setTimeout(function () {
        if (selectTableClickCount === 1 && config.unSelect === true) {
          //Manda a cargar la vista
          if (!config.noColumns) {
            selectTable_cargarVista()
          }

          //Resetea los clicks:
          selectTableClickCount = 0;
          dataDobleSelect = false;

          //Reinicia la seleccion:
          selectTable_resetSelect(tr, false, true)
          //

          if (config.multipleSelect) {
            //Multiple Seleccion
            //Hará el callback cada que seleccionan a uno nuevo
            let row_length = datatable.rows('.selected').data().length
            let data = datatable.rows('.selected').data()

            callbackClick(row_length, data, null, null)

          } else {


            //Desactivar otros tab
            $(`.tab-select`).addClass('disabled')

            //Regresa la funcion personalizada
            callbackClick(0, null, callback, null, null);
            //
          }
        } else if (selectTableClickCount === 2 && config.dblClick === true) {
          //Si esta haciendo dobleClick: 
          selectTableClickCount = 0;

          callbackDblClick(1, dataRow, callback, tr, row)

        }

      }, 200)

    } else {
      //Manda a cargar la vista
      if (!config.noColumns) {
        selectTable_cargarVista()
      }

      //Si esta seleccionando:
      dataDobleSelect = tr;
      //Tiempo de espera entre multiple click


      //Evalua la selección
      selectTable_resetSelect(tr, config)

      if (config.multipleSelect) {
        //Multiple Seleccion
        //Hará el callback cada que seleccionan a uno nuevo
        let row_length = datatable.rows('.selected').data().length
        let data = datatable.rows('.selected').data()

        callbackClick(row_length, data, null, null)

      } else {
        //Para una sola seleccion

        //Activar otros tab
        $(`.tab-select`).removeClass('disabled');
        //Reselecciona

        if (config['tab-default']) {
          $(`#tab-btn-${config['tab-default']}`).click();
        }

        callbackClick(1, dataRow, callback, tr, row);
      }

    }

    //Reinicia y espera el dobleClick
    setTimeout(() => {
      selectTableClickCount = 0;
      if (config.timeOut)
        selectCounTableTime = false;
    }, 600)

    return 'No action';

  })



  function selectTable_cargarVista() {
    if (config.divPadre) {
      $(`${config.divPadre} .tab-second`).fadeOut()
    } else {
      $('.tab-second').fadeOut()
    }

    // console.log($(loader_selectTable))
    if (config.reload)
      $(loader_selectTable).fadeIn(0);
  }

  function selectTable_resetSelect(tr, config, resetTR = false) {

    //Deselecciona solo 1
    if (resetTR) {
      $(tr).removeClass('selected');
      $(tr).removeClass(config.anotherClass);
      return true;
    }


    if (!config.multipleSelect) {
      //Reinicia la seleccion:
      datatable.$('tr.selected').removeClass('selected');
      datatable.$('tr.selected').removeClass(config.anotherClass);
      //
    }

    //Agrega la clase para indicar que lo esta seleccionando
    $(tr).addClass('selected');
    $(tr).addClass(config.anotherClass);

    return true;
  }
}


//Panel, este panel se usa ahora en la funcion selectTable, resolviendo el bug
function getPanel(divClass, loader, loaderDiv1, selectLista, fade, callback) { //selectLista es una variable que no se usa 
  switch (fade) {
    case 'Out':
      if ($(divClass).is(':visible')) {
        if (selectLista == null) {
          loaderDiv("Out", null, loader, loaderDiv1, 0);
          $(divClass).fadeOut()
          // //console.log('Invisible!')
        }
      } else {
        // //console.log('Todavia visible!')
        setTimeout(function () {
          return getPanel(divClass, loader, loaderDiv1, selectLista, 'Out')
        }, 100);
      }
      break;
    case 'In':
      $(divClass).fadeOut(0)
      loaderDiv("In", null, loader, loaderDiv1, 0);
      // alert('in');
      return callback(divClass);
      // $(divClass).fadeIn(100)
      break;
    default:
      return 0
  }
  return 1
}

function bugGetPanel(divClass, loaderLo, loaderDiv1, table = '') {
  loaderDiv("Out", null, loaderLo, loaderDiv1, 0);
  while (!$(divClass).is(':visible')) {
    if (!$(divClass).is(':visible')) {
      setTimeout(function () {
        $(divClass).fadeIn(0)
        // loader(0, 'bottom')
        // //console.log("Visible!")
      }, 100)
    }
    $(divClass).fadeIn(0)
  }
  // let altura = $(document).height();
  // $("html, body").animate({ scrollTop: altura + "px" });
}
//

// Antecedentes del paciente
function obtenerAntecedentesPaciente(id, curp, tipo = 1) {
  return new Promise(resolve => {
    let arrayDivs = new Array;
    let api = 10;
    //Antecedentes
    var divPatologicos = $('#collapse-Patologicos-Target').find("div[class='row d-flex justify-content-center'], div[class='row d-flex']")
    arrayDivs['ANTECEDENTES PERSONALES PATOLOGICOS'] = divPatologicos
    var divNoPatologicos = $('#collapse-nopatologicos-Target').find("div[class='row d-flex justify-content-center'], div[class='row d-flex']")
    arrayDivs['ANTECEDENTES NO PATOLOGICOS'] = divNoPatologicos
    var divHeredofamiliares = $('#collapse-anteHeredo-Target').find("div[class='row d-flex justify-content-center']")
    arrayDivs['ANTECEDENTES HEREDOFAMILIARES'] = divHeredofamiliares
    var divPsicologicos = $('#collapse-antPsico-Target').find("div[class='row d-flex justify-content-center']")
    arrayDivs['ANTECEDENTES PSICOLOGICOS/PSIQUIATRICOS'] = divPsicologicos
    var divNutricionales = $('#collapse-antNutri-Target').find("div[class='row d-flex justify-content-center']")
    arrayDivs['ANTECEDENTES NUTRICIONALES'] = divNutricionales
    var divGinecologidos = $('#collapse-antGine-Target').find("div[class='row']")
    arrayDivs['ANTECEDENTES GINECOLÓGICOS'] = divGinecologidos
    // var divLaboral = $('#collapse-MedLabo-Target').find("div[class='row d-flex justify-content-center']")
    var divLaboral = $('#collapse-MedLabo-Target').find("div[class='row d-flex justify-content-center'], div[class='row d-flex']")
    arrayDivs['MEDIO LABORAL'] = divLaboral

    var divsisteCardio = $('#collapse-sub-sisteCardio-Target').find("div[class='row']")
    arrayDivs['SISTEMA CARDIOVASCULAR'] = divsisteCardio
    var divAparaRespiratorio = $('#collapse-sub-AparaRespiratorio-Target').find("div[class='row']")
    arrayDivs['APARATO RESPIRATORIO'] = divAparaRespiratorio
    var divaparatoDigestivo = $('#collapse-sub-aparatoDigestivo-Target').find("div[class='row']")
    arrayDivs['APARATO DIGESTIVO'] = divaparatoDigestivo
    var divaparatoGenitourina = $('#collapse-sub-aparatoGenitourina-Target').find("div[class='row']")
    arrayDivs['APARATO GENITOURINARIO'] = divaparatoGenitourina
    var divsistemNervios = $('#collapse-sub-sistemNervios-Target').find("div[class='row']")
    arrayDivs['SISTEMA NERVIOSO'] = divsistemNervios
    var divEndrocrinoloMetabolism = $('#collapse-sub-EndrocrinoloMetabolism-Target').find("div[class='row']")
    arrayDivs['ENDOCRINOLOGIA Y METABOLISMO'] = divEndrocrinoloMetabolism
    var divaparatoLocomot = $('#collapse-sub-aparatoLocomot-Target').find("div[class='row']")
    arrayDivs['APARATO LOCOMOTOR'] = divaparatoLocomot
    var divTermoregulacin = $('#collapse-sub-Termoregulacin-Target').find("div[class='row']")
    arrayDivs['TERMOREGULACION'] = divTermoregulacin
    var divpiel = $('#collapse-sub-piel-Target').find("div[class='row']")
    arrayDivs['PIEL'] = divpiel
    var divOrganoSentidos = $('#collapse-organo-sentidos-Target').find("div[class='row']")
    arrayDivs['SENTIDOS'] = divOrganoSentidos;
    // //console.log(arrayDivs)

    // arrayDivs.push(divPatologicos, divNoPatologicos, divHeredofamiliares, divPsicologicos, divNutricionales, divLaboral)
    if (tipo == 2)
      api = 15

    $.ajax({
      url: http + servidor + "/" + appname + "/api/consulta_api.php",
      data: {
        api: api,
        turno_id: id,
        curp: curp
      },
      type: "POST",
      dataType: "json",
      success: function (data) {

        for (const key in data) {
          const element = data[key];
          //console.log(key)

          if (key && key != '¿ERES ALÉRGICO A ALGÚN MEDICAMENTO O ALIMENTO?')
            setValuesAntAnnameMetodo(arrayDivs[key], element, key)
        }
        // //console.log(data);
        // //console.log(arrayDivs)
      },
      complete: function () {
        // resolve(1);
      },
      error: function (jqXHR, exception, data) {
        alertErrorAJAX(jqXHR, exception, data)
      },
    })

    // Ficha admision 
    $.ajax({
      url: `${http}${servidor}/${appname}/api/ficha_admision_api.php`,
      data:{
        api: 2,
        turno_id: id,
      },
      type: "POST",
      dataType: "json",
      success: function(data) {
        data = data.response.data;
        rellenarInputFichaAdmision("formFichaAdmision", data[0])
      },
      error: function(jqXHR, exception, data){
        alertErrorAJAX(jqXHR, exception, data)
      }
    })

    // historia familiar recuperar respuestas
    $.ajax({
      url: `${http}${servidor}/${appname}/api/ficha_admision_api.php`,
      data: {
        api: 5,
        turno_id: id,
      },
      type: "POST",
      dataType: "json",
      success: function(data) {
        llenarHistoriaFamiliar(data.response.data);
      },
      error: function(jqXHR, exception, data){
        alertErrorAJAX(jqXHR, exception, data)
      }
    })

    // nutricion alimentos, recuperar respuestas nutAlimentos
    $.ajax({
      url: `${http}${servidor}/${appname}/api/ficha_admision_api.php`,
      data: {
        api: 7,
        turno_id: id,
      },
      type: "POST",
      dataType: "json",
      success: function(data){
        llenarNutricionAlimentos(data.response.data);
      },
      error: function(jqXHR, exception, data){
        alertErrorAJAX(jqXHR, exception, data );
      }
    })

    // recuperar las exploraciones de sigma
    $.ajax({
      url: `${http}${servidor}/${appname}/api/ficha_admision_api.php`,
      data: {
        api: 9,
        turno_id: id,
      },
      type: "POST",
      dataType: "json",
      success: function(data){
        llenarExploracionSigma(data.response.data);
      },
      error: function(jqXHR, exception, data){
        alertErrorAJAX(jqXHR, exception, data );
      }
    })

    // recuperar interpretaciones sigma
    $.ajax({
      url: `${http}${servidor}/${appname}/api/ficha_admision_api.php`,
      data: {
        api: 11,
        turno_id: id,
      },
      type: "POST",
      dataType: "json",
      success: function(data){
        llenarInterpretacionesSigma(data.response.data);
      },
      error: function(jqXHR, exception, data){
        alertErrorAJAX(jqXHR, exception, data );
      }
    })


    resolve(1)
  });
}



function mostrarDetalleLesionSigma(data){
  var container = document.getElementById('divDetalleLesiones');
  container.innerHTML = '';

  for (let i = 0; i < data.length; i += 4) {
    // Crear una fila
    var row = document.createElement('div');
    row.classList.add('row', 'mb-3');

    // Crear hasta 4 columnas por fila
    for (let j = 0; j < 4 && i + j < data.length; j++) {
      var lesion = data[i + j];

      // Crear columna con la tarjeta
      var col = document.createElement('div');
      col.classList.add('col');

      var card = `
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">${lesion.DESCRIPCION}</h5>
            <p class="card-text">${lesion.DETALLE_LESION}</p>
            <a href="#" class="card-link" onclick="eliminarLesionSigma(${lesion.TURNO_ID},${lesion.CUERPO_ID},'${lesion.DESCRIPCION}')">Borrar</a>
          </div>
        </div>
      `;
      col.innerHTML = card;
      row.appendChild(col);
    }

    // Agregar la fila al contenedor
    container.appendChild(row);
  }
}

function eliminarLesionSigma(turnoid, cuerpo_id, parte_cuerpo){
  alertMensajeConfirm({
    title: `¿Eliminar lesión de ${parte_cuerpo}?`,
      text: "Se borrará todo la información introducida",
      icon: 'warning',
  }, function () {
      $.ajax({
          data: {
            turno_id: turnoid,
            part_id: cuerpo_id,
            api: 14
          },
          url: `${http}${servidor}/${appname}/api/ficha_admision_api.php`,
          type: "POST",
          dataType: 'json',
          success: function (data) {
              if (mensajeAjax(data)) {
                  alertToast('Lesión eliminada!', 'success')
                  pintarAreasLesionadas()
              }
          },
      });
  }, 1);
}


// function pintarAreasLesionadas(){
//   $.ajax({
//     url: `${http}${servidor}/${appname}/api/ficha_admision_api.php`,
//     data: {
//       api: 13,
//       turno_id: pacienteActivo.array['ID_TURNO'],
//     },
//     type: "POST",
//     dataType: "json",
//     success: function(data){
//       llenarLesionesSigma(data.response.data);
//       mostrarDetalleLesionSigma(data.response.data);
//     },
//     error: function(jqXHR, exception, data){
//       alertErrorAJAX(jqXHR, exception, data );
//     }
//   })
// }

function llenarLesionesSigma(data){
  $('.highlight-selected').remove();
  for (let index = 0; index < data.length; index++) {
    var data_part = data[index].CUERPO_ID;
    var area = document.querySelector(`[data-part-id="${data_part}"]`);
    activarAreaSeleccionadaCuerpo(area);
  }
}

function activarAreaSeleccionadaCuerpo(area){
  var $highlight = $('<div class="highlight-selected"></div>');
  $('#silueta_frontal').append($highlight);

  var $area = $(area);
  var coords = $area.attr('coords').split(',').map(Number);

  if ($area.attr('shape') === 'circle') {
      var [x, y, r] = coords;
      $highlight.css({
          left: `${x - r}px`,
          top: `${y - r}px`,
          width: `${2 * r}px`,
          height: `${2 * r}px`
      }).show();
  }
}

function llenarInterpretacionesSigma(data){
  var resultados = [
    {
        "CUENTA_ROJA": data[0].CUENTA_ROJA,
        "GENERAL_ORINA": data[0].GENERAL_ORINA,
        "QUIMICA_SANGUINEA": data[0].QUIMICA_SANGUINEA,
        "RADIOGRAFIA_TORAX": data[0].RADIOGRAFIA_TORAX,
        "VIH": data[0].VIH,
        "ANTIDOPING": data[0].ANTIDOPING,
        "TIPO_SANGRE": data[0].TIPO_SANGRE,
        "REACCIONES_FEBRILES": data[0].REACCIONES_FEBRILES,
        "VDRL": data[0].VDRL,
        "COPRO": data[0].COPRO,
        "EXUDADO_FARINGEO": data[0].EXUDADO_FARINGEO,
        "TURNO_ID": data[0].TURNO_ID,
        "AUDIOMETRIA": data[0].AUDIOMETRIA,
        "OTROS": data[0].OTROS,
        "REGISTRADO_POR": data[0].REGISTRADO_POR,
        "FECHA_REGISTRO": data[0].FECHA_REGISTRO,
        "ACTIVO": data[0].ACTIVO
    }
  ];

  var resultado = resultados[0];

  // Recorrer los campos del formulario y asignarles los valores
  for (let key in resultado) {
    const field = document.querySelector(`[name="${key.toLowerCase()}"]`);
    if (field) {
        if (field.type === 'textarea' || field.type === 'text') {
            field.value = resultado[key] || '';  // Si es un valor nulo, asigna vacío
        }
    }
  }
}

function llenarNutricionAlimentos(data) {
  // Recorre cada objeto en el array de datos
  data.forEach(item => {
      // Selecciona el checkbox cuyo valor coincide con el ALIMENTO_ID del objeto
      let checkbox = document.querySelector(`input[name="nutalimentos[]"][value="${item.ALIMENTO_ID}"]`);
      // Si el checkbox existe, lo activa
      if (checkbox) {
          checkbox.checked = true;
      }
  });
}

function llenarExploracionSigma(data){
  // Recorre cada objeto en el array de datos
  for (let index = 0; index < data.length; index++) {
    const element = data[index];
    // console.log('elemento')
    // console.log(element.ID_CUERPO)
    $('form.form-exploracion').filter(function(){
      // buscar dentro de este formulario si existe un elemento con el name y valor deseado
      return $(this).find('[name="sigma-exploracion[parte_cuerpo]"]').val() == element.ID_CUERPO;
    }).each(function(){
      // si existe pintar los valores en el formulario
      var form = $(this).attr('id');
      for (let i = 0; i < 10; i++) {

        var input = $(`#${form}`).find(`[name="sigma-exploracion[exploraciones][${i}][tipo]"]`);

        if(input.length && input.val() == element.ID_TIPO){
          $(`#${form}`).find(`[name="sigma-exploracion[exploraciones][${i}][respuesta]"][value="${element.ID_RESPUESTA}"]`).prop('checked', true);
          $(`#${form}`).find(`[name="sigma-exploracion[exploraciones][${i}][observaciones]"]`).val(`${element.OBSERVACIONES}`);
          break;
        }
      }
    })
  }
  
}



function llenarHistoriaFamiliar(data) {
  data.forEach(function(item) {
      // Selector para los radios de "Vive" según el familiar
      const viveSelector = `input[name='vive[${item.familiar}]'][value='${item.vive}']`;
      $(viveSelector).prop('checked', true);

      // Selector para checkboxes de enfermedades
      item.enfermedades.forEach(function(enfermedad) {
          const enfermedadSelector = `input[name='enfermedad[${item.familiar}][]'][value='${enfermedad}']`;
          $(enfermedadSelector).prop('checked', true);
      });
  });
}

function rellenarInputFichaAdmision(formularioId, valores) {

  $(`#${formularioId} #religion`).val(valores['RELIGION']);
  $(`#${formularioId} #lugar_nacimiento`).val(valores['LUGAR_NACIMIENTO']);
  $(`#${formularioId} #estado_civil`).val(valores['ESTADO_CIVIL']);
  $(`#${formularioId} #puesto_solicita`).val(valores['PUESTO_SOLICITA']);
  $(`#${formularioId} #depto`).val(valores['AREA_DEPTO']);
  $(`#${formularioId} #no_imss`).val(valores['NO_IMSS']);
  $(`#${formularioId} #profesion`).val(valores['PROFESION']);
  $(`#${formularioId} #escolaridad`).val(valores['ESCOLARIDAD']);
  $(`#${formularioId} #umf`).val(valores['UMF']);
  $(`#${formularioId} #nombre_contacto`).val(valores['ACCIDENTE_AVISAR']);
  $(`#${formularioId} #parentesco`).val(valores['PARENTESCO']);
  $(`#${formularioId} #tel1`).val(valores['TELEFONO1']);
  $(`#${formularioId} #tel2`).val(valores['TELEFONO2']);

}

function setValuesAntAnnameMetodo(DIV, array, key) {

  if (array) {
    try {
      if (DIV.length != array.length)
        alertToast('Algunos datos de ' + key + ' se han cargado correctamente...', 'info')
    } catch (error) {

    }
  
    try {
      for (var i = 0, j=0; j < DIV.length; i++,j++) {

        var collapID = $(DIV[j]).find("div[class='collapse']").attr("id");
        console.warn(`${DIV[j]} ${array[i][2]}`)
        if(typeof collapID == 'undefined'){
          
          console.log(`entra al indefinicio ${collapID} ${array[i][2]}`);
        }

        try {
          $(DIV[j]).find("input[value='" + array[i][0] + "']:not(.sigmaClass input)").prop("checked", true);

          // Verifica si el div con la clase 'collapse' existe
          var collapseDiv = $(DIV[j]).find("div[class='collapse']:not(.sigmaClass .collapse)");
          if (collapseDiv.length > 0) {
              var collapID = collapseDiv.attr("id");
              if (array[i][0] == 1) {
                  $('#' + collapID).collapse("show");
              }
          }

          // var collapID = $(DIV[j]).find("div[class='collapse']").attr("id");
          // if (array[i][0] == 1) {
          //   $('#' + collapID).collapse("show")
          // }

          if (array[i][0] == 1 || array[i][0] == null) {

              $(DIV[j]).find("textarea.form-control.input-form:not(.sigmaClass .form-control.input-form)").val(`${array[i][1]}`)

              // para los input tipo range
              $(DIV[j]).find("input[type='range']:not(.sigmaClass input)").val(array[i][1])
              $(DIV[j]).find("label[class='rangeValueLabel']").text(array[i][1])
            

          } else {
            $(DIV[j]).find("textarea.form-control.input-form:not(.sigmaClass .form-control.input-form)").val('')
          }
          $(DIV[j]).find("input").each(function() {
            if ($(this).val() == array[i][0]) {
                $(this).prop("checked", true);
            }
        });
        } catch (error) {
          console.log(error);
        }

      }
    } catch (error) {
      console.warn(error);
    }
  } else {
    // //console.log(DIV)
    // //console.log(array);
    // alertSelectTable('La seccion ' + key + ' no cargó correctamente', 'info', 6000)
  }
}

function setValuesAntAnnameMetodo2(DIV, array, key) {
  // Verificar si DIV y array son arrays
  if (Array.isArray(DIV) && Array.isArray(array)) {
    try {
      if (DIV.length !== array.length) {
        alertToast('Algunos datos de ' + key + ' se han cargado correctamente...', 'info');
      }

      for (var i = 0; i < DIV.length; i++) {
        try {
            // Procesar inputs
            $(DIV[j]).find("input[value='" + array[i][0] + "']").each(function () {
                if ($(this).closest('.sigmaClass').length === 0) { // Excluir si tiene un ancestro sigmaClass
                    $(this).prop("checked", true);
                }
            });
        
            // Procesar collapse
            $(DIV[j]).find("div.collapse").each(function () {
                if ($(this).closest('.sigmaClass').length === 0) { // Excluir si tiene un ancestro sigmaClass
                    var collapID = $(this).attr("id");
                    if (array[i][0] == 1) {
                        $('#' + collapID).collapse("show");
                    }
                }
            });
        
            // Procesar textareas
            $(DIV[j]).find("textarea.form-control.input-form").each(function () {
                if ($(this).closest('.sigmaClass').length === 0) { // Excluir si tiene un ancestro sigmaClass
                    if (array[i][0] == 1 || array[i][0] == null) {
                        $(this).val(`${array[i][1]}`);
                    } else {
                        $(this).val('');
                    }
                }
            });
        
            // Procesar inputs tipo range
            $(DIV[j]).find("input[type='range']").each(function () {
                if ($(this).closest('.sigmaClass').length === 0) { // Excluir si tiene un ancestro sigmaClass
                    $(this).val(array[i][1]);
                    $(this).siblings("label.rangeValueLabel").text(array[i][1]);
                }
            });
        } catch (error) {
            console.log(error);
        }
      }
    } catch (error) {
      console.log("Error en el procesamiento de datos:", error);
    }
  } else {
    alertSelectTable('La sección ' + key + ' no cargó correctamente', 'info', 6000);
  }
}




function ocultarAntecedentesGinecologicos(sexo){
  return new Promise(resolve => {
        if(sexo == 'MASCULINO'){
          $('#formAntGinecologicos').fadeOut(0)
        } else {
          $("#formAntGinecologicos").fadeIn(0)
        }
        console.log(`este es el sexo ${sexo}`)
        resolve(1)
  })
}

function ocultarFichaAdmision(cliente){
  return new Promise(resolve =>{
    if(parseInt(cliente) != 51){
      $('#li-fadmision').fadeOut(0);
      $("#card-fadmision").fadeOut(0);
      $("#historiaFamiliarForm").fadeOut(0);
      $('.sigmaClass').fadeOut(0).find('input, textarea, select').prop('disabled', true);
      $('.sigmaClass').html('');
      console.warn(cliente)
    } else {
      $.post(`${http}${servidor}/${appname}/vista/include/acordion/ficha-admision.html`, function(html){
        $("#divFichaAdmision").html(html)
      })
      $('.clientesClass').fadeOut(0);
      $('.sigmaClass').fadeIn(0).find('input, textarea, select').prop('disabled', false);
    }
    resolve(1)
  })
}

function obtenerVistaAntecenetesPaciente(div, cliente, pagina = 1, sexo = 'MASCULINO') {
  return new Promise(resolve => {
    $.post(`${http}${servidor}/${appname}/vista/include/acordion/antecedentes-paciente${language}.html`, function (html) {
      setTimeout(function () {
        $(div).html(html);
        // //console.log(cliente)

        if (cliente == "Particular" || cliente == "PARTICULAR") {
          $('.onlyProcedencia').fadeOut(0);
        } else {
          $('.onlyProcedencia').fadeIn(0);
        }

        if (pagina == 0) {
          $('.onlyMedico').fadeOut(0);
        } else {
          $('.onlyMedico').fadeIn(0);
        }
        resolve(1)
      }, 100);
    });
  })
}

function obtenerVistaEspiroPacientes(div) {
  return new Promise(resolve => {
    $.post(`${http}${servidor}/${appname}/vista/menu/area-master/contenido/forms/form_espiro${language}.html`,

      function (html) {
        setTimeout(function () {
          $(div).html(html);

          resolve(1)
        }, 100);
      });
  })
}


function obtenerDatosEspiroPacientes(curp) {
  return new Promise(resolve => {
    ajaxAwait({
      api: 2,
      curp: curp
    }, 'espirometria_api', { callbackAfter: true, returnData: false }, false, function (data) {

      //$('#1pr1').prop('checked', true)
      let row = data.response.data;


      for (const key in row) {
        if (Object.hasOwnProperty.call(row, key)) {
          const element = row[key];

          respuestas = element.ID_R;
          comentario = element.COMENTARIO

          switch (true) {

            // PARA MOSTRAR AQUELLOS QUE SON INPUTS DE TIPO RADIO
            case respuestas == 1 || respuestas == '1' || respuestas == 2 || respuestas == '2':

              $(`input[id="p${element.ID_P}r${element.ID_R}"]`).prop('checked', true)

              break;


            // PARA TODOS AQUELLOS INPUTS DE TIPO CHECKBOX QUE NO TIENEN UN COMENTARIO ANEXADO
            case respuestas != 1 && respuestas != '1' && respuestas != 2 && respuestas != '2' && comentario == null:

              $(`input[id="p${element.ID_P}r${element.ID_R}"]`).prop('checked', true);

              //para el caso de los botones de no_aplica1 y no_aplica2
              $(`input[name="respuestas[${element.ID_P}][${element.ID_R}][valor]"]`).prop('checked', true);

              break;


            // // PARA TODOS AQUELLOS QUE SON INPUTS DE TIPO TEXT  QUE NO TIENEN RESPUESTA Y PARA AQUELLOS INPUTS DE TIPO CHECKBOX QUE CONTIENEN UN COMENTARIO
            case comentario != null:

              $(`input[id="p${element.ID_P}r${element.ID_R}"]`).prop('checked', true);
              $(`input[id="p${element.ID_P}"]`).val(comentario);

              //INSERTAMOS LA RESPUESTAS DE AQUELLAS PREGUNTAS QUE NO TIENEN UN ID DE RESPUESTA
              $(`input[id="p${element.ID_P}"]`).val(comentario);

              break;

          }

          //MOSTRAMOS LOS COLLAPSE DE TODAS AQUELLAS PREGUNTAS QUE LO CONTIENEN
          let parent = $('div[class="form-check form-check-inline col-12 mb-2"]');
          let children = $(parent).children(`div[id="p${element.ID_P}r${element.ID_R}"]`);
          children.collapse('show');

          $(`textarea[name="respuestas[${element.ID_P}][${element.ID_R}][comentario]"]`).val(comentario)


          let childrenCondiciones = $(parent).children(`div[id="pregunta${element.ID_P}"]`);
          childrenCondiciones.collapse('hide');

        }


      }
      resolve(1)
    })

  });

}



function select2(select, modal = null, placeholder = 'Selecciona una opción', width = '100%') {
  if (!modal) modal = 'body-controlador';
  $(select).select2({
    dropdownParent: $('#' + modal),
    tags: false,
    width: width,
    placeholder: placeholder
  });
}



//Creador vistas
pacienteTurnoActivo = new GuardarArreglo();
function obtenerPanelInformacion(id = null, api = null, tipPanel = null, panel = '#panel-informacion', nivel = null, area = null) {
  return new Promise(resolve => {
    var html = "";
    $(panel).fadeOut(0);
    $.post(http + servidor + "/" + appname + "/vista/include/barra-informacion/info-barra.php", {
      tip: tipPanel,
      nivel: nivel
    },
      function (html) {
        setTimeout(function () {
          $(panel).html(html);
        }, 100);
      }).done(function () {
        setTimeout(async function () {
          if (id > 0) {
            let row = array_selected;
            switch (tipPanel) {
              case 'paciente':
                $.ajax({
                  url: http + servidor + "/" + appname + "/api/pacientes_api.php",
                  data: {
                    api: 2,
                    turno_id: id
                  },
                  type: "POST",
                  dataType: 'json',
                  success: function (data) {
                    if (mensajeAjax(data)) {
                      row = data['response']['data'][0];
                      $('#nombre-persona').html(row.NOMBRE_COMPLETO);
                      $('#edad-persona').html(`${calcularEdad2(row.NACIMIENTO)['numero']} ${calcularEdad2(row.NACIMIENTO)['tipo']}`)
                      $('#nacimiento-persona').html(formatoFecha(row.NACIMIENTO));
                      $('#info-paquete_cargado').html(ifnull(row, '', ['PAQUETE_CARGADO']))
                      $('#info-vendedor').html(ifnull(row, '', ['VENDEDOR']))
                      $('#info-paci-alergias').html(row.ALERGIAS);
                      $('#info-paci-procedencia').html(row.PROCEDENCIA)
                      $('#info-paci-curp').html(row.CURP);
                      $('#info-paci-naciondalidad').html(row.NACIONALIDAD)
                      $('#info-paci-telefono').html(row.CELULAR);
                      $('#info-paci-correo').html(row.CORREO);
                      $('#info-paci-sexo').html(row.GENERO);
                      $('#info-paci-metodo-entrega').text(row.MEDIOS_ENTREGA);
                      if (row.TURNO) {
                        $('#info-paci-turno').html(row.TURNO);
                      } else {
                        $('#info-paci-turno').html('Sin generar');
                      }
                      $('#info-paci-directorio').html(row.CALLE + ", " + row.COLONIA + ", " +
                        row.MUNICIPIO + ", " + row.ESTADO);
                      $('#info-paci-comentario').html(row.COMENTARIO_RECHAZO);

                      $('#info-paci-diagnostico').html(row.DIAGNOSTICO);


                      if (row.FECHA_REAGENDA != null) {
                        $('#info-paci-reagenda').html(formatoFecha(row.FECHA_REAGENDA));
                      }

                      if (row.FECHA_RECEPCION != null) {
                        $('#info-paci-recepcion').html(row.FECHA_RECEPCION);
                      }

                      $('#info-paci-prefolio').html(row.PREFOLIO)

                      if (row['ordenes']) {
                        // let row = row['ordenes']
                        // if ()

                        let ordenes = row['ordenes'][0];

                        let hash = {
                          'LABORATORIO CLÍNICO': 6,
                          'ULTRASONIDO': 11,
                          'RAYOS X': 8
                        }

                        for (const key in ordenes) {
                          if (Object.hasOwnProperty.call(ordenes, key)) {
                            const element = ordenes[key];
                            if (hash[element['area']] == area) {
                              $('#contenedor-btn-ordenes-medicas').append(`
                                <div class="col text-center">
                                  <a type="button" target="_blank" class="btn btn-borrar"
                                      href="${element['url']}">
                                    <i class="bi bi-file-earmark-pdf"></i> ${element['area']}
                                  </a>
                                </div>
                              `)
                            }

                          }
                        }


                        try {
                          let row = row['ordenes'][0]
                        } catch (error) {

                        }


                        // Categoria del paciente, no particulares
                        if (ifnull(row, false, ['ID_CLIENTE']) != '1') {
                          $('#info-categoria_cargado').html(ifnull(row, '', ['CATEGORIA']))
                          // console.log(area);
                          if (area === 1) {
                            // Aparece las categorias
                            $('.categoria_paciente').fadeIn('fast');
                            $('#categoria_paciente_input').val(ifnull(row, '', ['CATEGORIA']))
                          }

                        }



                      } else {
                      }

                    }
                  },
                  complete: function () {
                    $(panel).fadeIn(100);
                    resolve(1);
                  },
                  error: function (jqXHR, exception, data) {
                    alertErrorAJAX(jqXHR, exception, data)
                  },
                })

                break;
              case 'equipo':
                $('#nombre-equipo').html(row.MARCA + "-" + row.MODELO);
                // $('#equipo-equipo').html(row.);
                $('#equipo-ingreso').html(formatoFecha(row.FECHA_INGRESO_EQUIPO));
                $('#equipo-inicio').html(formatoFecha(row.FECHA_INICIO_USO));
                $('#equipo-valor').html(row.VALOR_DEL_EQUIPO);
                $('#equipo-mantenimiento').html(row.FRECUENCIA_MANTENIMIENTO + " " + row.NUMERO_PRUEBAS);
                $('#equipo-calibracion').html(row.CALIBRACION + " " + row.NUMERO_PRUEBAS_CALIBRACION);
                $('#equipo-uso').html(row.USO);
                $('#equipo-descripcion').html(row.DESCRIPCION);
                $(panel).fadeIn(100);
                resolve(1);
                break;
              case 'signos-vitales':
                ajaxAwait({ api: 2, id_turno: id }, 'somatometria_api', { callbackAfter: true }, false, (data) => {
                  data = data.response.data
                  if (Object.keys(data).length > 2) {
                    $('#fecha-signos').html(formatoFecha2(data['FECHA_REGISTRO']))
                    const mappings = {
                      signosVitales: [
                        { id: 'frecuenciaCardiaca', label: 'Frec. Card.:', row: 'FRECUENCIA CARDIACA' },
                        { id: 'frecuenciaRespiratoria', label: 'Frec. Resp.:', row: 'FRECUENCIA RESPIRATORIA' },
                        { id: 'sistolica', label: 'Sistólica:', row: 'SISTOLICA' },
                        { id: 'diastolica', label: 'Diastólica:', row: 'DIASTOLICA' },
                        { id: 'saturacionOxigeno', label: 'Sa. Ox.:', row: 'SATURACION DE OXIGENO' },
                        { id: 'temperatura', label: 'Temp:', row: 'TEMPERATURA' }
                      ],
                      somatometria: [
                        { id: 'estatura', label: 'Estatura:', row: 'ESTATURA' },
                        { id: 'peso', label: 'Peso:', row: 'PESO' },
                        { id: 'masaCorporal', label: 'Índice de Masa Muscular:', row: 'ÍNDICE DE MASA MUSCULAR' },
                        { id: 'masaMuscular', label: 'Masa Libre de Grasa:', row: 'MASA LIBRE DE GRASA' },
                        { id: 'porcentajeGrasaVisceral', label: 'Perímetro Cefálico:', row: 'NIVEL DE GRASA VISCERAL' },
                        { id: 'porcentajeAgua', label: 'Agua Corporal Total:', row: 'AGUA CORPORAL TOTAL' },
                        { id: 'metabolismo', label: 'Nivel de Grasa Visceral:', row: 'TASA METABÓLICA BASAL' },
                        { id: 'huesos', label: 'Masa de Músculo Esquelético:', row: 'MÚSCULO ESQUELÉTICO' },
                        { id: 'perimetroCefalico', label: 'Tasa Metabólica Basal:', row: 'PERIMETRO CEFALICO' },
                        { id: 'porcentajeProteinas', label: 'Proteínas:', row: 'PROTEÍNAS' },
                        // { id: 'edadCuerpo', label: 'Edad del cuerpo:', row: 'EDAD DEL CUERPO' }
                      ]
                    };

                    const signosHTML = generateHTMLSection(mappings.signosVitales, 'col-12 col-xxl-6', { first: 'col-6 col-xxl-8', second: 'col-6 col-xxl-4' });
                    const somatometriaHTML = generateHTMLSection(mappings.somatometria, 'col-12', { first: 'col-6 col-xxl-7', second: 'col-6 col-xxl-5' });

                    $('#signos_portada').html(signosHTML);
                    $('#cuerpo_soma').html(somatometriaHTML)

                    function generateHTMLSection(items, div_class, col_class) {
                      let row = '';
                      return items.map(item => `
                        <div class="${div_class}">
                          <div class="row">
                            <div class="${col_class.first} text-end info-detalle">
                              <p>${item.label}</p>
                            </div>
                            <div class="${col_class.second} text-start d-flex align-items-center">
                              <p class="none-p">
                                ${ifnull(data, 'Sin tomar', [{ [item.row]: 'VALOR' }])} <strong>
                                ${ifnull(data, '', [{ [item.row]: 'UNIDAD_MEDIDA' }])}</strong>
                              </p>
                            </div>
                          </div>
                          <hr style="margin: 3px" />
                        </div>
                      `).join('');
                    }
                  } else {
                    $('#div-panel-signos').html('<p class="none-p"> Sin signos vitales</p>')
                  }


                  $(panel).fadeIn(100);
                  resolve(1);

                })

                break;
              case 'cliente':
                // //console.log(row)
                $('#nombreComercial-cliente').html(row.NOMBRE_COMERCIAL);
                $('#nombreSistema-cliente').html(row.NOMBRE_SISTEMA);
                $('#info-cliente-RFC').html(row.RFC);
                $('#info-cliente-CURP').html(row.CURP);
                $('#info-cliente-codigo').html(row.CODIGO);
                $('#info-cliente-credito').html(row.LIMITE_CREDITO);
                $('#info-cliente-tempcredito').html(row.TEMPORALIDAD_DE_CREDITO);
                $('#info-cliente-cuentaContable').html(row.CUENTA_CONTABLE);
                $('#info-cliente-pagweb').attr("href", row.PAGINA_WEB);
                $('#info-cliente-pagweb').text(row.PAGINA_WEB);
                $('#info-cliente-face').attr("href", row.FACEBOOK);
                $('#info-cliente-face').text(row.FACEBOOK);
                $('#info-cliente-twitter').attr("href", row.TWITTER);
                $('#info-cliente-twitter').text(row.TWITTER);
                $('#info-cliente-instragram').attr("href", row.INSTAGRAM);
                $('#info-cliente-instragram').text(row.INSTAGRAM);
                $(panel).fadeIn(100);
                resolve(1);
                break;
              case 'contacto':
                // //console.log(selectContacto)
                $('#nombre-contacto').html(selectContacto.NOMBRE + ' ' + selectContacto.APELLIDOS);
                $('#info-contacto-tel1').html(selectContacto.TELEFONO1);
                $('#info-contacto-tel2').html(selectContacto.TELEFONO2);
                $('#info-contacto-email').html(selectContacto.EMAIL);
                $(panel).fadeIn(100);
                resolve(1);
                break;
              case 'documentos-paciente':
                // //console.log(selectContacto)

                $(panel).fadeIn(100);
                resolve(1);
                break;
              case 'resultados-areas':
                $(panel).fadeIn(100);
                resolve(1);
                break;
              case 'estudios_muestras':
                $.ajax({
                  url: http + servidor + "/" + appname + "/api/recepcion_api.php",
                  type: "POST",
                  dataType: 'json',
                  data: { api: 6, id_turno: ifnull(row, id, ['ID_TURNO', 'TURNO_ID']) },
                  success: async function (data) {
                    if (!mensajeAjax(data))
                      return false;
                    let row = data.response.data
                    let html = '';

                    // $(panel).html('');

                    function htmlLI(texto) {
                      return '<li class="list-group-item">' + texto + '</li>';
                    }

                    function crearDIV(grupo, id, row) {
                      let html = '';
                      html += '<a class="collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#board-' + id + '" aria-expanded="false">';
                      html += '<div style = "display: block"><div class="collapse_estudio" style="margin:0px;background: rgb(0 0 0 / 25%);width: 100%;padding: 10px 0px 10px 0px;text-align: center;""><h4 style="font-size: 20px !important;padding: 0px;margin: 0px;">' + grupo + '</h4></div></div>';
                      html += '</a>'

                      html += '<div class="collapse bg-white-canvas" id="board-' + id + '">'
                      let area = 0;
                      for (const key in row) {
                        const element = row[key];
                        console.log(element)
                        if (element['AREA_ID'] == id) {
                          area = 1;
                          html += htmlLI(element['GRUPO']);
                        }

                        if (
                          element['AREA_ID'] != '6' &&
                          element['AREA_ID'] != '12' &&
                          element['AREA_ID'] != '8' &&
                          element['AREA_ID'] != '11' &&
                          (id == 0 || id == 'paq')
                        ) {
                          area = 1;
                          html += htmlLI(element['GRUPO']);
                        }
                      }
                      html += '</div>';

                      if (area)
                        return html;
                      return '';
                    }


                    await ajaxAwait({ api: 5, turno_id: id }, 'cargos_turnos_api', { callbackAfter: true, ajaxComplete: resolve(1) }, false, (data) => {

                      let row = data.response.data;
                      // $('#append-html-historial-estudios').html('');

                      //Paquetes
                      html += crearDIV('<i class="bi bi-box-seam"></i> Paquetes', 'paq', row);

                      // setListResultadosAreas('#append-html-historial-estudios', element, arrayArea)
                    })



                    //Lab
                    html += crearDIV('<i class="bi bi-heart-pulse"></i> Laboratorio Clínico', 6, row);
                    //Lab Bio
                    html += crearDIV('<i class="bi bi-heart-pulse"></i> Laboratorio Biomolecular', 12, row);
                    //Ultrasonido
                    html += crearDIV('<i class="bi bi-person-video"></i>  Ultrasonido', 11, row);
                    //RayosX
                    html += crearDIV('<i class="bi bi-universal-access"></i>  Rayos X', 8, row);
                    //Otros
                    html += crearDIV('<i class="bi bi-window-stack"></i> Otros Servicios', 0, row);




                    $('#lista-estudios-paciente').html(html);


                    $(panel).fadeIn(100);
                    resolve(1);



                    // let html = '';
                    // for (var i = 0; i < row.length; i++) {
                    //   //console.log(row[i]);
                    //   html += '<li class="list-group-item">';
                    //   html += row[i]['GRUPO'];
                    //   html += '</li>';
                    //   //<i class="bi bi-arrow-right-short"></i>
                    //   //<strong>' + row[i]['MUESTRA'] + '</strong> - <strong>' + row[i]['CONTENEDOR'] + '</strong>
                    // }
                    // $('#lista-estudios-paciente').html(html);


                    // $(panel).fadeIn(100);
                    // resolve(1);


                  },
                  complete: function () {
                    loaderDiv("Out", null, "#loader-muestras", '#loaderDivmuestras');
                    resolve(1);
                  },
                  error: function (jqXHR, exception, data) {
                    alertErrorAJAX(jqXHR, exception, data)
                  },
                });
                break;

              case 'turnos_panel':
                // id <-- area fisica
                ajaxTurnosActualArea()
                getStatusOptimizador()

                function getStatusOptimizador() {
                  if (api != 'vistas')
                    activoConsultadorTurnero = true
                  if (activoConsultadorTurnero) {
                    $.ajax({
                      url: http + servidor + '/' + appname + '/archivos/sistema/json/turnero_optimizador.json',
                      type: 'POST',
                      dataType: 'JSON',
                      success: function (data) {
                        // let data = JSON.parse(data);
                        // //console.log(data)
                        if (data['Optimizador'][id]) {
                          setTimeout(() => {
                            ajaxTurnosActualArea()
                          }, 500);
                        }
                        setTimeout(() => {
                          getStatusOptimizador()
                        }, 2000);
                      }
                    })
                  } else {
                    setTimeout(() => {
                      getStatusOptimizador()
                    }, 2000);
                  }
                }


                function ajaxTurnosActualArea() {
                  $.ajax({
                    url: http + servidor + "/" + appname + "/api/turnero_api.php",
                    type: "POST",
                    dataType: 'json',
                    data: { api: 6, area_fisica_id: id },
                    success: function (data) {
                      if (mensajeAjax(data, 'Turnero')) {
                        let row = data.response.data;
                        //console.log(row);
                        if (row[0]) {


                          pacienteTurnoActivo.selectID = row[0]['ID_TURNO'];
                          pacienteTurnoActivo.setguardado(row[0]['PACIENTE']);


                          $('#paciente_turno').html(row[0]['PACIENTE'])
                          // miStorage.setItem('paciente_actual_turno', row[0]['ID_TURNO']);
                          alertMsj({
                            title: row[0]['PACIENTE'],
                            text: 'Es su siguiente paciente',
                            icon: 'success',
                            timer: 5000,
                            showCancelButton: false,
                            timerProgressBar: true,
                          })
                        } else {
                          $('#paciente_turno').html('Ninguno')
                          // miStorage.setItem('paciente_actual_turno', null);
                        }

                        // Control de turnos
                        $('#omitir-paciente').on('click', function () {
                          omitirPaciente(id); //case 3
                        })

                        $('#llamar-paciente').on('click', function () {
                          llamarPaciente(id); //case 2
                        })


                        $('#liberar-paciente').on('click', function () {
                          if (pacienteTurnoActivo.selectID === null) {
                            alertMensaje('info', 'Paciente no disponible', 'No has llamado ningún paciente o no hay paciente en tu area')
                          } else {
                            liberarPaciente(id, pacienteTurnoActivo.selectID); //case 1
                          }
                        })
                      }
                    }, complete: function () {
                      $(panel).fadeIn(100);
                      resolve(1);
                    },
                    error: function (jqXHR, exception, data) {
                      alertErrorAJAX(jqXHR, exception, data)
                    },
                  })
                }



                break;

              case 'listado_resultados':
                ajaxAwait({ api: 21, turno_id: id }, 'consulta_api', { callbackAfter: true, ajaxComplete: resolve(1) }, false, (data) => {
                  //console.log(data)
                  let array = {
                    1: 'CONSULTORIO',
                    2: 'SOMATOMETRÍA',
                    3: 'OFTALMOLOGÍA',
                    4: 'AUDIOMETRÍA',
                    5: 'ESPIROMETRÍA',
                    6: 'LABORATORIO CLÍNICO',
                    7: 'RAYOS X',
                    8: 'ELECTROCARDIOGRAMA',
                    9: 'ELECTRO_CAPTURAS',
                    10: 'ULTRASONIDO',
                    11: 'LABORATORIO BIOMOLECULAR',
                    12: 'CITOLOGÍA',
                    13: 'NUTRICIÓN',
                    14: 'INBODY',
                    15: 'CERTIFICADO MÉDICO',
                    16: 'CONSULTORIO FASTCHECKUP',
                    17: 'CERTIFICADO POE',
                    18: 'CERTIFICADO BIMO'
                  }
                  let row = data.response.data;
                  // $('#append-html-historial-estudios').html('');

                  for (const key in array) {
                    if (Object.hasOwnProperty.call(array, key)) {
                      const element = array[key];

                      let arrayArea = $.grep(row, function (n, i) {
                        return n.AREA_LABEL === element;
                      });

                      //console.log(element, arrayArea)
                      setListResultadosAreas('#append-html-historial-estudios', element, arrayArea)
                    }
                  }

                  $(panel).fadeIn(100);
                  resolve(1);
                })

                function setListResultadosAreas(div, titulo, array) {
                  let html = '';
                  //titulo
                  let lenghtArray = array.length;
                  if (!lenghtArray)
                    return false;
                  html += `<li class="list-group-item d-flex justify-content-between align-items-start">
                              <div class="ms-2 me-auto">`
                  html += `<div class="fw-bold">
                                <a class="" data-bs-toggle="collapse" href="#collapseEstudios${deleteSpace(titulo)}" role="button"
                                    aria-expanded="false" aria-controls="collapseEstudios${deleteSpace(titulo)}">
                                    ${titulo}
                                </a>
                            </div>`
                  //Body 
                  html += `<div class="collapse" id="collapseEstudios${deleteSpace(titulo)}">
                                <ul style="list-style: disc;">`

                  for (const key in array) {
                    if (Object.hasOwnProperty.call(array, key)) {
                      const element = array[key];
                      html += `<li><a href="${element['RUTA']}" target="_blank">${formatoFecha2(element['FECHA_RECEPCION'], [0, 1, 2, 2, 0, 0, 0])}</a></li>`
                    }
                  }

                  html += `</ul> </div>`

                  //Finish and number span 
                  html += `</div>
                        <span class="badge bg-primary rounded-pill">${lenghtArray}</span>
                    </li>`

                  $(div).append(html);

                }

                break;

              //Antiguo por datatable
              case 'estudio':
                $('#nombre-estudio').html(row['DESCRIPCION']);
                $('#clasificacion-estudio').html(row.CLASIFICACION_EXAMEN);
                $('#estudio-metodo').html(row.METODO);
                $('#estudio-medida').html(row.MEDIDA);
                $('#estudio-entrega').html(row.DIAS_DE_ENTREGA);
                if (row.LOCAL == 1) {
                  $('#estudio-subroga').html('Si');
                } else {
                  $('#estudio-subroga').html('No');
                }
                if (row.MUESTRA_VALORES_REFERENCIA == 1) {
                  $('#estudio-valorvista').html('Si');
                } else {
                  $('#estudio-valorvista').html('No');
                }
                $('#estudio-indicaciones').html(row.INDICACIONES);
                $('#estudio-codigo-sat').html(row.DESCRIPCION_SAT);
                $('#estudio-venta').html(row.PRECIO_VENTA);
                $(panel).fadeIn(100);
                resolve(1);
                break;
              //Renovado para laboratorio
              case 'info-estudio-lab-clinico':
                // No  recuerdo para que  sevia...

                break;

              case 'lista-documentos-paciente':
                // $.ajax({

                //   url: `${http}${servidor}/${appname}/api/recepcion_api.php`,
                //   data: {
                //     api: 11,
                //     turno_id: id
                //   },
                //   type: "POST",
                //   dataType: 'json',
                //   success: function (data) {
                //     if (mensajeAjax(data)) {

                //     }
                //   },
                //   complete: function () {
                //     $(panel).fadeIn(100);
                //     resolve(1);
                //   },
                //   error: function (jqXHR, exception, data) {
                //     alertErrorAJAX(jqXHR, exception, data)
                //   },
                // })

                let dataDocumentos = false;

                dataDocumentos = await ajaxAwait({
                  api: 11, turno_id: id
                }, 'recepcion_api')

                dataDocumentos = dataDocumentos.response.data[0];
                //console.log(dataDocumentos)

                if (dataDocumentos) {
                  $('button[class="btn_documentacion_paciente list-group-item list-group-item-action"]').fadeOut('slow');

                  //console.log(dataDocumentos['IDENTIFICACION'])
                  if (dataDocumentos['VERIFICACION_UJAT'])
                    $(`#btn-VERIFICACION_UJAT`).fadeIn();

                  if (dataDocumentos['PASE_UJAT'])
                    $(`#btn-PASE_UJAT`).fadeIn();

                  if (dataDocumentos['PASE_UJAT'])
                    $(`#btn-PASE_UJAT`).fadeIn();

                  if (dataDocumentos['PERFIL'])
                    $(`#btn-PERFIL`).fadeIn();


                  //Credencial
                  try {
                    if (dataDocumentos['IDENTIFICACION'][0]) {
                      if (dataDocumentos['IDENTIFICACION'][0]['front'].length) {
                        $('#btn-credenciales').fadeIn();
                        // //console.log(dataDocumentos['IDENTIFICACION'][0]['back']);
                        // if (dataDocumentos['IDENTIFICACION'][0]['back'].length)
                        //   $(`#btn-back`).fadeIn();
                        if (dataDocumentos['IDENTIFICACION'][0]['front'].length)
                          $(`#btn-front`).fadeIn();
                      }
                    }
                  } catch (error) {

                  }

                  //Ordenes_medicas
                  try {
                    for (const key in dataDocumentos['ORDENES_MEDICAS'][0]) {
                      $('#btn-orden-medicas').fadeIn();
                      if (Object.hasOwnProperty.call(dataDocumentos['ORDENES_MEDICAS'][0], key)) {
                        const element = dataDocumentos['ORDENES_MEDICAS'][0][key];
                        if (element.area) {
                          element.area = element.area.replace(' ', '')
                          $(`#btn-${element.area}`).fadeIn();
                          $(`#btn-${element.area}`).attr('href', element.url);
                        }

                      }
                    }
                  } catch (error) {

                  }



                } else {
                  return false;
                }

                $('.btn_documentacion_paciente, #btn-laboratorio-etiquetas').on('click', function (event) {
                  event.preventDefault();

                  let btn = $(this);
                  // console.log(btn.attr('id'));
                  switch (btn.attr('id')) {

                    case 'btn-laboratorio-etiquetas':


                      area_nombre = 'etiquetas'
                      api = encodeURIComponent(window.btoa(area_nombre));
                      turno = encodeURIComponent(window.btoa(array_selected['ID_TURNO'],));

                      window.open(http + servidor + "/nuevo_checkup/visualizar_reporte/?api=" + api + "&turno=" + turno, "_blank");

                      break;

                    case 'btn-laboratorio-etiquetas-imprimir':

                      area_nombre = 'etiquetas'
                      api = encodeURIComponent(window.btoa(area_nombre));
                      turno = encodeURIComponent(window.btoa(array_selected['ID_TURNO'],));

                      const nombrePDf = 'ticket.pdf';
                      const nombreImpresora = 'PDF24';
                      const url = `http://localhost:8080/?nombrePdf=${nombrePDf}&impresora=${nombreImpresora}`;


                      fetch(url)
                        .then(respuesta => {

                          if (respuesta.status == 200) {

                            alertToast('Imprimiendo etiquetas', 'info', 5000)
                            console.log("Impresion OK")

                          } else {
                            respuesta.json()
                              .then(mensaje => {

                                console.log("Error: " + mensaje)

                              })
                          }
                        })

                      break;

                    case 'btn-PERFIL':
                      window.open(`${dataDocumentos['PERFIL']}`);
                      break;

                    case 'btn-VERIFICACION_UJAT':
                      window.open(`${dataDocumentos['VERIFICACION_UJAT']}`);
                      break;

                    case 'btn-PASE_UJAT':
                      window.open(`${dataDocumentos['PASE_UJAT']}`);
                      break;

                    case 'btn-front':
                      window.open(`${dataDocumentos['IDENTIFICACION'][0]['front']}`);
                      break;

                    case 'btn-back':
                      window.open(`${dataDocumentos['IDENTIFICACION'][0]['back']}`);
                      break;

                    default:
                      //console.log('boton incorrecto')
                      break;
                  }
                  event.preventDefault();
                })
                $(panel).fadeIn(100);
                resolve(1);
                break;

              case 'Estudios_Estatus':
                setTimeout(function () {
                  $(panel).fadeIn(100);
                }, 100);
                resolve(1);

                break;


              case 'PanelTickets':

                await ajaxAwait({
                  api: 2,
                  turno_id: id
                }, 'tickets_api', { callbackAfter: true }, false, function (data) {
                  data = data.response.data[0]

                  $('#info-ticket-total_cargos').html(data['TOTAL_CARGOS'])
                  $('#info-ticket-descuento').html(data['DESCUENTO'])
                  $('#info-ticket-subtotal').html(data['SUBTOTAL'])
                  $('#info-ticket-iva').html(data['IVA'])
                  $('#info-ticket-total').html(data['TOTAL'])
                  $('#info-ticket-tipopago').html(data['TIPO_PAGO'])

                  if (ifnull(data['RAZON_SOCIAL']) ||
                    ifnull(data['DOMICILIO_FISCAL']) ||
                    ifnull(data['REGIMEN_FISCAL']) ||
                    ifnull(data['USO_DESCRIPCION']) ||
                    ifnull(data['RFC']) ||
                    ifnull(data['METODO_PAGO'])) {

                    $('#info-factura-razon_social').html(data['RAZON_SOCIAL']);
                    $('#info-factura-domicilio_fiscal').html(data['DOMICILIO_FISCAL']);
                    $('#info-factura-regimen_fiscal').html(data['REGIMEN_DESCRIPCION']);
                    $('#info-factura-uso').html(data['USO_DESCRIPCION']);
                    $('#info-factura-rfc').html(data['RFC']);
                    $('#info-factura-metodo_pago').html(data['METODO_PAGO']);
                    $('#info-factura-forma_pago').html(data['TIPO_PAGO'])

                    $('.panel-contenedor-factura').fadeIn(0);
                  }
                }
                )



                setTimeout(function () {
                  $(panel).fadeIn(100);
                }, 100);
                resolve(1);
                break;

              case 'PanelTemperaturas':
                setTimeout(function () {
                  $(panel).fadeIn(100);
                }, 100);
                resolve(1);
                break;

              case 'area_faltantes':
                await ajaxAwait({
                  api: 5,
                  turno_id: id
                }, 'turnero_api', { callbackAfter: true }, false, function (data) {

                  try {
                    data = data.response.data[0]['AREAS_PENDIENTES']
                    let html = '';
                    console.log(data);

                    let filter = data.filter((data) => {
                      return data.FINALIZADO === 0;
                    });

                    console.log(filter);

                    for (const key in filter) {
                      if (Object.hasOwnProperty.call(filter, key)) {
                        const element = filter[key];
                        html += `${element.AREA}, `;
                      }
                    }

                    $('#areas_faltantes').html(html);


                    html = '';
                    // console.log(data);

                    filter = data.filter((data) => {
                      return data.FINALIZADO === 1;
                    });

                    for (const key in filter) {
                      if (Object.hasOwnProperty.call(filter, key)) {
                        const element = filter[key];
                        html += `${element.AREA}, `;
                      }
                    }

                    $('#areas_terminadas').html(html);
                  } catch (error) {

                  }

                  $(panel).fadeIn(100);
                  resolve(1);

                })

                break;


              default:
                console.log('Sin opción panel')
                setTimeout(function () {
                  $(panel).fadeOut(100);
                }, 100);
                resolve(false);
                break;
            }
          } else {
            setTimeout(function () {
              $(panel).fadeOut(100);
            }, 100);
            resolve(false);
          }
        }, 110);
      });
    // resolve(0);
  });
}




function selectedTrTable(text, column = 1, table) {
  filter = text.toUpperCase();
  tablesearch = document.getElementById(table);
  tr = tablesearch.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[column];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].classList.add("selected");
        return tr[i];
      }
    }
  }
}



//Vista de un solo valor
function getAreaUnValor(titulo, titulosingular, api_url, registro_id, divContenedor) {
  //Plantilla 
  html = '<div class="modal fade" id="modalRegistrar' + titulo + '" tabindex="-1" aria-hidden="true" data-bs-backdrop="static"' +
    'data-bs-keyboard="false">' +
    '<div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">' +
    '<div class="modal-content">';

  //Header
  html += '<div class="modal-header header-modal">' +
    '<h5 class="modal-title">' + firstMayus(titulo) + '</h5>' +
    '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>' +
    '</div>';

  //Cuerpo
  html += '<div class="modal-body" id="' + titulo + '-body">' +
    // '<p class="none-p">Doble click para editar <i class="bi bi-pencil"></i></p>' +
    '<div class="text-center mt-2">' +
    '<div class="input-group flex-nowrap">' +
    '<input type="text" class="form-control input-color" style="display: unset !important;"' +
    'name="inputBuscarTable' + titulo + '" placeholder="Filtrar tabla" autocomplete="off" id="BuscarTabla' + titulo + '"' +
    'data-bs-toggle="tooltip" data-bs-placement="top" title="Filtra la lista por coincidencias">' +
    // '<span class="input-group-text" id="addon-wrapping" data-bs-toggle="tooltip" data-bs-placement="top"'+
    //   'title="Seleccione un paciente para visualizar su información">'+
    //   '<i class="bi bi-info-circle"></i> </span>'+
    '<span class="input-group-text" id="addon-wrapping" data-bs-toggle="tooltip" data-bs-placement="top"' +
    'title="Doble click a un registro para modificarlo">' +
    '<i class="bi bi-pencil"></i> </span>' +
    '</div> </div>' +
    '<div class="row mt-3">' +

    //Tabla contenido
    '<div class="col-6">' +
    '<table class="table tableContenido" id="Tabla' + titulo + '" style="width:100%">' +
    '<thead class="">' +
    '<tr>' +
    '<th scope="col d-flex justify-content-center">#</th>' +
    '<th scope="col d-flex justify-content-center">' + firstMayus(titulo) + '</th>' +
    '<th scope="col d-flex justify-content-center"><i class="bi bi-collection"></i></th>' +
    '</tr>' +
    '</thead>' +
    '<tbody>' +
    '</tbody>' +
    '</table>' +
    '</div>' +
    //

    //Formularios Registrar
    '<div class="col-6" id="RegistrarMetodo' + titulo + '">' +
    '<p>Crear nuevo registro:</p>' +
    '<form class="row" id="formRegistrar' + titulo + '">' +
    '<div class="col-12">' +
    '<label for="descripcion" class="form-label">Nombre ' + titulosingular + '</label>' +
    '<input type="text" name="descripcion" required value="" class="form-control input-form">' +
    '</div>' +
    '<div class="text-center">' +
    '<button type="submit" class="btn btn-hover me-2" style="margin-bottom:4px">' +
    '<i class="bi bi-send-plus"></i> Guardar' +
    '</button>' +
    '</div>' +
    '</form>' +
    '</div>' +
    //

    //Formulario Actualizar
    '<div class="col-6" id="editarMetodo' + titulo + '" style="display:none">' +
    '<p>Actualizar registro:</p>' +
    '<form class="row" id="formEditar' + titulo + '">' +
    '<div class="col-12">' +
    '<label for="descripcion" class="form-label">Nombre ' + titulosingular + '</label>' +
    '<input type="text" name="descripcion" required id="edit-' + titulo + '-descripcion" ' +
    'class="form-control input-form">' +
    '</div>' +
    '<div class="text-center">' +
    '<button type="submit" class="btn btn-hover me-2" style="margin-bottom:4px">' +
    '<i class="bi bi-pencil-square"></i> Actualizar' +
    '</button>' +
    '<button type="button" class="btn btn-hover btn-activo me-2" style="margin-bottom:4px; display: none" id="desactivar-' + titulo + '">' +
    '<i class="bi bi-collection"></i> Desactivar' +
    '</button>' +
    '<button type="button" class="btn btn-hover btn-activo me-2" style="margin-bottom:4px; display: none" id="activar-' + titulo + '">' +
    '<i class="bi bi-collection"></i> Activar' +
    '</button>' +
    '</div>' +
    '</form>' +
    '</div>' +
    //

    '<style>' +
    '#Tabla' + titulo + '_filter {' +
    'display: none;' +
    '}' +
    '</style>' +

    '</div>' + // Etiquetas de cierres
    '</div>';

  //Footer
  html += '<div class="modal-footer">' +
    '<button type="button" class="btn btn-cancelar" data-bs-dismiss="modal"><i class="bi bi-arrow-left-short"></i>' +
    'Cerrar</button>' +
    '</div>' +
    '</div>' +
    '</div>' +
    '</div>';

  //Crea el html en DOM
  $(divContenedor).html(html);

  vistaAreaUnValor(api_url, '#Tabla' + titulo, registro_id, titulo)


}

function vistaAreaUnValor(api_url, tabla_id, registro_id, titulo) {
  let dataAreaValor;
  //Vista table {-
  let TablaContenido = $(tabla_id).DataTable({
    processing: true,
    language: {
      url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json",
      loadingRecords: '&nbsp;',
      processing: '<div class="spinner"></div>'
    },
    lengthMenu: [
      [5, 10, -1],
      [5, 10, "All"]
    ],
    autoWidth: false,
    // searching: false,
    lengthChange: false,
    info: false,
    paging: false,
    scrollY: autoHeightDiv(0, 348),
    scrollCollapse: true,
    ajax: {
      dataType: 'json',
      data: { api: 2, ACTIVO: 1 },
      method: 'POST',
      url: http + servidor + "/" + appname + "/api/" + api_url + ".php",
      beforeSend: function () { },
      // success: function (data) { mensajeAjax(data) },
      complete: function () { cambiarFormMetodo(0, titulo, "formEditar" + titulo); },
      dataSrc: 'response.data'
    },
    createdRow: function (row, data, dataIndex) {
      // mensajeAjax(data)
      if (data.ACTIVO == 1) {
        $(row).addClass('bg-success text-white');
      } else {
        $(row).addClass('bg-danger text-white');
      }
    },
    columns: [
      { data: 'COUNT' },
      { data: 'DESCRIPCION' },
      {
        data: 'ACTIVO', render: function (data) {
          if (data == 1) {
            return '<i class="bi bi-check-circle"></i>';
          } else {
            return '<i class="bi bi-x-circle"></i>';
          }
        }
      },
    ],
    columnDefs: [{
      "width": "3px",
      "targets": 0
    },],

  });

  //Buscador
  $('#BuscarTabla' + titulo).keyup(function () {
    // //console.log($(this).val())
    TablaContenido.search($(this).val()).draw();
  });

  selectDatatabledblclick(function (select, data) {
    dataAreaValor = data;
    $('.btn-activo').fadeOut()
    $('.btn-activo').prop('disabled', true);
    if (!select) {
      cambiarFormMetodo(0, titulo, "formEditar" + titulo);
    } else {
      switch (dataAreaValor.ACTIVO) {
        case 1: case '1':
          $('#desactivar-' + titulo).fadeIn(100);
          setTimeout(() => {
            $('#desactivar-' + titulo).prop('disabled', false);
          }, 100);
          break;
        case 0: case '0':
          $('#activar-' + titulo).fadeIn(100);
          setTimeout(() => {
            $('#activar-' + titulo).prop('disabled', false);
          }, 100);
          break;
      }
      document.getElementById("edit-" + titulo + "-descripcion").value = dataAreaValor['DESCRIPCION'];
      cambiarFormMetodo(1, titulo);
    }
  }, tabla_id, TablaContenido, true)
  // -}


  //Modal vista {-
  // let modal = document.getElementById('modalRegistrar' + titulo)
  // modal.addEventListener('show.bs.modal', event => {
  //     TablaContenido.ajax.reload();
  // })

  //Ajusta el ancho del encabezado cuando es dinamico
  let modal = $('#modalRegistrar' + titulo);
  modal.on('shown.bs.modal', function (e) {
    TablaContenido.ajax.reload();
    $.fn.dataTable
      .tables({
        visible: true,
        api: true
      })
      .columns.adjust();
  })



  // -}

  //Formulario de registro de cargo
  $("#formRegistrar" + titulo).submit(function (event) {
    event.preventDefault();
    /*DATOS Y VALIDACION DEL REGISTRO*/
    var form = document.getElementById("formRegistrar" + titulo);
    var formData = new FormData(form);
    formData.set('api', 1);

    alertMensajeConfirm({
      title: '¿Está seguro que todos los datos están correctos?',
      text: "No podrá eliminar el registro",
      icon: 'warning'
    }, function () {
      $.ajax({
        data: formData,
        url: http + servidor + "/" + appname + "/api/" + api_url + ".php",
        type: "POST",
        processData: false,
        contentType: false,
        dataType: 'json',
        success: function (data) {
          if (mensajeAjax(data)) {
            alertToast('¡' + firstMayus(titulo) + ' registrado!', 'success')
            document.getElementById("formRegistrar" + titulo).reset();
            TablaContenido.ajax.reload();
            cambiarFormMetodo(0, titulo, "formEditar" + titulo);
            // selectMetodo()
          }
        },
        error: function (jqXHR, exception, data) {
          alertErrorAJAX(jqXHR, exception, data)
        },
      });
    }, 1)
    event.preventDefault();
  });


  //Formulario de actualizar cargo
  $("#formEditar" + titulo).submit(function (event) {
    event.preventDefault();
    /*DATOS Y VALIDACION DEL REGISTRO*/
    var form = document.getElementById("formEditar" + titulo);
    var formData = new FormData(form);
    formData.set(registro_id, dataAreaValor[registro_id])
    formData.set('api', 1);

    alertMensajeConfirm({
      title: '¿Está seguro de cambiar la descripcion?',
      text: "¡Se cambiará en todas las vistas!",
      icon: 'warning'
    }, function () {
      //$("#btn-registrarse").prop('disabled', true);
      // Esto va dentro del AJAX
      $.ajax({
        data: formData,
        url: http + servidor + "/" + appname + "/api/" + api_url + ".php",
        type: "POST",
        processData: false,
        contentType: false,
        dataType: 'json',
        success: function (data) {
          if (mensajeAjax(data)) {
            alertToast('¡' + firstMayus(titulo) + ' actualizado!', 'success')
            document.getElementById("formEditar" + titulo).reset();
            TablaContenido.ajax.reload();
            cambiarFormMetodo(0, titulo, "formEditar" + titulo);
            // selectMetodo()
          }
        },
        error: function (jqXHR, exception, data) {
          alertErrorAJAX(jqXHR, exception, data)
        },
      });
    }, 1)
    event.preventDefault();
  });

  //Desactivar valor
  $('#desactivar-' + titulo).click(function () {
    if (dataAreaValor != null) {
      alertMensajeConfirm({
        title: "¿Está seguro que desea desactivar este registro?",
        text: "No podrán volver a elegir el registro",
        icon: 'warning',
      }, function () {
        $.ajax({
          data: {
            id: dataAreaValor[registro_id],
            api: 4,
            ACTIVO: 0
          },
          url: http + servidor + "/" + appname + "/api/" + api_url + ".php",
          type: "POST",
          dataType: 'json',
          success: function (data) {
            if (mensajeAjax(data)) {
              alertToast('¡' + firstMayus(titulo) + ' eliminado!', 'success')
              document.getElementById("formEditar" + titulo).reset();
              TablaContenido.ajax.reload();
              cambiarFormMetodo(0, titulo, "formEditar" + titulo);
            }
          },
          error: function (jqXHR, exception, data) {
            alertErrorAJAX(jqXHR, exception, data)
          },
        });
      }, 1)
    } else {
      alertSelectTable();
    }
  })

  //Desactivar valor
  $('#activar-' + titulo).click(function () {
    if (dataAreaValor != null) {
      alertMensajeConfirm({
        title: "¿Está seguro que desea desactivar este registro?",
        text: "No podrán volver a elegir el registro",
        icon: 'warning',
      }, function () {
        $.ajax({
          data: {
            id: dataAreaValor[registro_id],
            api: 4,
            ACTIVO: 1
          },
          url: http + servidor + "/" + appname + "/api/" + api_url + ".php",
          type: "POST",
          dataType: 'json',
          success: function (data) {
            if (mensajeAjax(data)) {
              alertToast('¡' + firstMayus(titulo) + ' eliminado!', 'success')
              document.getElementById("formEditar" + titulo).reset();
              TablaContenido.ajax.reload();
              cambiarFormMetodo(0, titulo, "formEditar" + titulo);
            }
          },
          error: function (jqXHR, exception, data) {
            alertErrorAJAX(jqXHR, exception, data)
          },
        });
      }, 1)
    } else {
      alertSelectTable();
    }
  })

}


/*EN PROCESO */
//Genera un modal de varios valores
function generarCatalogoModal(
  CONTENT = {
    divContenedor,
    ID_CATALOGO: 'ID_CATALOGO',
    titulos: {
      IDSDIVS: 'Nuevo',
      HeaderTitle: 'Catalogo de especialidades',
      titulo: 'especialidad',
      titulos: 'especialidades'
    },
    formLabels: {
      DESCRIPCION: {
        LABEL: 'Nombre de especialidad',
        STRING: 'DESCRIPCION',
        CLASS: {
          input: '',
          div: 'col-12'
        }
      }
    },
    tableContent: {
      COUNT: {
        HEADER: '#',
        ID: 'COUNT',
        CLASS: ''
      },
      DESCRIPCION: {
        HEADER: 'DESCRIPCION',
        ID: 'DESCRIPCION',
        CLASS: ''
      },
      ACTIVO: {
        HEADER: '<i class="bi bi-collection"></i>',
        ID: 'ACTIVO',
        CLASS: ''
      }
    },
    diseño: {
      MODALCLASS: 'modal-lg modal-dialog-centered modal-dialog-scrollable',
    },
  },
  ajax = {
    data: {
      api: 2, ACTIVO: 1
    },
    api_url: '',
    dataSrc: 'response.data',
  },

  columnsData = [
    { data: 'COUNT' },
    { data: 'DESCRIPCION' },
    {
      data: 'ACTIVO', render: function (data) {
        if (data == 1) {
          return '<i class="bi bi-check-circle"></i>';
        } else {
          return '<i class="bi bi-x-circle"></i>';
        }
      }
    }
  ],
  columnsDefData = [
    {
      "width": "3px",
      "targets": 0
    },
  ],
  configTable = {
    processing: true,
    autoWidth: false,
    searching: false,
    info: false,
    paging: false,
    scrollY: '30vh',
    scrollCollapse: true,
  },

  createdRow = {
    IDCOMPARADOR: 'ACTIVO',
    VALUE: 1,
    CLASSTRUE: 'bg-success text-white',
    CLASSFALSE: 'bg-danger text-white'
  },

  tagTable = {
    table_id: '',
    titulo: ''

  }


) {

  let id = CONTENT['ID_CATALOGO'];
  getHTMLCatalogo(CONTENT['divContenedor'], CONTENT['titulos'], CONTENT['formLabels'], CONTENT['tableContent'], CONTENT['diseño'])

  setTimeout(() => {
    //console.log('timeOut')
    getTableControlador(tagTable, CONTENT, id, CONTENT['formLabels'], configTable, ajax['table'], createdRow, columnsData, columnsDefData)
  }, 200);
}

//Crear HTML 
//Modal de catalogos
function getHTMLCatalogo(divContenedor, titulos, formLabels, tableContent, diseño) {
  let html = '';
  // //console.log(divContenedor)
  //Plantilla 
  html = '<div class="modal fade" id="modalVista' + titulos['IDSDIVS'] + '" tabindex="-1" aria-hidden="true" data-bs-backdrop="static"' +
    'data-bs-keyboard="false">' +
    '<div class="modal-dialog ' + diseño['MODALCLASS'] + '">' +
    '<div class="modal-content">';

  //Header
  html += '<div class="modal-header header-modal">' +
    '<h5 class="modal-title">' + firstMayus(titulos['HeaderTitle']) + '</h5>' +
    '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>' +
    '</div>';

  //Cuerpo
  html += '<div class="modal-body" id="' + titulos['IDSDIVS'] + '-body">' +
    '<p class="none-p">Edite un registro dando doble click <i class="bi bi-pencil"></i></p>' +
    '<div class="row mt-3">' +

    //Tabla contenido
    '<div class="col-6">' +
    '<table class="table table-hover tableContenido" id="Tabla' + titulos['IDSDIVS'] + '" style="width:100%">' +
    '<thead class="">' +
    '<tr>';

  //th
  for (const key in tableContent) {
    if (Object.hasOwnProperty.call(tableContent, key)) {
      const th = tableContent[key];
      html += '<th scope="col d-flex justify-content-center" class="' + th['CLASS'] + '">' + th['HEADER'] + '</th>';
      // '<th scope="col d-flex justify-content-center">' + firstMayus(titulo) + '</th>' +
      // '<th scope="col d-flex justify-content-center"><i class="bi bi-collection"></i></th>';
    }
  }

  //Cierre tabla
  html += '</tr> </thead>' +
    '<tbody>' +
    '</tbody>' +
    '</table>' +
    '</div>' +
    //

    //Formularios Registrar
    '<div class="col-6" id="RegistrarModal' + titulos['IDSDIVS'] + '">' +
    '<p>Crear nuevo registro:</p>' +
    '<form class="row" id="formRegistrar' + titulos['IDSDIVS'] + '">';

  //LABELS
  for (const key in formLabels) {
    if (Object.hasOwnProperty.call(formLabels, key)) {
      const input = formLabels[key];
      html += '<div class="' + input['CLASS']['div'] + '">' +
        '<label for="' + input['STRING'] + '" class="form-label">' + input['LABEL'] + '</label>' +
        '<input type="text" name="' + input['STRING'] + '" required value="" class="form-control input-form">' +
        '</div>';
    }
  }

  //Botones
  html += '<div class="text-center">' +
    '<button type="submit" class="btn btn-hover me-2" style="margin-bottom:4px">' +
    '<i class="bi bi-send-plus"></i> Guardar' +
    '</button>' +
    '</div>' +
    '</form>' +
    '</div>' +
    //

    //Formulario Actualizar
    '<div class="col-6" id="editarModal' + titulos['IDSDIVS'] + '" style="display:none">' +
    '<p>Actualizar registro:</p>' +
    '<form class="row" id="formEditar' + titulos['IDSDIVS'] + '">';

  //LABELS
  for (const key in formLabels) {
    if (Object.hasOwnProperty.call(formLabels, key)) {
      const input = formLabels[key];
      html += '<div class="col-12">' +
        '<label for="' + input['STRING'] + '" class="form-label">' + input['LABEL'] + '</label>' +
        '<input type="text" name="' + input['STRING'] + '" required id="edit-' + formLabels['DESCRIPCION']['STRING'] + '-input" class="form-control input-form">' +
        '</div>';
    }
  }

  //Botones
  html += '<div class="text-center">' +
    '<button type="submit" class="btn btn-hover me-2" style="margin-bottom:4px">' +
    '<i class="bi bi-pencil-square"></i> Actualizar' +
    '</button>' +
    '<button type="button" class="btn btn-hover btn-activo me-2" style="margin-bottom:4px; display: none" id="desactivar-' + titulos['IDSDIVS'] + '">' +
    '<i class="bi bi-collection"></i> Desactivar' +
    '</button>' +
    '<button type="button" class="btn btn-hover btn-activo me-2" style="margin-bottom:4px; display: none" id="activar-' + titulos['IDSDIVS'] + '">' +
    '<i class="bi bi-collection"></i> Activar' +
    '</button>' +
    '</div>' +
    '</form>' +
    '</div>' +
    //

    '</div>' + // Etiquetas de cierres
    '</div>';

  //Footer
  html += '<div class="modal-footer">' +
    '<button type="button" class="btn btn-cancelar" data-bs-dismiss="modal"><i class="bi bi-arrow-left-short"></i>' +
    'Cerrar</button>' +
    '</div>' +
    '</div>' +
    '</div>' +
    '</div>';

  //Crea el html en DOM
  //console.log($(divContenedor))
  $(divContenedor).html(html);

}


function getTableControlador(tagTable, CONTENT, id_primario, formLabels, configTable, ajax, createdRow, columnsData, columnsDefData) {
  let TablaContenido = $(tagTable['table_id']).DataTable({
    processing: configTable['processing'],
    language: {
      url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json",
      loadingRecords: '&nbsp;',
      processing: '<div class="spinner"></div>'
    },
    lengthMenu: [
      [5, 10, -1],
      [5, 10, "All"]
    ],
    autoWidth: configTable['autoWidth'],
    searching: configTable['searching'],
    lengthChange: configTable[''],
    info: configTable['info'],
    paging: configTable['paging'],
    scrollY: configTable['scrollY'],
    scrollCollapse: configTable['scrollCollapse'],
    ajax: {
      dataType: 'json',
      data: ajax['data'],
      method: 'POST',
      url: http + servidor + "/" + appname + "/api/" + ajax['api_url'] + ".php",
      beforeSend: function () { },
      // success: function (data) { mensajeAjax(data) },
      complete: function () {
        cambiarFormMetodo(0, `${CONTENT['titulos']['IDSDIVS']}`, `formEditar${CONTENT['titulos']['IDSDIVS']}`);
      },
      dataSrc: ajax['dataSrc']
    },
    createdRow: function (row, data, dataIndex) {
      // mensajeAjax(data)
      if (data[createdRow['IDCOMPARADOR']] == createdRow['VALUE']) {
        $(row).addClass(createdRow['CLASSTRUE']);
      } else {
        $(row).addClass(createdRow['CLASSFALSE']);
      }
    },
    columns: columnsData,
    columnDefs: columnsDefData,

  });


  selectDatatabledblclick(function (select, dataSelect) {
    //console.log(dataSelect);
    // var dataSelect = data;
    $('.btn-activo').fadeOut()
    $('.btn-activo').prop('disabled', true);
    if (!select) {
      cambiarFormMetodo(0, `${CONTENT['titulos']['IDSDIVS']}`, `formEditar${CONTENT['titulos']['IDSDIVS']}`);
    } else {
      switch (dataSelect.ACTIVO) {
        case 1: case '1': case '<i class="bi bi-check-circle"></i>':
          $('#desactivar-' + tagTable['titulo']).fadeIn(100);
          setTimeout(() => {
            $('#desactivar-' + tagTable['titulo']).prop('disabled', false);
          }, 100);
          break;
        case 0: case '0': case '<i class="bi bi-x-circle"></i>':
          $('#activar-' + tagTable['titulo']).fadeIn(100);
          setTimeout(() => {
            $('#activar-' + tagTable['titulo']).prop('disabled', false);
          }, 100);
          break;
      }
      document.getElementById("edit-" + formLabels['DESCRIPCION']['STRING'] + "-input").value = dataSelect['DESCRIPCION'];
      cambiarFormMetodo(1, tagTable['titulo']);
    }
  }, tagTable['table_id'], TablaContenido)
  let modal = $('#modalVista' + tagTable['titulo']);
  //console.log('#modalVista' + tagTable['titulo'])
  modal.on('shown.bs.modal', function (e) {
    //console.log('si');
    TablaContenido.ajax.reload();
    $.fn.dataTable
      .tables({
        visible: true,
        api: true
      })
      .columns.adjust();
  })
  $("#formRegistrar" + CONTENT['titulos']['IDSDIVS']).submit(function (event) {
    event.preventDefault();
    /*DATOS Y VALIDACION DEL REGISTRO*/
    var form = document.getElementById("formRegistrar" + CONTENT['titulos']['IDSDIVS']);
    var formData = new FormData(form);
    formData.set('api', ajax['registrar']['data']['api']);

    alertMensajeConfirm({
      title: '¿Está seguro que todos los datos están correctos?',
      text: "No podrá eliminar el registro",
      icon: 'warning'
    }, function () {
      $.ajax({
        data: formData,
        url: http + servidor + "/" + appname + "/api/" + ajax['registrar']['api_url'] + ".php",
        type: "POST",
        processData: false,
        contentType: false,
        dataType: 'json',
        success: function (data) {
          if (mensajeAjax(data)) {
            alertToast('¡' + firstMayus(CONTENT['titulos']['titulo']) + ' registrado!', 'success')
            document.getElementById("formRegistrar" + CONTENT['titulos']['IDSDIVS']).reset();
            TablaContenido.ajax.reload();
            cambiarFormMetodo(0, `${CONTENT['titulos']['IDSDIVS']}`, `formEditar${CONTENT['titulos']['IDSDIVS']}`);
            // selectMetodo()
          }
        },
        error: function (jqXHR, exception, data) {
          alertErrorAJAX(jqXHR, exception, data)
        },
      });
    }, 1)
    event.preventDefault();
  });


  //Formulario de actualizar cargo
  $("#formEditar" + CONTENT['titulos']['IDSDIVS']).submit(function (event) {
    event.preventDefault();
    /*DATOS Y VALIDACION DEL REGISTRO*/
    var form = document.getElementById("formEditar" + CONTENT['titulos']['IDSDIVS']);
    var formData = new FormData(form);
    formData.set(id, dataSelect[`${id_primario}`])
    formData.set('api', ajax['editar']['data']['api']);

    alertMensajeConfirm({
      title: '¿Está seguro de cambiar la descripcion?',
      text: "¡Se cambiará en todas las vistas!",
      icon: 'warning'
    }, function () {
      //$("#btn-registrarse").prop('disabled', true);
      // Esto va dentro del AJAX
      $.ajax({
        data: formData,
        url: http + servidor + "/" + appname + "/api/" + ajax['editar']['api_url'] + ".php",
        type: "POST",
        processData: false,
        contentType: false,
        dataType: 'json',
        success: function (data) {
          if (mensajeAjax(data)) {
            alertToast('¡' + firstMayus(titulos['titulo']) + ' actualizado!', 'success')
            document.getElementById("formEditar" + CONTENT['titulos']['IDSDIVS']).reset();
            TablaContenido.ajax.reload();
            cambiarFormMetodo(0, `${CONTENT['titulos']['IDSDIVS']}`, `formEditar${CONTENT['titulos']['IDSDIVS']}`);
            // selectMetodo()
          }
        },
        error: function (jqXHR, exception, data) {
          alertErrorAJAX(jqXHR, exception, data)
        },
      });
    }, 1)
    event.preventDefault();
  });

  //Desactivar valor
  $('#desactivar-' + CONTENT['titulos']['IDSDIVS']).click(function () {
    if (dataSelect != null) {
      alertMensajeConfirm({
        title: "¿Está seguro que desea desactivar este registro?",
        text: "No podrán volver a elegir el registro",
        icon: 'warning',
      }, function () {
        $.ajax({
          data: {
            id: dataSelect[`${id_primario}`],
            api: ajax['desactivar']['data']['api'],
            ACTIVO: 0
          },
          url: http + servidor + "/" + appname + "/api/" + ajax['desactivar']['api_url'] + ".php",
          type: "POST",
          dataType: 'json',
          success: function (data) {
            if (mensajeAjax(data)) {
              alertToast('¡' + firstMayus(titulos['titulo']) + ' eliminado!', 'success')
              document.getElementById("formEditar" + CONTENT['titulos']['IDSDIVS']).reset();
              TablaContenido.ajax.reload();
              cambiarFormMetodo(0, `${CONTENT['titulos']['IDSDIVS']}`, `formEditar${CONTENT['titulos']['IDSDIVS']}`);
            }
          },
          error: function (jqXHR, exception, data) {
            alertErrorAJAX(jqXHR, exception, data)
          },
        });
      }, 1)
    } else {
      alertSelectTable();
    }
  })

  //Desactivar valor
  $('#activar-' + CONTENT['titulos']['IDSDIVS']).click(function () {
    if (dataSelect != null) {
      alertMensajeConfirm({
        title: "¿Está seguro que desea desactivar este registro?",
        text: "No podrán volver a elegir el registro",
        icon: 'warning',
      }, function () {
        $.ajax({
          data: {
            id: dataSelect[`${id_primario}`],
            api: ajax['desactivar']['data']['api'],
            ACTIVO: 1
          },
          url: http + servidor + "/" + appname + "/api/" + ajax['desactivar']['api_url'] + ".php",
          type: "POST",
          dataType: 'json',
          success: function (data) {
            if (mensajeAjax(data)) {
              alertToast('¡' + firstMayus(titulos['titulo']) + ' eliminado!', 'success')
              document.getElementById("formEditar" + CONTENT['titulos']['IDSDIVS']).reset();
              TablaContenido.ajax.reload();
              cambiarFormMetodo(0, `${CONTENT['titulos']['IDSDIVS']}`, `formEditar${CONTENT['titulos']['IDSDIVS']}`);
            }
          },
          error: function (jqXHR, exception, data) {
            alertErrorAJAX(jqXHR, exception, data)
          },
        });
      }, 1)
    } else {
      alertSelectTable();
    }
  })
}






function vistaPDF(divContenedor, url, nombreArchivo, callback = function () { }, tipo = {}) {
  $.post(http + servidor + '/' + appname + '/vista/include/funciones/viewer-pdf.php', {
    url: url, nombreArchivo: nombreArchivo, tipo: tipo
  }, function (html) {
    $(divContenedor).html(html);
  }).done(async function () {
    callback()
  })
  // let htmlPDF = '<div id="adobe-dc-view" style="height: 100%"></div>' +
  //   '<script src="https://documentservices.adobe.com/view-sdk/viewer.js"></script>' +
  //   '<script type="text/javascript">' +
  //   'document.addEventListener("adobe_dc_view_sdk.ready", function(){ ' +
  //   'var adobeDCView = new AdobeDC.View({clientId: "cd0a5ec82af74d85b589bbb7f1175ce3", divId: "' + div + '"});' +
  //   'adobeDCView.previewFile({' +
  //   'content:{location: {url: "' + url + '"}},' +
  //   'metaData:{fileName: "' + nombreArchivo + '"}' +
  //   '});' +
  //   '});' +
  //   '</script>';
  // $(divContenedor).html(htmlPDF);
}


//Metodo global
function cambiarFormMetodo(fade, titulo, form = "formEditar") {
  if (fade == 1) {
    $('#RegistrarMetodo' + titulo).fadeOut();
    setTimeout(function () {
      $('#editarMetodo' + titulo).fadeIn();
    }, 400);
  } else {
    //console.log(form)
    document.getElementById(form).reset();
    $('#editarMetodo' + titulo).fadeOut();
    setTimeout(function () {
      $('#RegistrarMetodo' + titulo).fadeIn();
    }, 400);
  }
}

//Scroll zoom images
function ScrollZoom(container, max_scale, factor) {
  var target = container
  var size = {
    w: target.width(),
    h: target.height()
  }
  var pos = {
    x: 0,
    y: 0
  }
  var scale = 1
  var zoom_target = {
    x: 0,
    y: 0
  }
  var zoom_point = {
    x: 0,
    y: 0
  }
  var curr_tranform = target.css('transition')
  var last_mouse_position = {
    x: 0,
    y: 0
  }
  var drag_started = 0

  target.css('transform-origin', '0 0')
  target.on("mousewheel DOMMouseScroll", scrolled)
  target.on('mousemove', moved)
  target.on('mousedown', function () {
    drag_started = 1;
    target.css({
      'cursor': 'move',
      'transition': 'transform 0s'
    });
    /* Save mouse position */
    last_mouse_position = {
      x: event.pageX,
      y: event.pageY
    };
  });

  target.on('mouseup mouseout', function () {
    drag_started = 0;
    target.css({
      'cursor': 'default',
      'transition': curr_tranform
    });
  });

  function scrolled(e) {
    var offset = container.offset()
    zoom_point.x = e.pageX - offset.left
    zoom_point.y = e.pageY - offset.top

    e.preventDefault();
    var delta = e.delta || e.originalEvent.wheelDelta;
    if (delta === undefined) {
      //we are on firefox
      delta = e.originalEvent.detail;
    }
    delta = Math.max(-1, Math.min(1, delta)) // cap the delta to [-1,1] for cross browser consistency

    // determine the point on where the slide is zoomed in
    zoom_target.x = (zoom_point.x - pos.x) / scale
    zoom_target.y = (zoom_point.y - pos.y) / scale

    // apply zoom
    scale += delta * factor * scale
    scale = Math.max(1, Math.min(max_scale, scale))

    // calculate x and y based on zoom
    pos.x = -zoom_target.x * scale + zoom_point.x
    pos.y = -zoom_target.y * scale + zoom_point.y

    update()
  }

  function moved(event) {
    if (drag_started == 1) {
      var current_mouse_position = {
        x: event.pageX,
        y: event.pageY
      };
      var change_x = current_mouse_position.x - last_mouse_position.x;
      var change_y = current_mouse_position.y - last_mouse_position.y;

      /* Save mouse position */
      last_mouse_position = current_mouse_position;
      //Add the position change
      pos.x += change_x;
      pos.y += change_y;

      update()
    }
  }

  function update() {
    // Make sure the slide stays in its container area when zooming out
    if (pos.x > 0)
      pos.x = 0
    if (pos.x + size.w * scale < size.w)
      pos.x = -size.w * (scale - 1)
    if (pos.y > 0)
      pos.y = 0
    if (pos.y + size.h * scale < size.h)
      pos.y = -size.h * (scale - 1)

    target.css('transform', 'translate(' + (pos.x) + 'px,' + (pos.y) + 'px) scale(' + scale + ',' + scale + ')')
  }
}

//Servicios en cargar estudios con popper

function cargarServiciosEstudios(button, tooltip, servicio_id) {

  const arrow = $('#arrow');

  const popperInstance = Popper.createPopper(button, tooltip, {
    placement: 'right',
    options: {
      element: arrow,
    },
    modifiers: [
      {
        name: 'offset',
        options: {
          offset: [0, 20],
        },
      },
    ],
  });

  function show() {
    tooltip.setAttribute('data-show', '');
    popperInstance.update();

    ajaxAwait({
      api: 0,
      id: servicio_id
    }, "servicios_api", { callbackAfter: true }, false, function (data) {

    })

  }

  function hide() {
    tooltip.removeAttribute('data-show');
  }

  const showEvents = ['mouseenter', 'focus'];
  const hideEvents = ['mouseleave', 'blur'];

  showEvents.forEach((event) => {
    $(button).on(event, show);
  });

  hideEvents.forEach((event) => {
    $(button).on(event, hide);
  });
}


//Funcion para crear un tooltip grande
function popperHover(container = 'ID_CLASS', tooltip = 'ID_CLASS', callback = (show_hide) => { }, config = { directShow: false }) {

  $(tooltip).append(`<div id="arrow" class="arrow" data-popper-arrow></div>`);
  const arrow = $('#arrow'); // Siempre Introducir un arrow

  const reference = $(container)[0];
  const popper = $(tooltip)[0];

  let popperInstance = null;
  let timeoutId = null;

  function createPopper() {
    popperInstance = Popper.createPopper(reference, popper, {
      placement: 'right-start',
      modifiers: [
        {
          name: 'offset',
          options: {
            offset: [0, 20],
          },
        },
      ],
    });
  }

  function destroyPopper() {
    if (popperInstance) {
      popperInstance.destroy();
      popperInstance = null;
    }
  }

  function show() {
    if (!popperInstance) {
      createPopper();
    }

    $(document).on('click', hide);
    tooltip.setAttribute('data-show', '');
    popperInstance.update();

    // Iniciar temporizador para retrasar el callback
    timeoutId = setTimeout(() => {
      callback(true);
    }, 1000); // Cambia el valor de 500 a la cantidad de milisegundos que desees como retraso antes de ejecutar el callback
  }

  function hide(event) {
    if (!$(event.target).closest(container).length) {
      $(document).off('click', hide);
      tooltip.removeAttribute('data-show');
      destroyPopper();

      // Cancelar el temporizador si el usuario sale antes de que se ejecute el callback
      clearTimeout(timeoutId);
      callback(false);
    }
  }

  function leave(event) {
    if (!$(event.target).closest(container).length) {
      $(document).off('click', leave);

      // Cancelar el temporizador si el usuario sale antes de que se ejecute el callback
      clearTimeout(timeoutId);
      callback(false);
    }
  }

  $(container).on('click', hide);
  $(container).on('mouseenter', show);
  $(container).on('mouseleave', hide);
}



function validarCuestionarioEspiro() {
  // return new Promise(function (resolve) {

  situacion1 = '#no_aplica1'
  situacion1 = $(situacion1).is(':checked');

  let situacion2 = '#no_aplica2'
  situacion2 = $(situacion2).is(':checked');


  if (!detectPreguntasNivel('.independiente')) {
    // resolve(true);
    return true;
  }

  // console.log(situacion2)

  if (!situacion2) {
    if (!detectPreguntasNivel('.situaciones2')) {
      // resolve(true);
      return true;
    }
  }

  // if (!situacion1) {
  //   if (!detectPreguntasNivel('.situaciones1')) {
  //     // resolve(true);
  //     return true;
  //   }
  // }


  // resolve(false);
  return false;
  // })
}


function detectPreguntasNivel(situacion) {
  let hasUnansweredQuestion = false; // Variable auxiliar para indicar si hay una pregunta sin contestar

  // let label = $('.titulo')[0];
  // label.scrollIntoView({ behavior: 'smooth', block: 'center' });

  $(situacion).each(function () {
    let hasChecked = $(this).find('input[type="checkbox"], input[type="radio"]').is(':checked');
    let preguntaElement = $(this).find('.titulo')[0];

    if (!hasChecked) {
      //Scroll
      scrollContentInView(preguntaElement)
      hasUnansweredQuestion = true; // Establecer la variable auxiliar en true
      return false; // Salir del each()
    }

    // Si también necesitas comprobar otras condiciones, puedes hacerlo aquí

  });

  return !hasUnansweredQuestion; // Retornar el valor invertido de la variable auxiliar
}

//para formulario  de espiro
function scrollContentInView(pregunta) {
  pregunta.scrollIntoView({ behavior: 'smooth', block: 'center' });

  $(pregunta).css('border-bottom', '2px solid red');


  setTimeout(() => {
    $(pregunta).animate({
      marginLeft: '10px'
    }, 100, function () {
      $(this).animate({
        marginLeft: '-10px'
      }, 100, function () {
        $(this).animate({
          marginLeft: '0'
        }, 100);
      });
    });
  }, 500);

}