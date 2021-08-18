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
        $text = iconv('utf-8', 'utf-8//TRANSLIT', $text);

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
if (!function_exists('formatSizeUnits')) {
    function formatSizeUnits($bytes)
    {
        if ($bytes >= 1073741824) {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        } elseif ($bytes >= 1048576) {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        } elseif ($bytes >= 1024) {
            $bytes = number_format($bytes / 1024, 2) . ' KB';
        } elseif ($bytes > 1) {
            $bytes = $bytes . ' bytes';
        } elseif ($bytes == 1) {
            $bytes = $bytes . ' byte';
        } else {
            $bytes = '0 bytes';
        }

        return $bytes;
    }
}

function htmlToImage($html){





    $google_fonts = "Roboto";

    $data = array('html' => "<html><body><div  style='height:567px;width:100%;text-align: center;'>".$html."</div></body></html>",

        'google_fonts' => $google_fonts);

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, "https://hcti.io/v1/image");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));

    curl_setopt($ch, CURLOPT_POST, 1);
// Retrieve your user_id and api_key from https://htmlcsstoimage.com/dashboard
    curl_setopt($ch, CURLOPT_USERPWD, "7f2fac59-78e7-4763-8b16-bd7014b9c488" . ":" . "8b1b306d-6589-4b0c-999f-7cae40c963ae");

    $headers = array();
    $headers[] = "Content-Type: application/x-www-form-urlencoded";
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $result = curl_exec($ch);
    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    }
    curl_close($ch);
    $res = json_decode($result, true);
    return $res['url'];
// https://hcti.io/v1/image/202dc04d-5efc-482e-8f92-bb51612c84cf


}
