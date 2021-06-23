<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Language;

class LanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.language.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function translate(Language $language)
    {
        $code = $language->locale;
        $path = '/' . $code . ".json"; // ie: /var/www/laravel/app/storage/json/filename.json
        $jsons = file_get_contents(App()->langPath() . $path);
        $content = json_decode($jsons, true);
        
        return view('backend.language.translate',compact('content','language'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Language $language)
    {
        $data = $request->data;

        $code = $language->locale;
        $path = '/' . $code . ".json"; // ie: /var/www/laravel/app/storage/json/filename.json
        $jsonString = file_get_contents(App()->langPath() . $path);
        $language = json_decode($jsonString, true);
        // Update Keys
        foreach ($data as $key => $value) {
            $language[$key] = $value;
        }

        // Write File
        $newJsonString = json_encode($language, JSON_UNESCAPED_UNICODE);
        file_put_contents(App()->langPath() . $path, stripslashes($newJsonString));
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
