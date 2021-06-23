<?php

use App\InputTransaction;

if (!function_exists('_ti')) {
    function _ti($sting)
    {
       return InputTransaction::translate_input($sting);
    }
}