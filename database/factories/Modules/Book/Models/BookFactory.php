<?php

namespace Database\Factories\Modules\Book\Models;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Modules\Book\Models\Book;

class BookFactory extends Factory
{
    protected $model = Book::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->title,
            'cover' => $this->faker->imageUrl(640,480),
            'description' => $this->faker->paragraph($nbSentences = 3, $variableNbSentences = true),
            'content' => $this->faker->paragraphs($nb = 5, $asText = true) ,
            'hits' => 0,
            'user_id' => $this->faker->numberBetween(1,5),
        ];
    }
}
