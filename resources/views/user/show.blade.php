@extends('layout')

@section('title', 'Подробная информация о пользователе')

@section('content')
    <div class="container">
        <h1 class="mt-4">Подробная информация о компании {{ $user->name_company }}</h1>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Информация о компании {{ $user->name_company }}</h5>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Имя директора: {{ $user->full_name }}</li>
                    <li class="list-group-item">Email: {{ $user->email }}</li>
                    <li class="list-group-item">Телефон: {{ $user->phone }}</li>
                    <li class="list-group-item">ИНН: {{ $user->INN }}</li>
                    <li class="list-group-item">Адрес: {{ $user->address }}</li>
                    <li class="list-group-item">Описание: {{ $user->description  }}</li>

                    <li class="list-group-item {{ $user->shinomontazh ? 'bg-success text-white' : '' }}">Шиномонтаж: {{ $user->shinomontazh ? 'Да' : 'Нет' }}</li>
                    <li class="list-group-item {{ $user->sto ? 'bg-success text-white' : '' }}">СТО: {{ $user->sto ? 'Да' : 'Нет' }}</li>
                    <li class="list-group-item {{ $user->diagnostika ? 'bg-success text-white' : '' }}">Диагностика: {{ $user->diagnostika ? 'Да' : 'Нет' }}</li>
                    <li class="list-group-item {{ $user->remont_mkpp_akpp ? 'bg-success text-white' : '' }}">Ремонт МКПП и АКПП: {{ $user->remont_mkpp_akpp ? 'Да' : 'Нет' }}</li>
                    <li class="list-group-item {{ $user->remont_dvigatelya ? 'bg-success text-white' : '' }}">Работа и ремонт двигателя: {{ $user->remont_dvigatelya ? 'Да' : 'Нет' }}</li>

                </ul>
            </div>
        </div>
    </div>
@endsection
