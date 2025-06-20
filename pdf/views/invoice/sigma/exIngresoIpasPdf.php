<style>
    <?php include 'exIngresoIpasPdf.css'; ?>
</style>
<script>
    import "@fontsource-variable/onest";
</script>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ex Ingreso IPAS</title>
</head>

<body>
    <table class="tableS" dir="ltr" border="1" cellspacing="0" cellpadding="0" data-sheets-root="1" data-sheets-baot="1">
        <colgroup>
            <col width="670" />
            <col width="357" />
            <col width="189" />
            <col width="116" />
            <col width="100" />
            <col width="328" />
            <col width="66" />
            <col width="58" />
            <col width="76" />
            <col width="100" />
        </colgroup>
        <tbody>
            <tr>
                <td <?php $imagePath = 'https://bimo-lab.com/nuevo_checkup/pdf/views/invoice/sigma/Imagen1.jpg';
                    $imageData = base64_encode(file_get_contents($imagePath));
                    $src = 'data:image/jpeg;base64,' . $imageData;
                    ?> colspan="1" rowspan="1"><img class="logoSigma" src="<?= $src ?>" alt="SigmaLogo">
                </td>
                <td colspan="9" style="text-align: center; vertical-align: middle; font-weight: bold; font-size: 12px;">SISTEMA DE SALUD INTEGRAL SIGMA</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td colspan="9" rowspan="1" style="text-align: center; vertical-align: middle; font-weight: bold;">EXAMEN M&Eacute;DICO DE INGRESO</td>
            </tr>
            <tr>
                <td colspan="2"><strong>SIGNOS VITALES:</strong></td>
                <td><strong>TA:</strong></td>
                <td><span id="signosTASpan">
                        <?php
                        echo $resultados[6]->{6}->VALOR . ' / ' . $resultados[6]->{7}->VALOR;
                        ?>
                    </span></td>
                <td><strong>FC:</strong></td>
                <td><span id="signosFCSpan">
                        <?php
                        echo $resultados[6]->{8}->VALOR
                        ?>
                    </span></td>
                <td><strong>FR:</strong></td>
                <td><span id="signosFRSpan">
                        <?php
                        echo $resultados[6]->{5}->VALOR
                        ?>
                    </span></td>
                <td><strong>TEMP:</strong></td>
                <td colspan="1" rowspan="1"><span id="signosTEMPSpan">
                        <?php
                        echo $resultados[6]->{4}->VALOR . ' ' . $resultados[6]->{4}->UNIDAD_MEDIDA;
                        ?>
                    </span></td>
            </tr>
            <tr>
                <td colspan="2" rowspan="1"><strong>ANTOPOMETRICOS:</strong></td>
                <td><span></span></td>
                <td><strong>PESO:</strong></td>
                <td><span id="antoPESOSpan">
                        <?php
                        echo $resultados[6]->{2}->VALOR . ' ' . $resultados[6]->{2}->UNIDAD_MEDIDA;
                        ?>
                    </span></td>
                <td><strong>ESTATURA:</strong></td>
                <td><span id="antoEstaturaSpan">
                        <?php
                        echo $resultados[6]->{1}->VALOR . ' ' . $resultados[6]->{1}->UNIDAD_MEDIDA;
                        ?>
                    </span></td>
                <td style="background-color: #E6B8B7;"><strong>IMC:</strong></td>
                <td colspan="2" rowspan="1"><span id="antoIMDSpan">
                        <?php
                        echo $resultados[6]->{3}->VALOR
                        ?>
                    </span></td>
            </tr>
            <tr>
                <td colspan="10" rowspan="1" style="text-align: center; font-weight: bold; background-color: #C0C0C0;">INTERROGATORIO POR APARATOS Y SISTEMAS</td>
            </tr>
            <tr>
                <td colspan="5" rowspan="1" style="text-align: center; font-weight: bold; background-color: #E6B8B7;">&Oacute;rgano de los Sentidos</td>
                <td colspan="5" rowspan="1" style="text-align: center; font-weight: bold; background-color: #E6B8B7;">Respiratorio</td>
            </tr>
            <tr>
                <td colspan="3" rowspan="1">Problemas de la vista (uso de Lentes)</td>
                <td class="cent" colspan="2" rowspan="1"><span id="problemasViSpan">
                        <?php
                        // if ($resultados[4]->{249}->RESPUESTA == "Sí") {
                        //     echo "x";
                        // }
                        echo $resultados[4]->{249}->RESPUESTA;
                        ?>
                    </span></td>
                <td colspan="3" rowspan="1">Antecedente de ASMA</td>
                <td class="cent" colspan="2" rowspan="1"><span id="anteAsmaSpan">
                        <?php
                        // if ($resultados[4]->{81}->RESPUESTA == "Sí") {
                        //     echo "x";
                        // }
                        echo $resultados[4]->{81}->RESPUESTA;
                        ?>
                    </span></td>
            </tr>
            <tr>
                <td colspan="3" rowspan="1">Infecciones Oculares Recurrentes</td>
                <td class="cent" colspan="2" rowspan="1"><span id="infecOcuSpan">
                        <?php
                        // if ($resultados[4]->{261}->RESPUESTA == "Sí") {
                        //     echo "x";
                        // }
                        echo $resultados[4]->{261}->RESPUESTA;
                        ?>
                    </span></td>
                <td colspan="3" rowspan="1">Antecedente Rinitis Alérgica</td>
                <td class="cent" colspan="2" rowspan="1"><span id="antecRiniAlerSpan">
                        <?php
                        // if ($resultados[4]->{265}->RESPUESTA == "Sí") {
                        //     echo "x";
                        // }
                        echo $resultados[4]->{265}->RESPUESTA;
                        ?>
                    </span></td>
            </tr>
            <tr>
                <td colspan="5" rowspan="1">&nbsp;</td>
                <td colspan="3" rowspan="1">Antecedente de Neumonías o Bronquitis</td>
                <td class="cent" colspan="2" rowspan="1"><span id="antecNeumBronqSpan">
                        <?php
                        // if ($resultados[4]->{266}->RESPUESTA == "Sí") {
                        //     echo "x";
                        // }
                        echo $resultados[4]->{266}->RESPUESTA;
                        ?>
                    </span></td>
            </tr>
            <tr>
                <td colspan="5" rowspan="1">&nbsp;</td>
                <td colspan="3" rowspan="1">Antecedente de Influenza</td>
                <td class="cent" colspan="2" rowspan="1"><span id="antecInfuSpan">
                        <?php
                        // if ($resultados[4]->{267}->RESPUESTA == "Sí") {
                        //     echo "x";
                        // }
                        echo $resultados[4]->{267}->RESPUESTA;
                        ?>
                    </span></td>
                </span></td>
            </tr>
            <tr>
                <td colspan="5" rowspan="1">&nbsp;</td>
                <td colspan="3" rowspan="1">Antecedente de Tuberculosis</td>
                <td class="cent" colspan="2" rowspan="1"><span id="antecTuberSpan">
                        <?php
                        // if ($resultados[4]->{268}->RESPUESTA == "Sí") {
                        //     echo "x";
                        // }

                        echo $resultados[4]->{268}->RESPUESTA;
                        ?>
                    </span></td>
            </tr>
            <tr>
                <td colspan="5" rowspan="1">&nbsp;</td>
                <td colspan="5" rowspan="1">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="5" rowspan="1" style="text-align: center; font-weight: bold; background-color: #E6B8B7;">Cardiovascular</td>
                <td colspan="5" rowspan="1" style="text-align: center; font-weight: bold; background-color: #E6B8B7;">Digestivo</td>
            </tr>
            <tr>
                <td colspan="3" rowspan="1">Cirugías Cardiacas</td>
                <td class="cent" colspan="2" rowspan="1"><span id="cirCardSpan">
                        <?php
                        // if ($resultados[4]->{262}->RESPUESTA == "Sí") {
                        //     echo "x";
                        // }
                        echo $resultados[4]->{262}->RESPUESTA;
                        ?>
                    </span></td>
                <td colspan="3" rowspan="1">Antecedente de Gastritis</td>
                <td class="cent" colspan="2" rowspan="1"><span id="antecGrastSpan">
                        <?php
                        // if ($resultados[4]->{269}->RESPUESTA == "Sí") {
                        //     echo "x";
                        // }
                        echo $resultados[4]->{269}->RESPUESTA
                        ?>
                    </span></td>
            </tr>
            <tr>
                <td colspan="3" rowspan="1">Antecedente de Varices</td>
                <td class="cent" colspan="2" rowspan="1"><span id="antecVaricSpan">
                        <?php
                        // if ($resultados[4]->{263}->RESPUESTA == "Sí") {
                        //     echo "x";
                        // }
                        echo $resultados[4]->{263}->RESPUESTA
                        ?>
                    </span></td>
                <td colspan="3" rowspan="1">Antecedente de Colitis</td>
                <td class="cent" colspan="2" rowspan="1"><span id="antecColSpan">
                        <?php
                        // if ($resultados[4]->{270}->RESPUESTA == "Sí") {
                        //     echo "x";
                        // }
                        echo $resultados[4]->{270}->RESPUESTA;
                        ?>
                    </span></td>
            </tr>
            <tr>
                <td colspan="3" rowspan="1">Dolor hormigueos o Adormecimiento de Piernas</td>
                <td class="cent" colspan="2" rowspan="1"><span id="dolHorAdoPierSpan">
                        <?php
                        // if ($resultados[4]->{264}->RESPUESTA == "Sí") {
                        //     echo "x";
                        // }
                        echo $resultados[4]->{264}->RESPUESTA;
                        ?>
                    </span></td>
                <td colspan="3" rowspan="1">Antecedente de Enfermedades Diarreicas frecuentes</td>
                <td class="cent" colspan="2" rowspan="1"><span id="antecEnfDiarFrecSpan">
                        <?php
                        // if ($resultados[4]->{271}->RESPUESTA == "Sí") {
                        //     echo "x";
                        // }
                        echo $resultados[4]->{271}->RESPUESTA;
                        ?>
                    </span></td>
            </tr>
            <tr>
                <td colspan="5" rowspan="1">&nbsp;</td>
                <td colspan="5" rowspan="1">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="5" rowspan="1">&nbsp;</td>
                <td colspan="5" rowspan="1">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="5" rowspan="1">&nbsp;</td>
                <td colspan="5" rowspan="1">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="5" rowspan="1" style="text-align: center; font-weight: bold; background-color: #E6B8B7;">Genitourinario</td>
                <td colspan="5" rowspan="1" style="text-align: center; font-weight: bold; background-color: #E6B8B7;">Musculoesquel&eacute;tico</td>
            </tr>
            <tr>
                <td colspan="3" rowspan="1">Infecciones Urinarias</td>
                <td class="cent" colspan="2" rowspan="1"><span id="infUrinSpan">
                        <?php
                        // if ($resultados[4]->{272}->RESPUESTA == "Sí") {
                        //     echo "x";
                        // }
                        echo $resultados[4]->{272}->RESPUESTA;
                        ?>
                    </span></td>
                <td colspan="3" rowspan="1">Dolor en Columna, (Lumbar o cuello)</td>
                <td class="cent" colspan="2" rowspan="1"><span id="dolColumSpan">
                        <?php
                        // if ($resultados[4]->{275}->RESPUESTA == "Sí") {
                        //     echo "x";
                        // }
                        echo $resultados[4]->{275}->RESPUESTA;
                        ?>
                    </span></td>
            </tr>
            <tr>
                <td colspan="3" rowspan="1">Cálculos o arenillas</td>
                <td class="cent" colspan="2" rowspan="1"><span id="calcArenilSpan">
                        <?php
                        // if ($resultados[4]->{273}->RESPUESTA == "Sí") {
                        //     echo "x";
                        // }
                        echo $resultados[4]->{273}->RESPUESTA;
                        ?>
                    </span></td>
                <td colspan="3" rowspan="1">Desviación de Columna</td>
                <td class="cent" colspan="2" rowspan="1"><span id="desvColumSpan">
                        <?php
                        // if ($resultados[4]->{276}->RESPUESTA == "Sí") {
                        //     echo "x";
                        // }

                        echo $resultados[4]->{276}->RESPUESTA;
                        ?>
                    </span></td>
            </tr>
            <tr>
                <td colspan="3" rowspan="1">Problemas en ri&ntilde;ón</td>
                <td class="cent" colspan="2" rowspan="1"><span id="probRiñSpan">
                        <?php
                        // if ($resultados[4]->{274}->RESPUESTA == "Sí") {
                        //     echo "x";
                        // }
                        echo $resultados[4]->{274}->RESPUESTA;
                        ?>
                    </span></td>
                <td colspan="3" rowspan="1">Dolor, inflamación o crepitación de Hombro</td>
                <td class="cent" colspan="2" rowspan="1"><span id="dolInfCrepHombrSpan">
                        <?php
                        // if ($resultados[4]->{277}->RESPUESTA == "Sí") {
                        //     echo "x";
                        // }
                        echo $resultados[4]->{277}->RESPUESTA;
                        ?>
                    </span></td>
            </tr>
            <tr">
                <td colspan="1" rowspan="1" style="background-color: #CCFFFF; font-weight: bold;">S&Oacute;LO MUJERES: Menarquia:</td>
                <td class="cent" style="background-color: #CCFFFF;"><span id="menarquiaSpan">
                        <?php
                        if (isset($resultados[1]->{192}->NOTAS)) {
                            echo $resultados[1]->{192}->NOTAS;
                        }
                        ?>
                    </span></td>
                <td style="background-color: #CCFFFF; font-weight: bold; font-size: 7px; text-align: center;">Ritmo Menstrual:</td>
                <td colspan="2" style="background-color: #CCFFFF;"><span id="ritmoMenstrualSpan">
                        <?php
                        if (isset($resultados[1]->{197}->NOTAS)) {
                            echo $resultados[1]->{197}->NOTAS;
                        }
                        ?>
                    </span></td>
                <td colspan="3" rowspan="1">Dolor, inflamación o crepitación de Rodillas</td>
                <td class="cent" colspan="2" rowspan="1"><span id="dolInflCrepRodiSpan">
                        <?php
                        // if ($resultados[4]->{278}->RESPUESTA == "Sí") {
                        //     echo "x";
                        // }
                        echo $resultados[4]->{278}->RESPUESTA;
                        ?>
                    </span></td>
                </tr>
                <tr>
                    <td style="background-color: #CCFFFF; font-weight: bold;">Vida Sex Activa:</td>
                    <td class="cent" style="background-color: #CCFFFF;"><span id="vidaSexActSpan">
                            <?php
                            // if ($resultados[1]->{23}->RESPUESTA == "Sí") {
                            //     echo "x";
                            // }
                            echo $resultados[1]->{23}->RESPUESTA;
                            ?>
                        </span></td>
                    <td colspan="2" rowspan="1" style="background-color: #CCFFFF; font-weight: bold;">Fecha &Uacute;ltima Menstruaci&oacute;n:</td>
                    <td style="background-color: #CCFFFF;"><span id="fechUltMensSpan">
                            <?php
                            if (isset($resultados[1]->{193}->NOTAS)) {
                                echo $resultados[1]->{193}->NOTAS;
                            }
                            ?>
                        </span></td>
                    <td colspan="3" rowspan="1">Dolor, inflamación o crepitación en Mu&ntilde;ecas</td>
                    <td class="cent" colspan="2" rowspan="1"><span id="dolorInfCrepMuñSpan">
                            <?php
                            // if ($resultados[4]->{279}->RESPUESTA == "Sí") {
                            //     echo "x";
                            // }

                            echo $resultados[4]->{279}->RESPUESTA;
                            ?>
                        </span></td>
                </tr>
                <tr>
                    <td colspan="2" rowspan="1" style="background-color: #CCFFFF; font-weight: bold;">Fecha &Uacute;ltimo Papanicolau C V:</td>
                    <td colspan="3" rowspan="1" style="background-color: #CCFFFF;"><span id="fechUltPapanicolauSpan">
                            <?php
                            if (isset($resultados[1]->{200}->NOTAS)) {
                                echo $resultados[1]->{200}->NOTAS;
                            }
                            ?>
                        </span></td>
                    <td colspan="3" rowspan="1">Antecedente de Accidente Automovilístico</td>
                    <td class="cent" colspan="2" rowspan="1"><span id="antecedenAccAutoSpan">
                            <?php
                            // if ($resultados[4]->{280}->RESPUESTA == "Sí") {
                            //     echo "x";
                            // }
                            echo $resultados[4]->{280}->RESPUESTA;
                            ?>
                        </span></td>
                </tr>
                <tr>
                    <td colspan="10" rowspan="1" style="text-align: center; background-color: #C0C0C0;">Marque <strong>X</strong> bajo la condici&oacute;n observada durante la <strong>Exploraci&oacute;n F&iacute;sica</strong>: Normal "N" vs. Anormal "A" o "S&iacute;" vs. "No".</td>
                </tr>
                <tr>
                    <td style="font-weight: bold; background-color: #C0C0C0;">CABEZA</td>
                    <td style="background-color: #C0C0C0; text-align: center;">Normal</td>
                    <td style="background-color: #C0C0C0; text-align: center;">Anormal</td>
                    <td colspan="2" rowspan="1" style="background-color: #C0C0C0; text-align: center;">Especifique</td>
                    <td style="font-weight: bold; background-color: #C0C0C0;">NARIZ</td>
                    <td style="background-color: #C0C0C0; text-align: center;">Normal</td>
                    <td style="background-color: #C0C0C0; text-align: center;">Anormal</td>
                    <td colspan="2" rowspan="1" style="background-color: #C0C0C0; text-align: center;">Especifique</td>
                </tr>
                <tr>
                    <td>Cr&aacute;neo</td>
                    <td class="cent"><span id="craneoNormalSpan">
                            <?php
                            if ($resultados[7]->{11}->RESPUESTA == "Normal") {
                                echo "x";
                            }
                            ?>
                        </span></td>
                    <td class="cent"><span id="craneoAnormalSpan">
                            <?php
                            if ($resultados[7]->{11}->RESPUESTA == "Anormal") {
                                echo "x";
                            }
                            ?>
                        </span></td>
                    <td colspan="2" rowspan="1"><span id="craneoEspecifiqueSpan">
                            <?php
                            if (isset($resultados[7]->{11}->OBSERVACIONES)) {
                                echo $resultados[7]->{11}->OBSERVACIONES;
                            }
                            ?>
                        </span></td>
                    <td style="vertical-align: middle;">Mucosa</td>
                    <td class="cent"><span id="mucosaNormalSpan">
                            <?php
                            if ($resultados[7]->{412}->RESPUESTA == "Normal") {
                                echo "x";
                            }
                            ?>
                        </span></td>
                    <td class="cent"><span id="mucosaAnormalSpan">
                            <?php
                            if ($resultados[7]->{412}->RESPUESTA == "Anormal") {
                                echo "x";
                            }
                            ?>
                        </span></td>
                    <td colspan="2" rowspan="1"><span id="mucosaEspecifiqueSpan">
                            <?php
                            if (isset($resultados[7]->{412}->OBSERVACIONES)) {
                                echo $resultados[7]->{412}->OBSERVACIONES;
                            }
                            ?>
                        </span></td>
                </tr>
                <tr>
                    <td>Cara</td>
                    <td class="cent"><span id="caraNormalSpan">
                            <?php
                            if ($resultados[7]->{12}->RESPUESTA == "Normal") {
                                echo "x";
                            }
                            ?>
                        </span></td>
                    <td class="cent"><span id="caraAnormalSpan">
                            <?php
                            if ($resultados[7]->{12}->RESPUESTA == "Anormal") {
                                echo "x";
                            }
                            ?>
                        </span></td>
                    <td colspan="2" rowspan="1"><span id="caraEspecifiqueSpan">
                            <?php
                            if (isset($resultados[7]->{12}->OBSERVACIONES)) {
                                echo $resultados[7]->{12}->OBSERVACIONES;
                            }
                            ?>
                        </span></td>
                    <td>Cornetes</td>
                    <td class="cent"><span id="cornetesNormalSpan">
                            <?php
                            if ($resultados[7]->{413}->RESPUESTA == "Normal") {
                                echo "x";
                            }
                            ?>
                        </span></td>
                    <td class="cent"><span id="cornetesAnormalSpan">
                            <?php
                            if ($resultados[7]->{413}->RESPUESTA == "Anormal") {
                                echo "x";
                            }
                            ?>
                        </span></td>
                    <td class="cent" colspan="2" rowspan="1"><span id="cornetesEspecifiqueSpan">
                            <?php
                            if (isset($resultados[7]->{413}->OBSERVACIONES)) {
                                echo $resultados[7]->{413}->OBSERVACIONES;
                            }
                            ?>
                        </span></td>
                </tr>

                <tr>
                    <td style="font-weight: bold; background-color: #C0C0C0;">CUELLO</td>
                    <td style="background-color: #C0C0C0; text-align: center;">Normal</td>
                    <td style="background-color: #C0C0C0; text-align: center;">Anormal</td>
                    <td colspan="2" rowspan="1" style="background-color: #C0C0C0; text-align: center;">Especifique</td>
                    <td>P&oacute;lipos</td>
                    <td colspan="2" rowspan="1" style="text-align: center;">S&iacute;<span id="poliposSiSpan">
                            <?php
                            if ($resultados[7]->{414}->RESPUESTA == "Sí") {
                                echo "( x )";
                            } else {
                                echo "( )";
                            }
                            ?>
                        </span> No<span id="poliposNoSpan">
                            <?php
                            if ($resultados[7]->{414}->RESPUESTA == "No") {
                                echo "( x )";
                            } else {
                                echo "( )";
                            }
                            ?>
                        </span></td>
                    <td colspan="2" rowspan="1"><span id="poliposEspecifiqueSpan">
                            <?php
                            if (isset($resultados[7]->{414}->OBSERVACIONES)) {
                                echo $resultados[7]->{414}->OBSERVACIONES;
                            }
                            ?>
                        </span></td>
                </tr>
                <tr>
                    <td>Cilíndrico</td>
                    <td class="cent"><span id="cilindricoNormalSpan">
                            <?php
                            if ($resultados[7]->{23}->RESPUESTA == "Normal") {
                                echo "x";
                            }
                            ?>
                        </span></td>
                    <td class="cent"><span id="cilindricoAnormalSpan">
                            <?php
                            if ($resultados[7]->{23}->RESPUESTA == "Anormal") {
                                echo "x";
                            }
                            ?>
                        </span></td>
                    <td class="cent" colspan="2" rowspan="1"><span id="cilindricoEspecifiqueSpan">
                            <?php
                            if (isset($resultados[7]->{23}->OBSERVACIONES)) {
                                echo $resultados[7]->{23}->OBSERVACIONES;
                            }
                            ?>
                        </span></td>
                    <td>Septum</td>
                    <td class="cent"><span id="septumNormalSpan">
                            <?php
                            if ($resultados[7]->{415}->RESPUESTA == "Normal") {
                                echo "x";
                            }
                            ?>
                        </span></td>
                    <td class="cent"><span id="septumAnormalSpan">
                            <?php
                            if ($resultados[7]->{415}->RESPUESTA == "Anormal") {
                                echo "x";
                            }
                            ?>
                        </span></td>
                    <td colspan="2" rowspan="1"><span id="septumEspecifiqueSpan">
                            <?php
                            if (isset($resultados[7]->{415}->OBSERVACIONES)) {
                                echo $resultados[7]->{415}->OBSERVACIONES;
                            }
                            ?>
                        </span></td>
                </tr>
                <tr>
                    <td>Tráquea</td>
                    <td class="cent"><span id="traqueaNormalSpan">
                            <?php
                            if ($resultados[7]->{24}->RESPUESTA == "Normal") {
                                echo "x";
                            }
                            ?>
                        </span></td>
                    <td class="cent"><span id="traqueaAnormalSpan">
                            <?php
                            if ($resultados[7]->{24}->RESPUESTA == "Anormal") {
                                echo "x";
                            }
                            ?>
                        </span></td>
                    <td class="cent" colspan="2" rowspan="1"><span id="traqueaEspecifiqueSpan">
                            <?php
                            if (isset($resultados[7]->{24}->OBSERVACIONES)) {
                                echo $resultados[7]->{24}->OBSERVACIONES;
                            }
                            ?>
                        </span></td>
                    <td style="font-weight: bold; background-color: #C0C0C0;">OIDOS</td>
                    <td style="background-color: #C0C0C0; text-align: center;">Der.</td>
                    <td style="background-color: #C0C0C0; text-align: center;">Izq.</td>
                    <td colspan="2" rowspan="1" style="background-color: #C0C0C0; text-align: center;">Especifique</td>
                </tr>
                <tr>
                    <td style="vertical-align: middle;">Movilidad</td>
                    <td class="cent"><span id="movilidadNormalSpan">
                            <?php
                            if ($resultados[7]->{25}->RESPUESTA == "Normal") {
                                echo "x";
                            }
                            ?>
                        </span></td>
                    <td class="cent"><span id="movilidadAnormalSpan">
                            <?php
                            if ($resultados[7]->{25}->RESPUESTA == "Anormal") {
                                echo "x";
                            }
                            ?>
                        </span></td>
                    <td class="cent" colspan="2" rowspan="1"><span id="movilidadEspecifiqueSpan">
                            <?php
                            if (isset($resultados[7]->{25}->OBSERVACIONES)) {
                                echo $resultados[7]->{25}->OBSERVACIONES;
                            }
                            ?>
                        </span></td>
                    <td style="vertical-align: middle;">Membrana T&iacute;mpano</td>
                    <td style="text-align: center; vertical-align: middle;">N<span id="membaranaTimpanoNDerSpan">
                            <?php
                            if ($resultados[7]->{516}->RESPUESTA == "Normal") {
                                echo "( x )";
                            } else {
                                echo "( )";
                            }
                            ?>
                        </span> A <span id="membranaTimpanoADerSpan">
                            <?php
                            if ($resultados[7]->{516}->RESPUESTA == "Anormal") {
                                echo "( x )";
                            } else {
                                echo "( )";
                            }
                            ?>
                        </span></td>
                    <td style="text-align: center; vertical-align: middle;">N<span id="membranaTimpanoNIzqSpan">
                            <?php
                            if ($resultados[7]->{616}->RESPUESTA == "Normal") {
                                echo "( x )";
                            } else {
                                echo "( )";
                            }
                            ?>
                        </span> A <span id="membranaTimpanoAIzqSpan">
                            <?php
                            if ($resultados[7]->{616}->RESPUESTA == "Anormal") {
                                echo "( x )";
                            } else {
                                echo "( )";
                            }
                            ?>
                        </span></td>
                    <td colspan="2" rowspan="1"><span id="membranaTimpanoEspecifiqueSpan">
                            <?php
                            if (isset($resultados[7]->{516}->OBSERVACIONES) || isset($resultados[7]->{616}->OBSERVACIONES)) {
                                echo (isset($resultados[7]->{516}->OBSERVACIONES) ? $resultados[7]->{516}->OBSERVACIONES : '') . ' ' . (isset($resultados[7]->{616}->OBSERVACIONES) ? $resultados[7]->{616}->OBSERVACIONES : '');
                            }
                            ?>
                        </span></td>
                </tr>
                <tr>
                    <td style="background-color: #E6B8B7; vertical-align: middle;">Ganglios/ Tiroides</td>
                    <td style="text-align: center; vertical-align: middle;">S&iacute;<span id="ganglTiroSiSpan">
                            <?php
                            if ($resultados[7]->{225}->RESPUESTA == "Sí") {
                                echo "( x )";
                            } else {
                                echo "( )";
                            }
                            ?>
                        </span></td>
                    <td style="text-align: center; vertical-align: middle;">No<span id="ganglTiroNoSpan">
                            <?php
                            if ($resultados[7]->{225}->RESPUESTA == "No") {
                                echo "( x )";
                            } else {
                                echo "( )";
                            }
                            ?>
                        </span></td>
                    <td colspan="2" rowspan="1"><span id="ganglTiroEspecifiqueSpan">
                            <?php
                            if (isset($resultados[7]->{225}->OBSERVACIONES)) {
                                echo $resultados[7]->{225}->OBSERVACIONES;
                            }
                            ?>
                        </span></td>
                    <td style="vertical-align: middle;">Conducto Aud Ext</td>
                    <td style="text-align: center; vertical-align: middle;">N<span id="conducAudExtNDerSpan">
                            <?php
                            if ($resultados[7]->{517}->RESPUESTA == "Normal") {
                                echo "( x )";
                            } else {
                                echo "( )";
                            }
                            ?>
                        </span> A <span id="conducAudExtADerSpan">
                            <?php
                            if ($resultados[7]->{517}->RESPUESTA == "Anormal") {
                                echo "( x )";
                            } else {
                                echo "( )";
                            }
                            ?>
                        </span></td>
                    <td style="text-align: center; vertical-align: middle;">N<span id="conducAudExtNIzqSpan">
                            <?php
                            if ($resultados[7]->{617}->RESPUESTA == "Normal") {
                                echo "( x )";
                            } else {
                                echo "( )";
                            }
                            ?>
                        </span> A <span id="conducAudExtAIzqSpan">
                            <?php
                            if ($resultados[7]->{617}->RESPUESTA == "Anormal") {
                                echo "( x )";
                            } else {
                                echo "( )";
                            }
                            ?>
                        </span></td>
                    <td colspan="2" rowspan="1"><span id="conducAudExtEspecifiqueSpan">
                            <?php
                            if (isset($resultados[7]->{517}->OBSERVACIONES) || isset($resultados[7]->{617}->OBSERVACIONES)) {
                                echo (isset($resultados[7]->{517}->OBSERVACIONES) ? $resultados[7]->{517}->OBSERVACIONES : '') . ' ' . (isset($resultados[7]->{617}->OBSERVACIONES) ? $resultados[7]->{617}->OBSERVACIONES : '');
                            }
                            ?>
                        </span></td>
                </tr>
                <tr>
                    <td style="font-weight: bold; background-color: #C0C0C0; vertical-align: middle;">OJOS</td>
                    <td style="background-color: #C0C0C0; text-align: center; vertical-align: middle;">Der.</td>
                    <td style="background-color: #C0C0C0; text-align: center; vertical-align: middle;">Izq.</td>
                    <td colspan="2" rowspan="1" style="background-color: #C0C0C0; text-align: center; vertical-align: middle;">Especifique</td>
                    <td style="vertical-align: middle;">Pabell&oacute;n Auricular</td>
                    <td style="text-align: center; vertical-align: middle;">N<span id="pabAuricNDerSpan">
                            <?php
                            if ($resultados[7]->{518}->RESPUESTA == "Normal") {
                                echo "( x )";
                            } else {
                                echo "( )";
                            }
                            ?>
                        </span> A <span id="pabAuricADerSpan">
                            <?php
                            if ($resultados[7]->{518}->RESPUESTA == "Anormal") {
                                echo "( x )";
                            } else {
                                echo "( )";
                            }
                            ?>
                        </span></td>
                    <td style="text-align: center; vertical-align: middle;">N<span id="pabAuricNIzqSpan">
                            <?php
                            if ($resultados[7]->{618}->RESPUESTA == "Normal") {
                                echo "( x )";
                            } else {
                                echo "( )";
                            }
                            ?>
                        </span> A <span id="pabAuricAIzqSpan">
                            <?php
                            if ($resultados[7]->{618}->RESPUESTA == "Anormal") {
                                echo "( x )";
                            } else {
                                echo "( )";
                            }
                            ?>
                        </span></td>
                    <td colspan="2" rowspan="1"><span id="pabAuricEspecifiqueSpan">
                            <?php
                            if (isset($resultados[7]->{518}->OBSERVACIONES) || isset($resultados[7]->{618}->OBSERVACIONES)) {
                                echo (isset($resultados[7]->{518}->OBSERVACIONES) ? $resultados[7]->{518}->OBSERVACIONES : '') . ' ' . (isset($resultados[7]->{618}->OBSERVACIONES) ? $resultados[7]->{618}->OBSERVACIONES : '');
                            }
                            ?>
                        </span></td>
                </tr>
                <tr>
                    <td style="vertical-align: middle;">Pupila</td>
                    <td style="text-align: center; vertical-align: middle;">N<span id="pupilaNDerSpan">
                            <?php
                            if ($resultados[7]->{36}->RESPUESTA == "Normal") {
                                echo "( x )";
                            } else {
                                echo "( )";
                            }
                            ?>
                        </span> A <span id="pupilaADerSpan">
                            <?php
                            if ($resultados[7]->{36}->RESPUESTA == "Anormal") {
                                echo "( x )";
                            } else {
                                echo "( )";
                            }
                            ?>
                        </span></td>
                    <td style="text-align: center; vertical-align: middle;">N<span id="pupilaNIzqSpan">
                            <?php
                            if ($resultados[7]->{86}->RESPUESTA == "Normal") {
                                echo "( x )";
                            } else {
                                echo "( )";
                            }
                            ?>
                        </span> A <span id="pupilaAIzqSpan">
                            <?php
                            if ($resultados[7]->{86}->RESPUESTA == "Anormal") {
                                echo "( x )";
                            } else {
                                echo "( )";
                            }
                            ?>
                        </span></td>
                    <td colspan="2" rowspan="1"><span id="pupilaEspecifiqueSpan">
                            <?php
                            if (isset($resultados[7]->{36}->OBSERVACIONES) || isset($resultados[7]->{86}->OBSERVACIONES)) {
                                echo (isset($resultados[7]->{36}->OBSERVACIONES) ? $resultados[7]->{36}->OBSERVACIONES : '') . ' ' . (isset($resultados[7]->{86}->OBSERVACIONES) ? $resultados[7]->{86}->OBSERVACIONES : '');
                            }
                            ?>
                        </span></td>
                    <td style="font-weight: bold; background-color: #C0C0C0;">CAVIDAD ORAL</td>
                    <td style="background-color: #C0C0C0; text-align: center;">Normal</td>
                    <td style="background-color: #C0C0C0; text-align: center;">Anormal</td>
                    <td colspan="2" rowspan="1" style="background-color: #C0C0C0; text-align: center;">Especifique</td>
                </tr>
                <tr>
                    <td style="vertical-align: middle;">C&oacute;rnea</td>
                    <td style="text-align: center; vertical-align: middle;">N<span id="corneaNDerSpan">
                            <?php
                            if ($resultados[7]->{37}->RESPUESTA == "Normal") {
                                echo "( x )";
                            } else {
                                echo "( )";
                            }
                            ?>
                        </span> A <span id="corneaADerSpan">
                            <?php
                            if ($resultados[7]->{37}->RESPUESTA == "Anormal") {
                                echo "( x )";
                            } else {
                                echo "( )";
                            }
                            ?>
                        </span></td>
                    <td style="text-align: center; vertical-align: middle;">N<span id="corneaNIzqSpan">
                            <?php
                            if ($resultados[7]->{87}->RESPUESTA == "Normal") {
                                echo "( x )";
                            } else {
                                echo "( )";
                            }
                            ?>
                        </span> A <span id="corneaAIzqSpan">
                            <?php
                            if ($resultados[7]->{87}->RESPUESTA == "Anormal") {
                                echo "( x )";
                            } else {
                                echo "( )";
                            }
                            ?>
                        </span></td>
                    <td colspan="2" rowspan="1"><span id="corneaEspecifiqueSpan">
                            <?php
                            if (isset($resultados[7]->{37}->OBSERVACIONES) || isset($resultados[7]->{87}->OBSERVACIONES)) {
                                echo (isset($resultados[7]->{37}->OBSERVACIONES) ? $resultados[7]->{37}->OBSERVACIONES : '') . ' ' . (isset($resultados[7]->{87}->OBSERVACIONES) ? $resultados[7]->{87}->OBSERVACIONES : '');
                            }
                            ?>
                        </span></td>
                    <td>Enc&iacute;as</td>
                    <td class="cent"><span id="enciasNormalSpan">
                            <?php
                            if ($resultados[7]->{719}->RESPUESTA == "Normal") {
                                echo "x";
                            }
                            ?>
                        </span></td>
                    <td class="cent"><span id="enciasAnormalSpan">
                            <?php
                            if ($resultados[7]->{719}->RESPUESTA == "Anormal") {
                                echo "x";
                            }
                            ?>
                        </span></td>
                    <td colspan="2" rowspan="1"><span id="enciasEspecifiqueSpan">
                            <?php
                            if (isset($resultados[7]->{719}->OBSERVACIONES)) {
                                echo $resultados[7]->{719}->OBSERVACIONES;
                            }
                            ?>
                        </span></td>
                </tr>
                <tr>
                    <td style="background-color: #E6B8B7; vertical-align: middle;">Agudeza Visual (sin lentes)</td>
                    <td style="background-color: #E6B8B7; vertical-align: middle; text-align: center;"><span id="agudViDSinSpan">
                            <?php echo $resultados[7]->{378}->OBSERVACIONES; ?>
                        </span></td>
                    <td style="background-color: #E6B8B7; vertical-align: middle; text-align: center;"><span id="agudViISinSpan">
                            <?php echo $resultados[7]->{878}->OBSERVACIONES; ?>
                        </span></td>
                    <td colspan="2" rowspan="1" style="background-color: #E6B8B7;"><span id="agudViSinEspecifiqueSpan">
                            <?php
                            
                            ?>
                        </span></td>
                    <td style="vertical-align: middle;">Mucosa</td>
                    <td class="cent"><span id="mucosaNormalSpan">
                            <?php
                            if ($resultados[7]->{712}->RESPUESTA == "Normal") {
                                echo "x";
                            }
                            ?>
                        </span></td>
                    <td class="cent"><span id="mucosaAnormalSpan">
                            <?php
                            if ($resultados[7]->{712}->RESPUESTA == "Anormal") {
                                echo "x";
                            }
                            ?>
                        </span></td>
                    <td colspan="2" rowspan="1"><span id="mucosaEspecifiqueSpan">
                            <?php
                            if (isset($resultados[7]->{712}->OBSERVACIONES)) {
                                echo $resultados[7]->{712}->OBSERVACIONES;
                            }
                            ?>
                        </span></td>
                </tr>
                <tr>
                    <td style="background-color: #E6B8B7; vertical-align: middle;">Agudeza Visual (con lentes)</td>
                    <td style="background-color: #E6B8B7; vertical-align: middle; text-align: center;"><span id="agudViDConSpan">
                            <?php
                            // if (isset($resultados[9]->CON_OD)) {
                            //     echo $resultados[9]->CON_OD;
                            // }
                            echo $resultados[7]->{379}->OBSERVACIONES;
                            ?>
                        </span></td>
                    <td style="background-color: #E6B8B7; vertical-align: middle; text-align: center;"><span id="agudViIConSpan">
                            <?php
                            // if (isset($resultados[9]->CON_OI)) {
                            //     echo $resultados[9]->CON_OI;
                            // }
                            echo $resultados[7]->{879}->OBSERVACIONES;
                            ?>
                        </span></td>
                    <td colspan="2" rowspan="1" style="background-color: #E6B8B7;"><span id="agudViConEspecifiqueSpan">
                            <?php
                            
                            ?>
                        </span></td>
                    </span></td>
                    <td style="vertical-align: middle;">Paladar</td>
                    <td class="cent"><span id="paladarNormalSpan">
                            <?php
                            if ($resultados[7]->{720}->RESPUESTA == "Normal") {
                                echo "x";
                            }
                            ?>
                        </span></td>
                    <td class="cent"><span id="paladarAnormalSpan">
                            <?php
                            if ($resultados[7]->{720}->RESPUESTA == "Anormal") {
                                echo "x";
                            }
                            ?>
                        </span></td>
                    <td colspan="2" rowspan="1"><span id="paladarEspecifiqueSpan">
                            <?php
                            if (isset($resultados[7]->{720}->OBSERVACIONES)) {
                                echo $resultados[7]->{720}->OBSERVACIONES;
                            }
                            ?>
                        </span></td>
                </tr>
                <tr>
                    <td>Identifica Colores</td>
                    <td style="text-align: center;">S&iacute;<span id="identColSiDerSpan">
                            <?php
                            if ($resultados[7]->{38}->RESPUESTA == "Sí") {
                                echo "( x )";
                            } else {
                                echo "( )";
                            }
                            ?>
                        </span> No<span id="identColNoDerSpan">
                            <?php
                            if ($resultados[7]->{38}->RESPUESTA == "No") {
                                echo "( x )";
                            } else {
                                echo "( )";
                            }
                            ?>
                        </span></td>
                    <td style="text-align: center;">S&iacute;<span id="identColSiIzqSpan">
                            <?php
                            if ($resultados[7]->{88}->RESPUESTA == "Sí") {
                                echo "( x )";
                            } else {
                                echo "( )";
                            }
                            ?>
                        </span> No<span id="identColNoIzqSpan">
                            <?php
                            if ($resultados[7]->{88}->RESPUESTA == "No") {
                                echo "( x )";
                            } else {
                                echo "( )";
                            }
                            ?>
                        </span></td>
                    <td colspan="2" rowspan="1"><span id="identColEspecifiqueSpan">
                            <?php
                            if (isset($resultados[7]->{38}->OBSERVACIONES) || isset($resultados[7]->{88}->OBSERVACIONES)) {
                                echo (isset($resultados[7]->{38}->OBSERVACIONES) ? $resultados[7]->{38}->OBSERVACIONES : '') . ' ' . (isset($resultados[7]->{88}->OBSERVACIONES) ? $resultados[7]->{88}->OBSERVACIONES : '');
                            }
                            ?>
                        </span></td>
                    <td>Lengua</td>
                    <td class="cent"><span id="lenguaNormalSpan">
                            <?php
                            if ($resultados[7]->{721}->RESPUESTA == "Normal") {
                                echo "x";
                            }
                            ?>
                        </span></td>
                    <td class="cent"><span id="lenguaAnormalSpan">
                            <?php
                            if ($resultados[7]->{721}->RESPUESTA == "Anormal") {
                                echo "x";
                            }
                            ?>
                        </span></td>
                    <td colspan="2" rowspan="1"><span id="lenguaEspecifiqueSpan">
                            <?php
                            if (isset($resultados[7]->{721}->OBSERVACIONES)) {
                                echo $resultados[7]->{721}->OBSERVACIONES;
                            }
                            ?>
                        </span></td>
                </tr>
                <tr>
                    <td>Movimiento Ocular</td>
                    <td style="text-align: center;">N<span id="movOculNDerSpan">
                            <?php
                            if ($resultados[7]->{39}->RESPUESTA == "Normal") {
                                echo "( x )";
                            } else {
                                echo "( )";
                            }
                            ?>
                        </span> A <span id="movOculADerSpan">
                            <?php
                            if ($resultados[7]->{39}->RESPUESTA == "Anormal") {
                                echo "( x )";
                            } else {
                                echo "( )";
                            }
                            ?>
                        </span></td>
                    <td style="text-align: center;">N<span id="movOculNIzqSpan">
                            <?php
                            if ($resultados[7]->{89}->RESPUESTA == "Normal") {
                                echo "( x )";
                            } else {
                                echo "( )";
                            }
                            ?>
                        </span> A <span id="movOculAIzqSpan">
                            <?php
                            if ($resultados[7]->{89}->RESPUESTA == "Anormal") {
                                echo "( x )";
                            } else {
                                echo "( )";
                            }
                            ?>
                        </span></td>
                    <td colspan="2" rowspan="1"><span id="movOculEspecifiqueSpan">
                            <?php
                            if (isset($resultados[7]->{39}->OBSERVACIONES) || isset($resultados[7]->{89}->OBSERVACIONES)) {
                                echo (isset($resultados[7]->{39}->OBSERVACIONES) ? $resultados[7]->{39}->OBSERVACIONES : '') . ' ' . (isset($resultados[7]->{89}->OBSERVACIONES) ? $resultados[7]->{89}->OBSERVACIONES : '');
                            }
                            ?>
                        </span></td>
                    <td>Am&iacute;gdalas</td>
                    <td class="cent"><span id="amigdalasNormalSpan">
                            <?php
                            if ($resultados[7]->{722}->RESPUESTA == "Normal") {
                                echo "x";
                            }
                            ?>
                        </span></td>
                    <td class="cent"><span id="amigdalasAnormalSpan">
                            <?php
                            if ($resultados[7]->{722}->RESPUESTA == "Anormal") {
                                echo "x";
                            }
                            ?>
                        </span></td>
                    <td colspan="2" rowspan="1"><span id="amigdalasEspecifiqueSpan">
                            <?php
                            if (isset($resultados[7]->{722}->OBSERVACIONES)) {
                                echo $resultados[7]->{722}->OBSERVACIONES;
                            }
                            ?>
                        </span></td>
                </tr>
                <tr>
                    <td>Reflejos Oculares</td>
                    <td style="text-align: center;">N<span id="refOculNDerSpan">
                            <?php
                            if ($resultados[7]->{310}->RESPUESTA == "Normal") {
                                echo "( x )";
                            } else {
                                echo "( )";
                            }
                            ?>
                        </span> A <span id="refOculADerSpan">
                            <?php
                            if ($resultados[7]->{310}->RESPUESTA == "Anormal") {
                                echo "( x )";
                            } else {
                                echo "( )";
                            }
                            ?>
                        </span></td>
                    <td style="text-align: center;">N<span id="refOculNIzqSpan">
                            <?php
                            if ($resultados[7]->{810}->RESPUESTA == "Normal") {
                                echo "( x )";
                            } else {
                                echo "( )";
                            }
                            ?>
                        </span> A <span id="refOculAIzqSpan">
                            <?php
                            if ($resultados[7]->{810}->RESPUESTA == "Anormal") {
                                echo "( x )";
                            } else {
                                echo "( )";
                            }
                            ?>
                        </span></td>
                    <td colspan="2" rowspan="1"><span id="refOculEspecifiqueSpan">
                            <?php
                            if (isset($resultados[7]->{310}->OBSERVACIONES) || isset($resultados[7]->{810}->OBSERVACIONES)) {
                                echo (isset($resultados[7]->{310}->OBSERVACIONES) ? $resultados[7]->{310}->OBSERVACIONES : '') . ' ' . (isset($resultados[7]->{810}->OBSERVACIONES) ? $resultados[7]->{810}->OBSERVACIONES : '');
                            }
                            ?>
                        </span></td>
                    <td>Dentadura</td>
                    <td class="cent"><span id="dentaduraNormalSpan">
                            <?php
                            if ($resultados[7]->{723}->RESPUESTA == "Normal") {
                                echo "x";
                            }
                            ?>
                        </span></td>
                    <td class="cent"><span id="dentaduraAnormalSpan">
                            <?php
                            if ($resultados[7]->{723}->RESPUESTA == "Anormal") {
                                echo "x";
                            }
                            ?>
                        </span></td>
                    <td colspan="2" rowspan="1"><span id="dentaduraEspecifiqueSpan">
                            <?php
                            if (isset($resultados[7]->{723}->OBSERVACIONES)) {
                                echo $resultados[7]->{723}->OBSERVACIONES;
                            }
                            ?>
                        </span></td>
                </tr>
                <tr>
                    <td>Pterigión</td>
                    <td style="text-align: center;">S&iacute;<span id="pterigionSiDerSpan">
                            <?php
                            if ($resultados[7]->{311}->RESPUESTA == "Sí") {
                                echo "( x )";
                            } else {
                                echo "( )";
                            }
                            ?>
                        </span> No<span id="pterigionNoDerSpan">
                            <?php
                            if ($resultados[7]->{311}->RESPUESTA == "No") {
                                echo "( x )";
                            } else {
                                echo "( )";
                            }
                            ?>
                        </span></td>
                    <td style="text-align: center;">S&iacute;<span id="pterigionSiIzqSpan">
                            <?php
                            if ($resultados[7]->{811}->RESPUESTA == "Sí") {
                                echo "( x )";
                            } else {
                                echo "( )";
                            }
                            ?>
                        </span> No<span id="pterigionNoIzqSpan">
                            <?php
                            if ($resultados[7]->{811}->RESPUESTA == "No") {
                                echo "( x )";
                            } else {
                                echo "( )";
                            }
                            ?>
                        </span></td>
                    <td colspan="2" rowspan="1"><span id="pterigionEspecifiqueSpan">
                            <?php
                            if (isset($resultados[7]->{311}->OBSERVACIONES) || isset($resultados[7]->{811}->OBSERVACIONES)) {
                                echo (isset($resultados[7]->{311}->OBSERVACIONES) ? $resultados[7]->{311}->OBSERVACIONES : '') . ' ' . (isset($resultados[7]->{811}->OBSERVACIONES) ? $resultados[7]->{811}->OBSERVACIONES : '');
                            }
                            ?>
                        </span></td>
                    <td style="background-color: #E6B8B7;">Otras Lesiones</td>
                    <td colspan="4" rowspan="1"><span id="otrasLesionesEspecifiqueSpan">
                            <?php
                            if (isset($resultados[7]->{724}->OBSERVACIONES)) {
                                echo $resultados[7]->{724}->OBSERVACIONES;
                            }
                            ?>
                        </span></td>
                </tr>
        </tbody>
    </table>
</body>

</html>