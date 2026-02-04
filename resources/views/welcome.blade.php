<x-layout title="Home">
    <div class="container text-center">
        <h1>Benvenuta su Presto</h1>

        @auth
            <a href="{{ route('articles.create') }}" class="btn btn-primary mt-3">
                Inserisci annuncio
            </a>
        @else
            <a href="{{ route('register') }}" class="btn btn-success mt-3">
                Registrati
            </a>
        @endauth
    </div>
</x-layout>
