<br><br>
<table>
    <tbody>
        <tr>
            <td class="col-der" style="border-bottom: none; text-align: center">
                <h4>
                    DIAGNÓSTICO BIOMOLECULAR S.A.de C.V. <br>
                    <?= $titulo; ?><br>
                    <?php if (isset($subtitulo)) : ?>
                        <?= $subtitulo; ?>
                    <?php endif; ?>
                </h4>
            </td>
            <td class="col-izq" style="border-bottom: none; text-align:center;">
                <?= "<img src='data:image/png;base64, " . $encode . "' height='75' >"; ?>
            </td>
        </tr>
    </tbody>
</table>
<table>
    <tbody>
        <tr>
            <td style="text-align: center; border-style: solid none solid none; ">
                <table>
                    <tbody>
                        <tr>
                            <td class="col-left" colspan="6" style="border-bottom: none">
                                Folio: <strong style="font-size: 12px;"> <?= $encabezado->FOLIO; ?> </strong>
                            </td>
                            <td class="col-right" colspan="6" style="border-bottom: none">
                                Responsable: <strong style="font-size: 12px;"><?= $encabezado->RESPONSABLE; ?> </strong>
                            </td>
                            <td class="col-center" colspan="6" style="border-bottom: none">
                                Estado: <strong style="font-size: 12px;"> <?= ($encabezado->ESTADO) ?: 'Sin Estado' ?></strong>
                            </td>
                            <td class="col-center" colspan="6" style="border-bottom: none">
                                Fecha de Creación: <strong style="font-size: 12px;"> <?= $encabezado->CREACION; ?> </strong>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </tbody>
</table>