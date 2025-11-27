<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<style>
  /* Marca de agua EXACTA detrás de la tabla */
  .marca-agua {
    position: fixed;
    top: 50%;               /* posición similar al PDF */
    left: 45%;
    transform: translate(-50%, -50%);
    width: 100%;             /* tamaño más grande */
    opacity: 0.2;          /* muy tenue */
    z-index: -1000;         /* siempre detrás */
  }
</style>

</head>
<?php
$logo = file_get_contents("http://localhost/nuevo_checkup/pdf/public/assets/logo_cimmo.png");
$logo = base64_encode($logo);

$qr = file_get_contents("http://localhost/nuevo_checkup/pdf/public/assets/cimmo_qr.png");
$qr = base64_encode($qr);
?>

<body>
    <img src="data:image/png;base64,<?php echo $logo; ?>" class="marca-agua">
<!-- HEADER (pegar dentro de <body>) -->
<style>
  /* HEADER EXACTO */
  .header {
    width: 100%;
    padding: 6px 20px 10px 20px;
    /* border-bottom: 4px solid #0f4e91; */
    box-sizing: border-box;
    position: relative;
  }

  .header .logo {
    height: 140px;
    display: inline-block;
    vertical-align: top;
    margin-top: -5px;
  }

  .header .qr {
    width: 150px;
    position: absolute;
    right: 20px;
    top: 2px; /* igual al PDF */
  }

  .header .empresa {
    display: inline-block;
    vertical-align: top;
    margin-left: 10px;
    max-width: calc(100% - 380px);
    line-height: 1.1;
    font-size: 15px;               /* tamaño exacto */
    /* color: #0c3a66;                color exacto del PDF */
    color: #364a9c;
    letter-spacing: -0.2px;        /* compresión como en el PDF */
    margin-top: 10px;              /* alineación visual correcta */
  }


</style>

<div class="header">
  <!-- Logo a la izquierda -->
  <img src="data:image/png;base64,<?php echo $logo; ?>" height="150">

  <!-- Datos de la empresa al centro/izquierda -->
  <div class="empresa">
    <strong>CIMMO MEDICAL S.A. DE C.V.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;R.F.C.: CME210624MU9</strong><br>
    <strong> Pagés Llergo 150, Col. Arboledas, Villahermosa, Tabasco. C.P. 86079</strong>
  </div>

  <!-- QR a la derecha -->
  <img src="data:image/png;base64,<?php echo $qr;  ?>" class="qr" alt="QR">
</div>

<style>
  /* ----- ESTILO EXACTO DE LA BARRA AZUL "PACIENTE" ----- */
  .barra-paciente {
    background: #0f4e91;     /* color real del PDF */
    color: white;
    padding: 3px 20px;
    font-size: 16px;
    font-weight: bold;
    margin-top: 8px;
  }

   /* ----- DATOS DEL PACIENTE ----- */
  .datos-paciente {
    padding: 8px 10px;
    font-size: 15px;           /* ligeramente mayor */
    font-family: DejaVu Sans, Arial, sans-serif;  /* tipografía redonda */
    color: #2c3f8c;              /* tono azul como en el PDF */
    letter-spacing: 0.3px;       /* suaviza el texto */
    line-height: 1.35;           /* más aire vertical */
  }

  .datos-paciente strong {
    color: #0f4e91;
    font-weight: bold;
    font-family: DejaVu Sans, Arial, sans-serif;
  }
</style>

<!-- BARRA AZUL PACIENTE -->
<div class="barra-paciente">
</div>

<!-- DATOS DEL PACIENTE -->
<div class="datos-paciente">

  <!-- NOMBRE + EDAD + FECHA -->
  <strong>Paciente:</strong> <span style="color: black; font-weight: bold;"><?php echo $resultados->PACIENTE;  ?></span>
  <strong>Edad:</strong> <span style="color: black; font-weight: bold;"><?php echo $resultados->EDAD; ?> &nbsp;</span> 
  <strong>Fecha:</strong> <span style="color: black; font-weight: bold;"><?php echo $resultados->REGISTRO_RESULTADO; ?></span>
  <br>

  <!-- SEGUNDA LÍNEA: ID + SEXO -->
  <strong>ID Paciente:</strong> <span style="color: black; font-weight: bold;"><?php echo $resultados->ID_PACIENTE; ?></span>  &nbsp;&nbsp;&nbsp;
  <strong>Sexo:</strong> <span style="color: black; font-weight: bold;"><?php echo $resultados->SEXO; ?></span> 

