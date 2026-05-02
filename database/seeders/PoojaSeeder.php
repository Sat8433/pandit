<?php

namespace Database\Seeders;

use App\Models\Pooja;
use App\Models\PoojaPackage;
use App\Models\SamagriItem;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PoojaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create sample poojas
        $satyanarayan = Pooja::create([
            'name' => 'Satyanarayan Pooja',
            'slug' => 'satyanarayan-pooja',
            'description' => 'Perform Satyanarayan Pooja for prosperity, peace, and happiness. This pooja is dedicated to Lord Vishnu and is performed on full moon days.',
            'category' => 'general',
            'duration_minutes' => 120,
            'base_price' => 1500.00,
            'is_active' => true,
        ]);

        // Create packages for Satyanarayan
        PoojaPackage::create([
            'pooja_id' => $satyanarayan->id,
            'name' => 'Basic Package',
            'description' => 'Essential items for Satyanarayan pooja',
            'price' => 2500.00,
            'duration_minutes' => 120,
            'is_active' => true,
        ]);

        PoojaPackage::create([
            'pooja_id' => $satyanarayan->id,
            'name' => 'Standard Package',
            'description' => 'Complete Satyanarayan pooja with premium samagri',
            'price' => 3500.00,
            'duration_minutes' => 120,
            'is_active' => true,
        ]);

        PoojaPackage::create([
            'pooja_id' => $satyanarayan->id,
            'name' => 'Premium Package',
            'description' => 'Luxurious Satyanarayan pooja with all premium items',
            'price' => 5000.00,
            'duration_minutes' => 120,
            'is_active' => true,
        ]);

        // Create samagri items for Satyanarayan
        $samagriItems = [
            SamagriItem::create(['name' => 'Kalash', 'description' => 'Holy water pot', 'price_per_unit' => 150.00, 'unit' => 'piece', 'is_active' => true]),
            SamagriItem::create(['name' => 'Coconut', 'description' => 'Fresh coconut for offering', 'price_per_unit' => 50.00, 'unit' => 'piece', 'is_active' => true]),
            SamagriItem::create(['name' => 'Flowers', 'description' => 'Fresh flowers for decoration', 'price_per_unit' => 200.00, 'unit' => 'bunch', 'is_active' => true]),
            SamagriItem::create(['name' => 'Fruits', 'description' => 'Seasonal fruits as offering', 'price_per_unit' => 300.00, 'unit' => 'kg', 'is_active' => true]),
            SamagriItem::create(['name' => 'Sweets', 'description' => 'Traditional sweets for prasad', 'price_per_unit' => 250.00, 'unit' => 'kg', 'is_active' => true]),
            SamagriItem::create(['name' => 'Pooja Thali', 'description' => 'Complete pooja thali with all items', 'price_per_unit' => 500.00, 'unit' => 'set', 'is_active' => true]),
        ];

        // Attach samagri items to pooja
        foreach ($samagriItems as $item) {
            $satyanarayan->samagriItems()->attach($item->id, ['quantity' => 1, 'is_required' => true]);
        }

        // Create Griha Pravesh
        $grihaPravesh = Pooja::create([
            'name' => 'Griha Pravesh',
            'slug' => 'griha-pravesh',
            'description' => 'House warming ceremony to purify the new home and bring prosperity to the family.',
            'category' => 'ceremony',
            'duration_minutes' => 180,
            'base_price' => 2000.00,
            'is_active' => true,
        ]);

        // Create packages for Griha Pravesh
        PoojaPackage::create([
            'pooja_id' => $grihaPravesh->id,
            'name' => 'Basic Package',
            'description' => 'Essential items for house warming ceremony',
            'price' => 3500.00,
            'duration_minutes' => 180,
            'is_active' => true,
        ]);

        PoojaPackage::create([
            'pooja_id' => $grihaPravesh->id,
            'name' => 'Premium Package',
            'description' => 'Complete house warming with premium samagri',
            'price' => 5000.00,
            'duration_minutes' => 180,
            'is_active' => true,
        ]);

        // Create Marriage Pooja
        $marriage = Pooja::create([
            'name' => 'Marriage Pooja',
            'slug' => 'marriage-pooja',
            'description' => 'Sacred marriage ceremony with traditional rituals and blessings for the couple.',
            'category' => 'ceremony',
            'duration_minutes' => 240,
            'base_price' => 3000.00,
            'is_active' => true,
        ]);

        // Create packages for Marriage
        PoojaPackage::create([
            'pooja_id' => $marriage->id,
            'name' => 'Basic Package',
            'description' => 'Essential marriage ceremony items',
            'price' => 5000.00,
            'duration_minutes' => 240,
            'is_active' => true,
        ]);

        PoojaPackage::create([
            'pooja_id' => $marriage->id,
            'name' => 'Premium Package',
            'description' => 'Complete marriage ceremony with all traditional items',
            'price' => 8000.00,
            'duration_minutes' => 240,
            'is_active' => true,
        ]);
    }
}
