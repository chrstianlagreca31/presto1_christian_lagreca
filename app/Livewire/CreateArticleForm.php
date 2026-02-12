<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

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
    $this->validateOnly('temporary_images.*', [
        'temporary_images.*' => 'image|max:1024',
    ]);

    $this->validateOnly('temporary_images', [
        'temporary_images' => 'max:6',
    ]);

    foreach ($this->temporary_images as $image) {
        $this->images[] = $image;
    }

   
    $this->temporary_images = [];
}

    public function removeImage($key)
    {
        if (isset($this->images[$key])) {
            unset($this->images[$key]);
            $this->images = array_values($this->images);
        }
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

            $path = $image->store('images', 'public'); 

            $article->images()->create([
                'path' => $path
            ]);
        }
    }

    session()->flash('success', 'Annuncio creato con successo!');

    $this->reset(['title','description','price','category_id','images','temporary_images']);
}



    public function render()
    {
        return view('livewire.create-article-form', [
            'categories' => Category::all()
        ]);
    }
}
