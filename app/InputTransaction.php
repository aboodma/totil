<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App;
use App\Language;
class InputTransaction extends Model
{
    Static function translate_input($string)
    {

       $trans =  self::where(['string'=>$string,'locale'=>App::getLocale()])->first();
       if ($trans) {
        return $trans->transaction;
       }else{
           return $string;
       }
      
    }

    Static function create_input($string)
    {
        foreach (Language::all() as $language) {
            $input = new self();
            $input->string = $string;
            $input->locale = $language->locale;
            $input->transaction = $string;
            $input->save();
        }
       
    }
}
