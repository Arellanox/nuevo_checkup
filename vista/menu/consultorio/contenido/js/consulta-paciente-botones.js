$('#btn-consulta-terminar').click(function () {
  let button = $(this)
  alertMensajeConfirm({
    title: "¿Está seguro de terminar la consulta?",
    text: "Ya no podrá hacer cambios con la consulta",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Aceptar",
    cancelButtonText: "Cancelar",
  }, function () {
    $.ajax({
      url: http + servidor + "/nuevo_checkup/api/consulta_api.php",
      method: 'POST',
      dataType: 'json',
      beforeSend: function () {
        button.prop('disabled', true)
      },
      data: {
        api: 11,
        id_consulta: pacienteActivo.selectID
      },
      success: function (data) {
        if (mensajeAjax(data)) {
          button.prop('disabled', false)
          alertMensaje('info', 'La consulta ha sido cerrada', 'Podrá consultar la información del paciente desde el menú :)')
        }
      },
      complete: function () {

      }

    })
  })
})

// Exploracion clinica
$('#select-exploracion-clinica').on('change', function () {
  let selectoo = $('#select-exploracion-clinica').val();
  switch (selectoo) {
    case '1':
      $("#texto-exp-cli").html(`
      Estado de conciencia. Orientación temporo-espacial. Peso. Talla. Índice de masa corporal.
      Deformidades generales, parciales o regionales. Color de piel y mucosas (palidez. cianosis, ictericia, manchas,
      estado de nutrición e hidratación, presion arterial. Pulso y frecuencia de pulso. Temperatura. `);

      break;
    case '2':
      $("#texto-exp-cli").html(`
      Cráneo: configuración y deformidades. Pelo: implante, consistencia y aspecto. Cara: simetría o asimetría. Coloración. Percusión de senos paranasales. Motilidad facial y mandibular. Implantación de cejar. •	Ojos: Globo Ocular: tamaño: exolftalmía, enoftalmía, tensión. Motilidad. Conjuntiva ocular y palpebral, escleróticas, iris, pupila, córnea, reflejo fotomotor, movimientos oculares, fondo de ojo, agudeza visual.
      •	Oídos: forma, tamaño, posición, simetría, pabellón auricular, conducto auditivo externo, membrana timpánica. Higiene, presencia de secreciones, dificultad en la audición, dolor, secreción, infección de oído, otros.
      •	Naríz: fosas nasales, senos paranasales, tamaño, posición del tabique nasal, mucosa nasal, permeabilidad, olfato, coriza, aleteo nasal, lesiones.
      •	Amígdalas y faringe: lesiones, congestión, gusto.
        `)
      break;
    case '3':
      $("#texto-exp-cli").html(`
      "Deformidades generales, parciales o regionales. Color de piel y mucosas
      (palidez. Cavidad Bucal: labios (coloración, humedad, lesiones),
      dientes (presencia de prótesis, estado de conservación, caries, piezas faltantes),
      lengua (humedad, lesiones, movimientos), paladar duro y blando (lesiones, congestión)."

`)
      break;

    case '4':
      $("#texto-exp-cli").html(`
      Aspecto, simetría, forma y tamaño (ancho y corto, delgado y largo);
      movilidad (flexión, extensión, lateralización, rotación), ingurgitación yugular,
      pulso carotideo (presencia o ausencia, simetría, intensidad), sensibilidad,
      aumentos de volumen localizados (tumores, bocio, adenopatías), masa, rigidez
      a) Tiroides: aumentado de tamaño u otras alteraciones vasculares, presencia de lóbulos.
`)
      break;

    case '5':
      $("#texto-exp-cli").html(`"Conformación Ósea: simetría, uso musculatura accesoria, retracción o abombamiento de espacios intercostales, elasticidad, expansión, movilidad de la caja torácica, dolor, masas, lesiones, cicatrices, cambios de coloración.
Mamas: tamaño, simetría, forma, lesiones de piel, pezones, areolas, retracciones, tumoraciones, conductos galactófaros, cola de Spence, tejido adiposo
Axilas: búsqueda de ganglios linfáticos de la zona. Aspecto: consistencia, tamaño, adherencia a planos profundos y movilidad así como compromiso de la piel suprayacente."
`)
      break;

    case '6':
      $("#texto-exp-cli").html(`"Frecuencia respiratoria, movimientos respiratorios, expansibilidad torácica, ritmo respiratorio, describir el tipo, quejido, estridor, tiraje, abovedamientos, retracciones.
Expansibilidad torácica, vibraciones vocales (conservados, aumentados, disminuidas o abolidas).
Sonoridad pulmonar normal, hipersonoridad, timpanismo, submatidez, matidez. Murmullo vesicular (normal, disminuido, ausente), ruidos adventicios o estertores, auscultación de la tos, auscultación de la voz (pectoriloquia, broncofonia)."
`)
      break;

    case '7':
      $("#texto-exp-cli").html(`"
a)	Área Periférica: característica del pulso radial: sincronismo, amplitud, intensidad, determinar la presencia o ausencia de pulsos periféricos o disminución de la amplitud de los mismos (pulsos temporales superficiales, carotídeos, humerales, radiales, femorales, poplíteos, tibiales posteriores, pedios); Precisar la presencia de várices o microvárices.
b)	Área Central:
Ictus cordis: localización, extensión, intensidad, determinar los ruidos cardiacos en los focos de auscultación (punta, nórtico, pulmonar, tricuspideo y mosocardio). Precisar la presencia de: ritmo de galope, chasquido de apertura de la mitral, acentuación o desdoblamiento de los ruidos, clicks, soplos, arrastre. En el caso de soplos deben precisarse sus características (momento, localización, intensidad, tono, timbre, irradiación y modificación con diferentes maniobras)."
`)
      break;

    case '8':
      $("#texto-exp-cli").html(`Aspecto, simetría,
       abombamientos, circulación colateral,
       cicatrices, ombligo, *Maniobra de Valsalva, hernias, eventraciones. Dolor, tumoraciones,
       visceromegalias, signo de irritación peritoneal.
        Ascitis, distensión por gases, globo vesical, tumores de la pared o intraabdominal,
        sonoridad normal. Ruidos hidroaéreos (aumentados, disminuidos o ausentes).`);
      break;

    case '9':
      $("#texto-exp-cli").html(`Adenopatías inguinales (número, tamaño, consistencia, movilidad, adherencia a piel o planos profundos, sensibilidad y dolor, color de la piel que las recubre.
`)
      break;

    case '10':
      $("#texto-exp-cli").html(`"1.	Puñopercusión de fosas lumbares: aumento de volumen, cambios inflamatorios, dolorosa o no. 2.	Genitales Femeninos
Se comienzan examinando los genitales externos, observando caracteres sexuales secundarios, aspectos de labios mayores y menores, desarrollo del clítoris, desembocadura de la uretra, coloración de la mucosa e identificar si existe alguna lesión o abultamiento localizado anormal.  Inspección de región peri anal, lesiones, tumores, vesículas, fístulas. Secresiones: determinar características, color, fetidez y cantidad.
3) Genitales Masculinos:
Distribución pilosa, pene, prepucio, glande, bolsas escrotales, testículos, cordón espermático, próstata, etc."
`)
      break;

    case '11':
      $("#texto-exp-cli").html(`"Menarca. Fecha de última menstruación. Número de gestaciones. Partos. Cesareas. Abortos. Inicio de vida sexual. Método de planificación familiar.
"
`)
      break;

    case '12':
      $("#texto-exp-cli").html(`"Coloración general y sus alteraciones: palidez, rubicundez, cianosis, coloración amarilla (ictericia y seudoictericia), melanodermia.
Superficie: lustrosidad, humedad, descamaciones, grosor, nevos, efélides, manchas, pliegues, estrias, estado trófico, etc.
Faneras: pelo (cantidad, distribución, implantación, calidad, color, largo, grosor, resistencia), uñas (forma, aspecto, resistencia, crecimiento y color).
Tejido celular subcutáneo: determinar si está infiltrado o no por edema, mixedema o enfisema subcutáneo, características (distribución, color, temperatura, sensibilidad y consistencia)"
`)
      break;

    case '13':
      $("#texto-exp-cli").html(`"Ganglios Linfáticos: palpación meticulosa de las regiones ganglionares (retroauriculares, occipitales, submentonianas, submaxilares, cervicales, supraclaviculares, axilares, epitrocleares, inguinales), forma, consistencia, delimitación, movilidad, sensibilidad o dolor.
Hígado: normalmente no visible a la inspección, pero presumible por abombamiento del hipocondrio derecho. Se explora a la palpación superficial y profunda para determinar el tamaño, la consistencia, característica de su superficie si es lisa o nodular, delimitación de los bordes, etc.
Bazo: aumento de volumen del hipocondrio izquierdo (en grandes esplenomegalias). Realice la palpación en posición de Schuster, búsqueda de manifestaciones hemorrágicas: petequias, equimosis, vibices, hematomas, etc."
`)
      break;

    case '14':
      $("#texto-exp-cli").html(`"Columna Vertebral: determine la presencia de cifosis, lordosis, escoliosis, cifoescoliosis, palpación de las apófisis espinosas en busca de dolor y de los puntos entre dos apófisis espinosas (a 2 cm. a ambos lados de la línea media).
Articulaciones: precisar aumento de volumen, deformidad, cambios de coloración, grado de flexión y extensión, desviaciones articulares en uno u otro sentido, etc.
Miembros: aspecto, simetría	Motilidad: activa, pasiva
Músculos: volumen muscular, atrofias, tumoraciones, simetría, forma y movimiento, dolor consistencia."
`)
      break;

    case '15':
      $("#texto-exp-cli").html(`

"Estado de Conciencia: lúcido/a, desorientado/a en tiempo o espacio, somnoliento/a, obnubilado/a, estuporoso/a,
Escala de Glasgow. Lenguaje y habla: afasia y disfasias, disartria y anartria, polilalia, bradilalia y ecolalia.
Marcha: aspectos fundamentales a precisar en la marcha del paciente.
-	Capacidad de flexión y extensión de los segmentos de las extremidades inferiores.
-	Movimientos coordinados entre las extremidades superiores y el tronco.
-	Marcha en línea recta o no
-	Si el enfermo mira hacia delante, si mira al suelo y donde pone los pies o un punto fijo.
-	Si la marcha es rápida o lenta.
-	Si aumenta la base de sustentación.
-	Si al deambular apoya primero el talón o la punta del pie.
Tono y Trofismo muscular: aspecto, consistencia, relieve, contorno aumentado o disminuido, actitud de las extremidades. Resistencia de los músculos a la manipulación pasiva de los miembros, tronco y cabeza. El tono muscular puede estar normal, aumentado (hipertonía), disminuido (hipotonía), recurrir a la medición para identificar atrofia muscular. Pares Craneales: I-II-III-IV-V-VI-VII-VIII rama coclear y vestibular IX-X-XI-XII. Reflejos: cutáneos, osteotendinosos, clonus
Signos Meníngeos: rigidez de la nuca, Kernig, Brudzinski."

`)
      break;

    default:
      $("#texto-exp-cli").html(`Aqui se Mostrara Mas informacion`);
  }
})


