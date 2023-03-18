                        <br><br>

                        <table>
                            <tbody>
                                <tr>
                                    <td class="col-der" style="border-bottom: none">
                                        <h4>
                                            DIAGNOSTICO BIOMOLECULAR S.A.de C.V. <br>
                                            Laboratorio de Análisis Clínicos <br>
                                            Resultado de Exámenes
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
                                            Laboratorio de Análisis Clínicos
                                        </h3>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table>
                            <tbody>
                                <tr>
                                    <td class="col-left" style="border-bottom: none">
                                        No. Identificación: <strong style="font-size: 12px;"> <?php echo $encabezado->FOLIO; ?> </strong>
                                    </td>
                                    <td class="col-center" style="border-bottom: none">
                                        Edad: <strong style="font-size: 12px;"> <?php echo $encabezado->EDAD < 1 ? ($encabezado->EDAD * 100) . " meses" : $encabezado->EDAD . " años"; ?></strong>
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
                                        Fecha de Toma de Muestra: <strong style="font-size: 12px;"> <?php echo $encabezado->FECHA_TOMA; ?> </strong>
                                    </td>
                                    <td class="col-center" style="border-bottom: none">
                                        Fecha de Resultado: <strong style="font-size: 12px;"><?php echo $encabezado->FECHA_RESULTADO; ?> </strong>
                                    </td>
                                    <td class="col-right" style="border-bottom: none">
                                        <!-- Tipo de Muestra: <strong>Sangre</strong> -->
                                    </td>
                                </tr>
                                <tr>
                                    <td class="col-left" style="border-bottom: none">
                                        Procedencia: <strong style="font-size: 12px;"><?php echo $encabezado->PROCEDENCIA; ?> </strong>
                                    </td>
                                </tr>
                            </tbody>
                        </table>