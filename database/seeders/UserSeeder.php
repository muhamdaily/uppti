<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'Dino Sagara',
                'username' => 'dinosagara',
                'email' => 'dino@sagara.com',
                'email_verified_at' => now(),
                'password' => bcrypt('dinosagara'),
                'role' => 'admin',
            ]
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
