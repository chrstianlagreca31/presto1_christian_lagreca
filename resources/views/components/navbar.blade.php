<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">

        <a class="navbar-brand" href="{{ route('home') }}">Presto</a>

     
        <button class="navbar-toggler" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarNav"
                aria-controls="navbarNav"
                aria-expanded="false"
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">

            {{-- 🔎 FORM RICERCA --}}
            <form class="d-flex me-4"
                  action="{{ route('articles.search') }}"
                  method="GET">

                <input class="form-control me-2"
                       type="search"
                       name="query"
                       placeholder="Cerca annunci..."
                       required>

                <button class="btn btn-outline-light">
                    Cerca
                </button>
            </form>

            <ul class="navbar-nav ms-auto">

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('articles.index') }}">
                        Annunci
                    </a>
                </li>

                
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle"
                       href="#"
                       id="categoriesDropdown"
                       role="button"
                       data-bs-toggle="dropdown"
                       aria-expanded="false">
                        Categorie
                    </a>

                    <ul class="dropdown-menu"
                        aria-labelledby="categoriesDropdown">
                        @foreach($categories as $category)
                            <li>
                                <a class="dropdown-item"
                                   href="{{ route('articles.byCategory', $category) }}">
                                    {{ $category->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>

                @auth
                    {{-- LINK REVISORE --}}
                    @if(auth()->user()->is_revisor)
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('revisor.index') }}">
                                Area Revisore
                                <span class="badge bg-warning text-dark">
                                    {{ \App\Models\Article::toBeRevisedCount() }}
                                </span>
                            </a>
                        </li>
                    @endif

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('articles.create') }}">
                            Inserisci annuncio
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('work.with.us') }}">
                            Lavora con noi
                        </a>
                    </li>

                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button class="btn btn-link nav-link">
                                Logout
                            </button>
                        </form>
                    </li>

                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">
                            Login
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">
                            Registrati
                        </a>
                    </li>
                @endauth

            </ul>
        </div>
    </div>
</nav>
