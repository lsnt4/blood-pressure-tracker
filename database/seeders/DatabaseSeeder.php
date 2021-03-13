<?php

namespace Database\Seeders;

use App\Models\Team;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'name' => 'Administrator',
            'email' => 'admin@laravel.app',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);
        User::factory(9)->create();
        Team::create([
            'user_id' => 1,
            'name' => 'Admin\'s Team',
            'personal_team' => 1
        ]);
        $this->call(ProfileSeeder::class);
        $this->call(RecordSeeder::class);
    }
}
