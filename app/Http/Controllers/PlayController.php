<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Storage;

class PlayController extends Controller
{
    public function index(int $id)
    {

        if(!Storage::exists('audio_files/' .$id . '.mp3')) {


                $ch = curl_init('https://z3.fm/download/' . $id);
                curl_setopt_array($ch, [
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_HEADER         => false,
                    CURLOPT_REFERER        => 'https://z3.fm/',
                    CURLOPT_FOLLOWLOCATION => 1,
                    CURLOPT_SSL_VERIFYPEER => false,
                    CURLOPT_USERAGENT      => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 YaBrowser/23.7.4.971 Yowser/2.5 Safari/537.36',
                    CURLOPT_HTTPHEADER      => array("Cookie: zvApp=detect2; PHPSESSID=0e9pv7c5bkuqfcl06ikb2hebq4; zvAuth=1; zvLang=0; YII_CSRF_TOKEN=790327244f1944bab17be01890dbaa91ab76e6a1; zv=tak-tak-tak; ZvcurrentVolume=100; _ga=GA1.1.578043042.1694425888; _ga_4QVWK2LSTX=GS1.1.1694428526.2.0.1694428526.0.0.0; _oobs_=NXV0cmFfLV9kYXZhal9zYmV6aGltX19pc2tvcmtpXyh6My5mbSkubXAz"),
                ]);

                $data = curl_exec($ch);
                $info = curl_getinfo($ch);

                curl_close($ch);

                dd($data);

                return [
                    'html' => $data,
                    'headers' => $info,
                ];
            }






            /*if (Storage::put('audio_files/' . $id . '.mp3', $contents)) {
                return response()->file(Storage::path('audio_files/' . $id . '.mp3'), ['Content-Type' => 'audio/mp3']);
            }*/

        return response()->file(Storage::path('audio_files/' .$id . '.mp3'), ['Content-Type' => 'audio/mp3']);
    }
}
