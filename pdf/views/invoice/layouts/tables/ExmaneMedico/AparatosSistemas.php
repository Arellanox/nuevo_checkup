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
    Temperatura: <span class="text-table-result"><?= $resultados[6]->{4}->VALOR . ' ' . $resultados[6]->{4}->UNIDAD_MEDIDA; ?> </span><!-- RELLENAR -->
    Altura: <span class="text-table-result"><?= $resultados[6]->{1}->VALOR . ' ' . $resultados[6]->{1}->UNIDAD_MEDIDA; ?> </span><!-- RELLENAR -->
    Peso: <span class="text-table-result"><?= $resultados[6]->{2}->VALOR . ' ' . $resultados[6]->{2}->UNIDAD_MEDIDA; ?> </span><!-- RELLENAR -->
    IMC: <span class="text-table-result"><?= $resultados[6]->{3}->VALOR; ?></span><!-- RELLENAR -->
    Presión Arterial: <span class="text-table-result"><?= $resultados[6]->{0}->VALOR . ' ' . $resultados[6]->{0}->UNIDAD_MEDIDA; ?> </span><!-- RELLENAR -->
    Frecuencia Cardíaca: <span class="text-table-result"><?= $resultados[6]->{5}->VALOR . ' ' . $resultados[6]->{5}->UNIDAD_MEDIDA; ?> </span><!-- RELLENAR -->
    Presión sistólica:<span class="text-table-result">_________ </span><!-- RELLENAR -->
    <br>
    Presión diastólica:<span class="text-table-result">_________ </span><!-- RELLENAR -->
    Rango de presión arterial:<span class="text-table-result">_________ </span><!-- RELLENAR -->
    Glucosa:<span class="text-table-result">_________ </span><!-- RELLENAR -->
    Detalle glucosa:<span class="text-table-result">_________ </span><!-- RELLENAR -->
    HbA1c:<span class="text-table-result">_________ </span><!-- RELLENAR -->
    <br>
    Perímetro de cintura:<span class="text-table-result">_________ </span><!-- RELLENAR -->
    Perímetro de cadera:<span class="text-table-result">_________ </span><!-- RELLENAR -->
    Indice CC:<span class="text-table-result">_________ </span><!-- RELLENAR -->
    Oximetría:<span class="text-table-result">
        <?= $resultados[6]->{6}->VALOR . ' ' . $resultados[6]->{6}->UNIDAD_MEDIDA; ?>
    </span><!-- RELLENAR -->
    Frecuencia Respiratoria:<span class="text-table-result">_________ </span><!-- RELLENAR -->
    <br>
    Tipo de sangre:<span class="text-table-result">_________ </span><!-- RELLENAR -->
    Colesterol:<span class="text-table-result">_________ </span><!-- RELLENAR -->
    Trigliceridos:<span class="text-table-result">_________ </span><!-- RELLENAR -->
</p>














