<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesSeeder extends Seeder
{
    private $category;

    public function __construct(Category $category){
        $this->category = $category;
    }
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Animal',
                'created_at' => NOW(),
                'updated_at' => NOW()
            ],
            [
                'name' => 'dinner',
                'created_at' => NOW(),
                'updated_at' => NOW()
            ]
        ];

        $this->category->insert($categories);
    }
}
