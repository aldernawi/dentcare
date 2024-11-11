<?php

namespace App\Http\Controllers;

use App\Models\contact;
use App\Http\Requests\StorecontactRequest;
use App\Http\Requests\UpdatecontactRequest;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('home.contact');
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
    public function store(StorecontactRequest $request)
    {
        try {

            if (Auth::guard('web')->check()) {
                $data = $request->validated();
                $data['user_id'] = Auth::user()->id;
                contact::create(
                    $data
                );
            } else {
                return redirect()->route('login');
            }


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
    public function show()
    {
        $contacts = contact::latest()->get();
        return view('home.reviews', compact('contacts'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(contact $contact)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatecontactRequest $request, contact $contact)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(contact $contact)
    {
        //
    }
}
