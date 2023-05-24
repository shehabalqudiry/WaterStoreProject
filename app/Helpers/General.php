<?php

use App\Models\Setting;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;


function settings()
{
    return Setting::first();
}

function sendCode($numbers, $msg)
{
    $user = '';
    $pass = '';
    $sender = '';
    $url = "";

    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    $resp = curl_exec($curl);
    curl_close($curl);
    return $resp;
}

function googleTrans($value)
{
    $value = GoogleTranslate::trans($value, app()->getLocale());
    return $value;
}


function uploadImage($folder, $image)
{
    //$image->store( $folder);
    $filename = time() . '.' . $image->getClientOriginalExtension();
    $path2 = public_path("images/".$folder);
    $image->move($path2, $filename);
    $path = 'images/' . $folder . '/' . $filename;
    return $path;
}

function deleteFile($table, $id, $column)
{
    $img = DB::table($table)->where('id', $id)->first();
    File::delete($img->$column);
    return ;
}
function sendmessage($token, $title, $body)
{
    $from = "AAAAfjsR3Qk:APA91bExCj_gkwSlkI5BVcLM_rKM54UJuFhFRmFtWm5w_G8XlndYFOzT4ERU6Qw--8-nnwh_sUH5HxRtTXoUPkrtI4kKer_GqdKj2pSvZHeyI6hTqunVe_gJhe5YFc6ZyHHVqdisnuP7";
    $msg = array(
            'body'     => $body,
            'title'    => $title,
            'receiver' => 'erw',
            'icon'     => "https://salon-eljoker.com/images/joker.jpg",/*Default Icon*/
            'vibrate'	=> 1,
            'sound'		=> "http://commondatastorage.googleapis.com/codeskulptor-demos/DDR_assets/Kangaroo_MusiQue_-_The_Neverwritten_Role_Playing_Game.mp3",
            );

    $fields = array(
                'to'        => $token,
                'notification'  => $msg
            );

    $headers = array(
                'Authorization: key=' . $from,
                'Content-Type: application/json'
            );
    //#Send Reponse To FireBase Server
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}
