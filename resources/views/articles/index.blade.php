<x-layout :title="__('ui.tutti_annunci')">

    <div class="container py-5">

        {{-- TITOLO --}}
        <div class="text-center mb-5">
            <h1 class="fw-bold display-5">
                {{ __('ui.tutti_annunci') }}
            </h1>
          
        </div>

        {{-- LISTA ARTICOLI --}}
        <div class="row g-4">

            @forelse($articles as $article)
                <div class="col-md-4">
                    <x-card :article="$article" />
                </div>
            @empty
                <div class="col-12 text-center">
                    <p class="text-muted">
                        Nessun annuncio disponibile
                    </p>
                </div>
            @endforelse

        </div>

        {{-- PAGINAZIONE --}}
        <div class="d-flex justify-content-center mt-5">
            {{ $articles->links() }}
        </div>

    </div>

</x-layout>
