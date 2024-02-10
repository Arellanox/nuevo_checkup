<style>
.responsableEnvio, .responsableRecepcion {
    width: 100%;
    border-collapse: collapse;
    color: #054d60;
    margin-bottom: 18px;
    font-size: 12px;
}


.titulo {
    font-weight: bold;
    font-size: 12px;
    width: 120px;
    /* background-color: #f7b22b; */
}

.input-vacio {
    width: 1px; /* O puedes intentar 'padding: 0;' si quieres que sea más estrecho */
}

.top-border {
    border-top: 1px solid black;
}

.input-field {
    height: 14px;
    padding: 1px; /* Ajusta este valor según necesites */
}

.label,
.input-field {
    text-align: center;
    font-size: 12px;
}

/* Esta clase se usará para reducir el espacio alrededor del texto dentro de las celdas */
.small-padding {
    padding: 1px !important; /* O '0' si deseas que no haya espacio */
    width: 95px;
}

.medium-padding{
    padding: 1px !important;
    width: 200px;
}

.pie_pag{
    width: 100%;
    text-align: center;
    padding: 0px;
    margin: 0px;
}

</style>

<table class="responsableEnvio">
    <tr>
        <td class="titulo">Responsable del envío:</td>
        <!-- <td class="input-vacio"></td> -->

        <td class="input-field">
            <span class="content-above-line"><?php echo $resultados->RESPONSABLE_ENVIO  ?></span>
        </td>
        <td class="input-field">
            <span class="content-above-line"><?php echo $resultados->TELEFONO ?></span>
        </td>
        <td class="input-field">
            <span class="content-above-line"></span>
        </td>

    </tr>
    <tr>
        <td colspan="1" class=""></td>
        <td class="label top-border">Nombre</td>

        <td class="label top-border"># de contacto</td>

        <td class="label top-border">Firma</td>
    </tr>
</table>
<br>

<table class="responsableRecepcion">
    <tr>
        <td class="titulo">Responsable de la recepción:</td>
        <!-- <td class="input-vacio"></td> -->
        <td class="input-field medium-padding">
            <span class="content-above-line"><?php echo $resultados->RESPONSABLE_RECEPCION; ?></span>
        </td>
        <td class="input-field small-padding">
            <span class="content-above-line"><?php echo $resultados->TELEFONO_RECEPCION; ?></span>
        </td>
        <td class="input-field small-padding">
            <span class="content-above-line"><?php echo $resultados->FECHA_RECEPCION; ?></span>
        </td>
        <td class="input-field small-padding">
            <span class="content-above-line"><?php echo $resultados->HORA_RECEPCION; ?></span>
        </td>
        <td class="input-field">
            <span class="content-above-line"></span>
        </td>
    </tr>
    <tr>
        <td colspan="1" class=""></td>
        <td class="label top-border">Nombre</td>
        <td class="label top-border small-padding">Unidad</td>
        <td class="label top-border small-padding">Fecha</td>
        <td class="label top-border small-padding">Hora</td>
        <td class="label top-border">Firma</td>
    </tr>
</table>


<div class="pie_pag">
    <p style="font-size: 10px; color: #215868;"><b>Avenida José Pagés Llergo 150, Int. 1, Col. Arboledas, C.P. 86079, Villahermosa, Centro,
        Tabasco, Tel: 993 634 0250, Correo: <span style="color: #f7b22b;">hola</span><span style="color: #1699c7;">@</span>bimo.com.mx</b></p>

</div>
<!-- <p class="ubicacion" style="font-size: 1px;">
    <strong>Avenida José Pagés Llergo 150, Int. 1, Col. Arboledas, C.P. 86079, Villahermosa, Centro,
    Tabasco, Tel: 993 634 0250, Correo: hola@bimo.com.mx</strong>
</p> -->