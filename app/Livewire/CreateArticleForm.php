<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Article;
use App\Models\Category;
use App\Jobs\ResizeImage;
use App\Jobs\GoogleVisionSafeSearch;
use App\Jobs\GoogleVisionLabelImage;
use Illuminate\Support\Facades\File;

class CreateArticleForm extends Component
{
    use WithFileUploads;

    public $title;
    public $description;
    public $price;
    public $category_id;

    public $temporary_images = [];
    public $images = [];

    protected function rules()
    {
        return [
            'title' => 'required|min:3',
            'description' => 'required|min:5',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
        ];
    }

    public function updatedTemporaryImages()
    {
        foreach ($this->temporary_images as $image) {
            $this->images[] = $image;
        }

        $this->temporary_images = [];
    }

    public function removeImage($key)
    {
        unset($this->images[$key]);
        $this->images = array_values($this->images);
    }

    public function store()
    {
        $this->validate();

        $article = Article::create([
            'title' => $this->title,
            'description' => $this->description,
            'price' => $this->price,
            'category_id' => $this->category_id,
            'user_id' => auth()->id(),
        ]);

        if (!empty($this->images)) {

            foreach ($this->images as $image) {

                $folder = "articles/{$article->id}";
                $filePath = $image->store($folder, 'public');

                $newImage = $article->images()->create([
                    'path' => $filePath
                ]);

           
                ResizeImage::dispatch($newImage->path, 300, 300);

           
                GoogleVisionSafeSearch::dispatch($newImage->id);
                GoogleVisionLabelImage::dispatch($newImage->id);
            }
        }

        File::deleteDirectory(storage_path('/app/livewire-tmp'));

        session()->flash('success', 'Annuncio creato con successo!');

        $this->reset([
            'title',
            'description',
            'price',
            'category_id',
            'images',
            'temporary_images'
        ]);
    }

    public function render()
    {
        return view('livewire.create-article-form', [
            'categories' => Category::all()
        ]);
    }
}