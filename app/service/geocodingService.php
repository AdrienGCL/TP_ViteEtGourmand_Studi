<?php

declare(strict_types=1);

namespace app\service;

use InvalidArgumentException;
use JsonException;
use RuntimeException;

class GeocodingService
{
    private const API_URL = 'https://data.geopf.fr/geocodage/search';

    public function geocodeAddress(string $address, string $zipcode, string $city): array
    {
        $address = trim($address);
        $zipcode = trim($zipcode);
        $city = trim($city);

        if ($address === '' || !preg_match('/^\d{5}$/', $zipcode) || $city === ''){
            throw new InvalidArgumentException('Adresse, code postal ou ville invalide.');
        }

        // Recherche à partir des trois informations soumises.
        $query = implode(' ', [$address, $zipcode, $city]);

        $params = [
            'q' => $query,
            'index' => 'address',
            'limit' => 5,
            'autocomplete' => 0
        ];

        $url = self::API_URL . '?' .http_build_query($params);

        $curl = curl_init($url);

        if ($curl === false) {
            throw new RuntimeException('Impossible d’initialiser cURL.');
        }

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
        $httpCode = (int) curl_getinfo($curl, CURLINFO_HTTP_CODE);
        $curlError = curl_error($curl);
        $curlErrno = curl_errno($curl);

        curl_close($curl);

        if ($response === false || $curlErrno !== 0) {
            throw new RuntimeException('Erreur de communication avec le service ' . 'de géocodage : ' . $curlError);
        }

        if ($httpCode !== 200) {
            throw new RuntimeException('Le service de géocodage a renvoyé ' . 'le statut HTTP ' . $httpCode . '.');
        }

        try {
            $data = json_decode(
                $response,
                true,
                512,
                JSON_THROW_ON_ERROR
            );
        } catch (JsonException $exception) {
            throw new RuntimeException('La réponse du service de géocodage ' . 'est invalide.', 0, $exception);
        }

        if (!is_array($data) || !isset($data['features']) || !is_array($data['features'])) {
            throw new RuntimeException('Structure de réponse GeoJSON inattendue.');
        }

        return $data['features'];
    }
}
