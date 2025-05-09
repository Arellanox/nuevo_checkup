let lastHeartTime = 0;
const heartCooldown = 50; // milisegundos entre corazones

document.addEventListener('mousemove', (e) => {
    const now = Date.now();
    if (now - lastHeartTime < heartCooldown) return; // espera un poco

    lastHeartTime = now;

    const heart = document.createElement('div');
    heart.className = 'heart';
    heart.textContent = '🌸'; // puedes cambiar por 🌸 o ❤️

    heart.style.left = `${e.clientX}px`;
    heart.style.top = `${e.clientY}px`;

    document.getElementById('hearts-container').appendChild(heart);

    setTimeout(() => {
        heart.remove();
    }, 2000);
});