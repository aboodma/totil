<?php

namespace App\Http\Controllers;

use App\ProviderService;
use App\BookService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProviderServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param ProviderService $providerService
     * @return Response
     */
    public function show(ProviderService $providerService)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param ProviderService $providerService
     * @return Response
     */
    public function edit(ProviderService $providerService)
    {
        return view('website.provider.edit_service', compact('providerService'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param ProviderService $providerService
     * @return Response
     */
    public function update(Request $request, ProviderService $providerService)
    {
        $providerService->price = $request->price;
        if ($providerService->save()) {
            return redirect()->route('provider.services');
        } else {
            return redirect()->route('provider.services');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ProviderService $providerService
     * @return Response
     */
    public function destroy(ProviderService $providerService)
    {
        if ($providerService->delete()) {
            return redirect()->route('provider.services');
        } else {
            return redirect()->route('provider.services');
        }
    }

    public function service_check(Request $request)
    {

        $providerService = BookService::where(['service_id' => $request->service_id, 'book_id' => $request->provider_id])->first();
        $service = $providerService->service;
        return response()->json(['providerService' => $providerService, 'description' => _ti($service->description)], 200);
    }
}
