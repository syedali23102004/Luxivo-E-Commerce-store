<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Seed the database with categories.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Electronics',
                'slug' => 'electronics',
                'icon' => 'fas fa-laptop',
                'description' => 'Latest gadgets and electronic devices including phones, laptops, tablets, and more.',
            ],
            [
                'name' => 'Fashion',
                'slug' => 'fashion',
                'icon' => 'fas fa-tshirt',
                'description' => 'Trendy clothing, shoes, and fashion accessories for men and women.',
            ],
            [
                'name' => 'Home & Garden',
                'slug' => 'home-garden',
                'icon' => 'fas fa-home',
                'description' => 'Home décor, furniture, gardening tools, and household items.',
            ],
            [
                'name' => 'Books',
                'slug' => 'books',
                'icon' => 'fas fa-book',
                'description' => 'Wide selection of books across various genres and languages.',
            ],
            [
                'name' => 'Sports & Outdoors',
                'slug' => 'sports-outdoors',
                'icon' => 'fas fa-football-ball',
                'description' => 'Sports equipment, outdoor gear, and fitness accessories.',
            ],
            [
                'name' => 'Beauty & Personal Care',
                'slug' => 'beauty-personal-care',
                'icon' => 'fas fa-spa',
                'description' => 'Cosmetics, skincare, haircare products, and personal hygiene items.',
            ],
            [
                'name' => 'Toys & Games',
                'slug' => 'toys-games',
                'icon' => 'fas fa-gamepad',
                'description' => 'Educational toys, board games, video games, and entertainment products.',
            ],
            [
                'name' => 'Food & Beverages',
                'slug' => 'food-beverages',
                'icon' => 'fas fa-utensils',
                'description' => 'Gourmet foods, beverages, snacks, and grocery items.',
            ],
            [
                'name' => 'Furniture',
                'slug' => 'furniture',
                'icon' => 'fas fa-chair',
                'description' => 'Modern and traditional furniture for bedroom, living room, and office.',
            ],
            [
                'name' => 'Health & Wellness',
                'slug' => 'health-wellness',
                'icon' => 'fas fa-heartbeat',
                'description' => 'Vitamins, supplements, health equipment, and wellness products.',
            ],
            [
                'name' => 'Automotive',
                'slug' => 'automotive',
                'icon' => 'fas fa-car',
                'description' => 'Car accessories, parts, maintenance products, and automotive gear.',
            ],
            [
                'name' => 'Jewelry & Watches',
                'slug' => 'jewelry-watches',
                'icon' => 'fas fa-ring',
                'description' => 'Elegant jewelry, precious metals, watches, and accessories.',
            ],
            [
                'name' => 'Pet Supplies',
                'slug' => 'pet-supplies',
                'icon' => 'fas fa-paw',
                'description' => 'Pet food, toys, grooming products, and pet care essentials.',
            ],
            [
                'name' => 'Office Supplies',
                'slug' => 'office-supplies',
                'icon' => 'fas fa-briefcase',
                'description' => 'Stationery, office furniture, organization tools, and work essentials.',
            ],
            [
                'name' => 'Music & Instruments',
                'slug' => 'music-instruments',
                'icon' => 'fas fa-music',
                'description' => 'Musical instruments, audio equipment, and music accessories.',
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
