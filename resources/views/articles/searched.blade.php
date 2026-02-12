<x-layout title="Risultati ricerca">

    <div class="container">

        <h1 class="mb-4">
            Risultati per: "{{ $query }}"
        </h1>

        @if($articles->count())
            <div class="row">
                @foreach($articles as $article)
                    <div class="col-md-4 mb-4">
                        <div class="card shadow-sm h-100">
                            <div class="card-body">
                                <h5>{{ $article->title }}</h5>
                                <p>{{ Str::limit($article->description, 100) }}</p>
                                <p><strong>Categoria:</strong> {{ $article->category->name }}</p>
                                <p><strong>Prezzo:</strong> €{{ $article->price }}</p>

                                <a href="{{ route('articles.show', $article) }}"
                                   class="btn btn-primary btn-sm">
                                    Dettaglio
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-4">
                {{ $articles->links() }}
            </div>
        @else
            <div class="alert alert-warning">
                Nessun risultato trovato.
            </div>
        @endif

    </div>

</x-layout>
