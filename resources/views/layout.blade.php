<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <title>@yield('title')</title>
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark">
            <div class="container">
                <a class="navbar-brand logo" href="{{route('welcome')}}">
                    <img src="{{asset('storage/img/images/White logo - no background.svg')}}" alt="logo">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ml-auto">
                        @if(!\Illuminate\Support\Facades\Auth::user())
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('register')}}">Регистрация</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('login')}}">Авторизация</a>
                        </li>
                        @endif
                        @if(\Illuminate\Support\Facades\Auth::user() && \Illuminate\Support\Facades\Auth::user()->role === \App\Enums\RoleEnum::USER->value)
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('user')}}">Личный кабинет</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('user.show', auth()->user()->id) }}">Моя карточка</a>
                            </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('logout')}}">Выход</a>
                                </li>
                        @endif
                            @if(\Illuminate\Support\Facades\Auth::user() && \Illuminate\Support\Facades\Auth::user()->role === \App\Enums\RoleEnum::ADMIN->value)
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('admin')}}">Личный кабинет</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('admin.application.index')}}">Все заявки</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('add-admin')}}">Добавить администратора</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('logout')}}">Выход</a>
                                </li>
                            @endif
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    @yield('content')
    <script src="{{ asset('js/inn_validator.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="{{asset('jquery.mask.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
