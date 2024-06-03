@extends('layout')

@section('title', 'Главная страница')

@section('content')
    <section class="preview element-animation element-show">
        <div class="container">
            <h1 class="preview-heading">Найти автосервис по душе</h1>
            <div class="preview-card">
                <form action="{{ route('search') }}" method="GET">
                    <div class="row">
                        <div class="col-md-3 mb-3 mb-sm-3 mb-lg-0">
                            <input type="text" class="form-control preview-control" name="keyword" id="keyword"
                                   placeholder="Название, виды работ" value="{{ request()->input('keyword') }}">
                        </div>
                        <div class="col-md-3 mb-3 mb-sm-3 mb-lg-0">
                            <input type="text" class="form-control preview-control" name="location" id="location"
                                   placeholder="Город" value="{{ request()->input('location') }}">
                        </div>
                        <div class="col-md-3 mb-xs-3 mb-sm-3 mb-lg-0">
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
                        <div class="row" id="closest-users">
{{--                            @foreach($closestUsers as $user)--}}
{{--                                    <div class="col-md-6">--}}
{{--                                        <div class="card border-0 p-3 shadow mb-4">--}}
{{--                                            <div class="card-body">--}}
{{--                                                <h4 class="border-0 fs-5 pb-2 mb-0"><a--}}
{{--                                                        href="{{ route('user.show', $user->id) }}">--}}
{{--                                                        {{ $user->name_company }}</a></h4>--}}
{{--                                                <p class="description">{{ $user->description  }}</p>--}}
{{--                                                <div class="card-info p-4 border">--}}
{{--                                                    <p class="mb-1">--}}
{{--                                                        <span class="card-vector"><img--}}
{{--                                                                src="{{asset('storage/img/images/mail-icon.svg')}}"--}}
{{--                                                                alt="Почта"></span>--}}
{{--                                                        <span class="ps-1">{{ $user->email }}</span>--}}
{{--                                                    </p>--}}
{{--                                                    <p class="mb-1">--}}
{{--                                                        <span class="card-vector"><img--}}
{{--                                                                src="{{asset('storage/img/images/phone-icon.svg')}}"--}}
{{--                                                                alt="Телефон"></span>--}}
{{--                                                        <span class="ps-1">{{ $user->phone }}</span>--}}
{{--                                                    </p>--}}
{{--                                                    <p class="mb-1">--}}
{{--                                                        <span class="card-vector"><img--}}
{{--                                                                src="{{asset('storage/img/images/map-icon.svg')}}"--}}
{{--                                                                alt="Местоположения"></span>--}}
{{--                                                        <span class="ps-1">{{ $user->address }}</span>--}}
{{--                                                    </p>--}}

{{--                                                </div>--}}

