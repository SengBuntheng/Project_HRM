<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();

        for ($i = 1; $i <= 100; $i++) {
            DB::table('departments')->insert([
                'department_code' => 'DEPT-' . str_pad($i, 3, '0', STR_PAD_LEFT),
                'department_name' => $faker->unique()->company . ' Department',
                'description'     => $faker->sentence(10),
                'department_status'          => $faker->randomElement(['active', 'inactive']),
                'created_at'      => now(),
                'updated_at'      => now(),
            ]);
        }
    }
}
