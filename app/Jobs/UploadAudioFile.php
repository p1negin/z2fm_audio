<?php

namespace App\Jobs;

use GuzzleHttp\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class UploadAudioFile implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected array $proxy = [
        'BhUMZP:5nGtMT@91.198.208.158:8000',
        'Ds2zf9:j6uEKs@194.62.67.101:8000',
        'k3gBfU:Ej4p7j@45.133.32.148:8000',
        '4shetz:3YYN0S@45.133.32.245:8000',
    ];

    /**
     * Create a new job instance.
     */
    public function __construct(protected int $id)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $i = array_rand($this->proxy);
        $proxy = $this->proxy[$i];

        $client = new Client([
            'verify' => false,
            //'proxy' => 'http://' . $proxy,
        ]);
        $contents = $client->get('https://z3.fm/download/' . $this->id)->getBody()->getContents();
        Storage::put('audio_files/' . $this->id . '.mp3', $contents);
    }
}
