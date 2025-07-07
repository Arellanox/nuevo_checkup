<table>
    <thead class="table_head_common_with_padding">
        <tr>
            <th colspan="8">
                <span>
                    Marque la casilla de la condición observada durante la exploración física: Normal "N" vs. Anormal "A" o "Sí" vs. "No".
                </span>
            </th>
        </tr>
    </thead>
    <tbody class="table_body_common">
        <tr class="table_head_common_in"> <!-- CABECERA -->
            <th>Cabeza</th>
            <th>Normal</th>
            <th>Anormal</th>
            <th>Especifique</th>
            <th>Nariz</th>
            <th>Normal</th>
            <th>Anormal</th>
            <th>Especifique</th>
        </tr>

        <tr>
            <td class="text-table-result" rowspan="3" style="width: 80px; max-width: 80px; min-width: 80px">
                <span>Cráneo</span>
            </td>
            <td class="text-table-result" rowspan="3" style="width: 20px; max-width: 20px; min-width: 20px">
                <span class="center"><?= $resultados[7]->{11}->RESPUESTA == "Normal" ? "X" : "" ?></span>
            </td>
            <td class="text-table-result" rowspan="3" style="width: 20px; max-width: 20px; min-width: 20px">
                <span class="center"><?= $resultados[7]->{11}->RESPUESTA == "Anormal" ? "X" : "" ?></span>
            </td>
            <td class="text-table-result" rowspan="3" style="width: 100px; max-width: 100px; min-width: 100px">
                <span class="center"><?= $resultados[7]->{11}->OBSERVACIONES ?></span>
            </td>

            <td class="text-table-result" style="width: 80px; max-width: 80px; min-width: 80px">
                <span>Mucosa</span>
            </td>
            <td class="text-table-result" style="width: 20px; max-width: 20px; min-width: 20px">
                <span class="center"><?= $resultados[7]->{412}->RESPUESTA == "Normal" ? "X" : "" ?></span>
            </td>
            <td class="text-table-result" style="width: 20px; max-width: 20px; min-width: 20px">
                <span class="center"><?= $resultados[7]->{412}->RESPUESTA == "Anormal" ? "X" : "" ?></span>
            </td>
            <td class="text-table-result" style="width: 100px; max-width: 100px; min-width: 100px">
                <span class="center"><?= $resultados[7]->{412}->OBSERVACIONES ?></span>
            </td>
        </tr>

        <tr>
            <td class="text-table-result"><span>Septum</span></td>
            <td class="text-table-result"><span class="center"><?= $resultados[7]->{415}->RESPUESTA == "Normal" ? "X" : "" ?></span></td>
            <td class="text-table-result"><span class="center"><?= $resultados[7]->{415}->RESPUESTA == "Anormal" ? "X" : "" ?></span></td>
            <td class="text-table-result"><span class="center"><?= $resultados[7]->{415}->OBSERVACIONES ?></span></td>
        </tr>

        <tr>
            <td class="text-table-result"><span>Pólipos</span></td>
            <td class="text-table-result"><span class="center"><?= $resultados[7]->{414}->RESPUESTA == "Sí" ? "X" : "" ?></span></td>
            <td class="text-table-result"><span class="center"><?= $resultados[7]->{414}->RESPUESTA == "No" ? "X" : "" ?></span></td>
            <td class="text-table-result"><span class="center"><?= $resultados[7]->{414}->OBSERVACIONES ?></span></td>
        </tr>

        <tr class="table_head_common_in"> <!-- CABECERA -->
            <th>Cuello</th>
            <th>Normal</th>
            <th>Anormal</th>
            <th>Especifique</th>
            <th>Oídos</th>
            <th>Normal</th>
            <th>Anormal</th>
            <th>Especifique</th>
        </tr>

        <tr class="break">
            <td class="text-table-result"><span>Cilindrico</span></td>
            <td class="text-table-result"><span class="center"><?= $resultados[7]->{23}->RESPUESTA == "Normal" ? "X" : "" ?></span></td>
            <td class="text-table-result"><span class="center"><?= $resultados[7]->{23}->RESPUESTA == "Anormal" ? "X" : "" ?></span></td>
            <td class="text-table-result"><span class="center"><?= $resultados[7]->{23}->OBSERVACIONES ?></span></td>

            <td class="text-table-result"><span>Membrana timpánica</span></td>
            <td class="text-table-result">
                <span class="center">
                    <?= ($resultados[7]->{516}->RESPUESTA == "Normal" && $resultados[7]->{616}->RESPUESTA == "Normal")
                        ? 'X' : (($resultados[7]->{516}->RESPUESTA == "Normal") ? 'Derecho' : (($resultados[7]->{616}->RESPUESTA == "Normal") ? 'Izquierdo' : ''));
                    ?>
                </span>
            </td>
            <td class="text-table-result">
                <span class="center">
                    <?= ($resultados[7]->{516}->RESPUESTA == "Anormal" && $resultados[7]->{616}->RESPUESTA == "Anormal")
                        ? 'X' : (($resultados[7]->{516}->RESPUESTA == "Anormal") ? 'Derecho' : (($resultados[7]->{616}->RESPUESTA == "Anormal") ? 'Izquierdo' : ''));
                    ?>
                </span>
            </td>
            <td class="text-table-result"><span class="center"><?= $resultados[7]->{25}->OBSERVACIONES ?></span></td>
        </tr>

        <tr>
            <td class="text-table-result"><span>Movilidad</span></td>
            <td class="text-table-result"><span class="center"><?= $resultados[7]->{25}->RESPUESTA == "Normal" ? "X" : "" ?></span></td>
            <td class="text-table-result"><span class="center"><?= $resultados[7]->{25}->RESPUESTA == "Anormal" ? "X" : "" ?></span></td>
            <td class="text-table-result"><span class="center"><?= $resultados[7]->{25}->OBSERVACIONES ?></span></td>

            <td class="text-table-result"><span>Conducto aud. ext.</span></td>
            <td class="text-table-result">
                <span class="center">
                    <?= ($resultados[7]->{517}->RESPUESTA == "Normal" && $resultados[7]->{617}->RESPUESTA == "Normal")
                        ? 'X' : (($resultados[7]->{517}->RESPUESTA == "Normal") ? 'Derecho' : (($resultados[7]->{617}->RESPUESTA == "Normal") ? 'Izquierdo' : ''));
                    ?>
                </span>
            </td>
            <td class="text-table-result">
                <span class="center">
                    <?= ($resultados[7]->{517}->RESPUESTA == "Anormal" && $resultados[7]->{617}->RESPUESTA == "Anormal")
                        ? 'X' : (($resultados[7]->{517}->RESPUESTA == "Anormal") ? 'Derecho' : (($resultados[7]->{617}->RESPUESTA == "Anormal") ? 'Izquierdo' : ''));
                    ?>
                </span>
            </td>
            <td class="text-table-result"><span class="center"><?= $resultados[7]->{617}->OBSERVACIONES ?></span></td>
        </tr>

        <tr class=""> <!-- SALTO DE PÁGINA -->
            <td class="text-table-result"><span>Ganglios / Tiroides</span></td>
            <td class="text-table-result"><span class="center"><?= $resultados[7]->{225}->RESPUESTA == "Sí" ? "X" : "" ?></span></td>
            <td class="text-table-result"><span class="center"><?= $resultados[7]->{225}->RESPUESTA == "No" ? "X" : "" ?></span></td>
            <td class="text-table-result"><span class="center"><?= $resultados[7]->{225}->OBSERVACIONES ?></span></td>

            <td class="text-table-result"><span>Pabellón auricular</span></td>
            <td class="text-table-result">
                <span class="center">
                    <?= ($resultados[7]->{518}->RESPUESTA == "Normal" && $resultados[7]->{618}->RESPUESTA == "Normal")
                        ? 'X' : (($resultados[7]->{518}->RESPUESTA == "Normal") ? 'Derecho' : (($resultados[7]->{618}->RESPUESTA == "Normal") ? 'Izquierdo' : ''));
                    ?>
                </span>
            </td>
            <td class="text-table-result">
                <span class="center">
                    <?= ($resultados[7]->{518}->RESPUESTA == "Anormal" && $resultados[7]->{618}->RESPUESTA == "Anormal")
                        ? 'X' : (($resultados[7]->{518}->RESPUESTA == "Anormal") ? 'Derecho' : (($resultados[7]->{618}->RESPUESTA == "Anormal") ? 'Izquierdo' : ''));
                    ?>
                </span>
            </td>
            <td class="text-table-result">
                <span class="center"><?= $resultados[7]->{618}->OBSERVACIONES ?></span>
            </td>
        </tr>

        <tr class="table_head_common_in"> <!-- CABECERA -->
            <th>Ojos</th>
            <th>Normal</th>
            <th>Anormal</th>
            <th>Especifique</th>
            <th>Cavidad oral</th>
            <th>Normal</th>
            <th>Anormal</th>
            <th>Especifique</th>
        </tr>

        <tr>
            <td class="text-table-result"><span>Pupila</span></td>
            <td class="text-table-result">
                <span class="center">
                    <?= ($resultados[7]->{36}->RESPUESTA == "Normal" && $resultados[7]->{86}->RESPUESTA == "Normal")
                        ? 'X' : (($resultados[7]->{36}->RESPUESTA == "Normal") ? 'Derecho' : (($resultados[7]->{86}->RESPUESTA == "Normal") ? 'Izquierdo' : ''));
                    ?>
                </span>
            </td>
            <td class="text-table-result">
                <span class="center">
                    <?= ($resultados[7]->{36}->RESPUESTA == "Anormal" && $resultados[7]->{86}->RESPUESTA == "Anormal")
                        ? 'X' : (($resultados[7]->{36}->RESPUESTA == "Anormal") ? 'Derecho' : (($resultados[7]->{86}->RESPUESTA == "Anormal") ? 'Izquierdo' : ''));
                    ?>
                </span>
            </td>
            <td class="text-table-result"><span class="center"><?= $resultados[7]->{36}->OBSERVACIONES ?></span></td>

            <td class="text-table-result"><span>Encías</span></td>
            <td class="text-table-result"><span class="center"><?= $resultados[7]->{719}->RESPUESTA == "Normal" ? "X" : "" ?></span></td>
            <td class="text-table-result"><span class="center"><?= $resultados[7]->{719}->RESPUESTA == "Anormal" ? "X" : "" ?></span></td>
            <td class="text-table-result"><span class="center"><?= $resultados[7]->{719}->OBSERVACIONES ?></span></td>
        </tr>
        <tr>
            <td class="text-table-result"><span>Córnea</span></td>
            <td class="text-table-result">
                <span class="center">
                    <?= ($resultados[7]->{37}->RESPUESTA == "Normal" && $resultados[7]->{87}->RESPUESTA == "Normal")
                        ? 'X' : (($resultados[7]->{37}->RESPUESTA == "Normal") ? 'Derecho' : (($resultados[7]->{87}->RESPUESTA == "Normal") ? 'Izquierdo' : ''));
                    ?>
                </span>
            </td>
            <td class="text-table-result">
                <span class="center">
                    <?= ($resultados[7]->{37}->RESPUESTA == "Anormal" && $resultados[7]->{87}->RESPUESTA == "Anormal")
                        ? 'X' : (($resultados[7]->{37}->RESPUESTA == "Anormal") ? 'Derecho' : (($resultados[7]->{87}->RESPUESTA == "Anormal") ? 'Izquierdo' : ''));
                    ?>
                </span>
            </td>
            <td class="text-table-result"><span class="center"><?= $resultados[7]->{37}->OBSERVACIONES ?></span></td>

            <td class="text-table-result"><span>Mucosa</span></td>
            <td class="text-table-result"><span class="center"><?= $resultados[7]->{712}->RESPUESTA == "Normal" ? "X" : "" ?></span></td>
            <td class="text-table-result"><span class="center"><?= $resultados[7]->{712}->RESPUESTA == "Anormal" ? "X" : "" ?></span></td>
            <td class="text-table-result"><span class="center"><?= $resultados[7]->{712}->OBSERVACIONES ?></span></td>
        </tr>


        <tr>
            <td class="text-table-result"><span>Agudeza Visual (sin lentes)</span></td>
            <td class="text-table-result"><span class="center"><?= $resultados[7]->{378}->OBSERVACIONES ?></span></td>
            <td class="text-table-result"><span class="center"><?= $resultados[7]->{878}->OBSERVACIONES ?></span></td>
            <td class="text-table-result"><span class="center"></span></td>

            <td class="text-table-result"><span>Paladar</span></td>
            <td class="text-table-result"><span class="center"><?= $resultados[7]->{720}->RESPUESTA == "Normal" ? "X" : "" ?></span></td>
            <td class="text-table-result"><span class="center"><?= $resultados[7]->{720}->RESPUESTA == "Anormal" ? "X" : "" ?></span></td>
            <td class="text-table-result"><span class="center"><?= $resultados[7]->{720}->OBSERVACIONES ?></span></td>
        </tr>

        <tr>
            <td class="text-table-result"><span>Agudeza Visual (con lentes)</span></td>
            <td class="text-table-result"><span class="center"><?= $resultados[7]->{379}->OBSERVACIONES ?></span></td>
            <td class="text-table-result"><span class="center"><?= $resultados[7]->{879}->OBSERVACIONES ?></span></td>
            <td class="text-table-result"><span class="center"></span></td>

            <td class="text-table-result"><span>Lengua</span></td>
            <td class="text-table-result"><span class="center"><?= $resultados[7]->{721}->RESPUESTA == "Normal" ? "X" : "" ?></span></td>
            <td class="text-table-result"><span class="center"><?= $resultados[7]->{721}->RESPUESTA == "Anormal" ? "X" : "" ?></span></td>
            <td class="text-table-result"><span class="center"><?= $resultados[7]->{721}->OBSERVACIONES ?></span></td>
        </tr>

        <tr>
            <td class="text-table-result"><span>Identifica colores</span></td>
            <td class="text-table-result">
                <span class="center">
                    <?= ($resultados[7]->{38}->RESPUESTA == "Sí" && $resultados[7]->{88}->RESPUESTA == "Sí")
                        ? 'X' : (($resultados[7]->{38}->RESPUESTA == "Sí") ? 'Derecho' : (($resultados[7]->{88}->RESPUESTA == "Sí") ? 'Izquierdo' : ''));
                    ?>
                </span>
            </td>
            <td class="text-table-result">
                <span class="center">
                    <?= ($resultados[7]->{38}->RESPUESTA == "No" && $resultados[7]->{88}->RESPUESTA == "No")
                        ? 'X' : (($resultados[7]->{38}->RESPUESTA == "No") ? 'Derecho' : (($resultados[7]->{88}->RESPUESTA == "No") ? 'Izquierdo' : ''));
                    ?>
                </span>
            </td>
            <td class="text-table-result"><span class="center"><?= $resultados[7]->{38}->OBSERVACIONES ?></span></td>

            <td class="text-table-result"><span>Amígdalas</span></td>
            <td class="text-table-result"><span class="center"><?= $resultados[7]->{722}->RESPUESTA == "Normal" ? "X" : "" ?></span></td>
            <td class="text-table-result"><span class="center"><?= $resultados[7]->{722}->RESPUESTA == "Anormal" ? "X" : "" ?></span></td>
            <td class="text-table-result"><span class="center"><?= $resultados[7]->{722}->OBSERVACIONES ?></span></td>
        </tr>

        <tr>
            <td class="text-table-result"><span>Movimiento ocular</span></td>
            <td class="text-table-result">
                <span class="center">
                    <?= ($resultados[7]->{39}->RESPUESTA == "Normal" && $resultados[7]->{89}->RESPUESTA == "Normal")
                        ? 'X' : (($resultados[7]->{39}->RESPUESTA == "Normal") ? 'Derecho' : (($resultados[7]->{89}->RESPUESTA == "Normal") ? 'Izquierdo' : ''));
                    ?>
                </span>
            </td>
            <td class="text-table-result">
                <span class="center">
                    <?= ($resultados[7]->{39}->RESPUESTA == "Anormal" && $resultados[7]->{89}->RESPUESTA == "Anormal")
                        ? 'X' : (($resultados[7]->{39}->RESPUESTA == "Anormal") ? 'Derecho' : (($resultados[7]->{89}->RESPUESTA == "Anormal") ? 'Izquierdo' : ''));
                    ?>
                </span>
            </td>
            <td class="text-table-result"><span class="center"><?= $resultados[7]->{39}->OBSERVACIONES ?></span></td>

            <td class="text-table-result"><span>Dentadura</span></td>
            <td class="text-table-result"><span class="center"><?= $resultados[7]->{723}->RESPUESTA == "Normal" ? "X" : "" ?></span></td>
            <td class="text-table-result"><span class="center"><?= $resultados[7]->{723}->RESPUESTA == "Anormal" ? "X" : "" ?></span></td>
            <td class="text-table-result"><span class=""><?= $resultados[7]->{723}->OBSERVACIONES ?></span></td>
        </tr>

        <tr>
            <td class="text-table-result"><span>Reflejos oculares</span></td>
            <td class="text-table-result">
                <span class="center">
                    <?= ($resultados[7]->{310}->RESPUESTA == "Normal" && $resultados[7]->{810}->RESPUESTA == "Normal")
                        ? 'X' : (($resultados[7]->{310}->RESPUESTA == "Normal") ? 'Derecho' : (($resultados[7]->{810}->RESPUESTA == "Normal") ? 'Izquierdo' : ''));
                    ?>
                </span>
            </td>
            <td class="text-table-result">
                <span class="center">
                    <?= ($resultados[7]->{310}->RESPUESTA == "Anormal" && $resultados[7]->{810}->RESPUESTA == "Anormal")
                        ? 'X' : (($resultados[7]->{310}->RESPUESTA == "Anormal") ? 'Derecho' : (($resultados[7]->{810}->RESPUESTA == "Anormal") ? 'Izquierdo' : ''));
                    ?>
                </span>
            </td>
            <td class="text-table-result"><span class="center"><?= $resultados[7]->{310}->OBSERVACIONES ?></span></td>

            <td class="text-table-result" rowspan="2"><span>Otras lesiones</span></td>
            <td class="text-table-result" rowspan="2" colspan="3"><span><?= $resultados[7]->{724}->OBSERVACIONES ?></span></td>
        </tr>

        <tr>
            <td class="text-table-result"><span>Pterigion</span></td>
            <td class="text-table-result">
                <span class="center">
                    <?= ($resultados[7]->{311}->RESPUESTA == "Sí" && $resultados[7]->{811}->RESPUESTA == "Sí")
                        ? 'X' : (($resultados[7]->{311}->RESPUESTA == "Sí") ? 'Derecho' : (($resultados[7]->{811}->RESPUESTA == "Sí") ? 'Izquierdo' : ''));
                    ?>
                </span>
            </td>
            <td class="text-table-result">
                <span class="center">
                    <?= ($resultados[7]->{311}->RESPUESTA == "No" && $resultados[7]->{811}->RESPUESTA == "No")
                        ? 'X' : (($resultados[7]->{311}->RESPUESTA == "No") ? 'Derecho' : (($resultados[7]->{811}->RESPUESTA == "No") ? 'Izquierdo' : ''));
                    ?>
                </span>
            </td>
            <td class="text-table-result"><span class="center"><?= $resultados[7]->{311}->OBSERVACIONES ?></span></td>
        </tr>
    </tbody>
</table>
