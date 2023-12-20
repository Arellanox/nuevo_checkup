<style>
    .footer {
        position: fixed;
        bottom: -140px;
        left: -2px;
        right: 25px;
        height: 150px;
    }

    .footer-expro-text {
        font-size: 11px;
        margin-bottom: -10px;
        color: #12828f;
    }

    .p {
        position: absolute;
        top: 50px;
    }

    .container-footer-expro a {
        position: absolute;
        left: 650px;
        top: 0;
        bottom: 0px;

    }
</style>

<!-- <table style="margin: 0 auto;"> 
        <tbody>
            <tr class="col-foot-two">
                <td colspan="10" style="text-align: left !important;">
                    <p class="footer-expro-text" style="margin-top: -10px; ">Avenida José Pagés Llergo No. 150 Interior 1, Colonia Arboledas, Villahermosa Tabasco, C.P.86079</p>
                    <p class="footer-expro-text">Teléfonos: 993 634 0250,993 634 6245 Correo electrónico:resultados@bimo-lab.com</p>
                </td>
                <td class="footer-qr-expro" colspan="10">
                    <a target="_blank" href="<?= $qr[0] ?>"> <img src='<?= $qr[1] ?>' alt='QR Code' width='100' height='100'> </a>
                </td>
            </tr>
        </tbody>
    </table> -->


<div class="container-footer-expro">

    <div class="p">
        <p class="footer-expro-text" style="margin-top: -10px; ">Avenida José Pagés Llergo No. 150 Interior 1, Colonia Arboledas, Villahermosa Tabasco, C.P.86079</p>
        <p class="footer-expro-text">Teléfonos: 993 634 0250,993 634 6245 Correo electrónico:resultados@bimo-lab.com</p>
    </div>

    <a target="_blank" href="<?= $qr[0] ?>"> <img src='<?= $qr[1] ?>' alt='QR Code' width='100' height='100'> </a>
</div>