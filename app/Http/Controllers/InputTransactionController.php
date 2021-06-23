<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\InputTransaction;
use App\ProviderType;
use App\Service;
use App\Country;
class InputTransactionController extends Controller
{
    public function index($locale)
    {
        $inputs = InputTransaction::where('locale',$locale)->get();
       return view('backend.language.translate_inputs',compact('inputs','locale'));
    }

    public function update(Request $request , $locale)
    {
    //   return  $request->all();
      foreach ($request->data as $key => $value) {
       $input =  InputTransaction::find($key);
       $input->transaction = $value;
       $input->save();
      }
      return redirect()->route('admin.language.index');
    }

    public function generate($locale)
    {
        InputTransaction::where('locale',$locale)->delete();
            $categories = ProviderType::all();
            $services = Service::all();
            $countries = Country::all();
            foreach ($categories as $category) {
                $input = new InputTransaction();
                $input->string = $category->name;
                $input->transaction = $category->name;
                $input->locale = $locale;
                $input->save();
                $input_1 = new InputTransaction();
                $input_1->string = $category->description;
                $input_1->transaction = $category->description;
                $input_1->locale = $locale;
                $input_1->save();
            }
            foreach ($services as $service) {
                $input = new InputTransaction();
                $input->string = $service->name;
                $input->transaction = $service->name;
                $input->locale = $locale;
                $input->save();
                $input_1 = new InputTransaction();
                $input_1->string = $service->description;
                $input_1->transaction = $service->description;
                $input_1->locale = $locale;
                $input_1->save();
            }
            foreach ($countries as $country) {
                $input = new InputTransaction();
                $input->string = $country->name;
                $input->transaction = $country->name;
                $input->locale = $locale;
                $input->save();
            }
            return redirect()->back();
    }
}
