<div class="card shadow-sm border-0 rounded-4 overflow-hidden article-card">


    {{-- IMMAGINI --}}
    @if($article->images->isNotEmpty())

        <div id="carouselCard{{ $article->id }}"
             class="carousel slide"
             data-bs-ride="carousel">

            <div class="carousel-inner">

                @foreach($article->images as $key => $image)
                    <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">

                        <img src="{{ $image->getUrl(300,300) }}"
                             class="d-block w-100"
                             style="height:250px; object-fit:cover;">

                    </div>
                @endforeach

            </div>

            @if($article->images->count() > 1)

                <button class="carousel-control-prev"
                        type="button"
                        data-bs-target="#carouselCard{{ $article->id }}"
                        data-bs-slide="prev">

                    <span class="carousel-control-prev-icon"></span>
                </button>

                <button class="carousel-control-next"
                        type="button"
                        data-bs-target="#carouselCard{{ $article->id }}"
                        data-bs-slide="next">

                    <span class="carousel-control-next-icon"></span>
                </button>

            @endif

        </div>

    @endif


    {{-- CONTENUTO --}}
    <div class="card-body d-flex flex-column">

        <h5 class="fw-bold mb-2">
            {{ $article->title }}
        </h5>

        <p class="price">
    {{ $article->price }} €
</p>
<div class="mb-3">
            <a href="{{ route('articles.byCategory', $article->category) }}"
   class="badge bg-secondary text-decoration-none mb-2">

    {{ __("ui." . $article->category->name) }}

</a>

        </div>

        <a href="{{ route('articles.show', $article) }}"
           class="btn btn-primary mt-auto">
            {{ __('ui.details') }}
        </a>

    </div>

</div>