//Regresar a perfil de paciente
$('#btn-regresar-vista').click(function () {
  alertMensajeConfirm({
    title: "¿Está seguro de regresar?",
    text: "¡Asegurese de guardar los cambios!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Aceptar",
    cancelButtonText: "Cancelar",
  }, function () {
    obtenerContenidoAntecedentes(pacienteActivo.array)
  })
})


// Exploracion clinica
$('#btn-agregar-exploracion-clinina').on('click', function () {
  let titulo = $('#select-exploracion-clinica option').filter(':selected').text();
  $.ajax({
    data: {
      turno_id: pacienteActivo.array['ID_TURNO'],
      exploracion_tipo_id: $('#select-exploracion-clinica').val(),
      exploracion: $('#text-exploracion-clinica').val(),
      api: 6
    },
    url: "../../../api/consulta_api.php",
    type: "POST",
    dataType: "json",
    success: function (data) {
      // alert("antes de la nota")
      agregarNotaConsulta(titulo, null, $('#text-exploracion-clinica').val(), '#notas-historial-consultorio', data.response.data, 'eliminarExploracion')
      $('#text-exploracion-clinica').val('')
      // alert("despues de la nota")
    },
  });
})
//Eliminar los comentario 
$(document).on('click', '.eliminarExploracion', function () {
  let id = $(this).attr('data-bs-id');
  let comentario = $(this);

  alertMensajeConfirm({
    title: "¿Está seguro de eliminar este registro?",
    text: "¡No podrá revertir esta acción!",
    icon: "warning",
    showCancelButton: true,
    cancelButtonColor: "#3085d6",
    confirmButtonColor: "#d33",
    confirmButtonText: "Aceptar",
    cancelButtonText: "Cancelar",
  }, function () {
    $.ajax({
      data: {
        id_exploracion_clinica: id,
        api: 7
      },
      url: "../../../api/consulta_api.php",
      type: "POST",
      success: function (data) {
        // alert("antes de la nota")
        // if (mensajeAjax(data)) {
        var parent_element = $(comentario).closest("div[class='card mt-3']");
        console.log(parent_element)
        $(parent_element).remove()
        // }

        // alert("despues de la nota")
      },
    });
  })
  // eliminarElementoArray(id);
  // console.log(id);
});




