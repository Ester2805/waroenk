<?php

namespace Tests\Unit;

use App\Http\Controllers\CartController;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

class CartCalculationTest extends TestCase
{
    /**
     * SKPL-UNT-01 / DUPL-UNT-01: Pengujian fungsi kalkulasi total harga pada keranjang
     * Jenis: Unit Test (White-box)
     */
    public function test_calculate_cart_total_price(): void
    {
        $controller = new CartController;

        $reflection = new ReflectionClass(CartController::class);
        $method = $reflection->getMethod('buildCartSummary');

        $cart = [
            1 => [
                'name' => 'Produk A',
                'price' => 15000,
                'quantity' => 2,
                'stock' => 10,
            ],
            2 => [
                'name' => 'Produk B',
                'price' => 5000,
                'quantity' => 3,
                'stock' => 5,
            ],
        ];

        $summary = $method->invokeArgs($controller, [$cart]);

        $this->assertEquals(45000, $summary['total']);
        $this->assertEquals('Rp 45.000', $summary['formatted_total']);

        $this->assertEquals(5, $summary['total_quantity']);

        $this->assertEquals(2, $summary['items_count']);
    }
}
