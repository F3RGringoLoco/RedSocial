<nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">Red Social</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <!--<li class="nav-item">
                    <a class="nav-link" href="{{route('post.index')}}">Publicaciones</a>
                </li>
                <li class="nav-item">
                    <a href="{{route('profesional.index')}}" class="nav-link">Profesionales</a>
                </li>
                <li class="nav-item">
                    <a href="{{route('company.index')}}" class="nav-link">Compañia</a>
                </li>
                <li class="nav-item">
                    <a href="{{route('home')}}" class="nav-link">Home</a>
                </li>-->
            </ul>
            <span class="navbar-text">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Iniciar Sesión') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Registrarme') }}</a>
                            </li>
                        @endif
                    @else
                        <form method="GET" action="{{route('search')}}">
                            @csrf
                            <div class="searchbar me-5">
                                <input name="texto" class="search_input" type="text" placeholder="Buscar...">
                                <button type="submit" class="search_icon"><i class="fas fa-search"></i></button>
                            </div>
                        </form>

                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->email }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item text-dark" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                    {{ __('Cerrar Sesión') }}
                                </a>
    
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </span>
        </div>
    </div>
</nav>