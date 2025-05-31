<?php

const API_URL = 'https://whenisthenextmcufilm.com/api';

$ch = curl_init(API_URL);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
if ($response === false) {
    die('Error en CURL: ' . curl_error($ch));
}
$data = json_decode($response, true);
curl_close($ch);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Información sobre la próxima película de Marvel">
    <title>Próxima película de Marvel</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.classless.min.css">
    <style>
        :root {
            color-scheme: dark;
        }

        body {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
            font-family: sans-serif;
            background: radial-gradient(circle at center, #333 0%, #1a1a1a 100%);
        }

        main {
            text-align: center;
            max-width: 600px;
            padding: 20px;
        }

        .tilt-card {
            position: relative;
            perspective: 1000px;
            display: inline-block;
            border-radius: 12px;
            overflow: hidden;
            padding: 10px;
            background: rgba(0, 0, 0, 0.2);
            box-shadow:
                0 0 25px rgba(255, 215, 0, 0.6),
                0 0 40px rgba(255, 215, 0, 0.2) inset;
            transition: box-shadow 0.5s ease, transform 0.3s ease;
        }

        .tilt-card:hover {
            box-shadow:
                0 0 35px rgba(255, 215, 0, 0.8),
                0 0 80px rgba(255, 215, 0, 0.4) inset;
        }

        .tilt-card img {
            display: block;
            margin: 0 auto;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
            transition: transform 0.2s ease;
            width: 300px;
            max-width: 100%;
            height: auto;
        }
    </style>
</head>

<body>
    <main>
        <section class="tilt-card">
            <img
                src="<?= htmlspecialchars($data['poster_url']) ?>"
                alt="Poster de <?= htmlspecialchars($data['title']) ?>"
                loading="lazy" />
        </section>
        <hgroup>
            <h2><?= htmlspecialchars($data['title']) ?> se estrena en <?= htmlspecialchars($data['days_until']) ?> días</h2>
            <p>Fecha de estreno: <?= htmlspecialchars($data['release_date']) ?></p>
            <p>La siguiente es: <?= htmlspecialchars($data['following_production']['title']) ?></p>
        </hgroup>
    </main>

    <script>
        const card = document.querySelector('.tilt-card');

        card.addEventListener('mousemove', (e) => {
            const rect = card.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;

            const centerX = rect.width / 2;
            const centerY = rect.height / 2;

            const rotateX = ((y - centerY) / centerY) * 15;
            const rotateY = ((centerX - x) / centerX) * 15;

            card.style.transform = `rotateX(${rotateX}deg) rotateY(${rotateY}deg)`;
        });

        card.addEventListener('mouseleave', () => {
            card.style.transform = 'rotateX(0deg) rotateY(0deg)';
        });
    </script>
</body>

</html>
