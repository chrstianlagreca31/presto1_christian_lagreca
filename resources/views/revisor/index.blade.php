<x-layout title="Dashboard Revisore">
    <div class="container">

        @if($article_to_check)

            <h2 class="mb-3">{{ $article_to_check->title }}</h2>

            <div class="row my-3">

                @if($article_to_check->images->count() > 0)

                    @foreach($article_to_check->images as $image)
                        <div class="col-md-4 mb-4">
                            <div class="card shadow-sm">

                                <img 
                                    src="{{ $image->getUrl(300,300) }}"
                                    class="card-img-top img-fluid"
                                    alt="{{ $article_to_check->title }}"
                                >

                                <div class="card-body">

                                    <h6>Contenuto rilevato:</h6>

                                    <p>Adult: <i class="{{ $image->adult }}"></i></p>
                                    <p>Spoof: <i class="{{ $image->spoof }}"></i></p>
                                    <p>Medical: <i class="{{ $image->medical }}"></i></p>
                                    <p>Violence: <i class="{{ $image->violence }}"></i></p>
                                    <p>Racy: <i class="{{ $image->racy }}"></i></p>

                                    @if($image->labels)
                                        <div class="mt-2">
                                            <h6>Etichette:</h6>
                                            @foreach($image->labels as $label)
                                                <span class="badge bg-secondary me-1 mb-1">
                                                    {{ $label }}
                                                </span>
                                            @endforeach
                                        </div>
                                    @endif

                                </div>
                            </div>
                        </div>
                    @endforeach

                @endif

            </div>

            <p class="mt-3">{{ $article_to_check->description }}</p>

            <div class="mt-4">
                <form method="POST" action="{{ route('revisor.accept', $article_to_check) }}">
                    @csrf
                    @method('PATCH')
                    <button class="btn btn-success">Accetta</button>
                </form>

                <form method="POST" action="{{ route('revisor.reject', $article_to_check) }}" class="mt-2">
                    @csrf
                    @method('PATCH')
                    <button class="btn btn-danger">Rifiuta</button>
                </form>
            </div>

        @else
            <p>Nessun articolo da revisionare</p>
            <a href="/" class="btn btn-primary">Torna alla home</a>
        @endif

    </div>
</x-layout>