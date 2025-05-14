<style>
    <?php include 'css/particles.css'?>
</style>


<div id="particles" class="particle-content">
    <?php
        $emojis = ['❤️', '❤', '🌸', '✨', '💖'];
        $particles = '';
        $delayBase = 5;
        $durationValues = [6, 7, 8, 9, 10];
        $positions = range(10, 90, 10);

        foreach ($positions as $i => $left) {
            $emoji = $emojis[$i % count($emojis)];
            $delay = ($i % 3) . 's'; // 0s, 1s, 2s en ciclo
            $duration = $durationValues[$i % count($durationValues)] . 's';

            $particles .= "<div class=\"particles-heart\" style=\"left: {$left}%; animation-delay: {$delay}; animation-duration: {$duration};\">{$emoji}</div>\n";
        }

        echo $particles;
    ?>
</div>

<script>
    <?php include 'js/particles.js'?>
</script>