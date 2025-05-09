import { DotLottie } from "https://cdn.jsdelivr.net/npm/@lottiefiles/dotlottie-web/+esm";

new DotLottie({
    autoplay: true,
    loop: true,
    canvas: document.getElementById("canvas-mother"),
    src: `${current_url}/vista/login/contenido/page/05-10/json/mother.json`, // replace with your .lottie or .json file URL
});

new DotLottie({
    autoplay: true,
    loop: true,
    canvas: document.getElementById("canvas-confeti"),
    src: `${current_url}/vista/login/contenido/page/05-10/json/confeti.json`, // replace with your .lottie or .json file URL
});