<style>
    .page-number {
        position: center;
        bottom: 0;
        text-align: center;
    }
    .firma{
        position: relative;
        margin-top: 10px;
        margin-bottom: 10px;
    }
    .firma .detalles{
        font-size: 13px;
        margin: 0;
        margin-top: -2px;
        text-align: center;
        font-weight: 700;
    }
</style>
<div class="firma" style="position: relative;">
    <p class="detalles"><?= isset($footerDoctor) ? $footerDoctor : 'Dr. Nombre del doctor' ?></p>
    <p class="detalles">Cédula profesional: <?= isset($cedula) ? $cedula : '########' ?></p>
    <p class="detalles">Certificación NIOSH SP-000515-23</p>
    <?= isset($encode_firma) ? "<img style='position:absolute; right:200px; margin-top: -70px ' src='data:image/png;base64, " . $encode_firma . "' height='90px'> " : '' ?>
</div>
<hr style="margin-top: 0px; height: 0.5px; background-color: black ;">
<p style="text-align: center;">
    <small>
        <strong style="font-size: 11px;">Avenida José Pagés Llergo No. 150 Interior 1, Colonia Arboledas, Villahermosa Tabasco, C.P. 86079</strong> <br>
        <strong style="font-size: 11px;">Teléfonos: </strong>
        <strong style="font-size: 11px;">993 634 0250, 993 634 6245</strong>
        <strong style="font-size: 11px;">Correo electrónico:</strong>
        <strong style="font-size: 11px;color: rgb(000, 078, 089); margin-left: -1.5px; margin-right: -1.5px">resultados@</strong>
        <strong style="font-size: 11px;color: rgb(000, 078, 089); margin-left: -1.5px; margin-right: -1.5px">bimo-lab</strong>
        <strong style="font-size: 11px;color: rgb(000, 078, 089); margin-left: -1.5px; margin-right: -1.5px">.com</strong>
    </small>
</p>

<!-- Paginacion en reportes -->
<div class="page-number">Página: <span class="page"></span></div>