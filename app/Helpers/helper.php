<?php
use Illuminate\Support\Facades\App;

use App\Models\Seo;
use App\Models\SiteSetting;




function Translate($text,$lang){

    $api  = 'trnsl.1.1.20190807T134850Z.8bb6a23ccc48e664.a19f759906f9bb12508c3f0db1c742f281aa8468';

    $url = file_get_contents('https://translate.yandex.net/api/v1.5/tr.json/translate?key='.$api
        .'&lang=ar' . '-' . $lang . '&text=' . urlencode($text));
    $json = json_decode($url);
    return $json->text[0];

}



function lang(){
    return App() -> getLocale();
}



if (!function_exists('languages')) {
  function languages() {
    return [ 'en'];
  }
}

if (!function_exists('defaultLang')) {
  function defaultLang() {
    return 'en';
  }
}

function numberFormat($number){
    return number_format((float)$number, 2, '.', '');
}

function setting($key = false)
{
    if ($key != false) {
        if ($s = SiteSetting::where('key', $key)->first()) {
            return $s->value;
        }
        return false;
    }
    return false;
}

#No3man
function getDistanceHaving($result, $latitude =null, $longitude = null){

    $range = (int)appInformations()['distance_range'];
    if($latitude && $longitude){
        $raw   = DB::raw('( 6371 * acos( cos( radians(' . $latitude . ') ) *cos( radians( lat ) )
           * cos( radians( lng ) - radians(' . $longitude . ') ) + sin( radians(' . $latitude . ') )
           * sin( radians( lat ) ) ) )  AS distance');
        $results = $result->select('*', $raw)->addSelect($raw)->orderBy('distance' ,'asc')->having('distance', '<=', $range)->get();
    }else{
        $results = $result->get();
    }
//    dd($results);
    return $results;
}



