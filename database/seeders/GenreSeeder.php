<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Genre;
use App\Models\Book;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('genres')->truncate();
        Genre::factory()->count(10)->create();
        $books = Book::all();
        Genre::all()->each(function ($genre) use ($books) {
            $genre->books()->attach(
                $books->random(rand(1, count($books) - 1))->pluck('id')->toArray()
            );
        });
    }
}
