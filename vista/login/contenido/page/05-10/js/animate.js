import anime from 'https://cdn.jsdelivr.net/npm/animejs@3.2.1/lib/anime.es.js';

anime({
    targets: '.message span',
    translateY: [
        { value: -40, easing: 'easeOutElastic(1, .5)', duration: 700 },
        { value: 0, easing: 'easeOutBounce', duration: 800 }
    ],
    rotate: {
        value: '-1turn',
        easing: 'easeInOutSine',
        duration: 1000
    },
    delay: anime.stagger(50),
    loop: true,
    loopDelay: 1500
});

