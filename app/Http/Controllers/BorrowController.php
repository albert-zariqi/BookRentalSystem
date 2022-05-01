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
        $user = Auth::user();
        // $all_rentals = Borrow::where('reader_id', $user_id)
        //                             ->get();

        $rentals_pending = $user->is_librarian
            ? Borrow::where('status', 'PENDING')->get()
            : Borrow::where('reader_id', $user_id)->where('status', 'PENDING')->get();

        $accepted_intime = $user->is_librarian
            ? Borrow::where('status', 'ACCEPTED')
                ->where('deadline', '>', now())
                ->get()
            : Borrow::where('reader_id', $user_id)->where('status', 'ACCEPTED')
                                        ->where('deadline', '>', now())
                                        ->get();


        $accepted_late = $user->is_librarian
            ? Borrow::where('status', 'ACCEPTED')
                ->where('deadline', '<', now())
                ->get()
            : Borrow::where('reader_id', $user_id)->where('status', 'ACCEPTED')
                                        ->where('deadline', '<', now())
                                        ->get();

        $rejected_rentals = $user->is_librarian
            ? Borrow::where('status', 'REJECTED')->get()
            : Borrow::where('reader_id', $user_id)->where('status', 'REJECTED')->get();

        $returned_rentals = $user->is_librarian
            ? Borrow::where('status', 'RETURNED')->get()
            : Borrow::where('reader_id', $user_id)->where('status', 'RETURNED')->get();

        return view('borrows.index', [
            'user' => $user_id,
            'pending_rentals'=> $rentals_pending,
            'accepted_intime' => $accepted_intime,
            'accepted_late' => $accepted_late,
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

            $active_borrows = Borrow::whereIN('status', array('ACCEPTED', 'PENDING'))
                                ->where('reader_id', Auth::id())
                                ->where('book_id', $validated_data['book_id'])
                                ->get();

            if (count($active_borrows) > 0)
            {
                $error = \Illuminate\Validation\ValidationException::withMessages([
                    'book_id' => 'This user has already an active borrow request!'
                 ]);
                 throw $error;
            }

            $borrow = Borrow::create($validated_data);
            return redirect()->route('books.show',  $borrow->book->id);
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
    public function update(Borrow $borrow, BorrowFormRequest $request)
    {
        $validated_data = $request->validated();

        if ($validated_data['status'] == 'RETURNED' && $borrow->status != 'RETURNED'){
            $validated_data['returned_at'] = now();
            $validated_data['return_managed_by'] = Auth::id();
        }
        else if ($validated_data['status'] == 'ACCEPTED' && $borrow->status != 'ACCEPTED'){
            $validated_data['request_processed_at'] = now();
            $validated_data['request_managed_by'] = Auth::id();
        }

        $borrow->update($validated_data);
        return redirect()->route('borrows.show', $borrow->id);
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
