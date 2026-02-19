<x-layout>

    {{-- HERO --}}
    <section class="hero text-white text-center py-5 mb-5">
        <div class="container">

            <h1 class="display-3 fw-bold">
                {{ __('ui.welcome') }}
            </h1>

            <a href="{{ route('articles.create') }}"
               class="btn btn-primary btn-lg mt-4 px-4 py-2">
                {{ __('ui.insert_announcement') }}
            </a>

        </div>
    </section>


    {{-- ULTIMI ANNUNCI --}}
    <div class="container mb-5">

        <h2 class="mb-4 fw-bold">
            {{ __('ui.latest_announcements') }}
        </h2>

        <div class="row g-4">

            @foreach($articles as $article)

                <div class="col-12 col-md-6 col-lg-4">
                    <x-card :article="$article" />
                </div>

            @endforeach

        </div>

    </div>

</x-layout>
