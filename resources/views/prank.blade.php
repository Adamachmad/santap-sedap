@extends('layouts.app')

@section('content')
<div class="prank-container">
    <canvas id="confetti"></canvas>

    <!-- Floating emojis -->
    <div class="emoji">😂</div>
    <div class="emoji">🤡</div>
    <div class="emoji">🤪</div>
    <div class="emoji">🤣</div>
    <div class="emoji">👻</div>
    <div class="emoji">👀</div>

    <div class="prank-text">ANDA KENA PRANK!</div>
    <div class="laughing">WKWKWKWKWKWKWK</div>

    <a href="{{ url('/') }}" class="btn-back">Kembali ke Dunia Nyata 🏃‍♂️</a>
</div>

<style>
    /* Scoped container to avoid breaking navbar/footer */
    .prank-container {
        position: relative;
        width: 100%;
        min-height: 80vh;
        background-color: #1a1a2e;
        color: #fff;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        overflow: hidden;
        border-radius: 15px;
        margin-top: 20px;
        margin-bottom: 20px;
        box-shadow: 0 0 30px rgba(0,0,0,0.5);
    }

    /* The main prank text */
    .prank-text {
        font-size: 4rem;
        font-weight: 900;
        text-align: center;
        text-transform: uppercase;
        text-shadow: 0 0 20px rgba(255, 71, 87, 0.8), 0 0 40px rgba(255, 71, 87, 0.5);
        animation: shake 0.5s infinite, colorChange 3s infinite alternate;
        margin-bottom: 20px;
        z-index: 10;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    /* Subtext laughing */
    .laughing {
        font-size: 2rem;
        color: #2ed573;
        animation: bounce 1s infinite alternate;
        text-shadow: 0 0 10px rgba(46, 213, 115, 0.6);
        z-index: 10;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        font-weight: bold;
    }

    /* Fun background elements */
    .emoji {
        position: absolute;
        font-size: 3rem;
        animation: float 4s infinite ease-in-out;
        opacity: 0.8;
        z-index: 1;
    }

    .emoji:nth-child(2) { top: 10%; left: 20%; animation-delay: 0s; }
    .emoji:nth-child(3) { top: 70%; left: 80%; animation-delay: 1s; }
    .emoji:nth-child(4) { top: 30%; left: 70%; animation-delay: 2s; }
    .emoji:nth-child(5) { top: 80%; left: 15%; animation-delay: 0.5s; }
    .emoji:nth-child(6) { top: 50%; left: 10%; animation-delay: 1.5s; }
    .emoji:nth-child(7) { top: 20%; left: 85%; animation-delay: 2.5s; }

    /* Go back button */
    .btn-back {
        margin-top: 40px;
        padding: 15px 30px;
        font-size: 1.2rem;
        font-weight: bold;
        color: #fff;
        background: linear-gradient(45deg, #ff4757, #ff6b81);
        border: none;
        border-radius: 50px;
        cursor: pointer;
        box-shadow: 0 10px 20px rgba(255, 71, 87, 0.4);
        transition: transform 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275), box-shadow 0.3s;
        text-decoration: none;
        z-index: 10;
    }

    .btn-back:hover {
        transform: scale(1.1) translateY(-5px);
        box-shadow: 0 15px 25px rgba(255, 71, 87, 0.6);
        color: #fff;
    }

    /* Animations */
    @keyframes shake {
        0% { transform: translate(1px, 1px) rotate(0deg); }
        10% { transform: translate(-1px, -2px) rotate(-1deg); }
        20% { transform: translate(-3px, 0px) rotate(1deg); }
        30% { transform: translate(3px, 2px) rotate(0deg); }
        40% { transform: translate(1px, -1px) rotate(1deg); }
        50% { transform: translate(-1px, 2px) rotate(-1deg); }
        60% { transform: translate(-3px, 1px) rotate(0deg); }
        70% { transform: translate(3px, 1px) rotate(-1deg); }
        80% { transform: translate(-1px, -1px) rotate(1deg); }
        90% { transform: translate(1px, 2px) rotate(0deg); }
        100% { transform: translate(1px, -2px) rotate(-1deg); }
    }

    @keyframes colorChange {
        0% { color: #ff4757; text-shadow: 0 0 20px rgba(255, 71, 87, 0.8); }
        50% { color: #ffa502; text-shadow: 0 0 20px rgba(255, 165, 2, 0.8); }
        100% { color: #ff4757; text-shadow: 0 0 20px rgba(255, 71, 87, 0.8); }
    }

    @keyframes bounce {
        from { transform: translateY(0); }
        to { transform: translateY(-20px); }
    }

    @keyframes float {
        0%, 100% { transform: translateY(0) rotate(0deg); }
        50% { transform: translateY(-30px) rotate(20deg); }
    }

    /* Confetti Canvas */
    #confetti {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        pointer-events: none;
        z-index: 0;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const canvas = document.getElementById('confetti');
        const ctx = canvas.getContext('2d');
        
        // Sesuaikan dengan ukuran container
        const container = document.querySelector('.prank-container');
        canvas.width = container.offsetWidth;
        canvas.height = container.offsetHeight;

        const pieces = [];
        const colors = ['#ff4757', '#2ed573', '#1e90ff', '#ffa502', '#eccc68'];

        for (let i = 0; i < 100; i++) {
            pieces.push({
                x: Math.random() * canvas.width,
                y: Math.random() * canvas.height,
                vx: Math.random() * 4 - 2,
                vy: Math.random() * 4 + 2,
                size: Math.random() * 10 + 5,
                color: colors[Math.floor(Math.random() * colors.length)],
                rotation: Math.random() * 360,
                rotationSpeed: Math.random() * 10 - 5
            });
        }

        function draw() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            pieces.forEach(p => {
                ctx.save();
                ctx.translate(p.x, p.y);
                ctx.rotate(p.rotation * Math.PI / 180);
                ctx.fillStyle = p.color;
                ctx.fillRect(-p.size/2, -p.size/2, p.size, p.size);
                ctx.restore();

                p.y += p.vy;
                p.x += p.vx;
                p.rotation += p.rotationSpeed;

                if (p.y > canvas.height) {
                    p.y = -p.size;
                    p.x = Math.random() * canvas.width;
                }
            });
            requestAnimationFrame(draw);
        }

        draw();

        window.addEventListener('resize', () => {
            canvas.width = container.offsetWidth;
            canvas.height = container.offsetHeight;
        });
    });
</script>
@endsection
