<?php
function convertirObjetoAArray($objeto)
{
    if (is_object($objeto)) {
        // Opción 1: Utilizar el casting
        $array_resultante = (array) $objeto;

        // Opción 2: Utilizar get_object_vars
        // $array_resultante = get_object_vars($objeto);

        return $array_resultante;
    } else {
        // Si el argumento no es un objeto, puedes manejarlo de acuerdo a tus necesidades
        return array();
    }
}

# firma del medico
$img = file_get_contents("https://i.ibb.co/GQsJwcZ/Image-005.jpg");
$encode = base64_encode($img);

# logo de bimo
$img2 = file_get_contents("https://i.ibb.co/hVmkQh6/Image-006.jpg");
$encode2 = base64_encode($img2);

$medico = array();
$cuerpo = convertirObjetoAArray($resultados[0]->CUERPO);
// $resultado = convertirObjetoAArray($resultados[0]->DATA_BASE);
$medico = convertirObjetoAArray($resultados[0]->MEDICO_INFO);
// $servicios = convertirObjetoAArray($resultado['SERVICIOS']);

echo "<pre>";
var_dump($cuerpo);
echo "</pre>";

# arreglo para rellenar el certificado con la informacion necesaria
// $slb_arreglo = array(
//     "medico" => array(
//         "nombre" => "Beatriz Alejandra Ramos González",
//         "profesion" => $medico['INFO_UNIVERSIDAD'][0]->PROFESION,
//         "cedula" => $medico['INFO_UNIVERSIDAD'][0]->CEDULA,
//         "firma" => "",
//         "especialidades" => $medico['INFO_ESPECIALIDAD'][0]->CEDULA
//     ),
//     "paciente" => array(
//         "prefijo" => "Sra",
//         "px" => "Llano Ocampo, Catalina",
//         "fecha_nacimiento" => "09/07/1983",
//         "puesto" => " PROJECT MANAGER",
//         "apto_select" => array(
//             "apto" => "Apto sin restricciones en la industria de gas y petróleo.",
//             "actividades" => null
//         ),
//         "antidopoing" => "NEGATIVO",
//         "grupo_sanguineo" => "AB +",
//         "ADD" => " Se le realizaron los siguientes estudios médicos: BHC, VSG, QS, TGO, TGP, GGT, TSH, perfil de lípidos, Antidoping de 3 elementos, EGO, CPS, Audiometría, Espirometría, Tele de Tórax, Rx AP y lateral de columna lumbar, Agudeza visual, USG abdominal, Prueba de esfuerzo y Ecocardiograma."
//     )
// );

?>

<style type="text/css">
    /* * {
        margin: 0;
        padding: 0;
        text-indent: 0;
    } */

    @page {
        margin: 40px 10px 10px 10px;
    }


    .container {
        /* border: 1px solid black; */
        /* padding: 0px 30px 50px 50px; */
        padding: 5px 30px;
    }

    .h1 {
        color: #221F1F;
        font-family: Calibri, sans-serif;
        font-style: normal;
        font-weight: bold;
        text-decoration: none;
        font-size: 16px;
    }

    p {
        color: #221F1F;
        font-family: Calibri, sans-serif;
        font-style: normal;
        font-weight: bold;
        text-decoration: none;
        font-size: 16px;
        margin: 0pt;
    }


    .a {
        color: #221F1F;
        font-family: Calibri, sans-serif;
        font-style: normal;
        font-weight: bold;
        text-decoration: none;
        font-size: 16px;
    }