// Odontograma
$('#formAgregarOdontograma').submit(function (event) {
  event.preventDefault();
  let button = $('#btn-guardar-Receta')
  button.prop('disabled', true)
  let form = document.getElementById("formAgregarOdontograma");
  let formData = new FormData(form)
  formData.set('turno_id', pacienteActivo.array['ID_TURNO'])
  formData.set('api', 18)
  console.log(formData)
  $.ajax({
    data: formData,
    dataType: 'json',
    processData: false,
    type: "POST",
    contentType: false,
    url: http + servidor + '/nuevo_checkup/api/consulta_api.php',
    success: function (data) {
      // alert("antes de la nota")
      console.log(data);
      document.getElementById("formAgregarOdontograma").reset();
      button.prop('disabled', false)
      tablaOdontograma.ajax.reload()
      // alert("despues de la nota")
    },
  });
})
//Eliminar odontograma
$(document).on('click', '.eliminarOdontograma', function () {
  // alert(1);
  // event.stopPropagation();
  // event.stopImmediatePropagation();
  let id = $(this).attr('data-bs-id');
  let button = $(this);
  // alert(id);
  alertMensajeConfirm({
    title: "¿Está seguro de eliminar este registro?",
    text: "¡No podrá regresar los cambios!",
    icon: "warning",
    showCancelButton: true,
    cancelButtonColor: "#3085d6",
    confirmButtonColor: "#d33",
    confirmButtonText: "Confirmar",
    cancelButtonText: "Cancelar",
  }, function () {
    $.ajax({
      url: http + servidor + "/nuevo_checkup/api/consulta_api.php",
      method: 'POST',
      dataType: 'json',
      data: {
        api: 20,
        id_odontograma: id
      },
      beforeSend: function () {
        button.prop('disabled', true)
      },
      success: function (data) {
        if (mensajeAjax(data)) {
          button.prop('disabled', false)

          // alertMensaje('info', 'Eliminado', 'ELIMINADO')
          alertToast('Odontograma elimando', 'success')
          tablaOdontograma.ajax.reload()
        }
      }

    })
  })
})








