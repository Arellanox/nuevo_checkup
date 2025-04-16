<script type="text/javascript">
    //Inyecciones para su reutilización
    const appname = "<?= $appname ?>";
    const current_url = "<?= $current_url ?>"
    const isLocalHost = "<?= $isLocalHost ?>"
    const session = <?= json_encode($session_data); ?>;
    let http = "<?= $https ?>";
    let servidor = "<?= $current_host ?>";
    let dominio = "<?= $url ?>";
    let tipoUrl = <?= $tipoUrl ?>;
    //Fin de inyeccciónes para reutilización

    localStorage.setItem('http', http);
    localStorage.setItem('servidor', servidor);
    localStorage.setItem('appname', appname);
    const miStorage = window.localStorage;

    let oneClick_promociones = 0;
    let array_selected;
    let array_user;
    let validar;

    const isFranquisiario = session['franquiciario'];

    $.getScript("<?= $current_url . '/core/helpers/menu/tooltip.js' ?>").done(function () {
        $.getScript("<?= $current_url . '/core/helpers/menu/site.js' ?>").done(function () {
            obtenerHeader('<?= $menu ?>', '<?= $tip ?>');

            $.getScript("<?= $current_url . '/vista/menu/controlador/class.js' ?>").done(function () {
                $.getScript("<?= $current_url . '/vista/menu/controlador/funciones.js' ?>").done(function () {
                    $.getScript("<?= $current_url . '/core/helpers/menu/loggin.js' ?>").done(function () {
                    });
                });
            });
        })
    });
</script>