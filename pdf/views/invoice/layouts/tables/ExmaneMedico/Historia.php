<table >
    <thead class="table_head_common">
        <tr>
            <th rowspan="2" style="min-width: 90px">
                <span>Familiar</span>
            </th>
            <th rowspan="1" colspan="2" style="padding-top: 3px; padding-bottom: 3px; min-width: 40px" >
                <span>Vive</span>
            </th>
            <th rowspan="2" style="min-width: 70px">
                <span>Diabetes</span>
            </th>
            <th rowspan="2" style="min-width: 75px">
                <span>Hipertensión</span>
            </th>
            <th rowspan="2" style="min-width: 70px">
                <span>Enf. del corazón</span>
            </th>
            <th rowspan="2" style="min-width: 70px">
                <span>Enf. de los pulmones</span>
            </th>
            <th rowspan="2" style="min-width: 70px">
                <span>Cancer o leucemia</span>
            </th>
            <th rowspan="2" style="min-width: 70px">
                <span>Embolia</span>
            </th>
            <th rowspan="2" style="min-width: 70px">
                <span>Enf. mental</span>
            </th>
        </tr>
        <tr>
            <th style="padding-top: 3px; padding-bottom: 3px; min-width: 50px;">
                <span>Sí</span>
            </th>
            <th style="padding-top: 3px; padding-bottom: 3px; min-width: 50px;">
                <span>No</span>
            </th>
        </tr>
    </thead>
    <tbody class="table_body_common">
        <tr>
            <td class="text-table-result"><span>Padre</span></td>
            <td style="min-width: 50px; max-width: 50px;" class="text-table-result">
                <span class="center"><?= $resultados[1]->{25}->RESPUESTA == "No" ? 'X' : '' ?></span><!-- RELLENAR -->
            </td>
            <td style="min-width: 50px; max-width: 50px;" class="text-table-result">
                <span class="center"><?= $resultados[1]->{25}->RESPUESTA == "Sí" ? 'X' : '' ?></span><!-- RELLENAR -->
            </td>
            <td class="text-table-result">
                <span class="center"><?= $resultados[1]->{26}->RESPUESTA == "Sí" ? 'X' : '' ?></span><!-- RELLENAR -->
            </td>
            <td class="text-table-result">
                <span class="center"><?= $resultados[1]->{27}->RESPUESTA == "Sí" ? 'X' : '' ?></span><!-- RELLENAR -->
            </td>
            <td class="text-table-result">
                <span class="center"><?= $resultados[1]->{210}->RESPUESTA == "Sí" ? 'X' : '' ?></span><!-- RELLENAR -->
            </td>
            <td class="text-table-result">
                <span class="center"><?= $resultados[1]->{211}->RESPUESTA == "Sí" ? 'X' : '' ?></span><!-- RELLENAR -->
            </td>
            <td class="text-table-result">
                <span class="center"><?= $resultados[1]->{28}->RESPUESTA == "Sí" ? 'X' : '' ?></span><!-- RELLENAR -->
            </td>
            <td class="text-table-result">
                <span class="center"><?= $resultados[1]->{213}->RESPUESTA == "Sí" ? 'X' : '' ?></span><!-- RELLENAR -->
            </td>
            <td class="text-table-result">
                <span class="center"><?= $resultados[1]->{214}->RESPUESTA == "Sí" ? 'X' : '' ?></span><!-- RELLENAR -->
            </td>
        </tr>
        <tr>
            <td class="text-table-result"><span>Madre</span></td>
            <td class="text-table-result">
                <span class="center"><?= $resultados[1]->{30}->RESPUESTA == "No" ? 'X' : ''?></span><!-- RELLENAR -->
            </td>
            <td class="text-table-result">
                <span class="center"><?= $resultados[1]->{30}->RESPUESTA == "Sí" ? 'X' : ''?></span><!-- RELLENAR -->
            </td>
            <td class="text-table-result">
                <span class="center"><?= $resultados[1]->{31}->RESPUESTA == "Sí" ? 'X' : ''?></span><!-- RELLENAR -->
            </td>
            <td class="text-table-result">
                <span class="center"><?= $resultados[1]->{32}->RESPUESTA == "Sí" ? 'X' : ''?></span><!-- RELLENAR -->
            </td>
            <td class="text-table-result">
                <span class="center"><?= $resultados[1]->{215}->RESPUESTA == "Sí" ? 'X' : ''?></span><!-- RELLENAR -->
            </td>
            <td class="text-table-result">
                <span class="center"><?= $resultados[1]->{216}->RESPUESTA == "Sí" ? 'X' : ''?></span><!-- RELLENAR -->
            </td>
            <td class="text-table-result">
                <span class="center"><?= $resultados[1]->{33}->RESPUESTA == "Sí" ? 'X' : ''?></span><!-- RELLENAR -->
            </td>
            <td class="text-table-result">
                <span class="center"><?= $resultados[1]->{218}->RESPUESTA == "Sí" ? 'X' : ''?></span><!-- RELLENAR -->
            </td>
            <td class="text-table-result">
                <span class="center"><?= $resultados[1]->{219}->RESPUESTA == "Sí" ? 'X' : ''?></span><!-- RELLENAR -->
            </td>
        </tr>
        <tr>
            <td class="text-table-result"><span>Hermanos</span></td>
            <td class="text-table-result">
                <span class="center"><?= $resultados[2]->{1}->PREGUNTAS->{1}->RESPUESTA == 1 ? 'X' : ''?></span><!-- RELLENAR -->
            </td>
            <td class="text-table-result">
                <span class="center"><?= $resultados[2]->{1}->PREGUNTAS->{1}->RESPUESTA == 0 ? 'X' : ''?></span><!-- RELLENAR -->
            </td>
            <td class="text-table-result">
                <span class="center"><?= $resultados[2]->{1}->PREGUNTAS->{2}->RESPUESTA == 1 ? 'X' : ''?></span><!-- RELLENAR -->
            </td>
            <td class="text-table-result">
                <span class="center"><?= $resultados[2]->{1}->PREGUNTAS->{3}->RESPUESTA == 1 ? 'X' : ''?></span><!-- RELLENAR -->
            </td>
            <td class="text-table-result">
                <span class="center"><?= $resultados[2]->{1}->PREGUNTAS->{4}->RESPUESTA == 1 ? 'X' : ''?></span><!-- RELLENAR -->
            </td>
            <td class="text-table-result">
                <span class="center"><?= $resultados[2]->{1}->PREGUNTAS->{5}->RESPUESTA == 1 ? 'X' : ''?></span><!-- RELLENAR -->
            </td>
            <td class="text-table-result">
                <span class="center"<?= $resultados[2]->{1}->PREGUNTAS->{6}->RESPUESTA == 1 ? 'X' : ''?> </span><!-- RELLENAR -->
            </td>
            <td class="text-table-result">
                <span class="center"><?= $resultados[2]->{1}->PREGUNTAS->{7}->RESPUESTA == 1 ? 'X' : ''?></span><!-- RELLENAR -->
            </td>
            <td class="text-table-result">
                <span class="center"><?= $resultados[2]->{1}->PREGUNTAS->{8}->RESPUESTA == 1 ? 'X' : ''?></span><!-- RELLENAR -->
            </td>
        </tr>
        <tr>
            <td class="text-table-result"><span>Abuelo paterno</span></td>
            <td class="text-table-result">
                <span class="center"><?= $resultados[2]->{2}->PREGUNTAS->{1}->RESPUESTA == 1 ? 'X' : ''?></span><!-- RELLENAR -->
            </td>
            <td class="text-table-result">
                <span class="center"><?= $resultados[2]->{2}->PREGUNTAS->{1}->RESPUESTA == 0 ? 'X' : ''?></span><!-- RELLENAR -->
            </td>
            <td class="text-table-result">
                <span class="center"><?= $resultados[2]->{2}->PREGUNTAS->{2}->RESPUESTA == 1 ? 'X' : ''?></span><!-- RELLENAR -->
            </td>
            <td class="text-table-result">
                <span class="center"><?= $resultados[2]->{2}->PREGUNTAS->{3}->RESPUESTA == 1 ? 'X' : ''?></span><!-- RELLENAR -->
            </td>
            <td class="text-table-result">
                <span class="center"><?= $resultados[2]->{2}->PREGUNTAS->{4}->RESPUESTA == 1 ? 'X' : ''?></span><!-- RELLENAR -->
            </td>
            <td class="text-table-result">
                <span class="center"><?= $resultados[2]->{2}->PREGUNTAS->{5}->RESPUESTA == 1 ? 'X' : ''?></span><!-- RELLENAR -->
            </td>
            <td class="text-table-result">
                <span class="center"><?= $resultados[2]->{2}->PREGUNTAS->{6}->RESPUESTA == 1 ? 'X' : ''?></span><!-- RELLENAR -->
            </td>
            <td class="text-table-result">
                <span class="center"><?= $resultados[2]->{2}->PREGUNTAS->{7}->RESPUESTA == 1 ? 'X' : ''?></span><!-- RELLENAR -->
            </td>
            <td class="text-table-result">
                <span class="center"><?= $resultados[2]->{2}->PREGUNTAS->{8}->RESPUESTA == 1 ? 'X' : ''?></span><!-- RELLENAR -->
            </td>
        </tr>
        <tr>
            <td class="text-table-result"><span>Abuela paterna</span></td>
            <td class="text-table-result">
                <span class="center"><?= $resultados[2]->{3}->PREGUNTAS->{1}->RESPUESTA == 1 ? 'X' : ''?></span><!-- RELLENAR -->
            </td>
            <td class="text-table-result">
                <span class="center"><?= $resultados[2]->{3}->PREGUNTAS->{1}->RESPUESTA == 0 ? 'X' : ''?></span><!-- RELLENAR -->
            </td>
            <td class="text-table-result">
                <span class="center"><?= $resultados[2]->{3}->PREGUNTAS->{2}->RESPUESTA == 1 ? 'X' : ''?></span><!-- RELLENAR -->
            </td>
            <td class="text-table-result">
                <span class="center"><?= $resultados[2]->{3}->PREGUNTAS->{3}->RESPUESTA == 1 ? 'X' : ''?></span><!-- RELLENAR -->
            </td>
            <td class="text-table-result">
                <span class="center"><?= $resultados[2]->{3}->PREGUNTAS->{4}->RESPUESTA == 1 ? 'X' : ''?></span><!-- RELLENAR -->
            </td>
            <td class="text-table-result">
                <span class="center"><?= $resultados[2]->{3}->PREGUNTAS->{5}->RESPUESTA == 1 ? 'X' : ''?></span><!-- RELLENAR -->
            </td>
            <td class="text-table-result">
                <span class="center"><?= $resultados[2]->{3}->PREGUNTAS->{6}->RESPUESTA == 1 ? 'X' : ''?></span><!-- RELLENAR -->
            </td>
            <td class="text-table-result">
                <span class="center"><?= $resultados[2]->{3}->PREGUNTAS->{7}->RESPUESTA == 1 ? 'X' : ''?></span><!-- RELLENAR -->
            </td>
            <td class="text-table-result">
                <span class="center"><?= $resultados[2]->{3}->PREGUNTAS->{8}->RESPUESTA == 1 ? 'X' : ''?></span><!-- RELLENAR -->
            </td>
        </tr>
        <tr>
            <td class="text-table-result"><span>Abuelo materno</span></td>
            <td class="text-table-result">
                <span class="center"><?= $resultados[2]->{4}->PREGUNTAS->{1}->RESPUESTA == 1 ? 'X' : ''?></span><!-- RELLENAR -->
            </td>
            <td class="text-table-result">
                <span class="center"><?= $resultados[2]->{4}->PREGUNTAS->{1}->RESPUESTA == 0 ? 'X' : ''?></span><!-- RELLENAR -->
            </td>
            <td class="text-table-result">
                <span class="center"><?= $resultados[2]->{4}->PREGUNTAS->{2}->RESPUESTA == 1 ? 'X' : ''?></span><!-- RELLENAR -->
            </td>
            <td class="text-table-result">
                <span class="center"><?= $resultados[2]->{4}->PREGUNTAS->{3}->RESPUESTA == 1 ? 'X' : ''?></span><!-- RELLENAR -->
            </td>
            <td class="text-table-result">
                <span class="center"><?= $resultados[2]->{4}->PREGUNTAS->{4}->RESPUESTA == 1 ? 'X' : ''?></span><!-- RELLENAR -->
            </td>
            <td class="text-table-result">
                <span class="center"><?= $resultados[2]->{4}->PREGUNTAS->{5}->RESPUESTA == 1 ? 'X' : ''?></span><!-- RELLENAR -->
            </td>
            <td class="text-table-result">
                <span class="center"><?= $resultados[2]->{4}->PREGUNTAS->{6}->RESPUESTA == 1 ? 'X' : ''?></span><!-- RELLENAR -->
            </td>
            <td class="text-table-result">
                <span class="center"><?= $resultados[2]->{4}->PREGUNTAS->{7}->RESPUESTA == 1 ? 'X' : ''?></span><!-- RELLENAR -->
            </td>
            <td class="text-table-result">
                <span class="center"><?= $resultados[2]->{4}->PREGUNTAS->{8}->RESPUESTA == 1 ? 'X' : ''?></span><!-- RELLENAR -->
            </td>
        </tr>
        <tr>
            <td class="text-table-result"><span>Abuela materna</span></td>
            <td class="text-table-result">
                <span class="center"><?= $resultados[2]->{5}->PREGUNTAS->{1}->RESPUESTA == 1 ? 'X' : ''?></span><!-- RELLENAR -->
            </td>
            <td class="text-table-result">
                <span class="center"><?= $resultados[2]->{5}->PREGUNTAS->{1}->RESPUESTA == 0 ? 'X' : ''?></span><!-- RELLENAR -->
            </td>
            <td class="text-table-result">
                <span class="center"><?= $resultados[2]->{5}->PREGUNTAS->{2}->RESPUESTA == 1 ? 'X' : ''?></span><!-- RELLENAR -->
            </td>
            <td class="text-table-result">
                <span class="center"><?= $resultados[2]->{5}->PREGUNTAS->{3}->RESPUESTA == 1 ? 'X' : ''?></span><!-- RELLENAR -->
            </td>
            <td class="text-table-result">
                <span class="center"><?= $resultados[2]->{5}->PREGUNTAS->{4}->RESPUESTA == 1 ? 'X' : ''?></span><!-- RELLENAR -->
            </td>
            <td class="text-table-result">
                <span class="center"><?= $resultados[2]->{5}->PREGUNTAS->{5}->RESPUESTA == 1 ? 'X' : ''?></span><!-- RELLENAR -->
            </td>
            <td class="text-table-result">
                <span class="center"><?= $resultados[2]->{5}->PREGUNTAS->{6}->RESPUESTA == 1 ? 'X' : ''?></span><!-- RELLENAR -->
            </td>
            <td class="text-table-result">
                <span class="center"><?= $resultados[2]->{5}->PREGUNTAS->{7}->RESPUESTA == 1 ? 'X' : ''?></span><!-- RELLENAR -->
            </td>
            <td class="text-table-result">
                <span class="center"><?= $resultados[2]->{5}->PREGUNTAS->{8}->RESPUESTA == 1 ? 'X' : ''?></span><!-- RELLENAR -->
            </td>
        </tr>
        <tr>
            <td class="text-table-result"><span>Hijos</span></td>
            <td class="text-table-result">
                <span class="center"><?= $resultados[2]->{6}->PREGUNTAS->{1}->RESPUESTA == 1 ? 'X' : ''?></span><!-- RELLENAR -->
            </td>
            <td class="text-table-result">
                <span class="center"><?= $resultados[2]->{6}->PREGUNTAS->{1}->RESPUESTA == 0 ? 'X' : ''?></span><!-- RELLENAR -->
            </td>
            <td class="text-table-result">
                <span class="center"><?= $resultados[2]->{6}->PREGUNTAS->{2}->RESPUESTA == 1 ? 'X' : ''?></span><!-- RELLENAR -->
            </td>
            <td class="text-table-result">
                <span class="center"><?= $resultados[2]->{6}->PREGUNTAS->{3}->RESPUESTA == 1 ? 'X' : ''?></span><!-- RELLENAR -->
            </td>
            <td class="text-table-result">
                <span class="center"><?= $resultados[2]->{6}->PREGUNTAS->{4}->RESPUESTA == 1 ? 'X' : ''?></span><!-- RELLENAR -->
            </td>
            <td class="text-table-result">
                <span class="center"><?= $resultados[2]->{6}->PREGUNTAS->{5}->RESPUESTA == 1 ? 'X' : ''?></span><!-- RELLENAR -->
            </td>
            <td class="text-table-result">
                <span class="center"><?= $resultados[2]->{6}->PREGUNTAS->{6}->RESPUESTA == 1 ? 'X' : ''?></span><!-- RELLENAR -->
            </td>
            <td class="text-table-result">
                <span class="center"><?= $resultados[2]->{6}->PREGUNTAS->{7}->RESPUESTA == 1 ? 'X' : ''?></span><!-- RELLENAR -->
            </td>
            <td class="text-table-result">
                <span class="center"><?= $resultados[2]->{6}->PREGUNTAS->{8}->RESPUESTA == 1 ? 'X' : ''?></span><!-- RELLENAR -->
            </td>
        </tr>
        <tr>
            <td class="text-table-result"><span>Observaciónes</span></td>
            <td class="text-table-result" colspan="9">
                <span>Sin información</span><!-- RELLENAR -->
            </td>
        </tr>
    </tbody>
</table>