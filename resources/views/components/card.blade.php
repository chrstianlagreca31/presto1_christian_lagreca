@php use Illuminate\Support\Facades\Storage; @endphp

<div class="card">

 @if($article->images->isNotEmpty())

    <div id="carouselCard{{ $article->id }}" class="carousel slide" data-bs-ride="carousel">

        <div class="carousel-inner">

            @foreach($article->images as $key => $image)
                <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                    <img src="{{ Storage::url($image->path) }}"
     class="d-block w-100"
     style="height:200px; object-fit:contain; background-color:#f8f9fa;">

                </div>
            @endforeach

        </div>

        @if($article->images->count() > 1)
            <button class="carousel-control-prev" type="button"
                    data-bs-target="#carouselCard{{ $article->id }}"
                    data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </button>

            <button class="carousel-control-next" type="button"
                    data-bs-target="#carouselCard{{ $article->id }}"
                    data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </button>
        @endif

    </div>

@endif




    <div class="card-body">
        <h5>{{ $article->title }}</h5>
        <p>{{ $article->price }} €</p>
        <a href="{{ route('articles.show', $article) }}" class="btn btn-primary">
            Dettagli
        </a>
    </div>

</div>