//Guardar antecedentes
$(document).on('click', '.guardarAnamn ', function (event) {
  event.stopPropagation();;
  event.stopImmediatePropagation()
  button = $(this)
  button.prop('disabled', true);
  var parent_element = button.closest("form").attr('id');
  console.log(parent_element);
  let formData = new FormData(document.getElementById(parent_element));
  // console.log(formData);
  formData.set('api', 8);
  formData.set('turno_id', pacienteActivo.array['ID_TURNO']);

  $.ajax({
    data: formData,
    url: http + servidor + "/nuevo_checkup/api/consulta_api.php",
    type: "POST",
    processData: false,
    contentType: false,
    dataType: 'json',
    beforeSend: function () {
      // alert('Enviando')
      alertToast('Guardando...', 'info')
    },
    success: function (data) {
      button.prop('disabled', false);
      alertToast('Guardado con exito', 'success');
    },
  });
  // eliminarElementoArray(id);
  // console.log(id);

});




// //Agegar form para receta
// $('#btn-agregar-medicamento-receta').click(function () {
//   nuevoMedicamentoReceta("#recetas-medicamentos")
//     // $id_receta,
//   // $turno_id,
//   // $nombre_generico,
//   // $forma_farmaceutica,
//   // $dosis,
//   // $presentacion,
//   // $frecuencia,
//   // $via_de_administracion,
//   // $duracion_del_tratamiento,
//   // $indicaciones_para_el_uso
// })
//Eliminar los campos 
// $(document).on('click', '.eliminarRecetaActual', function () {
//   let id = $(this).attr('data-bs-id');


