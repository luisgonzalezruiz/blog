<?php

namespace Database\Seeders;

use App\Models\Image;

use App\Models\Post;

use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $posts = Post::factory(50)->create();

        // recorremos el pos, y por cada pos, le asignamos una imagen
        foreach($posts as $post){
            // por cada post asignamos una imagen y asu vez le pasamos datos extras
            // como el imageable
            Image::factory(1)->create([
                'imageable_id' => $post->id,
                'imageable_type' => Post::class
            ]);

            // vamos a agregar dos tags a cada post
            // para hacer eso hacemos uso de la relacion que hicimos en el modelo post
            // de esta forma asignamos aleatoriamente dos tags a cada post
            // $post->tags() = es la relacion que creamos, mediante esto podemos hacer el attach
            // de no hace esta relacion debemos hacer manualmente la asignacion
            $post->tags()->attach([
                rand(1,4),
                rand(5,8)
            ]);


        }



    }
}
