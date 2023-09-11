<?php

namespace App\Http\Controllers;

use App\Jobs\UploadAudioFile;
use Illuminate\Support\Facades\Storage;

class PlayController extends Controller
{
    public function index(int $id)
    {
        $directory = str_split(md5($id), 3);
        $path = 'audio_files/';
        foreach ($directory as $value) {
            $path .= $value . '/';
        }

        if (!Storage::exists($path . $id . '.mp3')) {
            UploadAudioFile::dispatch($id)->onQueue('default');
            return redirect('https://z3.fm/download/' . $id);
        }
        return response()->file(Storage::path($path .$id . '.mp3'), ['Content-Type' => 'audio/mp3']);
    }
}
