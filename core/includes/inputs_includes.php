<script type="text/javascript">
    const scripts = [
        "<?= $current_url . '/core/helpers/inputs/ordenadoSelects.js'; ?>",
        "<?= $current_url . '/core/helpers/inputs/direcciones.js'; ?>",
    ];

    scripts.map(script => {$.getScript(script);})
</script>