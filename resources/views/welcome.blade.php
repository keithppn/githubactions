<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
            background: linear-gradient(135deg, #101827, #1d4ed8);
            position: relative;
        }
        body::before {
            content: "HELLO WORLD  HELLO WORLD  HELLO WORLD  HELLO WORLD  HELLO WORLD  HELLO WORLD";
            position: absolute;
            inset: -20%;
            display: grid;
            place-items: center;
            color: rgba(255, 255, 255, 0.07);
            font-size: clamp(2rem, 7vw, 6rem);
            font-weight: 800;
            line-height: 2.2;
            letter-spacing: 0.12em;
            text-align: center;
            transform: rotate(-18deg);
            overflow-wrap: anywhere;
            pointer-events: none;
        }
        h1 {
            position: relative;
            margin: 0;
            padding: 1rem 2rem;
            font-size: clamp(2.5rem, 9vw, 6rem);
            letter-spacing: 0.08em;
            text-align: center;
            text-shadow: 0 8px 30px rgba(0, 0, 0, 0.3);
        }
    </style>
</head>
<body>
    <h1>HELLO WORLD</h1>
</body>
</html>
