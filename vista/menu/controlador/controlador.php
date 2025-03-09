<?php
  $menu = $_POST['menu'];
  $tipoUrl = isset($_POST['tipoUrl']) ?  $_POST['tipoUrl'] : 1;
  $tip = $_POST['tip'];
  date_default_timezone_set('America/Mexico_City');
  session_start();
  include "../../variables.php";
?>

<!-- HTML -->
<header id="header-js"></header>
<div id="titulo-js"></div>
<div class="container-fluid " id="body-js">
  <div class="col-12 loader" id="loader">
    <div class="preloader" id="preloader"> </div>
  </div>
</div>
<div class="" id="modals-js"> 
  <!-- Aqui podrán incluir los modals --> 
</div>
<!-- HTML -->
 <?php include "../../../helpers/config.php"; ?>
<script type="text/javascript">
  //Variable global para datatable
  var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
  var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl)
  })

  const appname = 'nuevo_checkup';
  switch ('<?php echo $url; ?>') {
    case 'localhost':
      var http = "http://";
      var servidor = "localhost";
      break;
    default:
      var http = "https://";
      var servidor = "bimo-lab.com";
      break;

    case 'drjb.com.mx':
      var http = "https://";
      var servidor = "drjb.com.mx";
      break;

    case 'helicebiologicos.com':
      var http = "http://";
      var servidor = "helicebiologicos.com";
      break;
  }

  localStorage.setItem('http', http);
  localStorage.setItem('servidor', servidor);
  localStorage.setItem('appname', appname);

  miStorage = window.localStorage;
  miStorage.setItem("Olakace", "HOLA MUNDO XD");
  // <!-- Aqui controlar e incluir las modals -->
  obtenerHeader('<?php echo $menu ?>', '<?php echo $tip ?>');

  function obtenerHeader(menu, tip) {
    $.post("<?php echo $https . $url . '/' . $appname . '/vista/include/header/header.php'; ?>", {
      menu: menu,
      tip: tip
    }, function(html) {
      $("#header-js").html(html);
    });
  }

  function obtenerTitulo(menu, tipo = null) { //Usar async await para no tener problemas con inputs de fecha
    return new Promise(resolve => {
      $.post("<?php echo $https . $url . '/' . $appname . '/vista/include/header/titulo.php'; ?>", {
        menu: menu,
        tipo: tipo
      }, function(html) {
        $("#titulo-js").html(html);
      }).done(function() {
        resolve(1);
      });
    });
  }

  function obtenerAreaActiva() {
    if (typeof areaActual === 'undefined') {
      return areaActiva; //Funciona para la area master, y probablemente para otras...
    }
    return areaActual; // Area actual es para areas independientes coloquen la ID donde pertenecen
  }


  // Carga la vista para entrar a los servicios
  function cargarVistaServiciosPorArea(hash) {
    event.preventDefault()
    subarea = obtenerAreaActiva()
    // Si existe la variable
    // var base64 = new Base64();
    // areaActual = base64.decode(areaActual);
    // $area = isset($_GET['var'])? $_GET['var']: 0;
    switch (subarea) {
      case 6:
        cargarVistaServiciosPorAreaURL(hash, 'laboratorio-servicios');
        break;
      case 3:
      case 4:
      case 5:
      case 7:
      case 8:
      case 9:
        let base64 = new Base64();
        var s = base64.encode(subarea); // BJlgLS
        // var n = base64.decode('BJlgLS'); 
        cargarVistaServiciosPorAreaURL(hash, 'area-servicios', '?var=' + s);
        break;
      default:
        break;
    }
  }

  function cargarVistaServiciosPorAreaURL(hash, ubicacion, variables = '') {
    switch (hash) {
      case 'Estudios':
        window.location.href = `${http}${servidor}/${appname}/vista/menu/${ubicacion}/${variables}#Estudios`;
        break;
      case 'Grupos':
        window.location.href = `${http}${servidor}/${appname}/vista/menu/${ubicacion}/${variables}#Grupos`;
        break;
    }
  }

  let array_selected;
  let array_user;
  var validar;
  const session = <?php echo json_encode($_SESSION); ?>;
  // session['id'] = '';
  session['token'] = '';

  // ontooltip(); // <-- Ejecutar los tooltip en todo momento
  // function ontooltip() {
  var delay = 100,
    setTimeoutConst = false;
  $(document).on({
    mouseenter: function(e) {
      tool = this;
      setTimeotConst = setTimeout(function() {
        return new bootstrap.Tooltip(tool).show();
      }, delay)
    },
    mouseleave: function(e) {
      clearTimeout(setTimeotConst)
      $('[role="tooltip"]').fadeOut(100, function() {
        $(this).remove();
      });
    },
  }, '[data-bs-toggle="tooltip"]')


  let oneClick_promociones = 0;
  $.getScript("<?php echo $https . $url . '/' . $appname . '/vista/menu/controlador/class.js'; ?>").done(function() {
    $.getScript("<?php echo $https . $url . '/' . $appname . '/vista/menu/controlador/funciones.js'; ?>").done(function() {
        loggin(function(val) {
          if (val) {

            getGalleryPromociones_menu();

            function getGalleryPromociones_menu() {
              ajaxAwait({
                api: 2,
                vigente: 1
              }, 'promociones_api', {
                callbackAfter: true
              }, false, (data) => {
                // Resetea para volver a consultar
                oneClick_promociones = 0;

                if (data.response.data.length > 0) {
                  const galleria = new CargadorProgresivo({
                    contenedor: 'vistaPromociones',
                    html_case: 'PROMOCIONES_BIMO',
                    datos: data.response.data,
                    itemsIniciales: 10,
                    itemsPorCarga: 50,
                    html: {
                      imagenes_css: {
                        width: '100%',
                      },
                      divElement: {
                        class: 'col-lg-6 col-md-6 mb-4'
                      }
                    }
                  });
                  modal_alert = 1;

                  $('.promociones-block').fadeIn(100);
                } else {
                  $('.promociones-block').fadeOut(0);
                  $('#modalPromociones').modal('hide');
                  modal_alert = 0;
                  if (modal_alert)
                    alertToast('Promociones no activas', 'info', 5000)
                }

              })
            }

            $(document).on('click', '.promociones_event', function(event) {
              oneClick_promociones += 1;

              setTimeout(() => {
                if (oneClick_promociones === 1) {
                  getGalleryPromociones_menu();
                } else {
                  // oneClick_promociones = 0;
                  // alertToast('Espera un momento', 'warning', 5000);
                }
              }, 250);
            });



            $(function() {
              // console.log(session)
              // <!-- Aqui controlar e incluir las modals -->
              $.getScript('contenido/controlador.js').done(function(data) {
                if (validar == true) {
                  // <!-- Aqui controlar e incluir los tablas -->
                  $.getScript('modals/controlador.js').done(function() {}); // !!Algunos modals de algunas areas no usan la calse GuardarArreglo.!!
                }
              });
            })
          }
        }, <?php echo $tipoUrl; ?>)
      });
  });
</script>
