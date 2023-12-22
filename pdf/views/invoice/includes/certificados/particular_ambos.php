<style>
    @page {
        margin: 80px 10px 94px 10px;
    }
</style>



<style>
    .body-certificado {
        padding: 10px 80px 10px 80px;
    }

    .body-certificado p {
        font-size: 15px;
    }

    .body-certificado h1 {
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
</style>


<!-- Contenedor -->
<div class="body-certificado">
    <!-- Certificado Medico -->
    <div class="certificado-medico">
        <h1 style="text-align: center;">Certificado Médico</h1>
        <div class="body" style="margin-top: 20px;">
            <p class="none-p">
                La Médico Cirujano que suscribe adscrita a ésta Institución y registrada con Cédula
                Profesional número <?php echo "7796595" ?> ante la Dirección General de Profesiones. Certifica que:
            </p>
            <p class="none-p" style="text-align: center;"> Practicó examen médico a:</p>
            <p class="none-p" style="font-weight: bold; text-decoration:underline; text-align:center;">
                <?php
                # nombre del medico
                echo "Dora Crystal Olivares Muñóz";
                ?>
            </p>
        </div>
    </div>
    <!-- Hallazgos -->
    <div class="hallazgos" style="margin-top: 30px;">
        <!-- Subtitulo -->
        <p class="center">Encontrando:</p>
        <!-- Body -->
        <div class="body">
            <div class="informacion-paciente">
                <p class="justify">
                    <?php
                    # esto no se que es xd
                    echo "Femenino de 36 años de edad, madre viva aparentemente sana, su padre falleció por
                    complicaciones de hipertensión arterial, niega ser alérgica a medicamentos, niega ser
                    fumador, refiere consumir bebidas alocholicas esporádicamente sin llegar a la embriaguez,
                    es portadora de estreñimiento; niega transfusiones sanguíneas, consumo de drogas, ni
                    limitaciones funcionales. Refiere buen estilo de vida, satisfacción personal y laboral con
                    buen ambiente del mismo.";
                    ?>
                </p>
            </div>
            <div class="signos-vitales">
                <p class="justify">
                    Signos vitales: <?php echo "T.A. 105/73mmHg, FC 69x’, FR 17x´, Temp. 35.7ºC, SpO2: 99%" ?>
                </p>
            </div>
            <div class="exploracion-fisica">
                <p class="justify">
                    <?php
                    # exploracion fisica
                    echo "A la exploración física, presentó un peso de 62.2kg, talla 158cm, IMC: 26.52kg/m2,
                    complexión delgada, cráneo simétrico, con adecuada implantación de cabello, teñido a color
                    beige, lacio y largo. Cara simétrica, sin cicatrices, conjuntiva sin alteraciones, pupilas
                    isocóricas y normorefléxicas, ambos pabellones auriculares bien implantados sin lesiones,
                    canales auditivos normales con ambas membranas timpánicas conservadas, cavidad
                    intraoral: con leve presencia de caries; tórax normolíneo con campos pulmonares ventilados
                    sin presencia de estertores o sibilancias; ruidos cardiacos rítmicos de buen tono e
                    intensidad, ambas glándulas mamarias sin lesiones y con buen aspecto de la piel, abdomen
                    plano y blando con peristalsis aumentada, sin visceromegalias, sin cicatrices, Giordano
                    negativo bilateral; extremidades integras, funcionales, normoreflexicas. Las actividades
                    dinámicas de flexión se realizaron sin problemas y sin datos de interés, su coordinación
                    motora se encuentra normal.";
                    ?>
                </p>
            </div>
        </div>
    </div>
    <div class="break"></div>
    <!--   Resultados -->
    <div class="resultados">
        <p>Los estudios complementarios presentan los siguientes resultados:</p>
        <!-- Table One  -->
        <table>
            <tr>
                <td colspan="4">Valoración oftalmológica</td>
            </tr>
            <tr>
                <td class="res">
                    Agudeza visual con
                    corrección:
                    <br>
                    OD: 20/20
                    <br>
                    OI: 20/20
                </td>
                <td class="res">
                    Visión cercana Tarjeta de
                    Rosenbaum Jaeger sin corrección
                    <br>
                    1: 20/20
                    <br>
                    Visión Cromática:
                    <?php
                    # resultado de vision cromatica
                    echo "Normal"
                    ?>
                </td>
                <td class="res">
                    Fondo de
                    Ojo:
                    <br>
                    <?php
                    # resultado de fondo de ojos
                    echo "Normal"
                    ?>
                </td>
                <td class="res">
                    Segmento Anterior
                    <?php
                    # resultado de segemento anterior
                    echo "Normal"
                    ?>
                    <br>
                    Segmento Posterior:
                    <?php
                    # resultado de segemento posterior
                    echo "Normal"
                    ?>
                </td>
            </tr>
            <tr>
                <td class="res" colspan="4">
                    IDx:
                    <?php
                    # resultado de valoracion oftalmologica
                    echo "Miopia"
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan="4">Audiometría</td>
            </tr>
            <tr>
                <td class="res" colspan="4">
                    IDx:
                    <?php
                    # resultado de audiometria
                    echo "Audición bilateral normal"
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan="4">Espirometria</td>
            </tr>
            <tr>
                <td class="res" colspan="4">
                    IDX:
                    <?php
                    # resultado de espirometria
                    echo "Espirometría normal."
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan="4">Prueba de esfuerzo</td>
            </tr>
            <tr>
                <td class="res left" colspan="4">
                    -
                    <?php
                    # resultado prueba de esfuerzo
                    echo "Prueba de esfuerzo máxima por FC y por consumo de oxígeno, negativa para isquemia miocárdica.
                    Asintomática cardiovascular. Sin arritmias"
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan="4">Rx Tele de tórax</td>
            </tr>
            <tr>
                <td class="res left" colspan="4">
                    -
                    <?php
                    # resultado rx prueba de tele de torax
                    echo "Estudio de tórax de aspecto normal."
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan="4">Rx de columna lumbar anteroposterior y lateral</td>
            </tr>
            <tr>
                <td class="res left" colspan="4">
                    -
                    <?php
                    # resultado rx columna lumbar anteroposterior y lateral
                    echo "Columna lumbar de aspecto normal.."
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan="4">Ultrasonido Abdominal</td>
            </tr>
            <tr>
                <td class="res left" colspan="4">
                    -
                    <?php
                    # resultado de ultrasonido abdominal
                    echo "Ultrasonido abdominal dentro de los parámetros normales."
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan="4">Ultrasonido Doppler Carotideo Bilateral</td>
            </tr>
            <tr>
                <td class="res left" colspan="4">
                    -
                    <?php
                    # resultado de ultrasonido doppler
                    echo "Ultrasonido doppler dentro de los parámetros normales."
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan="4">Mastrografía</td>
            </tr>
            <tr>
                <td class="res left" colspan="4">
                    <?php
                    # resultado d   e mastografia
                    echo "- Adenopatías inflamatorias en región axilar derecha. 
                    <br>
                     - Categoría Birads 2
                    "
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan="4">Citología Vaginal</td>
            </tr>
            <tr>
                <td class="res" colspan="4">
                    <?php
                    # resultado de citologia vaginal
                    echo "Extendido citológico sin alteraciones en la diferenciación celular."
                    ?>
                </td>
            </tr>
        </table>

        <!-- Table Two -->
        <table style="margin-top: 20px;">
            <tr>
                <td colspan="2">
                    Laboratorios
                </td>
            </tr>
            <tr>
                <td class="res" style="width: 50%;">Biometria Hemática</td>
                <td class="res justify">
                    <?php
                    # resultado de biometria hematica
                    echo "Normal.";
                    ?>
                </td>
            </tr>
            <tr>
                <td class="res" style="width: 50%;">Química sanguínea</td>
                <td class="res justify">
                    <?php
                    # resultado quimica sanguinea
                    echo "Glucosa 85mg/dl, Urea 37mg/dl, Bun 19.02mg/dl, Creatinina sérica 0.78
                    mg/dl, Colesterol total 169mg/dl, Triglicéridos 86mg/dl.";
                    ?>
                </td>
            </tr>
            <tr>
                <td class="res" style="width: 50%;">Perfil Tiroideo</td>
                <td class="res justify">
                    <?php
                    # resultado de perfil tiroideo
                    echo "T3 total normal,T3 libre normal, T4 total normal, T4 libre normal, TSH 4.94
                    uUI/mL.";
                    ?>

                </td>
            </tr>
            <tr>
                <td class="res" style="width: 50%;">Examen General de Orina</td>
                <td class="res justify">
                    <?php
                    # resultado de examen general de orina
                    echo "Normal."
                    ?>
                </td>
            </tr>
        </table>
    </div>
    <div class="break"></div>
    <!-- Conclusiones -->
    <div class="conclusion">
        <p class="justify">
            Por lo que, con los datos encontrados en su exploración y sus estudios, se concluye que el
            paciente cuenta con los siguientes diagnósticos: <strong>
                <?php
                # diagnostico 
                echo "SÍNDROME DEL TÚNEL DEL CARPO
                AMBAS MANOS/ HIPOTIROIDISMO SUBCLÍNICO."
                ?>
            </strong>
        </p>
        <p>
            Deberá observar las siguientes:
        </p>
        <table>
            <tr>
                <td>Recomendaciones</td>
            </tr>
            <tr>
                <td class="left">
                    <?php
                    # recomendaciones
                    echo " 1. Acudir al servicio de Fisioterapia y Rehabilitación.
                    <br>
                    2. Acudir al servicio de Endocrinología para realización de estudios de extensión.
                    <br>
                    3. Continuar con estilo de vida saludable. Realizar caminata 30 minutos 3 veces a
                    la semana.
                    <br>
                    4. Adoptar medidas de higiene de columna.
                    <br>
                    5. Valoración Médica anual"
                    ?>
                </td>
            </tr>
        </table>
        <div class="medico" style="margin-top: 50px;">
            <p class=" center">
                <strong>ATENTAMENTE:</strong>
            </p>
            <p class="none-p center">
                <strong>
                    <?php
                    # nombre de la doctora
                    echo "Dra. Beatriz Alejandra Ramos Gonzáles"
                    ?>
                </strong>
            </p>
            <p class="none-p center">
                Médico Cirujando
            </p>
            <p class="none-p center">
                Cédula profesional:
                <?php
                # cedula
                echo "77965955"
                ?>
            </p>
            <p class="none-p center">
                Certificación
                <?php
                # certificacion
                echo "NIOSH SP-000515-23"
                ?>
            </p>
        </div>
    </div>
</div>