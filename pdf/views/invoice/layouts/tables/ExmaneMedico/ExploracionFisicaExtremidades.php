<table style="margin-top: 10px">
    <thead class="table_head_common_with_padding">
        <tr>
            <th colspan="4">
                <span>
                    Marque la casilla de la condición observada durante la exploración física: Normal "N" vs. Anormal "A" o "Sí" vs. "No".
                </span>
            </th>
            <th colspan="4">
                <span>
                    Extremidades
                </span>
            </th>
        </tr>
    </thead>
    <tbody class="table_body_common">
        <tr class="table_head_common_in"> <!-- CABECERA -->
            <th>Torax</th>
            <th>Normal</th>
            <th>Anormal</th>
            <th>Especifique</th>
            <th>Miémbros torácico</th>
            <th>Normal</th>
            <th>Anormal</th>
            <th>Especifique</th>
        </tr>

        <tr>
            <td class="text-table-result"><span>Simetría</span></td>
            <td class="text-table-result"><span class="center"><?= $resultados[7]->{926}->RESPUESTA == "Normal" ? "X" : "" ?></span></td>
            <td class="text-table-result"><span class="center"><?= $resultados[7]->{926}->RESPUESTA == "Anormal" ? "X" : "" ?></span></td>
            <td class="text-table-result"><span class="center"><?= $resultados[7]->{926}->OBSERVACIONES ?></span></td>

            <td class="text-table-result"><span>Integridad</span></td>
            <td class="text-table-result">
                <span class="center">
                    <?= ($resultados[7]->{927}->RESPUESTA == "Normal" && $resultados[7]->{1343}->RESPUESTA == "Normal")
                        ? 'X' : (($resultados[7]->{927}->RESPUESTA == "Normal") ? 'Derecho' : (($resultados[7]->{1343}->RESPUESTA == "Normal") ? 'Izquierdo' : ''));
                    ?>
                </span>
            </td>
            <td class="text-table-result">
                <span class="center">
                    <?= ($resultados[7]->{927}->RESPUESTA == "Anormal" && $resultados[7]->{1343}->RESPUESTA == "Anormal")
                        ? 'X' : (($resultados[7]->{927}->RESPUESTA == "Anormal") ? 'Derecho' : (($resultados[7]->{1343}->RESPUESTA == "Anormal") ? 'Izquierdo' : ''));
                    ?>
                </span>
            </td>
            <td class="text-table-result"><span class="center"><?= $resultados[7]->{927}->OBSERVACIONES ?></span></td>
        </tr>

        <tr>
            <td class="text-table-result"><span>Amplexión</span></td>
            <td class="text-table-result"><span class="center"><?= $resultados[7]->{927}->RESPUESTA == "Normal" ? "X" : "" ?></span></td>
            <td class="text-table-result"><span class="center"><?= $resultados[7]->{927}->RESPUESTA == "Anormal" ? "X" : "" ?></span></td>
            <td class="text-table-result"><span class="center"><?= $resultados[7]->{927}->OBSERVACIONES ?></span></td>

            <td class="text-table-result"><span>Movilidad</span></td>
            <td class="text-table-result"><span class="center"><?= $resultados[7]->{926}->RESPUESTA == "Normal" ? "X" : "" ?></span></td>
            <td class="text-table-result"><span class="center"><?= $resultados[7]->{926}->RESPUESTA == "Anormal" ? "X" : "" ?></span></td>
            <td class="text-table-result"><span class="center"><?= $resultados[7]->{926}->OBSERVACIONES ?></span></td>
        </tr>

        <tr>
            <td class="text-table-result"><span>Amplexación</span></td>
            <td class="text-table-result"><span class="center"><?= $resultados[7]->{928}->RESPUESTA == "Normal" ? "X" : "" ?></span></td>
            <td class="text-table-result"><span class="center"><?= $resultados[7]->{928}->RESPUESTA == "Anormal" ? "X" : "" ?></span></td>
            <td class="text-table-result"><span class="center"><?= $resultados[7]->{928}->OBSERVACIONES ?></span></td>

            <td class="text-table-result"><span>R.O.T.</span></td>
            <td class="text-table-result">
                <span class="center">
                    <?= ($resultados[7]->{1344}->RESPUESTA == "Normal" && $resultados[7]->{1444}->RESPUESTA == "Normal")
                        ? 'X' : (($resultados[7]->{1344}->RESPUESTA == "Normal") ? 'Derecho' : (($resultados[7]->{1444}->RESPUESTA == "Normal") ? 'Izquierdo' : ''));
                    ?>
                </span>
            </td>
            <td class="text-table-result">
                <span class="center">
                    <?= ($resultados[7]->{1344}->RESPUESTA == "Anormal" && $resultados[7]->{1444}->RESPUESTA == "Anormal")
                        ? 'X' : (($resultados[7]->{1344}->RESPUESTA == "Anormal") ? 'Derecho' : (($resultados[7]->{1444}->RESPUESTA == "Anormal") ? 'Izquierdo' : ''));
                    ?>
                </span>
            </td>
            <td class="text-table-result"><span class="center"><?= $resultados[7]->{1344}->OBSERVACIONES ?></span></td>
        </tr>

        <tr>
            <td class="text-table-result"><span>Murmullo vesicular</span></td>
            <td class="text-table-result"><span class="center"><?= $resultados[7]->{929}->RESPUESTA == "Sí" ? "X" : "" ?></span></td>
            <td class="text-table-result"><span class="center"><?= $resultados[7]->{929}->RESPUESTA == "No" ? "X" : "" ?></span></td>
            <td class="text-table-result"><span class="center"><?= $resultados[7]->{929}->OBSERVACIONES ?></span></td>

            <td class="text-table-result"><span>Fuerza</span></td>
            <td class="text-table-result">
                <span class="center">
                    <?= ($resultados[7]->{1345}->RESPUESTA == "Normal" && $resultados[7]->{1445}->RESPUESTA == "Normal")
                        ? 'X' : (($resultados[7]->{1345}->RESPUESTA == "Normal") ? 'Derecho' : (($resultados[7]->{1445}->RESPUESTA == "Normal") ? 'Izquierdo' : ''));
                    ?>
                </span>
            </td>
            <td class="text-table-result">
                <span class="center">
                    <?= ($resultados[7]->{1345}->RESPUESTA == "Anormal" && $resultados[7]->{1445}->RESPUESTA == "Anormal")
                        ? 'X' : (($resultados[7]->{1345}->RESPUESTA == "Anormal") ? 'Derecho' : (($resultados[7]->{1445}->RESPUESTA == "Anormal") ? 'Izquierdo' : ''));
                    ?>
                </span>
            </td>
            <td class="text-table-result"><span class="center"><?= $resultados[7]->{1345}->OBSERVACIONES ?></span></td>
        </tr>

        <tr>
            <td class="text-table-result"><span>Ventilación</span></td>
            <td class="text-table-result"><span class="center"><?= $resultados[7]->{930}->RESPUESTA == "Normal" ? "X" : "" ?></span></td>
            <td class="text-table-result"><span class="center"><?= $resultados[7]->{930}->RESPUESTA == "Anormal" ? "X" : "" ?></span></td>
            <td class="text-table-result"><span class="center"><?= $resultados[7]->{930}->OBSERVACIONES ?></span></td>

            <td class="text-table-result"><span>Pulsos</span></td>
            <td class="text-table-result">
                <span class="center">
                    <?= ($resultados[7]->{1546}->RESPUESTA == "Normal" && $resultados[7]->{1646}->RESPUESTA == "Normal")
                        ? 'X' : (($resultados[7]->{1546}->RESPUESTA == "Normal") ? 'Derecho' : (($resultados[7]->{1646}->RESPUESTA == "Normal") ? 'Izquierdo' : ''));
                    ?>
                </span>
            </td>
            <td class="text-table-result">
                <span class="center">
                    <?= ($resultados[7]->{1546}->RESPUESTA == "Anormal" && $resultados[7]->{1646}->RESPUESTA == "Anormal")
                        ? 'X' : (($resultados[7]->{1546}->RESPUESTA == "Anormal") ? 'Derecho' : (($resultados[7]->{1646}->RESPUESTA == "Anormal") ? 'Izquierdo' : ''));
                    ?>
                </span>
            </td>
            <td class="text-table-result"><span class="center"><?= $resultados[7]->{1546}->OBSERVACIONES ?></span></td>
        </tr>

        <tr class="table_head_common_in"> <!-- CABECERA -->
            <th>Área cardíaca</th>
            <th>Normal</th>
            <th>Anormal</th>
            <th>Especifique</th>
            <th>Miémbros pélvicos</th>
            <th>Normal</th>
            <th>Anormal</th>
            <th>Especifique</th>
        </tr>

        <tr>
            <td class="text-table-result"><span>Ritmo</span></td>
            <td class="text-table-result"><span class="center"><?= $resultados[7]->{1031}->RESPUESTA == "Normal" ? "X" : "" ?></span></td>
            <td class="text-table-result"><span class="center"><?= $resultados[7]->{1031}->RESPUESTA == "Anormal" ? "X" : "" ?></span></td>
            <td class="text-table-result"><span class="center"><?= $resultados[7]->{1031}->OBSERVACIONES ?></span></td>

            <td class="text-table-result"><span>Integridad</span></td>
            <td class="text-table-result">
                <span class="center">
                    <?= ($resultados[7]->{1543}->RESPUESTA == "Normal" && $resultados[7]->{1643}->RESPUESTA == "Normal")
                        ? 'X' : (($resultados[7]->{1543}->RESPUESTA == "Normal") ? 'Derecho' : (($resultados[7]->{1643}->RESPUESTA == "Normal") ? 'Izquierdo' : ''));
                    ?>
                </span>
            </td>
            <td class="text-table-result">
                <span class="center">
                    <?= ($resultados[7]->{1543}->RESPUESTA == "Anormal" && $resultados[7]->{1643}->RESPUESTA == "Anormal")
                        ? 'X' : (($resultados[7]->{1543}->RESPUESTA == "Anormal") ? 'Derecho' : (($resultados[7]->{1643}->RESPUESTA == "Anormal") ? 'Izquierdo' : ''));
                    ?>
                </span>
            </td>
            <td class="text-table-result"><span class="center"><?= $resultados[7]->{1543}->OBSERVACIONES ?></span></td>
        </tr>

        <tr>
            <td class="text-table-result"><span>Intensidad</span></td>
            <td class="text-table-result"><span class="center"><?= $resultados[7]->{1032}->RESPUESTA == "Normal" ? "X" : "" ?></span></td>
            <td class="text-table-result"><span class="center"><?= $resultados[7]->{1032}->RESPUESTA == "Anormal" ? "X" : "" ?></span></td>
            <td class="text-table-result"><span class="center"><?= $resultados[7]->{1032}->OBSERVACIONES ?></span></td>

            <td class="text-table-result"><span>Movilidad</span></td>
            <td class="text-table-result">
                <span class="center">
                    <?= ($resultados[7]->{155}->RESPUESTA == "Normal" && $resultados[7]->{165}->RESPUESTA == "Normal")
                        ? 'X' : (($resultados[7]->{155}->RESPUESTA == "Normal") ? 'Derecho' : (($resultados[7]->{165}->RESPUESTA == "Normal") ? 'Izquierdo' : ''));
                    ?>
                </span>
            </td>
            <td class="text-table-result">
                <span class="center">
                    <?= ($resultados[7]->{155}->RESPUESTA == "Anormal" && $resultados[7]->{165}->RESPUESTA == "Anormal")
                        ? 'X' : (($resultados[7]->{155}->RESPUESTA == "Anormal") ? 'Derecho' : (($resultados[7]->{165}->RESPUESTA == "Anormal") ? 'Izquierdo' : ''));
                    ?>
                </span>
            </td>
            <td class="text-table-result"><span class="center"><?= $resultados[7]->{155}->OBSERVACIONES ?></span></td>
        </tr>

        <tr>
            <td class="text-table-result"><span>Ruidos cardiacos agregados</span></td>
            <td class="text-table-result"><span class="center"><?= $resultados[7]->{1033}->RESPUESTA == "Normal" ? "X" : "" ?></span></td>
            <td class="text-table-result"><span class="center"><?= $resultados[7]->{1033}->RESPUESTA == "Anormal" ? "X" : "" ?></span></td>
            <td class="text-table-result"><span class="center"><?= $resultados[7]->{1033}->OBSERVACIONES ?></span></td>

            <td class="text-table-result"><span>R.O.T.</span></td>
            <td class="text-table-result">
                <span class="center">
                    <?= ($resultados[7]->{1544}->RESPUESTA == "Normal" && $resultados[7]->{1644}->RESPUESTA == "Normal")
                        ? 'X' : (($resultados[7]->{1544}->RESPUESTA == "Normal") ? 'Derecho' : (($resultados[7]->{1644}->RESPUESTA == "Normal") ? 'Izquierdo' : ''));
                    ?>
                </span>
            </td>
            <td class="text-table-result">
                <span class="center">
                    <?= ($resultados[7]->{1544}->RESPUESTA == "Anormal" && $resultados[7]->{1644}->RESPUESTA == "Anormal")
                        ? 'X' : (($resultados[7]->{1544}->RESPUESTA == "Anormal") ? 'Derecho' : (($resultados[7]->{1644}->RESPUESTA == "Anormal") ? 'Izquierdo' : ''));
                    ?>
                </span>
            </td>
            <td class="text-table-result"><span class="center"><?= $resultados[7]->{1544}->OBSERVACIONES ?></span></td>
        </tr>

        <tr>
            <td class="text-table-result"><span>Soplos</span></td>
            <td class="text-table-result"><span class="center"><?= $resultados[7]->{1034}->RESPUESTA == "Sí" ? "X" : "" ?></span></td>
            <td class="text-table-result"><span class="center"><?= $resultados[7]->{1034}->RESPUESTA == "No" ? "X" : "" ?></span></td>
            <td class="text-table-result"><span class="center"><?= $resultados[7]->{1034}->OBSERVACIONES ?></span></td>

            <td class="text-table-result"><span>Fuerza</span></td>
            <td class="text-table-result">
                <span class="center">
                    <?= ($resultados[7]->{1545}->RESPUESTA == "Normal" && $resultados[7]->{1645}->RESPUESTA == "Normal")
                        ? 'X' : (($resultados[7]->{1545}->RESPUESTA == "Normal") ? 'Derecho' : (($resultados[7]->{1645}->RESPUESTA == "Normal") ? 'Izquierdo' : ''));
                    ?>
                </span>
            </td>
            <td class="text-table-result">
                <span class="center">
                    <?= ($resultados[7]->{1545}->RESPUESTA == "Anormal" && $resultados[7]->{1645}->RESPUESTA == "Anormal")
                        ? 'X' : (($resultados[7]->{1545}->RESPUESTA == "Anormal") ? 'Derecho' : (($resultados[7]->{1645}->RESPUESTA == "Anormal") ? 'Izquierdo' : ''));
                    ?>
                </span>
            </td>
            <td class="text-table-result"><span class="center"><?= $resultados[7]->{1545}->OBSERVACIONES ?></span></td>
        </tr>

        <tr>
            <th class="th_head_common_in">Abdomen</th>
            <td class="th_head_common_in" colspan="3"></td>

            <td class="text-table-result"><span>Pulsos</span></td>
            <td class="text-table-result">
                <span class="center">
                    <?= ($resultados[7]->{1546}->RESPUESTA == "Normal" && $resultados[7]->{1646}->RESPUESTA == "Normal")
                        ? 'X' : (($resultados[7]->{1546}->RESPUESTA == "Normal") ? 'Derecho' : (($resultados[7]->{1646}->RESPUESTA == "Normal") ? 'Izquierdo' : ''));
                    ?>
                </span>
            </td>
            <td class="text-table-result">
                <span class="center">
                    <?= ($resultados[7]->{1546}->RESPUESTA == "Anormal" && $resultados[7]->{1646}->RESPUESTA == "Anormal")
                        ? 'X' : (($resultados[7]->{1546}->RESPUESTA == "Anormal") ? 'Derecho' : (($resultados[7]->{1646}->RESPUESTA == "Anormal") ? 'Izquierdo' : ''));
                    ?>
                </span>
            </td>
            <td class="text-table-result"><span class="center"><?= $resultados[7]->{1546}->OBSERVACIONES ?></span></td>
        </tr>

        <tr class="break">
            <td class="text-table-result"><span>Conformación</span></td>
            <td class="text-table-result" colspan="3"><!-- RELLENAR -->
                <span class="checked <?= $resultados[7]->{1135}->RESPUESTA == 'Plano'? '' : 'empty' ?>">X</span> <!-- RELLENAR -->
                <span class="checked-label" style="margin-left: 2px; margin-right: 15px;">Plano</span>
                <span class="checked <?= $resultados[7]->{1135}->RESPUESTA == 'Globoso'? '' : 'empty' ?>">X</span> <!-- RELLENAR -->
                <span class="checked-label" style="margin-left: 2px; margin-right: 15px;">Globoso</span>
                <span class="checked <?= $resultados[7]->{1135}->RESPUESTA == 'Cóncavo'? '' : 'empty' ?>">X</span> <!-- RELLENAR -->
                <span class="checked-label" style="margin-left: 2px; margin-right: 15px;">Cóncavo</span>
            </td>

            <td class="text-table-result"><span>Hinchazon</span></td>
            <td class="text-table-result">
                <span class="center">
                    <?= ($resultados[7]->{1546}->RESPUESTA == "Normal" && $resultados[7]->{1646}->RESPUESTA == "Normal")
                        ? 'X' : (($resultados[7]->{1546}->RESPUESTA == "Normal") ? 'Derecho' : (($resultados[7]->{1646}->RESPUESTA == "Normal") ? 'Izquierdo' : ''));
                    ?>
                </span>
            </td>
            <td class="text-table-result">
                <span class="center">
                    <?= ($resultados[7]->{1546}->RESPUESTA == "Anormal" && $resultados[7]->{1646}->RESPUESTA == "Anormal")
                        ? 'X' : (($resultados[7]->{1546}->RESPUESTA == "Anormal") ? 'Derecho' : (($resultados[7]->{1646}->RESPUESTA == "Anormal") ? 'Izquierdo' : ''));
                    ?>
                </span>
            </td>
            <td class="text-table-result"><span class="center"><?= $resultados[7]->{1546}->OBSERVACIONES ?></span></td>
        </tr>

        <tr>
            <td class="text-table-result"><span>Peristálsis</span></td>
            <td class="text-table-result"><span class="center"><?= $resultados[7]->{1136}->RESPUESTA == "Normal" ? "Normal" : "" ?></span></td>
            <td class="text-table-result"><span class="center"><?= $resultados[7]->{1136}->RESPUESTA == "Anormal" ? "Anormal" : "" ?></span></td>
            <td class="text-table-result"><span class="center"><?= $resultados[7]->{1136}->OBSERVACIONES ?></span></td>

            <th class="th_head_common_in">Piel y anexos</th>
            <td class="th_head_common_in"><span>Normal</span></td>
            <td class="th_head_common_in"><span>Anormal</span></td>
            <td class="th_head_common_in"><span>Especifique</span></td>
        </tr>

        <tr>
            <td class="text-table-result"><span>Vísceromegalias</span></td>
            <td class="text-table-result" colspan="2">
                <div style="text-align: center">
                    <span style="letter-spacing: 2px;"><?= $resultados[7]->{1137}->RESPUESTA == "(X) Sí ( ) No" ? "X" : "( ) Sí (X) No" ?></span>
                </div>
            </td>
            <td class="text-table-result"><span class="center"><?= $resultados[7]->{1137}->OBSERVACIONES ?></span></td>

            <td class="text-table-result"><span>Dermis</span></td>
            <td class="text-table-result"><span class="center"><?= $resultados[7]->{1747}->RESPUESTA == "Normal" ? "Normal" : "" ?></span></td>
            <td class="text-table-result"><span class="center"><?= $resultados[7]->{1747}->RESPUESTA == "Anormal" ? "Anormal" : "" ?></span></td>
            <td class="text-table-result"><span class="center"><?= $resultados[7]->{1747}->OBSERVACIONES ?></span></td>
        </tr>

        <tr>
            <td class="text-table-result"><span>Hernias umbilical / inguinal</span></td>
            <td class="text-table-result" colspan="2">
                <div style="text-align: center">
                    <span style="letter-spacing: 2px;"><?= $resultados[7]->{1138}->RESPUESTA == "(X) Sí ( ) No" ? "X" : "( ) Sí (X) No" ?></span>
                </div>
            </td>
            <td class="text-table-result"><span class="center"><?= $resultados[7]->{1138}->OBSERVACIONES ?></span></td>

            <td class="text-table-result"><span>Cabello</span></td>
            <td class="text-table-result"><span class="center"><?= $resultados[7]->{1748}->RESPUESTA == "Normal" ? "Normal" : "" ?></span></td>
            <td class="text-table-result"><span class="center"><?= $resultados[7]->{1748}->RESPUESTA == "Anormal" ? "Anormal" : "" ?></span></td>
            <td class="text-table-result"><span class="center"><?= $resultados[7]->{1748}->OBSERVACIONES ?></span></td>
        </tr>

        <tr>
            <td class="text-table-result"><span>Otros</span></td>
            <td class="text-table-result"><span>             </span></td><!-- RELLENAR -->
            <td class="text-table-result"><span>             </span></td><!-- RELLENAR -->
            <td class="text-table-result"><span>             </span></td><!-- RELLENAR -->

            <td class="text-table-result"><span>Uñas</span></td>
            <td class="text-table-result"><span class="center"><?= $resultados[7]->{1749}->RESPUESTA == "Normal" ? "Normal" : "" ?></span></td>
            <td class="text-table-result"><span class="center"><?= $resultados[7]->{1749}->RESPUESTA == "Anormal" ? "Anormal" : "" ?></span></td>
            <td class="text-table-result"><span class="center"><?= $resultados[7]->{1749}->OBSERVACIONES ?></span></td>
        </tr>

        <tr>
            <td class="th_head_common_in"><span>Columna lumbosacra</span></td>
            <td class="th_head_common_in"><span>Normal</span></td>
            <td class="th_head_common_in"><span>Anormal</span></td>
            <td class="th_head_common_in"><span>Especifique</span></td>

            <td class="text-table-result"><span>Dermatosis</span></td>
            <td class="text-table-result" colspan="2">
                <div style="text-align: center">
                    <span style="letter-spacing: 2px;"><?= $resultados[7]->{1750}->RESPUESTA == "(X) Sí ( ) No" ? "X" : "( ) Sí (X) No" ?></span>
                </div>
            </td>
            <td class="text-table-result"><span class="center"><?= $resultados[7]->{1750}->OBSERVACIONES ?></span></td>
        </tr>

        <tr>
            <td class="text-table-result"><span>Conformación</span></td>
            <td class="text-table-result"><span class="center"><?= $resultados[7]->{1235}->RESPUESTA == "Normal" ? "X" : "" ?></span></td>
            <td class="text-table-result"><span class="center"><?= $resultados[7]->{1235}->RESPUESTA == "Anormal" ? "X" : "" ?></span></td>
            <td class="text-table-result"><span class="center"><?= $resultados[7]->{1235}->OBSERVACIONES ?></span></td>

            <td class="text-table-result"><span>Dermatitis</span></td>
            <td class="text-table-result" colspan="2">
                <div style="text-align: center">
                    <span style="letter-spacing: 2px;"><?= $resultados[7]->{1751}->RESPUESTA == "(X) Sí ( ) No" ? "X" : "( ) Sí (X) No" ?></span>
                </div>
            </td>
            <td class="text-table-result"><span class="center"><?= $resultados[7]->{1751}->OBSERVACIONES ?></span></td>
        </tr>

        <tr>
            <td class="text-table-result"><span>Arcos de movimiento</span></td>
            <td class="text-table-result"><span class="center"><?= $resultados[7]->{1240}->RESPUESTA == "Normal" ? "X" : "" ?></span></td>
            <td class="text-table-result"><span class="center"><?= $resultados[7]->{1240}->RESPUESTA == "Anormal" ? "X" : "" ?></span></td>
            <td class="text-table-result"><span class="center"><?= $resultados[7]->{1240}->OBSERVACIONES ?></span></td>

            <td class="text-table-result"><span>Tatuajes</span></td>
            <td class="text-table-result" colspan="2">
                <div style="text-align: center">
                    <span style="letter-spacing: 2px;"><?= $resultados[7]->{1752}->RESPUESTA == "(X) Sí ( ) No" ? "X" : "( ) Sí (X) No" ?></span>
                </div>
            </td>
            <td class="text-table-result"><span class="center"><?= $resultados[7]->{1752}->OBSERVACIONES ?></span></td>
        </tr>

        <tr>
            <td class="text-table-result"><span>Marcha</span></td>
            <td class="text-table-result"><span class="center"><?= $resultados[7]->{1241}->RESPUESTA == "Normal" ? "X" : "" ?></span></td>
            <td class="text-table-result"><span class="center"><?= $resultados[7]->{1241}->RESPUESTA == "Anormal" ? "X" : "" ?></span></td>
            <td class="text-table-result"><span class="center"><?= $resultados[7]->{1241}->OBSERVACIONES ?></span></td>

            <td class="text-table-result"><span>Cicatrices</span></td>
            <td class="text-table-result" colspan="2">
                <div style="text-align: center">
                    <span style="letter-spacing: 2px;"><?= $resultados[7]->{1753}->RESPUESTA == "(X) Sí ( ) No" ? "X" : "( ) Sí (X) No" ?></span>
                </div>
            </td>
            <td class="text-table-result"><span class="center"><?= $resultados[7]->{1753}->OBSERVACIONES ?></span></td>
        </tr>

        <tr>
            <td class="text-table-result"><span>Puntos dolorosos</span></td>
            <td class="text-table-result" colspan="2">
                <div style="text-align: center">
                    <span style="letter-spacing: 2px;"><?= $resultados[7]->{1242}->RESPUESTA == "(X) Sí ( ) No" ? "X" : "( ) Sí (X) No" ?></span>
                </div>
            </td>
            <td class="text-table-result"><span class="center"><?= $resultados[7]->{1242}->OBSERVACIONES ?></span></td>

            <td class="text-table-result"></td>
            <td class="text-table-result"></td>
            <td class="text-table-result"></td>
            <td class="text-table-result"></td>
        </tr>

        <tr>
            <td class="text-table-result" colspan="4"><span>Alteraciones en agudeza auditiva:</span></td>
            <td class="text-table-result" colspan="4"><span>Alteraciones radiográficas:</span></td>
        </tr>
    </tbody>
</table>
