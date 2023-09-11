<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class PlayController extends Controller
{
    public function index(int $id)
    {

        $remoteFileUrl = 'https://z3.fm/ajax/inc/' . $id; // Замените на URL удаленного файла
        $response = Http::get($remoteFileUrl);
        if ($response->ok()) {
            $fileContents = $response->body();
            $mime = $response->header('Content-Type');

            $response = new Response($fileContents);
            return $response->header('Content-Type', $mime);
        } else {
            abort(404);
        }



       /* if(!Storage::exists('audio_files/' .$id . '.mp3')) {
            $remoteFileUrl = 'https://z3.fm/download/' . $id; // Замените на URL удаленного файла
            $response = Http::get($remoteFileUrl);
            if ($response->ok()) {
                $fileContents = $response->body();
                $mime = $response->header('Content-Type');

                $response = new Response($fileContents);
                return $response->header('Content-Type', $mime);
            } else {
                abort(404);
            }


            $contents = $client->get('https://z3.fm/download/' . $id)->getBody()->getContents();
            if (Storage::put('audio_files/' . $id . '.mp3', $contents)) {
                return response()->file(Storage::path('audio_files/' . $id . '.mp3'), ['Content-Type' => 'audio/mp3']);
            }
        }
        return response()->file(Storage::path('audio_files/' .$id . '.mp3'), ['Content-Type' => 'audio/mp3']);*/
    }
}
