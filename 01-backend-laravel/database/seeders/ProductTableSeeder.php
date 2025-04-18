<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $categories = DB::table('category')->pluck('id')->toArray();

        if(empty($categories)){
            $this->command->warn("Category table is empty. Please run 'php artisan db:seed --class=CategoryTableSeeder' first.");
            return;
        }

        for($i = 1; $i <= 50; $i++){
            $products[] = [
                'name' => $faker->word(),
                'description' => $faker->sentence(),
                'price' => $faker->randomFloat(2, 10, 500),
                'category_id' => $faker->randomElement($categories),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('product')->insert($products);
    }
}
