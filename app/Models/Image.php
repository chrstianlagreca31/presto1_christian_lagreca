<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{
    protected $fillable = [
        'path',
        'article_id',
        'labels',
        'adult',
        'spoof',
        'medical',
        'violence',
        'racy'
    ];

    protected $casts = [
        'labels' => 'array',
    ];

    public function article()
    {
        return $this->belongsTo(Article::class);
    }

    public function getUrl($w = null, $h = null)
    {
        if ($w && $h) {

            $path = dirname($this->path);
            $filename = basename($this->path);

            $croppedFile = "{$path}/crop_{$w}x{$h}_{$filename}";

            if (Storage::disk('public')->exists($croppedFile)) {
                return Storage::url($croppedFile);
            }
        }

        return Storage::url($this->path);
    }
}