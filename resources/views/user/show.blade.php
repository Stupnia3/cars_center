@extends('layout')

@section('title', 'Подробная информация о пользователе')

@section('content')
    <section class="main">
        <div>
        </div>
        <div class="container pt-5">
            <div class="row">
                <div class="col">
                    <nav aria-label="bcrumb" class="rounded-3">
                        <ul class="bcrumb mb-0">
                            <li class="bcrumb-item"><a href="{{route('search')}}"><i class="fa fa-arrow-left" aria-hidden="true"></i> ← Обратно в поиск</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <div class="container job_details_area">
            <div class="row pb-5 detail-row">
                <div class="col-md-8 detail-card">
                    <div class="card border-0 shadow mb-4">
                        <div class="card-body p-4">
                            <div class="job_details_header">
                                <div class="single_jobs white-bg d-flex justify-content-between">
                                    <div class="jobs_left d-flex align-items-center">
                                        <div class="jobs_conetent">
                                            <h4 class="mb-4">{{ $user->name_company }}</h4>
                                            <div class="card-details d-flex align-items-center mb-4">
                                                <p>
                                                    <span class="card-vector"><img src="{{asset('storage/img/images/mail-icon.svg')}}" alt="Почта"></span>
                                                    <span class="ps-1">{{ $user->email }}</span>
                                                </p>
                                                <p>
                                                    <span class="card-vector"><img src="{{asset('storage/img/images/map-icon.svg')}}" alt="Местоположения"></span>
                                                    <span class="ps-1">{{ $user->address }}</span>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="jobs_right">
                                        <div class="apply_now ">
                                            <a class="heart_mark" href="javascript:void(0);" onclick="saveJob(57)">
                                                <i class="fa fa-heart-o" aria-hidden="true"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-4">
                                <h4 class="mb-4">Описание</h4>
                                {{ $user->description  }}
                            </div>
                            <div class="mb-4">
                                <h4 class="mb-4">Галерея</h4>
                                <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                                    <div class="carousel-inner">
                                        @if($user->images && $user->images->isNotEmpty())
                                            @foreach ($user->images as $key => $image)
                                                <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                                    <img src="{{ Storage::url($image->image_path) }}" class="d-block w-100" alt="Image">
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="carousel-item active">
                                                <p>Нет загруженных изображений.</p>
                                            </div>
                                        @endif
                                    </div>
                                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-md-4 detail-card">
                    <div class="card border-0 shadow mb-4 p-4">
                        <div class="job_sumary">
                            <div class="summery_header">
                                <h3>Краткое описание</h3>
                            </div>
                            <div class="job_content pt-3">
                                <ul>
                                    <li class="mb-2">Опубликовано: <span class="bold">{{ $user->created_at->format('d.m.Y') }}</span></li>
                                    <li class="mb-2">Имя директора: <span class="bold">{{ $user->full_name }}</span></li>
                                    <li class="mb-2">Город: <span class="bold">Казань</span></li>
                                    <li class="mb-2">Телефон: <span class="bold">{{ $user->phone }}</span></li>
                                    <li class="mb-2">ИНН: <span class="bold">{{ $user->INN }}</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card border-0 shadow mb-4 p-4">
                        <div class="job_sumary">
                            <div class="summery_header">
                                <h3>Виды работ</h3>
                            </div>
                            <div class="job_content pt-3">
                                <ul>
                                    <li class="mb-2"><span class="bold {{ $user->shinomontazh ? 'text-success' : '' }}">{{ $user->shinomontazh ? 'Шиномонтаж' : '' }}</span></li>
                                    <li class="mb-2"><span class="bold {{ $user->sto ? 'text-success' : '' }}">{{ $user->sto ? 'СТО' : '' }}</span></li>
                                    <li class="mb-2"><span class="bold {{ $user->diagnostika ? 'text-success' : '' }}">{{ $user->diagnostika ? 'Диагностика' : '' }}</span></li>
                                    <li class="mb-2"><span class="bold {{ $user->remont_mkpp_akpp ? 'text-success' : '' }}">{{ $user->remont_mkpp_akpp ? 'Ремонт МКПП и АКПП' : '' }}</span></li>
                                    <li class="mb-2"><span class="bold {{ $user->remont_dvigatelya ? 'text-success' : '' }}">{{ $user->remont_dvigatelya ? 'Работа и ремонт двигателя' : '' }}</span></li>
                                    <li class="mb-2">
                                        <span class="bold">
                                            @if($user->license)
                                                <p>Текущая лицензия:</p>
                                                <img class="img_license" src="{{ Storage::url($user->license) }}" alt="Лицензия">
                                            @else
                                                <p class="text-danger">Нет лицензии</p>
                                            @endif
                                        </span>
                                    </li>
                                </ul>
                            </div>
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





