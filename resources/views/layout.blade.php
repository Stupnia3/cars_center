<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU&amp;apikey=23d39131-3312-4163-a84c-fda06d024fa2" type="text/javascript"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <title>@yield('title')</title>
</head>
<body>
<div class="wrapper">
    <header class="header">
        <div class="header__container container flex">
            <div class="logo__container flex">
                <a href="{{route('welcome')}}" class="logo__picture">
                    <img src="{{asset('storage/img/images/Black logo - no background.svg')}}" alt="Логотип компании">
                </a>
                <a href="{{route('welcome')}}" class="logo__name font-size-average">Автосервисы</a>
            </div>
            <nav class="navigation">
                <ul class="navigation__user ">
                    <li>
                        <a href="{{route('search')}}" class="navigation__user__link">
                            Поиск
                        </a>
                    </li>
                    @if(!\Illuminate\Support\Facades\Auth::user())
                        <li class="navigation__user__item ">
                            <a class="navigation__user__link" href="{{route('register')}}">Оставить заявку</a>
                        </li>
                        <li class="navigation__user__item ">
                            <a class="navigation__user__link login__btn border border-dark p-3 rounded text-white"
                               href="{{ route('login') }}">Войти</a>
                        </li>
                    @endif
                    @if(\Illuminate\Support\Facades\Auth::user() && \Illuminate\Support\Facades\Auth::user()->role === \App\Enums\RoleEnum::USER->value)
                        <li class="navigation__user__item ">
                            <a class="navigation__user__link" href="{{route('user')}}">Личный кабинет</a>
                        </li>
                        <li class="navigation__user__item">
                            <a class="navigation__user__link" href="{{ route('user.show', auth()->user()->id) }}">Моя
                                карточка</a>
                        </li>
                        <li class="navigation__user__item">
                            <a class="navigation__user__link login__btn border border-red p-3 rounded text-white"
                               href="{{route('logout')}}">Выход</a>
                        </li>
                    @endif
                    @if(\Illuminate\Support\Facades\Auth::user() && \Illuminate\Support\Facades\Auth::user()->role === \App\Enums\RoleEnum::ADMIN->value)
                        <li class="navigation__user__item ">
                            <a class="navigation__user__link" href="{{route('admin')}}">Личный кабинет</a>
                        </li>
                        <li class="navigation__user__item">
                            <a class="navigation__user__link" href="{{route('admin.application.index')}}">Все заявки</a>
                        </li>
                        <li class="navigation__user__item">
                            <a class="navigation__user__link" href="{{route('add-admin')}}">Добавить администратора</a>
                        </li>
                        <li class="navigation__user__item">
                            <a class="navigation__user__link exit__btn border border-red p-3 rounded text-white login__btn"
                               href="{{route('logout')}}">Выход</a>
                        </li>
                    @endif
                </ul>
            </nav>
            <button class="burger-button burger"></button>
        </div>
    </header>
    {{--                    <form class="form-inline my-2 my-lg-0 ml-auto" action="{{ route('search') }}" method="GET"--}}
    {{--                          id="searchForm">--}}
    {{--                        <input class="form-control mr-sm-2" placeholder="Поиск" aria-label="Search" name="query"--}}
    {{--                               type="text" id="searchInput">--}}
    {{--                        --}}{{--                    <button class="btn btn-outline-light my-2 my-sm-0" type="submit">Найти</button>--}}
    {{--                        <div id="searchResults" class="position-absolute bg-light border rounded"--}}
    {{--                             style="display: none; top: 4rem!important; z-index: 10"></div>--}}
    {{--                    </form>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </nav>--}}
    {{--        <div class="container position-relative">--}}
    {{--            <div id="searchResults" class="position-absolute bg-light border rounded mt-1" style="display: none;"></div>--}}
    {{--        </div>--}}
    @yield('content')
</div>
<script src="{{ asset('js/inn_validator.js') }}"></script>
<script src="{{ asset('js/burger.js') }}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="{{asset('jquery.mask.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{asset('js/smooth-scroll.js')}}"></script>
<script src="{{asset('js/gallary.js')}}"></script>

</body>
</html>

