<?php

namespace App\Http\Controllers\admin;

use App\Models\Doctor;
use App\Models\Service;

use App\Traits\ProcessingTrait;
use App\Http\Controllers\Controller;
use Illuminate\Http\Client\Response;
use App\Http\Requests\StoreDoctorRequest;
use App\Http\Requests\UpdateDoctorRequest;
use App\Models\UserStatus;
use Exception;

class DoctorController extends Controller
{
    use ProcessingTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $doctors = Doctor::latest()->get();
        $services = Service::latest()->get();
        return view('admin.doctors.index', compact('doctors', 'services'));
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
    public function store(StoreDoctorRequest $request)
    {
        try {

            $data = $this->processImageAndData($request, $request->validated(), 'doctors/');


            $data['created_by'] = auth()->id();


            Doctor::create($data);


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
    public function show(Doctor $doctor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Doctor $doctor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDoctorRequest $request, Doctor $doctor)
    {
        try {

            $data = $this->processImageAndData($request, $request->validated(), 'doctors/');


            $doctor->update($data);


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
    public function destroy(Doctor $doctor)
    {
        try {

            $doctor->delete();
            toast(__('Success'), 'success');
        } catch (\Exception $e) {
            return $e->getMessage();
            toast(__('Error'), 'error');
        }
        return back();
    }


    public function getDownload($id)
    {
        try {
            $name = Doctor::findOrFail($id)->value('cv');
            $file =  public_path() . '/cvs/doctors/' . $name;
            toast(__('Success'), 'success');
            return response()->download($file);
        } catch (\Exception $e) {

            toast(__('Error'), 'error');
        }
        return back();
    }
}
