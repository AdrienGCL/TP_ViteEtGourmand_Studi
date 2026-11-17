<?php

namespace app\config;

class DeliveryConfig
{
    private static $shopCoord = [-0.5729325710222913, 44.845588015401276];
    private static $deliveryCost = 5.0;
    private static $kmCost = 0.59;
    private static $freeForZipcode = [33000];

    public static function getShopLongitude(): float
    {
        return self::$shopCoord[0];
    }

    public static function getShopLatitude(): float
    {
        return self::$shopCoord[1];
    }

    public static function getDeliveryCost(): float
    {
        return self::$deliveryCost;
    }

    public static function getKmCost(): float
    {
        return self::$kmCost;
    }

    public static function getFreeForZipcode(): array
    {
        return self::$freeForZipcode;
    }
}