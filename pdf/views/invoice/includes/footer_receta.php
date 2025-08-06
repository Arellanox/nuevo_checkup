<style>
    .page-number {
    position: center;
    bottom: 0;
    text-align: center;
}
</style>
<table style="margin-top:70px">
    <tbody>
        <tr class="col-foot-two">
            <td colspan="10">
            </td>
            <td colspan="2" style="text-align: left;">
                <?php if (isset($encode_firma)) echo "<img style='position:absolute; right:25px; margin-top: -65px ' src='data:image/png;base64, " . $encode_firma . "' height='70px'> " ?>
            </td>
        </tr>
        <tr class="col-foot-three" style="font-size: 13px;">
            <td colspan="6" style="text-align: center; width: 50%; height: 50px;" id="qr">
                <!-- <a target="_blank" href="<?= $qr[0] ?>"> <img src='<?= $qr[1] ?>' alt='QR Code' width='110' height='110'> </a> -->
            </td>
            <td colspan="6" style="text-align: right; width: 50%;">
                <strong style="font-size: 12px;"><?php if (isset($footerDoctor)) echo $footerDoctor; ?></strong>
            </td>
        </tr>
    </tbody>
</table>
<!-- <hr style="margin-top: -15px; height: 0.5px; background-color: black ;"> -->
<span style="display: flex; flex-direction: column; align-items: center; text-align: center;">
    <small>
        <strong style="font-size: 9px;">Avenida José Pagés Llergo No. 150 Interior 1, Colonia Arboledas, Villahermosa Tabasco, C.P. 86079</strong> <br>
        <strong style="font-size: 9px;">Teléfonos: </strong>
        <strong style="font-size: 9px;">993 634 0250, 993 634 6245</strong>
        <strong style="font-size: 9px;">Correo electrónico:</strong>
        <strong style="font-size: 9px;color: rgb(000, 078, 089); margin-left: -1.5px; margin-right: -1.5px">resultados@</strong>
        <strong style="font-size: 9px;color: rgb(000, 078, 089); margin-left: -1.5px; margin-right: -1.5px">bimo-lab</strong>
        <strong style="font-size: 9px;color: rgb(000, 078, 089); margin-left: -1.5px; margin-right: -1.5px">.com</strong>
    </small>
    <br>
    <span class="page-number" style="font-size: 9px;">Página: <span class="page"></span></span>
</span>
<!-- Paginacion en reportes -->
<!-- <div class="page-number">Página: <span class="page"></span></div> -->