</style>
<!-- Contenedor del body -->
<div class="container">
    <!-- Titulo -->
    <div class="title" style="text-align: center; margin-top:10px;">
        <p class="h1">EXAMEN MEDICO</p class="h1">
    </div>
    <!-- Cuerpo del reporte -->
    <div class="content">
        <!-- Asunto -->
        <div class="asunto" style="margin-top:30px;">
            <p class="h1">
                ASUNTO: Certificado de Aptitud
            </p class="h1">
        </div>
        <div class="informacion-medico" style="margin-top:30px;">
            <p class="h1" style="text-align:justify;">
                El Médico <?php echo $slb_arreglo['medico']['nombre'] ?>, con cedula profesional 7796595 en el registro de profesiones, certifico que el Sr. Soto Cuellar, Carlos Alfonso con fecha de nacimiento 20/10/1995, Segmento SPS en el puesto PL Job Delivery Lead se sometió a un examen médico apoyado de pruebas de laboratorio y gabinete en la fecha 12/10/2023, es medicamente:
            </p>
        </div>
        <div class="div_apto_noapto" style="margin-top: 10px">
            <p style="text-indent: 0pt;text-align: left;">
                <br />
            </p>
            <p class="s1" style="padding-top: 2pt;padding-left: 130pt;text-indent: 0pt;text-align: left;">
                <input type="checkbox" checked style="padding-top:10px;">
                <span class="p">Apto sin restricciones en la industria de gas y petróleo.</span>
            </p>
            <p class="s1" style="padding-top: 2pt;padding-left: 130pt;text-indent: 0pt;text-align: left;">
                <input type="checkbox">
                <span class="p">Apto con restricciones para las siguientes actividades: </span>
                <span class="s2">………………………………………………………………………………</span>
            </p>
            <p class="s1" style="padding-top: 2pt;padding-left: 130pt;text-indent: 0pt;text-align: left;">
                <span>
                    <input type="checkbox">
                </span>
                <span class="p">No apto para trabajar en la industria de gas y petróleo</span>
            </p>


        </div>
        <div class="antidoping" style="margin-top: 20px;">
            <p class="h1">ANTIDOPING: <br>
                <?php
                # resultado de antidoping
                echo "NEGATIVO"
                ?>
            </p class="h1">
        </div>
        <div class="grupo-sanguineo" style="margin-top: 20px;">
            <p class="h1">
                GRUPO SANGUINEO:
                <?php
                # resultados de grupos sanguineo
                echo "B+"
                ?>
            </p class="h1">
        </div>
        <div class="add" style="margin-top: 20px;">
            <p class="h1">
                ADD:
                <?php
                # no se que es ADD pero va algo xd
                echo "Se le realizaron los siguientes estudios médicos: BHC, VSG, QS, TGO, TGP GGT, perfil de lípidos, antidoping de 5 elementos, EGO, CPS, audiometría espirometría, Rayos X: tele de tórax, AP y lateral de columna lumbar y agudeza visual."
                ?>
            </p class="h1">
        </div>
        <div class="base">
            <p class="h1">
                <?php
                # no se que es pero dice que no es vulnerable, parece un resultado
                echo "Con base a la evaluación el empleado no cumple con ninguno de los criterios de vulnerabilidad publicados por
                el IMSS en julio 2020, por lo tanto; no es considerado como personal vulnerable."
                ?>
            </p class="h1">
        </div>
        <div class="informacion-medico" style="margin-top: 10px;">
            <p class="h1">
                Nombre del Medico examinador:
                <?php
                # nombre del medico
                echo "Ramos Gonzales, Beatriz Alenjandra."
                ?>
            </p class="h1">
            <p class="h1">
                Firma del Medico examinador:
            </p class="h1">
            <div class="firma-contenedor" style="
                position:relative; top:-10px;
                justify-content:center;
                text-align:center; margin:-10px
                ">
                <img src="data:image/png;base64,<?php echo $encode ?>">
            </div>
        </div>
        <div class="direccion">
            <p class="h1">
                Dirección del Medico examinador: Av. José Pagés Llergo #150 Col. Arboledas C.P. 86079 en Villahermosa, Tabasco,México.
            </p class="h1">
            <p class="h1" class="" style="margin-top: 5px;">
                Teléfono: 9936340250
            </p class="h1">
            <p class="h1" style="margin-top: 5px ;">
                Correo electrónico: hola@bimo.com.mx
            </p class="h1">
        </div>
        <div class="sello-centro-medico">
            <style>
                .sello-centro-medico {
                    position: absolute;
                    bottom: 50px;
                    left: 450px;
                    z-index: 100;
                }

                .sello-centro-medico .h1 {
                    margin-bottom: 10px !important;
                }
            </style>
            <div class="contenedor">
                <p class="h1">
                    SELLO DEL CENTRO MEDICO
                </p class="h1">
                <img src="data:image/png;base64,<?php echo $encode2 ?>">
            </div>
        </div>
    </div>
</div>