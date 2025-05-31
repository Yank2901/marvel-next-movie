<?php

const API_URL = 'https://whenisthenextmcufilm.com/api';
// Inicializar una nueva sesión de CURL; ch = CURL handle
$ch = curl_init(API_URL);
// Indicar que queremos recibir la respuesta de la petición y no que se imprima directamente
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// Ejecutar la petición y almacenar la respuesta
$response = curl_exec($ch);
$data = json_decode($response, true);
// Cerrar la sesión de CURL
curl_close($ch);

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta description="Información sobre la próxima película de Marvel">
    <title>Próxima película de Marvel</title>
    <!-- Centered viewport -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.classless.min.css">
</head>

<main>
    <section class="tilt-card">
        <img 
            src = <?= $data['poster_url'] ?>
            alt = "Poster de <?= $data['title'] ?>"
            width = "300"
            loading = "lazy"
        />
    </section>
    <hgroup>
        <h2><?= $data['title'] ?> se estrena en <?= $data["days_until"] ?> días</h2>
        <p>Fecha de estreno: <?= $data["release_date"] ?></p>
        <p> La siguiente es: <?= $data["following_production"]["title"] ?> </p>
    </hgroup>
</main>

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
    }

    main {
        text-align: center;
        max-width: 600px;
        padding: 20px;
    }

    img {
        display: block;
        margin: 0 auto 20px;
    }
</style>
