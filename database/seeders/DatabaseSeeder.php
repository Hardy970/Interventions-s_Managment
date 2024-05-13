<?php

namespace Database\Seeders;

use App\Models\Role;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        Role::create([
            'libelle'=>'admin'
        ]);

        User::factory()->create([
            'first_name' => 'Hardy',
            'last_name' => 'ADIMOU',
            'role_id'=>1,
            'email' => 'hardyadimou2005@gmail.com',
            'password'=>Hash::make('00000000')
        ]);
    }
}
