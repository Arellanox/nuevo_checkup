TablaContenidoPaciCertificados = $('#TablaContenidoPaciCertificados').DataTable({
  language: {
    url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
  },
  lengthChange: false,
  info: false,
  paging: false,
  // searching: false,
  scrollY: "53vh",
  scrollCollapse: true,
  ajax: {
    dataType: 'json',
    data: function (d) {
      return $.extend(d, dataListaPaciente);
    },
    method: 'POST',
    url: `${http}${servidor}/${appname}/api/certificados_api.php`,
    beforeSend: function () {
      loader("In")
    },
    complete: function () {
      loader("Out")
    },
    dataSrc: 'response.data'
  },
  columns: [
    { data: 'COUNT' },
    { data: 'NOMBRE_COMPLETO' },
    { data: 'PREFOLIO' },
    { data: 'CLIENTE' },
    { data: 'SEGMENTO' },
    { data: 'turno' },
    { data: 'GENERO' },
    { data: 'EXPEDIENTE' },
    // {defaultContent: 'En progreso...'}
  ],
  columnDefs: [
    { "width": "10px", "targets": 0 },
  ],

})

setTimeout(function () {
  inputBusquedaTable('TablaContenidoPaciCertificados', TablaContenidoPaciCertificados, [{
    msj: 'Una vez cargado o confirmado el reporte de un registro de esta area, aparecerán en verde',
    place: 'top'
  }], [], 'col-12')
}, 250)

selectTable('#TablaContenidoPaciCertificados', TablaContenidoPaciCertificados, { movil: true, reload: ['col-xl-8'] },
  async function (selectTR, array, callback) {

    datalist = array

    if (selectTR == 1) {
      dataSelect = new GuardarArreglo({
        select: true,
        // nombre_paciente: datalist['NOMBRE_COMPLETO'],
        turno: datalist['ID_TURNO']
      })
      
      await obtenerPanelInformacion(datalist['ID_TURNO'], 'pacientes_api', 'paciente', '#panel-informacion', '_lab',)
      await obtenerPanelInformacion(datalist['ID_TURNO'], 'consulta_api', 'listado_resultados', '#listado-resultados')

      callback('In')
      

      btnCertificados(datalist['CLIENTE'], datalist['GENERO']) //<- Funcion que alamacena la procedencia del paciente parta ir a global-botones.js
    }
    else {
      callback('Out')

      dataTurnero = null;
      dataSelect = new GuardarArreglo({
        select: false,
        // nombre_paciente: 'Sin paciente',
        turno: 0
      })
      // $('#btnResultados').fadeOut('100');
    }
  })

// selectTable('#TablaContenidoResultados', tablaContenido, { movil: true, reload: ['col-xl-8'] }, async function (selectTR, array, callback) {
//   // selectDatatable('TablaContenidoResultados', tablaContenido, 0, 0, 0, 0, function (selectTR = null, array = null) {
//   let datalist = array;
//   dataTurnero = array;
//   if (selectTR == 1) {
//       dataSelect = new GuardarArreglo({
//           select: true,
//           nombre_paciente: datalist['NOMBRE_COMPLETO'],
//           turno: datalist['ID_TURNO']
//       })

//       await obtenerPanelInformacion(datalist['ID_TURNO'], 'pacientes_api', 'paciente', '#panel-informacion', '_lab', areaActiva)
//       await obtenerServicios(areaActiva, datalist['ID_TURNO'])

//       //Obtener resultado de cada area
//       estadoFormulario(0) //Activa el formulario
//       switch (areaActiva) {
//           case 3: //Oftalmo
//               // await obtenerPanelInformacion(1, null, 'resultados-areas', '#panel-resultadosMaster', '_version2')
//               $('#btn-inter-oftal').fadeIn(0);
//               document.getElementById(formulario).reset()
//               if (datalist.CONFIRMADO_OFTAL == 1 || selectEstudio.getguardado() == 2) estadoFormulario(1)
//               if (selectEstudio.array.length)
//                   await obtenerResultadosOftalmo(selectEstudio.array)
//               break;

//           case 4:
//               // Cada que seleccione reinicie la interpretacion
//               ResetCapturasDeTablaDeAudio();
//               // audiometria;
//               $('#btn-inter-areas').fadeIn(0);

//               // Subir audios y Tabla de equipos
//               // console.log(dataSelect['array'])

//               // Captura de oidos (real por activar)
//               // getFormOidosAudiometria(datalist);

//               // Recupera la info del reporte:
//               console.log(selectEstudio.array);
//               if (ifnull(selectEstudio, false, ['array']))
//                   await obtenerResultadosAudio(selectEstudio);

//               // Inicializamos mostrando la primera página
//               updatePage($('.page').first());

//               if (datalist.CONFIRMADO_OFTAL == 1 || selectEstudio.getguardado() == 2) estadoFormulario(1)
//               break;
//           case 5:
//               $('#btn-inter-areas').fadeIn(0);
//               document.getElementById(formulario).reset()
//               $(`#${formulario}`).html('');
//               $(`#${formulario}`).html(formEspiroHTML)
//               $('#sintomasPaciente').html('');
//               $('#sintomasPaciente').fadeOut();

//               if (selectEstudio.array.length) {
//                   //console.log(selectEstudio.array[0]['PREGUNTAS'])
//                   recuperarDatosEspiro(selectEstudio.array[0]['PREGUNTAS'])
//               }

