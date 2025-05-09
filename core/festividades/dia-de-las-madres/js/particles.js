let lastHeartTime = 0;
const heartCooldown = 100;

document.addEventListener('mousemove', (e) => {
    const now = Date.now();
    if (now - lastHeartTime < heartCooldown) return;

    lastHeartTime = now;

    const heart = document.createElement('div');
    heart.className = 'heart-particles-mouse';
    heart.textContent = '🌸';

    heart.style.left = `${e.clientX}px`;
    heart.style.top = `${e.clientY}px`;

    document.getElementById('particles').appendChild(heart);

    setTimeout(() => {
        heart.remove();
    }, 2000);

    console.log('as')
});