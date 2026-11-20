<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#050817">
    <title>Hello World</title>
    <style>
        * { box-sizing: border-box; }
        body {
            min-height: 100vh;
            margin: 0;
            display: grid;
            place-items: center;
            overflow: hidden;
            color: #fff;
            font-family: Arial, Helvetica, sans-serif;
            position: relative;
            isolation: isolate;
            background:
                radial-gradient(ellipse at 50% 55%, rgba(55, 24, 125, .46), transparent 46%),
                radial-gradient(ellipse at 15% 20%, rgba(20, 100, 180, .2), transparent 35%),
                radial-gradient(ellipse at 82% 78%, rgba(141, 31, 125, .2), transparent 36%),
                #050817;
        }
        body::before, body::after {
            content: "";
            position: absolute;
            inset: -50%;
            z-index: -1;
            pointer-events: none;
        }
        body::before {
            opacity: .45;
            background-image:
                radial-gradient(1px 1px at 10% 20%, #fff 99%, transparent),
                radial-gradient(1.5px 1.5px at 35% 65%, #b8eaff 99%, transparent),
                radial-gradient(1px 1px at 70% 15%, #fff 99%, transparent),
                radial-gradient(2px 2px at 85% 70%, #ffd7ff 99%, transparent),
                radial-gradient(1px 1px at 55% 42%, #fff 99%, transparent);
            background-size: 290px 260px, 370px 310px, 330px 290px, 420px 360px, 250px 230px;
            animation: drift 100s linear infinite, twinkle 4s ease-in-out infinite alternate;
        }
        body::after {
            inset: auto;
            width: min(80vw, 760px);
            aspect-ratio: 1;
            top: 50%;
            left: 50%;
            z-index: -1;
            border-radius: 50%;
            transform: translate(-50%, -50%);
            background: radial-gradient(circle, transparent 45%, rgba(35, 88, 201, .08) 62%, transparent 70%);
            filter: blur(12px);
            animation: nebula 8s ease-in-out infinite alternate;
        }
        #glitter {
            position: fixed;
            inset: 0;
            z-index: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
        }
        h1 {
            position: relative;
            z-index: 1;
            margin: 0;
            padding: 1rem 1.5rem;
            text-align: center;
            font-size: clamp(2.5rem, 10vw, 7rem);
            font-weight: 800;
            letter-spacing: .08em;
            color: transparent;
            background: linear-gradient(110deg, #fff 10%, #b9eaff 34%, #fff 50%, #f3baff 68%, #fff 90%);
            background-size: 220% auto;
            background-clip: text;
            -webkit-background-clip: text;
            filter: drop-shadow(0 0 18px rgba(125, 194, 255, .62));
            animation: shimmer 5s linear infinite, float 4s ease-in-out infinite;
        }
        @keyframes drift { to { transform: rotate(360deg); } }
        @keyframes twinkle { from { opacity: .24; } to { opacity: .62; } }
        @keyframes nebula { from { opacity: .5; scale: .94; } to { opacity: 1; scale: 1.08; } }
        @keyframes shimmer { to { background-position: 220% center; } }
        @keyframes float { 0%, 100% { translate: 0 0; } 50% { translate: 0 -8px; } }
        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after { animation-duration: .01ms !important; animation-iteration-count: 1 !important; }
        }
    </style>
</head>
<body>
    <canvas id="glitter" aria-hidden="true"></canvas>
    <h1>HELLO WORLD</h1>
    <script>
        (() => {
            const canvas = document.getElementById('glitter');
            const context = canvas.getContext('2d');
            const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
            let width, height, particles = [], animationFrame;

            function resize() {
                const ratio = Math.min(window.devicePixelRatio || 1, 2);
                width = window.innerWidth;
                height = window.innerHeight;
                canvas.width = width * ratio;
                canvas.height = height * ratio;
                context.setTransform(ratio, 0, 0, ratio, 0, 0);
                particles = Array.from({ length: Math.min(150, Math.floor(width / 8)) }, createParticle);
            }

            function createParticle(startAbove = false) {
                return {
                    x: Math.random() * width,
                    y: startAbove ? -Math.random() * height : Math.random() * height,
                    speed: .35 + Math.random() * 1.6,
                    drift: (Math.random() - .5) * .55,
                    size: .6 + Math.random() * 2.1,
                    hue: [190, 205, 265, 300, 45][Math.floor(Math.random() * 5)],
                    phase: Math.random() * Math.PI * 2,
                };
            }

            function draw(time = 0) {
                context.clearRect(0, 0, width, height);
                particles.forEach((particle) => {
                    particle.y += particle.speed;
                    particle.x += particle.drift;
                    if (particle.y > height + 5) Object.assign(particle, createParticle(true));
                    if (particle.x < -5) particle.x = width + 5;
                    if (particle.x > width + 5) particle.x = -5;

                    const flicker = .35 + (Math.sin(time / 350 + particle.phase) + 1) * .32;
                    context.beginPath();
                    context.fillStyle = `hsla(${particle.hue}, 100%, 82%, ${flicker})`;
                    context.shadowColor = `hsla(${particle.hue}, 100%, 75%, .8)`;
                    context.shadowBlur = particle.size * 5;
                    context.arc(particle.x, particle.y, particle.size, 0, Math.PI * 2);
                    context.fill();
                });
                context.shadowBlur = 0;
                if (!reduceMotion) animationFrame = requestAnimationFrame(draw);
            }

            window.addEventListener('resize', resize);
            document.addEventListener('visibilitychange', () => {
                if (document.hidden) cancelAnimationFrame(animationFrame);
                else if (!reduceMotion) animationFrame = requestAnimationFrame(draw);
            });
            resize();
            draw();
        })();
    </script>
</body>
</html>
