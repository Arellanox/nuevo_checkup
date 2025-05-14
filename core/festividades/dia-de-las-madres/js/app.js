import { DotLottie } from "https://cdn.jsdelivr.net/npm/@lottiefiles/dotlottie-web/+esm";

function flowerAnimation(){
    const delay = 500; // milisegundos entre cada animación

    setTimeout(() => {
        new DotLottie({
            autoplay: true,
            loop: true,
            canvas: document.getElementById("canvas-flower-left-top"),
            src: `${current_url}/core/festividades/dia-de-las-madres/json/flower.json`,
        });
    }, 0);

    setTimeout(() => {
        new DotLottie({
            autoplay: true,
            loop: true,
            canvas: document.getElementById("canvas-flower-left-bottom"),
            src: `${current_url}/core/festividades/dia-de-las-madres/json/flower.json`,
        });
    }, delay);

    setTimeout(() => {
        new DotLottie({
            autoplay: true,
            loop: true,
            canvas: document.getElementById("canvas-flower-right-top"),
            src: `${current_url}/core/festividades/dia-de-las-madres/json/flower.json`,
        });
    }, delay * 2);

    setTimeout(() => {
        new DotLottie({
            autoplay: true,
            loop: true,
            canvas: document.getElementById("canvas-flower-right-bottom"),
            src: `${current_url}/core/festividades/dia-de-las-madres/json/flower.json`,
        });
    }, delay * 3);
}

function contentIllustration(){
    new DotLottie({
        autoplay: true,
        loop: false,
        canvas: document.getElementById("canvas-mother"),
        src: `${current_url}/core/festividades/dia-de-las-madres/json/mother_day.json`,
    });
}

setTimeout(() => { flowerAnimation() }, 500);
setTimeout(() => { contentIllustration() }, 1200);

setTimeout(() => {
    let container = document.getElementById('base-ads');
    container.classList.add('fade-out');

    // Espera que termine la transición antes de ocultar por completo
    setTimeout(() => {
        container.style.display = 'none';
    }, 1000); // debe coincidir con la duración del transition
}, 9000);
