<x-layout :title="$article->title">

    <div class="container py-5">

        <h1 class="mb-3">{{ $article->title }}</h1>

        <p class="text-muted fs-5">
            {{ $article->price }} €
        </p>

      
       @if($article->images->isNotEmpty())

<div id="carouselShow{{ $article->id }}"
     class="carousel slide mb-4 mx-auto"
     style="max-width:600px;"
     data-bs-ride="carousel">

    <div class="carousel-inner rounded shadow">

        @foreach($article->images as $key => $image)
            <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                <img src="{{ Storage::url($image->path) }}"
     class="d-block w-100"
     style="height:350px; object-fit:contain; background-color:#f8f9fa;">

            </div>
        @endforeach

    </div>

    @if($article->images->count() > 1)
        <button class="carousel-control-prev" type="button"
                data-bs-target="#carouselShow{{ $article->id }}"
                data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>

        <button class="carousel-control-next" type="button"
                data-bs-target="#carouselShow{{ $article->id }}"
                data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    @endif

</div>

@endif


        <p class="mt-4">{{ $article->description }}</p>

       <div class="mt-3">
    <span class="me-2 fw-semibold">Categoria:</span>

    <a href="{{ route('articles.byCategory', $article->category) }}"
       class="btn btn-outline-primary btn-sm rounded-pill px-3">
        {{ __('ui.' . $article->category->name) }}
    </a>
</div>



    </div>

</x-layout>
