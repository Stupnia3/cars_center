@extends('layout')

@section('title', 'Результаты поиска')

@section('content')
    <style>
        /* Добавьте свои стили, если необходимо */
    </style>
    <section class="search main">
        <div class="container">
            <div class="row pt-5">
                <div class="col-6 col-md-10">
                    <h2>Поиск объявлений</h2>
                </div>
                <div class="col-6 col-md-2">
                    <div class="align-end">
                        <form action="{{ route('search') }}" method="GET">
                            <select name="sort" id="sort" class="form-select" onchange="this.form.submit()">
                                <option value="1" {{ request('sort') == 1 ? 'selected' : '' }}>Последние</option>
                                <option value="0" {{ request('sort') == 0 ? 'selected' : '' }}>Старые</option>
                            </select>
                        </form>
                    </div>
                </div>
            </div>

            <div class="row pt-5">
                <div class="col-md-4 col-lg-3 sidebar mb-4">
                    <form action="{{ route('search') }}" method="GET" name="searchForm" id="searchForm">
                        <div class="card border-0 shadow p-4">
                            <div class="mb-4">
                                <p class="bold">Название</p>
                                <input type="text" value="{{ request('keyword') }}" name="keyword" id="keyword" placeholder="Ключевые слова" class="form-control">
                            </div>

                            <div class="mb-4">
                                <p class="bold">Город</p>
                                <input type="text" value="{{ request('location') }}" name="location" id="location" placeholder="Город" class="form-control">
                            </div>

                            <div class="mb-4">
                                <p class="bold">Виды работ</p>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" name="shinomontazh" type="checkbox" value="1" id="shinomontazh" {{ request('shinomontazh') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="shinomontazh">Шиномонтаж</label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" name="sto" type="checkbox" value="1" id="sto" {{ request('sto') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="sto">СТО</label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" name="diagnostika" type="checkbox" value="1" id="diagnostika" {{ request('diagnostika') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="diagnostika">Диагностика</label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" name="remont_mkpp_akpp" type="checkbox" value="1" id="remont_mkpp_akpp" {{ request('remont_mkpp_akpp') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="remont_mkpp_akpp">Ремонт МКПП и АКПП</label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" name="remont_dvigatelya" type="checkbox" value="1" id="remont_dvigatelya" {{ request('remont_dvigatelya') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="remont_dvigatelya">Работа и ремонт двигателя</label>
                                </div>
                            </div>

                            <button type="submit" class="text-center btn btn-primary mb-4">Применить</button>
                            <a href="{{ route('search') }}" class="btn btn-secondary">Сбросить</a>
                        </div>
                    </form>
                </div>
                <div class="col-md-8 col-lg-9">
                    <div class="job_listing_area">
                        <div class="job_lists">
                            <div class="row">
                                @forelse($users as $user)
                                    @if($user->role !== 'admin' && $user->status === 'active')
                                        @php
                                            $carouselId = 'carousel-' . $user->id;
                                            $prevButtonId = 'prev-' . $user->id;
                                            $nextButtonId = 'next-' . $user->id;
                                        @endphp
                                        <div class="col-md-6 search-card">
                                            <div class="card border-0 p-3 shadow mb-4">
                                                <div class="card-body">
                                                    <h4 class="border-0 fs-5 pb-2 mb-0"><a href="{{ route('user.show', $user->id) }}">{{ $user->name_company }}</a></h4>
                                                    <p class="description">{{ $user->description }}</p>
                                                    <div class="card-info p-4 border">
                                                        <p class="mb-1 flex">
                                                            <span class="card-vector"><img src="{{ asset('storage/img/images/mail-icon.svg') }}" alt="Почта"></span>
                                                            <span class="ps-1 nowrap_short">{{ $user->email }}</span>
                                                        </p>
                                                        <p class="mb-1 flex">
                                                            <span class="card-vector"><img src="{{ asset('storage/img/images/phone-icon.svg') }}" alt="Телефон"></span>
                                                            <span class="ps-1 nowrap_short">{{ $user->phone }}</span>
                                                        </p>
                                                        <p class="mb-1 flex">
                                                            <span class="card-vector"><img src="{{ asset('storage/img/images/map-icon.svg') }}" alt="Местоположение"></span>
                                                            <span class="ps-1 nowrap_short">{{ $user->address }}</span>
                                                        </p>
                                                        <div class="mb-4" id="gallery-{{ $user->id }}">
                                                            <div id="{{ $carouselId }}" class="carousel slide" data-bs-ride="carousel">
                                                                <div class="carousel-inner">
                                                                    @if($user->images && $user->images->isNotEmpty())
                                                                        @foreach ($user->images as $key => $image)
                                                                            <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                                                                <img src="{{ Storage::url($image->image_path) }}" class="d-block w-100" alt="Image">
                                                                            </div>
                                                                        @endforeach
                                                                    @else
                                                                        <div class="carousel-item active">
                                                                            <div class="job_content pt-3">
                                                                                <ul>
                                                                                    <li class="mb-2"><span class="bold {{ $user->shinomontazh ? 'text-success' : '' }}">{{ $user->shinomontazh ? 'Шиномонтаж' : '' }}</span></li>
                                                                                    <li class="mb-2"><span class="bold {{ $user->sto ? 'text-success' : '' }}">{{ $user->sto ? 'СТО' : '' }}</span></li>
                                                                                    <li class="mb-2"><span class="bold {{ $user->diagnostika ? 'text-success' : '' }}">{{ $user->diagnostika ? 'Диагностика' : '' }}</span></li>
                                                                                    <li class="mb-2"><span class="bold {{ $user->remont_mkpp_akpp ? 'text-success' : '' }}">{{ $user->remont_mkpp_akpp ? 'Ремонт МКПП и АКПП' : '' }}</span></li>
                                                                                    <li class="mb-2"><span class="bold {{ $user->remont_dvigatelya ? 'text-success' : '' }}">{{ $user->remont_dvigatelya ? 'Работа и ремонт двигателя' : '' }}</span></li>
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                                <button class="carousel-control-prev" type="button" data-bs-target="#{{ $carouselId }}" data-bs-slide="prev" id="{{ $prevButtonId }}">
                                                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                                    <span class="visually-hidden">Previous</span>
                                                                </button>
                                                                <button class="carousel-control-next" type="button" data-bs-target="#{{ $carouselId }}" data-bs-slide="next" id="{{ $nextButtonId }}">
                                                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                                    <span class="visually-hidden">Next</span>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <a href="{{ route('user.show', $user->id) }}" class="btn btn-primary mt-3">Подробнее</a>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @empty
                                    <p>Не найдено пользователей, соответствующих вашему запросу.</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var gallery = document.getElementById("gallery");
            var carouselItems = gallery.querySelectorAll(".carousel-item");

            function displayImage(index) {
                carouselItems.forEach(function(item, i) {
                    if (i === index) {
                        item.classList.add("active");
                    } else {
                        item.classList.remove("active");
                    }
                });
            }

            var itemCount = Math.min(carouselItems.length, 4); // Ограничение отображения только 4 изображений
            for (var i = 0; i < itemCount; i++) {
                carouselItems[i].addEventListener("mousemove", function() {
                    var index = Array.prototype.indexOf.call(carouselItems, this);
                    displayImage(index);
                });
            }
        });
    </script>
@endsection
