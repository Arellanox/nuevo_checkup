tablaListaPaciente = $('#TablaLaboratorio').DataTable({
    language: {url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"},
    lengthChange: false,
    info: false,
    paging: false,
    scrollY: '73vh',
    scrollCollapse: true,
    ajax: {
        method: 'POST',
        dataType: 'json',
        dataSrc: 'response.data',
        url: '../../../api/turnos_api.php',
        data: function (d) { return $.extend(d, dataListaPaciente); },
        beforeSend: function () { loader("In") },
        complete: function (data) {
          loader("Out", 'bottom');
          reloadSelectTable(); //Para ocultar segunda columna
        }
    },
    createdRow: function (row, data) {
        if (data.CONFIRMADO == 1) {
          $(row).addClass('bg-success text-white');
        }

       // Se utiliza un icono para identificar la procedencia
        if (data.PROCEDENCIA_FRANQUICIA == 1) {
            $('td:eq(1)', row).prepend('<i class="bi bi-building me-2"></i>');
            $(row).attr({'data-bs-toggle': 'tooltip', 'data-bs-original-title': 'Paciente de Franquicia', 'data-bs-placement': "right"});

            if(data.CONFIRMADO == 0) {
                $(row).addClass('text-white');
                $(row).css('background-color', '#a76a2d');
            }
        } else {
            $(row).addClass('bg-warning');
            $(row).attr({'data-bs-toggle': 'tooltip', 'data-bs-original-title': 'Paciente de BIMO', 'data-bs-placement': "right"});
        }
    },
    columns: [
        { data: 'COUNT' },
        { data: 'NOMBRE_COMPLETO'},
        { data: 'PREFOLIO' },
        { data: 'CLIENTE' },
        { data: 'SEGMENTO' },
        { data: 'turno' },
        { data: 'GENERO' },
        { data: 'EXPEDIENTE' },
        { data: 'CODIGOS' },
    ],
    columnDefs: [{ "width": "10px", "targets": 0 }],
});

loaderDiv("Out", null, "#loader-Lab", '#loaderDivLab');

selectTable('#TablaLaboratorio', tablaListaPaciente, { unSelect: true, movil: true, reload: ['col-xl-8'] }, async (selectTR, array, callback) => {
    selectListaLab = array;
    if (selectTR == 1) {
        try {
            await obtenerPanelInformacion(selectListaLab['ID_TURNO'], 'pacientes_api', 'paciente', '#panel-informacion', '_lab', 6)
            await generarHistorialResultados(selectListaLab['ID_PACIENTE'])
            await generarFormularioPaciente(selectListaLab['ID_TURNO'])

            if (selectListaLab.CONFIRMADO == 1) {
                $('button[type="submit"][form="formAnalisisLaboratorio"]').prop('disabled', true)
                $('#formAnalisisLaboratorio :input').prop('disabled', true)
            } else {
                $('button[type="submit"][form="formAnalisisLaboratorio"]').prop('disabled', false)
                $('#formAnalisisLaboratorio :input').prop('disabled', false)
            }
        } catch (error) {
            alertMensaje('warning', 'Hubo un error', 'Hubo un error al recuperar los datos del paciente, contacte con los coordinadores de TI')
        }
        callback('In')
    } else {
        callback('Out')
    }
})

inputBusquedaTable('TablaLaboratorio', tablaListaPaciente, [{
  msj: 'Una vez confirmado el reporte, el registro se dibujará en verde',
  place: 'top'
}], [], 'col-12')

function generarHistorialResultados(id) {
    return new Promise(resolve => {
        $.ajax({
            type: "POST",
            dataType: 'json',
            data: { id_paciente: id, api: 6, id_area: areaActiva},
            url: `${http}${servidor}/${appname}/api/turnos_api.php`,
            success: function (data) {
                row = data.response.data;

                /** Se genera el HTML para mostrar el historial de estudios anteriores */
                let html = '';
                for (var i = 0; i < row.length; i++) {
                    html += `
                        <div class="accordion-item bg-acordion">
                            <h2 class="accordion-header" id="collap-historial-estudios-${i}">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-estudio-${i}-Target" aria-expanded="false" aria-controls="accordionEstudios">
                                    <div class="row">
                                        <div class="col-12">
                                            <i class="bi bi-box-seam"></i>  &nbsp;&nbsp;&nbsp; Cargado: <strong>${row[i]['NOMBRE_COMPLETO']}</strong>
                                        </div>
                                        <div class="col-12">
                                            <i class="bi bi-calendar3"></i> &nbsp;&nbsp;&nbsp; Fecha: <strong>${formatoFecha2(row[i]['FECHA_CONFIRMADO'])}</strong>  
                                        </div>
                                    </div>
                                </button>
                            </h2>
                            <div id="collapse-estudio-${i}-Target" class="accordion-collapse collapse overflow-auto" aria-labelledby="collap-historial-estudios-${i}" style="max-height: 70vh"> 
                                <div class="d-flex justify-content-center align-items-center">
                                    <a href="${row[i]['RUTA_REPORTE']}" target="_blank" data-bs-id="${row[i]['ID_TURNO ']}" class="d-block w-max bg-danger text-white rounded-3 my-2" style="padding: 10px 14px">
                                         <i class="bi bi-file-earmark-pdf-fill"></i> Ver Resultados 
                                    </a>
                                </div>
                                <div class="accordion-body">
                                    <div class="row">
                    `;

                    for (var k in row[i]['servicios']) {
                        html += `
                            <div class="col-8 text-start info-detalle"><p>${row[i]['servicios'][k]['SERVICIO']}:</p></div>
                            <div class="col-4 text-start d-flex align-items-center">${row[i]['servicios'][k]['RESULTADO']} ${row[i]['servicios'][k]['MEDIDA_ABREVIATURA']}</div>
                            <hr style="margin: 3px"/>
                        `;
                    }

                    html += '</div> </div> </div>';
                }

                $('#accordionResultadosAnteriores').html(html);
            },
            complete: function () { resolve(1); }
        });
    });
}

function generarFormularioPaciente(id) {
    return new Promise(resolve => {
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: `${http}${servidor}/${appname}/api/turnos_api.php`,
            data: { id_turno: id,  api: 8,  id_area: areaActiva,  tipo: 1 },
            success: function (data) {
                $('#formulario-estudios').html('')
                data = data.response.data;

                let colStart = '<div class="col-12 col-lg-6">';
                let endDiv = '</div>';
                let colreStart = '<div class="col-12 col-lg-6 d-flex justify-content-end align-items-center">';
                let html = '';

                //Lee cada grupo
                for (let i = 0; i < data.length; i++) {
                    let row = data[i]
                    let kitDiag = null; //Biomolecular
                    let muestras = []; //Biomolecular
                    let tipo_resultado = []; //Biomolecular
                    let Tipo = ''; //Clinico

                    resultado = {0: { 'descripcion': 'NEGATIVO'}, 1: {'descripcion': 'POSITIVO'} }

                    switch (row['ID_GRUPO']) {
                        /**
                         * ++++++++++++++++++++++++++++++++++++++++
                         *             Biomolecular
                         * ++++++++++++++++++++++++++++++++++++++++
                         * */
                        case '685': case '684': case '1486':
                            classSelect = 'selectTipoMuestraPCR';
                            kitDiag = {
                                0: {'descripcion': 'CoviFlu Kit Multiplex', 'clave': 'DGE-DSAT-01498-2021'},
                                1: {'descripcion': 'DeCoV19 Kit Triplex', 'clave': 'DGE-DSAT-02874-2020'}
                            }
                            muestras = {
                                0: {'descripcion': 'NASOFARINGEO'},
                                1: {'descripcion': 'FARÍNGEA'},
                                2: {'descripcion': 'NASAL'},
                                3: {'descripcion': 'LAVADO BRONQUEOALVEOLAR'},
                                4: {'descripcion': 'HISOPADO NASOFARÍNGEO'},
                                5: {'descripcion': 'EXPECTORACIÓN'}
                            }
                            break;
                        case '697': // ANTIGENO
                            classSelect = 'selectTipoAntigeno';
                            muestras = { 0: {'descripcion': 'HISOPADO NASAL'} }
                            break;
                        case '698': // VPH
                            classSelect = 'selectTipoMuestraVPH';
                            kitDiag = {
                                0: {'descripcion': 'GeneProof para el virus del papiloma humano (VPH)', 'clave': '2002R2019 SSA'}
                            }
                            muestras = {
                                0: {'descripcion': 'CERVICAL'},
                                1: {'descripcion': 'ANAL'},
                                2: {'descripcion': 'URETRAL'},
                                3: {'descripcion': 'LBC'},
                                4: {'descripcion': 'HISOPADO NASOFARÍNGEO'},
                                5: {'descripcion': 'SURCO BALANO-PREPUSIAL.'},
                                6: {'descripcion': 'HISOPADO GLANDE Y PUBIS'},
                                7: {'descripcion': 'URETRAL,SURCO Y CUERPO DE PENE'},
                                8: {'descripcion': 'ESCROTO, GLANDE, CORONA, PREPUCIO'},
                                9: {'descripcion': 'PREPUSIO, GLANDE, CORONA, URETRA'},
                                10: {'descripcion': 'URETRAL Y GLANDE'}
                            }
                            break;
                        case '1682':  // toxoplasma_gondii_tr
                            muestras = {0: {'descripcion': 'Sangre'}}
                            break;
                        case '709': // PANEL21
                            classSelect = 'selectTipoMuestraPanel21';
                            kitDiag = {0: {'descripcion': 'FTD™ Respiratory Pathogens 21', 'clave': 'N/A'}}
                            muestras = {
                                0: {'descripcion': 'HISOPADO NASOFARÍNGEO'},
                                1: {'descripcion': 'FARÍNGEA'}
                            }
                            break;
                        case '1103': // BLUEFINDER 22
                            classSelect = 'selectTipoMuestraBF22';
                            kitDiag = { 0: {'descripcion': 'BlueFinder 22', 'clave': 'N/A'}}
                            muestras = {
                                0: {'descripcion': 'HISOPADO NASOFARÍNGEO'},
                                1: {'descripcion': 'FARÍNGEA'}
                            }
                            break;
                        case '743':
                            classSelect = 'selectTipoMuestraCitologia';
                            muestras = {
                                0: {'descripcion': 'CERVICAL'},
                                1: {'descripcion': 'ANAL'},
                                2: {'descripcion': 'URETRAL'},
                                3: {'descripcion': 'LBC'}
                            }
                            break;
                        case '980': // rT-PCR-ETS
                            classSelect = 'selectTipoMuestraETS';
                            kitDiag = {0: {'descripcion': 'FTD STD9 Multiplex', 'clave': ''}}
                            muestras = {
                                0: {'descripcion': 'CERVICAL'},
                                1: {'descripcion': 'ANAL'},
                                2: {'descripcion': 'URETRAL'},
                                3: {'descripcion': 'LBC'},
                                4: {'descripcion': 'HISOPADO NASOFARÍNGEO'},
                                5: {'descripcion': 'GLANDE, URETRA Y PREPUCIO'},
                                6: {'descripcion': 'CORONA,GLANDE, <br>URETRA Y PREPUCIO'},
                                7: {'descripcion': 'URETRAL Y GLANDE'},
                                8: {'descripcion': 'EXUDADO OROFARÍNGEO Y OCULAR'},
                            }
                            break;
                        case '972': case '973': break; //Sin cambios
                        case '1139': // rT-PCR para Mycobacterium tuberculosis MDR y XDR
                            classSelect = 'selectTipoMuestroMMDYXDR';
                            kitDiag = {0: {'descripcion': 'Anyplex™ II MTB/MDR/XDR', 'clave': 'N/A'}}
                            muestras = {
                                0: {'descripcion': 'Expectoración'},
                                1: {'descripcion': 'Cultivo'},
                                2: {'descripcion': 'Tejido Fresco'},
                                3: {'descripcion': 'Lavado Bronquial'},
                                4: {'descripcion': 'Orina'},
                                5: {'descripcion': 'Líquido pleural'},
                                6: {'descripcion': 'Biopsia'},
                                7: {'descripcion': 'Tejido Pleural'},
                                8: {'descripcion': 'Secreción'}
                            }
                            break;
                        case '1074':
                            classSelect = 'selectTipoMuestraFTD';
                            kitDiag = {0: {'descripcion': 'FTD Fiebre Tropical Multiplex', 'clave': ''}}
                            muestras = {
                                0: {'descripcion': 'SUERO'},
                                1: {'descripcion': 'PLASMA'},
                                2: {'descripcion': 'SANGRE TOTAL'},
                                3: {'descripcion': 'EXUDADO NASOFARÍNGEO'}
                            }
                            break;
                        case '1353': break
                        case '1390': break;
                        case '1609': break; // PANEL GASTROINTESTINAL
                        case "1420": // PCR HELICOBACTER PYLORI CON RESISTENCIA A CLARITROMICINA
                            classSelect = 'selectTipoMuestraPCRHeliPylori';
                            kitDiag = {0: {'descripcion': 'Allplex™ H.pylori & ClariR Assay', 'clave': 'N/A'}}
                            muestras = {0: {'descripcion': 'HECES'}, 1: {'descripcion': 'BIOPSIA'}}
                            break;
                        case '1452': // rT-PCR Entero-DR
                            classSelect = 'selectTipoMuestraEnteroDR';
                            muestras = {
                                0: {'descripcion': 'EXUDADO RECTAL'},
                                1: {'descripcion': 'CULTIVO',}
                            }
                            break
                        case '1462': // Ag. Virus Respiratorio
                            classSelect = 'selectTipoMuestraVirusRespiratorio';
                            muestras = {0: {'descripcion': 'Hisopado nasal'}}
                            break;
                        case '1463': // PCR Virus Respiratorio
                            classSelect = 'selectTipoMuestraPCRVirusRespiratorio';
                            tipo_resultado = {
                                0: {'descripcion': 'rT-PCR de VSR - CoviFlu'},
                                1: {'descripcion': 'rT-PCR de CoviFlu'}
                            }
                            muestras = {
                                0: {'descripcion': 'Hisopado nasal'},
                                1: {'descripcion': 'Hisopado Nasofaríngeo'},
                                2: {'descripcion': 'Hisopado orofaríngeo'},
                                3: {'descripcion': 'Expectoración'}
                            }
                          break;
                        case '':  break; // pneumoBacter
                        /**
                         * ++++++++++++++++++++++++++++++++++++++++
                         *         Laboratorio Clinico
                         * ++++++++++++++++++++++++++++++++++++++++
                         * */
                        case '1': Tipo = '_BH'; break;
                        case '1516': // rT-PCR Thrombosis SNP
                            classSelect = 'selectTipoMuestraThrombosisSNP';
                            resultado = {0: {'descripcion': 'Homocigoto'}, 1: {'descripcion': 'Heterocitogo'}};
                            muestras = {0: {'descripcion': 'Sangre Total con EDTA'}};
                            kitDiag = {0: {'descripcion': ' Anyplex™ Thrombosis SNP Panel Assays', 'clave': 'N/A'}};
                            break;
                        case '1599': // PCR Basal Carga Virual de hepatitis C (HCV)
                            classSelect = 'selectTipoMuestraCargaVirualHepatitisC';
                            muestras = {0: {'descripcion': 'Plasma EDTA'}}// ID muestra 695;
                            break;
                        case '1677': break; // PCR CARGA VIRAL DE CITOMEGALOVIRUS (CMV) - Solo visual por ahora
                        case '1738': // PCR Detección Mycobacterium tuberculosis
                            muestras = {
                                0: {'descripcion': 'Expectoración'},
                                1: {'descripcion': 'Lavado bronquial'},
                                2: {'descripcion': 'Orina'},
                                3: {'descripcion': 'Líquidos orgánicos sin hemolisis'},
                                4: {'descripcion': 'Sangre/EDTA'},
                                5: {'descripcion': 'Biopsia'},
                                6: {'descripcion': 'Bloques de parafina'},
                                7: {'descripcion': 'Líquido pleural'}
                            }
                            break;
                        case "1799": // PCR Infecciones de transmisión sexual (STI7)
                            muestras = {0: {'descripcion': 'Exudado Vaginal'}, 1: {'descripcion': 'Exudado Uretral'}}
                            break;
                        case '1838': // PCR PANEL VIRAL RESPIRATORIO (16 VIRUS)
                            muestras = {
                                0: {'descripcion': "Exudado Nasofaríngeo"},
                                1: {'descripcion': "Exudado Orofaríngeo"}
                            }
                            break;
                        default:
                            input = null;
                            if (areaActiva === 12) {
                              alert('El paciente no tiene estudios compatibles, hay un problema con la compatibilidad ' +
                                  'de los estudios con biomolecular, presente el error con el area de TI para ' +
                                  'solucionar este problema con el  paciente');
                            }
                            break;
                }

                html += '<ul class = "list-group hover-list info-detalle mt-3" style="padding: 3px;" >';

                if (row['ID_GRUPO']) {
                    html += `
                        <div class="css000001">
                            <div class="css000002">
                                <div class="row">
                                    <!--MARCAR ESTUDIO COMO PENDIENTE-->
                                    <div class="col-1 css000003">
                                        <input type="checkbox" class="btn-check btn-estudios-pendientes" 
                                        id="check${row['ID_GRUPO']}" autocomplete="off" data-bs-id="${row['ID_GRUPO']}" 
                                        data-bs-text="${row['NombreGrupo']}" data-bs-pending="${row['PENDIENTE']}">
                    `

                    if(parseInt(row['PENDIENTE']) === 1) {
                        // Dropdown con las opciones para marcar como completado y maquilar
                        html+=`
                            <div class="dropdown">
                                <span class="btn btn-outline-danger dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-three-dots"></i>
                                </span>
                                <ul class="dropdown-menu">
                                    <li>
                                        <label id="lbl${row['ID_GRUPO']}" for="check${row['ID_GRUPO']}" class="dropdown-item btn-posponer-estudios">
                                            <span>Completar</span>
                                            <i class="fa fa-check-circle"></i>
                                        </label>
                                    </li>
                                    <li>
                                        <div data-bs-id="${row['ID_GRUPO']}" class="dropdown-item btn-maquila-estudios" role="button" >
                                            Maquilar <i class="bi bi-file-earmark-break-fill"></i>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        `
                    } else {
                          // Dropdown con las opciones para marcar como pendiente y maquilar
                          html+=`
                              <div class="dropdown">
                                  <span class="btn btn-outline-danger dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                      <i class="bi bi-three-dots"></i>
                                  </span>
                                  <ul class="dropdown-menu">
                                      <li>
                                          <label id="lbl${row['ID_GRUPO']}" for="check${row['ID_GRUPO']}" class="dropdown-item btn-posponer-estudios">
                                              <span>Posponer</span>
                                              <i class="fa fa-clock-o"></i>
                                          </label>
                                      </li>
                                      <li>
                                          <div data-bs-id="${row['ID_GRUPO']}" class="dropdown-item btn-maquila-estudios" role="button">
                                                Maquilar <i class="bi bi-file-earmark-break-fill"></i>
                                          </div>
                                      </li>
                                  </ul>
                              </div>
                          `
                    }

                    html+=`
                             </div>
                                  <div class="col-9">
                                      <h4 class="css000004">${row['NombreGrupo']}</h4> 
                                      <p>${row['CLASIFICACION']}</p> 
                                  </div>
                                  <div class="col-1 css000005">
                                      <i data-bs-id="${row['ID_GRUPO']}" class="fas fa-microscope btn icon-hover btn-acciones css000006"></i>
                                  </div>
                             </div>
                        </div>
                        </div>
                    `;
                } else {
                    html += `
                        <div class="css000007">
                            <div class="css000008">
                                <div class="row">
                                    <div class="col-12">
                                        <h4 class="css000009">
                                           ${row['NombreGrupo']}
                                        </h4> 
                                        <p>${row['CLASIFICACION']}</p> 
                                    </div>
                                </div>
                            </div>
                        </div>`;
                }

                for (var k in row) { //Empieza cada estudio del grupo
                    let inputname = getRandomInt(1000000000000);
                    if (Number.isInteger(parseInt(k))) {

                    html += `
                        <li data-id_servicio="${row[k]['ID_SERVICIO']}" data-id_grupo="${row['ID_GRUPO']}" class="list-group-item linearEstudiosLabs" style="zoom: 95%">
                            <div class="row d-flex align-items-center">
                    `;

                    //Formulario
                    //Configuracion por ID_SERVICIO
                    let nameInput = `servicios[${inputname}][RESULTADO]`;
                    let onlyLabel = false;
                    let anotherValue = '';
                    let anotherInput = null;
                    let anotherClassInput = null;
                    let anotherAttr = '';

                    let anotherClassInputAbsoluto = '';
                    let typeInput = '';

                    switch (row[k]['ID_SERVICIO']) {
                        case '685': case '686': case '687': case '688': anotherValue = 'NEGATIVO'; break; //rT-PCR para Mycobacterium tuberculosis MDR y XDR
                        case '1145': case '1148': case '1149': case '1151': case '1153': case '1153': anotherValue = 'NO DETECTADO'; break;
                        case '690': case '699': case '702': case '726': case '727': case '728':
                        case '703': case '704': case '705': case '711': case '712': case '732':
                        case '713': case '714': case '716': case '717': case '718': case '731':
                        case '719': case '721': case '722': case '723': case '733': case '730':
                        case '725': case '744': //ETS
                        case '981': case '982': case '983': case '984': case '985': case '986': case '987': case '988': case '989': // los siguientes FTD
                        case '1075': case '1076': case '1077': case '1078': case '1079': case '1080':
                        case '1081': // BF22
                        case '1130': case '1131': case '1132': case '1126': case '1127': case '1128': case '1121':
                        case '1122': case '1123': case '1124': case '1116': case '1117': case '1118': case '1119':
                        case '1112': case '1113': case '1114': case '1107': case '1108': case '1109': case '1110': // Ag virus respiratorio
                        case '344': // PCR SARS-CoV-2/INFLUENZA A Y B
                        case '1470': case '1472': case '1474': case '1523': case '1526': case '1529': case '1531': // rT-PCR Thrombosis SNP
                        case '1519': case '1521': // STI7
                        case '1800': case '1801': anotherInput = crearSelectCamposMolecular(resultado, nameInput, row[k]['RESULTADO']); break; // Panel 21
                        case '710': case '715': case '720': case '724': case '729': // BlueFinder 22
                        case '1106': case '1111': case '1115': case '1120': case '1125': case '1129': //rT-PCR para Mycobacterium tuberculosis MDR y XDR
                        case '1146': case '1150': case '1147': case '1152': case '1164':// rT-PCR Panel Meningitis
                        case '1391': case '1399': case '1405': // PCR HELICOBACTER PYLORI CON RESISTENCIA A CLARITROMICINA
                        case '1436': case '1432': // rT-PCR Entero-DR
                        case '1421': case '1427': case '1430': // rT-PCR Thrombosis SNP
                        case '1517': case '1524': case '1527': onlyLabel = true; break;// PCR Virus Respiratorio - coviflu
                        case '1555': anotherInput = crearSelectCamposMolecular(tipo_resultado, nameInput, row[k]['RESULTADO']); break; //FTD KIT DIAGNOSTICO
                        case '1082': anotherValue = 'TF22-64-09R'; break;
                        case '694': anotherValue = 'KCFMP110123'; break; // <-- PCR -->
                        case '737': anotherValue = 'E160-22071101'; break; // <-- PANEL RESPIRATORIO POR PCR -->
                        case '1039':
                            switch (row['ID_GRUPO']) {
                              case '1462': anotherValue = ifnull(row[k]['No. kit.'], 'RV-135-K');
                              break;
                            }
                            break;
                        case '1040':
                            switch (row['ID_GRUPO']) {
                              case '1462': anotherValue = ifnull(row[k]['Descripción kit'], 'CerTest RSV ')
                              break;
                            }
                            break;
                        case '692': case '706': case '734': case '991': case '1083': // Bluefinder 22
                        case '1133': //rT-PCR para Mycobacterium tuberculosis MDR y XDR
                        case '1140': anotherInput = crearSelectCamposMolecular(kitDiag, nameInput, row[k]['RESULTADO'], ifnull(classSelect)); break;
                        case '693': case '707': case '735': case '992': anotherValue = ifnull(kitDiag[0]['clave']); anotherClassInput = 'ClaveAutorizacion'; anotherAttr = 'disabled'; break;
                        case '743': anotherValue = ifnull(row[k]['RESULTADO'], 'A QUIEN CORRESPONDA'); break; // No. Lote: Bluefinder 22
                        case '1136': anotherValue = 'KBFMP010324'; break;
                        case '695': case '700': case '708': case '736': case '756': case '994': case '1084': // BlueFinder 22:
                        case '1135'://rT-PCR para Mycobacterium tuberculosis MDR y XDR
                        case '1142':// Ag. Virus respiratorio
                        case '145': anotherInput = crearSelectCamposMolecular(muestras, nameInput, row[k]['RESULTADO']); break; //Laboratorio Clinico:
                        case '70': anotherClassInput = `LEUCOCITOS_VALUE${Tipo}`; break;
                        case '71': case '72': case '73': case '74': case '75': case '76': case '77': case '78': case '79':
                            anotherClassInput = `VALOR_ABSOLUTO${Tipo}`;
                            anotherClassInputAbsoluto = `RESULTADO_ABSOLUTO${Tipo}`;
                            break;
                          default: anotherValue = ''; break;
                      }

                    if (!onlyLabel) {
                        html += colStart;

                        if (row['ID_GRUPO']) {
                            html += `<p><i class="bi bi-box-arrow-in-right" style=""></i> ${row[k]['DESCRIPCION_SERVICIO']}</p>`;
                        } else {
                            html += `<p class="btn-acciones" data-bs-id="${row[k]['ID_SERVICIO']}"><i class="bi bi-box-arrow-in-right" style=""></i> ${row[k]['DESCRIPCION_SERVICIO']}</p>`;

                            // BOTON PARA MARCAR ESTUDIO COMO PENDIENTE
                            if(parseInt(row[k]['PENDIENTE']) === 1) {
                                html+=`
                                <div class="dropdown">
                                    <span class="btn btn-outline-danger dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="bi bi-three-dots"></i>
                                    </span>
                                    <ul class="dropdown-menu">
                                        <li>
                                              <label class="dropdown-item  btn-estudios-pendientes" 
                                                style="color: #d58512; display: flex; justify-content: space-between; align-items: center" 
                                                for="check${row[k]['ID_SERVICIO']}" data-bs-id="${row[k]['ID_SERVICIO']}" 
                                                data-bs-text="${row[k]['DESCRIPCION_SERVICIO']}" 
                                                data-bs-pending="${row[k]['PENDIENTE']}"
                                              >
                                                <input class="form-check-input" style="display: none;" type="checkbox" role="switch"
                                                    id="check${row[k]['ID_SERVICIO']}" checked
                                                >
                                                
                                                <span>Pendiente</span>
                                                <i class="fa fa-clock-o" style="color: #d58512"></i>
                                              </label>
                                        </li>
                                        <li>
                                            <span class="dropdown-item">Maquilar</span>
                                        </li>
                                    </ul>
                                </div>
                            `;
                        } else {
                            html+=`                               
                                <div class="dropdown">
                                  <span class="btn btn-outline-danger dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                      <i class="bi bi-three-dots"></i>
                                  </span>
                                  <ul class="dropdown-menu">
                                      <li>
                                          <div class="form-check form-switch dropdown-item">
                                                <input  
                                                    id="check${row[k]['ID_SERVICIO']}" type="checkbox" role="switch"
                                                    data-bs-id="${row[k]['ID_SERVICIO']}" 
                                                    data-bs-text="${row[k]['DESCRIPCION_SERVICIO']}" 
                                                    data-bs-pending="${row[k]['PENDIENTE']}"
                                                    class="form-check-input btn-estudios-pendientes invisible" 
                                                >
                                                <label class="form-check-label" for="check${row[k]['ID_SERVICIO']}">
                                                    Posponer <i class="fa fa-clock-o" style="color: #d58512"></i>
                                                </label>
                                            </div>
                                      </li>
                                      <li>
                                          <div 
                                              data-bs-id="${row[k]['ID_SERVICIO']}" 
                                              data-bs-text="${row[k]['DESCRIPCION_SERVICIO']}" 
                                              data-bs-pending="${row[k]['PENDIENTE']}" 
                                              class="dropdown-item btn-maquila-estudios" role="button"
                                          >
                                              Maquilar <i class="bi bi-file-earmark-break-fill"></i>
                                          </div>
                                      </li>
                                  </ul>
                              </div>
                            `;
                          }
                        }

                        html += endDiv;
                        html += colreStart;
                        html += '<div class="input-group">';
                        html += `
                            <div class="input-group-text input-span" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Vacía el resultado" >
                              <input class="form-check-input mt-0" value="1" name="servicios[${inputname}][BLANCO]" type="checkbox" aria-label="Checkbox for following text input">
                            </div>
                        `

                        // Si es posible, crea otro tipo de input, como select o más
                        if (anotherInput) {
                            html += anotherInput;
                            html += `<input type="text" style="display: none" name="servicios[${inputname}][ID_GRUPO]" value="${row['ID_GRUPO']}">`
                            html += `<input type="text" style="display: none" name="servicios[${inputname}][ID_SERVICIO]" value="${row[k]['ID_SERVICIO']}">`
                        } else {
                            html += `<input type="text" style="display: none" name="servicios[${inputname}][ID_GRUPO]" value="${row['ID_GRUPO']}">`
                            html += `<input type="text" style="display: none" name="servicios[${inputname}][ID_SERVICIO]" value="${row[k]['ID_SERVICIO']}">`
                            html += `<input class="form-control input-form text-end inputFormRequired ${anotherClassInput}" ${anotherAttr} name="servicios[${inputname}][RESULTADO]" value="` + ifnull(row[k]['RESULTADO'], anotherValue) + `" type="${ifnull(typeInput, 'text')}" autocomplete="off" >`;
                        }

                        // Muestra o no la medida
                        if (row[k]['MEDIDA']) {
                            if ((row[k]['TIENE_VALOR_ABSOLUTO'] == 1)) {
                                html += '<span class="input-span">%</span>';
                            } else {
                                html += '<span class="input-span">' + row[k]['MEDIDA'] + '</span>';
                            }
                        }

                        html += '</div>';
                        html += endDiv;

                        //Valor Absoluto
                        if (row[k]['TIENE_VALOR_ABSOLUTO'] == 1) {
                            html += colStart;
                          html += '<p  style="padding-left: 40px;"><i class="bi bi-box-arrow-in-right"></i> Valor absoluto</p>';
                          html += endDiv;
                          html += colreStart;
                          html += '<div class="input-group">';

                          html += `<input type="${ifnull(typeInput, 'text')}" class="form-control input-form text-end inputFormRequired ${anotherClassInputAbsoluto}" name="servicios[${inputname}][VALOR]" value="${ifnull(row[k]['VALOR_ABSOLUTO'])}" autocomplete="off">`;

                          if (row[k]['MEDIDA_ABS']) {
                              html += '<span class="input-span">' + row[k]['MEDIDA_ABS'] + '</span>';
                          }

                          html += '</div>';
                          html += endDiv;
                        }
                    } else {
                        html += `<div class="col-12 col-lg-12 text-center">`;
                        html += '<p style="font-size: 19px; font-wieght: bolder">' + row[k]['DESCRIPCION_SERVICIO'] + '</p>';
                        html += `<input type="text" style="display: none" name="servicios[${inputname}][ID_GRUPO]" value="${row['ID_GRUPO']}">`
                        html += `<input type="text" style="display: none" name="servicios[${inputname}][ID_SERVICIO]" value="${row[k]['ID_SERVICIO']}">`
                        html += `<input type="text" style="display: none" name="servicios[${inputname}][RESULTADO]" value="LABEL_BIOMOLECULAR">`
                        html += endDiv;
                    }


                    html += endDiv;
                    html += `<div class="linearEstudiosLabs_${row[k]['ID_SERVICIO']}_${row['ID_GRUPO']}"></div>`
                    html += '</li>';

                    if (row[k]['LLEVA_COMENTARIO'] == true) {
                        html += `<div class="d-flex justify-content-center"><div style="padding-top: 15px;"><p style = "/* font-size: 18px; */" > Observaciones:</p><textarea name="observacionesServicios[${row[k]['ID_SERVICIO']}]" rows="2;" cols="90" class="input-form" value="">${ifnull(row[k]['OBSERVACIONES'], '')}</textarea></div ></div > `;
                    }
                }
            }

                if (row['ID_GRUPO'] != null) {
                    if (row['OBSERVACIONES'] == null) {
                        row['OBSERVACIONES'] = '';
                    }
                    html += '<div class="d-flex justify-content-center"><div style="padding-top: 15px;">' +
                        '<p style = "/* font-size: 18px; */" > Observaciones:</p>' +
                        '<textarea name="observacionesGrupos[' + row['ID_GRUPO'] + ']" rows="2;" cols="90" class="input-form">' + ifnull(row['OBSERVACIONES']) + '</textarea></div ></div > ';
                }

                html += '</ul>';
            }

            $('#formulario-estudios').html(html)
        },
            complete: function () { resolve(1); },
            error: function () { console.warn('Error al recuperar el formulario de pacientes con turno: ' + idTurno) }
        });
    }).catch(e => console.warn(e));
}

