<?php

namespace App\Http\Controllers\doctor;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRequest;
use App\Models\card;
use App\Traits\ProcessingTrait;
use Exception;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    use ProcessingTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('doctor.profile.index');
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, string $id)
    {
        try {
            $data = $this->processImageAndData($request, $request->validated(), '/doctors');

            auth()->user()->update($data);
            toast(__('Success'), 'success');
        } catch (Exception $e) {
            toast(__('Error'), 'error');
        }
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
