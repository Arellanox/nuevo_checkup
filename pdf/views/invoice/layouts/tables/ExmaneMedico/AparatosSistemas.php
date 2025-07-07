<table>
    <tbody class="table_body_common">
        <tr>
            <td class="text-table-result" style="text-align: left">
                <span>Órgano de los sentidos:   </span><!-- RELLENAR -->
            </td>
            <td class="text-table-result" style="text-align: left">
                <span>Respiratorio:             </span><!-- RELLENAR -->
            </td>
        </tr>
        <tr>
            <td class="text-table-result" style="text-align: left">
                <span>Cardiovascular:           </span><!-- RELLENAR -->
            </td>
            <td class="text-table-result" style="text-align: left">
                <span>Digestivo:                </span><!-- RELLENAR -->
            </td>
        </tr>
        <tr>
            <td class="text-table-result" style="text-align: left">
                <span>Genitourinario:           </span><!-- RELLENAR -->
            </td>
            <td class="text-table-result" style="text-align: left">
                <span>Musculoesquelético:       </span><!-- RELLENAR -->
            </td>
        </tr>
    </tbody>
</table>

<h2 style="font-weight: bold; margin-top: 15px">Somatometría:</h2>

<p>
    Temperatura: <span class="text-soma-result"><?= $resultados[6]->{4}->VALOR . ' ' . $resultados[6]->{4}->UNIDAD_MEDIDA; ?></span>
    Altura: <span class="text-soma-result"><?= $resultados[6]->{1}->VALOR . ' ' . $resultados[6]->{1}->UNIDAD_MEDIDA; ?></span>
    Peso: <span class="text-soma-result"><?= $resultados[6]->{2}->VALOR . ' ' . $resultados[6]->{2}->UNIDAD_MEDIDA; ?></span>
    IMC: <span class="text-soma-result"><?= $resultados[6]->{3}->VALOR . ' ' . $resultados[6]->{3}->UNIDAD_MEDIDA; ?></span>
    Presión Arterial: <span class="text-soma-result"><?= $resultados[6]->{5}->VALOR . ' ' . $resultados[6]->{5}->UNIDAD_MEDIDA; ?></span>
    Frecuencia Cardíaca: <span class="text-soma-result"><?= $resultados[6]->{8}->VALOR . ' ' . $resultados[6]->{8}->UNIDAD_MEDIDA; ?></span>
    Presión sistólica:<span class="text-soma-result"><?= $resultados[6]->{6}->VALOR . ' ' . $resultados[6]->{6}->UNIDAD_MEDIDA; ?></span>
    Presión diastólica:<span class="text-soma-result"><?= $resultados[6]->{7}->VALOR . ' ' . $resultados[6]->{7}->UNIDAD_MEDIDA; ?></span><!-- RELLENAR -->
    Rango de presión arterial:<span class="text-soma-result">_________ </span><!-- RELLENAR -->
    Glucosa:<span class="text-soma-result">_________ </span><!-- RELLENAR -->
    Detalle glucosa:<span class="text-soma-result">_________ </span><!-- RELLENAR -->
    HbA1c:<span class="text-soma-result">_________ </span><!-- RELLENAR -->
    Perímetro de cintura:<span class="text-soma-result">_________ </span><!-- RELLENAR -->
    Perímetro de cadera:<span class="text-soma-result">_________ </span><!-- RELLENAR -->
    Indice CC:<span class="text-soma-result">_________ </span><!-- RELLENAR -->
    Oximetría:<span class="text-soma-result">_________ </span><!-- RELLENAR -->
    Frecuencia Respiratoria:<span class="text-soma-result">_________ </span><!-- RELLENAR -->
    Tipo de sangre:<span class="text-soma-result">_________ </span><!-- RELLENAR -->
    Colesterol:<span class="text-soma-result">_________ </span><!-- RELLENAR -->
    Trigliceridos:<span class="text-soma-result">_________ </span><!-- RELLENAR -->
</p>









