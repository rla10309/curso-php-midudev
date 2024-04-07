<?php

const API_URL = "https://whenisthenextmcufilm.com/api";


$curlHandler = curl_init(API_URL);

// Indicar que queremos recibir el resultado de la petición y no mostrarla en pantalla
curl_setopt($curlHandler, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curlHandler, CURLOPT_SSL_VERIFYPEER, false);

// Ejecutar la petición y guardar el resultado
$result = curl_exec($curlHandler);

if ($result === false) {
    echo 'Error de cURL: ' . curl_error($curlHandler);
}


// Una alternativa es utilizar file_get_contents
// $result = file_get_contents(API_URL); // Si solo quieres hacer un GET de una API
$data = json_decode($result, true);

curl_close($curlHandler);


?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La próxima película de Marvel</title>
    <!-- Centered viewport -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.classless.min.css" />
    <style>
        section{
            display: flex;
            justify-content: center;
        }
        h3, p{
            text-align: center;
        }
    </style>
</head>

<body>
    <main>
        <section>
            <img src="<?php echo $data["poster_url"]; ?>" alt="Póster de <?php echo $data["title"]; ?>" width="300" style="border-radius: 10px;">
        </section>
        <hgroup>
            <h3><?php echo $data["title"]; ?> se estrena en <?php echo $data["days_until"]; ?> días</h2>
            <p>Fecha de estreno <?php echo $data["release_date"]; ?></p>
            <p>La siguiente es <?php echo $data["following_production"]["title"]; ?></p>
        </hgroup>

    </main>

</body>

</html>