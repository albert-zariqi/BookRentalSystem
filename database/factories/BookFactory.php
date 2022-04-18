<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => function() {
                $nbWords = rand(1, 5);
                $sentence = $this->faker->sentence($nbWords);
                return substr($sentence, 0, strlen($sentence) - 1);
            },
            'authors' => function(){
                $authors = "";
                $noAuthors = rand(1, 5);
                for ($i=0; $i < $noAuthors; $i++){
                    $author = $this->faker->name();
                    if ($i > 0){
                        $authors .= " {$author}";
                    }
                    else{
                        $authors .= "{$author}";
                    }
                }
                return $authors;
            },
            'description' => $this->faker->optional()->sentence(),
            'released_at' => $this->faker->date(),
            'cover_image' => $this->faker->optional()->imageUrl(),
            'pages' => $this->faker->numerify('###'),
            'language_code' => function() {
                $language_codes = [
                    'en',
                    'hu',
                    'al'
                ];

                $lang_index = rand(0, count($language_codes) - 1);

                return $language_codes[$lang_index];
            },
            'isbn' => function(){
                return $this->faker->ean13();
            },
            'in_stock' => function(){
                $in_stock = rand(0, 10);

                return $in_stock;
            }
        ];
    }
}
