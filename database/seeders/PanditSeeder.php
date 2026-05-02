<?php

namespace Database\Seeders;

use App\Models\Pandit;
use App\Models\User;
use Illuminate\Database\Seeder;

class PanditSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create sample pandits
        $p1 = User::create([
            'name' => 'Pandit Sharma',
            'email' => 'sharma@pandits.com',
            'password' => bcrypt('password'),
            'user_type' => 'pandit'
        ]);
        $p2 = User::create([
            'name' => 'Pandit Vyas',
            'email' => 'vyas@pandits.com',
            'password' => bcrypt('password'),
            'user_type' => 'pandit'
        ]);
        $p3 = User::create([
            'name' => 'Pandit Joshi',
            'email' => 'joshi@pandits.com',
            'password' => bcrypt('password'),
            'user_type' => 'pandit'
        ]);

        $pandits = [
            Pandit::create([
                'user_id' => $p1->id,
                'experience_years' => 15,
                'languages_known' => json_encode(['Hindi', 'English', 'Sanskrit']),
                'specialization' => json_encode(['Satyanarayan', 'Griha Pravesh', 'Marriage Poojas']),
                'bio' => 'Experienced pandit with 15 years of practice in traditional Hindu ceremonies. Specialized in Satyanarayan and Griha Pravesh poojas.',
                'verification_status' => 'approved',
                'is_available' => true,
            ]),
            
            Pandit::create([
                'user_id' => $p2->id, 
                'experience_years' => 20,
                'languages_known' => json_encode(['Hindi', 'English', 'Marathi']),
                'specialization' => json_encode(['Navagraha Poojas', 'Vedic Rituals']),
                'bio' => 'Senior pandit with 20 years of expertise in Navagraha and Vedic rituals. Trained in traditional Sanskrit ceremonies.',
                'verification_status' => 'approved',
                'is_available' => true,
            ]),
            
            Pandit::create([
                'user_id' => $p3->id,
                'experience_years' => 12,
                'languages_known' => json_encode(['Hindi', 'English']),
                'specialization' => json_encode(['General Poojas', 'Daily Rituals']),
                'bio' => 'Dedicated pandit specializing in general poojas and daily Hindu rituals. Focus on simplicity and authenticity.',
                'verification_status' => 'approved',
                'is_available' => true,
            ]),
        ];

        // Update user types for pandits
        foreach ($pandits as $pandit) {
            User::where('id', $pandit->user_id)->update(['user_type' => 'pandit']);
        }
    }
}
