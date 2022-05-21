<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MapController extends Controller
{
    public function index() //追加
        {   //大阪市役所近辺のスポッチャ及び市民体育館を近い順に取得
            $apiKey = storage_path('app/private/keys/googleplaces.php');//apiキーを記したファイル
            $apiKey = fopen($apiKey, 'r');
            $apiKey = fgets($apiKey);

            $url= 'https://maps.googleapis.com/maps/api/place/nearbysearch/json?key='.$apiKey.'&location=34.6937366,135.4999782&rankby=distance&language=ja&keyword=スポッチャ';
            
            $json_str = file_get_contents($url); // 文字列に変換
            $json_obj = json_decode($json_str); // オブジェクトに変換

            $stages = $json_obj->results;
            
            foreach($stages as $key => $stage){
                $photoReference = $stages[$key]->photos[0]->photo_reference;
                $placeId = $stage->place_id;

                //営業時間
                $opentime = json_decode(file_get_contents('https://maps.googleapis.com/maps/api/place/details/json?place_id='.$placeId.'&key='.$apiKey.'&fields=formatted_phone_number,opening_hours,website,business_status&language=ja'))->result;

                $stagesList[$key] = array(
                    'name' => $stages[$key]->name,
                    'address' => $stages[$key]->vicinity,
                    'image'=>'https://maps.googleapis.com/maps/api/place/photo?maxwidth=400&photoreference='.$photoReference.'&key='.$apiKey,
                    'time'=> $opentime->opening_hours->weekday_text,
                    'website'=>$opentime->website,
                    'phoneNumber'=>$opentime->formatted_phone_number,
                );
            } 
            return $stagesList;
        }
    public function readStaticJson(){
        $url = storage_path('app/private/json/map.json');
        $json_str = file_get_contents($url); // 文字列に変換
        $json_obj = json_decode($json_str); // オブジェクトに変換    
        $json_obj = array_slice($json_obj, 0, 3);
        return $json_obj;
    }
}