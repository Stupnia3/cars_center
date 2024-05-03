@extends('layout')

@section('title', 'Главная страница')

@section('content')
{{--    <div class="container">--}}
{{--        <h1 class="mt-4">Карточки пользователей</h1>--}}
{{--        <div class="row">--}}
{{--            @foreach($users as $user)--}}
{{--                @if($user->role !== 'admin' && $user->status === 'active')--}}
{{--                    <div class="col-md-4 mb-4">--}}
{{--                        <div class="card h-100 shadow">--}}
{{--                            <div class="card-body">--}}
{{--                                <h5 class="card-title">{{ $user->name_company }}</h5>--}}
{{--                                <p class="card-text">Email: {{ $user->email }}</p>--}}
{{--                                <p class="card-text">Телефон: {{ $user->phone }}</p>--}}
{{--                                <p class="card-text">Адрес: {{ $user->address }}</p>--}}
{{--                                <!-- Добавьте другие данные пользователя, если необходимо -->--}}
{{--                            </div>--}}
{{--                            <div class="card-footer bg-info d-flex justify-content-between align-items-center">--}}
{{--                                <a href="{{ route('user.show', $user->id) }}" class="btn btn-light">Подробнее</a>--}}
{{--                                @if(auth()->check() && auth()->user()->isAdmin())--}}
{{--                                    <form method="POST" action="{{ route('admin.users.update', $user->id) }}">--}}
{{--                                        @csrf--}}
{{--                                        @method('PUT') <!-- Изменяем метод на PUT -->--}}
{{--                                        <input type="hidden" name="_method" value="PUT"> <!-- Добавляем скрытое поле _method -->--}}
{{--                                        <button type="submit" name="status" value="deleted" class="btn btn-danger ml-2">Удалить</button>--}}
{{--                                    </form>--}}
{{--                                @endif--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                @endif--}}
{{--            @endforeach--}}
{{--        </div>--}}
{{--    </div>--}}

    <section class="preview element-animation element-show">
        <div class="container">
            <h1 class="preview-heading">Найти автосервис по душе</h1>
            <div class="preview-card">
                <form action="" method="GET">
                    <div class="row">
                        <div class="col-md-3 mb-3 mb-sm-3 mb-lg-0">
                            <input type="text" class="form-control preview-control" name="keyword" id="keyword" placeholder="Название, виды работ">
                        </div>
                        <div class="col-md-3 mb-3 mb-sm-3 mb-lg-0">
                            <input type="text" class="form-control preview-control" name="location" id="location" placeholder="Город">
                        </div>
                        <div class=" col-md-3 mb-xs-3 mb-sm-3 mb-lg-0">
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">Поиск</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <section class="featured element-animation mt-5 element-show">
        <div class="container">
            <h2 class="heading">Рекомендуемые объявления</h2>
            <div class="row">
                <div class="job_listing_area">
                    <div class="job_lists">
                        <div class="row">
                            @foreach($users->sortByDesc('id')->take(3) as $user)
                                @if($user->role !== 'admin' && $user->status === 'active')
                                    <div class="col-md-6">
                                        <div class="card border-0 p-3 shadow mb-4">
                                            <div class="card-body">
                                                <h4 class="border-0 fs-5 pb-2 mb-0"><a
                                                        href="{{ route('user.show', $user->id) }}">
                                                        {{ $user->name_company }}</a></h4>
                                                <p class="description">{{ $user->description  }}</p>
                                                <div class="card-info p-4 border">
                                                    <p class="mb-1">
                                                        <span class="card-vector"><img
                                                                src="{{asset('storage/img/images/mail-icon.svg')}}"
                                                                alt="Почта"></span>
                                                        <span class="ps-1">{{ $user->email }}</span>
                                                    </p>
                                                    <p class="mb-1">
                                                        <span class="card-vector"><img
                                                                src="{{asset('storage/img/images/phone-icon.svg')}}"
                                                                alt="Телефон"></span>
                                                        <span class="ps-1">{{ $user->phone }}</span>
                                                    </p>
                                                    <p class="mb-1">
                                                        <span class="card-vector"><img
                                                                src="{{asset('storage/img/images/map-icon.svg')}}"
                                                                alt="Местоположения"></span>
                                                        <span class="ps-1">{{ $user->address }}</span>
                                                    </p>

                                                </div>

                                                <div
                                                    class="text-center mt-3 d-flex justify-content-between align-items-center">
                                                    <a href="{{ route('user.show', $user->id) }}"
                                                       class="btn btn-primary btn-lg">Подробнее</a>
                                                    @if(auth()->check() && auth()->user()->isAdmin())
                                                        <form method="POST"
                                                              action="{{ route('admin.users.update', $user->id) }}">
                                                            @csrf
                                                            @method('PUT') <!-- Изменяем метод на PUT -->
                                                            <input type="hidden" name="_method" value="PUT">
                                                            <!-- Добавляем скрытое поле _method -->
                                                            <button type="submit" name="status" value="deleted"
                                                                    class="btn btn-danger ml-2">Удалить
                                                            </button>
                                                        </form>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="recent element-animation element-show">
        <div class="container">
            <h2 class="heading">Последние объявления</h2>
            <div class="row">
                <div class="job_listing_area">
                    <div class="job_lists">
                        <div class="row">
                            @foreach($users as $user)
                                @if($user->role !== 'admin' && $user->status === 'active')
                                    <div class="col-md-6">
                                        <div class="card border-0 p-3 shadow mb-4">
                                            <div class="card-body">
                                                <h4 class="border-0 fs-5 pb-2 mb-0"><a
                                                        href="{{ route('user.show', $user->id) }}">
                                                        {{ $user->name_company }}</a></h4>
                                                <p class="description">{{ $user->description  }}</p>
                                                <div class="card-info p-4 border">
                                                    <p class="mb-1">
                                                        <span class="card-vector"><img
                                                                src="{{asset('storage/img/images/mail-icon.svg')}}"
                                                                alt="Почта"></span>
                                                        <span class="ps-1">{{ $user->email }}</span>
                                                    </p>
                                                    <p class="mb-1">
                                                        <span class="card-vector"><img
                                                                src="{{asset('storage/img/images/phone-icon.svg')}}"
                                                                alt="Телефон"></span>
                                                        <span class="ps-1">{{ $user->phone }}</span>
                                                    </p>
                                                    <p class="mb-1">
                                                        <span class="card-vector"><img
                                                                src="{{asset('storage/img/images/map-icon.svg')}}"
                                                                alt="Местоположения"></span>
                                                        <span class="ps-1">{{ $user->address }}</span>
                                                    </p>

                                                </div>

                                                <div
                                                    class="text-center mt-3 d-flex justify-content-between align-items-center">
                                                    <a href="{{ route('user.show', $user->id) }}"
                                                       class="btn btn-primary btn-lg">Подробнее</a>
                                                    @if(auth()->check() && auth()->user()->isAdmin())
                                                        <form method="POST"
                                                              action="{{ route('admin.users.update', $user->id) }}">
                                                            @csrf
                                                            @method('PUT') <!-- Изменяем метод на PUT -->
                                                            <input type="hidden" name="_method" value="PUT">
                                                            <!-- Добавляем скрытое поле _method -->
                                                            <button type="submit" name="status" value="deleted"
                                                                    class="btn btn-danger ml-2">Удалить
                                                            </button>
                                                        </form>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