</div>
<!-- BARRA AZUL PACIENTE -->
<div class="barra-paciente">
</div>

<style>
  /* ----- TÍTULO DEL ÁREA ----- */
  .titulo-area {
    background: #dbe5f1;          /* mismo azul claro que el header */
    color: #0f4e91;               /* azul del texto en el PDF */
    padding: 6px 20px;
    font-size: 16px;
    font-weight: bold;
    font-family: DejaVu Sans, Arial, sans-serif;
    border-bottom: 1px solid #b5c7d9; /* mismo borde que el header */
    margin-top: 15px;
  }

  /* ----- TABLA DE RESULTADOS ----- */
  .tabla-resultados {
    width: 100%;
    border-collapse: collapse;
    margin-top: 8px;
    font-family: DejaVu Sans, Arial, sans-serif;
    font-size: 14px;
  }

  .tabla-resultados th {
    background: #ffffff !important;   /* fondo blanco */
    color: #0f4e91;                   /* azul fuerte */
    font-size: 15px;
    padding: 6px 8px;
    border-bottom: 1px solid #b5c7d9;
    text-align: center;               /* CENTRADO */
    font-weight: bold;
  }
    
  .tabla-resultados td.col-examen {
    text-align: left;
  }


  /* RESULTADO — centrado */
  .tabla-resultados td.col-resultado {
    text-align: center;
  }

  /* UNIDAD — centrado */
  .tabla-resultados td.col-unidad {
    text-align: center;
  }

  /* VALORES DE REFERENCIA — centrado */
  .tabla-resultados td.col-ref {
    text-align: center;
  }

  .tabla-resultados td {
    padding: 6px 8px;
    border-bottom: 1px solid #e2e2e2;
    vertical-align: top;
    font-size: 13px;
  }

  /* ICONO AZUL DEL PDF */
  .icon-check {
    width: 11px;
    height: 11px;
    margin-right: 5px;
    vertical-align: middle;
  }

  /* BLOQUE DEL MÉTODO */
  .metodo {
    font-family: DejaVu Sans, Arial, sans-serif;
    font-size: 14px;
    padding: 8px 20px;
    margin-top: 6px;
    color: black;
  }
</style>

<!-- TÍTULO DEL ÁREA -->
<div class="titulo-area">
  Biología Molecular — Panther System
</div>

<!-- TABLA DE RESULTADOS -->
<table class="tabla-resultados">
  <tr>
    <th>Examen</th>
    <th>Resultado</th>
    <th>Unidad</th>
    <th>Valores de referencia</th>
  </tr>

  <tr>
    <td class="col-examen">
      Virus de la Inmunodeficiencia Humana (VIH 1 + 2)
    </td>

    <td class="col-resultado"><?php echo $resultados->VIH_1_2; ?></td>
    <td class="col-unidad">S/CO</td>
    <td class="col-ref">NO REACTIVO &lt; 1.0<br>REACTIVO ≥ 1.0</td>
  </tr>

  <tr>
    <td class="col-examen">
      Virus de la Hepatitis B (VHB)
    </td>

    <td class="col-resultado"><?php echo $resultados->VHB; ?></td>
    <td class="col-unidad">S/CO</td>
    <td class="col-ref">NO REACTIVO &lt; 1.0<br>REACTIVO ≥ 1.0</td>
  </tr>

  <tr>
    <td class="col-examen">
      Virus de la Hepatitis C (VHC)
    </td>

    <td class="col-resultado"><?php echo $resultados->VHC; ?></td>
    <td class="col-unidad">S/CO</td>
    <td class="col-ref">NO REACTIVO &lt; 1.0<br>REACTIVO ≥ 1.0</td>
  </tr>
</table>

<br>
<br>
<br>

<!-- MÉTODO -->
<div class="metodo">
  <strong>Método: Nucleic Acid Testing (NAT)</strong>
</div>

