<?php

namespace App\Http\Controllers;

use App\Models\card;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorecardRequest;
use Illuminate\Support\Facades\Auth;

class CardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cards = card::where('user_id', Auth::user()->id)->WhereNot('status', 2)->latest()->get();

        return view('home.myCard', compact('cards'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store($doctorid)
    {
        try {
            card::updateOrCreate([
                'doctor_id' => $doctorid,
                'user_id' => Auth::user()->id
            ]);

            toast(__('Success'), 'success');
        } catch (\Exception $e) {
            return $e->getMessage();
            toast(__('Error'), 'error');
        }
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show($doctorid) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(card $card)
    {

        try {

            $card->delete();
            toast(__('Success'), 'success');
        } catch (\Exception $e) {
            return $e->getMessage();
            toast(__('Error'), 'error');
        }
        return back();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($card) {}

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy(card $card)
    // {
    //     dd($card);
    //     try {

    //         card::findOrFail($card)->delete();
    //         toast(__('Success'), 'success');
    //     } catch (\Exception $e) {
    //         return $e->getMessage();
    //         toast(__('Error'), 'error');
    //     }
    //     return back();
    // }
}
