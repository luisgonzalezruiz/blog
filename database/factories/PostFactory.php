<?php

namespace Database\Factories;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;

use Illuminate\Database\Eloquent\Factories\Factory;

use Illuminate\Support\Str;

class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition()
    {
        $name = $this->faker->unique()->sentence();

        // de esta manera llenamos las claves foraneas, a partir de tablas existentes
       // 'category_id' => Category::all()->random()->id,
       // 'user_id' => User::all()->random()->id
        return [
            'name'=>$name,
            'slug'=>Str::slug($name),
            'extract'=>$this->faker->text(250),
            'body'=>$this->faker->text(2000),
            'status'=>$this->faker->randomElement([1,2]),
            'img'=>'posts/' . $this->faker->image('public/storage/posts_ext'),
            'category_id' => Category::all()->random()->id,
            'user_id' => User::all()->random()->id
        ];
    }
}
