<x-layout :title="$article->title">
    <div class="container">
        <h1>{{ $article->title }}</h1>

        <p>{{ $article->description }}</p>
        <p><strong>Prezzo:</strong> € {{ $article->price }}</p>
        <p><strong>Categoria:</strong> {{ $article->category->name }}</p>

        <a href="{{ route('articles.index') }}" class="btn btn-secondary">
            Torna indietro
        </a>
    </div>
</x-layout>
