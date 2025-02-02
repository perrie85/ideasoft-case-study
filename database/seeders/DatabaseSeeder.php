<?php

namespace Database\Seeders;

use App\Enums\DiscountTypeEnum;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Discount;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Customer::query()->create(['name' => "Türker Jöntürk", 'revenue' => 0]);
        Customer::query()->create(['name' => "Kaptan Devopuz", 'revenue' => 0]);
        Customer::query()->create(['name' => "İsa Sonuyumaz", 'revenue' => 0]);

        $category1 = Category::query()->create(['name' => "Tornavida Seti"]);
        $category2 = Category::query()->create(['name' => "Priz ve Anahtar"]);

        Product::query()->create([
            'name' => "Black&Decker A7062 40 Parça Cırcırlı Tornavida Seti",
            'price' => 120.75,
            'stock' => 10,
            'category_id' => $category1->id,
        ]);

        Product::query()->create([
            'name' => "Reko Mini Tamir Hassas Tornavida Seti 32'li",
            'price' => 49.50,
            'stock' => 10,
            'category_id' => $category1->id,
        ]);

        Product::query()->create([
            'name' => "Viko Karre Anahtar - Beyaz",
            'price' => 11.28,
            'stock' => 10,
            'category_id' => $category2->id,
        ]);

        $product3 = Product::query()->create([
            'name' => "Legrand Salbei Anahtar, Alüminyum",
            'price' => 22.80,
            'stock' => 10,
            'category_id' => $category2->id,
        ]);

        Product::query()->create([
            'name' => "Schneider Asfora Beyaz Komütatör",
            'price' => 12.95,
            'stock' => 10,
            'category_id' => $category2->id,
        ]);

        Discount::query()->create([
            'type' => DiscountTypeEnum::BUY_5_GET_1->value,
            'category_id' => $category2->id,
            'product_id' => null,
            'total' => null,
            'is_active' => true,
        ]);

        Discount::query()->create([
            'type' => DiscountTypeEnum::DISCOUNT_BY_CATEGORY->value,
            'category_id' => $category1->id,
            'product_id' => null,
            'total' => null,
            'is_active' => true,
        ]);

        Discount::query()->create([
            'type' => DiscountTypeEnum::DISCOUNT_BY_TOTAL->value,
            'category_id' => null,
            'product_id' => null,
            'total' => 1000,
            'is_active' => true,
        ]);
    }
}
