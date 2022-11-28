<?php
    require '../clases/master_class.php';
    require '../pdf/class/Pdf.php';

    require_once '../pdf/class/View.php';

    $api = $_POST['api'];
    $array = array(
    "folio"     => "007",
    "nombre"    => "Menganito paciente",
    "estudios"  => array(
        array(
            "clave"     => "EGO0",
            "recipiente"=> "TUBO ROJO"
        ),
        array(
            "clave"     => "BH00",
            "recipiente"=> "TUBO AZUL"
        ),
        array(
            "clave"     => "QS6",
            "recipiente"=> "TUBO GRIS"
        )
    ),
    "areas"         => array(
        array(
            "area"      => "hematologia",
            "estudios"  => array(
                array(
                    "estudio"   => "EXAMEN GENERAL DE ORINA",
                    "analitos"  => array(
                        array(
                            "clave"         => "AN01",
                            "nombre"        => "Hemoglobina glucosilada",
                            "unidad"        => "ml/Dl",
                            "resultado"     => "14",
                            "referencia"    => "10 - 26",
                        ),
                        array(
                            "clave"         => "AN01",
                            "nombre"        => "Hemoglobina glucosilada",
                            "unidad"        => "ml/Dl",
                            "resultado"     => "14",
                            "referencia"    => "10 - 26",
                        ),
                        array(
                            "clave"         => "AN01",
                            "nombre"        => "Hemoglobina glucosilada",
                            "unidad"        => "ml/Dl",
                            "resultado"     => "14",
                            "referencia"    => "10 - 26",
                        ),
                        array(
                            "clave"         => "AN01",
                            "nombre"        => "Hemoglobina glucosilada",
                            "unidad"        => "ml/Dl",
                            "resultado"     => "14",
                            "referencia"    => "10 - 26",
                        ),
                        array(
                            "clave"         => "AN01",
                            "nombre"        => "Hemoglobina glucosilada",
                            "unidad"        => "ml/Dl",
                            "resultado"     => "14",
                            "referencia"    => "10 - 26",
                        ),
                        array(
                            "clave"         => "AN01",
                            "nombre"        => "Hemoglobina glucosilada",
                            "unidad"        => "ml/Dl",
                            "resultado"     => "14",
                            "referencia"    => "10 - 26",
                        ),
                        array(
                            "clave"         => "AN01",
                            "nombre"        => "Hemoglobina glucosilada",
                            "unidad"        => "ml/Dl",
                            "resultado"     => "14",
                            "referencia"    => "10 - 26",
                        ),
                        array(
                            "clave"         => "AN01",
                            "nombre"        => "Hemoglobina glucosilada",
                            "unidad"        => "ml/Dl",
                            "resultado"     => "14",
                            "referencia"    => "10 - 26",
                        ),
                        array(
                            "clave"         => "AN01",
                            "nombre"        => "Hemoglobina glucosilada",
                            "unidad"        => "ml/Dl",
                            "resultado"     => "14",
                            "referencia"    => "10 - 26",
                        ),
                        array(
                            "clave"         => "AN01",
                            "nombre"        => "Hemoglobina glucosilada",
                            "unidad"        => "ml/Dl",
                            "resultado"     => "14",
                            "referencia"    => "10 - 26",
                        ),
                        array(
                            "clave"         => "AN01",
                            "nombre"        => "Hemoglobina glucosilada",
                            "unidad"        => "ml/Dl",
                            "resultado"     => "14",
                            "referencia"    => "10 - 26",
                        ),
                        array(
                            "clave"         => "AN01",
                            "nombre"        => "Hemoglobina glucosilada",
                            "unidad"        => "ml/Dl",
                            "resultado"     => "14",
                            "referencia"    => "10 - 26",
                        ),
                        array(
                            "clave"         => "AN01",
                            "nombre"        => "Hemoglobina glucosilada",
                            "unidad"        => "ml/Dl",
                            "resultado"     => "14",
                            "referencia"    => "10 - 26",
                        ),
                        array(
                            "clave"         => "AN01",
                            "nombre"        => "Hemoglobina glucosilada",
                            "unidad"        => "ml/Dl",
                            "resultado"     => "14",
                            "referencia"    => "10 - 26",
                        ),
                        array(
                            "clave"         => "AN01",
                            "nombre"        => "Hemoglobina glucosilada",
                            "unidad"        => "ml/Dl",
                            "resultado"     => "14",
                            "referencia"    => "10 - 26",
                        ),
                        array(
                            "clave"         => "AN01",
                            "nombre"        => "Hemoglobina glucosilada",
                            "unidad"        => "ml/Dl",
                            "resultado"     => "14",
                            "referencia"    => "10 - 26",
                        ),
                        array(
                            "clave"         => "AN01",
                            "nombre"        => "Hemoglobina glucosilada",
                            "unidad"        => "ml/Dl",
                            "resultado"     => "14",
                            "referencia"    => "10 - 26",
                        ),
                        array(
                            "clave"         => "AN01",
                            "nombre"        => "Hemoglobina glucosilada",
                            "unidad"        => "ml/Dl",
                            "resultado"     => "14",
                            "referencia"    => "10 - 26",
                        ),
                        array(
                            "clave"         => "AN01",
                            "nombre"        => "Hemoglobina glucosilada",
                            "unidad"        => "ml/Dl",
                            "resultado"     => "14",
                            "referencia"    => "10 - 26",
                        ),
                        array(
                            "clave"         => "AN01",
                            "nombre"        => "Hemoglobina glucosilada",
                            "unidad"        => "ml/Dl",
                            "resultado"     => "14",
                            "referencia"    => "10 - 26",
                        ),
                        array(
                            "clave"         => "AN01",
                            "nombre"        => "Hemoglobina glucosilada",
                            "unidad"        => "ml/Dl",
                            "resultado"     => "14",
                            "referencia"    => "10 - 26",
                        ),
                        array(
                            "clave"         => "AN01",
                            "nombre"        => "Hemoglobina glucosilada",
                            "unidad"        => "ml/Dl",
                            "resultado"     => "14",
                            "referencia"    => "10 - 26",
                        ),
                        array(
                            "clave"         => "AN01",
                            "nombre"        => "Hemoglobina glucosilada",
                            "unidad"        => "ml/Dl",
                            "resultado"     => "14",
                            "referencia"    => "10 - 26",
                        ),
                        array(
                            "clave"         => "AN01",
                            "nombre"        => "Hemoglobina glucosilada",
                            "unidad"        => "ml/Dl",
                            "resultado"     => "14",
                            "referencia"    => "10 - 26",
                        ),
                        array(
                            "clave"         => "AN01",
                            "nombre"        => "Hemoglobina glucosilada",
                            "unidad"        => "ml/Dl",
                            "resultado"     => "14",
                            "referencia"    => "10 - 26",
                        ),
                        array(
                            "clave"         => "AN01",
                            "nombre"        => "Hemoglobina glucosilada",
                            "unidad"        => "ml/Dl",
                            "resultado"     => "14",
                            "referencia"    => "10 - 26",
                        ),
                        array(
                            "clave"         => "AN01",
                            "nombre"        => "Hemoglobina glucosilada",
                            "unidad"        => "ml/Dl",
                            "resultado"     => "14",
                            "referencia"    => "10 - 26",
                        ),
                        array(
                            "clave"         => "AN01",
                            "nombre"        => "Hemoglobina glucosilada",
                            "unidad"        => "ml/Dl",
                            "resultado"     => "14",
                            "referencia"    => "10 - 26",
                        ),
                        array(
                            "clave"         => "AN01",
                            "nombre"        => "Hemoglobina glucosilada",
                            "unidad"        => "ml/Dl",
                            "resultado"     => "14",
                            "referencia"    => "10 - 26",
                        ),
                        array(
                            "clave"         => "AN01",
                            "nombre"        => "Hemoglobina glucosilada",
                            "unidad"        => "ml/Dl",
                            "resultado"     => "14",
                            "referencia"    => "10 - 26",
                        ),
                        array(
                            "clave"         => "AN01",
                            "nombre"        => "Hemoglobina glucosilada",
                            "unidad"        => "ml/Dl",
                            "resultado"     => "14",
                            "referencia"    => "10 - 26",
                        ),
                        array(
                            "clave"         => "AN01",
                            "nombre"        => "Hemoglobina glucosilada",
                            "unidad"        => "ml/Dl",
                            "resultado"     => "14",
                            "referencia"    => "10 - 26",
                        ),
                        array(
                            "clave"         => "AN01",
                            "nombre"        => "Hemoglobina glucosilada",
                            "unidad"        => "ml/Dl",
                            "resultado"     => "14",
                            "referencia"    => "10 - 26",
                        ),
                        array(
                            "clave"         => "AN01",
                            "nombre"        => "Hemoglobina glucosilada",
                            "unidad"        => "ml/Dl",
                            "resultado"     => "14",
                            "referencia"    => "10 - 26",
                        ),
                        array(
                            "clave"         => "AN01",
                            "nombre"        => "Hemoglobina glucosilada",
                            "unidad"        => "ml/Dl",
                            "resultado"     => "14",
                            "referencia"    => "10 - 26",
                        ),
                        array(
                            "clave"         => "AN01",
                            "nombre"        => "Hemoglobina glucosilada",
                            "unidad"        => "ml/Dl",
                            "resultado"     => "14",
                            "referencia"    => "10 - 26",
                        ),
                        array(
                            "clave"         => "AN01",
                            "nombre"        => "Hemoglobina glucosilada",
                            "unidad"        => "ml/Dl",
                            "resultado"     => "14",
                            "referencia"    => "10 - 26",
                        ),
                        array(
                            "clave"         => "AN01",
                            "nombre"        => "Hemoglobina glucosilada",
                            "unidad"        => "ml/Dl",
                            "resultado"     => "14",
                            "referencia"    => "10 - 26",
                        ),
                        array(
                            "clave"         => "AN01",
                            "nombre"        => "Hemoglobina glucosilada",
                            "unidad"        => "ml/Dl",
                            "resultado"     => "14",
                            "referencia"    => "10 - 26",
                        ),
                        array(
                            "clave"         => "AN01",
                            "nombre"        => "Hemoglobina glucosilada",
                            "unidad"        => "ml/Dl",
                            "resultado"     => "14",
                            "referencia"    => "10 - 26",
                        ),
                        array(
                            "clave"         => "AN01",
                            "nombre"        => "Hemoglobina glucosilada",
                            "unidad"        => "ml/Dl",
                            "resultado"     => "14",
                            "referencia"    => "10 - 26",
                        ),
                        array(
                            "clave"         => "AN01",
                            "nombre"        => "Hemoglobina glucosilada",
                            "unidad"        => "ml/Dl",
                            "resultado"     => "14",
                            "referencia"    => "10 - 26",
                        ),
                        array(
                            "clave"         => "AN01",
                            "nombre"        => "Hemoglobina glucosilada",
                            "unidad"        => "ml/Dl",
                            "resultado"     => "14",
                            "referencia"    => "10 - 26",
                        ),
                        array(
                            "clave"         => "AN01",
                            "nombre"        => "Hemoglobina glucosilada",
                            "unidad"        => "ml/Dl",
                            "resultado"     => "14",
                            "referencia"    => "10 - 26",
                        ),
                        array(
                            "clave"         => "AN01",
                            "nombre"        => "Hemoglobina glucosilada",
                            "unidad"        => "ml/Dl",
                            "resultado"     => "14",
                            "referencia"    => "10 - 26",
                        ),
                        array(
                            "clave"         => "AN01",
                            "nombre"        => "Hemoglobina glucosilada",
                            "unidad"        => "ml/Dl",
                            "resultado"     => "14",
                            "referencia"    => "10 - 26",
                        ),
                        array(
                            "clave"         => "AN01",
                            "nombre"        => "Hemoglobina glucosilada",
                            "unidad"        => "ml/Dl",
                            "resultado"     => "14",
                            "referencia"    => "10 - 26",
                        ),
                        array(
                            "clave"         => "AN01",
                            "nombre"        => "Hemoglobina glucosilada",
                            "unidad"        => "ml/Dl",
                            "resultado"     => "14",
                            "referencia"    => "10 - 26",
                        )
                    ),
                    "metodo"        => 'Cromascotopia',
                    "muestra"       => 'Cromascotopia',
                    "observaciones" => 'Cromascotopia',
                ),
                array(
                    "estudio"   => "EXAMEN GENERAL DE ORINA",
                    "analitos"  => array(
                            array(
                                "clave"         => "AN01",
                                "nombre"        => "Hemoglobina glucosilada",
                                "unidad"        => "ml/Dl",
                                "resultado"     => "14",
                                "referencia"    => "10 - 26",
                            ),
                            array(
                                "clave"         => "AN01",
                                "nombre"        => "Hemoglobina glucosilada",
                                "unidad"        => "ml/Dl",
                                "resultado"     => "14",
                                "referencia"    => "10 - 26",
                            ),
                            array(
                                "clave"         => "AN01",
                                "nombre"        => "Hemoglobina glucosilada",
                                "unidad"        => "ml/Dl",
                                "resultado"     => "14",
                                "referencia"    => "10 - 26",
                            )
                    ),
                    "metodo"        => 'Cromascotopia',
                    "muestra"       => 'Cromascotopia',
                    "observaciones" => 'Cromascotopia',
                )
            )
        ),
        array(
            "area"      => "BIOQUIMICA CLINICA",
            "estudios"  => array(
                array(
                    "estudio"   => "EXAMEN GENERAL DE ORINA",
                    "analitos"  => array(
                        array(
                            "clave"         => "AN01",
                            "nombre"        => "Hemoglobina glucosilada",
                            "unidad"        => "ml/Dl",
                            "resultado"     => "14",
                            "referencia"    => "10 - 26",
                        ),
                        array(
                            "clave"         => "AN01",
                            "nombre"        => "Hemoglobina glucosilada",
                            "unidad"        => "ml/Dl",
                            "resultado"     => "14",
                            "referencia"    => "10 - 26",
                        ),
                        array(
                            "clave"         => "AN01",
                            "nombre"        => "Hemoglobina glucosilada",
                            "unidad"        => "ml/Dl",
                            "resultado"     => "14",
                            "referencia"    => "10 - 26",
                        )
                    ),
                    "metodo"        => 'Cromascotopia',
                    "muestra"       => 'Cromascotopia',
                    "observaciones" => 'Cromascotopia',
                ),
                array(
                    "estudio"   => "QUIMICA SANQUINEA DE 6 ELEMENTOS",
                    "analitos"  => array(
                        array(
                            "clave"         => null,
                            "nombre"        => "Subtitulo",
                            "unidad"        => null,
                            "resultado"     => null,
                            "referencia"    => null,
                        ),
                        array(
                            "clave"         => "AN01",
                            "nombre"        => "Hemoglobina glucosilada",
                            "unidad"        => "ml/Dl",
                            "resultado"     => "14",
                            "referencia"    => "10 - 26",
                        ),
                        array(
                            "clave"         => "AN01",
                            "nombre"        => "Hemoglobina glucosilada",
                            "unidad"        => "ml/Dl",
                            "resultado"     => "14",
                            "referencia"    => "10 - 26",
                        )
                    ),
                    "metodo"        => 'Cromascotopia',
                    "muestra"       => 'Cromascotopia',
                    "observaciones" => 'Cromascotopia',
                )
            )
        )
    ),
    "oftamologia"   => array(
        "antecedentes_personales"       => "NEGADOS",
        "antecendentes_oftamologicos"   => "PTERIGION NASAL OJO IZQUIERDO",
        "padecimiento_actual"           => "ASINTOMATICA",
        "agudeza_visual"                => array(
            array(
                "metodo"        => "AGUDEZA VISUAL SIN CORRECCION: TABLA DE SNELLEN",
                "od"            => "20/20",
                "oi"            => "20/20",
                "jaeger"        => "1: 20/20",
                "observacion"   => "VISIÓN CERCANA SIN CORRECCIÓN TARJETA DE ROSENBAUM"
            )
        ),
        "refraccion"                => "NO AMERITA USO DE CORRECCIÓN ÓPTICA",
        "prueba_cromatica"          => "PRUEBA CROMATICA NORMAL CON PRUEBA DE ISHIBARA",
        "exploracion_oftamologica"  => "ANEXOS OCULARES NORMALES SEGMENTO ANTERIOR COJUNTIVA PTERIGION NASAL OJO IZQUIERDO, CORNEA, IRIS, CRISTALIINO, SIN ALTERACIONES, SEGMENTO POSTERIOR VITREO, NERVIO OPTICO, MACULA SIN ALTERACIONES.",
        "forias"                    => "FORIAS NO PRESENTES",
        "campimetria"               => "CAMPIMETRIA POR CONFRONTACION NORMAL",
        "presion_intraocular"       => array(
            array(
                "od" => "10 MMHG",
                "oi" => "10 MMHG"
            )
        ),
        "diagnostico"   => "VALORACION VISUAL NORMAL + PTERIGION NASAL OJO IZQUIERDO NO INVOLUCRO PLAN VISUAL.",
        "plan"          => "OBSERVACION ANUAL"
    )
);

    switch ($api){
        case 1:
        // Case 1 para etiquetas
            $pdf = new Reporte($data, 'etiquetas', 'mostrar');
            $pdf->build();
            break;
        case 2:
        // Case 2 para resultados
            $pdf = new Reporte($data, 'resultados', 'mostrar');
            $pdf->build();
            break;
        case 3: 
            $pdf = new Reporte($data, 'oftamologia', 'mostrar');
            $pdf->build();
            break;
        default:
            break;
    }
?>