function crearSelectCamposMolecular(data, nameInput, valueInput, classInput = '') {
    let selectHtml = `<select name="${nameInput}" class="input-form selectMolecular ${classInput} text-end" required="">`
    for (const key in data) {
        if (Object.hasOwnProperty.call(data, key)) {
            const element = data[key];
            let optionSelect = '';
            if (valueInput == element['descripcion']) optionSelect = 'selected';

            selectHtml += '<option value="' + element['descripcion'] + '" claveOption = "'
                + ifnull(element['clave']) + '" ' + optionSelect + '>' + element['descripcion'] + '</option>'
        }
    }
    selectHtml += '</select>';

    return selectHtml;
}

$(document).on('keyup', '.VALOR_ABSOLUTO_BH', function () {
    let input = $(this);
    let val = (input.val()).replace(/,/g, "");

    //Buscar el Leucocito
    let ul = $(input).closest('ul');
    let valorLeucocitos = (ul.find('li input.LEUCOCITOS_VALUE_BH').val()).replace(/,/g, "");

    // Convierte el valor a un entero
    let val_leuco = parseInt(valorLeucocitos, 10);
    let li = $(input).closest('li');
    let input_absolut = li.find('input.RESULTADO_ABSOLUTO_BH');

    // Verifica si el valor es un número entero o una cadena de texto
    if (!isNaN(val_leuco)) { // El valor es un número entero
        let value = val_leuco * val / 100
        input_absolut.val(value.toLocaleString('en-US'));
    } else { // El valor es una cadena de texto o no se puede convertir a entero
        alertMensaje('info', 'El valor del LEUCOCITOS no es numerico', 'No se ha podido calcular')
    }
})


