<?php

namespace app\service;

use app\config\DeliveryConfig;

class DeliveryService
{
    public static function calculateDeliveryCost(float $distance, int $zipcode): float
    {
        $deliveryCost = DeliveryConfig::getDeliveryCost();
        $kmCost = DeliveryConfig::getKmCost();
        $freeForZipcode = DeliveryConfig::getFreeForZipcode();

        if (in_array($zipcode, $freeForZipcode)) {
            return 0.0; // Livraison gratuite pour les codes postaux spécifiés
        }

        // return le prix arrondi au centime supérieur
        return ceil(($deliveryCost + ($distance * $kmCost)) * 100) / 100;
    }
}