{{--                                                <div--}}
{{--                                                    class="text-center mt-3 d-flex justify-content-between align-items-center">--}}
{{--                                                    <a href="{{ route('user.show', $user->id) }}"--}}
{{--                                                       class="btn btn-primary btn-lg">Подробнее</a>--}}
{{--                                                    @if(auth()->check() && auth()->user()->isAdmin())--}}
{{--                                                        <form method="POST"--}}
{{--                                                              action="{{ route('admin.users.update', $user->id) }}">--}}
{{--                                                            @csrf--}}
{{--                                                            @method('PUT') <!-- Изменяем метод на PUT -->--}}
{{--                                                            <input type="hidden" name="_method" value="PUT">--}}
{{--                                                            <!-- Добавляем скрытое поле _method -->--}}
{{--                                                            <button type="submit" name="status" value="deleted"--}}
{{--                                                                    class="btn btn-danger ml-2">Удалить--}}
{{--                                                            </button>--}}
{{--                                                        </form>--}}
{{--                                                    @endif--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                            @endforeach--}}
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
        <div class="container pt-5">
            <div class="row">
                <div class="col">
                    <div id="map"></div>
                </div>
            </div>
        </div>
    </section>
    @php
        $isAdmin = (auth()->check() && auth()->user()->isAdmin());
    @endphp

    <script>

        ymaps.ready(function () {
            var geolocation = ymaps.geolocation;

            var myMap = new ymaps.Map('map', {
                center: [55, 34], // Центр карты по умолчанию
                zoom: 10
            }, {
                searchControlProvider: 'yandex#search'
            });

            // Сравним положение, вычисленное по IP пользователя и
            // положение, вычисленное средствами браузера.
            geolocation.get({
                provider: 'yandex',
                mapStateAutoApply: true
            }).then(function (result) {
                // Красным цветом пометим положение, вычисленное через IP.
                result.geoObjects.options.set('preset', 'islands#redCircleIcon');
                result.geoObjects.get(0).properties.set({
                    balloonContentBody: 'Мое местоположение'
                });
                myMap.geoObjects.add(result.geoObjects);

                // Добавляем метки всех пользователей на карту
                var userMarkers = [];
                @foreach($users as $user)
                @if($user->role !== 'admin' && $user->status === 'active')
                var latitude_{{ $user->id }} = {{ $user->latitude ?? 'null' }};
                var longitude_{{ $user->id }} = {{ $user->longitude ?? 'null' }};
                var companyName_{{ $user->id }} = '{{ $user->name_company }}';
                var address_{{ $user->id }} = '{{ $user->address }}';

                // Проверяем, есть ли у пользователя координаты
                if (latitude_{{ $user->id }} !== null && longitude_{{ $user->id }} !== null) {
                    // Создаем метку с данными о компании
                    var myPlacemark_{{ $user->id }} = new ymaps.Placemark([latitude_{{ $user->id }}, longitude_{{ $user->id }}], {
                        iconContent: companyName_{{ $user->id }},
                        balloonContentHeader: companyName_{{ $user->id }}
                    }, {
                        preset: 'islands#blueDotIcon',
                        draggable: false
                    });

                    // Добавляем метку компании на карту
                    myMap.geoObjects.add(myPlacemark_{{ $user->id }});

                    // Добавляем обработчик клика на метку
                    myPlacemark_{{ $user->id }}.events.add('click', function () {
                        window.location.href = '/users/{{ $user->id }}'; // Перенаправляем на страницу пользователя
                    });

                    // Добавляем метку компании в массив меток
                    userMarkers.push({
                        placemark: myPlacemark_{{ $user->id }},
                        distance: ymaps.coordSystem.geo.getDistance(result.geoObjects.get(0).geometry.getCoordinates(), [latitude_{{ $user->id }}, longitude_{{ $user->id }}]),
                        userId: {{ $user->id }} // Добавляем идентификатор пользователя в массив
                    });
                }
                @endif
                @endforeach

                // Сортируем метки по расстоянию до текущего местоположения пользователя
                userMarkers.sort(function(a, b) {
                    return a.distance - b.distance;
                });

                // Оставляем только две ближайшие метки
                if (userMarkers.length > 2) {
                    userMarkers = userMarkers.slice(0, 2);
                }

                // Добавляем все метки пользователей на карту
                userMarkers.forEach(function(marker) {
                    myMap.geoObjects.add(marker.placemark);
                });

                // Массив для хранения идентификаторов ближайших пользователей
                var closestUserIds = [];

                // Добавляем идентификаторы ближайших пользователей в массив
                userMarkers.forEach(function(marker) {
                    closestUserIds.push(marker.userId);
                });

                // Выводим идентификаторы ближайших пользователей в консоль для проверки
                console.log('Ближайшие пользователи:', closestUserIds);
                // Посылаем AJAX-запрос на сервер с идентификаторами ближайших пользователей
                $.ajax({
                    type: 'POST',
                    url: '{{ route("get-closest-users") }}',
                    data: {
                        closestUserIds: closestUserIds,
                        // Включение CSRF-токена в данные запроса
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        console.log(response); // Убедимся, что данные приходят правильно
                        // Очищаем содержимое элемента
                        var isAdmin = {{ $isAdmin ? 'true' : 'false' }};
                        $('#closest-users').empty();

                        // Добавляем данные о ближайших пользователях
                        response.forEach(function(user) {
                            console.log(user); // Выведем объект пользователя для проверки
                            // Создаем HTML-элементы с помощью jQuery
                            var card = $('<div class="col-md-6">' +
                                '<div class="card border-0 p-3 shadow mb-4">' +
                                '<div class="card-body">' +
                                '<h4 class="border-0 fs-5 pb-2 mb-0"><a href="/user/show/' + user.id + '">' + user.name_company + '</a></h4>' +
                                // Заменил user.name_company на user.full_name, так как в объекте пользователя нет свойства name_company
                                '<p class="description">' + user.description + '</p>' + // У объектов пользователя нет свойства description
                                '<div class="card-info p-4 border">' +
                                '<p class="mb-1">' +
                                '<span class="card-vector"><img src="{{asset('storage/img/images/mail-icon.svg')}}" alt="Почта"></span>' +
                                '<span class="ps-1">' + user.email + '</span>' +
                                '</p>' +
                                '<p class="mb-1">' +
                                '<span class="card-vector"><img src="{{asset('storage/img/images/phone-icon.svg')}}" alt="Телефон"></span>' +
                                '<span class="ps-1">' + user.phone + '</span>' +
                                '</p>' +
                                '<p class="mb-1">' +
                                '<span class="card-vector"><img src="{{asset('storage/img/images/map-icon.svg')}}" alt="Местоположения"></span>' +
                                '<span class="ps-1">' + user.address + '</span>' +
                                '</p>' +
                                '</div>' +
                                '<div class="text-center mt-3 d-flex justify-content-between align-items-center">' +
                                '<a href="/users/' + user.id + '" class="btn btn-primary btn-lg">Подробнее</a>' +
                                // У объектов пользователя нет свойства isAdmin
                                (isAdmin ?
                                    '<form method="POST" action="/admin/users/update/' + user.id + '">' +
                                    '{{ csrf_field() }}' + // Используйте это вместо '@csrf'
                                    '<input type="hidden" name="_method" value="PUT">' +
                                    '<button type="submit" name="status" value="deleted" class="btn btn-danger ml-2">Удалить</button>' +
                                    '</form>' : '') +
                                '</div>' +
                                '</div>' +
                                '</div>' +
                                '</div>');

                            // Добавляем созданный HTML-элемент в #closest-users
                            $('#closest-users').append(card);
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error('Произошла ошибка:', error);
                    }
                });
            });
        });
    </script>






@endsection
