<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Genre;
use App\Models\Book;
use App\Models\Borrow;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = User::all();
        $genres = Genre::all();
        $books = Book::all();
        $active_rentals = Borrow::where('status', 'ACCEPTED')->get();
        return view('home', [
            'users' => count($users),
            'genres_count' => count($genres),
            'books' => count($books),
            'book_rentals' => count($active_rentals),
            'genres' => $genres
        ]);
    }

    public function profile(){
        if (Auth::check()){
            $user = Auth::user();
            return view('profile',[
                'user' => $user
            ]);
        }

        return redirect()->action('index');
    }
}
