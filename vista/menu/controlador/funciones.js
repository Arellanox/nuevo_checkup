function formatoFecha(texto) {
  return texto.replace(/^(\d{4})-(\d{2})-(\d{2})$/g, '$3/$2/$1');
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
      // console.log(data);
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
function rellenarSelect(select, api, num,v,c, values = {}){
  return new Promise(resolve => {
    values.api = num;
    
    let htmlContent;
    // Crear arreglo de contenido
    if (!Number.isInteger(c)) {
      htmlContent = c.split('.');
      console.log(htmlContent);
    }

    $(select).find('option').remove().end()
    $.ajax({
      url: http + servidor + "/nuevo_checkup/api/" + api + ".php",
      data: values,
      type: "POST",
      success: function (data) {
        var data = jQuery.parseJSON(data);
        for (var i = 0; i < data['response']['data'].length; i++) {

          // Crear el contenido del select por numero o arreglo
          if (Array.isArray(htmlContent)) {
            datao = "";
            for (var a = 0; a < htmlContent.length; a++) {
              if (a == 0) {
                datao += data['response']['data'][i][htmlContent[a]];
              }else{
                datao += " - " + data['response']['data'][i][htmlContent[a]];
              }
            }
          }else{
            datao = data['response']['data'][i][c];
          }

          // Rellenar select con Jquery
          var o = new Option("option text", data['response']['data'][i][v]);
          $(o).html(datao);
          $(select).append(o);
        }
      },
      complete: function(){
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

function alertSelectTable() {
  Toast.fire({
    icon: 'error',
    title: 'No ha seleccionado ningún registro',
    timer: 4000
  });
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

function selectDatatable(tablename, datatable, panel = null, api = null, tipPanel = null){
  $('#'+tablename+' tbody').on('click', 'tr', function () {
     if ($(this).hasClass('selected')) {
         $(this).removeClass('selected');
         array_selected = null;
         obtenerPanelInformacion(0, api, tipPanel)
     } else {
         datatable.$('tr.selected').removeClass('selected');
         $(this).addClass('selected');
         array_selected = datatable.row( this ).data();
         if (panel) {
           obtenerPanelInformacion(array_selected[0], api, tipPanel)
         }

     }
  });
}

function select2(select, modal = null){
  $(select).select2({
    dropdownParent: $('#'+modal),
    tags: false,
    width:'100%',
    placeholder: 'Selecciona una opcion',
  });
}

function obtenerPanelInformacion(id = null, api = null, tipPanel = null, panel = '#panel-informacion'){
  console.log("llamado");
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
    if (id > 0) {
      row = array_selected;
      switch (tipPanel) {
        case 'paciente':
            if (array_selected != null) {
              console.log(array_selected)
              $('#nombre-persona').html(row.NOMBRE_COMPLETO);
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
            }else{
              $.ajax({
                url: http + servidor + "/nuevo_checkup/api/pacientes_api.php",
                data: { api: 2, id: id },
                type: "POST",
                datatype: 'json',
                success: function (data) {
                  data = jQuery.parseJSON(data);
                  row = data[0];
                  console.log(row);
                  $('#nombre-persona').html(row.NOMBRE_COMPLETO);
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
                }
              })
            }
        break;
        case 'estudio':
          $('#nombre-estudio').html(row.DESCRIPCION);
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
        break;
        case 'equipo':
        console.log(row)
          $('#nombre-equipo').html(row.MARCA + "-"+row.MODELO);
          // $('#equipo-equipo').html(row.);
          $('#equipo-ingreso').html(formatoFecha(row.FECHA_INGRESO_EQUIPO));
          $('#equipo-inicio').html(formatoFecha(row.FECHA_INICIO_USO));
          $('#equipo-valor').html(row.VALOR_DEL_EQUIPO);
          $('#equipo-mantenimiento').html(row.FRECUENCIA_MANTENIMIENTO +" "+row.NUMERO_PRUEBAS);
          $('#equipo-calibracion').html(row.CALIBRACION +" "+ row.NUMERO_PRUEBAS_CALIBRACION);
          $('#equipo-uso').html(row.USO);
          $('#equipo-descripcion').html(row.DESCRIPCION);
        break;
        case 'signos-vitales':

        break;

        default:

      }
    }else{
      $('#info-php').fadeOut(100);
    }
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
