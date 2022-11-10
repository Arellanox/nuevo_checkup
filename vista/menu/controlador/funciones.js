//Formatear Fecha de sql
function formatoFecha(texto) {
  return texto.replace(/^(\d{4})-(\d{2})-(\d{2})$/g, '$3/$2/$1');
}
//Obtener numero rando
function getRandomInt(max) {
  return Math.floor(Math.random() * max);
}

// Omitir paciente actual
function pasarPacienteTurno(id_turno){
  Swal.fire({
    title: "¿Está seguro omitir este paciente?",
    text: "¡Este paciente se mandará al final de la lista!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Sí, omitir",
    cancelButtonText: "Cancelar",
  }).then((result) => {
    if (result.isConfirmed) {
      // $('#submit-registrarEstudio').prop('disabled', true);
      // Esto va dentro del AJAX

      $.ajax({
        data: {api: 7, id_turno: id_turno},
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
            tablaMuestras.ajax.reload();
          }
        },
      });
    }
  });
}

// Validar la vista
function redireccionarVista(vista, callback){
  if (session.vista[vista] == 1 ? true:false) {
    callback();
  }else{
    window.location.href = http + servidor + '/nuevo_checkup/vista/login/';
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

function desactivarCampo(div, fade){
  if (fade == 1) {
    $(div).fadeIn(400);
  }else{
    $(div +": input").val("");
    $(div).fadeOut(400);
  }
}

// Notifiació  movil
if (window.innerWidth <= 768) {
  position = 'top';
} else {
  position = 'top-start';
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


// Obtener segmentos por procedencia en select
function getSegmentoByProcedencia(id, select){
  return new Promise(resolve => {
    $('#'+select).find('option').remove().end()
    $.ajax({
      url: http + servidor + "/nuevo_checkup/api/segmentos_api.php",
      type: "POST",
      data: { id: id, api: 6 },
      success: function (data) {
        var data = jQuery.parseJSON(data);
        if (mensajeAjax(data)) {
          if (data['response']['data'].length > 0) {
            for (var i = 0; i < data['response']['data'].length; i++) {
              var o = new Option("option text", data['response']['data'][i]['id']);
              $(o).html(data['response']['data'][i]['segmento']);
              $('#'+select).append(o);
            }
          }else{
            var o = new Option("option text", null);
            $(o).html('No contiene segmentos');
            $('#'+select).append(o);
          }
        }
      },
      complete: function(){
        resolve(1);
      }
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
    url: http + servidor + "/nuevo_checkup/api/segmentos_api.php",
    type: "POST",
    data: { id: idProcedencia, api: 6 },
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
    }
  });

  return true;
}


// Obtener procedencias en select
function getProcedencias(select){
  return new Promise(resolve => {
    $('#'+select).find('option').remove().end()
    $.ajax({
      url: http + servidor + "/nuevo_checkup/api/clientes_api.php",
      type: "POST",
      data: { api: 2 },
      success: function (data) {
        var data = jQuery.parseJSON(data);
        for (var i = 0; i < data['response']['data'].length; i++) {
          var o = new Option("option text", data['response']['data'][i]['ID_CLIENTE']);
          $(o).html(data['response']['data'][i]['NOMBRE_COMERCIAL']);
          $('#'+select).append(o);
        }
      },
      complete: function(){
        resolve(1);
      }
    })
  });
}


function setProcedenciaOption(select, idProcedencia){
  var select = document.getElementById(select),
    length = select.options.length;
  while (length--) {
    select.remove(length);
  }
  $.ajax({
    url: http + servidor + "/nuevo_checkup/api/clientes_api.php",
    type: "POST",
    data: { api: 2 },
    success: function (data) {
      var data = jQuery.parseJSON(data);
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
  });
  return true;
}

// Obtener cargo y tipos de usuarios
function rellenarSelect(select, api, num,v,c, values = {}, callback = function(array){}){
  return new Promise(resolve => {
    values.api = num;

    let htmlContent;
    // Crear arreglo de contenido
    if (!Number.isInteger(c)) {
      htmlContent = c.split('.');
    }

    $(select).find('option').remove().end()
    $.ajax({
      url: http + servidor + "/nuevo_checkup/api/" + api + ".php",
      data: values,
      type: "POST",
      success: function (data) {

        if (typeof data == "string" && data.indexOf('response') > -1) {
          data = JSON.parse(data);
          data  = data['response']['data'];
          // data = data['data'];
        }else{
          data = JSON.parse(data);
        }

        for (var i = 0; i < data.length; i++) {

          // Crear el contenido del select por numero o arreglo
          if (Array.isArray(htmlContent)) {
            datao = "";
            for (var a = 0; a < htmlContent.length; a++) {
              if (data[i][htmlContent[a]] != null) {
                if (datao == '') {
                  datao += data[i][htmlContent[a]];
                }else{
                  datao += " - " + data[i][htmlContent[a]];
                }
              }

            }
          }else{
            datao = data[i][c];
          }
          // Rellenar select con Jquery
          var o = new Option("option text", data[i][v]);
          $(o).html(datao);
          $(select).append(o);

        }
        // console.log(data);
        callback(data);
      },
      complete: function(data){
        resolve(1);
      }
    })
  });
}


function optionElement(select,value,content){
  var o = new Option("option text", value);
  $(o).html(content);
  $(select).append(o);
  el.setAttribute('selected', 'selected');
}


$(window).on('hashchange', function (e) {
  var hash = window.location.hash.substring(1);
  switch (hash) {
    case 'LogOut':
      window.location.hash = '';
      window.location.href = http + servidor + '/nuevo_checkup/vista/login/?page=' + window.location;
      break;
    default: break;
  }
});

function getParameterByName(name) {
  name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
  var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
    results = regex.exec(location.search);
  return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}


function loader(fade) {
  if (fade == 'Out') {
    $("#loader").fadeOut(100);
    // alert("salir");
  } else if (fade == 'In') {
    $("#loader").fadeIn(100);
    // alert("entrar");
  }
}

function loaderDiv(fade, div = null, loader, loaderDiv1 = null, seconds = 50){
  if (fade == 'Out') {
    if (div != null) {
      $(div).fadeIn(seconds);
    }

    if (loaderDiv1 != null) {
      $(loaderDiv1).fadeOut(seconds);
    }
    $(loader).fadeOut(seconds);
    // alert("salir");
  } else if (fade == 'In') {
    if (div != null) {
      $(div).fadeOut(seconds);
    }
    if (loaderDiv1 != null) {
      $(loaderDiv1).fadeIn(seconds);
    }
    $(loader).fadeIn(seconds);
    // alert("entrar");
  }
}

function alertSelectTable(msj = 'No ha seleccionado ningún registro', icon = 'error', timer = 2000) {
  Toast.fire({
    icon: icon,
    title: msj,
    timer: timer
  });
}

function alertMensaje(icon = 'success', title = '¡Completado!', text = 'Datos completados', footer = null, html = null) {
  Swal.fire({
    icon: icon,
    title: title,
    text: text,
    html: html,
    footer: footer
  })
}

function mensajeAjax(data) {
  switch (data['response']['code']) {
    case 1:
      return 1;
      break;
    case 2:
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: '¡Ha ocurrido un error!',
        footer: 'Codigo: ' + data['response']['msj']
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
        text: 'Codigo: ' + data['response']['msj']
      })
      break;
    default:
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Hubo un problema!',
        footer: 'Reporte este error con el personal :)'
      })
  }
  return 0;
}

function selectDatatable(tablename, datatable, panel, api = {}, tipPanel = {}, idPanel = {0 : "#panel-informacion"}, callback = null){ //Se deben enviar las ultimas 3 variables en arreglo y deben coincidir en longitud
  // console.log(typeof tipPanel);
  if (typeof tipPanel == "string") {
    // Convierte String a Object
    api = {0: api}; tipPanel= {0: tipPanel};
  }else{
    // Coloca por defecto la ID de panel si no existe ID de envio
    if (idPanel[0] == null) {
      idPanel[0] = "#panel-informacion";
    }
  }
  if (typeof tablename === 'string') {
    tablename = '#'+tablename;
  }
  console.log(tablename)
  // console.log(idPanel)
  $(tablename).on('click', 'tr', function () {
     if ($(this).hasClass('selected')) {
         $(this).removeClass('selected');
         array_selected = null;
         // obtenerPanelInformacion(0, api, tipPanel)
         for (var i = 0; i < Object.keys(tipPanel).length; i++) {
           obtenerPanelInformacion(0, api, tipPanel[i], idPanel[i])
         }
         if (callback != null) {
           callback(0, null);
         }
     } else {
         datatable.$('tr.selected').removeClass('selected');
         $(this).addClass('selected');
         array_selected = datatable.row( this ).data();
         if (panel) {
           // Lee los 3 objetos para llamar a la funcion
           for (var i = 0; i < Object.keys(tipPanel).length; i++) {
             obtenerPanelInformacion(array_selected[0], api[i], tipPanel[i], idPanel[i])
           }
         }
         if (callback != null) {
           callback(1, array_selected); // Primer parametro es seleccion y segundo el arreglo del select del registro
         }
     }
  });
}

function getPanel(divClass, loader, loaderDiv1, selectLista, fade, callback){
  switch (fade) {
    case 'Out':
        if ($(divClass).is(':visible')) {
          if (selectLista == null) {
            loaderDiv("Out", null, loader, loaderDiv1, 0);
            $(divClass).fadeOut()
            // console.log('Invisible!')
          }
        }else{
          // console.log('Todavia visible!')
          setTimeout(function(){
            return getPanel(divClass, loader, loaderDiv1, selectLista, 'Out')
          }, 100);
        }
      break;
    case 'In':
        $(divClass).fadeOut(0)
        loaderDiv("In", null, loader, loaderDiv1, 0);
        // alert('in');
        callback(divClass);
        // $(divClass).fadeIn(100)
    break;
    default:
    return 0
  }
  return 1
}

function select2(select, modal = null, placeholder = 'Selecciona una opción'){
  $(select).select2({
    dropdownParent: $('#'+modal),
    tags: false,
    width:'100%',
    placeholder: placeholder
  });
}

function obtenerPanelInformacion(id = null, api = null, tipPanel = null, panel = '#panel-informacion'){
  return new Promise(resolve => {
    var html = "";
    $.post(http+servidor+"/nuevo_checkup/vista/include/barra-informacion/info-barra.php",
    {
      tip: tipPanel
    },
    function(html){
       setTimeout(function () {
         $(panel).html(html);
       }, 100);
    }).done(function(){
       setTimeout(function () {
          $(panel).fadeOut(0);
          if (id > 0) {
            row = array_selected;
            switch (tipPanel) {
              case 'paciente':
                  if (array_selected != null) {
                    $('#nombre-persona').html(row.NOMBRE_COMPLETO);
                    $('#edad-persona').html(formatoFecha(row.EDAD))
                    $('#nacimiento-persona').html(formatoFecha(row.NACIMIENTO))
                    $('#info-paci-curp').html(row.CURP);
                    $('#info-paci-telefono').html(row.CELULAR);
                    $('#info-paci-correo').html(row.CORREO);
                    $('#info-paci-sexo').html(row.GENERO);
                    if (row.TURNO) {
                      $('#info-paci-turno').html(row.TURNO);
                    }else{
                      $('#info-paci-turno').html('Sin generar');
                    }
                    $('#info-paci-directorio').html(row.CALLE+", "+row.COLONIA+", "+
                    row.MUNICIPIO+", "+row.ESTADO);
                    $('#info-paci-comentario').html(row.COMENTARIO_RECHAZO);
                    if (row.FECHA_REAGENDA != null) {
                      $('#info-paci-agenda').html(formatoFecha(row.FECHA_REAGENDA));
                    }
                    $(panel).fadeIn(100);
                    resolve(1);
                  }else{
                    $.ajax({
                      url: http + servidor + "/nuevo_checkup/api/pacientes_api.php",
                      data: { api: 2, id: id },
                      type: "POST",
                      datatype: 'json',
                      success: function (data) {
                        data = jQuery.parseJSON(data);
                        row = data['response']['data'][0];
                        $('#nombre-persona').html(row.NOMBRE_COMPLETO);
                        $('#edad-persona').html(formatoFecha(row.EDAD))
                        $('#nacimiento-persona').html(formatoFecha(row.NACIMIENTO));
                        $('#info-paci-curp').html(row.CURP);
                        $('#info-paci-telefono').html(row.CELULAR);
                        $('#info-paci-correo').html(row.CORREO);
                        $('#info-paci-sexo').html(row.GENERO);
                        if (row.TURNO) {
                          $('#info-paci-turno').html(row.TURNO);
                        }else{
                          $('#info-paci-turno').html('Sin generar');
                        }
                        $('#info-paci-directorio').html(row.CALLE+", "+row.COLONIA+", "+
                        row.MUNICIPIO+", "+row.ESTADO);
                        $('#info-paci-comentario').html(row.COMENTARIO_RECHAZO);
                        if (row.FECHA_REAGENDA != null) {
                          $('#info-paci-agenda').html(formatoFecha(row.FECHA_REAGENDA));
                        }
                      },
                      complete: function(){
                        $(panel).fadeIn(100);
                        resolve(1);
                      }
                    })
                  }
              break;
              case 'paciente_lab':
                $.ajax({
                  url: http + servidor + "/nuevo_checkup/api/pacientes_api.php",
                  data: { api: 2, id: id },
                  type: "POST",
                  datatype: 'json',
                  success: function (data) {
                    data = jQuery.parseJSON(data);
                    row = data['response']['data'][0];
                    $('#nombre-persona').html(row.NOMBRE_COMPLETO);
                    $('#edad-persona').html(formatoFecha(row.EDAD))
                    $('#nacimiento-persona').html(formatoFecha(row.NACIMIENTO));
                    $('#info-paci-curp').html(row.CURP);
                    $('#info-paci-telefono').html(row.CELULAR);
                    $('#info-paci-correo').html(row.CORREO);
                    $('#info-paci-sexo').html(row.GENERO);
                    if (row.TURNO) {
                      $('#info-paci-turno').html(row.TURNO);
                    }else{
                      $('#info-paci-turno').html('Sin generar');
                    }
                    $('#info-paci-directorio').html(row.CALLE+", "+row.COLONIA+", "+
                    row.MUNICIPIO+", "+row.ESTADO);
                    $('#info-paci-procedencia').html(row.PROCEDENCIA);
                    $('#info-paci-prefolio').html(row.PREFOLIO)
                  },
                  complete: function(){
                    $(panel).fadeIn(100);
                    resolve(1);
                  }
                })
              break;
              case 'estudio':
                $('#nombre-estudio').html(row['DESCRIPCION']);
                $('#clasificacion-estudio').html(row.CLASIFICACION_EXAMEN);
                $('#estudio-metodo').html(row.METODO);
                $('#estudio-medida').html(row.MEDIDA);
                $('#estudio-entrega').html(row.DIAS_DE_ENTREGA);
                if (row.LOCAL == 1) {
                  $('#estudio-subroga').html('Si');
                }else{
                  $('#estudio-subroga').html('No');
                }
                if (row.MUESTRA_VALORES_REFERENCIA == 1) {
                  $('#estudio-valorvista').html('Si');
                }else{
                  $('#estudio-valorvista').html('No');
                }
                $('#estudio-indicaciones').html(row.INDICACIONES);
                $('#estudio-codigo-sat').html(row.DESCRIPCION_SAT);
                $('#estudio-venta').html(row.PRECIO_VENTA);
                $(panel).fadeIn(100);
                resolve(1);
              break;
              case 'equipo':
                $('#nombre-equipo').html(row.MARCA + "-"+row.MODELO);
                // $('#equipo-equipo').html(row.);
                $('#equipo-ingreso').html(formatoFecha(row.FECHA_INGRESO_EQUIPO));
                $('#equipo-inicio').html(formatoFecha(row.FECHA_INICIO_USO));
                $('#equipo-valor').html(row.VALOR_DEL_EQUIPO);
                $('#equipo-mantenimiento').html(row.FRECUENCIA_MANTENIMIENTO +" "+row.NUMERO_PRUEBAS);
                $('#equipo-calibracion').html(row.CALIBRACION +" "+ row.NUMERO_PRUEBAS_CALIBRACION);
                $('#equipo-uso').html(row.USO);
                $('#equipo-descripcion').html(row.DESCRIPCION);
                $(panel).fadeIn(100);
                resolve(1);
              break;
              case 'signos-vitales':
              $(panel).fadeIn(100);
                resolve(1);
              break;
              case 'cliente':
              // console.log(row)
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
                console.log(selectContacto)
                $('#nombre-contacto').html(selectContacto.NOMBRE+' '+selectContacto.APELLIDOS);
                $('#info-contacto-tel1').html(selectContacto.TELEFONO1);
                $('#info-contacto-tel2').html(selectContacto.TELEFONO2);
                $('#info-contacto-email').html(selectContacto.EMAIL);
                $(panel).fadeIn(100);
                resolve(1);
              break;
              case 'documentos-paciente':
                // console.log(selectContacto)

                $(panel).fadeIn(100);
                resolve(1);
              break;
              case 'resultados-areaMaster':
                $(panel).fadeIn(100);
                resolve(1);
              break;

              default:
                console.log('Sin opción panel')
            }
          }else{
            setTimeout(function(){
              $(panel).fadeOut(100);
            }, 100);
          }
       }, 110);
    });
    // resolve(0);
  });
}


function selectedTrTable(text, column = 1, table){
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
