<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;

class PlayController extends Controller
{
    public function index(int $id)
    {
        dd('https://z3.fm/download/' . $id);
        if(!Storage::exists('audio_files/' .$id . '.mp3')) {
            if(Storage::put('audio_files/' .$id . '.mp3', file_get_contents('https://z3.fm/download/' . $id))) {
                return response()->file(Storage::path('audio_files/' .$id . '.mp3'), ['Content-Type' => 'audio/mp3']);
            }
        }
        return response()->file(Storage::path('audio_files/' .$id . '.mp3'), ['Content-Type' => 'audio/mp3']);
    }
}
