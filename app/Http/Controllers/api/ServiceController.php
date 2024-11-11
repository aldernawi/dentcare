<?php

namespace App\Http\Controllers\api;

use App\Models\Service;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreserviceRequest;
use App\Http\Requests\UpdateserviceRequest;
use App\Models\Doctor;
use App\Traits\ProcessingTrait;

class ServiceController extends Controller
{
    use ProcessingTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = Service::latest()->get();
        return response()->json($services);
    }
    public function doctors($id)
    {
        $doctors = Doctor::where('service', $id)
            ->with('ratings')
            ->get()
            ->map(function ($doctor) {
                $doctor->average_rating = $doctor->ratings->avg('rating');
                return $doctor;
            });

        return response()->json($doctors);
    }

    public function Alldoctors()
    {


        $doctors = Doctor::latest()->with('ratings')
            ->get()
            ->map(function ($doctor) {
                $doctor->average_rating = $doctor->ratings->avg('rating');
                return $doctor;
            });
        return response()->json($doctors);
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
    public function store(StoreserviceRequest $request)
    {
        try {

            $img = $this->processImage($request->file('img'), null, 'services/');

            $name = $this->getTranslatedNames($request);

            Service::create(['name' => $name, 'img' => $img]);


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
    public function show(service $service)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(service $service)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateserviceRequest $request,  $service)
    {
        try {
            $service = Service::findOrFail($service);
            $img = $this->processImage($request->file('img'), $service->img, 'services/');

            $name = $this->getTranslatedNames($request);
            $service->update(['name' => $name, 'img' => $img]);


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
    public function destroy($service)
    {
        try {
            $service = Service::findOrFail($service);
            $service->delete();
            toast(__('Success'), 'success');
        } catch (\Exception $e) {
            return $e->getMessage();
            toast(__('Error'), 'error');
        }
        return back();
    }
}
