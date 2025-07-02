<?php
    date_default_timezone_set('America/Mexico_City');

    if ($_SESSION['vista']['CONSULTORIO'] == 1) : ?>
      <a class="dropdown-a align-items-center" type="button" href="<?php echo $https . $url . '/' . $appname . '/vista/menu/consultorio/'; ?>">
        <i class="bi bi-clipboard2-pulse"></i> Consultorio
      </a>
    <?php endif; ?>

    <?php if ($_SESSION['vista']['SOMATOMETRIA'] == 1) : ?>
      <a class="dropdown-a align-items-center" type="button" href="<?php echo $https . $url . '/' . $appname . '/vista/menu/somatometria/'; ?>">
        <i class="bi bi-heart-pulse"></i> Somatometría | Signos vitales
      </a>
    <?php endif; ?>

    <!-- IMAGENOLOGÍA -->
    <?php if ($_SESSION['vista']['ULTRASONIDO'] == 1 || $_SESSION['vista']['ULTRASONIDOTOMA'] == 1) : ?>
      <a class="dropdown-a align-items-center collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#board-ultrasonido" aria-expanded="false">
        <i class="bi bi-person-video"></i> Ultrasonido
      </a>
      <div class="collapse" id="board-ultrasonido">
        <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
          <?php if ($_SESSION['vista']['ULTRASONIDO'] == 1) : ?>
            <li>
              <a class="dropdown-a align-items-center" type="button" href="<?php echo $https . $url . '/' . $appname . '/vista/menu/area-master/#ULTRASONIDO'; ?>">
                <i class="bi bi-dot"></i> Interpretación
              </a>
            </li>
          <?php endif; ?>
          <?php if ($_SESSION['vista']['ULTRASONIDOTOMA'] == 1) : ?>
            <li>
              <a href="<?php echo $https . $url . '/' . $appname . '/vista/menu/area-master/#ULTRASONIDOTOMA'; ?>" class="dropdown-a align-items-center" type="button">
                <i class="bi bi-dot"></i> Captura
              </a>
            </li>
          <?php endif; ?>
        </ul>
      </div>
    <?php endif; ?>

    <?php if ($_SESSION['vista']['RX'] == 1 || $_SESSION['vista']['RXTOMA'] == 1) : ?>
      <a class="dropdown-a align-items-center collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#board-rayosX" aria-expanded="false">
        <i class="bi bi-universal-access"></i> Rayos X
      </a>
      <div class="collapse" id="board-rayosX">
        <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
          <?php if ($_SESSION['vista']['RX'] == 1) : ?>
            <li>
              <a class="dropdown-a align-items-center" type="button" href="<?php echo $https . $url . '/' . $appname . '/vista/menu/area-master/#RX'; ?>">
                <i class="bi bi-dot"></i> Interpretación
              </a>
            </li>
          <?php endif; ?>
          <?php if ($_SESSION['vista']['RXTOMA'] == 1) : ?>
            <li>
              <a href="<?php echo $https . $url . '/' . $appname . '/vista/menu/area-master/#RXTOMA'; ?>" class="dropdown-a align-items-center" type="button">
                <i class="bi bi-dot"></i> Captura
              </a>
            </li>
          <?php endif; ?>
        </ul>
      </div>
    <?php endif; ?>

    <!-- Otras Areas -->
    <?php if ($_SESSION['vista']['ELECTROCARDIOGRAMA'] == 1 || $_SESSION['vista']['ELECTROCARDIOGRAMA_CAPTURAS'] == 1) : ?>
      <!-- Cardiología -->
      <a class="dropdown-a align-items-center collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#board-cardiologia" aria-expanded="false">
        <i class="bi bi-heart-pulse"></i> Cardiología
      </a>
      <div class="collapse" id="board-cardiologia">
        <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
          <?php if ($_SESSION['vista']['ELECTROCARDIOGRAMA'] == 1 || $_SESSION['vista']['ELECTROCARDIOGRAMA_CAPTURAS'] == 1) : ?>
            <a class="dropdown-a align-items-center collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#board-electrocardiograma" aria-expanded="false">
              <i class="bi bi-activity"></i> Electrocardiograma
            </a>
            <div class="collapse" id="board-electrocardiograma">
              <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                <?php if ($_SESSION['vista']['ELECTROCARDIOGRAMA'] == 1) : ?>
                  <li>
                    <a class="dropdown-a" type="button" href="<?php echo $https . $url . '/' . $appname . '/vista/menu/area-master/#ELECTROCARDIOGRAMA'; ?>">
                      <i class="bi bi-dot"></i> Interpretación
                    </a>
                  </li>
                <?php endif; ?>
                <?php if ($_SESSION['vista']['ELECTROCARDIOGRAMA_CAPTURAS'] == 1) : ?>
                  <li>
                    <a href="<?php echo $https . $url . '/' . $appname . '/vista/menu/area-master/#ELECTROCARDIOGRAMA_CAPTURAS'; ?>" class="dropdown-a" type="button">
                      <i class="bi bi-dot"></i> Captura
                    </a>
                  </li>
                <?php endif; ?>
                <hr class="dropdown-divider">
              </ul>
            </div>
          <?php endif; ?>


          <?php if ($_SESSION['vista']['ECOCARDIOGRAMA'] == 1) : ?>
            <a class="dropdown-a align-items-center" type="button" href="<?php echo $https . $url . '/' . $appname . '/vista/menu/area-master/#ECOCARDIOGRAMA'; ?>">
              <i class="bi bi-heart-pulse-fill"></i> Ecocardiograma
            </a>
          <?php endif; ?>
          <?php if ($_SESSION['vista']['PRUEBA_DE_ESFUERZO'] == 1) : ?>
            <a class="dropdown-a align-items-center" type="button" href="<?php echo $https . $url . '/' . $appname . '/vista/menu/area-master/#PRUEBA_DE_ESFUERZO'; ?>">
              <i class="bi bi-lightning"></i> Prueba de Esfuerzo
            </a>
          <?php endif; ?>
        </ul>
        <hr class="dropdown-divider">
      </div>
    <?php endif; ?>

    <?php if ($_SESSION['vista']['ESPIROMETRIA'] == 1) : ?>
      <a class="dropdown-a align-items-center" type="button" href="<?php echo $https . $url . '/' . $appname . '/vista/menu/area-master/#ESPIROMETRIA'; ?>">
        <i class="bi bi-lungs"></i> Espirometría
      </a>
    <?php endif; ?>

    <?php if ($_SESSION['vista']['AUDIOMETRIA'] == 1) : ?>
      <a class="dropdown-a align-items-center" type="button" href="<?php echo $https . $url . '/' . $appname . '/vista/menu/area-master/#AUDIOMETRIA'; ?>">
        <i class="bi bi-ear"></i> Audiometría
      </a>
    <?php endif; ?>

    <?php if ($_SESSION['vista']['OFTALMOLOGIA'] == 1) : ?>
      <a class="dropdown-a align-items-center" type="button" href="<?php echo $https . $url . '/' . $appname . '/vista/menu/area-master/#OFTALMOLOGIA'; ?>">
        <i class="bi bi-eye"></i> Oftalmología
      </a>
    <?php endif; ?>

    <!-- Otras Areas -->
    <?php if ($_SESSION['vista']['NUTRICION'] == 1 || $_SESSION['vista']['NUTRICION_CAPTURAS'] == 1) : ?>
      <a class="dropdown-a align-items-center collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#board-nutricion" aria-expanded="false">
        <img src="../../../archivos/sistema/nutrientes.svg" alt="" style="filter: invert(100%); margin-top: -4px;    width: 17px;"> Nutrición
      </a>
      <div class="collapse" id="board-nutricion">
        <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
          <?php if ($_SESSION['vista']['NUTRICION'] == 2) : ?>
            <li>
              <a class="dropdown-a align-items-center" type="button" href="<?php echo $https . $url . '/' . $appname . '/vista/menu/area-master/#NUTRICION'; ?>">
                <i class="bi bi-dot"></i> Interpretación
              </a>
            </li>
          <?php endif; ?>
          <?php if ($_SESSION['vista']['NUTRICION_CAPTURAS'] == 1) : ?>
            <li>
              <a href="<?php echo $https . $url . '/' . $appname . '/vista/menu/area-master/#NUTRICION_CAPTURAS'; ?>" class="dropdown-a align-items-center" type="button">
                <i class="bi bi-dot"></i> Estudio (InBody)
              </a>
            </li>
          <?php endif; ?>
        </ul>
      </div>
    <?php endif; ?>

    <?php if (
      $_SESSION['vista']['CONTROL_TURNOS_PANTALLA'] == 1 ||
      $_SESSION['vista']['CONTROL_TURNOS'] == 1
    ) : ?>
      <a class="dropdown-a align-items-center collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#board-turnos" aria-expanded="false">
        <i class="bi bi-back"></i> Control de Turnos
      </a>
      <div class="collapse" id="board-turnos">
        <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
          <?php if ($_SESSION['vista']['CONTROL_TURNOS'] == 1) : ?>
            <li>
              <a class="dropdown-a align-items-center" type="button" href="<?php echo $https . $url . '/' . $appname . '/vista/menu/control-turnos/'; ?>">
                <i class="bi bi-dot"></i> Menú
              </a>
            </li>
          <?php endif; ?>
          <?php if ($_SESSION['vista']['CONTROL_TURNOS_PANTALLA'] == 1) : ?>
            <li>
              <a href="<?php echo $https . $url . '/' . $appname . '/vista/pantalla/control-turnos/'; ?>" class="dropdown-a align-items-center" type="button">
                <i class="bi bi-dot"></i> Pantalla Checkups
              </a>
            </li>
          <?php endif; ?>
          <?php if ($_SESSION['vista']['CONTROL_TURNOS_PANTALLA'] == 1) : ?>
            <li>
              <a href="<?php echo $https . $url . '/' . $appname . '/vista/pantalla_muestras/control-turnos/'; ?>" class="dropdown-a align-items-center" type="button">
                <i class="bi bi-dot"></i> Pantalla Toma de Muestras
              </a>
            </li>
          <?php endif; ?>
        </ul>
      </div>
    <?php endif; ?>

    <?php if ($_SESSION['vista']['ESTUDIOS_ULTRASONIDO'] == 1 || $_SESSION['vista']['ESTUDIOS_RAYOSX'] == 1) : ?>
      <a class="dropdown-a align-items-center collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#board-validacionCorreoLab" aria-expanded="false">
        <i class="bi bi-box2-heart"></i> Estudios
      </a>
      <div class="collapse" id="board-validacionCorreoLab">
        <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small shadow">
          <?php if ($_SESSION['vista']['ESTUDIOS_ULTRASONIDO'] == 1) : ?>
            <li>
              <a class="dropdown-a" type="button" href="<?php echo $https . $url . '/' . $appname . '/vista/menu/area-servicios/#ESTUDIOS_ULTRASONIDO'; ?>">
                <i class="bi bi-dot"></i> Ultrasonido
              </a>
            </li>

          <?php endif; ?>
          <?php if ($_SESSION['vista']['ESTUDIOS_RAYOSX'] == 1) : ?>
            <li>
              <a class="dropdown-a" type="button" href="<?php echo $https . $url . '/' . $appname . '/vista/menu/area-servicios/#ESTUDIOS_RAYOSX'; ?>">
                <i class="bi bi-dot"></i> Rayos X
              </a>
            </li>
          <?php endif; ?>
          <?php if ($_SESSION['vista']['ESTUDIOS_AREAS'] == 1) : ?>
            <li>
              <a class="dropdown-a" type="button" href="<?php echo $https . $url . '/' . $appname . '/vista/menu/area-servicios/#ESTUDIOS_AREAS'; ?>">
                <i class="bi bi-dot"></i> Checkups
              </a>
            </li>
          <?php endif; ?>
        </ul>
      </div>
    <?php endif; ?>

    <?php
        $BASE_URL_BY_ITEMS = $https . $url . '/' . $appname;
        $vistasPosibles = [
            [
                'permisos' => ['CONSULTORIO'], 'NOMBRE' => 'Consultorio',  'ICONO' => 'bi bi-clipboard2-pulse',
                'URL' => $BASE_URL_BY_ITEMS.'/vista/menu/reportes/checkup?area=CONSULTORIO',
            ],
            [
                'permisos' => ['SOMATOMETRIA'], 'NOMBRE' => 'Somatometría', 'ICONO' => 'bi bi-heart-pulse',
                'URL' => $BASE_URL_BY_ITEMS.'/vista/menu/reportes/checkup?area=SOMATOMETRIA',
            ],
            [
                'permisos' => ['ULTRASONIDO', 'ULTRASONIDOTOMA'], 'NOMBRE' => 'Ultrasonido', 'ICONO' => 'bi bi-person-video',
                'URL' => $BASE_URL_BY_ITEMS.'/vista/menu/reportes/checkup?area=ULTRASONIDO',
            ],
            [
                'permisos' => ['RX'], 'NOMBRE' => 'Rayos X', 'ICONO' => 'bi bi-universal-access',
                'URL' => $BASE_URL_BY_ITEMS.'/vista/menu/reportes/checkup?area=RX',
            ],
            [
                'permisos' => ['ELECTROCARDIOGRAMA', 'ELECTROCARDIOGRAMA_CAPTURAS'], 'NOMBRE' => 'Electrocardiograma', 'ICONO' => 'bi bi-activity',
                'URL' => $BASE_URL_BY_ITEMS.'/vista/menu/reportes/checkup?area=ELECTROCARDIOGRAMA',
            ],
            [
                'permisos' => ['ESPIROMETRIA'], 'NOMBRE' => 'Espirometria', 'ICONO' => 'bi bi-lungs',
                'URL' => $BASE_URL_BY_ITEMS.'/vista/menu/reportes/checkup?area=ESPIROMETRIA',
            ],
            [
                'permisos' => ['AUDIOMETRIA'], 'NOMBRE' => 'Audiometria', 'ICONO' => 'bi bi-ear',
                'URL' => $BASE_URL_BY_ITEMS.'/vista/menu/reportes/checkup?area=AUDIOMETRIA',
            ],
            [
                'permisos' => ['OFTALMOLOGIA'], 'NOMBRE' => 'Oftalmologia', 'ICONO' => 'bi bi-eye',
                'URL' => $BASE_URL_BY_ITEMS.'/vista/menu/reportes/checkup?area=OFTALMOLOGIA',
            ],
            [
                'permisos' => ['NUTRICION', 'NUTRICION_CAPTURAS'], 'NOMBRE' => 'Nutrición', 'ICONO' => 'bi bi-pie-chart',
                'URL' => $BASE_URL_BY_ITEMS.'/vista/menu/reportes/checkup?area=NUTRICION',
            ]
        ];

        $vistasFiltradas = array_filter($vistasPosibles, function ($vista) {
            foreach ($vista['permisos'] as $permiso) {
                if (!empty($_SESSION['vista'][$permiso]) && $_SESSION['vista'][$permiso] == 1) {
                    return true;
                }
            }
            return false;
        });
    ?>

    <a class="dropdown-a align-items-center collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#checkup-board-reportes" aria-expanded="false">
        <i class="bi bi-file-earmark-spreadsheet"></i> Reportes
    </a>
    <div class="collapse" id="checkup-board-reportes" style="box-shadow: none">
      <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
          <?php foreach ($vistasFiltradas as $index => $vista): ?>
              <?php
                  $lastIndex = array_key_last($vistasFiltradas);
                  $esUltimo = ($index === $lastIndex);
                  $prefijo = $esUltimo ? '└─' : '│─';
              ?>
              <li>
                  <a class="dropdown-a" style="display: flex; align-items: center; gap: 5px; padding-left: 20px" type="button" href="<?php echo $vista['URL']; ?>">
                      <?php echo $prefijo; ?> <i class="<?php echo $vista['ICONO']; ?>"></i> <?php echo $vista['NOMBRE']; ?>
                  </a>
              </li>
          <?php endforeach; ?>
      </ul>
    </div>
