<?php

namespace App\Http\Controllers\admin;

use App\Models\card;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorecardRequest;

class CardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cards = card::where('status', 0)->latest()->get();

        return view('admin.reservation.index', compact('cards'));
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
    public function store(StorecardRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(card $card)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(card $card)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($card)
    {
        try {




            card::findOrFail($card)->update(['status' => 1]);


            toast(__('Success'), 'success');
        } catch (\Exception $e) {
            return $e->getMessage();
            toast(__('Error'), 'error');
        }
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($card)
    {
        try {

            card::findOrFail($card)->delete();
            toast(__('Success'), 'success');
        } catch (\Exception $e) {
            return $e->getMessage();
            toast(__('Error'), 'error');
        }
        return back();
    }
}
