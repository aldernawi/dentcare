<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use App\Models\UserStatus;
use App\Traits\ProcessingTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    use ProcessingTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::latest()->get();
        $status = UserStatus::latest()->get();
        return view('admin.users.index', compact('users', 'status'));
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
    public function store(StoreUserRequest $request)
    {
        try {

            $data = $this->processImageAndData($request, $request->validated(), 'users/');

            $data['created_by'] = auth()->id();
            User::create($data);


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
    public function update(UpdateUserRequest $request, User $user)
    {
        try {

            $data = $this->processImageAndData($request, $request->validated(), 'users/');


            $user->update($data);


            toast(__('Success'), 'success');
        } catch (\Exception $e) {

            toast(__('Error'), 'error');
        }
        return back(); //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        try {

            $user->delete();
            toast(__('Success'), 'success');
        } catch (\Exception $e) {

            toast(__('Error'), 'error');
        }
        return back();
    }
}
