<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;

class DataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        // generate category
        for($i = 0; $i < 10; $i++){
            Category::create([
                'name_ar' => 'نوع ' . $i,
                'name_en' => 'category ' . $i,
                'parent_id' => NULL
            ]);
        }
        // generate sub category
        for($i = 10; $i < 20; $i++){
            Category::create([
                'name_ar' => 'نوع فرعي ' . $i,
                'name_en' => 'sub category ' . $i,
                'parent_id' => Category::whereNull('parent_id')->inRandomOrder()->first()->id,
            ]);
        }
        // generate sub sub category
        for($i = 20; $i < 30; $i++){
            Category::create([
                'name_ar' => 'نوع ' . $i,
                'name_en' => 'sub sub category ' . $i,
                'parent_id' => Category::whereNotNull('parent_id')->inRandomOrder()->first()->id,
            ]);
        }
        // generate product 
        for($i = 0; $i < 30; $i++){
            Product::create([
                'name_ar' => 'منتج ' . $i,
                'name_en' => 'product ' . $i,
                'category_id' => Category::whereNotNull('parent_id')->inRandomOrder()->first()->id,
            ]);
        }
    }
}
