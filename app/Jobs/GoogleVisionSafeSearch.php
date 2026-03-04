<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable; 
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Image;
use Google\Cloud\Vision\V1\ImageAnnotatorClient;
use Illuminate\Support\Facades\Log;

class GoogleVisionSafeSearch implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $image_id;

    public function __construct($image_id)
    {
        $this->image_id = $image_id;
    }

    public function handle(): void
    {
        $i = Image::find($this->image_id);
        if (!$i) return;

        $imagePath = storage_path('app/public/' . $i->path);
        if (!file_exists($imagePath)) return;

        try {
           $imageAnnotator = new \Google\Cloud\Vision\V1\ImageAnnotatorClient([
    'credentials' => base_path('google_credential.json'),
    'transport' => 'rest'
]);

            $image = file_get_contents($imagePath);
            $response = $imageAnnotator->safeSearchDetection($image);
            $safe = $response->getSafeSearchAnnotation();

           
            $likelihoodName = [
                0 => 'bi bi-question-circle text-secondary', 
                1 => 'bi bi-check-circle text-success',      
                2 => 'bi bi-check-circle text-success',      
                3 => 'bi bi-exclamation-circle text-warning',
                4 => 'bi bi-shield-slash text-danger',     
                5 => 'bi bi-shield-fill-x text-danger'   
            ];

         
            $i->adult = $likelihoodName[$safe->getAdult()];
            $i->spoof = $likelihoodName[$safe->getSpoof()];
            $i->medical = $likelihoodName[$safe->getMedical()];
            $i->violence = $likelihoodName[$safe->getViolence()];
            $i->racy = $likelihoodName[$safe->getRacy()];

            $i->save();
            $imageAnnotator->close();

        } catch (\Exception $e) {
            Log::error("Google Vision SafeSearch Error: " . $e->getMessage());
        }
    }
}