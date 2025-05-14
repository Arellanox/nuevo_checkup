<style>
    <?php include 'css/app.css'?>
</style>


<div id="base-ads" class="bg-festividad">
    <div id="progress-bar"></div>

    <div class="content">

        <div class="card-message">
            <div class="message">
                <canvas id="canvas-mother" width="500px" height="500px">
                </canvas>
            </div>
        </div>

        <div id="text-message" class="message-wrapper" style="display: none">
            <h2 class="message-text">
                <span>F</span><span>E</span><span>L</span><span>I</span><span>Z</span>
                <span>&nbsp;</span>
                <span>D</span><span>Í</span><span>A</span>
                <span>&nbsp;</span>
                <span>D</span><span>E</span>
                <span>&nbsp;</span>
                <span>L</span><span>A</span><span>S</span>
                <span>&nbsp;</span>
                <br>
                <span>M</span><span>A</span><span>D</span><span>R</span><span>E</span><span>S</span>
            </h2>
        </div>

        <canvas id="canvas-flower-left-top" width="300px" height="300px">
        </canvas>
        <canvas id="canvas-flower-left-bottom" width="300px" height="300px">
        </canvas>

        <canvas id="canvas-flower-right-top" width="300px" height="300px">
        </canvas>
        <canvas id="canvas-flower-right-bottom" width="300px" height="300px">
        </canvas>
    </div>
</div>

<script>
    // Inicia la barra cuando comience la animación
    const progressBar = document.getElementById('progress-bar');

    // Forzamos el reflow para que el transition funcione incluso si la propiedad cambia de inmediato
    progressBar.offsetWidth; // Trigger reflow

    // Animar el ancho de la barra
    progressBar.style.transition = 'width 9s linear';
    progressBar.style.width = '100%';

    // Ocultar progresivamente el contenedor después de 9 segundos
    setTimeout(() => {
        const container = document.getElementById('base-ads');
        container.style.transition = 'opacity 0.6s ease-out';
        container.style.opacity = '0';

        setTimeout(() => {
            container.style.display = 'none';
        }, 600); // Espera a que termine la animación de opacidad
    }, 9000);

</script>
<script type="module">
    <?php include 'js/app.js'?>
</script>
<script type="module">
    <?php include 'js/animated.js'?>
</script>