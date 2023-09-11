<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Storage;

class PlayController extends Controller
{
    protected array $proxy = [
        'BhUMZP:5nGtMT@91.198.208.158:8000',
        'Ds2zf9:j6uEKs@194.62.67.101:8000',
        'k3gBfU:Ej4p7j@45.133.32.148:8000',
        '4shetz:3YYN0S@45.133.32.245:8000',
    ];


    public function index(int $id)
    {


        if (!Storage::exists('audio_files/' . $id . '.mp3')) {

            $i = array_rand($this->proxy);
            $proxy = $this->proxy[$i];

            $client = new Client([
                'verify' => false,
                //'proxy' => 'http://' . $proxy,

            ]);
            $contents = $client->get('https://z3.fm/download/' . $id)->getBody()->getContents();
            if (Storage::put('audio_files/' . $id . '.mp3', $contents)) {
                return response()->file(Storage::path('audio_files/' . $id . '.mp3'), ['Content-Type' => 'audio/mp3']);
            }
        }
        return response()->file(Storage::path('audio_files/' .$id . '.mp3'), ['Content-Type' => 'audio/mp3']);
    }
}
