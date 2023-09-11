<?php

namespace App\Jobs;

use GuzzleHttp\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class UploadAudioFile implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected array $proxy = [
        'user:password@host:port',
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
        if($contents) {

            $directory = str_split(md5($this->id), 3);
            $path = 'audio_files/';
            foreach ($directory as $value) {
                $path .= $value . '/';
            }

            Storage::put($path . $this->id . '.mp3', $contents);
        }
    }
}
