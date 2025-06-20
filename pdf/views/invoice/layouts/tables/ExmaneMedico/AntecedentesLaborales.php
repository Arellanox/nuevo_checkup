<table>
    <thead class="table_head_common_with_padding">
        <tr>
            <th colspan="8">
                <span>Ha recibido alguno de los siguientes tratamientos médicos</span>
            </th>
        </tr>
        <tr>
            <th><span>Salud y seguridad en el trabajo</span></th>
            <th><span>Sí</span></th>
            <th><span>No</span></th>
            <th><span>¿Cuáles?</span></th>
            <th><span>Secuelas de los accidentes o enfermedades</span></th>
            <th><span>%IPP</span></th>
            <th><span>Nombre de la empresa</span></th>
            <th><span>Giro de la empresa</span></th>
        </tr>
    </thead>
    <tbody class="table_body_common">
        <tr>
            <td class="text-table-result"><span>Accidentes de trabajo</span></td>
            <td style="min-width: 30px; width: 30px; max-width: 30px" class="text-table-result">
                <span class="center"><?= $resultados[1]->{54}->RESPUESTA == "Sí" ? 'X' : '' ?></span><!-- RELLENAR -->
            </td>
            <td style="min-width: 30px; width: 30px; max-width: 30px" class="text-table-result">
                <span class="center"><?= $resultados[1]->{54}->RESPUESTA == "No" ? 'X' : '' ?></span><!-- RELLENAR -->
            </td>
            <td style="min-width: 150px; width: 150px; max-width: 150px;" class="text-table-result">
                <span><?= $resultados[1]->{220}->NOTAS ?></span><!-- RELLENAR -->
            </td>
            <td style="min-width: 150px; width: 150px; max-width: 150px;" class="text-table-result">
                <span><?= $resultados[1]->{221}->NOTAS ?></span><!-- RELLENAR -->
            </td>
            <td style="min-width: 50px; width: 50px; max-width: 50px;" class="text-table-result">
                <span><?= $resultados[1]->{222}->NOTAS ?></span><!-- RELLENAR -->
            </td>
            <td style="min-width: 80px; width: 80px; max-width: 80px;" class="text-table-result">
                <span>             </span><!-- RELLENAR -->
            </td>
            <td style="min-width: 60px; width: 60px; max-width: 60px;"  class="text-table-result">
                <span>             </span><!-- RELLENAR -->
            </td>
        </tr>
        <tr>
            <td class="text-table-result"><span>Enfermedades de trabajo</span></td>
            <td class="text-table-result">
                <span class="center"><?= $resultados[1]->{55}->RESPUESTA == "Sí" ? 'X' : '' ?></span><!-- RELLENAR -->
            </td>
            <td class="text-table-result">
                <span class="center"><?= $resultados[1]->{55}->RESPUESTA == "No" ? 'X' : '' ?></span><!-- RELLENAR -->
            </td>
            <td class="text-table-result">
                <span><?= $resultados[1]->{223}->NOTAS ?></span><!-- RELLENAR -->
            </td>
            <td class="text-table-result">
                <span><?= $resultados[1]->{224}->NOTAS ?></span><!-- RELLENAR -->
            </td>
            <td class="text-table-result">
                <span><?= $resultados[1]->{225}->NOTAS ?></span><!-- RELLENAR -->
            </td>
            <td class="text-table-result">
                <span>             </span><!-- RELLENAR -->
            </td>
            <td class="text-table-result">
                <span>             </span><!-- RELLENAR -->
            </td>
        </tr>
        <tr>
            <td class="text-table-result"><span>Accidentes de trayecto o viales</span></td>
            <td class="text-table-result">
                <span class="center"><?= $resultados[1]->{229}->RESPUESTA == "Sí" ? 'X' : '' ?></span><!-- RELLENAR -->
            </td>
            <td class="text-table-result">
                <span class="center"><?= $resultados[1]->{229}->RESPUESTA == "No" ? 'X' : '' ?></span><!-- RELLENAR -->
            </td>
            <td class="text-table-result">
                <span><?= $resultados[1]->{226}->NOTAS ?></span><!-- RELLENAR -->
            </td>
            <td class="text-table-result">
                <span><?= $resultados[1]->{227}->NOTAS ?></span><!-- RELLENAR -->
            </td>
            <td class="text-table-result">
                <span><?= $resultados[1]->{228}->NOTAS ?></span><!-- RELLENAR -->
            </td>
            <td class="text-table-result">
                <span>             </span><!-- RELLENAR -->
            </td>
            <td class="text-table-result">
                <span>             </span><!-- RELLENAR -->
            </td>
        </tr>
    </tbody>
