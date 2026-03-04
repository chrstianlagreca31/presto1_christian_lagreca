<?php

namespace App\Jobs;

use App\Models\Image;
use Google\Cloud\Vision\V1\ImageAnnotatorClient;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class GoogleVisionLabelImage implements ShouldQueue
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

        if (!$i) {
            return;
        }

        $imagePath = storage_path('app/public/' . $i->path);

        if (!file_exists($imagePath)) {
            return;
        }

        $image = file_get_contents($imagePath);

        putenv('GOOGLE_APPLICATION_CREDENTIALS=' . base_path('google_credential.json'));

        $imageAnnotator = new ImageAnnotatorClient();

        $response = $imageAnnotator->labelDetection($image);

        $labels = $response->getLabelAnnotations();

        if ($labels) {
            $result = [];

            foreach ($labels as $label) {
                $result[] = $label->getDescription();
            }

            $i->labels = $result;
            $i->save();
        }

        $imageAnnotator->close();
    }
}