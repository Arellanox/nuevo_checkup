<div class="paciente_info_container">
    <table class="paciente_info" cellpadding="5">
        <tr>
            <th colspan="12">
                <div style="position: relative">
                    Nombre: <div><?= $datosPaciente['NOMBRE'] ?></div>
                </div>
            </th>
        </tr>
        <tr>
            <th colspan="5">
                <div style="position: relative">
                    CURP: <div><?= $datosPaciente['CURP'] ?></div>
                </div>
            </th>
            <th colspan="4">
                <div style="position: relative">
                    Fecha de Nacimiento: <div><?= $datosPaciente['FECHA_NACIMIENTO'] ?></div>
                </div>
            </th>
            <th colspan="3">
                <div style="position: relative">
                    Edad: <div><?= $datosPaciente['EDAD'] ?></div>
                </div>
            </th>
        </tr>
        <tr>
            <th colspan="6">
                <div style="position: relative">
                    Dirección: <div><?= $datosPaciente['DIRECCION'] ?></div>
                </div>
            </th>
            <th colspan="6">
                <div style="position: relative">
                    Teléfono: <div><?= $datosPaciente['TELEFONO'] ?></div>
                </div>
            </th>
        </tr>
        <tr>
            <th colspan="6">
                <div style="position: relative">
                    Correo Electrónico: <div><?= $datosPaciente['CORREO'] ?></div>
                </div>
            </th>
            <th colspan="6">
                <div style="position: relative">
                    Sexo: <div><?= $datosPaciente['SEXO'] ?></div>
                </div>
            </th>
        </tr>
        <tr>
            <th colspan="4">
                <div style="position: relative">
                    Estado Civil: <div><?= $datosPaciente['ESTADO_CIVIL'] ?></div>
                </div>
            </th>
            <th colspan="4">
                <div style="position: relative">
                    Tipo de Sangre: <div><?= $datosPaciente['TIPO_SANGRE'] ?></div>
                </div>
            </th>
            <th colspan="4">
                <div style="position: relative">
                    Número de IMSS: <div><?= $datosPaciente['NUMERO_IMSS'] ?></div>
                </div>
            </th>
        </tr>
    </table>
</div>