<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Services\CartService;

class CartServiceTest extends TestCase
{
    /**
     * DUPL-UNT-04: Pengujian fungsi kalkulasi diskon pada keranjang
     * Jenis: Pure Unit Test (White-box)
     */
    public function test_cart_discount_calculation(): void
    {
        // 1. Arrange: Siapkan file unit fungsi custom yang telah Anda buat
        $cartService = new CartService();
        
        $total = 100000;
        $discountPercentage = 10;
        
        // 2. Act: Panggil fungsi kalkulasi diskon dengan persentase tertentu
        $result = $cartService->calculateDiscount($total, $discountPercentage);
        
        // 3. Assert: Fungsi mengembalikan nilai 90000 dengan benar
        $this->assertEquals(90000, $result, "Diskon 10% dari 100.000 harus menghasilkan 90.000");
    }
}
