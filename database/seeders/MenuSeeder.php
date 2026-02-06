<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Menu::create([
            'name' => 'Roti Coklat Lumer',
            'category' => 'Roti Manis',
            'price' => 12000,
            'description' => 'Roti lembut dengan isian coklat belgia.',
            'image' => 'https://via.placeholder.com/150'
        ]);

        \App\Models\Menu::create([
            'name' => 'Croissant Butter',
            'category' => 'Pastry',
            'price' => 25000,
            'description' => 'Renyah di luar, lembut di dalam.',
            'image' => 'https://via.placeholder.com/150'
        ]);

        \App\Models\Menu::create([
            'name' => 'Donat Gula Halus',
            'category' => 'Donat',
            'price' => 8000,
            'description' => 'Donat kampung klasik tabur gula.',
            'image' => 'https://via.placeholder.com/150'
        ]);
    }
}