$(document).on('click', '.selectMolecular', function () {
    value = $(this).find(':selected').attr('claveOption')
    if (value) {
        let parent_element = $(this).closest("ul");
        input = $(parent_element).find('input[class="form-control input-form text-end inputFormRequired ClaveAutorizacion"]');
        input.val(value)
    }
});

$(document).on('click', '.linearEstudiosLabs', function (event) {
    const target = $(event.target);

    if (target.is('input')) { // Verifica si el elemento clickeado es un checkbox.
        // Si es un checkbox, permite el comportamiento normal del checkbox y no ejecutes el resto del código.
        return;
    }

    event.stopPropagation();
    event.preventDefault();

    if (areaActiva == 12) {
      return false;
    }

    let id = $(this).attr('data-id_servicio');
    let grupo = $(this).attr('data-id_grupo');
    let $element = $(`.linearEstudiosLabs_${id}_${grupo}`);

    // Oculta todos los otros elementos de collapse
    $('#formAnalisisLaboratorio .valores-referencia').collapse('hide');

    if ($element.find('.valores-referencia').length === 0) {  // Verifica si el contenido ya ha sido cargado
        reloadValoresRef($element, id); // Si no existe, realiza la llamada AJAX y carga el contenido
    } else $element.find('.valores-referencia').collapse('show');
});

