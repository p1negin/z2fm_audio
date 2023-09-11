<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Storage;

class PlayController extends Controller
{
    public function index(int $id)
    {

        if(!Storage::exists('audio_files/' .$id . '.mp3')) {
            $client = new Client([
                'verify' => false
            ]);
            $contents = $client->get('https://z3.fm/download/' . $id)->getBody()->getContents();
            if (Storage::put('audio_files/' . $id . '.mp3', $contents)) {
                return response()->file(Storage::path('audio_files/' . $id . '.mp3'), ['Content-Type' => 'audio/mp3']);
            }
        }
        return response()->file(Storage::path('audio_files/' .$id . '.mp3'), ['Content-Type' => 'audio/mp3']);
    }
}
