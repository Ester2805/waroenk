<?php

namespace App\Services;

class CartService
{
    /**
     * Fungsi custom untuk menghitung diskon pada keranjang.
     * Mengacu pada kebutuhan pengujian DUPL-UNT-04.
     * 
     * @param float $total Harga total sebelum diskon
     * @param float $discountPercentage Persentase diskon (misal 10 untuk 10%)
     * @return float Harga total setelah dikurangi diskon
     */
    public function calculateDiscount(float $total, float $discountPercentage): float
    {
        // Validasi dasar, tidak boleh minus atau lebih dari 100%
        if ($discountPercentage < 0 || $discountPercentage > 100) {
            return $total;
        }

        $discountAmount = $total * ($discountPercentage / 100);
        return $total - $discountAmount;
    }
}
