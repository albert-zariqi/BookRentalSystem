<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Borrow;
use App\Models\User;
use App\Models\Book;
use App\Http\Requests\BorrowFormRequest;
use App\Http\Request\BookController;

class BorrowController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::id();

        // $all_rentals = Borrow::where('reader_id', $user_id)
        //                             ->get();

        $rentals_pending = Borrow::where('reader_id', $user_id)->where('status', 'PENDING')->get();
        $accepted_intime = Borrow::where('reader_id', $user_id)->where('status', 'ACCEPTED')
                                        ->where('deadline', '<', now())
                                        ->get();
        $rejected_rentals = Borrow::where('reader_id', $user_id)->where('status', 'REJECTED')->get();
        $returned_rentals = Borrow::where('reader_id', $user_id)->where('status', 'RETURNED')->get();
        // dd([
        //     'user' => $user_id,
        //     'pending_rentals'=> $rentals_pending,
        //     'accepted_intime' => $accepted_intime,
        //     'rejected_rentals' => $rejected_rentals,
        //     'returned_rentals' => $returned_rentals
        // ]);
        // return;
        return view('borrows.index', [
            'user' => $user_id,
            'pending_rentals'=> $rentals_pending,
            'accepted_intime' => $accepted_intime,
            'rejected_rentals' => $rejected_rentals,
            'returned_rentals' => $returned_rentals
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BorrowFormRequest $request)
    {
        try{
            $validated_data = $request->validated();

            $borrow = Borrow::create($validated_data);
            $book = Book::where('id', $borrow->book->id);
            return redirect()->action([BookController::class, 'show'], ['book' => $book]);
        }
        catch(Exception $exc){
            throw new Exception($exc->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Borrow $borrow)
    {
        $statuses = ['PENDING', 'ACCEPTED', 'REJECTED', 'RETURNED'];
        return view('borrows/detail', [
            'borrow' => $borrow,
            'statuses' => $statuses
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Borrow $borrow, Request $request)
    {
        dd($request);
        return;
        // $validated_data = $request->validated();

        $borrow->update($request->collection());
        return redirect()->action('borrows.show', [
            'borrow' => $borrow
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
