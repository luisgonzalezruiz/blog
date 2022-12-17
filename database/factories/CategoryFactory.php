<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

// este nos ayudara a crear el slug
use Illuminate\Support\Str;

class CategoryFactory extends Factory
{
    protected $model =Category::class;


    public function definition()
    {
        $name = $this->faker->unique()->word(20);
        return [
            'name' => $name,
            'slug' => Str::slug($name)

        ];
    }
}
