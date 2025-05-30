<div class="col-12 loader" id="loader">
    <div class="preloader" id="preloader"> </div>
</div>

<div class="table-responsive mt-2" style="width: 100%;">
    <div>
        Mostrar Columnas:
        <a href="" class="toggle-vis" data-column="4">Laboratorio</a> -
        <a href="" class="toggle-vis" data-column="5">Biomolecular</a> -
        <?php if(filter_var($_POST['franquicia'], FILTER_VALIDATE_BOOLEAN) === false): ?>
            <a href="" class="toggle-vis" data-column="6">Ultrasonido</a> -
            <a href="" class="toggle-vis" data-column="7">Rayos X</a> -
            <a href="" class="toggle-vis" data-column="8">Oftalmología</a> -
            <a href="" class="toggle-vis" data-column="9">Historia Clínica</a> -
            <a href="" class="toggle-vis" data-column="10">Electrocardiograma</a> -
            <a href="" class="toggle-vis" data-column="11">Estudio InBody</a> -
            <a href="" class="toggle-vis" data-column="12">Espirometría</a> -
            <a href="" class="toggle-vis" data-column="13">Audiometría</a>
        <?php endif; ?>
    </div>

    <table class="table table-hover display responsive" id="TablaEstatusTurnos" width="100%">
        <thead>
            <tr>
                <th scope="" class="col-number all">#</th>
                <th scope="" class="col-20% all">Nombre</th>
                <th scope="" class="col-20% mobile-l desktop">Procedencia</th>
                <th scope="" class="col-5% desktop">Prefolio</th>

                <!-- Laboratorio 4 -->
                <th scope="" class="col-icons min-tablet">Lab. Cli.</th>

                <!-- Biomolecular 5 -->
                <th scope="" class="col-invisble-first col-icons  min-tablet">Lab. Bio.
                </th>

                <?php if(filter_var($_POST['franquicia'], FILTER_VALIDATE_BOOLEAN) === false): ?>
                <!-- Ultrasonido 6-->
                <th scope="" class="col-icons  min-tablet">Ultra.</th>
                <!-- Rayos X 7-->
                <th scope="" class="col-icons  min-tablet">RX.</th>
                <!-- Oftalmología 8-->
                <th scope="" class="col-invisble-first col-icons  min-tablet">Oft.</th>
                <!-- Historia Clínica 9-->
                <th scope="" class="col-icons  min-tablet">Hist. Cli.</th>
                <!-- Electrocardiograma 10-->
                <th scope="" class="col-invisble-first col-icons  min-tablet">Electro.</th>
                <!-- Nutricion Inbody  11-->
                <th scope="" class="col-invisble-first col-icons  min-tablet">InBody.</th>
                <!-- Espirometría 12-->
                <th scope="" class="col-icons  min-tablet">Espiro.</th>
                <!-- Audiometría 13 -->
                <th scope="" class="col-icons  min-tablet">Audio.</th>
                <?php endif; ?>

                <th scope="" class="desktop">Recepción</th>
                <th scope="" class="desktop">Turno</th>

                <th scope="" class="none">Agenda</th>
                <th scope="" class="none">Re-agenda</th>
                <th scope="" class="none">Segmento</th>
                <th scope="" class="col-invisble-first">Area Actual</th>
                <th scope="" class="none">Sexo</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>

</div>
<!-- Off canvas -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasInfoPrincipal"
    aria-labelledby="offcanvasInfoPrincipalLabel">
    <div class="d-flex flex-column flex-shrink-0 p-3 off-canvas-container" style="width: 100%;height:100%">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasExampleLabel"><i class="bi bi-person-bounding-box"></i> Información
            </h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <hr>
        <div class="offcanvas-body">
            <div class="" id="panel-muestras-estudios"></div>
        </div>
    </div>
</div>