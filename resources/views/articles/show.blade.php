@php use Illuminate\Support\Facades\Storage; @endphp

<x-layout :title="$article->title">

<div class="container py-5">

    <div class="row">

        <div class="col-md-6">

            @if($article->images->isNotEmpty())

                <div id="carouselShow{{ $article->id }}"
                     class="carousel slide"
                     data-bs-ride="carousel">

                    <div class="carousel-inner">

                        @foreach($article->images as $key => $image)
                            <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                                <img src="{{ Storage::url($image->path) }}"
                                     class="d-block w-100 detail-img">
                            </div>
                        @endforeach

                    </div>

                    @if($article->images->count() > 1)
                        <button class="carousel-control-prev"
                                type="button"
                                data-bs-target="#carouselShow{{ $article->id }}"
                                data-bs-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                        </button>

                        <button class="carousel-control-next"
                                type="button"
                                data-bs-target="#carouselShow{{ $article->id }}"
                                data-bs-slide="next">
                            <span class="carousel-control-next-icon"></span>
                        </button>
                    @endif

                </div>

            @endif

        </div>

        <div class="col-md-6">

            <a href="{{ route('articles.byCategory', $article->category) }}"
               class="badge bg-secondary text-decoration-none mb-3">
                {{ $article->category->name }}
            </a>

            <h1 class="fw-bold">
                {{ $article->title }}
            </h1>

            <p class="fs-3 text-primary fw-bold">
                {{ $article->price }} €
            </p>

            <p class="mt-4">
                {{ $article->description }}
            </p>

        </div>

    </div>

</div>

</x-layout>
