<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'mathew',
            'email' => 'mathew@gmail.com',
            'password' => Hash::make('789456'),
            'role' => 'Admin'
        ]);
        User::factory()->create([
            'name' => 'suvisesh',
            'email' => 'suvisesh@gmail.com',
            'password' => Hash::make('789456'),
            'role' => 'Speaker'
        ]);
        User::factory()->create([
            'name' => 'sam',
            'email' => 'sam@gmail.com',
            'password' => Hash::make('789456'),
            'role' => 'Speaker'
        ]);
        User::factory()->create([
            'name' => 'raj',
            'email' => 'raj@gmail.com',
            'password' => Hash::make('789456'),
            'role' => 'Organizer'
        ]);
        User::factory()->create([
            'name' => 'joe',
            'email' => 'joe@gmail.com',
            'password' => Hash::make('789456'),
            'role' => 'Organizer'
        ]);
        User::factory()->create([
            'name' => 'prince',
            'email' => 'prince@gmail.com',
            'password' => Hash::make('789456'),
            'role' => 'Attendee'
        ]);
        User::factory()->create([
            'name' => 'hari',
            'email' => 'hari@gmail.com',
            'password' => Hash::make('789456'),
            'role' => 'Attendee'
        ]);
        $this->call(InputSeeder::class);
    }
}
