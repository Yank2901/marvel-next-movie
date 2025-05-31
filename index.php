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

var_dump($data);

?>

<h1>La proxima película de Marvel</h1>

<style>
    :root {
        color-scheme: dark;
    }

    body {
        display: grid;
        place-content: center;
    }
</style>