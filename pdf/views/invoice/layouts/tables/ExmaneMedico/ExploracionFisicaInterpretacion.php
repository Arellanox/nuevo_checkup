<table style="margin-top: 10px">
    <thead class="table_head_common_with_padding">
        <tr>
            <th colspan="2">
                <span>
                    Interpretación de resultados de laboratorio
                </span>
            </th>
        </tr>
    </thead>
    <tbody class="table_body_common">
        <tr>
            <td class="text-table-result"><span>Cuenta roja (BH): <?= $resultados[8]->CUENTA_ROJA ?></span></td><!-- RELLENAR -->
            <td class="text-table-result"><span>Audiometría: (sólo si amerita) <?= $resultados[8]->AUDIOMETRIA ?></span></td><!-- RELLENAR -->
        </tr>
        <tr>
            <td class="text-table-result"><span>General de orina: <?= $resultados[8]->GENERAL_ORINA ?></span></td><!-- RELLENAR -->
            <td class="text-table-result"><span>Otros: <?= $resultados[8]->OTROS ?></span></td><!-- RELLENAR -->
        </tr>
        <tr>
            <td class="text-table-result"><span>Química sanguinea 6 elementos: <?= $resultados[8]->QUIMICA_SANGUINEA ?></span></td><!-- RELLENAR -->
            <th class="th_head_common_in">Sólo personal designado a áreas críticas HACCP</th>
        </tr>
        <tr>
            <td class="text-table-result">
                <span>
                    Radiografía de tórax (AP y lateral de columna): <?= $resultados[8]->RADIOGRAFIA_TORAX ?>
                </span>
            </td><!-- RELLENAR -->
            <td class="text-table-result"><span>Reacciones febriles: <?= $resultados[8]->REACCIONES_FEBRILES ?></span></td><!-- RELLENAR -->
        </tr>
        <tr>
            <td class="text-table-result"><span>VIH: <?= $resultados[8]->VIH ?></span></td><!-- RELLENAR -->
            <td class="text-table-result"><span>VDRL: <?= $resultados[8]->VDRL ?></span></td><!-- RELLENAR -->
        </tr>
        <tr>
            <td class="text-table-result">
                <span>
                    Antidoping 5 parametros: Marihuana (THC), Cocaína (COC),
                    Anfetaminas (AMP) Metanfetaminas (mAMP) Opioides (OPI) y
                    Fenciclidina (PCP): <?= $resultados[8]->ANTIDOPING ?>
                </span>
            </td>
            <td class="text-table-result"><span>COPRO <?= $resultados[8]->COPRO ?></span></td><!-- RELLENAR -->
        </tr>
        <tr>
            <td class="text-table-result"><span>Tipo de sangre: <?= $resultados[8]->TIPO_SANGRE ?></span></td><!-- RELLENAR -->
            <td class="text-table-result"><span>Exudado faríngeo: <?= $resultados[8]->EXUDADO_FARINGEO ?></span></td><!-- RELLENAR -->
        </tr>
        <tr>
            <td class="text-table-result" colspan="2">
                <span>Diagnósitico y observaciones: <?= $resultados[12]->OBSERVACIONES ?></span>
            </td><!-- RELLENAR -->
        </tr>
    </tbody>
</table>

<table style="margin-top: 10px">
    <tbody class="table_body_common">
        <tr>
            <td class="text-table-result" style="padding-bottom: 10px">
                <span style="display: block; margin-bottom: 10px">Valoración de condición</span><!-- RELLENAR -->

                <span class="checked <?= $resultados[12]->VALORACION == "APTO" ? '' : 'empty' ?>">X</span> <!-- RELLENAR -->
                <span class="checked-label" style="margin-left: 2px; margin-right: 15px;">Cumple</span>
                <span class="checked <?= $resultados[12]->VALORACION == "NO APTO" ? '' : 'empty' ?>">X</span> <!-- RELLENAR -->
                <span class="checked-label" style="margin-left: 2px; margin-right: 15px;">No cumple</span>
                <span class="checked <?= $resultados[12]->VALORACION == "APTO CONDICIONADO" ? '' : 'empty' ?>">X</span> <!-- RELLENAR -->
                <span class="checked-label" style="margin-left: 2px; margin-right: 15px;">Cumple condicionado</span>
            </td>
            <td class="text-table-result" style="width: 100px">
                <span>Meses:  <?= $resultados[12]->VALORACION_MESES ?> meses.</span><!-- RELLENAR -->
            </td>
        </tr>
        <tr>
            <td class="text-table-result" colspan="2">
                <span>Observaciónes:                </span><!-- RELLENAR -->
            </td>
        </tr>
        <tr>
            <td class="text-table-result" colspan="2">
                <span>Recomendaciónes:               </span><!-- RELLENAR -->
            </td>
        </tr>
    </tbody>
</table>