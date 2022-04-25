<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Book;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Borrow>
 */
class BorrowFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $librarians = User::where('is_librarian', 1)->get();
        $readers = User::where('is_librarian', 0)->get();
        $no_librarians = count($librarians) - 1;
        $no_readers = count($readers) - 1;
        $books = Book::all();
        $no_books = count($books) - 1;
        $statuses = ['PENDING', 'ACCEPTED', 'REJECTED', 'RETURNED'];
        return [
            'reader_id' => $readers[rand(0, $no_readers)],
            'book_id' => $books[rand(0, $no_books)],
            'status' => $statuses[rand(0, count($statuses)-1)],
            'request_processed_at' => $this->faker->date(),
            'request_managed_by' => $librarians[rand(0, $no_librarians)],
            'deadline' => $this->faker->optional()->date(),
            'returned_at' => $this->faker->optional()->date(),
            'return_managed_by' => $librarians[rand(0, $no_librarians)]
        ];
    }
}
