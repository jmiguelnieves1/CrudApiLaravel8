<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\User;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        //Definimos una frase falsa para el titulo
        $title = $this->faker->sentence;
        //Con Str llamamos al metodo slug y le pasamos el titulo
        $slug = Str::slug($title);
        //Creamos el factory
        return [
            //De esta forma obtenemos un usuario aleatorio y colocamos el ID (asi no dependemos de que los ids obligatoriamente sean del 1 al 10)
            'user_id' => User::all()->random()->id,
            'title' => $title,
            'slug' => $slug,
            'content' => $this->faker->text(1600),
        ];
    }
}