// Evento de clic para el botón de recarga
$(document).on('click', '.reload-button', function (event) {
    event.stopPropagation();

    if (areaActiva == 12) { // Desactiva la secuencia para biomolecular
        return false;
    }

    let id = $(this).closest('.linearEstudiosLabs').attr('data-id_servicio');
    let grupo = $(this).closest('.linearEstudiosLabs').attr('data-id_grupo');
    let $element = $(`.linearEstudiosLabs_${id}_${grupo}`);

    // Oculta todos los otros elementos de collapse
    $('#formAnalisisLaboratorio .valores-referencia').collapse('hide');
    reloadValoresRef($element, id); // Recarga el contenido del collapse actual
});

function reloadValoresRef($element, id) {
    // Desactiva la secuencia para biomolecular
    if (areaActiva == 12) {
        return false;
    }

    ajaxAwait({
        id_servicio: id,
        genero: selectListaLab.GENERO,
        fecha_nacimiento: selectListaLab.NACIMIENTO,
        api: 1
    }, 'valor_referencia_api', { callbackAfter: true }, false, (data) => {
        data = data.response.data;
        let html = `
            <div class="valores-referencia collapse">
                <div class="d-flex justify-content-between align-items-center px-3 pb-2">
                    <h6 class="fw-bold text-primary m-0">Valores de referencia</h6>
                    <button class="btn btn-outline-secondary btn-sm reload-button" type="button">
                        <i class="bi bi-arrow-clockwise"></i>
                    </button>
                </div>
                <p class="px-3 none-p">${data[0]['VALORES']}</p>
            </div>
        `;

        $element.html(html); // Inserta el contenido del collapse
        $element.find('.valores-referencia').collapse('show'); // Muestra el collapse
    });
}
