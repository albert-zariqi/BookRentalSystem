<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Book;
use App\Models\User;
use Carbon\Carbon;

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

        $no_days_deadline = rand(14, 30);
        $no_days_return = rand(14, 30);
        $reader_id = $readers[rand(0, $no_readers)];
        $book_id = $books[rand(0, $no_books)];
        $status = $statuses[rand(0, count($statuses)-1)];
        $request_processed_at = $status != 'PENDING' ? $this->faker->date() : null;
        $request_managed_by = $status != 'PENDING' ? $librarians[rand(0, $no_librarians)] : null;
        $deadline = $status != 'PENDING' && $status != 'REJECTED'
            ? (new Carbon($request_processed_at))->addDays($no_days_deadline)
            : null;
        $returned_at = $status == 'RETURNED'
            ? (new Carbon($request_processed_at))->addDays($no_days_return)
            : null;
        $return_managed_by = $status == 'RETURNED'
            ? $librarians[rand(0, $no_librarians)]
            : null;

        return [
            'reader_id' => $reader_id,
            'book_id' => $book_id,
            'status' => $status,
            'request_processed_at' => $request_processed_at,
            'request_managed_by' => $request_managed_by,
            'deadline' => $deadline,
            'returned_at' => $returned_at,
            'return_managed_by' => $return_managed_by
        ];
    }
}
