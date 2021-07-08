<?php

use App\InputTransaction;

if (!function_exists('_ti')) {
    function _ti($sting)
    {
       return InputTransaction::translate_input($sting);
    }
}
if (!function_exists('slugify')) {
function slugify($text, string $divider = '-')
{
  // replace non letter or digits by divider
  $text = preg_replace('~[^\pL\d]+~u', $divider, $text);

  // transliterate
  $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

  // remove unwanted characters
  $text = preg_replace('~[^-\w]+~', '', $text);

  // trim
  $text = trim($text, $divider);

  // remove duplicate divider
  $text = preg_replace('~-+~', $divider, $text);

  // lowercase
  $text = strtolower($text);

  if (empty($text)) {
    return 'n-a';
  }

  return $text;
}
}

if (!function_exists('getUrlMimeType')) {
  function getUrlMimeType($url)
  {
      $buffer = file_get_contents($url);
      $finfo = new finfo(FILEINFO_MIME_TYPE);
      return $finfo->buffer($buffer);
  }
}