<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{

    public function run()
    {
        Category::create([
        
            'name'=>'html tutorials',
            'slug'=>'html-tutorials',
        
        ]);

        Category::create([
            
            'name'=>'css tutorials',
            'slug'=>'css-tutorials',

        ]);

        Category::create([
            
            'name'=>'javascript tutorials',
            'slug'=>'javascript-tutorials',

        ]);

        Category::create([
        
            'name'=>'laravel tutorials',
            'slug'=>'laravel-tutorials',

        ]);

        Category::create([

            'name'=>'vue js tutorials',
            'slug'=>'vue-js-tutorials',
        
        ]);
    }
}