//   var parent_element = $(this).closest("div[class='col-12 d-flex justify-content-end']");
//   $(parent_element).remove()

// });

//Guardar receta 
$('#formNuevaReceta').submit(function (event) {
  event.preventDefault();
  let button = $('#btn-guardar-Receta')
  button.prop('disabled', true)
  let form = document.getElementById("formNuevaReceta");
  let formData = new FormData(form)
  formData.set('api', 9)
  formData.set('turno_id', pacienteActivo.array['ID_TURNO'])
  $.ajax({
    url: http + servidor + "/nuevo_checkup/api/consulta_api.php",
    method: 'POST',
    dataType: 'json',
    processData: false,
    contentType: false,
    data: formData,
    success: function (data) {
      console.log(data);
      button.prop('disabled', false)
      document.getElementById("formNuevaReceta").reset();
      tablaRecetas.ajax.reload()
    }
  })
})
//Eliminar receta registro
$(document).on('click', '.eliminarRecetaTabla', function () {
  let id = $(this).attr('data-bs-id');
  let button = $(this);
  // alert(id);
  alertMensajeConfirm({
    title: "¿Está seguro de eliminar esta receta?",
    text: "¡No podrá regresar los cambios!",
    icon: "warning",
    showCancelButton: true,
    cancelButtonColor: "#3085d6",
    confirmButtonColor: "#d33",
    confirmButtonText: "Confirmar",
    cancelButtonText: "Cancelar",
  }, function () {
    $.ajax({
      url: http + servidor + "/nuevo_checkup/api/consulta_api.php",
      method: 'POST',
      dataType: 'json',
      data: {
        api: 17,
        id_receta: id
      },
      beforeSend: function () {
        button.prop('disabled', true)
      },
      success: function (data) {
        if (mensajeAjax(data)) {
          button.prop('disabled', false)
          // alertMensaje('info', 'Eliminado', 'ELIMINADO')
          alertToast('Receta elimanda', 'success')
          tablaRecetas.ajax.reload()
        }
      }

    })
  })
  // $.ajax({
  //   url: http + servidor + "/nuevo_checkup/api/notas_historia_api.php",
  //   type: "POST",
  //   dataType: "json",
  //   data: {
  //     api: 4,
  //     id_nota: id,
  //   },
  //   success: function (data) {
  //     if (mensajeAjax(data)) {
  //       var parent_element = button.closest("div");
  //       $(parent_element).remove()
  //     }
  //   }
  // });
});


$('#btn-guardar-Nutricion').click(function () {
  let button = $(this)
  button.prop('disabled', true)
  guardarInformacion({
    api: 5,
    turno_id: pacienteActivo.array['ID_TURNO'],
    peso_perdido: $('#input-pesosPerdido').val(),
    grasa: $('#input-grasa').val(),
    cintura: $('#input-cintura').val(),
    agua: $('#input-agua').val(),
    musculo: $('#input-musculo').val(),
    abdomen: $('#input-abdomen').val()
  }, function () {
    button.prop('disabled', false)
    alertToast('Datos guardados...', 'success')
  })
})

$('#btn-guardar-notaPadecimiento').click(function () {
  $('#btn-guardar-notaPadecimiento').prop('disabled', true);
  guardarInformacion({
    api: 3,
    notas_padecimiento: $('#nota-notas-padecimiento').val(),
    id_consulta: pacienteActivo.selectID
  }, function () {
    $('#btn-guardar-notaPadecimiento').prop('disabled', false);
    alertToast('Nota guardarda', 'success')
  })
})

$('#btn-guardar-Diagnostico').click(function () {
  $('#btn-guardar-Diagnostico').prop('disabled', true);
  guardarInformacion({
    api: 3,
    diagnostico: $('#diagnostico-campo-consulta').val(),
    id_consulta: pacienteActivo.selectID
  }, function () {
    $('#btn-guardar-Diagnostico').prop('disabled', false);
    alertToast('Nota guardarda', 'success')
  })
})




function guardarInformacion(data, callback) {
  $.ajax({
    url: http + servidor + "/nuevo_checkup/api/consulta_api.php",
    method: 'POST',
    dataType: 'json',
    data: data,
    success: function (data) {
      if (mensajeAjax(data)) {
        callback();
      }
    }
  })
}