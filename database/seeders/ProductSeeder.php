<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            // Electronics (id:1)
            ['category_slug' => 'electronics', 'name' => 'iPhone 15 Pro Max', 'slug' => 'iphone-15-pro-max', 'price' => 149999, 'discount_price' => 134999, 'description' => 'Latest iPhone with A17 Pro chip.', 'brand' => 'Apple', 'stock' => 50, 'featured' => true, 'image' => '/images/products/electronics.jpg'],
            ['category_slug' => 'electronics', 'name' => 'Samsung Galaxy S24 Ultra', 'slug' => 'samsung-galaxy-s24-ultra', 'price' => 189999, 'discount_price' => 161499, 'description' => 'Samsung flagship with S Pen.', 'brand' => 'Samsung', 'stock' => 40, 'featured' => true, 'image' => '/images/products/electronics.jpg'],
            ['category_slug' => 'electronics', 'name' => 'MacBook Air M3', 'slug' => 'macbook-air-m3', 'price' => 520000, 'discount_price' => 469000, 'description' => 'Thin and powerful MacBook Air.', 'brand' => 'Apple', 'stock' => 20, 'featured' => false, 'image' => '/images/products/laptops.jpg'],
            ['category_slug' => 'electronics', 'name' => 'Dell XPS 15', 'slug' => 'dell-xps-15', 'price' => 480000, 'discount_price' => 430000, 'description' => 'Premium Dell laptop with RTX 4070.', 'brand' => 'Dell', 'stock' => 15, 'featured' => false, 'image' => '/images/products/laptops.jpg'],
            ['category_slug' => 'electronics', 'name' => 'Sony WH-1000XM5', 'slug' => 'sony-wh-1000xm5', 'price' => 85000, 'discount_price' => 75000, 'description' => 'Best noise cancelling headphones.', 'brand' => 'Sony', 'stock' => 60, 'featured' => false, 'image' => '/images/products/electronics.jpg'],
            ['category_slug' => 'electronics', 'name' => 'Sony A7R V Camera', 'slug' => 'sony-a7r-v', 'price' => 620000, 'discount_price' => 558000, 'description' => 'Professional mirrorless camera.', 'brand' => 'Sony', 'stock' => 10, 'featured' => false, 'image' => '/images/products/cameras.jpg'],
            ['category_slug' => 'electronics', 'name' => 'Canon EOS R6 Mark II', 'slug' => 'canon-eos-r6', 'price' => 480000, 'discount_price' => 432000, 'description' => 'Fast autofocus mirrorless camera.', 'brand' => 'Canon', 'stock' => 12, 'featured' => false, 'image' => '/images/products/cameras.jpg'],
            ['category_slug' => 'electronics', 'name' => 'PlayStation 5', 'slug' => 'playstation-5', 'price' => 125000, 'discount_price' => 112500, 'description' => 'Sony PS5 disc edition console.', 'brand' => 'Sony', 'stock' => 20, 'featured' => false, 'image' => '/images/products/gaming.jpg'],
            ['category_slug' => 'electronics', 'name' => 'Xbox Series X', 'slug' => 'xbox-series-x', 'price' => 115000, 'discount_price' => 103500, 'description' => 'Microsoft Xbox Series X.', 'brand' => 'Microsoft', 'stock' => 18, 'featured' => false, 'image' => '/images/products/gaming.jpg'],
            ['category_slug' => 'electronics', 'name' => 'Nintendo Switch OLED', 'slug' => 'nintendo-switch-oled', 'price' => 85000, 'discount_price' => 76500, 'description' => 'Nintendo Switch OLED screen.', 'brand' => 'Nintendo', 'stock' => 25, 'featured' => false, 'image' => '/images/products/gaming.jpg'],

            // Fashion (id:2)
            ['category_slug' => 'fashion', 'name' => 'Wool Suit 3-Piece', 'slug' => 'wool-suit-3-piece', 'price' => 45000, 'discount_price' => 40500, 'description' => 'Premium 3-piece wool formal suit.', 'brand' => 'Luxury Wear', 'stock' => 25, 'featured' => true, 'image' => '/images/products/fashion-men.jpg'],
            ['category_slug' => 'fashion', 'name' => 'Leather Jacket', 'slug' => 'leather-jacket', 'price' => 38000, 'discount_price' => 34200, 'description' => 'Genuine leather biker jacket.', 'brand' => 'Leather Co', 'stock' => 20, 'featured' => true, 'image' => '/images/products/fashion-men.jpg'],
            ['category_slug' => 'fashion', 'name' => 'Designer Kurta Shalwar', 'slug' => 'designer-kurta-shalwar', 'price' => 12500, 'discount_price' => 11250, 'description' => 'Embroidered traditional kurta.', 'brand' => 'Gul Ahmed', 'stock' => 50, 'featured' => false, 'image' => '/images/products/fashion-men.jpg'],
            ['category_slug' => 'fashion', 'name' => 'Calvin Klein Jeans', 'slug' => 'calvin-klein-jeans', 'price' => 15000, 'discount_price' => 13500, 'description' => 'Slim fit premium denim jeans.', 'brand' => 'Calvin Klein', 'stock' => 40, 'featured' => false, 'image' => '/images/products/fashion-men.jpg'],
            ['category_slug' => 'fashion', 'name' => 'Designer Silk Saree', 'slug' => 'designer-silk-saree', 'price' => 35000, 'discount_price' => 31500, 'description' => 'Pure silk designer saree.', 'brand' => 'Khaadi', 'stock' => 20, 'featured' => false, 'image' => '/images/products/fashion-women.jpg'],
            ['category_slug' => 'fashion', 'name' => 'Luxury Embroidered Lehnga', 'slug' => 'luxury-lehnga', 'price' => 85000, 'discount_price' => 76500, 'description' => 'Heavy embroidered bridal lehnga.', 'brand' => 'HSY', 'stock' => 10, 'featured' => false, 'image' => '/images/products/fashion-women.jpg'],
            ['category_slug' => 'fashion', 'name' => 'Premium Lawn 3-Piece', 'slug' => 'premium-lawn-3-piece', 'price' => 8500, 'discount_price' => 7650, 'description' => 'Printed lawn 3-piece suit.', 'brand' => 'Sana Safinaz', 'stock' => 80, 'featured' => false, 'image' => '/images/products/fashion-women.jpg'],
            ['category_slug' => 'fashion', 'name' => 'Luxury Stiletto Heels', 'slug' => 'luxury-stiletto-heels', 'price' => 15000, 'discount_price' => 13500, 'description' => 'Premium stiletto heels.', 'brand' => 'Generic', 'stock' => 25, 'featured' => false, 'image' => '/images/products/fashion-women.jpg'],

            // Home & Garden (id:3)
            ['category_slug' => 'home-garden', 'name' => 'Egyptian Cotton Bedsheet', 'slug' => 'egyptian-cotton-bedsheet', 'price' => 15000, 'discount_price' => 13500, 'description' => '1000TC Egyptian cotton bedsheet.', 'brand' => 'Generic', 'stock' => 40, 'featured' => true, 'image' => '/images/products/home.jpg'],
            ['category_slug' => 'home-garden', 'name' => 'Crystal Chandelier', 'slug' => 'crystal-chandelier', 'price' => 85000, 'discount_price' => 76500, 'description' => 'Large crystal ceiling chandelier.', 'brand' => 'Generic', 'stock' => 8, 'featured' => true, 'image' => '/images/products/home.jpg'],
            ['category_slug' => 'home-garden', 'name' => 'Luxury Sofa Set', 'slug' => 'luxury-sofa-set', 'price' => 285000, 'discount_price' => 256500, 'description' => '7 seater premium sofa set.', 'brand' => 'Generic', 'stock' => 5, 'featured' => false, 'image' => '/images/products/home.jpg'],
            ['category_slug' => 'home-garden', 'name' => 'Nespresso Coffee Machine', 'slug' => 'nespresso-coffee-machine', 'price' => 65000, 'discount_price' => 58500, 'description' => 'Nespresso Vertuo coffee machine.', 'brand' => 'Nespresso', 'stock' => 15, 'featured' => false, 'image' => '/images/products/home.jpg'],
            ['category_slug' => 'home-garden', 'name' => 'Dyson V15 Vacuum', 'slug' => 'dyson-v15-vacuum', 'price' => 95000, 'discount_price' => 85500, 'description' => 'Cordless Dyson V15 vacuum.', 'brand' => 'Dyson', 'stock' => 12, 'featured' => false, 'image' => '/images/products/home.jpg'],

            // Books (id:4)
            ['category_slug' => 'books', 'name' => 'Kulliyat-e-Iqbal', 'slug' => 'kulliyat-e-iqbal', 'price' => 8500, 'discount_price' => 7650, 'description' => 'Gold edition Kulliyat-e-Iqbal.', 'brand' => 'Generic', 'stock' => 30, 'featured' => true, 'image' => '/images/products/books.jpg'],
            ['category_slug' => 'books', 'name' => 'Premium Leather Planner', 'slug' => 'premium-leather-planner', 'price' => 6200, 'discount_price' => 5580, 'description' => 'Leather planner for 2025.', 'brand' => 'Generic', 'stock' => 40, 'featured' => true, 'image' => '/images/products/books.jpg'],
            ['category_slug' => 'books', 'name' => 'Self Help Collection', 'slug' => 'self-help-collection', 'price' => 12500, 'discount_price' => 11250, 'description' => '10 best self-help books.', 'brand' => 'Generic', 'stock' => 25, 'featured' => false, 'image' => '/images/products/books.jpg'],
            ['category_slug' => 'books', 'name' => 'Moleskine Notebook', 'slug' => 'moleskine-notebook', 'price' => 4500, 'discount_price' => 4050, 'description' => 'Limited edition Moleskine.', 'brand' => 'Moleskine', 'stock' => 45, 'featured' => false, 'image' => '/images/products/books.jpg'],
            ['category_slug' => 'books', 'name' => 'Parker Luxury Pen Set', 'slug' => 'parker-luxury-pen-set', 'price' => 15000, 'discount_price' => 13500, 'description' => 'Premium Parker pen gift set.', 'brand' => 'Parker', 'stock' => 20, 'featured' => false, 'image' => '/images/products/books.jpg'],

            // Sports & Outdoors (id:5)
            ['category_slug' => 'sports-outdoors', 'name' => 'Technogym Treadmill', 'slug' => 'technogym-treadmill', 'price' => 485000, 'discount_price' => 436500, 'description' => 'Professional treadmill.', 'brand' => 'Technogym', 'stock' => 5, 'featured' => true, 'image' => '/images/products/sports.jpg'],
            ['category_slug' => 'sports-outdoors', 'name' => 'Dumbbell Set 5-50kg', 'slug' => 'dumbbell-set', 'price' => 85000, 'discount_price' => 76500, 'description' => 'Complete dumbbell set.', 'brand' => 'Generic', 'stock' => 10, 'featured' => true, 'image' => '/images/products/sports.jpg'],
            ['category_slug' => 'sports-outdoors', 'name' => 'Adidas Football Boots', 'slug' => 'adidas-football-boots', 'price' => 28000, 'discount_price' => 25200, 'description' => 'Adidas Predator boots.', 'brand' => 'Adidas', 'stock' => 30, 'featured' => false, 'image' => '/images/products/sports.jpg'],
            ['category_slug' => 'sports-outdoors', 'name' => 'Cricket Bat Pro', 'slug' => 'cricket-bat-pro', 'price' => 35000, 'discount_price' => 31500, 'description' => 'Gray-Nicolls cricket bat.', 'brand' => 'Gray-Nicolls', 'stock' => 20, 'featured' => false, 'image' => '/images/products/sports.jpg'],
            ['category_slug' => 'sports-outdoors', 'name' => 'Garmin Forerunner 965', 'slug' => 'garmin-forerunner-965', 'price' => 125000, 'discount_price' => 112500, 'description' => 'Premium Garmin running watch.', 'brand' => 'Garmin', 'stock' => 15, 'featured' => false, 'image' => '/images/products/sports.jpg'],
            ['category_slug' => 'sports-outdoors', 'name' => 'Whey Protein Gold', 'slug' => 'whey-protein-gold', 'price' => 18000, 'discount_price' => 16200, 'description' => 'Gold Standard whey protein.', 'brand' => 'ON', 'stock' => 50, 'featured' => false, 'image' => '/images/products/sports.jpg'],

            // Beauty & Personal Care (id:6)
            ['category_slug' => 'beauty-personal-care', 'name' => 'Chanel No5 EDP', 'slug' => 'chanel-no5-edp', 'price' => 35000, 'discount_price' => 31500, 'description' => 'Iconic Chanel No5 perfume.', 'brand' => 'Chanel', 'stock' => 20, 'featured' => true, 'image' => '/images/products/beauty.jpg'],
            ['category_slug' => 'beauty-personal-care', 'name' => 'La Mer Creme', 'slug' => 'la-mer-creme', 'price' => 48000, 'discount_price' => 43200, 'description' => 'La Mer moisturizing cream.', 'brand' => 'La Mer', 'stock' => 15, 'featured' => true, 'image' => '/images/products/beauty.jpg'],
            ['category_slug' => 'beauty-personal-care', 'name' => 'SK-II Facial Essence', 'slug' => 'sk-ii-facial-essence', 'price' => 32000, 'discount_price' => 28800, 'description' => 'SK-II facial treatment.', 'brand' => 'SK-II', 'stock' => 18, 'featured' => false, 'image' => '/images/products/beauty.jpg'],
            ['category_slug' => 'beauty-personal-care', 'name' => 'Dyson Airwrap', 'slug' => 'dyson-airwrap', 'price' => 95000, 'discount_price' => 85500, 'description' => 'Complete Dyson Airwrap styler.', 'brand' => 'Dyson', 'stock' => 10, 'featured' => false, 'image' => '/images/products/beauty.jpg'],
            ['category_slug' => 'beauty-personal-care', 'name' => 'MAC Makeup Kit', 'slug' => 'mac-makeup-kit', 'price' => 22500, 'discount_price' => 20250, 'description' => 'Premium MAC makeup kit.', 'brand' => 'MAC', 'stock' => 25, 'featured' => false, 'image' => '/images/products/beauty.jpg'],
            ['category_slug' => 'beauty-personal-care', 'name' => 'Kerastase Hair Oil', 'slug' => 'kerastase-hair-oil', 'price' => 9800, 'discount_price' => 8820, 'description' => 'Kerastase Elixir hair oil.', 'brand' => 'Kerastase', 'stock' => 35, 'featured' => false, 'image' => '/images/products/beauty.jpg'],

            // Toys & Games (id:7)
            ['category_slug' => 'toys-games', 'name' => 'LEGO Technic Lamborghini', 'slug' => 'lego-technic-lamborghini', 'price' => 28000, 'discount_price' => 25200, 'description' => 'LEGO Technic Lamborghini.', 'brand' => 'LEGO', 'stock' => 15, 'featured' => true, 'image' => '/images/products/toys.jpg'],
            ['category_slug' => 'toys-games', 'name' => 'RC Ferrari Pro', 'slug' => 'rc-ferrari-pro', 'price' => 18500, 'discount_price' => 16650, 'description' => 'Remote control Ferrari.', 'brand' => 'Generic', 'stock' => 20, 'featured' => true, 'image' => '/images/products/toys.jpg'],
            ['category_slug' => 'toys-games', 'name' => 'Educational Robotics Kit', 'slug' => 'educational-robotics-kit', 'price' => 15000, 'discount_price' => 13500, 'description' => 'Kids robotics learning kit.', 'brand' => 'Generic', 'stock' => 25, 'featured' => false, 'image' => '/images/products/toys.jpg'],
            ['category_slug' => 'toys-games', 'name' => 'Baby Grand Piano', 'slug' => 'baby-grand-piano', 'price' => 35000, 'discount_price' => 31500, 'description' => 'Electronic baby grand piano.', 'brand' => 'Generic', 'stock' => 10, 'featured' => false, 'image' => '/images/products/toys.jpg'],
            ['category_slug' => 'toys-games', 'name' => 'Premium Doll House', 'slug' => 'premium-doll-house', 'price' => 22000, 'discount_price' => 19800, 'description' => 'Wooden premium doll house.', 'brand' => 'Generic', 'stock' => 12, 'featured' => false, 'image' => '/images/products/toys.jpg'],
            ['category_slug' => 'toys-games', 'name' => 'Montessori Learning Set', 'slug' => 'montessori-learning-set', 'price' => 8500, 'discount_price' => 7650, 'description' => 'Complete Montessori set.', 'brand' => 'Generic', 'stock' => 30, 'featured' => false, 'image' => '/images/products/toys.jpg'],

            // Food & Beverages (id:8)
            ['category_slug' => 'food-beverages', 'name' => 'Kashmiri Dry Fruits Box', 'slug' => 'kashmiri-dry-fruits', 'price' => 8500, 'discount_price' => 7650, 'description' => 'Premium Kashmiri dry fruits.', 'brand' => 'Generic', 'stock' => 50, 'featured' => true, 'image' => '/images/products/groceries.jpg'],
            ['category_slug' => 'food-beverages', 'name' => 'Organic Sidr Honey', 'slug' => 'organic-sidr-honey', 'price' => 8500, 'discount_price' => 7650, 'description' => 'Pure organic Sidr honey 1kg.', 'brand' => 'Generic', 'stock' => 40, 'featured' => true, 'image' => '/images/products/groceries.jpg'],
            ['category_slug' => 'food-beverages', 'name' => 'Desi Cow Ghee', 'slug' => 'desi-cow-ghee', 'price' => 6200, 'discount_price' => 5580, 'description' => 'Pure desi cow ghee 2kg.', 'brand' => 'Generic', 'stock' => 60, 'featured' => false, 'image' => '/images/products/groceries.jpg'],
            ['category_slug' => 'food-beverages', 'name' => 'Darjeeling Tea', 'slug' => 'darjeeling-tea', 'price' => 4800, 'discount_price' => 4320, 'description' => 'First flush Darjeeling tea.', 'brand' => 'Generic', 'stock' => 45, 'featured' => false, 'image' => '/images/products/groceries.jpg'],
            ['category_slug' => 'food-beverages', 'name' => 'Premium Saffron', 'slug' => 'premium-saffron', 'price' => 12000, 'discount_price' => 10800, 'description' => 'Kashmiri saffron 10g.', 'brand' => 'Generic', 'stock' => 30, 'featured' => false, 'image' => '/images/products/groceries.jpg'],
            ['category_slug' => 'food-beverages', 'name' => 'Extra Virgin Olive Oil', 'slug' => 'extra-virgin-olive-oil', 'price' => 5500, 'discount_price' => 4950, 'description' => 'Imported extra virgin olive oil.', 'brand' => 'Generic', 'stock' => 35, 'featured' => false, 'image' => '/images/products/groceries.jpg'],

            // Furniture (id:9)
            ['category_slug' => 'furniture', 'name' => 'Luxury Sofa Set 7 Seater', 'slug' => 'luxury-sofa-7-seater', 'price' => 285000, 'discount_price' => 256500, 'description' => '7 seater premium sofa set.', 'brand' => 'Generic', 'stock' => 5, 'featured' => true, 'image' => '/images/products/home.jpg'],
            ['category_slug' => 'furniture', 'name' => 'Crystal Chandelier Large', 'slug' => 'crystal-chandelier-large', 'price' => 85000, 'discount_price' => 76500, 'description' => 'Large crystal chandelier.', 'brand' => 'Generic', 'stock' => 8, 'featured' => true, 'image' => '/images/products/home.jpg'],
            ['category_slug' => 'furniture', 'name' => 'King Size Bed Frame', 'slug' => 'king-size-bed-frame', 'price' => 125000, 'discount_price' => 112500, 'description' => 'Premium king size bed frame.', 'brand' => 'Generic', 'stock' => 10, 'featured' => false, 'image' => '/images/products/home.jpg'],
            ['category_slug' => 'furniture', 'name' => 'Dining Table Set', 'slug' => 'dining-table-set', 'price' => 95000, 'discount_price' => 85500, 'description' => '6 seater dining table set.', 'brand' => 'Generic', 'stock' => 7, 'featured' => false, 'image' => '/images/products/home.jpg'],
            ['category_slug' => 'furniture', 'name' => 'Office Executive Chair', 'slug' => 'office-executive-chair', 'price' => 45000, 'discount_price' => 40500, 'description' => 'Premium executive office chair.', 'brand' => 'Generic', 'stock' => 15, 'featured' => false, 'image' => '/images/products/home.jpg'],

            // Health & Wellness (id:10)
            ['category_slug' => 'health-wellness', 'name' => 'Philips Air Purifier', 'slug' => 'philips-air-purifier', 'price' => 85000, 'discount_price' => 76500, 'description' => 'HEPA air purifier by Philips.', 'brand' => 'Philips', 'stock' => 10, 'featured' => true, 'image' => '/images/products/health.jpg'],
            ['category_slug' => 'health-wellness', 'name' => 'Omron BP Monitor', 'slug' => 'omron-bp-monitor', 'price' => 18500, 'discount_price' => 16650, 'description' => 'Omron blood pressure monitor.', 'brand' => 'Omron', 'stock' => 30, 'featured' => true, 'image' => '/images/products/health.jpg'],
            ['category_slug' => 'health-wellness', 'name' => 'Vitamix Blender Pro', 'slug' => 'vitamix-blender-pro', 'price' => 125000, 'discount_price' => 112500, 'description' => 'Professional Vitamix blender.', 'brand' => 'Vitamix', 'stock' => 8, 'featured' => false, 'image' => '/images/products/health.jpg'],
            ['category_slug' => 'health-wellness', 'name' => 'Yoga Mat Set', 'slug' => 'yoga-mat-set', 'price' => 12000, 'discount_price' => 10800, 'description' => 'Premium yoga mat with blocks.', 'brand' => 'Generic', 'stock' => 40, 'featured' => false, 'image' => '/images/products/health.jpg'],
            ['category_slug' => 'health-wellness', 'name' => 'Essential Oil Diffuser', 'slug' => 'essential-oil-diffuser', 'price' => 8500, 'discount_price' => 7650, 'description' => 'Premium oil diffuser.', 'brand' => 'Generic', 'stock' => 35, 'featured' => false, 'image' => '/images/products/health.jpg'],
            ['category_slug' => 'health-wellness', 'name' => 'Full Body Massage Chair', 'slug' => 'full-body-massage-chair', 'price' => 285000, 'discount_price' => 256500, 'description' => 'Full body massage chair.', 'brand' => 'Generic', 'stock' => 5, 'featured' => false, 'image' => '/images/products/health.jpg'],

            // Automotive (id:11)
            ['category_slug' => 'automotive', 'name' => 'Meguiars Car Care Kit', 'slug' => 'meguiars-car-care-kit', 'price' => 18500, 'discount_price' => 16650, 'description' => 'Professional car care kit.', 'brand' => 'Meguiars', 'stock' => 25, 'featured' => true, 'image' => '/images/products/automotive.jpg'],
            ['category_slug' => 'automotive', 'name' => 'Garmin DashCam 67W', 'slug' => 'garmin-dashcam-67w', 'price' => 35000, 'discount_price' => 31500, 'description' => 'Garmin dash camera 67W.', 'brand' => 'Garmin', 'stock' => 20, 'featured' => true, 'image' => '/images/products/automotive.jpg'],
            ['category_slug' => 'automotive', 'name' => 'Leather Seat Covers', 'slug' => 'leather-seat-covers', 'price' => 28000, 'discount_price' => 25200, 'description' => 'Premium leather seat covers.', 'brand' => 'Generic', 'stock' => 15, 'featured' => false, 'image' => '/images/products/automotive.jpg'],
            ['category_slug' => 'automotive', 'name' => 'Premium Car Perfume', 'slug' => 'premium-car-perfume', 'price' => 8500, 'discount_price' => 7650, 'description' => 'Luxury car perfume set.', 'brand' => 'Generic', 'stock' => 50, 'featured' => false, 'image' => '/images/products/automotive.jpg'],
            ['category_slug' => 'automotive', 'name' => 'Car Jump Starter', 'slug' => 'car-jump-starter', 'price' => 15000, 'discount_price' => 13500, 'description' => 'Portable car jump starter.', 'brand' => 'Generic', 'stock' => 20, 'featured' => false, 'image' => '/images/products/automotive.jpg'],
            ['category_slug' => 'automotive', 'name' => '3M Window Tinting Kit', 'slug' => '3m-window-tinting-kit', 'price' => 22000, 'discount_price' => 19800, 'description' => '3M window tinting kit.', 'brand' => '3M', 'stock' => 12, 'featured' => false, 'image' => '/images/products/automotive.jpg'],

            // Jewelry & Watches (id:12)
            ['category_slug' => 'jewelry-watches', 'name' => 'Rolex Submariner', 'slug' => 'rolex-submariner', 'price' => 850000, 'discount_price' => 765000, 'description' => 'Luxury Rolex submariner watch.', 'brand' => 'Rolex', 'stock' => 5, 'featured' => true, 'image' => '/images/products/watches.jpg'],
            ['category_slug' => 'jewelry-watches', 'name' => 'Apple Watch Ultra 2', 'slug' => 'apple-watch-ultra-2', 'price' => 185000, 'discount_price' => 166500, 'description' => 'Apple Watch Ultra 2.', 'brand' => 'Apple', 'stock' => 20, 'featured' => true, 'image' => '/images/products/watches.jpg'],
            ['category_slug' => 'jewelry-watches', 'name' => 'Samsung Galaxy Watch 6', 'slug' => 'samsung-galaxy-watch-6', 'price' => 75000, 'discount_price' => 67500, 'description' => 'Samsung smartwatch classic.', 'brand' => 'Samsung', 'stock' => 25, 'featured' => false, 'image' => '/images/products/watches.jpg'],
            ['category_slug' => 'jewelry-watches', 'name' => 'Ray-Ban Aviator', 'slug' => 'ray-ban-aviator', 'price' => 35000, 'discount_price' => 31500, 'description' => 'Classic Ray-Ban aviators.', 'brand' => 'Ray-Ban', 'stock' => 30, 'featured' => false, 'image' => '/images/products/watches.jpg'],
            ['category_slug' => 'jewelry-watches', 'name' => 'Luxury Leather Wallet', 'slug' => 'luxury-leather-wallet', 'price' => 12000, 'discount_price' => 10800, 'description' => 'Genuine leather bifold wallet.', 'brand' => 'Generic', 'stock' => 50, 'featured' => false, 'image' => '/images/products/watches.jpg'],
            ['category_slug' => 'jewelry-watches', 'name' => 'Premium Mens Belt', 'slug' => 'premium-mens-belt', 'price' => 18500, 'discount_price' => 16650, 'description' => 'Crocodile leather premium belt.', 'brand' => 'Generic', 'stock' => 40, 'featured' => false, 'image' => '/images/products/watches.jpg'],
        ];

        foreach ($products as $data) {
            $category = Category::where('slug', $data['category_slug'])->first();
            if ($category) {
                Product::create([
                    'category_id'    => $category->id,
                    'name'           => $data['name'],
                    'slug'           => $data['slug'],
                    'description'    => $data['description'],
                    'price'          => $data['price'],
                    'discount_price' => $data['discount_price'],
                    'stock'          => $data['stock'],
                    'brand'          => $data['brand'],
                    'image'          => $data['image'],
                    'is_featured'    => $data['featured'],
                ]);
            }
        }
    }
}