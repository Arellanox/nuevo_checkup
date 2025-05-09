<div class="container-event">
    <div class="event-content">
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

<style>
    .container-event {
        position: absolute;
        inset: 0;
        overflow: hidden;
        z-index: 70;
    }
    .event-content {
        width: 100%;
        height: 100vh;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        padding: 2rem;
        z-index: 90;
    }


    .heart {
        position: absolute;
        font-size: 1.5rem;
        color: #ff6b81;
        animation: floatUp 2s ease-out forwards infinite;
    }

    @keyframes floatUp {
        0% {
            transform: translateY(0) scale(1);
            opacity: 1;
        }
        100% {
            transform: translateY(-100px) scale(1.5);
            opacity: 0;
        }
    }

    @keyframes float {
        0% {
            transform: translateY(0) scale(1);
            opacity: 1;
        }
        100% {
            transform: translateY(-100vh) scale(1.5);
            opacity: 0;
        }
    }
</style>