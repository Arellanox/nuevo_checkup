<?php

/**
 * ==============================================================================
 *           Archivo de configuración de funcionalidades JavaScript
 * ==============================================================================
 * Configuración funcionalidades de la aplicación desarrolladas en JavaScript
 * estas funcionalidades son las que se ejecutan en el lado del cliente
 * son funcionalidades globales y deben ser registradas en este archivo,
 * los archivos js que se incluyan en este archivo deben estar en la carpeta
 * helpers/js/ de la aplicación
 * 
 * Se debe crear un archivo por función de esta manera se mantiene el orden en
 * el código y se facilita la lectura y mantenimiento del mismo.
 * ==============================================================================
 * !No se debe incluir código HTML en este archivo¡
 * !No se debe incluir código PHP en este archivo¡
 * !No se debe incluir código CSS en este archivo¡
 * !Este archivo esta registrado en el archivo vista/menu/controlador/controlador.php¡
 * ==============================================================================
 */
?>
<script type="text/javascript">
    const scripts = [
        "<?= $https . $url . '/' . $appname . '/helpers/js/fetchAndFillSelect.js'; ?>",
    ]

    scripts.map(script => {$.getScript(script);})
</script>