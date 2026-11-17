<?php

namespace app\config;

class OrderConfig
{
    private static $quantityForDiscount = 5;
    private static $quantityDiscountPercent = 10;

    public static function getQuantityForDiscount(): int
    {
        return self::$quantityForDiscount;
    }

    public static function getQuantityDiscountPercent(): int
    {
        return self::$quantityDiscountPercent;
    }
}