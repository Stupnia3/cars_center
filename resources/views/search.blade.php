@extends('layout')

@section('title', 'Результаты поиска')

@section('content')
    <section class="search main">
        <div class="container">
            <div class="row pt-5">
                <div class="col-6 col-md-10">
                    <h2>Поиск объявлений</h2>
                </div>
                <div class="col-6 col-md-2">
                    <div class="align-end">
                        <select name="sort" id="sort" class="form-select">
                            <option value="1">Последние</option>
                            <option value="0">Старые</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row pt-5">
                <div class="col-md-4 col-lg-3 sidebar mb-4">

                    <form action="" name="searchForm" id="searchForm">
                        <div class="card border-0 shadow p-4">
                            <div class="mb-4">
                                <p class="bold">Название</p>
                                <input type="text" value="" name="keyword" id="keyword" placeholder="Ключевые слова" class="form-control">
                            </div>

                            <div class="mb-4">
                                <p class="bold">Город</p>
                                <input type="text" value="" name="location" id="location" placeholder="Город" class="form-control">
                            </div>

                            <div class="mb-4">
                                <p class="bold">Виды работ</p>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" name="job_type" type="checkbox" value="1" id="job-type-1">
                                    <label class="form-check-label" for="job-type-1">Шиномонтаж</label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" name="job_type" type="checkbox" value="2" id="job-type-2">
                                    <label class="form-check-label" for="job-type-2">СТО</label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" name="job_type" type="checkbox" value="3" id="job-type-3">
                                    <label class="form-check-label" for="job-type-3">Диагностика</label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" name="job_type" type="checkbox" value="4" id="job-type-4">
                                    <label class="form-check-label" for="job-type-4">Ремонт МКПП и АКПП</label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" name="job_type" type="checkbox" value="5" id="job-type-5">
                                    <label class="form-check-label" for="job-type-5">Работа и ремонт двигателя</label>
                                </div>
                            </div>

                            <button type="submit" class="text-center btn btn-primary mb-4">Применить</button>
                            <a href="{{route('search')}}" class="btn btn-secondary">Сбросить</a>
                        </div>
                    </form>
                </div>
                <div class="col-md-8 col-lg-9 ">
                    <div class="job_listing_area">
                        <div class="job_lists">
                            <div class="row">
                                @foreach($users as $user)
                                    @if($user->role !== 'admin' && $user->status === 'active')
                                        <div class="col-md-6 search-card">
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
                                <div class="col-md-12">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

