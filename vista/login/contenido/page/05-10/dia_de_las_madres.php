<style> <?php echo include 'css/style.css' ?> </style>

<div id="ads" class="backrop">
    <div class="event-content">
        <!--
        <canvas id="canvas-confeti" width="100%" height="100%"></canvas> -->
        <canvas id="canvas-mother" width="300" height="300"></canvas>

        <h2 class="message">
            <span>F</span><span>E</span><span>L</span><span>I</span><span>Z</span>
            <span>&nbsp;</span>
            <span>D</span><span>Í</span><span>A</span>
            <span>&nbsp;</span>
            <span>D</span><span>E</span>
            <span>&nbsp;</span>
            <span>L</span><span>A</span><span>S</span>
            <span>&nbsp;</span>
            <span>M</span><span>A</span><span>D</span><span>R</span><span>E</span><span>S</span>
        </h2>

        <!-- Contenedor donde se añadirán los corazones -->
        <div id="hearts-container"></div>

        <div class="heart" style="left: 10%; bottom: -40px;">❤️</div>
        <div class="heart" style="left: 20%; bottom: -40px; animation-delay: 1s;">💖</div>
        <div class="heart" style="left: 30%; bottom: -40px; animation-delay: 2s;">🌸</div>
        <div class="heart" style="left: 40%; bottom: -40px; animation-delay: 3s;">💖</div>
        <div class="heart" style="left: 50%; bottom: -40px; animation-delay: 4s;">🌸</div>
        <div class="heart" style="left: 60%; bottom: -40px; animation-delay: 5s;">💖</div>
        <div class="heart" style="left: 70%; bottom: -40px; animation-delay: 6s;">🌸</div>
        <div class="heart" style="left: 80%; bottom: -40px; animation-delay: 7s;">💖</div>
        <div class="heart" style="left: 90%; bottom: -40px; animation-delay: 8s;">🌸</div>
    </div>
</div>

<!-- ANIMCACIONES -->
<script type="module">
    <?php echo include "js/animate.js" ?>
</script>

<!-- LOTTIE -->
<script type="module">
    <?php echo include "js/lottie.js" ?>
</script>


<script type="module">
    <?php echo include "js/heart.js" ?>
</script>