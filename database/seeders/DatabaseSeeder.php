<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create(
            [
                'name' => 'Najwa',
                'email' => 'arindranajwanafasari@mail.ugm.ac.id',
                'password' => bcrypt('password'),
            ],
        );
        User::factory()->create(
            [
                'name' => 'Mingyu',
                'email' => 'kimmingyu@mail.ugm.ac.id',
                'password' => bcrypt('password2'),
            ],
        );
        User::factory()->create(
            [
                'name' => 'Jungkook',
                'email' => 'jeonjeongguk@mail.ugm.ac.id',
                'password' => bcrypt('password3'),
            ],
        );
    }
}
