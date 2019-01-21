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

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdownProjekty" data-toggle="dropdown" aria-haspopup="true"
                              aria-expanded="false"><i class="fas fa-tag mr-1"></i> Projekty</a>
                            <div class="dropdown-menu dropdown-projekty" aria-labelledby="navbarDropdown">
                              <a class="dropdown-item" href="{{ route('jobs') }}"><i class="fas fa-tag text-info mr-1"></i> Aktualnie</a>
                              <div class="dropdown-divider"></div>
                              <a class="dropdown-item" href="{{ route('job_create') }}"><i class="fas fa-plus-circle text-success mr-1"></i> Dodaj</a>
                              <div class="dropdown-divider"></div>
                              <a class="dropdown-item" href="{{ route('jobs_deleted') }}"><i class="far fa-trash-alt text-danger mr-1"></i> Kosz</a>
                              <div class="dropdown-divider"></div>
                              <a class="dropdown-item" href="{{ route('jobs_by_status', ['1']) }}"><i class="fa fa-play-circle text-danger mr-1"></i> Do zrobienia</a>
                              <a class="dropdown-item" href="{{ route('jobs_by_status', ['2']) }}"><i class="fa fa-hourglass-half text-warning mr-1"></i> W trakcie</a>
                              <a class="dropdown-item" href="{{ route('jobs_by_status', ['3']) }}"><i class="fa fa-check text-success mr-1"></i> Zrobione</a>
                              <a class="dropdown-item" href="{{ route('jobs_by_status', ['4']) }}"><i class="fa fa-check-circle text-success mr-1"></i> Zatwierdzone</a>
                            </div>
                           
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('users') }}"><i class="fas fa-user"></i> Użytkownicy</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#"><i class="fas fa-list"></i></i> Checklista</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#"><i class="fas fa-chart-pie"></i> Statystyki</a>
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