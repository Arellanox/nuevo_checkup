<script>
    function playAudio() {
        var msg = new SpeechSynthesisUtterance('Help me with this code please?');
        msg.pitch = 0;
        msg.rate = .6;
        window.speechSynthesis.speak(msg);



        var msg = new SpeechSynthesisUtterance();
        var voices = window.speechSynthesis.getVoices();
        msg.voice = voices[10]; // Note: some voices don't support altering params
        msg.voiceURI = 'native';
        msg.volume = 1; // 0 to 1
        msg.rate = 1.2; // 0.1 to 10
        msg.pitch = 2; //0 to 2
        msg.text = 'Sure. This code plays "Hello World" for you';
        msg.lang = 'en-US';

        msg.onend = function(e) {
            var msg1 = new SpeechSynthesisUtterance('Now code plays audios for you');
            msg1.voice = speechSynthesis.getVoices().filter(function(voice) {
                return voice.name == 'Whisper';
            })[0];
            msg1.pitch = 2; //0 to 2
            msg1.rate = 1.2; //0 to 2
            // start your audio loop.
            speechSynthesis.speak(msg1);
            console.log('Finished in ' + e.elapsedTime + ' seconds.');
        };

        speechSynthesis.speak(msg);
    }
</script>
<div class="container">
    <button id="runProgram" onclick='playAudio();' class="runProgram-button">Start</button>
</div>