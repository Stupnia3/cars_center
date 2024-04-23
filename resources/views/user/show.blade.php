@extends('layout')

@section('title', 'Подробная информация о пользователе')

@section('content')
    <div class="container">
        <h1 class="mt-4">Подробная информация о компании {{ $user->name_company }}</h1>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Информация о компании {{ $user->name_company }}</h5>
                <div class="mb-3">
                    <h5>Галерея изображений:</h5>
                    <div class="row">
                        @if($user->images)
                            @foreach ($user->images as $image)
                                <div class="col-md-4 mb-4">
                                    <img src="{{ Storage::url($image->image_path) }}" alt="Image" class="img-fluid">
                                </div>
                            @endforeach
                        @else
                            <p>Нет загруженных изображений.</p>
                        @endif

                    </div>
                </div>

                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Имя директора: {{ $user->full_name }}</li>
                    <li class="list-group-item">Email: {{ $user->email }}</li>
                    <li class="list-group-item">Телефон: {{ $user->phone }}</li>
                    <li class="list-group-item">ИНН: {{ $user->INN }}</li>
                    <li class="list-group-item">Адрес: {{ $user->address }}</li>
                    <li class="list-group-item">Описание: {{ $user->description  }}</li>

                    <!-- Добавляем поля с широтой и долготой -->
                    <li class="list-group-item">Широта: {{ $user->latitude }}</li>
                    <li class="list-group-item">Долгота: {{ $user->longitude }}</li>

                    <li class="list-group-item {{ $user->shinomontazh ? 'bg-success text-white' : '' }}">Шиномонтаж: {{ $user->shinomontazh ? 'Да' : 'Нет' }}</li>
                    <li class="list-group-item {{ $user->sto ? 'bg-success text-white' : '' }}">СТО: {{ $user->sto ? 'Да' : 'Нет' }}</li>
                    <li class="list-group-item {{ $user->diagnostika ? 'bg-success text-white' : '' }}">Диагностика: {{ $user->diagnostika ? 'Да' : 'Нет' }}</li>
                    <li class="list-group-item {{ $user->remont_mkpp_akpp ? 'bg-success text-white' : '' }}">Ремонт МКПП и АКПП: {{ $user->remont_mkpp_akpp ? 'Да' : 'Нет' }}</li>
                    <li class="list-group-item {{ $user->remont_dvigatelya ? 'bg-success text-white' : '' }}">Работа и ремонт двигателя: {{ $user->remont_dvigatelya ? 'Да' : 'Нет' }}</li>

                </ul>
            </div>
        </div>
    </div>

    <!-- Добавляем карту для отображения местоположения -->
    <div id="map" style="height: 400px; width: 100%;"></div>

    <!-- JavaScript-код для инициализации карты и отображения местоположения пользователя -->
    <script>
        function initMap() {
            // Инициализация карты
            var map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: {{ $user->latitude }}, lng: {{ $user->longitude }}}, // Устанавливаем центр карты
                zoom: 8 // Устанавливаем масштаб
            });

            // Добавление маркера с местоположением пользователя
            var marker = new google.maps.Marker({
                position: {lat: {{ $user->latitude }}, lng: {{ $user->longitude }}}, // Устанавливаем позицию маркера
                map: map, // Устанавливаем карту, на которую добавляем маркер
                title: 'Местоположение пользователя' // Устанавливаем заголовок маркера
            });
        }
    </script>
    <!-- Подключаем JavaScript API для работы с картами -->
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=initMap"></script>
@endsection
