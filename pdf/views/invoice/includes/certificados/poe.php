<style>
    @page {
        margin: 80px 70px 94px 70px;
    }

    .body-certificado {
        padding: 10px 30px 10px 30px;
    }

    .body-certificado p {
        font-size: 13px;
    }

    .body-certificado h1 {
        padding: none !important;
        margin: none !important;
    }

    .body-certificado h2 {
        padding: none !important;
        margin: none !important;
    }

    .body-certificado h3 {
        padding: none !important;
        margin: none !important;
    }

    .body-certificado .none-p {
        padding: none !important;
        margin: none !important;
    }

    .body-certificado .center {
        text-align: center !important;
    }

    .body-certificado .justify {
        text-align: justify !important;
    }

    .body-certificado table {
        width: 100%;
        max-width: 100%;

        caption-side: bottom;
        border-collapse: collapse;
    }

    .body-certificado th,
    .body-certificado td {
        border: 1px solid black;
        width: 100%;
        max-width: 100%;
        word-break: break-all;
    }

    .body-certificado .border {
        border: 1px solid black;
    }

    .body-certificado td {
        padding: 2px;
        font-size: 15px;
    }

    .body-certificado .res {
        font-size: 13px !important;
    }

    .body-certificado .left {
        padding-left: 30px !important;
    }

    .body-certificado .bg {
        padding: 6px;
        background-color: #e7e6e6 !important;
    }

    .body-certificado .bold {
        font-weight: bold !important;
    }

    .body-certificado .italic {
        font-style: italic !important;
    }

    .body-certificado .pb {
        padding-bottom: 20px !important;
    }

    .body-certificado .p {
        padding: 5px !important;
    }

    .body-certificado .tabla2 {
        margin-left: auto !important;
    }

    .body-certificado .bg-black {
        color: white !important;
        background-color: black !important;
    }

    .body-certificado .bg-gray {
        background-color: #757070 !important;
    }

    .body-certificado .title {
        position: absolute;
        top: -50px;
    }

    .body-certificado input {
        font-size: 13px;
        padding: none !important;
        margin: none !important;
        border: none !important;
        border-bottom: 1px solid black !important;
    }

    .body-certificado label {
        font-size: 13px;
    }

    .body-certificado .fotogragfia {
        height: 100px;
        width: 120px;
        border: 2px solid black !important;
    }

    .body-certificado .pulgares-container {
        /* margin-left: auto; */
        display: flex;
    }

    .body-certificado .pulgares {
        height: 100px;
        width: 150px;
        border: 2px solid black !important;
    }

    .body-certificado .border {
        border: 2px solid black !important;
        border-top: none !important;
    }

    .campos-rellenar table td,
    .fotografia_pulgares table td {
        border: none !important;
    }

    .body-certificado .linea {
        width: 100%;
        border-bottom: 1px solid black;
        height: 1px !important;
    }

    .body-certificado .rfc {
        height: 30px !important;
        border: 2px solid black !important;
        border-top: none !important;
    }

    .body-certificado .curp {
        height: 30px !important;
        border: 2px solid black !important;
        border-top: none !important;
    }

    .body-certificado .border-b {
        border-bottom: 2px solid black !important;
    }

    .body-certificado .border-t {
        border-top: 1px solid black !important;
    }
</style>