<style>
  /* ----- BARRA DE OBSERVACIONES (IGUAL AL PDF) ----- */
  .barra-observaciones {
    background: #dbe5f1;              /* MISMO AZUL */
    color: black;                     /* TEXTO BLANCO */
    padding: 6px 20px;                /* IGUAL QUE PACIENTE/ÁREA */
    font-size: 15px;
    font-weight: bold;
    font-family: DejaVu Sans, Arial, sans-serif;
    margin-top: 20px;
    line-height: 1.3;
  }

  .texto-observaciones {
    background: #0f4e91;              /* MISMO FONDO */
    color: white;
    padding: 4px 20px 10px 20px;      /* Un poco más de espacio abajo */
    font-size: 14px;
    font-family: DejaVu Sans, Arial, sans-serif;
    line-height: 1.35;
    text-align: left;
  }
</style>

<!-- FRANJA AZUL DE OBSERVACIONES -->
<div class="barra-observaciones">
  Observaciones: <?php echo $resultados->OBSERVACIONES; ?>
</div>


<style>
  /* Reservar espacio para el footer (ajustar si cambias padding) */
  body { margin-bottom: 140px; }

  /* Contenedor footer fijo usando tabla */
  .footer-table {
    position: fixed;
    left: 0;
    bottom: 150px;
    width: 100%;
    border-collapse: collapse;
    font-family: DejaVu Sans, Arial, sans-serif;
    z-index: 9999;
  }

  /* filas */
  .f1 td {
    background: #0f4e91;   /* azul oscuro */
    height: 12px;          /* franja superior fina (ajusta si necesitas) */
    padding: 10px;
  }

    .f2 td {
    background: #dbe5f1;
    color: black;
    padding: 15px 20px;     /* bajamos altura */
    text-align: center;
    font-size: 12px;       /* texto más compacto */
    line-height: 1.1;      /* igual al PDF */
    }


  .f3 td {
    background: #0f4e91;   /* azul oscuro */
    color: #ffffff;
    padding: 12px 20px;
    vertical-align: middle;
    font-size: 13px;
  }

  /* celdas de la fila 2 */
  .f2 .col-left  { width: 55%; text-align: left; padding-left: 20px; }
  .f2 .col-divider { width: 1%; text-align: center; padding: 0; }
  .f2 .col-right { width: 44%; text-align: center; padding-right: 20px; }

  /* la línea divisoria vertical centrada dentro de su celda, con altura menor a la fila */
  .divider {
    display: inline-block;
    width: 1px;
    background: #b5c7d9;
    height: 8%;          /* NO toca top/bottom */
    vertical-align: middle;
  }

  /* celdas de la fila 3 */
  .f3 .col-left  { width: 50%; text-align: left; padding-left: 20px; }
  .f3 .col-right { width: 50%; text-align: right; padding-right: 20px; }

  /* asegurarnos de que la tabla no tenga bordes visibles */
  .footer-table, .footer-table td { border: none; }

  .spacer-quimico {
  height: 35px;   /* ⬅️ este valor determina qué tan abajo queda */
}

.datos-quimico {
  text-align: center;
  line-height: 1.1;
}

</style>

<!-- FOOTER (TABLA FIJA, 3 FILAS) -->
<table class="footer-table" cellpadding="0" cellspacing="0" role="presentation">
  <!-- fila 1: franja azul oscuro completa -->
  <tr class="f1">
    <td colspan="3"></td>
  </tr>

  <!-- fila 2: franja azul claro con 3 celdas: left | divider | right (datos del químico) -->
  <tr class="f2">
    <td class="col-left">
      <!-- opcional: info corta o vacio -->
      &nbsp;
    </td>

    <td class="col-divider">
      <span class="divider" aria-hidden="true"></span>
    </td>

    <td class="col-right">
        <div class="spacer-quimico"></div>
        <div class="datos-quimico">
            <strong>Q.F.B. JESÚS ALONSO JIMÉNEZ VIDAL</strong><br>
            <strong>PROF. 14136054</strong> 
        </div>
    </td>

  </tr>

  <!-- fila 3: franja azul oscuro con telefono a la izquierda y correo a la derecha -->
  <tr class="f3">
    <td class="col-left">
      Tel. 33 3667 8756
    </td>

    <td class="col-center" style="width:1%"></td>

    <td class="col-right">
      MedicalCimmo@gmail.com
    </td>
  </tr>
</table>


</body>
</html>
