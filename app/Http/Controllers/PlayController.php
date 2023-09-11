<?php

namespace App\Http\Controllers;

use App\Jobs\UploadAudioFile;
use Illuminate\Support\Facades\Storage;

class PlayController extends Controller
{

    public function index(int $id)
    {
        if (!Storage::exists('audio_files/' . $id . '.mp3')) {
            UploadAudioFile::dispatch($id);
            return redirect('https://z3.fm/download/' . $id, 301);
        }
        return response()->file(Storage::path('audio_files/' .$id . '.mp3'), ['Content-Type' => 'audio/mp3']);
    }
}
