<?php

namespace App\Http\Controllers;

use App\Service;
use Illuminate\Http\Request;
use App\InputTransaction;
use Illuminate\Http\Response;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $services = Service::all();
        return view('backend.service.list', compact('services'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('backend.service.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $service = new Service();
        $service->name = $request->name;
        $service->description = $request->description;
        $service->duration = 0;
        $service->image = "no Image";
        $service->is_video = $request->is_video;
        if ($service->save()) {
            InputTransaction::create_input($request->name);
            InputTransaction::create_input($request->description);
            return redirect()->route('admin.service_list');

        } else {
            return redirect()->route('admin.service_list');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Service $service
     * @return Response
     */
    public function show(Service $service)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Service $service
     * @return Response
     */
    public function edit(Service $service)
    {
        return view('backend.service.edit', compact('service'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Service $service
     * @return Response
     */
    public function update(Request $request, Service $service)
    {
        $service->name = $request->name;
        $service->description = $request->description;
        $service->duration = 0;
        $service->is_video = $request->is_video;
        if ($service->save()) {
            return redirect()->route('admin.service_list');
        } else {
            return redirect()->route('admin.service_list');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Service $service
     * @return Response
     */
    public function destroy(Service $service)
    {
        if ($service->delete()) {
            return redirect()->route('admin.service_list');
        } else {
            return redirect()->route('admin.service_list');
        }
    }


}
