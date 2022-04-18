<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Http\Requests\BookFormRequest;

class BookController extends Controller
{
    public function index(){
        $books = Book::all();
        return view('books.index', [
            'books' => $books
        ]);
    }

    public function show(Book $book){

    }

    public function create(BookFormRequest $request){
        $validate_data = $request->validated();

        $book = Book::create($validate_data);

        return redirect()->route('books.show', $book->id);
    }
}
