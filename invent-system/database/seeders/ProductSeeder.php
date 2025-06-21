<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        Product::create([
            'name_product' => 'Laptop Dell XPS 13',
            'desc_product' => 'Laptop premium dengan performa tinggi',
            'harga_product' => '15000000',
            'stock_product' => '10'
        ]);

        Product::create([
            'name_product' => 'Mouse Wireless Logitech',
            'desc_product' => 'Mouse wireless untuk produktivitas',
            'harga_product' => '250000',
            'stock_product' => '25'
        ]);

        Product::create([
            'name_product' => 'Keyboard Mechanical',
            'desc_product' => 'Keyboard mechanical RGB untuk gaming',
            'harga_product' => '750000',
            'stock_product' => '15'
        ]);

        Product::create([
            'name_product' => 'Monitor 24 inch',
            'desc_product' => 'Monitor Full HD untuk kerja dan gaming',
            'harga_product' => '2500000',
            'stock_product' => '8'
        ]);

        Product::create([
            'name_product' => 'Headset Gaming',
            'desc_product' => 'Headset dengan surround sound',
            'harga_product' => '500000',
            'stock_product' => '20'
        ]);
    }
}
