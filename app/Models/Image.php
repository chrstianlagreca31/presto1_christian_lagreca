<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{
    protected $fillable = [
        'path',
        'article_id'
    ];

   

    public function article()
    {
        return $this->belongsTo(Article::class);
    }



    public static function getUrlByFilePath($filePath, $w = null, $h = null)
    {
        
        if ($w === null || $h === null) {
            return Storage::disk('public')->url($filePath);
        }

    
        $path = dirname($filePath);
        $filename = basename($filePath);

       
        $croppedFile = "{$path}/crop_{$w}x{$h}_{$filename}";

      
        if (Storage::disk('public')->exists($croppedFile)) {
            return Storage::disk('public')->url($croppedFile);
        }

        
        return Storage::disk('public')->url($filePath);
    }

   

    public function getUrl($w = null, $h = null)
    {
        return self::getUrlByFilePath($this->path, $w, $h);
    }
}
