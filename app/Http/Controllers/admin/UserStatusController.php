<?php

namespace App\Http\Controllers\admin;

use App\Models\UserStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserStatusRequest;
use App\Http\Requests\UpdateUserStatusRequest;
use App\Traits\ProcessingTrait;

class UserStatusController extends Controller
{
    use ProcessingTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $statuses = UserStatus::latest()->get();
        return view('admin.status.index', compact('statuses'));
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
    public function store(StoreUserStatusRequest $request)
    {

        try {



            UserStatus::create(['status' => $this->getTranslatedStatus($request)]);
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
    public function show(UserStatus $userStatus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserStatus $userStatus)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserStatusRequest $request,  $id)
    {
        try {
            UserStatus::findOrFail($id)->update(['status' => $this->getTranslatedStatus($request)]);
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
    public function destroy($id)
    {
        try {
            UserStatus::findOrFail($id)->delete();

            toast(__('Success'), 'success');
        } catch (\Exception $e) {
            return $e->getMessage();
            toast(__('Error'), 'error');
        }
        return back();
    }
}
