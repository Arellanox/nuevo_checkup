<?php
session_start();

include "rechazados.html";
include "p_aceptar.html";
include "p_rechazar.html";
include "p_reagendar.html";
include "subir-perfil.html";
include "../../../include/modal/registrar-pruebas.php";
include "../../../include/modal/registrar-paciente.php";
include "../../../include/modal/editar-paciente.php";

//modal estudios del paciente por contado
include "../../../include/funciones/facturacion-pacientes/estudios-contando.php";
include "../../../include/funciones/facturacion-pacientes/factura-paciente.php";


include "solicitud-ingreso.html";

//UJAT
include "ujat-beneficiarios.html";

//documentos
include "ine-paciente.html";
include "ordenes-medicas.html";
include "consentimientos.html";

//Actualizar estudios
if ($_SESSION['permisos']['RepActEstudios'])
    include "p_actualizar_estudios.html";



include "p_qr-clientes.html";

//Actualizar procedencia
include "modal_actualizar_procedencia.html";

//Modal para los reportes no entregados
include "m_reportes_no_entregados.html";


// Para informacion de estudios
include "estudios/estudios_info.html";


// filtro de la tabla de pacientes
include 'modal_filtro_aceptados.html';