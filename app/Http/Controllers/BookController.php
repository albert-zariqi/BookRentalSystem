<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Genre;
use App\Models\Borrow;
use Illuminate\Http\Request;
use App\Http\Requests\BookFormRequest;
use Illuminate\Support\Facades\Auth;


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

    public function store(Request $request){
        dd($request);
        // $validated_data = $request->validated();
        return;
        // $validated_data = $request->validated();
        // $input = $request->collect();
        // $book = new Book(){
        //     'title' => $request->input('title'),
        //     'authors' => $request->input('authors'),
        //     'released_at' => $request->input('released_at'),
        //     'isbn' => $request->input('isbn'),
        //     'cover_image' => $request->input('cover_image'),
        //     'pages' => $request->input('pages'),
        //     'language_code' =>
        // }
        // $book = Book::create();

        return redirect()->action('${App\Http\Controllers\HomeController@index}');
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
        return view('books/edit', [
            'book' => $book
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
        $project->update($validated_data);
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
