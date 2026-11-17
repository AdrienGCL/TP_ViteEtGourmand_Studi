<?php

declare(strict_types=1);

header('Content-Type: application/json; charset=utf-8');

$query = trim($_GET['q'] ?? '');

if (mb_strlen($query) < 3) {
    http_response_code(400);

    echo json_encode([
        'error' => 'La recherche doit contenir au moins 3 caractères.'
    ]);

    exit;
}

// Préparation des paramètres de recherche
$params = [
    'text' => $query,
    'terr' => 'METROPOLE',
    'type' => 'StreetAddress',
    'maximumResponses' => 5
];

$url = 'https://data.geopf.fr/geocodage/completion/?'. http_build_query($params);

// Initialisation de cURL
$curl = curl_init($url);

curl_setopt_array($curl, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_CONNECTTIMEOUT => 3,
    CURLOPT_TIMEOUT => 5,
    CURLOPT_FOLLOWLOCATION => false,
    CURLOPT_HTTPHEADER => [
        'Accept: application/json'
    ]
]);

$response = curl_exec($curl);
$statusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
$curlError = curl_errno($curl);

curl_close($curl);

// Gestion des erreurs réseau ou HTTP
if ($response === false || $curlError !== 0) {
    http_response_code(502);

    echo json_encode([
        'error' => 'Le service d’adresses est temporairement indisponible.'
    ]);

    exit;
}

if ($statusCode < 200 || $statusCode >= 300) {
    http_response_code(502);

    echo json_encode([
        'error' => 'Le service d’adresses a renvoyé une erreur.'
    ]);

    exit;
}

// Vérification du JSON reçu
$data = json_decode($response, true);

if (!is_array($data) || !isset($data['results'])) {
    http_response_code(502);

    echo json_encode([
        'error' => 'La réponse du service d’adresses est invalide.'
    ]);

    exit;
}

// Transmission des résultats au navigateur
echo json_encode(
    $data,
    JSON_UNESCAPED_UNICODE
        | JSON_UNESCAPED_SLASHES
);