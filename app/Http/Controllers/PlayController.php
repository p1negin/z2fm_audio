<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;

class PlayController extends Controller
{
    public function index(int $id)
    {
        if(!Storage::exists('audio_files/' .$id . '.mp3')) {
            Storage::put('audio_files/' .$id . '.mp3', 'https://z3.fm/download/' . $id);
        }
        return response()->download(Storage::path('audio_files/' .$id . '.mp3'));
    }
}
