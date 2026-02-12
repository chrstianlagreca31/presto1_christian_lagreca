<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">

        <a class="navbar-brand" href="{{ route('home') }}">Presto</a>

        <button class="navbar-toggler" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">

               
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('articles.index') }}">
                        {{ __('ui.announcements') }}
                    </a>
                </li>

               
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle"
                       href="#"
                       role="button"
                       data-bs-toggle="dropdown">
                        {{ __('ui.categories') }}
                    </a>

                    <ul class="dropdown-menu">
                        @foreach($categories as $category)
                            <li>
                                <a class="dropdown-item"
                                   href="{{ route('articles.byCategory', $category) }}">
                                    {{ __('ui.' . $category->name) }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>

                @auth

                 
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
                            {{ __('ui.insert_announcement') }}
                        </a>
                    </li>

                   
                    @if(!auth()->user()->is_revisor)
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('work.with.us') }}">
                                {{ __('ui.work_with_us') }}
                            </a>
                        </li>
                    @endif

                    {{-- LOGOUT --}}
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
                            {{ __('ui.login') }}
                        </a>
                    </li>

                    
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">
                            {{ __('ui.register') }}
                        </a>
                    </li>

                @endauth

                
                <li class="nav-item ms-3 d-flex align-items-center gap-2">
                    <x-_locale lang="it" />
                    <x-_locale lang="en" />
                    <x-_locale lang="es" />
                </li>

            </ul>
        </div>
    </div>
</nav>
