<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Spatie\Image\Image;
use Spatie\Image\Enums\CropPosition;

class ResizeImage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $filePath;
    protected $w;
    protected $h;

    public function __construct($filePath, $w, $h)
    {
        $this->filePath = $filePath;
        $this->w = $w;
        $this->h = $h;
    }

    public function handle(): void
    {
        $path = dirname($this->filePath);
        $filename = basename($this->filePath);

        $srcPath = storage_path("app/public/{$path}/{$filename}");
        $destPath = storage_path("app/public/{$path}/crop_{$this->w}x{$this->h}_{$filename}");

        Image::load($srcPath)
            ->crop($this->w, $this->h, CropPosition::Center)
            ->save($destPath);
    }
}
