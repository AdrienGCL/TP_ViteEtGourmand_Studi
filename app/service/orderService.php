<?php

namespace app\service;

use app\config\OrderConfig;

class OrderService
{
    public static function calculateQuantityDiscount(int $quantityOrdered, int $minimumQuantity, float $itemPrice): float
    {
        $quantityForDiscount = OrderConfig::getQuantityForDiscount();
        $quantityDiscountPercent = OrderConfig::getQuantityDiscountPercent();

        if ($quantityOrdered >= $minimumQuantity + $quantityForDiscount) {
            $discountAmount = $quantityOrdered * $itemPrice * ($quantityDiscountPercent / 100);
            return $discountAmount;
        }

        return 0.0;
    }

    public static function calculateTotalPrice(float $itemPrice, int $quantityOrdered, float $discountAmount, float $deliveryCost): float
    {
        $totalPrice = ($itemPrice * $quantityOrdered) - $discountAmount + $deliveryCost;
        return max($totalPrice, 0.0); // Le prix total ne doit pas être négatif
    }
}