<!-- Body -->
<div class="body-certificado">
    <div class="subtitle">
        <h3 class="center">FICHA DE REGISTRO PARA CANDIDATOS Y PERSONAL OCUPACIONALMENTE EXPUESTO</h3>
    </div>
    <div class="body">
        <!-- Datos general del trabajador -->
        <div class="datos-trabajador" style="margin-top: 30px;">
            <h3>A.1 Datos generales del trabajador</h3>
            <div class="trabajador-body" style="margin-top: 5px;">
                <!-- Lugar y fecha -->
                <label class="none-p">Lugar y fecha:</label>
                <input type="text" value="">
                <!-- Fotografia y pulgares -->
                <div class="fotografia_pulgares" style="margin-top: 20px;">
                    <table>
                        <tr>
                            <td class="none-p">
                                <div class="fotogragfia">
                                    <p class="none-p bold center">Fotografía</p>
                                </div>
                            </td>
                            <td class="none-p" style="display: flex; justify-content:end; ">
                                <div class="pulgares">
                                </div>
                            </td>
                            <td class="none-p">
                                <div class="pulgares" style="border-left: none !important;">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>

                            </td>
                            <td class=" none-p" style="display: flex; justify-content:end; ">
                                <div class="border" style="width: 150px;">
                                    <p class="none-p bold center">Pulgar izquierdo</p>
                                </div>
                            </td>
                            <td class=" none-p">
                                <div class="border" style="width: 150px; border-left: none !important;">
                                    <p class="none-p bold center">Pulgar derecho</p>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td class="none-p" colspan="2">
                                <p class="none-p center">Huellas dactilares</p>
                            </td>
                        </tr>
                    </table>
                </div>
                <!--  datos del trabajador -->
                <div class="campos-rellenar" style="margin-top: 30px;">
                    <!-- Inputs para rellenar la informacion -->
                    <div class="inputs">
                        <table>
                            <tr>
                                <td class="none-p">
                                    <p class="none-p">Juan</p>
                                </td>
                                <td class="none-p">
                                    <p class="none-p center">Juan</p>

                                </td>
                                <td class="none-p">
                                    <p class="none-p center">Juan</p>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <!-- Linea divisora -->
                    <div class="linea"></div>
                    <!-- Labels de los inputs -->
                    <div class="labels" style="display: flex; width:100%;">
                        <table>
                            <tr>
                                <td class="none-p">
                                    <p class="none-p bold">Apellido paterno</p>
                                </td>
                                <td class="none-p">
                                    <p class="none-p bold center">Apellido materno</p>

                                </td>
                                <td class="none-p">
                                    <p class="none-p bold center" style="margin-left: 40px !important;">Nombre(s)</p>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <!-- edad y sexo -->
                <div class="campos-rellenar" style="margin-top: 20px;">
                    <!-- Inputs -->
                    <div class="inputs">
                        <table>
                            <tr>
                                <td class="none-p" style="display: flex;">
                                    <p class="none-p  center" style=" width:60px;">59 años </p>
                                </td>
                                <td class="none-p" style="width: 30%;">
                                    <p class="none-p center">
                                        <span style="margin-right: 30px;">Femenino</span>
                                        <strong>(X)</strong>
                                        <span>Masculino</span>
                                    </p>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <!-- labels -->
                    <div class="labels" style="display: flex; width:100%;">
                        <table>
                            <tr>
                                <td class="none-p" style="display: flex;">
                                    <p class="none-p bold center" style="border-top: 1px solid black; width:60px;">Edad</p>
                                </td>
                                <td class="none-p" style="width: 30%;">
                                    <p class="none-p bold center" style="border-top: 1px solid black;">Sexo</p>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <!-- lugar de nacimiento y fecha de nacimiento -->
                <div class="campos-rellenar" style="margin-top: 20px;">
                    <!-- Inputs -->
                    <div class="inputs">
                        <table>
                            <tr>
                                <td>
                                    <p class="none-p  center">Lugar de nacimiento</p>
                                </td>
                                <td>
                                    <p class="none-p center">05 / octubre /1964</p>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <!-- Labels -->
                    <div class="labels">
                        <table>
                            <tr>
                                <td>
                                    <p class="none-p bold center" style="border-top: 1px solid black !important;">Lugar de nacimiento</p>
                                </td>
                                <td>
                                    <p class="none-p bold center" style="border-top: 1px solid black !important;">Fecha de nacimiento (dd/mm/aaaa)</p>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <!-- RFC Y CURP -->
                <div class="campos-rellenar" style="margin-top: 20px;">
                    <!-- Inputs -->
                    <table>
                        <tr>
                            <td class="rfc"></td>
                            <td class="rfc"></td>
                            <td class="rfc"></td>
                            <td class="rfc"></td>
                            <td class="rfc"></td>
                            <td class="rfc"></td>
                            <td class="rfc"></td>
                            <td class="rfc"></td>
                            <td class="rfc"></td>
                            <td class="rfc"></td>
                            <td class="rfc"></td>
                            <td class="rfc"></td>
                            <td class="rfc"></td>
                            <td class="border-b"></td>
                            <td class="border-b"></td>
                            <td class="border-b"></td>
                            <td class="border-b"></td>
                            <td class="border-b"></td>
                            <td class="curp"></td>
                            <td class="curp"></td>
                            <td class="curp"></td>
                            <td class="curp"></td>
                            <td class="curp"></td>
                            <td class="curp"></td>
                            <td class="curp"></td>
                            <td class="curp"></td>
                            <td class="curp"></td>
                            <td class="curp"></td>
                            <td class="curp"></td>
                            <td class="curp"></td>
                            <td class="curp"></td>
                            <td class="curp"></td>
                            <td class="curp"></td>
                            <td class="curp"></td>
                            <td class="curp"></td>
                            <td class="curp"></td>
                        </tr>
                    </table>
                    <!-- Labels -->
                    <table>
                        <tr>
                            <td>
                                <p class="bold center none-p">
                                    RFC
                                </p>
                            </td>
                            <td>
                                <p class="bold center none-p">
                                    CURP
                                </p>
                            </td>
                        </tr>
                    </table>
                </div>
                <!-- Escolaridad  maxima -->
                <div class="campos-rellenar" style="margin-top: 20px;">
                    <!-- Input -->
                    <table>
                        <tr>
                            <td style="border-bottom: 1px solid black !important;">

                            </td>
                        </tr>
                    </table>
                    <!-- Labels -->
                    <table>
                        <tr>
                            <td>
                                <p class="none-p center"> Escolaridad máxima</p>
                            </td>
                        </tr>
                    </table>
                </div>
                <!-- Direccion particular -->
                <div class="campos-rellenar" style="margin-top: 10px;">
                    <p class="none-p"> Dirección particular:</p>
                    <!-- Inputs para rellenar la informacion -->
                    <div class="inputs" style="margin-top: 10px;">
                        <table>
                            <tr>
                                <td class="none-p">
                                    <p class="none-p center"></p>
                                </td>
                                <td class="none-p">
                                    <p class="none-p center"></p>

                                </td>
                                <td class="none-p">
                                    <p class="none-p center"></p>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <!-- Linea divisora -->
                    <div class="linea"></div>
                    <!-- Labels de los inputs -->
                    <div class="labels" style="display: flex; width:100%;">
                        <table>
                            <tr>
                                <td class="none-p">
                                    <p class="none-p  center">Calle</p>
                                </td>
                                <td class="none-p">
                                    <p class="none-p  center">Número</p>

                                </td>
                                <td class="none-p">
                                    <p class="none-p  center" style="margin-left: 40px !important;">Colonia</p>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <!-- Ciudad, Codigo postal, estado, telefono particular -->
                <div class="campos-rellenar" style="margin-top: 10px;">
                    <!-- Inputs -->
                    <table>
                        <tr>
                            <td class="center">
                                <p class="none-p">

                                </p>
                            </td>
                            <td class="center">
                                <p class="none-p">

                                </p>
                            </td>
                            <td class="center">
                                <p class="none-p">

                                </p>
                            </td>
                            <td class="center">
                                <p class="none-p">

                                </p>
                            </td>
                        </tr>
                    </table>
                    <!-- Label -->
                    <table>
                        <tr class="border-t">
                            <td>
                                <p class="center none-p">
                                    Ciudad
                                </p>
                            </td>
                            <td>
                                <p class="center none-p">
                                    Código Postal
                                </p>
                            </td>
                            <td>
                                <p class="center none-p">
                                    Estado
                                </p>
                            </td>
                            <td>
                                <p class="center none-p">
                                    Télefono particular
                                </p>
                            </td>
                        </tr>
                    </table>
                </div>
                <!-- Area, Cargo, Telefono de la empresa -->
                <div class="campos-rellenar" style="margin-top: 20px;">
                    <div class="area">
                        <label class="none-p">Área de trabajo propuesta:</label>
                        <input type="text" value="">
                    </div>
                    <div class="cargo" style="margin-top: 10px;">
                        <label class="none-p">Cargo propuesto:</label>
                        <input type="text" value="">
                    </div>
                    <div class="telefono_empresa" style="margin-top: 10px;">
                        <label class="none-p">Teléfono de la empresa contratante:</label>
                        <input type="text" value="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>