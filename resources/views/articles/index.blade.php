<x-layout title="Annunci">
    <div class="container">
        <h1>Tutti gli annunci</h1>

        <div class="row">
            @foreach($articles as $article)
                <div class="col-md-4">
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5>{{ $article->title }}</h5>
                            <p>{{ Str::limit($article->description, 80) }}</p>

                            <a href="{{ route('articles.show', $article) }}" class="btn btn-sm btn-primary">
                                Leggi
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-layout>
