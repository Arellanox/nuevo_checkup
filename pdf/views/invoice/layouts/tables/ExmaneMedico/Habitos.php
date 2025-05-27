<table>
    <thead class="table_head_common_with_padding">
        <tr>
            <th colspan="3" style="min-width: 120px"><span>Consume</span></th>
            <th colspan="3" style="min-width: 20px"><span>Sí</span></th>
            <th colspan="3" style="min-width: 20px"><span>No</span></th>
            <th colspan="3"><span>¿A qué edad inició el consumo?</span></th>
            <th colspan="3"><span>¿A qué edad dejó de consumir?</span></th>
            <th colspan="3"><span>Cantidad que consume por dia</span></th>
            <th colspan="3" style="min-width: 170px"><span>Observaciones</span></th>
        </tr>
    </thead>
    <tbody class="table_body_common">
        <tr>
            <td colspan="3" class="text-table-result"><span>Alcohol / Cerveza</span></td>
            <td colspan="3" class="text-table-result">
                <span class="center"><?= $resultados[1]->{19}->RESPUESTA == "Sí" ? 'X' : ''?></span><!-- RELLENAR -->
            </td>
            <td colspan="3" class="text-table-result">
                <span class="center"><?= $resultados[1]->{19}->RESPUESTA == "No" ? 'X' : ''?></span><!-- RELLENAR -->
            </td>
            <td colspan="3" class="text-table-result">
                <span><?= $resultados[1]->{19}->RESPUESTA == "Sí" ? $resultados[1]->{233}->NOTAS : ''?></span><!-- RELLENAR -->
            </td>
            <td colspan="3" class="text-table-result">
                <span><?= $resultados[1]->{19}->RESPUESTA == "Sí" ? $resultados[1]->{234}->NOTAS : ''?></span><!-- RELLENAR -->
            </td>
            <td colspan="3" class="text-table-result">
                <span><?= $resultados[1]->{19}->RESPUESTA == "Sí" ? $resultados[1]->{235}->NOTAS : ''?></span><!-- RELLENAR -->
            </td>
            <td colspan="3" class="text-table-result">
                <span>                 </span><!-- RELLENAR -->
            </td>
        </tr>
        <tr>
            <td colspan="3" class="text-table-result"><span>Tabaco</span></td>
            <td colspan="3" class="text-table-result">
                <span class="center"><?= $resultados[1]->{18}->RESPUESTA == "Sí" ? 'X' : ''?></span><!-- RELLENAR -->
            </td>
            <td colspan="3" class="text-table-result">
                <span class="center"><?= $resultados[1]->{18}->RESPUESTA == "No" ? 'X' : ''?></span><!-- RELLENAR -->
            </td>
            <td colspan="3" class="text-table-result">
                <span><?= $resultados[1]->{18}->RESPUESTA == "Sí" ? $resultados[1]->{230}->NOTAS : ''?></span><!-- RELLENAR -->
            </td>
            <td colspan="3" class="text-table-result">
                <span><?= $resultados[1]->{18}->RESPUESTA == "Sí" ? $resultados[1]->{231}->NOTAS : ''?></span><!-- RELLENAR -->
            </td>
            <td colspan="3" class="text-table-result">
                <span><?= $resultados[1]->{18}->RESPUESTA == "Sí" ? $resultados[1]->{232}->NOTAS : ''?></span><!-- RELLENAR -->
            </td>
            <td colspan="3" class="text-table-result">
                <span>                 </span><!-- RELLENAR -->
            </td>
        </tr>
        <tr>
            <td colspan="3" class="text-table-result"><span>Drogas</span></td>
            <td colspan="3" class="text-table-result">
                <span class="center"><?= $resultados[1]->{20}->RESPUESTA == "Sí" ? 'X' : ''?></span><!-- RELLENAR -->
            </td>
            <td colspan="3" class="text-table-result">
                <span class="center"><?= $resultados[1]->{20}->RESPUESTA == "No" ? 'X' : ''?></span><!-- RELLENAR -->
            </td>
            <td colspan="3" class="text-table-result">
                <span><?= $resultados[1]->{20}->RESPUESTA == "Sí" ? $resultados[1]->{236}->NOTAS : ''?></span><!-- RELLENAR -->
            </td>
            <td colspan="3" class="text-table-result">
                <span><?= $resultados[1]->{20}->RESPUESTA == "Sí" ? $resultados[1]->{237}->NOTAS : ''?></span><!-- RELLENAR -->
            </td>
            <td colspan="3" class="text-table-result">
                <span><?= $resultados[1]->{20}->RESPUESTA  == "Sí" ? $resultados[1]->{238}->NOTAS : ''?></span><!-- RELLENAR -->
            </td>
            <td colspan="3" class="text-table-result">
                <span>                 </span><!-- RELLENAR -->
            </td>
        </tr>
        <tr>
            <td colspan="3" class="text-table-result"><span>Drogas 2</span></td>
            <td colspan="3" class="text-table-result">
                <span>              </span><!-- RELLENAR -->
            </td>
            <td colspan="3" class="text-table-result">
                <span>              </span><!-- RELLENAR -->
            </td>
            <td colspan="3" class="text-table-result">
                <span>              </span><!-- RELLENAR -->
            </td>
            <td colspan="3" class="text-table-result">
                <span>              </span><!-- RELLENAR -->
            </td>
            <td colspan="3" class="text-table-result">
                <span>              </span><!-- RELLENAR -->
            </td>
            <td colspan="3" class="text-table-result">
                <span>                 </span><!-- RELLENAR -->
            </td>
        </tr>
        <tr>
            <td class="text-table-result" colspan="15">
                <span>¿Realiza con frecuencia Deporte / Ejercicio?</span>
                <span><?= $resultados[1]->{21}->RESPUESTA  == "Sí" ? 'Sí' : 'No'?></span><!-- RELLENAR -->
            </td>
            <td class="text-table-result" colspan="6">
                <span>¿Cuál?</span>
                <span><?= $resultados[1]->{21}->RESPUESTA  == "Sí" ? $resultados[1]->{21}->NOTAS : ''?></span><!-- RELLENAR -->
            </td>
        </tr>
    </tbody>
