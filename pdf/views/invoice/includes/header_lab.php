                        <br><br>

                        <table>
                            <tbody>
                                <tr>
                                    <td class="col-der" style="border-bottom: none; text-align: center">
                                        <h4>
                                            DIAGNOSTICO BIOMOLECULAR S.A.de C.V. <br>
                                            <?php echo $titulo; ?> <br>
                                            <?php if (isset($subtitulo)) {
                                                echo $subtitulo;
                                            } else {
                                                echo 'Resultado de examenes';
                                            }; ?>
                                        </h4>
                                    </td>
                                    <td class="col-izq" style="border-bottom: none; text-align:center;">
                                        <?php
                                        echo "<img src='data:image/png;base64, " . $encode . "' height='75' >";
                                        // echo "<img src='data:image/png;base64," . $barcode . "' height='75'>";
                                        ?>

                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table>
                            <tbody>
                                <tr>
                                    <td style="text-align: center; border-style: solid none solid none; ">
                                        <h3>
                                            <?php echo $tituloPersonales; ?>
                                        </h3>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table>
                            <tbody>
                                <tr>
                                    <td class="col-left" style="border-bottom: none">
                                        No. Identificación: <strong style="font-size: 12px;"> <?php echo $pie['folio']; ?> </strong>
                                    </td>
                                    <td class="col-center" style="border-bottom: none">
                                        Edad: <strong style="font-size: 12px;"> <?php echo $encabezado->EDAD < 1 ? ($encabezado->EDAD * 10) . " meses" : $encabezado->EDAD . " años"; ?></strong>
                                    </td>
                                    <td class="col-right" style="border-bottom: none">
                                        Sexo: <strong style="font-size: 12px;"><?php echo $encabezado->SEXO; ?> </strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="col-left" style="border-bottom: none">
                                        Nombre: <strong style="font-size: 12px;"> <?php echo $encabezado->NOMBRE; ?> </strong>
                                    </td>
                                    <td class="col-center" style="border-bottom: none">
                                        Fecha de Nacimiento: <strong style="font-size: 12px;"> <?php echo $encabezado->NACIMIENTO; ?> </strong>
                                    </td>
                                    <td class="col-right" style="border-bottom: none">
                                        <?php echo (isset($encabezado->PASAPORTE)) ? "Pasaporte: <strong style='font-size:12px'>" . $encabezado->PASAPORTE . "</strong>" : ""; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="col-left" style="border-bottom: none">
                                        Fecha de Toma de Muestra: <strong style="font-size: 12px;"> <?php echo $encabezado->FECHA_RESULTADO; ?> </strong>
                                    </td>
                                    <td class="col-center" style="border-bottom: none">
                                        Fecha de Resultado: <strong style="font-size: 12px;"> <?php echo $encabezado->FECHA_RESULTADO; ?> </strong>
                                    </td>
                                    <td class="col-right" style="border-bottom: none">
                                        <!-- Tipo de muestra -->
                                    </td>
                                </tr>
                                <tr>
                                    <td class="col-left" style="border-bottom: none">
                                        <!-- Procedencia -->
                                    </td>
                                    <td class="col-left" style="border-bottom: none">
                                        <!-- Tipo de muestra  -->
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <p style="font-size: 12px; padding-left: 3.5px; margin: -1px;">Procedencia: <strong style="font-size: 12px;"><?php echo $encabezado->PROCEDENCIA; ?> </strong></p>