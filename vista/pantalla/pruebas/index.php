<script>
    const init = () => {

        // Comprobamos si tenemos soporte en nuestro navegador
        if (!'speechSynthesis' in window) {
            showNotify({
                msn: 'Your browser not support tha Web Speech API',
                show: true,
                type: 'success'
            });
            return false;
        }

        // Interface de la API
        let voice = new SpeechSynthesisUtterance();

        // Objeto de la API
        let jarvis = window.speechSynthesis;

        let disabledPlay = true;

        const store = window.localStorage.getItem('dataSave') || '';
        const text = document.querySelector('#text');
        const btnSave = document.querySelector('#btnSave');
        const btnLoad = document.querySelector('#btnLoad');
        const btnPlay = document.querySelector('#btnPlay');
        const renderText = document.querySelector('.conversation');
        const select = document.getElementById("voices");

        // Controlamos el botón para cargar datos del localstorage
        btnLoad[store ? 'removeAttribute' : 'setAttribute']('disabled', true);

        // Observamos la propiedad 'innerHTML' para observar los cambios que se producen
        const SET = Object.getOwnPropertyDescriptor(Element.prototype, 'innerHTML').set;
        const handler = {
            set(value) {
                const hasConversation = Object.values(this.classList).includes('conversation') && disabledPlay;
                if (hasConversation) {
                    btnPlay.removeAttribute('disabled');
                    disabledPlay = false;
                }
                return SET.call(this, value);
            }
        };
        Object.defineProperty(Element.prototype, 'innerHTML', handler);

        text.addEventListener('keydown', function({
            code
        }) {
            if (['shift', 'NumpadEnter'].includes(code)) {
                const lastWord = this.value.split('\n');
                renderText.innerHTML += `<div>${this.value}</div>`;
                this.value = '';
                // Convertimos el texto a voz
                playVoice(lastWord[lastWord.length - 1]);
            }
        });

        btnSave.addEventListener('click', () => {
            showNotify({
                msn: 'The text has been saved success',
                show: true,
                type: 'success'
            });
            const dataSave = renderText.innerHTML;
            // Guardamos los datos en el localStorage
            storeData(dataSave);
        });

        btnLoad.addEventListener('click', () => {
            showNotify({
                msn: 'The text has been loaded success',
                show: true,
                type: 'success'
            });
            // Recuperamos los daots del localStorage
            const text = storeData('', false);
            renderText.innerHTML = text;
        });

        btnPlay.addEventListener('click', () => {
            // Reproducimos la voz
            pauseVoice();
            stopVoice();
            showNotify({
                msn: 'The text is playing',
                show: true,
                type: 'success'
            });
            playVoice(renderText.innerHTML);
        });

        const playVoice = text => {
            // Reproduce la voz
            voice.text = text;
            jarvis.speak(voice);
        };

        const stopVoice = () => {
            // Cancela la reproducción de la voz
            jarvis.cancel()
        };

        const pauseVoice = () => {
            // Pausa la reproducción de la voz
            jarvis.resume();
        }

        // Obtenemos todas las voces soportadas
        const getVoices = function() {
            const voices = jarvis.getVoices();
            voices.forEach(item => {
                const {
                    name,
                    lang
                } = item;
                const option = document.createElement('option');
                option.textContent = `${name} - [${lang}]`;
                option.setAttribute('data-language', lang);
                option.setAttribute('data-name', name);
                select.appendChild(option);
            });
            voice.lang = this.selectedOptions?.[0]?.dataset.language.split('-')[0] || 'es';
        };

        getVoices();
        jarvis.onvoiceschanged = getVoices;
        select.addEventListener('input', getVoices);

        // Función extra, no es necesario para el funcionamiento
        const storeData = (data = '', save = true) => {
            return window.localStorage[save ? 'setItem' : 'getItem']('dataSave', data);
        };
    };

    // Mostra una notificación
    const showNotify = ({
        msn = '',
        duration = 3000,
        show = false,
        type = ''
    }) => {
        if (show) {
            const notification = document.querySelector('.notification');
            const bgNotification = ['info', 'warning', 'success'].includes(type) ? type : 'info';
            notification.innerHTML = msn;
            notification.classList.add('show', bgNotification);
            setTimeout(() => {
                notification.classList.remove('show');
            }, duration);
        }
    };

    document.addEventListener('DOMContentLoaded', init);
</script>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TEXT TO VOICE - JAVASCRIPT</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
    <link rel="stylesheet" href="./css/index.css">
</head>

<body>
    <div class="container">
        <input type="text" placeholder="Texto to Speech" id="text">
        <div class="conversation"></div>
        <div class="container-button">
            <select id="voices"></select>
            <button id="btnSave"><i class="fas fa-upload"></i>Save text</button>
            <button id="btnLoad" disabled><i class="fas fa-download"></i>Load text</button>
            <button id="btnPlay" disabled><i class="fas fa-play-circle"></i>Play text</button>
        </div>
    </div>
    <div class="notification"></div>
    <script src="./js/index.js"></script>
</body>

</html>


<style>
    body {
        font-family: 'Montserrat', sans-serif;
        overflow: hidden;
    }

    input[type='text'] {
        border: 0;
        border-bottom: 1px solid #cccccc;
        width: calc(100% - 20px);
        margin: 10px 0;
        padding: 10px;
    }

    button,
    select {
        border: 0;
        padding: 10px;
        background: #3988f2;
        color: #ffffff;
        box-shadow: 0 0 3px 1px rgb(0, 0, 0, 0.2);
        cursor: pointer;
    }

    button:focus,
    input:focus {
        outline: -webkit-focus-ring-color auto 0px;
    }

    button[disabled] {
        background: #aaaaaa;
        color: #000000;
        cursor: not-allowed;
    }

    button i {
        margin-right: 10px;
    }

    select {
        padding: 9px;
    }

    .conversation {
        width: calc(100% - 20px);
        height: 300px;
        box-shadow: 0 0 7px 2px rgb(0, 0, 0, 0.2);
        margin: 15px 0;
        padding: 10px;
        overflow: auto;
    }

    .container-button {
        text-align: right;
    }

    .notification {
        width: 200px;
        padding: 10px;
        border-radius: 2px;
        position: absolute;
        left: calc(50% - 100px);
        bottom: -100px;
        transition: 450ms ease-in-out;
        text-align: center;
        line-height: 25px;
    }

    .notification.show {
        bottom: 50px;
        transition: 450ms ease-in-out;
    }

    .info {
        background: #3988f2;
        color: #ffffff;
    }

    .warning {
        background: #fe8c8c;
        color: #000000;
    }

    .success {
        background: #60c356;
        color: #000000;
    }
</style>