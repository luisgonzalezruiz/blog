<?php

namespace Database\Factories;

use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;

// este nos ayudara a crear el slug
use Illuminate\Support\Str;

class TagFactory extends Factory
{
    protected $model = Tag::class;

    public function definition()
    {
        $name = $this->faker->unique()->word(20);
        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'color'=> $this->faker->randomElement(['red','yellow','green','blue','indigo','purple','pink'])

        ];
    }
}