//               if (datalist.CONFIRMADO_ESPIRO == 1 || selectEstudio.getguardado() == 2) estadoFormulario(1)

//               await obtenerPanelInformacion(datalist['ID_TURNO'], "signos-vitales_api", 'signos-vitales', '#signos-vitales');

//               break;
//           case 8: //Rayos X
//               masterImagenología('CONFIRMADO_RX', datalist)
//               break;
//           case 11: //Ultrasonido
//               masterImagenología('CONFIRMADO_ULTRASO', datalist)
//               break;
//           case 10: //Electrocardiograma
//               $('#btn-inter-areas').fadeIn(0);
//               if (formulario != 1) {
//                   document.getElementById(formulario).reset()
//                   $('#capturaElectro').html('')
//                   if (datalist.CONFIRMADO_ELECTRO == 1 || selectEstudio.getguardado() == 2) estadoFormulario(1)

//                   if (selectEstudio.array.length) {
//                       await obtenerResultadosElectro(selectEstudio.array)
//                       if (ifnull(selectEstudio.array[0].ELECTRO_PDF))
//                           await mostrarElectroInterpretacion(selectEstudio.array[0].ELECTRO_PDF)
//                   }
//               } else {
//                   botonElectroCaptura(0);

//                   if (selectEstudio.array.length)
//                       if (selectEstudio.array[0].ELECTRO_PDF)
//                           botonElectroCaptura(1)
//               }
//               break;
//           case 14: //Nutricion
//               $('#btn-inter-areas').fadeIn(0);
//               if (formulario != 1) {
//                   // document.getElementById(formulario).reset()
//                   // $('#capturaElectro').html('')
//                   // if (datalist.CONFIRMADO_ELECTRO == 1 || selectEstudio.getguardado() == 2) estadoFormulario(1)

//                   // if (selectEstudio.array.length) {
//                   //     await obtenerResultadosElectro(selectEstudio.array)
//                   //     if (ifnull(selectEstudio.array[0].ELECTRO_PDF))
//                   //         await mostrarElectroInterpretacion(selectEstudio.array[0].ELECTRO_PDF)
//                   // }
//                   alert('Interpretacion de nutrición aun esta en mantenimiento')
//               } else {
//                   btnNutricionInbody(1);

//                   if (selectEstudio.array.length)
//                       if (selectEstudio.array[0].INBODY_PDF)
//                           btnNutricionInbody(0)
//               }
//               break;

//           case 9: //Prueba de esfuerzo
//               $('#btn-inter-areas').fadeIn(0);
//               if (formulario != 1) {
//                   // document.getElementById(formulario).reset()
//                   // $('#capturaElectro').html('')
//                   // if (datalist.CONFIRMADO_ELECTRO == 1 || selectEstudio.getguardado() == 2) estadoFormulario(1)

//                   // if (selectEstudio.array.length) {
//                   //     await obtenerResultadosElectro(selectEstudio.array)
//                   //     if (ifnull(selectEstudio.array[0].ELECTRO_PDF))
//                   //         await mostrarElectroInterpretacion(selectEstudio.array[0].ELECTRO_PDF)
//                   // }
//                   alert('Interpretacion en mantenimiento')
//               } else {
//                   btnTomaCapturas(0, 'Ecocardiología');
//                   try {
//                       if (selectEstudio.array.length)
//                           if (selectEstudio.array[0].ECOCARDIOGRAMA_PDF) //<-PDF como llega si hay
//                               btnTomaCapturas(1, 'Ecocardiología', selectEstudio.array[0].ECOCARDIOGRAMA_PDF)
//                   } catch (error) {

//                   }
//               }
//               break;


//           case 18: //Ecocardiograma
//               $('#btn-inter-areas').fadeIn(0);
//               if (formulario != 1) {
//                   // document.getElementById(formulario).reset()
//                   // $('#capturaElectro').html('')
//                   // if (datalist.CONFIRMADO_ELECTRO == 1 || selectEstudio.getguardado() == 2) estadoFormulario(1)

//                   // if (selectEstudio.array.length) {
//                   //     await obtenerResultadosElectro(selectEstudio.array)
//                   //     if (ifnull(selectEstudio.array[0].ELECTRO_PDF))
//                   //         await mostrarElectroInterpretacion(selectEstudio.array[0].ELECTRO_PDF)
//                   // }
//                   alert('Interpretacion en mantenimiento')
//               } else {
//                   btnTomaCapturas(0, 'Ecocardiología');
//                   try {
//                       if (selectEstudio.array.length)
//                           if (selectEstudio.array[0].ECOCARDIOGRAMA_PDF) //<-PDF como llega si hay
//                               btnTomaCapturas(1, 'Ecocardiología', selectEstudio.array[0].ECOCARDIOGRAMA_PDF)
//                   } catch (error) {

//                   }
//               }
//               break;
//           default:
//               botonesResultados('activar');
//               break;
//       }


//       if (selectEstudio.getguardado() == 1)
//           estadoFormulario(2)

//       callback('In')
//   } else {
//       callback('Out')

//       dataTurnero = null;
//       dataSelect = new GuardarArreglo({
//           select: false,
//           nombre_paciente: 'Sin paciente',
//           turno: 0
//       })
//       $('#btnResultados').fadeOut('100');
//   }

// })
