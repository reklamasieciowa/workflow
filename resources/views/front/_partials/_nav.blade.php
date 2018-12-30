        <nav class="navbar navbar-expand-md navbar-dark default-color navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('jobs') }}">Projekty</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('jobs_by_status', ['1']) }}"><i class="fa fa-play-circle"></i> Do zrobienia</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('jobs_by_status', ['2']) }}"><i class="fa fa-hourglass-half"></i> W trakcie</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('jobs_by_status', ['3']) }}"><i class="fa fa-check"></i> Skończone</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('jobs_by_status', ['4']) }}"><i class="fa fa-check-circle"></i> Zatwierdzone</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('jobs_by_status', ['3']) }}">Kosz</a>
                        </li>
                    </ul>
                    <form class="form-inline">
                        <div class="md-form my-0">
                          <input class="form-control mr-sm-2" type="text" placeholder="Szukaj" aria-label="Szukaj">
                        </div>
                        <button class="btn btn-outline-white btn-md my-2 my-sm-0 ml-3" type="submit">Szukaj</button>
                    </form>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>