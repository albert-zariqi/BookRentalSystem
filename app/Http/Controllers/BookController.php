<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Genre;
use App\Models\Borrow;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\BookFormRequest;
use Illuminate\Support\Arr;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $books = Book::all();
        return view('books.index', [
            'books' => $books
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::check() && !Auth::user()->is_librarian){
            return response()->json(['error' => 'Unauthorized!'], 403);
        }
        $genres = Genre::all();
        return view('books/create', [
            'genres' => $genres
        ]);
    }

    public function store(BookFormRequest $request){
        try {
            $validated_data = $request->validated();
            $genres = $validated_data['genres'] ?? [];
            $validated_data['language_code'] = $validated_data['language_code'] ?? 'hu';
            // $book = Book::create($validated_data->except(['genres']));
            $book =  Book::create(Arr::except($validated_data, 'genres'));
            $book->genres()->sync($genres);
            return redirect()->route('home');
        }
        catch(Exception $exception){
            throw new Exception($exception->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book){
        $user_id = Auth::id();

        $active_borrows = Borrow::whereIN('status', array('ACCEPTED', 'PENDING'))
                                ->where('reader_id', $user_id)
                                ->where('book_id', $book->id)
                                ->get();

        $has_active_rental = count($active_borrows) > 0 ? true : false;


        return view('books/detail', [
            'book' => $book,
            'active_rental' => $has_active_rental ? 'Yes' : 'No',
            'has_active_rental' => $has_active_rental
        ]);
    }

    public function search(Request $request){

        $books = Book::where('title', 'LIKE', "%{$request['search_text']}%")
                            ->orWhere('authors', 'LIKE', "%{request['search_text']}%")
                            ->get();

        return view('books.list', [
            'books' => $books
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        $genres = Genre::all();
        return view('books/edit', [
            'book' => $book,
            'genres' => $genres
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Book $book, BookFormRequest $request)
    {
        $validated_data = $request->validated();
        $book->update(Arr::except($validated_data, 'genres'));
        $book->genres()->sync($validated_data['genres'] ?? []);
        return redirect()->route('books.show', $book->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->route('books.index');
    }

}
