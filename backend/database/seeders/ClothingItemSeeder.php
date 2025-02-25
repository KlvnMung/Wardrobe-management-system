<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ClothingItem;

class ClothingItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ClothingItem::create([
            'name' => 'T-Shirt',
            'category' => 'Tops',
            'size' => 'M',
            'color' => 'Blue',
        ]);

        ClothingItem::create([
            'name' => 'Jeans',
            'category' => 'Bottoms',
            'size' => '32',
            'color' => 'Black',
        ]);
    }
}