{{--    <div class="container">--}}
{{--        <h1 class="mt-4">Подробная информация о компании {{ $user->name_company }}</h1>--}}
{{--        <div class="card">--}}
{{--            <div class="card-body">--}}
{{--                <h5 class="card-title">Информация о компании {{ $user->name_company }}</h5>--}}
{{--                <div class="mb-3">--}}
{{--                    <h5>Галерея изображений:</h5>--}}
{{--                    <div class="row">--}}
{{--                        @if($user->images)--}}
{{--                            @foreach ($user->images as $image)--}}
{{--                                <div class="col-md-4 mb-4">--}}
{{--                                    <img src="{{ Storage::url($image->image_path) }}" alt="Image" class="img-fluid">--}}
{{--                                </div>--}}
{{--                            @endforeach--}}
{{--                        @else--}}
{{--                            <p>Нет загруженных изображений.</p>--}}
{{--                        @endif--}}

{{--                    </div>--}}
{{--                </div>--}}

{{--                <ul class="list-group list-group-flush">--}}
{{--                    <li class="list-group-item">Имя директора: {{ $user->full_name }}</li>--}}
{{--                    <li class="list-group-item">Email: {{ $user->email }}</li>--}}
{{--                    <li class="list-group-item">Телефон: {{ $user->phone }}</li>--}}
{{--                    <li class="list-group-item">ИНН: {{ $user->INN }}</li>--}}
{{--                    <li class="list-group-item">Адрес: {{ $user->address }}</li>--}}
{{--                    <li class="list-group-item">Описание: {{ $user->description  }}</li>--}}

{{--                    <!-- Добавляем поля с широтой и долготой -->--}}
{{--                    <li class="list-group-item">Широта: {{ $user->latitude }}</li>--}}
{{--                    <li class="list-group-item">Долгота: {{ $user->longitude }}</li>--}}

{{--                    <li class="list-group-item {{ $user->shinomontazh ? 'bg-success text-white' : '' }}">Шиномонтаж: {{ $user->shinomontazh ? 'Да' : 'Нет' }}</li>--}}
{{--                    <li class="list-group-item {{ $user->sto ? 'bg-success text-white' : '' }}">СТО: {{ $user->sto ? 'Да' : 'Нет' }}</li>--}}
{{--                    <li class="list-group-item {{ $user->diagnostika ? 'bg-success text-white' : '' }}">Диагностика: {{ $user->diagnostika ? 'Да' : 'Нет' }}</li>--}}
{{--                    <li class="list-group-item {{ $user->remont_mkpp_akpp ? 'bg-success text-white' : '' }}">Ремонт МКПП и АКПП: {{ $user->remont_mkpp_akpp ? 'Да' : 'Нет' }}</li>--}}
{{--                    <li class="list-group-item {{ $user->remont_dvigatelya ? 'bg-success text-white' : '' }}">Работа и ремонт двигателя: {{ $user->remont_dvigatelya ? 'Да' : 'Нет' }}</li>--}}

{{--                </ul>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
    <script>
        ymaps.ready(function () {
            var geolocation = ymaps.geolocation;

            // Получаем координаты и данные о компании из базы данных
            var latitude = {{ $user->latitude }};
            var longitude = {{ $user->longitude }};
            var companyName = '{{ $user->name_company }}';
            var address = '{{ $user->address }}';

            var myMap = new ymaps.Map('map', {
                center: [55, 34], // Центр карты по умолчанию
                zoom: 15
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
            });

            // Создаем метку с данными о компании
            var myPlacemark = new ymaps.Placemark([latitude, longitude], {
                iconContent: companyName, // Название компании будет отображаться на метке
                balloonContentHeader: companyName, // Название компании будет отображаться в заголовке балуна метки
                balloonContentBody: address // Адрес будет отображаться в теле балуна метки
            }, {
                preset: 'islands#blueDotIcon', // Устанавливаем вид метки
                draggable: false // Отключаем возможность перемещения метки
            });

            // Добавляем метку компании на карту
            myMap.geoObjects.add(myPlacemark);
        });
    </script>

@endsection