</table>
<br style="margin-bottom: 20px" />
<table>
    <tbody class="table_body_common">
        <tr>
            <td>
                <table>
                    <tbody class="table_body_common">
                        <tr>
                            <td class="text-table-result" colspan="2">
                                Marque los alimentos que consume más de 4 veces por semana:
                            </td>
                        </tr>
                        <tr>
                            <td class="text-table-result"><span>Alimentos</span></td>
                            <td class="text-table-result"><span>Veces que consume por semana</span></td>
                        </tr>
                        <tr>
                            <td class="text-table-result"><span>Frutas / Verduras</span></td>
                            <td class="text-table-result">
                                <span><?= isset($resultados[3]->{1}) ? 'X' : ''?></span><!-- RELLENAR -->
                            </td>
                        </tr>
                        <tr>
                            <td class="text-table-result"><span>Pan / galletas</span></td>
                            <td class="text-table-result">
                                <span><?= isset($resultados[3]->{2}) ? 'X' : ''?></span><!-- RELLENAR -->
                            </td>
                        </tr>
                        <tr>
                            <td class="text-table-result"><span>Pollo / pescado</span></td>
                            <td class="text-table-result">
                                <span><?= isset($resultados[3]->{3}) ? 'X' : ''?></span><!-- RELLENAR -->
                            </td>
                        </tr>
                        <tr>
                            <td class="text-table-result"><span>Carne</span></td>
                            <td class="text-table-result">
                                <span><?= isset($resultados[3]->{4}) ? 'X' : ''?></span><!-- RELLENAR -->
                            </td>
                        </tr>
                        <tr>
                            <td class="text-table-result"><span>Refrescos</span></td>
                            <td class="text-table-result">
                                <span><?= isset($resultados[3]->{5}) ? 'X' : ''?></span><!-- RELLENAR -->
                            </td>
                        </tr>
                        <tr>
                            <td class="text-table-result"><span>Tortillas</span></td>
                            <td class="text-table-result">
                                <span><?= isset($resultados[3]->{6}) ? 'X' : ''?></span><!-- RELLENAR -->
                            </td>
                        </tr>
                        <tr>
                            <td class="text-table-result"><span>Frituras</span></td>
                            <td class="text-table-result">
                                <span><?= isset($resultados[3]->{7}) ? 'X' : ''?></span><!-- RELLENAR -->
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
            <td>
                <table>
                    <tbody class="table_body_common">
                        <tr>
                            <td class="text-table-result" colspan="2">
                                <span>Características de su vivienda: </span><!-- RELLENAR -->
                            </td>
                        </tr>
                        <tr>
                            <td class="text-table-result" colspan="2">
                                <span>Número de Habitaciones: <?= $resultados[1]->{281}->NOTAS ?? '' ?></span><!-- RELLENAR -->
                            </td>
                        </tr>
                        <tr>
                            <td class="text-table-result" colspan="2">
                                <span>Material de techo: <?= $resultados[1]->{240}->NOTAS ?? '' ?></span><!-- RELLENAR -->
                            </td>
                        </tr>
                        <tr>
                            <td class="text-table-result" colspan="2">
                                <span>Habitantes por vivienda: </span><!-- RELLENAR -->
                            </td>
                        </tr>
                        <tr>
                            <td class="text-table-result" colspan="2">
                                <span>¿Cuenta con Servicios?: </span>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-table-result" colspan="2">
                                <span style="margin-right: 24px">Luz:</span>
                                <span class="checked <?= $resultados[1]->{243}->RESPUESTA == 'Sí'? '' : 'empty' ?>">X</span><!-- RELLENAR -->
                            </td>
                        </tr>
                        <tr>
                            <td class="text-table-result" colspan="2">
                                <span style="margin-right: 17px">Agua:</span>
                                <span class="checked <?= $resultados[1]->{244}->RESPUESTA == 'Sí'? '' : 'empty' ?>">X</span><!-- RELLENAR -->
                            </td>
                        </tr>
                        <tr>
                            <td class="text-table-result" colspan="2">
                                <span style="margin-right: 5px">Drenaje:</span>
                                <span class="checked <?= $resultados[1]->{245}->RESPUESTA == 'Sí'? '' : 'empty' ?>">X</span><!-- RELLENAR -->
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" style="color: transparent; border: 0">X</td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </tbody>
</table>
