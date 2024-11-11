<?php

namespace App\Http\Controllers\admin;

use App\Models\Service;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreserviceRequest;
use App\Http\Requests\UpdateserviceRequest;
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

        return view('admin.services.index', compact('services'));
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
            $desc = $this->getTranslatedDesc($request);
    
            $created_by = auth()->id();            
    
            Service::create([
                'name' => $name, 
                'desc' => $desc, 
                'price' => $request->price,  
                'img' => $img,
                'created_by' => $created_by 
            ]);
    
            toast(__('Success'), 'success');
        } catch (\Exception $e) {
    
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
            $desc = $this->getTranslatedDesc($request);
            $service->update(['name' => $name, 'desc' => $desc, 'price' => $request->price, 'img' => $img]);


            toast(__('Success'), 'success');
        } catch (\Exception $e) {

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

            toast(__('Error'), 'error');
        }
        return back();
    }
}