</table>

<table cellpadding="0" style="margin-top: 10px">
    <thead>
        <tr>
            <th style="min-width: 45%; width: 45%; max-width: 45%; padding-right: 10px">
                <table>
                    <thead class="table_head_common_with_padding">
                        <tr>
                            <th>Puesto en sus empleos anteriores</th>
                            <th>Años</th>
                        </tr>
                    </thead>
                    <tbody class="table_body_common">
                        <tr>
                            <td class="text-table-result"><span class="text-white"> - </span></td><!-- RELLENAR -->
                            <td class="text-table-result"><span class="text-white"> - </span></td><!-- RELLENAR -->
                        </tr>
                        <tr>
                            <td class="text-table-result"><span class="text-white"> - </span></td><!-- RELLENAR -->
                            <td class="text-table-result"><span class="text-white"> - </span></td><!-- RELLENAR -->
                        </tr>
                        <tr>
                            <td class="text-table-result"><span class="text-white"> - </span></td><!-- RELLENAR -->
                            <td class="text-table-result"><span class="text-white"> - </span></td><!-- RELLENAR -->
                        </tr>
                        <tr>
                            <td class="text-table-result"><span class="text-white"> - </span></td><!-- RELLENAR -->
                            <td class="text-table-result"><span class="text-white"> - </span></td><!-- RELLENAR -->
                        </tr>
                        <tr>
                            <td class="text-table-result"><span class="text-white"> - </span></td><!-- RELLENAR -->
                            <td class="text-table-result"><span class="text-white"> - </span></td><!-- RELLENAR -->
                        </tr>
                        <tr>
                            <td class="text-table-result"><span class="text-white"> - </span></td><!-- RELLENAR -->
                            <td class="text-table-result"><span class="text-white"> - </span></td><!-- RELLENAR -->
                        </tr>
                        <tr>
                            <td class="text-table-result"><span class="text-white"> - </span></td><!-- RELLENAR -->
                            <td class="text-table-result"><span class="text-white"> - </span></td><!-- RELLENAR -->
                        </tr>
                        <tr>
                            <td class="text-table-result"><span class="text-white"> - </span></td><!-- RELLENAR -->
                            <td class="text-table-result"><span class="text-white"> - </span></td><!-- RELLENAR -->
                        </tr>
                    </tbody>
                </table>
            </th>
            <th style="min-width: 55%; width: 55%; max-width: 55%">
                <table>
                    <thead class="table_head_common_with_padding">
                        <tr>
                            <th>En sus trabajos anteriores ha estado expuesto a algunos de los siguientes casos:</th>
                            <th>Sí</th>
                            <th>No</th>
                        </tr>
                    </thead>
                    <tbody class="table_body_common">
                        <tr>
                            <td class="text-table-result"><span>Productos químicos (polvos, humos, neblina, vapores, aerosoles)</span></td>
                            <td style="width: 25px;">
                                <span class="center"><?= $resultados[1]->{61}->RESPUESTA == "Sí" ? 'X' : '' ?></span>
                            </td><!-- RELLENAR -->
                            <td style="width: 25px;">
                                <span class="center"><?= $resultados[1]->{61}->RESPUESTA == "No" ? 'X' : '' ?></span>
                            </td><!-- RELLENAR -->
                        </tr>
                        <tr>
                            <td class="text-table-result"><span>Temperaturas elevadas extremas o bajas extremas o vibraciones</span></td>
                            <td style="width: 25px;">
                                <span class="center">
                                    <?=
                                        ($resultados[1]->{203}->RESPUESTA == "Sí"
                                            || $resultados[1]->{204}->RESPUESTA == "Sí"
                                            || $resultados[1]->{205}->RESPUESTA == "Sí"
                                        ) ? 'X' : ''
                                    ?>
                                </span>
                            </td><!-- RELLENAR -->
                            <td style="width: 25px;">
                                <span class="center">
                                    <?=
                                        ($resultados[1]->{203}->RESPUESTA == "No"
                                            || $resultados[1]->{204}->RESPUESTA == "No"
                                            || $resultados[1]->{205}->RESPUESTA == "No") ? 'X' : ''
                                    ?>
                                </span>
                            </td><!-- RELLENAR -->
                        </tr>
                        <tr>
                            <td class="text-table-result"><span>Áreas con niveles elevados de ruido</span></td>
                            <td style="width: 25px;">
                                <span class="center"><?= $resultados[1]->{60}->RESPUESTA == "Sí" ? 'X' : '' ?></span>
                            </td><!-- RELLENAR -->
                            <td style="width: 25px;">
                                <span class="center"><?= $resultados[1]->{60}->RESPUESTA == "No" ? 'X' : '' ?></span>
                            </td><!-- RELLENAR -->
                        </tr>
                        <tr>
                            <td class="text-table-result"><span>Levantamiento de cargas pesadas y repetitivas</span></td>
                            <td style="width: 25px;">
                                <span class="center"><?= $resultados[1]->{206}->RESPUESTA == "Sí" ? 'X' : '' ?></span>
                            </td><!-- RELLENAR -->
                            <td style="width: 25px;">
                                <span class="center"><?= $resultados[1]->{206}->RESPUESTA == "No" ? 'X' : '' ?></span>
                            </td><!-- RELLENAR -->
                        </tr>
                        <tr>
                            <td class="text-table-result"><span>Trabajos manuales repetitivos</span></td>
                            <td style="width: 25px;">
                                <span class="center"><?= $resultados[1]->{207}->RESPUESTA == "Sí" ? 'X' : '' ?></span>
                            </td><!-- RELLENAR -->
                            <td style="width: 25px;">
                                <span class="center"><?= $resultados[1]->{207}->RESPUESTA == "No" ? 'X' : '' ?></span>
                            </td><!-- RELLENAR -->
                        </tr>
                        <tr>
                            <td class="text-table-result"><span>Agentes biológicos (bacterias, virus, hongos u otros)</span></td>
                            <td style="width: 25px;">
                                <span class="center"><?= $resultados[1]->{208}->RESPUESTA == "Sí" ? 'X' : '' ?></span>
                            </td><!-- RELLENAR -->
                            <td style="width: 25px;">
                                <span class="center"><?= $resultados[1]->{208}->RESPUESTA == "No" ? 'X' : '' ?></span>
                            </td><!-- RELLENAR -->
                        </tr>
                        <tr>
                            <td class="text-table-result"><span>Radiaciones (rayos X, láser, infrarrojos, UV u otros)</span></td>
                            <td style="width: 25px;">
                                <span class="center"><?= $resultados[1]->{66}->RESPUESTA == "Sí" ? 'X' : '' ?></span>
                            </td><!-- RELLENAR -->
                            <td style="width: 25px;">
                                <span class="center"><?= $resultados[1]->{66}->RESPUESTA == "No" ? 'X' : '' ?></span>
                            </td><!-- RELLENAR -->
                        </tr>
                        <tr>
                            <td class="text-table-result"><span>Trabajo bajo estrés, ambientes cerrados, rolar turnos, tiempo extra</span></td>
                            <td style="width: 25px;">
                                <span class="center"><?= $resultados[1]->{209}->RESPUESTA == "Sí" ? 'X' : '' ?></span>
                            </td><!-- RELLENAR -->
                            <td style="width: 25px;">
                                <span class="center"><?= $resultados[1]->{209}->RESPUESTA == "No" ? 'X' : '' ?></span>
                            </td><!
                        </tr>
                    </tbody>
                </table>
            </th>
        </tr>
    </thead>
</table>